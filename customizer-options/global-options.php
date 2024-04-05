<?php
function blogtube_global($wp_customize)
{
    // Section
    $wp_customize->add_section('global_section', array(
        'title'      => __('Global', 'blogtube'),
        'priority'   => 30,
    ));

    // Fonts
    $wp_customize->add_setting('body_font', array(
        'default'   => 'Roboto, sans-serif',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('body_font', array(
        'description' => __('All fonts are hosted locally. Consent according to the GDPR is not required for this theme (cookie banner).', 'blogtube'),
        'label'      => __('Main text font', 'blogtube'),
        'section'    => 'global_section',
        'type'       => 'select',
        'choices'    => array(
            'Arial, sans-serif' => 'Arial',
            'Courier New, monospace' => 'Courier New',
            'Fragment Mono' => 'Fragment Mono',
            'Georgia, serif' => 'Georgia',
            'Lato, sans-serif' => 'Lato',
            'Lucida Console, monospace' => 'Lucida Console',
            'Montserrat, sans-serif' => 'Montserrat',
            'Noto Sans JP, sans-serif' => 'Noto Sans JP',
            'Open Sans, sans-serif' => 'Open Sans',
            'Poppins, sans-serif' => 'Poppins',
            'Quicksand, sans-serif' => 'Quicksand',
            'Roboto, sans-serif' => 'Roboto',
            'Tahoma, sans-serif' => 'Tahoma',
            'Times New Roman, serif' => 'Times New Roman',
            'Trebuchet MS, sans-serif' => 'Trebuchet MS',
            'Verdana, sans-serif' => 'Verdana',
            'monospace' => 'Monospace',
        ),
    ));

    // Primary color
    $wp_customize->add_setting('primary_color', array(
        'default' => '#3ea6ff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label' => __('Primary color', 'blogtube'),
        'section' => 'global_section',
        'settings' => 'primary_color'
    )));

    // Background color
    $wp_customize->add_setting('body_background_color', array(
        'default' => '#0f0f0f',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'body_background_color', array(
        'label' => __('Background color', 'blogtube'),
        'section' => 'global_section',
        'settings' => 'body_background_color'
    )));

    // Font color
    $wp_customize->add_setting('font_color', array(
        'default' => '#F1F1F1',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'font_color', array(
        'label' => __('Font color', 'blogtube'),
        'section' => 'global_section',
        'settings' => 'font_color'
    )));
}
add_action('customize_register', 'blogtube_global');
