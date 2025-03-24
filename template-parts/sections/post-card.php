<article class="post-<?php the_ID(); ?> rounded-[8px] overflow-hidden">
    <div class="relative mb-[15px]">
        <?php first_agency_archive_post_thumbnail(); ?>
        <div class="<?php echo esc_attr(has_post_thumbnail() ? "absolute" : "relative") ?> z-[1] left-0 bottom-0">
            <?php first_agency_archive_post_category(); ?>
        </div>
    </div>
    <?php first_agency_archive_post_title(); ?>
    <?php
    $display_read_more_text = get_theme_mod('first_agency_archive_read_more_text', __('Read More', 'hs-first-agency'));
    ?>
    <?php first_agency_archive_content(); ?>

    <a href="<?php echo esc_url(get_permalink()) ?>" rel="bookmark" class="btn my-[15px]"><?php echo esc_html($display_read_more_text) ?> <span class="dashicons dashicons-arrow-right-alt text-[var(--first-agency-secondary-color)]"></span></a>
</article>