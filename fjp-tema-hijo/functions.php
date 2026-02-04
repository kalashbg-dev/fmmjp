<?php
/**
 * FJP Premium - Fundación Juventud Progresista
 * Premium Child Theme for Astra
 *
 * A professional-grade WordPress theme with native Gutenberg integration,
 * advanced custom post types, and seamless style synchronization.
 *
 * @package FJP_Premium
 * @author Equipo de Desarrollo Web FJP
 * @version 2.0.0
 * @link https://fundacionjuventudprogresista.org
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit('Direct access forbidden.');
}

/**
 * ==============================================
 * THEME CONSTANTS
 * ==============================================
 */
define('FJP_VERSION', '2.0.0');
define('FJP_THEME_DIR', get_stylesheet_directory());
define('FJP_THEME_URI', get_stylesheet_directory_url());
define('FJP_INC_DIR', FJP_THEME_DIR . '/inc');
define('FJP_ASSETS_URI', FJP_THEME_URI . '/assets');

/**
 * ==============================================
 * THEME SETUP
 * ==============================================
 */
function fjp_premium_setup() {
    // Load text domain for translations
    load_child_theme_textdomain('fjp', FJP_THEME_DIR . '/languages');
    
    // Add theme support features
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('custom-logo');
    add_theme_support('custom-header');
    add_theme_support('custom-background');
    add_theme_support('title-tag');
    
    // Add editor stylesheet
    add_editor_style('style.css');
    
    // Register custom image sizes
    add_image_size('fjp-hero', 1920, 1080, true);
    add_image_size('fjp-featured', 1200, 675, true);
    add_image_size('fjp-thumbnail', 600, 400, true);
    add_image_size('fjp-card', 400, 300, true);
    add_image_size('fjp-logo', 200, 100, false);
    add_image_size('fjp-profile', 150, 150, true);
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Menú Principal', 'fjp'),
        'footer' => __('Menú del Footer', 'fjp'),
        'social' => __('Redes Sociales', 'fjp'),
    ));
}
add_action('after_setup_theme', 'fjp_premium_setup');

/**
 * ==============================================
 * ENQUEUE STYLES & SCRIPTS
 * ==============================================
 */
function fjp_premium_enqueue_assets() {
    // Parent theme styles (Astra)
    wp_enqueue_style('astra-theme-css', get_template_directory_uri() . '/style.css', array(), FJP_VERSION);
    
    // Child theme main stylesheet
    wp_enqueue_style('fjp-main-styles', FJP_THEME_URI . '/style.css', array('astra-theme-css'), FJP_VERSION);
    
    // Google Fonts
    wp_enqueue_style(
        'fjp-google-fonts',
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap',
        array(),
        null
    );
    
    // Font Awesome
    wp_enqueue_style(
        'fjp-font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
        array(),
        '6.4.0'
    );
    
    // Animate.css for animations
    wp_enqueue_style(
        'fjp-animate',
        'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css',
        array(),
        '4.1.1'
    );
    
    // Bootstrap Grid (optional, only if needed)
    wp_enqueue_style(
        'fjp-bootstrap-grid',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap-grid.min.css',
        array(),
        '5.3.0'
    );
    
    // Main JavaScript
    wp_enqueue_script('fjp-main-js', FJP_THEME_URI . '/js/main.js', array('jquery'), FJP_VERSION, true);
    
    // Counter animations
    wp_enqueue_script('fjp-counter-js', FJP_THEME_URI . '/js/counter.js', array('jquery'), FJP_VERSION, true);
    
    // News/Blog functionality
    if (is_singular('noticias') || is_post_type_archive('noticias') || is_page('noticias')) {
        wp_enqueue_script('fjp-news-js', FJP_THEME_URI . '/js/news.js', array('jquery'), FJP_VERSION, true);
    }
    
    // Volunteer form functionality
    if (is_page('voluntariado') || is_page('voluntarios')) {
        wp_enqueue_script('fjp-volunteers-js', FJP_THEME_URI . '/js/volunteers.js', array('jquery'), FJP_VERSION, true);
    }
    
    // Donations functionality
    if (is_page('donaciones') || is_page('donar')) {
        wp_enqueue_script('fjp-donations-js', FJP_THEME_URI . '/js/donations.js', array('jquery'), FJP_VERSION, true);
    }
    
    // Localize scripts for AJAX
    wp_localize_script('fjp-main-js', 'fjpData', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('fjp_nonce'),
        'api_url' => esc_url_raw(rest_url('wp/v2/')),
        'theme_url' => FJP_THEME_URI,
        'site_name' => get_bloginfo('name'),
        'site_url' => home_url('/'),
    ));
    
    // Comments script (if enabled)
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'fjp_premium_enqueue_assets', 20);

/**
 * ==============================================
 * LOAD MODULAR COMPONENTS
 * ==============================================
 */

// Custom Post Types
require_once FJP_INC_DIR . '/custom-post-types.php';

// ACF Field Groups
require_once FJP_INC_DIR . '/acf-fields.php';

// ACF Blocks (Gutenberg integration)
if (file_exists(FJP_INC_DIR . '/acf-blocks.php')) {
    require_once FJP_INC_DIR . '/acf-blocks.php';
}

// Shortcodes
require_once FJP_INC_DIR . '/shortcodes.php';

// Customizer (Theme options)
require_once FJP_INC_DIR . '/customizer.php';

// Patterns (Block patterns)
require_once FJP_INC_DIR . '/patterns.php';

// Custom layout metabox (Pro features)
require_once FJP_INC_DIR . '/custom-layout-metabox.php';

// Performance optimizations
require_once FJP_INC_DIR . '/performance.php';

// Admin customizations
if (is_admin()) {
    require_once FJP_INC_DIR . '/admin.php';
}

// REST API extensions
if (file_exists(FJP_INC_DIR . '/rest-api.php')) {
    require_once FJP_INC_DIR . '/rest-api.php';
}

// Security enhancements
if (file_exists(FJP_INC_DIR . '/security.php')) {
    require_once FJP_INC_DIR . '/security.php';
}

/**
 * ==============================================
 * BODY CLASSES
 * ==============================================
 */
function fjp_premium_body_classes($classes) {
    global $post;
    
    // Add page slug
    if (is_singular()) {
        $classes[] = 'page-' . $post->post_name;
    }
    
    // Add post type
    if (is_singular()) {
        $classes[] = 'post-type-' . get_post_type();
    }
    
    // Add custom classes based on ACF options
    if (function_exists('get_field')) {
        if (get_field('page_header_transparent')) {
            $classes[] = 'fjp-transparent-header';
        }
        if (get_field('page_header_sticky')) {
            $classes[] = 'fjp-sticky-header';
        }
        if (get_field('page_hide_title')) {
            $classes[] = 'fjp-hide-title';
        }
        if (get_field('page_hide_footer')) {
            $classes[] = 'fjp-hide-footer';
        }
        
        // Add width class
        $width = get_field('page_width');
        if ($width && $width !== 'default') {
            $classes[] = 'fjp-width-' . $width;
        }
    }
    
    // Archive classes
    if (is_post_type_archive('noticias') || is_singular('noticias')) {
        $classes[] = 'fjp-noticias-archive';
    }
    
    // Browser detection (for compatibility)
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $browser = fjp_get_browser_name();
        $classes[] = 'browser-' . $browser;
    }
    
    return $classes;
}
add_filter('body_class', 'fjp_premium_body_classes');

/**
 * ==============================================
 * EXCERPT LENGTH & MORE TAG
 * ==============================================
 */
function fjp_premium_excerpt_length($length) {
    if (is_post_type_archive('noticias') || is_singular('noticias')) {
        return 30;
    }
    return 20;
}
add_filter('excerpt_length', 'fjp_premium_excerpt_length', 999);

function fjp_premium_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'fjp_premium_excerpt_more');

/**
 * ==============================================
 * OPTIMIZE IMAGES
 * ==============================================
 */
function fjp_premium_optimize_images($content) {
    // Add loading="lazy" and decoding="async" to images
    return preg_replace_callback('/<img([^>]+?)>/', function($matches) {
        $img = $matches[1];
        
        // Add loading lazy if not present
        if (strpos($img, 'loading=') === false) {
            $img .= ' loading="lazy"';
        }
        
        // Add decoding async if not present
        if (strpos($img, 'decoding=') === false) {
            $img .= ' decoding="async"';
        }
        
        return '<img' . $img . '>';
    }, $content);
}
add_filter('the_content', 'fjp_premium_optimize_images');
add_filter('post_thumbnail_html', 'fjp_premium_optimize_images');

/**
 * ==============================================
 * CUSTOM EXCERPT FOR NEWS
 * ==============================================
 */
function fjp_get_excerpt($post_id = null, $length = 20) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $excerpt = get_the_excerpt($post_id);
    
    if (!$excerpt) {
        $content = get_post_field('post_content', $post_id);
        $excerpt = wp_trim_words($content, $length);
    }
    
    return $excerpt;
}

/**
 * ==============================================
 * UTILITY FUNCTIONS
 * ==============================================
 */

/**
 * Get browser name from user agent
 */
function fjp_get_browser_name() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    
    if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'opera';
    if (strpos($user_agent, 'Edge')) return 'edge';
    if (strpos($user_agent, 'Chrome')) return 'chrome';
    if (strpos($user_agent, 'Safari')) return 'safari';
    if (strpos($user_agent, 'Firefox')) return 'firefox';
    if (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'ie';
    
    return 'unknown';
}

/**
 * Check if current page is a specific custom post type
 */
function fjp_is_post_type($type) {
    return is_singular($type) || is_post_type_archive($type) || get_post_type() === $type;
}

/**
 * Get social sharing links
 */
function fjp_get_social_share_links($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $url = get_permalink($post_id);
    $title = get_the_title($post_id);
    
    return array(
        'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($url),
        'twitter' => 'https://twitter.com/intent/tweet?url=' . urlencode($url) . '&text=' . urlencode($title),
        'linkedin' => 'https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode($url) . '&title=' . urlencode($title),
        'whatsapp' => 'https://api.whatsapp.com/send?text=' . urlencode($title . ' ' . $url),
        'email' => 'mailto:?subject=' . urlencode($title) . '&body=' . urlencode($url),
    );
}

/**
 * Format phone number for WhatsApp
 */
function fjp_format_whatsapp_number($number) {
    // Remove all non-numeric characters
    $number = preg_replace('/[^0-9]/', '', $number);
    
    // Ensure it starts with country code
    if (substr($number, 0, 1) !== '1' && strlen($number) === 10) {
        $number = '1' . $number; // Add country code for Dominican Republic
    }
    
    return $number;
}

/**
 * Get formatted date in Spanish
 */
function fjp_get_formatted_date($post_id = null, $format = 'long') {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $timestamp = get_the_time('U', $post_id);
    
    switch ($format) {
        case 'short':
            return date_i18n('d/m/Y', $timestamp);
        case 'medium':
            return date_i18n('d M Y', $timestamp);
        case 'long':
        default:
            return date_i18n('d \d\e F \d\e Y', $timestamp);
    }
}

/**
 * ==============================================
 * REDIRECT EXTERNAL NEWS
 * ==============================================
 */
function fjp_redirect_external_news() {
    if (!is_singular('noticias')) {
        return;
    }
    
    global $post;
    
    if (function_exists('get_field')) {
        $external_url = get_field('noticia_url_externa', $post->ID);
        
        if ($external_url && filter_var($external_url, FILTER_VALIDATE_URL)) {
            wp_redirect($external_url, 301);
            exit;
        }
    }
}
add_action('template_redirect', 'fjp_redirect_external_news');

/**
 * ==============================================
 * DISABLE COMMENTS ON CERTAIN POST TYPES
 * ==============================================
 */
function fjp_disable_comments($open, $post_id) {
    $post_type = get_post_type($post_id);
    $disabled_types = array('voluntarios', 'alianzas', 'page');
    
    if (in_array($post_type, $disabled_types)) {
        return false;
    }
    
    return $open;
}
add_filter('comments_open', 'fjp_disable_comments', 10, 2);

/**
 * ==============================================
 * CUSTOM LOGIN LOGO
 * ==============================================
 */
function fjp_login_logo() {
    if (has_custom_logo()) {
        $custom_logo_id = get_theme_mod('custom_logo');
        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
        
        if ($logo) {
            echo '<style type="text/css">
                #login h1 a, .login h1 a {
                    background-image: url(' . esc_url($logo[0]) . ');
                    height: 80px;
                    width: 100%;
                    background-size: contain;
                    background-repeat: no-repeat;
                    padding-bottom: 30px;
                }
            </style>';
        }
    }
}
add_action('login_enqueue_scripts', 'fjp_login_logo');

function fjp_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'fjp_login_logo_url');

function fjp_login_logo_url_title() {
    return get_bloginfo('name');
}
add_filter('login_headertitle', 'fjp_login_logo_url_title');

/**
 * ==============================================
 * THEME ACTIVATION
 * ==============================================
 */
function fjp_premium_activation() {
    // Flush rewrite rules on theme activation
    flush_rewrite_rules();
    
    // Set default options
    if (get_option('fjp_theme_activated') !== FJP_VERSION) {
        update_option('fjp_theme_activated', FJP_VERSION);
        update_option('fjp_activation_date', current_time('mysql'));
    }
}
add_action('after_switch_theme', 'fjp_premium_activation');

/**
 * ==============================================
 * DEBUGGING HELPERS (Development only)
 * ==============================================
 */
if (defined('WP_DEBUG') && WP_DEBUG) {
    function fjp_debug_log($message, $data = null) {
        if ($data) {
            error_log('[FJP DEBUG] ' . $message . ': ' . print_r($data, true));
        } else {
            error_log('[FJP DEBUG] ' . $message);
        }
    }
}
