<?php
/**
 * Advanced Theme Functions
 * Optimized for Modular Architecture
 *
 * @package FJP
 */

if (!defined('ABSPATH')) {
    exit;
}

// ==========================================
// 1. SECURITY (Hardening)
// ==========================================

/**
 * Disable XML-RPC for security
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Hide WordPress Version
 */
remove_action('wp_head', 'wp_generator');
add_filter('the_generator', '__return_empty_string');

/**
 * Disallow File Edit
 */
if (!defined('DISALLOW_FILE_EDIT')) {
    define('DISALLOW_FILE_EDIT', true);
}

/**
 * Disable Emojis (Performance)
 */
function fjp_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
}
add_action('init', 'fjp_disable_emojis');

// ==========================================
// 2. PERFORMANCE & SEO
// ==========================================

/**
 * DNS Prefetching
 */
function fjp_dns_prefetch() {
    echo '<meta http-equiv="x-dns-prefetch-control" content="on">' . PHP_EOL;
    echo '<link rel="dns-prefetch" href="//fonts.googleapis.com" />' . PHP_EOL;
    echo '<link rel="dns-prefetch" href="//fonts.gstatic.com" />' . PHP_EOL;
    echo '<link rel="dns-prefetch" href="//ajax.googleapis.com" />' . PHP_EOL;
}
add_action('wp_head', 'fjp_dns_prefetch', 0);

/**
 * Native Lazy Loading (Enhanced)
 */
function fjp_add_lazy_loading_attribute($content) {
    // Add loading="lazy" to all img tags that don't have it
    return preg_replace('/<img(?![^>]*\bloading=)([^>]+?)>/i', '<img loading="lazy"$1>', $content);
}
add_filter('the_content', 'fjp_add_lazy_loading_attribute');

// ==========================================
// 3. UI ENHANCEMENTS & ASTRA HOOKS
// ==========================================



// ==========================================
// 4. ADMIN UTILITIES
// ==========================================

/**
 * Sortable Columns for Noticias CPT
 */
function fjp_noticias_sortable_columns($columns) {
    $columns['fecha_noticia'] = 'fecha_noticia';
    return $columns;
}
add_filter('manage_edit-noticias_sortable_columns', 'fjp_noticias_sortable_columns');

/**
 * Custom Column Content for Noticias
 */
function fjp_noticias_custom_column_content($column, $post_id) {
    if ($column === 'fecha_noticia') {
        $date = get_field('fecha_de_publicacion', $post_id);
        echo $date ? esc_html($date) : '—';
    }
}
add_action('manage_noticias_posts_custom_column', 'fjp_noticias_custom_column_content', 10, 2);

/**
 * Add Columns to Noticias List
 */
function fjp_add_noticias_columns($columns) {
    $new_columns = array();
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key === 'title') {
            $new_columns['fecha_noticia'] = __('Fecha Publicación', 'fjp');
        }
    }
    return $new_columns;
}
add_filter('manage_noticias_posts_columns', 'fjp_add_noticias_columns');
