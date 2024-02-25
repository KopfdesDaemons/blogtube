<?php get_header(); ?>
<main role="main">
    <section class="blogtube_content_spacer">
        <div class="blogtube_error" id="blogtube_main_content">
            <div class="blogtube_404_headline_row">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <h1><?php esc_html_e('File not found', 'blogtube'); ?></h1>
            </div>
            <p><?php echo esc_html__("The page you are looking for could not be found. Please check the URL or go back to the homepage.", 'blogtube'); ?></p>
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo __('Go to the home page', 'blogtube'); ?></a>
        </div>
    </section>
</main>
<?php get_footer(); ?>