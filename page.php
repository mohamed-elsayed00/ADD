<?php
/**
 * The template for displaying all pages
 *
 * @package ModernBiz_Pro
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <div class="content-layout">
            <div class="content-area">
                <?php
                while (have_posts()) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('single-page'); ?>>
                        <?php if (has_post_thumbnail() && !is_front_page()) : ?>
                            <div class="page-thumbnail">
                                <?php the_post_thumbnail('large', array('class' => 'img-responsive')); ?>
                            </div>
                        <?php endif; ?>

                        <header class="entry-header">
                            <?php if (!is_front_page()) : ?>
                                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                            <?php endif; ?>
                        </header>

                        <div class="entry-content">
                            <?php
                            the_content();

                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . esc_html__('Pages:', 'modernbiz-pro'),
                                'after'  => '</div>',
                            ));
                            ?>
                        </div>

                        <?php if (get_edit_post_link()) : ?>
                            <footer class="entry-footer">
                                <?php
                                edit_post_link(
                                    sprintf(
                                        wp_kses(
                                            __('Edit <span class="screen-reader-text">"%s"</span>', 'modernbiz-pro'),
                                            array(
                                                'span' => array(
                                                    'class' => array(),
                                                ),
                                            )
                                        ),
                                        get_the_title()
                                    ),
                                    '<span class="edit-link">',
                                    '</span>'
                                );
                                ?>
                            </footer>
                        <?php endif; ?>
                    </article>

                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;

                endwhile; // End of the loop.
                ?>
            </div>

            <?php if (!is_front_page()) get_sidebar(); ?>
        </div>
    </div>
</main>

<?php
get_footer();
?>

