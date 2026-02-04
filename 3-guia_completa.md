# 📘 GUÍA COMPLETA DE USO Y GESTIÓN - FUNDACIÓN JUVENTUD PROGRESISTA
## Tema Híbrido FJP para WordPress (Versión Avanzada)

---

## 🎯 INTRODUCCIÓN

Bienvenido a la guía oficial del sitio web de la Fundación Juventud Progresista. Este sitio ha sido diseñado con una **Arquitectura Híbrida Avanzada** sobre el tema Astra, combinando flexibilidad visual con solidez técnica.

### Componentes Clave:
1.  **Astra Customizer**: Para configurar colores globales, tipografías y el botón de WhatsApp.
2.  **Editor de Bloques (Gutenberg)**: Para editar el contenido de las páginas.
3.  **Hooks y Shortcodes**: Funcionalidades avanzadas inyectadas automáticamente.

---

## 📋 TABLA DE CONTENIDOS

1.  [Configuración Global (Personalizador)](#1-configuración-global-personalizador)
    *   [Colores y Estilos](#11-colores-y-estilos)
    *   [Botón de WhatsApp](#12-botón-de-whatsapp)
    *   [Ajustes de Layout](#13-ajustes-de-layout)
2.  [Gestión de Contenido (Editor)](#2-gestión-de-contenido-editor)
    *   [Patrones de Bloques](#21-patrones-de-bloques)
    *   [Páginas Clave](#22-páginas-clave)
3.  [Funcionalidades Avanzadas](#3-funcionalidades-avanzadas)
    *   [Noticias (CPT)](#31-noticias-cpt)
    *   [Donaciones (GiveWP)](#32-donaciones-givewp)

---

## 1. CONFIGURACIÓN GLOBAL (PERSONALIZADOR)

Todo lo relacionado con la apariencia global se gestiona desde **Apariencia > Personalizar**.

### 1.1 Colores y Estilos
El tema hijo hereda y extiende la paleta global de Astra.
*   Ve a **Apariencia > Personalizar > Colores Globales**.
*   Los colores de FJP están mapeados automáticamente a esta paleta:
    *   **Color 1 (Brand/Primary)** -> `--fjp-primary` (Botones principales, enlaces, encabezados).
    *   **Color 2 (Secondary)** -> `--fjp-secondary` (Botones secundarios, hover).
    *   **Color 3 (Text)** -> `--fjp-text` (Texto general).
    *   **Color 4 (Background)** -> `--fjp-background` (Fondos).

### 1.2 Botón de WhatsApp
El botón flotante de WhatsApp es totalmente personalizable.
1.  Ve a **Apariencia > Personalizar > FJP Ajustes Globales**.
2.  Entra en la sección **Botón de WhatsApp**.
3.  **Número**: Ingresa el número con código de país (ej: `+54911...`).
4.  **Mensaje**: Escribe el mensaje predeterminado que aparecerá en el chat del usuario.
5.  Los cambios se verán en tiempo real en la previsualización.

### 1.3 Ajustes de Layout
En el mismo panel **FJP Ajustes Globales**, puedes activar opciones como:
*   **Header Pegajoso (Sticky)**: Para que el menú siga al usuario.
*   **Créditos del Footer**: Personaliza el texto de copyright al pie de página.

---

## 2. GESTIÓN DE CONTENIDO (EDITOR)

### 2.1 Patrones de Bloques
No necesitas diseñar desde cero. Usa los **Patrones FJP**.
1.  En el editor, haz clic en el **`+`** (arriba a la izquierda).
2.  Ve a la pestaña **Patrones**.
3.  Explora las categorías para encontrar secciones pre-diseñadas (Hero, Contadores, Llamadas a la acción).

### 2.2 Páginas Clave
*   **Inicio**: Usa un patrón "Hero" con imagen de fondo y botones.
*   **Voluntariado**: Contiene un formulario de inscripción integrado.
*   **Donaciones**: Integra el formulario de GiveWP o botones de pago directo.

**Nota**: Si borras todo el contenido de una página, el sistema mostrará automáticamente un diseño de respaldo (Fallback) seguro.

---

## 3. FUNCIONALIDADES AVANZADAS

### 3.1 Noticias (CPT)
Las noticias no son "Entradas" normales, tienen su propio apartado.
*   Ve a **Noticias > Añadir Nueva**.
*   Completa el título y el contenido.
*   **Campos Personalizados (Abajo del editor)**:
    *   **Fuente**: Medio original (si es externa).
    *   **URL Externa**: Si llenas esto, la noticia redirigirá automáticamente al sitio original.
    *   **Fecha**: Fecha de publicación original.
*   La página `/noticias` se actualiza automáticamente.

### 3.2 Donaciones (GiveWP)
Si el plugin GiveWP está activo:
*   Gestiona los formularios en **Donaciones > Todos los formularios**.
*   Para insertar un formulario en una página, usa el bloque "Shortcode" con `[give_form id="123"]`.

---

**Soporte Técnico**
*   Los archivos del tema se encuentran en `wp-content/themes/fjp-tema-hijo`.
*   La lógica principal está modularizada en la carpeta `inc/`.
*   No edites directamente los archivos `.php` a menos que seas desarrollador. Usa el Personalizador o el Editor de Bloques.
