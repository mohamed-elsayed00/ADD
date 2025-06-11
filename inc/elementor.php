<?php
/**
 * Elementor Compatibility File
 *
 * @package ModernBiz_Pro
 */

/**
 * Check if Elementor is active
 */
if (!defined('ELEMENTOR_VERSION')) {
    return;
}

/**
 * Elementor theme support
 */
function modernbiz_elementor_support() {
    // Add theme support for Elementor
    add_theme_support('elementor');
    
    // Add support for custom header and footer
    add_theme_support('elementor-header-footer');
    
    // Add support for custom colors and fonts
    add_theme_support('elementor-color-scheme');
    add_theme_support('elementor-typography-scheme');
}
add_action('after_setup_theme', 'modernbiz_elementor_support');

/**
 * Register Elementor locations
 */
function modernbiz_elementor_register_locations($elementor_theme_manager) {
    $elementor_theme_manager->register_location('header');
    $elementor_theme_manager->register_location('footer');
    $elementor_theme_manager->register_location('single');
    $elementor_theme_manager->register_location('archive');
}
add_action('elementor/theme/register_locations', 'modernbiz_elementor_register_locations');

/**
 * Add custom Elementor widgets
 */
function modernbiz_elementor_widgets() {
    // Include widget files
    require_once get_template_directory() . '/inc/elementor-widgets/hero-section.php';
    require_once get_template_directory() . '/inc/elementor-widgets/features-grid.php';
    require_once get_template_directory() . '/inc/elementor-widgets/testimonials.php';
    require_once get_template_directory() . '/inc/elementor-widgets/team-members.php';
    require_once get_template_directory() . '/inc/elementor-widgets/pricing-table.php';
    
    // Register widgets
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \ModernBiz_Hero_Section_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \ModernBiz_Features_Grid_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \ModernBiz_Testimonials_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \ModernBiz_Team_Members_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \ModernBiz_Pricing_Table_Widget());
}
add_action('elementor/widgets/widgets_registered', 'modernbiz_elementor_widgets');

/**
 * Add custom Elementor categories
 */
function modernbiz_elementor_categories($elements_manager) {
    $elements_manager->add_category(
        'modernbiz-elements',
        [
            'title' => esc_html__('ModernBiz Elements', 'modernbiz-pro'),
            'icon' => 'fa fa-plug',
        ]
    );
}
add_action('elementor/elements/categories_registered', 'modernbiz_elementor_categories');

/**
 * Enqueue Elementor frontend styles
 */
function modernbiz_elementor_frontend_styles() {
    wp_enqueue_style(
        'modernbiz-elementor',
        get_template_directory_uri() . '/assets/css/elementor.css',
        [],
        MODERNBIZ_VERSION
    );
}
add_action('elementor/frontend/after_enqueue_styles', 'modernbiz_elementor_frontend_styles');

/**
 * Enqueue Elementor editor styles
 */
function modernbiz_elementor_editor_styles() {
    wp_enqueue_style(
        'modernbiz-elementor-editor',
        get_template_directory_uri() . '/assets/css/elementor-editor.css',
        [],
        MODERNBIZ_VERSION
    );
}
add_action('elementor/editor/after_enqueue_styles', 'modernbiz_elementor_editor_styles');

/**
 * Add custom CSS to Elementor
 */
function modernbiz_elementor_add_custom_css() {
    $custom_css = '
        .elementor-section {
            background-color: var(--bg-primary);
            color: var(--text-primary);
        }
        
        .elementor-widget-container {
            color: var(--text-primary);
        }
        
        .elementor-heading-title {
            color: var(--text-primary);
        }
        
        .elementor-text-editor {
            color: var(--text-secondary);
        }
        
        .elementor-button {
            background-color: var(--primary-color);
            color: white;
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        
        .elementor-button:hover {
            background-color: var(--accent-color);
            transform: translateY(-2px);
        }
        
        /* Dark mode compatibility */
        [data-theme="dark"] .elementor-section,
        .dark-mode .elementor-section {
            background-color: var(--dark-bg-primary);
        }
        
        [data-theme="dark"] .elementor-widget-container,
        .dark-mode .elementor-widget-container {
            color: var(--dark-text-primary);
        }
        
        [data-theme="dark"] .elementor-heading-title,
        .dark-mode .elementor-heading-title {
            color: var(--dark-text-primary);
        }
        
        [data-theme="dark"] .elementor-text-editor,
        .dark-mode .elementor-text-editor {
            color: var(--dark-text-secondary);
        }
    ';
    
    wp_add_inline_style('modernbiz-elementor', $custom_css);
}
add_action('elementor/frontend/after_enqueue_styles', 'modernbiz_elementor_add_custom_css');

/**
 * Override Elementor page template
 */
function modernbiz_elementor_page_template($template) {
    if (is_page() && \Elementor\Plugin::$instance->documents->get(get_the_ID())->is_built_with_elementor()) {
        $elementor_template = locate_template('page-elementor.php');
        if ($elementor_template) {
            return $elementor_template;
        }
    }
    return $template;
}
add_filter('template_include', 'modernbiz_elementor_page_template', 11);

/**
 * Add Elementor theme colors
 */
function modernbiz_elementor_theme_colors() {
    return [
        [
            '_id' => 'primary',
            'title' => esc_html__('Primary', 'modernbiz-pro'),
            'color' => get_theme_mod('primary_color', '#2563eb'),
        ],
        [
            '_id' => 'secondary',
            'title' => esc_html__('Secondary', 'modernbiz-pro'),
            'color' => '#64748b',
        ],
        [
            '_id' => 'accent',
            'title' => esc_html__('Accent', 'modernbiz-pro'),
            'color' => get_theme_mod('accent_color', '#f59e0b'),
        ],
        [
            '_id' => 'text',
            'title' => esc_html__('Text', 'modernbiz-pro'),
            'color' => '#1e293b',
        ],
    ];
}
add_filter('elementor/editor/localize_settings', function($settings) {
    $settings['schemes']['color']['items'] = modernbiz_elementor_theme_colors();
    return $settings;
});

/**
 * Add Elementor theme fonts
 */
function modernbiz_elementor_theme_fonts() {
    return [
        [
            '_id' => 'primary',
            'font_family' => get_theme_mod('primary_font', 'Inter'),
            'font_weight' => '400',
        ],
        [
            '_id' => 'secondary',
            'font_family' => get_theme_mod('heading_font', 'Poppins'),
            'font_weight' => '600',
        ],
        [
            '_id' => 'text',
            'font_family' => get_theme_mod('primary_font', 'Inter'),
            'font_weight' => '400',
        ],
        [
            '_id' => 'accent',
            'font_family' => get_theme_mod('heading_font', 'Poppins'),
            'font_weight' => '500',
        ],
    ];
}

/**
 * Disable Elementor default colors and fonts
 */
function modernbiz_elementor_disable_default_schemes() {
    remove_action('elementor/editor/before_enqueue_scripts', [\Elementor\Plugin::$instance->schemes_manager->get_scheme('color'), 'print_template_view']);
    remove_action('elementor/editor/before_enqueue_scripts', [\Elementor\Plugin::$instance->schemes_manager->get_scheme('typography'), 'print_template_view']);
}
add_action('init', 'modernbiz_elementor_disable_default_schemes');

/**
 * Add custom Elementor controls
 */
function modernbiz_elementor_controls() {
    $controls_manager = \Elementor\Plugin::$instance->controls_manager;
    
    // Add custom control for theme colors
    $controls_manager->register_control('modernbiz_color', new \ModernBiz_Color_Control());
}
add_action('elementor/controls/controls_registered', 'modernbiz_elementor_controls');

/**
 * Elementor Pro compatibility
 */
if (defined('ELEMENTOR_PRO_VERSION')) {
    /**
     * Add theme builder support
     */
    function modernbiz_elementor_pro_support() {
        add_theme_support('elementor-pro');
    }
    add_action('after_setup_theme', 'modernbiz_elementor_pro_support');
    
    /**
     * Register custom post types for Elementor Pro
     */
    function modernbiz_elementor_pro_cpt() {
        $cpt_support = get_option('elementor_cpt_support', ['page', 'post']);
        
        if (!in_array('portfolio', $cpt_support)) {
            $cpt_support[] = 'portfolio';
            update_option('elementor_cpt_support', $cpt_support);
        }
        
        if (!in_array('team', $cpt_support)) {
            $cpt_support[] = 'team';
            update_option('elementor_cpt_support', $cpt_support);
        }
    }
    add_action('init', 'modernbiz_elementor_pro_cpt');
}

/**
 * Add Elementor custom breakpoints
 */
function modernbiz_elementor_breakpoints($breakpoints) {
    $breakpoints['mobile'] = 768;
    $breakpoints['tablet'] = 1024;
    $breakpoints['desktop'] = 1200;
    
    return $breakpoints;
}
add_filter('elementor/breakpoints/get_breakpoints', 'modernbiz_elementor_breakpoints');

/**
 * Elementor maintenance mode compatibility
 */
function modernbiz_elementor_maintenance_mode() {
    if (\Elementor\Plugin::$instance->maintenance_mode->is_maintenance_mode()) {
        wp_enqueue_style('modernbiz-style');
        wp_enqueue_style('modernbiz-dark-mode');
    }
}
add_action('elementor/maintenance_mode/after_enqueue_styles', 'modernbiz_elementor_maintenance_mode');

/**
 * Add Elementor global settings
 */
function modernbiz_elementor_global_settings() {
    $kit = \Elementor\Plugin::$instance->kits_manager->get_active_kit();
    
    if ($kit) {
        $kit->update_settings([
            'container_width' => [
                'size' => 1200,
                'unit' => 'px',
            ],
            'space_between_widgets' => [
                'size' => 20,
                'unit' => 'px',
            ],
            'page_title_selector' => 'h1.entry-title',
        ]);
    }
}
add_action('elementor/kit/register_tabs', 'modernbiz_elementor_global_settings');

/**
 * Custom Elementor icons
 */
function modernbiz_elementor_icons($additional_tabs) {
    $additional_tabs['modernbiz-icons'] = [
        'name' => 'modernbiz-icons',
        'label' => esc_html__('ModernBiz Icons', 'modernbiz-pro'),
        'url' => get_template_directory_uri() . '/assets/fonts/modernbiz-icons.css',
        'enqueue' => [get_template_directory_uri() . '/assets/fonts/modernbiz-icons.css'],
        'prefix' => 'mb-',
        'displayPrefix' => 'modernbiz',
        'labelIcon' => 'mb-logo',
        'ver' => MODERNBIZ_VERSION,
        'fetchJson' => get_template_directory_uri() . '/assets/fonts/modernbiz-icons.json',
        'native' => false,
    ];
    
    return $additional_tabs;
}
add_filter('elementor/icons_manager/additional_tabs', 'modernbiz_elementor_icons');

