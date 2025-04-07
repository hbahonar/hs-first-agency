<?php
if (!function_exists('first_agency_customizer_buttons')) {
    add_action('customize_register', 'first_agency_customizer_buttons');
    function first_agency_customizer_buttons($wp_customize)
    {
        get_template_part('/inc/customize/class/customizer');
        $customizer = new first_agency_Customizer($wp_customize);

        $customizer->AddSection('first_agency_buttons', __('Buttons', 'hs-first-agency'), 'first_agency_settings_pannel');

        $customizer->AddControl(
            array(
                'id' => 'first_agency_button_bg_color',
                'default' => first_agency_Theme_Class::$headingColor,
                'title' => __('Background Color', 'hs-first-agency'),
                'section_id' => 'first_agency_buttons'
            ),
            first_agency_Customizer::$COLOR
        );

        $customizer->AddControl(
            array(
                'id' => 'first_agency_button_text_color',
                'default' => '#FFFFFF',
                'title' => __('Text Color', 'hs-first-agency'),
                'section_id' => 'first_agency_buttons'
            ),
            first_agency_Customizer::$COLOR
        );

        $customizer->AddControl(
            array(
                'id' => 'first_agency_button_bg_hover_color',
                'default' => first_agency_Theme_Class::$headingColor,
                'title' => __('Background Hover Color', 'hs-first-agency'),
                'section_id' => 'first_agency_buttons'
            ),
            first_agency_Customizer::$COLOR
        );

        $customizer->AddControl(
            array(
                'id' => 'first_agency_button_text_hover_color',
                'default' => first_agency_Theme_Class::$secondaryColor,
                'title' => __('Text Hover Color', 'hs-first-agency'),
                'section_id' => 'first_agency_buttons'
            ),
            first_agency_Customizer::$COLOR
        );

        $customizer->AddControl(
            array(
                'id' => 'first_agency_buttons_get_pro',
                'title' => __('Get Premium', 'hs-first-agency'),
                'description' => __('For more options, get the premium version.', 'hs-first-agency'),
                'link' => 'https://honarsystems.com/first-agency/',
                'section_id' => 'first_agency_buttons',
            ),
            first_agency_Customizer::$GETPROBUTTON
        );
    }
}

if (!function_exists('first_agency_customizer_buttons_style')) {
    add_action('wp_head', 'first_agency_customizer_buttons_style');
    function first_agency_customizer_buttons_style()
    {
?>
        <style type="text/css">
            :root {
                --first-agency-button-background-color: <?php echo esc_attr(get_theme_mod('first_agency_button_bg_color', first_agency_Theme_Class::$headingColor)); ?>;
                --first-agency-button-text-color: <?php echo esc_attr(get_theme_mod('first_agency_button_text_color', '#FFFFFF')); ?>;
                --first-agency-button-background-hover-color: <?php echo esc_attr(get_theme_mod('first_agency_button_bg_hover_color', first_agency_Theme_Class::$headingColor)); ?>;
                --first-agency-button-text-hover-color: <?php echo esc_attr(get_theme_mod('first_agency_button_text_hover_color', first_agency_Theme_Class::$secondaryColor)); ?>;
            }
        </style>
<?php
    }
}
