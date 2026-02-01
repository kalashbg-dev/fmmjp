# 📘 GUÍA COMPLETA DE USO Y GESTIÓN - FUNDACIÓN JUVENTUD PROGRESISTA
## Tema Híbrido FJP para WordPress

---

## 🎯 INTRODUCCIÓN

Bienvenido a la guía oficial del sitio web de la Fundación Juventud Progresista. Este sitio utiliza una **Arquitectura Híbrida** moderna que combina:

1.  **Editor de Bloques (Gutenberg)**: Para editar textos, imágenes y estructura de las páginas de manera visual.
2.  **Componentes Dinámicos (Shortcodes)**: Para secciones automáticas como Noticias, Alianzas y Donaciones.
3.  **Design Tokens**: Un sistema de diseño centralizado para mantener la coherencia visual.

---

## 📋 TABLA DE CONTENIDOS

1.  [Instalación del Tema](#1-instalación-del-tema)
2.  [Gestión de Contenido (Páginas)](#2-gestión-de-contenido-páginas)
3.  [Componentes Dinámicos (Shortcodes)](#3-componentes-dinámicos-shortcodes)
4.  [Configuración de Noticias](#4-configuración-de-noticias)
5.  [Sistema de Donaciones](#5-sistema-de-donaciones)
6.  [Personalización Visual](#6-personalización-visual)

---

## 1. INSTALACIÓN DEL TEMA

### Requisitos Previos
- WordPress 6.0 o superior
- PHP 8.0 o superior
- Plugin **Advanced Custom Fields** (Gratuito)
- Plugin **GiveWP** (Gratuito - Opcional para donaciones)

### Pasos
1.  Sube la carpeta `fjp-tema-hijo` a `/wp-content/themes/`.
2.  Activa el tema "FJP - Fundación Juventud Progresista" desde Apariencia > Temas.
3.  Instala los plugins requeridos.
4.  Importa la configuración de campos desde `acf-export.json` en ACF > Herramientas > Importar.

---

## 2. GESTIÓN DE CONTENIDO (PÁGINAS)

Las páginas principales (`Home`, `Quiénes Somos`, `Donaciones`, `Voluntariado`) son **contenedores dinámicos**. Esto significa que puedes borrar y reescribir todo su contenido visualmente.

### Cómo editar una página:
1.  Ve a **Páginas** y selecciona la que deseas editar.
2.  Usa el editor para añadir:
    -   **Encabezados y Párrafos**: Para el texto narrativo.
    -   **Imágenes y Fondos**: Para las secciones visuales (Hero).
    -   **Columnas**: Para organizar el contenido.
3.  Para insertar funcionalidades especiales (como el listado de noticias), usa los **Shortcodes** (ver sección 3).

> **💡 Tip:** Consulta el archivo `5-guia-composicion-bloques.md` para ver el código base de cada página y copiarlo si necesitas restaurar el diseño original.

---

## 3. COMPONENTES DINÁMICOS (SHORTCODES)

Copia y pega estos códigos breves (shortcodes) dentro de un bloque "Shortcode" en el editor para mostrar secciones automáticas.

### 📰 Noticias
Muestra una cuadrícula con las últimas noticias publicadas.
```
[fjp_news_loop posts="3" title="Últimas Noticias"]
```

### 🤝 Alianzas
Muestra los logos de las organizaciones aliadas.
```
[fjp_alliances_loop posts="6"]
```

### 💬 Testimonios
Muestra testimonios cargados en el sistema.
```
[fjp_testimonials_loop]
```
*Para la página de voluntariado (testimonios específicos):*
```
[fjp_volunteer_testimonials]
```

### 📊 Contadores de Impacto
Muestra las estadísticas animadas.
```
[fjp_contador_impacto libras="56966" voluntarios="1341" provincias="32"]
```

### ❤️ Opciones de Donación
Muestra las tarjetas con opciones para donar.
```
[fjp_donation_options]
```

### 📝 Formulario de Voluntariado
Muestra el formulario de inscripción.
```
[fjp_volunteer_form]
```

---

## 4. CONFIGURACIÓN DE NOTICIAS

Para agregar una noticia nueva:
1.  Ve a **Noticias > Añadir nueva**.
2.  Escribe el título y el contenido principal.
3.  Sube una **Imagen Destacada** (columna derecha).
4.  Completa los **Campos Personalizados** (debajo del editor):
    -   *Fecha de Publicación*
    -   *Fuente / Autor*
    -   *URL Externa* (si la noticia es de otro sitio)
    -   *Categoría Temática*

---

## 5. SISTEMA DE DONACIONES

El tema soporta **GiveWP** para procesar donaciones.
- Si GiveWP está activo, los botones de donación abrirán el formulario automático.
- Si no está activo, se mostrarán enlaces alternativos (PayPal/Transferencia) configurados en el shortcode.

---

## 6. PERSONALIZACIÓN VISUAL

Los colores y tipografías están centralizados. Para cambiarlos globalmente, un desarrollador debe editar el archivo `style.css` y modificar las variables en `:root`.

```css
:root {
    --fjp-primary: #0056D2; /* Color principal */
    --fjp-secondary: #28A745; /* Color secundario */
    /* ... */
}
```

---

**Soporte Técnico**
Si encuentras problemas, revisa que los plugins estén activos y que los campos de ACF se hayan importado correctamente.
