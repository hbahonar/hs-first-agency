<?php

add_filter('ocdi/register_plugins', function ($plugins) {
    $theme_plugins = [];
    if (
        isset($_GET['step']) &&
        $_GET['step'] === 'import' &&
        isset($_GET['import'])
    ) {
        $theme_plugins[] =
            [
                'name'     => __('Elementor', 'hs-first-agency'),
                'slug'     => 'elementor',
                'required' => true,
            ];
        $theme_plugins[] =
            [
                'name'     => __('Portfolio', 'hs-first-agency'),
                'slug'     => 'tlp-portfolio',
                'required' => true,
            ];
    }

    if (is_array($theme_plugins)) {
        return array_merge($plugins, $theme_plugins);
    } else {
        return array_merge($plugins, []);
    }
});


add_filter('ocdi/import_files', function () {
    return [
        [
            'import_file_name'           => __('First Agency', 'hs-first-agency'),
            'import_file_url'            => 'https://honarsystems.com/theme/first-agency/demo-content/firstagency-content.xml',
            'import_widget_file_url'     => 'https://honarsystems.com/theme/first-agency/demo-content/firstagency-widgets.wie',
            'import_customizer_file_url' => 'https://honarsystems.com/theme/first-agency/demo-content/firstagency-customizer.dat',
        ],
    ];
});


add_action('ocdi/after_import', function () {
    // Assign menus to their locations.
    $main_menu = get_term_by('name', 'Main Menu', 'nav_menu');
    $footer_menu = get_term_by('name', 'Footer Menu', 'nav_menu');

    set_theme_mod(
        'nav_menu_locations',
        [
            'main-menu' => $main_menu->term_id,
            'footer-menu' => $footer_menu->term_id,
        ]
    );

    // Get the front page.
    $front_page = get_posts(
        [
            'post_type'              => 'page',
            'title'                  => 'Home',
            'post_status'            => 'all',
            'numberposts'            => 1,
            'update_post_term_cache' => false,
            'update_post_meta_cache' => false,
        ]
    );

    if (!empty($front_page)) {
        update_option('page_on_front', $front_page[0]->ID);
    }

    // Get the blog page.
    $blog_page = get_posts(
        [
            'post_type'              => 'page',
            'title'                  => 'Blog',
            'post_status'            => 'all',
            'numberposts'            => 1,
            'update_post_term_cache' => false,
            'update_post_meta_cache' => false,
        ]
    );

    if (!empty($blog_page)) {
        update_option('page_for_posts', $blog_page[0]->ID);
    }

    if (!empty($blog_page) || !empty($front_page)) {
        update_option('show_on_front', 'page');
    }

    $activeKitId = get_option('elementor_active_kit');
    if (!is_null($activeKitId)) {
        $postMeta = get_post_meta($activeKitId, '_elementor_page_settings');
        $newPostMeta = array();
        if (isset($postMeta)) {
            // copy everything that's already there and override relevant portions
            foreach ($postMeta as $key => $value) {
                $newPostMeta[$key] = $value;
            }
        }
        $newPostMeta['custom_colors'] = [
            0 => [
                '_id' => 'd15f4ac',
                'title' => 'Primary Dark',
                'color' => '#025CB7'
            ],
            1 => [
                '_id' => '961baba',
                'title' => 'Primary Light',
                'color' => '#EBF4FE'
            ],
            2 => [
                '_id' => '2d6dd4b',
                'title' => 'White',
                'color' => '#FFFFFF'
            ],
            3 => [
                '_id' => '60937ab',
                'title' => 'Black',
                'color' => '#000000'
            ],
        ];
        $newPostMeta['system_colors'] = [
            0 => [
                '_id' => 'primary',
                'title' => 'Primary',
                'color' => BHR_Theme_Class::$primaryColor
            ],
            1 => [
                '_id' => 'secondary',
                'title' => 'Secondary',
                'color' => BHR_Theme_Class::$headingColor
            ],
            2 => [
                '_id' => 'text',
                'title' => 'Text',
                'color' => BHR_Theme_Class::$textColor
            ],
            3 => [
                '_id' => 'accent',
                'title' => 'Accent',
                'color' => BHR_Theme_Class::$secondaryColor
            ],
        ];
        $newPostMeta['system_typography'] = [
            0 => [
                '_id' => 'primary',
                'title' => 'Primary',
                'typography_typography' => 'custom',
                'typography_font_family' => 'Manrope',
                'typography_font_weight' => '600'
            ],
            1 => [
                '_id' => 'secondary',
                'title' => 'Secondary',
                'typography_typography' => 'custom',
                'typography_font_family' => 'Manrope',
                'typography_font_weight' => '400'
            ],
            2 => [
                '_id' => 'text',
                'title' => 'Text',
                'typography_typography' => 'custom',
                'typography_font_family' => 'Manrope',
                'typography_font_weight' => '400'
            ],
            3 => [
                '_id' => 'accent',
                'title' => 'Accent',
                'typography_typography' => 'custom',
                'typography_font_family' => 'Manrope',
                'typography_font_weight' => '500'
            ],
        ];
        update_post_meta($activeKitId, '_elementor_page_settings', $newPostMeta, true);
    }
});
