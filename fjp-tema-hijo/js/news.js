jQuery(document).ready(function($) {
    // News grid enhancements

    // Animación suave al hacer clic en enlaces internos
    $('a[href^="#"]').on('click', function (e) {
        var target = $(this.getAttribute('href'));
        if (target.length) {
            e.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top
            }, 1000);
        }
    });

    // Compartir en redes sociales con animación
    $('.red-social').on('click', function(e) {
        e.preventDefault();
        const url = this.href;
        const width = 600;
        const height = 400;
        const left = (screen.width - width) / 2;
        const top = (screen.height - height) / 2;

        window.open(url, 'compartir', `width=${width},height=${height},left=${left},top=${top}`);

        // Animación de éxito
        $(this).css('transform', 'scale(1.1)');
        setTimeout(() => {
            $(this).css('transform', 'scale(1)');
        }, 200);
    });

    // Lazy loading para imágenes (Native IntersectionObserver)
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.classList.add('loaded');
                        observer.unobserve(img);
                    }
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }

    // Navegación responsive
    function responsiveNav() {
        const navLinks = $('.nav-links');
        if (window.innerWidth <= 768) {
            navLinks.css('flex-direction', 'column');
        } else {
            navLinks.css('flex-direction', 'row');
        }
    }

    responsiveNav();
    $(window).resize(responsiveNav);
});
