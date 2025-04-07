<?php
if (!function_exists('first_agency_print_first_instance_of_block')) {
    function first_agency_print_first_instance_of_block($block_name, $content = null, $instances = 1)
    {
        $instances_count = 0;
        $blocks_content  = '';

        if (! $content) {
            $content = get_the_content();
        }

        // Parse blocks in the content.
        $blocks = parse_blocks($content);

        // Loop blocks.
        foreach ($blocks as $block) {

            // Sanity check.
            if (! isset($block['blockName'])) {
                continue;
            }

            // Check if this the block matches the $block_name.
            $is_matching_block = false;

            // If the block ends with *, try to match the first portion.
            if ('*' === $block_name[-1]) {
                $is_matching_block = 0 === strpos($block['blockName'], rtrim($block_name, '*'));
            } else {
                $is_matching_block = $block_name === $block['blockName'];
            }

            if ($is_matching_block) {
                // Increment count.
                $instances_count++;

                // Add the block HTML.
                $blocks_content .= render_block($block);

                // Break the loop if the $instances count was reached.
                if ($instances_count >= $instances) {
                    break;
                }
            }
        }

        if ($blocks_content) {
            /** This filter is documented in wp-includes/post-template.php */
            echo apply_filters('the_content', $blocks_content); // phpcs:ignore WordPress.Security.EscapeOutput
            return true;
        }

        return false;
    }
}

//logo
if (!function_exists('first_agency_logo')) {
    add_action('first_agency_logo', 'first_agency_logo');
    function first_agency_logo()
    {
        if (has_custom_logo()) : ?>
            <?php the_custom_logo(); ?>
        <?php else : ?>
            <a href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_html(get_bloginfo('name')); ?>">
                <h4 class="site-title text-[var(--first-agency-site-name-color)]">
                    <?php
                    echo esc_html(get_bloginfo('name'));
                    ?>
                </h4>
            </a>
            <?php $first_agency_description = get_bloginfo('description'); ?>
            <?php if ($first_agency_description) : ?>
                <p class="site-description"><?php echo esc_html($first_agency_description); ?></p>
        <?php endif;
        endif;
    }
}

//header menu
if (!function_exists('first_agency_nav_menu')) {
    add_action('first_agency_nav_menu', 'first_agency_nav_menu', 10, 2);
    function first_agency_nav_menu()
    {
        if (!has_nav_menu('main-menu')) {
            return;
        }
        ?>
        <button class="header-menu-toggler flex lg:hidden" type="button">
            <span class="dashicons dashicons-menu text-[2rem] w-[35px] h-[35px]"></span>
        </button>
        <div class="header-menu">
            <div class="">
                <div class="flex lg:hidden items-center justify-end p-[10px]">
                    <span class="close flex items-center justify-center" tabindex="0"><span class="dashicons dashicons-no text-[1.5rem]"></span></span>
                </div>
                <nav class="">
                    <div class="flex lg:hidden flex justify-center my-[50px]">
                        <?php do_action('first_agency_logo'); ?>
                    </div>
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'main-menu',
                        'menu' => 'main-menu',
                        'container' => 'div',
                    ]); ?>
                </nav>

            </div>
        </div>

    <?php
    }
}

//excerpt length
if (!function_exists('first_agency_excerpt_length')) {
    add_filter("excerpt_length", 'first_agency_excerpt_length', 999);
    function first_agency_excerpt_length($length)
    {
        if (is_admin()) {
            return $length;
        }
        return esc_attr(get_theme_mod('first_agency_archive_content_length', '20'));
    }
}


if (!function_exists('first_agency_excerpt_more')) {
    add_filter('excerpt_more', 'first_agency_excerpt_more');
    function first_agency_excerpt_more($more)
    {
        return ' ...';
    }
}

/*Custom Comment*/
if (!function_exists('first_agency_comment_form_fields')) {
    add_filter('comment_form_fields', 'comment_form_fields');
    function comment_form_fields($fields)
    {
        $comment_field = $fields['comment'];
        $cookies_field = $fields['cookies'];
        unset($fields['comment']);
        unset($fields['cookies']);
        $fields['comment'] = $comment_field;
        $fields['cookies'] = $cookies_field;
        return $fields;
    }
}

if (!function_exists('first_agency_custom_comment_list')) {
    function first_agency_custom_comment_list($comment, $args, $depth)
    {
    ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <div id="div-comment-<?php comment_ID(); ?>" class="comment-body flex gap-[10px] p-[5px] pb-[10px] mb-[5px] border rounded-[8px]">
                <?php
                if (0 != $args['avatar_size']) :
                    $avatar = get_avatar($comment, $args['avatar_size']);
                    if ($avatar) :
                ?>
                        <div class="avatar-image w-[50px]">
                            <?php echo get_avatar($comment, $args['avatar_size'], '', get_comment_author(), ['class' => 'rounded-full']); ?>
                        </div>
                <?php endif;
                endif; ?>
                <div class="w-[calc(100%-60px)]">
                    <div class="comment-metadata text-[0.8rem] lg:text-[1rem]">
                        <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>" aria-label="<?php esc_html__('Comment Date', 'hs-first-agency') ?>">
                            <?php
                            $time_string = '<time class="entry-date published updated text-[0.8rem] lg:text-[1rem]" datetime="%1$s">%2$s</time>';
                            $time_string = sprintf(
                                $time_string,
                                esc_attr(get_comment_date(DATE_W3C)),
                                esc_html(get_comment_date('M j, Y'))
                            );
                            echo wp_kses_post($time_string); ?>

                        </a>
                        <span class="mx-[10px]">/</span>
                        <span class="comment-author"><?php echo wp_kses(get_comment_author_link(), array('a' => array('href' => array()))); ?></span>
                        <?php edit_comment_link(esc_html__('Edit', 'hs-first-agency'), '<span class="mx-[10px]">/</span><span class="edit-link">', '</span>'); ?>

                        <?php
                        comment_reply_link(array_merge($args, array(
                            'reply_text' => __('Reply', 'hs-first-agency'),
                            'depth'      => $depth,
                            'max_depth'  => $args['max_depth'],
                            'before' => '<span class="mx-[10px]">/</span><span class="comment-reply">',
                            'after' => '</span>'
                        )));
                        ?>
                    </div>

                    <div class="comment-content mt-[5px] text-[0.8rem] lg:text-[1rem]">
                        <?php comment_text(); ?>
                    </div>
                </div>
            </div>
            <div class="comment-footer">
                <?php if ('0' == $comment->comment_approved) : ?>
                    <p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'hs-first-agency'); ?></p>
                <?php endif; ?>
            </div>
    <?php
    }
}

/* check post title */
if (!function_exists('first_agency_check_the_title')) {
    add_filter('the_title', 'first_agency_check_the_title', 10, 2);
    function first_agency_check_the_title($title, $id)
    {
        if (empty($title)) {
            return __('Untitled', 'hs-first-agency');
        }
        return $title;
    }
}
