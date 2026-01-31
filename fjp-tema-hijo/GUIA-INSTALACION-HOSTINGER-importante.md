# 🚀 Guía de Instalación Completa - Fundación Juega y Participa
## WordPress Premium en Hostinger con Tema Personalizado

---

## 📋 ÍNDICE

1. [Preparación del Entorno](#1-preparación-del-entorno)
2. [Instalación de WordPress en Hostinger](#2-instalación-de-wordpress-en-hostinger)
3. [Configuración del Tema Hijo FJP](#3-configuración-del-tema-hijo-fjp)
4. [Instalación de Plugins Premium](#4-instalación-de-plugins-premium)
5. [Configuración de ACF y Campos Personalizados](#5-configuración-de-acf-y-campos-personalizados)
6. [Configuración de GiveWP para Donaciones](#6-configuración-de-givewp-para-donaciones)
7. [Optimización de Rendimiento](#7-optimización-de-rendimiento)
8. [SEO y Analytics](#8-seo-y-analytics)
9. [Seguridad y Backups](#9-seguridad-y-backups)
10. [Testing y Go Live](#10-testing-y-go-live)
11. [Mantenimiento Post-Instalación](#11-mantenimiento-post-instalación)

---

## 1. PREPARACIÓN DEL ENTORNO

### 📁 Estructura de Archivos del Proyecto
```
fjp-wordpress/
├── fjp-tema-hijo/
│   ├── style.css
│   ├── functions.php
│   ├── functions-advanced.php
│   ├── page-home.php
│   ├── page-quienes-somos.php
│   ├── page-donaciones.php
│   ├── page-noticias.php
│   ├── page-voluntariado.php
│   ├── single-noticias.php
│   ├── acf-export.json
│   └── assets/
├── plugins/
│   ├── advanced-custom-fields-pro.zip
│   ├── givewp.zip
│   ├── rank-math-seo.zip
│   └── litespeed-cache.zip
├── documentacion/
│   ├── instalacion-hostinger.md
│   └── configuracion-adicional.md
└── backups/
```

### 🔧 Requisitos del Sistema
- **PHP**: 7.4 o superior
- **MySQL**: 5.7 o superior
- **WordPress**: 6.0 o superior
- **Almacenamiento**: Mínimo 2GB
- **RAM**: 1GB recomendado

---

## 2. INSTALACIÓN DE WORDPRESS EN HOSTINGER

### Paso 1: Acceso al Panel de Control
1. Ingresar a [Hostinger](https://www.hostinger.com)
2. Acceder al panel de control (hPanel)
3. Ir a **Websites** → **Panel de Control**

### Paso 2: Instalación Automática de WordPress
```bash
# Opción A: Auto Instalador
1. Ir a "Website" → "Auto Installer"
2. Seleccionar "WordPress"
3. Configurar:
   - URL del sitio: https://fundacionjuegayparticipa.org
   - Idioma: Español
   - Usuario admin: admin_fjp
   - Contraseña: [GENERAR CONTRASEÑA SEGURA]
   - Email: info@fundacionjuegayparticipa.org
```

### Paso 3: Configuración Inicial
```php
// wp-config.php - Configuraciones adicionales
// Agregar después de wp-settings.php:

// Desactivar edición de archivos desde el admin
define('DISALLOW_FILE_EDIT', true);

// Desactivar actualizaciones automáticas de plugins
define('AUTOMATIC_UPDATER_DISABLED', true);

// Aumentar límite de memoria
define('WP_MEMORY_LIMIT', '512M');
define('WP_MAX_MEMORY_LIMIT', '512M');

// Configurar SSL
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}

// Desactivar cron de WP (usar cron real)
define('DISABLE_WP_CRON', true);
```

### Paso 4: Configuración de Base de Datos
```sql
-- Optimización de base de datos
-- Ejecutar en phpMyAdmin

-- Cambiar prefijo de tablas (opcional)
RENAME TABLE wp_options TO fjp_options;
RENAME TABLE wp_posts TO fjp_posts;
RENAME TABLE wp_postmeta TO fjp_postmeta;
RENAME TABLE wp_users TO fjp_users;
RENAME TABLE wp_usermeta TO fjp_usermeta;

-- Actualizar referencias
UPDATE fjp_options SET option_name = REPLACE(option_name, 'wp_', 'fjp_');
UPDATE fjp_usermeta SET meta_key = REPLACE(meta_key, 'wp_', 'fjp_');
```

---

## 3. CONFIGURACIÓN DEL TEMA HIJO FJP

### Paso 1: Instalación del Tema Padre (Astra)
```bash
# En el panel de WordPress
1. Apariencia → Temas → Añadir nuevo
2. Buscar "Astra" de Brainstorm Force
3. Instalar y activar
```

### Paso 2: Instalación del Tema Hijo FJP
```bash
# Método A: FTP
1. Conectar por FTP a Hostinger
2. Subir carpeta /fjp-tema-hijo/ a /wp-content/themes/
3. En WordPress: Apariencia → Temas → Activar "FJP Tema Hijo"

# Método B: Zip
1. Comprimir /fjp-tema-hijo/ en fjp-tema-hijo.zip
2. WordPress → Apariencia → Temas → Subir tema
3. Seleccionar archivo zip y activar
```

### Paso 3: Configuración del Tema
```php
// functions.php - Verificar activación
die('Tema FJP activado correctamente');

// Después de verificar, comentar la línea
```

### Paso 4: Crear Páginas Principales
```sql
-- Crear páginas base
INSERT INTO fjp_posts (post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count) VALUES
(1, NOW(), NOW(), '', 'Home', '', 'publish', 'closed', 'closed', '', 'home', '', '', NOW(), NOW(), '', 0, 'https://fundacionjuegayparticipa.org/?page_id=2', 0, 'page', '', 0),
(1, NOW(), NOW(), '', 'Quiénes Somos', '', 'publish', 'closed', 'closed', '', 'quienes-somos', '', '', NOW(), NOW(), '', 0, 'https://fundacionjuegayparticipa.org/?page_id=3', 0, 'page', '', 0),
(1, NOW(), NOW(), '', 'Donaciones', '', 'publish', 'closed', 'closed', '', 'donaciones', '', '', NOW(), NOW(), '', 0, 'https://fundacionjuegayparticipa.org/?page_id=4', 0, 'page', '', 0),
(1, NOW(), NOW(), '', 'Noticias', '', 'publish', 'closed', 'closed', '', 'noticias', '', '', NOW(), NOW(), '', 0, 'https://fundacionjuegayparticipa.org/?page_id=5', 0, 'page', '', 0),
(1, NOW(), NOW(), '', 'Voluntariado', '', 'publish', 'closed', 'closed', '', 'voluntariado', '', '', NOW(), NOW(), '', 0, 'https://fundacionjuegayparticipa.org/?page_id=6', 0, 'page', '', 0);

-- Configurar página de inicio
UPDATE fjp_options SET option_value = '2' WHERE option_name = 'page_on_front';
UPDATE fjp_options SET option_value = 'page' WHERE option_name = 'show_on_front';
```

---

## 4. INSTALACIÓN DE PLUGINS PREMIUM

### Paso 1: Subir Plugins por FTP
```bash
# Conectar por FTP
Host: ftp.fundacionjuegayparticipa.org
Usuario: [usuario_hostinger]
Contraseña: [contraseña_hostinger]

# Subir archivos
/plugins/advanced-custom-fields-pro.zip → /wp-content/plugins/
/plugins/givewp.zip → /wp-content/plugins/
/plugins/rank-math-seo.zip → /wp-content/plugins/
/plugins/litespeed-cache.zip → /wp-content/plugins/
```

### Paso 2: Descomprimir y Activar
```bash
# Descomprimir archivos
unzip advanced-custom-fields-pro.zip -d /wp-content/plugins/
unzip givewp.zip -d /wp-content/plugins/
unzip rank-math-seo.zip -d /wp-content/plugins/
unzip litespeed-cache.zip -d /wp-content/plugins/

# Activar plugins desde WordPress
Plugins → Todos los plugins → Activar seleccionados
```

### Paso 3: Configuración de Plugins
```php
// Configuración de ACF
add_filter('acf/settings/show_admin', '__return_true');
add_filter('acf/settings/show_updates', '__return_true', 100);

// Configuración de Rank Math
add_filter('rank_math/seo_analysis/disable_analysis', '__return_true');

// Configuración de LiteSpeed
add_filter('litespeed_cache_disable', '__return_false');
```

---

## 5. CONFIGURACIÓN DE ACF Y CAMPOS PERSONALIZADOS

### Paso 1: Importar Campos ACF
```bash
# WordPress Admin
1. Custom Fields → Tools → Import
2. Seleccionar archivo: acf-export.json
3. Importar todos los grupos de campos
```

### Paso 2: Configurar Opciones del Sitio
```php
// functions.php - Crear páginas de opciones
if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'    => 'Configuración General FJP',
        'menu_title'    => 'Configuración FJP',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Configuración de Donaciones',
        'menu_title'    => 'Donaciones',
        'parent_slug'   => 'theme-general-settings',
        'menu_slug'     => 'theme-donation-settings'
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Redes Sociales',
        'menu_title'    => 'Redes Sociales',
        'parent_slug'   => 'theme-general-settings',
        'menu_slug'     => 'theme-social-settings'
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'SEO',
        'menu_title'    => 'SEO',
        'parent_slug'   => 'theme-general-settings',
        'menu_slug'     => 'theme-seo-settings'
    ));
}
```

### Paso 3: Configurar Campos de Noticias
```php
// Verificar que los campos se importaron correctamente
// Ir a: Custom Fields → Field Groups
// Debe aparecer: "Configuración de Noticias"

// Configurar valores por defecto
update_field('telefono_de_contacto', '+54 11 3456-7890', 'option');
update_field('email_de_contacto', 'info@fundacionjuegayparticipa.org', 'option');
update_field('whatsapp_numero', '+5491134567890', 'option');
```

---

## 6. CONFIGURACIÓN DE GIVEWP PARA DONACIONES

### Paso 1: Configuración Inicial
```bash
# WordPress Admin
GiveWP → Configuración → General

Configuración básica:
- Moneda: Peso Argentino (ARS)
- Formato de moneda: $1,000.00
- Base de datos: Crear tablas
- Correo electrónico: info@fundacionjuegayparticipa.org
```

### Paso 2: Pasarelas de Pago
```php
// Configuración de PayPal
add_action('give_paypal_commerce_merchant_id', function() {
    return 'AY_QkT5P5_1234567890';
});

// Configuración de MercadoPago
add_action('give_mercadopago_public_key', function() {
    return 'TEST-1234567890';
});

add_action('give_mercadopago_access_token', function() {
    return 'TEST-12345678901234567890';
});
```

### Paso 3: Crear Formularios de Donación
```php
// Crear formulario de donación básico
$form_id = wp_insert_post([
    'post_title' => 'Donación General',
    'post_content' => '',
    'post_status' => 'publish',
    'post_type' => 'give_forms'
]);

// Configurar formulario
update_post_meta($form_id, '_give_set_price', '100');
update_post_meta($form_id, '_give_price_option', 'multi');
update_post_meta($form_id, '_give_donation_levels', [
    ['_give_amount' => '500', '_give_text' => '$500 ARS'],
    ['_give_amount' => '1000', '_give_text' => '$1,000 ARS'],
    ['_give_amount' => '2500', '_give_text' => '$2,500 ARS'],
    ['_give_amount' => '5000', '_give_text' => '$5,000 ARS']
]);
```

---

## 7. OPTIMIZACIÓN DE RENDIMIENTO

### Paso 1: Configuración de LiteSpeed Cache
```php
// Activar caché
add_filter('litespeed_cache_enabled', '__return_true');

// Configuración avanzada
add_filter('litespeed_cache_optimize_ttl', function() {
    return 86400; // 24 horas
});

add_filter('litespeed_cache_browser_ttl', function() {
    return 31536000; // 1 año
});
```

### Paso 2: Optimización de Imágenes
```bash
# Activar WebP
wp litespeed-preset webp

# Optimizar imágenes existentes
wp media regenerate --yes
```

### Paso 3: Configuración de CDN
```php
// Si usas CDN de Hostinger
add_filter('litespeed_cdn_enabled', '__return_true');
add_filter('litespeed_cdn_url', function() {
    return 'https://cdn.fundacionjuegayparticipa.org';
});
```

---

## 8. SEO Y ANALYTICS

### Paso 1: Configuración de Rank Math
```php
// Configuración básica
add_filter('rank_math_options', function($options) {
    $options['general']['site_name'] = 'Fundación Juega y Participa';
    $options['general']['site_description'] = 'Trabajamos por los derechos de niños, niñas y adolescentes';
    $options['general']['admin_email'] = 'info@fundacionjuegayparticipa.org';
    return $options;
});
```

### Paso 2: Google Analytics
```php
// Agregar GA4
add_action('wp_head', function() {
    $ga_id = get_field('google_analytics_id', 'option');
    if ($ga_id): ?>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($ga_id); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?php echo esc_attr($ga_id); ?>');
    </script>
    <?php endif;
});
```

### Paso 3: Facebook Pixel
```php
// Agregar Facebook Pixel
add_action('wp_head', function() {
    $pixel_id = get_field('facebook_pixel_id', 'option');
    if ($pixel_id): ?>
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '<?php echo esc_attr($pixel_id); ?>');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=<?php echo esc_attr($pixel_id); ?>&ev=PageView&noscript=1"/>
    </noscript>
    <?php endif;
});
```

---

## 9. SEGURIDAD Y BACKUPS

### Paso 1: Configuración de Seguridad
```php
// functions-advanced.php - Seguridad premium

// Cambiar prefijo de tablas (si no se hizo durante la instalación)
// $table_prefix = 'fjp_';

// Desactivar XML-RPC
add_filter('xmlrpc_enabled', '__return_false');

// Ocultar versión de WordPress
remove_action('wp_head', 'wp_generator');

// Desactivar edición de archivos
define('DISALLOW_FILE_EDIT', true);

// Limitar intentos de login
add_action('wp_login_failed', 'fjp_limit_login_attempts');
function fjp_limit_login_attempts() {
    $max_attempts = 5;
    $lockout_time = 15 * 60; // 15 minutos

    if (!session_id()) {
        session_start();
    }

    $user_ip = $_SERVER['REMOTE_ADDR'];
    $attempt_key = 'login_attempts_' . $user_ip;

    if (!isset($_SESSION[$attempt_key])) {
        $_SESSION[$attempt_key] = 0;
    }

    $_SESSION[$attempt_key]++;

    if ($_SESSION[$attempt_key] >= $max_attempts) {
        $_SESSION['login_lockout_' . $user_ip] = time() + $lockout_time;
        $_SESSION[$attempt_key] = 0;

        wp_die('Demasiados intentos fallidos. Por favor, inténtalo de nuevo en 15 minutos.');
    }
}
```

### Paso 2: Configuración de Backups
```bash
# Crear script de backup#!/bin/bash

# Variables
DB_NAME="fundacionjuegayparticipa"
DB_USER="u123456789_fjp"
DB_PASS="[CONTRASEÑA_BASE_DE_DATOS]"
BACKUP_DIR="/home/u123456789/backups"
DATE=$(date +%Y%m%d_%H%M%S)

# Crear directorio de backups
mkdir -p $BACKUP_DIR

# Backup de base de datos
mysqldump -u$DB_USER -p$DB_PASS $DB_NAME > $BACKUP_DIR/db_backup_$DATE.sql

# Backup de archivos
tar -czf $BACKUP_DIR/files_backup_$DATE.tar.gz /home/u123456789/public_html/

# Subir a Google Drive (requiere rclone configurado)
# rclone copy $BACKUP_DIR/ gdrive:backups-fjp/

# Eliminar backups antiguos (más de 30 días)
find $BACKUP_DIR -name "*.sql" -mtime +30 -delete
find $BACKUP_DIR -name "*.tar.gz" -mtime +30 -delete

# Programar en cron (crontab -e)
# 0 2 * * * /home/u123456789/scripts/backup-diario.sh
```

### Paso 3: Configuración SSL
```bash
# Hostinger proporciona SSL gratuito automáticamente
# Verificar en: Hosting → SSL

# Forzar HTTPS
# Agregar en .htaccess
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

# También agregar en wp-config.php
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}
```

---

## 10. TESTING Y GO LIVE

### Paso 1: Checklist de Testing
```
✅ Funcionalidad básica del sitio
✅ Formularios de contacto y donaciones
✅ Páginas de inicio, quienes somos, donaciones, noticias, voluntariado
✅ Responsive design (móvil, tablet, desktop)
✅ Velocidad de carga (PageSpeed Insights > 90)
✅ SEO básico (Rank Math configurado)
✅ Analytics funcionando
✅ Formularios de contacto llegando al email
✅ Proceso de donación completo
✅ Carga de noticias
✅ Links funcionando (sin broken links)
✅ SSL activo en todas las páginas
✅ Backups automáticos configurados
✅ Seguridad básica implementada
```

### Paso 2: Pruebas de Rendimiento
```bash
# Test de velocidad con GTmetrix
# Test de velocidad con PageSpeed Insights
# Test de seguridad con Sucuri
# Test de SEO con SEMrush
```

### Paso 3: Go Live
```bash
# 1. Verificar DNS apuntando a Hostinger
# 2. Verificar SSL activo
# 3. Configurar email con Hostinger
# 4. Enviar sitio a motores de búsqueda
# 5. Configurar Google Search Console
# 6. Configurar Google My Business
# 7. Crear redes sociales
# 8. Lanzar campaña de marketing
```

---

## 11. MANTENIMIENTO POST-INSTALACIÓN

### Mantenimiento Semanal
```bash
# Actualizar plugins y temas
wp plugin update --all
wp theme update --all

# Optimizar base de datos
wp db optimize

# Limpiar spam y revisiones
wp comment delete $(wp comment list --status=spam --format=ids)
wp post delete $(wp post list --post_type='revision' --format=ids)

# Verificar enlaces rotos
wp broken-links check
```

### Mantenimiento Mensual
```bash
# Revisar logs de errores
tail -f /home/u123456789/logs/error_log

# Actualizar WordPress core
wp core update

# Revisar estadísticas de Google Analytics
# Revisar posicionamiento SEO
# Actualizar contenido si es necesario
```

### Mantenimiento Trimestral
```bash
# Revisar y actualizar políticas de privacidad
# Revisar términos y condiciones
# Actualizar información de contacto
# Revisar estrategia de contenidos
# Planificar mejoras y nuevas funcionalidades
```

---

## 🆘 SOLUCIÓN DE PROBLEMAS COMUNES

### Error 500 - Internal Server Error
```bash
# Verificar logs
 tail -f /home/u123456789/logs/error_log

# Soluciones comunes:
1. Verificar permisos de archivos (644 para archivos, 755 para carpetas)
2. Verificar espacio en disco: df -h
3. Verificar límites de recursos en php.ini
4. Desactivar plugins problemáticos
```

### Sitio Lento
```bash
# Verificar uso de recursos
top -c

# Optimizaciones:
1. Activar LiteSpeed Cache
2. Optimizar imágenes
3. Minificar CSS/JS
4. Usar CDN
5. Optimizar base de datos
```

### Problemas con el Email
```bash
# Verificar configuración DNS MX
# Verificar configuración SPF/DKIM
# Verificar que el email no esté en lista negra
```

---

## 📞 SOPORTE Y CONTACTO

### Contacto de Desarrollo
- **Email**: desarrollo@fundacionjuegayparticipa.org
- **Teléfono**: +54 11 3456-7890
- **Horario**: Lunes a Viernes 9:00-18:00

### Documentación Adicional
- [Manual de Usuario WordPress](https://wordpress.org/support/)
- [Documentación ACF](https://www.advancedcustomfields.com/docs/)
- [Documentación GiveWP](https://givewp.com/documentation/)
- [Documentación Rank Math](https://rankmath.com/kb/)

### Recursos Externos
- [Hostinger Knowledge Base](https://support.hostinger.com/)
- [WordPress.org Forums](https://wordpress.org/support/forums/)
- [GTmetrix Speed Testing](https://gtmetrix.com/)
- [Google PageSpeed Insights](https://pagespeed.web.dev/)

---

**✅ Última actualización**: Enero 2024
**📝 Versión**: 2.0 Premium
**👨‍💻 Desarrollado por**: Equipo de Desarrollo FJP

**¡Gracias por elegir nuestro tema premium!**

---

*Esta guía está diseñada para usuarios con conocimientos intermedios de WordPress. Si necesitas ayuda adicional, no dudes en contactarnos.*