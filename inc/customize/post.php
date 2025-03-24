<?php
add_action('customize_register', function ($wp_customize) {
    get_template_part('/inc/customize/class/customizer');
    $customizer = new BHR_Customizer($wp_customize);

    $customizer->AddSection('first_agency_post', __('Post & Page', 'hs-first-agency'), 'first_agency_settings_pannel');

    $customizer->AddControl(
        array(
            'id' => 'first_agency_post_get_pro',
            'title' => __('Get Premium', 'hs-first-agency'),
            'description' => __('For more options, get the premium version.', 'hs-first-agency'),
            'link' => 'https://honarsystems.com/first-agency/',
            'section_id' => 'first_agency_post',
        ),
        BHR_Customizer::$GETPROBUTTON
    );
});