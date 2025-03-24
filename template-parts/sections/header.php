<?php
$is_sticky = get_theme_mod('first_agency_header_sticky_entire_website', 'no') === 'yes';
global $wp_query;
if(!empty($wp_query->post->ID) && $is_sticky === false){
    $is_sticky = get_post_meta(get_the_ID(), 'first_agency_post_option_header_sticky_display', true) === 'show';
}
?>
<header class="hs-site-header <?php echo esc_attr($is_sticky ? 'sticky-header fixed top-0 left-0 z-[9999] w-full' : ''); ?> py-[5px]">
    <div class="flex items-center px-[30px]">
        <div class="site-logo w-[calc(50%-50px)] lg:w-[20%] order-2 lg:order-1">
            <?php do_action('first_agency_logo'); ?>
        </div>
        <div class="w-[50px] lg:w-[60%] flex items-center justify-start lg:justify-center order-1 lg:order-2">
            <?php do_action('first_agency_nav_menu'); ?>
        </div>
        <?php if (is_active_sidebar('header_contact')) : ?>
            <div class="w-[50%] lg:w-[20%] order-3 flex items-center justify-end">
                <?php dynamic_sidebar('header_contact'); ?>
            </div>
        <?php endif; ?>
    </div>
</header>
<main>