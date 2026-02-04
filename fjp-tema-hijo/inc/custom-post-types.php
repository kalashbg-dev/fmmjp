<?php
/**
 * Custom Post Types - Premium Edition
 *
 * Professional custom post type registration with full REST API support,
 * proper taxonomies, and admin customizations.
 *
 * @package FJP_Premium
 * @version 2.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * ==============================================
 * NOTICIAS (NEWS) POST TYPE
 * ==============================================
 */
function fjp_register_noticias_cpt() {
    $labels = array(
        'name' => _x('Noticias', 'Post type general name', 'fjp'),
        'singular_name' => _x('Noticia', 'Post type singular name', 'fjp'),
        'menu_name' => _x('Noticias', 'Admin Menu text', 'fjp'),
        'name_admin_bar' => _x('Noticia', 'Add New on Toolbar', 'fjp'),
        'add_new' => __('Agregar Nueva', 'fjp'),
        'add_new_item' => __('Agregar Nueva Noticia', 'fjp'),
        'new_item' => __('Nueva Noticia', 'fjp'),
        'edit_item' => __('Editar Noticia', 'fjp'),
        'view_item' => __('Ver Noticia', 'fjp'),
        'all_items' => __('Todas las Noticias', 'fjp'),
        'search_items' => __('Buscar Noticias', 'fjp'),
        'parent_item_colon' => __('Noticias Padre:', 'fjp'),
        'not_found' => __('No se encontraron noticias.', 'fjp'),
        'not_found_in_trash' => __('No se encontraron noticias en la papelera.', 'fjp'),
        'featured_image' => _x('Imagen de Portada', 'Overrides the "Featured Image" phrase', 'fjp'),
        'set_featured_image' => _x('Asignar imagen de portada', 'Overrides the "Set featured image"', 'fjp'),
        'remove_featured_image' => _x('Eliminar imagen de portada', 'Overrides the "Remove featured image"', 'fjp'),
        'use_featured_image' => _x('Usar como imagen de portada', 'Overrides the "Use as featured image"', 'fjp'),
        'archives' => _x('Archivos de Noticias', 'The post type archive label', 'fjp'),
        'insert_into_item' => _x('Insertar en la noticia', 'Overrides the "Insert into post"', 'fjp'),
        'uploaded_to_this_item' => _x('Subido a esta noticia', 'Overrides the "Uploaded to this post"', 'fjp'),
        'filter_items_list' => _x('Filtrar lista de noticias', 'Screen reader text', 'fjp'),
        'items_list_navigation' => _x('Navegación de lista de noticias', 'Screen reader text', 'fjp'),
        'items_list' => _x('Lista de noticias', 'Screen reader text', 'fjp'),
    );

    $args = array(
        'labels' => $labels,
        'description' => __('Noticias y actualizaciones de la fundación', 'fjp'),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'noticias',
            'with_front' => false,
            'feeds' => true,
            'pages' => true,
        ),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-media-document',
        'supports' => array(
            'title',
            'editor',
            'author',
            'thumbnail',
            'excerpt',
            'comments',
            'revisions',
            'custom-fields',
        ),
        'show_in_rest' => true,
        'rest_base' => 'noticias',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
        'taxonomies' => array('categoria_noticias', 'etiqueta_noticias'),
    );

    register_post_type('noticias', $args);
}
add_action('init', 'fjp_register_noticias_cpt');

/**
 * Register News Taxonomies
 */
function fjp_register_noticias_taxonomies() {
    // Categories
    $category_labels = array(
        'name' => _x('Categorías de Noticias', 'taxonomy general name', 'fjp'),
        'singular_name' => _x('Categoría de Noticia', 'taxonomy singular name', 'fjp'),
        'search_items' => __('Buscar Categorías', 'fjp'),
        'all_items' => __('Todas las Categorías', 'fjp'),
        'parent_item' => __('Categoría Padre', 'fjp'),
        'parent_item_colon' => __('Categoría Padre:', 'fjp'),
        'edit_item' => __('Editar Categoría', 'fjp'),
        'update_item' => __('Actualizar Categoría', 'fjp'),
        'add_new_item' => __('Agregar Nueva Categoría', 'fjp'),
        'new_item_name' => __('Nombre de Nueva Categoría', 'fjp'),
        'menu_name' => __('Categorías', 'fjp'),
    );

    register_taxonomy('categoria_noticias', array('noticias'), array(
        'hierarchical' => true,
        'labels' => $category_labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'categoria-noticias'),
        'show_in_rest' => true,
    ));

    // Tags
    $tag_labels = array(
        'name' => _x('Etiquetas de Noticias', 'taxonomy general name', 'fjp'),
        'singular_name' => _x('Etiqueta de Noticia', 'taxonomy singular name', 'fjp'),
        'search_items' => __('Buscar Etiquetas', 'fjp'),
        'popular_items' => __('Etiquetas Populares', 'fjp'),
        'all_items' => __('Todas las Etiquetas', 'fjp'),
        'edit_item' => __('Editar Etiqueta', 'fjp'),
        'update_item' => __('Actualizar Etiqueta', 'fjp'),
        'add_new_item' => __('Agregar Nueva Etiqueta', 'fjp'),
        'new_item_name' => __('Nombre de Nueva Etiqueta', 'fjp'),
        'separate_items_with_commas' => __('Separar etiquetas con comas', 'fjp'),
        'add_or_remove_items' => __('Agregar o eliminar etiquetas', 'fjp'),
        'choose_from_most_used' => __('Elegir de las más usadas', 'fjp'),
        'not_found' => __('No se encontraron etiquetas.', 'fjp'),
        'menu_name' => __('Etiquetas', 'fjp'),
    );

    register_taxonomy('etiqueta_noticias', 'noticias', array(
        'hierarchical' => false,
        'labels' => $tag_labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array('slug' => 'etiqueta-noticias'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'fjp_register_noticias_taxonomies');

/**
 * ==============================================
 * TESTIMONIOS POST TYPE
 * ==============================================
 */
function fjp_register_testimonios_cpt() {
    $labels = array(
        'name' => _x('Testimonios', 'Post type general name', 'fjp'),
        'singular_name' => _x('Testimonio', 'Post type singular name', 'fjp'),
        'menu_name' => _x('Testimonios', 'Admin Menu text', 'fjp'),
        'name_admin_bar' => _x('Testimonio', 'Add New on Toolbar', 'fjp'),
        'add_new' => __('Agregar Nuevo', 'fjp'),
        'add_new_item' => __('Agregar Nuevo Testimonio', 'fjp'),
        'new_item' => __('Nuevo Testimonio', 'fjp'),
        'edit_item' => __('Editar Testimonio', 'fjp'),
        'view_item' => __('Ver Testimonio', 'fjp'),
        'all_items' => __('Todos los Testimonios', 'fjp'),
        'search_items' => __('Buscar Testimonios', 'fjp'),
        'not_found' => __('No se encontraron testimonios.', 'fjp'),
        'not_found_in_trash' => __('No se encontraron testimonios en la papelera.', 'fjp'),
    );

    $args = array(
        'labels' => $labels,
        'description' => __('Testimonios de voluntarios y colaboradores', 'fjp'),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'testimonios'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 8,
        'menu_icon' => 'dashicons-format-quote',
        'supports' => array('title', 'editor', 'thumbnail', 'revisions'),
        'show_in_rest' => true,
    );

    register_post_type('testimonios', $args);
}
add_action('init', 'fjp_register_testimonios_cpt');

/**
 * ==============================================
 * ALIANZAS (ALLIANCES) POST TYPE
 * ==============================================
 */
function fjp_register_alianzas_cpt() {
    $labels = array(
        'name' => _x('Alianzas', 'Post type general name', 'fjp'),
        'singular_name' => _x('Alianza', 'Post type singular name', 'fjp'),
        'menu_name' => _x('Alianzas', 'Admin Menu text', 'fjp'),
        'name_admin_bar' => _x('Alianza', 'Add New on Toolbar', 'fjp'),
        'add_new' => __('Agregar Nueva', 'fjp'),
        'add_new_item' => __('Agregar Nueva Alianza', 'fjp'),
        'new_item' => __('Nueva Alianza', 'fjp'),
        'edit_item' => __('Editar Alianza', 'fjp'),
        'view_item' => __('Ver Alianza', 'fjp'),
        'all_items' => __('Todas las Alianzas', 'fjp'),
        'search_items' => __('Buscar Alianzas', 'fjp'),
        'not_found' => __('No se encontraron alianzas.', 'fjp'),
        'not_found_in_trash' => __('No se encontraron alianzas en la papelera.', 'fjp'),
    );

    $args = array(
        'labels' => $labels,
        'description' => __('Organizaciones y empresas aliadas', 'fjp'),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'alianzas'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 7,
        'menu_icon' => 'dashicons-networking',
        'supports' => array('title', 'thumbnail', 'revisions'),
        'show_in_rest' => true,
    );

    register_post_type('alianzas', $args);
}
add_action('init', 'fjp_register_alianzas_cpt');

/**
 * ==============================================
 * VOLUNTARIOS (VOLUNTEERS) POST TYPE
 * ==============================================
 */
function fjp_register_voluntarios_cpt() {
    $labels = array(
        'name' => _x('Voluntarios', 'Post type general name', 'fjp'),
        'singular_name' => _x('Voluntario', 'Post type singular name', 'fjp'),
        'menu_name' => _x('Voluntarios', 'Admin Menu text', 'fjp'),
        'name_admin_bar' => _x('Voluntario', 'Add New on Toolbar', 'fjp'),
        'add_new' => __('Agregar Nuevo', 'fjp'),
        'add_new_item' => __('Agregar Nuevo Voluntario', 'fjp'),
        'new_item' => __('Nuevo Voluntario', 'fjp'),
        'edit_item' => __('Editar Voluntario', 'fjp'),
        'view_item' => __('Ver Voluntario', 'fjp'),
        'all_items' => __('Todos los Voluntarios', 'fjp'),
        'search_items' => __('Buscar Voluntarios', 'fjp'),
        'not_found' => __('No se encontraron voluntarios.', 'fjp'),
        'not_found_in_trash' => __('No se encontraron voluntarios en la papelera.', 'fjp'),
    );

    $args = array(
        'labels' => $labels,
        'description' => __('Registro de voluntarios', 'fjp'),
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => false,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-groups',
        'supports' => array('title'),
        'show_in_rest' => false, // Private data
    );

    register_post_type('voluntarios', $args);
}
add_action('init', 'fjp_register_voluntarios_cpt');

/**
 * ==============================================
 * ADMIN COLUMNS CUSTOMIZATION
 * ==============================================
 */

// Noticias columns
function fjp_noticias_columns($columns) {
    $new_columns = array();
    
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        
        if ($key === 'title') {
            $new_columns['featured_image'] = __('Imagen', 'fjp');
            $new_columns['noticia_destacada'] = __('Destacada', 'fjp');
            $new_columns['noticia_fuente'] = __('Fuente', 'fjp');
        }
    }
    
    return $new_columns;
}
add_filter('manage_noticias_posts_columns', 'fjp_noticias_columns');

function fjp_noticias_column_content($column, $post_id) {
    switch ($column) {
        case 'featured_image':
            echo get_the_post_thumbnail($post_id, array(50, 50));
            break;
            
        case 'noticia_destacada':
            if (function_exists('get_field')) {
                $destacada = get_field('noticia_destacada', $post_id);
                echo $destacada ? '<span style="color: #28a745;">✓ Sí</span>' : '<span style="color: #6c757d;">—</span>';
            }
            break;
            
        case 'noticia_fuente':
            if (function_exists('get_field')) {
                $fuente = get_field('noticia_fuente', $post_id);
                echo $fuente ? esc_html($fuente) : '<span style="color: #6c757d;">—</span>';
            }
            break;
    }
}
add_action('manage_noticias_posts_custom_column', 'fjp_noticias_column_content', 10, 2);

// Voluntarios columns
function fjp_voluntarios_columns($columns) {
    $new_columns = array();
    
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        
        if ($key === 'title') {
            $new_columns['voluntario_email'] = __('Email', 'fjp');
            $new_columns['voluntario_area'] = __('Área', 'fjp');
            $new_columns['voluntario_estado'] = __('Estado', 'fjp');
            $new_columns['voluntario_fecha'] = __('Fecha Solicitud', 'fjp');
        }
    }
    
    return $new_columns;
}
add_filter('manage_voluntarios_posts_columns', 'fjp_voluntarios_columns');

function fjp_voluntarios_column_content($column, $post_id) {
    if (!function_exists('get_field')) {
        return;
    }
    
    switch ($column) {
        case 'voluntario_email':
            $email = get_field('voluntario_email', $post_id);
            echo $email ? '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>' : '—';
            break;
            
        case 'voluntario_area':
            $area = get_field('voluntario_area', $post_id);
            echo $area ? esc_html($area) : '—';
            break;
            
        case 'voluntario_estado':
            $estado = get_field('voluntario_estado', $post_id);
            $colors = array(
                'pendiente' => '#ffc107',
                'revisando' => '#17a2b8',
                'aprobado' => '#28a745',
                'activo' => '#007bff',
                'inactivo' => '#6c757d',
                'rechazado' => '#dc3545',
            );
            
            $color = isset($colors[$estado]) ? $colors[$estado] : '#6c757d';
            echo '<span style="color: ' . $color . '; font-weight: 600;">' . esc_html(ucfirst($estado)) . '</span>';
            break;
            
        case 'voluntario_fecha':
            $fecha = get_field('voluntario_fecha_solicitud', $post_id);
            echo $fecha ? esc_html(date_i18n('d/m/Y', strtotime($fecha))) : '—';
            break;
    }
}
add_action('manage_voluntarios_posts_custom_column', 'fjp_voluntarios_column_content', 10, 2);

/**
 * ==============================================
 * FLUSH REWRITE RULES ON ACTIVATION
 * ==============================================
 */
function fjp_flush_rewrites() {
    // Register CPTs
    fjp_register_noticias_cpt();
    fjp_register_testimonios_cpt();
    fjp_register_alianzas_cpt();
    fjp_register_voluntarios_cpt();
    
    // Flush rewrite rules
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'fjp_flush_rewrites');

/**
 * ==============================================
 * CUSTOM ADMIN NOTICES
 * ==============================================
 */
function fjp_cpt_admin_notices() {
    $screen = get_current_screen();
    
    if ($screen->post_type === 'noticias' && $screen->base === 'edit') {
        ?>
        <div class="notice notice-info is-dismissible">
            <p>
                <strong>💡 Sugerencia:</strong> Las noticias con URL externa se redireccionarán automáticamente al sitio original.
                <a href="<?php echo admin_url('edit-tags.php?taxonomy=categoria_noticias&post_type=noticias'); ?>">Gestionar Categorías</a>
            </p>
        </div>
        <?php
    }
    
    if ($screen->post_type === 'voluntarios' && $screen->base === 'edit') {
        $pendientes = wp_count_posts('voluntarios');
        if (isset($pendientes->publish) && $pendientes->publish > 0) {
            ?>
            <div class="notice notice-warning">
                <p>
                    <strong>⚠️ Atención:</strong> Hay <?php echo $pendientes->publish; ?> solicitudes de voluntariado pendientes de revisión.
                </p>
            </div>
            <?php
        }
    }
}
add_action('admin_notices', 'fjp_cpt_admin_notices');
