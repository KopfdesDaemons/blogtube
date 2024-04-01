<?php get_header(); ?>
<?php include_once get_template_directory() . '/template-parts/sidemenu.php'; ?>
            <?php
            while (have_posts()) :
                the_post();
            ?>
<main <?php if (get_theme_mod('post_sidebar', true)) echo 'class="blogtube_has_sidebar"' ?>>
    <section class="blogtube_hero">
        <header>
            <?php if (get_theme_mod('post_image', true) & has_post_thumbnail()) : ?>
                <div class="blogtube_post_thumbnail">
                    <div>
                        <?php the_post_thumbnail(); ?>
                    </div>
                </div>
            <?php endif; ?>
            <h1 class="title"><?php the_title(); ?></h1>

            <?php
            $blogtube_author_id = get_the_author_meta('ID');
            $blogtube_author_name = esc_html(get_the_author_meta('display_name'));
            $blogtube_author_avatar = get_avatar($blogtube_author_id, 40);

            // Get the current date and time
            $blogtube_current_time = current_time('timestamp');

            // Get the post date
            $blogtube_post_time = get_the_time('U');

            // Calculate the difference between the current time and the post time
            $blogtube_time_difference = human_time_diff($blogtube_post_time, $blogtube_current_time);
            ?>
                    <div class="blogtube_hero_author_row">
                        <a href="<?php echo esc_url(get_author_posts_url($blogtube_author_id)); ?>">
                            <?php echo $blogtube_author_avatar; ?>
                        </a>
                        <a href="<?php echo esc_url(get_author_posts_url($blogtube_author_id)); ?>"><?php echo $blogtube_author_name; ?></a>
                    </div>
                <div class="blogtube_metadata_box">
                    <span class="blogtube_date"><?php printf(__('%s ago', 'blogtube'), $blogtube_time_difference); ?></span>
                    <div class="blogtube_categorie_list">
                        <?php
                        $blogtube_categories = get_the_category();
                        if (!empty($blogtube_categories)) {
                            echo '<ul>';
                            foreach ($blogtube_categories as $category) {
                                echo '<li class="' . 'blogtube_chips_layout_' . str_replace("-", "_", get_theme_mod('posts_categories_layout', 'color-blocks')) . '"><a href="' . esc_url(get_category_link($category->term_id)) . '">' . $category->name . '</a></li>';
                            }
                            echo '</ul>';
                        }
                        ?>
                    </div>
                </div>
        </header>
    </section>
        <section class="blogtube_content_spacer" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <article class="blogtube_user_content_container" id="blogtube_main_content">
                <?php the_content(); ?>
            </article>

            <footer class="blogtube_post_footer">
                <!-- Pagination-->
                <?php
                wp_link_pages(
                    array(
                        'before'         => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'blogtube') . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span class="page-number">',
                        'link_after'  => '</span>',
                    )
                );
                ?>

                <!-- Tags -->
                <?php
                $blogtube_tags_options = get_theme_mod('tags', true);
                $blogtube_tags = get_the_tags();
                if ($blogtube_tags_options & !empty($blogtube_tags)) {
                    echo '<div class="blogtube_post_tags"><ul>';
                    foreach ($blogtube_tags as $tag) {
                        echo '<li class="' . 'blogtube_chips_layout_' . str_replace("-", "_", esc_attr(get_theme_mod('posts_tags_layout', 'portal'))) . '"><a href="' . esc_url(get_tag_link($tag->term_id)) . '">' . $tag->name . '</a></li>';
                    }
                    echo '</ul></div>';
                }

                // Author
                $blogtube_author_info = get_theme_mod('author_details', true);
                if ($blogtube_author_info) {
                    $blogtube_author_id = get_the_author_meta('ID');
                    $blogtube_author_name = esc_html(get_the_author_meta('display_name'));
                    $blogtube_author_description = esc_html(get_the_author_meta('description'));
                    $blogtube_author_website = esc_url(get_the_author_meta('user_url'));
                    $blogtube_author_avatar = get_avatar($blogtube_author_id, 500);
                ?>
                    <div class="blogtube_authorbox">
                        <div class="blogtube_author_avatar">
                            <a href="<?php echo esc_url(get_author_posts_url($blogtube_author_id)); ?>">
                                <?php echo $blogtube_author_avatar; ?>
                            </a>
                        </div>
                        <div class="blogtube_author_details">
                            <div class="blogtube_author_name_row">
                                <h3>
                                    <a href="<?php echo esc_url(get_author_posts_url($blogtube_author_id)); ?>"><?php echo $blogtube_author_name; ?></a>
                                </h3>
                                <?php if ($blogtube_author_website) : ?>
                                    <a href="<?php echo $blogtube_author_website; ?>" target="_blank">
                                        <i class="fa-solid fa-globe"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <p><?php echo $blogtube_author_description; ?></p>
                        </div>
                    </div>
                <?php } ?>

                <?php
                $post_pagination = get_theme_mod('post_pagination', true);
                if ($post_pagination) { ?>
                    <div class="blogtube_post_pagination">
                        <div class="blogtube_post_pagination_prev">
                            <?php previous_post_link('%link', __('&laquo; Previous Post', 'blogtube')); ?> </div>
                        <div class="blogtube_post_pagination_next">
                            <?php next_post_link('%link', __('Next Post &raquo;', 'blogtube')); ?> </div>
                    </div>
                <?php } ?>

                <!-- Comments -->
            <?php
            if (comments_open() || get_comments_number()) {
                comments_template();
            }
        endwhile;
            ?>
            </footer>
            </div>
        </section>
</main>
<aside id="blogtube_sidebar"><?php get_sidebar(); ?></aside>
<?php get_footer(); ?>