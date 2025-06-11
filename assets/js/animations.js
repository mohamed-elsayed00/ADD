/**
 * Animation and Scroll Effects
 * ModernBiz Pro Theme
 */

(function($) {
    'use strict';

    const Animations = {
        init: function() {
            this.bindEvents();
            this.initScrollAnimations();
            this.initCounters();
            this.initParallax();
        },

        bindEvents: function() {
            $(window).on('scroll', this.handleScroll.bind(this));
            $(window).on('load', this.handleLoad.bind(this));
        },

        handleScroll: function() {
            this.checkScrollAnimations();
            this.updateParallax();
        },

        handleLoad: function() {
            this.checkScrollAnimations();
        },

        initScrollAnimations: function() {
            // Add intersection observer for better performance
            if ('IntersectionObserver' in window) {
                this.setupIntersectionObserver();
            } else {
                // Fallback for older browsers
                this.setupScrollFallback();
            }
        },

        setupIntersectionObserver: function() {
            const options = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const $element = $(entry.target);
                        const delay = $element.data('delay') || 0;
                        
                        setTimeout(() => {
                            $element.addClass('visible');
                        }, delay);
                        
                        observer.unobserve(entry.target);
                    }
                });
            }, options);

            $('.fade-in').each(function() {
                observer.observe(this);
            });
        },

        setupScrollFallback: function() {
            this.checkScrollAnimations();
        },

        checkScrollAnimations: function() {
            const windowTop = $(window).scrollTop();
            const windowBottom = windowTop + $(window).height();

            $('.fade-in:not(.visible)').each(function() {
                const $element = $(this);
                const elementTop = $element.offset().top;
                const elementBottom = elementTop + $element.outerHeight();

                if (elementBottom >= windowTop && elementTop <= windowBottom) {
                    const delay = $element.data('delay') || 0;
                    
                    setTimeout(() => {
                        $element.addClass('visible');
                    }, delay);
                }
            });
        },

        initCounters: function() {
            $('.counter').each(function() {
                const $counter = $(this);
                const target = parseInt($counter.text());
                
                $counter.text('0');
                
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            this.animateCounter($counter, target);
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.5 });

                observer.observe(this);
            });
        },

        animateCounter: function($counter, target) {
            const duration = 2000;
            const start = 0;
            const increment = target / (duration / 16);
            let current = start;

            const timer = setInterval(() => {
                current += increment;
                
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                
                $counter.text(Math.floor(current));
            }, 16);
        },

        initParallax: function() {
            $('.parallax-element').each(function() {
                const $element = $(this);
                const speed = $element.data('speed') || 0.5;
                
                $element.data('parallax-speed', speed);
            });
        },

        updateParallax: function() {
            const scrollTop = $(window).scrollTop();
            
            $('.parallax-element').each(function() {
                const $element = $(this);
                const speed = $element.data('parallax-speed');
                const yPos = -(scrollTop * speed);
                
                $element.css('transform', `translateY(${yPos}px)`);
            });
        }
    };

    // Smooth scrolling for anchor links
    const SmoothScroll = {
        init: function() {
            this.bindEvents();
        },

        bindEvents: function() {
            $(document).on('click', 'a[href^="#"]', this.handleClick.bind(this));
        },

        handleClick: function(e) {
            const href = $(e.currentTarget).attr('href');
            
            if (href === '#' || href === '#top') {
                e.preventDefault();
                this.scrollToTop();
                return;
            }

            const $target = $(href);
            
            if ($target.length) {
                e.preventDefault();
                this.scrollToElement($target);
            }
        },

        scrollToElement: function($target) {
            const headerHeight = $('.site-header').outerHeight() || 0;
            const targetOffset = $target.offset().top - headerHeight - 20;
            
            $('html, body').animate({
                scrollTop: targetOffset
            }, 800, 'easeInOutCubic');
        },

        scrollToTop: function() {
            $('html, body').animate({
                scrollTop: 0
            }, 800, 'easeInOutCubic');
        }
    };

    // Portfolio filter functionality
    const PortfolioFilter = {
        init: function() {
            this.bindEvents();
        },

        bindEvents: function() {
            $(document).on('click', '.filter-btn', this.handleFilter.bind(this));
        },

        handleFilter: function(e) {
            e.preventDefault();
            
            const $button = $(e.currentTarget);
            const filter = $button.data('filter');
            
            // Update active button
            $('.filter-btn').removeClass('active');
            $button.addClass('active');
            
            // Filter portfolio items
            this.filterItems(filter);
        },

        filterItems: function(filter) {
            const $items = $('.portfolio-item');
            
            if (filter === 'all') {
                $items.removeClass('hidden').addClass('visible');
            } else {
                $items.each(function() {
                    const $item = $(this);
                    const category = $item.data('category');
                    
                    if (category === filter) {
                        $item.removeClass('hidden').addClass('visible');
                    } else {
                        $item.removeClass('visible').addClass('hidden');
                    }
                });
            }
        }
    };

    // Loading animations
    const LoadingAnimations = {
        init: function() {
            this.showPageLoader();
            this.bindEvents();
        },

        bindEvents: function() {
            $(window).on('load', this.hidePageLoader.bind(this));
        },

        showPageLoader: function() {
            if ($('.page-loader').length === 0) {
                $('body').prepend(`
                    <div class="page-loader">
                        <div class="loader-content">
                            <div class="loader-spinner"></div>
                            <p>Loading...</p>
                        </div>
                    </div>
                `);
            }
        },

        hidePageLoader: function() {
            $('.page-loader').fadeOut(500, function() {
                $(this).remove();
            });
        }
    };

    // Scroll progress indicator
    const ScrollProgress = {
        init: function() {
            this.createProgressBar();
            this.bindEvents();
        },

        createProgressBar: function() {
            if ($('.scroll-progress').length === 0) {
                $('body').prepend('<div class="scroll-progress"><div class="progress-bar"></div></div>');
            }
        },

        bindEvents: function() {
            $(window).on('scroll', this.updateProgress.bind(this));
        },

        updateProgress: function() {
            const scrollTop = $(window).scrollTop();
            const docHeight = $(document).height() - $(window).height();
            const scrollPercent = (scrollTop / docHeight) * 100;
            
            $('.progress-bar').css('width', scrollPercent + '%');
        }
    };

    // Custom easing functions
    $.easing.easeInOutCubic = function(x, t, b, c, d) {
        if ((t /= d / 2) < 1) return c / 2 * t * t * t + b;
        return c / 2 * ((t -= 2) * t * t + 2) + b;
    };

    // Initialize when document is ready
    $(document).ready(function() {
        Animations.init();
        SmoothScroll.init();
        PortfolioFilter.init();
        LoadingAnimations.init();
        ScrollProgress.init();
    });

    // Export for external use
    window.ModernBizAnimations = Animations;

})(jQuery);

