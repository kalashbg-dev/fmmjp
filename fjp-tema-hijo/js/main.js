/**
 * FJP Theme Main Scripts
 * Handles header effects, counters, and general UI interactions.
 */
jQuery(document).ready(function($) {
    'use strict';

    // ==========================================
    // 1. Header Logic (Sticky / Transparent)
    // ==========================================
    const header = document.querySelector('.site-header') || document.querySelector('.fjp-header');
    const body = document.body;

    if (header) {
        const isTransparent = body.classList.contains('fjp-transparent-header');
        const isSticky = body.classList.contains('fjp-sticky-header');

        if (isTransparent || isSticky) {
            const handleScroll = () => {
                if (window.scrollY > 50) {
                    header.classList.add('fjp-is-scrolled');
                } else {
                    header.classList.remove('fjp-is-scrolled');
                }
            };
            window.addEventListener('scroll', handleScroll);
            handleScroll(); // Init on load
        }
    }

    // ==========================================
    // 2. Smooth Scroll for Anchors
    // ==========================================
    $('a[href^="#"]:not([href="#"])').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if (target.length) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 80
            }, 800);
        }
    });

    // ==========================================
    // 3. Impact Counters (Intersection Observer)
    // ==========================================
    var counters = $('.fjp-counter-number');

    if (counters.length) {
        var observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.2
        };

        var counterObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    var $target = $(entry.target);
                    var rawValue = $target.attr('data-target');
                    var countTo = parseInt(rawValue.replace(/,/g, ''), 10);

                    // Skip if invalid
                    if (isNaN(countTo)) return;

                    $({ countNum: 0 }).animate({
                        countNum: countTo
                    }, {
                        duration: 2000,
                        easing: 'swing',
                        step: function() {
                            $target.text(Math.floor(this.countNum).toLocaleString());
                        },
                        complete: function() {
                            $target.text(countTo.toLocaleString());
                        }
                    });

                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        counters.each(function() {
            counterObserver.observe(this);
        });
    }

    // ==========================================
    // 4. Testimonials Slider (Snap fallback)
    // ==========================================
    // (Optional: If we needed JS enhancement for the CSS snap slider, it would go here.
    // Currently, CSS scroll-snap handles it natively.)

});
