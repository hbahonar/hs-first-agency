<?php
add_action('widgets_init', function () {
    register_sidebar(
        array(
            'name' => __('Header Contact', 'hs-first-agency'),
            'id' => 'header_contact',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h5 class="widget-title">',
            'after_title' => '</h5>',
        )
    );

    register_sidebar(
        array(
            'name' => __('Left Sidebar', 'hs-first-agency'),
            'id' => 'left_sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h5 class="widget-title">',
            'after_title' => '</h5>',
        )
    );

    register_sidebar(
        array(
            'name' => __('Right Sidebar', 'hs-first-agency'),
            'id' => 'right_sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h5 class="widget-title">',
            'after_title' => '</h5>',
        )
    );

    for ($counter = 1; $counter <= get_theme_mod('first_agency_footer_columns', '1'); $counter++) :
        $name = 'Footer Column %s';
        $name = sprintf($name, $counter);
        register_sidebar(
            array(
                'name' => $name,
                'id' => 'footer' . $counter,
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h5 class="widget-title">',
                'after_title' => '</h5>',
            )
        );
    endfor;
});
