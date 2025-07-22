<?php if (is_search()) : ?>
    <div class="px-[30px] my-[15px]">
        <h1 class="text-[2rem] font-[700] capitilize"><?php echo esc_html('Search Results for: ', 'hs-first-agency') . '<span class="italic">' . esc_html(get_search_query()); ?></span></h1>
    </div>
<?php elseif (is_archive()) : ?>
    <div class="px-[30px] my-[15px]">
        <?php the_archive_title('<h1 class="text-[2rem] font-[700] capitilize">', '</h1>'); ?>
        <?php the_archive_description('<div>', '</div>'); ?>
    </div>
<?php endif; ?>

<div id="content" class="">
    <div class="flex flex-wrap lg:flex-nowrap py-[30px]">
        <?php if (is_rtl() ? is_active_sidebar('right_sidebar') : is_active_sidebar('left_sidebar')) : ?>
            <div class="w-full lg:w-[<?php echo esc_attr(get_theme_mod('hs_first_agency_archive_sidebar_width', '25')) ?>%]">
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
            <div class="posts grid gap-[30px] grid-cols-1 lg:grid-cols-<?php echo esc_html(get_theme_mod('hs_first_agency_archive_column_count', '2')); ?>">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) :/* loop start*/
                        the_post(); ?>
                        <?php get_template_part('template-parts/sections/post-card', null); ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <div class="my-[60px]">
                <?php hs_first_agency_archive_pagination(); ?>
            </div>
        </div>
        <?php if (is_rtl() ? is_active_sidebar('left_sidebar') : is_active_sidebar('right_sidebar')) : ?>
            <div class="w-full lg:w-[<?php echo esc_attr(get_theme_mod('hs_first_agency_archive_sidebar_width', '25')) ?>%]">
                <?php is_rtl() ? get_sidebar('left') : get_sidebar('right'); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
</div>