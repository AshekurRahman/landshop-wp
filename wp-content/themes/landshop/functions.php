<?php
// Landshop Theme Setup
if( !function_exists('landshop_setup_theme') ){
	function landshop_setup_theme(){
		/*
		* Make theme available for translation.
		* If you're building a theme based on Landshop, use a find and replace
		* to change 'landshop' to the name of your theme in all the template files
		*/
		load_theme_textdomain( 'landshop', get_theme_file_path('/languages/') );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
		add_theme_support( 'title-tag' );
		
		/*
		* Enable support for custom logo.
		*/
		add_theme_support( 'custom-logo', array(
			'flex-height' => true
		) );

		/*
		* Enable support for woocommerce.
		*/
		if( class_exists( 'WooCommerce' ) ){   
			add_theme_support( 'woocommerce', 
				array(
					'thumbnail_image_width' => 400,
					'gallery_thumbnail_image_width' => 300,
					'single_image_width'    => 800,
					'product_grid' => array(
						'default_rows'    => 3,
						'min_rows'        => 1,
						'max_rows'        => 6,
						'default_columns' => 3,
						'min_columns'     => 1,
						'max_columns'     => 5,
					),
				)
			);
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );
		}
		// Setup the WordPress core custom background feature.
		/**
		 * Filter Landshop custom-header support arguments.
		 *
		 * @since Landshop 1.0
		 *
		 * @param array $args {
		 *     An array of custom-header support arguments.
		 *
		 *     @type string $default-color     		Default color of the header.
		 *     @type string $default-attachment     Default attachment of the header.
		 * }
		 */
		add_theme_support( 
			'custom-background',
				apply_filters(
					'landshop_custom_background_args', array(
						'default-color'      => 'ffffff'
					)
			)
		);     

		// Setup the WordPress core custom header background feature.    
		add_theme_support( 'custom-header', apply_filters( 'landshop_custom_header_args', array(
			'default-text-color'     => 'ffffff',
			'wp-head-callback'       => 'landshop_header_style',
		) ) );

		if ( ! function_exists( 'landshop_header_style' ) ) {
		   function landshop_header_style() {
				if ( get_theme_support( 'custom-header', 'default-text-color' ) === get_header_textcolor() ) {
					return;
				}
			} 
		}

		/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		*/
		add_theme_support( 'post-thumbnails' );
        add_image_size( 'landshop_370x266', 570, 410, true );
        add_image_size( 'landshop_540x430', 740, 590, true );
        add_image_size( 'landshop_405x470', 605, 702, true );
        add_image_size( 'landshop_370x320', 570, 492, true );
        add_image_size( 'landshop_560x470', 760, 638, true );
        add_image_size( 'landshop_370x465', 570, 716, true );
        add_image_size( 'landshop_560x380', 760, 516, true );
        add_image_size( 'landshop_550x500', 750, 680, true );
        add_image_size( 'landshop_570x520', 770, 702, true );
        add_image_size( 'landshop_560x597', 760, 810, true );
        add_image_size( 'landshop_1170x570', 1370, 660, true );
        add_image_size( 'landshop_770x600', 970, 756, true );
        add_image_size( 'landshop_770x600', 970, 756, true );
        add_image_size( 'landshop_230x223', 330, 320, true );
        add_image_size( 'landshop_370x425', 570, 656, true );
        add_image_size( 'landshop_370x240', 570, 370, true );
        add_image_size( 'landshop_770x450', 970, 566, true );
        add_image_size( 'landshop_560x430', 760, 584, true );
        add_image_size( 'landshop_370x350', 570, 540, true );
        add_image_size( 'landshop_370x278', 570, 428, true );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'primary_menu' => esc_html__( 'Primary Menu', 'landshop' )
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'status',
			'audio',
			'chat',
		) );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'assets/css/editor-style.css' ) );

		// Indicate widget sidebars can use selective refresh in the Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		
		// Disables the block editor from managing widgets in the Gutenberg plugin.
		add_filter( 'gutenberg_use_widgets_block_editor', '__return_false', 100 );
		// Disables the block editor from managing widgets.
		add_filter( 'use_widgets_block_editor', '__return_false' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for HTML5.
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );

		// Add support for custom spacing.
		add_theme_support( 'custom-spacing' );

		// Add support for custom line height.
		add_theme_support( 'custom-line-height' );
        
        // Used for OnePage Template Back Link 
        if( !function_exists('landshop_detect_homepage') ){
            function landshop_detect_homepage() {
                $onepage = '';
                $onepage = get_post_meta( get_the_ID(), '_landshop_one_page_scroll', true );
                /*If front page is set to display a static page, get the URL of the posts page.*/
                $homepage_id = get_option( 'page_on_front' );
                /*current page id*/
                $current_page_id = ( is_page( get_the_ID() ) ) ? get_the_ID() : '';
                if( $homepage_id == $current_page_id or $onepage == 'on'  ) {
                    return true;
                } else {
                    return false;
                }
            }
        }
	}
}
add_action( 'after_setup_theme', 'landshop_setup_theme' );


/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Landshop 1.0.0
 */
if( !function_exists('landshop_widgets_init') ){
    function landshop_widgets_init() {
        register_sidebar( array(
            'name'          => esc_html__( 'Sidebar', 'landshop' ),
            'id'            => 'main_sidebar',
            'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'landshop' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h5 class="widget_title">',
            'after_title'   => '</h5>',
        ) );
        
        if( class_exists( 'WooCommerce' ) ){            
            register_sidebar( array(
                'name'          => esc_html__( 'WooCommerce Sidebar', 'landshop' ),
                'id'            => 'wc_sidebar',
                'description'   => esc_html__( 'Add widgets here to appear in your woocommerce sidebar.', 'landshop' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h5 class="widget_title">',
                'after_title'   => '</h5>',
            ) );
        }
        register_sidebar( array(
            'name'          => esc_html__( 'Footer Widget', 'landshop' ),
            'id'            => 'footer_sidebar',
            'description'   => esc_html__( 'Add footer widgets.', 'landshop' ),
            'before_widget' => '<section id="%1$s" class="widget footer_widget %2$s col-xl-3 col-lg-4 col-sm-6">',
            'after_widget'  => '</section>',
            'before_title'  => '<h5 class="widget_title">',
            'after_title'   => '</h5>',
        ) );
    }
}
add_action( 'widgets_init', 'landshop_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function landshop_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'landshop_content_width', 850 );
}
add_action( 'after_setup_theme', 'landshop_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function landshop_scripts() {
	// Add Theme-custom-fonts.
	wp_enqueue_style( 'landshop_fonts', get_theme_file_uri('/assets/css/theme-fonts.css'), array(), '1.0.0' );   
	// Add Bootstrap, Used for default grid system.
	wp_enqueue_style( 'bootstrap', get_theme_file_uri('/assets/css/bootstrap-min.css'), array(), '5.1.1' );                  
	// Add Normalizer, Used for remove default tag style.
	wp_enqueue_style( 'normalizer', get_theme_file_uri('/assets/css/normalize.css'), array(), '8.0.1' );
	// Add slicknav, Used for responsive mobile menu.
	wp_enqueue_style( 'slicknav', get_theme_file_uri('/assets/css/slicknav.css'), array(), '1.0.10' );             
	// Add FontAwesome, Used for font icons.
	wp_enqueue_style( 'fontawesome', get_theme_file_uri('/assets/css/fontawesome-min.css'), array(), '5.8.1' );
	if( class_exists( 'WooCommerce' ) ){
		// Add WooCommerce style overwrite css
		wp_enqueue_style( 'woocommerce-overwrite', get_theme_file_uri('/assets/css/woocommerce.css'), array(), wp_get_theme()->get( 'Version' )  );	
	}
	// Add Landshop Theme CSS, Used for important structure style.
	wp_enqueue_style( 'landshop-theme', get_theme_file_uri('/assets/css/theme.css'), array(), wp_get_theme()->get( 'Version' )  );	
	// Theme stylesheet.
	wp_enqueue_style( 'landshop-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
	wp_style_add_data( 'landshop-style', 'rtl', 'replace' );	
	// Add responsive, Used for mobile style.
	wp_enqueue_style( 'landshop-responsive', get_theme_file_uri('/assets/css/responsive.css'), array(), '1.0.0' );
	
	
	// Add html5shiv. Used for support html5 tag.
	wp_enqueue_script( 'html5shiv', get_theme_file_uri('/assets/js/vendor/html5shiv-min.js'), array(), '3.7.2' );
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );
	// Add respond. A polyfill is a browser fallback, made in JavaScript work in older browsers.
	wp_enqueue_script( 'respond', get_theme_file_uri('/assets/js/vendor/respond-min.js'), array(), '1.4.2' );
	wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );
	// Add jQuery-Fitvids, Used for responsive Video.
	wp_enqueue_script( 'jquery-fitvids', get_theme_file_uri('/assets/js/fitvids.js'), array('jquery'), '1.1.0', true );    
	// Add jQuery-Fitvids, Used for responsive Video.
	wp_enqueue_script( 'jquery-prefixfree', get_theme_file_uri('/assets/js/prefixfree-min.js'), array('jquery'), '1.1.0', true ); 
	// Add SlickNav, Used for responsive mobile menu.
	wp_enqueue_script( 'slicknav', get_theme_file_uri('/assets/js/slicknav-min.js'), array('jquery'), '1.0.10', true );
	wp_enqueue_script( 'animatenumber', get_theme_file_uri('/assets/js/animatenumber-min.js'), array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'jquery-appear', get_theme_file_uri('/assets/js/jquery-appear.js'), array('jquery'), '0.3.3', true );
	// Add Bootstrap, Used for default normal effect.
	wp_enqueue_script( 'bootstrap', get_theme_file_uri('/assets/js/bootstrap-bundle-min.js'), array('jquery'), '5.1.1', true );		
	wp_enqueue_script( 'landshop-active', get_theme_file_uri('/assets/js/active.js'), array('jquery','jquery-masonry','imagesloaded'), wp_get_theme()->get( 'Version' ), true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    
	 
	if ( class_exists( 'Redux' ) ) {
		global $landshop_opt;
	}else{
		$landshop_opt['custom_css_options'] = '';
		$landshop_opt['nav_button_radius'] = '';
		$landshop_opt['nav_shop_radius'] = '';
		$landshop_opt['nav_search_radius'] = '';
		$landshop_opt['toggle_menu_radius'] = '';
		$landshop_opt['nav_button_radius'] = '';
		$landshop_opt['page_header_align'] = 'left';
		$landshop_opt['section-padding'] = array('height' => '136');
		$landshop_opt['navbar_height'] = array('height' => '120');
        
		$landshop_opt['primary_color'] = '#F1554C';
		$landshop_opt['heading_color'] = '#10131F';
		$landshop_opt['text_color'] = '#6E6E78';
		$landshop_opt['white_color'] = '#ffffff';
		$landshop_opt['gray_color'] = '#f7f7f7';
		$landshop_opt['dark_color'] = '#10131F';
		$landshop_opt['footer_heading_color'] = '#ffffff';
		$landshop_opt['footer_text_color'] = '#9FA1A5';
		$landshop_opt['footer_gray_color'] = '#1E212C';
		$landshop_opt['footer_white_color'] = '#ffffff';        
		$landshop_opt['mobile_menu_active'] = '1200';
	}
	
	$custom_css = '';
	list($primaryR, $primaryG, $primaryB) = sscanf($landshop_opt['primary_color'], "#%02x%02x%02x");	
	list($headingR, $headingG, $headingB) = sscanf($landshop_opt['heading_color'], "#%02x%02x%02x");	
	list($textR, $textG, $textB) = sscanf($landshop_opt['text_color'], "#%02x%02x%02x");	
	list($whiteR, $whiteG, $whiteB) = sscanf($landshop_opt['white_color'], "#%02x%02x%02x");	
	list($grayR, $grayG, $grayB) = sscanf($landshop_opt['gray_color'], "#%02x%02x%02x");	
	list($darkR, $darkG, $darkB) = sscanf($landshop_opt['dark_color'], "#%02x%02x%02x");	
	list($fhR, $fhG, $fhB) = sscanf($landshop_opt['footer_heading_color'], "#%02x%02x%02x");	
	list($ftR, $ftG, $ftB) = sscanf($landshop_opt['footer_text_color'], "#%02x%02x%02x");	
	list($fgR, $fgG, $fgB) = sscanf($landshop_opt['footer_gray_color'], "#%02x%02x%02x");	
	list($ffR, $ffG, $ffB) = sscanf($landshop_opt['footer_white_color'], "#%02x%02x%02x");	
    
    	
    if( is_page() and has_post_thumbnail() ){
        $custom_css .= sprintf('.site-header { background-image: url(%s) !important; }', esc_url(get_the_post_thumbnail_url()) );
    }elseif(!empty(get_header_image())){
        $custom_css .= sprintf('.site-header { background-image: url(%s) }', esc_url(get_header_image()) );
    }
    
    $custom_css .= '
    :root {
        --primary-color: '.$primaryR.', '.$primaryG.', '.$primaryB.';
        --heading-color: '.$headingR.', '.$headingG.', '.$headingB.';
        --text-color: '.$textR.', '.$textG.', '.$textB.';
        --white-color: '.$whiteR.', '.$whiteG.', '.$whiteB.';
        --gray-color: '.$grayR.', '.$grayG.', '.$grayB.';
        --dark-color: '.$darkR.', '.$darkG.', '.$darkB.';
        --section-padding: '.$landshop_opt['section-padding']['height'].'px;
        --navbar-height: '.$landshop_opt['navbar_height']['height'].'px;

    }            
    .site-header {
        text-align: '.esc_attr($landshop_opt['page_header_align']).';
    }
    .footer_area {
        --heading-color: '.$fhR.', '.$fhG.', '.$fhB.';
        --text-color: '.$ftR.', '.$ftG.', '.$ftB.';
        --gray-color: '.$fgR.', '.$fgG.', '.$fgB.';
        --white-color: '.$ffR.', '.$ffG.', '.$ffB.';
    }';
    
    
    $custom_css .= '
        @media screen and (max-width: '.(!empty($landshop_opt['mobile_menu_active']) ? esc_attr($landshop_opt['mobile_menu_active']) : '992' ).'px) {
            .nav_area .slicknav_menu {
                display: block;
            }

            .nav_area .nav_menu {
                display: none;
            }

            .nav_area .mobile_menu_toggle {
                display: flex !important;
            }

            .nav_area .nav > li > a:before {
                display: none !important;
            }
        }
    ';
    if('page' == get_post_type() && !empty(get_post_meta( get_the_ID(), '_landshop_page_background', 1 ))){
        $custom_css .= '.page-section { 
            background-image: url("'.esc_url(get_post_meta( get_the_ID(), '_landshop_page_background', 1 )).'");
        }';
    }
    if( isset( $landshop_opt['nav_button_radius'] ) and !empty($landshop_opt['nav_button_radius']['top']) or !empty($landshop_opt['nav_button_radius']['bottom']) or !empty($landshop_opt['nav_button_radius']['left']) or !empty($landshop_opt['nav_button_radius']['right'])){
        $custom_css .= '.nav_area .primary_button { 
            border-radius: '.esc_attr($landshop_opt['nav_button_radius']['top']).' '.esc_attr($landshop_opt['nav_button_radius']['right']).' '.esc_attr($landshop_opt['nav_button_radius']['bottom']).' '.esc_attr($landshop_opt['nav_button_radius']['left']).';
        }';
    }
    if( isset( $landshop_opt['toggle_menu_radius'] ) and !empty($landshop_opt['toggle_menu_radius']['top']) or !empty($landshop_opt['toggle_menu_radius']['bottom']) or !empty($landshop_opt['toggle_menu_radius']['left']) or !empty($landshop_opt['toggle_menu_radius']['right'])){
        $custom_css .= '.nav_area .mobile_menu_toggle { 
            border-radius: '.esc_attr($landshop_opt['toggle_menu_radius']['top']).' '.esc_attr($landshop_opt['toggle_menu_radius']['right']).' '.esc_attr($landshop_opt['toggle_menu_radius']['bottom']).' '.esc_attr($landshop_opt['toggle_menu_radius']['left']).';
        }';
    }
    if( isset( $landshop_opt['nav_search_radius'] ) and !empty($landshop_opt['nav_search_radius']['top']) or !empty($landshop_opt['nav_search_radius']['bottom']) or !empty($landshop_opt['nav_search_radius']['left']) or !empty($landshop_opt['nav_search_radius']['right'])){
        $custom_css .= '.nav_area .search_toggle { 
            border-radius: '.esc_attr($landshop_opt['nav_search_radius']['top']).' '.esc_attr($landshop_opt['nav_search_radius']['right']).' '.esc_attr($landshop_opt['nav_search_radius']['bottom']).' '.esc_attr($landshop_opt['nav_search_radius']['left']).';
        }';
    }
    if( isset( $landshop_opt['nav_shop_radius'] ) and !empty($landshop_opt['nav_shop_radius']['top']) or !empty($landshop_opt['nav_shop_radius']['bottom']) or !empty($landshop_opt['nav_shop_radius']['left']) or !empty($landshop_opt['nav_shop_radius']['right'])){
        $custom_css .= '.nav_area .cart_toggle { 
            border-radius: '.esc_attr($landshop_opt['nav_shop_radius']['top']).' '.esc_attr($landshop_opt['nav_shop_radius']['right']).' '.esc_attr($landshop_opt['nav_shop_radius']['bottom']).' '.esc_attr($landshop_opt['nav_shop_radius']['left']).';
        }';
    }
    if( isset( $landshop_opt['nav_button_radius'] ) and !empty($landshop_opt['nav_button_radius']['top']) or !empty($landshop_opt['nav_button_radius']['bottom']) or !empty($landshop_opt['nav_button_radius']['left']) or !empty($landshop_opt['nav_button_radius']['right'])){
        $custom_css .= '.post-box .primary_button { 
            border-radius: '.esc_attr($landshop_opt['nav_button_radius']['top']).' '.esc_attr($landshop_opt['nav_button_radius']['right']).' '.esc_attr($landshop_opt['nav_button_radius']['bottom']).' '.esc_attr($landshop_opt['nav_button_radius']['left']).';
        }';
    }
    if(isset($landshop_opt['custom_css'])){
        $custom_css .= $landshop_opt['custom_css'];
    }
	wp_add_inline_style( 'landshop-theme', $custom_css );
    
        // Register the script
 	wp_register_script( 'custom-script', get_theme_file_uri('/assets/js/myloadmore.js'), array('jquery'), false, true );
    // Localize the script with new data
    $script_data_array = array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'security' => wp_create_nonce( 'load_more_posts' ),
    );
    wp_localize_script( 'custom-script', 'blog', $script_data_array );
 
    // Enqueued script with localized data.
    wp_enqueue_script( 'custom-script' );
}
add_action( 'wp_enqueue_scripts', 'landshop_scripts' );

add_action('wp_ajax_load_posts_by_ajax', 'landshop_load_ajax_callback');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'landshop_load_ajax_callback');
function landshop_load_ajax_callback() {
    check_ajax_referer('load_more_posts', 'security');
    $paged = $_POST['page'];
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => '3',
        'paged' => $paged,
    );
    $blog_posts = new WP_Query( $args );
    ?>
 
    <?php if ( $blog_posts->have_posts() ) : ?>
        <?php
            while ( $blog_posts->have_posts() ) : 
            $blog_posts->the_post(); 
        ?>
        <div class="col-lg-4 col-md-6">
           <div <?php post_class('post-box box-style-2'); ?>>
                <?php
                    the_post_thumbnail('landshop_370x266');
                ?>
                <div class="content"> 
                    <h4 class="title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h4>

                    <div class="footer_meta_list">
                        <ul>
                          <?php if(get_the_category()): ?>
                           <li class="category">
                               <a href="<?php echo home_url( get_the_category()[0]->taxonomy.'/'.get_the_category()[0]->slug); ?>"><?php echo get_the_category()[0]->name; ?></a>
                           </li>
                           <?php endif; ?>
                            <?php if(landshop_get_post_date()): ?>
                            <li class="date">
                                <?php echo landshop_get_post_date(); ?>
                            </li>
                            <?php endif; ?>
                            <li class="link-arrow">
                                <a href="<?php echo get_permalink(); ?>"><i class="fal fa-arrow-right"></i></a>
                            </li>
                        </ul>
                    </div>                                             
                </div>
            </div>
        </div>
<?php 
    endwhile;
    wp_reset_postdata();    
    endif;

    wp_die();
}



add_action('wp_ajax_load_case_by_ajax', 'landshop_load_posts_ajax_callback');
add_action('wp_ajax_nopriv_load_case_by_ajax', 'landshop_load_posts_ajax_callback');
function landshop_load_posts_ajax_callback() {
    check_ajax_referer('load_more_posts', 'security');
    $paged = $_POST['page'];
    $args = array(
        'post_type' => 'case-studie',
        'post_status' => 'publish',
        'posts_per_page' => '3',
        'paged' => $paged,
    );
    $blog_posts = new WP_Query( $args );
    ?>
 
    <?php if ( $blog_posts->have_posts() ) : ?>
        <?php
            while ( $blog_posts->have_posts() ) : 
            $blog_posts->the_post(); 
        ?>
        <div class="col-lg-4 col-md-6">
            <div class="case_studie_box box-4">
             <?php if(has_post_thumbnail()): ?>
              <figure class="photo">
                <?php the_post_thumbnail('landshop_370x425'); ?>
              </figure>
              <?php endif; ?>
              <div class="case_studie_content">
                <div class="w-100">
                    <?php
                    echo get_the_term_list( get_the_ID(), 'case-studie-category', '<div class="cats">', ' ', '</div>' );
                    ?>
                    <?php if(get_the_title()): ?>
                      <h4 class="title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                      </h4>
                    <?php endif; ?>
                </div>
              </div>
            </div>
        </div>
        <?php 
    endwhile;
    wp_reset_postdata();    
    endif;

    wp_die();
}

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function landshop_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
<script>
    /(trident|msie)/i.test(navigator.userAgent) && document.getElementById && window.addEventListener && window.addEventListener("hashchange", function() {
        var t, e = location.hash.substring(1);
        /^[A-z0-9_-]+$/.test(e) && (t = document.getElementById(e)) && (/^(?:a|select|input|button|textarea)$/i.test(t.tagName) || (t.tabIndex = -1), t.focus())
    }, !1);
</script>
<?php
}
add_action( 'wp_print_footer_scripts', 'landshop_skip_link_focus_fix' );

// Landshop All Function Pack.
require get_theme_file_path('/inc/theme-funtions.php');

// Install Required Plugin.
require get_theme_file_path('/inc/theme-plugin-activation.php');

// Theme Options
require get_theme_file_path('/inc/theme-option.php');

// Customizer Add Option.
require get_theme_file_path('/inc/customizer.php');

// OnePage Nav Waker Function.
require get_theme_file_path('/inc/nav-menu-walker.php');