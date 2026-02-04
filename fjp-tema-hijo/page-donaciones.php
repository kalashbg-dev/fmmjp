<?php
/**
 * Template Name: Página Donaciones FJP
 * Description: Plantilla personalizada para la página de donaciones con integración GiveWP
 *
 * @package FJP
 */

get_header();

// Verificar si GiveWP está activo
$givewp_active = class_exists('Give');
?>

<div id="primary" <?php astra_primary_class(); ?>>
    <main id="main" class="site-main">

    <?php
    // Comprobar si hay contenido en el editor de bloques (Gutenberg)
    if ( have_posts() && get_the_content() ) {
        while ( have_posts() ) {
            the_post();
            the_content();
        }
    } else {
        // Fallback: Contenido original estático si no hay bloques
    ?>

    <!-- Hero Section Interior -->
    <section class="fjp-hero-interior py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center text-white">
                    <h1 class="display-4 fw-bold mb-3"><?php _e('Haz una Donación', 'fjp'); ?></h1>
                    <p class="lead mb-0"><?php _e('Tu aporte nos permite continuar transformando vidas', 'fjp'); ?></p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="/" class="text-white-50"><?php _e('Inicio', 'fjp'); ?></a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page"><?php _e('Donaciones', 'fjp'); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Información de Donaciones -->
    <section class="fjp-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="mb-3"><?php _e('¿Cómo puedes ayudar?', 'fjp'); ?></h2>
                    <p class="lead"><?php _e('Tu donación, por pequeña que sea, tiene un impacto significativo', 'fjp'); ?></p>
                </div>
            </div>

            <!-- Estadísticas de Impacto -->
            <div class="row mb-5">
                <div class="col-md-3 mb-4 mb-md-0">
                    <div class="fjp-impact-stat text-center">
                        <h3 class="text-primary">RD$500</h3>
                        <p><?php _e('Alimenta a una familia por una semana', 'fjp'); ?></p>
                    </div>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <div class="fjp-impact-stat text-center">
                        <h3 class="text-success">RD$1,000</h3>
                        <p><?php _e('Proporciona útiles escolares a 5 niños', 'fjp'); ?></p>
                    </div>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <div class="fjp-impact-stat text-center">
                        <h3 class="text-info">RD$2,500</h3>
                        <p><?php _e('Planta 50 árboles en áreas verdes', 'fjp'); ?></p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="fjp-impact-stat text-center">
                        <h3 class="text-warning">RD$5,000</h3>
                        <p><?php _e('Capacita a 10 jóvenes en oficios', 'fjp'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Formulario de Donación GiveWP -->
    <section class="fjp-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="fjp-donation-form-wrapper p-4 bg-white rounded-3 shadow">
                        <div class="text-center mb-4">
                            <h3 class="mb-3"><?php _e('Realiza tu donación ahora', 'fjp'); ?></h3>
                            <p class="text-muted"><?php _e('Es rápido, seguro y confidencial', 'fjp'); ?></p>
                        </div>

                        <?php if ($givewp_active) : ?>
                            <?php
                            // Obtener el ID del formulario de donación principal
                            $form_id = get_field('givewp_form_id', get_the_ID());
                            if (!$form_id) {
                                // Si no hay formulario especificado, usar el primero disponible
                                $forms = get_posts(array(
                                    'post_type' => 'give_forms',
                                    'posts_per_page' => 1,
                                    'post_status' => 'publish'
                                ));
                                $form_id = !empty($forms) ? $forms[0]->ID : 0;
                            }

                            if ($form_id) {
                                echo do_shortcode('[give_form id="' . $form_id . '"]');
                            } else {
                                echo '<div class="alert alert-info">' . __('No hay formularios de donación disponibles. Por favor, contacta al administrador.', 'fjp') . '</div>';
                            }
                            ?>
                        <?php else : ?>
                            <div class="alert alert-warning">
                                <h5><?php _e('¡Importante!', 'fjp'); ?></h5>
                                <p><?php _e('El plugin GiveWP no está activo. Para procesar donaciones, necesitas instalar y activar GiveWP.', 'fjp'); ?></p>

                                <!-- Formulario alternativo temporal -->
                                <div class="fjp-alternative-donation-form">
                                    <h6 class="mb-3"><?php _e('Métodos de donación disponibles:', 'fjp'); ?></h6>

                                    <!-- PayPal -->
                                    <div class="donation-method mb-3 p-3 border rounded">
                                        <h6><i class="fab fa-paypal text-primary me-2"></i>PayPal</h6>
                                        <p class="small text-muted mb-2"><?php _e('Donaciones seguras vía PayPal', 'fjp'); ?></p>
                                        <a href="https://www.paypal.com/donate?hosted_button_id=YOUR_BUTTON_ID"
                                           target="_blank"
                                           class="btn btn-outline-primary btn-sm">
                                            <?php _e('Donar con PayPal', 'fjp'); ?>
                                        </a>
                                    </div>

                                    <!-- Transferencia Bancaria -->
                                    <div class="donation-method mb-3 p-3 border rounded">
                                        <h6><i class="fas fa-university text-success me-2"></i><?php _e('Transferencia Bancaria', 'fjp'); ?></h6>
                                        <p class="small text-muted mb-2">Banco Popular Dominicano</p>
                                        <div class="bank-details small">
                                            <strong><?php _e('Cuenta:', 'fjp'); ?></strong> 1234567890<br>
                                            <strong><?php _e('Nombre:', 'fjp'); ?></strong> Fundación Juventud Progresista<br>
                                            <strong><?php _e('RNC:', 'fjp'); ?></strong> 123456789
                                        </div>
                                    </div>

                                    <!-- Patreon -->
                                    <div class="donation-method mb-3 p-3 border rounded">
                                        <h6><i class="fab fa-patreon text-danger me-2"></i>Patreon</h6>
                                        <p class="small text-muted mb-2"><?php _e('Apoyo mensual recurrente', 'fjp'); ?></p>
                                        <a href="https://www.patreon.com/fundacionjuventudprogresista"
                                           target="_blank"
                                           class="btn btn-outline-danger btn-sm">
                                            <?php _e('Convertirme en Patrocinador', 'fjp'); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tipos de Donaciones -->
    <section class="fjp-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="mb-3"><?php _e('Tipos de Donaciones', 'fjp'); ?></h2>
                    <p class="lead"><?php _e('Elige la opción que mejor se adapte a ti', 'fjp'); ?></p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="fjp-donation-type text-center p-4 bg-light rounded-3 h-100">
                        <div class="mb-3">
                            <i class="fas fa-heart fa-3x text-danger"></i>
                        </div>
                        <h4 class="mb-3"><?php _e('Donación Única', 'fjp'); ?></h4>
                        <p class="mb-4"><?php _e('Haz una donación puntual de cualquier monto. Cada aporte cuenta y tiene un impacto directo en nuestras comunidades.', 'fjp'); ?></p>
                        <ul class="list-unstyled text-start mb-4">
                            <li><i class="fas fa-check text-success me-2"></i><?php _e('Proceso rápido y seguro', 'fjp'); ?></li>
                            <li><i class="fas fa-check text-success me-2"></i><?php _e('Recibo de donación', 'fjp'); ?></li>
                            <li><i class="fas fa-check text-success me-2"></i><?php _e('Actualizaciones del impacto', 'fjp'); ?></li>
                        </ul>
                        <?php if ($givewp_active) : ?>
                            <a href="#give-form" class="btn btn-primary"><?php _e('Donar Ahora', 'fjp'); ?></a>
                        <?php else : ?>
                            <a href="https://www.paypal.com/donate?hosted_button_id=YOUR_BUTTON_ID"
                               target="_blank"
                               class="btn btn-primary"><?php _e('Donar Ahora', 'fjp'); ?></a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="fjp-donation-type text-center p-4 bg-light rounded-3 h-100">
                        <div class="mb-3">
                            <i class="fas fa-sync-alt fa-3x text-primary"></i>
                        </div>
                        <h4 class="mb-3"><?php _e('Donación Mensual', 'fjp'); ?></h4>
                        <p class="mb-4"><?php _e('Conviértete en donante recurrente. Tu apoyo constante nos permite planificar proyectos a largo plazo.', 'fjp'); ?></p>
                        <ul class="list-unstyled text-start mb-4">
                            <li><i class="fas fa-check text-success me-2"></i><?php _e('Mayor impacto sostenido', 'fjp'); ?></li>
                            <li><i class="fas fa-check text-success me-2"></i><?php _e('Reportes trimestrales', 'fjp'); ?></li>
                            <li><i class="fas fa-check text-success me-2"></i><?php _e('Beneficios fiscales', 'fjp'); ?></li>
                        </ul>
                        <?php if ($givewp_active) : ?>
                            <a href="#give-form" class="btn btn-primary"><?php _e('Hacerme Donante Mensual', 'fjp'); ?></a>
                        <?php else : ?>
                            <a href="https://www.patreon.com/fundacionjuventudprogresista"
                               target="_blank"
                               class="btn btn-primary"><?php _e('Hacerme Donante Mensual', 'fjp'); ?></a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="fjp-donation-type text-center p-4 bg-light rounded-3 h-100">
                        <div class="mb-3">
                            <i class="fas fa-gift fa-3x text-success"></i>
                        </div>
                        <h4 class="mb-3"><?php _e('Donación en Especie', 'fjp'); ?></h4>
                        <p class="mb-4"><?php _e('Contribuye con bienes, servicios o tu tiempo. Tu experiencia y recursos son valiosos para nuestra causa.', 'fjp'); ?></p>
                        <ul class="list-unstyled text-start mb-4">
                            <li><i class="fas fa-check text-success me-2"></i><?php _e('Equipos y materiales', 'fjp'); ?></li>
                            <li><i class="fas fa-check text-success me-2"></i><?php _e('Servicios profesionales', 'fjp'); ?></li>
                            <li><i class="fas fa-check text-success me-2"></i><?php _e('Voluntariado corporativo', 'fjp'); ?></li>
                        </ul>
                        <a href="/contacto" class="btn btn-primary"><?php _e('Contactar', 'fjp'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Preguntas Frecuentes -->
    <section class="fjp-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="mb-3"><?php _e('Preguntas Frecuentes', 'fjp'); ?></h2>
                    <p class="lead"><?php _e('Resolvemos tus dudas sobre el proceso de donación', 'fjp'); ?></p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="donationFAQ">
                        <div class="accordion-item mb-3 border-0 shadow-sm">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                    <?php _e('¿Es seguro donar en línea?', 'fjp'); ?>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#donationFAQ">
                                <div class="accordion-body">
                                    <?php _e('Sí, absolutamente. Utilizamos tecnología de encriptación SSL y procesamos los pagos a través de plataformas seguras como PayPal y Stripe. Tu información financiera nunca es almacenada en nuestros servidores.', 'fjp'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mb-3 border-0 shadow-sm">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                    <?php _e('¿Puedo obtener un recibo de mi donación?', 'fjp'); ?>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#donationFAQ">
                                <div class="accordion-body">
                                    <?php _e('Sí, todos nuestros donantes reciben un recibo oficial por email inmediatamente después de completar su donación. Este recibo puede ser utilizado para fines fiscales.', 'fjp'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mb-3 border-0 shadow-sm">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                    <?php _e('¿Cómo se utilizan las donaciones?', 'fjp'); ?>
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#donationFAQ">
                                <div class="accordion-body">
                                    <?php _e('El 85% de las donaciones se destina directamente a nuestros programas (educación, salud, medio ambiente, desarrollo comunitario). El 15% restante cubre gastos administrativos necesarios para mantener la organización funcionando.', 'fjp'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mb-3 border-0 shadow-sm">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                    <?php _e('¿Puedo cancelar mi donación mensual?', 'fjp'); ?>
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#donationFAQ">
                                <div class="accordion-body">
                                    <?php _e('Sí, puedes cancelar tu donación mensual en cualquier momento. Solo tienes que enviarnos un email a info@fundacionjuventudprogresista.org o acceder a tu cuenta de donante.', 'fjp'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Final -->
    <section class="fjp-section bg-gradient text-white">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="mb-4 text-white"><?php _e('¿Listo para hacer la diferencia?', 'fjp'); ?></h2>
                    <p class="lead mb-4">
                        <?php _e('Tu donación, sin importar el monto, tiene el poder de transformar vidas y construir un futuro mejor.', 'fjp'); ?>
                    </p>
                    <div class="d-flex flex-column flex-md-row justify-content-center gap-3">
                        <?php if ($givewp_active) : ?>
                            <a href="#give-form" class="btn btn-light btn-lg">
                                <i class="fas fa-heart me-2"></i><?php _e('Donar Ahora', 'fjp'); ?>
                            </a>
                        <?php else : ?>
                            <a href="https://www.paypal.com/donate?hosted_button_id=YOUR_BUTTON_ID"
                               target="_blank"
                               class="btn btn-light btn-lg">
                                <i class="fas fa-heart me-2"></i><?php _e('Donar Ahora', 'fjp'); ?>
                            </a>
                        <?php endif; ?>
                        <a href="/contacto" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-question-circle me-2"></i><?php _e('Tengo Preguntas', 'fjp'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php } // Fin del fallback ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>