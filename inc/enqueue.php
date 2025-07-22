<?php
/**
 * Enqueue scripts and styles.
 */
if (!function_exists('hs_first_agency_enqueue_scripts')) {
    add_action('wp_enqueue_scripts', 'hs_first_agency_enqueue_scripts');
    function hs_first_agency_enqueue_scripts()
    {
        //enqueue style
        wp_enqueue_style(
            'first-agency-style',
            get_stylesheet_uri(),
            [],
            null
        );

        //enqueue default style
        wp_enqueue_style('first-agency-main-style', esc_url(get_template_directory_uri() . '/assets/css/style.css'), array('first-agency-style'), null);

        //enqueue tailwind
        wp_enqueue_script(
            'tailwind-script',
            esc_url(get_template_directory_uri() . '/assets/js/tailwind.min.js'),
            [],
            wp_get_theme()->get('Version'),
            false
        );

        //enqueue google font
        $google_font = get_theme_mod('hs_first_agency_google_font', 'https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap');
        if (!empty($google_font)) {
            wp_enqueue_style(
                'first-agency-google-font',
                esc_url($google_font),
                false
            );
        }

        $second_google_font = get_theme_mod('hs_first_agency_second_google_font', 'https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap');
        if (!empty($second_google_font)) {
            wp_enqueue_style(
                'first-agency-custom-google-font',
                esc_url($second_google_font),
                false
            );
        }

        //enqueue script
        wp_enqueue_script(
            'first-agency-script',
            esc_url(get_template_directory_uri() . '/assets/js/custom.js'),
            ['jquery'],
            wp_get_theme()->get('Version'),
            true
        );

        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }

        //add dash icons
        wp_enqueue_style('dashicons');
    }
}
