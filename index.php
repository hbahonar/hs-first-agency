<?php
get_header();
if (have_posts()) {
    if (is_single()) {
        get_template_part('template-parts/content', 'single');
    } else {
        get_template_part('template-parts/content');
    }
} else {
    get_template_part('template-parts/content', 'none');
}
get_footer();