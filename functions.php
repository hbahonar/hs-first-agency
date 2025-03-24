<?php
add_action('after_setup_theme', function () {

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
});

require_once get_template_directory() . '/inc/classes/theme.class.php';
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/widget-areas.php';
require_once get_template_directory() . '/inc/template-functions.php';
require_once get_template_directory() . '/inc/template-tags.php';
require_once get_template_directory() . '/inc/customize/customize.php';
require_once get_template_directory() . '/widgets/init.php';
require_once get_template_directory() . '/inc/getting-start.php';
require_once get_template_directory() . '/inc/welcome.php';
require_once get_template_directory() . '/inc/demo_importer.php';

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
add_action('wp_print_footer_scripts', function () {

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
});
