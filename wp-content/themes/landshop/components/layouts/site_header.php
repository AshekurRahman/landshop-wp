<?php
if ( class_exists( 'Redux' ) ) {
		global $landshop_opt;
	}else{
		$landshop_opt = array();
		$landshop_opt['page_title'] = '1';
		$landshop_opt['breadcrumb_home'] = 'Home';
		$landshop_opt['breadcrumb_home_2'] = 'Home';
		$landshop_opt['breadcrumb_separator'] = '/';
		$landshop_opt['breadcrumb_separator_2'] = '/';
		$landshop_opt['custom_sub_title'] = '/';
		$landshop_opt['sub_title_format'] = 1;
		$landshop_opt['header_actions'] = 0;
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
        <div class="sub_title">
            <?php
                if( $landshop_opt['sub_title_format'] == 1 && !is_product() ){
                    echo '<div class="site-description">'.get_bloginfo( 'description' ) .'</div>';
                }elseif($landshop_opt['sub_title_format'] == 2 and function_exists('landshop_page_breadcrumb') ){
                    echo landshop_page_breadcrumb($landshop_opt['breadcrumb_home'],$landshop_opt['breadcrumb_separator']);
                }elseif($landshop_opt['sub_title_format'] == 3 and !empty($landshop_opt['custom_sub_title']) ){
                    echo '<div class="sub-title">'. wp_kses_post($landshop_opt['custom_sub_title']) .'</div>';
                }
            ?>
            <?php if($landshop_opt['page_title']): ?>
            <h1 class="page_title"><?php echo landshop_page_title(); ?></h1>
            <?php endif; ?>
        </div>
    </div>
    <div class="header-actions">
        <?php
            if( $landshop_opt['header_actions'] == 2 ){
                echo '<a href="#scrollDown" class="scrollDown"><i class="far fa-long-arrow-down"></i></a>    ';
            }elseif($landshop_opt['header_actions'] == 1 and function_exists('landshop_page_breadcrumb') ){
                echo landshop_page_breadcrumb($landshop_opt['breadcrumb_home_2'],$landshop_opt['breadcrumb_separator_2']);
            }
        ?>
    </div>
</section>
<!--Site_Header-End-->
<div id="scrollDown"></div>