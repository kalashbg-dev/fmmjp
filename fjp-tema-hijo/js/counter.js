jQuery(document).ready(function($) {
    // Animación de contadores
    var counters = $('.fjp-counter-number');

    if (counters.length) {
        var options = {
            root: null,
            rootMargin: '0px',
            threshold: 0.5
        };

        var observer = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    var target = $(entry.target);
                    var countTo = target.attr('data-target');

                    $({ countNum: target.text() }).animate({
                        countNum: countTo
                    },
                    {
                        duration: 2000,
                        easing: 'linear',
                        step: function() {
                            target.text(Math.floor(this.countNum));
                        },
                        complete: function() {
                            target.text(this.countNum);
                        }
                    });

                    observer.unobserve(entry.target);
                }
            });
        }, options);

        counters.each(function() {
            observer.observe(this);
        });
    }
});
