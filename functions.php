<?php
/**
 * ModernBiz Pro functions and definitions
 *
 * @package ModernBiz_Pro
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('MODERNBIZ_VERSION', '1.0.0');
define('MODERNBIZ_THEME_DIR', get_template_directory());
define('MODERNBIZ_THEME_URI', get_template_directory_uri());

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function modernbiz_setup() {
    // Make theme available for translation
    load_theme_textdomain('modernbiz-pro', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for core custom logo
    add_theme_support('custom-logo', array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ));

    // Add theme support for custom background
    add_theme_support('custom-background', array(
        'default-color' => 'ffffff',
    ));

    // Add support for HTML5 markup
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add support for custom header
    add_theme_support('custom-header', array(
        'default-image'      => '',
        'default-text-color' => '000',
        'width'              => 1200,
        'height'             => 400,
        'flex-height'        => true,
        'wp-head-callback'   => 'modernbiz_header_style',
    ));

    // Add support for editor styles
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');

    // Add support for responsive embedded content
    add_theme_support('responsive-embeds');

    // Add support for WooCommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'modernbiz-pro'),
        'footer'  => esc_html__('Footer Menu', 'modernbiz-pro'),
    ));

    // Add image sizes
    add_image_size('modernbiz-featured', 800, 450, true);
    add_image_size('modernbiz-thumbnail', 400, 300, true);
}
add_action('after_setup_theme', 'modernbiz_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function modernbiz_content_width() {
    $GLOBALS['content_width'] = apply_filters('modernbiz_content_width', 1200);
}
add_action('after_setup_theme', 'modernbiz_content_width', 0);

/**
 * Register widget area.
 */
function modernbiz_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'modernbiz-pro'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'modernbiz-pro'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer 1', 'modernbiz-pro'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here.', 'modernbiz-pro'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer 2', 'modernbiz-pro'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Add widgets here.', 'modernbiz-pro'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer 3', 'modernbiz-pro'),
        'id'            => 'footer-3',
        'description'   => esc_html__('Add widgets here.', 'modernbiz-pro'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer 4', 'modernbiz-pro'),
        'id'            => 'footer-4',
        'description'   => esc_html__('Add widgets here.', 'modernbiz-pro'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'modernbiz_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function modernbiz_scripts() {
    // Enqueue Google Fonts
    wp_enqueue_style('modernbiz-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap', array(), null);

    // Enqueue main stylesheet
    wp_enqueue_style('modernbiz-style', get_stylesheet_uri(), array(), MODERNBIZ_VERSION);

    // Enqueue RTL stylesheet if needed
    wp_style_add_data('modernbiz-style', 'rtl', 'replace');

    // Enqueue dark mode styles
    wp_enqueue_style('modernbiz-dark-mode', get_template_directory_uri() . '/assets/css/dark-mode.css', array('modernbiz-style'), MODERNBIZ_VERSION);

    // Enqueue main JavaScript
    wp_enqueue_script('modernbiz-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), MODERNBIZ_VERSION, true);

    // Enqueue dark mode toggle script
    wp_enqueue_script('modernbiz-dark-mode', get_template_directory_uri() . '/assets/js/dark-mode.js', array('jquery'), MODERNBIZ_VERSION, true);

    // Enqueue mobile menu script
    wp_enqueue_script('modernbiz-mobile-menu', get_template_directory_uri() . '/assets/js/mobile-menu.js', array('jquery'), MODERNBIZ_VERSION, true);

    // Enqueue animation script
    wp_enqueue_script('modernbiz-animations', get_template_directory_uri() . '/assets/js/animations.js', array('jquery'), MODERNBIZ_VERSION, true);

    // Enqueue comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    // Localize script for AJAX
    wp_localize_script('modernbiz-script', 'modernbiz_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('modernbiz_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'modernbiz_scripts');

/**
 * Enqueue admin styles and scripts.
 */
function modernbiz_admin_scripts() {
    wp_enqueue_style('modernbiz-admin', get_template_directory_uri() . '/assets/css/admin.css', array(), MODERNBIZ_VERSION);
    wp_enqueue_script('modernbiz-admin', get_template_directory_uri() . '/assets/js/admin.js', array('jquery'), MODERNBIZ_VERSION, true);
}
add_action('admin_enqueue_scripts', 'modernbiz_admin_scripts');

/**
 * Custom header callback.
 */
function modernbiz_header_style() {
    $header_text_color = get_header_textcolor();

    if (get_theme_support('custom-header', 'default-text-color') === $header_text_color) {
        return;
    }

    ?>
    <style type="text/css">
    <?php if (!display_header_text()) : ?>
        .site-title,
        .site-description {
            position: absolute;
            clip: rect(1px, 1px, 1px, 1px);
        }
    <?php else : ?>
        .site-title a,
        .site-description {
            color: #<?php echo esc_attr($header_text_color); ?>;
        }
    <?php endif; ?>
    </style>
    <?php
}

/**
 * Add custom classes to the body.
 */
function modernbiz_body_classes($classes) {
    // Adds a class of hfeed to non-singular pages
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Add class for dark mode
    if (get_theme_mod('dark_mode_enabled', false)) {
        $classes[] = 'dark-mode-enabled';
    }

    // Add class for RTL support
    if (is_rtl()) {
        $classes[] = 'rtl-support';
    }

    return $classes;
}
add_filter('body_class', 'modernbiz_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function modernbiz_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'modernbiz_pingback_header');

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * WooCommerce compatibility.
 */
if (class_exists('WooCommerce')) {
    require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Elementor compatibility.
 */
if (did_action('elementor/loaded')) {
    require get_template_directory() . '/inc/elementor.php';
}

/**
 * Homepage layouts functionality.
 */
require get_template_directory() . '/inc/homepage-layouts.php';

/**
 * Dark mode functionality.
 */
require get_template_directory() . '/inc/dark-mode.php';

/**
 * RTL language support.
 */
require get_template_directory() . '/inc/rtl-support.php';

/**
 * AJAX handlers.
 */
require get_template_directory() . '/inc/ajax-handlers.php';

/**
 * Security enhancements.
 */
require get_template_directory() . '/inc/security.php';

/**
 * Performance optimizations.
 */
require get_template_directory() . '/inc/performance.php';

/**
 * Custom post types and fields.
 */
require get_template_directory() . '/inc/custom-post-types.php';

/**
 * Theme activation and setup.
 */
function modernbiz_theme_activation() {
    // Set default theme options
    set_theme_mod('dark_mode_enabled', false);
    set_theme_mod('homepage_layout', 'layout-1');
    
    // Create default pages if they don't exist
    $pages = array(
        'Home' => 'Welcome to our modern business website',
        'About' => 'Learn more about our company',
        'Services' => 'Discover our professional services',
        'Contact' => 'Get in touch with us',
    );

    foreach ($pages as $title => $content) {
        $page = get_page_by_title($title);
        if (!$page) {
            wp_insert_post(array(
                'post_title'   => $title,
                'post_content' => $content,
                'post_status'  => 'publish',
                'post_type'    => 'page',
            ));
        }
    }

    // Set front page
    $front_page = get_page_by_title('Home');
    if ($front_page) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $front_page->ID);
    }

    // Flush rewrite rules
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'modernbiz_theme_activation');

/**
 * Add theme support for Gutenberg editor.
 */
function modernbiz_gutenberg_support() {
    // Add support for editor color palette
    add_theme_support('editor-color-palette', array(
        array(
            'name'  => esc_html__('Primary', 'modernbiz-pro'),
            'slug'  => 'primary',
            'color' => '#2563eb',
        ),
        array(
            'name'  => esc_html__('Secondary', 'modernbiz-pro'),
            'slug'  => 'secondary',
            'color' => '#64748b',
        ),
        array(
            'name'  => esc_html__('Accent', 'modernbiz-pro'),
            'slug'  => 'accent',
            'color' => '#f59e0b',
        ),
    ));

    // Add support for editor font sizes
    add_theme_support('editor-font-sizes', array(
        array(
            'name' => esc_html__('Small', 'modernbiz-pro'),
            'size' => 14,
            'slug' => 'small'
        ),
        array(
            'name' => esc_html__('Regular', 'modernbiz-pro'),
            'size' => 16,
            'slug' => 'regular'
        ),
        array(
            'name' => esc_html__('Large', 'modernbiz-pro'),
            'size' => 20,
            'slug' => 'large'
        ),
        array(
            'name' => esc_html__('Extra Large', 'modernbiz-pro'),
            'size' => 24,
            'slug' => 'extra-large'
        ),
    ));

    // Disable custom colors and font sizes
    add_theme_support('disable-custom-colors');
    add_theme_support('disable-custom-font-sizes');

    // Add support for wide and full alignment
    add_theme_support('align-wide');
}
add_action('after_setup_theme', 'modernbiz_gutenberg_support');

/**
 * Remove unnecessary WordPress features for better performance.
 */
function modernbiz_cleanup() {
    // Remove emoji scripts
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');

    // Remove unnecessary meta tags
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');

    // Remove shortlink
    remove_action('wp_head', 'wp_shortlink_wp_head');
}
add_action('init', 'modernbiz_cleanup');

