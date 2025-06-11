/**
 * Main JavaScript File
 * ModernBiz Pro Theme
 */

(function($) {
    'use strict';

    // Main theme object
    const ModernBizTheme = {
        init: function() {
            this.bindEvents();
            this.initComponents();
            this.handleRTL();
        },

        bindEvents: function() {
            $(document).ready(this.onDocumentReady.bind(this));
            $(window).on('load', this.onWindowLoad.bind(this));
            $(window).on('resize', this.onWindowResize.bind(this));
        },

        onDocumentReady: function() {
            this.initBackToTop();
            this.initTooltips();
            this.initModals();
            this.initTabs();
            this.initAccordions();
            this.initCarousels();
            this.initLazyLoading();
        },

        onWindowLoad: function() {
            this.handlePreloader();
            this.initMasonry();
        },

        onWindowResize: function() {
            this.handleResponsiveElements();
        },

        initComponents: function() {
            // Initialize all theme components
            if (typeof window.ModernBizDarkMode !== 'undefined') {
                window.ModernBizDarkMode.init();
            }
            
            if (typeof window.ModernBizMobileMenu !== 'undefined') {
                window.ModernBizMobileMenu.init();
            }
            
            if (typeof window.ModernBizAnimations !== 'undefined') {
                window.ModernBizAnimations.init();
            }
        },

        initBackToTop: function() {
            const $backToTop = $('#back-to-top');
            
            if ($backToTop.length) {
                $(window).on('scroll', function() {
                    if ($(this).scrollTop() > 300) {
                        $backToTop.addClass('visible');
                    } else {
                        $backToTop.removeClass('visible');
                    }
                });

                $backToTop.on('click', function(e) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: 0
                    }, 800);
                });
            }
        },

        initTooltips: function() {
            $('[data-tooltip]').each(function() {
                const $element = $(this);
                const tooltipText = $element.data('tooltip');
                
                $element.on('mouseenter', function() {
                    const $tooltip = $('<div class="tooltip">' + tooltipText + '</div>');
                    $('body').append($tooltip);
                    
                    const elementOffset = $element.offset();
                    const elementWidth = $element.outerWidth();
                    const elementHeight = $element.outerHeight();
                    const tooltipWidth = $tooltip.outerWidth();
                    const tooltipHeight = $tooltip.outerHeight();
                    
                    $tooltip.css({
                        top: elementOffset.top - tooltipHeight - 10,
                        left: elementOffset.left + (elementWidth / 2) - (tooltipWidth / 2)
                    }).fadeIn(200);
                });
                
                $element.on('mouseleave', function() {
                    $('.tooltip').fadeOut(200, function() {
                        $(this).remove();
                    });
                });
            });
        },

        initModals: function() {
            // Modal functionality
            $(document).on('click', '[data-modal]', function(e) {
                e.preventDefault();
                const modalId = $(this).data('modal');
                const $modal = $('#' + modalId);
                
                if ($modal.length) {
                    $modal.addClass('active');
                    $('body').addClass('modal-open');
                }
            });

            $(document).on('click', '.modal-close, .modal-overlay', function(e) {
                e.preventDefault();
                $(this).closest('.modal').removeClass('active');
                $('body').removeClass('modal-open');
            });

            // Close modal with Escape key
            $(document).on('keydown', function(e) {
                if (e.keyCode === 27 && $('.modal.active').length) {
                    $('.modal.active').removeClass('active');
                    $('body').removeClass('modal-open');
                }
            });
        },

        initTabs: function() {
            $(document).on('click', '.tab-nav a', function(e) {
                e.preventDefault();
                
                const $tab = $(this);
                const $tabContainer = $tab.closest('.tabs');
                const targetId = $tab.attr('href');
                
                // Update active tab
                $tabContainer.find('.tab-nav a').removeClass('active');
                $tab.addClass('active');
                
                // Show target content
                $tabContainer.find('.tab-content').removeClass('active');
                $tabContainer.find(targetId).addClass('active');
            });
        },

        initAccordions: function() {
            $(document).on('click', '.accordion-header', function(e) {
                e.preventDefault();
                
                const $header = $(this);
                const $accordion = $header.closest('.accordion');
                const $content = $header.next('.accordion-content');
                const isActive = $header.hasClass('active');
                
                // Close all other accordions if single-open mode
                if ($accordion.hasClass('single-open')) {
                    $accordion.find('.accordion-header').removeClass('active');
                    $accordion.find('.accordion-content').slideUp(300);
                }
                
                if (!isActive) {
                    $header.addClass('active');
                    $content.slideDown(300);
                } else if (!$accordion.hasClass('single-open')) {
                    $header.removeClass('active');
                    $content.slideUp(300);
                }
            });
        },

        initCarousels: function() {
            $('.carousel').each(function() {
                const $carousel = $(this);
                const $items = $carousel.find('.carousel-item');
                const itemCount = $items.length;
                let currentIndex = 0;
                
                if (itemCount <= 1) return;
                
                // Add navigation
                $carousel.append(`
                    <div class="carousel-nav">
                        <button class="carousel-prev">‹</button>
                        <button class="carousel-next">›</button>
                    </div>
                `);
                
                // Add indicators
                let indicators = '<div class="carousel-indicators">';
                for (let i = 0; i < itemCount; i++) {
                    indicators += `<button class="indicator ${i === 0 ? 'active' : ''}" data-index="${i}"></button>`;
                }
                indicators += '</div>';
                $carousel.append(indicators);
                
                // Navigation functionality
                $carousel.on('click', '.carousel-prev', function() {
                    currentIndex = currentIndex > 0 ? currentIndex - 1 : itemCount - 1;
                    updateCarousel();
                });
                
                $carousel.on('click', '.carousel-next', function() {
                    currentIndex = currentIndex < itemCount - 1 ? currentIndex + 1 : 0;
                    updateCarousel();
                });
                
                $carousel.on('click', '.indicator', function() {
                    currentIndex = parseInt($(this).data('index'));
                    updateCarousel();
                });
                
                function updateCarousel() {
                    $items.removeClass('active').eq(currentIndex).addClass('active');
                    $carousel.find('.indicator').removeClass('active').eq(currentIndex).addClass('active');
                }
                
                // Auto-play if enabled
                if ($carousel.data('autoplay')) {
                    const interval = $carousel.data('interval') || 5000;
                    
                    setInterval(function() {
                        if (!$carousel.is(':hover')) {
                            currentIndex = currentIndex < itemCount - 1 ? currentIndex + 1 : 0;
                            updateCarousel();
                        }
                    }, interval);
                }
            });
        },

        initLazyLoading: function() {
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.src = img.dataset.src;
                            img.classList.remove('lazy');
                            img.classList.add('loaded');
                            observer.unobserve(img);
                        }
                    });
                });

                document.querySelectorAll('img[data-src]').forEach(img => {
                    imageObserver.observe(img);
                });
            }
        },

        initMasonry: function() {
            if (typeof Masonry !== 'undefined') {
                $('.masonry-grid').each(function() {
                    const $grid = $(this);
                    
                    $grid.masonry({
                        itemSelector: '.masonry-item',
                        columnWidth: '.masonry-sizer',
                        percentPosition: true
                    });
                });
            }
        },

        handlePreloader: function() {
            $('.preloader').fadeOut(500, function() {
                $(this).remove();
            });
        },

        handleResponsiveElements: function() {
            const windowWidth = $(window).width();
            
            // Handle responsive tables
            $('.table-responsive table').each(function() {
                const $table = $(this);
                const $wrapper = $table.parent();
                
                if (windowWidth < 768) {
                    $wrapper.addClass('scroll-horizontal');
                } else {
                    $wrapper.removeClass('scroll-horizontal');
                }
            });
        },

        handleRTL: function() {
            if ($('body').hasClass('rtl') || $('html').attr('dir') === 'rtl') {
                // RTL-specific adjustments
                $('.carousel-prev').text('›');
                $('.carousel-next').text('‹');
            }
        },

        // Utility functions
        utils: {
            debounce: function(func, wait, immediate) {
                let timeout;
                return function() {
                    const context = this;
                    const args = arguments;
                    const later = function() {
                        timeout = null;
                        if (!immediate) func.apply(context, args);
                    };
                    const callNow = immediate && !timeout;
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                    if (callNow) func.apply(context, args);
                };
            },

            throttle: function(func, limit) {
                let inThrottle;
                return function() {
                    const args = arguments;
                    const context = this;
                    if (!inThrottle) {
                        func.apply(context, args);
                        inThrottle = true;
                        setTimeout(() => inThrottle = false, limit);
                    }
                };
            },

            isElementInViewport: function(el) {
                const rect = el.getBoundingClientRect();
                return (
                    rect.top >= 0 &&
                    rect.left >= 0 &&
                    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
                );
            }
        }
    };

    // Initialize theme
    ModernBizTheme.init();

    // Export for external use
    window.ModernBizTheme = ModernBizTheme;

})(jQuery);

// Vanilla JS for critical functionality
document.addEventListener('DOMContentLoaded', function() {
    // Critical path CSS loading
    const criticalCSS = document.getElementById('critical-css');
    if (criticalCSS) {
        criticalCSS.onload = function() {
            this.media = 'all';
        };
    }

    // Service Worker registration (if available)
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/sw.js').catch(function(error) {
            console.log('ServiceWorker registration failed: ', error);
        });
    }
});

