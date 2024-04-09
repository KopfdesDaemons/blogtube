<?php
    get_header();
    include_once get_template_directory() . '/template-parts/sidemenu.php';
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
    $blogtube_author_avatar = get_avatar($blogtube_author_id, 160);
?>
    <section class="blogtube_post_author_headline_section">
        <header>
            <?php echo $blogtube_author_avatar ?>
            <div class="blogtube_author_data">
                <h1>
                    <?php
                    the_post();
                    echo get_the_author(); // Author name
                    rewind_posts();
                    ?>
                </h1>
                <span class="blogtube_author_name"><?php echo get_the_author() ?></span>
                <span class="blogtube_author_number_of_posts"><?php echo $blogtube_author_posts_count . ' ' . esc_html__('Posts', 'blogtube')?></span>
                <p><?php echo $blogtube_author_description; ?></p>
                <a class="blogtube_author_website" href="<?php echo $blogtube_author_website; ?>" target="_blank">
                    <?php echo $blogtube_author_website ?></a>
    </section>
<?php } ?>

<main role="main">
    <section class="blogtube_content_spacer blogtube_content_spacer_feed blogtube_content_and_sidebar_grid" id="blogtube_main_content">
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
    </section>
</main>
<?php get_footer(); ?>