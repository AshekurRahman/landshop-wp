<?php
// Maruncy Theme Setup
if( !function_exists('maruncy_setup_theme') ){
	function maruncy_setup_theme(){
		/*
		* Make theme available for translation.
		* If you're building a theme based on maruncy, use a find and replace
		* to change 'maruncy' to the name of your theme in all the template files
		*/
		load_theme_textdomain( 'maruncy', get_theme_file_path('/languages/') );

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
		 * Filter Maruncy custom-header support arguments.
		 *
		 * @since Maruncy 1.0
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
					'maruncy_custom_background_args', array(
						'default-color'      => 'ffffff'
					)
			)
		);     

		// Setup the WordPress core custom header background feature.    
		add_theme_support( 'custom-header', apply_filters( 'maruncy_custom_header_args', array(
			'default-text-color'     => 'ffffff',
			'wp-head-callback'       => 'maruncy_header_style',
		) ) );

		if ( ! function_exists( 'maruncy_header_style' ) ) {
		   function maruncy_header_style() {
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
        add_image_size( 'maruncy-feature-image', 1400, 980, true );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'primary_menu' => esc_html__( 'Primary Menu', 'maruncy' )
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
        if( !function_exists('maruncy_detect_homepage') ){
            function maruncy_detect_homepage() {
                $onepage = '';
                $onepage = get_post_meta( get_the_ID(), '_maruncy_one_page_scroll', true );
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
add_action( 'after_setup_theme', 'maruncy_setup_theme' );


/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Maruncy 1.0.0
 */
if( !function_exists('maruncy_widgets_init') ){
    function maruncy_widgets_init() {
        register_sidebar( array(
            'name'          => esc_html__( 'Sidebar', 'maruncy' ),
            'id'            => 'main_sidebar',
            'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'maruncy' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h5 class="widget_title">',
            'after_title'   => '</h5>',
        ) );
        
        if( class_exists( 'WooCommerce' ) ){            
            register_sidebar( array(
                'name'          => esc_html__( 'WooCommerce Sidebar', 'maruncy' ),
                'id'            => 'wc_sidebar',
                'description'   => esc_html__( 'Add widgets here to appear in your woocommerce sidebar.', 'maruncy' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h5 class="widget_title">',
                'after_title'   => '</h5>',
            ) );
        }
        register_sidebar( array(
            'name'          => esc_html__( 'Footer Widget', 'maruncy' ),
            'id'            => 'footer_sidebar',
            'description'   => esc_html__( 'Add footer widgets.', 'maruncy' ),
            'before_widget' => '<section id="%1$s" class="widget footer_widget %2$s col-xl-3 col-lg-4 col-sm-6">',
            'after_widget'  => '</section>',
            'before_title'  => '<h5 class="widget_title">',
            'after_title'   => '</h5>',
        ) );
    }
}
add_action( 'widgets_init', 'maruncy_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function maruncy_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'maruncy_content_width', 850 );
}
add_action( 'after_setup_theme', 'maruncy_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function maruncy_scripts() {
	// Add cereberi-sans-font.
	wp_enqueue_style( 'theme-icon', get_theme_file_uri('/assets/css/theme-icon.css'), array(), '1.0.0' );  
	// Add cereberi-sans-font.
	wp_enqueue_style( 'cereberi-sans-fonts', get_theme_file_uri('/assets/css/cereberi-sans.css'), array(), '1.0.0' );           
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
	// Add Maruncy Theme CSS, Used for important structure style.
	wp_enqueue_style( 'maruncy-theme', get_theme_file_uri('/assets/css/theme.css'), array(), wp_get_theme()->get( 'Version' )  );	
	// Theme stylesheet.
	wp_enqueue_style( 'maruncy-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
	wp_style_add_data( 'maruncy-style', 'rtl', 'replace' );	
	// Add responsive, Used for mobile style.
	wp_enqueue_style( 'maruncy-responsive', get_theme_file_uri('/assets/css/responsive.css'), array(), '1.0.0' );
	
	
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
	wp_enqueue_script( 'maruncy-active', get_theme_file_uri('/assets/js/active.js'), array('jquery','jquery-masonry','imagesloaded'), wp_get_theme()->get( 'Version' ), true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    
	 
	if ( class_exists( 'Redux' ) ) {
		global $maruncy_opt;
	}else{
		$maruncy_opt['custom_css_options'] = '';
		$maruncy_opt['nav_button_radius'] = '';
		$maruncy_opt['nav_shop_radius'] = '';
		$maruncy_opt['nav_search_radius'] = '';
		$maruncy_opt['toggle_menu_radius'] = '';
		$maruncy_opt['nav_button_radius'] = '';
		$maruncy_opt['page_header_align'] = 'left';
		$maruncy_opt['primary_color'] = '#FF6854';
		$maruncy_opt['secondary_color'] = '#3AC4E5';
		$maruncy_opt['heading_color'] = '#010212';
		$maruncy_opt['text_color'] = '#0C0D24';
		$maruncy_opt['footer_heading_color'] = '#ffffff';
		$maruncy_opt['footer_text_color'] = '#ffffff';
		$maruncy_opt['footer_gray_color'] = '#2B2A3A';
		$maruncy_opt['body_bg'] = '#ffffff';
		$maruncy_opt['black_bg'] = '#252220';
		$maruncy_opt['gray_bg'] = '#E5E4E4';
		$maruncy_opt['mobile_menu_active'] = '1200';
	}
	
	$custom_css = '';
	list($ftTR, $ftTG, $ftTB) = sscanf($maruncy_opt['footer_heading_color'], "#%02x%02x%02x");	
	list($ftCR, $ftCG, $ftCB) = sscanf($maruncy_opt['footer_text_color'], "#%02x%02x%02x");	
	list($ftLR, $ftLG, $ftLB) = sscanf($maruncy_opt['footer_gray_color'], "#%02x%02x%02x");	
	list($primaryR, $primaryG, $primaryB) = sscanf($maruncy_opt['primary_color'], "#%02x%02x%02x");	
	list($headingR, $headingG, $headingB) = sscanf($maruncy_opt['heading_color'], "#%02x%02x%02x");	
	list($txtR, $txtG, $txtB) = sscanf($maruncy_opt['text_color'], "#%02x%02x%02x");	
	list($balckR, $balckG, $balckB) = sscanf($maruncy_opt['black_bg'], "#%02x%02x%02x");	
	list($bodyR, $bodyG, $bodyB) = sscanf($maruncy_opt['body_bg'], "#%02x%02x%02x");	
	list($grayR, $grayG, $grayB) = sscanf($maruncy_opt['gray_bg'], "#%02x%02x%02x");	
	
    if( is_page() and has_post_thumbnail() ){
        $custom_css .= sprintf('.site-header { background-image: url(%s) !important; }', esc_url(get_the_post_thumbnail_url()) );
    }elseif(!empty(get_header_image())){
        $custom_css .= sprintf('.site-header { background-image: url(%s) }', esc_url(get_header_image()) );
    } 
	$custom_css .= '
	.site-header {
		text-align: '.$maruncy_opt['page_header_align'].';
	}';
    

    $custom_css .= '
        @media screen and (max-width: '.(!empty($maruncy_opt['mobile_menu_active']) ? esc_attr($maruncy_opt['mobile_menu_active']) : '992' ).'px) {
            .slicknav_menu {
                display: block;
            }

            .nav_menu {
                display: none;
            }

            .mobile_menu_toggle {
                display: block !important;
            }

            .nav_area .nav > li > a:before {
                display: none !important;
            }

            .navbar-style-3 .nav_area {
                padding: 0px 10px;
            }            

            .navbar-style-3 {
                --navbar-height: 90px;
            }

            .navbar-style-3 .site-header {
                padding-top: 200px;
            }
        }
    ';
    if('page' == get_post_type() && !empty(get_post_meta( get_the_ID(), '_maruncy_page_background', 1 ))){
        $custom_css .= '.page-section { 
            background-image: url("'.esc_url(get_post_meta( get_the_ID(), '_maruncy_page_background', 1 )).'");
        }';
    }
    if( isset( $maruncy_opt['nav_button_radius'] ) and !empty($maruncy_opt['nav_button_radius']['top']) or !empty($maruncy_opt['nav_button_radius']['bottom']) or !empty($maruncy_opt['nav_button_radius']['left']) or !empty($maruncy_opt['nav_button_radius']['right'])){
        $custom_css .= '.nav_area .primary_button { 
            border-radius: '.esc_attr($maruncy_opt['nav_button_radius']['top']).' '.esc_attr($maruncy_opt['nav_button_radius']['right']).' '.esc_attr($maruncy_opt['nav_button_radius']['bottom']).' '.esc_attr($maruncy_opt['nav_button_radius']['left']).';
        }';
    }
    if( isset( $maruncy_opt['toggle_menu_radius'] ) and !empty($maruncy_opt['toggle_menu_radius']['top']) or !empty($maruncy_opt['toggle_menu_radius']['bottom']) or !empty($maruncy_opt['toggle_menu_radius']['left']) or !empty($maruncy_opt['toggle_menu_radius']['right'])){
        $custom_css .= '.nav_area .mobile_menu_toggle { 
            border-radius: '.esc_attr($maruncy_opt['toggle_menu_radius']['top']).' '.esc_attr($maruncy_opt['toggle_menu_radius']['right']).' '.esc_attr($maruncy_opt['toggle_menu_radius']['bottom']).' '.esc_attr($maruncy_opt['toggle_menu_radius']['left']).';
        }';
    }
    if( isset( $maruncy_opt['nav_search_radius'] ) and !empty($maruncy_opt['nav_search_radius']['top']) or !empty($maruncy_opt['nav_search_radius']['bottom']) or !empty($maruncy_opt['nav_search_radius']['left']) or !empty($maruncy_opt['nav_search_radius']['right'])){
        $custom_css .= '.nav_area .search_toggle { 
            border-radius: '.esc_attr($maruncy_opt['nav_search_radius']['top']).' '.esc_attr($maruncy_opt['nav_search_radius']['right']).' '.esc_attr($maruncy_opt['nav_search_radius']['bottom']).' '.esc_attr($maruncy_opt['nav_search_radius']['left']).';
        }';
    }
    if( isset( $maruncy_opt['nav_shop_radius'] ) and !empty($maruncy_opt['nav_shop_radius']['top']) or !empty($maruncy_opt['nav_shop_radius']['bottom']) or !empty($maruncy_opt['nav_shop_radius']['left']) or !empty($maruncy_opt['nav_shop_radius']['right'])){
        $custom_css .= '.nav_area .cart_toggle { 
            border-radius: '.esc_attr($maruncy_opt['nav_shop_radius']['top']).' '.esc_attr($maruncy_opt['nav_shop_radius']['right']).' '.esc_attr($maruncy_opt['nav_shop_radius']['bottom']).' '.esc_attr($maruncy_opt['nav_shop_radius']['left']).';
        }';
    }
    if( isset( $maruncy_opt['nav_button_radius'] ) and !empty($maruncy_opt['nav_button_radius']['top']) or !empty($maruncy_opt['nav_button_radius']['bottom']) or !empty($maruncy_opt['nav_button_radius']['left']) or !empty($maruncy_opt['nav_button_radius']['right'])){
        $custom_css .= '.post-box .primary_button { 
            border-radius: '.esc_attr($maruncy_opt['nav_button_radius']['top']).' '.esc_attr($maruncy_opt['nav_button_radius']['right']).' '.esc_attr($maruncy_opt['nav_button_radius']['bottom']).' '.esc_attr($maruncy_opt['nav_button_radius']['left']).';
        }';
    }
    if(isset($maruncy_opt['custom_css'])){
        $custom_css .= $maruncy_opt['custom_css'];
    }
	wp_add_inline_style( 'maruncy-theme', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'maruncy_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function maruncy_skip_link_focus_fix() {
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
add_action( 'wp_print_footer_scripts', 'maruncy_skip_link_focus_fix' );

// Maruncy All Function Pack.
require get_theme_file_path('/inc/theme-funtions.php');

// Install Required Plugin.
require get_theme_file_path('/inc/theme-plugin-activation.php');

// Theme Options
require get_theme_file_path('/inc/theme-option.php');

// Customizer Add Option.
require get_theme_file_path('/inc/customizer.php');

// OnePage Nav Waker Function.
require get_theme_file_path('/inc/nav-menu-walker.php');
