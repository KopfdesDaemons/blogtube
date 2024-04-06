<?php
function blogtube_custom_pages($wp_customize)
{
    // Section
    $wp_customize->add_section('custom_theme_pages', array(
        'title' => __('Pages', 'blogtube'),
        'priority' => 30,
        'description' => __('Options for WordPress "Pages".', 'blogtube'),
    ));

    // Maximum width of the post
    $wp_customize->add_setting('maximum_width_of_pages', array(
        'default' => '90',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('maximum_width_of_pages', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Maximum width of pages', 'blogtube'),
        'section' => 'custom_theme_pages',
        'input_attrs' => array(
            'min' => 50,
            'max' => 150,
            'step' => 1,
        ),
    ));

    // Sidebar
    $wp_customize->add_setting('pages_sidebar', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'blogtube_sanitize_checkbox',
    ));

    $wp_customize->add_control('pages_sidebar', array(
        'type' => 'checkbox',
        'label' => __('Show sidebar', 'blogtube'),
        'section' => 'custom_theme_pages',
    ));

    // Background color
    $wp_customize->add_setting('background_color_pages', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'pages_background_color', array(
        'label' => __('Background color', 'blogtube'),
        'section' => 'custom_theme_pages',
        'settings' => 'background_color_pages'
    )));
}
add_action('customize_register', 'blogtube_custom_pages');
