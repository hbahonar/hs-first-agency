<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();

?>
<div id="content">
    <div class="flex py-[30px]">
        <?php if (is_rtl() ? is_active_sidebar('right_sidebar') : is_active_sidebar('left_sidebar')) : ?>
            <div class="w-[<?php echo esc_attr(get_theme_mod('hs_first_agency_archive_sidebar_width', '25')) ?>%]">
                <?php is_rtl() ? get_sidebar('right') : get_sidebar('left'); ?>
            </div>
        <?php endif; ?>
        <?php
        $content_width = 100;
        if (is_active_sidebar('right_sidebar')) {
            $content_width -= intval(get_theme_mod('hs_first_agency_archive_sidebar_width', '25'));
        }
        if (is_active_sidebar('left_sidebar')) {
            $content_width -= intval(get_theme_mod('hs_first_agency_archive_sidebar_width', '25'));
        }
        ?>
        <div class="w-[<?php echo esc_html($content_width); ?>%] px-[5px] lg:px-[30px]">
            <article class="post">
                <h1 class="text-[1.4rem] lg:text-[1.8rem] font-[600] my-[30px] leading-normal"><?php esc_html_e('404 Error', 'hs-first-agency'); ?></h1>
                <div class="entry-content">
                    <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for.', 'hs-first-agency'); ?></p>
                </div>
            </article>
        </div>
        <?php if (is_rtl() ? is_active_sidebar('left_sidebar') : is_active_sidebar('right_sidebar')) : ?>
            <div class="w-[<?php echo esc_attr(get_theme_mod('hs_first_agency_archive_sidebar_width', '25')) ?>%]">
                <?php is_rtl() ? get_sidebar('left') : get_sidebar('right'); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php
get_footer();
