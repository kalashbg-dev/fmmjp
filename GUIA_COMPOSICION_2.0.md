# Guía de Construcción Manual (Modo Avanzado)

Esta guía proporciona el código fuente para construir las páginas del sitio utilizando **Bloques Nativos de Gutenberg y Astra**. Esto garantiza máxima compatibilidad, velocidad y facilidad de edición visual.

## Instrucciones de Uso
1.  Cree una nueva página en WordPress.
2.  **IMPORTANTE:** En la barra lateral derecha, bajo "Atributos de página", seleccione la plantilla **"FJP - Ancho Completo (Canvas)"**.
3.  Haga clic en los tres puntos verticales (arriba derecha) > **Editor de código**.
4.  Copie el bloque de código deseado de abajo y péguelo en el editor.
5.  Salga del editor de código para ver y personalizar el diseño visualmente.

---

## 1. CSS de Animaciones y Efectos (Copiar en Personalizar)

Para que los bloques tengan movimiento y estilos especiales, vaya a **Apariencia > Personalizar > CSS Adicional** y pegue este código.

```css
/* Animación de entrada suave */
.fjp-animate-fadein {
    animation: fadeInUp 1s ease-out;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Efecto Hover en Columnas/Tarjetas */
.fjp-hover-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.fjp-hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}

/* Texto con Gradiente (Usa colores globales) */
.fjp-text-gradient {
    background: linear-gradient(135deg, var(--wp--preset--color--primary), var(--wp--preset--color--secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
```

---

## 2. Bloques de Página: Inicio (Home)

```html
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"backgroundColor":"ast-global-color-4","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-ast-global-color-4-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
    <!-- wp:cover {"url":"https://via.placeholder.com/1920x800","dimRatio":60,"overlayColor":"ast-global-color-0","align":"full","layout":{"type":"constrained"}} -->
    <div class="wp-block-cover alignfull">
        <span aria-hidden="true" class="wp-block-cover__background has-ast-global-color-0-background-color has-background-dim-60 has-background-dim"></span>
        <img class="wp-block-cover__image-background" src="https://via.placeholder.com/1920x800" alt="Fondo Hero" data-object-fit="cover"/>
        <div class="wp-block-cover__inner-container">
            <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"3.5rem"}},"textColor":"white","className":"fjp-animate-fadein"} -->
            <h1 class="wp-block-heading has-text-align-center fjp-animate-fadein has-white-color has-text-color" style="font-size:3.5rem">Juntos construyendo un futuro mejor</h1>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.2rem"}},"textColor":"white"} -->
            <p class="has-text-align-center has-white-color has-text-color" style="font-size:1.2rem">La Fundación Juventud Progresista trabaja incansablemente para el desarrollo sostenible.</p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
            <div class="wp-block-buttons">
                <!-- wp:button {"backgroundColor":"primary","style":{"border":{"radius":"50px"}},"className":"is-style-fill"} -->
                <div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-primary-background-color has-background wp-element-button" style="border-radius:50px">Donar Ahora</a></div>
                <!-- /wp:button -->

                <!-- wp:button {"style":{"border":{"radius":"50px","width":"2px"}},"className":"is-style-outline","textColor":"white"} -->
                <div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-white-color has-text-color wp-element-button" style="border-radius:50px;border-width:2px">Ser Voluntario</a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
    </div>
    <!-- /wp:cover -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"60px","bottom":"60px"}}},"backgroundColor":"white","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-white-background-color has-background" style="padding-top:60px;padding-bottom:60px">
    <!-- wp:shortcode -->
    [fjp_contador_impacto libras="50000" voluntarios="1200" provincias="15"]
    <!-- /wp:shortcode -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"80px","bottom":"80px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:80px;padding-bottom:80px">
    <!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"2rem","left":"2rem"}}}} -->
    <div class="wp-block-columns alignwide">
        <!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center">
            <!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"is-style-default rounded shadow"} -->
            <figure class="wp-block-image size-large is-style-default rounded shadow"><img src="https://via.placeholder.com/800x600" alt=""/></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center">
            <!-- wp:heading {"className":"fjp-text-gradient"} -->
            <h2 class="wp-block-heading fjp-text-gradient">Nuestra Misión</h2>
            <!-- /wp:heading -->
            <!-- wp:paragraph -->
            <p>Somos una organización sin fines de lucro dedicada a empoderar a la juventud y fomentar el desarrollo integral de las comunidades más vulnerables.</p>
            <!-- /wp:paragraph -->
            <!-- wp:buttons -->
            <div class="wp-block-buttons">
                <!-- wp:button {"backgroundColor":"primary","style":{"border":{"radius":"50px"}}} -->
                <div class="wp-block-button"><a class="wp-block-button__link has-primary-background-color has-background wp-element-button" style="border-radius:50px">Leer Más</a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide"} -->
<div class="wp-block-group alignwide">
    <!-- wp:heading {"textAlign":"center"} -->
    <h2 class="wp-block-heading has-text-align-center">Últimas Noticias</h2>
    <!-- /wp:heading -->
    <!-- wp:shortcode -->
    [fjp_news_loop posts="3"]
    <!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
```

---

## 3. Bloques de Página: Voluntariado

```html
<!-- wp:cover {"url":"https://via.placeholder.com/1920x600","dimRatio":70,"overlayColor":"ast-global-color-2","align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull">
    <span aria-hidden="true" class="wp-block-cover__background has-ast-global-color-2-background-color has-background-dim-70 has-background-dim"></span>
    <img class="wp-block-cover__image-background" src="https://via.placeholder.com/1920x600" alt="" data-object-fit="cover"/>
    <div class="wp-block-cover__inner-container">
        <!-- wp:heading {"textAlign":"center","level":1,"textColor":"white"} -->
        <h1 class="wp-block-heading has-text-align-center has-white-color has-text-color">Únete al Voluntariado</h1>
        <!-- /wp:heading -->
        <!-- wp:paragraph {"align":"center","textColor":"white"} -->
        <p class="has-text-align-center has-white-color has-text-color">Tu tiempo y talento pueden transformar vidas.</p>
        <!-- /wp:paragraph -->
    </div>
</div>
<!-- /wp:cover -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"60px","bottom":"60px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:60px;padding-bottom:60px">
    <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"40px"}}}} -->
    <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:40px">Beneficios de ser Voluntario</h2>
    <!-- /wp:heading -->

    <!-- wp:columns {"style":{"spacing":{"blockGap":"2rem"}}} -->
    <div class="wp-block-columns">
        <!-- wp:column {"className":"fjp-hover-card has-white-background-color has-background","style":{"border":{"radius":"15px"},"spacing":{"padding":{"top":"30px","right":"30px","bottom":"30px","left":"30px"}}}} -->
        <div class="wp-block-column fjp-hover-card has-white-background-color has-background" style="border-radius:15px;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px">
            <!-- wp:heading {"level":4,"textAlign":"center","textColor":"primary"} -->
            <h4 class="wp-block-heading has-text-align-center has-primary-color has-text-color">Desarrollo Personal</h4>
            <!-- /wp:heading -->
            <!-- wp:paragraph {"align":"center"} -->
            <p class="has-text-align-center">Adquiere nuevas habilidades para tu futuro.</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"className":"fjp-hover-card has-white-background-color has-background","style":{"border":{"radius":"15px"},"spacing":{"padding":{"top":"30px","right":"30px","bottom":"30px","left":"30px"}}}} -->
        <div class="wp-block-column fjp-hover-card has-white-background-color has-background" style="border-radius:15px;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px">
            <!-- wp:heading {"level":4,"textAlign":"center","textColor":"secondary"} -->
            <h4 class="wp-block-heading has-text-align-center has-secondary-color has-text-color">Impacto Social</h4>
            <!-- /wp:heading -->
            <!-- wp:paragraph {"align":"center"} -->
            <p class="has-text-align-center">Ayuda a construir una mejor sociedad.</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"className":"fjp-hover-card has-white-background-color has-background","style":{"border":{"radius":"15px"},"spacing":{"padding":{"top":"30px","right":"30px","bottom":"30px","left":"30px"}}}} -->
        <div class="wp-block-column fjp-hover-card has-white-background-color has-background" style="border-radius:15px;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px">
            <!-- wp:heading {"level":4,"textAlign":"center","textColor":"primary"} -->
            <h4 class="wp-block-heading has-text-align-center has-primary-color has-text-color">Networking</h4>
            <!-- /wp:heading -->
            <!-- wp:paragraph {"align":"center"} -->
            <p class="has-text-align-center">Conecta con personas con tus mismos valores.</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- wp:shortcode -->
[fjp_volunteer_testimonials]
<!-- /wp:shortcode -->

<!-- wp:group {"align":"full","backgroundColor":"ast-global-color-5","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-ast-global-color-5-background-color has-background">
    <!-- wp:shortcode -->
    [fjp_volunteer_form]
    <!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
```

---

## 4. Bloques de Página: Quiénes Somos

```html
<!-- wp:group {"align":"full","backgroundColor":"white","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-white-background-color has-background">
    <!-- wp:columns {"align":"wide","style":{"spacing":{"padding":{"top":"60px","bottom":"60px"}}}} -->
    <div class="wp-block-columns alignwide" style="padding-top:60px;padding-bottom:60px">
        <!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center">
            <!-- wp:heading {"className":"fjp-text-gradient"} -->
            <h2 class="wp-block-heading fjp-text-gradient">Nuestra Historia</h2>
            <!-- /wp:heading -->
            <!-- wp:paragraph -->
            <p>Desde 2010, hemos trabajado incansablemente para mejorar la calidad de vida de las comunidades dominicanas.</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->
        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"rounded shadow"} -->
            <figure class="wp-block-image size-large rounded shadow"><img src="https://via.placeholder.com/600x400" alt=""/></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","backgroundColor":"ast-global-color-0","textColor":"white","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-white-color has-ast-global-color-0-background-color has-text-color has-background">
    <!-- wp:heading {"textAlign":"center","textColor":"white"} -->
    <h2 class="wp-block-heading has-text-align-center has-white-color">Nuestros Valores</h2>
    <!-- /wp:heading -->
    <!-- wp:columns {"align":"wide","style":{"spacing":{"padding":{"top":"40px","bottom":"40px"}}}} -->
    <div class="wp-block-columns alignwide" style="padding-top:40px;padding-bottom:40px">
        <!-- wp:column {"className":"has-text-align-center"} -->
        <div class="wp-block-column has-text-align-center">
            <!-- wp:heading {"level":4,"textColor":"white"} -->
            <h4 class="wp-block-heading has-white-color">Solidaridad</h4>
            <!-- /wp:heading -->
        </div>
        <!-- /wp:column -->
        <!-- wp:column {"className":"has-text-align-center"} -->
        <div class="wp-block-column has-text-align-center">
            <!-- wp:heading {"level":4,"textColor":"white"} -->
            <h4 class="wp-block-heading has-white-color">Integridad</h4>
            <!-- /wp:heading -->
        </div>
        <!-- /wp:column -->
        <!-- wp:column {"className":"has-text-align-center"} -->
        <div class="wp-block-column has-text-align-center">
            <!-- wp:heading {"level":4,"textColor":"white"} -->
            <h4 class="wp-block-heading has-white-color">Pasión</h4>
            <!-- /wp:heading -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- wp:shortcode -->
[fjp_alliances_loop title="Nuestros Aliados"]
<!-- /wp:shortcode -->
```

---

## 5. Bloques de Página: Donaciones

```html
<!-- wp:cover {"url":"https://via.placeholder.com/1920x600","dimRatio":50,"overlayColor":"ast-global-color-1","align":"full"} -->
<div class="wp-block-cover alignfull">
    <span aria-hidden="true" class="wp-block-cover__background has-ast-global-color-1-background-color has-background-dim-50 has-background-dim"></span>
    <img class="wp-block-cover__image-background" src="https://via.placeholder.com/1920x600" alt="" data-object-fit="cover"/>
    <div class="wp-block-cover__inner-container">
        <!-- wp:heading {"textAlign":"center","level":1,"textColor":"white"} -->
        <h1 class="wp-block-heading has-text-align-center has-white-color has-text-color">Tu Aporte Cambia Vidas</h1>
        <!-- /wp:heading -->
    </div>
</div>
<!-- /wp:cover -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"60px","bottom":"60px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:60px;padding-bottom:60px">
    <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"40px"}}}} -->
    <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:40px">¿Cómo ayudar?</h2>
    <!-- /wp:heading -->

    <!-- wp:shortcode -->
    [fjp_donation_options]
    <!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
```

---

## 6. Bloques de Página: Noticias

```html
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"60px","bottom":"60px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:60px;padding-bottom:60px">
    <!-- wp:heading {"level":1,"style":{"spacing":{"margin":{"bottom":"40px"}}}} -->
    <h1 class="wp-block-heading" style="margin-bottom:40px">Noticias y Actualidad</h1>
    <!-- /wp:heading -->

    <!-- wp:shortcode -->
    [fjp_news_loop posts="9"]
    <!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
```

---

## Anexo: Shortcodes Disponibles

Si necesita insertar funcionalidades específicas en cualquier lugar:

*   `[fjp_volunteer_form]`: Formulario de inscripción.
*   `[fjp_news_loop posts="3"]`: Grilla de noticias.
*   `[fjp_testimonials_loop]`: Slider de testimonios.
*   `[fjp_volunteer_testimonials]`: Testimonios de voluntarios (requiere configurar la página).
*   `[fjp_alliances_loop]`: Logos de aliados.
*   `[fjp_contador_impacto]`: Contadores animados.
*   `[fjp_donation_options]`: Opciones de donación.
