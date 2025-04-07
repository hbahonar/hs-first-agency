<?php
if (!function_exists('first_agency_customizer_archive')) {
    add_action('customize_register', 'first_agency_customizer_archive');
    function first_agency_customizer_archive($wp_customize)
    {
        get_template_part('/inc/customize/class/customizer');
        $customizer = new first_agency_Customizer($wp_customize);

        $customizer->AddSection('first_agency_archive', __('Blog', 'hs-first-agency'), 'first_agency_settings_pannel');

        $customizer->AddControl(
            array(
                'id' => 'first_agency_archive_column_count',
                'default' => '2',
                'title' => __('Column Count', 'hs-first-agency'),
                'section_id' => 'first_agency_archive',
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
                'id' => 'first_agency_archive_read_more_text',
                'default' => __('Read More', 'hs-first-agency'),
                'title' => __('Read More Text', 'hs-first-agency'),
                'description' => __('Change the text of the Read More button.', 'hs-first-agency'),
                'section_id' => 'first_agency_archive'
            ),
            first_agency_Customizer::$TEXT
        );

        $customizer->AddControl(
            array(
                'id' => 'first_agency_archive_get_pro',
                'title' => __('Get Premium', 'hs-first-agency'),
                'description' => __('For more options, get the premium version.', 'hs-first-agency'),
                'link' => 'https://honarsystems.com/first-agency/',
                'section_id' => 'first_agency_archive',
            ),
            first_agency_Customizer::$GETPROBUTTON
        );
    }
}
