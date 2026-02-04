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
2.  [Design Tokens (Variables CSS)](#2-design-tokens-variables-css)
3.  [Gestión de Contenido (Páginas y Bloques)](#3-gestión-de-contenido-páginas-y-bloques)
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
    *   *Ejemplo:* Si creas una página nueva con la plantilla "Home" y la dejas vacía, aparecerá automáticamente el Hero, Misión, Contadores y Noticias por defecto.

Esto garantiza que el sitio nunca se vea "roto" o vacío, incluso si borras accidentalmente el contenido del editor.

---

## 2. DESIGN TOKENS (VARIABLES CSS)

Hemos abstraído los estilos visuales en **Variables CSS** (Custom Properties) para facilitar cambios globales instantáneos. Estas variables se encuentran en `:root` del archivo `style.css`.

### Colores Principales
| Variable CSS | Descripción | Valor por Defecto |
| :--- | :--- | :--- |
| `--fjp-primary` | Azul Institucional (Marca) | `#0056D2` |
| `--fjp-secondary` | Verde Esperanza (Acción) | `#28A745` |
| `--fjp-accent` | Rojo (Atención/Urgencia) | `#E63946` |
| `--fjp-teal` | Verde Azulado (Decorativo) | `#2A9D8F` |
| `--fjp-dark-blue` | Azul Oscuro (Textos/Fondos) | `#264653` |
| `--fjp-yellow` | Amarillo (Resaltado) | `#E9C46A` |

### Tipografía
| Variable CSS | Uso | Fuente |
| :--- | :--- | :--- |
| `--fjp-font-heading` | Títulos (H1-H6) | `'Montserrat', sans-serif` |
| `--fjp-font-body` | Párrafos y Textos | `'Inter', sans-serif` |

### Espaciado y Bordes
| Variable CSS | Uso |
| :--- | :--- |
| `--fjp-spacing-md` | Espaciado medio (30px) |
| `--fjp-spacing-xl` | Espaciado grande (60px) |
| `--fjp-radius-md` | Borde redondeado tarjetas (15px) |
| `--fjp-radius-pill` | Borde botones (50px) |

> **Para Desarrolladores:** Usa siempre `var(--fjp-variable)` en tu CSS en lugar de valores hexadecimales fijos.

---

## 3. GESTIÓN DE CONTENIDO (PÁGINAS Y BLOQUES)

### Edición con Bloques (Recomendado)
Para personalizar una página:
1.  Ve a **Páginas** y selecciona la que deseas editar.
2.  Usa el editor para añadir bloques de **Encabezado**, **Párrafo**, **Imagen**, **Columnas**, etc.
3.  Al guardar, este contenido reemplazará al diseño por defecto.

### Restaurar el Diseño Original
Si quieres volver al diseño original (Fallback):
1.  Abre la página en el editor.
2.  **Borra todos los bloques** hasta que el editor esté completamente vacío.
3.  Actualiza la página.
4.  El sistema detectará que está vacía y volverá a cargar la plantilla PHP original.

> **💡 Tip:** Consulta el archivo `5-guia-composicion-bloques.md` para ver patrones de bloques pre-diseñados que puedes copiar y pegar para recrear secciones específicas manualmente.

---

## 4. COMPONENTES DINÁMICOS (SHORTCODES)

Para insertar funcionalidades complejas dentro de tu contenido de bloques, usa el bloque "Shortcode" con estos códigos:

### 📰 Noticias
Muestra una cuadrícula con las últimas noticias.
```
[fjp_news_loop posts="3" title="Últimas Noticias"]
```

### 🤝 Alianzas
Muestra los logos de aliados en carrusel/grid.
```
[fjp_alliances_loop posts="6"]
```

### 💬 Testimonios
Muestra testimonios aleatorios.
```
[fjp_testimonials_loop]
```
*Específico para voluntariado:* `[fjp_volunteer_testimonials]`

### 📊 Contadores de Impacto
Estadísticas animadas.
```
[fjp_contador_impacto libras="56966" voluntarios="1341" provincias="32"]
```

### ❤️ Opciones de Donación
Tarjetas de donación (Única, Mensual, Especie).
```
[fjp_donation_options]
```

### 📝 Formulario de Voluntariado
Formulario de inscripción completo.
```
[fjp_volunteer_form]
```

---

## 5. CONFIGURACIÓN DE NOTICIAS

El sistema de noticias es híbrido:
1.  **Contenido**: Usa el editor de bloques para escribir la noticia.
2.  **Estructura**: La plantilla `page-noticias.php` añade automáticamente la barra de búsqueda, filtros por categoría y la cuadrícula de noticias debajo de tu contenido introductorio.

**Para añadir una noticia:**
1.  Ve a **Noticias > Añadir nueva**.
2.  Escribe el título y contenido.
3.  Sube una **Imagen Destacada**.
4.  (Opcional) Rellena los campos ACF: *Fuente*, *URL Externa*.

---

## 6. SISTEMA DE DONACIONES

Integración nativa con **GiveWP**.
- Si el plugin está activo, los botones "Donar" abren el formulario.
- Si no, se muestran métodos alternativos (PayPal, Transferencia) configurados en la plantilla.

---

## 7. PERSONALIZACIÓN VISUAL

Puedes ajustar la apariencia global desde **Apariencia > Editor** (Full Site Editing) gracias al archivo `theme.json`, o modificando las variables CSS en `style.css`.

### Archivos Importantes:
-   `GUIA-INSTALACION-HOSTINGER-importante.md`: (Si disponible) Contiene instrucciones específicas de despliegue.
-   `4-revision-codigo-adaptaciones`: Registro de cambios técnicos.
-   `5-guia-composicion-bloques.md`: Catálogo de patrones de bloques.

---

**Soporte Técnico**
Si encuentras problemas de visualización ("página en blanco"), asegúrate de que el editor de bloques tenga contenido válido o esté completamente vacío para activar el modo Fallback.
