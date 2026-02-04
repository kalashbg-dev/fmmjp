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

<main id="primary" class="site-main">

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
    <section class="fjp-hero-interior py-5" style="background: linear-gradient(135deg, var(--fjp-secondary) 0%, var(--fjp-primary) 100%);">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center text-white">
                    <h1 class="display-4 fw-bold mb-3">Haz una Donación</h1>
                    <p class="lead mb-0">Tu aporte nos permite continuar transformando vidas</p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="/" class="text-white-50">Inicio</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">Donaciones</li>
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
                    <h2 class="mb-3">¿Cómo puedes ayudar?</h2>
                    <p class="lead">Tu donación, por pequeña que sea, tiene un impacto significativo</p>
                </div>
            </div>

            <!-- Estadísticas de Impacto -->
            <div class="row mb-5">
                <div class="col-md-3 mb-4 mb-md-0">
                    <div class="fjp-impact-stat text-center">
                        <h3 class="text-primary">RD$500</h3>
                        <p>Alimenta a una familia por una semana</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <div class="fjp-impact-stat text-center">
                        <h3 class="text-success">RD$1,000</h3>
                        <p>Proporciona útiles escolares a 5 niños</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <div class="fjp-impact-stat text-center">
                        <h3 class="text-info">RD$2,500</h3>
                        <p>Planta 50 árboles en áreas verdes</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="fjp-impact-stat text-center">
                        <h3 class="text-warning">RD$5,000</h3>
                        <p>Capacita a 10 jóvenes en oficios</p>
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
                            <h3 class="mb-3">Realiza tu donación ahora</h3>
                            <p class="text-muted">Es rápido, seguro y confidencial</p>
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
                                echo '<div class="alert alert-info">No hay formularios de donación disponibles. Por favor, contacta al administrador.</div>';
                            }
                            ?>
                        <?php else : ?>
                            <div class="alert alert-warning">
                                <h5>¡Importante!</h5>
                                <p>El plugin GiveWP no está activo. Para procesar donaciones, necesitas instalar y activar GiveWP.</p>

                                <!-- Formulario alternativo temporal -->
                                <div class="fjp-alternative-donation-form">
                                    <h6 class="mb-3">Métodos de donación disponibles:</h6>

                                    <!-- PayPal -->
                                    <div class="donation-method mb-3 p-3 border rounded">
                                        <h6><i class="fab fa-paypal text-primary me-2"></i>PayPal</h6>
                                        <p class="small text-muted mb-2">Donaciones seguras vía PayPal</p>
                                        <a href="https://www.paypal.com/donate?hosted_button_id=YOUR_BUTTON_ID"
                                           target="_blank"
                                           class="btn btn-outline-primary btn-sm">
                                            Donar con PayPal
                                        </a>
                                    </div>

                                    <!-- Transferencia Bancaria -->
                                    <div class="donation-method mb-3 p-3 border rounded">
                                        <h6><i class="fas fa-university text-success me-2"></i>Transferencia Bancaria</h6>
                                        <p class="small text-muted mb-2">Banco Popular Dominicano</p>
                                        <div class="bank-details small">
                                            <strong>Cuenta:</strong> 1234567890<br>
                                            <strong>Nombre:</strong> Fundación Juventud Progresista<br>
                                            <strong>RNC:</strong> 123456789
                                        </div>
                                    </div>

                                    <!-- Patreon -->
                                    <div class="donation-method mb-3 p-3 border rounded">
                                        <h6><i class="fab fa-patreon text-danger me-2"></i>Patreon</h6>
                                        <p class="small text-muted mb-2">Apoyo mensual recurrente</p>
                                        <a href="https://www.patreon.com/fundacionjuventudprogresista"
                                           target="_blank"
                                           class="btn btn-outline-danger btn-sm">
                                            Convertirme en Patrocinador
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
                    <h2 class="mb-3">Tipos de Donaciones</h2>
                    <p class="lead">Elige la opción que mejor se adapte a ti</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="fjp-donation-type text-center p-4 bg-light rounded-3 h-100">
                        <div class="mb-3">
                            <i class="fas fa-heart fa-3x text-danger"></i>
                        </div>
                        <h4 class="mb-3">Donación Única</h4>
                        <p class="mb-4">Haz una donación puntual de cualquier monto. Cada aporte cuenta y tiene un impacto directo en nuestras comunidades.</p>
                        <ul class="list-unstyled text-start mb-4">
                            <li><i class="fas fa-check text-success me-2"></i>Proceso rápido y seguro</li>
                            <li><i class="fas fa-check text-success me-2"></i>Recibo de donación</li>
                            <li><i class="fas fa-check text-success me-2"></i>Actualizaciones del impacto</li>
                        </ul>
                        <?php if ($givewp_active) : ?>
                            <a href="#give-form" class="btn btn-primary">Donar Ahora</a>
                        <?php else : ?>
                            <a href="https://www.paypal.com/donate?hosted_button_id=YOUR_BUTTON_ID"
                               target="_blank"
                               class="btn btn-primary">Donar Ahora</a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="fjp-donation-type text-center p-4 bg-light rounded-3 h-100">
                        <div class="mb-3">
                            <i class="fas fa-sync-alt fa-3x text-primary"></i>
                        </div>
                        <h4 class="mb-3">Donación Mensual</h4>
                        <p class="mb-4">Conviértete en donante recurrente. Tu apoyo constante nos permite planificar proyectos a largo plazo.</p>
                        <ul class="list-unstyled text-start mb-4">
                            <li><i class="fas fa-check text-success me-2"></i>Mayor impacto sostenido</li>
                            <li><i class="fas fa-check text-success me-2"></i>Reportes trimestrales</li>
                            <li><i class="fas fa-check text-success me-2"></i>Beneficios fiscales</li>
                        </ul>
                        <?php if ($givewp_active) : ?>
                            <a href="#give-form" class="btn btn-primary">Hacerme Donante Mensual</a>
                        <?php else : ?>
                            <a href="https://www.patreon.com/fundacionjuventudprogresista"
                               target="_blank"
                               class="btn btn-primary">Hacerme Donante Mensual</a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="fjp-donation-type text-center p-4 bg-light rounded-3 h-100">
                        <div class="mb-3">
                            <i class="fas fa-gift fa-3x text-success"></i>
                        </div>
                        <h4 class="mb-3">Donación en Especie</h4>
                        <p class="mb-4">Contribuye con bienes, servicios o tu tiempo. Tu experiencia y recursos son valiosos para nuestra causa.</p>
                        <ul class="list-unstyled text-start mb-4">
                            <li><i class="fas fa-check text-success me-2"></i>Equipos y materiales</li>
                            <li><i class="fas fa-check text-success me-2"></i>Servicios profesionales</li>
                            <li><i class="fas fa-check text-success me-2"></i>Voluntariado corporativo</li>
                        </ul>
                        <a href="/contacto" class="btn btn-primary">Contactar</a>
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
                    <h2 class="mb-3">Preguntas Frecuentes</h2>
                    <p class="lead">Resolvemos tus dudas sobre el proceso de donación</p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="donationFAQ">
                        <div class="accordion-item mb-3 border-0 shadow-sm">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                    ¿Es seguro donar en línea?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#donationFAQ">
                                <div class="accordion-body">
                                    Sí, absolutamente. Utilizamos tecnología de encriptación SSL y procesamos los pagos a través de plataformas seguras como PayPal y Stripe. Tu información financiera nunca es almacenada en nuestros servidores.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mb-3 border-0 shadow-sm">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                    ¿Puedo obtener un recibo de mi donación?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#donationFAQ">
                                <div class="accordion-body">
                                    Sí, todos nuestros donantes reciben un recibo oficial por email inmediatamente después de completar su donación. Este recibo puede ser utilizado para fines fiscales.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mb-3 border-0 shadow-sm">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                    ¿Cómo se utilizan las donaciones?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#donationFAQ">
                                <div class="accordion-body">
                                    El 85% de las donaciones se destina directamente a nuestros programas (educación, salud, medio ambiente, desarrollo comunitario). El 15% restante cubre gastos administrativos necesarios para mantener la organización funcionando.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mb-3 border-0 shadow-sm">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                    ¿Puedo cancelar mi donación mensual?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#donationFAQ">
                                <div class="accordion-body">
                                    Sí, puedes cancelar tu donación mensual en cualquier momento. Solo tienes que enviarnos un email a info@fundacionjuventudprogresista.org o acceder a tu cuenta de donante.
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
                    <h2 class="mb-4 text-white">¿Listo para hacer la diferencia?</h2>
                    <p class="lead mb-4">
                        Tu donación, sin importar el monto, tiene el poder de transformar vidas y construir un futuro mejor.
                    </p>
                    <div class="d-flex flex-column flex-md-row justify-content-center gap-3">
                        <?php if ($givewp_active) : ?>
                            <a href="#give-form" class="btn btn-light btn-lg">
                                <i class="fas fa-heart me-2"></i>Donar Ahora
                            </a>
                        <?php else : ?>
                            <a href="https://www.paypal.com/donate?hosted_button_id=YOUR_BUTTON_ID"
                               target="_blank"
                               class="btn btn-light btn-lg">
                                <i class="fas fa-heart me-2"></i>Donar Ahora
                            </a>
                        <?php endif; ?>
                        <a href="/contacto" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-question-circle me-2"></i>Tengo Preguntas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php } // Fin del fallback ?>

</main>

<?php get_footer(); ?>