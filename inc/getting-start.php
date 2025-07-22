<?php

/*******************************************************************************
 *  Get Started Notice
 *******************************************************************************/
if (!function_exists('hs_first_agency_add_get_started_admin_enqueue_scripts')) {
    add_action('admin_enqueue_scripts', 'hs_first_agency_add_get_started_admin_enqueue_scripts');
    function hs_first_agency_add_get_started_admin_enqueue_scripts()
    {
        wp_enqueue_script('first-agency-dismiss-js', get_template_directory_uri() . '/assets/js/notice-dismiss.js', array('jquery-core'), false, true);
        wp_localize_script('first-agency-dismiss-js', 'hs_first_agency_ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
    }
}
if (!function_exists('hs_first_agency_dismiss_notice_on_click')) {
    add_action('wp_ajax_hs_first_agency_dismiss_notice_on_click', 'hs_first_agency_dismiss_notice_on_click');
    function hs_first_agency_dismiss_notice_on_click()
    {
        // if (isset($_GET['hs_first_agency_notice_dismissed']) && $_GET['hs_first_agency_notice_dismissed'] == '1') {
        $user_id = get_current_user_id();
        update_user_meta($user_id, 'hs_first_agency_notice_dismissed', 1);
        // }
    }
}

if (!function_exists('hs_first_agency_getting_start_admin_notices')) {
    add_action('admin_notices', 'hs_first_agency_getting_start_admin_notices');
    function hs_first_agency_getting_start_admin_notices()
    {
        $user_id = get_current_user_id();
        if (! get_user_meta($user_id, 'hs_first_agency_notice_dismissed')) {
?>
            <div class="updated notice notice-get-started-class is-dismissible" data-notice="get_started">
                <div class="first-agency-getting-started-notice clearfix">
                    <div class="first-agency-theme-screenshot">
                        <img src="<?php echo esc_url(wp_get_theme()->get_screenshot()); ?>" class="screenshot" alt="<?php esc_attr_e('Theme Screenshot', 'hs-first-agency'); ?>" style="max-width:200px;" />
                    </div><!-- /.first-agency-theme-screenshot -->
                    <div class="first-agency-theme-notice-content">
                        <h2 class="first-agency-notice-h2">
                            <?php
                            printf(
                                /* translators: 1: welcome page link starting html tag, 2: welcome page link ending html tag. */
                                esc_html__('Welcome! Thank you for choosing %1$s!', 'hs-first-agency'),
                                '<strong>' . esc_html(wp_get_theme()->get('Name')) . '</strong>'
                            );
                            ?>
                        </h2>

                        <a class="first-agency-btn-get-started button button-primary button-hero first-agency-button-padding" href="<?php echo esc_url(admin_url("admin.php?page=hs_first_agency__welcome")); ?>" data-name="" data-slug=""><?php esc_html_e('Get started with First Agency', 'hs-first-agency') ?></a><span class="first-agency-push-down">
                            <?php
                            /* translators: %1$s: Anchor link start %2$s: Anchor link end */
                            printf(
                                ' %1$sCustomize theme%2$s</a></span>',
                                '<a target="_blank" href="' . esc_url(admin_url('customize.php')) . '" class="button button-primary button-hero">',
                                '</a>'
                            );
                            ?>
                    </div><!-- /.first-agency-theme-notice-content -->
                </div>
            </div>
<?php
        }
    }
}
