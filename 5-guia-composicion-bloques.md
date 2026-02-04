# 🏗️ Guía de Composición de Bloques FJP

Esta guía detalla cómo reconstruir las páginas principales utilizando el editor de bloques nativo de WordPress. Copia el código y pégalo en el "Editor de Código" de cada página.

---

## 1. PÁGINA DE INICIO (HOME)

**Objetivo**: Impacto visual inmediato, resumen de métricas y acceso rápido a donaciones.

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
<figure class="wp-block-image size-large rounded-3 shadow"><img src="https://via.placeholder.com/600x400" alt="Hero Imagen" /></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->

<!-- wp:shortcode -->
[fjp_counter_section]
<!-- /wp:shortcode -->
```

---

## 2. QUIÉNES SOMOS

**Objetivo**: Presentar la misión, visión y valores de forma clara.

```html
<!-- wp:group {"tagName":"section","className":"fjp-section","layout":{"type":"constrained"}} -->
<section class="wp-block-group fjp-section"><!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"fjp-card p-4 h-100 text-center bg-light"} -->
<div class="wp-block-group fjp-card p-4 h-100 text-center bg-light"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Misión</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Impulsar el desarrollo integral de la juventud.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"fjp-card p-4 h-100 text-center bg-light"} -->
<div class="wp-block-group fjp-card p-4 h-100 text-center bg-light"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Visión</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Ser referente nacional en innovación social.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
```

---

## 3. VOLUNTARIADO

**Objetivo**: Inspirar a la acción y captar datos mediante formulario.

```html
<!-- wp:cover {"overlayColor":"fjp-teal","className":"voluntariado-hero fjp-section"} -->
<div class="wp-block-cover voluntariado-hero fjp-section"><span aria-hidden="true" class="wp-block-cover__background has-fjp-teal-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","level":1} -->
<h1 class="wp-block-heading has-text-align-center">Únete al Voluntariado</h1>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","className":"lead"} -->
<p class="has-text-align-center lead">Tu tiempo puede cambiar vidas.</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover -->

<!-- wp:shortcode -->
[fjp_volunteer_form]
<!-- /wp:shortcode -->
```

---

## 4. DONACIONES

**Objetivo**: Transparencia y facilidad de pago.

```html
<!-- wp:group {"tagName":"section","className":"fjp-hero-interior py-5","backgroundColor":"fjp-secondary","layout":{"type":"constrained"}} -->
<section class="wp-block-group fjp-hero-interior py-5 has-fjp-secondary-background-color has-background"><!-- wp:heading {"textAlign":"center","className":"text-white display-4 fw-bold"} -->
<h2 class="wp-block-heading has-text-align-center text-white display-4 fw-bold">Apoya Nuestra Causa</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","className":"text-white lead"} -->
<p class="has-text-align-center text-white lead">Cada aporte cuenta.</p>
<!-- /wp:paragraph --></section>
<!-- /wp:group -->

<!-- wp:shortcode -->
[fjp_donation_options]
<!-- /wp:shortcode -->
```
