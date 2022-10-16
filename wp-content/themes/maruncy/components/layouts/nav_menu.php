<?php
	if ( class_exists( 'Redux' ) ) {
		global $maruncy_opt;
	}else{
		$maruncy_opt['navbar_sticky'] = '1';
		$maruncy_opt['sticky_offset'] = '100';
		$maruncy_opt['nav_shop_display'] = '0';
		$maruncy_opt['nav_search_display'] = '1';
		$maruncy_opt['toggle_menu_display'] = '1';
		$maruncy_opt['nav_button_display'] = '0';
		$maruncy_opt['nav_button_label'] = __('Donate Now','maruncy');
		$maruncy_opt['nav_button_url'] = '#';
		$maruncy_opt['nav_button_icon'] = '';
		$maruncy_opt['nav_number_display'] = '0';
		$maruncy_opt['nav_phone_number'] = '';
		$maruncy_opt['nav_phone_url'] = '';
		$maruncy_opt['nav_phone_icon'] = '';
		$maruncy_opt['is_preloader'] = '1';
	}
    $menu_transparent = get_post_meta( get_the_ID(), '_maruncy_transparent_menu', true );   

	$data = '';

	if($maruncy_opt['nav_number_display'] == '1'){
		$data .= '<a href="'.esc_url($maruncy_opt['nav_phone_url']).'" class="nav-phone">';
        if(!empty($maruncy_opt['nav_phone_icon']['thumbnail'])){
            $data .= '<img src="'.esc_url($maruncy_opt['nav_phone_icon']['thumbnail']).'" alt="'.__('Phone','maruncy').'" />';
        }
		$data .= '<span>'.wp_kses_post($maruncy_opt['nav_phone_number']).'</span>';
		$data .= '</a>';
	}

	if(class_exists( 'WooCommerce' ) && $maruncy_opt['nav_shop_display'] == '1' ){
		$data .= maruncy_shop_mini_cart();
	}

	if($maruncy_opt['nav_search_display'] == '1'):
		$data .= '<div class="nav_actions">';
		$data .= '<button type="button" class="tools_icon search_toggle" data-bs-toggle="collapse" data-bs-target="#header_search_form"><i class="mr-search-icon"></i><span class="txt">'.__('Search','maruncy').'</span></button>';
		$data .= '</div>';
	endif;

	if($maruncy_opt['toggle_menu_display'] == '1'):
        $data .= '<div class="nav_actions mobile_menu_toggle">';
        $data .= '<button type="button" class="tools_icon" id="nav_mobile_toggle"><i class="fal fa-bars"></i></button>';
        $data .= '</div>';
	endif;

	if($maruncy_opt['nav_button_display'] == '1'){
		$data .= '<a href="'.esc_url($maruncy_opt['nav_button_url']).'" class="primary_button rounded">';
		$data .= '<span>'.wp_kses_post($maruncy_opt['nav_button_label']).'</span>';
        if(!empty($maruncy_opt['nav_button_icon']['thumbnail'])){
            $data .= '<img src="'.esc_url($maruncy_opt['nav_button_icon']['thumbnail']).'" alt="'.__('Donation Icon','maruncy').'" />';
        }
		$data .= '</a>';
	}

if($maruncy_opt['is_preloader'] == '1'): ?>
    <!-- preloader  -->
    <div id="preloader" class="preloader">
        <div class="animation-preloader">
            <div class="spinner"></div>
            <div class="txt-loading">
                <span data-text-preloader="L" class="letters-loading">L</span>
                <span data-text-preloader="O" class="letters-loading">O</span>
                <span data-text-preloader="A" class="letters-loading">A</span>
                <span data-text-preloader="D" class="letters-loading">D</span>
                <span data-text-preloader="I" class="letters-loading">I</span>
                <span data-text-preloader="N" class="letters-loading">N</span>
                <span data-text-preloader="G" class="letters-loading">G</span>
            </div>
        </div>
        <div class="loader">
            <div class="row">
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- preloader end -->
<?php endif; 
if($maruncy_opt['nav_search_display'] == '1'): ?>				
		<div class="header_search_form collapse" id="header_search_form">
        <div class="container" >
        <?php get_search_form(); ?>
		</div>
		<button type="button" class="close_action" data-bs-toggle="collapse" data-bs-target="#header_search_form"><i class="fal fa-times"></i></button>
		</div>	
<?php endif; ?>
<div class="nav_area" <?php echo esc_attr($maruncy_opt['navbar_sticky'] ? 'data-sticky='.(!empty($maruncy_opt['sticky_offset']['height']) ? esc_attr($maruncy_opt['sticky_offset']['height']): '100') : '');?>>
	<div class="container-wide">
		<div class="nav_row">
			<!--Nav_Logo-Start-->
			<div class="nav_logo">
				<?php
					if( !empty($maruncy_opt['main_logo']['url']) and !empty($maruncy_opt['sticky_logo']['url']) ){
						echo '<a href="'.esc_url(home_url('/')).'" class="main_logo" ><img src="'.esc_url($maruncy_opt['main_logo']['url']).'" alt="'.get_bloginfo('name').'" ></a>';
						echo '<a href="'.esc_url(home_url('/')).'" class="sticky_logo" ><img src="'.esc_url($maruncy_opt['sticky_logo']['url']).'" alt="'.get_bloginfo('name').'" ></a>';
					}elseif( !empty($maruncy_opt['main_logo']['url']) ){
						echo '<a href="'.esc_url(home_url('/')).'" ><img src="'.esc_url($maruncy_opt['main_logo']['url']).'" alt="'.get_bloginfo('name').'" ></a>';
					}elseif( !empty($maruncy_opt['sticky_logo']['url']) ){
						echo '<a href="'.esc_url(home_url('/')).'" ><img src="'.esc_url($maruncy_opt['sticky_logo']['url']).'" alt="'.get_bloginfo('name').'" ></a>';
					}elseif(has_custom_logo()){
						the_custom_logo();
					}else{
						echo '<a href="'.esc_url(home_url('/')).'" >'.get_bloginfo('title').'</a>';
					}
				?>
			</div>
			<!--Nav_Logo-End-->
			<!--Nav_Menu-Start-->
			<div class="nav_menu" id="nav_menu">
				<?php
					wp_nav_menu(array(
						'theme_location' => 'primary_menu',
						'menu_class'     => 'nav',
						'container'      => ' ',
						'fallback_cb'    => 'maruncy_mainmenu_demo_content',
						'walker'         =>  new maruncy_Nav_Menu_Walker
					));
				?>
			</div>
			<!--Nav_Menu-End-->

			<!--Nav_Tools-Start-->
			<div class="nav_tools">
				<?php echo wp_kses_post($data); ?>
			</div>
			<!--Nav_Tools-End-->
		</div>
	</div>
</div>
<div class="navbar-height"></div>