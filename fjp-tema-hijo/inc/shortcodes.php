<?php
/**
 * Shortcodes para el tema hijo FJP
 *
 * @package FJP
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Shortcode para mostrar últimas noticias
 * Uso: [fjp_news_loop posts="3"]
 */
function fjp_shortcode_news_loop($atts) {
    $atts = shortcode_atts(array(
        'posts' => 3,
        'title' => 'Últimas Noticias',
        'subtitle' => 'Mantente informado sobre nuestras actividades y proyectos'
    ), $atts);

    ob_start();
    ?>
    <section class="fjp-section">
        <div class="container">
            <?php if ($atts['title']) : ?>
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="mb-3"><?php echo esc_html($atts['title']); ?></h2>
                    <?php if ($atts['subtitle']) : ?>
                    <p class="lead"><?php echo esc_html($atts['subtitle']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="row">
                <?php
                $noticias = new WP_Query(array(
                    'post_type' => 'noticias',
                    'posts_per_page' => intval($atts['posts']),
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));

                if ($noticias->have_posts()) :
                    while ($noticias->have_posts()) : $noticias->the_post();
                        $url_externa = get_field('url_noticia');
                        $fuente = get_field('fuente_noticia');
                        $target = $url_externa ? 'target="_blank" rel="noopener noreferrer"' : '';
                        $permalink = $url_externa ? $url_externa : get_the_permalink();
                        ?>
                        <div class="col-md-4 mb-4">
                            <div class="fjp-card h-100">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php echo esc_url($permalink); ?>" <?php echo $target; ?>>
                                        <?php the_post_thumbnail('fjp-noticia-card', array('class' => 'card-img-top')); ?>
                                    </a>
                                <?php endif; ?>
                                <div class="card-body d-flex flex-column">
                                    <div class="fjp-blog-meta mb-2">
                                        <small class="text-muted">
                                            <i class="far fa-calendar me-1"></i><?php echo get_the_date('d/m/Y'); ?>
                                            <?php if ($fuente) : ?>
                                                | <i class="far fa-newspaper me-1"></i><?php echo esc_html($fuente); ?>
                                            <?php endif; ?>
                                        </small>
                                    </div>
                                    <h5 class="card-title">
                                        <a href="<?php echo esc_url($permalink); ?>" <?php echo $target; ?> class="text-decoration-none">
                                            <?php the_title(); ?>
                                        </a>
                                    </h5>
                                    <p class="fjp-blog-excerpt flex-grow-1">
                                        <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                                    </p>
                                    <div class="mt-auto">
                                        <a href="<?php echo esc_url($permalink); ?>" <?php echo $target; ?> class="btn btn-sm btn-outline-primary">
                                            <?php echo $url_externa ? 'Leer noticia completa' : 'Leer más'; ?>
                                            <?php if ($url_externa) : ?>
                                                <i class="fas fa-external-link-alt ms-1"></i>
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <div class="col-12 text-center">
                        <p>No hay noticias disponibles en este momento.</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col-12 text-center mt-4">
                    <a href="<?php echo get_post_type_archive_link('noticias'); ?>" class="btn-fjp-primary">Ver todas las noticias</a>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('fjp_news_loop', 'fjp_shortcode_news_loop');

/**
 * Shortcode para mostrar alianzas
 * Uso: [fjp_alliances_loop posts="6"]
 */
function fjp_shortcode_alliances_loop($atts) {
    $atts = shortcode_atts(array(
        'posts' => 6,
        'title' => 'Nuestras Alianzas',
        'subtitle' => 'Trabajamos junto a organizaciones comprometidas con el cambio social'
    ), $atts);

    ob_start();
    ?>
    <section class="fjp-section bg-light">
        <div class="container">
            <?php if ($atts['title']) : ?>
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="mb-3"><?php echo esc_html($atts['title']); ?></h2>
                    <?php if ($atts['subtitle']) : ?>
                    <p class="lead"><?php echo esc_html($atts['subtitle']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="row">
                <?php
                $alianzas = new WP_Query(array(
                    'post_type' => 'alianzas',
                    'posts_per_page' => intval($atts['posts']),
                    'orderby' => 'rand'
                ));

                if ($alianzas->have_posts()) :
                    while ($alianzas->have_posts()) : $alianzas->the_post();
                        ?>
                        <div class="col-lg-2 col-md-4 col-6 mb-4">
                            <div class="fjp-alianza-item text-center">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('fjp-logo-alianza', array('class' => 'img-fluid mb-3')); ?>
                                <?php else : ?>
                                    <div class="alianza-placeholder mb-3">
                                        <i class="fas fa-handshake fa-3x text-primary"></i>
                                    </div>
                                <?php endif; ?>
                                <h6><?php the_title(); ?></h6>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <div class="col-12 text-center">
                        <p>Próximamente anunciaremos nuestras alianzas.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('fjp_alliances_loop', 'fjp_shortcode_alliances_loop');

/**
 * Shortcode para mostrar testimonios (CPT)
 * Uso: [fjp_testimonials_loop posts="3"]
 */
function fjp_shortcode_testimonials_loop($atts) {
    $atts = shortcode_atts(array(
        'posts' => 3,
        'title' => 'Testimonios',
        'subtitle' => 'Lo que dicen quienes han trabajado con nosotros'
    ), $atts);

    ob_start();
    ?>
    <section class="fjp-section">
        <div class="container">
            <?php if ($atts['title']) : ?>
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="mb-3"><?php echo esc_html($atts['title']); ?></h2>
                    <?php if ($atts['subtitle']) : ?>
                    <p class="lead"><?php echo esc_html($atts['subtitle']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="row">
                <?php
                $testimonios = new WP_Query(array(
                    'post_type' => 'testimonios',
                    'posts_per_page' => intval($atts['posts']),
                    'orderby' => 'rand'
                ));

                if ($testimonios->have_posts()) :
                    while ($testimonios->have_posts()) : $testimonios->the_post();
                        $cargo = get_field('cargo_testimonio');
                        $organizacion = get_field('organizacion_testimonio');
                        ?>
                        <div class="col-md-4 mb-4">
                            <div class="fjp-testimonio-card text-center p-4 bg-light rounded-3">
                                <div class="mb-3">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('fjp-testimonio', array('class' => 'rounded-circle mb-3')); ?>
                                    <?php else : ?>
                                        <i class="fas fa-user-circle fa-4x text-primary mb-3"></i>
                                    <?php endif; ?>
                                </div>
                                <blockquote class="blockquote">
                                    <p>"<?php echo wp_trim_words(get_the_content(), 30); ?>"</p>
                                </blockquote>
                                <h5 class="mb-1"><?php the_title(); ?></h5>
                                <?php if ($cargo) : ?>
                                    <p class="text-muted mb-1"><?php echo esc_html($cargo); ?></p>
                                <?php endif; ?>
                                <?php if ($organizacion) : ?>
                                    <p class="text-muted"><?php echo esc_html($organizacion); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <div class="col-12 text-center">
                        <p>Próximamente compartiremos testimonios.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('fjp_testimonials_loop', 'fjp_shortcode_testimonials_loop');

/**
 * Shortcode para mostrar testimonios de voluntarios (ACF Repeater en página)
 * Uso: [fjp_volunteer_testimonials]
 */
function fjp_shortcode_volunteer_testimonials($atts) {
    // Intentar obtener del post actual
    $testimonios = get_field('voluntariado_testimonios');

    // Si no hay, usar fallback (simulando los datos hardcoded que había antes)
    if (!$testimonios) {
        $testimonios = [
            [
                'nombre' => 'María González',
                'cargo' => 'Voluntaria educativa',
                'testimonio' => 'Ser voluntaria me permitió descubrir una pasión por la enseñanza que no sabía que tenía.',
                'imagen' => ''
            ],
            [
                'nombre' => 'Carlos Rodríguez',
                'cargo' => 'Voluntario deportivo',
                'testimonio' => 'Compartir mi amor por el deporte con los chicos es maravilloso.',
                'imagen' => ''
            ],
            [
                'nombre' => 'Ana Martínez',
                'cargo' => 'Voluntaria artística',
                'testimonio' => 'El arte tiene un poder transformador increíble.',
                'imagen' => ''
            ]
        ];
    }

    ob_start();
    ?>
    <section class="voluntariado-testimonios">
        <div class="container">
            <h2>Lo que dicen nuestros voluntarios/as</h2>
            <div class="row">
                <?php foreach ($testimonios as $testimonio): ?>
                <div class="col-lg-4 mb-4">
                    <div class="testimonio-card">
                        <?php if (isset($testimonio['imagen']) && $testimonio['imagen']): ?>
                        <img src="<?php echo esc_url($testimonio['imagen']); ?>" alt="<?php echo esc_attr($testimonio['nombre']); ?>" class="testimonio-imagen">
                        <?php else: ?>
                        <div class="testimonio-imagen bg-light d-flex align-items-center justify-content-center">
                            <i class="fas fa-user" style="font-size: 3rem; color: #2A9D8F;"></i>
                        </div>
                        <?php endif; ?>
                        <p class="testimonio-texto"><?php echo esc_html($testimonio['testimonio']); ?></p>
                        <div class="testimonio-autor"><?php echo esc_html($testimonio['nombre']); ?></div>
                        <div class="testimonio-cargo"><?php echo esc_html($testimonio['cargo']); ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('fjp_volunteer_testimonials', 'fjp_shortcode_volunteer_testimonials');

/**
 * Shortcode para el formulario de voluntariado
 * Uso: [fjp_volunteer_form]
 */
function fjp_shortcode_volunteer_form($atts) {
    // Obtener áreas desde ACF o fallback
    $areas_voluntariado = get_field('voluntariado_areas');
    if (!$areas_voluntariado) {
        // Fallback simple
        $areas_voluntariado = [
            ['titulo' => 'Acompañamiento educativo'],
            ['titulo' => 'Deportes y recreación'],
            ['titulo' => 'Arte y cultura'],
            ['titulo' => 'Apoyo administrativo']
        ];
    }

    ob_start();
    ?>
    <section id="formulario" class="voluntariado-formulario">
        <div class="container">
            <h2>Inscríbete como voluntario/a</h2>
            <p class="intro">Completa el siguiente formulario para unirte a nuestro equipo</p>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="formulario-container">
                        <form id="formulario-voluntariado" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                            <input type="hidden" name="action" value="procesar_formulario_voluntariado">
                            <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('formulario_voluntariado'); ?>">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre completo *</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email *</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telefono">Teléfono *</label>
                                        <input type="tel" class="form-control" id="telefono" name="telefono" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="edad">Edad *</label>
                                        <input type="number" class="form-control" id="edad" name="edad" min="16" max="80" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="area">Área de interés *</label>
                                <select class="form-control" id="area" name="area" required>
                                    <option value="">Seleccionar área</option>
                                    <?php foreach ($areas_voluntariado as $area): ?>
                                    <option value="<?php echo esc_attr(sanitize_title($area['titulo'])); ?>"><?php echo esc_html($area['titulo']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="disponibilidad">Disponibilidad horaria *</label>
                                <select class="form-control" id="disponibilidad" name="disponibilidad" required>
                                    <option value="">Seleccionar disponibilidad</option>
                                    <option value="mananas">Mañanas</option>
                                    <option value="tardes">Tardes</option>
                                    <option value="fines-semana">Fines de semana</option>
                                    <option value="tiempo-completo">Tiempo completo</option>
                                    <option value="fines-de-mes">Fines de mes</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="experiencia">¿Tenés experiencia previa en voluntariado?</label>
                                <textarea class="form-control" id="experiencia" name="experiencia" rows="3" placeholder="Contanos sobre tu experiencia previa (si tenés)..."></textarea>
                            </div>

                            <div class="form-group">
                                <label for="motivacion">¿Qué te motiva a ser voluntario/a? *</label>
                                <textarea class="form-control" id="motivacion" name="motivacion" rows="4" required placeholder="Contanos qué te motiva a sumarte como voluntario/a..."></textarea>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="terminos" name="terminos" required>
                                <label class="form-check-label" for="terminos">
                                    Acepto los términos y condiciones del programa de voluntariado *
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-paper-plane"></i> Enviar solicitud
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const formulario = document.getElementById('formulario-voluntariado');
        if (formulario) {
            formulario.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                // Simular envío (o usar admin-post si está configurado)
                fetch(this.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    // Si no hay respuesta JSON válida (porque el handler devuelve void o redirect), asumimos éxito por ahora en esta demo
                    // En producción, el handler PHP debe devolver JSON
                    return response.text().then(text => {
                        try {
                            return JSON.parse(text);
                        } catch (e) {
                            return { success: true }; // Fallback para demo
                        }
                    });
                })
                .then(data => {
                    const container = this.closest('.formulario-container');
                    container.innerHTML = `
                        <div class="text-center">
                            <div style="font-size: 4rem; color: #2A9D8F; margin-bottom: 20px;">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h3 style="color: #264653; margin-bottom: 15px;">¡Solicitud enviada!</h3>
                            <p style="color: #6c757d; font-size: 1.1rem;">
                                Gracias por tu interés en ser voluntario/a. Nos pondremos en contacto contigo muy pronto.
                            </p>
                        </div>
                    `;
                    container.scrollIntoView({ behavior: 'smooth' });
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Hubo un error al enviar el formulario. Intente nuevamente.');
                });
            });
        }
    });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('fjp_volunteer_form', 'fjp_shortcode_volunteer_form');

/**
 * Handler para el formulario de voluntariado
 */
function fjp_procesar_formulario_voluntariado() {
    // Verificar nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'formulario_voluntariado')) {
        wp_send_json_error('Nonce inválido');
    }

    // Sanitizar campos
    $nombre = sanitize_text_field($_POST['nombre'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $telefono = sanitize_text_field($_POST['telefono'] ?? '');
    $edad = intval($_POST['edad'] ?? 0);
    $area = sanitize_text_field($_POST['area'] ?? '');
    $disponibilidad = sanitize_text_field($_POST['disponibilidad'] ?? '');
    $experiencia = sanitize_textarea_field($_POST['experiencia'] ?? '');
    $motivacion = sanitize_textarea_field($_POST['motivacion'] ?? '');

    if (empty($nombre) || empty($email) || empty($telefono) || empty($edad)) {
        wp_send_json_error('Por favor complete todos los campos obligatorios.');
    }

    // 1. Guardar en CPT "voluntarios"
    $post_data = array(
        'post_title'    => 'Voluntario: ' . $nombre,
        'post_status'   => 'private', // Privado para proteger datos
        'post_type'     => 'voluntarios',
        'post_content'  => $motivacion, // Guardar motivación en el contenido
    );

    $post_id = wp_insert_post($post_data);

    if (is_wp_error($post_id)) {
        wp_send_json_error('Error al guardar la solicitud. Intente nuevamente.');
    }

    // Guardar meta data (compatible con ACF si se registra después)
    update_post_meta($post_id, 'voluntario_email', $email);
    update_post_meta($post_id, 'voluntario_telefono', $telefono);
    update_post_meta($post_id, 'voluntario_edad', $edad);
    update_post_meta($post_id, 'voluntario_area', $area);
    update_post_meta($post_id, 'voluntario_disponibilidad', $disponibilidad);
    update_post_meta($post_id, 'voluntario_experiencia', $experiencia);

    // 2. Enviar Correo al Voluntario
    $subject = '¡Gracias por querer ser parte de FJP!';
    $headers = array('Content-Type: text/html; charset=UTF-8');

    $message = '
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
            .header { background-color: #F2385A; color: white; padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
            .content { padding: 20px; }
            .footer { font-size: 12px; color: #777; text-align: center; margin-top: 20px; border-top: 1px solid #eee; padding-top: 20px; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>¡Solicitud Recibida!</h1>
            </div>
            <div class="content">
                <p>Hola <strong>' . esc_html($nombre) . '</strong>,</p>
                <p>Hemos recibido tu solicitud para unirte al equipo de voluntarios de la <strong>Fundación Juventud Progresista</strong>.</p>
                <p>Nuestro equipo revisará tu perfil y nos pondremos en contacto contigo pronto para coordinar una entrevista o reunión de bienvenida.</p>
                <p><strong>Tus datos:</strong></p>
                <ul>
                    <li><strong>Área de interés:</strong> ' . esc_html(ucfirst($area)) . '</li>
                    <li><strong>Disponibilidad:</strong> ' . esc_html(ucfirst($disponibilidad)) . '</li>
                </ul>
                <p>Gracias por tu compromiso con el cambio social.</p>
            </div>
            <div class="footer">
                <p>&copy; ' . date('Y') . ' Fundación Juventud Progresista.</p>
            </div>
        </div>
    </body>
    </html>
    ';

    wp_mail($email, $subject, $message, $headers);

    // 3. Enviar Correo al Admin
    $admin_email = get_option('admin_email');
    $admin_subject = 'Nueva solicitud de voluntariado: ' . $nombre;
    $admin_message = "Nuevo voluntario registrado:\n\nNombre: $nombre\nEmail: $email\nTeléfono: $telefono\nÁrea: $area\n\nRevisar en el panel de administración.";

    wp_mail($admin_email, $admin_subject, $admin_message);

    wp_send_json_success('Formulario recibido correctamente');
}
add_action('admin_post_procesar_formulario_voluntariado', 'fjp_procesar_formulario_voluntariado');
add_action('admin_post_nopriv_procesar_formulario_voluntariado', 'fjp_procesar_formulario_voluntariado');

/**
 * Shortcode para opciones de donación
 * Uso: [fjp_donation_options]
 */
function fjp_shortcode_donation_options($atts) {
    ob_start();
    ?>
    <section class="fjp-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="fjp-donation-type text-center p-4 bg-light rounded-3 h-100">
                        <div class="mb-3">
                            <i class="fas fa-heart fa-3x text-danger"></i>
                        </div>
                        <h4 class="mb-3">Donación Única</h4>
                        <p class="mb-4">Haz una donación puntual de cualquier monto. Cada aporte cuenta.</p>
                        <?php if (class_exists('Give')) : ?>
                            <a href="#give-form" class="btn btn-primary">Donar Ahora</a>
                        <?php else : ?>
                            <a href="#" class="btn btn-primary">Donar con PayPal</a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="fjp-donation-type text-center p-4 bg-light rounded-3 h-100">
                        <div class="mb-3">
                            <i class="fas fa-sync-alt fa-3x text-primary"></i>
                        </div>
                        <h4 class="mb-3">Donación Mensual</h4>
                        <p class="mb-4">Conviértete en donante recurrente. Apoyo constante.</p>
                        <a href="#" class="btn btn-primary">Hacerme Donante Mensual</a>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="fjp-donation-type text-center p-4 bg-light rounded-3 h-100">
                        <div class="mb-3">
                            <i class="fas fa-gift fa-3x text-success"></i>
                        </div>
                        <h4 class="mb-3">Donación en Especie</h4>
                        <p class="mb-4">Contribuye con bienes, servicios o tu tiempo.</p>
                        <a href="/contacto" class="btn btn-primary">Contactar</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('fjp_donation_options', 'fjp_shortcode_donation_options');

/**
 * Shortcode para mostrar contador de impacto
 * Uso: [fjp_contador_impacto libras="56966" voluntarios="1341" provincias="22"]
 */
function fjp_shortcode_contador_impacto($atts) {
    $atts = shortcode_atts(array(
        'libras' => '56966',
        'voluntarios' => '1341',
        'provincias' => '22'
    ), $atts);

    ob_start();
    ?>
    <div class="fjp-counter-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="fjp-counter text-center">
                        <span class="fjp-counter-number" data-target="<?php echo esc_attr($atts['libras']); ?>">0</span>
                        <span class="fjp-counter-label">Libras Recolectadas</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fjp-counter text-center">
                        <span class="fjp-counter-number" data-target="<?php echo esc_attr($atts['voluntarios']); ?>">0</span>
                        <span class="fjp-counter-label">Voluntarios Activos</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fjp-counter text-center">
                        <span class="fjp-counter-number" data-target="<?php echo esc_attr($atts['provincias']); ?>">0</span>
                        <span class="fjp-counter-label">Provincias Cubiertas</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('fjp_contador_impacto', 'fjp_shortcode_contador_impacto');

/**
 * Alias para shortcode de alianzas (backward compatibility)
 */
add_shortcode('fjp_alianzas', 'fjp_shortcode_alliances_loop');
