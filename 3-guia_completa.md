# 📘 GUÍA COMPLETA DE INSTALACIÓN - FUNDACIÓN JUVENTUD PROGRESISTA
## Proyecto WordPress con Tema Hijo Personalizado

---

## 🎯 INTRODUCCIÓN

Esta guía está diseñada para **personas sin experiencia avanzada en WordPress o PHP**. Cada paso está explicado de forma detallada sin asumir conocimientos previos. El proyecto incluye:

- **Tema hijo personalizado** (fjp-tema-hijo) basado en Astra
- **Páginas personalizadas** con plantillas PHP
- **Custom Post Type** para noticias
- **Campos personalizados** con ACF (Advanced Custom Fields)
- **Sistema de donaciones** preparado para GiveWP

### ⚠️ IMPORTANTE: Sobre Plugins Premium vs Gratuitos

Este proyecto fue originalmente diseñado con plugins premium, pero **trabajaremos ÚNICAMENTE con versiones gratuitas**:

- ✅ **ACF Free** (Advanced Custom Fields) - Permite importar/exportar JSON
- ✅ **Give** (GiveWP Free) - Sistema de donaciones básico
- ✅ **Astra** (versión gratuita) - Tema base
- ✅ **Rank Math Free** - SEO básico

**Lo que NO necesitas comprar**: ACF Pro, GiveWP Pro, ni ningún plugin premium.

---

## 📋 TABLA DE CONTENIDOS

1. [Preparación Inicial](#1-preparación-inicial)
2. [Instalación de WordPress en Hostinger](#2-instalación-de-wordpress-en-hostinger)
3. [Instalación del Tema Base Astra](#3-instalación-del-tema-base-astra)
4. [Instalación del Tema Hijo FJP](#4-instalación-del-tema-hijo-fjp)
5. [Instalación de Plugins Gratuitos](#5-instalación-de-plugins-gratuitos)
6. [Configuración de ACF y Campos Personalizados](#6-configuración-de-acf-y-campos-personalizados)
7. [Creación de Páginas y Asignación de Plantillas](#7-creación-de-páginas-y-asignación-de-plantillas)
8. [Configuración del Custom Post Type (Noticias)](#8-configuración-del-custom-post-type-noticias)
9. [Configuración de GiveWP (Donaciones)](#9-configuración-de-givewp-donaciones)
10. [Revisión de Archivos PHP](#10-revisión-de-archivos-php)
11. [Configuración de Menús y Navegación](#11-configuración-de-menús-y-navegación)
12. [Optimización y SEO](#12-optimización-y-seo)
13. [Pruebas y Verificación](#13-pruebas-y-verificación)
14. [Mantenimiento Continuo](#14-mantenimiento-continuo)
15. [Solución de Problemas Comunes](#15-solución-de-problemas-comunes)

---

## 1. PREPARACIÓN INICIAL

### 🗂️ Archivos del Proyecto

El proyecto contiene:

```
funjp.zip
├── fjp-tema-hijo/              ← TEMA HIJO (lo más importante)
│   ├── style.css               ← Define el tema hijo
│   ├── functions.php           ← Funciones principales (882 líneas)
│   ├── functions-advanced.php  ← Funciones avanzadas (879 líneas)
│   ├── givewp-config.php       ← Configuración de donaciones (1111 líneas)
│   ├── acf-export.json         ← Campos personalizados ACF (772 líneas)
│   ├── page-home.php           ← Plantilla página inicio
│   ├── page-quienes-somos.php  ← Plantilla quiénes somos
│   ├── page-donaciones.php     ← Plantilla donaciones
│   ├── page-noticias.php       ← Plantilla noticias
│   ├── page-voluntariado.php   ← Plantilla voluntariado
│   ├── single-noticias.php     ← Plantilla individual noticia
│   └── README.md               ← Documentación
├── css/                        ← Archivos HTML (no necesarios)
├── js/
├── index.html                  ← VERSION HTML (ignorar)
├── donaciones.html
├── noticias.html
├── quienes-somos.html
├── voluntariado.html
└── README.md                   ← Documentación general
```

### ✅ Qué Usar y Qué Ignorar

**USAR:**
- ✅ Carpeta completa `fjp-tema-hijo/` (es el corazón del proyecto)
- ✅ Todos los archivos `.php` dentro
- ✅ El archivo `acf-export.json`
- ✅ El archivo `style.css`

**IGNORAR:**
- ❌ Archivos `.html` (index.html, donaciones.html, etc.)
- ❌ Carpetas `css/` y `js/` sueltas (el tema hijo tiene sus propios estilos)

---

## 2. INSTALACIÓN DE WORDPRESS EN HOSTINGER

### Paso 1: Acceder a Hostinger

1. Ir a [www.hostinger.com](https://www.hostinger.com)
2. Iniciar sesión con tu cuenta
3. Buscar tu plan de hosting activo
4. Hacer clic en **"Panel de Control"** o **"hPanel"**

### Paso 2: Instalar WordPress Automáticamente

1. En el panel de Hostinger, buscar la sección **"Website"** o **"Sitios Web"**
2. Hacer clic en **"Auto Installer"** o **"Instalador Automático"**
3. Seleccionar **"WordPress"**
4. Completar el formulario:
   - **URL del sitio**: Tu dominio (ej: fundacionjuventudprogresista.org)
   - **Nombre del sitio**: Fundación Juventud Progresista
   - **Idioma**: Español (es_ES)
   - **Usuario administrador**: admin_fjp (o el que prefieras)
   - **Contraseña**: [CREAR UNA CONTRASEÑA SEGURA]
   - **Email**: juventudprogresistamm@gmail.com
5. Hacer clic en **"Instalar"**
6. Esperar 2-5 minutos hasta que termine

### Paso 3: Acceder al Panel de WordPress

1. Una vez instalado, verás dos URLs importantes:
   - **URL del sitio**: https://tudominio.org (página pública)
   - **URL de administración**: https://tudominio.org/wp-admin (panel de control)
2. Ir a: **https://tudominio.org/wp-admin**
3. Ingresar con el usuario y contraseña que creaste
4. ¡Listo! Estás dentro del panel de WordPress

### Paso 4: Configuración Inicial de WordPress

1. En el menú lateral izquierdo, ir a **Ajustes → Generales**
2. Configurar:
   - **Título del sitio**: Fundación Juventud Progresista
   - **Descripción corta**: Transformando comunidades, protegiendo nuestros mares
   - **Zona horaria**: UTC-4 (República Dominicana)
   - **Formato de fecha**: d/m/Y
   - **Idioma del sitio**: Español
3. Hacer clic en **"Guardar cambios"**

4. Ir a **Ajustes → Enlaces permanentes**
5. Seleccionar **"Nombre de la entrada"** (opción más amigable)
6. Hacer clic en **"Guardar cambios"**

---

## 3. INSTALACIÓN DEL TEMA BASE ASTRA

### ¿Qué es un Tema Hijo?

Un **tema hijo** es una extensión de un tema principal (tema padre). El tema hijo **hereda** todas las funcionalidades del tema padre, pero permite hacer personalizaciones sin perder los cambios cuando el tema padre se actualiza.

**Analogía simple**:
- El **tema padre (Astra)** es como la casa base
- El **tema hijo (FJP)** es como una extensión personalizada de esa casa

### Paso 1: Instalar Astra (Tema Padre)

1. En WordPress, ir a **Apariencia → Temas**
2. Hacer clic en **"Añadir nuevo"**
3. En el buscador escribir: **"Astra"**
4. Buscar el tema **"Astra"** de Brainstorm Force
5. Hacer clic en **"Instalar"**
6. Esperar a que termine la instalación
7. **NO ACTIVAR TODAVÍA** (solo instalar)

### ¿Por qué no activar Astra?

Porque vamos a activar directamente el **tema hijo FJP**, que automáticamente activará también Astra como base.

---

## 4. INSTALACIÓN DEL TEMA HIJO FJP

### Método 1: Subir por FTP (Recomendado para archivos grandes)

#### Paso 1: Descargar un Cliente FTP

1. Descargar **FileZilla** (gratuito): [https://filezilla-project.org/](https://filezilla-project.org/)
2. Instalarlo en tu computadora

#### Paso 2: Obtener Credenciales FTP de Hostinger

1. En el panel de Hostinger, ir a **"Archivos"** → **"FTP Accounts"** o **"Cuentas FTP"**
2. Anotar:
   - **Servidor/Host**: ftp.tudominio.org (o IP proporcionada)
   - **Usuario**: tu_usuario_ftp
   - **Contraseña**: tu_contraseña_ftp
   - **Puerto**: 21

#### Paso 3: Conectar con FileZilla

1. Abrir FileZilla
2. En la parte superior, ingresar:
   - **Host**: ftp.tudominio.org
   - **Usuario**: tu_usuario_ftp
   - **Contraseña**: tu_contraseña_ftp
   - **Puerto**: 21
3. Hacer clic en **"Conexión rápida"**
4. Esperar a que se conecte

#### Paso 4: Navegar a la Carpeta de Temas

1. En el lado **derecho** de FileZilla (servidor remoto), navegar a:
   ```
   public_html → wp-content → themes
   ```
2. En el lado **izquierdo** (tu computadora), buscar la carpeta descomprimida `fjp-tema-hijo`
3. **Arrastrar** la carpeta completa `fjp-tema-hijo` desde la izquierda hacia la carpeta `themes` en la derecha
4. Esperar a que todos los archivos se suban (puede tomar 2-5 minutos)

### Método 2: Subir como ZIP (Más simple pero puede fallar con archivos grandes)

#### Paso 1: Comprimir la Carpeta

1. En tu computadora, hacer clic derecho sobre la carpeta `fjp-tema-hijo`
2. Seleccionar **"Comprimir"** o **"Enviar a → Carpeta comprimida"**
3. Se creará un archivo: `fjp-tema-hijo.zip`

#### Paso 2: Subir desde WordPress

1. En WordPress, ir a **Apariencia → Temas**
2. Hacer clic en **"Añadir nuevo"**
3. Hacer clic en **"Subir tema"**
4. Hacer clic en **"Seleccionar archivo"**
5. Buscar y seleccionar `fjp-tema-hijo.zip`
6. Hacer clic en **"Instalar ahora"**
7. Esperar a que termine la instalación

### Paso 3: Activar el Tema Hijo

1. Una vez subido, ir a **Apariencia → Temas**
2. Deberías ver tres temas:
   - **Twenty Twenty-Four** (tema por defecto de WordPress)
   - **Astra** (tema padre)
   - **FJP - Fundación Juventud Progresista** (tema hijo) ← Este es el nuestro
3. Hacer clic en **"Activar"** sobre el tema **FJP**
4. ¡Listo! El tema hijo está activo

### ¿Cómo Verificar que Funciona?

1. Visitar la página principal de tu sitio: https://tudominio.org
2. Deberías ver cambios en los colores y estilos
3. Si ves errores o la página en blanco → Ver sección [Solución de Problemas](#15-solución-de-problemas-comunes)

---

## 5. INSTALACIÓN DE PLUGINS GRATUITOS

### ¿Qué son los Plugins?

Los plugins son **extensiones** que añaden funcionalidades extras a WordPress. Son como aplicaciones que instalas en tu teléfono.

### Plugins Necesarios (TODOS GRATUITOS)

| Plugin | Función | Prioridad |
|--------|---------|-----------|
| **Advanced Custom Fields** | Crear campos personalizados | ⭐⭐⭐ CRÍTICO |
| **Give - Donation Plugin** | Sistema de donaciones | ⭐⭐⭐ CRÍTICO |
| **Rank Math SEO** | Optimización para Google | ⭐⭐ IMPORTANTE |
| **LiteSpeed Cache** | Acelerar el sitio | ⭐⭐ IMPORTANTE |
| **Wordfence Security** | Seguridad | ⭐ RECOMENDADO |

### Paso 1: Instalar Advanced Custom Fields (ACF)

1. En WordPress, ir a **Plugins → Añadir nuevo**
2. En el buscador escribir: **"Advanced Custom Fields"**
3. Buscar el plugin **"Advanced Custom Fields"** (por Delicious Brains)
4. Hacer clic en **"Instalar ahora"**
5. Cuando termine, hacer clic en **"Activar"**
6. ¡Listo! Ahora verás en el menú lateral: **"Custom Fields"** o **"Campos personalizados"**

### Paso 2: Instalar Give (GiveWP)

1. En **Plugins → Añadir nuevo**
2. Buscar: **"Give - Donation Plugin"**
3. Instalar el plugin **"Give - Donation Plugin"** (por GiveWP)
4. Activarlo
5. Aparecerá en el menú: **"Donations"** o **"Donaciones"**

### Paso 3: Instalar Rank Math SEO

1. En **Plugins → Añadir nuevo**
2. Buscar: **"Rank Math SEO"**
3. Instalar **"Rank Math SEO"** (por Rank Math)
4. Activarlo
5. Te pedirá hacer una configuración inicial:
   - Seleccionar: **"Sitio web de organización sin fines de lucro"**
   - Nombre de la organización: **Fundación Juventud Progresista**
   - Logo: Subir el logo de la fundación
   - Completar el asistente (puedes usar opciones por defecto)

### Paso 4: Instalar LiteSpeed Cache

1. En **Plugins → Añadir nuevo**
2. Buscar: **"LiteSpeed Cache"**
3. Instalar **"LiteSpeed Cache"** (por LiteSpeed Technologies)
4. Activarlo
5. Ir a **LiteSpeed Cache → General** y hacer clic en **"Enable"** (habilitar)

### Paso 5: (Opcional) Instalar Wordfence Security

1. En **Plugins → Añadir nuevo**
2. Buscar: **"Wordfence Security"**
3. Instalar y activar
4. Seguir el asistente de configuración básica

### ⚠️ IMPORTANTE: Verificar Compatibilidad

Después de instalar todos los plugins:

1. Ir a **Plugins → Plugins instalados**
2. Verificar que todos estén **"Activos"**
3. Si alguno muestra error, desactivarlo temporalmente

---

## 6. CONFIGURACIÓN DE ACF Y CAMPOS PERSONALIZADOS

### ¿Qué son los Campos Personalizados?

WordPress por defecto tiene campos básicos: título, contenido, imagen destacada. Los **campos personalizados** te permiten añadir campos extras como:
- Fecha de publicación
- URL de la noticia
- Fuente
- Autor
- Categoría temática
- Etc.

### Paso 1: Importar Campos desde JSON

El proyecto incluye un archivo `acf-export.json` que contiene TODOS los campos pre-configurados.

1. En WordPress, ir a **Custom Fields → Tools** (o **Campos Personalizados → Herramientas**)
2. En la pestaña **"Import"** (Importar)
3. Hacer clic en **"Choose File"** (Elegir archivo)
4. Buscar y seleccionar el archivo: `fjp-tema-hijo/acf-export.json`
5. Hacer clic en **"Import JSON"** (Importar JSON)
6. ¡Listo! Los campos se importaron

### Paso 2: Verificar la Importación

1. Ir a **Custom Fields → Field Groups** (Grupos de campos)
2. Deberías ver un grupo llamado: **"Configuración de Noticias"**
3. Hacer clic en él para abrirlo
4. Verificar que contenga campos como:
   - Fecha de Publicación
   - URL de la Noticia
   - Fuente
   - Autor de la Noticia
   - Resumen de la Noticia
   - Categoría Temática
   - Tipo de Noticia
   - Destacar Noticia

### ⚠️ REVISIÓN DEL JSON (IMPORTANTE)

Como mencionaste que ACF Free puede tener problemas con JSON de versiones premium, revisemos:

#### Campos que pueden causar problemas:

1. **Campos condicionales complejos**: ACF Pro tiene lógica condicional avanzada
2. **Campos de tipo "Repeater"**: Solo disponibles en Pro
3. **Campos de tipo "Flexible Content"**: Solo en Pro
4. **Campos de tipo "Gallery"**: Solo en Pro

#### Solución si hay errores:

Si al importar `acf-export.json` recibes errores como:
- "Field type 'repeater' not found"
- "Field type 'flexible_content' not found"

**Deberás crear los campos manualmente**:

1. Ir a **Custom Fields → Field Groups**
2. Hacer clic en **"Add New"**
3. Crear el grupo: **"Configuración de Noticias"**
4. Añadir campos uno por uno (explicaré cómo en el siguiente paso)

### Paso 3: Crear Campos Manualmente (Solo si la importación falla)

#### Campo 1: Fecha de Publicación

1. En el grupo de campos, hacer clic en **"Add Field"**
2. Configurar:
   - **Field Label**: Fecha de Publicación
   - **Field Name**: fecha_de_publicacion
   - **Field Type**: Date Picker
   - **Required**: Yes
   - **Display Format**: d/m/Y
   - **Return Format**: d/m/Y

#### Campo 2: URL de la Noticia

1. Añadir otro campo
2. Configurar:
   - **Field Label**: URL de la Noticia
   - **Field Name**: url_de_noticia
   - **Field Type**: URL
   - **Required**: Yes
   - **Placeholder**: https://ejemplo.com/noticia

#### Campo 3: Fuente

1. Añadir campo
2. Configurar:
   - **Field Label**: Fuente
   - **Field Name**: fuente
   - **Field Type**: Text
   - **Required**: Yes
   - **Placeholder**: Ej: Diario La Nación
   - **Max Length**: 100

#### Campo 4: Autor de la Noticia

1. Añadir campo
2. Configurar:
   - **Field Label**: Autor/a de la Noticia
   - **Field Name**: autor_de_la_noticia
   - **Field Type**: Text
   - **Required**: No
   - **Placeholder**: Ej: María González
   - **Max Length**: 100

#### Campo 5: Resumen de la Noticia

1. Añadir campo
2. Configurar:
   - **Field Label**: Resumen de la Noticia
   - **Field Name**: resumen_de_la_noticia
   - **Field Type**: Textarea
   - **Required**: No
   - **Placeholder**: Breve resumen de la noticia...
   - **Max Length**: 500
   - **Rows**: 4

#### Campo 6: Categoría Temática

1. Añadir campo
2. Configurar:
   - **Field Label**: Categoría Temática
   - **Field Name**: categoria_tematica
   - **Field Type**: Select
   - **Required**: Yes
   - **Choices** (uno por línea):
     ```
     Medio Ambiente : Medio Ambiente
     Voluntariado : Voluntariado
     Comunidad : Comunidad
     Educación : Educación
     Salud : Salud
     ```

#### Campo 7: Tipo de Noticia

1. Añadir campo
2. Configurar:
   - **Field Label**: Tipo de Noticia
   - **Field Name**: tipo_de_noticia
   - **Field Type**: Radio Button
   - **Required**: Yes
   - **Choices**:
     ```
     destacada : Destacada
     regular : Regular
     ```
   - **Default Value**: regular

#### Campo 8: Destacar Noticia

1. Añadir campo
2. Configurar:
   - **Field Label**: Destacar Noticia
   - **Field Name**: destacar_noticia
   - **Field Type**: True / False
   - **Required**: No
   - **Default Value**: 0 (No)
   - **Message**: Marcar si esta noticia debe aparecer como destacada

### Paso 4: Asignar el Grupo de Campos

1. Desplazarse hacia abajo en la página de configuración del grupo
2. En la sección **"Location"** (Ubicación)
3. Configurar la regla:
   - **Show this field group if**: Post Type is equal to Noticias
4. Hacer clic en **"Update"** o **"Publish"** para guardar

---

## 7. CREACIÓN DE PÁGINAS Y ASIGNACIÓN DE PLANTILLAS

### ¿Qué son las Plantillas de Página?

Las **plantillas** son archivos PHP que determinan cómo se ve una página. El tema hijo incluye plantillas personalizadas:

- `page-home.php` → Para la página de inicio
- `page-quienes-somos.php` → Para "Quiénes Somos"
- `page-donaciones.php` → Para "Donaciones"
- `page-noticias.php` → Para "Noticias"
- `page-voluntariado.php` → Para "Voluntariado"

### Paso 1: Crear las Páginas Principales

#### Página 1: Inicio (Home)

1. En WordPress, ir a **Páginas → Añadir nueva**
2. En el título escribir: **Home**
3. **NO ESCRIBIR NADA EN EL CONTENIDO** (la plantilla se encarga de todo)
4. En el panel derecho, buscar **"Atributos de página"** o **"Page Attributes"**
5. En **"Plantilla"** seleccionar: **Home** (si aparece) o **Default**
6. Hacer clic en **"Publicar"**

#### Página 2: Quiénes Somos

1. **Páginas → Añadir nueva**
2. Título: **Quiénes Somos**
3. Contenido: Dejar vacío
4. Plantilla: Buscar **"Quiénes Somos"** si aparece
5. Publicar

#### Página 3: Donaciones

1. **Páginas → Añadir nueva**
2. Título: **Donaciones**
3. Contenido: Dejar vacío
4. Plantilla: Buscar **"Donaciones"**
5. Publicar

#### Página 4: Noticias

1. **Páginas → Añadir nueva**
2. Título: **Noticias**
3. Contenido: Dejar vacío
4. Plantilla: Buscar **"Noticias"**
5. Publicar

#### Página 5: Voluntariado

1. **Páginas → Añadir nueva**
2. Título: **Voluntariado**
3. Contenido: Dejar vacío
4. Plantilla: Buscar **"Voluntariado"**
5. Publicar

### Paso 2: Configurar la Página de Inicio

1. Ir a **Ajustes → Lectura**
2. En **"Tu página de inicio muestra"**:
   - Seleccionar: **"Una página estática"**
   - **Página de inicio**: Seleccionar **"Home"**
   - **Página de entradas**: Dejar en **"-- Seleccionar --"**
3. Hacer clic en **"Guardar cambios"**

### Paso 3: Verificar las Plantillas Asignadas

1. Ir a **Páginas → Todas las páginas**
2. Para cada página creada, hacer clic en **"Edición rápida"**
3. Verificar que la plantilla correcta esté asignada
4. Si no aparecen las plantillas personalizadas:
   - Verificar que el tema hijo esté activo
   - Verificar que los archivos `page-*.php` estén en la carpeta del tema hijo

---

## 8. CONFIGURACIÓN DEL CUSTOM POST TYPE (NOTICIAS)

### ¿Qué es un Custom Post Type?

WordPress tiene dos tipos de contenido por defecto:
- **Entradas (Posts)**: Para blogs
- **Páginas (Pages)**: Para contenido estático

Un **Custom Post Type** es un tipo de contenido personalizado. En este proyecto, creamos el tipo **"Noticias"** para gestionar noticias de la fundación de forma organizada.

### Paso 1: Verificar que Noticias Está Registrado

El archivo `functions.php` del tema hijo ya registra el Custom Post Type "Noticias".

1. En WordPress, buscar en el menú lateral izquierdo: **"Noticias"**
2. Si aparece, ¡perfecto! El CPT está funcionando
3. Si NO aparece:
   - Ir a **Apariencia → Editor de temas** (o Theme Editor)
   - Seleccionar el tema: **FJP - Fundación Juventud Progresista**
   - Abrir el archivo `functions.php`
   - Buscar la función `fjp_register_noticias_cpt()`
   - Verificar que esté presente

### Paso 2: Refrescar los Permalinks

A veces WordPress necesita "refrescar" las URLs para reconocer el nuevo tipo de contenido.

1. Ir a **Ajustes → Enlaces permanentes**
2. **NO CAMBIAR NADA**
3. Simplemente hacer clic en **"Guardar cambios"**
4. Esto refresca las reglas de URLs

### Paso 3: Crear una Noticia de Prueba

1. En el menú lateral, ir a **Noticias → Añadir nueva**
2. Completar:
   - **Título**: Fundación FJP recolecta 500 libras de residuos en playas
   - **Contenido**: Escribir un texto de ejemplo
   - **Imagen destacada**: Subir una imagen (en el panel derecho)
3. Desplazarse hacia abajo y completar los **campos personalizados de ACF**:
   - **Fecha de Publicación**: 15/01/2024
   - **URL de la Noticia**: https://ejemplo.com/noticia-fjp
   - **Fuente**: Diario Libre
   - **Autor**: Juan Pérez
   - **Resumen**: Breve descripción de la noticia
   - **Categoría Temática**: Medio Ambiente
   - **Tipo de Noticia**: Regular
   - **Destacar Noticia**: No
4. Hacer clic en **"Publicar"**

### Paso 4: Verificar la Noticia

1. Ir a **Noticias → Todas las noticias**
2. Deberías ver la noticia que creaste
3. Hacer clic en **"Ver"** para visualizarla en el sitio
4. Si usa la plantilla `single-noticias.php`, verás el diseño personalizado

---

## 9. CONFIGURACIÓN DE GIVEWP (DONACIONES)

### Paso 1: Configuración Inicial de Give

1. En el menú lateral, ir a **Donations → Settings** (Donaciones → Configuración)
2. Pestaña **"General"**:
   - **Currency**: Seleccionar **USD - US Dollar** o **DOP - Dominican Peso**
   - **Currency Position**: Before - $1,000
   - **Thousands Separator**: ,
   - **Decimal Separator**: .
   - **Number of Decimals**: 2
3. Guardar cambios

### Paso 2: Configurar Pasarelas de Pago

#### PayPal (Más simple para empezar)

1. En **Donations → Settings → Payment Gateways**
2. Activar: **PayPal Standard**
3. Hacer clic en configurar PayPal:
   - **PayPal Email**: juventudprogresistamm@gmail.com
   - **PayPal Page Style**: Dejar vacío
   - **IPN Verification**: Enabled
4. Guardar cambios

#### Transferencia Bancaria (Offline)

1. Activar: **Offline Donations**
2. Configurar:
   - **Collect Billing Details**: Yes
   - **Offline Donation Instructions**: Escribir instrucciones como:
     ```
     Por favor realizar transferencia a:
     Banco: Banco Popular
     Cuenta: 123456789
     Titular: Fundación Juventud Progresista
     RNC: 123456789
     ```
3. Guardar cambios

### Paso 3: Crear Formulario de Donación

1. Ir a **Donations → Add Form** (Donaciones → Añadir formulario)
2. Dar un nombre: **Campaña General FJP**
3. En **"Donation Levels"** (Niveles de donación):
   - Nivel 1: $500 DOP - Apoyo Básico
   - Nivel 2: $1,000 DOP - Apoyo Estándar
   - Nivel 3: $2,500 DOP - Apoyo Premium
   - Nivel 4: $5,000 DOP - Apoyo Platino
   - **Custom Amount**: Enabled (permitir montos personalizados)
4. **Goal Settings** (Meta de campaña):
   - **Enable Goal**: Yes
   - **Goal Amount**: $3,800,000 DOP (o la meta que desees)
   - **Progress Bar**: Enable
5. **Form Display Options**:
   - **Payment Fields**: Show
   - **Guest Donations**: Allow
   - **Anonymous Donations**: Allow
6. Publicar

### Paso 4: Integrar el Formulario en la Página de Donaciones

El archivo `page-donaciones.php` ya está preparado para integrar GiveWP.

**Opción A: Shortcode (Más simple)**

1. Editar la página **"Donaciones"** creada anteriormente
2. En el contenido, agregar el shortcode:
   ```
   [give_form id="1"]
   ```
   (Reemplazar "1" con el ID del formulario que creaste)
3. Actualizar la página

**Opción B: Código PHP (Más avanzado)**

El archivo `page-donaciones.php` puede incluir código como:
```php
<?php echo do_shortcode('[give_form id="1"]'); ?>
```

### Paso 5: Probar el Sistema de Donaciones

1. Visitar: https://tudominio.org/donaciones
2. Completar el formulario de donación con datos de prueba
3. Si usas PayPal, usar el **modo sandbox** (pruebas):
   - En Give → Settings → Payment Gateways → PayPal
   - Habilitar: **PayPal Sandbox**
   - Crear una cuenta de prueba en: [developer.paypal.com](https://developer.paypal.com)

---

## 10. REVISIÓN DE ARCHIVOS PHP

### ⚠️ IMPORTANTE: Revisión de Compatibilidad

Como mencionaste que el proyecto asume plugins premium pero solo tienes versiones gratuitas, debemos **revisar los archivos PHP** para asegurarnos de que no haya código que dependa de funcionalidades premium.

### Archivos PHP a Revisar

1. **functions.php** (882 líneas)
2. **functions-advanced.php** (879 líneas)
3. **givewp-config.php** (1,111 líneas)
4. **page-donaciones.php** (331 líneas)
5. **page-home.php** (263 líneas)
6. **page-noticias.php** (259 líneas)
7. **page-quienes-somos.php** (344 líneas)
8. **page-voluntariado.php** (1,170 líneas)
9. **single-noticias.php** (957 líneas)

### Buscar Funciones Problemáticas

#### ACF Pro vs ACF Free

**Funciones que solo funcionan en ACF Pro:**

```php
// ❌ SOLO ACF PRO
get_field('repeater_field'); // Si es un campo Repeater
get_field('flexible_content'); // Si es Flexible Content
get_field('gallery'); // Si es Gallery
the_field('clone_field'); // Si es Clone

// ✅ FUNCIONA EN ACF FREE
get_field('text_field'); // Text
get_field('textarea_field'); // Textarea
get_field('select_field'); // Select
get_field('image_field'); // Image
get_field('date_field'); // Date Picker
get_field('url_field'); // URL
```

#### GiveWP Pro vs GiveWP Free

**Funciones que solo funcionan en GiveWP Pro:**

```php
// ❌ SOLO GIVEWP PRO
give_recurring_show_subscription_details(); // Donaciones recurrentes
give_fee_recovery_settings(); // Recuperación de comisiones
give_tributes_form_fields(); // Tributos

// ✅ FUNCIONA EN GIVEWP FREE
give_get_forms(); // Obtener formularios
give_form_shortcode(); // Mostrar formulario
give_get_total_earnings(); // Total recaudado
```

### Cómo Revisar los Archivos

#### Método 1: Desde el Navegador Web

1. En WordPress, ir a **Apariencia → Editor de temas**
2. Seleccionar el tema: **FJP - Fundación Juventud Progresista**
3. En el panel derecho, seleccionar cada archivo PHP
4. Buscar (Ctrl+F o Cmd+F):
   - `repeater`
   - `flexible_content`
   - `gallery`
   - `clone`
   - `recurring`
   - `fee_recovery`
   - `tributes`

#### Método 2: Con un Editor de Código

1. Abrir la carpeta `fjp-tema-hijo` con un editor como:
   - **VS Code** (recomendado, gratuito)
   - **Sublime Text**
   - **Notepad++**
2. Hacer búsqueda global (Ctrl+Shift+F) de las palabras clave arriba

### Qué Hacer si Encuentras Código Premium

Si encuentras código que usa funciones premium, tienes dos opciones:

#### Opción A: Comentar el Código

```php
// ANTES (con función premium)
<?php if (get_field('repeater_field')): ?>
    <!-- código HTML -->
<?php endif; ?>

// DESPUÉS (código comentado)
<?php
// TEMPORALMENTE DESACTIVADO - Requiere ACF Pro
// if (get_field('repeater_field')):
?>
    <!-- código HTML -->
<?php
// endif;
?>
```

#### Opción B: Reemplazar con Alternativas

```php
// ANTES (ACF Pro Repeater)
<?php if (have_rows('equipo_miembros')): ?>
    <?php while (have_rows('equipo_miembros')): the_row(); ?>
        <div>
            <h3><?php the_sub_field('nombre'); ?></h3>
        </div>
    <?php endwhile; ?>
<?php endif; ?>

// DESPUÉS (Alternativa sin Repeater)
<?php
// Obtener 3 campos individuales en lugar de repeater
$miembro1 = get_field('miembro_1_nombre');
$miembro2 = get_field('miembro_2_nombre');
$miembro3 = get_field('miembro_3_nombre');
?>
<div>
    <?php if ($miembro1): ?><h3><?php echo $miembro1; ?></h3><?php endif; ?>
    <?php if ($miembro2): ?><h3><?php echo $miembro2; ?></h3><?php endif; ?>
    <?php if ($miembro3): ?><h3><?php echo $miembro3; ?></h3><?php endif; ?>
</div>
```

### Archivos Más Probables de Tener Problemas

1. **givewp-config.php** (1,111 líneas) - Probablemente usa funciones Pro
2. **page-voluntariado.php** (1,170 líneas) - Puede usar Repeater para formularios
3. **page-home.php** (263 líneas) - Puede usar Gallery o Repeater

---

## 11. CONFIGURACIÓN DE MENÚS Y NAVEGACIÓN

### Paso 1: Crear el Menú Principal

1. En WordPress, ir a **Apariencia → Menús**
2. Hacer clic en **"Crear un nuevo menú"**
3. Nombre del menú: **Menú Principal**
4. Hacer clic en **"Crear menú"**

### Paso 2: Añadir Páginas al Menú

1. En el panel izquierdo, buscar **"Páginas"**
2. Expandir y seleccionar:
   - ☑️ Home
   - ☑️ Quiénes Somos
   - ☑️ Donaciones
   - ☑️ Noticias
   - ☑️ Voluntariado
3. Hacer clic en **"Añadir al menú"**
4. Las páginas aparecerán en el panel derecho
5. Arrastrar y ordenar según prefieras

### Paso 3: Asignar Ubicación del Menú

1. En la parte inferior del panel derecho, buscar **"Ubicaciones del menú"**
2. Marcar: **☑️ Primary Menu** (Menú Principal)
3. Hacer clic en **"Guardar menú"**

### Paso 4: Crear Menú del Footer (Opcional)

1. **Apariencia → Menús → Crear un nuevo menú**
2. Nombre: **Menú Footer**
3. Añadir enlaces útiles:
   - Políticas de Privacidad
   - Términos y Condiciones
   - Contacto
   - Redes Sociales
4. Asignar ubicación: **Footer Menu**
5. Guardar

---

## 12. OPTIMIZACIÓN Y SEO

### Configuración de Rank Math SEO

#### Paso 1: Configurar la Página de Inicio

1. Editar la página **Home**
2. Desplazarse hacia abajo hasta encontrar **"Rank Math SEO"**
3. Completar:
   - **Focus Keyword**: Fundación Juventud Progresista
   - **SEO Title**: Fundación Juventud Progresista | Transformando Comunidades
   - **Meta Description**: Fundación sin fines de lucro dedicada a la transformación social y ambiental en República Dominicana. Únete a nuestra misión.
4. Actualizar

#### Paso 2: Configurar las Otras Páginas

Repetir para cada página:

**Quiénes Somos**:
- Focus Keyword: Quiénes somos FJP
- Title: Quiénes Somos | Fundación Juventud Progresista
- Description: Conoce nuestra historia, misión y valores. Desde 2016 transformando comunidades en República Dominicana.

**Donaciones**:
- Focus Keyword: Donar FJP
- Title: Apoya Nuestra Causa | Donaciones FJP
- Description: Tu donación hace la diferencia. Apoya proyectos ambientales y sociales en República Dominicana.

**Noticias**:
- Focus Keyword: Noticias FJP
- Title: Noticias y Actividades | FJP
- Description: Mantente informado sobre nuestras acciones, logros y proyectos en curso.

**Voluntariado**:
- Focus Keyword: Voluntariado FJP
- Title: Únete Como Voluntario | FJP
- Description: Forma parte del cambio. Inscríbete como voluntario y participa en nuestras acciones.

#### Paso 3: Configurar el Sitemap

1. Ir a **Rank Math → Sitemap Settings**
2. Verificar que esté habilitado: **Enable Sitemap**
3. Incluir:
   - ☑️ Páginas
   - ☑️ Noticias (Custom Post Type)
   - ☐ Entradas (Posts) - Desmarcar si no usas el blog
4. Guardar cambios
5. Visitar: https://tudominio.org/sitemap.xml para verificar

### Configuración de LiteSpeed Cache

#### Paso 1: Habilitar el Caché

1. Ir a **LiteSpeed Cache → Cache**
2. Verificar que esté en **"ON"** (verde)
3. Configurar:
   - **Cache Logged-in Users**: OFF
   - **Cache Pages**: ON
   - **Cache Posts**: ON
   - **Cache Archives**: ON
4. Guardar cambios

#### Paso 2: Optimizar Imágenes

1. Ir a **LiteSpeed Cache → Image Optimization**
2. Activar:
   - ☑️ Lazy Load Images
   - ☑️ WebP Replacement
3. Hacer clic en **"Send Optimization Request"** para optimizar imágenes existentes

#### Paso 3: Minificar CSS y JavaScript

1. Ir a **LiteSpeed Cache → Page Optimization**
2. Pestaña **CSS Settings**:
   - ☑️ CSS Minify
   - ☑️ CSS Combine
3. Pestaña **JS Settings**:
   - ☑️ JS Minify
   - ☑️ JS Combine
4. Guardar cambios

---

## 13. PRUEBAS Y VERIFICACIÓN

### Lista de Verificación Completa

#### ✅ Verificación de Tema y Apariencia

- [ ] El tema hijo **FJP** está activo
- [ ] El tema padre **Astra** está instalado (pero no activo)
- [ ] Los colores personalizados se ven correctamente
- [ ] Las fuentes Montserrat e Inter se cargan
- [ ] El logo de la fundación aparece en el header

#### ✅ Verificación de Páginas

- [ ] Página **Home** funciona y usa la plantilla correcta
- [ ] Página **Quiénes Somos** funciona
- [ ] Página **Donaciones** funciona
- [ ] Página **Noticias** funciona
- [ ] Página **Voluntariado** funciona
- [ ] Todas las páginas tienen contenido visible (no están en blanco)

#### ✅ Verificación de Noticias (Custom Post Type)

- [ ] El menú **"Noticias"** aparece en el panel de WordPress
- [ ] Se puede crear una noticia nueva
- [ ] Los campos personalizados de ACF aparecen al crear noticia
- [ ] Al publicar una noticia, se ve correctamente en el sitio
- [ ] La plantilla `single-noticias.php` se aplica correctamente

#### ✅ Verificación de Campos Personalizados (ACF)

- [ ] Los campos se importaron correctamente desde `acf-export.json`
- [ ] El grupo **"Configuración de Noticias"** existe
- [ ] Al crear una noticia, aparecen todos los campos:
  - [ ] Fecha de Publicación
  - [ ] URL de la Noticia
  - [ ] Fuente
  - [ ] Autor
  - [ ] Resumen
  - [ ] Categoría Temática
  - [ ] Tipo de Noticia
  - [ ] Destacar Noticia
- [ ] Los valores guardados se muestran correctamente en el frontend

#### ✅ Verificación de Donaciones (GiveWP)

- [ ] GiveWP está instalado y activo
- [ ] Se creó al menos un formulario de donación
- [ ] El formulario aparece en la página **Donaciones**
- [ ] PayPal está configurado correctamente
- [ ] Transferencia bancaria (offline) está configurada
- [ ] Se puede completar una donación de prueba
- [ ] Se recibe confirmación por email (verificar spam)

#### ✅ Verificación de Menús

- [ ] El **Menú Principal** está creado
- [ ] Todas las páginas principales están en el menú
- [ ] El menú aparece en el header del sitio
- [ ] Los enlaces del menú funcionan correctamente

#### ✅ Verificación de SEO

- [ ] Rank Math está instalado y configurado
- [ ] Cada página tiene título SEO personalizado
- [ ] Cada página tiene meta descripción
- [ ] El sitemap XML funciona: /sitemap.xml
- [ ] Google Analytics está configurado (si aplica)

#### ✅ Verificación de Rendimiento

- [ ] LiteSpeed Cache está activo
- [ ] Las imágenes cargan con lazy load
- [ ] El sitio carga en menos de 3 segundos
- [ ] Probar en PageSpeed Insights: https://pagespeed.web.dev/

#### ✅ Verificación de Responsividad

- [ ] El sitio se ve bien en móvil (celular)
- [ ] El sitio se ve bien en tablet
- [ ] El sitio se ve bien en desktop (computadora)
- [ ] El menú móvil funciona correctamente

### Cómo Probar el Sitio

#### Prueba 1: Navegación General

1. Abrir el sitio en navegador: https://tudominio.org
2. Navegar por todas las páginas usando el menú
3. Verificar que no haya páginas en blanco o errores 404
4. Verificar que todas las imágenes cargan

#### Prueba 2: Crear y Publicar Noticia

1. En WordPress, ir a **Noticias → Añadir nueva**
2. Completar todos los campos
3. Publicar
4. Ver la noticia en el frontend
5. Verificar que todos los datos se muestran correctamente

#### Prueba 3: Realizar Donación de Prueba

1. Ir a la página **Donaciones**
2. Seleccionar un monto
3. Completar el formulario
4. **NO completar el pago real** (usar modo sandbox)
5. Verificar que se recibe email de confirmación

#### Prueba 4: Responsividad

1. Abrir el sitio en el celular
2. O en el navegador, presionar F12 y activar modo responsive
3. Probar en varios tamaños:
   - iPhone SE (375px)
   - iPad (768px)
   - Desktop (1920px)

---

## 14. MANTENIMIENTO CONTINUO

### Tareas Semanales (15 minutos)

#### Lunes: Revisión General

1. Verificar que el sitio esté funcionando: https://tudominio.org
2. Revisar comentarios spam en **Comentarios**
3. Revisar nuevas donaciones en **Donations → Donations History**
4. Responder consultas de voluntarios

#### Miércoles: Actualización de Noticias

1. Publicar al menos una noticia nueva
2. Actualizar noticias destacadas si hay novedades
3. Compartir en redes sociales

#### Viernes: Respaldo Rápido

1. Ir a **Plugins** y verificar actualizaciones pendientes
2. Actualizar plugins si hay actualizaciones de seguridad críticas
3. Verificar que LiteSpeed Cache esté activo

### Tareas Mensuales (1 hora)

#### Semana 1: Actualización de WordPress y Plugins

1. Crear respaldo completo:
   - Usar plugin **UpdraftPlus** (gratuito)
   - O hacer respaldo manual desde Hostinger
2. Actualizar WordPress core:
   - **Panel → Actualizaciones → Actualizar ahora**
3. Actualizar todos los plugins:
   - **Plugins → Actualizar** (uno por uno)
4. Verificar que todo funcione después de actualizar

#### Semana 2: Optimización de Base de Datos

1. Instalar plugin **WP-Optimize** (gratuito)
2. Ir a **WP-Optimize → Database**
3. Seleccionar:
   - ☑️ Limpiar revisiones de posts
   - ☑️ Limpiar comentarios spam
   - ☑️ Limpiar transients expirados
4. Hacer clic en **"Run optimization"**

#### Semana 3: Revisión de SEO

1. Ir a **Google Search Console**: https://search.google.com/search-console
2. Revisar:
   - Errores de indexación
   - Páginas más visitadas
   - Palabras clave que generan tráfico
3. Optimizar las páginas con mejor rendimiento

#### Semana 4: Análisis de Donaciones

1. Ir a **Donations → Reports**
2. Analizar:
   - Total recaudado en el mes
   - Número de donantes
   - Monto promedio
3. Enviar reporte al equipo de la fundación

### Tareas Trimestrales (2-3 horas)

#### Revisión Profunda de Seguridad

1. Cambiar contraseñas:
   - WordPress admin
   - FTP
   - Base de datos (si es posible)
2. Revisar usuarios de WordPress:
   - Eliminar usuarios inactivos
   - Verificar roles y permisos
3. Escanear con **Wordfence**:
   - Ir a **Wordfence → Scan**
   - Hacer clic en **"Start New Scan"**
   - Resolver problemas detectados

#### Actualización de Contenido

1. Revisar páginas principales:
   - Actualizar información desactualizada
   - Añadir nuevos logros o estadísticas
   - Actualizar imágenes
2. Revisar noticias antiguas:
   - Archivar noticias de más de 1 año
   - Destacar noticias recientes importantes

---

## 15. ARQUITECTURA HÍBRIDA Y GESTIÓN DE CONTENIDO

El tema ha sido actualizado a una **Arquitectura Híbrida**. Esto significa que combina la flexibilidad del Editor de Bloques (Gutenberg) para el contenido narrativo con la potencia de PHP para secciones complejas y automatizadas.

### 🎨 Design Tokens (Variables CSS)

Se ha centralizado la identidad visual en `style.css` usando variables CSS. Esto permite cambiar colores, tipografías y espaciados globalmente editando solo el archivo `style.css` en la sección `:root`.

**Variables principales disponibles:**
- **Colores**: `--fjp-primary`, `--fjp-secondary`, `--fjp-accent`, `--fjp-teal`, `--fjp-dark-blue`
- **Tipografía**: `--fjp-font-heading`, `--fjp-font-body`
- **Espaciado**: `--fjp-spacing-xs` a `--fjp-spacing-huge`

### 🧱 Edición de Páginas (Home, Quiénes Somos, etc.)

Las plantillas de página (`page-home.php`, etc.) ahora son **contenedores dinámicos**. Ya no tienen texto "hardcoded" (fijo en código).

**Cómo editar el contenido:**
1. Ve a **Páginas** y edita la página (ej: Home).
2. Usa el **Editor de Bloques** para crear la estructura (Encabezados, Párrafos, Imágenes, Columnas).
3. Para insertar las secciones automáticas (Noticias, Alianzas, etc.), usa los **Shortcodes**.

### 🧩 Shortcodes Disponibles

Copia y pega estos shortcodes en un bloque "Shortcode" dentro del editor:

| Shortcode | Descripción | Atributos Opcionales |
|-----------|-------------|----------------------|
| `[fjp_news_loop]` | Muestra las últimas noticias en tarjeta | `posts="3"`, `title="Título"`, `subtitle="Subtítulo"` |
| `[fjp_alliances_loop]` | Muestra el carrusel/grid de alianzas | `posts="6"`, `title="Título"`, `subtitle="Subtítulo"` |
| `[fjp_testimonials_loop]` | Muestra testimonios del CPT | `posts="3"`, `title="Título"`, `subtitle="Subtítulo"` |
| `[fjp_volunteer_form]` | Muestra el formulario de voluntariado | N/A |
| `[fjp_donation_options]` | Muestra las tarjetas de opciones de donación | N/A |
| `[fjp_contador_impacto]` | Muestra contadores de impacto | `libras="5000"`, `voluntarios="100"`, `provincias="32"` |

**Ejemplo de estructura para la Home en el Editor:**
1. Bloque Fondo (Cover) con Video/Imagen y Texto (Hero)
2. Bloque Shortcode: `[fjp_contador_impacto]`
3. Bloque Grupo/Columnas con "Sobre Nosotros"
4. Bloque Shortcode: `[fjp_news_loop title="Últimas Novedades"]`
5. Bloque Shortcode: `[fjp_alliances_loop]`
6. Bloque Fondo (Cover) para CTA Final

---

## 16. SOLUCIÓN DE PROBLEMAS COMUNES

### Problema 1: Página en Blanco al Activar el Tema

**Síntomas:**
- Al activar el tema hijo FJP, el sitio muestra una página completamente en blanco
- O muestra un error como: "Parse error" o "Fatal error"

**Causas Posibles:**
- Error de sintaxis en `functions.php`
- Falta el tema padre Astra
- Incompatibilidad de versión de PHP

**Solución:**

1. **Acceder por FTP**:
   - Conectar con FileZilla
   - Navegar a: `public_html/wp-content/themes/`
   - Renombrar la carpeta `fjp-tema-hijo` a `fjp-tema-hijo-old`
   - Esto desactivará el tema y WordPress volverá al tema por defecto

2. **Activar modo debug**:
   - Editar el archivo `wp-config.php`
   - Buscar la línea: `define('WP_DEBUG', false);`
   - Cambiarla a: `define('WP_DEBUG', true);`
   - Esto mostrará los errores específicos

3. **Verificar logs de errores**:
   - En Hostinger, ir a **Archivos → Administrador de archivos**
   - Buscar archivo: `error_log` en la raíz
   - Abrirlo y ver el último error

4. **Soluciones específicas**:
   - Si dice "Class not found": Falta instalar Astra
   - Si dice "Parse error in functions.php line X": Hay un error de código en esa línea
   - Si dice "Memory limit exceeded": Aumentar memoria en `wp-config.php`:
     ```php
     define('WP_MEMORY_LIMIT', '256M');
     ```

### Problema 2: No Aparecen las Plantillas Personalizadas

**Síntomas:**
- Al editar una página, en "Plantilla" solo aparece "Default"
- No aparecen: Home, Donaciones, Noticias, etc.

**Causas:**
- Los archivos PHP no están en la carpeta correcta
- Los archivos no tienen el encabezado Template Name

**Solución:**

1. **Verificar ubicación de archivos**:
   - Conectar por FTP
   - Navegar a: `public_html/wp-content/themes/fjp-tema-hijo/`
   - Verificar que existan archivos como: `page-home.php`, `page-donaciones.php`, etc.

2. **Verificar encabezado de plantilla**:
   - Abrir `page-home.php` con un editor
   - Al inicio del archivo debe tener:
     ```php
     <?php
     /**
      * Template Name: Home
      */
     ?>
     ```
   - Si no tiene ese encabezado, añadirlo

3. **Refrescar permisos**:
   - En WordPress, ir a **Apariencia → Temas**
   - Desactivar y volver a activar el tema hijo FJP

### Problema 3: Los Campos de ACF No Aparecen

**Síntomas:**
- Al crear una noticia, no aparecen los campos personalizados abajo
- Solo aparecen título, contenido e imagen destacada

**Causas:**
- ACF no está instalado
- Los campos no se importaron correctamente
- Los campos no están asignados al Custom Post Type "Noticias"

**Solución:**

1. **Verificar instalación de ACF**:
   - Ir a **Plugins → Plugins instalados**
   - Buscar "Advanced Custom Fields"
   - Si no está, instalarlo

2. **Verificar campos importados**:
   - Ir a **Custom Fields → Field Groups**
   - Debe haber un grupo llamado "Configuración de Noticias"
   - Si no existe, importar desde `acf-export.json` o crear manualmente

3. **Verificar asignación**:
   - Abrir el grupo "Configuración de Noticias"
   - Desplazarse a **Location Rules** (Reglas de ubicación)
   - Verificar que diga: "Post Type is equal to Noticias"
   - Si no, añadir esa regla

4. **Crear campos manualmente** (si la importación falla):
   - Seguir la [Sección 6](#6-configuración-de-acf-y-campos-personalizados) de esta guía
   - Crear cada campo uno por uno

### Problema 4: El Formulario de Donaciones No Aparece

**Síntomas:**
- La página Donaciones está en blanco o sin formulario
- Aparece un shortcode visible como `[give_form id="1"]`

**Causas:**
- GiveWP no está instalado
- El shortcode tiene un ID incorrecto
- La plantilla no está llamando al formulario correctamente

**Solución:**

1. **Verificar GiveWP**:
   - **Plugins → Plugins instalados**
   - Buscar "Give - Donation Plugin"
   - Si no está, instalarlo y activarlo

2. **Verificar ID del formulario**:
   - Ir a **Donations → Forms**
   - Anotar el ID del formulario (aparece en la columna "ID")
   - Editar la página **Donaciones**
   - Reemplazar el shortcode con el ID correcto:
     ```
     [give_form id="X"]
     ```
     (donde X es el ID anotado)

3. **Verificar que el formulario esté publicado**:
   - En **Donations → Forms**
   - El estado debe ser "Published" (Publicado)
   - Si dice "Draft" (Borrador), publicarlo

### Problema 5: Error "No se Pueden Publicar Noticias"

**Síntomas:**
- Al intentar publicar una noticia, aparece un error
- O la noticia no se guarda

**Causas:**
- Custom Post Type no está registrado correctamente
- Permisos de usuario incorrectos
- Problema con los permalinks

**Solución:**

1. **Refrescar permalinks**:
   - **Ajustes → Enlaces permanentes**
   - Hacer clic en **"Guardar cambios"** (sin cambiar nada)
   - Intentar publicar de nuevo

2. **Verificar función en functions.php**:
   - Ir a **Apariencia → Editor de temas**
   - Abrir `functions.php`
   - Buscar: `function fjp_register_noticias_cpt()`
   - Verificar que exista
   - Buscar: `add_action('init', 'fjp_register_noticias_cpt');`
   - Verificar que exista

3. **Verificar permisos de usuario**:
   - Ir a **Usuarios → Tu perfil**
   - Verificar que tu rol sea "Administrador"

### Problema 6: Sitio Muy Lento

**Síntomas:**
- El sitio tarda más de 5 segundos en cargar
- Las páginas se quedan "pensando" mucho tiempo

**Causas:**
- Caché no está configurado
- Imágenes muy pesadas
- Demasiados plugins activos
- Hosting con pocos recursos

**Solución:**

1. **Activar LiteSpeed Cache**:
   - **LiteSpeed Cache → Cache**
   - Verificar que esté ON
   - Si no, activarlo

2. **Optimizar imágenes**:
   - Instalar plugin **Smush** (gratuito)
   - Ir a **Smush → Bulk Smush**
   - Hacer clic en "Bulk Smush Now"
   - Esperar a que optimice todas las imágenes

3. **Desactivar plugins innecesarios**:
   - Ir a **Plugins → Plugins instalados**
   - Desactivar plugins que no uses
   - Especialmente:
     - Plugins de "page builder" si no los usas
     - Plugins de redes sociales pesados
     - Plugins de sliders si no tienes sliders

4. **Medir velocidad**:
   - Ir a: https://pagespeed.web.dev/
   - Ingresar tu URL
   - Ver recomendaciones específicas

### Problema 7: Las Donaciones No Llegan al Email

**Síntomas:**
- Se completan donaciones pero no recibes email de notificación
- El donante tampoco recibe confirmación

**Causas:**
- Email del servidor no está configurado
- Emails van a carpeta de spam
- Plugin de email no configurado

**Solución:**

1. **Configurar email SMTP**:
   - Instalar plugin **WP Mail SMTP** (gratuito)
   - Ir a **WP Mail SMTP → Settings**
   - Configurar con email de Hostinger:
     - **From Email**: tu@tudominio.org
     - **From Name**: Fundación Juventud Progresista
     - **Mailer**: Other SMTP
     - **SMTP Host**: smtp.hostinger.com
     - **SMTP Port**: 587
     - **Encryption**: TLS
     - **Authentication**: ON
     - **Username**: tu@tudominio.org
     - **Password**: [contraseña del email]
   - Guardar cambios
   - Hacer clic en **"Send Test Email"** para probar

2. **Verificar configuración de GiveWP**:
   - **Donations → Settings → Emails**
   - Verificar que la dirección sea correcta
   - Habilitar notificaciones de admin

3. **Revisar spam**:
   - Revisar carpeta de spam de tu email
   - Marcar emails de GiveWP como "No spam"

### Problema 8: Error 500 - Internal Server Error

**Síntomas:**
- El sitio muestra "Error 500 Internal Server Error"
- No se puede acceder ni al frontend ni al admin

**Causas:**
- Error en archivo `.htaccess`
- Límite de memoria PHP excedido
- Plugin o tema con error crítico

**Solución:**

1. **Verificar archivo .htaccess**:
   - Conectar por FTP
   - Buscar archivo `.htaccess` en `public_html/`
   - Renombrarlo a `.htaccess-old`
   - Intentar acceder al sitio
   - Si funciona, regenerar permalinks en WordPress

2. **Aumentar límite de memoria**:
   - Editar `wp-config.php` por FTP
   - Añadir antes de "That's all, stop editing!":
     ```php
     define('WP_MEMORY_LIMIT', '256M');
     define('WP_MAX_MEMORY_LIMIT', '512M');
     ```

3. **Desactivar todos los plugins**:
   - Por FTP, ir a `public_html/wp-content/`
   - Renombrar carpeta `plugins` a `plugins-old`
   - Intentar acceder al sitio
   - Si funciona, el problema es un plugin
   - Renombrar de vuelta a `plugins`
   - En WordPress, desactivar plugins uno por uno para identificar el problemático

4. **Contactar soporte de Hostinger**:
   - Si nada funciona, abrir ticket con Hostinger
   - Ellos pueden revisar logs del servidor

---

## 📞 SOPORTE ADICIONAL

### Recursos Oficiales

- **WordPress en Español**: https://es.wordpress.org/support/
- **Documentación ACF**: https://www.advancedcustomfields.com/resources/
- **Documentación GiveWP**: https://givewp.com/documentation/
- **Soporte Hostinger**: https://www.hostinger.com/tutorials

### Videos Tutoriales Recomendados

1. **WordPress para principiantes**: Buscar en YouTube "WordPress tutorial español 2024"
2. **ACF básico**: "Advanced Custom Fields tutorial español"
3. **GiveWP configuración**: "Give WordPress tutorial"

### Foros y Comunidades

- **Foro WordPress.org**: https://es.wordpress.org/support/forums/
- **Facebook**: Grupos de "WordPress en Español"
- **Reddit**: r/WordPress

---

## 📝 NOTAS FINALES

### Diferencias Entre Versión HTML y WordPress

Este proyecto incluye versiones HTML (index.html, donaciones.html, etc.) que **NO debes usar** directamente. La versión WordPress (tema hijo) toma la **estructura y estilos** de esos HTML pero los convierte en páginas dinámicas de WordPress.

### Sobre Plugins Premium vs Free

Aunque el proyecto fue diseñado pensando en plugins premium, **casi todo puede funcionar con plugins gratuitos**. Las únicas limitaciones reales son:

- **ACF Free**: No tiene campos Repeater, Flexible Content ni Gallery
  - **Solución**: Usar campos individuales o usar bloques de WordPress/Gutenberg
- **GiveWP Free**: No tiene donaciones recurrentes ni recuperación de comisiones
  - **Solución**: Enfocarse en donaciones únicas por ahora

### Backup Regular Es CRÍTICO

**IMPORTANTE**: Siempre ten respaldos antes de:
- Actualizar WordPress
- Actualizar plugins
- Modificar archivos PHP
- Cambiar código

**Cómo hacer respaldo rápido**:
1. Instalar plugin **UpdraftPlus**
2. Configurar respaldos automáticos semanales
3. Conectar con Google Drive o Dropbox

### Próximos Pasos Recomendados

Una vez que el sitio esté funcionando:

1. **Semana 1-2**: Familiarizarse con WordPress y publicar noticias
2. **Semana 3-4**: Configurar correctamente las donaciones y probar
3. **Mes 2**: Optimizar SEO y comenzar a posicionar en Google
4. **Mes 3**: Evaluar métricas y considerar mejoras

---

## ✅ CHECKLIST FINAL DE INSTALACIÓN

Usa esta lista para verificar que TODO está completo:

### Configuración Básica
- [ ] WordPress instalado en Hostinger
- [ ] Tema Astra instalado (no activado)
- [ ] Tema hijo FJP instalado y activado
- [ ] Zona horaria configurada (UTC-4)
- [ ] Permalinks configurados (Nombre de entrada)

### Plugins
- [ ] ACF instalado y activado
- [ ] GiveWP instalado y activado
- [ ] Rank Math instalado y configurado
- [ ] LiteSpeed Cache instalado y activado
- [ ] (Opcional) Wordfence instalado

### Campos Personalizados
- [ ] acf-export.json importado correctamente
- [ ] Grupo "Configuración de Noticias" visible
- [ ] Campos asignados al Custom Post Type "Noticias"

### Páginas
- [ ] Página Home creada y configurada como inicio
- [ ] Página Quiénes Somos creada
- [ ] Página Donaciones creada
- [ ] Página Noticias creada
- [ ] Página Voluntariado creada
- [ ] Todas las páginas tienen plantilla correcta asignada

### Custom Post Type
- [ ] "Noticias" aparece en el menú de WordPress
- [ ] Se puede crear noticia de prueba
- [ ] Campos ACF aparecen al crear noticia
- [ ] Noticia se publica y visualiza correctamente

### Donaciones
- [ ] Formulario de donación creado
- [ ] PayPal configurado
- [ ] Transferencia bancaria configurada
- [ ] Formulario aparece en página Donaciones
- [ ] Donación de prueba funciona

### Menús
- [ ] Menú Principal creado
- [ ] Páginas añadidas al menú
- [ ] Menú asignado a ubicación Primary
- [ ] Menú visible en el sitio

### SEO
- [ ] Cada página tiene título SEO
- [ ] Cada página tiene meta descripción
- [ ] Sitemap.xml funciona
- [ ] Google Search Console configurado (opcional)

### Optimización
- [ ] LiteSpeed Cache activo
- [ ] Lazy load de imágenes activado
- [ ] Minificación CSS/JS activada
- [ ] Sitio carga en menos de 3 segundos

### Seguridad
- [ ] Contraseñas seguras configuradas
- [ ] SSL/HTTPS activo
- [ ] Wordfence escaneado (si instalado)
- [ ] Respaldo inicial creado

### Pruebas
- [ ] Sitio se ve bien en desktop
- [ ] Sitio se ve bien en tablet
- [ ] Sitio se ve bien en móvil
- [ ] Todas las páginas cargan sin errores
- [ ] Formularios funcionan correctamente

---

**🎉 ¡FELICITACIONES!**

Si completaste todos los puntos, tu sitio WordPress está completamente funcional y listo para usar.

---

**Versión de la Guía**: 1.0
**Fecha**: Enero 2024
**Proyecto**: Fundación Juventud Progresista
**Desarrollado para**: Usuarios sin experiencia técnica avanzada

---

*Esta guía ha sido creada con el objetivo de hacer el proceso de instalación lo más claro y accesible posible. Si encuentras algún problema no cubierto en esta guía, no dudes en contactar a la comunidad de WordPress o al soporte de Hostinger.*
