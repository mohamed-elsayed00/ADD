<?php
/**
 * The header for our theme
 *
 * @package ModernBiz_Pro
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'modernbiz-pro'); ?></a>

    <header id="masthead" class="site-header">
        <div class="container">
            <div class="header-container">
                <div class="site-branding">
                    <?php
                    the_custom_logo();
                    if (is_front_page() && is_home()) :
                        ?>
                        <h1 class="site-title">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <?php bloginfo('name'); ?>
                            </a>
                        </h1>
                        <?php
                    else :
                        ?>
                        <p class="site-title">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <?php bloginfo('name'); ?>
                            </a>
                        </p>
                        <?php
                    endif;
                    $modernbiz_description = get_bloginfo('description', 'display');
                    if ($modernbiz_description || is_customize_preview()) :
                        ?>
                        <p class="site-description"><?php echo $modernbiz_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                    <?php endif; ?>
                </div><!-- .site-branding -->

                <nav id="site-navigation" class="main-navigation">
                    <button class="mobile-menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                        <span class="screen-reader-text"><?php esc_html_e('Primary Menu', 'modernbiz-pro'); ?></span>
                        <span class="hamburger">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'menu_id'        => 'primary-menu',
                            'container'      => false,
                            'fallback_cb'    => 'modernbiz_default_menu',
                        )
                    );
                    ?>
                </nav><!-- #site-navigation -->

                <div class="header-actions">
                    <!-- Dark Mode Toggle -->
                    <button class="dark-mode-toggle" id="dark-mode-toggle" aria-label="<?php esc_attr_e('Toggle dark mode', 'modernbiz-pro'); ?>">
                        <span class="light-icon">🌙</span>
                        <span class="dark-icon">☀️</span>
                    </button>

                    <!-- Language Switcher (if WPML or Polylang is active) -->
                    <?php if (function_exists('icl_get_languages') || function_exists('pll_the_languages')) : ?>
                        <div class="language-switcher">
                            <?php
                            if (function_exists('icl_get_languages')) {
                                // WPML language switcher
                                $languages = icl_get_languages('skip_missing=0&orderby=code');
                                if (!empty($languages)) {
                                    echo '<select class="language-select" onchange="location = this.value;">';
                                    foreach ($languages as $l) {
                                        $selected = $l['active'] ? 'selected="selected"' : '';
                                        echo '<option value="' . $l['url'] . '" ' . $selected . '>' . $l['native_name'] . '</option>';
                                    }
                                    echo '</select>';
                                }
                            } elseif (function_exists('pll_the_languages')) {
                                // Polylang language switcher
                                pll_the_languages(array(
                                    'dropdown' => 1,
                                    'show_names' => 1,
                                    'display_names_as' => 'name',
                                ));
                            }
                            ?>
                        </div>
                    <?php endif; ?>

                    <!-- WooCommerce Cart (if WooCommerce is active) -->
                    <?php if (class_exists('WooCommerce')) : ?>
                        <div class="header-cart">
                            <a class="cart-link" href="<?php echo esc_url(wc_get_cart_url()); ?>">
                                <span class="cart-icon">🛒</span>
                                <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>

                    <!-- Search Toggle -->
                    <button class="search-toggle" id="search-toggle" aria-label="<?php esc_attr_e('Toggle search', 'modernbiz-pro'); ?>">
                        <span class="search-icon">🔍</span>
                    </button>
                </div><!-- .header-actions -->
            </div><!-- .header-container -->

            <!-- Search Form -->
            <div class="header-search" id="header-search">
                <div class="search-form-container">
                    <?php get_search_form(); ?>
                    <button class="search-close" id="search-close" aria-label="<?php esc_attr_e('Close search', 'modernbiz-pro'); ?>">
                        <span>✕</span>
                    </button>
                </div>
            </div>
        </div><!-- .container -->
    </header><!-- #masthead -->

    <?php
    // Display custom header image if set
    if (get_header_image()) :
        ?>
        <div class="custom-header">
            <img src="<?php header_image(); ?>" width="<?php echo esc_attr(get_custom_header()->width); ?>" height="<?php echo esc_attr(get_custom_header()->height); ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
        </div>
    <?php endif; ?>

    <?php
    // Display breadcrumbs if not on front page
    if (!is_front_page() && function_exists('modernbiz_breadcrumbs')) :
        ?>
        <div class="breadcrumbs-container">
            <div class="container">
                <?php modernbiz_breadcrumbs(); ?>
            </div>
        </div>
    <?php endif; ?>

    <div id="content" class="site-content">

<?php
/**
 * Default menu fallback
 */
function modernbiz_default_menu() {
    echo '<ul id="primary-menu" class="menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'modernbiz-pro') . '</a></li>';
    
    // Add pages to menu
    $pages = get_pages(array('sort_column' => 'menu_order'));
    foreach ($pages as $page) {
        echo '<li><a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html($page->post_title) . '</a></li>';
    }
    
    echo '</ul>';
}
?>

