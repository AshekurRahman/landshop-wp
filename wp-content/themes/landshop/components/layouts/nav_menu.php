<?php
	if ( class_exists( 'Redux' ) ) {
		global $landshop_opt;
	}else{
		$landshop_opt['navbar_sticky'] = '1';
		$landshop_opt['sticky_offset'] = '100';
		$landshop_opt['nav_shop_display'] = '1';
		$landshop_opt['nav_search_display'] = '1';
		$landshop_opt['toggle_menu_display'] = '1';
		$landshop_opt['nav_button_display'] = '0';
		$landshop_opt['loader_text'] = esc_html__('Loading','landshop');
		$landshop_opt['nav_button_label'] = esc_html__('Donate Now','landshop');
		$landshop_opt['nav_button_url'] = '#';
		$landshop_opt['nav_button_icon'] = '';
		$landshop_opt['nav_number_display'] = '0';
		$landshop_opt['nav_phone_number'] = '';
		$landshop_opt['nav_phone_url'] = '';
		$landshop_opt['nav_phone_icon'] = '';
		$landshop_opt['is_preloader'] = '1';
		$landshop_opt['navbar_transparent'] = '';
	}

	$data = '';
	$ndata = true;


	if(class_exists( 'WooCommerce' ) && $landshop_opt['nav_shop_display'] == '1' ){
		$data .= landshop_shop_mini_cart();
        $ndata = false;
	}

	if($landshop_opt['nav_search_display'] == '1'):
		$data .= '<div class="nav_actions">';
		$data .= '<button type="button" class="tools_icon search_toggle" data-bs-toggle="collapse" data-bs-target="#header_search_form">';
		$data .= '<svg class="svg-icon"><use xlink:href="'.get_theme_file_uri( 'assets/images/symble.svg#ic-search' ).'"></use></svg>';
		$data .= '</button>';
		$data .= '</div>';
        $ndata = false;
	endif;

    $data .= '<div class="nav_actions login_toggle">';
        $data .= '<button type="button" class="tools_icon" data-bs-toggle="collapse" data-bs-target="#login_popup"><svg class="svg-icon"><use xlink:href="'.get_theme_file_uri( 'assets/images/symble.svg#ic-profile' ).'"></use></svg></button>';
    $data .= '</div>';

	if($landshop_opt['toggle_menu_display'] == '1'):
        $data .= '<div class="nav_actions mobile_menu_toggle">';
        $data .= '<button type="button" class="tools_icon" id="nav_mobile_toggle"><svg class="svg-icon"><use xlink:href="'.get_theme_file_uri( 'assets/images/symble.svg#ic-menu-toggle' ).'"></use></svg></button>';
        $data .= '</div>';
	endif;

	if($landshop_opt['nav_button_display'] == '1'){
		$data .= '<a href="'.esc_url($landshop_opt['nav_button_url']).'" class="primary_button nav_actions">';
		$data .= '<span>'.wp_kses_post($landshop_opt['nav_button_label']).'</span>';
        if(!empty($landshop_opt['nav_button_icon']['thumbnail'])){
            $data .= '<img src="'.esc_url($landshop_opt['nav_button_icon']['thumbnail']).'" alt="'.esc_attr__('Donation Icon','landshop').'" />';
        }
		$data .= '</a>';
        $ndata = false;
	}

	if($landshop_opt['nav_number_display'] == '1'){
		$data .= '<a href="'.esc_url($landshop_opt['nav_phone_url']).'" class="nav-phone nav_actions">';
        if(!empty($landshop_opt['nav_phone_icon']['thumbnail'])){
            $data .= '<img src="'.esc_url($landshop_opt['nav_phone_icon']['thumbnail']).'" alt="'.esc_attr__('Phone','landshop').'" />';
        }
		$data .= '<span>'.wp_kses_post($landshop_opt['nav_phone_number']).'</span>';
		$data .= '</a>';
        $ndata = false;
	}

if($landshop_opt['is_preloader'] == '1'): ?>
    <!-- preloader  -->
    <div id="preloader" class="preloader">
        <div class="animation-preloader">
            <div class="loader">
                <div class="shadow"></div>
                <div class="box"></div>
            </div>
            <?php if($landshop_opt['loader_text']): ?>
                <?php $loader_text = str_split(esc_html($landshop_opt['loader_text'])); ?>
                <div class="txt-loading">
                    <?php foreach($loader_text as $value): ?>
                    <span data-text-preloader="<?php echo esc_attr($value); ?>" class="letters-loading"><?php echo esc_html($value); ?></span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
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
if($landshop_opt['nav_search_display'] == '1'): ?>
<div class="header_search_form collapse" id="header_search_form">
    <div class="container">
        <?php get_search_form(); ?>
    </div>
    <button type="button" class="close_action" data-bs-toggle="collapse" data-bs-target="#header_search_form"><svg class="svg-icon"><use xlink:href="<?php echo get_theme_file_uri( 'assets/images/symble.svg#ic-close' ); ?>"></use></svg></button>
</div>
<?php endif; ?>
<div class="nav_area" <?php echo esc_attr($landshop_opt['navbar_sticky'] ? 'data-sticky='.(!empty($landshop_opt['sticky_offset']['height']) ? esc_attr($landshop_opt['sticky_offset']['height']): '100') : '');?>>
    <div class="container-wide">
        <div class="nav_row">
            <!--Nav_Logo-Start-->
            <div class="nav_logo">
                <?php
					if( !empty($landshop_opt['main_logo']['url']) and !empty($landshop_opt['sticky_logo']['url']) ){
						echo '<a href="'.esc_url(home_url('/')).'" class="main_logo" ><img src="'.esc_url($landshop_opt['main_logo']['url']).'" alt="'.get_bloginfo('name').'" ></a>';
						echo '<a href="'.esc_url(home_url('/')).'" class="sticky_logo" ><img src="'.esc_url($landshop_opt['sticky_logo']['url']).'" alt="'.get_bloginfo('name').'" ></a>';
					}elseif( !empty($landshop_opt['main_logo']['url']) ){
						echo '<a href="'.esc_url(home_url('/')).'" ><img src="'.esc_url($landshop_opt['main_logo']['url']).'" alt="'.get_bloginfo('name').'" ></a>';
					}elseif( !empty($landshop_opt['sticky_logo']['url']) ){
						echo '<a href="'.esc_url(home_url('/')).'" ><img src="'.esc_url($landshop_opt['sticky_logo']['url']).'" alt="'.get_bloginfo('name').'" ></a>';
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
						'fallback_cb'    => 'landshop_mainmenu_demo_content',
						'walker'         =>  new landshop_Nav_Menu_Walker
					));
				?>
            </div>
            <!--Nav_Menu-End-->

            <!--Nav_Tools-Start-->
            <div class="nav_tools <?php echo esc_attr(($ndata ? 'mobile_menu_toggle' : '')); ?>">
				<?php echo wp_kses_post($data); ?>
            </div>
            <!--Nav_Tools-End-->
        </div>
    </div>
</div>
<div class="navbar-height"></div>

<div class="collapse fade landshop-login-popup" id="login_popup">
<div class="popup-close-overlay" data-bs-toggle="collapse" data-bs-target="#login_popup"></div>
    <div class="popup-middle">
        <button type="button" class="popup-close" data-bs-toggle="collapse" data-bs-target="#login_popup"><svg class="svg-icon"><use xlink:href="<?php echo get_theme_file_uri( 'assets/images/symble.svg#ic-close' ); ?>"></use></svg></button>      
        <?php if ( !is_user_logged_in() ): ?>
        <ul class="nav tab-items" role="tablist">
            <li class="tab-item" role="presentation">
                <button class="nav-link active" id="landshop-login-tab" data-bs-toggle="pill" data-bs-target="#tab-login" type="button" role="tab" aria-controls="tab-login" aria-selected="true"><?php esc_html_e('Login','landshop'); ?></button>
            </li>
            <li class="tab-item" role="presentation">
                <button class="nav-link" id="landshop-register-tab" data-bs-toggle="pill" data-bs-target="#tab-register" type="button" role="tab" aria-controls="tab-register" aria-selected="false"><?php esc_html_e('Registration','landshop'); ?></button>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="tab-login" role="tabpanel" aria-labelledby="landshop-login-tab">
                <?php
                    landshop_login_form();    
                ?>
            </div>
            <div class="tab-pane fade" id="tab-register" role="tabpanel" aria-labelledby="landshop-register-tab">
                <?php
                    landshop_registration_form(); 
                ?>
            </div>
        </div>
        <?php else: ?>
            <div class="popup-author-info">                
                <?php 
                    if(!empty(get_avatar(wp_get_current_user()->ID, '200'))){
                        printf( '<figure class="author_pic">%s</figure>', get_avatar(wp_get_current_user()->ID, '200') );  
                    }
                ?>
                <?php if(!empty(get_user_meta( wp_get_current_user()->ID)['nickname']['0'])): ?>
                    <h3 class="title"><?php echo str_replace("_"," ",esc_html(get_user_meta( wp_get_current_user()->ID)['nickname']['0'])); ?></h3>
                <?php endif; ?>
                <?php if(!empty(get_user_meta( wp_get_current_user()->ID)['description']['0'])): ?>
                    <p class="description"><?php echo esc_html(get_user_meta( wp_get_current_user()->ID)['description']['0']); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>