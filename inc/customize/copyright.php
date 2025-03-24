<?php
add_action('customize_register', function ($wp_customize) {
    get_template_part('/inc/customize/class/customizer');
    $customizer = new BHR_Customizer($wp_customize);

    $customizer->AddSection('first_agency_copyright', __('Copyright', 'hs-first-agency'), 'first_agency_settings_pannel');

    $customizer->AddControl(
        array(
            'id' => 'first_agency_copyright_bg_color',
            'default' => BHR_Theme_Class::$headingColor,
            'title' => __('Background Color', 'hs-first-agency'),
            'section_id' => 'first_agency_copyright'
        ),
        BHR_Customizer::$COLOR
    );

    $customizer->AddControl(
        array(
            'id' => 'first_agency_copyright_text_color',
            'default' => '#DDDDDD',
            'title' => __('Text Color', 'hs-first-agency'),
            'section_id' => 'first_agency_copyright'
        ),
        BHR_Customizer::$COLOR
    );

    $customizer->AddControl(
        array(
            'id' => 'first_agency_copyright_text',
            'default' => '© {year} {site_name}',
            'title' => __('Copyright Text', 'hs-first-agency'),
            'description' => __('Add text and HTML code to display in Copyright section. Add "{site_name}" to display website name, "{description}" to display website description or "{year}" to display current year.', 'hs-first-agency'),
            'section_id' => 'first_agency_copyright'
        ),
        BHR_Customizer::$TEXTAREA
    );

    $customizer->AddControl(
        array(
            'id' => 'first_agency_copyright_get_pro',
            'title' => __('Get Premium', 'hs-first-agency'),
            'description' => __('For more options, get the premium version.', 'hs-first-agency'),
            'link' => 'https://honarsystems.com/first-agency/',
            'section_id' => 'first_agency_copyright',
        ),
        BHR_Customizer::$GETPROBUTTON
    );
});

add_action('wp_head', function () {
?>
    <style type="text/css">
        .site-copyright {
            background: <?php echo esc_attr(get_theme_mod('first_agency_copyright_bg_color', BHR_Theme_Class::$headingColor)); ?>;
            color: <?php echo esc_attr(get_theme_mod('first_agency_copyright_text_color', '#DDDDDD')); ?>;
        }
    </style>
<?php
});
