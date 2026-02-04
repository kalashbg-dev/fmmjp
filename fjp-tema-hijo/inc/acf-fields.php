<?php
/**
 * ACF Field Groups Configuration
 * Premium-tier field architecture with native Gutenberg integration
 *
 * @package FJP
 * @version 2.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register ACF Field Groups
 */
function fjp_premium_register_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    /**
     * ==============================================
     * NOTICIAS (NEWS) - FIELD GROUP
     * ==============================================
     */
    acf_add_local_field_group(array(
        'key' => 'group_noticias_premium',
        'title' => 'Información de Noticia',
        'fields' => array(
            // Meta Information Tab
            array(
                'key' => 'field_tab_meta',
                'label' => 'Meta Información',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_noticia_url_externa',
                'label' => 'URL Externa',
                'name' => 'noticia_url_externa',
                'type' => 'url',
                'instructions' => 'Si es una noticia de un medio externo, ingresa la URL completa. Al hacer clic se redireccionará a esta URL.',
                'placeholder' => 'https://ejemplo.com/noticia',
            ),
            array(
                'key' => 'field_noticia_fuente',
                'label' => 'Fuente',
                'name' => 'noticia_fuente',
                'type' => 'text',
                'instructions' => 'Nombre del medio o fuente original (ej: Diario Libre, Listín Diario)',
                'placeholder' => 'Nombre del medio',
            ),
            array(
                'key' => 'field_noticia_fecha_publicacion',
                'label' => 'Fecha de Publicación Original',
                'name' => 'noticia_fecha_publicacion',
                'type' => 'date_picker',
                'instructions' => 'Fecha en que se publicó originalmente la noticia (opcional)',
                'display_format' => 'd/m/Y',
                'return_format' => 'Y-m-d',
            ),
            array(
                'key' => 'field_noticia_autor_externo',
                'label' => 'Autor Externo',
                'name' => 'noticia_autor_externo',
                'type' => 'text',
                'instructions' => 'Nombre del autor original de la noticia externa',
                'placeholder' => 'Nombre del autor',
            ),
            
            // Display Settings Tab
            array(
                'key' => 'field_tab_display',
                'label' => 'Opciones de Visualización',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_noticia_destacada',
                'label' => 'Noticia Destacada',
                'name' => 'noticia_destacada',
                'type' => 'true_false',
                'instructions' => 'Marcar como noticia destacada para mostrarla en la página principal',
                'ui' => 1,
                'ui_on_text' => 'Destacada',
                'ui_off_text' => 'Normal',
            ),
            array(
                'key' => 'field_noticia_urgente',
                'label' => 'Noticia Urgente',
                'name' => 'noticia_urgente',
                'type' => 'true_false',
                'instructions' => 'Marcar como urgente para mostrar con badge especial',
                'ui' => 1,
                'ui_on_text' => 'Urgente',
                'ui_off_text' => 'Normal',
            ),
            array(
                'key' => 'field_noticia_color_tema',
                'label' => 'Color del Tema',
                'name' => 'noticia_color_tema',
                'type' => 'select',
                'instructions' => 'Color principal para esta noticia (afecta badges y acentos)',
                'choices' => array(
                    'primary' => 'Azul Primario',
                    'secondary' => 'Verde Secundario',
                    'teal' => 'Turquesa',
                    'orange' => 'Naranja',
                    'accent' => 'Rojo Acento',
                ),
                'default_value' => 'primary',
            ),
            
            // Media Tab
            array(
                'key' => 'field_tab_media',
                'label' => 'Medios',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_noticia_galeria',
                'label' => 'Galería de Imágenes',
                'name' => 'noticia_galeria',
                'type' => 'gallery',
                'instructions' => 'Galería de imágenes relacionadas con la noticia',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
            ),
            array(
                'key' => 'field_noticia_video_url',
                'label' => 'URL de Video',
                'name' => 'noticia_video_url',
                'type' => 'url',
                'instructions' => 'URL de video de YouTube o Vimeo relacionado',
                'placeholder' => 'https://youtube.com/watch?v=...',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'noticias',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
        'show_in_rest' => 1, // Enable Gutenberg
    ));

    /**
     * ==============================================
     * TESTIMONIOS - FIELD GROUP
     * ==============================================
     */
    acf_add_local_field_group(array(
        'key' => 'group_testimonios_premium',
        'title' => 'Detalles del Testimonio',
        'fields' => array(
            array(
                'key' => 'field_testimonio_cargo',
                'label' => 'Cargo / Rol',
                'name' => 'testimonio_cargo',
                'type' => 'text',
                'instructions' => 'Cargo o rol de la persona (ej: Voluntaria educativa, Coordinador)',
                'placeholder' => 'Ej: Voluntario deportivo',
                'required' => 1,
            ),
            array(
                'key' => 'field_testimonio_organizacion',
                'label' => 'Organización',
                'name' => 'testimonio_organizacion',
                'type' => 'text',
                'instructions' => 'Organización a la que pertenece (opcional)',
                'placeholder' => 'Ej: Fundación Juventud Progresista',
            ),
            array(
                'key' => 'field_testimonio_rating',
                'label' => 'Valoración',
                'name' => 'testimonio_rating',
                'type' => 'range',
                'instructions' => 'Valoración de 1 a 5 estrellas',
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default_value' => 5,
                'prepend' => '⭐',
                'append' => 'estrellas',
            ),
            array(
                'key' => 'field_testimonio_fecha_colaboracion',
                'label' => 'Fecha de Colaboración',
                'name' => 'testimonio_fecha_colaboracion',
                'type' => 'date_picker',
                'instructions' => 'Fecha en que colaboró con la fundación',
                'display_format' => 'd/m/Y',
                'return_format' => 'Y-m-d',
            ),
            array(
                'key' => 'field_testimonio_destacado',
                'label' => 'Testimonio Destacado',
                'name' => 'testimonio_destacado',
                'type' => 'true_false',
                'instructions' => 'Marcar para mostrar en áreas destacadas',
                'ui' => 1,
                'ui_on_text' => 'Destacado',
                'ui_off_text' => 'Normal',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'testimonios',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'side',
        'style' => 'default',
        'active' => true,
        'show_in_rest' => 1,
    ));

    /**
     * ==============================================
     * ALIANZAS - FIELD GROUP
     * ==============================================
     */
    acf_add_local_field_group(array(
        'key' => 'group_alianzas_premium',
        'title' => 'Detalles de la Alianza',
        'fields' => array(
            array(
                'key' => 'field_alianza_url',
                'label' => 'Sitio Web',
                'name' => 'alianza_url',
                'type' => 'url',
                'instructions' => 'URL del sitio web de la organización aliada',
                'placeholder' => 'https://ejemplo.com',
            ),
            array(
                'key' => 'field_alianza_tipo',
                'label' => 'Tipo de Alianza',
                'name' => 'alianza_tipo',
                'type' => 'select',
                'instructions' => 'Tipo de colaboración',
                'choices' => array(
                    'estrategica' => 'Alianza Estratégica',
                    'operativa' => 'Alianza Operativa',
                    'patrocinio' => 'Patrocinio',
                    'colaboracion' => 'Colaboración',
                    'beneficiario' => 'Beneficiario',
                ),
                'default_value' => 'colaboracion',
            ),
            array(
                'key' => 'field_alianza_fecha_inicio',
                'label' => 'Fecha de Inicio',
                'name' => 'alianza_fecha_inicio',
                'type' => 'date_picker',
                'instructions' => 'Fecha en que inició la alianza',
                'display_format' => 'd/m/Y',
                'return_format' => 'Y-m-d',
            ),
            array(
                'key' => 'field_alianza_descripcion',
                'label' => 'Descripción Breve',
                'name' => 'alianza_descripcion',
                'type' => 'textarea',
                'instructions' => 'Breve descripción de la alianza y su impacto',
                'rows' => 3,
                'maxlength' => 250,
            ),
            array(
                'key' => 'field_alianza_activa',
                'label' => 'Alianza Activa',
                'name' => 'alianza_activa',
                'type' => 'true_false',
                'instructions' => 'Marcar si la alianza está actualmente activa',
                'ui' => 1,
                'ui_on_text' => 'Activa',
                'ui_off_text' => 'Inactiva',
                'default_value' => 1,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'alianzas',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
        'show_in_rest' => 1,
    ));

    /**
     * ==============================================
     * VOLUNTARIOS - FIELD GROUP
     * ==============================================
     */
    acf_add_local_field_group(array(
        'key' => 'group_voluntarios_premium',
        'title' => 'Información del Voluntario',
        'fields' => array(
            // Personal Information Tab
            array(
                'key' => 'field_tab_volunteer_personal',
                'label' => 'Información Personal',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_voluntario_email',
                'label' => 'Email',
                'name' => 'voluntario_email',
                'type' => 'email',
                'instructions' => 'Dirección de correo electrónico',
                'required' => 1,
            ),
            array(
                'key' => 'field_voluntario_telefono',
                'label' => 'Teléfono',
                'name' => 'voluntario_telefono',
                'type' => 'text',
                'instructions' => 'Número de teléfono de contacto',
                'required' => 1,
            ),
            array(
                'key' => 'field_voluntario_edad',
                'label' => 'Edad',
                'name' => 'voluntario_edad',
                'type' => 'number',
                'instructions' => 'Edad del voluntario',
                'min' => 16,
                'max' => 100,
            ),
            array(
                'key' => 'field_voluntario_ciudad',
                'label' => 'Ciudad',
                'name' => 'voluntario_ciudad',
                'type' => 'text',
                'instructions' => 'Ciudad de residencia',
            ),
            
            // Volunteer Details Tab
            array(
                'key' => 'field_tab_volunteer_details',
                'label' => 'Detalles del Voluntariado',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_voluntario_area',
                'label' => 'Área de Interés',
                'name' => 'voluntario_area',
                'type' => 'select',
                'instructions' => 'Área en la que desea colaborar',
                'choices' => array(
                    'educativo' => 'Acompañamiento educativo',
                    'deportivo' => 'Deportes y recreación',
                    'artistico' => 'Arte y cultura',
                    'administrativo' => 'Apoyo administrativo',
                    'social' => 'Trabajo social',
                    'tecnologia' => 'Tecnología',
                    'comunicacion' => 'Comunicación y medios',
                    'recaudacion' => 'Recaudación de fondos',
                ),
                'required' => 1,
            ),
            array(
                'key' => 'field_voluntario_disponibilidad',
                'label' => 'Disponibilidad',
                'name' => 'voluntario_disponibilidad',
                'type' => 'select',
                'instructions' => 'Disponibilidad horaria',
                'choices' => array(
                    'mananas' => 'Mañanas',
                    'tardes' => 'Tardes',
                    'fines-semana' => 'Fines de semana',
                    'tiempo-completo' => 'Tiempo completo',
                    'fines-de-mes' => 'Fines de mes',
                ),
                'required' => 1,
            ),
            array(
                'key' => 'field_voluntario_experiencia',
                'label' => 'Experiencia Previa',
                'name' => 'voluntario_experiencia',
                'type' => 'textarea',
                'instructions' => 'Experiencia previa en voluntariado',
                'rows' => 4,
            ),
            array(
                'key' => 'field_voluntario_motivacion',
                'label' => 'Motivación',
                'name' => 'voluntario_motivacion',
                'type' => 'textarea',
                'instructions' => '¿Qué le motiva a ser voluntario?',
                'rows' => 4,
                'required' => 1,
            ),
            
            // Status Tab
            array(
                'key' => 'field_tab_volunteer_status',
                'label' => 'Estado',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_voluntario_estado',
                'label' => 'Estado de Solicitud',
                'name' => 'voluntario_estado',
                'type' => 'select',
                'instructions' => 'Estado actual de la solicitud',
                'choices' => array(
                    'pendiente' => 'Pendiente de revisión',
                    'revisando' => 'En revisión',
                    'aprobado' => 'Aprobado',
                    'activo' => 'Activo',
                    'inactivo' => 'Inactivo',
                    'rechazado' => 'Rechazado',
                ),
                'default_value' => 'pendiente',
            ),
            array(
                'key' => 'field_voluntario_fecha_solicitud',
                'label' => 'Fecha de Solicitud',
                'name' => 'voluntario_fecha_solicitud',
                'type' => 'date_picker',
                'instructions' => 'Fecha en que se recibió la solicitud',
                'display_format' => 'd/m/Y',
                'return_format' => 'Y-m-d',
                'default_value' => date('Y-m-d'),
            ),
            array(
                'key' => 'field_voluntario_fecha_inicio',
                'label' => 'Fecha de Inicio',
                'name' => 'voluntario_fecha_inicio',
                'type' => 'date_picker',
                'instructions' => 'Fecha de inicio como voluntario activo',
                'display_format' => 'd/m/Y',
                'return_format' => 'Y-m-d',
            ),
            array(
                'key' => 'field_voluntario_notas',
                'label' => 'Notas Internas',
                'name' => 'voluntario_notas',
                'type' => 'textarea',
                'instructions' => 'Notas internas del equipo (no visible para el voluntario)',
                'rows' => 3,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'voluntarios',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
        'show_in_rest' => 0, // Private data
    ));

    /**
     * ==============================================
     * PAGE OPTIONS - FIELD GROUP
     * ==============================================
     */
    acf_add_local_field_group(array(
        'key' => 'group_page_options_premium',
        'title' => '⚙️ Opciones Avanzadas de Página (Premium)',
        'fields' => array(
            // Layout Tab
            array(
                'key' => 'field_tab_layout',
                'label' => 'Diseño y Layout',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_page_header_transparent',
                'label' => 'Header Transparente',
                'name' => 'page_header_transparent',
                'type' => 'true_false',
                'instructions' => 'El header se superpondrá sobre el contenido (ideal para páginas con hero)',
                'ui' => 1,
                'ui_on_text' => 'Activado',
                'ui_off_text' => 'Desactivado',
            ),
            array(
                'key' => 'field_page_header_sticky',
                'label' => 'Header Sticky (Fijo)',
                'name' => 'page_header_sticky',
                'type' => 'true_false',
                'instructions' => 'El header permanecerá visible al hacer scroll',
                'ui' => 1,
                'ui_on_text' => 'Activado',
                'ui_off_text' => 'Desactivado',
            ),
            array(
                'key' => 'field_page_hide_title',
                'label' => 'Ocultar Título de Página',
                'name' => 'page_hide_title',
                'type' => 'true_false',
                'instructions' => 'Ocultar el título automático de la página',
                'ui' => 1,
                'ui_on_text' => 'Ocultar',
                'ui_off_text' => 'Mostrar',
            ),
            array(
                'key' => 'field_page_hide_footer',
                'label' => 'Ocultar Footer',
                'name' => 'page_hide_footer',
                'type' => 'true_false',
                'instructions' => 'Ocultar el pie de página (útil para landing pages)',
                'ui' => 1,
                'ui_on_text' => 'Ocultar',
                'ui_off_text' => 'Mostrar',
            ),
            array(
                'key' => 'field_page_width',
                'label' => 'Ancho de Contenido',
                'name' => 'page_width',
                'type' => 'select',
                'instructions' => 'Ancho máximo del contenido',
                'choices' => array(
                    'default' => 'Por defecto (1200px)',
                    'wide' => 'Ancho (1400px)',
                    'full' => 'Ancho completo',
                    'narrow' => 'Estrecho (900px)',
                ),
                'default_value' => 'default',
            ),
            
            // Hero Section Tab
            array(
                'key' => 'field_tab_hero',
                'label' => 'Sección Hero',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_page_hero_enable',
                'label' => 'Activar Hero',
                'name' => 'page_hero_enable',
                'type' => 'true_false',
                'instructions' => 'Mostrar sección hero personalizada',
                'ui' => 1,
                'ui_on_text' => 'Activado',
                'ui_off_text' => 'Desactivado',
            ),
            array(
                'key' => 'field_page_hero_background',
                'label' => 'Imagen de Fondo Hero',
                'name' => 'page_hero_background',
                'type' => 'image',
                'instructions' => 'Imagen de fondo para la sección hero',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_page_hero_enable',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_page_hero_height',
                'label' => 'Altura del Hero',
                'name' => 'page_hero_height',
                'type' => 'select',
                'instructions' => 'Altura de la sección hero',
                'choices' => array(
                    'small' => 'Pequeño (40vh)',
                    'medium' => 'Medio (60vh)',
                    'large' => 'Grande (80vh)',
                    'full' => 'Pantalla completa (100vh)',
                ),
                'default_value' => 'medium',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_page_hero_enable',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
            ),
            
            // SEO Tab
            array(
                'key' => 'field_tab_seo',
                'label' => 'SEO y Meta',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_page_meta_description',
                'label' => 'Meta Descripción',
                'name' => 'page_meta_description',
                'type' => 'textarea',
                'instructions' => 'Descripción breve para motores de búsqueda (150-160 caracteres)',
                'rows' => 3,
                'maxlength' => 160,
            ),
            array(
                'key' => 'field_page_og_image',
                'label' => 'Imagen para Redes Sociales',
                'name' => 'page_og_image',
                'type' => 'image',
                'instructions' => 'Imagen que aparecerá al compartir en redes sociales',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ),
            ),
        ),
        'menu_order' => 10,
        'position' => 'side',
        'style' => 'default',
        'active' => true,
        'show_in_rest' => 1,
    ));
}
add_action('acf/init', 'fjp_premium_register_acf_fields');

/**
 * Modify ACF settings for better Gutenberg integration
 */
function fjp_premium_acf_settings() {
    // Enable ACF Gutenberg blocks
    acf_update_setting('show_admin', true);
    acf_update_setting('enable_shortcode', true);
}
add_action('acf/init', 'fjp_premium_acf_settings');
