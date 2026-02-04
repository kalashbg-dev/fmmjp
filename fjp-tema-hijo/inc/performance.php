<?php
/**
 * FJP - Optimización de Rendimiento y Assets
 * Deshabilita scripts innecesarios de Astra para mejorar la velocidad.
 *
 * @package FJP
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Optimizar Assets de Astra
 */
function fjp_optimize_astra_assets() {
    // Si estamos usando nuestro propio Header Sticky, quitar el de Astra Pro si existe
    if (get_theme_mod('fjp_global_sticky_header')) {
        wp_dequeue_script('astra-sticky-header');
        wp_dequeue_style('astra-sticky-header');
    }

    // Si estamos usando nuestro propio Header Transparente, quitar assets conflictivos
    if (is_page() && get_post_meta(get_the_ID(), '_fjp_transparent_header', true) === '1') {
        // Ejemplo: Deshabilitar estilos de margen superior automático
        add_filter('astra_header_break_point_class', '__return_empty_string');
    }
}
add_action('wp_enqueue_scripts', 'fjp_optimize_astra_assets', 99);

/**
 * Deshabilitar Google Fonts de Astra si usamos las nuestras
 */
add_filter('astra_google_fonts_selected', '__return_empty_array');
