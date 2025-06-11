/**
 * Dark Mode Toggle Functionality
 * ModernBiz Pro Theme
 */

(function($) {
    'use strict';

    // Dark mode functionality
    const DarkMode = {
        init: function() {
            this.bindEvents();
            this.loadSavedTheme();
        },

        bindEvents: function() {
            $(document).on('click', '#dark-mode-toggle', this.toggleDarkMode.bind(this));
        },

        toggleDarkMode: function(e) {
            e.preventDefault();
            
            const body = $('body');
            const isDarkMode = body.hasClass('dark-mode');
            
            if (isDarkMode) {
                this.enableLightMode();
            } else {
                this.enableDarkMode();
            }
        },

        enableDarkMode: function() {
            $('body').addClass('dark-mode');
            $('html').attr('data-theme', 'dark');
            localStorage.setItem('modernbiz-theme', 'dark');
            
            // Update toggle button
            $('#dark-mode-toggle .light-icon').hide();
            $('#dark-mode-toggle .dark-icon').show();
            
            // Trigger custom event
            $(document).trigger('darkModeEnabled');
        },

        enableLightMode: function() {
            $('body').removeClass('dark-mode');
            $('html').attr('data-theme', 'light');
            localStorage.setItem('modernbiz-theme', 'light');
            
            // Update toggle button
            $('#dark-mode-toggle .light-icon').show();
            $('#dark-mode-toggle .dark-icon').hide();
            
            // Trigger custom event
            $(document).trigger('lightModeEnabled');
        },

        loadSavedTheme: function() {
            const savedTheme = localStorage.getItem('modernbiz-theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            
            if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
                this.enableDarkMode();
            } else {
                this.enableLightMode();
            }
        },

        // System theme change detection
        watchSystemTheme: function() {
            const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
            
            mediaQuery.addListener((e) => {
                const savedTheme = localStorage.getItem('modernbiz-theme');
                
                // Only auto-switch if user hasn't manually set a preference
                if (!savedTheme) {
                    if (e.matches) {
                        this.enableDarkMode();
                    } else {
                        this.enableLightMode();
                    }
                }
            });
        }
    };

    // Auto-dark mode based on time
    const AutoDarkMode = {
        init: function() {
            if (this.shouldEnableAutoDarkMode()) {
                this.bindTimeBasedToggle();
            }
        },

        shouldEnableAutoDarkMode: function() {
            // Check if auto dark mode is enabled in customizer
            return window.modernbiz_settings && window.modernbiz_settings.auto_dark_mode;
        },

        bindTimeBasedToggle: function() {
            const now = new Date();
            const hour = now.getHours();
            
            // Enable dark mode between 6 PM and 6 AM
            if (hour >= 18 || hour < 6) {
                DarkMode.enableDarkMode();
            } else {
                DarkMode.enableLightMode();
            }
        }
    };

    // Smooth transitions for theme switching
    const ThemeTransitions = {
        init: function() {
            this.addTransitionClass();
            this.bindEvents();
        },

        addTransitionClass: function() {
            $('body').addClass('theme-transition');
        },

        bindEvents: function() {
            $(document).on('darkModeEnabled lightModeEnabled', this.handleThemeChange.bind(this));
        },

        handleThemeChange: function() {
            // Add a brief transition class
            $('body').addClass('theme-changing');
            
            setTimeout(() => {
                $('body').removeClass('theme-changing');
            }, 300);
        }
    };

    // Initialize when document is ready
    $(document).ready(function() {
        DarkMode.init();
        DarkMode.watchSystemTheme();
        AutoDarkMode.init();
        ThemeTransitions.init();
    });

    // Export for external use
    window.ModernBizDarkMode = DarkMode;

})(jQuery);

