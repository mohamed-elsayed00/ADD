<?php
/**
 * Template for displaying search forms
 *
 * @package ModernBiz_Pro
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label>
        <span class="screen-reader-text"><?php echo _x('Search for:', 'label', 'modernbiz-pro'); ?></span>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Search...', 'placeholder', 'modernbiz-pro'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    </label>
    <button type="submit" class="search-submit">
        <span class="screen-reader-text"><?php echo _x('Search', 'submit button', 'modernbiz-pro'); ?></span>
        <span class="search-icon">🔍</span>
    </button>
</form>

