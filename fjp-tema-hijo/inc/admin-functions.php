<?php
/**
 * Admin Functions, Metaboxes, and Statistics
 *
 * @package FJP
 */

if (!defined('ABSPATH')) {
    exit;
}

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
 * Helper functions needed by admin (if any)
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

function fjp_obtener_alianzas($cantidad = -1) {
    $args = array(
        'post_type' => 'alianzas',
        'posts_per_page' => $cantidad,
        'orderby' => 'title',
        'order' => 'ASC'
    );

    return new WP_Query($args);
}

function fjp_obtener_testimonios($cantidad = 3) {
    $args = array(
        'post_type' => 'testimonios',
        'posts_per_page' => $cantidad,
        'orderby' => 'rand'
    );

    return new WP_Query($args);
}
