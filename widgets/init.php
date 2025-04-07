<?php
if (defined('ELEMENTOR_VERSION')) {
    if (!function_exists('first_agency_elementor_categories_registered')) {
        add_action('elementor/elements/categories_registered', 'first_agency_elementor_categories_registered');
        function first_agency_elementor_categories_registered($elements_manager)
        {
            $elements_manager->add_category('first-agency-addon', [
                'title' => esc_html__('First Agency Addons', 'hs-first-agency'),
                'icon' => 'fa fa-plug',
            ]);
        }
    }

    if (!function_exists('first_agency_elementor_widgets_registered')) {
        add_action('elementor/widgets/widgets_registered', 'first_agency_elementor_widgets_registered');
        function first_agency_elementor_widgets_registered()
        {
            get_template_part('/widgets/posts/posts');
        }
    }
}
