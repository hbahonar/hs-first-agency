<?php
add_action('customize_register', function ($wp_customize) {
    get_template_part('/inc/customize/class/customizer');
    $customizer = new BHR_Customizer($wp_customize);

    $customizer->AddSection('first_agency_header', __('Header', 'hs-first-agency'), 'first_agency_settings_pannel');

    $customizer->AddControl(
        array(
            'id' => 'first_agency_header_bg_color',
            'default' => BHR_Theme_Class::$headingColor,
            'title' => __('Background Color', 'hs-first-agency'),
            'section_id' => 'first_agency_header'
        ),
        BHR_Customizer::$COLOR
    );

    /** Logo **/
    $customizer->AddControl(
        array(
            'id' => 'first_agency_header_logo_heading',
            'title' => __('Logo', 'hs-first-agency'),
            'section_id' => 'first_agency_header',
        ),
        BHR_Customizer::$HEADING
    );

    $customizer->AddControl(
        array(
            'id' => 'first_agency_logo_width_desktop',
            'default' => '100',
            'title' => __('Width (px)', 'hs-first-agency'),
            'section_id' => 'first_agency_header'
        ),
        BHR_Customizer::$NUMBER
    );

    $customizer->AddControl(
        array(
            'id' => 'first_agency_logo_width_mobile',
            'default' => '100',
            'title' => __('Width &#128241; (px)', 'hs-first-agency'),
            'section_id' => 'first_agency_header'
        ),
        BHR_Customizer::$NUMBER
    );

    /** Menu **/
    $customizer->AddControl(
        array(
            'id' => 'first_agency_header_menu_heading',
            'title' => __('Menu', 'hs-first-agency'),
            'section_id' => 'first_agency_header',
        ),
        BHR_Customizer::$HEADING
    );

    $customizer->AddControl(
        array(
            'id' => 'first_agency_header_menu_item_color',
            'default' => '#ffffff',
            'title' => __('Item Color', 'hs-first-agency'),
            'section_id' => 'first_agency_header'
        ),
        BHR_Customizer::$COLOR
    );

    /* submenu */
    $customizer->AddControl(
        array(
            'id' => 'first_agency_header_menu_submenu_bg_color',
            'default' => '#ffffff',
            'title' => __('Sub Menu Background Color', 'hs-first-agency'),
            'section_id' => 'first_agency_header'
        ),
        BHR_Customizer::$COLOR
    );

    $customizer->AddControl(
        array(
            'id' => 'first_agency_header_menu_submenu_item_color',
            'default' => BHR_Theme_Class::$headingColor,
            'title' => __('Sub Menu Item Color', 'hs-first-agency'),
            'section_id' => 'first_agency_header'
        ),
        BHR_Customizer::$COLOR
    );

    $customizer->AddControl(
        array(
            'id' => 'first_agency_header_menu_submenu_item_hover_color',
            'default' => BHR_Theme_Class::$headingColor,
            'title' => __('Sub Menu Item Hover Color', 'hs-first-agency'),
            'section_id' => 'first_agency_header'
        ),
        BHR_Customizer::$COLOR
    );

    $customizer->AddControl(
        array(
            'id' => 'first_agency_header_menu_submenu_item_bg_color',
            'default' => '#FFFFFF',
            'title' => __('Sub Menu Item Background Color', 'hs-first-agency'),
            'section_id' => 'first_agency_header'
        ),
        BHR_Customizer::$COLOR
    );

    $customizer->AddControl(
        array(
            'id' => 'first_agency_header_menu_submenu_item_bg_hover_color',
            'default' => BHR_Theme_Class::$primaryColorLight,
            'title' => __('Sub Menu Item Background Color', 'hs-first-agency'),
            'section_id' => 'first_agency_header'
        ),
        BHR_Customizer::$COLOR
    );

    /** mobile **/
    $customizer->AddControl(
        array(
            'id' => 'first_agency_header_mobile_heading',
            'title' => __('Mobile', 'hs-first-agency'),
            'section_id' => 'first_agency_header',
        ),
        BHR_Customizer::$HEADING
    );

    $customizer->AddControl(
        array(
            'id' => 'first_agency_header_mobile_menu_toggler_color',
            'default' => BHR_Theme_Class::$secondaryColor,
            'title' => __('Menu Toggler Color', 'hs-first-agency'),
            'section_id' => 'first_agency_header'
        ),
        BHR_Customizer::$COLOR
    );

    $customizer->AddControl(
        array(
            'id' => 'first_agency_header_mobile_menu_bg_color',
            'default' => BHR_Theme_Class::$headingColor,
            'title' => __('Menu Background Color', 'hs-first-agency'),
            'section_id' => 'first_agency_header'
        ),
        BHR_Customizer::$COLOR
    );

    $customizer->AddControl(
        array(
            'id' => 'first_agency_header_mobile_menu_item_color',
            'default' => '#FFFFFF',
            'title' => __('Menu Item Color', 'hs-first-agency'),
            'section_id' => 'first_agency_header'
        ),
        BHR_Customizer::$COLOR
    );

    $customizer->AddControl(
        array(
            'id' => 'first_agency_header_get_pro',
            'title' => __('Get Premium', 'hs-first-agency'),
            'description' => __('For more options, get the premium version.', 'hs-first-agency'),
            'link' => 'https://honarsystems.com/first-agency/',
            'section_id' => 'first_agency_header',
        ),
        BHR_Customizer::$GETPROBUTTON
    );
});

add_action('wp_head', function () {
?>
    <style type="text/css">
        /***header***/
        :root {
            --first-agency-header-background-color: <?php echo esc_attr(get_theme_mod('first_agency_header_bg_color', BHR_Theme_Class::$headingColor)); ?>;
            --first-agency-header-sticky-background-color: <?php echo esc_attr(get_theme_mod('first_agency_header_sticky_bg_color', 'yes') === 'yes' ? 'transparent' : 'var(--first-agency-header-background-color)'); ?>;
        }

        .hs-site-header {
            background-color: var(--first-agency-header-background-color);
        }

        .hs-site-header.sticky-header {
            background-color: var(--first-agency-header-sticky-background-color);
        }

        .hs-site-header .custom-logo {
            width: <?php echo esc_attr(get_theme_mod('first_agency_logo_width_desktop', '100')); ?>px;
        }

        /***menu***/
        .header-menu .menu-item-has-children::after,
        .header-menu .menu>li>a {
            color: <?php echo esc_attr(get_theme_mod('first_agency_header_menu_item_color', '#ffffff')); ?>;
        }

        /*submenu*/
        .header-menu .sub-menu {
            background-color: <?php echo esc_attr(get_theme_mod('first_agency_header_menu_submenu_bg_color', '#ffffff')); ?>;
        }

        .header-menu .sub-menu li a {
            color: <?php echo esc_attr(get_theme_mod('first_agency_header_menu_submenu_item_color', BHR_Theme_Class::$headingColor)); ?>;
            background-color: <?php echo esc_attr(get_theme_mod('first_agency_header_menu_submenu_item_bg_color', '#FFFFFF')); ?>;
        }

        .header-menu .sub-menu li a:hover {
            color: <?php echo esc_attr(get_theme_mod('first_agency_header_menu_submenu_item_hover_color', BHR_Theme_Class::$headingColor)); ?>;
            background-color: <?php echo esc_attr(get_theme_mod('first_agency_header_menu_submenu_item_bg_color', BHR_Theme_Class::$primaryColorLight)); ?>;
        }

        @media screen and (max-width:991px) {
            .hs-site-header .site-logo .custom-logo {
                width: <?php echo esc_attr(get_theme_mod('first_agency_logo_width_mobile', '100')); ?>px;
            }

            .header-menu-toggler {
                color: <?php echo esc_attr(get_theme_mod('first_agency_header_mobile_menu_toggler_color', BHR_Theme_Class::$secondaryColor)); ?>;
            }

            .header-menu {
                background-color: <?php echo esc_attr(get_theme_mod('first_agency_header_mobile_menu_bg_color', BHR_Theme_Class::$headingColor)); ?>;
            }


            .header-menu .sub-menu li a,
            .header-menu .menu>li>a,
            .header-menu li a,
            .header-menu .close {
                color: <?php echo esc_attr(get_theme_mod('first_agency_header_mobile_menu_item_color', '#FFFFFF')); ?>;
            }

            .header-menu .sub-menu,
            .header-menu .sub-menu li a {
                background-color: transparent;
            }
        }
    </style>
<?php
});
