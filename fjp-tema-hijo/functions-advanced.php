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

// --- WhatsApp Floating Button con efecto metálico, brillo y scroll control ---
function fh_whatsapp_button_shortcode() {
    $number = '13213659676';
    $img = 'https://azure-wallaby-881234.hostingersite.com/wp-content/uploads/2026/02/fundacion-juventud-progresista-6986b042d2a11.webp';

    $html = '
    <style>
        #whatsapp-float {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
            opacity: 0; /* Hidden initially */
            transform: translateY(20px);
        }
        #whatsapp-float.visible {
            opacity: 1;
            transform: translateY(0);
        }
        #whatsapp-float img {
            width: 100%;
            height: auto;
            border-radius: 50%;
        }
        #whatsapp-float:hover {
            transform: scale(1.1);
        }
        /* Shine Effect */
        .btn-shine {
            position: relative;
            overflow: hidden;
        }
        .btn-shine::after {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            transition: 0.5s;
        }
        .btn-shine:hover::after {
            left: 100%;
        }
    </style>
    <a id="whatsapp-float"
       href="https://wa.me/' . esc_attr($number) . '"
       target="_blank"
       rel="noopener noreferrer"
       class="btn-shine card-hover"
       aria-label="Message us on WhatsApp">
        <img src="' . esc_url($img) . '" alt="WhatsApp" loading="lazy">
    </a>';

    return $html;
}
add_shortcode('whatsapp_button', 'fh_whatsapp_button_shortcode'); // Corrected function name

// --- JavaScript SIN showAfter, el botón aparece de inmediato ---
function fh_whatsapp_button_footer_script() {
    // Only verify we are not in admin, to show on frontend
    if (is_admin()) return;

    // Inject the shortcode output into the footer automatically
    echo do_shortcode('[whatsapp_button]');

    ?>
    <script>
    (function(){
        document.addEventListener('DOMContentLoaded', function(){
            var btn = document.getElementById('whatsapp-float');
            if (!btn) return;
            // aseguramos que la clase "visible" esté activa inmediatamente
            setTimeout(function() {
                btn.classList.add('visible');
            }, 100);
        });
    })();
    </script>
    <?php
}
add_action('wp_footer', 'fh_whatsapp_button_footer_script');


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
