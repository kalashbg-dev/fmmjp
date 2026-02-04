# 🏗️ GUÍA MAESTRA DE COMPOSICIÓN DE BLOQUES (GUTENBERG) - FJP

Esta guía es el recurso definitivo para construir o reconstruir las páginas principales del sitio web de la Fundación Juventud Progresista. Contiene el **código fuente exacto** de cada página, listo para copiar y pegar.

---

## 🛠️ INSTRUCCIONES PREVIAS: CÓMO USAR EL EDITOR DE CÓDIGO

Para aplicar estos diseños, no necesitas arrastrar bloques uno por uno. Solo sigue estos pasos:

1.  Ve al Panel de Administración de WordPress > **Páginas**.
2.  Haz clic en el título de la página que quieres editar (ej: "Inicio").
3.  En la esquina superior derecha de la pantalla, haz clic en el icono de **tres puntos verticales (⋮)** (Opciones).
4.  En el menú que se abre, busca la sección "Editor" y selecciona **"Editor de código"** (Atajo: `Ctrl + Shift + Alt + M`).
5.  Verás que la pantalla cambia a un editor de texto con código. **Borra todo lo que haya ahí**.
6.  **Copia el bloque de código** correspondiente de esta guía (asegúrate de copiar desde el primer `<!-- wp:...` hasta el último cierre).
7.  **Pégalo** en el editor de la página.
8.  Haz clic de nuevo en los tres puntos (⋮) y selecciona **"Editor visual"** para ver el resultado final.
9.  Haz clic en **Actualizar** o **Publicar**.

---

## 🏠 1. PÁGINA DE INICIO (HOME)

**Descripción**: La página principal debe capturar la atención inmediatamente. Incluye un "Hero" con imagen de fondo, contadores de impacto, y accesos directos.

### Código Completo (Copiar y Pegar):

```html
<!-- wp:group {"tagName":"section","className":"fjp-hero","layout":{"type":"constrained"}} -->
<section class="wp-block-group fjp-hero"><!-- wp:columns {"verticalAlignment":"center","align":"wide"} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:heading {"level":1,"className":"display-4 fw-bold mb-4"} -->
<h1 class="wp-block-heading display-4 fw-bold mb-4">Fundación Juventud Progresista</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"lead mb-4"} -->
<p class="lead mb-4">Trabajamos incansablemente por los derechos, la educación y el futuro de niños, niñas y adolescentes en toda la República Dominicana.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"btn-fjp-primary me-3"} -->
<div class="wp-block-button btn-fjp-primary me-3"><a class="wp-block-button__link wp-element-button" href="/donaciones">Donar Ahora</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"btn-fjp-secondary"} -->
<div class="wp-block-button btn-fjp-secondary"><a class="wp-block-button__link wp-element-button" href="/voluntariado">Ser Voluntario</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"rounded-3 shadow"} -->
<figure class="wp-block-image size-large rounded-3 shadow"><img src="https://via.placeholder.com/600x400" alt="Juventud Progresista en Acción"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->

<!-- wp:shortcode -->
[fjp_counter_section]
<!-- /wp:shortcode -->

<!-- wp:group {"tagName":"section","className":"fjp-section bg-light","layout":{"type":"constrained"}} -->
<section class="wp-block-group fjp-section bg-light"><!-- wp:heading {"textAlign":"center","className":"mb-5"} -->
<h2 class="wp-block-heading has-text-align-center mb-5">Nuestros Pilares</h2>
<!-- /wp:heading -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"fjp-card p-4 h-100 text-center"} -->
<div class="wp-block-group fjp-card p-4 h-100 text-center"><!-- wp:heading {"level":3,"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size">Educación</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Fomentamos el aprendizaje continuo y el desarrollo de habilidades.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"fjp-card p-4 h-100 text-center"} -->
<div class="wp-block-group fjp-card p-4 h-100 text-center"><!-- wp:heading {"level":3,"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size">Salud</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Promovemos el bienestar físico y mental en las comunidades.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"fjp-card p-4 h-100 text-center"} -->
<div class="wp-block-group fjp-card p-4 h-100 text-center"><!-- wp:heading {"level":3,"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size">Medio Ambiente</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Protegemos nuestros recursos naturales para el futuro.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->

<!-- wp:heading {"textAlign":"center","className":"mt-5 mb-4"} -->
<h2 class="wp-block-heading has-text-align-center mt-5 mb-4">Aliados Estratégicos</h2>
<!-- /wp:heading -->

<!-- wp:shortcode -->
[fjp_alliances_loop]
<!-- /wp:shortcode -->
```

---

## 👥 2. PÁGINA QUIÉNES SOMOS

**Descripción**: Presenta la identidad institucional (Misión, Visión, Valores) y al liderazgo. Utiliza tarjetas limpias para facilitar la lectura.

### Código Completo (Copiar y Pegar):

```html
<!-- wp:group {"tagName":"section","className":"fjp-hero-interior py-5","backgroundColor":"fjp-primary","layout":{"type":"constrained"}} -->
<section class="wp-block-group fjp-hero-interior py-5 has-fjp-primary-background-color has-background"><!-- wp:heading {"textAlign":"center","className":"text-white display-4 fw-bold"} -->
<h2 class="wp-block-heading has-text-align-center text-white display-4 fw-bold">Quiénes Somos</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"text-white-50"} -->
<p class="has-text-align-center text-white-50"><a href="/" style="color: rgba(255,255,255,0.7);">Inicio</a> / Nuestra Historia</p>
<!-- /wp:paragraph --></section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","className":"fjp-section","layout":{"type":"constrained"}} -->
<section class="wp-block-group fjp-section"><!-- wp:columns {"className":"mb-5"} -->
<div class="wp-block-columns mb-5"><!-- wp:column {"width":"100%"} -->
<div class="wp-block-column" style="flex-basis:100%"><!-- wp:heading {"textAlign":"center","className":"mb-4"} -->
<h2 class="wp-block-heading has-text-align-center mb-4">Nuestra Identidad</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","className":"lead mb-5"} -->
<p class="has-text-align-center lead mb-5">Somos una organización comprometida con el desarrollo integral de la sociedad dominicana.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"fjp-card p-4 h-100 bg-light rounded-3 shadow-sm"} -->
<div class="wp-block-group fjp-card p-4 h-100 bg-light rounded-3 shadow-sm"><!-- wp:heading {"level":3,"className":"mb-3 text-primary"} -->
<h3 class="wp-block-heading mb-3 text-primary">Misión</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Impulsar el desarrollo sostenible de las comunidades mediante programas educativos, de salud y medioambientales que empoderen a la juventud.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"fjp-card p-4 h-100 bg-light rounded-3 shadow-sm"} -->
<div class="wp-block-group fjp-card p-4 h-100 bg-light rounded-3 shadow-sm"><!-- wp:heading {"level":3,"className":"mb-3 text-primary"} -->
<h3 class="wp-block-heading mb-3 text-primary">Visión</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Ser la organización referente en innovación social y voluntariado en la República Dominicana, reconocida por su transparencia e impacto.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"fjp-card p-4 h-100 bg-light rounded-3 shadow-sm"} -->
<div class="wp-block-group fjp-card p-4 h-100 bg-light rounded-3 shadow-sm"><!-- wp:heading {"level":3,"className":"mb-3 text-primary"} -->
<h3 class="wp-block-heading mb-3 text-primary">Valores</h3>
<!-- /wp:heading -->
<!-- wp:list -->
<ul><!-- wp:list-item -->
<li>Solidaridad</li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li>Integridad</li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li>Compromiso</li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li>Excelencia</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
```

---

## 🤝 3. PÁGINA DE VOLUNTARIADO

**Descripción**: Diseñada para convertir visitantes en voluntarios. Incluye un encabezado inspirador, beneficios y el formulario de inscripción obligatorio.

### Código Completo (Copiar y Pegar):

```html
<!-- wp:cover {"overlayColor":"fjp-teal","className":"voluntariado-hero fjp-section"} -->
<div class="wp-block-cover voluntariado-hero fjp-section"><span aria-hidden="true" class="wp-block-cover__background has-fjp-teal-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","level":1,"className":"display-3 fw-bold"} -->
<h1 class="wp-block-heading has-text-align-center display-3 fw-bold">Únete al Voluntariado</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"lead mb-4"} -->
<p class="has-text-align-center lead mb-4">Tu tiempo y talento pueden transformar vidas. Sé parte del cambio que quieres ver.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline has-text-color has-white-color"} -->
<div class="wp-block-button is-style-outline has-text-color has-white-color"><a class="wp-block-button__link wp-element-button" href="#formulario" style="color:#ffffff">Inscribirme Ahora</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover -->

<!-- wp:group {"tagName":"section","className":"fjp-section bg-light","layout":{"type":"constrained"}} -->
<section class="wp-block-group fjp-section bg-light"><!-- wp:heading {"textAlign":"center","className":"mb-5"} -->
<h2 class="wp-block-heading has-text-align-center mb-5">¿Por qué ser voluntario?</h2>
<!-- /wp:heading -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"text-center"} -->
<div class="wp-block-group text-center"><!-- wp:image {"align":"center","width":80,"height":80,"sizeSlug":"thumbnail","linkDestination":"none","className":"is-style-rounded mb-3"} -->
<figure class="wp-block-image aligncenter is-style-rounded mb-3 is-resized"><img src="https://via.placeholder.com/150" alt="Icono Desarrollo" width="80" height="80"/></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":4} -->
<h4 class="wp-block-heading">Desarrollo Profesional</h4>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Adquiere experiencia práctica y habilidades de liderazgo.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"text-center"} -->
<div class="wp-block-group text-center"><!-- wp:image {"align":"center","width":80,"height":80,"sizeSlug":"thumbnail","linkDestination":"none","className":"is-style-rounded mb-3"} -->
<figure class="wp-block-image aligncenter is-style-rounded mb-3 is-resized"><img src="https://via.placeholder.com/150" alt="Icono Comunidad" width="80" height="80"/></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":4} -->
<h4 class="wp-block-heading">Impacto Real</h4>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Verás los resultados directos de tu ayuda en la comunidad.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"text-center"} -->
<div class="wp-block-group text-center"><!-- wp:image {"align":"center","width":80,"height":80,"sizeSlug":"thumbnail","linkDestination":"none","className":"is-style-rounded mb-3"} -->
<figure class="wp-block-image aligncenter is-style-rounded mb-3 is-resized"><img src="https://via.placeholder.com/150" alt="Icono Networking" width="80" height="80"/></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":4} -->
<h4 class="wp-block-heading">Networking</h4>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Conecta con personas que comparten tus mismos valores.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->

<!-- wp:group {"className":"container my-5","layout":{"type":"constrained"}} -->
<div class="wp-block-group container my-5"><!-- wp:heading {"textAlign":"center","className":"mb-4"} -->
<h2 class="wp-block-heading has-text-align-center mb-4" id="formulario">Formulario de Inscripción</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"mb-5"} -->
<p class="has-text-align-center mb-5">Completa tus datos a continuación y nos pondremos en contacto contigo.</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[fjp_volunteer_form]
<!-- /wp:shortcode --></div>
<!-- /wp:group -->
```

---

## 💸 4. PÁGINA DE DONACIONES

**Descripción**: Enfocada en la transparencia y facilidad. Muestra el impacto de cada aporte y opciones de donación.

### Código Completo (Copiar y Pegar):

```html
<!-- wp:group {"tagName":"section","className":"fjp-hero-interior py-5","backgroundColor":"fjp-secondary","layout":{"type":"constrained"}} -->
<section class="wp-block-group fjp-hero-interior py-5 has-fjp-secondary-background-color has-background"><!-- wp:heading {"textAlign":"center","className":"text-white display-4 fw-bold"} -->
<h2 class="wp-block-heading has-text-align-center text-white display-4 fw-bold">Tu Aporte Cambia Vidas</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"text-white lead"} -->
<p class="has-text-align-center text-white lead">Ayúdanos a seguir construyendo un futuro lleno de oportunidades.</p>
<!-- /wp:paragraph --></section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","className":"fjp-section","layout":{"type":"constrained"}} -->
<section class="wp-block-group fjp-section"><!-- wp:heading {"textAlign":"center","className":"mb-5"} -->
<h2 class="wp-block-heading has-text-align-center mb-5">El Impacto de tu Donación</h2>
<!-- /wp:heading -->

<!-- wp:columns {"className":"mb-5"} -->
<div class="wp-block-columns mb-5"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"fjp-card p-4 text-center border-primary"} -->
<div class="wp-block-group fjp-card p-4 text-center border-primary"><!-- wp:heading {"level":3,"className":"has-fjp-primary-color display-5 fw-bold"} -->
<h3 class="wp-block-heading has-fjp-primary-color display-5 fw-bold">RD$500</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Alimenta a una familia por una semana.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"fjp-card p-4 text-center border-secondary"} -->
<div class="wp-block-group fjp-card p-4 text-center border-secondary"><!-- wp:heading {"level":3,"className":"has-fjp-secondary-color display-5 fw-bold"} -->
<h3 class="wp-block-heading has-fjp-secondary-color display-5 fw-bold">RD$1,000</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Proporciona útiles escolares completos a 5 niños.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"fjp-card p-4 text-center border-accent"} -->
<div class="wp-block-group fjp-card p-4 text-center border-accent"><!-- wp:heading {"level":3,"className":"has-fjp-accent-color display-5 fw-bold"} -->
<h3 class="wp-block-heading has-fjp-accent-color display-5 fw-bold">RD$2,500</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Permite plantar 50 árboles en zonas deforestadas.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:heading {"textAlign":"center","className":"mb-4"} -->
<h2 class="wp-block-heading has-text-align-center mb-4">Elige tu Método de Donación</h2>
<!-- /wp:heading -->

<!-- wp:shortcode -->
[fjp_donation_options]
<!-- /wp:shortcode -->

<!-- wp:paragraph {"align":"center","className":"mt-4 text-muted small"} -->
<p class="has-text-align-center mt-4 text-muted small">Todas las donaciones son seguras y pueden ser deducibles de impuestos.</p>
<!-- /wp:paragraph --></section>
<!-- /wp:group -->
```
