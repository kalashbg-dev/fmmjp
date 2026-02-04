<?php
/**
 * Plantilla para la página de Voluntariado
 * Template Name: Página Voluntariado
 * @package FJP
 */

get_header();

// Verificar si hay contenido en el editor de bloques
if ( have_posts() && get_the_content() ) {
    while ( have_posts() ) {
        the_post();
        the_content();
    }
} else {
    // Fallback: Contenido original estático

    // Obtener datos de ACF si existen
    $hero_titulo = get_field('voluntariado_hero_titulo') ?: 'Sumate como voluntario/a';
    $hero_descripcion = get_field('voluntariado_hero_descripcion') ?: 'Formá parte de nuestro equipo de voluntarios y ayudanos a construir una comunidad más justa y solidaria.';
    $hero_imagen = get_field('voluntariado_hero_imagen');

    $beneficios = get_field('voluntariado_beneficios') ?: [
        [
            'titulo' => 'Desarrollo personal',
            'descripcion' => 'Adquirí nuevas habilidades y experiencias valiosas.',
            'icono' => 'fas fa-user-plus'
        ],
        [
            'titulo' => 'Networking',
            'descripcion' => 'Conocé personas con tus mismos valores e intereses.',
            'icono' => 'fas fa-users'
        ],
        [
            'titulo' => 'Impacto social',
            'descripcion' => 'Contribuí al bienestar de niños, niñas y adolescentes.',
            'icono' => 'fas fa-heart'
        ]
    ];

    $areas_voluntariado = get_field('voluntariado_areas') ?: [
        [
            'titulo' => 'Acompañamiento educativo',
            'descripcion' => 'Ayudá a niños y niñas con sus tareas escolares y actividades de refuerzo.',
            'icono' => 'fas fa-graduation-cap',
            'requisitos' => 'Secundario completo, disponibilidad horaria, vocación docente.'
        ],
        [
            'titulo' => 'Deportes y recreación',
            'descripcion' => 'Acompañá en actividades deportivas y recreativas.',
            'icono' => 'fas fa-running',
            'requisitos' => 'Conocimientos básicos de deportes, buena condición física.'
        ],
        [
            'titulo' => 'Arte y cultura',
            'descripcion' => 'Colaborá en talleres de arte, música, teatro y manualidades.',
            'icono' => 'fas fa-palette',
            'requisitos' => 'Creatividad, habilidades artísticas, entusiasmo.'
        ],
        [
            'titulo' => 'Apoyo administrativo',
            'descripcion' => 'Ayudá con tareas administrativas y organización de eventos.',
            'icono' => 'fas fa-laptop',
            'requisitos' => 'Conocimientos básicos de computación, organización.'
        ]
    ];

    $testimonios = get_field('voluntariado_testimonios') ?: [
        [
            'nombre' => 'María González',
            'cargo' => 'Voluntaria educativa',
            'testimonio' => 'Ser voluntaria me permitió descubrir una pasión por la enseñanza que no sabía que tenía. Ver el progreso de los chicos es muy gratificante.',
            'imagen' => ''
        ],
        [
            'nombre' => 'Carlos Rodríguez',
            'cargo' => 'Voluntario deportivo',
            'testimonio' => 'Compartir mi amor por el deporte con los chicos es maravilloso. Verlos disfrutar y crecer a través del juego es muy satisfactorio.',
            'imagen' => ''
        ],
        [
            'nombre' => 'Ana Martínez',
            'cargo' => 'Voluntaria artística',
            'testimonio' => 'El arte tiene un poder transformador increíble. Ver cómo los chicos se expresan y crecen a través de la creatividad es maravilloso.',
            'imagen' => ''
        ]
    ];

    $preguntas_frecuentes = get_field('voluntariado_faq') ?: [
        [
            'pregunta' => '¿Cuántas horas por semana debo comprometerme?',
            'respuesta' => 'La cantidad de horas es flexible y se adapta a tu disponibilidad. Puede ser desde 2 horas semanales hasta varios días, dependiendo del área y tu tiempo disponible.'
        ],
        [
            'pregunta' => '¿Necesito experiencia previa?',
            'respuesta' => 'No necesariamente. Proporcionamos capacitación inicial y acompañamiento continuo. Lo más importante es tu actitud y disposición para ayudar.'
        ],
        [
            'pregunta' => '¿Hay algún costo para ser voluntario?',
            'respuesta' => 'No, el voluntariado es gratuito. Solo necesitamos tu compromiso y tiempo. Cubrimos los materiales y capacitación necesarios.'
        ],
        [
            'pregunta' => '¿Puedo elegir el horario y día?',
            'respuesta' => 'Sí, trabajamos juntos para encontrar un horario que se adapte tanto a tu disponibilidad como a las necesidades del programa.'
        ]
    ];

    $contacto_info = get_field('voluntariado_contacto') ?: [
        'email' => 'voluntariado@fundacionjuegayparticipa.org',
        'telefono' => '+54 11 3456-7890',
        'direccion' => 'Calle Principal 123, Buenos Aires'
    ];

    // Variables para el formulario (usadas en el HTML original)
    $formulario_titulo = get_field('voluntariado_form_titulo') ?: 'Inscribite ahora';
    $formulario_descripcion = get_field('voluntariado_form_desc') ?: 'Completá el formulario con tus datos y nos pondremos en contacto con vos a la brevedad.';

    ?>

    <style>
    /* Estilos específicos para página de voluntariado */
    .voluntariado-hero {
        background: linear-gradient(135deg, #2A9D8F 0%, #264653 100%);
        color: white;
        padding: 120px 0 80px;
        position: relative;
        overflow: hidden;
    }

    /* [Styles truncated for brevity in plan update, but included in full file content] */
    .voluntariado-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.2);
        z-index: 1;
    }

    .voluntariado-hero .container {
        position: relative;
        z-index: 2;
    }

    .voluntariado-hero h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 25px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .voluntariado-hero p {
        font-size: 1.3rem;
        line-height: 1.7;
        margin-bottom: 40px;
        max-width: 700px;
    }

    .voluntariado-hero .btn-primary {
        background: #E9C46A;
        color: #264653;
        border: none;
        padding: 15px 40px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(233, 196, 106, 0.4);
    }

    .voluntariado-hero .btn-primary:hover {
        background: #F4A261;
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(233, 196, 106, 0.6);
    }

    /* Beneficios del voluntariado */
    .voluntariado-beneficios {
        padding: 100px 0;
        background: #f8f9fa;
    }

    .voluntariado-beneficios h2 {
        text-align: center;
        color: #264653;
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 60px;
    }

    .beneficio-card {
        background: white;
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        height: 100%;
        border: 2px solid transparent;
    }

    .beneficio-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.15);
        border-color: #2A9D8F;
    }

    .beneficio-icono {
        background: linear-gradient(135deg, #2A9D8F 0%, #264653 100%);
        color: white;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        font-size: 2rem;
        box-shadow: 0 5px 20px rgba(42, 157, 143, 0.3);
    }

    .beneficio-titulo {
        color: #264653;
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .beneficio-descripcion {
        color: #6c757d;
        line-height: 1.6;
        margin-bottom: 0;
    }

    /* Áreas de voluntariado */
    .voluntariado-areas {
        padding: 100px 0;
        background: white;
    }

    .voluntariado-areas h2 {
        text-align: center;
        color: #264653;
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .voluntariado-areas .intro {
        text-align: center;
        color: #6c757d;
        font-size: 1.2rem;
        margin-bottom: 60px;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
    }

    .area-card {
        background: #f8f9fa;
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        transition: all 0.3s ease;
        height: 100%;
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
    }

    .area-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(42, 157, 143, 0.1), transparent);
        transition: left 0.5s ease;
    }

    .area-card:hover::before {
        left: 100%;
    }

    .area-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        border-color: #2A9D8F;
        background: white;
    }

    .area-icono {
        background: linear-gradient(135deg, #E9C46A 0%, #F4A261 100%);
        color: white;
        width: 90px;
        height: 90px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        font-size: 2.2rem;
        box-shadow: 0 5px 20px rgba(233, 196, 106, 0.4);
    }

    .area-titulo {
        color: #264653;
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .area-descripcion {
        color: #6c757d;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .area-requisitos {
        background: rgba(42, 157, 143, 0.1);
        color: #2A9D8F;
        padding: 15px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
        margin-top: 20px;
    }

    /* Testimonios */
    .voluntariado-testimonios {
        padding: 100px 0;
        background: linear-gradient(135deg, #264653 0%, #2A9D8F 100%);
        color: white;
        position: relative;
    }

    .voluntariado-testimonios::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }

    .voluntariado-testimonios .container {
        position: relative;
        z-index: 2;
    }

    .voluntariado-testimonios h2 {
        text-align: center;
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 60px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .testimonio-card {
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        border: 1px solid rgba(255,255,255,0.2);
        transition: all 0.3s ease;
        height: 100%;
    }

    .testimonio-card:hover {
        background: rgba(255,255,255,0.15);
        transform: translateY(-5px);
    }

    .testimonio-imagen {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin: 0 auto 25px;
        border: 4px solid rgba(255,255,255,0.3);
        object-fit: cover;
    }

    .testimonio-texto {
        font-style: italic;
        font-size: 1.1rem;
        line-height: 1.7;
        margin-bottom: 25px;
        position: relative;
    }

    .testimonio-texto::before {
        content: '"';
        font-size: 4rem;
        color: rgba(233, 196, 106, 0.5);
        position: absolute;
        top: -20px;
        left: -15px;
        font-family: Georgia, serif;
    }

    .testimonio-autor {
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 5px;
    }

    .testimonio-cargo {
        color: rgba(255,255,255,0.8);
        font-size: 0.95rem;
    }

    /* Formulario de inscripción */
    .voluntariado-formulario {
        padding: 100px 0;
        background: white;
    }

    .voluntariado-formulario h2 {
        text-align: center;
        color: #264653;
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .voluntariado-formulario .intro {
        text-align: center;
        color: #6c757d;
        font-size: 1.2rem;
        margin-bottom: 60px;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
    }

    .formulario-container {
        background: #f8f9fa;
        border-radius: 20px;
        padding: 50px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        color: #264653;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
    }

    .form-control:focus {
        border-color: #2A9D8F;
        box-shadow: 0 0 0 3px rgba(42, 157, 143, 0.1);
        outline: none;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    .form-check {
        margin-bottom: 15px;
    }

    .form-check-input {
        margin-right: 10px;
    }

    .form-check-label {
        color: #6c757d;
        font-size: 0.95rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, #2A9D8F 0%, #264653 100%);
        color: white;
        border: none;
        padding: 15px 40px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(42, 157, 143, 0.4);
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(42, 157, 143, 0.6);
        background: linear-gradient(135deg, #264653 0%, #2A9D8F 100%);
    }

    /* Preguntas frecuentes */
    .voluntariado-faq {
        padding: 100px 0;
        background: #f8f9fa;
    }

    .voluntariado-faq h2 {
        text-align: center;
        color: #264653;
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 60px;
    }

    .accordion-item {
        background: white;
        border: 2px solid #e9ecef;
        border-radius: 15px;
        margin-bottom: 20px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .accordion-item:hover {
        border-color: #2A9D8F;
    }

    .accordion-header {
        padding: 25px 30px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s ease;
    }

    .accordion-header:hover {
        background: rgba(42, 157, 143, 0.05);
    }

    .accordion-title {
        color: #264653;
        font-weight: 600;
        font-size: 1.1rem;
        margin: 0;
        flex: 1;
    }

    .accordion-icon {
        color: #2A9D8F;
        font-size: 1.2rem;
        transition: transform 0.3s ease;
    }

    .accordion-item.active .accordion-icon {
        transform: rotate(180deg);
    }

    .accordion-content {
        padding: 0 30px 25px;
        color: #6c757d;
        line-height: 1.7;
        display: none;
    }

    .accordion-content.show {
        display: block;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Contacto */
    .voluntariado-contacto {
        padding: 100px 0;
        background: linear-gradient(135deg, #2A9D8F 0%, #264653 100%);
        color: white;
        text-align: center;
    }

    .voluntariado-contacto h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 30px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .voluntariado-contacto p {
        font-size: 1.2rem;
        margin-bottom: 40px;
        opacity: 0.9;
    }

    .contacto-info {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 40px;
        margin-bottom: 40px;
    }

    .contacto-item {
        display: flex;
        align-items: center;
        gap: 15px;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        padding: 20px 30px;
        border-radius: 15px;
        border: 1px solid rgba(255,255,255,0.2);
        transition: all 0.3s ease;
    }

    .contacto-item:hover {
        background: rgba(255,255,255,0.2);
        transform: translateY(-3px);
    }

    .contacto-icono {
        color: #E9C46A;
        font-size: 1.5rem;
    }

    .contacto-texto {
        text-align: left;
    }

    .contacto-label {
        font-size: 0.9rem;
        opacity: 0.8;
        margin-bottom: 5px;
    }

    .contacto-valor {
        font-weight: 600;
        font-size: 1.1rem;
    }

    .contacto-valor a {
        color: white;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .contacto-valor a:hover {
        color: #E9C46A;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .voluntariado-hero {
            padding: 100px 0 60px;
        }

        .voluntariado-hero h1 {
            font-size: 2.5rem;
        }

        .voluntariado-hero p {
            font-size: 1.1rem;
        }

        .voluntariado-beneficios h2,
        .voluntariado-areas h2,
        .voluntariado-testimonios h2,
        .voluntariado-formulario h2,
        .voluntariado-faq h2 {
            font-size: 2.2rem;
        }

        .formulario-container {
            padding: 30px 20px;
        }

        .contacto-info {
            flex-direction: column;
            align-items: center;
        }

        .contacto-item {
            width: 100%;
            max-width: 300px;
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .voluntariado-hero h1 {
            font-size: 2rem;
        }

        .beneficio-card,
        .area-card,
        .testimonio-card {
            padding: 30px 20px;
        }

        .voluntariado-beneficios h2,
        .voluntariado-areas h2,
        .voluntariado-testimonios h2,
        .voluntariado-formulario h2,
        .voluntariado-faq h2 {
            font-size: 2rem;
        }
    }

    /* Animaciones */
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .voluntariado-beneficios .row > div,
    .voluntariado-areas .row > div,
    .voluntariado-testimonios .row > div {
        animation: slideInUp 0.6s ease forwards;
    }

    .voluntariado-beneficios .row > div:nth-child(2) {
        animation-delay: 0.1s;
    }

    .voluntariado-beneficios .row > div:nth-child(3) {
        animation-delay: 0.2s;
    }

    .voluntariado-areas .row > div:nth-child(2) {
        animation-delay: 0.1s;
    }

    .voluntariado-areas .row > div:nth-child(3) {
        animation-delay: 0.2s;
    }

    .voluntariado-areas .row > div:nth-child(4) {
        animation-delay: 0.3s;
    }

    .voluntariado-testimonios .row > div:nth-child(2) {
        animation-delay: 0.1s;
    }

    .voluntariado-testimonios .row > div:nth-child(3) {
        animation-delay: 0.2s;
    }
    </style>

    <!-- Hero Section -->
    <section class="voluntariado-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1><?php echo esc_html($hero_titulo); ?></h1>
                    <p><?php echo esc_html($hero_descripcion); ?></p>
                    <a href="#formulario" class="btn btn-primary">
                        <i class="fas fa-hands-helping"></i> Quiero ser voluntario/a
                    </a>
                </div>
                <div class="col-lg-5">
                    <?php if ($hero_imagen): ?>
                    <img src="<?php echo esc_url($hero_imagen); ?>" alt="Voluntariado" class="img-fluid rounded-3 shadow-lg">
                    <?php else: ?>
                    <div class="text-center">
                        <i class="fas fa-users" style="font-size: 200px; color: rgba(255,255,255,0.3);"></i>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Beneficios del voluntariado -->
    <section class="voluntariado-beneficios">
        <div class="container">
            <h2>Beneficios de ser voluntario/a</h2>
            <div class="row">
                <?php foreach ($beneficios as $beneficio): ?>
                <div class="col-lg-4 mb-4">
                    <div class="beneficio-card">
                        <div class="beneficio-icono">
                            <i class="<?php echo esc_attr($beneficio['icono']); ?>"></i>
                        </div>
                        <h3 class="beneficio-titulo"><?php echo esc_html($beneficio['titulo']); ?></h3>
                        <p class="beneficio-descripcion"><?php echo esc_html($beneficio['descripcion']); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Áreas de voluntariado -->
    <section class="voluntariado-areas">
        <div class="container">
            <h2>Áreas para voluntarios/as</h2>
            <p class="intro">Elegí el área que más se adapte a tus intereses y habilidades</p>
            <div class="row">
                <?php foreach ($areas_voluntariado as $area): ?>
                <div class="col-lg-6 mb-4">
                    <div class="area-card">
                        <div class="area-icono">
                            <i class="<?php echo esc_attr($area['icono']); ?>"></i>
                        </div>
                        <h3 class="area-titulo"><?php echo esc_html($area['titulo']); ?></h3>
                        <p class="area-descripcion"><?php echo esc_html($area['descripcion']); ?></p>
                        <div class="area-requisitos">
                            <strong>Requisitos:</strong> <?php echo esc_html($area['requisitos']); ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Testimonios -->
    <section class="voluntariado-testimonios">
        <div class="container">
            <h2>Lo que dicen nuestros voluntarios/as</h2>
            <div class="row">
                <?php foreach ($testimonios as $testimonio): ?>
                <div class="col-lg-4 mb-4">
                    <div class="testimonio-card">
                        <?php if ($testimonio['imagen']): ?>
                        <img src="<?php echo esc_url($testimonio['imagen']); ?>" alt="<?php echo esc_attr($testimonio['nombre']); ?>" class="testimonio-imagen">
                        <?php else: ?>
                        <div class="testimonio-imagen bg-light d-flex align-items-center justify-content-center">
                            <i class="fas fa-user" style="font-size: 3rem; color: #2A9D8F;"></i>
                        </div>
                        <?php endif; ?>
                        <p class="testimonio-texto"><?php echo esc_html($testimonio['testimonio']); ?></p>
                        <div class="testimonio-autor"><?php echo esc_html($testimonio['nombre']); ?></div>
                        <div class="testimonio-cargo"><?php echo esc_html($testimonio['cargo']); ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Formulario de inscripción -->
    <section id="formulario" class="voluntariado-formulario">
        <div class="container">
            <h2><?php echo esc_html($formulario_titulo); ?></h2>
            <p class="intro"><?php echo esc_html($formulario_descripcion); ?></p>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="formulario-container">
                        <form id="formulario-voluntariado" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                            <input type="hidden" name="action" value="procesar_formulario_voluntariado">
                            <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('formulario_voluntariado'); ?>">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre completo *</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email *</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telefono">Teléfono *</label>
                                        <input type="tel" class="form-control" id="telefono" name="telefono" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="edad">Edad *</label>
                                        <input type="number" class="form-control" id="edad" name="edad" min="16" max="80" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="area">Área de interés *</label>
                                <select class="form-control" id="area" name="area" required>
                                    <option value="">Seleccionar área</option>
                                    <?php foreach ($areas_voluntariado as $area): ?>
                                    <option value="<?php echo esc_attr(sanitize_title($area['titulo'])); ?>"><?php echo esc_html($area['titulo']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="disponibilidad">Disponibilidad horaria *</label>
                                <select class="form-control" id="disponibilidad" name="disponibilidad" required>
                                    <option value="">Seleccionar disponibilidad</option>
                                    <option value="mananas">Mañanas</option>
                                    <option value="tardes">Tardes</option>
                                    <option value="fines-semana">Fines de semana</option>
                                    <option value="tiempo-completo">Tiempo completo</option>
                                    <option value="fines-de-mes">Fines de mes</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="experiencia">¿Tenés experiencia previa en voluntariado?</label>
                                <textarea class="form-control" id="experiencia" name="experiencia" rows="3" placeholder="Contanos sobre tu experiencia previa (si tenés)..."></textarea>
                            </div>

                            <div class="form-group">
                                <label for="motivacion">¿Qué te motiva a ser voluntario/a? *</label>
                                <textarea class="form-control" id="motivacion" name="motivacion" rows="4" required placeholder="Contanos qué te motiva a sumarte como voluntario/a..."></textarea>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="terminos" name="terminos" required>
                                <label class="form-check-label" for="terminos">
                                    Acepto los <a href="#" data-bs-toggle="modal" data-bs-target="#modalTerminos">términos y condiciones</a> del programa de voluntariado *
                                </label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="newsletter" name="newsletter">
                                <label class="form-check-label" for="newsletter">
                                    Deseo recibir novedades y actualizaciones por email
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-paper-plane"></i> Enviar solicitud
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Preguntas frecuentes -->
    <section class="voluntariado-faq">
        <div class="container">
            <h2>Preguntas frecuentes</h2>
            <div class="accordion" id="faqVoluntariado">
                <?php foreach ($preguntas_frecuentes as $index => $faq): ?>
                <div class="accordion-item">
                    <div class="accordion-header" data-bs-toggle="collapse" data-bs-target="#faq<?php echo $index; ?>">
                        <h3 class="accordion-title"><?php echo esc_html($faq['pregunta']); ?></h3>
                        <i class="fas fa-chevron-down accordion-icon"></i>
                    </div>
                    <div id="faq<?php echo $index; ?>" class="accordion-collapse collapse" data-bs-parent="#faqVoluntariado">
                        <div class="accordion-content">
                            <?php echo esc_html($faq['respuesta']); ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Contacto -->
    <section class="voluntariado-contacto">
        <div class="container">
            <h2><i class="fas fa-question-circle"></i> ¿Tenés más preguntas?</h2>
            <p>No dudes en contactarnos, estamos acá para ayudarte</p>

            <div class="contacto-info">
                <div class="contacto-item">
                    <div class="contacto-icono">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="contacto-texto">
                        <div class="contacto-label">Email</div>
                        <div class="contacto-valor">
                            <a href="mailto:<?php echo esc_attr($contacto_info['email']); ?>"><?php echo esc_html($contacto_info['email']); ?></a>
                        </div>
                    </div>
                </div>

                <div class="contacto-item">
                    <div class="contacto-icono">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="contacto-texto">
                        <div class="contacto-label">Teléfono</div>
                        <div class="contacto-valor">
                            <a href="tel:<?php echo esc_attr(str_replace([' ', '-'], '', $contacto_info['telefono'])); ?>"><?php echo esc_html($contacto_info['telefono']); ?></a>
                        </div>
                    </div>
                </div>

                <div class="contacto-item">
                    <div class="contacto-icono">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="contacto-texto">
                        <div class="contacto-label">Dirección</div>
                        <div class="contacto-valor"><?php echo esc_html($contacto_info['direccion']); ?></div>
                    </div>
                </div>
            </div>

            <a href="mailto:<?php echo esc_attr($contacto_info['email']); ?>" class="btn btn-primary">
                <i class="fas fa-comments"></i> Contactar al equipo de voluntariado
            </a>
        </div>
    </section>

    <!-- Modal de términos y condiciones -->
    <div class="modal fade" id="modalTerminos" tabindex="-1" aria-labelledby="modalTerminosLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTerminosLabel">Términos y condiciones del programa de voluntariado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>1. Compromiso y responsabilidad</h6>
                    <p>Los voluntarios se comprometen a cumplir con el horario y tareas asignadas, manteniendo un comportamiento ético y profesional.</p>

                    <h6>2. Confidencialidad</h6>
                    <p>Los voluntarios deben mantener la confidencialidad de la información de los beneficiarios y la institución.</p>

                    <h6>3. Capacitación</h6>
                    <p>Es obligatorio asistir a las capacitaciones proporcionadas por la fundación antes de iniciar las actividades.</p>

                    <h6>4. Seguridad</h6>
                    <p>Los voluntarios deben seguir los protocolos de seguridad establecidos y reportar cualquier incidente.</p>

                    <h6>5. Evaluación</h6>
                    <p>La fundación realizará evaluaciones periódicas del desempeño de los voluntarios para mejorar la calidad del servicio.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Formulario de voluntariado
        const formulario = document.getElementById('formulario-voluntariado');

        if (formulario) {
            formulario.addEventListener('submit', function(e) {
                e.preventDefault();

                // Validar formulario
                if (!this.checkValidity()) {
                    this.reportValidity();
                    return;
                }

                // Mostrar mensaje de éxito
                const formData = new FormData(this);

                fetch('<?php echo esc_url(admin_url('admin-post.php')); ?>', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Mostrar mensaje de éxito
                        const container = this.closest('.formulario-container');
                        container.innerHTML = `
                            <div class="text-center">
                                <div style="font-size: 4rem; color: #2A9D8F; margin-bottom: 20px;">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <h3 style="color: #264653; margin-bottom: 15px;">¡Solicitud enviada!</h3>
                                <p style="color: #6c757d; font-size: 1.1rem;">
                                    Gracias por tu interés en ser voluntario/a. Nos pondremos en contacto contigo muy pronto.
                                </p>
                            </div>
                        `;

                        // Hacer scroll al mensaje
                        container.scrollIntoView({ behavior: 'smooth' });
                    } else {
                        alert('Hubo un error al enviar el formulario. Por favor, intentá de nuevo.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Hubo un error al enviar el formulario. Por favor, intentá de nuevo.');
                });
            });
        }

        // Acordeón de FAQ
        const accordionItems = document.querySelectorAll('.accordion-item');

        accordionItems.forEach(item => {
            const header = item.querySelector('.accordion-header');
            const content = item.querySelector('.accordion-content');

            header.addEventListener('click', function() {
                // Cerrar otros acordeones
                accordionItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                        otherItem.querySelector('.accordion-content').classList.remove('show');
                    }
                });

                // Toggle este acordeón
                item.classList.toggle('active');
                content.classList.toggle('show');
            });
        });

        // Animaciones al hacer scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observar elementos
        document.querySelectorAll('.beneficio-card, .area-card, .testimonio-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });

        // Validación de edad
        const edadInput = document.getElementById('edad');
        if (edadInput) {
            edadInput.addEventListener('input', function() {
                const edad = parseInt(this.value);
                if (edad < 16) {
                    this.setCustomValidity('Debes tener al menos 16 años para ser voluntario/a');
                } else {
                    this.setCustomValidity('');
                }
            });
        }
    });

    // Función para desplazamiento suave
    function scrollToSection(sectionId) {
        const section = document.getElementById(sectionId);
        if (section) {
            section.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    }
    </script>

    <?php } // Fin del fallback ?>

<?php get_footer(); ?>