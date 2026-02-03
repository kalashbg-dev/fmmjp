# ✅ ESTADO DEL PROYECTO

Este documento detalla el estado actual del proyecto tras la refactorización a una Arquitectura Híbrida y la auditoría de compatibilidad.

## 📋 Checklist de Auditoría

### 1. Arquitectura Híbrida
- [x] **Plantillas Dinámicas**: `page-home.php`, `page-quienes-somos.php`, `page-donaciones.php`, `page-noticias.php`, `page-voluntariado.php` ahora utilizan el loop estándar `the_content()`.
- [x] **Gestión de Contenido**: Se ha creado `5-guia-composicion-bloques.md` con el código de bloques para recrear el diseño original en Gutenberg.
- [x] **Componentes Dinámicos**: La lógica compleja (Noticias, Alianzas, Testimonios) se ha movido a `inc/shortcodes.php`.

### 2. Diseño y Estilos (Design Tokens)
- [x] **Variables CSS**: `style.css` define variables en `:root` para colores, tipografías y espaciado.
- [x] **Global Styles**: Se ha implementado `theme.json` para permitir la personalización visual desde el Editor del Sitio.
- [x] **Soporte de Bloques**: Se han añadido clases de utilidad en `style.css` para soportar las clases nativas de bloques de WordPress (`wp-block-*`).
- [x] **Limpieza**: Se han eliminado los estilos en línea (inline CSS) de los archivos PHP.

### 3. Compatibilidad de Plugins (Free vs Premium)
- [x] **ACF Free**: Se ha actualizado `acf-export.json` para eliminar dependencias de campos "Repeater" en la lógica crítica o proveer fallbacks en el código (`inc/shortcodes.php`).
- [x] **GiveWP Free**: Se ha eliminado `givewp-config.php` (código muerto/premium) y se han asegurado los shortcodes con verificaciones `class_exists('Give')`.
- [x] **Funciones Deprecadas**: Se auditó el código para asegurar compatibilidad con PHP 8.3 y WP 6.9.

### 4. Seguridad y Mantenimiento
- [x] **Seguridad**: Se eliminó la función peligrosa `fjp_proteger_sql_injection` que corrompía los datos de entrada.
- [x] **WhatsApp**: Se corrigió la duplicación del botón de WhatsApp, consolidando la lógica en `functions-advanced.php` y los estilos en `style.css`.
- [x] **Documentación**: `3-guia_completa.md` ha sido reescrita para reflejar el estado final y el uso del sistema híbrido.

---

## 📂 Archivos Clave

- `fjp-tema-hijo/style.css`: Estilos principales y Design Tokens.
- `fjp-tema-hijo/theme.json`: Configuración de estilos globales.
- `fjp-tema-hijo/inc/shortcodes.php`: Lógica de componentes dinámicos.
- `fjp-tema-hijo/functions.php`: Punto de entrada, carga scripts y configuraciones.
- `3-guia_completa.md`: Manual de usuario.
- `5-guia-composicion-bloques.md`: Guía para restaurar contenido visual.

## 🚀 Próximos Pasos Recomendados

1.  **Importar ACF**: Ir a ACF > Herramientas e importar `fjp-tema-hijo/acf-export.json`.
2.  **Crear Páginas**: Crear las páginas Home, Quiénes Somos, etc., y pegar el código de bloques de la guía de composición.
3.  **Personalizar**: Usar el Editor del Sitio (Apariencia > Editor) para ajustar colores si es necesario.
