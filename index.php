<?php get_header(); ?>
<?php include_once get_template_directory() . '/template-parts/sidemenu.php'; ?>
<section class="blogtube_hero">
    <header>
        <h1 class="title"><?php the_title(); ?></h1>
    </header>
</section>
<main <?php if (get_theme_mod('pages_sidebar', true)) echo 'class="blogtube_has_sidebar"' ?>>
    <section class="blogtube_content_spacer">
        <div class="blogtube_content" id="blogtube_main_content">
            <?php
            while (have_posts()) {
                the_post();
            ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('blogtube_user_content_container'); ?>>
                    <?php the_content(); ?>
                </article>
                <footer class="blogtube_post_footer">
                    <!-- Pagination-->
                    <?php
                    wp_link_pages(
                        array(
                            'before'         => '<div class="blogtube_pagination"><span class="page-links-title">' . esc_html__('Pages:', 'blogtube') . '</span>',
                            'after'       => '</div>',
                            'link_before' => '<span class="page-number">',
                            'link_after'  => '</span>',
                        )
                    );

                    // Comments
                    if (comments_open() || get_comments_number()) comments_template();
                    ?>
                </footer>
            <?php } ?>
        </div>
    </section>
</main>
<aside id="blogtube_sidebar"><?php get_sidebar(); ?></aside>
<?php get_footer(); ?>
