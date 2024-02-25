<?php get_header(); ?>
<main role="main" <?php if (get_theme_mod('searchresults_sidebar', true)) echo 'class="blogtube_has_sidebar"' ?>>
    <section class="blogtube_content_spacer">
        <div class="blogtube_search_container" id="blogtube_main_content">
            <?php
            $blogtube_search_query = get_search_query();

            $blogtube_args = array(
                'post_type'      => 'post',
                'posts_per_page' => -1,
                's'              => $blogtube_search_query,
            );
            $blogtube_query = new WP_Query($blogtube_args);

            if ($blogtube_query->have_posts()) {
                echo '<h1 class="blogtube_search_headline">' . sprintf(esc_html__('Search results for "%s"', 'blogtube'), esc_html($blogtube_search_query)) . '</h1>';

                $searchresults_style = get_theme_mod('searchresults_style', 'search-engine');
                require_once get_template_directory() . '/template-parts/layout-manager.php';
                echo blogtube_display_posts_list($blogtube_query, $searchresults_style);

                
                // Pagination only if needed
                if ($wp_query->max_num_pages > 1) {
                    ?>
                    <div class="blogtube_pagination blogtube_shadow">
                        <div class="blogtube_pagination_content">
                            <div class="blogtube_pagination_controls">
                                <?php previous_posts_link(__('« Previous', 'blogtube')); ?>
                            </div>
                            <div class="blogtube_pagination_pages">
                                <?php
                                echo paginate_links(array(
                                    'total' => $wp_query->max_num_pages,
                                    'current' => $paged,
                                    'prev_next' => false,
                                ));
                                ?>
                            </div>
                            <div class="blogtube_pagination_controls">
                                <?php next_posts_link(__('Next »', 'blogtube'), $wp_query->max_num_pages); ?>
                            </div>
                        </div>
                    </div>
            <?php
                }

                wp_reset_postdata();
            } else {
                echo '<h1>' . __('No posts found.', 'blogtube') . '</h1>';
            }
            ?>
        </div>
    </section>
</main>
<?php
if(get_theme_mod('searchresults_sidebar', true)) {
    echo '<aside id="blogtube_sidebar" class="' . 'blogtube_sidebar_layout_' . esc_attr(get_theme_mod('searchresults_sidebar_layout', 'social')) . '">';
    get_sidebar();
    echo '</aside>';
}
?>
<?php get_footer(); ?>