<?php
    $sticky_menu_setting = get_theme_mod('sticky_menu_setting', 'enable');
    $sticky_offset_setting = get_theme_mod('sticky_offset_setting', 100);
    if ( is_plugin_active( 'elementor/elementor.php' ) ) {
        $elementor_template = get_theme_mod('navbar_elementor_template_setting', 'default');
    }
?>

<div class="navbar__area <?php echo ($elementor_template === 'default' ? 'default__navbar' : 'template__navbar'); ?>" <?php if ('enable' === $sticky_menu_setting) { echo 'data-sticky="' . esc_attr($sticky_offset_setting) . '"'; } ?>>
    <?php if (empty($elementor_template) || $elementor_template === 'default'): ?>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-7 col-lg-2">
                    <!--nav__logo-Start-->
                    <div class="nav__logo">
                        <?php
                            $sticky__logo = get_theme_mod('landshop_sticky_logo');
                            if ($sticky__logo) {
                                echo '<a class="sticky__logo" href="' . esc_url(home_url('/')) . '" ><img src="' . esc_url($sticky__logo) . '" alt="'.__('Sticky Logo','codexse').'"></a>';
                            }
                            if (has_custom_logo()) {
                                echo '<span class="main__logo">';
                                the_custom_logo();
                                echo '</span>';
                            } else {
                                echo '<a class="logo__text" href="' . esc_url(home_url('/')) . '" >' . get_bloginfo('title') . '</a>';
                            }
                        ?>
                    </div>
                    <!--nav__logo-End-->
                </div>
                <div class="col-5 col-lg-10 d-flex align-items-center">
                    <!--Nav_Menu-Start-->
                    <div class="nav__menu ms-auto">
                        <?php
                            wp_nav_menu(array(
                                'theme_location' => 'primary_menu',
                                'menu_class'     => 'nav d-inline-flex',
                                'container'      => ' ',
                                'fallback_cb'    => 'landshop_mainmenu_demo_content',
                                'walker'         => new landshop_Desktop_Menu_Walker
                            ));
                        ?>
                    </div>
                    <!--Nav_Menu-End-->
                    <button class="mobile__menu__toggle"><i class="fa-regular fa-bars"></i></button>
                </div>
            </div>
            <div class="mobile__menu">
                <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary_menu',
                        'menu_class'     => 'nav',
                        'container'      => ' ',
                        'walker'         => new landshop_Mobile_Menu_Walker
                    ));
                ?>
            </div>
        </div>
    <?php
        else:
            echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($elementor_template);
        endif;
    ?>
</div>
<div class="navbar__height"></div>
