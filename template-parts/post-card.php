<?php
function blogtube_display_post_card()
{
    ob_start(); // Start output buffering

    $blogtube_author_id = get_the_author_meta('ID');
    $blogtube_author_name = esc_html(get_the_author_meta('display_name'));
    $blogtube_author_avatar = get_avatar($blogtube_author_id, 32);

    // Get the current date and time
    $blogtube_current_time = current_time('timestamp');

    // Get the post date
    $blogtube_post_time = get_the_time('U');

    // Calculate the difference between the current time and the post time
    $blogtube_time_difference = human_time_diff($blogtube_post_time, $blogtube_current_time);
?>
    <div class="blogtube_post_card <?php if(is_sticky()) echo 'blogtube_sticky_post' ?>">
        <div class="blogtube_post_card_author_row">
            <a href="<?php echo esc_url(get_author_posts_url($blogtube_author_id)); ?>">
                <?php echo $blogtube_author_avatar; ?>
            </a>
            <a href="<?php echo esc_url(get_author_posts_url($blogtube_author_id)); ?>"><?php echo $blogtube_author_name; ?></a>
        </div>
        <?php if (has_post_thumbnail() && get_theme_mod('feed_post_card_image', true)) { ?>
            <a class="blogtube_post_card_image_container" href="<?php the_permalink(); ?>">
                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
            </a>
        <?php } ?>
        <div class="blogtube_post_card_content_div">
            <a href="<?php the_permalink(); ?>">
                <h2><?php the_title(); ?></h2>
            </a>
            <a href="<?php echo esc_url(get_author_posts_url($blogtube_author_id)); ?>"><?php echo $blogtube_author_name; ?></a>
            <span class="blogtube_post_card_date"><?php printf(__('%s ago', 'blogtube'), $blogtube_time_difference); ?></span>
            <a href="<?php the_permalink(); ?>">
                <?php the_excerpt(); ?>
            </a>
        </div>
    </div>
<?php
    return ob_get_clean(); // Return the buffered output as a string
}
