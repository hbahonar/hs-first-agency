<?php
add_action('customize_register', function ($wp_customize) {
    get_template_part('/inc/customize/class/customizer');
    $customizer = new BHR_Customizer($wp_customize);

    $customizer->AddSection('first_agency_colors', __('Colors', 'hs-first-agency'), 'first_agency_settings_pannel');

    $customizer->AddControl(
        array(
            'id' => 'first_agency_primary_color',
            'default' => BHR_Theme_Class::$primaryColor,
            'title' => __('Primary Color', 'hs-first-agency'),
            'section_id' => 'first_agency_colors'
        ),
        BHR_Customizer::$COLOR
    );

    $customizer->AddControl(
        array(
            'id' => 'first_agency_primary_dark_color',
            'default' => BHR_Theme_Class::$primaryColorDark,
            'title' => __('Primary Dark Color', 'hs-first-agency'),
            'section_id' => 'first_agency_colors'
        ),
        BHR_Customizer::$COLOR
    );

    $customizer->AddControl(
        array(
            'id' => 'first_agency_primary_light_color',
            'default' => BHR_Theme_Class::$primaryColorLight,
            'title' => __('Primary Light Color', 'hs-first-agency'),
            'section_id' => 'first_agency_colors'
        ),
        BHR_Customizer::$COLOR
    );

    $customizer->AddControl(
        array(
            'id' => 'first_agency_header_color',
            'default' => BHR_Theme_Class::$headingColor,
            'title' => __('Heading (h1 - h6) Color', 'hs-first-agency'),
            'section_id' => 'first_agency_colors'
        ),
        BHR_Customizer::$COLOR
    );

    $customizer->AddControl(
        array(
            'id' => 'first_agency_text_color',
            'default' => BHR_Theme_Class::$textColor,
            'title' => __('Text Color', 'hs-first-agency'),
            'section_id' => 'first_agency_colors'
        ),
        BHR_Customizer::$COLOR
    );

    $customizer->AddControl(
        array(
            'id' => 'first_agency_secondary_color',
            'default' => BHR_Theme_Class::$secondaryColor,
            'title' => __('secondary Color', 'hs-first-agency'),
            'section_id' => 'first_agency_colors'
        ),
        BHR_Customizer::$COLOR
    );

    $customizer->AddControl(
        array(
            'id' => 'first_agency_secondary_color',
            'default' => BHR_Theme_Class::$secondaryColor,
            'title' => __('Secondary Color', 'hs-first-agency'),
            'section_id' => 'first_agency_colors'
        ),
        BHR_Customizer::$COLOR
    );

    $customizer->AddControl(
        array(
            'id' => 'first_agency_site_name_color',
            'default' => BHR_Theme_Class::$primaryColor,
            'title' => __('Site Name Color', 'hs-first-agency'),
            'section_id' => 'first_agency_colors'
        ),
        BHR_Customizer::$COLOR
    );

    $customizer->AddControl(
        array(
            'id' => 'first_agency_colors_get_pro',
            'title' => __('Get Premium', 'hs-first-agency'),
            'description' => __('For more options, get the premium version.', 'hs-first-agency'),
            'link' => 'https://honarsystems.com/first-agency/',
            'section_id' => 'first_agency_colors',
        ),
        BHR_Customizer::$GETPROBUTTON
    );
});

add_action('wp_head', function () {
?>
    <style type="text/css">
        :root {
            --first-agency-primary-color: <?php echo esc_attr(get_theme_mod('first_agency_primary_color', BHR_Theme_Class::$primaryColor)); ?>;
            --first-agency-primary-dark-color: <?php echo esc_attr(get_theme_mod('first_agency_primary_dark_color', BHR_Theme_Class::$primaryColorDark)); ?>;
            --first-agency-primary-light-color: <?php echo esc_attr(get_theme_mod('first_agency_primary_light_color', BHR_Theme_Class::$primaryColorLight)); ?>;
            --first-agency-heading-color: <?php echo esc_attr(get_theme_mod('first_agency_header_color', BHR_Theme_Class::$headingColor)); ?>;
            --first-agency-text-color: <?php echo esc_attr(get_theme_mod('first_agency_text_color', BHR_Theme_Class::$textColor)); ?>;
            --first-agency-background-color: #<?php echo esc_attr(get_background_color()); ?>;
            --first-agency-secondary-color: <?php echo esc_attr(get_theme_mod('first_agency_secondary_color', BHR_Theme_Class::$secondaryColor)); ?>;
            --first-agency-site-name-color: <?php echo esc_attr(get_theme_mod('first_agency_site_name_color', BHR_Theme_Class::$primaryColor)); ?>;
        }
    </style>
<?php
});
