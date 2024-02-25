<?php
// Widget area
if (is_active_sidebar('my-sidebar')) {
    dynamic_sidebar('my-sidebar');
} else {
    echo '<div class="widget"><p>' . esc_html__('Fill the sidebar in the customizer', 'blogtube') . '</p></div>';
}
