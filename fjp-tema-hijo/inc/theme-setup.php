<?php
/**
 * Theme Setup and Global Configurations
 *
 * @package FJP
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Habilitar soporte para estilos del editor y theme.json
 */
function fjp_setup_theme_features() {
    add_theme_support('editor-styles');
    add_editor_style('style.css');
}
add_action('after_setup_theme', 'fjp_setup_theme_features');

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
