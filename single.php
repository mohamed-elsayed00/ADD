<?php
/**
 * The template for displaying all single posts
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
                    <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('large', array('class' => 'img-responsive')); ?>
                            </div>
                        <?php endif; ?>

                        <header class="entry-header">
                            <div class="entry-meta">
                                <span class="posted-on">
                                    <time class="entry-date published" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                        <?php echo esc_html(get_the_date()); ?>
                                    </time>
                                </span>
                                <span class="byline">
                                    <?php _e('by', 'modernbiz-pro'); ?> 
                                    <span class="author vcard">
                                        <a class="url fn n" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                            <?php echo esc_html(get_the_author()); ?>
                                        </a>
                                    </span>
                                </span>
                                <?php if (has_category()) : ?>
                                    <span class="cat-links">
                                        <?php _e('in', 'modernbiz-pro'); ?> <?php the_category(', '); ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                        </header>

                        <div class="entry-content">
                            <?php
                            the_content(sprintf(
                                wp_kses(
                                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'modernbiz-pro'),
                                    array(
                                        'span' => array(
                                            'class' => array(),
                                        ),
                                    )
                                ),
                                get_the_title()
                            ));

                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . esc_html__('Pages:', 'modernbiz-pro'),
                                'after'  => '</div>',
                            ));
                            ?>
                        </div>

                        <footer class="entry-footer">
                            <?php if (has_tag()) : ?>
                                <div class="tag-links">
                                    <strong><?php _e('Tags:', 'modernbiz-pro'); ?></strong>
                                    <?php the_tags('', ', ', ''); ?>
                                </div>
                            <?php endif; ?>

                            <div class="post-navigation">
                                <?php
                                the_post_navigation(array(
                                    'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'modernbiz-pro') . '</span> <span class="nav-title">%title</span>',
                                    'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'modernbiz-pro') . '</span> <span class="nav-title">%title</span>',
                                ));
                                ?>
                            </div>
                        </footer>
                    </article>

                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;

                endwhile; // End of the loop.
                ?>
            </div>

            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<?php
get_footer();
?>

