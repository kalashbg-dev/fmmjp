<?php
/**
 * FJP - Fundación Juventud Progresista
 * Functions del tema hijo de Astra
 *
 * @package FJP
 * @author Equipo de Desarrollo Web FJP
 * @version 1.1.0
 */

// Prevenir acceso directo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Definir constantes del tema
 */
define('FJP_VERSION', '1.1.0');
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

    // Cargar scripts condicionalmente
    if ( is_front_page() || is_home() ) {
        wp_enqueue_script('fjp-counter', FJP_THEME_URI . '/js/counter.js', array('jquery'), FJP_VERSION, true);
    }

    if ( is_singular('noticias') || is_post_type_archive('noticias') ) {
        wp_enqueue_script('fjp-news', FJP_THEME_URI . '/js/news.js', array('jquery'), FJP_VERSION, true);
    }

    if ( is_page('donaciones') || is_page('donar') ) {
        wp_enqueue_script('fjp-donations', FJP_THEME_URI . '/js/donations.js', array('jquery'), FJP_VERSION, true);
    }

    if ( is_page('voluntariado') ) {
        wp_enqueue_script('fjp-volunteers', FJP_THEME_URI . '/js/volunteers.js', array('jquery'), FJP_VERSION, true);
    }

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

    // Animate.css (Required for homepage animations)
    wp_enqueue_style('animate-css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css', array(), '4.1.1');

    // Google Fonts
    wp_enqueue_style('fjp-google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap', array(), null);
}
add_action('wp_enqueue_scripts', 'fjp_enqueue_scripts', 20);

/**
 * Incluir módulos
 */

// Registro de CPTs y Taxonomías
require_once FJP_THEME_DIR . '/inc/cpt-registry.php';

// Configuración global del tema y hooks
require_once FJP_THEME_DIR . '/inc/theme-setup.php';

// Funciones de administración y helpers
require_once FJP_THEME_DIR . '/inc/admin-functions.php';

// Shortcodes personalizados
require_once FJP_THEME_DIR . '/inc/shortcodes.php';

// ACF Blocks
require_once FJP_THEME_DIR . '/inc/acf-blocks.php';
require_once FJP_THEME_DIR . '/inc/acf-block-fields.php';

// Metabox de Layout ("Pro" Features)
if (file_exists(FJP_THEME_DIR . '/inc/custom-layout-metabox.php')) {
    require_once FJP_THEME_DIR . '/inc/custom-layout-metabox.php';
}

// Sistema de Patrones de Bloques
if (file_exists(FJP_THEME_DIR . '/inc/patterns.php')) {
    require_once FJP_THEME_DIR . '/inc/patterns.php';
}

// Configuración del Personalizador
if (file_exists(FJP_THEME_DIR . '/inc/customizer.php')) {
    require_once FJP_THEME_DIR . '/inc/customizer.php';
}

// Optimización de Rendimiento
if (file_exists(FJP_THEME_DIR . '/inc/performance.php')) {
    require_once FJP_THEME_DIR . '/inc/performance.php';
}

// Funciones avanzadas y utilidades
require_once FJP_THEME_DIR . '/functions-advanced.php';

/**
 * Hooks para CPT Noticias (Nuevo "Astra Way")
 */
if (file_exists(FJP_THEME_DIR . '/inc/cpt-noticias-hooks.php')) {
    require_once FJP_THEME_DIR . '/inc/cpt-noticias-hooks.php';
}
