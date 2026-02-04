# 📘 GUÍA COMPLETA DE USO Y GESTIÓN - FUNDACIÓN JUVENTUD PROGRESISTA
## Tema Híbrido FJP para WordPress (Versión Avanzada)

---

## 🎯 INTRODUCCIÓN

Bienvenido a la guía oficial del sitio web de la Fundación Juventud Progresista. Este sitio utiliza una **Arquitectura Híbrida Avanzada** que combina:

1.  **Editor de Bloques (Gutenberg)**: Para editar textos, imágenes y estructura de las páginas de manera visual.
2.  **Sistema "Pro" de Layouts**: Opciones avanzadas por página para controlar cabeceras, pies de página y anchos.
3.  **Patrones de Bloques**: Diseños prefabricados que puedes insertar con un clic.
4.  **Design Tokens**: Estilos globales centralizados.

---

## 📋 TABLA DE CONTENIDOS

1.  [Opciones de Diseño FJP (Estilo Pro)](#1-opciones-de-diseño-fjp-estilo-pro)
2.  [Patrones de Bloques: Diseña Rápido](#2-patrones-de-bloques-diseña-rápido)
3.  [Arquitectura Híbrida y Fallbacks](#3-arquitectura-híbrida-y-fallbacks)
4.  [Design Tokens (Colores y Fuentes)](#4-design-tokens-colores-y-fuentes)
5.  [Componentes Dinámicos (Shortcodes)](#5-componentes-dinámicos-shortcodes)

---

## 1. OPCIONES DE DISEÑO FJP (ESTILO PRO)

Hemos desbloqueado capacidades avanzadas de personalización directamente en el editor de cada página.

### ⚙️ Panel "Opciones de Diseño FJP"
Al editar cualquier página, busca en la barra lateral derecha el panel **"⚙️ Opciones de Diseño FJP"**.

#### Funciones Disponibles:
*   **Header Transparente**: Actívalo para que el menú se superponga a la imagen principal (ideal para la Home).
*   **Header Pegajoso (Sticky)**: Hace que el menú te siga al hacer scroll hacia abajo.
*   **Ocultar Título**: Elimina el título automático de la página (H1) para que puedas diseñar tu propio Hero con bloques.
*   **Ocultar Footer**: Útil para Landing Pages donde no quieres distracciones.

---

## 2. PATRONES DE BLOQUES: DISEÑA RÁPIDO

Ya no dependes de plantillas fijas. Hemos convertido los diseños originales en **Patrones**.

### ¿Cómo usarlos?
1.  En el editor de una página, haz clic en el botón **`+`** (arriba a la izquierda).
2.  Ve a la pestaña **Patrones**.
3.  Selecciona la categoría **"FJP Secciones"** o **"FJP Páginas Completas"**.
4.  Haz clic en un diseño (ej: "Hero Home", "Contadores", "Página Home Completa") y se insertará automáticamente.
5.  **¡Edita todo!** Cambia textos, imágenes y colores directamente haciendo clic sobre ellos.

---

## 3. ARQUITECTURA HÍBRIDA Y FALLBACKS

El tema sigue siendo seguro ante fallos ("Safe-Fail").

1.  **Si borras todo el contenido**: La página mostrará automáticamente un diseño por defecto (Fallback PHP) para que nunca se vea rota.
2.  **Si añades un bloque**: El sistema detecta que quieres personalizar y te da control total.

---

## 4. DESIGN TOKENS (COLORES Y FUENTES)

Para cambiar la identidad visual de todo el sitio:
1.  Ve a **Apariencia > Editor** (o abre los estilos en una página).
2.  Haz clic en el icono **"Estilos"** (círculo mitad negro/blanco).
3.  Edita la **Paleta de Colores**.
    *   Los cambios se aplican instantáneamente al CSS (`style.css`) y a todos los bloques.

---

## 5. COMPONENTES DINÁMICOS (SHORTCODES)

Siguen disponibles para funcionalidades complejas:

*   `[fjp_news_loop]` - Grid de noticias.
*   `[fjp_alliances_loop]` - Carrusel de aliados.
*   `[fjp_volunteer_form]` - Formulario de inscripción.
*   `[fjp_donation_options]` - Tarjetas de donación.

---

**Soporte Técnico**
Si las opciones de diseño no aparecen, asegúrate de estar editando una "Página" y no una "Entrada", y revisa que el plugin ACF esté activo (aunque estas opciones son nativas del tema hijo).
