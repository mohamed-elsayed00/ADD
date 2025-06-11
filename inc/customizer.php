<?php
/**
 * ModernBiz Pro Theme Customizer
 *
 * @package ModernBiz_Pro
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 */
function modernbiz_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial('blogname', array(
            'selector'        => '.site-title a',
            'render_callback' => 'modernbiz_customize_partial_blogname',
        ));
        $wp_customize->selective_refresh->add_partial('blogdescription', array(
            'selector'        => '.site-description',
            'render_callback' => 'modernbiz_customize_partial_blogdescription',
        ));
    }

    // Theme Options Panel
    $wp_customize->add_panel('modernbiz_theme_options', array(
        'title'       => esc_html__('Theme Options', 'modernbiz-pro'),
        'description' => esc_html__('Customize your theme settings', 'modernbiz-pro'),
        'priority'    => 30,
    ));

    // Homepage Layout Section
    $wp_customize->add_section('modernbiz_homepage_layout', array(
        'title'    => esc_html__('Homepage Layout', 'modernbiz-pro'),
        'panel'    => 'modernbiz_theme_options',
        'priority' => 10,
    ));

    $wp_customize->add_setting('homepage_layout', array(
        'default'           => 'layout-1',
        'sanitize_callback' => 'modernbiz_sanitize_select',
    ));

    $wp_customize->add_control('homepage_layout', array(
        'label'    => esc_html__('Select Homepage Layout', 'modernbiz-pro'),
        'section'  => 'modernbiz_homepage_layout',
        'type'     => 'select',
        'choices'  => array(
            'layout-1' => esc_html__('Corporate Business', 'modernbiz-pro'),
            'layout-2' => esc_html__('Creative Agency', 'modernbiz-pro'),
            'layout-3' => esc_html__('Tech Startup', 'modernbiz-pro'),
        ),
    ));

    // Dark Mode Section
    $wp_customize->add_section('modernbiz_dark_mode', array(
        'title'    => esc_html__('Dark Mode', 'modernbiz-pro'),
        'panel'    => 'modernbiz_theme_options',
        'priority' => 20,
    ));

    $wp_customize->add_setting('dark_mode_enabled', array(
        'default'           => false,
        'sanitize_callback' => 'modernbiz_sanitize_checkbox',
    ));

    $wp_customize->add_control('dark_mode_enabled', array(
        'label'   => esc_html__('Enable Dark Mode by Default', 'modernbiz-pro'),
        'section' => 'modernbiz_dark_mode',
        'type'    => 'checkbox',
    ));

    $wp_customize->add_setting('auto_dark_mode', array(
        'default'           => false,
        'sanitize_callback' => 'modernbiz_sanitize_checkbox',
    ));

    $wp_customize->add_control('auto_dark_mode', array(
        'label'       => esc_html__('Auto Dark Mode (6 PM - 6 AM)', 'modernbiz-pro'),
        'description' => esc_html__('Automatically enable dark mode during evening hours', 'modernbiz-pro'),
        'section'     => 'modernbiz_dark_mode',
        'type'        => 'checkbox',
    ));

    // Hero Section
    $wp_customize->add_section('modernbiz_hero_section', array(
        'title'    => esc_html__('Hero Section', 'modernbiz-pro'),
        'panel'    => 'modernbiz_theme_options',
        'priority' => 30,
    ));

    // Hero Title
    $wp_customize->add_setting('hero_title', array(
        'default'           => esc_html__('Welcome to Our Modern Business', 'modernbiz-pro'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('hero_title', array(
        'label'   => esc_html__('Hero Title', 'modernbiz-pro'),
        'section' => 'modernbiz_hero_section',
        'type'    => 'text',
    ));

    // Hero Subtitle
    $wp_customize->add_setting('hero_subtitle', array(
        'default'           => esc_html__('We provide innovative solutions for your business needs with cutting-edge technology and exceptional service.', 'modernbiz-pro'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('hero_subtitle', array(
        'label'   => esc_html__('Hero Subtitle', 'modernbiz-pro'),
        'section' => 'modernbiz_hero_section',
        'type'    => 'textarea',
    ));

    // Hero Button 1
    $wp_customize->add_setting('hero_button_1_text', array(
        'default'           => esc_html__('Our Services', 'modernbiz-pro'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('hero_button_1_text', array(
        'label'   => esc_html__('Button 1 Text', 'modernbiz-pro'),
        'section' => 'modernbiz_hero_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('hero_button_1_url', array(
        'default'           => '#services',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('hero_button_1_url', array(
        'label'   => esc_html__('Button 1 URL', 'modernbiz-pro'),
        'section' => 'modernbiz_hero_section',
        'type'    => 'url',
    ));

    // Hero Button 2
    $wp_customize->add_setting('hero_button_2_text', array(
        'default'           => esc_html__('Contact Us', 'modernbiz-pro'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('hero_button_2_text', array(
        'label'   => esc_html__('Button 2 Text', 'modernbiz-pro'),
        'section' => 'modernbiz_hero_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('hero_button_2_url', array(
        'default'           => '#contact',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('hero_button_2_url', array(
        'label'   => esc_html__('Button 2 URL', 'modernbiz-pro'),
        'section' => 'modernbiz_hero_section',
        'type'    => 'url',
    ));

    // Contact Information Section
    $wp_customize->add_section('modernbiz_contact_info', array(
        'title'    => esc_html__('Contact Information', 'modernbiz-pro'),
        'panel'    => 'modernbiz_theme_options',
        'priority' => 40,
    ));

    $wp_customize->add_setting('contact_address', array(
        'default'           => esc_html__('123 Business Street, City, State 12345', 'modernbiz-pro'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('contact_address', array(
        'label'   => esc_html__('Address', 'modernbiz-pro'),
        'section' => 'modernbiz_contact_info',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('contact_phone', array(
        'default'           => '+1 (555) 123-4567',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('contact_phone', array(
        'label'   => esc_html__('Phone Number', 'modernbiz-pro'),
        'section' => 'modernbiz_contact_info',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('contact_email', array(
        'default'           => 'info@example.com',
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('contact_email', array(
        'label'   => esc_html__('Email Address', 'modernbiz-pro'),
        'section' => 'modernbiz_contact_info',
        'type'    => 'email',
    ));

    // Social Media Section
    $wp_customize->add_section('modernbiz_social_media', array(
        'title'    => esc_html__('Social Media', 'modernbiz-pro'),
        'panel'    => 'modernbiz_theme_options',
        'priority' => 50,
    ));

    $social_networks = array(
        'facebook'  => 'Facebook',
        'twitter'   => 'Twitter',
        'linkedin'  => 'LinkedIn',
        'instagram' => 'Instagram',
        'youtube'   => 'YouTube',
    );

    foreach ($social_networks as $network => $label) {
        $wp_customize->add_setting($network . '_url', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control($network . '_url', array(
            'label'   => sprintf(esc_html__('%s URL', 'modernbiz-pro'), $label),
            'section' => 'modernbiz_social_media',
            'type'    => 'url',
        ));
    }

    // Typography Section
    $wp_customize->add_section('modernbiz_typography', array(
        'title'    => esc_html__('Typography', 'modernbiz-pro'),
        'panel'    => 'modernbiz_theme_options',
        'priority' => 60,
    ));

    $wp_customize->add_setting('primary_font', array(
        'default'           => 'Inter',
        'sanitize_callback' => 'modernbiz_sanitize_select',
    ));

    $wp_customize->add_control('primary_font', array(
        'label'   => esc_html__('Primary Font', 'modernbiz-pro'),
        'section' => 'modernbiz_typography',
        'type'    => 'select',
        'choices' => array(
            'Inter'     => 'Inter',
            'Roboto'    => 'Roboto',
            'Open Sans' => 'Open Sans',
            'Lato'      => 'Lato',
            'Poppins'   => 'Poppins',
        ),
    ));

    $wp_customize->add_setting('heading_font', array(
        'default'           => 'Poppins',
        'sanitize_callback' => 'modernbiz_sanitize_select',
    ));

    $wp_customize->add_control('heading_font', array(
        'label'   => esc_html__('Heading Font', 'modernbiz-pro'),
        'section' => 'modernbiz_typography',
        'type'    => 'select',
        'choices' => array(
            'Poppins'   => 'Poppins',
            'Montserrat' => 'Montserrat',
            'Playfair Display' => 'Playfair Display',
            'Merriweather' => 'Merriweather',
            'Inter'     => 'Inter',
        ),
    ));

    // Colors Section (extend default)
    $wp_customize->add_setting('primary_color', array(
        'default'           => '#2563eb',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label'   => esc_html__('Primary Color', 'modernbiz-pro'),
        'section' => 'colors',
    )));

    $wp_customize->add_setting('accent_color', array(
        'default'           => '#f59e0b',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'accent_color', array(
        'label'   => esc_html__('Accent Color', 'modernbiz-pro'),
        'section' => 'colors',
    )));
}
add_action('customize_register', 'modernbiz_customize_register');

/**
 * Render the site title for the selective refresh partial.
 */
function modernbiz_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 */
function modernbiz_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function modernbiz_customize_preview_js() {
    wp_enqueue_script('modernbiz-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), MODERNBIZ_VERSION, true);
}
add_action('customize_preview_init', 'modernbiz_customize_preview_js');

/**
 * Sanitization functions
 */
function modernbiz_sanitize_checkbox($checked) {
    return ((isset($checked) && true == $checked) ? true : false);
}

function modernbiz_sanitize_select($input, $setting) {
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control($setting->id)->choices;
    return (array_key_exists($input, $choices) ? $input : $setting->default);
}

/**
 * Output custom CSS based on customizer settings
 */
function modernbiz_customizer_css() {
    $primary_color = get_theme_mod('primary_color', '#2563eb');
    $accent_color = get_theme_mod('accent_color', '#f59e0b');
    $primary_font = get_theme_mod('primary_font', 'Inter');
    $heading_font = get_theme_mod('heading_font', 'Poppins');

    $css = "
        :root {
            --primary-color: {$primary_color};
            --accent-color: {$accent_color};
            --font-primary: '{$primary_font}', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            --font-secondary: '{$heading_font}', sans-serif;
        }
    ";

    wp_add_inline_style('modernbiz-style', $css);
}
add_action('wp_enqueue_scripts', 'modernbiz_customizer_css');

