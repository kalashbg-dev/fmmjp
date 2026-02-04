# 📘 GUÍA COMPLETA DE USO Y GESTIÓN - FUNDACIÓN JUVENTUD PROGRESISTA
## Tema Híbrido FJP para WordPress

---

## 🎯 INTRODUCCIÓN

Bienvenido a la guía oficial del sitio web de la Fundación Juventud Progresista. Este sitio utiliza una **Arquitectura Híbrida Avanzada** que combina lo mejor de dos mundos:

1.  **Editor de Bloques (Gutenberg)**: Para editar textos, imágenes y estructura de las páginas de manera visual y flexible.
2.  **Plantillas Inteligentes con Fallback**: Si no añades contenido en el editor, el sitio mostrará automáticamente un diseño profesional predefinido (contenido original).
3.  **Design Tokens (Variables CSS)**: Un sistema centralizado para controlar la identidad visual (colores, tipografías, espaciados) de forma global.

---

## 📋 TABLA DE CONTENIDOS

1.  [Arquitectura Híbrida: ¿Cómo funciona?](#1-arquitectura-híbrida-cómo-funciona)
2.  [Gestión de Diseño y Estilos (Design Tokens)](#2-gestión-de-diseño-y-estilos-design-tokens)
3.  [Gestión de Contenido y Layouts](#3-gestión-de-contenido-y-layouts)
4.  [Componentes Dinámicos (Shortcodes)](#4-componentes-dinámicos-shortcodes)
5.  [Configuración de Noticias](#5-configuración-de-noticias)
6.  [Sistema de Donaciones](#6-sistema-de-donaciones)
7.  [Personalización Visual](#7-personalización-visual)

---

## 1. ARQUITECTURA HÍBRIDA: ¿CÓMO FUNCIONA?

El tema `fjp-tema-hijo` ha sido refactorizado para ser **"Block-Ready"** (listo para bloques) pero **"Safe-Fail"** (seguro ante fallos).

### Lógica de Visualización (Fallback)
Cada página principal (`Home`, `Quiénes Somos`, `Donaciones`, `Voluntariado`) sigue esta lógica inteligente:

1.  **Verificación**: El sistema revisa si has añadido algún bloque en el editor de la página.
2.  **Si HAY Bloques**: Se muestra **TU** contenido personalizado. Tienes control total del diseño.
3.  **Si NO HAY Bloques (o están vacíos)**: Se muestra automáticamente el **Contenido Original Estático**.

---

## 2. GESTIÓN DE DISEÑO Y ESTILOS (DESIGN TOKENS)

Hemos centralizado la identidad visual en **Design Tokens**. Esto significa que los colores y fuentes están definidos en un solo lugar y se sincronizan entre el Editor y el Frontend.

### 🎨 ¿Dónde editar los Colores y Fuentes?
**IMPORTANTE:** Al ser un tema híbrido moderno, la configuración de estilos NO está en "Apariencia > Personalizar" (Customizer clásico), sino en los **Estilos Globales**.

1.  Ve a **Apariencia > Editor** (si está disponible) o abre cualquier página en el editor de bloques.
2.  Haz clic en el icono **"Estilos"** (círculo mitad negro/blanco) en la esquina superior derecha.
3.  Aquí verás la paleta de colores oficial (Azul Primario, Verde Secundario, etc.).
4.  **Si cambias un color aquí**, se actualizará automáticamente en:
    *   Todos los bloques del sitio.
    *   El código CSS personalizado (`style.css`), gracias a la vinculación de variables.

### Variables CSS (Para Desarrolladores)
Estas variables están en `style.css` y están vinculadas a `theme.json`:

| Variable CSS | Descripción | Valor por Defecto |
| :--- | :--- | :--- |
| `--fjp-primary` | Azul Institucional | `var(--wp--preset--color--fjp-primary)` |
| `--fjp-secondary` | Verde Esperanza | `var(--wp--preset--color--fjp-secondary)` |

---

## 3. GESTIÓN DE CONTENIDO Y LAYOUTS

### Control de Ancho (Boxed vs Full Width)
El tema ahora respeta completamente las configuraciones de ancho del editor de bloques.

1.  **Ancho Completo (Full Width):**
    *   Para crear secciones que ocupen el 100% de la pantalla (de borde a borde), usa bloques de grupo o "Cover" y selecciona la alineación **"Ancho Completo"** en la barra de herramientas del bloque.
    *   El contenedor principal se expandirá automáticamente.

2.  **Ancho de Caja (Boxed):**
    *   Si usas la alineación **"Ancho Amplio"** o ninguna alineación, el contenido se mantendrá centrado dentro del ancho máximo definido (1200px por defecto).

### Restaurar el Diseño Original
Si quieres volver al diseño original (Fallback):
1.  Abre la página en el editor.
2.  **Borra todos los bloques** hasta que el editor esté completamente vacío.
3.  Actualiza la página.

> **💡 Tip:** Consulta el archivo `5-guia-composicion-bloques.md` para ver patrones de bloques pre-diseñados.

---

## 4. COMPONENTES DINÁMICOS (SHORTCODES)

Para insertar funcionalidades complejas, usa el bloque "Shortcode":

### 📰 Noticias
```
[fjp_news_loop posts="3" title="Últimas Noticias"]
```

### 🤝 Alianzas
```
[fjp_alliances_loop posts="6"]
```

### 💬 Testimonios
```
[fjp_testimonials_loop]
```

### 📊 Contadores de Impacto
```
[fjp_contador_impacto libras="56966" voluntarios="1341" provincias="32"]
```

### ❤️ Opciones de Donación
```
[fjp_donation_options]
```

### 📝 Formulario de Voluntariado
```
[fjp_volunteer_form]
```

---

## 5. CONFIGURACIÓN DE NOTICIAS

El sistema de noticias es híbrido:
1.  **Contenido**: Usa el editor de bloques para escribir la noticia.
2.  **Estructura**: La plantilla `page-noticias.php` añade automáticamente la barra de búsqueda y filtros.

**Para añadir una noticia:**
1.  Ve a **Noticias > Añadir nueva**.
2.  Sube una **Imagen Destacada**.
3.  (Opcional) Rellena los campos ACF: *Fuente*, *URL Externa*.

---

## 6. SISTEMA DE DONACIONES

Integración nativa con **GiveWP**. Si el plugin no está activo, se muestran métodos alternativos configurados en la plantilla.

---

**Soporte Técnico**
Si los cambios de estilo no se reflejan, asegúrate de haber borrado la caché del navegador y de que el archivo `theme.json` sea válido.
