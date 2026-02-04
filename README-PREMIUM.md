# 🎨 FJP Premium Theme - Fundación Juventud Progresista

> **Premium WordPress Child Theme** for Astra - Professional-grade theme with native Gutenberg integration, advanced custom post types, and comprehensive design system.

**Version:** 2.0.0  
**Requires:** WordPress 6.0+, Astra Theme, Advanced Custom Fields (Free)  
**License:** GPL v2 or later

---

## 🌟 Key Features

### ✨ Premium Design System
- **Comprehensive Design Tokens** - Unified color palette, typography, spacing, and shadows
- **Theme.json Integration** - Full Site Editing support with visual controls
- **Synchronized Styles** - Perfect consistency between editor and frontend
- **Multi-Font Support** - Montserrat (headings), Inter (body), Georgia (serif), and Monospace

### 🎯 Native Gutenberg Integration
- **ACF Block Support** - Custom fields appear directly in the block editor
- **Block Patterns** - Pre-designed sections for quick page building
- **Custom Blocks** - Specialized blocks for news, testimonials, and more
- **Wide & Full Alignment** - Professional layout options

### 📝 Advanced Custom Post Types
- **Noticias** (News) - With external URL support, categories, tags, and galleries
- **Testimonios** - Volunteer and partner testimonials with ratings
- **Alianzas** - Partnership showcase with logos and descriptions
- **Voluntarios** - Complete volunteer management system

### 🎛️ Page-Level Controls (Like Astra Pro)
- Header transparency and sticky navigation
- Custom hero sections with background images
- Hide/show title and footer per page
- Content width control (narrow, default, wide, full)
- SEO meta fields and social media images

### 🚀 Performance Optimized
- Lazy loading images
- Minimal CSS and JS
- Modular component loading
- REST API integration for dynamic content

### 🔐 Security & Best Practices
- Sanitized inputs and outputs
- Nonce verification
- Capability checks
- i18n/l10n ready

---

## 📦 Installation

### Prerequisites
1. **WordPress** 6.0 or higher
2. **Astra Theme** (free version) - [Download](https://wordpress.org/themes/astra/)
3. **Advanced Custom Fields** (free) - [Download](https://wordpress.org/plugins/advanced-custom-fields/)

### Setup Instructions

1. **Upload the Theme**
   ```bash
   wp-content/themes/fjp-tema-hijo/
   ```

2. **Activate the Theme**
   - Go to `Appearance > Themes`
   - Activate "FJP - Fundación Juventud Progresista"

3. **Configure ACF**
   - Field groups are auto-registered via PHP
   - No import needed - they'll appear automatically

4. **Create Default Pages**
   ```
   - Home
   - Noticias
   - Quiénes Somos
   - Voluntariado
   - Donaciones
   - Contacto
   ```

5. **Set Permalinks**
   - Go to `Settings > Permalinks`
   - Choose "Post name" structure
   - Save changes

---

## 🎨 Using the Design System

### Color Palette
The theme includes a carefully curated color system:

- **Primary Blue** `#0056D2` - Main brand color
- **Secondary Green** `#28A745` - Call-to-action
- **Accent Red** `#E63946` - Highlights
- **Turquoise** `#2A9D8F` - Secondary accents
- **Dark Blue** `#264653` - Text and headings
- **Yellow** `#E9C46A` - Warm accents
- **Orange** `#F4A261` - Energy

All colors are accessible via:
- **WordPress Editor** - Color picker shows FJP colors
- **CSS Variables** - `var(--wp--preset--color--fjp-primary)`
- **Utility Classes** - `.has-fjp-primary-color`

### Typography System
- **Headings:** Montserrat (300-800 weights)
- **Body:** Inter (300-700 weights)
- **Serif:** Georgia (for quotes)
- **Monospace:** Courier New (for code)

Font sizes: XS, Small, Medium, Large, XL, XXL, XXXL, Huge, Massive

### Spacing Scale
- **XS:** 10px
- **SM:** 20px
- **MD:** 30px
- **LG:** 40px
- **XL:** 60px
- **XXL:** 80px
- **Huge:** 100px

---

## 📄 Working with Pages

### Page Options (Premium Features)

When editing any page, look for the **"⚙️ Opciones Avanzadas de Página (Premium)"** metabox in the sidebar.

#### Layout Options
- **Header Transparente** - Makes header overlay the content (perfect for hero sections)
- **Header Sticky** - Header follows you on scroll
- **Ocultar Título** - Hide automatic page title
- **Ocultar Footer** - Remove footer (landing pages)
- **Ancho de Contenido** - Choose content width (narrow, default, wide, full)

#### Hero Section
- **Activar Hero** - Enable custom hero section
- **Imagen de Fondo** - Upload hero background image
- **Altura del Hero** - Small (40vh), Medium (60vh), Large (80vh), Full (100vh)

#### SEO & Social
- **Meta Descripción** - Custom description for search engines
- **Imagen para Redes Sociales** - Open Graph image

### Example: Creating a Landing Page

1. **Create New Page**
2. **In Page Options:**
   - ✅ Header Transparente
   - ✅ Header Sticky
   - ✅ Ocultar Título
   - ✅ Ocultar Footer
   - Width: Full
3. **Add Hero Background Image**
4. **Build with Blocks**

---

## 📰 Managing Noticias (News)

### Creating a News Post

1. **Go to:** `Noticias > Agregar Nueva`
2. **Enter Title** and content in the editor
3. **Set Featured Image** (required for cards)
4. **Choose Categories and Tags**

### ACF Fields (Automatic in Editor)

#### Meta Información Tab
- **URL Externa** - Link to external article (auto-redirects)
- **Fuente** - Original source name (e.g., "Diario Libre")
- **Fecha de Publicación Original** - When originally published
- **Autor Externo** - Original author name

#### Opciones de Visualización Tab
- **Noticia Destacada** - Show on homepage
- **Noticia Urgente** - Display urgent badge
- **Color del Tema** - Primary, Secondary, Teal, Orange, Accent

#### Medios Tab
- **Galería de Imágenes** - Multiple images
- **URL de Video** - YouTube/Vimeo link

### Using Noticias in Pages

**Shortcode:**
```
[fjp_news_loop posts="6" title="Últimas Noticias" subtitle="Mantente informado"]
```

**Block Pattern:** Use "Noticias Grid" pattern

---

## 👥 Managing Testimonios

### Creating a Testimonial

1. **Go to:** `Testimonios > Agregar Nuevo`
2. **Title:** Person's full name
3. **Content:** The testimonial text (quote)
4. **Featured Image:** Profile photo

### ACF Fields
- **Cargo/Rol** - E.g., "Voluntaria educativa"
- **Organización** - Organization name
- **Valoración** - 1-5 stars
- **Fecha de Colaboración** - When they collaborated
- **Testimonio Destacado** - Feature this testimonial

### Using Testimonials

**Shortcode:**
```
[fjp_testimonials_loop posts="3" title="Lo que dicen nuestros voluntarios"]
```

---

## 🤝 Managing Alianzas (Partnerships)

### Adding a Partner

1. **Go to:** `Alianzas > Agregar Nueva`
2. **Title:** Organization name
3. **Featured Image:** Logo (recommended: 200x100px PNG with transparency)

### ACF Fields
- **Sitio Web** - Partner's website URL
- **Tipo de Alianza** - Strategic, Operational, Sponsorship, Collaboration
- **Fecha de Inicio** - When partnership began
- **Descripción Breve** - About the partnership (max 250 chars)
- **Alianza Activa** - Is partnership currently active?

### Using Alliances

**Shortcode:**
```
[fjp_alliances_loop posts="12" title="Nuestros Aliados"]
```

---

## 👋 Managing Voluntarios

### The Volunteer System

The volunteer post type is **private** (not visible on frontend). It's designed to manage volunteer applications submitted via forms.

### When a Form is Submitted

A new "Voluntario" post is created automatically with all the form data stored in ACF fields.

### Reviewing Applications

1. **Go to:** `Voluntarios > Todos los Voluntarios`
2. **View columns:**
   - Email
   - Area of interest
   - Application status
   - Submission date
3. **Click to edit** and review full details

### ACF Fields (Private Data)

#### Información Personal
- Email, Phone, Age, City

#### Detalles del Voluntariado
- **Área de Interés** - Education, Sports, Arts, Admin, etc.
- **Disponibilidad** - Mornings, Afternoons, Weekends, Full-time
- **Experiencia Previa** - Previous volunteer experience
- **Motivación** - Why they want to volunteer

#### Estado
- **Estado de Solicitud:**
  - Pendiente (yellow)
  - En revisión (blue)
  - Aprobado (green)
  - Activo (blue)
  - Inactivo (gray)
  - Rechazado (red)
- **Notas Internas** - Staff notes (private)

---

## 🛠️ Shortcodes Reference

### News Loop
```
[fjp_news_loop posts="3" title="Últimas Noticias" subtitle="Description"]
```

### Alliances Grid
```
[fjp_alliances_loop posts="6" title="Nuestras Alianzas" subtitle="Partners"]
```

### Testimonials Carousel
```
[fjp_testimonials_loop posts="3" title="Testimonios"]
```

### Volunteer Testimonials
```
[fjp_volunteer_testimonials]
```

### Volunteer Form
```
[fjp_volunteer_form]
```

### Donation Options
```
[fjp_donation_options]
```

### Impact Counter
```
[fjp_contador_impacto libras="56966" voluntarios="1341" provincias="22"]
```

---

## 🎯 Block Patterns

The theme includes pre-designed block patterns accessible via the **Patterns** panel in the block editor:

### Available Patterns
- **Hero Home** - Full-width hero section with gradient
- **Contadores** - Impact counter section
- **Noticias Grid** - News cards grid
- **Testimonios** - Testimonial cards
- **Call to Action** - CTA section with button
- **Página Home Completa** - Full homepage layout

### Using Patterns
1. **Click +** in block editor
2. **Go to Patterns tab**
3. **Select "FJP Secciones"** category
4. **Click pattern to insert**
5. **Edit text and images**

---

## 🎨 Customizing Styles

### Via WordPress Customizer
1. **Go to:** `Appearance > Customize`
2. **Colors** - Modify brand colors
3. **Typography** - Change fonts
4. **Layout** - Content width

### Via theme.json
All design tokens are defined in `theme.json`. This file controls:
- Color palette
- Typography system
- Spacing scale
- Border styles
- Shadows

### Via CSS Variables
```css
:root {
    --fjp-primary: #0056D2;
    --fjp-secondary: #28A745;
    --fjp-spacing-md: 30px;
}
```

---

## 🔧 Developer Documentation

### File Structure
```
fjp-tema-hijo/
├── style.css                  # Main stylesheet
├── theme.json                 # FSE configuration
├── functions.php              # Main functions file
├── inc/
│   ├── acf-fields.php        # ACF field groups
│   ├── acf-blocks.php        # ACF Gutenberg blocks
│   ├── custom-post-types.php # CPT registration
│   ├── shortcodes.php        # Shortcode functions
│   ├── customizer.php        # Theme customizer
│   ├── patterns.php          # Block patterns
│   ├── custom-layout-metabox.php # Page options
│   ├── performance.php       # Optimization
│   ├── admin.php             # Admin customizations
│   └── security.php          # Security enhancements
├── js/
│   ├── main.js               # Main JavaScript
│   ├── counter.js            # Counter animations
│   ├── news.js               # News functionality
│   ├── volunteers.js         # Volunteer forms
│   └── donations.js          # Donation interactions
├── templates/
│   ├── page-home.php
│   ├── page-noticias.php
│   ├── page-voluntariado.php
│   └── single-noticias.php
└── languages/
    └── fjp.pot                # Translation template
```

### Hooks & Filters

#### Actions
```php
add_action('fjp_before_content', 'your_function');
add_action('fjp_after_content', 'your_function');
add_action('fjp_news_card_meta', 'your_function');
```

#### Filters
```php
add_filter('fjp_news_query_args', 'your_function');
add_filter('fjp_excerpt_length', 'your_function');
add_filter('fjp_social_links', 'your_function');
```

### REST API Endpoints
```
GET /wp-json/wp/v2/noticias
GET /wp-json/wp/v2/testimonios
GET /wp-json/wp/v2/alianzas
```

---

## 🐛 Troubleshooting

### Styles Not Showing
1. **Clear cache** (if using caching plugin)
2. **Regenerate CSS:** `Appearance > Astra Options > Regenerate Assets`
3. **Check parent theme** is Astra

### ACF Fields Not Appearing
1. **Verify ACF plugin** is active (free version works)
2. **Check field groups** are assigned to correct post types
3. **Clear object cache** if using Redis/Memcached

### Custom Post Types 404
1. **Re-save permalinks:** `Settings > Permalinks > Save Changes`
2. **Check post type registration** in `inc/custom-post-types.php`

### Block Patterns Not Showing
1. **Check WordPress version** is 5.9+
2. **Verify** `inc/patterns.php` is loaded
3. **Clear browser cache**

---

## 📚 Support & Documentation

### Resources
- **ACF Documentation:** https://www.advancedcustomfields.com/resources/
- **Astra Theme Docs:** https://wpastra.com/docs/
- **Block Editor Handbook:** https://developer.wordpress.org/block-editor/

### Getting Help
1. Check this README
2. Review code comments
3. Contact development team

---

## 🎯 Roadmap

### Version 2.1 (Planned)
- [ ] Advanced form builder
- [ ] Event management CPT
- [ ] Newsletter integration
- [ ] Multi-language support (WPML/Polylang)

### Version 2.2 (Planned)
- [ ] WooCommerce integration
- [ ] Learning Management System
- [ ] Member profiles
- [ ] Interactive maps

---

## 📄 License

This theme is licensed under the GPL v2 or later.

```
FJP Premium Theme
Copyright (C) 2024 Fundación Juventud Progresista

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
```

---

## 💝 Credits

**Developed by:** Equipo de Desarrollo Web FJP  
**Based on:** Astra Theme by Brainstorm Force  
**Powered by:** WordPress, ACF, PHP, JavaScript

---

## 🚀 Quick Start Checklist

- [ ] Install WordPress 6.0+
- [ ] Install & activate Astra theme
- [ ] Install & activate ACF (free)
- [ ] Upload FJP Premium theme
- [ ] Activate FJP Premium theme
- [ ] Go to Settings > Permalinks > Save
- [ ] Create basic pages (Home, About, News, etc.)
- [ ] Configure theme options in Customizer
- [ ] Add your first noticia with featured image
- [ ] Test responsive design on mobile
- [ ] Celebrate! 🎉

---

**Made with ❤️ for a better Dominican Republic**
