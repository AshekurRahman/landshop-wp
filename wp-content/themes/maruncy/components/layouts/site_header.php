<?php
if ( class_exists( 'Redux' ) ) {
		global $maruncy_opt;
	}else{
		$maruncy_opt = array();
		$maruncy_opt['page_title'] = '1';
		$maruncy_opt['breadcrumb_home'] = 'Home';
		$maruncy_opt['breadcrumb_separator'] = '/';
		$maruncy_opt['custom_sub_title'] = '/';
		$maruncy_opt['sub_title_format'] = 1;
		$maruncy_opt['header_element_one']['url'] = get_theme_file_uri( 'assets/images/element-1.svg' );
		$maruncy_opt['header_element_two']['url'] = get_theme_file_uri( 'assets/images/element-2.svg' );
		$maruncy_opt['header_element_three']['url'] = get_theme_file_uri( 'assets/images/element-3.svg' );
	} 

    if(!function_exists('is_product')){
        function is_product(){
            return false;
        }
    }
?>


<!--Site_Header-Start-->
<section class="site-header <?php echo get_post_type(); ?>">
    <div class="container">
        <?php if($maruncy_opt['page_title']): ?>
        <h1 class="page_title"><?php echo maruncy_page_title(); ?></h1>
        <?php endif; ?>
        <div class="sub_title">
            <?php
                if( $maruncy_opt['sub_title_format'] == 1 && !is_product()){
                    echo '<div class="sub-title site-description">'.get_bloginfo( 'description' ) .'</div>';
                }elseif($maruncy_opt['sub_title_format'] == 2 and function_exists('maruncy_page_breadcrumb') ){
                    echo maruncy_page_breadcrumb($maruncy_opt['breadcrumb_home'],$maruncy_opt['breadcrumb_separator']);
                }elseif($maruncy_opt['sub_title_format'] == 3 and !empty($maruncy_opt['custom_sub_title']) ){
                    echo '<div class="sub-title">'. wp_kses_post($maruncy_opt['custom_sub_title']) .'</div>';
                }
            ?>
        </div>
    </div>
    <?php if(!empty($maruncy_opt['header_element_one']['url'])): ?>
    <div class="element element-1">
        <img src="<?php echo esc_url($maruncy_opt['header_element_one']['url']); ?>" alt="<?php _e('Shpae','maruncy'); ?>">
    </div>
    <?php endif; ?>
    <?php if(!empty($maruncy_opt['header_element_two']['url'])): ?>
    <div class="element element-2">
        <img src="<?php echo esc_url($maruncy_opt['header_element_two']['url']); ?>" alt="<?php _e('Shpae','maruncy'); ?>">
    </div>
    <?php endif; ?>
    <?php if(!empty($maruncy_opt['header_element_three']['url'])): ?>
    <div class="element element-3">
        <img src="<?php echo esc_url($maruncy_opt['header_element_three']['url']); ?>" alt="<?php _e('Shpae','maruncy'); ?>">
    </div>
    <?php endif; ?>
</section>
<!--Site_Header-End-->