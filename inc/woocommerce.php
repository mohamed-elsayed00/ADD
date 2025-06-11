<?php
/**
 * WooCommerce Compatibility File
 *
 * @package ModernBiz_Pro
 */

/**
 * WooCommerce setup function.
 */
function modernbiz_woocommerce_setup() {
    add_theme_support('woocommerce', array(
        'thumbnail_image_width' => 300,
        'single_image_width'    => 600,
        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 2,
            'max_rows'        => 8,
            'default_columns' => 3,
            'min_columns'     => 2,
            'max_columns'     => 5,
        ),
    ));

    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'modernbiz_woocommerce_setup');

/**
 * WooCommerce specific scripts & stylesheets.
 */
function modernbiz_woocommerce_scripts() {
    wp_enqueue_style('modernbiz-woocommerce-style', get_template_directory_uri() . '/assets/css/woocommerce.css', array(), MODERNBIZ_VERSION);

    $font_path   = WC()->plugin_url() . '/assets/fonts/';
    $inline_font = '@font-face {
        font-family: "star";
        src: url("' . $font_path . 'star.eot");
        src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
            url("' . $font_path . 'star.woff") format("woff"),
            url("' . $font_path . 'star.ttf") format("truetype"),
            url("' . $font_path . 'star.svg#star") format("svg");
        font-weight: normal;
        font-style: normal;
    }';

    wp_add_inline_style('modernbiz-woocommerce-style', $inline_font);
}
add_action('wp_enqueue_scripts', 'modernbiz_woocommerce_scripts');

/**
 * Disable the default WooCommerce stylesheet.
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * Add 'woocommerce-active' class to the body tag.
 */
function modernbiz_woocommerce_active_body_class($classes) {
    $classes[] = 'woocommerce-active';
    return $classes;
}
add_filter('body_class', 'modernbiz_woocommerce_active_body_class');

/**
 * Products per page.
 */
function modernbiz_woocommerce_products_per_page() {
    return 12;
}
add_filter('loop_shop_per_page', 'modernbiz_woocommerce_products_per_page');

/**
 * Product gallery thumnbail columns.
 */
function modernbiz_woocommerce_thumbnail_columns() {
    return 4;
}
add_filter('woocommerce_product_thumbnails_columns', 'modernbiz_woocommerce_thumbnail_columns');

/**
 * Default loop columns on product archives.
 */
function modernbiz_woocommerce_loop_columns() {
    return 3;
}
add_filter('woocommerce_default_catalog_columns', 'modernbiz_woocommerce_loop_columns');

/**
 * Related Products Args.
 */
function modernbiz_woocommerce_related_products_args($args) {
    $defaults = array(
        'posts_per_page' => 3,
        'columns'        => 3,
    );

    $args = wp_parse_args($defaults, $args);

    return $args;
}
add_filter('woocommerce_output_related_products_args', 'modernbiz_woocommerce_related_products_args');

/**
 * Remove default WooCommerce wrapper.
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

if (!function_exists('modernbiz_woocommerce_wrapper_before')) {
    /**
     * Before Content.
     */
    function modernbiz_woocommerce_wrapper_before() {
        ?>
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <div class="container">
        <?php
    }
}
add_action('woocommerce_before_main_content', 'modernbiz_woocommerce_wrapper_before');

if (!function_exists('modernbiz_woocommerce_wrapper_after')) {
    /**
     * After Content.
     */
    function modernbiz_woocommerce_wrapper_after() {
        ?>
                </div><!-- .container -->
            </main><!-- #main -->
        </div><!-- #primary -->
        <?php
    }
}
add_action('woocommerce_after_main_content', 'modernbiz_woocommerce_wrapper_after');

/**
 * Sample implementation of the WooCommerce Mini Cart.
 */
if (!function_exists('modernbiz_woocommerce_cart_link_fragment')) {
    /**
     * Cart Fragments.
     */
    function modernbiz_woocommerce_cart_link_fragment($fragments) {
        ob_start();
        modernbiz_woocommerce_cart_link();
        $fragments['a.cart-contents'] = ob_get_clean();

        return $fragments;
    }
}
add_filter('woocommerce_add_to_cart_fragments', 'modernbiz_woocommerce_cart_link_fragment');

if (!function_exists('modernbiz_woocommerce_cart_link')) {
    /**
     * Cart Link.
     */
    function modernbiz_woocommerce_cart_link() {
        ?>
        <a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'modernbiz-pro'); ?>">
            <span class="cart-icon">🛒</span>
            <span class="amount"><?php echo wp_kses_data(WC()->cart->get_cart_subtotal()); ?></span>
            <span class="count"><?php echo wp_kses_data(sprintf(_n('%d item', '%d items', WC()->cart->get_cart_contents_count(), 'modernbiz-pro'), WC()->cart->get_cart_contents_count())); ?></span>
        </a>
        <?php
    }
}

if (!function_exists('modernbiz_woocommerce_header_cart')) {
    /**
     * Display Header Cart.
     */
    function modernbiz_woocommerce_header_cart() {
        if (is_cart()) {
            $class = 'current-menu-item';
        } else {
            $class = '';
        }
        ?>
        <ul id="site-header-cart" class="site-header-cart">
            <li class="<?php echo esc_attr($class); ?>">
                <?php modernbiz_woocommerce_cart_link(); ?>
            </li>
            <li>
                <?php
                $instance = array(
                    'title' => '',
                );

                the_widget('WC_Widget_Cart', $instance);
                ?>
            </li>
        </ul>
        <?php
    }
}

/**
 * Customize WooCommerce breadcrumbs
 */
function modernbiz_woocommerce_breadcrumbs() {
    return array(
        'delimiter'   => ' / ',
        'wrap_before' => '<nav class="woocommerce-breadcrumb breadcrumbs" itemprop="breadcrumb">',
        'wrap_after'  => '</nav>',
        'before'      => '',
        'after'       => '',
        'home'        => _x('Home', 'breadcrumb', 'modernbiz-pro'),
    );
}
add_filter('woocommerce_breadcrumb_defaults', 'modernbiz_woocommerce_breadcrumbs');

/**
 * Customize WooCommerce pagination
 */
function modernbiz_woocommerce_pagination_args($args) {
    $args['prev_text'] = __('&larr; Previous', 'modernbiz-pro');
    $args['next_text'] = __('Next &rarr;', 'modernbiz-pro');
    return $args;
}
add_filter('woocommerce_pagination_args', 'modernbiz_woocommerce_pagination_args');

/**
 * Change number of upsells output
 */
function modernbiz_woocommerce_upsell_display() {
    woocommerce_upsell_display(3, 3);
}
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
add_action('woocommerce_after_single_product_summary', 'modernbiz_woocommerce_upsell_display', 15);

/**
 * Change number of cross-sells output
 */
function modernbiz_woocommerce_cross_sell_display() {
    woocommerce_cross_sell_display(3, 3);
}
remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
add_action('woocommerce_cart_collaterals', 'modernbiz_woocommerce_cross_sell_display');

/**
 * Customize WooCommerce single product tabs
 */
function modernbiz_woocommerce_product_tabs($tabs) {
    // Rename the description tab
    $tabs['description']['title'] = __('Product Details', 'modernbiz-pro');
    
    // Rename the reviews tab
    $tabs['reviews']['title'] = __('Customer Reviews', 'modernbiz-pro');
    
    // Add custom tab
    $tabs['custom_tab'] = array(
        'title'    => __('Shipping & Returns', 'modernbiz-pro'),
        'priority' => 50,
        'callback' => 'modernbiz_woocommerce_custom_product_tab_content'
    );
    
    return $tabs;
}
add_filter('woocommerce_product_tabs', 'modernbiz_woocommerce_product_tabs', 98);

/**
 * Custom product tab content
 */
function modernbiz_woocommerce_custom_product_tab_content() {
    echo '<h2>' . __('Shipping & Returns', 'modernbiz-pro') . '</h2>';
    echo '<p>' . __('Free shipping on orders over $50. Returns accepted within 30 days.', 'modernbiz-pro') . '</p>';
}

/**
 * Add custom fields to checkout
 */
function modernbiz_woocommerce_checkout_fields($fields) {
    $fields['billing']['billing_company_type'] = array(
        'label'     => __('Company Type', 'modernbiz-pro'),
        'placeholder' => _x('Select company type', 'placeholder', 'modernbiz-pro'),
        'required'  => false,
        'clear'     => false,
        'type'      => 'select',
        'options'   => array(
            ''           => __('Select an option', 'modernbiz-pro'),
            'individual' => __('Individual', 'modernbiz-pro'),
            'business'   => __('Business', 'modernbiz-pro'),
            'nonprofit'  => __('Non-profit', 'modernbiz-pro'),
        )
    );
    
    return $fields;
}
add_filter('woocommerce_checkout_fields', 'modernbiz_woocommerce_checkout_fields');

/**
 * Customize WooCommerce email templates
 */
function modernbiz_woocommerce_email_styles($css) {
    $css .= '
        .wc-email-header {
            background-color: ' . get_theme_mod('primary_color', '#2563eb') . ';
        }
        .wc-email-body {
            font-family: ' . get_theme_mod('primary_font', 'Inter') . ', sans-serif;
        }
    ';
    return $css;
}
add_filter('woocommerce_email_styles', 'modernbiz_woocommerce_email_styles');

/**
 * Add custom WooCommerce widgets
 */
function modernbiz_woocommerce_widgets() {
    register_sidebar(array(
        'name'          => esc_html__('Shop Sidebar', 'modernbiz-pro'),
        'id'            => 'shop-sidebar',
        'description'   => esc_html__('Add widgets here to appear in your shop sidebar.', 'modernbiz-pro'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'modernbiz_woocommerce_widgets');

/**
 * Display shop sidebar
 */
function modernbiz_woocommerce_sidebar() {
    if (is_shop() || is_product_category() || is_product_tag()) {
        if (is_active_sidebar('shop-sidebar')) {
            echo '<aside id="secondary" class="widget-area shop-sidebar">';
            dynamic_sidebar('shop-sidebar');
            echo '</aside>';
        }
    }
}
add_action('woocommerce_sidebar', 'modernbiz_woocommerce_sidebar');

/**
 * Customize WooCommerce notice styles
 */
function modernbiz_woocommerce_notice_types($notice_types) {
    $notice_types['success'] = 'success';
    $notice_types['error'] = 'error';
    $notice_types['notice'] = 'info';
    return $notice_types;
}
add_filter('woocommerce_notice_types', 'modernbiz_woocommerce_notice_types');

