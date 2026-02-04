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
    $disable_breadcrumbs = get_post_meta($post->ID, '_fjp_disable_breadcrumbs', true);

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

        <label style="display:block; margin-bottom:10px;">
            <input type="checkbox" name="fjp_disable_breadcrumbs" value="1" <?php checked($disable_breadcrumbs, '1'); ?>>
            Ocultar Migas de Pan (Breadcrumbs)
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
    $trans_header = isset($_POST['fjp_transparent_header']) ? '1' : '0';
    $disable_title = isset($_POST['fjp_disable_title']) ? '1' : '0';
    $disable_footer = isset($_POST['fjp_disable_footer']) ? '1' : '0';
    $disable_breadcrumbs = isset($_POST['fjp_disable_breadcrumbs']) ? '1' : '0';

    update_post_meta($post_id, '_fjp_transparent_header', $trans_header);
    update_post_meta($post_id, '_fjp_sticky_header', isset($_POST['fjp_sticky_header']) ? '1' : '0');
    update_post_meta($post_id, '_fjp_disable_title', $disable_title);
    update_post_meta($post_id, '_fjp_disable_footer', $disable_footer);
    update_post_meta($post_id, '_fjp_disable_breadcrumbs', $disable_breadcrumbs);

    // Sincronización Bidireccional: Forzar compatibilidad nativa con Astra
    // Si Astra está activo, intentamos actualizar sus propios meta keys para asegurar compatibilidad total

    // 1. Título
    if ($disable_title === '1') {
        update_post_meta($post_id, 'site-post-title', 'disabled');
    } else {
        delete_post_meta($post_id, 'site-post-title'); // Restaurar default
    }

    // 2. Footer (Deshabilitar todos los widgets del footer de Astra)
    if ($disable_footer === '1') {
        update_post_meta($post_id, 'footer-sml-layout', 'disabled');
        update_post_meta($post_id, 'footer-adv-display', 'disabled');
    } else {
        delete_post_meta($post_id, 'footer-sml-layout');
        delete_post_meta($post_id, 'footer-adv-display');
    }

    // 3. Breadcrumbs
    if ($disable_breadcrumbs === '1') {
        update_post_meta($post_id, 'ast-breadcrumbs-content', 'disabled');
    } else {
        delete_post_meta($post_id, 'ast-breadcrumbs-content');
    }

    // 4. Header Transparente (Si Astra tiene su propio control)
    if ($trans_header === '1') {
        update_post_meta($post_id, 'theme-transparent-header-meta', 'enabled');
    } else {
        update_post_meta($post_id, 'theme-transparent-header-meta', 'default');
    }
}
add_action('save_post', 'fjp_save_layout_options');

/**
 * Integración Profunda con Hooks de Astra
 */

// 1. Aplicar clases al Body (Compatibilidad CSS)
function fjp_apply_layout_body_classes($classes) {
    if (is_page() || is_singular()) {
        global $post;
        if (!isset($post->ID)) return $classes;

        // Header Transparente
        if (get_post_meta($post->ID, '_fjp_transparent_header', true) === '1') {
            $classes[] = 'fjp-transparent-header';
            $classes[] = 'ast-header-break-point'; // Forzar comportamiento responsivo
        }

        // Header Sticky
        if (get_post_meta($post->ID, '_fjp_sticky_header', true) === '1') {
            $classes[] = 'fjp-sticky-header';
        }
    }
    return $classes;
}
add_filter('body_class', 'fjp_apply_layout_body_classes');

// 2. Desactivar Título (Nativo Astra)
function fjp_astra_disable_title($enabled) {
    if (is_page() || is_singular()) {
        global $post;
        if (get_post_meta($post->ID, '_fjp_disable_title', true) === '1') {
            return false;
        }
    }
    return $enabled;
}
add_filter('astra_the_title_enabled', 'fjp_astra_disable_title');

// 3. Desactivar Footer (Nativo Astra)
function fjp_astra_disable_footer() {
    if (is_page() || is_singular()) {
        global $post;
        if (get_post_meta($post->ID, '_fjp_disable_footer', true) === '1') {
            // Elimina los hooks del footer de Astra
            remove_action( 'astra_footer', 'astra_footer_markup' );
        }
    }
}
add_action('wp', 'fjp_astra_disable_footer');

// 4. Desactivar Breadcrumbs (Nativo Astra - si el hook existe)
function fjp_astra_disable_breadcrumbs() {
    if (is_page() || is_singular()) {
        global $post;
        if (get_post_meta($post->ID, '_fjp_disable_breadcrumbs', true) === '1') {
            add_filter('astra_breadcrumb_enabled', '__return_false');
        }
    }
}
add_action('wp', 'fjp_astra_disable_breadcrumbs');

/**
 * Lógica CSS para Header Transparente (Overlay)
 */
function fjp_layout_css_output() {
    if (is_page() || is_singular()) {
        global $post;
        if (!isset($post->ID)) return;

        $css = '';

        // Header Transparente
        if (get_post_meta($post->ID, '_fjp_transparent_header', true) === '1') {
            $css .= '
                .fjp-transparent-header .site-header {
                    position: absolute;
                    width: 100%;
                    left: 0;
                    top: 0;
                    background: transparent;
                    border-bottom: 1px solid rgba(255,255,255,0.1);
                    z-index: 99;
                }
                .fjp-transparent-header .main-header-bar {
                    background: transparent;
                    border: none;
                }
                .fjp-transparent-header .ast-builder-menu .menu-item > .menu-link {
                    color: #fff;
                }
                .fjp-transparent-header .site-title a,
                .fjp-transparent-header .ast-site-identity a {
                    color: #fff !important;
                }
            ';
        }

        // Sticky Header
        if (get_post_meta($post->ID, '_fjp_sticky_header', true) === '1') {
            $css .= '
                .fjp-sticky-header .site-header {
                    position: sticky;
                    top: 0;
                }
            ';
        }

        if (!empty($css)) {
            echo '<style id="fjp-layout-css">' . $css . '</style>';
        }
    }
}
add_action('wp_head', 'fjp_layout_css_output');
