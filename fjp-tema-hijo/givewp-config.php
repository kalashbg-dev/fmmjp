<?php
/**
 * Configuración de GiveWP - Formularios de Donación Premium
 * Plantillas predefinidas y configuración avanzada
 * @package FJP
 */

// ===== CONFIGURACIÓN GENERAL DE GIVEWP =====

/**
 * Configuración básica de GiveWP al activar el tema
 */
function fjp_configurar_givewp_inicial() {
    if (!class_exists('Give')) {
        return;
    }

    // Configuración de moneda
    $give_settings = get_option('give_settings', []);

    $configuracion_default = [
        'currency' => 'ARS',
        'currency_position' => 'before',
        'thousands_separator' => '.',
        'decimal_separator' => ',',
        'number_decimals' => 2,
        'test_mode' => 'disabled',
        'email_access' => 'enabled',
        'anonymous_donations' => 'enabled',
        'terms' => 'enabled',
        'give_agree_text' => 'Acepto los términos y condiciones',
        'give_agree_label' => 'Términos y condiciones',
        'give_agree_text_color' => '#264653',
        'give_agree_text' => 'He leído y acepto los términos y condiciones',
        'donation_receipt' => [
            'name' => 'Recibo de Donación - Fundación Juega y Participa',
            'address' => 'Calle Principal 123, Buenos Aires, Argentina',
            'website' => 'https://fundacionjuegayparticipa.org',
            'vat_number' => '30-12345678-9',
            'logo' => get_template_directory_uri() . '/assets/img/logo-fjp.png'
        ]
    ];

    foreach ($configuracion_default as $key => $value) {
        if (!isset($give_settings[$key])) {
            $give_settings[$key] = $value;
        }
    }

    update_option('give_settings', $give_settings);
}
add_action('after_setup_theme', 'fjp_configurar_givewp_inicial');

// ===== FORMULARIOS PREDEFINIDOS =====

/**
 * Crear formularios de donación predefinidos
 */
function fjp_crear_formularios_donacion() {
    if (!class_exists('Give')) {
        return;
    }

    // Verificar si ya existen los formularios
    $formularios_existentes = get_posts([
        'post_type' => 'give_forms',
        'posts_per_page' => -1,
        'meta_query' => [
            [
                'key' => '_fjp_formulario_tipo',
                'compare' => 'EXISTS'
            ]
        ]
    ]);

    if (count($formularios_existentes) > 0) {
        return; // Ya están creados
    }

    // Formulario 1: Donación General
    $formulario_general = [
        'post_title' => 'Donación General - FJP',
        'post_content' => 'Ayudanos a construir una comunidad más justa y solidaria. Tu donación nos permite continuar trabajando por los derechos de niños, niñas y adolescentes.',
        'post_type' => 'give_forms',
        'post_status' => 'publish',
        'meta_input' => [
            '_give_set_price' => '1000',
            '_give_price_option' => 'multi',
            '_give_donation_levels' => [
                [
                    '_give_id' => [ 'level_id' => 1 ],
                    '_give_amount' => '500',
                    '_give_text' => '$500 ARS - Ayuda básica',
                    '_give_default' => 'default'
                ],
                [
                    '_give_id' => [ 'level_id' => 2 ],
                    '_give_amount' => '1000',
                    '_give_text' => '$1,000 ARS - Ayuda estándar'
                ],
                [
                    '_give_id' => [ 'level_id' => 3 ],
                    '_give_amount' => '2500',
                    '_give_text' => '$2,500 ARS - Ayuda premium'
                ],
                [
                    '_give_id' => [ 'level_id' => 4 ],
                    '_give_amount' => '5000',
                    '_give_text' => '$5,000 ARS - Patrocinador'
                ],
                [
                    '_give_id' => [ 'level_id' => 5 ],
                    '_give_amount' => 'custom',
                    '_give_text' => 'Otro monto'
                ]
            ],
            '_give_goal' => '500000',
            '_give_goal_format' => 'amount',
            '_give_close_form_when_goal_achieved' => 'no',
            '_give_form_content' => 'display',
            '_give_form_floating_labels' => 'enabled',
            '_give_anonymous_donation' => 'enabled',
            '_give_show_donation_comment' => 'enabled',
            '_give_comment_field_label' => 'Déjanos un mensaje de motivación',
            '_give_donation_comment_placeholder' => 'Cuéntanos qué te motivó a donar...',
            '_give_terms_label' => 'Acepto los términos y condiciones',
            '_give_terms_text' => 'Al realizar esta donación, aceptas nuestros términos y condiciones. Tu información está segura con nosotros.',
            '_give_agree_to_terms_label' => 'Acepto los términos y condiciones',
            '_fjp_formulario_tipo' => 'donacion_general',
            '_fjp_color_principal' => '#2A9D8F',
            '_fjp_color_secundario' => '#E9C46A'
        ]
    ];

    $formulario_id_general = wp_insert_post($formulario_general);

    // Formulario 2: Donación Mensual
    $formulario_mensual = [
        'post_title' => 'Donación Mensual - Socios FJP',
        'post_content' => 'Convertite en socio mensual y ayudanos a planificar nuestros proyectos a largo plazo. Tu apoyo constante es fundamental para nuestra sostenibilidad.',
        'post_type' => 'give_forms',
        'post_status' => 'publish',
        'meta_input' => [
            '_give_set_price' => '500',
            '_give_price_option' => 'multi',
            '_give_donation_levels' => [
                [
                    '_give_id' => [ 'level_id' => 1 ],
                    '_give_amount' => '300',
                    '_give_text' => '$300 ARS/mes - Socio básico'
                ],
                [
                    '_give_id' => [ 'level_id' => 2 ],
                    '_give_amount' => '500',
                    '_give_text' => '$500 ARS/mes - Socio estándar',
                    '_give_default' => 'default'
                ],
                [
                    '_give_id' => [ 'level_id' => 3 ],
                    '_give_amount' => '1000',
                    '_give_text' => '$1,000 ARS/mes - Socio premium'
                ],
                [
                    '_give_id' => [ 'level_id' => 4 ],
                    '_give_amount' => '2000',
                    '_give_text' => '$2,000 ARS/mes - Socio benefactor'
                ]
            ],
            '_give_recurring' => 'yes',
            '_give_recurring Billing Period' => 'month',
            '_give_recurring_times' => '0', // Indefinido
            '_give_recurring_donation_text' => 'Quiero hacer una donación mensual',
            '_give_recurring_one_time donation_text' => 'Quiero hacer una donación única',
            '_give_recurring_one_time donation_default' => 'no',
            '_give_form_content' => 'display',
            '_give_form_floating_labels' => 'enabled',
            '_give_anonymous_donation' => 'enabled',
            '_fjp_formulario_tipo' => 'donacion_mensual',
            '_give_goal' => '10000',
            '_give_goal_format' => 'donors'
        ]
    ];

    $formulario_id_mensual = wp_insert_post($formulario_mensual);

    // Formulario 3: Donación para Campañas Especiales
    $formulario_campana = [
        'post_title' => 'Campaña de Navidad - FJP',
        'post_content' => 'Sumate a nuestra campaña de Navidad y ayudanos a llevar alegría a niños, niñas y adolescentes. Tu donación nos permite organizar actividades especiales y entregar regalos.',
        'post_type' => 'give_forms',
        'post_status' => 'publish',
        'meta_input' => [
            '_give_set_price' => '1500',
            '_give_price_option' => 'multi',
            '_give_donation_levels' => [
                [
                    '_give_id' => [ 'level_id' => 1 ],
                    '_give_amount' => '1000',
                    '_give_text' => '$1,000 ARS - Regalo básico',
                    '_give_default' => 'default'
                ],
                [
                    '_give_id' => [ 'level_id' => 2 ],
                    '_give_amount' => '2500',
                    '_give_text' => '$2,500 ARS - Regalo especial'
                ],
                [
                    '_give_id' => [ 'level_id' => 3 ],
                    '_give_amount' => '5000',
                    '_give_text' => '$5,000 ARS - Regalo premium'
                ],
                [
                    '_give_id' => [ 'level_id' => 4 ],
                    '_give_amount' => '10000',
                    '_give_text' => '$10,000 ARS - Padrino de Navidad'
                ]
            ],
            '_give_goal' => '250000',
            '_give_goal_format' => 'amount',
            '_give_goal_color' => '#E9C46A',
            '_give_close_form_when_goal_achieved' => 'yes',
            '_give_form_content' => 'display',
            '_give_campaign_end_date' => date('Y-m-d', strtotime('+2 months')),
            '_fjp_formulario_tipo' => 'campana_especial',
            '_fjp_campana_activa' => 'si',
            '_fjp_campana_fecha_fin' => date('Y-m-d', strtotime('+2 months'))
        ]
    ];

    $formulario_id_campana = wp_insert_post($formulario_campana);

    // Guardar IDs de formularios para referencia
    update_option('fjp_formularios_donacion', [
        'general' => $formulario_id_general,
        'mensual' => $formulario_id_mensual,
        'campana' => $formulario_id_campana
    ]);
}
add_action('init', 'fjp_crear_formularios_donacion', 20);

// ===== PERSONALIZACIÓN DE FORMULARIOS =====

/**
 * Personalizar la apariencia de los formularios de GiveWP
 */
function fjp_personalizar_givewp_estilos() {
    if (!class_exists('Give')) {
        return;
    }
    ?>
    <style>
    /* Estilos personalizados para GiveWP */
    .give-form-wrap {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .give-form-wrap:hover {
        box-shadow: 0 15px 50px rgba(0,0,0,0.15);
        border-color: #2A9D8F;
    }

    .give-total-wrap {
        background: linear-gradient(135deg, #2A9D8F 0%, #264653 100%);
        color: white;
        padding: 25px;
        border-radius: 15px;
        text-align: center;
        margin-bottom: 30px;
        box-shadow: 0 5px 20px rgba(42, 157, 143, 0.3);
    }

    .give-total-wrap .give-currency-symbol {
        background: #E9C46A;
        color: #264653;
        padding: 8px 12px;
        border-radius: 8px;
        margin-right: 8px;
        font-weight: 700;
        font-size: 1.2rem;
    }

    .give-total-wrap #give-amount {
        background: transparent;
        border: none;
        color: white;
        font-size: 2rem;
        font-weight: 700;
        text-align: center;
        width: 150px;
    }

    .give-donation-levels-wrap {
        margin: 30px 0;
    }

    .give-donation-levels-wrap .give-btn {
        background: linear-gradient(135deg, #E9C46A 0%, #F4A261 100%);
        color: #264653;
        border: none;
        padding: 15px 25px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        margin: 5px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(233, 196, 106, 0.3);
    }

    .give-donation-levels-wrap .give-btn:hover,
    .give-donation-levels-wrap .give-btn.give-btn-level-active {
        background: linear-gradient(135deg, #2A9D8F 0%, #264653 100%);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(42, 157, 143, 0.4);
    }

    .give-donation-levels-wrap .give-btn.give-btn-level-active {
        transform: translateY(-3px) scale(1.05);
    }

    .give-btn-modal {
        background: linear-gradient(135deg, #2A9D8F 0%, #264653 100%);
        color: white;
        border: none;
        padding: 18px 40px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(42, 157, 143, 0.4);
    }

    .give-btn-modal:hover {
        background: linear-gradient(135deg, #264653 0%, #2A9D8F 100%);
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(42, 157, 143, 0.6);
    }

    .give-form .form-row input,
    .give-form .form-row select,
    .give-form .form-row textarea {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 12px 15px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
    }

    .give-form .form-row input:focus,
    .give-form .form-row select:focus,
    .give-form .form-row textarea:focus {
        border-color: #2A9D8F;
        box-shadow: 0 0 0 3px rgba(42, 157, 143, 0.1);
        outline: none;
    }

    .give-form label {
        color: #264653;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .give-form .form-row .give-tooltip {
        color: #2A9D8F;
    }

    /* Goal Progress Bar */
    .give-goal-progress {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 25px;
        margin: 30px 0;
        border: 2px solid #e9ecef;
    }

    .give-goal-progress .give-progress-bar {
        background: #e9ecef;
        border-radius: 10px;
        height: 20px;
        overflow: hidden;
        margin: 15px 0;
    }

    .give-goal-progress .give-progress-bar > span {
        background: linear-gradient(90deg, #2A9D8F 0%, #E9C46A 100%);
        height: 100%;
        border-radius: 10px;
        transition: width 0.6s ease;
        position: relative;
    }

    .give-goal-progress .give-progress-bar > span::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    .give-goal-progress .give-goal-text {
        color: #264653;
        font-weight: 600;
        font-size: 1.1rem;
        text-align: center;
        margin-top: 15px;
    }

    .give-goal-progress .give-goal-raised,
    .give-goal-progress .give-goal-goal {
        color: #2A9D8F;
        font-weight: 700;
    }

    /* Formulario de donación recurrente */
    .give-recurring-donation-section {
        background: rgba(42, 157, 143, 0.1);
        border-radius: 15px;
        padding: 25px;
        margin: 25px 0;
        border: 2px dashed #2A9D8F;
    }

    .give-recurring-donation-section .give-recurring-donors-choice {
        color: #264653;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .give-recurring-donation-section .give-recurring-donors-choice input[type="checkbox"] {
        margin-right: 10px;
        transform: scale(1.2);
    }

    /* Checkbox de términos */
    .give-terms-agreement {
        background: rgba(233, 196, 106, 0.1);
        border-radius: 10px;
        padding: 20px;
        margin: 25px 0;
        border: 2px solid #E9C46A;
    }

    .give-terms-agreement input[type="checkbox"] {
        transform: scale(1.3);
        margin-right: 10px;
    }

    .give-terms-agreement label {
        color: #264653;
        font-weight: 600;
        cursor: pointer;
        user-select: none;
    }

    .give-terms-agreement a {
        color: #2A9D8F;
        text-decoration: underline;
        font-weight: 600;
    }

    .give-terms-agreement a:hover {
        color: #264653;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .give-form-wrap {
            padding: 25px 20px;
        }

        .give-total-wrap {
            padding: 20px;
        }

        .give-total-wrap h3 {
            font-size: 1.2rem;
        }

        .give-total-wrap #give-amount {
            font-size: 1.5rem;
            width: 120px;
        }

        .give-donation-levels-wrap .give-btn {
            display: block;
            width: 100%;
            margin: 5px 0;
            text-align: center;
        }

        .give-btn-modal {
            width: 100%;
            padding: 15px 30px;
            font-size: 1rem;
        }
    }
    </style>
    <?php
}
add_action('wp_head', 'fjp_personalizar_givewp_estilos');

// ===== CAMPOS PERSONALIZADOS EN FORMULARIOS =====

/**
 * Añadir campos personalizados a los formularios de GiveWP
 */
function fjp_campos_personalizados_givewp($form_id, $args) {
    // Obtener el tipo de formulario
    $formulario_tipo = get_post_meta($form_id, '_fjp_formulario_tipo', true);

    // Campo: Información de contacto adicional
    ?>
    <div class="give-form-row give-donor-phone-wrap">
        <label class="give-label" for="give-phone-<?php echo $form_id; ?>">
            Teléfono de contacto
            <span class="give-required-indicator">*</span>
            <span class="give-tooltip give-icon give-question" data-tooltip="Nos pondremos en contacto contigo para confirmar tu donación"></span>
        </label>
        <input type="tel" name="give_phone" id="give-phone-<?php echo $form_id; ?>" class="give-input" placeholder="+54 11 1234-5678" required>
    </div>

    <div class="give-form-row give-donor-address-wrap">
        <label class="give-label" for="give-address-<?php echo $form_id; ?>">
            Dirección
            <span class="give-tooltip give-icon give-question" data-tooltip="Necesitamos tu dirección para el recibo de donación"></span>
        </label>
        <input type="text" name="give_address" id="give-address-<?php echo $form_id; ?>" class="give-input" placeholder="Calle, Número, Ciudad">
    </div>

    <div class="give-form-row give-donor-motivo-wrap">
        <label class="give-label" for="give-motivo-<?php echo $form_id; ?>">
            ¿Qué te motivó a donar?
            <span class="give-tooltip give-icon give-question" data-tooltip="Tu respuesta nos ayuda a mejorar"></span>
        </label>
        <select name="give_motivo" id="give-motivo-<?php echo $form_id; ?>" class="give-select">
            <option value="">Seleccionar motivo</option>
            <option value="apoyo-infantil">Apoyo a niños y niñas</option>
            <option value="educacion">Educación y formación</option>
            <option value="salud">Salud y bienestar</option>
            <option value="comunidad">Desarrollo comunitario</option>
            <option value="confianza">Confianza en la fundación</option>
            <option value="memoria">En memoria de alguien</option>
            <option value="otros">Otros</option>
        </select>
    </div>

    <div class="give-form-row give-donor-comentarios-wrap">
        <label class="give-label" for="give-comentarios-<?php echo $form_id; ?>">
            Comentarios adicionales
            <span class="give-tooltip give-icon give-question" data-tooltip="¿Quisieras compartir algo más con nosotros?"></span>
        </label>
        <textarea name="give_comentarios" id="give-comentarios-<?php echo $form_id; ?>" class="give-textarea" rows="3" placeholder="¿Quisieras compartir algo más con nosotros?"></textarea>
    </div>

    <?php if ($formulario_tipo === 'campana_especial'): ?>
    <div class="give-form-row give-campana-info">
        <div style="background: rgba(233, 196, 106, 0.1); border: 2px dashed #E9C46A; border-radius: 10px; padding: 20px; margin: 20px 0;">
            <h4 style="color: #264653; margin-bottom: 10px;"><i class="fas fa-gift"></i> Campaña especial</h4>
            <p style="color: #6c757d; margin-bottom: 0;">Tu donación será destinada específicamente a esta campaña. ¡Muchas gracias por tu generosidad!</p>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($formulario_tipo === 'donacion_mensual'): ?>
    <div class="give-form-row give-mensual-info">
        <div style="background: rgba(42, 157, 143, 0.1); border: 2px solid #2A9D8F; border-radius: 10px; padding: 20px; margin: 20px 0;">
            <h4 style="color: #264653; margin-bottom: 10px;"><i class="fas fa-heart"></i> Socio mensual</h4>
            <p style="color: #6c757d; margin-bottom: 0;">Al convertirte en socio mensual, nos ayudas a planificar nuestros proyectos a largo plazo. ¡Muchas gracias por tu compromiso!</p>
        </div>
    </div>
    <?php endif; ?>
    <?php
}
add_action('give_donor_after_name', 'fjp_campos_personalizados_givewp', 10, 2);

/**
 * Guardar datos personalizados de los formularios
 */
function fjp_guardar_campos_personalizados_givewp($payment_id, $payment_data) {
    // Guardar teléfono
    if (isset($_POST['give_phone'])) {
        update_post_meta($payment_id, '_give_donor_phone', sanitize_text_field($_POST['give_phone']));
    }

    // Guardar dirección
    if (isset($_POST['give_address'])) {
        update_post_meta($payment_id, '_give_donor_address', sanitize_text_field($_POST['give_address']));
    }

    // Guardar motivo
    if (isset($_POST['give_motivo'])) {
        update_post_meta($payment_id, '_give_donor_motivo', sanitize_text_field($_POST['give_motivo']));
    }

    // Guardar comentarios
    if (isset($_POST['give_comentarios'])) {
        update_post_meta($payment_id, '_give_donor_comentarios', sanitize_textarea_field($_POST['give_comentarios']));
    }

    // Guardar información adicional
    $user_info = wp_get_current_user();
    if ($user_info->ID > 0) {
        update_post_meta($payment_id, '_give_donor_user_id', $user_info->ID);
        update_post_meta($payment_id, '_give_donor_username', $user_info->user_login);
    }

    // Marcar si es primera donación
    $donor_email = give_get_payment_user_email($payment_id);
    $previous_donations = give_get_donations([
        'email' => $donor_email,
        'number' => -1
    ]);

    if (count($previous_donations) === 1) {
        update_post_meta($payment_id, '_give_first_time_donor', 'yes');
    }
}
add_action('give_insert_payment', 'fjp_guardar_campos_personalizados_givewp', 10, 2);

// ===== FUNCIONES AUXILIARES PARA DONACIONES =====

/**
 * Obtener estadísticas de donaciones
 */
function fjp_obtener_estadisticas_donaciones($periodo = 'all') {
    if (!class_exists('Give')) {
        return false;
    }

    $args = [
        'post_type' => 'give_payment',
        'posts_per_page' => -1,
        'post_status' => ['publish', 'give_subscription']
    ];

    if ($periodo !== 'all') {
        $args['date_query'] = fjp_obtener_rango_fecha($periodo);
    }

    $donaciones = get_posts($args);

    $estadisticas = [
        'total_donaciones' => count($donaciones),
        'monto_total' => 0,
        'promedio_donacion' => 0,
        'donaciones_mensuales' => 0,
        'donadores_unicos' => [],
        'metodos_pago' => []
    ];

    foreach ($donaciones as $donacion) {
        $monto = give_get_payment_amount($donacion->ID);
        $estadisticas['monto_total'] += $monto;

        $email = give_get_payment_user_email($donacion->ID);
        if (!in_array($email, $estadisticas['donadores_unicos'])) {
            $estadisticas['donadores_unicos'][] = $email;
        }

        // Verificar si es mensual
        if (give_get_payment_meta($donacion->ID, '_give_subscription_payment', true)) {
            $estadisticas['donaciones_mensuales']++;
        }

        // Método de pago
        $metodo = give_get_payment_gateway($donacion->ID);
        if (!isset($estadisticas['metodos_pago'][$metodo])) {
            $estadisticas['metodos_pago'][$metodo] = 0;
        }
        $estadisticas['metodos_pago'][$metodo]++;
    }

    $estadisticas['promedio_donacion'] = $estadisticas['total_donaciones'] > 0
        ? $estadisticas['monto_total'] / $estadisticas['total_donaciones']
        : 0;

    return $estadisticas;
}

/**
 * Obtener donadores recurrentes
 */
function fjp_obtener_donadores_recurrentes() {
    if (!class_exists('Give')) {
        return [];
    }

    global $wpdb;

    $results = $wpdb->get_results("
        SELECT DISTINCT
            p.ID as payment_id,
            p.post_title as donor_name,
            p.post_date as start_date,
            pm.meta_value as email
        FROM {$wpdb->posts} p
        INNER JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id
        WHERE p.post_type = 'give_payment'
        AND p.post_status = 'give_subscription'
        AND pm.meta_key = '_give_payment_user_email'
        ORDER BY p.post_date DESC
    ");

    return $results;
}

/**
 * Enviar notificación de agradecimiento personalizada
 */
function fjp_enviar_agradecimiento_donacion($payment_id) {
    if (!class_exists('Give')) {
        return;
    }

    $donor_name = give_get_donor_name_by_payment($payment_id);
    $donor_email = give_get_payment_user_email($payment_id);
    $amount = give_get_payment_amount($payment_id);
    $form_id = give_get_payment_form_id($payment_id);

    // Obtener información adicional
    $phone = get_post_meta($payment_id, '_give_donor_phone', true);
    $motivo = get_post_meta($payment_id, '_give_donor_motivo', true);
    $is_first_time = get_post_meta($payment_id, '_give_first_time_donor', true);

    // Preparar email
    $to = $donor_email;
    $subject = '¡Muchas gracias por tu donación a Fundación Juega y Participa!';

    $message = '<!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Gracias por tu donación</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #264653; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: linear-gradient(135deg, #2A9D8F 0%, #264653 100%); color: white; padding: 30px; text-align: center; border-radius: 15px 15px 0 0; }
            .content { background: #f8f9fa; padding: 30px; border-radius: 0 0 15px 15px; }
            .highlight { background: #E9C46A; color: #264653; padding: 15px; border-radius: 10px; margin: 20px 0; font-weight: 600; }
            .footer { text-align: center; margin-top: 30px; color: #6c757d; }
            .button { background: #2A9D8F; color: white; padding: 15px 30px; text-decoration: none; border-radius: 30px; display: inline-block; margin: 20px 0; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>¡Muchas gracias!</h1>
                <p>Tu generosidad nos permite continuar ayudando a niños, niñas y adolescentes</p>
            </div>

            <div class="content">
                <p>Hola <strong>' . esc_html($donor_name) . '</strong>,</p>

                <p>Queremos expresarte nuestra más sincera gratitud por tu donación de <strong>$' . number_format($amount, 2, ',', '.') . ' ARS</strong> a Fundación Juega y Participa.</p>
                ';

    if ($is_first_time === 'yes') {
        $message .= '<p>¡Es especialmente emocionante recibir tu primera donación! Esperamos que esta sea el comienzo de una relación duradera.</p>';
    }

    if ($motivo) {
        $motivos_traducidos = [
            'apoyo-infantil' => 'apoyar a niños y niñas',
            'educacion' => 'apoyar la educación',
            'salud' => 'apoyar la salud y bienestar',
            'comunidad' => 'desarrollar la comunidad',
            'confianza' => 'confiar en nuestra fundación',
            'memoria' => 'honrar la memoria de alguien'
        ];

        $motivo_traducido = isset($motivos_traducidos[$motivo]) ? $motivos_traducidos[$motivo] : $motivo;
        $message .= '<p>Nos alegra saber que tu motivación para donar es ' . esc_html($motivo_traducido) . '.</p>';
    }

    $message .= '
                <div class="highlight">
                    <strong>Tu donación será utilizada para:</strong>
                    <ul>
                        <li>Programas educativos y de refuerzo escolar</li>
                        <li>Actividades deportivas y recreativas</li>
                        <li>Talleres de arte y cultura</li>
                        <li>Apoyo psicológico y social</li>
                        <li>Materiales y recursos para las actividades</li>
                    </ul>
                </div>

                <p>En los próximos días recibirás tu recibo oficial de donación. Si tienes alguna pregunta o necesitas más información, no dudes en contactarnos.</p>

                <p>¡Una vez más, muchas gracias por tu generosidad!</p>

                <p>Con cariño,<br>
                <strong>El equipo de Fundación Juega y Participa</strong></p>

                <center>
                    <a href="https://fundacionjuegayparticipa.org" class="button">Visitar nuestro sitio web</a>
                </center>
            </div>

            <div class="footer">
                <p>Fundación Juega y Participa<br>
                Calle Principal 123, Buenos Aires, Argentina<br>
                Email: info@fundacionjuegayparticipa.org<br>
                Teléfono: +54 11 3456-7890</p>

                <p>Síguenos en nuestras redes sociales para estar al tanto de nuestras actividades.</p>
            </div>
        </div>
    </body>
    </html>';

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: Fundación Juega y Participa <info@fundacionjuegayparticipa.org>',
        'Reply-To: info@fundacionjuegayparticipa.org'
    ];

    // Enviar email
    $sent = wp_mail($to, $subject, $message, $headers);

    if ($sent) {
        // Registrar que se envió el email
        update_post_meta($payment_id, '_give_thankyou_email_sent', current_time('mysql'));
    }
}
add_action('give_insert_payment', 'fjp_enviar_agradecimiento_donacion', 20);

// ===== SHORTCODES PARA DONACIONES =====

/**
 * Shortcode para mostrar estadísticas de donaciones
 */
function fjp_shortcode_estadisticas_donaciones($atts) {
    $atts = shortcode_atts([
        'periodo' => 'all',
        'mostrar' => 'all'
    ], $atts);

    $estadisticas = fjp_obtener_estadisticas_donaciones($atts['periodo']);

    if (!$estadisticas) {
        return '<p>No hay estadísticas disponibles.</p>';
    }

    ob_start();
    ?>
    <div class="fjp-estadisticas-donaciones" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 30px; border-radius: 15px; margin: 20px 0;">
        <h3 style="color: #264653; text-align: center; margin-bottom: 30px;">Estadísticas de Donaciones</h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
            <div style="text-align: center; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                <div style="font-size: 2rem; color: #2A9D8F; font-weight: 700;"><?php echo number_format($estadisticas['total_donaciones']); ?></div>
                <div style="color: #6c757d; font-size: 0.9rem;">Total donaciones</div>
            </div>

            <div style="text-align: center; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                <div style="font-size: 2rem; color: #E9C46A; font-weight: 700;">$<?php echo number_format($estadisticas['monto_total'], 0, ',', '.'); ?></div>
                <div style="color: #6c757d; font-size: 0.9rem;">Monto total recaudado</div>
            </div>

            <div style="text-align: center; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                <div style="font-size: 2rem; color: #264653; font-weight: 700;">$<?php echo number_format($estadisticas['promedio_donacion'], 0, ',', '.'); ?></div>
                <div style="color: #6c757d; font-size: 0.9rem;">Promedio por donación</div>
            </div>

            <div style="text-align: center; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                <div style="font-size: 2rem; color: #F4A261; font-weight: 700;"><?php echo number_format($estadisticas['donaciones_mensuales']); ?></div>
                <div style="color: #6c757d; font-size: 0.9rem;">Donaciones mensuales</div>
            </div>
        </div>

        <?php if (!empty($estadisticas['metodos_pago'])): ?>
        <div style="margin-top: 30px; padding-top: 20px; border-top: 2px solid #e9ecef;">
            <h4 style="color: #264653; margin-bottom: 15px;">Métodos de pago más utilizados</h4>
            <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                <?php foreach ($estadisticas['metodos_pago'] as $metodo => $cantidad): ?>
                <span style="background: #2A9D8F; color: white; padding: 5px 12px; border-radius: 20px; font-size: 0.85rem;">
                    <?php echo esc_html($metodo); ?>: <?php echo $cantidad; ?>
                </span>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php

    return ob_get_clean();
}
add_shortcode('fjp_estadisticas_donaciones', 'fjp_shortcode_estadisticas_donaciones');

/**
 * Shortcode para mostrar donadores recurrentes
 */
function fjp_shortcode_donadores_recurrentes($atts) {
    $atts = shortcode_atts([
        'limite' => 5,
        'mostrar_fecha' => 'si'
    ], $atts);

    $donadores_recurrentes = fjp_obtener_donadores_recurrentes();

    if (empty($donadores_recurrentes)) {
        return '<p>No hay donadores recurrentes para mostrar.</p>';
    }

    $limite = min((int)$atts['limite'], count($donadores_recurrentes));

    ob_start();
    ?>
    <div class="fjp-donadores-recurrentes" style="background: linear-gradient(135deg, #264653 0%, #2A9D8F 100%); color: white; padding: 30px; border-radius: 15px; margin: 20px 0;">
        <h3 style="text-align: center; margin-bottom: 30px;"><i class="fas fa-heart"></i> Nuestros socios mensuales</h3>

        <div style="display: grid; gap: 15px;">
            <?php for ($i = 0; $i < $limite; $i++): ?>
            <?php $donador = $donadores_recurrentes[$i]; ?>
            <div style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 10px; padding: 15px; border: 1px solid rgba(255,255,255,0.2);">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <div style="font-weight: 600;"><?php echo esc_html($donador->donor_name); ?></div>
                        <?php if ($atts['mostrar_fecha'] === 'si'): ?>
                        <div style="font-size: 0.85rem; opacity: 0.8;">Desde <?php echo date('M Y', strtotime($donador->start_date)); ?></div>
                        <?php endif; ?>
                    </div>
                    <div style="color: #E9C46A;">
                        <i class="fas fa-medal"></i>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
        </div>

        <div style="text-align: center; margin-top: 20px; opacity: 0.9;">
            <small>¡Gracias a todos nuestros socios por su compromiso constante!</small>
        </div>
    </div>
    <?php

    return ob_get_clean();
}
add_shortcode('fjp_donadores_recurrentes', 'fjp_shortcode_donadores_recurrentes');

/**
 * Shortcode para mostrar formulario de donación específico
 */
function fjp_shortcode_formulario_donacion($atts) {
    $atts = shortcode_atts([
        'id' => '',
        'titulo' => 'si',
        'descripcion' => 'si'
    ], $atts);

    if (empty($atts['id'])) {
        return '<p>Por favor, especifica el ID del formulario de donación.</p>';
    }

    $formulario_id = (int)$atts['id'];

    // Verificar que el formulario existe
    $formulario = get_post($formulario_id);
    if (!$formulario || $formulario->post_type !== 'give_forms') {
        return '<p>Formulario de donación no encontrado.</p>';
    }

    ob_start();

    if ($atts['titulo'] === 'si') {
        echo '<h3 style="color: #264653; margin-bottom: 15px;">' . esc_html($formulario->post_title) . '</h3>';
    }

    if ($atts['descripcion'] === 'si' && !empty($formulario->post_content)) {
        echo '<p style="color: #6c757d; margin-bottom: 25px;">' . esc_html($formulario->post_content) . '</p>';
    }

    echo do_shortcode('[give_form id="' . $formulario_id . '"]');

    return ob_get_clean();
}
add_shortcode('fjp_formulario_donacion', 'fjp_shortcode_formulario_donacion');

// ===== INTEGRACIÓN CON PASARELAS DE PAGO =====

/**
 * Configurar pasarelas de pago específicas para Argentina
 */
function fjp_configurar_pasarelas_pago($gateways) {
    // Agregar configuración de MercadoPago
    if (isset($gateways['mercadopago'])) {
        $gateways['mercadopago']['admin_label'] = 'MercadoPago Argentina';
        $gateways['mercadopago']['checkout_label'] = 'MercadoPago';
    }

    // Agregar configuración de transferencia bancaria
    $gateways['bank_transfer'] = [
        'admin_label' => 'Transferencia Bancaria',
        'checkout_label' => 'Transferencia Bancaria',
        'gateway_logo' => get_template_directory_uri() . '/assets/img/bank-transfer.png',
        'support_subscription' => false,
        'support_preapproval' => false
    ];

    return $gateways;
}
add_filter('give_payment_gateways', 'fjp_configurar_pasarelas_pago');

/**
 * Información de transferencia bancaria
 */
function fjp_informacion_transferencia_bancaria() {
    $cuenta_bancaria = get_field('cuenta_bancaria', 'option');

    if ($cuenta_bancaria): ?>
    <div class="bank-transfer-info" style="background: rgba(42, 157, 143, 0.1); border: 2px dashed #2A9D8F; border-radius: 15px; padding: 25px; margin: 25px 0;">
        <h4 style="color: #264653; margin-bottom: 15px;"><i class="fas fa-university"></i> Datos para transferencia bancaria</h4>
        <div style="color: #6c757d; line-height: 1.6;">
            <?php echo nl2br(esc_html($cuenta_bancaria)); ?>
        </div>
        <div style="background: #E9C46A; color: #264653; padding: 15px; border-radius: 10px; margin-top: 15px; font-weight: 600;">
            <i class="fas fa-info-circle"></i> Importante: Enviar comprobante por email a info@fundacionjuegayparticipa.org
        </div>
    </div>
    <?php endif;
}
add_action('give_bank_transfer_cc_form', 'fjp_informacion_transferencia_bancaria');

// ===== FUNCIONES DE ADMINISTRACIÓN =====

/**
 * Añadir columnas personalizadas al listado de donaciones
 */
function fjp_columnas_donaciones($columns) {
    $new_columns = [];

    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;

        if ($key === 'donation') {
            $new_columns['telefono'] = 'Teléfono';
            $new_columns['motivo'] = 'Motivo';
        }
    }

    return $new_columns;
}
add_filter('give_payments_table_columns', 'fjp_columnas_donaciones');

/**
 * Rellenar columnas personalizadas
 */
function fjp_rellenar_columnas_donaciones($value, $payment_id, $column_name) {
    switch ($column_name) {
        case 'telefono':
            $telefono = get_post_meta($payment_id, '_give_donor_phone', true);
            return $telefono ?: '—';

        case 'motivo':
            $motivo = get_post_meta($payment_id, '_give_donor_motivo', true);
            $motivos_traducidos = [
                'apoyo-infantil' => 'Apoyo infantil',
                'educacion' => 'Educación',
                'salud' => 'Salud',
                'comunidad' => 'Comunidad',
                'confianza' => 'Confianza',
                'memoria' => 'Memoria',
                'otros' => 'Otros'
            ];
            return isset($motivos_traducidos[$motivo]) ? $motivos_traducidos[$motivo] : '—';
    }

    return $value;
}
add_filter('give_payments_table_column', 'fjp_rellenar_columnas_donaciones', 10, 3);

/**
 * Exportar datos personalizados con el exportador de GiveWP
 */
function fjp_exportar_datos_personalizados($payment_id, $payment) {
    $datos_extra = [];

    $telefono = get_post_meta($payment_id, '_give_donor_phone', true);
    if ($telefono) {
        $datos_extra['telefono'] = $telefono;
    }

    $motivo = get_post_meta($payment_id, '_give_donor_motivo', true);
    if ($motivo) {
        $datos_extra['motivo_donacion'] = $motivo;
    }

    $comentarios = get_post_meta($payment_id, '_give_donor_comentarios', true);
    if ($comentarios) {
        $datos_extra['comentarios'] = $comentarios;
    }

    return $datos_extra;
}
add_filter('give_export_donation_extra_data', 'fjp_exportar_datos_personalizados', 10, 2);