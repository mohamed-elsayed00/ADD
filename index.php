<?php
/**
 * The main template file
 *
 * @package ModernBiz_Pro
 */

get_header(); ?>

<main id="primary" class="site-main">
    <?php if (is_home() && !is_front_page()) : ?>
        <header class="page-header">
            <div class="container">
                <h1 class="page-title"><?php single_post_title(); ?></h1>
            </div>
        </header>
    <?php endif; ?>

    <div class="container">
        <div class="content-area">
            <?php if (have_posts()) : ?>
                <div class="posts-grid grid grid-2">
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium_large', array('class' => 'img-responsive')); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="post-content">
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
                                    </div>

                                    <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
                                </header>

                                <div class="entry-summary">
                                    <?php the_excerpt(); ?>
                                </div>

                                <footer class="entry-footer">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-secondary">
                                        <?php _e('Read More', 'modernbiz-pro'); ?>
                                    </a>
                                </footer>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <?php
                the_posts_navigation(array(
                    'prev_text' => __('&larr; Older posts', 'modernbiz-pro'),
                    'next_text' => __('Newer posts &rarr;', 'modernbiz-pro'),
                ));
                ?>

            <?php else : ?>
                <section class="no-results not-found">
                    <header class="page-header">
                        <h1 class="page-title"><?php _e('Nothing here', 'modernbiz-pro'); ?></h1>
                    </header>

                    <div class="page-content">
                        <?php if (is_home() && current_user_can('publish_posts')) : ?>
                            <p>
                                <?php
                                printf(
                                    wp_kses(
                                        __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'modernbiz-pro'),
                                        array(
                                            'a' => array(
                                                'href' => array(),
                                            ),
                                        )
                                    ),
                                    esc_url(admin_url('post-new.php'))
                                );
                                ?>
                            </p>
                        <?php elseif (is_search()) : ?>
                            <p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'modernbiz-pro'); ?></p>
                            <?php get_search_form(); ?>
                        <?php else : ?>
                            <p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'modernbiz-pro'); ?></p>
                            <?php get_search_form(); ?>
                        <?php endif; ?>
                    </div>
                </section>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>

