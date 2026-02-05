# 📘 GUÍA COMPLETA DE USO Y GESTIÓN - FUNDACIÓN JUVENTUD PROGRESISTA
## Tema Híbrido FJP para WordPress (Versión Avanzada)

---

## 🎯 INTRODUCCIÓN

Bienvenido a la guía oficial del sitio web de la Fundación Juventud Progresista. Este documento es tu manual paso a paso para gestionar, editar y mantener el sitio web.

### 📌 Conceptos Clave
*   **Editor de Bloques (Gutenberg)**: Es la herramienta visual donde escribirás textos y subirás fotos.
*   **Personalizador (Customizer)**: Donde cambias colores globales, el botón de WhatsApp y el logo.
*   **CPT (Custom Post Types)**: Menús especiales para "Noticias", "Voluntarios", "Alianzas", etc.

---

## 📋 TABLA DE CONTENIDOS

1.  [Cómo Crear y Editar Páginas (Paso a Paso)](#1-cómo-crear-y-editar-páginas)
2.  [Guía de Bloques y Patrones](#2-guía-de-bloques-y-patrones)
3.  [Gestión de Noticias, Voluntarios y Alianzas](#3-gestión-de-noticias-voluntarios-y-alianzas)
4.  [Configuración del Sitio (Colores y WhatsApp)](#4-configuración-del-sitio)
5.  [Solución de Problemas Comunes](#5-solución-de-problemas-comunes)

---

## 1. CÓMO CREAR Y EDITAR PÁGINAS (PASO A PASO)

### Editar la Página de Inicio (Home)
1.  Ve al Panel de Administración > **Páginas**.
2.  Busca la página "Home" o "Inicio" y haz clic en **Editar**.
3.  Verás el editor visual. Haz clic en cualquier texto para cambiarlo.
4.  Para cambiar una imagen: Haz clic en la imagen > "Reemplazar" > Subir o Biblioteca de Medios.
5.  **Importante**: Si la página se ve vacía o rota, copia el código del [Capítulo 2](#2-guía-de-bloques-y-patrones) y pégalo en el editor de código.

### Editar la Página de Voluntariado
Esta página tiene secciones automáticas (los testimonios vienen del menú "Testimonios").
1.  Edita la página "Voluntariado".
2.  Puedes cambiar el título "Sumate como voluntario/a" y la descripción directamente en los bloques.
3.  **El Formulario**: Es un bloque especial `[fjp_volunteer_form]`. No lo borres.

---

## 2. GUÍA DE BLOQUES Y PATRONES (COPIAR Y PEGAR)

Si necesitas reconstruir una página desde cero, usa estos códigos.

### 🛠️ Cómo usar estos códigos:
1.  En el editor de la página, ve a los tres puntos (arriba derecha) > **Editor de código**.
2.  Borra todo.
3.  Copia el bloque de código abajo y pégalo.
4.  Vuelve a **Editor visual** para ver el resultado.

### 🏠 PÁGINA DE INICIO (HOME)

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
<figure class="wp-block-image size-large rounded-3 shadow"><img src="https://via.placeholder.com/600x400" alt="Hero Imagen"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->

<!-- wp:shortcode -->
[fjp_counter_section]
<!-- /wp:shortcode -->

<!-- wp:heading {"textAlign":"center","className":"mt-5"} -->
<h2 class="wp-block-heading has-text-align-center mt-5">Nuestras Alianzas</h2>
<!-- /wp:heading -->

<!-- wp:shortcode -->
[fjp_alliances_loop]
<!-- /wp:shortcode -->
```

### 🤝 PÁGINA DE VOLUNTARIADO

```html
<!-- wp:cover {"overlayColor":"fjp-teal","className":"voluntariado-hero fjp-section"} -->
<div class="wp-block-cover voluntariado-hero fjp-section"><span aria-hidden="true" class="wp-block-cover__background has-fjp-teal-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","level":1} -->
<h1 class="wp-block-heading has-text-align-center">Únete al Voluntariado</h1>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","className":"lead"} -->
<p class="has-text-align-center lead">Tu tiempo puede cambiar vidas.</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover -->

<!-- wp:group {"className":"container my-5"} -->
<div class="wp-block-group container my-5"><!-- wp:heading -->
<h2 class="wp-block-heading">Inscríbete</h2>
<!-- /wp:heading -->
<!-- wp:shortcode -->
[fjp_volunteer_form]
<!-- /wp:shortcode --></div>
<!-- /wp:group -->
```

---

## 3. GESTIÓN DE NOTICIAS, VOLUNTARIOS Y ALIANZAS

El sitio usa menús especiales en la barra lateral izquierda del administrador.

### 📰 Noticias
1.  Ve a **Noticias > Añadir Nueva**.
2.  Escribe el Título y el Contenido.
3.  **Imagen Destacada** (Barra derecha): Es la foto principal que se ve en la lista.
4.  **Datos de la Noticia** (Abajo del editor):
    *   **Fecha**: Cuándo ocurrió.
    *   **Fuente**: Medio original (ej: Diario Libre).
    *   **URL**: Si pones un link aquí, al hacer clic en la noticia llevará a esa web externa.

### 🗣️ Testimonios
Aparecen en la Home y en Voluntariado.
1.  Ve a **Testimonios > Añadir Nuevo**.
2.  **Título**: Nombre de la persona.
3.  **Contenido**: El texto de lo que dijo.
4.  **Cargo / Rol**: (Campo personalizado abajo) Ej: "Voluntaria Educativa".
5.  **Imagen Destacada**: Foto de la persona.

### 🤝 Alianzas
Logos de empresas o instituciones aliadas.
1.  Ve a **Alianzas > Añadir Nueva**.
2.  **Título**: Nombre de la organización.
3.  **Imagen Destacada**: El logo (preferiblemente fondo transparente PNG).

---

## 4. CONFIGURACIÓN DEL SITIO (COLORES Y WHATSAPP)

### 🎨 Cambiar Colores
1.  Ve a **Apariencia > Personalizar > Colores Globales**.
2.  Cambia los colores de la paleta.
    *   El sitio está conectado a esta paleta: si cambias el "Color Principal", cambiarán todos los botones y títulos automáticamente.

### 📞 Botón de WhatsApp
1.  Ve a **Apariencia > Personalizar > FJP Ajustes Globales**.
2.  Busca la sección **Botón de WhatsApp**.
3.  Cambia el número y el mensaje.
4.  Haz clic en **Publicar**.

---

## 5. SOLUCIÓN DE PROBLEMAS COMUNES

**El menú se ve raro al bajar (Sticky Header)**
*   Asegúrate de que en **Apariencia > Personalizar > FJP Ajustes Globales** esté activado "Header Pegajoso". El sistema arregla automáticamente el tamaño.

**Las secciones de Voluntariado se ven horizontales en móvil**
*   Hemos corregido esto en el código. Si persiste, edita la página y asegúrate de que los bloques estén dentro de "Columnas" configuradas para apilarse en móvil.

**No veo los campos personalizados (Fecha, Fuente)**
*   Asegúrate de que el plugin **Advanced Custom Fields (ACF)** esté activo. Si lo está, ve a la pantalla de edición de la Noticia y busca la caja "Configuración de Noticias" debajo del editor de texto. Si no la ves, haz clic en los tres puntos (arriba derecha) > Preferencias > Paneles y activa los campos personalizados.
