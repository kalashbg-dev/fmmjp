<?php
/**
 * Funciones Avanzadas del Tema Hijo FJP
 * Incluye funciones premium para optimización, seguridad y funcionalidades avanzadas
 */

// ===== SEGURIDAD Y PROTECCIÓN PREMIUM =====

/**
 * Desactivar XML-RPC para mejorar seguridad
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Ocultar versión de WordPress
 */
remove_action('wp_head', 'wp_generator');
add_filter('the_generator', '__return_empty_string');

/**
 * Desactivar edición de temas y plugins desde el admin
 */
define('DISALLOW_FILE_EDIT', true);

/**
 * Limitar intentos de login fallidos
 */
function fjp_limit_login_attempts() {
    $max_attempts = 5;
    $lockout_time = 15 * 60; // 15 minutos

    if (!session_id()) {
        session_start();
    }

    $user_ip = $_SERVER['REMOTE_ADDR'];
    $attempt_key = 'login_attempts_' . $user_ip;
    $lockout_key = 'login_lockout_' . $user_ip;

    // Verificar si está en período de bloqueo
    if (isset($_SESSION[$lockout_key]) && $_SESSION[$lockout_key] > time()) {
        $time_remaining = ceil(($_SESSION[$lockout_key] - time()) / 60);
        wp_die('Demasiados intentos fallidos. Por favor, inténtalo de nuevo en ' . $time_remaining . ' minutos.');
    }

    // Si el login falla, incrementar contador
    add_action('wp_login_failed', function() use ($attempt_key, $lockout_key, $max_attempts, $lockout_time) {
        if (!isset($_SESSION[$attempt_key])) {
            $_SESSION[$attempt_key] = 0;
        }

        $_SESSION[$attempt_key]++;

        if ($_SESSION[$attempt_key] >= $max_attempts) {
            $_SESSION[$lockout_key] = time() + $lockout_time;
            $_SESSION[$attempt_key] = 0;
        }
    });
}
add_action('init', 'fjp_limit_login_attempts');

// ===== RENDIMIENTO Y OPTIMIZACIÓN =====

/**
 * Desactivar emojis de WordPress
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

/**
 * Desactivar embeds de WordPress
 */
function fjp_disable_embeds() {
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
    remove_action('rest_api_init', 'wp_oembed_register_route');
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
    remove_filter('pre_oembed_result', 'wp_filter_pre_oembed_result', 10);
}
add_action('init', 'fjp_disable_embeds', 9999);

/**
 * Optimizar Heartbeat API
 */
function fjp_optimize_heartbeat($settings) {
    $settings['interval'] = 60; // Reducir frecuencia a 60 segundos
    return $settings;
}
add_filter('heartbeat_settings', 'fjp_optimize_heartbeat');

/**
 * Desactivar Heartbeat en páginas específicas
 */
function fjp_disable_heartbeat() {
    global $pagenow;

    if ($pagenow == 'post.php' || $pagenow == 'post-new.php') {
        return;
    }
    wp_deregister_script('heartbeat');
}
add_action('init', 'fjp_disable_heartbeat', 1);

/**
 * Añadir prefetch DNS para recursos externos
 */
function fjp_dns_prefetch() {
    echo '<meta http-equiv="x-dns-prefetch-control" content="on">' . PHP_EOL;
    echo '<link rel="dns-prefetch" href="//fonts.googleapis.com" />' . PHP_EOL;
    echo '<link rel="dns-prefetch" href="//fonts.gstatic.com" />' . PHP_EOL;
    echo '<link rel="dns-prefetch" href="//cdnjs.cloudflare.com" />' . PHP_EOL;
    echo '<link rel="dns-prefetch" href="//ajax.googleapis.com" />' . PHP_EOL;
    echo '<link rel="dns-prefetch" href="//www.googletagmanager.com" />' . PHP_EOL;
}
add_action('wp_head', 'fjp_dns_prefetch', 0);

// ===== FUNCIONES DE UTILIDAD PREMIUM =====

/**
 * Detectar idioma del navegador y redirigir
 */
function fjp_detectar_idioma_y_redirigir() {
    if (is_admin() || isset($_COOKIE['fjp_idioma_redirect'])) {
        return;
    }

    $idioma_navegador = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $idioma_actual = function_exists('pll_current_language') ? pll_current_language() : get_locale();

    // Si el idioma del navegador es diferente al actual y no es español, redirigir
    if ($idioma_navegador !== 'es' && $idioma_navegador !== substr($idioma_actual, 0, 2)) {
        $url_base = home_url();
        $url_destino = $url_base;

        switch ($idioma_navegador) {
            case 'en':
                $url_destino = $url_base . '/en/';
                break;
            case 'pt':
                $url_destino = $url_base . '/pt/';
                break;
            case 'fr':
                $url_destino = $url_base . '/fr/';
                break;
        }

        setcookie('fjp_idioma_redirect', '1', time() + 86400, '/'); // 24 horas
        wp_redirect($url_destino);
        exit;
    }
}
add_action('init', 'fjp_detectar_idioma_y_redirigir');

/**
 * Botón flotante de WhatsApp con animaciones
 */
function fjp_whatsapp_flotante() {
    if (is_admin()) {
        return;
    }

    $numero_whatsapp = get_option('fjp_whatsapp_numero', '+5491134567890');
    $mensaje_default = get_option('fjp_whatsapp_mensaje', 'Hola, quisiera obtener más información sobre la Fundación Juega y Participa');
    ?>
    <div id="whatsapp-flotante" class="whatsapp-flotante">
        <a href="https://wa.me/<?php echo esc_attr(str_replace(['+', ' ', '-'], '', $numero_whatsapp)); ?>?text=<?php echo urlencode($mensaje_default); ?>"
           target="_blank"
           rel="noopener noreferrer"
           class="whatsapp-btn"
           title="Contactar por WhatsApp">
            <i class="fab fa-whatsapp"></i>
            <span class="whatsapp-text">Chateá con nosotros</span>
        </a>
    </div>


    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var whatsappBtn = document.querySelector('.whatsapp-btn');
        var whatsappFlotante = document.getElementById('whatsapp-flotante');

        // Mostrar después de 3 segundos
        setTimeout(function() {
            whatsappFlotante.style.display = 'block';
        }, 3000);

        // Añadir efecto de pulso cada 10 segundos
        setInterval(function() {
            whatsappBtn.style.animation = 'pulse 2s infinite';
            setTimeout(function() {
                whatsappBtn.style.animation = 'none';
            }, 2000);
        }, 10000);

        // Añadir animación de pulse
        var style = document.createElement('style');
        style.textContent = `
            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.05); }
                100% { transform: scale(1); }
            }
        `;
        document.head.appendChild(style);
    });
    </script>
    <?php
}
add_action('wp_footer', 'fjp_whatsapp_flotante');

/**
 * Lazy loading avanzado para imágenes
 */
function fjp_lazy_loading_imagenes($content) {
    return preg_replace('/<img([^>]+?)src=/', '<img$1loading="lazy" src=', $content);
}
add_filter('the_content', 'fjp_lazy_loading_imagenes');

/**
 * Generar WebP automáticamente
 */
function fjp_generar_webp($attachment_id) {
    $file = get_attached_file($attachment_id);
    $info = pathinfo($file);

    if (!in_array(strtolower($info['extension']), ['jpg', 'jpeg', 'png'])) {
        return;
    }

    $webp_file = $info['dirname'] . '/' . $info['filename'] . '.webp';

    if (file_exists($webp_file)) {
        return;
    }

    $image = wp_get_image_editor($file);
    if (!is_wp_error($image)) {
        $image->set_quality(85);
        $image->save($webp_file, 'image/webp');
    }
}
add_action('wp_generate_attachment_metadata', 'fjp_generar_webp');

// ===== FUNCIONES PARA GIVEWP PREMIUM =====

/**
 * Personalizar formularios de GiveWP
 */
function fjp_personalizar_givewp_form($form_id) {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Añadir animación al montos
        var giveAmounts = document.querySelectorAll('.give-donation-level-btn');
        giveAmounts.forEach(function(btn) {
            btn.addEventListener('click', function() {
                // Remover clase activa de todos
                giveAmounts.forEach(function(b) {
                    b.classList.remove('give-btn-level-active');
                });
                // Añadir clase activa al seleccionado
                this.classList.add('give-btn-level-active');
            });
        });

        // Validación personalizada
        var giveForm = document.querySelector('.give-form');
        if (giveForm) {
            giveForm.addEventListener('submit', function(e) {
                var amount = document.querySelector('.give-amount-top');
                if (amount && parseFloat(amount.value) < 100) {
                    e.preventDefault();
                    alert('El monto mínimo de donación es de $100 ARS');
                    return false;
                }
            });
        }
    });
    </script>
    <?php
}
add_action('give_pre_form_output', 'fjp_personalizar_givewp_form');

/**
 * Añadir campos personalizados al formulario de GiveWP
 */
function fjp_campos_personalizados_givewp($form_id, $args) {
    ?>
    <div class="give-form-row give-donor-address-wrap">
        <label class="give-label" for="give-address">Dirección Completa</label>
        <input type="text" name="give_address" id="give-address" class="give-input" placeholder="Calle, Número, Ciudad" />
    </div>

    <div class="give-form-row give-donor-phone-wrap">
        <label class="give-label" for="give-phone">Teléfono de Contacto</label>
        <input type="tel" name="give_phone" id="give-phone" class="give-input" placeholder="+54 11 1234-5678" />
    </div>

    <div class="give-form-row give-donor-motivo-wrap">
        <label class="give-label" for="give-motivo">¿Qué te motivó a donar?</label>
        <select name="give_motivo" id="give-motivo" class="give-select">
            <option value="">Seleccionar motivo</option>
            <option value="apoyo-infantil">Apoyo a niños y niñas</option>
            <option value="educacion">Educación y formación</option>
            <option value="salud">Salud y bienestar</option>
            <option value="comunidad">Desarrollo comunitario</option>
            <option value="otros">Otros</option>
        </select>
    </div>

    <div class="give-form-row give-donor-comentarios-wrap">
        <label class="give-label" for="give-comentarios">Comentarios adicionales</label>
        <textarea name="give_comentarios" id="give-comentarios" class="give-textarea" rows="3" placeholder="¿Quisieras compartir algo más con nosotros?"></textarea>
    </div>
    <?php
}
add_action('give_donor_after_name', 'fjp_campos_personalizados_givewp', 10, 2);

/**
 * Guardar datos personalizados de GiveWP
 */
function fjp_guardar_campos_personalizados_givewp($payment_id, $payment_data) {
    if (isset($_POST['give_address'])) {
        update_post_meta($payment_id, '_give_donor_address', sanitize_text_field($_POST['give_address']));
    }

    if (isset($_POST['give_phone'])) {
        update_post_meta($payment_id, '_give_donor_phone', sanitize_text_field($_POST['give_phone']));
    }

    if (isset($_POST['give_motivo'])) {
        update_post_meta($payment_id, '_give_donor_motivo', sanitize_text_field($_POST['give_motivo']));
    }

    if (isset($_POST['give_comentarios'])) {
        update_post_meta($payment_id, '_give_donor_comentarios', sanitize_textarea_field($_POST['give_comentarios']));
    }
}
add_action('give_insert_payment', 'fjp_guardar_campos_personalizados_givewp', 10, 2);

// ===== FUNCIONES PARA EL CPT NOTICIAS =====

/**
 * Añadir columnas personalizadas al listado de noticias
 */
function fjp_columnas_noticias($columns) {
    $columns['fecha_noticia'] = 'Fecha de la Noticia';
    $columns['fuente_noticia'] = 'Fuente';
    $columns['imagen_destacada'] = 'Imagen';
    return $columns;
}
add_filter('manage_noticias_posts_columns', 'fjp_columnas_noticias');

/**
 * Rellenar las columnas personalizadas
 */
function fjp_rellenar_columnas_noticias($column, $post_id) {
    switch ($column) {
        case 'fecha_noticia':
            $fecha = get_field('fecha_de_publicacion', $post_id);
            echo $fecha ? date('d/m/Y', strtotime($fecha)) : '—';
            break;

        case 'fuente_noticia':
            $fuente = get_field('fuente', $post_id);
            echo $fuente ? esc_html($fuente) : '—';
            break;

        case 'imagen_destacada':
            if (has_post_thumbnail($post_id)) {
                echo get_the_post_thumbnail($post_id, 'thumbnail', ['style' => 'width: 50px; height: auto;']);
            } else {
                echo '—';
            }
            break;
    }
}
add_action('manage_noticias_posts_custom_column', 'fjp_rellenar_columnas_noticias', 10, 2);

/**
 * Hacer columnas ordenables
 */
function fjp_columnas_orderables_noticias($columns) {
    $columns['fecha_noticia'] = 'fecha_noticia';
    $columns['fuente_noticia'] = 'fuente_noticia';
    return $columns;
}
add_filter('manage_edit-noticias_sortable_columns', 'fjp_columnas_orderables_noticias');

/**
 * Ordenamiento personalizado
 */
function fjp_ordenar_columnas_noticias($query) {
    if (!is_admin()) {
        return;
    }

    $orderby = $query->get('orderby');

    if ('fecha_noticia' == $orderby) {
        $query->set('meta_key', 'fecha_de_publicacion');
        $query->set('orderby', 'meta_value');
        $query->set('order', 'DESC');
    } elseif ('fuente_noticia' == $orderby) {
        $query->set('meta_key', 'fuente');
        $query->set('orderby', 'meta_value');
        $query->set('order', 'ASC');
    }
}
add_action('pre_get_posts', 'fjp_ordenar_columnas_noticias');

// ===== FUNCIONES DE BACKUP Y MANTENIMIENTO =====

/**
 * Crear backup de la base de datos
 */
function fjp_crear_backup() {
    global $wpdb;

    $backup_dir = WP_CONTENT_DIR . '/backups-fjp/';
    if (!file_exists($backup_dir)) {
        mkdir($backup_dir, 0755, true);
    }

    $fecha = date('Y-m-d_H-i-s');
    $backup_file = $backup_dir . 'backup_' . $fecha . '.sql';

    $tables = [];
    $result = $wpdb->get_results("SHOW TABLES", ARRAY_N);

    foreach ($result as $row) {
        $tables[] = $row[0];
    }

    $sql = "-- Backup FJP " . date('Y-m-d H:i:s') . "\n\n";

    foreach ($tables as $table) {
        $result = $wpdb->get_results("SELECT * FROM $table", ARRAY_A);
        $sql .= "DROP TABLE IF EXISTS $table;\n";

        $create_table = $wpdb->get_row("SHOW CREATE TABLE $table", ARRAY_N);
        $sql .= $create_table[1] . ";\n\n";

        foreach ($result as $row) {
            $sql .= "INSERT INTO $table VALUES(";
            $values = [];
            foreach ($row as $value) {
                $values[] = "'" . esc_sql($value) . "'";
            }
            $sql .= implode(',', $values) . ");\n";
        }
        $sql .= "\n";
    }

    file_put_contents($backup_file, $sql);

    // Subir a Google Drive (requiere configuración adicional)
    // fjp_subir_a_google_drive($backup_file);

    return $backup_file;
}

// Programar backup semanal
if (!wp_next_scheduled('fjp_backup_semanal')) {
    wp_schedule_event(time(), 'weekly', 'fjp_backup_semanal');
}
add_action('fjp_backup_semanal', 'fjp_crear_backup');

// ===== FUNCIONES DE ANALÍTICAS Y SEO =====

/**
 * Añadir Google Analytics
 */
function fjp_google_analytics() {
    $ga_id = get_option('fjp_google_analytics_id');
    if ($ga_id && !is_admin()) {
        ?>
        <!-- Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($ga_id); ?>"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?php echo esc_js($ga_id); ?>');
        </script>
        <?php
    }
}
add_action('wp_head', 'fjp_google_analytics');

/**
 * Añadir estructura JSON-LD para SEO
 */
function fjp_json_ld_schema() {
    if (is_single() && get_post_type() == 'noticias') {
        $post_id = get_the_ID();
        $titulo = get_the_title($post_id);
        $descripcion = wp_trim_words(get_the_content($post_id), 30);
        $imagen = get_the_post_thumbnail_url($post_id, 'full');
        $fecha = get_the_date('c', $post_id);
        $autor = get_the_author();

        $schema = [
            "@context" => "https://schema.org",
            "@type" => "NewsArticle",
            "headline" => $titulo,
            "description" => $descripcion,
            "image" => $imagen,
            "datePublished" => $fecha,
            "author" => [
                "@type" => "Organization",
                "name" => $autor
            ],
            "publisher" => [
                "@type" => "Organization",
                "name" => "Fundación Juega y Participa",
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => get_template_directory_uri() . '/assets/img/logo-fjp.png'
                ]
            ]
        ];

        echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>';
    }
}
add_action('wp_head', 'fjp_json_ld_schema');

// ===== FUNCIONES DE MANTENIMIENTO Y LIMPIEZA =====

/**
 * Limpiar revisiones antiguas de posts
 */
function fjp_limpiar_revisiones() {
    global $wpdb;

    $dias = 30; // Conservar revisiones de los últimos 30 días
    $fecha_limite = date('Y-m-d H:i:s', strtotime("-{$dias} days"));

    $revisiones = $wpdb->get_results(
        "SELECT ID FROM {$wpdb->posts}
         WHERE post_type = 'revision'
         AND post_date < '{$fecha_limite}'
         LIMIT 100"
    );

    foreach ($revisiones as $revision) {
        wp_delete_post($revision->ID, true);
    }
}

// Programar limpieza mensual
if (!wp_next_scheduled('fjp_limpieza_mensual')) {
    wp_schedule_event(time(), 'monthly', 'fjp_limpieza_mensual');
}
add_action('fjp_limpieza_mensual', 'fjp_limpiar_revisiones');

/**
 * Optimizar base de datos
 */
function fjp_optimizar_bd() {
    global $wpdb;

    $tables = $wpdb->get_results("SHOW TABLES", ARRAY_N);

    foreach ($tables as $table) {
        $wpdb->query("OPTIMIZE TABLE {$table[0]}");
    }
}

// Programar optimización semanal
if (!wp_next_scheduled('fjp_optimizacion_semanal')) {
    wp_schedule_event(time(), 'weekly', 'fjp_optimizacion_semanal');
}
add_action('fjp_optimizacion_semanal', 'fjp_optimizar_bd');

// ===== FUNCIONES DE SEGURIDAD ADICIONALES =====

/**
 * Cambiar prefijo de las tablas de WordPress (solo ejecutar una vez)
 */
function fjp_cambiar_prefijo_tablas() {
    // Esta función debe ejecutarse con EXTREMO CUIDADO
    // y solo una vez durante la instalación
    // Se recomienda hacer backup antes

    // Código comentado por seguridad
    // Descomentar solo si es necesario y con backup previo
    /*
    global $wpdb;
    $old_prefix = 'wp_';
    $new_prefix = 'fjp_';

    $tables = $wpdb->get_results("SHOW TABLES LIKE '{$old_prefix}%'", ARRAY_N);

    foreach ($tables as $table) {
        $new_table = str_replace($old_prefix, $new_prefix, $table[0]);
        $wpdb->query("RENAME TABLE {$table[0]} TO {$new_table}");
    }

    // Actualizar opciones
    $wpdb->query("UPDATE {$new_prefix}options SET option_name = REPLACE(option_name, '{$old_prefix}', '{$new_prefix}')");
    $wpdb->query("UPDATE {$new_prefix}usermeta SET meta_key = REPLACE(meta_key, '{$old_prefix}', '{$new_prefix}')");
    */
}

// Se ha eliminado la función fjp_proteger_sql_injection por problemas de seguridad y compatibilidad.
// WordPress ya maneja la sanitización de inputs a través de sus APIs (prepare, sanitize_*, etc).

// ===== FUNCIONES DE RENDIMIENTO PARA PÁGINAS ESPECÍFICAS =====

/**
 * Desactivar plugins innecesarios en páginas específicas
 */
function fjp_optimizar_plugins() {
    // Desactivar plugins pesados en páginas de donaciones
    if (is_page('donaciones')) {
        // Desactivar plugins que no sean necesarios
        // add_filter('option_active_plugins', 'fjp_desactivar_plugins_pesados');
    }
}
add_action('wp_loaded', 'fjp_optimizar_plugins');

/**
 * Precargar recursos críticos
 */
function fjp_precargar_recursos() {
    if (is_page('home')) {
        echo '<link rel="preload" href="' . get_template_directory_uri() . '/assets/css/critical.css" as="style">';
        echo '<link rel="preload" href="' . get_template_directory_uri() . '/assets/js/critical.js" as="script">';
    }
}
add_action('wp_head', 'fjp_precargar_recursos', 1);

// ===== FUNCIONES DE ACCESIBILIDAD =====

/**
 * Mejorar accesibilidad del sitio
 */
function fjp_mejorar_accesibilidad() {
    // Añadir saltos de navegación
    echo '<a class="skip-link screen-reader-text" href="#main">Ir al contenido principal</a>';
    echo '<a class="skip-link screen-reader-text" href="#footer">Ir al pie de página</a>';

    // Añadir atributos ARIA
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mejorar navegación por teclado
        var focusableElements = document.querySelectorAll('a, button, input, select, textarea');
        focusableElements.forEach(function(element) {
            element.addEventListener('focus', function() {
                this.style.outline = '2px solid #2A9D8F';
                this.style.outlineOffset = '2px';
            });

            element.addEventListener('blur', function() {
                this.style.outline = 'none';
            });
        });

        // Añadir indicadores visuales
        var buttons = document.querySelectorAll('.give-btn, .btn, button');
        buttons.forEach(function(button) {
            button.setAttribute('role', 'button');
            if (!button.hasAttribute('aria-label')) {
                button.setAttribute('aria-label', button.textContent || 'Botón');
            }
        });
    });
    </script>
    <?php
}
add_action('wp_body_open', 'fjp_mejorar_accesibilidad');

// ===== FUNCIONES DE MANTENIMIENTO DE USUARIOS =====

/**
 * Limpiar usuarios inactivos
 */
function fjp_limpiar_usuarios_inactivos() {
    $usuarios_inactivos = get_users([
        'meta_query' => [
            [
                'key' => 'last_login',
                'value' => date('Y-m-d H:i:s', strtotime('-1 year')),
                'compare' => '<'
            ]
        ]
    ]);

    foreach ($usuarios_inactivos as $usuario) {
        // Solo eliminar usuarios con rol de suscriptor
        if (in_array('subscriber', $usuario->roles)) {
            wp_delete_user($usuario->ID);
        }
    }
}

// Programar limpieza mensual de usuarios
if (!wp_next_scheduled('fjp_limpieza_usuarios')) {
    wp_schedule_event(time(), 'monthly', 'fjp_limpieza_usuarios');
}
add_action('fjp_limpieza_usuarios', 'fjp_limpiar_usuarios_inactivos');

/**
 * Registrar último login de usuarios
 */
function fjp_registrar_ultimo_login($user_login, $user) {
    update_user_meta($user->ID, 'last_login', current_time('mysql'));
}
add_action('wp_login', 'fjp_registrar_ultimo_login', 10, 2);