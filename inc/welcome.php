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
            if ($hook != 'toplevel_page_first_agency_welcome') {
                return;
            }

            wp_enqueue_style('first-agency-admin-css', get_template_directory_uri() . '/assets/css/admin.css', array(), '1');

            wp_enqueue_script('admin-js', get_template_directory_uri() . '/assets/js/admin.js', array('jquery-core'), false, true);
            wp_localize_script('admin-js', 'first_agency_ajax_object', array('ajax_url' => admin_url('admin-ajax.php'), 'one_demo_import_url' => esc_url(admin_url("themes.php?page=one-click-demo-import")), 'button_text' => esc_html__('Import Demo', 'hs-first-agency')));
        }
        add_action('admin_enqueue_scripts', 'first_agency_add_welcome_admin_enqueue_scripts');
    }

    /* Ajax On Click Demo Importer action */
    if (!function_exists('first_agency_one_demo_import_installer')) {
        function first_agency_one_demo_import_installer()
        {
            $args = array(
                'path' => ABSPATH . 'wp-content/plugins/',
                'preserve_zip' => false
            );

            $url = 'https://downloads.wordpress.org/plugin/one-click-demo-import.3.3.0.zip';
            $plugin_name = 'one-click-demo-import';
            $path = $args['path'] . $plugin_name . '.zip';

            //download One Click Demo Import
            if (! function_exists('download_url')) {
                require_once ABSPATH . 'wp-admin/includes/file.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
            }

            $tmp_file = download_url($url);
            copy($tmp_file, $path);
            unlink($tmp_file);

            //Unzip One Demo Click Import
            global $wp_filesystem;
            if (! $wp_filesystem) {
                WP_Filesystem();
            }
            $unzipfile = unzip_file($path, $args['path']);

            if ($unzipfile) {
                unlink($path);
            }

            // //Active One Click Demo Import
            $current = get_option('active_plugins');
            $plugin = plugin_basename(trim('one-click-demo-import/one-click-demo-import.php'));

            if (!in_array($plugin, $current)) {
                $current[] = $plugin;
                sort($current);
                do_action('activate_plugin', trim($plugin));
                update_option('active_plugins', $current);
                do_action('activate_' . trim($plugin));
                do_action('activated_plugin', trim($plugin));
            }

            wp_die();
        }
        add_action('wp_ajax_first_agency_one_demo_import_installer', 'first_agency_one_demo_import_installer');
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
                    <?php if (!class_exists('OCDI_Plugin')) : ?>
                        <div class="first-agency-one-click-demo-import item">
                            <div class="inner-item">
                                <span class="dashicons dashicons-admin-plugins"></span>
                                <h2><?php esc_html_e('Install Required Plugin', 'hs-first-agency'); ?></h2>
                                <p><?php esc_html_e('Install "One Click Demo Import" plugin to import the demo templates.', 'hs-first-agency'); ?></p>
                                <span class="button button-primary" id="first-agency-one-click-demo-import">
                                    <span class="icn-spinner"></span>
                                    <?php esc_html_e('Install', 'hs-first-agency'); ?>
                                </span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="demo-content-import item">
                        <div class="inner-item">
                            <span class="dashicons dashicons-info"></span>
                            <h2><?php esc_html_e('Demo Content', 'hs-first-agency'); ?></h2>
                            <p><?php esc_html_e('Import demo content by "One Click Demo Import" plugin.', 'hs-first-agency'); ?></p>
                            <?php if (class_exists('OCDI_Plugin')) : ?>
                                <a href="<?php echo esc_url(admin_url("themes.php?page=one-click-demo-import")); ?>" class="button button-primary">
                                    <?php esc_html_e('Import Demo', 'hs-first-agency'); ?>
                                </a>
                            <?php else : ?>
                                <p class="err_msg"><?php esc_html_e('After installing the plugin from required plugin section, this option will be activated.', 'hs-first-agency'); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

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
