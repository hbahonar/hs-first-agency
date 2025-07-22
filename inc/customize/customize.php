<?php

/**
 * @package WordPress
 */
if (!function_exists('hs_first_agency_customize_controls_enqueue_scripts')) {
    add_action('customize_controls_enqueue_scripts', 'hs_first_agency_customize_controls_enqueue_scripts');
    function hs_first_agency_customize_controls_enqueue_scripts()
    {
        wp_enqueue_script('first-agency-customize-controls-toggle', get_template_directory_uri() . '/inc/customize/assets/customize-controls-toggle.js', array('jquery', 'customize-preview'), '1.30', true);
    }
}

if (!function_exists('hs_first_agency_customize_register_settings_pannel')) {
    add_action('customize_register', 'hs_first_agency_customize_register_settings_pannel');
    function hs_first_agency_customize_register_settings_pannel($wp_customize)
    {
        $wp_customize->add_panel('hs_first_agency_settings_pannel', array(
            'priority' => 10,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => hs_first_agency_Theme_Class::$theme_name . ' Customization',
            'description' => '',
        ));
    }

    get_template_part('/inc/customize/color');
    get_template_part('/inc/customize/typography');
    get_template_part('/inc/customize/header');
    get_template_part('/inc/customize/archive');
    get_template_part('/inc/customize/sidebar');
    get_template_part('/inc/customize/footer');
    get_template_part('/inc/customize/copyright');
    get_template_part('/inc/customize/button');
}
