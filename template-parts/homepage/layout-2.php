<?php
/**
 * Homepage Layout 2 - Creative Agency
 *
 * @package ModernBiz_Pro
 */
?>

<!-- Hero Section with Video Background -->
<section class="hero-section hero-creative" id="hero">
    <div class="hero-background">
        <?php
        $hero_video = get_theme_mod('hero_video_url', '');
        if ($hero_video) :
            ?>
            <video autoplay muted loop class="hero-video">
                <source src="<?php echo esc_url($hero_video); ?>" type="video/mp4">
            </video>
        <?php endif; ?>
        <div class="hero-overlay"></div>
    </div>
    
    <div class="container">
        <div class="hero-content text-center fade-in">
            <h1 class="hero-title-large"><?php echo esc_html(get_theme_mod('hero_title', __('Creative Solutions for Modern Businesses', 'modernbiz-pro'))); ?></h1>
            <p class="hero-subtitle-large"><?php echo esc_html(get_theme_mod('hero_subtitle', __('We craft exceptional digital experiences that drive results and inspire action.', 'modernbiz-pro'))); ?></p>
            <div class="hero-buttons">
                <a href="<?php echo esc_url(get_theme_mod('hero_button_1_url', '#portfolio')); ?>" class="btn btn-primary btn-large">
                    <?php echo esc_html(get_theme_mod('hero_button_1_text', __('View Portfolio', 'modernbiz-pro'))); ?>
                </a>
                <a href="<?php echo esc_url(get_theme_mod('hero_button_2_url', '#contact')); ?>" class="btn btn-outline btn-large">
                    <?php echo esc_html(get_theme_mod('hero_button_2_text', __('Start Project', 'modernbiz-pro'))); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio/Work Section -->
<section class="section portfolio-section" id="portfolio">
    <div class="container">
        <div class="section-header fade-in">
            <h2 class="section-title"><?php echo esc_html(get_theme_mod('portfolio_title', __('Our Latest Work', 'modernbiz-pro'))); ?></h2>
            <p class="section-subtitle"><?php echo esc_html(get_theme_mod('portfolio_subtitle', __('Explore our recent projects and creative solutions', 'modernbiz-pro'))); ?></p>
        </div>

        <div class="portfolio-filter fade-in">
            <button class="filter-btn active" data-filter="all"><?php esc_html_e('All', 'modernbiz-pro'); ?></button>
            <button class="filter-btn" data-filter="web"><?php esc_html_e('Web Design', 'modernbiz-pro'); ?></button>
            <button class="filter-btn" data-filter="branding"><?php esc_html_e('Branding', 'modernbiz-pro'); ?></button>
            <button class="filter-btn" data-filter="mobile"><?php esc_html_e('Mobile Apps', 'modernbiz-pro'); ?></button>
        </div>

        <div class="portfolio-grid grid grid-3">
            <?php
            $portfolio_items = array(
                array(
                    'category' => 'web',
                    'title' => get_theme_mod('portfolio_1_title', __('E-commerce Platform', 'modernbiz-pro')),
                    'description' => get_theme_mod('portfolio_1_desc', __('Modern e-commerce solution with advanced features', 'modernbiz-pro')),
                    'image' => get_theme_mod('portfolio_1_image', '')
                ),
                array(
                    'category' => 'branding',
                    'title' => get_theme_mod('portfolio_2_title', __('Brand Identity Design', 'modernbiz-pro')),
                    'description' => get_theme_mod('portfolio_2_desc', __('Complete brand identity for tech startup', 'modernbiz-pro')),
                    'image' => get_theme_mod('portfolio_2_image', '')
                ),
                array(
                    'category' => 'mobile',
                    'title' => get_theme_mod('portfolio_3_title', __('Mobile Banking App', 'modernbiz-pro')),
                    'description' => get_theme_mod('portfolio_3_desc', __('Secure and user-friendly banking application', 'modernbiz-pro')),
                    'image' => get_theme_mod('portfolio_3_image', '')
                ),
                array(
                    'category' => 'web',
                    'title' => get_theme_mod('portfolio_4_title', __('Corporate Website', 'modernbiz-pro')),
                    'description' => get_theme_mod('portfolio_4_desc', __('Professional corporate website with CMS', 'modernbiz-pro')),
                    'image' => get_theme_mod('portfolio_4_image', '')
                ),
                array(
                    'category' => 'branding',
                    'title' => get_theme_mod('portfolio_5_title', __('Restaurant Branding', 'modernbiz-pro')),
                    'description' => get_theme_mod('portfolio_5_desc', __('Complete branding package for restaurant chain', 'modernbiz-pro')),
                    'image' => get_theme_mod('portfolio_5_image', '')
                ),
                array(
                    'category' => 'mobile',
                    'title' => get_theme_mod('portfolio_6_title', __('Fitness Tracking App', 'modernbiz-pro')),
                    'description' => get_theme_mod('portfolio_6_desc', __('Health and fitness tracking mobile application', 'modernbiz-pro')),
                    'image' => get_theme_mod('portfolio_6_image', '')
                )
            );

            foreach ($portfolio_items as $index => $item) :
                ?>
                <div class="portfolio-item fade-in" data-category="<?php echo esc_attr($item['category']); ?>" data-delay="<?php echo $index * 100; ?>">
                    <div class="portfolio-image">
                        <?php if ($item['image']) : ?>
                            <img src="<?php echo esc_url($item['image']); ?>" alt="<?php echo esc_attr($item['title']); ?>">
                        <?php else : ?>
                            <div class="placeholder-image" style="background: linear-gradient(135deg, var(--primary-color), var(--accent-color)); height: 250px; display: flex; align-items: center; justify-content: center; color: white;">
                                <?php echo esc_html($item['title']); ?>
                            </div>
                        <?php endif; ?>
                        <div class="portfolio-overlay">
                            <div class="portfolio-content">
                                <h3><?php echo esc_html($item['title']); ?></h3>
                                <p><?php echo esc_html($item['description']); ?></p>
                                <a href="#" class="btn btn-primary btn-small"><?php esc_html_e('View Project', 'modernbiz-pro'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="section services-creative" style="background-color: var(--bg-secondary);">
    <div class="container">
        <div class="section-header fade-in">
            <h2 class="section-title"><?php echo esc_html(get_theme_mod('services_title', __('What We Do', 'modernbiz-pro'))); ?></h2>
            <p class="section-subtitle"><?php echo esc_html(get_theme_mod('services_subtitle', __('We offer a full range of creative and technical services', 'modernbiz-pro'))); ?></p>
        </div>

        <div class="services-creative-grid">
            <?php
            $services = array(
                array(
                    'icon' => '🎨',
                    'title' => get_theme_mod('service_1_title', __('Creative Design', 'modernbiz-pro')),
                    'description' => get_theme_mod('service_1_desc', __('Innovative design solutions that capture your brand essence and engage your audience.', 'modernbiz-pro')),
                    'features' => array(__('Logo Design', 'modernbiz-pro'), __('Brand Identity', 'modernbiz-pro'), __('Print Design', 'modernbiz-pro'))
                ),
                array(
                    'icon' => '💻',
                    'title' => get_theme_mod('service_2_title', __('Web Development', 'modernbiz-pro')),
                    'description' => get_theme_mod('service_2_desc', __('Custom web solutions built with modern technologies and best practices.', 'modernbiz-pro')),
                    'features' => array(__('Responsive Design', 'modernbiz-pro'), __('E-commerce', 'modernbiz-pro'), __('CMS Integration', 'modernbiz-pro'))
                ),
                array(
                    'icon' => '📱',
                    'title' => get_theme_mod('service_3_title', __('Mobile Apps', 'modernbiz-pro')),
                    'description' => get_theme_mod('service_3_desc', __('Native and cross-platform mobile applications for iOS and Android.', 'modernbiz-pro')),
                    'features' => array(__('iOS Development', 'modernbiz-pro'), __('Android Development', 'modernbiz-pro'), __('Cross-platform', 'modernbiz-pro'))
                ),
                array(
                    'icon' => '📊',
                    'title' => get_theme_mod('service_4_title', __('Digital Strategy', 'modernbiz-pro')),
                    'description' => get_theme_mod('service_4_desc', __('Strategic planning and consulting to maximize your digital presence.', 'modernbiz-pro')),
                    'features' => array(__('SEO Optimization', 'modernbiz-pro'), __('Analytics', 'modernbiz-pro'), __('Consulting', 'modernbiz-pro'))
                )
            );

            foreach ($services as $index => $service) :
                ?>
                <div class="service-card-creative fade-in" data-delay="<?php echo $index * 150; ?>">
                    <div class="service-icon-large"><?php echo $service['icon']; ?></div>
                    <h3><?php echo esc_html($service['title']); ?></h3>
                    <p><?php echo esc_html($service['description']); ?></p>
                    <ul class="service-features">
                        <?php foreach ($service['features'] as $feature) : ?>
                            <li><?php echo esc_html($feature); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="#" class="btn btn-outline"><?php esc_html_e('Learn More', 'modernbiz-pro'); ?></a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="section team-section" id="team">
    <div class="container">
        <div class="section-header fade-in">
            <h2 class="section-title"><?php echo esc_html(get_theme_mod('team_title', __('Meet Our Team', 'modernbiz-pro'))); ?></h2>
            <p class="section-subtitle"><?php echo esc_html(get_theme_mod('team_subtitle', __('Talented professionals dedicated to bringing your vision to life', 'modernbiz-pro'))); ?></p>
        </div>

        <div class="grid grid-4">
            <?php
            $team_members = array(
                array(
                    'name' => get_theme_mod('team_1_name', __('Alex Johnson', 'modernbiz-pro')),
                    'position' => get_theme_mod('team_1_position', __('Creative Director', 'modernbiz-pro')),
                    'bio' => get_theme_mod('team_1_bio', __('Leading creative vision and design strategy', 'modernbiz-pro')),
                    'image' => get_theme_mod('team_1_image', '')
                ),
                array(
                    'name' => get_theme_mod('team_2_name', __('Sarah Chen', 'modernbiz-pro')),
                    'position' => get_theme_mod('team_2_position', __('Lead Developer', 'modernbiz-pro')),
                    'bio' => get_theme_mod('team_2_bio', __('Full-stack development and technical architecture', 'modernbiz-pro')),
                    'image' => get_theme_mod('team_2_image', '')
                ),
                array(
                    'name' => get_theme_mod('team_3_name', __('Mike Rodriguez', 'modernbiz-pro')),
                    'position' => get_theme_mod('team_3_position', __('UX Designer', 'modernbiz-pro')),
                    'bio' => get_theme_mod('team_3_bio', __('User experience and interface design specialist', 'modernbiz-pro')),
                    'image' => get_theme_mod('team_3_image', '')
                ),
                array(
                    'name' => get_theme_mod('team_4_name', __('Emma Wilson', 'modernbiz-pro')),
                    'position' => get_theme_mod('team_4_position', __('Project Manager', 'modernbiz-pro')),
                    'bio' => get_theme_mod('team_4_bio', __('Ensuring projects are delivered on time and budget', 'modernbiz-pro')),
                    'image' => get_theme_mod('team_4_image', '')
                )
            );

            foreach ($team_members as $index => $member) :
                ?>
                <div class="team-member fade-in" data-delay="<?php echo $index * 100; ?>">
                    <div class="team-image">
                        <?php if ($member['image']) : ?>
                            <img src="<?php echo esc_url($member['image']); ?>" alt="<?php echo esc_attr($member['name']); ?>">
                        <?php else : ?>
                            <div class="placeholder-avatar" style="background: linear-gradient(135deg, var(--primary-color), var(--accent-color)); width: 100%; height: 250px; display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem; border-radius: 12px;">
                                <?php echo esc_html(substr($member['name'], 0, 1)); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="team-info">
                        <h3><?php echo esc_html($member['name']); ?></h3>
                        <p class="team-position"><?php echo esc_html($member['position']); ?></p>
                        <p class="team-bio"><?php echo esc_html($member['bio']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section cta-section" style="background: linear-gradient(135deg, var(--primary-color), var(--accent-color)); color: white;">
    <div class="container">
        <div class="cta-content text-center fade-in">
            <h2><?php echo esc_html(get_theme_mod('cta_title', __('Ready to Start Your Project?', 'modernbiz-pro'))); ?></h2>
            <p><?php echo esc_html(get_theme_mod('cta_subtitle', __('Let\'s work together to bring your vision to life. Contact us today for a free consultation.', 'modernbiz-pro'))); ?></p>
            <div class="cta-buttons">
                <a href="<?php echo esc_url(get_theme_mod('cta_button_1_url', '#contact')); ?>" class="btn btn-white btn-large">
                    <?php echo esc_html(get_theme_mod('cta_button_1_text', __('Get Started', 'modernbiz-pro'))); ?>
                </a>
                <a href="<?php echo esc_url(get_theme_mod('cta_button_2_url', '#portfolio')); ?>" class="btn btn-outline-white btn-large">
                    <?php echo esc_html(get_theme_mod('cta_button_2_text', __('View Work', 'modernbiz-pro'))); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="section contact-section" id="contact">
    <div class="container">
        <div class="section-header fade-in">
            <h2 class="section-title"><?php echo esc_html(get_theme_mod('contact_title', __('Let\'s Talk', 'modernbiz-pro'))); ?></h2>
            <p class="section-subtitle"><?php echo esc_html(get_theme_mod('contact_subtitle', __('Have a project in mind? We\'d love to hear from you.', 'modernbiz-pro'))); ?></p>
        </div>

        <div class="contact-creative-layout">
            <div class="contact-info-creative fade-in">
                <div class="contact-item-large">
                    <div class="contact-icon-large">📧</div>
                    <h3><?php esc_html_e('Email Us', 'modernbiz-pro'); ?></h3>
                    <p><a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email', 'hello@example.com')); ?>"><?php echo esc_html(get_theme_mod('contact_email', 'hello@example.com')); ?></a></p>
                </div>

                <div class="contact-item-large">
                    <div class="contact-icon-large">📞</div>
                    <h3><?php esc_html_e('Call Us', 'modernbiz-pro'); ?></h3>
                    <p><a href="tel:<?php echo esc_attr(get_theme_mod('contact_phone', '+1 (555) 123-4567')); ?>"><?php echo esc_html(get_theme_mod('contact_phone', '+1 (555) 123-4567')); ?></a></p>
                </div>

                <div class="contact-item-large">
                    <div class="contact-icon-large">📍</div>
                    <h3><?php esc_html_e('Visit Us', 'modernbiz-pro'); ?></h3>
                    <p><?php echo esc_html(get_theme_mod('contact_address', __('123 Creative Street, Design City, DC 12345', 'modernbiz-pro'))); ?></p>
                </div>
            </div>

            <div class="contact-form-creative fade-in" data-delay="200">
                <form class="contact-form-element" action="#" method="post">
                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="<?php esc_attr_e('Your Name', 'modernbiz-pro'); ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="<?php esc_attr_e('Your Email', 'modernbiz-pro'); ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject" placeholder="<?php esc_attr_e('Project Type', 'modernbiz-pro'); ?>" required>
                    </div>
                    <div class="form-group">
                        <textarea name="message" rows="6" placeholder="<?php esc_attr_e('Tell us about your project...', 'modernbiz-pro'); ?>" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-large">
                        <?php esc_html_e('Send Message', 'modernbiz-pro'); ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

