# Guía de Construcción Manual - Fundación Juventud Progresista

Esta guía está diseñada para construir el sitio sección por sección utilizando **Bloques de Código** (HTML y Shortcodes). Esto le permite tener control total sobre el diseño.

## 0. Instalación y Estructura

El tema hijo FJP está diseñado para ser ligero y modular.

### Estructura de Carpetas
Al instalar el tema (archivo `.zip`), encontrará estas carpetas clave:
*   `/inc/`: Contiene toda la lógica PHP (Shortcodes, CPTs, Configuración). **No borrar**.
*   `/blocks/`: Contiene los archivos de registro de los Bloques ACF. **No borrar**.
*   `/acf-json/`: Carpeta donde se guardan automáticamente las configuraciones de los campos ACF. Esto permite que los campos aparezcan en el administrador sin necesidad de configurarlos manualmente. Si mueve el tema a otro sitio, asegúrese de incluir esta carpeta.

### Instalación
1.  Comprima la carpeta `fjp-tema-hijo` en un archivo `.zip`.
2.  En WordPress, vaya a Apariencia > Temas > Añadir nuevo > Subir tema.
3.  Suba el `.zip` y active el tema.
4.  Asegúrese de que el plugin **Advanced Custom Fields (ACF)** esté instalado y activo.

---

## 1. Instrucciones de Construcción

1.  Cree una nueva página en WordPress.
2.  Seleccione la plantilla **"FJP - Ancho Completo (Canvas)"** en los atributos de página.
3.  Para insertar cada sección, agregue un bloque **"HTML Personalizado"** (o "Custom HTML") y pegue el código correspondiente de las secciones abajo.

---

## 2. Página de Inicio (Home)

### Sección A: Hero (Portada)
```html
<div class="fjp-hero-section alignfull" style="background-image: url('https://via.placeholder.com/1920x800'); background-size: cover; background-position: center; position: relative; height: 600px; display: flex; align-items: center;">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(242, 56, 90, 0.8);"></div> <!-- Overlay Primario -->
    <div class="container" style="position: relative; z-index: 2; color: white; text-align: center;">
        <h1 style="font-size: 3.5rem; font-weight: 700; margin-bottom: 20px;">Juntos construyendo un futuro mejor</h1>
        <p style="font-size: 1.5rem; margin-bottom: 40px; max-width: 800px; margin-left: auto; margin-right: auto;">La Fundación Juventud Progresista trabaja incansablemente para el desarrollo sostenible de nuestra comunidad.</p>
        <div>
            <a href="#donar" class="btn btn-light rounded-pill px-5 py-3 fw-bold me-3" style="color: #F2385A; text-decoration: none;">Donar Ahora</a>
            <a href="/voluntariado" class="btn btn-outline-light rounded-pill px-5 py-3 fw-bold" style="text-decoration: none;">Ser Voluntario</a>
        </div>
    </div>
</div>
```

### Sección B: Contador de Impacto
```html
<div class="alignfull has-fjp-background-background-color" style="padding: 60px 0;">
    [fjp_contador_impacto libras="56966" voluntarios="1341" provincias="22"]
</div>
```

### Sección C: Misión
```html
<div class="container" style="padding: 80px 0;">
    <div class="row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0">
            <img src="https://via.placeholder.com/800x600" alt="Nuestra Misión" class="img-fluid rounded-3 shadow">
        </div>
        <div class="col-md-6 ps-md-5">
            <h2 class="text-gradient mb-4">Nuestra Misión</h2>
            <p class="lead mb-4">Somos una organización sin fines de lucro dedicada a empoderar a la juventud y fomentar el desarrollo integral de las comunidades más vulnerables.</p>
            <a href="/quienes-somos" class="btn-fjp-primary">Leer más sobre nosotros</a>
        </div>
    </div>
</div>
```

### Sección D: Noticias Destacadas
```html
<div class="alignfull" style="padding: 60px 0; background: #fff;">
    [fjp_news_loop posts="3" title="Últimas Noticias"]
</div>
```

### Sección E: Testimonios y CTA
```html
[fjp_testimonials_loop posts="3" title="Testimonios"]

<div class="container my-5">
    <div class="fjp-volunteer-cta p-5 text-center text-white rounded-3" style="background: linear-gradient(135deg, #5BD9D9 0%, #56BF66 100%);">
        <h2 class="text-white mb-3">¿Listo para hacer la diferencia?</h2>
        <p class="lead mb-4">Únete a nuestro equipo de voluntarios y sé parte del cambio.</p>
        <a href="/voluntariado" class="btn btn-light rounded-pill px-5 py-3 fw-bold" style="color: #56BF66; text-decoration: none;">Inscríbete Hoy</a>
    </div>
</div>
```

---

## 3. Página de Voluntariado

### Sección A: Hero Voluntariado
```html
<div class="fjp-hero-section alignfull" style="background-image: url('https://via.placeholder.com/1920x600'); background-size: cover; background-position: center; position: relative; height: 500px; display: flex; align-items: center;">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(91, 217, 217, 0.9);"></div> <!-- Overlay Teal -->
    <div class="container" style="position: relative; z-index: 2; color: white; text-align: center;">
        <h1 style="font-size: 3rem; font-weight: 700; margin-bottom: 20px;">Únete al Voluntariado</h1>
        <p style="font-size: 1.3rem; margin-bottom: 30px;">Tu tiempo y talento pueden transformar vidas.</p>
        <a href="#formulario" class="btn btn-light rounded-pill px-4 py-3 fw-bold" style="color: #2A9D8F; text-decoration: none;">Inscribirme al Formulario</a>
    </div>
</div>
```

### Sección B: Beneficios
```html
<div class="container py-5">
    <h2 class="text-center mb-5">Beneficios de ser Voluntario</h2>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="fjp-card p-4 text-center h-100">
                <i class="fas fa-user-graduate fa-3x mb-3 text-primary"></i>
                <h4>Desarrollo Personal</h4>
                <p>Adquiere nuevas habilidades valiosas.</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="fjp-card p-4 text-center h-100">
                <i class="fas fa-hands-helping fa-3x mb-3 text-success"></i>
                <h4>Impacto Social</h4>
                <p>Contribuye al bienestar de tu comunidad.</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="fjp-card p-4 text-center h-100">
                <i class="fas fa-users fa-3x mb-3 text-info"></i>
                <h4>Networking</h4>
                <p>Conecta con personas apasionadas.</p>
            </div>
        </div>
    </div>
</div>
```

### Sección C: Testimonios de Voluntarios
```html
[fjp_volunteer_testimonials]
```

### Sección D: Formulario de Inscripción
```html
<div class="alignfull bg-light py-5">
    [fjp_volunteer_form]
</div>
```

---

## 4. Página Quiénes Somos

### Sección A: Historia y Valores
```html
<div class="container py-5">
    <h1 class="text-center mb-5 text-gradient">Nuestra Historia</h1>
    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <p>Fundada en 2010, la FJP nació del deseo de un grupo de jóvenes líderes...</p>
            <p>Desde entonces, hemos impactado a más de 10,000 vidas.</p>
        </div>
        <div class="col-md-6">
            <img src="https://via.placeholder.com/600x400" class="img-fluid rounded shadow" alt="Historia">
        </div>
    </div>
</div>

<div class="alignfull py-5" style="background-color: var(--fjp-primary); color: white;">
    <div class="container">
        <h2 class="text-center text-white mb-5">Nuestros Valores</h2>
        <div class="row text-center">
            <div class="col-md-4">
                <i class="fas fa-heart fa-3x mb-3"></i>
                <h4 class="text-white">Solidaridad</h4>
            </div>
            <div class="col-md-4">
                <i class="fas fa-balance-scale fa-3x mb-3"></i>
                <h4 class="text-white">Integridad</h4>
            </div>
            <div class="col-md-4">
                <i class="fas fa-fire fa-3x mb-3"></i>
                <h4 class="text-white">Pasión</h4>
            </div>
        </div>
    </div>
</div>
```

### Sección B: Alianzas
```html
[fjp_alliances_loop title="Nuestros Aliados"]
```

---

## 5. Página Donaciones

### Sección A: Opciones de Donación
```html
<div class="container py-5">
    <h1 class="text-center mb-4">Apoya nuestra causa</h1>
    <p class="text-center lead mb-5">Cada aporte cuenta para seguir construyendo oportunidades.</p>

    [fjp_donation_options]
</div>
```

---

## 6. Página Noticias

### Sección A: Listado Completo
```html
<div class="container py-5">
    <h1 class="text-center mb-5">Noticias y Actualidad</h1>

    <!-- Muestra 9 noticias paginadas -->
    [fjp_news_loop posts="9" title=""]
</div>
```

---

## Listado de Shortcodes Disponibles

Puede usar estos códigos cortos en cualquier parte del sitio:

*   `[fjp_volunteer_form]`: Muestra el formulario de inscripción completo.
*   `[fjp_news_loop posts="3"]`: Muestra una grilla de noticias (puede cambiar el número).
*   `[fjp_testimonials_loop]`: Muestra testimonios generales.
*   `[fjp_volunteer_testimonials]`: Muestra testimonios específicos de voluntarios.
*   `[fjp_alliances_loop]`: Muestra el carrusel/grilla de aliados.
*   `[fjp_contador_impacto]`: Muestra los números animados (Libras, Voluntarios, etc.).
*   `[fjp_donation_options]`: Muestra las tarjetas de opciones de donación.
