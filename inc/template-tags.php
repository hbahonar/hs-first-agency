<?php
// archive post thumbnail
if (!function_exists('hs_first_agency_archive_post_thumbnail')) {
    function hs_first_agency_archive_post_thumbnail()
    {
        if (has_post_thumbnail()): ?>
            <a href="<?php echo esc_url(get_permalink()); ?>" aria-label="<?php echo esc_html(get_the_title()); ?>" class="block">
                <div class="post-thumbnail flex justify-center overflow-hidden rounded-[8px]">
                    <?php the_post_thumbnail(); ?>
                </div>
            </a>
        <?php
        endif;
    }
}

// post & page thumbnail
if (!function_exists('hs_first_agency_archive_post_thumbnail')) {
    function hs_first_agency_archive_post_thumbnail()
    {
        if (has_post_thumbnail()): ?>
            <div class="post-thumbnail flex justify-center overflow-hidden">
                <?php the_post_thumbnail(); ?>
            </div>
        <?php
        endif;
    }
}

if (!function_exists('hs_first_agency_post_thumbnail')) {
    function hs_first_agency_post_thumbnail()
    {
        if (has_post_thumbnail()): ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div>
        <?php
        endif;
    }
}

// post category list
if (!function_exists('hs_first_agency_archive_post_category')) {
    function hs_first_agency_archive_post_category()
    {
        $categories_list = get_the_category_list(_x(' ', 'Used between list items, there is a space after the comma.', 'hs-first-agency'));// phpcs:ignore WordPress.WP.I18n.NoEmptyStrings
        if ($categories_list) : ?>
            <span class="categories">
                <?php printf('<span class="screen-reader-text">%1$s </span> %2$s', esc_html__('Used before category names.', 'hs-first-agency'), wp_kses($categories_list, array('a' => array('href' => array(), 'rel' => array())))); ?>
            </span>
        <?php
        endif;
    }
}

if (!function_exists('hs_first_agency_post_category')) {
    function hs_first_agency_post_category()
    {
        $categories_list = get_the_category_list(_x(', ', 'Used between list items, there is a space after the comma.', 'hs-first-agency'));
        if ($categories_list) : ?>
            <span class="categories">
                <?php printf('<span class="screen-reader-text">%1$s </span> %2$s', esc_html__('Used before category names.', 'hs-first-agency'), wp_kses($categories_list, array('a' => array('href' => array(), 'rel' => array())))); ?>
            </span>
        <?php
        endif;
    }
}

// post title
if (!function_exists('hs_first_agency_archive_post_title')) {
    function hs_first_agency_archive_post_title()
    {
        if (is_sticky()) {
            the_title(sprintf('<h2 class="flex items-center gap-[10px] text-[1.4rem] font-[600] mb-[15px]"><span class="dashicons dashicons-sticky"></span><a href="%s" class="capitalize leading-normal" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
        } else {
            the_title(sprintf('<h2 class="text-[1.4rem] font-[600] mb-[15px]"><a href="%s" class="capitalize leading-normal" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
        }
    }
}

if (!function_exists('hs_first_agency_post_title')) {
    function hs_first_agency_post_title()
    {
        ?>
        <?php if (is_sticky()) : ?>
            <?php
            the_title('<h1 class="flex items-center gap-[10px] text-[1.4rem] lg:text-[1.8rem] font-[600] my-[30px] leading-normal"><span class="dashicons dashicons-sticky text-[1.4rem] lg:text-[1.8rem]"></span>', '</h1>');
            ?>
        <?php else : ?>
            <?php
            the_title('<h1 class="text-[1.4rem] lg:text-[1.8rem] font-[600] my-[30px] leading-normal">', '</h1>');
            ?>
        <?php endif; ?>
    <?php
    }
}

//post excerpt
if (!function_exists('hs_first_agency_archive_content')) {
    function hs_first_agency_archive_content()
    {
    ?>
        <div class="entry-content text-[var(--first-agency-text-color)]">
            <?php the_excerpt(); ?>
        </div>
        <?php
    }
}

//archive pagination
if (!function_exists('hs_first_agency_archive_pagination')) {
    function hs_first_agency_archive_pagination()
    {
        if (is_rtl()) {
            the_posts_pagination(array(
                'prev_text' => __('<span class="dashicons dashicons-arrow-right-alt2 w-[7px] mr-[-12px]"></span><span class="dashicons dashicons-arrow-right-alt2 w-[7px]"></span>', 'hs-first-agency'),
                'next_text' => __('<span class="dashicons dashicons-arrow-left-alt2 w-[7px] mr-[-12px]"></span><span class="dashicons dashicons-arrow-left-alt2 w-[7px]"></span>', 'hs-first-agency'),
            ));
        } else {
            the_posts_pagination(array(
                'prev_text' => __('<span class="dashicons dashicons-arrow-left-alt2 w-[7px] ml-[-12px]"></span><span class="dashicons dashicons-arrow-left-alt2 w-[7px]"></span>', 'hs-first-agency'),
                'next_text' => __('<span class="dashicons dashicons-arrow-right-alt2 w-[7px] ml-[-12px]"></span><span class="dashicons dashicons-arrow-right-alt2 w-[7px]"></span>', 'hs-first-agency'),
            ));
        }
    }
}

/* post tags */
if (!function_exists('hs_first_agency_post_tags')) {
    function hs_first_agency_post_tags()
    {
        $tags_list = get_the_tag_list('', _x(', ', 'Used between list items, there is a space after the comma.', 'hs-first-agency'));
        if ($tags_list && !is_wp_error($tags_list)) :
        ?>
            <div class="tags my-[30px]">
                <?php
                printf(
                    '%1$s',
                    wp_kses($tags_list, array('a' => array('href' => array(), 'rel' => array())))

                );
                ?>
            </div>
        <?php
        endif;
    }
}

/* post & page comment */
if (!function_exists('hs_first_agency_post_comment')) {
    function hs_first_agency_post_comment()
    {
        if (comments_open() || get_comments_number()) : ?>
            <div class="entry-comment mt-[30px]">
                <?php comments_template(); ?>
            </div>
        <?php elseif (!comments_open()) : ?>
            <div class="entry-comment"><?php echo esc_html__('Comments are closed for this section.', 'hs-first-agency'); ?></div>
<?php
        endif;
    }
}
