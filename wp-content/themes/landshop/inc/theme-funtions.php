<?php

if ( class_exists( 'WooCommerce' ) ) {
    add_action( 'woocommerce_before_add_to_cart_quantity', 'landshop_quantity_before_extra', 0);
    function landshop_quantity_before_extra() {
        $button_label = get_post_meta( get_the_ID(), '_landshop_wc_ex_button_label', true );   
        $button_url = get_post_meta( get_the_ID(), '_landshop_wc_ex_button_url', true );
        echo '<div class="before-extra">';
        if(!empty($button_label) && !empty($button_url)){
            echo '<a class="primary_button gray_button" target="_blank" href="'.esc_url($button_url).'">'.esc_html($button_label).'</a>';
        }
        if(shortcode_exists('ti_wishlists_addtowishlist')){
            echo do_shortcode('[ti_wishlists_addtowishlist]');
        }        
        echo '</div>';
    }
    add_action( 'wp_footer', 'landshop_quantity_plus_minus' );
    function landshop_quantity_plus_minus() {
    // To run this on the single product page
    if ( !is_product() ) return;
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('.quantity').on('click', 'button.plus, button.minus', function() {
                // Get current quantity values
                var qty = $(this).siblings('.qty');
                var val = parseFloat(qty.val());
                var max = parseFloat(qty.attr('max'));
                var min = parseFloat(qty.attr('min'));
                var step = parseFloat(qty.attr('step'));
                // Change the value if plus or minus
                if ($(this).is('.plus')) {
                    if (max && (max <= val)) {
                        qty.val(max);
                    } else {
                        qty.val(val + step);
                    }
                } else {
                    if (min && (min >= val)) {
                        qty.val(min);
                    } else if (val > min) {
                        qty.val(val - step);
                    }
                }
            });
        });
    </script>
    <?php
    }
	function landshop_shop_mini_cart() {
		ob_start();
		echo '<div class="nav_actions">';
			echo '<button type="button" class="tools_icon cart_toggle" data-bs-toggle="collapse" data-bs-target="#nav_mini_cart"><i class="far fa-shopping-bag"></i><span class="shop_count">'.WC()->cart->get_cart_contents_count().'</span></button>';
            echo '<div class="nav_mini_cart collapse woocommerce" id="nav_mini_cart">';
                echo '<div class="cart_header">';
                  echo '<h4 class="header_title">'.esc_html__('Your Cart:','landshop').' <span class="shop_count">'.WC()->cart->get_cart_contents_count().'</span></h4>';
                  echo '<button type="button" class="cart_close" data-bs-toggle="collapse" data-bs-target="#nav_mini_cart"><i class="fal fa-times"></i></button>';
                echo '</div>';
                echo '<div class="cart_body">';
                    woocommerce_mini_cart();
                echo '</div>';
            echo '</div>';
		echo '</div>';
		$data = ob_get_contents();
		ob_end_clean();
		return $data;
	}
	add_filter( 'woocommerce_add_to_cart_fragments', 'landshop_cart_count_fragments' );
	function landshop_cart_count_fragments( $fragments ) {
		$fragments['.shop_count'] = '<span class="shop_count">'.WC()->cart->get_cart_contents_count().'</span>';
		ob_start();
		echo '<div class="cart_body">';
		  woocommerce_mini_cart();
		echo '</div>';
		$fragments['.cart_body'] = ob_get_contents();
		ob_end_clean();        
		return $fragments;
	}
	
	/**
	 * Change number or products per row to 3
	 */
	add_filter('loop_shop_columns', 'landshop_loop_columns', 999);
	if (!function_exists('landshop_loop_columns')) {
		function landshop_loop_columns() {
			if(is_active_sidebar('wc_sidebar')){
				return 2; // 3 products per row
			}else{
				return 3; // 4 products per row
			}
		}
	}

    /*-- WooCommerce-Action-Remove --*/
	add_filter( 'woocommerce_output_related_products_args', 'landshop_related_products_args', 20 );
	  function landshop_related_products_args( $args ) {
		$args['posts_per_page'] = 4; // 4 related products
		$args['columns'] = 3; // arranged in 2 columns
		return $args;
	}
    
	function landshop_template_loop_product_thumbnail( $size = 'landshop_370x278', $deprecated1 = 0, $deprecated2 = 0 ) {
		global $product;
		$image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );
		echo wp_kses_post($product ? $product->get_image( $image_size ) : '');
	}
    
    function woocommerce_template_more_single_meta(){
        $entries = get_post_meta( get_the_ID(), '_landshop_wc_meta_repeat_group', true );
        
        if(!empty($entries)){
            echo '<ul class="product_meta">';
            foreach( $entries as $entrie){
                echo '<li><span class="title">'.wp_kses_post($entrie['_landshop_wc_meta_title']).': </span> <span class="value">'.wp_kses_post($entrie['_landshop_wc_meta_value']).'</span></li>';
            }
            echo '</ul>';
        }else {
            return false;
        }
        
    }
    
    add_action('init',function(){        
        /*-- Remove-Action ---*/
        remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb',20 );    
        /*remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_title',5 );*/
        remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_rating',10 );
        remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_price',10 );
        remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_excerpt',20 );
        remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',30 );
        remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_meta',40 );
        remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_sharing',50 );
        remove_action( 'woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail',10 );

        /*-- Add-Action --*/
        add_action( 'woocommerce_single_product_summary','woocommerce_template_single_rating', 5 );
        add_action( 'woocommerce_single_product_summary','woocommerce_template_single_price', 10 );
        add_action( 'woocommerce_single_product_summary','woocommerce_template_single_excerpt', 20 );
        add_action( 'woocommerce_single_product_summary','woocommerce_template_single_meta', 30 );
        add_action( 'woocommerce_single_product_summary','woocommerce_template_more_single_meta', 35 );
        add_action( 'woocommerce_single_product_summary','woocommerce_template_single_add_to_cart', 40 );
        add_action( 'woocommerce_single_product_summary','woocommerce_template_single_sharing', 50 );
        add_action( 'woocommerce_before_shop_loop_item_title','landshop_template_loop_product_thumbnail',10 );
    });
}


/*----------------
WP_Kses-SVG-Tags-Allowed
-----------------*/
if(!function_exists('landshop_kses_svg_allowed')){
    function landshop_kses_svg_allowed( $tags ) {
        $args = array(
            'svg'   => array(
                'class'           => true,
                'aria-hidden'     => true,
                'aria-labelledby' => true,
                'role'            => true,
                'xmlns'           => true,
                'width'           => true,
                'height'          => true,
                'viewbox'         => true // <= Must be lower case!
            ),
            'g'     => array( 'fill' => true ),
            'title' => array( 'title' => true ),
            'path'  => array(
                'd'               => true, 
                'fill'            => true
            ),
            'use'  => array(
                'xlink:href' => true,
            )
        );
        $allowed = array_merge( $tags, $args );
        return $allowed;
    }
    add_filter( 'wp_kses_allowed_html', 'landshop_kses_svg_allowed', 10, 2 );
}


/*----------------
Add-Body-Class
-----------------*/
function landshop_body_classes( $classes ) {
	if ( class_exists( 'Redux' ) ) {
		global $landshop_opt;
	}else{
		$landshop_opt['navbar_transparent'] = 'off';
	}   
    if( !empty($landshop_opt['navbar_transparent']) ){
        $classes[] = esc_attr($landshop_opt['navbar_transparent']);
    }    
    
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}    
	return $classes;
}
add_filter( 'body_class', 'landshop_body_classes' );


/*-------------------------------------------------------------------------------
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 --------------------------------------------------------------------------------*/
function landshop_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'landshop_pingback_header' );
/*------------------------------------------
Comment-Form-Field-Position-Change-Function 
-------------------------------------------*/
function landshop_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
} 
add_filter( 'comment_form_fields', 'landshop_move_comment_field_to_bottom' );



function landshop_ocdi_import_files() {
  return array(
    array(       
        'import_file_name'  => esc_html__('Home V1','landshop' ),
        'local_import_file' => trailingslashit( get_template_directory() ) . 'lib/dummy/home-1/content.xml',
        'local_import_widget_file'  => trailingslashit( get_template_directory() ) . 'lib/dummy/home-1/widget.wie',
        'local_import_customizer_file'  => trailingslashit( get_template_directory() ) . 'lib/dummy/home-1/customizer.dat',
        'local_import_redux' => array(
            array(
                'file_path'   => trailingslashit( get_template_directory() ) . 'lib/dummy/home-1/redux-options.json',
                'option_name' => 'landshop_opt',
            )
        ),
        'import_preview_image_url'  => get_template_directory_uri().'/lib/dummy/home-1/home-1.png',
        'preview_url'   => 'http://wp.devignedge.com/landshop/',        
    ),
    array(     
        'import_file_name'  => esc_html__('Home V2','landshop' ),
        'local_import_file' => trailingslashit( get_template_directory() ) . 'lib/dummy/home-2/content.xml',
        'local_import_widget_file'  => trailingslashit( get_template_directory() ) . 'lib/dummy/home-2/widget.wie',
        'local_import_customizer_file'  => trailingslashit( get_template_directory() ) . 'lib/dummy/home-2/customizer.dat',
        'local_import_redux' => array(
            array(
                'file_path'   => trailingslashit( get_template_directory() ) . 'lib/dummy/home-2/redux-options.json',
                'option_name' => 'landshop_opt',
            )
        ),
        'import_preview_image_url'  => get_template_directory_uri().'/lib/dummy/home-2/home-2.png',
        'preview_url'   => 'http://wp.devignedge.com/landshop/home-2',        
    ),
    array(     
        'import_file_name'  => esc_html__('Home V3','landshop' ),
        'local_import_file' => trailingslashit( get_template_directory() ) . 'lib/dummy/home-3/content.xml',
        'local_import_widget_file'  => trailingslashit( get_template_directory() ) . 'lib/dummy/home-3/widget.wie',
        'local_import_customizer_file'  => trailingslashit( get_template_directory() ) . 'lib/dummy/home-3/customizer.dat',
        'local_import_redux' => array(
            array(
                'file_path'   => trailingslashit( get_template_directory() ) . 'lib/dummy/home-3/redux-options.json',
                'option_name' => 'landshop_opt',
            )
        ),
        'import_preview_image_url'  => get_template_directory_uri().'/lib/dummy/home-3/home-3.png',
        'preview_url'   => 'http://wp.devignedge.com/landshop/home-3',
    ),
    array(     
        'import_file_name'  => esc_html__('Home V4','landshop' ),
        'local_import_file' => trailingslashit( get_template_directory() ) . 'lib/dummy/home-4/content.xml',
        'local_import_widget_file'  => trailingslashit( get_template_directory() ) . 'lib/dummy/home-4/widget.wie',
        'local_import_customizer_file'  => trailingslashit( get_template_directory() ) . 'lib/dummy/home-4/customizer.dat',
        'local_import_redux' => array(
            array(
                'file_path'   => trailingslashit( get_template_directory() ) . 'lib/dummy/home-4/redux-options.json',
                'option_name' => 'landshop_opt',
            )
        ),
        'import_preview_image_url'  => get_template_directory_uri().'/lib/dummy/home-4/home-4.png',
        'preview_url'   => 'http://wp.devignedge.com/landshop/home-4',
    ),
    array(     
        'import_file_name'  => esc_html__('Home V5','landshop' ),
        'local_import_file' => trailingslashit( get_template_directory() ) . 'lib/dummy/home-5/content.xml',
        'local_import_widget_file'  => trailingslashit( get_template_directory() ) . 'lib/dummy/home-5/widget.wie',
        'local_import_customizer_file'  => trailingslashit( get_template_directory() ) . 'lib/dummy/home-5/customizer.dat',
        'local_import_redux' => array(
            array(
                'file_path'   => trailingslashit( get_template_directory() ) . 'lib/dummy/home-5/redux-options.json',
                'option_name' => 'landshop_opt',
            )
        ),
        'import_preview_image_url'  => get_template_directory_uri().'/lib/dummy/home-5/home-5.png',
        'preview_url'   => 'http://wp.devignedge.com/landshop/home-5',
    ),
    array(     
        'import_file_name'  => esc_html__('Home V6','landshop' ),
        'local_import_file' => trailingslashit( get_template_directory() ) . 'lib/dummy/home-6/content.xml',
        'local_import_widget_file'  => trailingslashit( get_template_directory() ) . 'lib/dummy/home-6/widget.wie',
        'local_import_customizer_file'  => trailingslashit( get_template_directory() ) . 'lib/dummy/home-6/customizer.dat',
        'local_import_redux' => array(
            array(
                'file_path'   => trailingslashit( get_template_directory() ) . 'lib/dummy/home-6/redux-options.json',
                'option_name' => 'landshop_opt',
            )
        ),
        'import_preview_image_url'  => get_template_directory_uri().'/lib/dummy/home-6/home-6.png',
        'preview_url'   => 'http://wp.devignedge.com/landshop/home-6',
    ),
  );
}

add_filter( 'pt-ocdi/import_files', 'landshop_ocdi_import_files' );

/**
 * [landshop_after_import_setup]
 * @return Front Page, Post Page & Menu Set
 */
function landshop_after_import_setup($selected_import) {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Mainmenu', 'nav_menu' );
        set_theme_mod( 'nav_menu_locations', array(
            'primary_menu' => $main_menu->term_id
        )
    );
    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blog' );
    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );    
}
add_action( 'pt-ocdi/after_import', 'landshop_after_import_setup' );



/*-- Mainmenu-Demo-Content --*/
if( !function_exists('landshop_mainmenu_demo_content')){
	function landshop_mainmenu_demo_content(){ 
		if(!current_user_can('edit_theme_options')){
			return;
		}
		printf( wp_kses('<a class="select_menu_link" href="%s">%s</a>',wp_kses_allowed_html('post')), esc_url(admin_url('nav-menus.php')), esc_html__('Setup a menu','landshop'));
	}
}



/*----- Page_Title_&_Sub_Title_HooK_Function -----*/

// Page-Title-Genareted
function landshop_page_title(){    
    if ( class_exists( 'Redux' ) ) {
        global $landshop_opt;
        $blog_title = $landshop_opt['blog_page_title'];
        $search_title = $landshop_opt['search_page_title'];
    }else{
        // Default Value Set In Variable
        $blog_title   = esc_html__( 'Blog List','landshop' );
        $search_title = esc_html__( 'Search','landshop' );
    }
    $data = '';
    // Declare Variable    
    if( is_home() ){        
        $data .= esc_html($blog_title);        
    }elseif(is_single() && 'post' == get_post_type()){
        $data .= get_the_title();
    }elseif(is_single() && 'event' == get_post_type()){
        $data .= esc_html__('Event','landshop');
    }elseif(is_single()){
        $data .= get_the_title();
    }elseif(is_search()){
        $data .= esc_html($search_title).' : <span class="search_select" >'.esc_html(get_search_query()).'</span>';
    }elseif(is_archive()){  
        if( class_exists( 'WooCommerce' ) and is_shop() ){
            $data .= woocommerce_page_title(false);
        }else{
            $data .= get_the_archive_title( '', '' );  
        }              
    }elseif( class_exists( 'WooCommerce' ) and is_woocommerce() ){        
        if( class_exists( 'WooCommerce' ) and is_shop() ){
            $data .= esc_html__( 'Shop Page', 'landshop' );
        }else{
            $data .= woocommerce_page_title(false);
        }        
    }elseif(is_404()){
        $data .= esc_html__('Error Page','landshop');
    }else{        
        $data .= single_post_title('',false);           
    }
	
    // Data-Return...
    if( empty($data) ){
        return false;
    }else{
        return wp_kses( $data, wp_kses_allowed_html('post') );
    }
}

/*----- Post_Thumbnail_Function -----*/
if ( !function_exists( 'landshop_post_thumbnail' ) ) :
    function landshop_post_thumbnail( $thumb_size = 'large' ) {
        if ( post_password_required() || is_attachment() || !has_post_thumbnail() ) {
            return;
        }
        if ( is_single() ) {
            // Is Single Page Attachment Content.            
           printf( '<figure class="post-media">%1$s</figure>',get_the_post_thumbnail( '', $thumb_size )); 
        }else{
            // Is Post Page Attachment Content.
            printf( '<figure class="post-media" ><a href="%1$s" aria-hidden="true">%2$s</a></figure>', get_the_permalink(), get_the_post_thumbnail( '', $thumb_size ));
        }
    }
endif;


/*----- Post_Date_Function_Modify -----*/
if( !function_exists('landshop_get_post_date') ){
	function landshop_get_post_date($format = 'j F, Y'){
		$time_string = sprintf( wp_kses( '<time class="entry-date published updated" datetime="%1$s">%2$s</time>', wp_kses_allowed_html('post')),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date($format) )
		);        
		if(get_the_date('Y/m/d')){
			$data = '<a href="'.get_day_link(get_the_date('Y'),get_the_date('m'),get_the_date('d')).'">'.$time_string.'</a>';		
			return $data;
		}else {
			return false;
		}
	}
}

/*----- Post_Comments_Function_Modify -----*/
if( !function_exists('landshop_get_comment_count') ){
	function landshop_get_comment_count(){
		if ( !post_password_required() && ( comments_open() || get_comments_number() ) && get_comments_number() > 0 ) { 
            $comment_count = get_comments_number_text(esc_html__('No comment','landshop'),esc_html__('1 Comment','landshop'),esc_html__('% Comments','landshop'));
            $data = esc_html($comment_count);
			return $data;
        }else{
			return false;
		}	
	}	
}
    
// Remove issues with prefetching adding extra views
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


// Post title array
if( !function_exists('landshop_get_postTitleArray') ){
	function landshop_get_post_title($postType = 'post') {
		$post_type_query  = new WP_Query(
			array (
				'post_type'      => $postType,
				'posts_per_page' => -1
			)
		);
		// we need the array of posts
		$posts_array      = $post_type_query->posts;
		// the key equals the ID, the value is the post_title
		if( $posts_array ) {
			$post_title_array = wp_list_pluck($posts_array, 'post_title', 'ID');
		} else {
			$post_title_array['default'] = esc_html__('Default', 'landshop');
		}

		return $post_title_array;
	}
}


/**
 * Filter the categories archive widget to add a span around post count
 */
function landshop_cat_count_span( $links ) {
	$links = str_replace( '</a> (', '<span class="post-count">(', $links );
	$links = str_replace( ')', ')</span></a>', $links );
	return $links;
}
add_filter( 'wp_list_categories', 'landshop_cat_count_span' );

/**
 * Filter the archives widget to add a span around post count
 */
function landshop_archive_count_span( $links ) {
	$links = str_replace( '</a>&nbsp;(', '<span class="post-count">(', $links );
	$links = str_replace( ')', ')</span></a>', $links );
	return $links;
}
add_filter( 'get_archives_link', 'landshop_archive_count_span' );