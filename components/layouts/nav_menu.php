<div class="navbar__area" data-sticky="100" >
    <div class="container">
        <div class="row align-items-center">
			<div class="col-3 col-sm-2">
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
			<div class="col-9 col-sm-10 text-end">
				<!--Nav_Menu-Start-->
				<div class="nav_menu" id="nav_menu">
					<?php
						wp_nav_menu(array(
							'theme_location' => 'primary_menu',
							'menu_class'     => 'nav d-inline-flex',
							'container'      => ' ',
							'fallback_cb'    => 'landshop_mainmenu_demo_content',
							'walker'         =>  new landshop_Nav_Menu_Walker
						));
					?>
				</div>
				<!--Nav_Menu-End-->
			</div>
        </div>
    </div>
</div>
<div class="navbar__height"></div>