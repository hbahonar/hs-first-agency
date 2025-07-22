<?php
if (!function_exists('hs_first_agency_customizer_copyright')) {
    add_action('customize_register', 'hs_first_agency_customizer_copyright');
    function hs_first_agency_customizer_copyright($wp_customize)
    {
        get_template_part('/inc/customize/class/customizer');
        $customizer = new hs_first_agency_Customizer($wp_customize);

        $customizer->AddSection('hs_first_agency_copyright', __('Copyright', 'hs-first-agency'), 'hs_first_agency_settings_pannel');

        $customizer->AddControl(
            array(
                'id' => 'hs_first_agency_copyright_bg_color',
                'default' => hs_first_agency_Theme_Class::$headingColor,
                'title' => __('Background Color', 'hs-first-agency'),
                'section_id' => 'hs_first_agency_copyright'
            ),
            hs_first_agency_Customizer::$COLOR
        );

        $customizer->AddControl(
            array(
                'id' => 'hs_first_agency_copyright_text_color',
                'default' => '#DDDDDD',
                'title' => __('Text Color', 'hs-first-agency'),
                'section_id' => 'hs_first_agency_copyright'
            ),
            hs_first_agency_Customizer::$COLOR
        );

        $customizer->AddControl(
            array(
                'id' => 'hs_first_agency_copyright_text',
                'default' => '© {year} {site_name}',
                'title' => __('Copyright Text', 'hs-first-agency'),
                'description' => __('Add text and HTML code to display in Copyright section. Add "{site_name}" to display website name, "{description}" to display website description or "{year}" to display current year.', 'hs-first-agency'),
                'section_id' => 'hs_first_agency_copyright'
            ),
            hs_first_agency_Customizer::$TEXTAREA
        );

        $customizer->AddControl(
            array(
                'id' => 'hs_first_agency_copyright_get_pro',
                'title' => __('Get Premium', 'hs-first-agency'),
                'description' => __('For more options, get the premium version.', 'hs-first-agency'),
                'link' => 'https://honarsystems.com/first-agency/',
                'section_id' => 'hs_first_agency_copyright',
            ),
            hs_first_agency_Customizer::$GETPROBUTTON
        );
    }
}

if (!function_exists('hs_first_agency_customizer_copyright_style')) {
    add_action('wp_head', 'hs_first_agency_customizer_copyright_style');
    function hs_first_agency_customizer_copyright_style()
    {
?>
        <style type="text/css">
            .site-copyright {
                background: <?php echo esc_attr(get_theme_mod('hs_first_agency_copyright_bg_color', hs_first_agency_Theme_Class::$headingColor)); ?>;
                color: <?php echo esc_attr(get_theme_mod('hs_first_agency_copyright_text_color', '#DDDDDD')); ?>;
            }
        </style>
<?php
    }
}
