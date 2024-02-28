<?php
// landshop Theme Setup
if( !function_exists('landshop_setup_theme') ){
	function landshop_setup_theme(){
		/*
		* Make theme available for translation.
		* If you're building a theme based on landshop, use a find and replace
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

		/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		*/
		add_theme_support( 'post-thumbnails' );
        // add_image_size( 'full', 570, 410, true );


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
                $onepage = get_post_meta( get_the_ID(), '_codexse_one_page_scrolling_effect', true );
                /*If front page is set to display a static page, get the URL of the posts page.*/
                $homepage_id = get_option( 'page_on_front' );
                /*current page id*/
                $current_page_id = ( is_page( get_the_ID() ) ) ? get_the_ID() : '';
                if( $homepage_id == $current_page_id or $onepage != 'yes'  ) {
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
 * @since landshop 1.0.0
 */
if( !function_exists('landshop_widgets_init') ){
    function landshop_widgets_init() {

        if ( class_exists( 'Redux' ) ) {
            global $landshop_opt;
        }else{
            $landshop_opt['nav_toggle_sidebar'] = '0';
        }

        register_sidebar( array(
            'name'          => esc_html__( 'Sidebar', 'landshop' ),
            'id'            => 'main_sidebar',
            'description'   => esc_html__( 'This sidebar appears in the blog pages on the website.', 'landshop' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h5 class="widget_title">',
            'after_title'   => '</h5>',
        ) );
        
        if( class_exists( 'WooCommerce' ) ){            
            register_sidebar( array(
                'name'          => esc_html__( 'WooCommerce Sidebar', 'landshop' ),
                'id'            => 'woocommerce_sidebar',
                'description'   => esc_html__( 'This sidebar appears in the wooCommerce pages on the website.', 'landshop' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h5 class="widget_title">',
                'after_title'   => '</h5>',
            ) );
        }

        if($landshop_opt['nav_toggle_sidebar'] == '1'){
            register_sidebar( array(
                'name'          => esc_html__( 'Navbar Toggle Sidebar', 'landshop' ),
                'id'            => 'navbar_toggle_sidebar',
                'description'   => esc_html__( 'This sidebar appears in the toggle navigation menu on the website.', 'landshop' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h5 class="widget_title">',
                'after_title'   => '</h5>',
            ) );
        }        

        register_sidebar( array(
            'name'          => esc_html__( 'Footer Widget', 'landshop' ),
            'id'            => 'footer_sidebar',
            'description'   => esc_html__( 'This sidebar appears in the footer on the website.', 'landshop' ),
            'before_widget' => '<div id="%1$s" class="widget footer_widget %2$s col-xl-3 col-lg-4 col-sm-6">',
            'after_widget'  => '</div>',
            'before_title'  => '<h5 class="widget_title">',
            'after_title'   => '</h5>',
        ) );
    }
}
add_action( 'widgets_init', 'landshop_widgets_init' );


if ( !function_exists( 'landshop_fonts_url' ) ) {
    /**
     * Register Google fonts for landshop.
     *
     * Create your own landshop_fonts_url() function to override in a child theme.
     *
     * @since landshop 1.0
     *
     * @return string Google fonts URL for the theme.
     */
    
    function landshop_fonts_url() {
        $fonts_url = '';
        $fonts     = array();
        $subsets   = 'latin,latin-ext';
        /* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
        $fonts[] = 'Inter:wght@500;600;700;800&family=Manrope:wght@300;400;500;600;700&display=swap';

        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' =>  implode( '|', $fonts ),
                'subset' =>  $subsets,
            ), 'https://fonts.googleapis.com/css2' );
        }
        return esc_url_raw($fonts_url);
    }
}

/**
 * Enqueue scripts and styles.
 */
function landshop_scripts() {
	// Add google fonts, used in the main stylesheet.
	wp_enqueue_style( 'landshop-custom-fonts', landshop_fonts_url(), array(), null );   
	// Add Bootstrap, Used for default grid system.
	wp_enqueue_style( 'bootstrap', get_theme_file_uri('/assets/css/bootstrap-min.css'), array(), '5.1.1' );  
	wp_enqueue_style( 'landshop-root', get_theme_file_uri('/assets/css/root.css'), array(), wp_get_theme()->get( 'Version' )  );	                
	// Add Normalizer, Used for remove default tag style.
	wp_enqueue_style( 'normalizer', get_theme_file_uri('/assets/css/normalize.css'), array(), '8.0.1' );
	// Add slicknav, Used for responsive mobile menu.
	wp_enqueue_style( 'slicknav', get_theme_file_uri('/assets/css/slicknav.css'), array(), '1.0.10' );             
	// Add FontAwesome, Used for font icons.
	wp_enqueue_style( 'fontawesome', get_theme_file_uri('/assets/css/fontawesome-min.css'), array(), '5.8.1' );
	if( class_exists( 'WooCommerce' ) ){
		// Add WooCommerce style overwrite css
		wp_enqueue_style( 'woocommerce-general', get_theme_file_uri('/assets/css/woocommerce.css'), array(), wp_get_theme()->get( 'Version' )  );	
		wp_enqueue_style( 'woocommerce-layout', get_theme_file_uri('/assets/css/woocommerce-layout.css'), array(), wp_get_theme()->get( 'Version' )  );
		wp_enqueue_style( 'woocommerce-smallscreen', get_theme_file_uri('/assets/css/woocommerce-smallscreen.css'), array(), wp_get_theme()->get( 'Version' )  );
	}
	// Add landshop Theme CSS, Used for important structure style.
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

    if( class_exists('WooCommerce') ):
	    wp_enqueue_script( 'landshop-wc-scripts', get_theme_file_uri('/assets/js/wc-scripts.js'), array('jquery'), wp_get_theme()->get( 'Version' ), true );
    endif;

	wp_enqueue_script( 'landshop-scripts', get_theme_file_uri('/assets/js/scripts.js'), array('jquery','jquery-masonry','imagesloaded'), wp_get_theme()->get( 'Version' ), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    
}
add_action( 'wp_enqueue_scripts', 'landshop_scripts', 99999999999999999999999999 );

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
            <div <?php post_class('post__box box-style-2'); ?>>
                <a href="<?php the_permalink(); ?>" class="thumb">
                    <?php
                        the_post_thumbnail('full');
                    ?>
                </a>
                <div class="content"> 
                    <h4 class="title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <div class="footer_meta_list">
                        <ul>
                            <?php if(landshop_get_post_date()): ?>
                            <li class="date">
                                <?php echo landshop_get_post_date('Y M D'); ?>
                            </li>
                            <?php endif; ?>
                            <li class="link-arrow">
                                <a href="<?php echo get_permalink(); ?>"><i class="fa-light fa-arrow-right"></i></a>
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
                <?php the_post_thumbnail('full'); ?>
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

// landshop All Function Pack.
require get_theme_file_path('/inc/theme-functions.php');

if( class_exists('WooCommerce') ){
    // landshop All WooCommerce Function Overwrite.
    require get_theme_file_path('/inc/wc-functions.php');
}


if( class_exists('OCDI_Plugin') ){
    // landshop All One Click Demo Import Plugin Function Overwrite.
    require get_theme_file_path('/inc/ocdi-functions.php');
}

// Install Required Plugin.
require get_theme_file_path('/inc/theme-plugin-activation.php');

// Theme Options
require get_theme_file_path('/inc/theme-option.php');

// Customizer Add Option.
require get_theme_file_path('/inc/customizer.php');

// OnePage Nav Waker Function.
require get_theme_file_path('/inc/nav-menu-walker.php');