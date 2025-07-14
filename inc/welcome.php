<?php

if (!function_exists('first_agency_add_admin_menu')) {
    function first_agency_add_admin_menu()
    {
        add_theme_page(
            __('First Agency', 'hs-first-agency'),
            __('First Agency', 'hs-first-agency'),
            'edit_theme_options',
            'first_agency_welcome',
            'first_agency_welcome_page_contents'
        );
    }
    add_action('admin_menu', 'first_agency_add_admin_menu');

    if (!function_exists('first_agency_add_welcome_admin_enqueue_scripts')) {
        function first_agency_add_welcome_admin_enqueue_scripts($hook)
        {
            wp_enqueue_style('first-agency-admin-css', get_template_directory_uri() . '/assets/css/admin.css', array(), '1');
        }
        add_action('admin_enqueue_scripts', 'first_agency_add_welcome_admin_enqueue_scripts');
    }

    if (!function_exists('first_agency_welcome_page_contents')) {
        function first_agency_welcome_page_contents()
        {
?>

            <div class="first-agency-welcome">
                <h1>
                    <?php esc_html_e('Welcome to First Agency WordPress Theme', 'hs-first-agency'); ?>
                    <span class="theme-version"><?php echo 'v' . esc_html(wp_get_theme()->version); ?></span>
                </h1>
                <p><?php echo esc_html(wp_get_theme()->get('Description')); ?></p>
                <div class="items">
                    <div class="item">
                        <div class="inner-item">
                            <span class="dashicons dashicons-book-alt"></span>
                            <h2><?php esc_html_e('Documentation', 'hs-first-agency'); ?></h2>
                            <p><?php esc_html_e('First Agency theme documantation is available in First Agency host website.', 'hs-first-agency'); ?></p>
                            <a href="https://honarsystems.com/first-agency/" class="button button-primary" target="_blank">
                                <?php esc_html_e('Read Documentation', 'hs-first-agency'); ?>
                            </a>
                        </div>
                    </div>

                    <div class="item">
                        <div class="inner-item">
                            <span class="dashicons dashicons-admin-generic"></span>
                            <h2><?php esc_html_e('Theme Customization', 'hs-first-agency'); ?></h2>
                            <p><?php esc_html_e('First Agency theme has an awesome customizations.', 'hs-first-agency'); ?></p>
                            <a href="<?php echo esc_url(admin_url('customize.php')); ?>" class="button button-primary">
                                <?php esc_html_e('Start Customizing', 'hs-first-agency'); ?>
                            </a>
                        </div>
                    </div>

                    <div class="item">
                        <div class="inner-item">
                            <p><img src="<?php echo esc_url(wp_get_theme()->get_screenshot()); ?>" style="width:100%;max-width:400px;" /></p>
                            <p><?php esc_html_e('In demo website you can see the view of the website after installation the theme.', 'hs-first-agency'); ?></p>
                            <span class="first-agency-italic"></span>
                            <a href="http://honarsystems.com/theme/first-agency/" target="_blank" class="button button-primary">
                                <?php esc_html_e('Visit Preview', 'hs-first-agency'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
<?php
        }
    }
}
