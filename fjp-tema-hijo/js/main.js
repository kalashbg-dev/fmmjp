jQuery(document).ready(function($) {
    // Main JS functionality for FJP Theme
    console.log('FJP Theme Scripts Loaded');

    // Header scroll effect (Advanced Pro Logic)
    // Supports both FJP custom header and standard Astra header
    const header = document.querySelector('.site-header') || document.querySelector('.fjp-header');
    const body = document.body;

    if (header) {
        // Check if Transparent or Sticky is enabled via Body classes
        const isTransparent = body.classList.contains('fjp-transparent-header');
        const isSticky = body.classList.contains('fjp-sticky-header');

        if (isTransparent || isSticky) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 100) {
                    header.classList.add('fjp-is-scrolled');
                } else {
                    header.classList.remove('fjp-is-scrolled');
                }
            });
        }
    }

    // Smooth scroll for anchors
    $('a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if( target.length ) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 100
            }, 1000);
        }
    });
});
