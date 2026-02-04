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
    $hero_titulo = get_field('voluntariado_hero_titulo') ?: __('Sumate como voluntario/a', 'fjp');
    $hero_descripcion = get_field('voluntariado_hero_descripcion') ?: __('Formá parte de nuestro equipo de voluntarios y ayudanos a construir una comunidad más justa y solidaria.', 'fjp');
    $hero_imagen = get_field('voluntariado_hero_imagen');

    $beneficios = get_field('voluntariado_beneficios') ?: [
        [
            'titulo' => __('Desarrollo personal', 'fjp'),
            'descripcion' => __('Adquirí nuevas habilidades y experiencias valiosas.', 'fjp'),
            'icono' => 'fas fa-user-plus'
        ],
        [
            'titulo' => __('Networking', 'fjp'),
            'descripcion' => __('Conocé personas con tus mismos valores e intereses.', 'fjp'),
            'icono' => 'fas fa-users'
        ],
        [
            'titulo' => __('Impacto social', 'fjp'),
            'descripcion' => __('Contribuí al bienestar de niños, niñas y adolescentes.', 'fjp'),
            'icono' => 'fas fa-heart'
        ]
    ];

    // Obtener áreas de voluntariado (CPT: 'areas_voluntariado' si existiera, o campos)
    // En este caso, usamos el campo repetidor de ACF si está poblado, o fallback.
    $areas_voluntariado = get_field('voluntariado_areas');

    if (!$areas_voluntariado) {
        $areas_voluntariado = [
            [
                'titulo' => __('Acompañamiento educativo', 'fjp'),
                'descripcion' => __('Ayudá a niños y niñas con sus tareas escolares y actividades de refuerzo.', 'fjp'),
                'icono' => 'fas fa-graduation-cap',
                'requisitos' => __('Secundario completo, disponibilidad horaria, vocación docente.', 'fjp')
            ],
            [
                'titulo' => __('Deportes y recreación', 'fjp'),
                'descripcion' => __('Acompañá en actividades deportivas y recreativas.', 'fjp'),
                'icono' => 'fas fa-running',
                'requisitos' => __('Conocimientos básicos de deportes, buena condición física.', 'fjp')
            ],
            [
                'titulo' => __('Arte y cultura', 'fjp'),
                'descripcion' => __('Colaborá en talleres de arte, música, teatro y manualidades.', 'fjp'),
                'icono' => 'fas fa-palette',
                'requisitos' => __('Creatividad, habilidades artísticas, entusiasmo.', 'fjp')
            ],
            [
                'titulo' => __('Apoyo administrativo', 'fjp'),
                'descripcion' => __('Ayudá con tareas administrativas y organización de eventos.', 'fjp'),
                'icono' => 'fas fa-laptop',
                'requisitos' => __('Conocimientos básicos de computación, organización.', 'fjp')
            ]
        ];
    }

    // Integración de CPT Testimonios si existe
    $testimonios = [];
    $args_testimonios = array(
        'post_type' => 'testimonios',
        'posts_per_page' => 3,
        'orderby' => 'rand'
    );
    $query_testimonios = new WP_Query($args_testimonios);

    if ($query_testimonios->have_posts()) {
        while ($query_testimonios->have_posts()) {
            $query_testimonios->the_post();
            $testimonios[] = [
                'nombre' => get_the_title(),
                'cargo' => get_field('cargo_testimonio'),
                'testimonio' => get_the_excerpt(),
                'imagen' => get_the_post_thumbnail_url(get_the_ID(), 'fjp-testimonio')
            ];
        }
        wp_reset_postdata();
    } else {
        // Fallback array
        $testimonios = get_field('voluntariado_testimonios') ?: [
            [
                'nombre' => 'María González',
                'cargo' => __('Voluntaria educativa', 'fjp'),
                'testimonio' => __('Ser voluntaria me permitió descubrir una pasión por la enseñanza que no sabía que tenía. Ver el progreso de los chicos es muy gratificante.', 'fjp'),
                'imagen' => ''
            ],
            [
                'nombre' => 'Carlos Rodríguez',
                'cargo' => __('Voluntario deportivo', 'fjp'),
                'testimonio' => __('Compartir mi amor por el deporte con los chicos es maravilloso. Verlos disfrutar y crecer a través del juego es muy satisfactorio.', 'fjp'),
                'imagen' => ''
            ],
            [
                'nombre' => 'Ana Martínez',
                'cargo' => __('Voluntaria artística', 'fjp'),
                'testimonio' => __('El arte tiene un poder transformador increíble. Ver cómo los chicos se expresan y crecen a través de la creatividad es maravilloso.', 'fjp'),
                'imagen' => ''
            ]
        ];
    }

    $preguntas_frecuentes = get_field('voluntariado_faq') ?: [
        [
            'pregunta' => __('¿Cuántas horas por semana debo comprometerme?', 'fjp'),
            'respuesta' => __('La cantidad de horas es flexible y se adapta a tu disponibilidad. Puede ser desde 2 horas semanales hasta varios días, dependiendo del área y tu tiempo disponible.', 'fjp')
        ],
        [
            'pregunta' => __('¿Necesito experiencia previa?', 'fjp'),
            'respuesta' => __('No necesariamente. Proporcionamos capacitación inicial y acompañamiento continuo. Lo más importante es tu actitud y disposición para ayudar.', 'fjp')
        ],
        [
            'pregunta' => __('¿Hay algún costo para ser voluntario?', 'fjp'),
            'respuesta' => __('No, el voluntariado es gratuito. Solo necesitamos tu compromiso y tiempo. Cubrimos los materiales y capacitación necesarios.', 'fjp')
        ],
        [
            'pregunta' => __('¿Puedo elegir el horario y día?', 'fjp'),
            'respuesta' => __('Sí, trabajamos juntos para encontrar un horario que se adapte tanto a tu disponibilidad como a las necesidades del programa.', 'fjp')
        ]
    ];

    $contacto_info = get_field('voluntariado_contacto') ?: [
        'email' => 'voluntariado@fundacionjuegayparticipa.org',
        'telefono' => '+54 11 3456-7890',
        'direccion' => 'Calle Principal 123, Buenos Aires'
    ];

    // Variables para el formulario (usadas en el HTML original)
    $formulario_titulo = get_field('voluntariado_form_titulo') ?: __('Inscribite ahora', 'fjp');
    $formulario_descripcion = get_field('voluntariado_form_desc') ?: __('Completá el formulario con tus datos y nos pondremos en contacto con vos a la brevedad.', 'fjp');

    ?>

    <!-- Hero Section -->
    <section class="voluntariado-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1><?php echo esc_html($hero_titulo); ?></h1>
                    <p><?php echo esc_html($hero_descripcion); ?></p>
                    <a href="#formulario" class="btn btn-primary">
                        <i class="fas fa-hands-helping"></i> <?php _e('Quiero ser voluntario/a', 'fjp'); ?>
                    </a>
                </div>
                <div class="col-lg-5">
                    <?php if ($hero_imagen): ?>
                    <img src="<?php echo esc_url($hero_imagen); ?>" alt="<?php esc_attr_e('Voluntariado', 'fjp'); ?>" class="img-fluid rounded-3 shadow-lg">
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
            <h2><?php _e('Beneficios de ser voluntario/a', 'fjp'); ?></h2>
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
            <h2><?php _e('Áreas para voluntarios/as', 'fjp'); ?></h2>
            <p class="intro"><?php _e('Elegí el área que más se adapte a tus intereses y habilidades', 'fjp'); ?></p>
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
                            <strong><?php _e('Requisitos:', 'fjp'); ?></strong> <?php echo esc_html($area['requisitos']); ?>
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
            <h2><?php _e('Lo que dicen nuestros voluntarios/as', 'fjp'); ?></h2>
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
                                        <label for="nombre"><?php _e('Nombre completo *', 'fjp'); ?></label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email"><?php _e('Email *', 'fjp'); ?></label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telefono"><?php _e('Teléfono *', 'fjp'); ?></label>
                                        <input type="tel" class="form-control" id="telefono" name="telefono" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="edad"><?php _e('Edad *', 'fjp'); ?></label>
                                        <input type="number" class="form-control" id="edad" name="edad" min="16" max="80" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="area"><?php _e('Área de interés *', 'fjp'); ?></label>
                                <select class="form-control" id="area" name="area" required>
                                    <option value=""><?php _e('Seleccionar área', 'fjp'); ?></option>
                                    <?php foreach ($areas_voluntariado as $area): ?>
                                    <option value="<?php echo esc_attr(sanitize_title($area['titulo'])); ?>"><?php echo esc_html($area['titulo']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="disponibilidad"><?php _e('Disponibilidad horaria *', 'fjp'); ?></label>
                                <select class="form-control" id="disponibilidad" name="disponibilidad" required>
                                    <option value=""><?php _e('Seleccionar disponibilidad', 'fjp'); ?></option>
                                    <option value="mananas"><?php _e('Mañanas', 'fjp'); ?></option>
                                    <option value="tardes"><?php _e('Tardes', 'fjp'); ?></option>
                                    <option value="fines-semana"><?php _e('Fines de semana', 'fjp'); ?></option>
                                    <option value="tiempo-completo"><?php _e('Tiempo completo', 'fjp'); ?></option>
                                    <option value="fines-de-mes"><?php _e('Fines de mes', 'fjp'); ?></option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="experiencia"><?php _e('¿Tenés experiencia previa en voluntariado?', 'fjp'); ?></label>
                                <textarea class="form-control" id="experiencia" name="experiencia" rows="3" placeholder="<?php esc_attr_e('Contanos sobre tu experiencia previa (si tenés)...', 'fjp'); ?>"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="motivacion"><?php _e('¿Qué te motiva a ser voluntario/a? *', 'fjp'); ?></label>
                                <textarea class="form-control" id="motivacion" name="motivacion" rows="4" required placeholder="<?php esc_attr_e('Contanos qué te motiva a sumarte como voluntario/a...', 'fjp'); ?>"></textarea>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="terminos" name="terminos" required>
                                <label class="form-check-label" for="terminos">
                                    <?php printf( __('Acepto los <a href="#" data-bs-toggle="modal" data-bs-target="#modalTerminos">términos y condiciones</a> del programa de voluntariado *', 'fjp') ); ?>
                                </label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="newsletter" name="newsletter">
                                <label class="form-check-label" for="newsletter">
                                    <?php _e('Deseo recibir novedades y actualizaciones por email', 'fjp'); ?>
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-paper-plane"></i> <?php _e('Enviar solicitud', 'fjp'); ?>
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
            <h2><?php _e('Preguntas frecuentes', 'fjp'); ?></h2>
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
            <h2><i class="fas fa-question-circle"></i> <?php _e('¿Tenés más preguntas?', 'fjp'); ?></h2>
            <p><?php _e('No dudes en contactarnos, estamos acá para ayudarte', 'fjp'); ?></p>

            <div class="contacto-info">
                <div class="contacto-item">
                    <div class="contacto-icono">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="contacto-texto">
                        <div class="contacto-label"><?php _e('Email', 'fjp'); ?></div>
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
                        <div class="contacto-label"><?php _e('Teléfono', 'fjp'); ?></div>
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
                        <div class="contacto-label"><?php _e('Dirección', 'fjp'); ?></div>
                        <div class="contacto-valor"><?php echo esc_html($contacto_info['direccion']); ?></div>
                    </div>
                </div>
            </div>

            <a href="mailto:<?php echo esc_attr($contacto_info['email']); ?>" class="btn btn-primary">
                <i class="fas fa-comments"></i> <?php _e('Contactar al equipo de voluntariado', 'fjp'); ?>
            </a>
        </div>
    </section>

    <!-- Modal de términos y condiciones -->
    <div class="modal fade" id="modalTerminos" tabindex="-1" aria-labelledby="modalTerminosLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTerminosLabel"><?php _e('Términos y condiciones del programa de voluntariado', 'fjp'); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>1. <?php _e('Compromiso y responsabilidad', 'fjp'); ?></h6>
                    <p><?php _e('Los voluntarios se comprometen a cumplir con el horario y tareas asignadas, manteniendo un comportamiento ético y profesional.', 'fjp'); ?></p>

                    <h6>2. <?php _e('Confidencialidad', 'fjp'); ?></h6>
                    <p><?php _e('Los voluntarios deben mantener la confidencialidad de la información de los beneficiarios y la institución.', 'fjp'); ?></p>

                    <h6>3. <?php _e('Capacitación', 'fjp'); ?></h6>
                    <p><?php _e('Es obligatorio asistir a las capacitaciones proporcionadas por la fundación antes de iniciar las actividades.', 'fjp'); ?></p>

                    <h6>4. <?php _e('Seguridad', 'fjp'); ?></h6>
                    <p><?php _e('Los voluntarios deben seguir los protocolos de seguridad establecidos y reportar cualquier incidente.', 'fjp'); ?></p>

                    <h6>5. <?php _e('Evaluación', 'fjp'); ?></h6>
                    <p><?php _e('La fundación realizará evaluaciones periódicas del desempeño de los voluntarios para mejorar la calidad del servicio.', 'fjp'); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php _e('Cerrar', 'fjp'); ?></button>
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
                                <h3 style="color: #264653; margin-bottom: 15px;"><?php _e('¡Solicitud enviada!', 'fjp'); ?></h3>
                                <p style="color: #6c757d; font-size: 1.1rem;">
                                    <?php _e('Gracias por tu interés en ser voluntario/a. Nos pondremos en contacto contigo muy pronto.', 'fjp'); ?>
                                </p>
                            </div>
                        `;

                        // Hacer scroll al mensaje
                        container.scrollIntoView({ behavior: 'smooth' });
                    } else {
                        alert('<?php _e('Hubo un error al enviar el formulario. Por favor, intentá de nuevo.', 'fjp'); ?>');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('<?php _e('Hubo un error al enviar el formulario. Por favor, intentá de nuevo.', 'fjp'); ?>');
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
                    this.setCustomValidity('<?php _e('Debes tener al menos 16 años para ser voluntario/a', 'fjp'); ?>');
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