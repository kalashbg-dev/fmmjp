# Guía de Composición 2.0 - Fundación Juventud Progresista

Esta guía detalla el flujo de trabajo actualizado para la creación y gestión de contenido en el sitio web de la **Fundación Juventud Progresista**.

## 1. Introducción al Nuevo Sistema

El sitio utiliza una arquitectura híbrida basada en **Bloques ACF (Advanced Custom Fields)** y **Patrones de Bloques** de WordPress. Esto elimina la necesidad de editar código PHP para cambiar textos o imágenes.

**Componentes Clave:**
*   **Bloques FJP:** Componentes personalizados (Hero, Noticias, Testimonios, CTA) que se editan visualmente.
*   **Patrones FJP:** Plantillas de página completa ("Un Clic") que insertan la estructura ideal.
*   **Gestión PHP:** Toda la configuración de campos ACF ahora reside en el código (`inc/acf-block-fields.php`), eliminando la necesidad de importar archivos JSON manualmente.

---

## 2. Creación de Páginas Principales

Para reconstruir páginas clave como **Home** o **Voluntariado**:

### Paso 1: Crear la Página y Seleccionar Plantilla
1.  Ir a **Páginas > Añadir nueva**.
2.  Escribir el título (ej: "Inicio" o "Voluntariado").
3.  **IMPORTANTE:** En la barra lateral derecha, bajo "Atributos de página" (o "Resumen"), busque la opción **Plantilla**.
4.  Seleccione **FJP - Ancho Completo (Canvas)**. Esto es crucial para que los diseños ocupen todo el ancho y para habilitar opciones específicas (como los campos de voluntariado).

### Paso 2: Insertar el Patrón
1.  Hacer clic en el botón **`+`** (Insertador de bloques) en la esquina superior izquierda.
2.  Ir a la pestaña **Patrones**.
3.  Buscar la categoría **FJP Páginas (Layouts Completos)**.
4.  Seleccione el layout deseado (ej: **Home - Layout Completo**).
5.  La estructura se cargará automáticamente.

### Paso 3: Personalizar
Haga clic en cualquier elemento para editarlo. Los bloques ACF (Hero, Grid, etc.) tienen sus opciones en la barra lateral derecha.

---

## 3. Página de Voluntariado y Formulario

La página de Voluntariado tiene una lógica especial:

1.  **Campos Específicos:** Al seleccionar la plantilla **FJP - Ancho Completo**, aparecerá un panel "Configuración Página Voluntariado" (abajo del editor). Aquí puede agregar/editar las áreas de interés y los testimonios específicos de voluntarios.
2.  **Formulario Funcional:** El formulario visible en la página (insertado vía Shortcode `[fjp_volunteer_form]`) es completamente funcional.
    *   **Envío:** Los datos se guardan en el menú **Voluntarios** (visible solo para administradores) como entradas "Privadas" para proteger la privacidad.
    *   **Emails:** El sistema envía automáticamente un correo de confirmación al voluntario y una notificación al administrador del sitio.

---

## 4. Gestión de los Bloques FJP (ACF Blocks)

### FJP Hero (Portada)
*   **Uso:** Encabezado principal con imagen de fondo.
*   **Configuración:** Título, Descripción, Imagen de Fondo, Color de Superposición (Overlay) y Botones (Estilo Primario, Secundario o Borde).

### FJP News Grid (Noticias)
*   **Uso:** Grilla automática de noticias.
*   **Configuración:** Cantidad de posts a mostrar y filtro por Categoría (opcional).

### FJP Testimonials (Testimonios)
*   **Fuente:** Muestra automáticamente las entradas del CPT "Testimonios".

### FJP Volunteer CTA
*   **Uso:** Llamada a la acción con fondo degradado turquesa/verde.

---

## 5. Gestión de Datos (Custom Post Types)

El contenido dinámico se gestiona desde el menú principal del escritorio:

*   **Noticias:** Artículos estándar. Campos extra: Fuente, Autor, URL Externa.
*   **Testimonios:** Citas de personas. Campos: Cargo, Organización.
*   **Alianzas:** Logos de aliados (usar Imagen Destacada).
*   **Voluntarios:** (Solo lectura) Registro de solicitudes recibidas desde el formulario web.

---

## 6. Paleta de Colores

El sistema utiliza las variables globales de la marca:
*   🔴 **Primario:** `#F2385A`
*   🔵 **Turquesa:** `#5BD9D9`
*   🟢 **Verde:** `#56BF66`
*   ⚪ **Fondo:** `#F2F2F2`

**Nota Técnica:**
No elimine los archivos `.php` dentro de la carpeta `inc/` ni los archivos `block.json` dentro de `blocks/`, ya que son esenciales para el funcionamiento del tema.
