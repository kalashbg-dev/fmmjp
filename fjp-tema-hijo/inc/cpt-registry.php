<?php
/**
 * Custom Post Types and Taxonomies Registration
 *
 * @package FJP
 */

if (!defined('ABSPATH')) {
    exit;
}

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
