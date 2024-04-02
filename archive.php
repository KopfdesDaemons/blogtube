<?php
get_header();
include_once get_template_directory() . '/template-parts/sidemenu.php';

$blogtube_archive_title = esc_html__('Archive', 'blogtube');
if (is_author()) {
    $blogtube_archive_title = get_the_author();
} elseif (is_tag()) {
    $blogtube_archive_title = single_tag_title('', false);
} elseif (is_category()) {
    $blogtube_archive_title = single_cat_title('', false);
} elseif (is_date()) {
    if (is_day()) {
        $blogtube_archive_title = esc_html__('Archive for', 'blogtube') . ' ' . get_the_date();
    } elseif (is_month()) {
        $blogtube_archive_title = esc_html__('Archive for', 'blogtube') . ' ' . get_the_date('F Y');
    } elseif (is_year()) {
        $blogtube_archive_title = esc_html__('Archive for', 'blogtube') . ' ' . get_the_date('Y');
    }
}
?>

<!-- author header -->
<?php if (is_author() && get_theme_mod('author_header', true)) {
    $blogtube_author_id = get_the_author_meta('ID');
    $blogtube_author_name = esc_html(get_the_author_meta('display_name'));
    $blogtube_author_description = esc_html(get_the_author_meta('description'));
    $blogtube_author_website = esc_url(get_the_author_meta('user_url'));
    $blogtube_author_posts_count = count_user_posts($blogtube_author_id);
    $blogtube_author_roles = get_the_author_meta('roles');

    $blogtube_user_registered = get_the_author_meta('blogtube_user_registered');
    $blogtube_timestamp = strtotime($blogtube_user_registered);
    $blogtube_formatted_date = date_i18n(get_option('date_format'), $blogtube_timestamp);

    // Avatar
    $blogtube_image_size = esc_attr(get_theme_mod('image_size_setting', '150'));
    $blogtube_author_avatar = get_avatar($blogtube_author_id, $blogtube_image_size);
?>
    <section class="blogtube_post_author_headline_section">
        <header>
            <div class="blogtube_author_row_1">
                <?php echo $blogtube_author_avatar ?>
                <div class="blogtube_author_headline_container">
                    <h1>
                        <?php
                        if (is_author()) {
                            the_post();
                            echo get_the_author(); // Author name
                            rewind_posts();
                        } ?>
                    </h1>
                    <ul class="blogtube_author_stats">
                        <?php if (get_theme_mod('author_page_role', true)) { ?>
                            <li>
                                <div class="blogtube_author_stats_data"> <?php echo $blogtube_author_roles[0] ?></div>
                                <label class="blogtube_author_stats_label"><?php echo esc_html(__('Role', 'blogtube')) ?></label>
                            </li>
                        <?php } ?>
                        <?php if (get_theme_mod('author_registration_date', true)) { ?>
                            <li>
                                <div class="blogtube_author_stats_data">
                                    <?php
                                    $registration_date = get_the_author_meta('blogtube_user_registered', $blogtube_author_id);
                                    $blogtube_formatted_date = date_i18n('d.m.Y', strtotime($registration_date));
                                    ?>
                                    <time datetime="<?php echo date('Y-m-d', strtotime($registration_date)); ?>"><?php echo $blogtube_formatted_date; ?></time>
                                </div>
                                <label class="blogtube_author_stats_label">
                                    <?php echo esc_html(__('Registration date', 'blogtube')); ?>
                                </label>
                            </li>
                        <?php } ?>
                        <?php if (get_theme_mod('author_number_of_posts', true)) { ?>
                            <li>
                                <div class="blogtube_author_stats_data"> <?php echo $blogtube_author_posts_count ?></div>
                                <label class="blogtube_author_stats_label"><?php echo esc_html(__('Number of posts', 'blogtube')) ?></label>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </header>
        <nav class="blogtube_author_nav">
            <ul>
                <li>
                    <button id="blogtube_author_posts" onclick="click_author_posts()"><?php echo esc_html(__('Posts', 'blogtube')) ?></button>
                </li>
                <?php if (get_theme_mod('author_page_latest_comments', true)) { ?>
                    <li>
                        <button id="blogtube_author_comments" onclick="click_author_comments()"><?php echo esc_html(__('Comments', 'blogtube')) ?></button>
                    </li>
                <?php } ?>
            </ul>
        </nav>
        <?php if (!empty($blogtube_author_description)) : ?>
            <div class="blogtube_author_bio_container">
                <div class="blogtube_author_bio">
                    <h2><?php printf(esc_html__('About %s:', 'blogtube'), get_the_author()); ?></h2>
                    <p><?php echo $blogtube_author_description; ?></p>
                    <?php if (get_theme_mod('blogtube_author_website', true) && $blogtube_author_website) { ?>
                        <a class="blogtube_author_website" href="<?php echo $blogtube_author_website; ?>" target="_blank">🌐
                            <?php echo esc_html(__('Website', 'blogtube')) ?></a>
                    <?php } ?>
                </div>
            </div>
        <?php endif; ?>
    </section>
<?php } ?>

<main role="main">
    <section class="blogtube_content_spacer blogtube_content_spacer_feed blogtube_content_and_sidebar_grid">
        <?php if (is_author()) {; ?>
            <div class="blogtube_autor_content">
                <div class="blogtube_author_comments_container">
                    <?php
                    $blogtube_args = array(
                        'user_id' => $blogtube_author_id,
                        'number' => 5, // Number of comments
                    );
                    $blogtube_author_comments = get_comments($blogtube_args);
                    ?>
                    <h3 class="blogtube_author_last_comments_headline">
                        <?php echo __('Last comments from', 'blogtube') . ' ' . $blogtube_author_name; ?></h3>
                    <ol class="has-avatars has-dates has-excerpts wp-block-latest-comments">
                        <?php
                        if ($blogtube_author_comments) {
                            foreach ($blogtube_author_comments as $comment) {
                                echo '<li class="wp-block-latest-comments__comment">';
                                echo get_avatar($comment->comment_author_email, 48); // Gravatar-Avatar
                                echo '<article>';
                                echo '<footer class="wp-block-latest-comments__comment-meta">';
                                echo '<a class="wp-block-latest-comments__comment-author" href="' . esc_url($comment->comment_author_url) . '">' . $comment->comment_author . '</a>';
                                echo ' <a class="wp-block-latest-comments__comment-link" href="' . esc_url(get_comment_link($comment)) . '">' . get_the_title($comment->comment_post_ID) . '</a>';
                                echo '<time datetime="' . esc_attr(get_comment_date('c', $comment)) . '" class="wp-block-latest-comments__comment-date">' . get_comment_date('j. F Y', $comment) . '</time>';
                                echo '</footer>';
                                echo '<div class="wp-block-latest-comments__comment-excerpt">';
                                echo '<p>' . get_comment_excerpt($comment) . '</p>'; // Comment snippet
                                echo '</div>';
                                echo '</article>';
                                echo '</li>';
                            }
                        } else {
                            echo __('No comments found.', 'blogtube');
                        }
                        ?>
                    </ol>
                <?php } ?>
                </div>

                <?php
                    global $wp_query;
                    $wp_query->set('paged', 1);

                    if ($wp_query->have_posts()) {
                        while ($wp_query->have_posts()) {
                            $wp_query->the_post();
                            require_once get_template_directory() . '/template-parts/post-card.php';
                            echo blogtube_display_post_card();
                        }
                        wp_reset_postdata();
                    } else {
                        echo esc_html__('No posts found.', 'blogtube');
                    }
                ?>
            </div>
            </div>
    </section>
</main>
<?php get_footer(); ?>