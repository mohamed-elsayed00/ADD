<?php
/**
 * Homepage Layout 1 - Corporate Business
 *
 * @package ModernBiz_Pro
 */
?>

<!-- Hero Section -->
<section class="hero-section" id="hero">
    <div class="container">
        <div class="hero-content fade-in">
            <h1><?php echo esc_html(get_theme_mod('hero_title', __('Welcome to Our Modern Business', 'modernbiz-pro'))); ?></h1>
            <p><?php echo esc_html(get_theme_mod('hero_subtitle', __('We provide innovative solutions for your business needs with cutting-edge technology and exceptional service.', 'modernbiz-pro'))); ?></p>
            <div class="hero-buttons">
                <a href="<?php echo esc_url(get_theme_mod('hero_button_1_url', '#services')); ?>" class="btn btn-primary">
                    <?php echo esc_html(get_theme_mod('hero_button_1_text', __('Our Services', 'modernbiz-pro'))); ?>
                </a>
                <a href="<?php echo esc_url(get_theme_mod('hero_button_2_url', '#contact')); ?>" class="btn btn-secondary">
                    <?php echo esc_html(get_theme_mod('hero_button_2_text', __('Contact Us', 'modernbiz-pro'))); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="section features-section" id="features">
    <div class="container">
        <div class="section-header fade-in">
            <h2 class="section-title"><?php echo esc_html(get_theme_mod('features_title', __('Why Choose Us', 'modernbiz-pro'))); ?></h2>
            <p class="section-subtitle"><?php echo esc_html(get_theme_mod('features_subtitle', __('We offer comprehensive solutions tailored to your business needs', 'modernbiz-pro'))); ?></p>
        </div>

        <div class="grid grid-3">
            <?php
            $features = array(
                array(
                    'icon' => '🚀',
                    'title' => get_theme_mod('feature_1_title', __('Fast Performance', 'modernbiz-pro')),
                    'description' => get_theme_mod('feature_1_desc', __('Lightning-fast loading times and optimized performance for better user experience.', 'modernbiz-pro'))
                ),
                array(
                    'icon' => '🔒',
                    'title' => get_theme_mod('feature_2_title', __('Secure & Reliable', 'modernbiz-pro')),
                    'description' => get_theme_mod('feature_2_desc', __('Enterprise-grade security measures to protect your data and ensure reliability.', 'modernbiz-pro'))
                ),
                array(
                    'icon' => '📱',
                    'title' => get_theme_mod('feature_3_title', __('Mobile Responsive', 'modernbiz-pro')),
                    'description' => get_theme_mod('feature_3_desc', __('Fully responsive design that works perfectly on all devices and screen sizes.', 'modernbiz-pro'))
                ),
                array(
                    'icon' => '⚡',
                    'title' => get_theme_mod('feature_4_title', __('24/7 Support', 'modernbiz-pro')),
                    'description' => get_theme_mod('feature_4_desc', __('Round-the-clock customer support to help you whenever you need assistance.', 'modernbiz-pro'))
                ),
                array(
                    'icon' => '🎯',
                    'title' => get_theme_mod('feature_5_title', __('Targeted Solutions', 'modernbiz-pro')),
                    'description' => get_theme_mod('feature_5_desc', __('Customized solutions designed specifically for your business requirements.', 'modernbiz-pro'))
                ),
                array(
                    'icon' => '💼',
                    'title' => get_theme_mod('feature_6_title', __('Professional Team', 'modernbiz-pro')),
                    'description' => get_theme_mod('feature_6_desc', __('Experienced professionals dedicated to delivering exceptional results.', 'modernbiz-pro'))
                )
            );

            foreach ($features as $index => $feature) :
                ?>
                <div class="card fade-in" data-delay="<?php echo $index * 100; ?>">
                    <div class="card-icon"><?php echo $feature['icon']; ?></div>
                    <h3 class="card-title"><?php echo esc_html($feature['title']); ?></h3>
                    <p><?php echo esc_html($feature['description']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="section services-section" id="services" style="background-color: var(--bg-secondary);">
    <div class="container">
        <div class="section-header fade-in">
            <h2 class="section-title"><?php echo esc_html(get_theme_mod('services_title', __('Our Services', 'modernbiz-pro'))); ?></h2>
            <p class="section-subtitle"><?php echo esc_html(get_theme_mod('services_subtitle', __('Comprehensive solutions to help your business grow and succeed', 'modernbiz-pro'))); ?></p>
        </div>

        <div class="grid grid-2">
            <?php
            $services = array(
                array(
                    'icon' => '💻',
                    'title' => get_theme_mod('service_1_title', __('Web Development', 'modernbiz-pro')),
                    'description' => get_theme_mod('service_1_desc', __('Custom web development solutions using the latest technologies and best practices.', 'modernbiz-pro'))
                ),
                array(
                    'icon' => '📊',
                    'title' => get_theme_mod('service_2_title', __('Digital Marketing', 'modernbiz-pro')),
                    'description' => get_theme_mod('service_2_desc', __('Strategic digital marketing campaigns to boost your online presence and reach.', 'modernbiz-pro'))
                ),
                array(
                    'icon' => '🎨',
                    'title' => get_theme_mod('service_3_title', __('UI/UX Design', 'modernbiz-pro')),
                    'description' => get_theme_mod('service_3_desc', __('Beautiful and intuitive user interface designs that enhance user experience.', 'modernbiz-pro'))
                ),
                array(
                    'icon' => '🔧',
                    'title' => get_theme_mod('service_4_title', __('Technical Support', 'modernbiz-pro')),
                    'description' => get_theme_mod('service_4_desc', __('Comprehensive technical support and maintenance services for your systems.', 'modernbiz-pro'))
                )
            );

            foreach ($services as $index => $service) :
                ?>
                <div class="card fade-in" data-delay="<?php echo $index * 150; ?>">
                    <div class="card-icon"><?php echo $service['icon']; ?></div>
                    <h3 class="card-title"><?php echo esc_html($service['title']); ?></h3>
                    <p><?php echo esc_html($service['description']); ?></p>
                    <a href="#" class="btn btn-secondary"><?php esc_html_e('Learn More', 'modernbiz-pro'); ?></a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="section about-section" id="about">
    <div class="container">
        <div class="grid grid-2" style="align-items: center;">
            <div class="about-content fade-in">
                <h2><?php echo esc_html(get_theme_mod('about_title', __('About Our Company', 'modernbiz-pro'))); ?></h2>
                <p><?php echo esc_html(get_theme_mod('about_description', __('We are a leading company in our industry, committed to providing exceptional services and innovative solutions. With years of experience and a dedicated team of professionals, we help businesses achieve their goals and reach new heights of success.', 'modernbiz-pro'))); ?></p>
                
                <div class="stats-grid grid grid-2" style="margin-top: 2rem;">
                    <div class="stat-item">
                        <h3><?php echo esc_html(get_theme_mod('stat_1_number', '500+')); ?></h3>
                        <p><?php echo esc_html(get_theme_mod('stat_1_label', __('Happy Clients', 'modernbiz-pro'))); ?></p>
                    </div>
                    <div class="stat-item">
                        <h3><?php echo esc_html(get_theme_mod('stat_2_number', '1000+')); ?></h3>
                        <p><?php echo esc_html(get_theme_mod('stat_2_label', __('Projects Completed', 'modernbiz-pro'))); ?></p>
                    </div>
                    <div class="stat-item">
                        <h3><?php echo esc_html(get_theme_mod('stat_3_number', '10+')); ?></h3>
                        <p><?php echo esc_html(get_theme_mod('stat_3_label', __('Years Experience', 'modernbiz-pro'))); ?></p>
                    </div>
                    <div class="stat-item">
                        <h3><?php echo esc_html(get_theme_mod('stat_4_number', '24/7')); ?></h3>
                        <p><?php echo esc_html(get_theme_mod('stat_4_label', __('Support Available', 'modernbiz-pro'))); ?></p>
                    </div>
                </div>

                <a href="<?php echo esc_url(get_theme_mod('about_button_url', '#contact')); ?>" class="btn btn-primary" style="margin-top: 2rem;">
                    <?php echo esc_html(get_theme_mod('about_button_text', __('Get Started', 'modernbiz-pro'))); ?>
                </a>
            </div>

            <div class="about-image fade-in" data-delay="200">
                <?php
                $about_image = get_theme_mod('about_image', '');
                if ($about_image) :
                    ?>
                    <img src="<?php echo esc_url($about_image); ?>" alt="<?php esc_attr_e('About us', 'modernbiz-pro'); ?>" class="img-responsive">
                <?php else : ?>
                    <div class="placeholder-image" style="background: linear-gradient(135deg, var(--primary-color), var(--accent-color)); height: 400px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem;">
                        <?php esc_html_e('About Image Placeholder', 'modernbiz-pro'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="section testimonials-section" style="background-color: var(--bg-secondary);">
    <div class="container">
        <div class="section-header fade-in">
            <h2 class="section-title"><?php echo esc_html(get_theme_mod('testimonials_title', __('What Our Clients Say', 'modernbiz-pro'))); ?></h2>
            <p class="section-subtitle"><?php echo esc_html(get_theme_mod('testimonials_subtitle', __('Don\'t just take our word for it - hear from our satisfied clients', 'modernbiz-pro'))); ?></p>
        </div>

        <div class="grid grid-3">
            <?php
            $testimonials = array(
                array(
                    'content' => get_theme_mod('testimonial_1_content', __('Excellent service and professional team. They delivered exactly what we needed on time and within budget.', 'modernbiz-pro')),
                    'name' => get_theme_mod('testimonial_1_name', __('John Smith', 'modernbiz-pro')),
                    'position' => get_theme_mod('testimonial_1_position', __('CEO, Tech Corp', 'modernbiz-pro'))
                ),
                array(
                    'content' => get_theme_mod('testimonial_2_content', __('Outstanding results and great communication throughout the project. Highly recommended!', 'modernbiz-pro')),
                    'name' => get_theme_mod('testimonial_2_name', __('Sarah Johnson', 'modernbiz-pro')),
                    'position' => get_theme_mod('testimonial_2_position', __('Marketing Director', 'modernbiz-pro'))
                ),
                array(
                    'content' => get_theme_mod('testimonial_3_content', __('Professional, reliable, and innovative. They exceeded our expectations in every way.', 'modernbiz-pro')),
                    'name' => get_theme_mod('testimonial_3_name', __('Michael Brown', 'modernbiz-pro')),
                    'position' => get_theme_mod('testimonial_3_position', __('Founder, StartupXYZ', 'modernbiz-pro'))
                )
            );

            foreach ($testimonials as $index => $testimonial) :
                ?>
                <div class="card testimonial-card fade-in" data-delay="<?php echo $index * 100; ?>">
                    <div class="testimonial-content">
                        <p>"<?php echo esc_html($testimonial['content']); ?>"</p>
                    </div>
                    <div class="testimonial-author">
                        <h4><?php echo esc_html($testimonial['name']); ?></h4>
                        <p><?php echo esc_html($testimonial['position']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="section contact-section" id="contact">
    <div class="container">
        <div class="section-header fade-in">
            <h2 class="section-title"><?php echo esc_html(get_theme_mod('contact_title', __('Get In Touch', 'modernbiz-pro'))); ?></h2>
            <p class="section-subtitle"><?php echo esc_html(get_theme_mod('contact_subtitle', __('Ready to start your project? Contact us today for a free consultation', 'modernbiz-pro'))); ?></p>
        </div>

        <div class="grid grid-2">
            <div class="contact-info fade-in">
                <h3><?php esc_html_e('Contact Information', 'modernbiz-pro'); ?></h3>
                
                <div class="contact-item">
                    <div class="contact-icon">📍</div>
                    <div class="contact-details">
                        <h4><?php esc_html_e('Address', 'modernbiz-pro'); ?></h4>
                        <p><?php echo esc_html(get_theme_mod('contact_address', __('123 Business Street, City, State 12345', 'modernbiz-pro'))); ?></p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">📞</div>
                    <div class="contact-details">
                        <h4><?php esc_html_e('Phone', 'modernbiz-pro'); ?></h4>
                        <p><a href="tel:<?php echo esc_attr(get_theme_mod('contact_phone', '+1 (555) 123-4567')); ?>"><?php echo esc_html(get_theme_mod('contact_phone', '+1 (555) 123-4567')); ?></a></p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">✉️</div>
                    <div class="contact-details">
                        <h4><?php esc_html_e('Email', 'modernbiz-pro'); ?></h4>
                        <p><a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email', 'info@example.com')); ?>"><?php echo esc_html(get_theme_mod('contact_email', 'info@example.com')); ?></a></p>
                    </div>
                </div>
            </div>

            <div class="contact-form fade-in" data-delay="200">
                <form class="contact-form-element" action="#" method="post">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="<?php esc_attr_e('Your Name', 'modernbiz-pro'); ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="<?php esc_attr_e('Your Email', 'modernbiz-pro'); ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject" placeholder="<?php esc_attr_e('Subject', 'modernbiz-pro'); ?>" required>
                    </div>
                    <div class="form-group">
                        <textarea name="message" rows="5" placeholder="<?php esc_attr_e('Your Message', 'modernbiz-pro'); ?>" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <?php esc_html_e('Send Message', 'modernbiz-pro'); ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

