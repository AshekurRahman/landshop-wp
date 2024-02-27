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
    $landshop_opt['custom_sub__title'] = '/';
    $landshop_opt['sub__title_format'] = 1;
    $landshop_opt['header_actions'] = 0;
} 

if(!function_exists('is_product')){
    function is_product(){
        return false;
    }
}
?>

<!--Site_Header-Start-->
<section class="site__header <?php echo get_post_type(); ?>">
    <div class="container">
        <?php if($landshop_opt['page_title']): ?>
        <h1 class="page_title"><?php echo landshop_page_title(); ?></h1>
        <?php endif; ?>
        <div class="sub__title">
            <?php echo get_bloginfo( 'description' ); ?>
        </div>
    </div>
    <div class="header-actions">
        <?php
            if( $landshop_opt['header_actions'] == 2 ){
                echo '<a href="#scrollDown" class="scrollDown"><i class="fa-light fa-arrow-up"></i></a>    ';
            }elseif($landshop_opt['header_actions'] == 1 and function_exists('landshop_page_breadcrumb') ){
                echo landshop_page_breadcrumb($landshop_opt['breadcrumb_home_2'],$landshop_opt['breadcrumb_separator_2']);
            }
        ?>
    </div>
</section>
<!--Site_Header-End-->
<div id="scrollDown"></div>