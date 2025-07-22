<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<div id="content">
    <div class="flex flex-wrap lg:flex-nowrap py-[30px]">
        <?php if (is_rtl() ? is_active_sidebar('right_sidebar') : is_active_sidebar('left_sidebar')) : ?>
            <div class="w-full md:w-[<?php echo esc_attr(get_theme_mod('hs_first_agency_archive_sidebar_width', '25')) ?>%]">
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
        <div class="w-full lg:w-[<?php echo esc_html($content_width); ?>%] px-[5px] lg:px-[30px]">
            <article <?php post_class('post'); ?>>
                <h1 class="text-[1.4rem] lg:text-[1.8rem] font-[600] my-[30px] leading-normal"><?php esc_html_e('No Post Yet', 'hs-first-agency'); ?></h1>

                <div class="entry-content clear-both">
                    <?php if (is_home() && current_user_can('publish_posts')) : ?>

                        <p><?php printf(
                                wp_kses(
                                    /* translators: 1: link to new post */
                                    __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'hs-first-agency'),
                                    array(
                                        'a' => array(
                                            'href' => array(),
                                        ),
                                    )
                                ),
                                esc_url(admin_url('post-new.php'))
                            ); ?></p>

                    <?php elseif (is_search()) : ?>

                        <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'hs-first-agency'); ?></p>

                    <?php else : ?>

                        <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for.', 'hs-first-agency'); ?></p>

                    <?php endif; ?>
                </div>
            </article>
        </div>
        <?php if (is_rtl() ? is_active_sidebar('left_sidebar') : is_active_sidebar('right_sidebar')) : ?>
            <div class="w-full lg:w-[<?php echo esc_attr(get_theme_mod('hs_first_agency_archive_sidebar_width', '25')) ?>%]">
                <?php is_rtl() ? get_sidebar('left') : get_sidebar('right'); ?>
            </div>
        <?php endif; ?>
    </div>
</div>