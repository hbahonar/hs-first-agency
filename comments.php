<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<?php
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php
    $comment_args = array(
        'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title text-[1.3rem]">',
        'title_reply' => esc_html__('Leave a reply', 'hs-first-agency'),
        'title_reply_after' => '</h3>',
        'fields' => apply_filters('comment_form_default_fields', array(
            'author' => '<div class="comment-form-info grid grid-cols-1 md:grid-cols-2 gap-[10px] w-full lg:w-[50vw] my-[5px]"><p class="comment-form-author">' .
                '<input id="author" name="author" class="border p-[10px] w-full" placeholder="' . esc_html__('Name', 'hs-first-agency') . ($req ? ' *' : '') . '" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" /></p>',
            'email' => '<p class="comment-form-email">' .
                '<input id="email" name="email" class="border p-[10px] w-full" placeholder="' . esc_html__('Email', 'hs-first-agency') . ($req ? ' *' : '') . '" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" />' . '</p></div>',
            'url' => ''
        )),
        'comment_field' => '<p class="comment-form-comment">' .
            '<textarea id="comment" placeholder="' . esc_html__('Write a Comment', 'hs-first-agency') . ' *" name="comment" aria-required="true" class="border p-[10px] w-full lg:w-[50vw] min-h-[140px] my-[5px]"></textarea>' .
            '</p>',
        'comment_notes_after' => '',
        'comment_notes_before' => '',
        'class_submit' => 'btn active cursor-pointer my-[5px]'
    );
    comment_form($comment_args);
    ?>
    <?php if (have_comments()) { ?>
        <ul class="comment-list list-unstyled mt-[60px]">
            <?php
            wp_list_comments(
                array(
                    'short_ping' => true,
                    'avatar_size' => 50,
                    'callback' => 'first_agency_custom_comment_list'
                )
            );
            ?>
        </ul>

        <div class="comment-pagination">
            <?php 
            if (is_rtl()) {
                paginate_comments_links(array('prev_text' => __('<span class="dashicons dashicons-arrow-right-alt2 w-[7px] mr-[-12px]"></span><span class="dashicons dashicons-arrow-right-alt2 w-[7px]"></span>', 'hs-first-agency'), 'next_text' => __('<span class="dashicons dashicons-arrow-left-alt2 w-[7px] mr-[-12px]"></span><span class="dashicons dashicons-arrow-left-alt2 w-[7px]"></span>', 'hs-first-agency')));
            }else{
                paginate_comments_links(array('prev_text' => __('<span class="dashicons dashicons-arrow-left-alt2 w-[7px] ml-[-12px]"></span><span class="dashicons dashicons-arrow-left-alt2 w-[7px]"></span>', 'hs-first-agency'), 'next_text' => __('<span class="dashicons dashicons-arrow-right-alt2 w-[7px] ml-[-12px]"></span><span class="dashicons dashicons-arrow-right-alt2 w-[7px]"></span>', 'hs-first-agency')));
            }?>
        </div>

    <?php }
    ?>

</div>