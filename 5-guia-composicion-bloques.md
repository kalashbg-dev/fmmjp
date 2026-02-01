# 🏗️ Guía de Composición de Páginas con Bloques (Gutenberg)

Esta guía contiene el código de bloques (Code Editor) necesario para recrear la estructura original de las páginas del sitio utilizando la nueva arquitectura híbrida.

## 📋 Instrucciones de Uso

1.  En WordPress, ve a **Páginas** y edita la página correspondiente (ej: Home).
2.  En la esquina superior derecha, haz clic en los tres puntos (Opciones) y selecciona **Editor de código**.
3.  Borra todo el contenido existente.
4.  Copia el código correspondiente de esta guía y pégalo en el editor.
5.  Haz clic en **Salir del editor de código** para ver los bloques visualmente.
6.  Actualiza la página.

---

## 🏠 1. Página de Inicio (Home)

Recrea la sección Hero, contadores, "Sobre Nosotros", noticias recientes y alianzas.

```html
<!-- wp:group {"tagName":"section","className":"fjp-hero","layout":{"type":"constrained"}} -->
<section class="wp-block-group fjp-hero"><!-- wp:columns {"verticalAlignment":"center","align":"wide"} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:heading {"level":1,"className":"display-4 fw-bold mb-4"} -->
<h1 class="wp-block-heading display-4 fw-bold mb-4">Fundación Juventud Progresista</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"lead mb-4"} -->
<p class="lead mb-4">Trabajamos por los derechos de niños, niñas y adolescentes en la República Dominicana.</p>
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
<figure class="wp-block-image size-large rounded-3 shadow"><img src="https://via.placeholder.com/600x400" alt="Hero Video Placeholder"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->

<!-- wp:shortcode -->
[fjp_contador_impacto libras="56966" voluntarios="1341" provincias="32"]
<!-- /wp:shortcode -->

<!-- wp:group {"tagName":"section","className":"fjp-section bg-light","layout":{"type":"constrained"}} -->
<section class="wp-block-group fjp-section bg-light"><!-- wp:columns {"verticalAlignment":"center"} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading -->
<h2 class="wp-block-heading">Sobre Nosotros</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"lead"} -->
<p class="lead">La Fundación Juventud Progresista es una organización sin fines de lucro dedicada a mejorar la calidad de vida de las comunidades dominicanas.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Desde 2016, hemos impactado positivamente a miles de familias en las 32 provincias del país, promoviendo el voluntariado y la participación ciudadana.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"btn-fjp-primary"} -->
<div class="wp-block-button btn-fjp-primary"><a class="wp-block-button__link wp-element-button" href="/quienes-somos">Conocer Más</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"img-fluid rounded-3 shadow"} -->
<figure class="wp-block-image size-large img-fluid rounded-3 shadow"><img src="https://via.placeholder.com/600x400" alt="Sobre Nosotros"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->

<!-- wp:shortcode -->
[fjp_news_loop title="Últimas Noticias" subtitle="Mantente informado sobre nuestras actividades"]
<!-- /wp:shortcode -->

<!-- wp:shortcode -->
[fjp_alliances_loop title="Nuestras Alianzas"]
<!-- /wp:shortcode -->

<!-- wp:cover {"url":"https://via.placeholder.com/1920x600","dimRatio":70,"overlayColor":"fjp-primary","className":"fjp-section text-white","layout":{"type":"constrained"}} -->
<div class="wp-block-cover fjp-section text-white"><span aria-hidden="true" class="wp-block-cover__background has-fjp-primary-background-color has-background-dim-70 has-background-dim"></span><img class="wp-block-cover__image-background" src="https://via.placeholder.com/1920x600" alt="" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","level":2,"className":"mb-4 text-white"} -->
<h2 class="wp-block-heading has-text-align-center mb-4 text-white">¿Quieres ser parte del cambio?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"lead mb-4"} -->
<p class="has-text-align-center lead mb-4">Únete a nosotros en nuestra misión de construir un futuro mejor para las comunidades dominicanas.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline has-text-color has-white-color"} -->
<div class="wp-block-button is-style-outline has-text-color has-white-color"><a class="wp-block-button__link wp-element-button" href="/donaciones" style="color:#ffffff">Donar Ahora</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline has-text-color has-white-color"} -->
<div class="wp-block-button is-style-outline has-text-color has-white-color"><a class="wp-block-button__link wp-element-button" href="/voluntariado" style="color:#ffffff">Ser Voluntario</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover -->
```

---

## 👥 2. Quiénes Somos

Incluye Misión, Visión, Valores, Historia (Timeline simplificado), Fundador y Mapa.

```html
<!-- wp:group {"tagName":"section","className":"fjp-hero-interior py-5","backgroundColor":"fjp-primary","layout":{"type":"constrained"}} -->
<section class="wp-block-group fjp-hero-interior py-5 has-fjp-primary-background-color has-background"><!-- wp:heading {"textAlign":"center","className":"text-white display-4 fw-bold"} -->
<h2 class="wp-block-heading has-text-align-center text-white display-4 fw-bold">Quiénes Somos</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"text-white-50"} -->
<p class="has-text-align-center text-white-50"><a href="/">Inicio</a> / Quiénes Somos</p>
<!-- /wp:paragraph --></section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","className":"fjp-section","layout":{"type":"constrained"}} -->
<section class="wp-block-group fjp-section"><!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column {"className":"mb-4"} -->
<div class="wp-block-column mb-4"><!-- wp:group {"className":"fjp-card p-4 h-100 text-center bg-light rounded-3","layout":{"type":"constrained"}} -->
<div class="wp-block-group fjp-card p-4 h-100 text-center bg-light rounded-3"><!-- wp:heading {"level":3,"className":"mb-3"} -->
<h3 class="wp-block-heading mb-3">Misión</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Contribuir al desarrollo sostenible de las comunidades dominicanas mediante programas de educación, salud y medio ambiente.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"mb-4"} -->
<div class="wp-block-column mb-4"><!-- wp:group {"className":"fjp-card p-4 h-100 text-center bg-light rounded-3","layout":{"type":"constrained"}} -->
<div class="wp-block-group fjp-card p-4 h-100 text-center bg-light rounded-3"><!-- wp:heading {"level":3,"className":"mb-3"} -->
<h3 class="wp-block-heading mb-3">Visión</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Ser la fundación líder en la República Dominicana en la promoción del desarrollo comunitario sostenible.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"mb-4"} -->
<div class="wp-block-column mb-4"><!-- wp:group {"className":"fjp-card p-4 h-100 text-center bg-light rounded-3","layout":{"type":"constrained"}} -->
<div class="wp-block-group fjp-card p-4 h-100 text-center bg-light rounded-3"><!-- wp:heading {"level":3,"className":"mb-3"} -->
<h3 class="wp-block-heading mb-3">Valores</h3>
<!-- /wp:heading -->
<!-- wp:list -->
<ul><!-- wp:list-item -->
<li>Compromiso Social</li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li>Transparencia</li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li>Innovación</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","className":"fjp-section","layout":{"type":"constrained"}} -->
<section class="wp-block-group fjp-section"><!-- wp:heading {"textAlign":"center","className":"mb-5"} -->
<h2 class="wp-block-heading has-text-align-center mb-5">Conoce a Nuestro Fundador</h2>
<!-- /wp:heading -->

<!-- wp:columns {"verticalAlignment":"center"} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"width":"33%"} -->
<div class="wp-block-column" style="flex-basis:33%"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"rounded-3 shadow"} -->
<figure class="wp-block-image size-large rounded-3 shadow"><img src="https://via.placeholder.com/400x400" alt="Fundador"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"66%"} -->
<div class="wp-block-column" style="flex-basis:66%"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Ing. Mayker Méndez</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"lead"} -->
<p class="lead">Fundador y Presidente de la Fundación Juventud Progresista, ingeniero civil con más de 15 años de experiencia.</p>
<!-- /wp:paragraph -->
<!-- wp:quote -->
<blockquote class="wp-block-quote"><!-- wp:paragraph -->
<p>"La juventud dominicana tiene un potencial ilimitado."</p>
<!-- /wp:paragraph --></blockquote>
<!-- /wp:quote --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->

<!-- wp:shortcode -->
[fjp_testimonials_loop title="Testimonios"]
<!-- /wp:shortcode -->
```

---

## 🤝 3. Voluntariado

Incluye Hero, Beneficios, Áreas, Formulario y FAQ.

```html
<!-- wp:group {"tagName":"section","className":"voluntariado-hero fjp-section text-white","backgroundColor":"fjp-teal","layout":{"type":"constrained"}} -->
<section class="wp-block-group voluntariado-hero fjp-section text-white has-fjp-teal-background-color has-background"><!-- wp:columns {"verticalAlignment":"center"} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"width":"60%"} -->
<div class="wp-block-column" style="flex-basis:60%"><!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Sumate como voluntario/a</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"lead mb-4"} -->
<p class="lead mb-4">Formá parte de nuestro equipo y ayudanos a construir una comunidad más justa.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"btn-fjp-primary"} -->
<div class="wp-block-button btn-fjp-primary"><a class="wp-block-button__link wp-element-button" href="#formulario">Quiero ser voluntario</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"40%"} -->
<div class="wp-block-column" style="flex-basis:40%"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"rounded-3 shadow-lg"} -->
<figure class="wp-block-image size-large rounded-3 shadow-lg"><img src="https://via.placeholder.com/600x400" alt="Voluntarios"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","className":"fjp-section bg-light","layout":{"type":"constrained"}} -->
<section class="wp-block-group fjp-section bg-light"><!-- wp:heading {"textAlign":"center","className":"mb-5"} -->
<h2 class="wp-block-heading has-text-align-center mb-5">Beneficios de ser voluntario</h2>
<!-- /wp:heading -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"fjp-card p-4 text-center h-100","layout":{"type":"constrained"}} -->
<div class="wp-block-group fjp-card p-4 text-center h-100"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Desarrollo Personal</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Adquiere nuevas habilidades y experiencias valiosas.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"fjp-card p-4 text-center h-100","layout":{"type":"constrained"}} -->
<div class="wp-block-group fjp-card p-4 text-center h-100"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Networking</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Conoce personas con tus mismos valores.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"fjp-card p-4 text-center h-100","layout":{"type":"constrained"}} -->
<div class="wp-block-group fjp-card p-4 text-center h-100"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Impacto Social</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Contribuye al bienestar de tu comunidad.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->

<!-- wp:shortcode -->
[fjp_volunteer_testimonials]
<!-- /wp:shortcode -->

<!-- wp:shortcode -->
[fjp_volunteer_form]
<!-- /wp:shortcode -->

<!-- wp:group {"tagName":"section","className":"fjp-section","layout":{"type":"constrained"}} -->
<section class="wp-block-group fjp-section"><!-- wp:heading {"textAlign":"center","className":"mb-5"} -->
<h2 class="wp-block-heading has-text-align-center mb-5">Preguntas Frecuentes</h2>
<!-- /wp:heading -->

<!-- wp:details {"className":"mb-3"} -->
<details class="wp-block-details mb-3"><summary>¿Cuántas horas debo comprometerme?</summary><!-- wp:paragraph -->
<p>La cantidad de horas es flexible y depende de tu disponibilidad.</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details {"className":"mb-3"} -->
<details class="wp-block-details mb-3"><summary>¿Necesito experiencia previa?</summary><!-- wp:paragraph -->
<p>No necesariamente, nosotros proveemos capacitación.</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details --></section>
<!-- /wp:group -->
```

---

## 💸 4. Donaciones

Incluye Hero, Estadísticas, Formulario, Tipos y FAQ.

```html
<!-- wp:group {"tagName":"section","className":"fjp-hero-interior py-5","backgroundColor":"fjp-secondary","layout":{"type":"constrained"}} -->
<section class="wp-block-group fjp-hero-interior py-5 has-fjp-secondary-background-color has-background"><!-- wp:heading {"textAlign":"center","className":"text-white display-4 fw-bold"} -->
<h2 class="wp-block-heading has-text-align-center text-white display-4 fw-bold">Haz una Donación</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"text-white lead"} -->
<p class="has-text-align-center text-white lead">Tu aporte transforma vidas.</p>
<!-- /wp:paragraph --></section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","className":"fjp-section","layout":{"type":"constrained"}} -->
<section class="wp-block-group fjp-section"><!-- wp:columns {"className":"mb-5"} -->
<div class="wp-block-columns mb-5"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3,"textAlign":"center","className":"has-fjp-primary-color"} -->
<h3 class="wp-block-heading has-text-align-center has-fjp-primary-color">RD$500</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Alimenta una familia</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3,"textAlign":"center","className":"has-fjp-secondary-color"} -->
<h3 class="wp-block-heading has-text-align-center has-fjp-secondary-color">RD$1,000</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Útiles escolares</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3,"textAlign":"center","className":"has-fjp-accent-color"} -->
<h3 class="wp-block-heading has-text-align-center has-fjp-accent-color">RD$2,500</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Planta 50 árboles</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->

<!-- wp:shortcode -->
[fjp_donation_options]
<!-- /wp:shortcode -->

<!-- wp:group {"tagName":"section","className":"fjp-section bg-light","layout":{"type":"constrained"}} -->
<section class="wp-block-group fjp-section bg-light"><!-- wp:heading {"textAlign":"center","className":"mb-5"} -->
<h2 class="wp-block-heading has-text-align-center mb-5">Preguntas Frecuentes</h2>
<!-- /wp:heading -->

<!-- wp:details {"className":"mb-3"} -->
<details class="wp-block-details mb-3"><summary>¿Es seguro donar en línea?</summary><!-- wp:paragraph -->
<p>Sí, utilizamos plataformas encriptadas para tu seguridad.</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details {"className":"mb-3"} -->
<details class="wp-block-details mb-3"><summary>¿Puedo obtener un recibo?</summary><!-- wp:paragraph -->
<p>Sí, enviamos comprobantes fiscales vía email.</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details --></section>
<!-- /wp:group -->
```

---

## 📰 5. Noticias

La página de Noticias es principalmente dinámica, pero puedes agregar un Hero personalizado antes del loop automático.

```html
<!-- wp:group {"tagName":"section","className":"fjp-hero-interior py-5","backgroundColor":"fjp-primary","layout":{"type":"constrained"}} -->
<section class="wp-block-group fjp-hero-interior py-5 has-fjp-primary-background-color has-background"><!-- wp:heading {"textAlign":"center","className":"text-white display-4 fw-bold"} -->
<h2 class="wp-block-heading has-text-align-center text-white display-4 fw-bold">Noticias y Actualidad</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"text-white lead"} -->
<p class="has-text-align-center text-white lead">Mantente informado de nuestros últimos proyectos.</p>
<!-- /wp:paragraph --></section>
<!-- /wp:group -->

<!-- El resto del contenido (Grid de noticias y filtros) se carga automáticamente después de estos bloques -->
```
