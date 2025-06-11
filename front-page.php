<?php
/**
 * The front page template file
 *
 * @package ModernBiz_Pro
 */

get_header();

// Get the selected homepage layout
$homepage_layout = get_theme_mod('homepage_layout', 'layout-1');

// Include the appropriate layout template
$layout_file = get_template_directory() . '/template-parts/homepage/layout-' . $homepage_layout . '.php';

if (file_exists($layout_file)) {
    include $layout_file;
} else {
    // Fallback to default layout
    include get_template_directory() . '/template-parts/homepage/layout-1.php';
}

get_footer();
?>

