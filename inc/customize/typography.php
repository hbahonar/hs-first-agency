<?php
if (!function_exists('first_agency_customizer_typography')) {
    add_action('customize_register', 'first_agency_customizer_typography');
    function first_agency_customizer_typography($wp_customize)
    {
        get_template_part('/inc/customize/class/customizer');
        $customizer = new first_agency_Customizer($wp_customize);

        $customizer->AddSection('first_agency_typography', __('Typography', 'hs-first-agency'), 'first_agency_settings_pannel');

        $customizer->AddControl(
            array(
                'id' => 'first_agency_google_font',
                'default' => 'https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap',
                'title' => __('Google Font URL', 'hs-first-agency'),
                'description' => sprintf(
                    '%1$s <a href="%2$s" target="_blank">%3$s</a> %4$s The url will be like "https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap". Copy url from google and past it in here.',
                    __('Insert', 'hs-first-agency'),
                    esc_url('https://www.google.com/fonts'),
                    __('Google Font URL', 'hs-first-agency'),
                    __('for embed fonts.', 'hs-first-agency')
                ),
                'section_id' => 'first_agency_typography'
            ),
            first_agency_Customizer::$TEXT
        );

        $customizer->AddControl(
            array(
                'id' => 'first_agency_font_family',
                'default' => 'Manrope',
                'title' => __('Font Family Name', 'hs-first-agency'),
                'section_id' => 'first_agency_typography'
            ),
            first_agency_Customizer::$TEXT
        );

        $customizer->AddControl(
            array(
                'id' => 'first_agency_font_size',
                'default' => '14',
                'title' => __('Font Size', 'hs-first-agency'),
                'section_id' => 'first_agency_typography'
            ),
            first_agency_Customizer::$NUMBER
        );

        $customizer->AddControl(
            array(
                'id' => 'first_agency_second_google_font',
                'default' => 'https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap',
                'title' => __('Custom Google Font URL', 'hs-first-agency'),
                'description' => sprintf(
                    '%1$s <a href="%2$s" target="_blank">%3$s</a> %4$s The url will be like "https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap". Copy url from google and past it in here.',
                    __('Insert', 'hs-first-agency'),
                    esc_url('https://www.google.com/fonts'),
                    __('Google Font URL', 'hs-first-agency'),
                    __('for embed fonts.', 'hs-first-agency')
                ),
                'section_id' => 'first_agency_typography'
            ),
            first_agency_Customizer::$TEXT
        );

        $customizer->AddControl(
            array(
                'id' => 'first_agency_second_font_family',
                'default' => 'Comfortaa',
                'title' => __('Custom Font Family Name', 'hs-first-agency'),
                'section_id' => 'first_agency_typography'
            ),
            first_agency_Customizer::$TEXT
        );

        $customizer->AddControl(
            array(
                'id' => 'first_agency_typography_get_pro',
                'title' => __('Get Premium', 'hs-first-agency'),
                'description' => __('For more options, get the premium version.', 'hs-first-agency'),
                'link' => 'https://honarsystems.com/first-agency/',
                'section_id' => 'first_agency_typography',
            ),
            first_agency_Customizer::$GETPROBUTTON
        );
    }
}

if (!function_exists('first_agency_customizer_typography_style')) {
    add_action('wp_head', 'first_agency_customizer_typography_style');
    function first_agency_customizer_typography_style()
    {
?>
        <style type="text/css">
            :root {
                --first-agency-font-family: <?php echo esc_attr(get_theme_mod('first_agency_font_family', 'Manrope, sans-serif')); ?>;
                --first-agency-second-font-family: <?php echo esc_attr(get_theme_mod('first_agency_second_font_family', 'Comfortaa, sans-serif')); ?>;
                --first-agency-font-size: <?php echo esc_attr(get_theme_mod('first_agency_font_size', '14')); ?>;
            }
        </style>
<?php
    }
}
