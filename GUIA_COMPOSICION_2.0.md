# Guía de Composición 2.0 - Fundación Juventud Progresista

Esta guía detalla el nuevo flujo de trabajo para la creación y gestión de contenido en el sitio web de la **Fundación Juventud Progresista**, utilizando el nuevo sistema de Bloques ACF y Patrones "Un Clic".

## 1. Introducción al Nuevo Sistema

El sitio ha sido reestructurado para eliminar plantillas rígidas (hardcoded) y reemplazarlas por un sistema flexible basado en **Gutenberg** y **Advanced Custom Fields (ACF)**.

**Componentes Clave:**
*   **Bloques FJP:** Componentes personalizados (Hero, Noticias, Testimonios, CTA) que se editan visualmente.
*   **Patrones FJP:** Plantillas de página completa que se insertan con un solo clic.
*   **Diseño Premium:** Estilos centralizados que aseguran coherencia visual (Colores, Tipografía, Espaciado).

---

## 2. Creación de Páginas Principales

Para reconstruir páginas clave como **Home** o **Voluntariado**, siga estos pasos:

### Paso 1: Crear la Página
1.  Ir a **Páginas > Añadir nueva**.
2.  Escribir el título (ej: "Inicio" o "Voluntariado").
3.  En la barra lateral derecha, asegurar que la **Plantilla** sea "Por defecto" (Default).

### Paso 2: Insertar el Patrón
1.  Hacer clic en el botón **`+`** (Insertador de bloques) en la esquina superior izquierda.
2.  Ir a la pestaña **Patrones**.
3.  Buscar la categoría **FJP Páginas (Layouts Completos)**.
4.  Hacer clic en **Home - Layout Completo** o **Voluntariado - Layout Completo**.
5.  ¡Listo! La estructura completa de la página se cargará automáticamente.

### Paso 3: Personalizar el Contenido
Una vez insertado el patrón, puede hacer clic en cualquier elemento (texto, imagen, botón) para editarlo directamente.

*   **Hero Block:** Haga clic en el bloque superior para cambiar el título, la descripción, la imagen de fondo y el color de superposición (Overlay) desde la barra lateral.
*   **Noticias Grid:** Seleccione el bloque de noticias para cambiar cuántas noticias mostrar o filtrar por categoría.
*   **Testimonios:** El slider cargará automáticamente los testimonios, pero puede ajustar la cantidad en la configuración del bloque.

---

## 3. Gestión de los Bloques FJP (ACF Blocks)

### FJP Hero (Portada)
*   **Uso:** Encabezados principales de página.
*   **Configuración (Barra Lateral):**
    *   **Title/Description:** Texto principal.
    *   **Background Image:** Imagen de fondo de alta calidad.
    *   **Overlay Color:** Seleccione un color de la marca (Primary, Secondary, Teal) para asegurar legibilidad.
    *   **Buttons:** Añada uno o varios botones de llamada a la acción.

### FJP News Grid (Noticias)
*   **Uso:** Mostrar últimas noticias o noticias de una categoría específica.
*   **Configuración:**
    *   **Number of Posts:** Cantidad de noticias a mostrar.
    *   **Filter by Category:** Si se selecciona una categoría, solo mostrará noticias de esa temática. Si se deja vacío, mostrará todas y habilitará una barra de filtros en el frontend.

### FJP Testimonials (Testimonios)
*   **Uso:** Carrusel de testimonios.
*   **Fuente de Datos:** Toma la información automáticamente del CPT "Testimonios".
*   **Configuración:** Cantidad de testimonios a rotar.

### FJP Volunteer CTA
*   **Uso:** Llamada a la acción específica para voluntariado.
*   **Configuración:** Título, texto y botón. El fondo utiliza el gradiente "Teal" de la marca automáticamente.

---

## 4. Gestión de Datos (Custom Post Types)

Para que los bloques funcionen, debe haber contenido cargado en las secciones correspondientes del menú principal de WordPress:

*   **Noticias:** Añada artículos con su Imagen Destacada, Categoría y fecha. Los campos extra (Fuente, Autor) ahora aparecen en la barra lateral derecha.
*   **Testimonios:** Añada testimonios con el nombre (Título), el texto (Editor), y los datos de Cargo/Organización en la barra lateral.
*   **Alianzas:** Añada logos de aliados como Imagen Destacada.

---

## 5. Paleta de Colores

El sistema utiliza las siguientes variables globales, accesibles también desde el selector de colores de Gutenberg:

*   🔴 **FJP Primario (Rosa):** `#F2385A` (Acciones principales, Títulos)
*   🌸 **FJP Secundario (Rosa Suave):** `#D95F76` (Detalles, Hover)
*   🔵 **FJP Turquesa:** `#5BD9D9` (Fondos, Acentos frescos)
*   🟢 **FJP Verde:** `#56BF66` (Éxito, Naturaleza)
*   ⚪ **FJP Fondo:** `#F2F2F2` (Fondos generales)

---

**Nota Técnica:**
Si necesita modificar estilos globales, hágalo a través de **Apariencia > Personalizar** o editando `style.css` si tiene conocimientos de código. Los bloques heredarán automáticamente estos cambios.
