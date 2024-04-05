<?php
function blogtube_styles()
{
    $theme_directory = get_stylesheet_directory_uri();

    $styles = array(
        'blogtube-styles' => '/style.css',
        'blogtube-fontawesome' => '/fonts/fontawesome/css/all.min.css',
    );

    foreach ($styles as $handle => $file) {
        wp_enqueue_style($handle, $theme_directory . $file, array(), '1', 'all');
    }
}
add_action('wp_enqueue_scripts', 'blogtube_styles');


// Theme Support
add_theme_support('post-thumbnails');
add_theme_support("title-tag");
add_theme_support('automatic-feed-links');
add_theme_support('html5', array(
    'comment-list',
    'comment-form',
    'search-form',
    'gallery',
    'caption',
));
add_theme_support('align-wide');
add_theme_support('responsive-embeds');

function blogtube_enqueue_scripts()
{
    // Load the wordpress comment script from the “\wordpress\wp-includes\js” directory.
    // This allows the comment response form to be located below the corresponding comment
    // and not at the very bottom of the page.
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_enqueue_script('blogtube_sidemenu_script', get_template_directory_uri() . '/js/blogtube_sidemenu.js', null, '1.0', true);

    // Infinitiyscroll Script
    if(is_home() || is_search()){
        wp_enqueue_script('blogtube_infinityscroll_script', get_template_directory_uri() . '/js/blogtube_infinityscroll.js', null, '1.0', true);
       
        // Pass the Ajax URL to script.js
        wp_localize_script('blogtube_infinityscroll_script', 'my_scripts_vars', array(
            'ajaxurl' => admin_url('admin-ajax.php')
        ));
    }
}
add_action('wp_enqueue_scripts', 'blogtube_enqueue_scripts');

// Number of words previewed in the feed
function blogtube_custom_excerpt_length($length)
{
    return get_theme_mod('words_in_snippet', 30);
}
add_filter('excerpt_length', 'blogtube_custom_excerpt_length', 999);

// Characters after snippet
function blogtube_custom_excerpt_more($more)
{
    return '...';
}
add_filter('excerpt_more', 'blogtube_custom_excerpt_more');

function blogtube_register_menus()
{
    register_nav_menus(
        array(
            'sidemenu' => __('Sidemenu', 'blogtube'),
            'legal links' => __('legal links', 'blogtube'),
        )
    );
}
add_action('init', 'blogtube_register_menus');

function blogtube_register_sidebar()
{
    register_sidebar(array(
        'name' => __('Sidebar', 'blogtube'),
        'id' => 'my-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'blogtube_register_sidebar');

// Custom menu structure
class blogtube_menu_walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
        if (empty($item->title)) return;

        $output .= "<li class='" .  implode(" ", (array)$item->classes) . "'>";
        $output .= "<div class='blogtube_menuitem_container'>";
        $output .= '<a href="' . esc_url($item->url) . '">';
        $output .= $item->title;
        $output .= '</a>';

        if ($args->walker->has_children) {
            $output .= '<i tabindex="0" class="blogtube_submenu_toggle fa-solid fa-chevron-down"></i>';
        }
        $output .= "</div>";
    }
}

// customizer settings
$blogtube_customizer_options = [
    'global-options.php',
    // 'header-options.php',
    // 'feed-options.php',
    // 'posts-options.php',
    // 'pages-options.php',
    // 'author-page-options.php',
];

foreach ($blogtube_customizer_options as $option) {
    require_once get_template_directory() . '/customizer-options/' . $option;
}

// Sanitize function to check checkbox value (true/false)
function blogtube_sanitize_checkbox($input)
{
    return (isset($input) && true === $input) ? true : false;
}

// Infinityscroll
function load_posts()
{
    $page = $_POST['page'];
    $blogtube_posts_per_page = get_option('posts_per_page');
    $blogtube_args = array(
        'post_type' => 'post',
        'posts_per_page' => $blogtube_posts_per_page,
        'paged' => $page
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
        echo 'NoMorePosts'; // Signal when there are no more posts to load
    }

    die();
}

add_action('wp_ajax_load_posts', 'load_posts');
add_action('wp_ajax_nopriv_load_posts', 'load_posts');
