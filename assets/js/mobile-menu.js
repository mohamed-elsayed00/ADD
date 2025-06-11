/**
 * Mobile Menu Functionality
 * ModernBiz Pro Theme
 */

(function($) {
    'use strict';

    const MobileMenu = {
        init: function() {
            this.bindEvents();
            this.setupAccessibility();
        },

        bindEvents: function() {
            // Mobile menu toggle
            $(document).on('click', '.mobile-menu-toggle', this.toggleMobileMenu.bind(this));
            
            // Close menu when clicking overlay
            $(document).on('click', '.mobile-menu-overlay', this.closeMobileMenu.bind(this));
            
            // Close menu when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.site-header').length && $('.main-navigation').hasClass('active')) {
                    this.closeMobileMenu();
                }
            }.bind(this));

            // Handle window resize
            $(window).on('resize', this.handleResize.bind(this));

            // Handle submenu toggles
            $(document).on('click', '.menu-item-has-children > a', this.toggleSubmenu.bind(this));

            // Keyboard navigation
            $(document).on('keydown', this.handleKeyboardNavigation.bind(this));
        },

        toggleMobileMenu: function(e) {
            e.preventDefault();
            
            const $navigation = $('.main-navigation');
            const $toggle = $('.mobile-menu-toggle');
            const $overlay = $('.mobile-menu-overlay');
            const $body = $('body');
            
            if ($navigation.hasClass('active')) {
                this.closeMobileMenu();
            } else {
                this.openMobileMenu();
            }
        },

        openMobileMenu: function() {
            const $navigation = $('.main-navigation');
            const $toggle = $('.mobile-menu-toggle');
            const $overlay = $('.mobile-menu-overlay');
            const $body = $('body');
            
            $navigation.addClass('active');
            $toggle.addClass('active').attr('aria-expanded', 'true');
            $overlay.addClass('active');
            $body.addClass('mobile-menu-open');
            
            // Focus first menu item
            setTimeout(() => {
                $navigation.find('a:first').focus();
            }, 300);
            
            // Trigger custom event
            $(document).trigger('mobileMenuOpened');
        },

        closeMobileMenu: function() {
            const $navigation = $('.main-navigation');
            const $toggle = $('.mobile-menu-toggle');
            const $overlay = $('.mobile-menu-overlay');
            const $body = $('body');
            
            $navigation.removeClass('active');
            $toggle.removeClass('active').attr('aria-expanded', 'false');
            $overlay.removeClass('active');
            $body.removeClass('mobile-menu-open');
            
            // Close all submenus
            $('.submenu-open').removeClass('submenu-open');
            
            // Return focus to toggle button
            $toggle.focus();
            
            // Trigger custom event
            $(document).trigger('mobileMenuClosed');
        },

        toggleSubmenu: function(e) {
            if ($(window).width() <= 768) {
                e.preventDefault();
                
                const $menuItem = $(e.target).closest('.menu-item-has-children');
                const $submenu = $menuItem.find('.sub-menu:first');
                
                if ($menuItem.hasClass('submenu-open')) {
                    $menuItem.removeClass('submenu-open');
                    $submenu.slideUp(300);
                } else {
                    // Close other open submenus
                    $('.submenu-open').removeClass('submenu-open').find('.sub-menu').slideUp(300);
                    
                    $menuItem.addClass('submenu-open');
                    $submenu.slideDown(300);
                }
            }
        },

        handleResize: function() {
            if ($(window).width() > 768) {
                this.closeMobileMenu();
                
                // Reset submenu states
                $('.submenu-open').removeClass('submenu-open');
                $('.sub-menu').removeAttr('style');
            }
        },

        handleKeyboardNavigation: function(e) {
            if (!$('.main-navigation').hasClass('active')) return;
            
            const $focusedElement = $(document.activeElement);
            const $menuItems = $('.main-navigation a');
            const currentIndex = $menuItems.index($focusedElement);
            
            switch(e.keyCode) {
                case 27: // Escape key
                    e.preventDefault();
                    this.closeMobileMenu();
                    break;
                    
                case 38: // Up arrow
                    e.preventDefault();
                    if (currentIndex > 0) {
                        $menuItems.eq(currentIndex - 1).focus();
                    } else {
                        $menuItems.last().focus();
                    }
                    break;
                    
                case 40: // Down arrow
                    e.preventDefault();
                    if (currentIndex < $menuItems.length - 1) {
                        $menuItems.eq(currentIndex + 1).focus();
                    } else {
                        $menuItems.first().focus();
                    }
                    break;
                    
                case 13: // Enter key
                case 32: // Space key
                    if ($focusedElement.parent().hasClass('menu-item-has-children')) {
                        e.preventDefault();
                        this.toggleSubmenu(e);
                    }
                    break;
            }
        },

        setupAccessibility: function() {
            // Add ARIA attributes
            $('.mobile-menu-toggle').attr({
                'aria-controls': 'primary-menu',
                'aria-expanded': 'false',
                'aria-label': 'Toggle mobile menu'
            });
            
            // Add submenu indicators
            $('.menu-item-has-children > a').each(function() {
                $(this).append('<span class="submenu-indicator" aria-hidden="true">▼</span>');
            });
            
            // Add role attributes
            $('.main-navigation ul').attr('role', 'menubar');
            $('.main-navigation li').attr('role', 'menuitem');
            $('.sub-menu').attr('role', 'menu');
        }
    };

    // Search functionality
    const SearchToggle = {
        init: function() {
            this.bindEvents();
        },

        bindEvents: function() {
            $(document).on('click', '#search-toggle', this.toggleSearch.bind(this));
            $(document).on('click', '#search-close', this.closeSearch.bind(this));
            $(document).on('keydown', this.handleKeyboard.bind(this));
            
            // Close search when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.header-search, #search-toggle').length) {
                    this.closeSearch();
                }
            }.bind(this));
        },

        toggleSearch: function(e) {
            e.preventDefault();
            
            const $searchContainer = $('#header-search');
            
            if ($searchContainer.hasClass('active')) {
                this.closeSearch();
            } else {
                this.openSearch();
            }
        },

        openSearch: function() {
            const $searchContainer = $('#header-search');
            const $searchInput = $searchContainer.find('input[type="search"]');
            
            $searchContainer.addClass('active');
            $('body').addClass('search-open');
            
            // Focus search input
            setTimeout(() => {
                $searchInput.focus();
            }, 300);
        },

        closeSearch: function() {
            const $searchContainer = $('#header-search');
            
            $searchContainer.removeClass('active');
            $('body').removeClass('search-open');
        },

        handleKeyboard: function(e) {
            if (e.keyCode === 27 && $('#header-search').hasClass('active')) {
                this.closeSearch();
            }
        }
    };

    // Sticky header functionality
    const StickyHeader = {
        init: function() {
            this.bindEvents();
            this.checkScroll();
        },

        bindEvents: function() {
            $(window).on('scroll', this.handleScroll.bind(this));
        },

        handleScroll: function() {
            this.checkScroll();
        },

        checkScroll: function() {
            const scrollTop = $(window).scrollTop();
            const $header = $('.site-header');
            
            if (scrollTop > 100) {
                $header.addClass('scrolled');
            } else {
                $header.removeClass('scrolled');
            }
        }
    };

    // Initialize when document is ready
    $(document).ready(function() {
        MobileMenu.init();
        SearchToggle.init();
        StickyHeader.init();
    });

    // Export for external use
    window.ModernBizMobileMenu = MobileMenu;
    window.ModernBizSearchToggle = SearchToggle;

})(jQuery);

