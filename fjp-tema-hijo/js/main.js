jQuery(document).ready(function($) {
    // Main JS functionality for FJP Theme
    console.log('FJP Theme Scripts Loaded');

    // Mobile menu toggle if needed (usually handled by Astra)

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
