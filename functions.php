<?php
if (!function_exists('first_agency_setup_theme')) {
    function first_agency_setup_theme()
    {

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
            * Let WordPress manage the document title.
            * By adding theme support, we declare that this theme does not use a
            * hard-coded <title> tag in the document head, and expect WordPress to
            * provide it for us.
            */
        add_theme_support('title-tag');

        $args = array(
            'default-text-color' => '000',
            'width'              => 1000,
            'height'             => 250,
            'flex-width'         => true,
            'flex-height'        => true,
        );
        add_theme_support('custom-header', $args);

        /*
             * Enable support for Post Thumbnails on posts and pages.
             *
             * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
             */
        add_theme_support('post-thumbnails');

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /*
             * Make theme available for translation.
             * Translations can be filed in the /languages/ directory.
             * If you're building a theme based on appside, use a find and replace
             * to change 'hs-first-agency' to the name of your theme in all the template files.
             */
        load_theme_textdomain('hs-first-agency', get_template_directory() . '/languages');

        // This theme uses wp_nav_menu() in three location.
        register_nav_menus(
            array(
                'main-menu' => esc_html__('Main Menu', 'hs-first-agency'),
                'footer-menu' => esc_html__('Footer Menu', 'hs-first-agency'),
            )
        );

        /*
             * Switch default core markup for search form, comment form, and comments
             * to output valid HTML5.
             */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
                'navigation-widgets',
            )
        );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height' => 250,
                'width' => 300,
                'flex-width' => true,
                'flex-height' => true,
                'unlink-homepage-logo' => true,
            )
        );

        $args = array(
            'default-text-color' => '000',
            'width'              => 1140,
            'height'             => 122,
            'flex-width'         => true,
            'flex-height'        => true,
        );
        add_theme_support('custom-header', $args);

        add_theme_support('wp-block-styles');

        // Add support for responsive embedded content.
        add_theme_support('responsive-embeds');

        add_theme_support('register_block_style');

        add_theme_support('register_block_pattern');

        add_theme_support('add_editor_style()');

        // Add support for full and wide align images.
        add_theme_support('align-wide');

        // Add support for editor styles.
        add_theme_support('editor-styles');

        // Enqueue editor styles.
        add_editor_style('assets/css/editor-style.css');

        // Set up the WordPress core custom background feature.
        add_theme_support(
            'custom-background',
            apply_filters(
                'first_agency_custom_background_args',
                array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );

        $GLOBALS['content_width'] = apply_filters('first_agency_content_width', 1170);
    }
    add_action('after_setup_theme', 'first_agency_setup_theme');
}


require_once get_template_directory() . '/inc/classes/theme.class.php';
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/widget-areas.php';
require_once get_template_directory() . '/inc/template-functions.php';
require_once get_template_directory() . '/inc/template-tags.php';
require_once get_template_directory() . '/inc/customize/customize.php';
require_once get_template_directory() . '/widgets/init.php';
require_once get_template_directory() . '/inc/getting-start.php';
require_once get_template_directory() . '/inc/welcome.php';

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
if (!function_exists('first_agency_footer_scripts')) {
    add_action('wp_print_footer_scripts','first_agency_footer_scripts');
    function first_agency_footer_scripts() {

        // If SCRIPT_DEBUG is defined and true, print the unminified file.
        if (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) {
            echo '<script>';
            include get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js';
            echo '</script>';
        }

        // The following is minified via `npx terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
?>
        <script>
            /(trident|msie)/i.test(navigator.userAgent) && document.getElementById && window.addEventListener && window.addEventListener("hashchange", (function() {
                var t, e = location.hash.substring(1);
                /^[A-z0-9_-]+$/.test(e) && (t = document.getElementById(e)) && (/^(?:a|select|input|button|textarea)$/i.test(t.tagName) || (t.tabIndex = -1), t.focus())
            }), !1);
        </script>
<?php
    }
}

/**** demo importer */
if (!function_exists('first_agency_demo_importer_register_plugins')) {
    add_filter('ocdi/register_plugins', 'first_agency_demo_importer_register_plugins');
    function first_agency_demo_importer_register_plugins($plugins)
    {
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
    }
}

if (!function_exists('first_agency_demo_importer_import_files')) {
    add_filter('ocdi/import_files', 'first_agency_demo_importer_import_files');
    function first_agency_demo_importer_import_files()
    {
        return [
            [
                'import_file_name'           => __('First Agency', 'hs-first-agency'),
                'import_file_url'            => 'https://honarsystems.com/theme/first-agency/demo-content/firstagency-content.xml',
                'import_widget_file_url'     => 'https://honarsystems.com/theme/first-agency/demo-content/firstagency-widgets.wie',
                'import_customizer_file_url' => 'https://honarsystems.com/theme/first-agency/demo-content/firstagency-customizer.dat',
            ],
        ];
    }
}

if (!function_exists('first_agency_demo_importer_after_import')) {
    add_action('ocdi/after_import', 'first_agency_demo_importer_after_import');
    function first_agency_demo_importer_after_import()
    {
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
                    'color' => first_agency_Theme_Class::$primaryColor
                ],
                1 => [
                    '_id' => 'secondary',
                    'title' => 'Secondary',
                    'color' => first_agency_Theme_Class::$headingColor
                ],
                2 => [
                    '_id' => 'text',
                    'title' => 'Text',
                    'color' => first_agency_Theme_Class::$textColor
                ],
                3 => [
                    '_id' => 'accent',
                    'title' => 'Accent',
                    'color' => first_agency_Theme_Class::$secondaryColor
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
    }
}
