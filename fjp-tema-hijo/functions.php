<?php
/**
 * FJP - Fundación Juventud Progresista
 * Functions del tema hijo de Astra
 *
 * @package FJP
 * @author Equipo de Desarrollo Web FJP
 * @version 1.0.0
 */

// Prevenir acceso directo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Definir constantes del tema
 */
define('FJP_VERSION', '1.0.0');
define('FJP_THEME_DIR', get_stylesheet_directory());
define('FJP_THEME_URI', get_stylesheet_directory_uri());

/**
 * Cargar scripts y estilos del tema hijo
 */
function fjp_enqueue_scripts() {
    // Estilos principales
    wp_enqueue_style('fjp-main', FJP_THEME_URI . '/style.css', array('astra-theme-css'), FJP_VERSION);

    // Scripts principales
    wp_enqueue_script('fjp-main', FJP_THEME_URI . '/js/main.js', array('jquery'), FJP_VERSION, true);
    wp_enqueue_script('fjp-counter', FJP_THEME_URI . '/js/counter.js', array('jquery'), FJP_VERSION, true);
    wp_enqueue_script('fjp-news', FJP_THEME_URI . '/js/news.js', array('jquery'), FJP_VERSION, true);
    wp_enqueue_script('fjp-donations', FJP_THEME_URI . '/js/donations.js', array('jquery'), FJP_VERSION, true);
    wp_enqueue_script('fjp-volunteers', FJP_THEME_URI . '/js/volunteers.js', array('jquery'), FJP_VERSION, true);

    // Localizar scripts para AJAX
    wp_localize_script('fjp-main', 'fjp_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('fjp_nonce'),
        'api_url' => home_url('/wp-json/wp/v2/')
    ));

    // Estilos de Bootstrap para componentes específicos
    wp_enqueue_style('bootstrap-grid', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap-grid.min.css', array(), '5.1.3');

    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');

    // Google Fonts
    wp_enqueue_style('fjp-google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap', array(), null);
}
add_action('wp_enqueue_scripts', 'fjp_enqueue_scripts', 20);

/**
 * Registrar Custom Post Type: Noticias
 */
function fjp_register_noticias_cpt() {
    $labels = array(
        'name'                  => _x('Noticias', 'Post type general name', 'fjp'),
        'singular_name'         => _x('Noticia', 'Post type singular name', 'fjp'),
        'menu_name'             => _x('Noticias', 'Admin Menu text', 'fjp'),
        'name_admin_bar'        => _x('Noticia', 'Add New on Toolbar', 'fjp'),
        'add_new'               => __('Agregar Nueva', 'fjp'),
        'add_new_item'          => __('Agregar Nueva Noticia', 'fjp'),
        'new_item'              => __('Nueva Noticia', 'fjp'),
        'edit_item'             => __('Editar Noticia', 'fjp'),
        'view_item'             => __('Ver Noticia', 'fjp'),
        'all_items'             => __('Todas las Noticias', 'fjp'),
        'search_items'          => __('Buscar Noticias', 'fjp'),
        'parent_item_colon'     => __('Noticias Padre:', 'fjp'),
        'not_found'             => __('No se encontraron noticias.', 'fjp'),
        'not_found_in_trash'    => __('No se encontraron noticias en la papelera.', 'fjp'),
        'featured_image'        => _x('Imagen de Portada', 'Overrides the "Featured Image" phrase for this post type. Added in 4.3', 'fjp'),
        'set_featured_image'    => _x('Asignar imagen de portada', 'Overrides the "Set featured image" phrase for this post type. Added in 4.3', 'fjp'),
        'remove_featured_image' => _x('Eliminar imagen de portada', 'Overrides the "Remove featured image" phrase for this post type. Added in 4.3', 'fjp'),
        'use_featured_image'    => _x('Usar como imagen de portada', 'Overrides the "Use as featured image" phrase for this post type. Added in 4.3', 'fjp'),
        'archives'              => _x('Archivos de Noticias', 'The post type archive label used in nav menus. Default "Post Archives". Added in 4.4', 'fjp'),
        'insert_into_item'      => _x('Insertar en la noticia', 'Overrides the "Insert into post"/"Insert into page" phrase (used when inserting media into a post). Added in 4.4', 'fjp'),
        'uploaded_to_this_item' => _x('Subido a esta noticia', 'Overrides the "uploaded to this post"/"uploaded to this page" phrase (used when viewing media attached to a post). Added in 4.4', 'fjp'),
        'filter_items_list'     => _x('Filtrar lista de noticias', 'Screen reader text for the filter links heading on the post type listing screen. Default "Filter posts list"/"Filter pages list". Added in 4.4', 'fjp'),
        'items_list_navigation' => _x('Navegación de lista de noticias', 'Screen reader text for the pagination heading on the post type listing screen. Default "Posts list navigation"/"Pages list navigation". Added in 4.4', 'fjp'),
        'items_list'            => _x('Lista de noticias', 'Screen reader text for the items list heading on the post type listing screen. Default "Posts list"/"Pages list". Added in 4.4', 'fjp'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'noticias', 'with_front' => false),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-media-document',
        'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
        'show_in_rest'       => true,
        'rest_base'          => 'noticias',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    );

    register_post_type('noticias', $args);
}
add_action('init', 'fjp_register_noticias_cpt');

/**
 * Registrar taxonomías para Noticias
 */
function fjp_register_noticias_taxonomies() {
    // Categorías de Noticias
    $labels = array(
        'name'              => _x('Categorías de Noticias', 'taxonomy general name', 'fjp'),
        'singular_name'     => _x('Categoría de Noticia', 'taxonomy singular name', 'fjp'),
        'search_items'      => __('Buscar Categorías', 'fjp'),
        'all_items'         => __('Todas las Categorías', 'fjp'),
        'parent_item'       => __('Categoría Padre', 'fjp'),
        'parent_item_colon' => __('Categoría Padre:', 'fjp'),
        'edit_item'         => __('Editar Categoría', 'fjp'),
        'update_item'       => __('Actualizar Categoría', 'fjp'),
        'add_new_item'      => __('Agregar Nueva Categoría', 'fjp'),
        'new_item_name'     => __('Nombre de Nueva Categoría', 'fjp'),
        'menu_name'         => __('Categorías', 'fjp'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'categoria-noticias'),
        'show_in_rest'      => true,
    );

    register_taxonomy('categoria_noticias', array('noticias'), $args);

    // Etiquetas de Noticias
    $labels = array(
        'name'                       => _x('Etiquetas de Noticias', 'taxonomy general name', 'fjp'),
        'singular_name'             => _x('Etiqueta de Noticia', 'taxonomy singular name', 'fjp'),
        'search_items'               => __('Buscar Etiquetas', 'fjp'),
        'popular_items'               => __('Etiquetas Populares', 'fjp'),
        'all_items'                   => __('Todas las Etiquetas', 'fjp'),
        'parent_item'                 => null,
        'parent_item_colon'           => null,
        'edit_item'                   => __('Editar Etiqueta', 'fjp'),
        'update_item'                 => __('Actualizar Etiqueta', 'fjp'),
        'add_new_item'                => __('Agregar Nueva Etiqueta', 'fjp'),
        'new_item_name'               => __('Nombre de Nueva Etiqueta', 'fjp'),
        'separate_items_with_commas' => __('Separar etiquetas con comas', 'fjp'),
        'add_or_remove_items'         => __('Agregar o eliminar etiquetas', 'fjp'),
        'choose_from_most_used'       => __('Elegir de las más usadas', 'fjp'),
        'not_found'                   => __('No se encontraron etiquetas.', 'fjp'),
        'menu_name'                   => __('Etiquetas', 'fjp'),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array('slug' => 'etiqueta-noticias'),
        'show_in_rest'          => true,
    );

    register_taxonomy('etiqueta_noticias', 'noticias', $args);
}
add_action('init', 'fjp_register_noticias_taxonomies');

/**
 * Registrar Custom Post Type: Voluntarios
 */
function fjp_register_voluntarios_cpt() {
    $labels = array(
        'name'                  => _x('Voluntarios', 'Post type general name', 'fjp'),
        'singular_name'         => _x('Voluntario', 'Post type singular name', 'fjp'),
        'menu_name'             => _x('Voluntarios', 'Admin Menu text', 'fjp'),
        'name_admin_bar'        => _x('Voluntario', 'Add New on Toolbar', 'fjp'),
        'add_new'               => __('Agregar Nuevo', 'fjp'),
        'add_new_item'          => __('Agregar Nuevo Voluntario', 'fjp'),
        'new_item'              => __('Nuevo Voluntario', 'fjp'),
        'edit_item'             => __('Editar Voluntario', 'fjp'),
        'view_item'             => __('Ver Voluntario', 'fjp'),
        'all_items'             => __('Todos los Voluntarios', 'fjp'),
        'search_items'          => __('Buscar Voluntarios', 'fjp'),
        'not_found'             => __('No se encontraron voluntarios.', 'fjp'),
        'not_found_in_trash'    => __('No se encontraron voluntarios en la papelera.', 'fjp'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => array('title'),
        'show_in_rest'       => false,
    );

    register_post_type('voluntarios', $args);
}
add_action('init', 'fjp_register_voluntarios_cpt');

/**
 * Registrar Custom Post Type: Alianzas
 */
function fjp_register_alianzas_cpt() {
    $labels = array(
        'name'                  => _x('Alianzas', 'Post type general name', 'fjp'),
        'singular_name'         => _x('Alianza', 'Post type singular name', 'fjp'),
        'menu_name'             => _x('Alianzas', 'Admin Menu text', 'fjp'),
        'name_admin_bar'        => _x('Alianza', 'Add New on Toolbar', 'fjp'),
        'add_new'               => __('Agregar Nuevo', 'fjp'),
        'add_new_item'          => __('Agregar Nuevo Alianza', 'fjp'),
        'new_item'              => __('Nueva Alianza', 'fjp'),
        'edit_item'             => __('Editar Alianza', 'fjp'),
        'view_item'             => __('Ver Alianza', 'fjp'),
        'all_items'             => __('Todas las Alianzas', 'fjp'),
        'search_items'          => __('Buscar Alianzas', 'fjp'),
        'not_found'             => __('No se encontraron alianzas.', 'fjp'),
        'not_found_in_trash'    => __('No se encontraron alianzas en la papelera.', 'fjp'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'alianzas', 'with_front' => false),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-networking',
        'supports'           => array('title', 'thumbnail'),
        'show_in_rest'       => true,
    );

    register_post_type('alianzas', $args);
}
add_action('init', 'fjp_register_alianzas_cpt');

/**
 * Registrar Custom Post Type: Testimonios
 */
function fjp_register_testimonios_cpt() {
    $labels = array(
        'name'                  => _x('Testimonios', 'Post type general name', 'fjp'),
        'singular_name'         => _x('Testimonio', 'Post type singular name', 'fjp'),
        'menu_name'             => _x('Testimonios', 'Admin Menu text', 'fjp'),
        'name_admin_bar'        => _x('Testimonio', 'Add New on Toolbar', 'fjp'),
        'add_new'               => __('Agregar Nuevo', 'fjp'),
        'add_new_item'          => __('Agregar Nuevo Testimonio', 'fjp'),
        'new_item'              => __('Nuevo Testimonio', 'fjp'),
        'edit_item'             => __('Editar Testimonio', 'fjp'),
        'view_item'             => __('Ver Testimonio', 'fjp'),
        'all_items'             => __('Todos los Testimonios', 'fjp'),
        'search_items'          => __('Buscar Testimonios', 'fjp'),
        'not_found'             => __('No se encontraron testimonios.', 'fjp'),
        'not_found_in_trash'    => __('No se encontraron testimonios en la papelera.', 'fjp'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'testimonios', 'with_front' => false),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 8,
        'menu_icon'          => 'dashicons-format-quote',
        'supports'           => array('title', 'editor', 'thumbnail'),
        'show_in_rest'       => true,
    );

    register_post_type('testimonios', $args);
}
add_action('init', 'fjp_register_testimonios_cpt');

/**
 * Registrar ACF para Noticias Externas
 */
function fjp_register_acf_noticias() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_noticias_externas',
            'title' => 'Información de Noticia Externa',
            'fields' => array(
                array(
                    'key' => 'field_url_noticia',
                    'label' => 'URL de Noticia',
                    'name' => 'url_noticia',
                    'type' => 'url',
                    'instructions' => 'URL completa de la noticia original (incluir https://)',
                    'required' => false,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => 'https://ejemplo.com/noticia',
                ),
                array(
                    'key' => 'field_fuente_noticia',
                    'label' => 'Fuente',
                    'name' => 'fuente_noticia',
                    'type' => 'text',
                    'instructions' => 'Nombre del medio o fuente original de la noticia',
                    'required' => false,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => 'Ej: Diario Libre, Listín Diario, etc.',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
                array(
                    'key' => 'field_imagen_portada',
                    'label' => 'Imagen de Portada',
                    'name' => 'imagen_portada',
                    'type' => 'image',
                    'instructions' => 'Imagen principal de la noticia (si es diferente a la destacada)',
                    'required' => false,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'mime_types' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'noticias',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'show_in_rest' => 1,
        ));
    }
}
add_action('acf/init', 'fjp_register_acf_noticias');

/**
 * Redireccionar noticias externas
 */
function fjp_redirect_noticias_externas() {
    global $post;

    if (is_singular('noticias')) {
        $url_externa = get_field('url_noticia', $post->ID);

        if (!empty($url_externa) && filter_var($url_externa, FILTER_VALIDATE_URL)) {
            wp_redirect($url_externa, 301);
            exit;
        }
    }
}
add_action('template_redirect', 'fjp_redirect_noticias_externas');

/**
 * Detectar idioma del navegador y redireccionar
 */
function fjp_detectar_idioma_y_redireccionar() {
    if (!is_admin() && !isset($_COOKIE['fjp_idioma_detectado'])) {
        $idioma_navegador = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

        // Establecer cookie para evitar redirecciones repetidas
        setcookie('fjp_idioma_detectado', $idioma_navegador, time() + (86400 * 30), '/'); // 30 días

        // Si el idioma es inglés, redirigir a versión en inglés
        if ($idioma_navegador === 'en') {
            $url_en = home_url('/en');
            if (function_exists('tp_url')) {
                $url_en = tp_url('/en');
            }
            wp_redirect($url_en);
            exit;
        }
    }
}
add_action('init', 'fjp_detectar_idioma_y_redireccionar');

/**
 * Optimización automática de imágenes
 */
function fjp_optimizar_imagenes($content) {
    return preg_replace('/<img([^>]+?)>/', '<img$1 loading="lazy" decoding="async">', $content);
}
add_filter('the_content', 'fjp_optimizar_imagenes');

/**
 * Agregar botón flotante de WhatsApp
 */
function fjp_agregar_whatsapp_float() {
    if (!is_admin()) {
        $numero_whatsapp = '8298703385';
        $mensaje = 'Hola, me gustaría obtener más información sobre la Fundación Juventud Progresista';
        ?>
        <a href="https://wa.me/<?php echo $numero_whatsapp; ?>?text=<?php echo urlencode($mensaje); ?>"
           class="whatsapp-float"
           target="_blank"
           rel="noopener noreferrer"
           title="Contactar por WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>

        <style>
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 20px;
            right: 20px;
            background-color: #25d366;
            color: #fff;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
            transition: all 0.3s ease;
        }

        .whatsapp-float:hover {
            background-color: #128c7e;
            transform: scale(1.1);
        }

        @media (max-width: 768px) {
            .whatsapp-float {
                width: 50px;
                height: 50px;
                font-size: 24px;
                bottom: 15px;
                right: 15px;
            }
        }
        </style>
        <?php
    }
}
add_action('wp_footer', 'fjp_agregar_whatsapp_float');

/**
 * Personalizar GiveWP
 */
function fjp_personalizar_givewp() {
    if (class_exists('Give')) {
        // Agregar campos personalizados al formulario de donación
        add_action('give_donation_form_after_personal_info', 'fjp_agregar_campos_donacion');

        function fjp_agregar_campos_donacion($form_id) {
            ?>
            <div class="give-form-row">
                <label for="fjp_tipo_donacion">Tipo de Donación</label>
                <select name="fjp_tipo_donacion" id="fjp_tipo_donacion">
                    <option value="unica">Única</option>
                    <option value="mensual">Mensual</option>
                    <option value="anual">Anual</option>
                </select>
            </div>

            <div class="give-form-row">
                <label for="fjp_proyecto">Proyecto de Interés</label>
                <select name="fjp_proyecto" id="fjp_proyecto">
                    <option value="general">Donación General</option>
                    <option value="educacion">Educación</option>
                    <option value="salud">Salud</option>
                    <option value="medio-ambiente">Medio Ambiente</option>
                    <option value="desarrollo">Desarrollo Comunitario</option>
                </select>
            </div>
            <?php
        }
    }
}
add_action('init', 'fjp_personalizar_givewp');

/**
 * Agregar metaboxes personalizados
 */
function fjp_agregar_metaboxes() {
    add_meta_box(
        'fjp_informacion_destacada',
        'Información Destacada',
        'fjp_render_metabox_destacado',
        array('noticias', 'alianzas', 'testimonios'),
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'fjp_agregar_metaboxes');

function fjp_render_metabox_destacado($post) {
    $value = get_post_meta($post->ID, '_fjp_destacado', true);
    wp_nonce_field('fjp_destacado_nonce', 'fjp_destacado_nonce');
    ?>
    <label for="fjp_destacado">
        <input type="checkbox" id="fjp_destacado" name="fjp_destacado" value="1" <?php checked($value, '1'); ?> />
        Marcar como destacado
    </label>
    <?php
}

/**
 * Guardar metaboxes
 */
function fjp_guardar_metaboxes($post_id) {
    if (!isset($_POST['fjp_destacado_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['fjp_destacado_nonce'], 'fjp_destacado_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $destacado = isset($_POST['fjp_destacado']) ? '1' : '0';
    update_post_meta($post_id, '_fjp_destacado', $destacado);
}
add_action('save_post', 'fjp_guardar_metaboxes');

/**
 * Agregar columnas personalizadas al admin
 */
function fjp_agregar_columnas_admin($columns) {
    $columns['destacado'] = 'Destacado';
    $columns['fecha_evento'] = 'Fecha Evento';
    return $columns;
}
add_filter('manage_noticias_posts_columns', 'fjp_agregar_columnas_admin');
add_filter('manage_alianzas_posts_columns', 'fjp_agregar_columnas_admin');

function fjp_render_columnas_admin($column, $post_id) {
    switch ($column) {
        case 'destacado':
            $destacado = get_post_meta($post_id, '_fjp_destacado', true);
            echo $destacado === '1' ? '<span style="color: #28a745;">✓ Sí</span>' : '<span style="color: #dc3545;">✗ No</span>';
            break;

        case 'fecha_evento':
            echo get_the_date('d/m/Y', $post_id);
            break;
    }
}
add_action('manage_posts_custom_column', 'fjp_render_columnas_admin', 10, 2);

/**
 * Función para obtener noticias destacadas
 */
function fjp_obtener_noticias_destacadas($cantidad = 3) {
    $args = array(
        'post_type' => 'noticias',
        'posts_per_page' => $cantidad,
        'meta_query' => array(
            array(
                'key' => '_fjp_destacado',
                'value' => '1',
                'compare' => '='
            )
        ),
        'orderby' => 'date',
        'order' => 'DESC'
    );

    return new WP_Query($args);
}

/**
 * Función para obtener alianzas
 */
function fjp_obtener_alianzas($cantidad = -1) {
    $args = array(
        'post_type' => 'alianzas',
        'posts_per_page' => $cantidad,
        'orderby' => 'title',
        'order' => 'ASC'
    );

    return new WP_Query($args);
}

/**
 * Función para obtener testimonios
 */
function fjp_obtener_testimonios($cantidad = 3) {
    $args = array(
        'post_type' => 'testimonios',
        'posts_per_page' => $cantidad,
        'orderby' => 'rand'
    );

    return new WP_Query($args);
}

/**
 * Agregar soporte para imágenes en alianzas
 */
function fjp_agregar_soporte_imagenes() {
    add_theme_support('post-thumbnails', array('post', 'page', 'alianzas', 'testimonios'));

    // Agregar tamaños de imagen personalizados
    add_image_size('fjp-logo-alianza', 200, 100, false);
    add_image_size('fjp-testimonio', 150, 150, true);
    add_image_size('fjp-noticia-card', 400, 250, true);
}
add_action('after_setup_theme', 'fjp_agregar_soporte_imagenes');

/**
 * Personalizar excerpt para noticias
 */
function fjp_custom_excerpt($length) {
    if (get_post_type() === 'noticias') {
        return 20; // 20 palabras para noticias
    }
    return $length;
}
add_filter('excerpt_length', 'fjp_custom_excerpt', 999);

/**
 * Agregar clases CSS personalizadas al body
 */
function fjp_body_classes($classes) {
    if (is_post_type_archive('noticias') || is_singular('noticias')) {
        $classes[] = 'fjp-noticias';
    }

    if (is_page('donaciones') || is_page('donar')) {
        $classes[] = 'fjp-donaciones';
    }

    return $classes;
}
add_filter('body_class', 'fjp_body_classes');

/**
 * Desactivar comentarios en ciertos post types
 */
function fjp_desactivar_comentarios($open, $post_id) {
    $post = get_post($post_id);

    if ($post->post_type === 'voluntarios' || $post->post_type === 'alianzas') {
        return false;
    }

    return $open;
}
add_filter('comments_open', 'fjp_desactivar_comentarios', 10, 2);

/**
 * Personalizar mensajes de administración
 */
function fjp_custom_admin_notices() {
    $screen = get_current_screen();

    if ($screen->post_type === 'noticias' && $screen->base === 'edit') {
        ?>
        <div class="notice notice-info">
            <p><?php _e('💡 Sugerencia: Las noticias con URL externa se redireccionarán automáticamente al sitio original.', 'fjp'); ?></p>
        </div>
        <?php
    }
}
add_action('admin_notices', 'fjp_custom_admin_notices');

/**
 * Función para obtener estadísticas del sitio
 */
function fjp_obtener_estadisticas() {
    $stats = array(
        'total_noticias' => wp_count_posts('noticias')->publish,
        'total_voluntarios' => wp_count_posts('voluntarios')->publish,
        'total_alianzas' => wp_count_posts('alianzas')->publish,
        'total_testimonios' => wp_count_posts('testimonios')->publish,
    );

    return $stats;
}

/**
 * Crear página de estadísticas en el admin
 */
function fjp_agregar_pagina_estadisticas() {
    add_menu_page(
        'Estadísticas FJP',
        'Estadísticas FJP',
        'manage_options',
        'fjp-estadisticas',
        'fjp_render_pagina_estadisticas',
        'dashicons-chart-bar',
        9
    );
}
add_action('admin_menu', 'fjp_agregar_pagina_estadisticas');

function fjp_render_pagina_estadisticas() {
    $stats = fjp_obtener_estadisticas();
    ?>
    <div class="wrap">
        <h1>Estadísticas de la Fundación Juventud Progresista</h1>

        <div class="fjp-stats-container">
            <div class="fjp-stat-card">
                <h3>Total de Noticias</h3>
                <p class="fjp-stat-number"><?php echo $stats['total_noticias']; ?></p>
            </div>

            <div class="fjp-stat-card">
                <h3>Total de Voluntarios</h3>
                <p class="fjp-stat-number"><?php echo $stats['total_voluntarios']; ?></p>
            </div>

            <div class="fjp-stat-card">
                <h3>Total de Alianzas</h3>
                <p class="fjp-stat-number"><?php echo $stats['total_alianzas']; ?></p>
            </div>

            <div class="fjp-stat-card">
                <h3>Total de Testimonios</h3>
                <p class="fjp-stat-number"><?php echo $stats['total_testimonios']; ?></p>
            </div>
        </div>

        <style>
        .fjp-stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .fjp-stat-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
        }

        .fjp-stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #0056D2;
            margin: 10px 0;
        }
        </style>
    </div>
    <?php
}

/**
 * Agregar shortcodes personalizados
 */
require_once FJP_THEME_DIR . '/inc/shortcodes.php';

/**
 * Agregar funciones de utilidad
 */
require_once FJP_THEME_DIR . '/functions-advanced.php';
