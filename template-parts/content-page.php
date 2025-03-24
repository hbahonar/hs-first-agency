<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<div id="content" class="">
    <div class="flex flex-wrap lg:flex-nowrap py-[30px]">
        <?php if (is_rtl() ? is_active_sidebar('right_sidebar') : is_active_sidebar('left_sidebar')) : ?>
            <div class="w-full md:w-[<?php echo esc_attr(get_theme_mod('first_agency_archive_sidebar_width', '25')) ?>%]">
                <?php is_rtl() ? get_sidebar('right') : get_sidebar('left'); ?>
            </div>
        <?php endif; ?>
        <?php
        $content_width = 100;
        if (is_active_sidebar('right_sidebar')) {
            $content_width -= intval(get_theme_mod('first_agency_archive_sidebar_width', '25'));
        }
        if (is_active_sidebar('left_sidebar')) {
            $content_width -= intval(get_theme_mod('first_agency_archive_sidebar_width', '25'));
        }
        ?>
        <div class="w-full lg:w-[<?php echo esc_html($content_width); ?>%] px-[5px] lg:px-[30px]">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) :/* loop start*/
                    the_post(); ?>
                    <article <?php post_class('post'); ?>>
                        <div class="">
                            <?php first_agency_post_thumbnail(); ?>
                        </div>
                        <div class="mt-[30px]">
                            <span class="date text-[0.8rem] lg:text-[1rem]"><?php echo esc_html(get_the_date('M j, Y')); ?></span>
                            <span class="mx-[10px]">/</span>
                            <span class="author-name">
                                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="capitalize text-[0.8rem] lg:text-[1rem] text-[var(--first-agency-heading-color)] hover:text-[var(--first-agency-primary-color)]" aria-label="<?php echo get_the_author(); ?>"><?php echo get_the_author(); ?></a>
                            </span>
                        </div>

                        <?php first_agency_post_title(); ?>

                        <div class="entry-content after:content-[''] after:block after:clear-both">
                            <?php the_content(); ?>
                            <?php
                            wp_link_pages(
                                array(
                                    'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'hs-first-agency') . '</span>',
                                    'after' => '</div>',
                                    'link_before' => '<span>',
                                    'link_after' => '</span>',
                                    'pagelink' => '<span class="screen-reader-text">' . __('Page', 'hs-first-agency') . ' </span>%',
                                    'separator' => '<span class="screen-reader-text">, </span>',
                                )
                            );
                            ?>
                        </div>
                        <?php first_agency_post_comment(); ?>
                    </article>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <?php if (is_rtl() ? is_active_sidebar('left_sidebar') : is_active_sidebar('right_sidebar')) : ?>
            <div class="w-full lg:w-[<?php echo esc_attr(get_theme_mod('first_agency_archive_sidebar_width', '25')) ?>%]">
                <?php is_rtl() ? get_sidebar('left') : get_sidebar('right'); ?>
            </div>
        <?php endif; ?>
    </div>
</div>