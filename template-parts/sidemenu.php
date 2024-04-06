<div id="blogtube_sidemenu_closing_div"></div>
<aside id="blogtube_sidemenu">
    <div class="blogtube_sidebar_content">
        <nav>
            <ul class="blogtube_sidebar_mainmenu">
                <li>
                    <a href="/">
                        <i class="fa-solid fa-house"></i>
                        <span> <?php echo esc_html__('Startpage', 'blogtube') ?></span>
                    </a>
                </li>
            </ul>
        </nav>
        <nav>
            <?php
            if (has_nav_menu('sidemenu')) {
                wp_nav_menu(array(
                    'theme_location' => 'sidemenu',
                    'menu_class' => 'blogtube_sidemenu',
                    'container'      => false,
                    'walker' => new blogtube_menu_walker(),
                ));
            } else {
                echo '<div>' . esc_html__('Select a menu in the customizer', 'blogtube') . '</div>';
            }
            ?>
        </nav>
        <?php
        if(has_nav_menu('legal links')){
            wp_nav_menu(array(
                'theme_location' => 'legal links',
                'menu_class' => 'blogtube_sidebar_lagal_links',
                'container'      => false,
            ));
        }
            ?>
        <div class="blogtube_theme_info">
            <div>
                <a href="https://wordpress.org/themes/blogtube/" target="_blank">Blogtube WordPress Theme</a>
                <?php
                printf(
                    esc_html__('created by %1$s', 'blogtube'),
                    '<a href="https://ricoswebsite.com/" target="_blank" rel="designer">Rico</a>'
                );
                ?>
            </div>
    </div>
    </div>
</aside>