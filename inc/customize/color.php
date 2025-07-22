<?php
if (!function_exists('hs_first_agency_customizer_colors')) {
    add_action('customize_register', 'hs_first_agency_customizer_colors');
    function hs_first_agency_customizer_colors($wp_customize)
    {
        get_template_part('/inc/customize/class/customizer');
        $customizer = new hs_first_agency_Customizer($wp_customize);

        $customizer->AddSection('hs_first_agency_colors', __('Colors', 'hs-first-agency'), 'hs_first_agency_settings_pannel');

        $customizer->AddControl(
            array(
                'id' => 'hs_first_agency_primary_color',
                'default' => hs_first_agency_Theme_Class::$primaryColor,
                'title' => __('Primary Color', 'hs-first-agency'),
                'section_id' => 'hs_first_agency_colors'
            ),
            hs_first_agency_Customizer::$COLOR
        );

        $customizer->AddControl(
            array(
                'id' => 'hs_first_agency_primary_dark_color',
                'default' => hs_first_agency_Theme_Class::$primaryColorDark,
                'title' => __('Primary Dark Color', 'hs-first-agency'),
                'section_id' => 'hs_first_agency_colors'
            ),
            hs_first_agency_Customizer::$COLOR
        );

        $customizer->AddControl(
            array(
                'id' => 'hs_first_agency_primary_light_color',
                'default' => hs_first_agency_Theme_Class::$primaryColorLight,
                'title' => __('Primary Light Color', 'hs-first-agency'),
                'section_id' => 'hs_first_agency_colors'
            ),
            hs_first_agency_Customizer::$COLOR
        );

        $customizer->AddControl(
            array(
                'id' => 'hs_first_agency_header_color',
                'default' => hs_first_agency_Theme_Class::$headingColor,
                'title' => __('Heading (h1 - h6) Color', 'hs-first-agency'),
                'section_id' => 'hs_first_agency_colors'
            ),
            hs_first_agency_Customizer::$COLOR
        );

        $customizer->AddControl(
            array(
                'id' => 'hs_first_agency_text_color',
                'default' => hs_first_agency_Theme_Class::$textColor,
                'title' => __('Text Color', 'hs-first-agency'),
                'section_id' => 'hs_first_agency_colors'
            ),
            hs_first_agency_Customizer::$COLOR
        );

        $customizer->AddControl(
            array(
                'id' => 'hs_first_agency_secondary_color',
                'default' => hs_first_agency_Theme_Class::$secondaryColor,
                'title' => __('secondary Color', 'hs-first-agency'),
                'section_id' => 'hs_first_agency_colors'
            ),
            hs_first_agency_Customizer::$COLOR
        );

        $customizer->AddControl(
            array(
                'id' => 'hs_first_agency_secondary_color',
                'default' => hs_first_agency_Theme_Class::$secondaryColor,
                'title' => __('Secondary Color', 'hs-first-agency'),
                'section_id' => 'hs_first_agency_colors'
            ),
            hs_first_agency_Customizer::$COLOR
        );

        $customizer->AddControl(
            array(
                'id' => 'hs_first_agency_site_name_color',
                'default' => hs_first_agency_Theme_Class::$primaryColor,
                'title' => __('Site Name Color', 'hs-first-agency'),
                'section_id' => 'hs_first_agency_colors'
            ),
            hs_first_agency_Customizer::$COLOR
        );

        $customizer->AddControl(
            array(
                'id' => 'hs_first_agency_colors_get_pro',
                'title' => __('Get Premium', 'hs-first-agency'),
                'description' => __('For more options, get the premium version.', 'hs-first-agency'),
                'link' => 'https://honarsystems.com/first-agency/',
                'section_id' => 'hs_first_agency_colors',
            ),
            hs_first_agency_Customizer::$GETPROBUTTON
        );
    }
}

if (!function_exists('hs_first_agency_customizer_colors_style')) {
    add_action('wp_head', 'hs_first_agency_customizer_colors_style');
    function hs_first_agency_customizer_colors_style()
    {
?>
        <style type="text/css">
            :root {
                --first-agency-primary-color: <?php echo esc_attr(get_theme_mod('hs_first_agency_primary_color', hs_first_agency_Theme_Class::$primaryColor)); ?>;
                --first-agency-primary-dark-color: <?php echo esc_attr(get_theme_mod('hs_first_agency_primary_dark_color', hs_first_agency_Theme_Class::$primaryColorDark)); ?>;
                --first-agency-primary-light-color: <?php echo esc_attr(get_theme_mod('hs_first_agency_primary_light_color', hs_first_agency_Theme_Class::$primaryColorLight)); ?>;
                --first-agency-heading-color: <?php echo esc_attr(get_theme_mod('hs_first_agency_header_color', hs_first_agency_Theme_Class::$headingColor)); ?>;
                --first-agency-text-color: <?php echo esc_attr(get_theme_mod('hs_first_agency_text_color', hs_first_agency_Theme_Class::$textColor)); ?>;
                --first-agency-background-color: #<?php echo esc_attr(get_background_color()); ?>;
                --first-agency-secondary-color: <?php echo esc_attr(get_theme_mod('hs_first_agency_secondary_color', hs_first_agency_Theme_Class::$secondaryColor)); ?>;
                --first-agency-site-name-color: <?php echo esc_attr(get_theme_mod('hs_first_agency_site_name_color', hs_first_agency_Theme_Class::$primaryColor)); ?>;
            }
        </style>
<?php
    }
}
