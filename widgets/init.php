<?php
if (defined('ELEMENTOR_VERSION')) {
    add_action(
        'elementor/elements/categories_registered',
        function ($elements_manager) {
            $elements_manager->add_category('first-agency-addon', [
                'title' => esc_html__('First Agency Addons', 'hs-first-agency'),
                'icon' => 'fa fa-plug',
            ]);
        }
    );

    add_action('elementor/widgets/widgets_registered', function () {
        get_template_part('/widgets/posts/posts');
    });
}
