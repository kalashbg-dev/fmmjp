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
    // 3. Impact Counters (Vanilla JS + IO)
    // ==========================================
    var counters = document.querySelectorAll('.fjp-counter-number');

    if (counters.length > 0) {
        // Fallback for browsers without IntersectionObserver
        if (!('IntersectionObserver' in window)) {
            counters.forEach(function(c) {
                c.innerHTML = c.getAttribute('data-target');
            });
            return;
        }

        var observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0 // Trigger as soon as 1 pixel is visible
        };

        var counterObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    var target = entry.target;
                    var rawValue = target.getAttribute('data-target');
                    if (!rawValue) return;

                    var countTo = parseInt(rawValue.replace(/,/g, ''), 10);
                    if (isNaN(countTo)) return;

                    var duration = 2000; // 2 seconds
                    var frameDuration = 1000 / 60; // 60fps
                    var totalFrames = Math.round(duration / frameDuration);
                    var easeOutQuad = function(t) { return t * (2 - t); };
                    var frame = 0;

                    var counter = setInterval(function() {
                        frame++;
                        var progress = easeOutQuad(frame / totalFrames);
                        var currentCount = Math.round(countTo * progress);

                        if (parseInt(target.innerHTML) !== currentCount) {
                            target.innerHTML = currentCount.toLocaleString();
                        }

                        if (frame === totalFrames) {
                            clearInterval(counter);
                            target.innerHTML = countTo.toLocaleString();
                        }
                    }, frameDuration);

                    observer.unobserve(target);
                }
            });
        }, observerOptions);

        counters.forEach(function(counter) {
            counterObserver.observe(counter);
        });
    }

    // ==========================================
    // 4. Testimonials Slider (Snap fallback)
    // ==========================================
    // (Optional: If we needed JS enhancement for the CSS snap slider, it would go here.
    // Currently, CSS scroll-snap handles it natively.)

});
