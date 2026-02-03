jQuery(document).ready(function($) {
    // Animación de contadores
    var counters = $('.fjp-counter-number');

    if (counters.length) {
        var options = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1 // Trigger sooner
        };

        var observer = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    var target = $(entry.target);
                    // Ensure we parse the target number correctly, removing commas if present
                    var rawTarget = target.attr('data-target');
                    var countTo = parseInt(rawTarget.replace(/,/g, ''), 10);

                    // Stop any running animation
                    target.stop(true, true);

                    $({ countNum: 0 }).animate({
                        countNum: countTo
                    },
                    {
                        duration: 2000,
                        easing: 'swing', // 'swing' is smoother than 'linear'
                        step: function() {
                            target.text(Math.floor(this.countNum));
                        },
                        complete: function() {
                            target.text(countTo); // Set final value explicitly
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
