<?php
/**
 * Admin Customizations - Premium Edition
 *
 * Professional admin interface enhancements, custom dashboards,
 * and administrative utilities.
 *
 * @package FJP_Premium
 * @version 2.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * ==============================================
 * CUSTOM ADMIN DASHBOARD
 * ==============================================
 */
function fjp_add_dashboard_widgets() {
    // Statistics Widget
    wp_add_dashboard_widget(
        'fjp_stats_widget',
        '📊 Estadísticas de la Fundación',
        'fjp_render_stats_widget'
    );
    
    // Recent Volunteers Widget
    wp_add_dashboard_widget(
        'fjp_volunteers_widget',
        '👥 Solicitudes de Voluntariado Recientes',
        'fjp_render_volunteers_widget'
    );
    
    // Quick Links Widget
    wp_add_dashboard_widget(
        'fjp_quick_links_widget',
        '🔗 Accesos Rápidos FJP',
        'fjp_render_quick_links_widget'
    );
}
add_action('wp_dashboard_setup', 'fjp_add_dashboard_widgets');

/**
 * Render Statistics Widget
 */
function fjp_render_stats_widget() {
    $stats = array(
        'noticias' => wp_count_posts('noticias')->publish,
        'testimonios' => wp_count_posts('testimonios')->publish,
        'alianzas' => wp_count_posts('alianzas')->publish,
        'voluntarios' => wp_count_posts('voluntarios')->publish,
    );
    ?>
    <div class="fjp-dashboard-stats">
        <div class="fjp-stat-grid">
            <div class="fjp-stat-item" style="border-left: 4px solid #0056D2;">
                <div class="fjp-stat-number"><?php echo $stats['noticias']; ?></div>
                <div class="fjp-stat-label">Noticias Publicadas</div>
            </div>
            <div class="fjp-stat-item" style="border-left: 4px solid #28A745;">
                <div class="fjp-stat-number"><?php echo $stats['testimonios']; ?></div>
                <div class="fjp-stat-label">Testimonios</div>
            </div>
            <div class="fjp-stat-item" style="border-left: 4px solid #2A9D8F;">
                <div class="fjp-stat-number"><?php echo $stats['alianzas']; ?></div>
                <div class="fjp-stat-label">Alianzas Activas</div>
            </div>
            <div class="fjp-stat-item" style="border-left: 4px solid #E9C46A;">
                <div class="fjp-stat-number"><?php echo $stats['voluntarios']; ?></div>
                <div class="fjp-stat-label">Voluntarios Registrados</div>
            </div>
        </div>
    </div>
    
    <style>
        .fjp-stat-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 15px;
        }
        .fjp-stat-item {
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        .fjp-stat-number {
            font-size: 28px;
            font-weight: 700;
            color: #264653;
            margin-bottom: 5px;
        }
        .fjp-stat-label {
            font-size: 13px;
            color: #6c757d;
            font-weight: 500;
        }
    </style>
    <?php
}

/**
 * Render Volunteers Widget
 */
function fjp_render_volunteers_widget() {
    $recent_volunteers = get_posts(array(
        'post_type' => 'voluntarios',
        'posts_per_page' => 5,
        'orderby' => 'date',
        'order' => 'DESC',
    ));
    
    if (empty($recent_volunteers)) {
        echo '<p>No hay solicitudes recientes.</p>';
        return;
    }
    
    echo '<ul class="fjp-volunteer-list">';
    foreach ($recent_volunteers as $volunteer) {
        $estado = get_field('voluntario_estado', $volunteer->ID);
        $area = get_field('voluntario_area', $volunteer->ID);
        $email = get_field('voluntario_email', $volunteer->ID);
        
        $status_colors = array(
            'pendiente' => '#ffc107',
            'revisando' => '#17a2b8',
            'aprobado' => '#28a745',
            'activo' => '#007bff',
            'inactivo' => '#6c757d',
            'rechazado' => '#dc3545',
        );
        
        $color = isset($status_colors[$estado]) ? $status_colors[$estado] : '#6c757d';
        
        echo '<li class="fjp-volunteer-item">';
        echo '<strong>' . esc_html($volunteer->post_title) . '</strong><br>';
        echo '<small style="color: #6c757d;">' . esc_html($email) . ' | ' . esc_html($area) . '</small><br>';
        echo '<span style="display: inline-block; padding: 2px 8px; background: ' . $color . '; color: white; border-radius: 3px; font-size: 11px; margin-top: 5px;">' . esc_html(ucfirst($estado)) . '</span>';
        echo '</li>';
    }
    echo '</ul>';
    
    echo '<p style="text-align: center; margin-top: 15px;">';
    echo '<a href="' . admin_url('edit.php?post_type=voluntarios') . '" class="button button-primary">Ver Todos los Voluntarios</a>';
    echo '</p>';
    
    ?>
    <style>
        .fjp-volunteer-list {
            margin: 10px 0;
            padding: 0;
            list-style: none;
        }
        .fjp-volunteer-item {
            padding: 10px;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 10px;
        }
        .fjp-volunteer-item:last-child {
            border-bottom: none;
        }
    </style>
    <?php
}

/**
 * Render Quick Links Widget
 */
function fjp_render_quick_links_widget() {
    $links = array(
        array(
            'title' => '📰 Agregar Noticia',
            'url' => admin_url('post-new.php?post_type=noticias'),
            'icon' => 'dashicons-media-document',
        ),
        array(
            'title' => '💬 Agregar Testimonio',
            'url' => admin_url('post-new.php?post_type=testimonios'),
            'icon' => 'dashicons-format-quote',
        ),
        array(
            'title' => '🤝 Agregar Alianza',
            'url' => admin_url('post-new.php?post_type=alianzas'),
            'icon' => 'dashicons-networking',
        ),
        array(
            'title' => '📄 Gestionar Páginas',
            'url' => admin_url('edit.php?post_type=page'),
            'icon' => 'dashicons-admin-page',
        ),
        array(
            'title' => '🎨 Personalizar Diseño',
            'url' => admin_url('customize.php'),
            'icon' => 'dashicons-admin-customizer',
        ),
        array(
            'title' => '⚙️ Configuración ACF',
            'url' => admin_url('edit.php?post_type=acf-field-group'),
            'icon' => 'dashicons-admin-generic',
        ),
    );
    
    echo '<div class="fjp-quick-links-grid">';
    foreach ($links as $link) {
        echo '<a href="' . esc_url($link['url']) . '" class="fjp-quick-link">';
        echo '<span class="dashicons ' . esc_attr($link['icon']) . '"></span>';
        echo '<span>' . esc_html($link['title']) . '</span>';
        echo '</a>';
    }
    echo '</div>';
    
    ?>
    <style>
        .fjp-quick-links-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-top: 10px;
        }
        .fjp-quick-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            text-decoration: none;
            color: #264653;
            transition: all 0.2s ease;
        }
        .fjp-quick-link:hover {
            background: #0056D2;
            color: white;
            border-color: #0056D2;
            transform: translateY(-2px);
        }
        .fjp-quick-link .dashicons {
            font-size: 20px;
            width: 20px;
            height: 20px;
        }
    </style>
    <?php
}

/**
 * ==============================================
 * CUSTOM ADMIN MENU
 * ==============================================
 */
function fjp_add_admin_menu_pages() {
    // Main FJP Settings Page
    add_menu_page(
        __('FJP Dashboard', 'fjp'),
        __('FJP Dashboard', 'fjp'),
        'manage_options',
        'fjp-dashboard',
        'fjp_render_dashboard_page',
        'dashicons-heart',
        3
    );
    
    // Theme Settings Submenu
    add_submenu_page(
        'fjp-dashboard',
        __('Configuración del Tema', 'fjp'),
        __('Configuración', 'fjp'),
        'manage_options',
        'fjp-settings',
        'fjp_render_settings_page'
    );
    
    // Import/Export Submenu
    add_submenu_page(
        'fjp-dashboard',
        __('Importar/Exportar', 'fjp'),
        __('Importar/Exportar', 'fjp'),
        'manage_options',
        'fjp-import-export',
        'fjp_render_import_export_page'
    );
}
add_action('admin_menu', 'fjp_add_admin_menu_pages');

/**
 * Render Main Dashboard Page
 */
function fjp_render_dashboard_page() {
    ?>
    <div class="wrap fjp-admin-page">
        <h1><?php _e('Dashboard FJP - Fundación Juventud Progresista', 'fjp'); ?></h1>
        
        <div class="fjp-dashboard-welcome">
            <div class="fjp-welcome-panel">
                <h2>👋 ¡Bienvenido al Panel de Administración!</h2>
                <p>Desde aquí puedes gestionar todos los aspectos de tu sitio web de manera profesional.</p>
            </div>
        </div>
        
        <div class="fjp-dashboard-content">
            <div class="fjp-dashboard-section">
                <h2>📊 Estadísticas Generales</h2>
                <?php fjp_render_stats_widget(); ?>
            </div>
            
            <div class="fjp-dashboard-section">
                <h2>🔗 Accesos Rápidos</h2>
                <?php fjp_render_quick_links_widget(); ?>
            </div>
            
            <div class="fjp-dashboard-section">
                <h2>📋 Tareas Pendientes</h2>
                <?php fjp_render_pending_tasks(); ?>
            </div>
            
            <div class="fjp-dashboard-section">
                <h2>ℹ️ Información del Tema</h2>
                <table class="widefat">
                    <tr>
                        <td><strong>Versión del Tema:</strong></td>
                        <td><?php echo FJP_VERSION; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Tema Padre:</strong></td>
                        <td>Astra <?php echo wp_get_theme('astra')->get('Version'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>WordPress:</strong></td>
                        <td><?php echo get_bloginfo('version'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>PHP:</strong></td>
                        <td><?php echo PHP_VERSION; ?></td>
                    </tr>
                </table>
            </div>
        </div>
        
        <style>
            .fjp-admin-page {
                max-width: 1400px;
            }
            .fjp-welcome-panel {
                background: linear-gradient(135deg, #0056D2 0%, #28A745 100%);
                color: white;
                padding: 30px;
                border-radius: 10px;
                margin: 20px 0;
            }
            .fjp-welcome-panel h2 {
                margin: 0 0 10px 0;
                color: white;
            }
            .fjp-dashboard-content {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
                gap: 20px;
                margin-top: 20px;
            }
            .fjp-dashboard-section {
                background: white;
                padding: 20px;
                border: 1px solid #e9ecef;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            }
            .fjp-dashboard-section h2 {
                margin-top: 0;
                color: #264653;
                font-size: 18px;
                border-bottom: 2px solid #0056D2;
                padding-bottom: 10px;
            }
        </style>
    </div>
    <?php
}

/**
 * Render pending tasks
 */
function fjp_render_pending_tasks() {
    $tasks = array();
    
    // Check for pending volunteers
    $pending_volunteers = get_posts(array(
        'post_type' => 'voluntarios',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'voluntario_estado',
                'value' => 'pendiente',
            ),
        ),
    ));
    
    if (!empty($pending_volunteers)) {
        $tasks[] = array(
            'title' => 'Revisar ' . count($pending_volunteers) . ' solicitudes de voluntariado pendientes',
            'url' => admin_url('edit.php?post_type=voluntarios'),
            'priority' => 'high',
        );
    }
    
    // Check for unpublished news
    $draft_news = wp_count_posts('noticias')->draft;
    if ($draft_news > 0) {
        $tasks[] = array(
            'title' => 'Publicar ' . $draft_news . ' noticias en borrador',
            'url' => admin_url('edit.php?post_status=draft&post_type=noticias'),
            'priority' => 'medium',
        );
    }
    
    // Check for pages without featured images
    $pages_without_images = get_posts(array(
        'post_type' => 'page',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => '_thumbnail_id',
                'compare' => 'NOT EXISTS',
            ),
        ),
    ));
    
    if (!empty($pages_without_images) && count($pages_without_images) > 0) {
        $tasks[] = array(
            'title' => count($pages_without_images) . ' páginas sin imagen destacada',
            'url' => admin_url('edit.php?post_type=page'),
            'priority' => 'low',
        );
    }
    
    if (empty($tasks)) {
        echo '<p style="color: #28a745;">✅ ¡Todo está al día! No hay tareas pendientes.</p>';
        return;
    }
    
    echo '<ul class="fjp-tasks-list">';
    foreach ($tasks as $task) {
        $priority_colors = array(
            'high' => '#dc3545',
            'medium' => '#ffc107',
            'low' => '#17a2b8',
        );
        $color = $priority_colors[$task['priority']];
        
        echo '<li class="fjp-task-item">';
        echo '<span class="fjp-task-indicator" style="background: ' . $color . ';"></span>';
        echo '<a href="' . esc_url($task['url']) . '">' . esc_html($task['title']) . '</a>';
        echo '</li>';
    }
    echo '</ul>';
    
    ?>
    <style>
        .fjp-tasks-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .fjp-task-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border-bottom: 1px solid #e9ecef;
        }
        .fjp-task-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }
    </style>
    <?php
}

/**
 * Render Settings Page
 */
function fjp_render_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Configuración del Tema FJP', 'fjp'); ?></h1>
        <p>Configuración avanzada del tema próximamente...</p>
    </div>
    <?php
}

/**
 * Render Import/Export Page
 */
function fjp_render_import_export_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Importar/Exportar Contenido', 'fjp'); ?></h1>
        <p>Herramientas de importación y exportación próximamente...</p>
    </div>
    <?php
}

/**
 * ==============================================
 * ADMIN STYLES
 * ==============================================
 */
function fjp_admin_styles() {
    wp_enqueue_style('fjp-admin-styles', FJP_THEME_URI . '/admin/css/admin-styles.css', array(), FJP_VERSION);
}
add_action('admin_enqueue_scripts', 'fjp_admin_styles');

/**
 * ==============================================
 * ADMIN BAR CUSTOMIZATION
 * ==============================================
 */
function fjp_admin_bar_menu($wp_admin_bar) {
    // Add FJP Menu to Admin Bar
    $wp_admin_bar->add_node(array(
        'id' => 'fjp-menu',
        'title' => '🏢 FJP',
        'href' => admin_url('admin.php?page=fjp-dashboard'),
    ));
    
    $wp_admin_bar->add_node(array(
        'id' => 'fjp-dashboard',
        'parent' => 'fjp-menu',
        'title' => 'Dashboard',
        'href' => admin_url('admin.php?page=fjp-dashboard'),
    ));
    
    $wp_admin_bar->add_node(array(
        'id' => 'fjp-new-news',
        'parent' => 'fjp-menu',
        'title' => 'Nueva Noticia',
        'href' => admin_url('post-new.php?post_type=noticias'),
    ));
    
    $wp_admin_bar->add_node(array(
        'id' => 'fjp-volunteers',
        'parent' => 'fjp-menu',
        'title' => 'Voluntarios',
        'href' => admin_url('edit.php?post_type=voluntarios'),
    ));
}
add_action('admin_bar_menu', 'fjp_admin_bar_menu', 100);

/**
 * ==============================================
 * FOOTER TEXT CUSTOMIZATION
 * ==============================================
 */
function fjp_admin_footer_text($text) {
    return sprintf(
        __('Tema Premium FJP v%s | Desarrollado con ❤️ para la Fundación Juventud Progresista', 'fjp'),
        FJP_VERSION
    );
}
add_filter('admin_footer_text', 'fjp_admin_footer_text');
