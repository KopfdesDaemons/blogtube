<?php get_header(); ?>
<?php include_once get_template_directory() . '/template-parts/sidemenu.php'; ?>
<main role="main" <?php if (get_theme_mod('feed_sidebar', true)) echo 'class="blogtube_has_sidebar"' ?>>
    <section class="blogtube_content_spacer blogtube_feed" id="blogtube_main_content">
        <?php
        if (is_active_sidebar('home-widget-area')) dynamic_sidebar('home-widget-area');
        if (has_nav_menu('chipmenu')) {
            wp_nav_menu(array(
                'theme_location' => 'chipmenu',
                'menu_class' => 'blogtube_chipmenu',
                'container'      => false,
            ));
        }

        $blogtube_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $blogtube_posts_per_page = get_option('posts_per_page');
        $blogtube_args = array(
            'post_type' => 'post',
            'posts_per_page' => $blogtube_posts_per_page,
            'paged' => $blogtube_paged
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
            echo esc_html__('No posts found.', 'blogtube');
        }
        ?>
    </section>
</main>
<?php get_footer(); ?>