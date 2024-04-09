<?php get_header(); ?>
<?php include_once get_template_directory() . '/template-parts/sidemenu.php'; ?>
<main role="main" <?php if (get_theme_mod('searchresults_sidebar', true)) echo 'class="blogtube_has_sidebar"' ?>>
    <section class="blogtube_content_spacer"  id="blogtube_main_content">
        <?php
        $blogtube_search_query = get_search_query();
        $blogtube_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $blogtube_posts_per_page = get_option('posts_per_page');
        $blogtube_args = array(
            'post_type' => 'post',
            'posts_per_page' => $blogtube_posts_per_page,
            'paged' => $blogtube_paged,
            's' => $blogtube_search_query,
        );

        $blogtube_query = new WP_Query($blogtube_args);

        if ($blogtube_query->have_posts()) {
            while ($blogtube_query->have_posts()) {
                $blogtube_query->the_post();
                // Show Posts
                require_once get_template_directory() . '/template-parts/post-card.php';
                echo blogtube_display_post_card();
            }
            wp_reset_postdata();
        } else {
            echo '<span class="blogtube_no_post_found">' . esc_html__('No posts found.', 'blogtube') . '</span>';
        }
        ?>
    </section>
</main>
<?php get_footer(); ?>