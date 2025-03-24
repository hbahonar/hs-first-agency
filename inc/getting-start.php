<?php

/*******************************************************************************
 *  Get Started Notice
 *******************************************************************************/

/**
 * AJAX handler to store the state of dismissible notices.
 */
add_action('wp_ajax_first_agency__dismissed_notice_handler', function () {
    update_option('dismissed-get_started', TRUE);
});

add_action('admin_notices', function () {
    // Check if it's been dismissed...
    if (! get_option('dismissed-get_started', FALSE)) {
        // Added the class "notice-get-started-class" so jQuery pick it up and pass via AJAX,
        // and added "data-notice" attribute in order to track multiple / different notices
        // multiple dismissible notice states 
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
                            '<strong>' . wp_get_theme()->get('Name') . '</strong>'
                        );
                        ?>
                    </h2>

                    <a class="first-agency-btn-get-started button button-primary button-hero first-agency-button-padding" href="<?php echo esc_url(admin_url("admin.php?page=first_agency__welcome")); ?>" data-name="" data-slug=""><?php esc_html_e('Get started with First Agency', 'hs-first-agency') ?></a><span class="first-agency-push-down">
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
<?php }
});
