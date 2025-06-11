<?php
/**
 * The template for displaying the footer
 *
 * @package ModernBiz_Pro
 */

?>

    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="container">
            <?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4')) : ?>
                <div class="footer-content">
                    <?php if (is_active_sidebar('footer-1')) : ?>
                        <div class="footer-section footer-1">
                            <?php dynamic_sidebar('footer-1'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (is_active_sidebar('footer-2')) : ?>
                        <div class="footer-section footer-2">
                            <?php dynamic_sidebar('footer-2'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (is_active_sidebar('footer-3')) : ?>
                        <div class="footer-section footer-3">
                            <?php dynamic_sidebar('footer-3'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (is_active_sidebar('footer-4')) : ?>
                        <div class="footer-section footer-4">
                            <?php dynamic_sidebar('footer-4'); ?>
                        </div>
                    <?php endif; ?>
                </div><!-- .footer-content -->
            <?php else : ?>
                <!-- Default footer content if no widgets are active -->
                <div class="footer-content">
                    <div class="footer-section">
                        <h3><?php bloginfo('name'); ?></h3>
                        <p><?php bloginfo('description'); ?></p>
                        <div class="social-links">
                            <?php
                            $social_links = array(
                                'facebook' => get_theme_mod('facebook_url', ''),
                                'twitter' => get_theme_mod('twitter_url', ''),
                                'linkedin' => get_theme_mod('linkedin_url', ''),
                                'instagram' => get_theme_mod('instagram_url', ''),
                            );

                            foreach ($social_links as $platform => $url) {
                                if (!empty($url)) {
                                    echo '<a href="' . esc_url($url) . '" target="_blank" rel="noopener noreferrer" class="social-link social-' . esc_attr($platform) . '">';
                                    echo '<span class="screen-reader-text">' . esc_html(ucfirst($platform)) . '</span>';
                                    echo '</a>';
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <div class="footer-section">
                        <h3><?php esc_html_e('Quick Links', 'modernbiz-pro'); ?></h3>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'menu_class'     => 'footer-menu',
                            'container'      => false,
                            'fallback_cb'    => 'modernbiz_footer_menu_fallback',
                        ));
                        ?>
                    </div>

                    <div class="footer-section">
                        <h3><?php esc_html_e('Contact Info', 'modernbiz-pro'); ?></h3>
                        <div class="contact-info">
                            <?php
                            $contact_info = array(
                                'address' => get_theme_mod('contact_address', ''),
                                'phone' => get_theme_mod('contact_phone', ''),
                                'email' => get_theme_mod('contact_email', ''),
                            );

                            if (!empty($contact_info['address'])) {
                                echo '<p class="contact-address"><strong>' . esc_html__('Address:', 'modernbiz-pro') . '</strong> ' . esc_html($contact_info['address']) . '</p>';
                            }

                            if (!empty($contact_info['phone'])) {
                                echo '<p class="contact-phone"><strong>' . esc_html__('Phone:', 'modernbiz-pro') . '</strong> <a href="tel:' . esc_attr($contact_info['phone']) . '">' . esc_html($contact_info['phone']) . '</a></p>';
                            }

                            if (!empty($contact_info['email'])) {
                                echo '<p class="contact-email"><strong>' . esc_html__('Email:', 'modernbiz-pro') . '</strong> <a href="mailto:' . esc_attr($contact_info['email']) . '">' . esc_html($contact_info['email']) . '</a></p>';
                            }
                            ?>
                        </div>
                    </div>

                    <div class="footer-section">
                        <h3><?php esc_html_e('Newsletter', 'modernbiz-pro'); ?></h3>
                        <p><?php esc_html_e('Subscribe to our newsletter for updates and news.', 'modernbiz-pro'); ?></p>
                        <form class="newsletter-form" action="#" method="post">
                            <div class="form-group">
                                <input type="email" name="newsletter_email" placeholder="<?php esc_attr_e('Your email address', 'modernbiz-pro'); ?>" required>
                                <button type="submit" class="btn btn-primary">
                                    <?php esc_html_e('Subscribe', 'modernbiz-pro'); ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endif; ?>

            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <div class="copyright">
                        <p>
                            <?php
                            printf(
                                esc_html__('© %1$s %2$s. All rights reserved.', 'modernbiz-pro'),
                                date('Y'),
                                get_bloginfo('name')
                            );
                            ?>
                        </p>
                    </div>

                    <div class="footer-links">
                        <?php
                        $footer_links = array(
                            'privacy_policy' => array(
                                'url' => get_privacy_policy_url(),
                                'text' => __('Privacy Policy', 'modernbiz-pro')
                            ),
                            'terms_of_service' => array(
                                'url' => get_theme_mod('terms_url', ''),
                                'text' => __('Terms of Service', 'modernbiz-pro')
                            ),
                        );

                        $links_output = array();
                        foreach ($footer_links as $key => $link) {
                            if (!empty($link['url'])) {
                                $links_output[] = '<a href="' . esc_url($link['url']) . '">' . esc_html($link['text']) . '</a>';
                            }
                        }

                        if (!empty($links_output)) {
                            echo '<p>' . implode(' | ', $links_output) . '</p>';
                        }
                        ?>
                    </div>

                    <div class="theme-credit">
                        <p>
                            <?php
                            printf(
                                esc_html__('Powered by %1$s | Theme: %2$s', 'modernbiz-pro'),
                                '<a href="' . esc_url(__('https://wordpress.org/', 'modernbiz-pro')) . '">WordPress</a>',
                                '<a href="#" rel="designer">ModernBiz Pro</a>'
                            );
                            ?>
                        </p>
                    </div>
                </div>
            </div><!-- .footer-bottom -->
        </div><!-- .container -->
    </footer><!-- #colophon -->

    <!-- Back to Top Button -->
    <button id="back-to-top" class="back-to-top" aria-label="<?php esc_attr_e('Back to top', 'modernbiz-pro'); ?>">
        <span class="back-to-top-icon">↑</span>
    </button>

    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay" id="mobile-menu-overlay"></div>

</div><!-- #page -->

<?php wp_footer(); ?>

<script>
// Initialize theme functionality
document.addEventListener('DOMContentLoaded', function() {
    // Back to top functionality
    const backToTopButton = document.getElementById('back-to-top');
    
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.add('visible');
        } else {
            backToTopButton.classList.remove('visible');
        }
    });

    backToTopButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Newsletter form handling
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[name="newsletter_email"]').value;
            
            // Here you would typically send the email to your server
            // For now, we'll just show a success message
            alert('<?php esc_html_e("Thank you for subscribing!", "modernbiz-pro"); ?>');
            this.reset();
        });
    }
});
</script>

</body>
</html>

<?php
/**
 * Footer menu fallback
 */
function modernbiz_footer_menu_fallback() {
    echo '<ul class="footer-menu">';
    
    $pages = get_pages(array(
        'sort_column' => 'menu_order',
        'number' => 5
    ));
    
    foreach ($pages as $page) {
        echo '<li><a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html($page->post_title) . '</a></li>';
    }
    
    echo '</ul>';
}
?>

