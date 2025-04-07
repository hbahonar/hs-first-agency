<?php
if (!function_exists('first_agency_customizer_footer')) {
    add_action('customize_register', 'first_agency_customizer_footer');
    function first_agency_customizer_footer($wp_customize)
    {
        get_template_part('/inc/customize/class/customizer');
        $customizer = new first_agency_Customizer($wp_customize);

        $customizer->AddSection('first_agency_footer', __('Footer', 'hs-first-agency'), 'first_agency_settings_pannel');

        $customizer->AddControl(
            array(
                'id' => 'first_agency_footer_columns',
                'default' => '1',
                'title' => __('Column Count', 'hs-first-agency'),
                'section_id' => 'first_agency_footer',
                'options' => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                )
            ),
            first_agency_Customizer::$SELECT
        );

        $customizer->AddControl(
            array(
                'id' => 'first_agency_footer_bg_color',
                'default' => first_agency_Theme_Class::$headingColor,
                'title' => __('Background Color', 'hs-first-agency'),
                'section_id' => 'first_agency_footer'
            ),
            first_agency_Customizer::$COLOR
        );

        $customizer->AddControl(
            array(
                'id' => 'first_agency_footer_text_color',
                'default' => '#DDDDDD',
                'title' => __('Text Color', 'hs-first-agency'),
                'section_id' => 'first_agency_footer'
            ),
            first_agency_Customizer::$COLOR
        );

        $customizer->AddControl(
            array(
                'id' => 'first_agency_footer_link_color',
                'default' => '#FFFFFF',
                'title' => __('Link Color', 'hs-first-agency'),
                'section_id' => 'first_agency_footer'
            ),
            first_agency_Customizer::$COLOR
        );

        $customizer->AddControl(
            array(
                'id' => 'first_agency_footer_link_hover_color',
                'default' => '#DDDDDD',
                'title' => __('Link Hover Color', 'hs-first-agency'),
                'section_id' => 'first_agency_footer'
            ),
            first_agency_Customizer::$COLOR
        );

        $customizer->AddControl(
            array(
                'id' => 'first_agency_footer_get_pro',
                'title' => __('Get Premium', 'hs-first-agency'),
                'description' => __('For more options, get the premium version.', 'hs-first-agency'),
                'link' => 'https://honarsystems.com/first-agency/',
                'section_id' => 'first_agency_footer',
            ),
            first_agency_Customizer::$GETPROBUTTON
        );
    }
}

if (!function_exists('first_agency_customizer_footer_style')) {
    add_action('wp_head', 'first_agency_customizer_footer_style');
    function first_agency_customizer_footer_style()
    {
?>
        <style type="text/css">
            .site-footer svg,
            .site-footer {
                background: <?php echo esc_attr(get_theme_mod('first_agency_footer_bg_color', first_agency_Theme_Class::$headingColor)); ?>;
                color: <?php echo esc_attr(get_theme_mod('first_agency_footer_text_color', '#DDDDDD')); ?>;
                fill: <?php echo esc_attr(get_theme_mod('first_agency_footer_text_color', '#DDDDDD')); ?>;
            }

            .site-footer .widget-title,
            .site-footer .widget-title svg,
            .site-footer .widget h1,
            .site-footer .widget h2,
            .site-footer .widget h3,
            .site-footer .widget h4,
            .site-footer .widget h5,
            .site-footer .widget h6 {
                color: <?php echo esc_attr(get_theme_mod('first_agency_footer_widget_title_color', '#FFFFFF')); ?>;
                fill: <?php echo esc_attr(get_theme_mod('first_agency_footer_widget_title_color', '#FFFFFF')); ?>;
            }

            .site-footer a svg,
            .site-footer a {
                color: <?php echo esc_attr(get_theme_mod('first_agency_footer_link_color', '#FFFFFF')); ?>;
            }

            .site-footer a:hover svg,
            .site-footer a:hover {
                color: <?php echo esc_attr(get_theme_mod('first_agency_footer_link_hover_color', '#DDDDDD')); ?>;
            }
        </style>
<?php
    }
}
