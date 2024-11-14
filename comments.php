<?php
// Exit if accessed directly.
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ($comments_number === '1') {
                printf(_x('One comment on &ldquo;%s&rdquo;', 'comments title', 'real-estate-ors'), get_the_title());
            } else {
                printf(
                    _nx(
                        '%1$s comment on &ldquo;%2$s&rdquo;',
                        '%1$s comments on &ldquo;%2$s&rdquo;',
                        $comments_number,
                        'comments title',
                        'real-estate-ors'
                    ),
                    number_format_i18n($comments_number),
                    get_the_title()
                );
            }
            ?>
        </h2>

        <ul class="comment-list">
            <?php
            // Display the list of comments
            wp_list_comments(array(
                'style'      => 'ul',
                'short_ping' => true,
                'avatar_size' => 50,
            ));
            ?>
        </ul>

        <?php
        // Display comment navigation if there are multiple pages of comments
        if (get_comment_pages_count() > 1 && get_option('page_comments')) :
        ?>
            <nav class="comment-navigation">
                <div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'real-estate-ors')); ?></div>
                <div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'real-estate-ors')); ?></div>
            </nav>
        <?php endif; ?>

    <?php endif; // Check for have_comments(). 
    ?>

    <?php
    // If comments are closed and there are comments, display a note
    if (!comments_open() && get_comments_number()) :
    ?>
        <p class="no-comments"><?php _e('Comments are closed.', 'real-estate-ors'); ?></p>
    <?php endif; ?>

    <?php
    // Display the comment form
    comment_form();
    ?>
</div>