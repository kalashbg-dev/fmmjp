# 🔧 REVISIÓN Y ADAPTACIÓN DE CÓDIGO PHP
## Guía para Adaptar el Proyecto de Premium a Free

---

## 📋 INTRODUCCIÓN

Este documento complementa la **Guía Completa de Instalación** y se enfoca específicamente en:

1. **Identificar código que usa funciones premium**
2. **Adaptar ese código para que funcione con plugins gratuitos**
3. **Explicar paso a paso cómo hacer las modificaciones**
4. **Proporcionar alternativas funcionales**

### ⚠️ ANTES DE EMPEZAR

**NO entres en pánico si ves mucho código**. Esta guía te explicará:
- ✅ QUÉ buscar
- ✅ DÓNDE buscar
- ✅ CÓMO modificar (con ejemplos paso a paso)
- ✅ QUÉ hacer si algo sale mal

---

## 📁 ARCHIVOS A REVISAR (EN ORDEN DE PRIORIDAD)

### Prioridad ALTA (Revisar primero)

1. **acf-export.json** (772 líneas)
   - Contiene definiciones de campos ACF
   - **Riesgo**: Alto - Si tiene campos premium, la importación fallará

2. **givewp-config.php** (1,111 líneas)
   - Configuración completa de donaciones
   - **Riesgo**: Alto - Probablemente usa funciones Pro

3. **functions.php** (882 líneas)
   - Funciones principales del tema
   - **Riesgo**: Medio - Puede tener referencias a funciones premium

### Prioridad MEDIA (Revisar después)

4. **page-voluntariado.php** (1,170 líneas)
   - Plantilla de voluntariado
   - **Riesgo**: Medio - Puede usar campos Repeater

5. **page-donaciones.php** (331 líneas)
   - Plantilla de donaciones
   - **Riesgo**: Medio - Puede requerir GiveWP Pro

### Prioridad BAJA (Revisar si hay problemas)

6. **functions-advanced.php** (879 líneas)
7. **page-home.php** (263 línas)
8. **page-noticias.php** (259 líneas)
9. **page-quienes-somos.php** (344 líneas)
10. **single-noticias.php** (957 líneas)

---

## 🔍 PARTE 1: REVISAR ACF-EXPORT.JSON

### Paso 1: Abrir el Archivo

**Opción A: Con Editor de Texto**

1. Descomprimir `funjp.zip`
2. Navegar a: `fjp-tema-hijo/acf-export.json`
3. Abrir con:
   - **Notepad++** (Windows)
   - **TextEdit** (Mac)
   - **VS Code** (recomendado, gratuito)

**Opción B: Desde WordPress**

1. Ya instalado WordPress con el tema
2. FTP: Descargar `acf-export.json` desde `/wp-content/themes/fjp-tema-hijo/`

### Paso 2: Buscar Campos Problemáticos

Presionar **Ctrl+F** (o Cmd+F en Mac) y buscar estos términos:

#### 🚫 Campos SOLO para ACF Pro:

| Tipo de Campo | Buscar | Qué Hace | Alternativa Free |
|---------------|--------|----------|------------------|
| **repeater** | `"type": "repeater"` | Campos repetibles (ej: lista de miembros del equipo) | Crear campos individuales (miembro_1, miembro_2, etc.) |
| **flexible_content** | `"type": "flexible_content"` | Secciones flexibles de contenido | Usar bloques de Gutenberg |
| **gallery** | `"type": "gallery"` | Galería de múltiples imágenes | Usar campo Image múltiples veces |
| **clone** | `"type": "clone"` | Clonar campos de otros grupos | Duplicar campos manualmente |
| **group** | `"type": "group"` | Agrupar campos relacionados | **✅ FUNCIONA en Free** |

### Paso 3: Analizar los Resultados

#### Escenario A: NO encontraste ninguno

✅ **¡Perfecto!** El JSON es compatible con ACF Free. Puedes importarlo sin problemas.

**Siguiente paso**: Ir directamente a [Parte 2: Revisar GiveWP Config](#parte-2-revisar-givewp-configphp)

#### Escenario B: Encontraste algunos campos problemáticos

⚠️ **Debes adaptar el JSON** antes de importar.

**Ejemplo de lo que podrías encontrar**:

```json
{
    "key": "field_equipo_miembros",
    "label": "Miembros del Equipo",
    "name": "equipo_miembros",
    "type": "repeater",  ← PROBLEMA: Solo ACF Pro
    "sub_fields": [
        {
            "key": "field_miembro_nombre",
            "label": "Nombre",
            "name": "nombre",
            "type": "text"
        },
        {
            "key": "field_miembro_cargo",
            "label": "Cargo",
            "name": "cargo",
            "type": "text"
        }
    ]
}
```

### Paso 4: Adaptaciones Específicas

#### Adaptación 1: Reemplazar Repeater con Campos Individuales

**ANTES (con Repeater - ACF Pro)**:
```json
{
    "key": "field_equipo_miembros",
    "type": "repeater",
    "sub_fields": [...]
}
```

**DESPUÉS (sin Repeater - ACF Free)**:
```json
{
    "key": "field_miembro_1_nombre",
    "label": "Miembro 1 - Nombre",
    "name": "miembro_1_nombre",
    "type": "text"
},
{
    "key": "field_miembro_1_cargo",
    "label": "Miembro 1 - Cargo",
    "name": "miembro_1_cargo",
    "type": "text"
},
{
    "key": "field_miembro_2_nombre",
    "label": "Miembro 2 - Nombre",
    "name": "miembro_2_nombre",
    "type": "text"
},
{
    "key": "field_miembro_2_cargo",
    "label": "Miembro 2 - Cargo",
    "name": "miembro_2_cargo",
    "type": "text"
}
```

**Límite**: Define un número máximo (ej: 5 miembros, 10 testimonios, etc.)

#### Adaptación 2: Reemplazar Gallery con Imágenes Individual

**ANTES (Gallery - ACF Pro)**:
```json
{
    "key": "field_galeria_fotos",
    "type": "gallery"
}
```

**DESPUÉS (Multiple Image - ACF Free)**:
```json
{
    "key": "field_foto_1",
    "label": "Foto 1",
    "name": "foto_1",
    "type": "image",
    "return_format": "url"
},
{
    "key": "field_foto_2",
    "label": "Foto 2",
    "name": "foto_2",
    "type": "image",
    "return_format": "url"
},
{
    "key": "field_foto_3",
    "label": "Foto 3",
    "name": "foto_3",
    "type": "image",
    "return_format": "url"
}
```

### Paso 5: Importar el JSON Adaptado

1. Guardar el archivo JSON modificado
2. En WordPress: **Custom Fields → Tools → Import**
3. Seleccionar el archivo adaptado
4. Importar
5. Verificar que no haya errores

---

## 🎁 PARTE 2: REVISAR GIVEWP-CONFIG.PHP

### Paso 1: Abrir el Archivo

1. Por FTP, descargar: `/wp-content/themes/fjp-tema-hijo/givewp-config.php`
2. Abrirlo con editor de código (VS Code, Notepad++, etc.)

### Paso 2: Buscar Funciones Premium de GiveWP

Buscar estos términos (Ctrl+F):

| Función/Característica | Solo Pro | Descripción |
|------------------------|----------|-------------|
| `recurring` | ✅ | Donaciones recurrentes/mensuales |
| `give_recurring` | ✅ | Funciones de suscripción |
| `fee_recovery` | ✅ | Recuperación de comisiones |
| `tributes` | ✅ | Donaciones en honor/memoria |
| `peer_to_peer` | ✅ | Campañas colaborativas |
| `form_field_manager` | ✅ | Gestor avanzado de campos |

### Paso 3: Comentar Código Premium

Si encuentras funciones premium que no son críticas, coméntalas:

**ANTES**:
```php
// Configurar donaciones recurrentes
add_action('give_recurring_add_subscription', 'fjp_setup_recurring_donations');
function fjp_setup_recurring_donations($subscription_id) {
    // Código para manejar suscripciones
    update_post_meta($subscription_id, 'fjp_subscription_active', 'yes');
}
```

**DESPUÉS (comentado)**:
```php
// TEMPORALMENTE DESACTIVADO - Requiere GiveWP Pro
// Configurar donaciones recurrentes
/*
add_action('give_recurring_add_subscription', 'fjp_setup_recurring_donations');
function fjp_setup_recurring_donations($subscription_id) {
    // Código para manejar suscripciones
    update_post_meta($subscription_id, 'fjp_subscription_active', 'yes');
}
*/
```

### Paso 4: Código Esencial vs No Esencial

#### ✅ Código ESENCIAL (debe funcionar con Free):

```php
// Crear formulario de donación básico
function fjp_create_donation_form() {
    $form_id = wp_insert_post([
        'post_title' => 'Donación General',
        'post_type' => 'give_forms',
        'post_status' => 'publish'
    ]);

    return $form_id;
}

// Obtener total de donaciones
function fjp_get_total_donations() {
    return give_get_total_earnings();
}

// Obtener número de donantes
function fjp_get_donors_count() {
    return give_get_total_donor_count();
}
```

#### ⚠️ Código NO ESENCIAL (puede comentarse):

```php
// Configurar recuperación de comisiones (SOLO PRO)
add_filter('give_fee_recovery_settings', 'fjp_fee_recovery_config');

// Sistema de tributos (SOLO PRO)
add_action('give_tributes_form', 'fjp_custom_tribute_fields');

// Donaciones recurrentes (SOLO PRO)
add_filter('give_recurring_subscription_details', 'fjp_subscription_info');
```

### Paso 5: Alternativas a Funciones Pro

#### Función Pro: Donaciones Recurrentes

**Alternativa Free**: Usar servicios externos

```php
// En lugar de donaciones recurrentes integradas,
// redirigir a Patreon o PayPal Recurring
function fjp_external_recurring_link() {
    $patreon_url = 'https://www.patreon.com/fundacionjp';
    echo '<a href="' . esc_url($patreon_url) . '" target="_blank">';
    echo 'Apóyanos mensualmente en Patreon';
    echo '</a>';
}
```

#### Función Pro: Recuperación de Comisiones

**Alternativa Free**: Mostrar mensaje manual

```php
// Mostrar nota sobre comisiones
function fjp_show_fee_note() {
    echo '<p class="donation-fee-note">';
    echo 'Las pasarelas de pago cobran una comisión del 3-5%. ';
    echo 'Si deseas cubrir esta comisión, puedes aumentar tu donación en un 5%.';
    echo '</p>';
}
add_action('give_donation_form_before_submit', 'fjp_show_fee_note');
```

---

## 📄 PARTE 3: REVISAR PLANTILLAS PHP (PAGE-*.PHP)

### Archivos a Revisar

1. **page-home.php**
2. **page-donaciones.php**
3. **page-noticias.php**
4. **page-quienes-somos.php**
5. **page-voluntariado.php**
6. **single-noticias.php**

### Paso 1: Buscar Loops de ACF Repeater

**Patrón a buscar**:
```php
<?php if (have_rows('campo_repetible')): ?>
    <?php while (have_rows('campo_repetible')): the_row(); ?>
        <!-- contenido -->
    <?php endwhile; ?>
<?php endif; ?>
```

### Paso 2: Adaptar Repeaters

#### Ejemplo Real: Lista de Testimonios

**ANTES (con ACF Pro Repeater)**:
```php
<?php if (have_rows('testimonios')): ?>
    <div class="testimonios-grid">
    <?php while (have_rows('testimonios')): the_row();
        $nombre = get_sub_field('nombre');
        $testimonio = get_sub_field('testimonio');
        $foto = get_sub_field('foto');
    ?>
        <div class="testimonio-item">
            <img src="<?php echo esc_url($foto); ?>" alt="<?php echo esc_attr($nombre); ?>">
            <h3><?php echo esc_html($nombre); ?></h3>
            <p><?php echo esc_html($testimonio); ?></p>
        </div>
    <?php endwhile; ?>
    </div>
<?php endif; ?>
```

**DESPUÉS (con ACF Free - campos individuales)**:
```php
<div class="testimonios-grid">
    <?php
    // Definir número máximo de testimonios
    $max_testimonios = 6;

    for ($i = 1; $i <= $max_testimonios; $i++) {
        $nombre = get_field('testimonio_' . $i . '_nombre');
        $testimonio = get_field('testimonio_' . $i . '_texto');
        $foto = get_field('testimonio_' . $i . '_foto');

        // Solo mostrar si hay contenido
        if ($nombre && $testimonio): ?>
            <div class="testimonio-item">
                <?php if ($foto): ?>
                    <img src="<?php echo esc_url($foto); ?>" alt="<?php echo esc_attr($nombre); ?>">
                <?php endif; ?>
                <h3><?php echo esc_html($nombre); ?></h3>
                <p><?php echo esc_html($testimonio); ?></p>
            </div>
        <?php endif;
    } ?>
</div>
```

### Paso 3: Adaptar Flexible Content

**Flexible Content** permite crear diferentes tipos de secciones dinámicas. En ACF Free, debes usar condicionales manuales.

**ANTES (Flexible Content - ACF Pro)**:
```php
<?php if (have_rows('secciones_flexibles')): ?>
    <?php while (have_rows('secciones_flexibles')): the_row(); ?>

        <?php if (get_row_layout() == 'seccion_texto'): ?>
            <section class="texto">
                <p><?php the_sub_field('contenido'); ?></p>
            </section>

        <?php elseif (get_row_layout() == 'seccion_imagen'): ?>
            <section class="imagen">
                <img src="<?php the_sub_field('imagen'); ?>">
            </section>

        <?php elseif (get_row_layout() == 'seccion_video'): ?>
            <section class="video">
                <iframe src="<?php the_sub_field('url_video'); ?>"></iframe>
            </section>
        <?php endif; ?>

    <?php endwhile; ?>
<?php endif; ?>
```

**DESPUÉS (con ACF Free - secciones fijas)**:
```php
<?php
// Sección 1: Texto
$seccion_1_tipo = get_field('seccion_1_tipo'); // select: texto/imagen/video
if ($seccion_1_tipo == 'texto'): ?>
    <section class="texto">
        <p><?php the_field('seccion_1_contenido'); ?></p>
    </section>
<?php elseif ($seccion_1_tipo == 'imagen'): ?>
    <section class="imagen">
        <img src="<?php the_field('seccion_1_imagen'); ?>">
    </section>
<?php elseif ($seccion_1_tipo == 'video'): ?>
    <section class="video">
        <iframe src="<?php the_field('seccion_1_url_video'); ?>"></iframe>
    </section>
<?php endif; ?>

<?php
// Sección 2: (repetir lo mismo)
$seccion_2_tipo = get_field('seccion_2_tipo');
if ($seccion_2_tipo == 'texto'): ?>
    <!-- ... -->
<?php endif; ?>

<?php
// Continuar para sección 3, 4, 5, etc.
?>
```

**Alternativa mejor**: Usar **Bloques de Gutenberg** nativos de WordPress

---

## 🔄 PARTE 4: ADAPTAR FUNCTIONS.PHP Y FUNCTIONS-ADVANCED.PHP

### Paso 1: Verificar Dependencias de Plugins

Buscar código que verifique si plugins están activos:

```php
// Verificar si ACF Pro está activo
if (function_exists('acf_add_options_page')) {
    // Código que usa ACF
}

// Verificar si GiveWP Pro está activo
if (class_exists('Give_Recurring')) {
    // Código que usa funciones recurrentes
}
```

✅ **Este código está bien** porque solo se ejecuta si el plugin existe.

### Paso 2: Funciones que Pueden Causar Errores

#### ❌ Error Común 1: Llamar función sin verificar

**ANTES (puede causar error fatal)**:
```php
function fjp_mostrar_estadisticas() {
    // Si ACF no está instalado, esto da error fatal
    $total_donaciones = get_field('total_donaciones', 'option');
    echo $total_donaciones;
}
```

**DESPUÉS (código defensivo)**:
```php
function fjp_mostrar_estadisticas() {
    // Verificar que ACF esté activo
    if (function_exists('get_field')) {
        $total_donaciones = get_field('total_donaciones', 'option');
        if ($total_donaciones) {
            echo esc_html($total_donaciones);
        } else {
            echo '0'; // Valor por defecto
        }
    } else {
        echo 'Plugin ACF no instalado';
    }
}
```

#### ❌ Error Común 2: Registro de Custom Post Type con campos Pro

**ANTES**:
```php
function fjp_register_cpt() {
    register_post_type('proyectos', [
        'supports' => ['title', 'editor', 'thumbnail', 'custom-fields'],
        'rewrite' => ['slug' => 'proyectos']
    ]);

    // Esto requiere ACF Pro si los campos son tipo Repeater
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group([
            'fields' => [
                [
                    'type' => 'repeater', // ← PROBLEMA
                    'name' => 'etapas_proyecto'
                ]
            ]
        ]);
    }
}
```

**DESPUÉS**:
```php
function fjp_register_cpt() {
    register_post_type('proyectos', [
        'supports' => ['title', 'editor', 'thumbnail', 'custom-fields'],
        'rewrite' => ['slug' => 'proyectos']
    ]);

    // Campos adaptados para ACF Free
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group([
            'fields' => [
                [
                    'type' => 'text', // Cambiar de repeater a campos individuales
                    'name' => 'etapa_1_nombre'
                ],
                [
                    'type' => 'text',
                    'name' => 'etapa_2_nombre'
                ],
                [
                    'type' => 'text',
                    'name' => 'etapa_3_nombre'
                ]
            ]
        ]);
    }
}
```

### Paso 3: Optimizar Consultas de ACF

Para mejorar rendimiento con ACF Free:

```php
// ❌ LENTO: Llamar get_field() muchas veces
<?php
for ($i = 1; $i <= 10; $i++) {
    $nombre = get_field('miembro_' . $i . '_nombre');
    $cargo = get_field('miembro_' . $i . '_cargo');
    $foto = get_field('miembro_' . $i . '_foto');
}
?>

// ✅ RÁPIDO: Obtener todos los campos una vez
<?php
$all_fields = get_fields(); // Obtiene TODOS los campos en una consulta
for ($i = 1; $i <= 10; $i++) {
    $nombre = isset($all_fields['miembro_' . $i . '_nombre']) ? $all_fields['miembro_' . $i . '_nombre'] : '';
    $cargo = isset($all_fields['miembro_' . $i . '_cargo']) ? $all_fields['miembro_' . $i . '_cargo'] : '';
    $foto = isset($all_fields['miembro_' . $i . '_foto']) ? $all_fields['miembro_' . $i . '_foto'] : '';

    if ($nombre) {
        echo '<div>' . esc_html($nombre) . ' - ' . esc_html($cargo) . '</div>';
    }
}
?>
```

---

## 🛠️ PARTE 5: HERRAMIENTAS PARA REVISAR CÓDIGO

### Herramienta 1: Query Monitor (Plugin Gratuito)

Detecta errores y código lento:

1. Instalar plugin **Query Monitor**
2. Activarlo
3. Navegar por el sitio
4. Hacer clic en el ícono de Query Monitor en la barra superior
5. Ver:
   - **Errors**: Errores de PHP
   - **Queries**: Consultas lentas de base de datos
   - **Hooks**: Funciones que se ejecutan

### Herramienta 2: PHP Code Checker (Online)

Verificar sintaxis PHP:

1. Ir a: https://phpcodechecker.com/
2. Copiar código de `functions.php`
3. Pegar y hacer clic en "Check Code"
4. Revisar errores de sintaxis

### Herramienta 3: Búsqueda con Expresiones Regulares

Para buscar patrones específicos:

**En VS Code**:
1. Abrir carpeta `fjp-tema-hijo`
2. Presionar Ctrl+Shift+F (búsqueda global)
3. Habilitar "Use Regular Expression" (icono `.*`)
4. Buscar:

```regex
have_rows\(['"].*?['"]\)
```
Esto encuentra todos los usos de `have_rows()` (Repeaters)

```regex
get_sub_field\(['"].*?['"]\)
```
Esto encuentra todos los usos de `get_sub_field()` (subcampos de Repeater)

---

## 📝 PARTE 6: PLANTILLA DE REVISIÓN

Usa esta plantilla para documentar tus revisiones:

### Archivo: functions.php

| Línea | Código Problemático | Tipo | Solución Aplicada |
|-------|---------------------|------|-------------------|
| 245 | `have_rows('testimonios')` | Repeater | Reemplazado con loop for |
| 389 | `get_field('galeria_fotos')` | Gallery | Reemplazado con campos individuales foto_1, foto_2, foto_3 |
| 567 | `give_recurring_subscription()` | GiveWP Pro | Comentado temporalmente |

### Archivo: page-home.php

| Línea | Código Problemático | Tipo | Solución Aplicada |
|-------|---------------------|------|-------------------|
| 89 | `have_rows('slider_imagenes')` | Repeater | Cambiar a campos imagen_1, imagen_2, imagen_3 |

### Archivo: givewp-config.php

| Línea | Código Problemático | Tipo | Solución Aplicada |
|-------|---------------------|------|-------------------|
| 234 | `give_recurring_create_subscription()` | GiveWP Pro | Comentado + añadido enlace a Patreon |
| 456 | `give_fee_recovery_enable()` | GiveWP Pro | Comentado + añadido mensaje manual |

---

## ✅ CHECKLIST DE REVISIÓN COMPLETA

### Fase 1: Campos ACF

- [ ] Revisar `acf-export.json` con editor de texto
- [ ] Buscar campos tipo: `repeater`, `flexible_content`, `gallery`, `clone`
- [ ] Documentar campos problemáticos encontrados
- [ ] Adaptar JSON o crear campos manualmente en WordPress
- [ ] Importar JSON y verificar sin errores

### Fase 2: Código GiveWP

- [ ] Abrir `givewp-config.php`
- [ ] Buscar: `recurring`, `fee_recovery`, `tributes`, `peer_to_peer`
- [ ] Comentar funciones que requieren Pro
- [ ] Crear alternativas (enlaces externos, mensajes manuales)
- [ ] Verificar que el formulario básico de donaciones funcione

### Fase 3: Plantillas PHP

- [ ] Revisar `page-home.php`
- [ ] Revisar `page-donaciones.php`
- [ ] Revisar `page-noticias.php`
- [ ] Revisar `page-quienes-somos.php`
- [ ] Revisar `page-voluntariado.php`
- [ ] Revisar `single-noticias.php`
- [ ] Buscar: `have_rows()`, `the_row()`, `get_sub_field()`
- [ ] Adaptar loops de Repeater a loops estándar PHP

### Fase 4: Functions.php

- [ ] Revisar `functions.php`
- [ ] Revisar `functions-advanced.php`
- [ ] Verificar que todas las funciones tengan checks de `function_exists()`
- [ ] Verificar que no haya errores fatales
- [ ] Probar crear una página de prueba

### Fase 5: Pruebas

- [ ] Activar tema hijo sin errores
- [ ] Crear noticia de prueba con campos ACF
- [ ] Publicar noticia y ver en frontend
- [ ] Completar formulario de donación de prueba
- [ ] Navegar por todas las páginas sin errores
- [ ] Verificar con Query Monitor que no haya errores

---

## 🆘 QUÉ HACER SI TODO FALLA

### Opción 1: Empezar desde Cero con los Básicos

Si encuentras demasiados problemas:

1. **Desactivar el tema hijo FJP temporalmente**
2. **Usar Astra directamente**
3. **Recrear las páginas con bloques de Gutenberg**
4. **Copiar solo los estilos CSS del tema hijo**
5. **Ir añadiendo funcionalidades poco a poco**

### Opción 2: Simplificar el Proyecto

Reducir el alcance a lo esencial:

**Fase 1 - Solo Contenido Básico**:
- Páginas estáticas con contenido
- Sin campos personalizados complejos
- Menú de navegación

**Fase 2 - Añadir Noticias Simple**:
- Custom Post Type Noticias
- Campos ACF básicos (solo Text, Textarea, URL)
- Sin Repeaters ni Galleries

**Fase 3 - Añadir Donaciones**:
- GiveWP Free con formulario básico
- PayPal o transferencia bancaria
- Sin recurrencias

### Opción 3: Contratar Ayuda Puntual

Si el proyecto es urgente:

- **Fiverr**: Buscar "WordPress ACF adaptation"
- **Upwork**: Buscar desarrollador WordPress por hora
- **Freelancer.com**: Similar
- **Presupuesto estimado**: $50-150 USD para adaptaciones básicas

---

## 📚 RECURSOS ADICIONALES

### Documentación Oficial

- **ACF Free vs Pro**: https://www.advancedcustomfields.com/resources/
- **GiveWP Docs**: https://givewp.com/documentation/core/
- **WordPress Codex**: https://codex.wordpress.org/

### Tutoriales en Video

- "ACF without Repeater fields" - YouTube
- "GiveWP free tutorial" - YouTube
- "WordPress custom fields beginner" - YouTube

### Foros de Ayuda

- **WordPress.org Forums**: https://wordpress.org/support/
- **ACF Community**: https://support.advancedcustomfields.com/
- **Stack Overflow**: Etiquetar con `wordpress`, `advanced-custom-fields`

---

## 📞 CONTACTO PARA SOPORTE

Si necesitas ayuda específica con este proyecto:

1. **Documentar el problema**:
   - Captura de pantalla del error
   - Archivo PHP donde ocurre
   - Número de línea
   - Plugin/versión

2. **Publicar en WordPress.org forums**:
   - Categoría: "Developing and Customization"
   - Incluir fragmento de código relevante
   - Mencionar que usas ACF Free (no Pro)

3. **Consultar comunidad GitHub**:
   - Buscar proyectos similares
   - Ver cómo otros adaptaron código premium a free

---

## ✅ RESUMEN EJECUTIVO

### Si encuentras código con Repeater:
→ Reemplazar con campos numerados (`campo_1`, `campo_2`, etc.)

### Si encuentras código con Flexible Content:
→ Usar bloques de Gutenberg o campos con Select para elegir tipo

### Si encuentras código con Gallery:
→ Usar múltiples campos Image individuales

### Si encuentras código con GiveWP Recurring:
→ Comentar y añadir enlace externo a Patreon

### Si encuentras código con GiveWP Fee Recovery:
→ Comentar y añadir mensaje manual sobre comisiones

---

**Versión**: 1.0
**Fecha**: Enero 2024
**Para**: Proyecto Fundación Juventud Progresista
**Autor**: Guía de Adaptación Premium → Free

---

*Esta guía técnica complementa la Guía de Instalación principal y está diseñada para facilitar la transición de plugins premium a versiones gratuitas sin perder funcionalidad esencial
