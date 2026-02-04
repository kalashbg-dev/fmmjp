<?php
/**
 * FJP - Opciones de Layout Personalizado (Estilo "Astra Pro")
 * Permite controlar header, footer y título por página.
 *
 * @package FJP
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Agregar Metabox a Páginas
 */
function fjp_add_layout_metabox() {
    add_meta_box(
        'fjp_layout_options',
        '⚙️ Opciones de Diseño FJP',
        'fjp_render_layout_metabox',
        'page',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'fjp_add_layout_metabox');

/**
 * Renderizar Metabox
 */
function fjp_render_layout_metabox($post) {
    // Obtener valores guardados
    $transparent_header = get_post_meta($post->ID, '_fjp_transparent_header', true);
    $sticky_header = get_post_meta($post->ID, '_fjp_sticky_header', true);
    $disable_title = get_post_meta($post->ID, '_fjp_disable_title', true);
    $disable_footer = get_post_meta($post->ID, '_fjp_disable_footer', true);

    // Nonce para seguridad
    wp_nonce_field('fjp_layout_nonce', 'fjp_layout_nonce_field');
    ?>
    <div class="fjp-metabox-options">
        <p><strong>Cabecera (Header)</strong></p>
        <label style="display:block; margin-bottom:10px;">
            <input type="checkbox" name="fjp_transparent_header" value="1" <?php checked($transparent_header, '1'); ?>>
            Activar Header Transparente
        </label>

        <label style="display:block; margin-bottom:15px;">
            <input type="checkbox" name="fjp_sticky_header" value="1" <?php checked($sticky_header, '1'); ?>>
            Activar Header Pegajoso (Sticky)
        </label>

        <hr>

        <p><strong>Contenido</strong></p>
        <label style="display:block; margin-bottom:10px;">
            <input type="checkbox" name="fjp_disable_title" value="1" <?php checked($disable_title, '1'); ?>>
            Ocultar Título de Página
        </label>

        <hr>

        <p><strong>Pie de Página (Footer)</strong></p>
        <label style="display:block; margin-bottom:10px;">
            <input type="checkbox" name="fjp_disable_footer" value="1" <?php checked($disable_footer, '1'); ?>>
            Ocultar Footer
        </label>
    </div>
    <?php
}

/**
 * Guardar Opciones
 */
function fjp_save_layout_options($post_id) {
    if (!isset($_POST['fjp_layout_nonce_field']) || !wp_verify_nonce($_POST['fjp_layout_nonce_field'], 'fjp_layout_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_page', $post_id)) {
        return;
    }

    // Guardar campos
    update_post_meta($post_id, '_fjp_transparent_header', isset($_POST['fjp_transparent_header']) ? '1' : '0');
    update_post_meta($post_id, '_fjp_sticky_header', isset($_POST['fjp_sticky_header']) ? '1' : '0');
    update_post_meta($post_id, '_fjp_disable_title', isset($_POST['fjp_disable_title']) ? '1' : '0');
    update_post_meta($post_id, '_fjp_disable_footer', isset($_POST['fjp_disable_footer']) ? '1' : '0');
}
add_action('save_post', 'fjp_save_layout_options');

/**
 * Aplicar clases al Body según opciones
 */
function fjp_apply_layout_body_classes($classes) {
    if (is_page()) {
        global $post;
        if (!isset($post->ID)) return $classes;

        // Header Transparente
        if (get_post_meta($post->ID, '_fjp_transparent_header', true) === '1') {
            $classes[] = 'fjp-transparent-header';
        }

        // Header Sticky
        if (get_post_meta($post->ID, '_fjp_sticky_header', true) === '1') {
            $classes[] = 'fjp-sticky-header';
        }

        // Ocultar Título (Astra usa ast-no-title, pero añadimos el nuestro por si acaso)
        if (get_post_meta($post->ID, '_fjp_disable_title', true) === '1') {
            $classes[] = 'fjp-no-title';
            // Inyectar compatibilidad nativa con Astra
            add_filter('astra_the_title_enabled', '__return_false');
        }

        // Ocultar Footer
        if (get_post_meta($post->ID, '_fjp_disable_footer', true) === '1') {
            $classes[] = 'fjp-no-footer';
        }
    }
    return $classes;
}
add_filter('body_class', 'fjp_apply_layout_body_classes');

/**
 * Lógica CSS para ocultar elementos si se seleccionó
 */
function fjp_layout_css_output() {
    if (is_page()) {
        global $post;
        if (!isset($post->ID)) return;

        $css = '';

        if (get_post_meta($post->ID, '_fjp_disable_footer', true) === '1') {
            $css .= '.site-footer { display: none !important; }';
        }

        if (!empty($css)) {
            echo '<style id="fjp-layout-css">' . $css . '</style>';
        }
    }
}
add_action('wp_head', 'fjp_layout_css_output');
