<?php
/**
 * Template Name: Página Quiénes Somos FJP
 * Description: Plantilla personalizada para la página de información sobre la fundación
 *
 * @package FJP
 */

get_header();
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
    <section class="fjp-hero-interior py-5" style="background: linear-gradient(135deg, var(--fjp-primary) 0%, var(--fjp-secondary) 100%);">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center text-white">
                    <h1 class="display-4 fw-bold mb-3">Quiénes Somos</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="/" class="text-white-50">Inicio</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">Quiénes Somos</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección Misión, Visión y Valores -->
    <section class="fjp-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="fjp-mision-card text-center h-100 p-4 rounded-3 bg-light">
                        <div class="mb-3">
                            <i class="fas fa-bullseye fa-3x text-primary"></i>
                        </div>
                        <h3 class="mb-3">Misión</h3>
                        <p class="mb-0">
                            Contribuir al desarrollo sostenible de las comunidades dominicanas mediante programas de educación, salud, medio ambiente y desarrollo comunitario, promoviendo la participación activa de la juventud.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="fjp-vision-card text-center h-100 p-4 rounded-3 bg-light">
                        <div class="mb-3">
                            <i class="fas fa-eye fa-3x text-success"></i>
                        </div>
                        <h3 class="mb-3">Visión</h3>
                        <p class="mb-0">
                            Ser la fundación líder en la República Dominicana en la promoción del desarrollo comunitario sostenible, reconocida por su impacto positivo en la calidad de vida de las personas.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="fjp-valores-card text-center h-100 p-4 rounded-3 bg-light">
                        <div class="mb-3">
                            <i class="fas fa-heart fa-3x text-danger"></i>
                        </div>
                        <h3 class="mb-3">Valores</h3>
                        <ul class="list-unstyled mb-0 text-start">
                            <li><i class="fas fa-check text-success me-2"></i>Compromiso social</li>
                            <li><i class="fas fa-check text-success me-2"></i>Transparencia</li>
                            <li><i class="fas fa-check text-success me-2"></i>Responsabilidad</li>
                            <li><i class="fas fa-check text-success me-2"></i>Trabajo en equipo</li>
                            <li><i class="fas fa-check text-success me-2"></i>Innovación</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline de Historia -->
    <section class="fjp-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="mb-3">Nuestra Historia</h2>
                    <p class="lead">Una trayectoria de compromiso y transformación social</p>
                </div>
            </div>

            <div class="fjp-timeline">
                <div class="fjp-timeline-item">
                    <div class="fjp-timeline-content">
                        <div class="fjp-timeline-date">2016</div>
                        <h4>Fundación de FJP</h4>
                        <p>Nace la Fundación Juventud Progresista con el objetivo de mejorar las condiciones de vida de las comunidades dominicanas.</p>
                    </div>
                </div>

                <div class="fjp-timeline-item">
                    <div class="fjp-timeline-content">
                        <div class="fjp-timeline-date">2017</div>
                        <h4>Primera Gran Campaña</h4>
                        <p>Lanzamos nuestra primera campaña de limpieza de playas con la participación de más de 500 voluntarios.</p>
                    </div>
                </div>

                <div class="fjp-timeline-item">
                    <div class="fjp-timeline-content">
                        <div class="fjp-timeline-date">2018</div>
                        <h4>Expansión Nacional</h4>
                        <p>Ampliamos nuestras operaciones a las 32 provincias del país, consolidando nuestra presencia nacional.</p>
                    </div>
                </div>

                <div class="fjp-timeline-item">
                    <div class="fjp-timeline-content">
                        <div class="fjp-timeline-date">2019</div>
                        <h4>Programa de Educación</h4>
                        <p>Iniciamos el programa "Educación para el Futuro" beneficiando a más de 5,000 estudiantes.</p>
                    </div>
                </div>

                <div class="fjp-timeline-item">
                    <div class="fjp-timeline-content">
                        <div class="fjp-timeline-date">2020</div>
                        <h4>Respuesta COVID-19</h4>
                        <p>En la pandemia, distribuimos más de 50,000 raciones de alimentos y equipos de protección personal.</p>
                    </div>
                </div>

                <div class="fjp-timeline-item">
                    <div class="fjp-timeline-content">
                        <div class="fjp-timeline-date">2021</div>
                        <h4>Alianzas Estratégicas</h4>
                        <p>Establecemos alianzas con organizaciones internacionales ampliando nuestro alcance y recursos.</p>
                    </div>
                </div>

                <div class="fjp-timeline-item">
                    <div class="fjp-timeline-content">
                        <div class="fjp-timeline-date">2022</div>
                        <h4>Reconocimiento Nacional</h4>
                        <p>Recibimos el Premio Nacional de Voluntariado por nuestro impacto en las comunidades.</p>
                    </div>
                </div>

                <div class="fjp-timeline-item">
                    <div class="fjp-timeline-content">
                        <div class="fjp-timeline-date">2023</div>
                        <h4>Nuevas Iniciativas</h4>
                        <p>Lanzamos programas de emprendimiento y desarrollo de habilidades para jóvenes.</p>
                    </div>
                </div>

                <div class="fjp-timeline-item">
                    <div class="fjp-timeline-content">
                        <div class="fjp-timeline-date">2024</div>
                        <h4>Expansión Regional</h4>
                        <p>Iniciamos operaciones en Haití y Puerto Rico, consolidando nuestra presencia caribeña.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Perfil del Fundador -->
    <section class="fjp-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <?php
                    $imagen_fundador = get_field('imagen_fundador');
                    if ($imagen_fundador) : ?>
                        <img src="<?php echo esc_url($imagen_fundador['url']); ?>"
                             alt="<?php echo esc_attr($imagen_fundador['alt']); ?>"
                             class="img-fluid rounded-3 shadow">
                    <?php else : ?>
                        <img src="https://via.placeholder.com/400x400?text=Ing.+Mayker+Méndez"
                             alt="Ing. Mayker Méndez"
                             class="img-fluid rounded-3 shadow">
                    <?php endif; ?>
                </div>

                <div class="col-lg-8">
                    <h2 class="mb-4">Conoce a Nuestro Fundador</h2>
                    <h3 class="text-primary mb-3">Ing. Mayker Méndez</h3>
                    <p class="lead mb-4">
                        Fundador y Presidente de la Fundación Juventud Progresista, ingeniero civil con más de 15 años de experiencia en desarrollo comunitario y gestión de proyectos sociales.
                    </p>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="text-primary">Educación</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-graduation-cap text-success me-2"></i>Ingeniería Civil - PUCMM</li>
                                <li><i class="fas fa-graduation-cap text-success me-2"></i>Maestría en Gestión Social - UASD</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-primary">Reconocimientos</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-trophy text-warning me-2"></i>Premio Nacional de Juventud 2020</li>
                                <li><i class="fas fa-trophy text-warning me-2"></i>Orden al Mérito Ciudadano 2022</li>
                            </ul>
                        </div>
                    </div>

                    <blockquote class="blockquote">
                        <p class="mb-0">
                            "La juventud dominicana tiene un potencial ilimitado. Nuestra misión es proporcionarles las herramientas y oportunidades para que puedan construir un futuro mejor para ellos y sus comunidades."
                        </p>
                        <footer class="blockquote-footer mt-2">
                            <cite title="Ing. Mayker Méndez">Ing. Mayker Méndez</cite>
                        </footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    <!-- Mapa de Impacto -->
    <section class="fjp-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="mb-3">Nuestro Impacto Nacional</h2>
                    <p class="lead">Presencia activa en las 32 provincias de la República Dominicana</p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="fjp-mapa-container text-center">
                        <?php
                        $imagen_mapa = get_field('imagen_mapa_impacto');
                        if ($imagen_mapa) : ?>
                            <img src="<?php echo esc_url($imagen_mapa['url']); ?>"
                                 alt="Mapa de impacto FJP"
                                 class="img-fluid rounded-3 shadow mb-4">
                        <?php else : ?>
                            <img src="https://via.placeholder.com/800x500?text=Mapa+de+Impacto+FJP"
                                 alt="Mapa de impacto FJP"
                                 class="img-fluid rounded-3 shadow mb-4">
                        <?php endif; ?>

                        <div class="row">
                            <div class="col-md-4 text-center">
                                <div class="fjp-impacto-stat">
                                    <h3 class="text-primary">32</h3>
                                    <p>Provincias cubiertas</p>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="fjp-impacto-stat">
                                    <h3 class="text-success">150+</h3>
                                    <p>Comunidades beneficiadas</p>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="fjp-impacto-stat">
                                    <h3 class="text-danger">50,000+</h3>
                                    <p>Personas impactadas</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección Testimonios -->
    <section class="fjp-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="mb-3">Testimonios</h2>
                    <p class="lead">Lo que dicen quienes han trabajado con nosotros</p>
                </div>
            </div>

            <div class="row">
                <?php
                $testimonios = new WP_Query(array(
                    'post_type' => 'testimonios',
                    'posts_per_page' => 3,
                    'orderby' => 'rand'
                ));

                if ($testimonios->have_posts()) :
                    while ($testimonios->have_posts()) : $testimonios->the_post();
                        $cargo = get_field('cargo_testimonio');
                        $organizacion = get_field('organizacion_testimonio');
                        ?>
                        <div class="col-md-4 mb-4">
                            <div class="fjp-testimonio-card text-center p-4 bg-light rounded-3">
                                <div class="mb-3">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('fjp-testimonio', array('class' => 'rounded-circle mb-3')); ?>
                                    <?php else : ?>
                                        <i class="fas fa-user-circle fa-4x text-primary mb-3"></i>
                                    <?php endif; ?>
                                </div>
                                <blockquote class="blockquote">
                                    <p>"<?php echo wp_trim_words(get_the_content(), 30); ?>"</p>
                                </blockquote>
                                <h5 class="mb-1"><?php the_title(); ?></h5>
                                <?php if ($cargo) : ?>
                                    <p class="text-muted mb-1"><?php echo esc_html($cargo); ?></p>
                                <?php endif; ?>
                                <?php if ($organizacion) : ?>
                                    <p class="text-muted"><?php echo esc_html($organizacion); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <div class="col-12 text-center">
                        <p>Próximamente compartiremos testimonios de quienes han colaborado con nosotros.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Sección CTA -->
    <section class="fjp-section bg-gradient text-white">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="mb-4 text-white">¿Quieres conocer más sobre nuestro trabajo?</h2>
                    <p class="lead mb-4">
                        Contáctanos y con gusto te brindaremos más información sobre nuestras actividades y cómo puedes participar.
                    </p>
                    <a href="/contacto" class="btn btn-light btn-lg">
                        <i class="fas fa-envelope me-2"></i>Contáctanos
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?php } // Fin del fallback ?>

</main>

<?php get_footer(); ?>