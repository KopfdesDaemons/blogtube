<?php
    function blogtube_hex2hsl($hex)
    {
        // Extract RGB values from the hex color code
        list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");

        // Convert RGB to HSL
        $r /= 255.0;
        $g /= 255.0;
        $b /= 255.0;

        $max = max($r, $g, $b);
        $min = min($r, $g, $b);

        $h = 0;
        $s = 0;
        $l = ($max + $min) / 2;

        if ($max != $min) {
            $d = $max - $min;
            $s = $l > 0.5 ? $d / (2 - $max - $min) : $d / ($max + $min);

            switch ($max) {
                case $r:
                    $h = ($g - $b) / $d + ($g < $b ? 6 : 0);
                    break;
                case $g:
                    $h = ($b - $r) / $d + 2;
                    break;
                case $b:
                    $h = ($r - $g) / $d + 4;
                    break;
            }

            $h /= 6;
        }

        return array(round($h * 360), round($s * 100), round($l * 100));
    }

    // Get the primary color from the Customizer
    $blogtube_primary_color = esc_attr(get_theme_mod('primary_color', '#3ea6ff'));
    // Convert the primary color to HSL
    list($blogtube_primary_hue, $blogtube_saturation, $lightness) = blogtube_hex2hsl($blogtube_primary_color);
    $blogtube_lightness = 50;

    // Define other colors based on the primary color
    $blogtube_primary_variant_darker = "hsl($blogtube_primary_hue, " . (max(0, $blogtube_saturation - 20)) . "%, " . (max(0, $blogtube_lightness - 40)) . "%)";
?>

<style>
    :root {
        --blogtube_primary_color: <?php echo $blogtube_primary_color ?>;
        --blogtube_primary_variant_darker: <?php echo $blogtube_primary_variant_darker ?>;
        --blogtube_font_color: <?php echo esc_attr(get_theme_mod('font_color', '#F1F1F1')); ?>;
        --blogtube_body_font: <?php echo esc_attr(get_theme_mod('body_font', 'Roboto,Arial,sans-serif')); ?>;
        --blogtube_body_background_color: <?php echo esc_attr(get_theme_mod('body_background_color', '#0f0f0f')); ?>;
        --blogtube_maximum_width_of_posts: <?php echo esc_attr(get_theme_mod('maximum_width_of_posts', '90') . 'em'); ?>;
        --blogtube_maximum_width_of_pages: <?php echo esc_attr(get_theme_mod('maximum_width_of_pages', '90') . 'em'); ?>;
        --blogtube_background_color_posts: <?php echo esc_attr(get_theme_mod('background_color_posts', '')); ?>;
        --blogtube_background_color_pages: <?php echo esc_attr(get_theme_mod('background_color_pages', '')); ?>;
    }
</style>