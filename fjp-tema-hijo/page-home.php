<?php
/**
 * Template Name: Página Home FJP
 * Description: Plantilla personalizada para la página principal de FJP con soporte híbrido (Bloques + Fallback)
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
        // Fallback: Contenido por defecto construido dinámicamente

        // Datos del Hero
        $hero_titulo = get_field('hero_titulo') ?: 'Juntos construyendo un futuro mejor';
        $hero_desc = get_field('hero_descripcion') ?: 'La Fundación Juventud Progresista trabaja incansablemente para el desarrollo sostenible de nuestras comunidades.';
        $hero_img = get_field('hero_imagen');
        $hero_bg = $hero_img ? $hero_img['url'] : ''; // Usar imagen de ACF o dejar que CSS maneje el gradiente

        // Datos de Impacto (Hardcoded defaults si no hay ACF)
        $impact_1 = get_field('impacto_numero_1') ?: '50+';
        $impact_txt_1 = get_field('impacto_texto_1') ?: 'Comunidades';
        $impact_2 = get_field('impacto_numero_2') ?: '10k+';
        $impact_txt_2 = get_field('impacto_texto_2') ?: 'Beneficiarios';
        $impact_3 = get_field('impacto_numero_3') ?: '500+';
        $impact_txt_3 = get_field('impacto_texto_3') ?: 'Voluntarios';
    ?>

    <!-- Hero Section Default -->
    <section class="fjp-hero py-5 d-flex align-items-center" style="min-height: 80vh; background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('<?php echo esc_url($hero_bg); ?>'); background-size: cover; background-position: center; background-color: var(--fjp-primary);">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 text-white">
                    <h1 class="display-3 fw-bold mb-4 animate__animated animate__fadeInDown"><?php echo esc_html($hero_titulo); ?></h1>
                    <p class="lead mb-5 animate__animated animate__fadeInUp animate__delay-1s"><?php echo esc_html($hero_desc); ?></p>
                    <div class="d-flex justify-content-center gap-3 animate__animated animate__fadeInUp animate__delay-2s">
                        <a href="/donaciones" class="btn btn-primary btn-lg px-4 py-3 rounded-pill fw-bold shadow">
                            <i class="fas fa-heart me-2"></i>Donar Ahora
                        </a>
                        <a href="/voluntariado" class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill fw-bold">
                            <i class="fas fa-hands-helping me-2"></i>Ser Voluntario
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Impacto (Contadores) -->
    <section class="fjp-section bg-light py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="fjp-counter-item p-4 bg-white rounded-3 shadow-sm h-100">
                        <i class="fas fa-globe-americas fa-3x text-primary mb-3"></i>
                        <h3 class="display-4 fw-bold fjp-counter-number" data-target="<?php echo esc_attr(filter_var($impact_1, FILTER_SANITIZE_NUMBER_INT)); ?>"><?php echo esc_html($impact_1); ?></h3>
                        <p class="text-muted text-uppercase fw-bold ls-1"><?php echo esc_html($impact_txt_1); ?></p>
                    </div>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="fjp-counter-item p-4 bg-white rounded-3 shadow-sm h-100">
                        <i class="fas fa-users fa-3x text-success mb-3"></i>
                        <h3 class="display-4 fw-bold fjp-counter-number" data-target="<?php echo esc_attr(filter_var($impact_2, FILTER_SANITIZE_NUMBER_INT)); ?>"><?php echo esc_html($impact_2); ?></h3>
                        <p class="text-muted text-uppercase fw-bold ls-1"><?php echo esc_html($impact_txt_2); ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fjp-counter-item p-4 bg-white rounded-3 shadow-sm h-100">
                        <i class="fas fa-hand-holding-heart fa-3x text-warning mb-3"></i>
                        <h3 class="display-4 fw-bold fjp-counter-number" data-target="<?php echo esc_attr(filter_var($impact_3, FILTER_SANITIZE_NUMBER_INT)); ?>"><?php echo esc_html($impact_3); ?></h3>
                        <p class="text-muted text-uppercase fw-bold ls-1"><?php echo esc_html($impact_txt_3); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección "Sobre Nosotros" Resumen -->
    <section class="fjp-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="https://via.placeholder.com/600x400?text=Sobre+FJP" class="img-fluid rounded-3 shadow" alt="Sobre FJP">
                </div>
                <div class="col-lg-6">
                    <h2 class="mb-4 fw-bold text-dark">Nuestra Misión</h2>
                    <p class="lead text-muted mb-4">
                        Somos una organización sin fines de lucro dedicada a empoderar a la juventud y fomentar el desarrollo integral de las comunidades más vulnerables.
                    </p>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Educación de calidad</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Salud y bienestar</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Medio ambiente y sostenibilidad</li>
                    </ul>
                    <a href="/quienes-somos" class="btn btn-outline-primary rounded-pill px-4">Conoce más sobre nosotros</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Noticias Recientes -->
    <section class="fjp-section bg-light py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="fw-bold">Últimas Noticias</h2>
                    <p class="text-muted">Mantente informado sobre nuestras actividades y logros</p>
                </div>
            </div>
            <div class="row">
                <?php
                // Query para noticias
                $news_query = new WP_Query(array(
                    'post_type' => 'noticias', // Asumiendo CPT 'noticias' o 'post'
                    'posts_per_page' => 3
                ));

                if (!$news_query->have_posts()) {
                    // Fallback a posts normales si no hay CPT noticias
                    $news_query = new WP_Query(array(
                        'post_type' => 'post',
                        'posts_per_page' => 3
                    ));
                }

                if ($news_query->have_posts()) :
                    while ($news_query->have_posts()) : $news_query->the_post();
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm transition-hover">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="card-img-top overflow-hidden" style="height: 200px;">
                                <?php the_post_thumbnail('medium', array('class' => 'img-fluid w-100 h-100 object-fit-cover')); ?>
                            </div>
                        <?php else : ?>
                            <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center text-white" style="height: 200px;">
                                <i class="far fa-newspaper fa-3x"></i>
                            </div>
                        <?php endif; ?>
                        <div class="card-body p-4">
                            <div class="small text-muted mb-2">
                                <i class="far fa-calendar-alt me-1"></i> <?php echo get_the_date(); ?>
                            </div>
                            <h5 class="card-title fw-bold mb-3">
                                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark stretched-link">
                                    <?php the_title(); ?>
                                </a>
                            </h5>
                            <p class="card-text text-muted small">
                                <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<div class="col-12 text-center"><p>No hay noticias recientes.</p></div>';
                endif;
                ?>
            </div>
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <a href="/noticias" class="btn btn-primary rounded-pill px-4">Ver todas las noticias</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Alianzas -->
    <section class="fjp-section py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="fw-bold">Nuestros Aliados</h2>
                </div>
            </div>
            <div class="row justify-content-center align-items-center grayscale-logos">
                <!-- Logos de aliados (hardcoded placeholders o dinámicos) -->
                <div class="col-6 col-md-3 col-lg-2 mb-4 text-center">
                    <img src="https://via.placeholder.com/150x80?text=Aliado+1" class="img-fluid opacity-50 hover-opacity-100" alt="Aliado 1">
                </div>
                <div class="col-6 col-md-3 col-lg-2 mb-4 text-center">
                    <img src="https://via.placeholder.com/150x80?text=Aliado+2" class="img-fluid opacity-50 hover-opacity-100" alt="Aliado 2">
                </div>
                <div class="col-6 col-md-3 col-lg-2 mb-4 text-center">
                    <img src="https://via.placeholder.com/150x80?text=Aliado+3" class="img-fluid opacity-50 hover-opacity-100" alt="Aliado 3">
                </div>
                <div class="col-6 col-md-3 col-lg-2 mb-4 text-center">
                    <img src="https://via.placeholder.com/150x80?text=Aliado+4" class="img-fluid opacity-50 hover-opacity-100" alt="Aliado 4">
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Final -->
    <section class="fjp-cta py-5 bg-dark text-white text-center">
        <div class="container">
            <h2 class="mb-3">¿Listo para unirte al cambio?</h2>
            <p class="lead mb-4 text-white-50">Tu apoyo hace posible nuestra misión.</p>
            <a href="/donaciones" class="btn btn-primary btn-lg rounded-pill px-5">Haz tu aporte hoy</a>
        </div>
    </section>

    <?php } // Fin del fallback ?>

</main>

<?php get_footer(); ?>