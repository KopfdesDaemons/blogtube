<?php
function blogtube_display_post_card()
{
    ob_start(); // Start output buffering
?>
    <div class="blogtube_post_card">
        <?php if (has_post_thumbnail() && get_theme_mod('feed_post_card_image', true)) { ?>
            <a class="blogtube_post_card_image_container" href="<?php the_permalink(); ?>">
                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
            </a>
        <?php } ?>
        <div class="blogtube_post_card_content_div">
            <a href="<?php the_permalink(); ?>">
                <h2><?php the_title(); ?></h2>
            </a>
            <span class="blogtube_post_card_image_date"><?php the_date(); ?></span>
            <?php the_excerpt(); ?>
            <!-- <div class="blogtube_post_card_tags_div">
                <?php
                if (get_theme_mod('feed_post_card_tags', true)) {
                    $tags = get_the_tags();
                    if ($tags) {
                        echo '<ul>';
                        foreach ($tags as $tag) {
                            $tag_link = esc_url(get_tag_link($tag->term_id));
                            echo '<li><a href="' . $tag_link . '">' . $tag->name . '</a></li>';
                        }
                        echo '</ul>';
                    }
                }
                ?>
            </div> -->
            <!-- <div class="blogtube_post_card_buttom_row">
                <span class="blogtube_post_card_pin">📌</span>
                <div class="blogtube_post_card_link_div">
                    <?php if (get_theme_mod('feed_post_card_comments', true)) { ?>

                        <a href="<?php comments_link(); ?>" class="blogtube_post_card_comments_count">
                            <?php
                            $blogtube_post_card_comments_count = get_comments_number();
                            echo '<span>' . $blogtube_post_card_comments_count . '</span>' . '<span>💬</span>';
                            ?>
                        </a>
                    <?php } ?>
                </div>
            </div> -->
        </div>
    </div>
<?php
    return ob_get_clean(); // Return the buffered output as a string
}
