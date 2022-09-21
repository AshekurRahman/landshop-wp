<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */
if ( ! class_exists( 'Redux' ) ) {
    return;
}

// This is your option name where all the Redux data is stored.
$opt_name = "landshop_opt";

/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */
$theme = wp_get_theme(); // For use with some settings. Not necessary.
$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'             => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'         => $theme->get( 'Name' ),
    // Name that appears at the top of your panel
    'display_version'      => $theme->get( 'Version' ),
    // Version that appears at the top of your panel
    'menu_type'            => 'menu',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => true,
    // Show the sections below the admin menu item or not
    'menu_title'           => esc_html__( 'Theme Options', 'landshop' ),
    'page_title'           => esc_html__( 'Theme Options', 'landshop' ),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => false,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar'            => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-portfolio',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 50,
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => false,
    // Show the time the page took to load, etc
    'update_notice'        => false,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => true,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
    // OPTIONAL -> Give you extra features
    'page_priority'        => 30,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => '',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => 'landshop_opt',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => true,
    // Shows the Import/Export panel when not used as a field.
    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn'              => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
    // HINTS
    'hints'                => array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => array(
            'color'   => 'red',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ),
        'tip_position'  => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect'    => array(
            'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ),
            'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ),
        ),
    )
);

Redux::setArgs( $opt_name, $args );
/*
 * ---> END ARGUMENTS
 */




// Page Layout Section
Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Layout', 'landshop' ),
    'id'               => 'layout',
    'customizer_width' => '400px',
    'icon'             => 'el el-website',
    'fields'           => array(
		'layout' => array(
            'id'        => 'page_layout',
			'type'     	=> 'radio',
            'title'     => esc_html__( 'Layout', 'landshop' ),
            'subtitle'     => esc_html__( 'Controls the site layout.', 'landshop' ),
			//Must provide key => value pairs for radio options
			'options'  	=> array(
				'1' => esc_html__('Boxed Wrapper','landshop'), 
				'2' => esc_html__('Wide Wrapper','landshop'),
			),
			'default' 	=> '2'
		),
		'site_width' => array(
			'title'		=> esc_html__( 'Site Width', 'landshop' ),
			'subtitle'	=> esc_html__( 'Controls the overall site width.', 'landshop' ),
			'id'		=> 'site_width',
			'width' 	=> true,
			'height' 	=> false,
			'default'   => array('width' => '1170'),
            'type'      => 'dimensions',
            'units'     => array('em','px','%'),
			'desc'      => esc_attr__( 'The value was changed in Landshop to include both the site-width & side-header width, ex: calc(90% + 300px). Leave this as is, or update it with a single percentage, ex: 95%', 'landshop' ),
            'output'    => '.page_wrapper',
            'required'  => array('page_layout', '=', '1'),
		),		
		'section-padding' => array(
			'title'		=> esc_html__( 'Section Padding', 'landshop' ),
			'subtitle'	=> esc_html__( 'Controls the section height.', 'landshop' ),
			'id'		=> 'section-padding',
			'width' 	=> false,
			'height' 	=> true,
			'default'   => array('height' => '136'),
            'type'      => 'dimensions',
            'units'     => false,
			'desc'      => esc_attr__( 'The value was changed in all section top and bottom space.', 'landshop' ),
		),	
        'wide_layout_space' => array(
            'id'             => 'wide_layout_space',
            'type'           => 'spacing',
            'output'   => array( '.page_wrapper' ),
            // An array of CSS selectors to apply this font style to
            'mode'           => 'margin',
            // absolute, padding, margin, defaults to padding
            'all'            => false,
            // Have one field that applies to all
            //'top'           => false,     // Disable the top
            'right'         => false,     // Disable the right
            //'bottom'        => false,     // Disable the bottom
            'left'          => false,     // Disable the left
            'units'          => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',    // Allow users to select any type of unit
            //'display_units' => 'false',   // Set to false to hide the units if the units are specified
            'title'          => esc_html__( 'Boxed Mode Offset Top & Bottom', 'landshop' ),
            'subtitle'       => esc_html__( 'Controls the top/bottom offset of the page background.', 'landshop' ),
            'required'  => array('page_layout', '=', '1'),
        ),		
        'wide_layout_padding' => array(
            'id'             => 'wide_layout_padding',
            'type'           => 'spacing',
            'output'   => array( '[class|=container]' ),
            // An array of CSS selectors to apply this font style to
            'mode'           => 'padding',
            // absolute, padding, margin, defaults to padding
            'all'            => false,
            // Have one field that applies to all
            //'top'           => false,     // Disable the top
            'top'         => false,     // Disable the right
            //'bottom'        => false,     // Disable the bottom
            'bottom'          => false,     // Disable the left
            'units'          => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',    // Allow users to select any type of unit
            //'display_units' => 'false',   // Set to false to hide the units if the units are specified
            'title'          => esc_html__( 'Boxed Mode Inner Padding Left & Right', 'landshop' ),
            'subtitle'       => esc_html__( 'Controls the left and right padding of the boxed background.', 'landshop' ),
            'required'  => array('page_layout', '=', '1'),
        ),
		'page_bg_color' => array(         
            'id'        => 'page_bg_color',
			'type'     => 'background',
            'title'     => esc_html__( 'Page Background', 'landshop' ),
            'subtitle'  => esc_html__( 'Controls the background and opacity for the page.', 'landshop' ),
            'output'    => ['.main_wrapper'],
            'required'  => array('page_layout', '=', '1'),
		),
    )
));



// Global Color Layout
Redux::setSection($opt_name , array(
    'title'            => esc_html__( 'Global Color', 'landshop' ),
    'id'               => 'gloabl_color',
    'customizer_width' => '400px',
    'icon'             => 'el el-brush',
    'fields'           => array(
         'color_info' => array(
			'id'    => 'color_info',
			'type'  => 'info',
			'title' => esc_html__('IMPORTANT NOTE:', 'landshop'),
			'style' => 'info',
			'desc'  => esc_html__('This tab contains general color options. Additional color options for specific areas, can be found within other tabs. Example: For menu color options go to the menu tab.', 'landshop')
		),
        'primary_color' => array(
           'id'    => 'primary_color',
           'type'  => 'color',
           'title' => esc_html__('Primary Color', 'landshop'),
           'subtitle' => esc_html__('Controls the main highlight color throughout the theme.', 'landshop'),
           'default'   => '#FF6B31',
           'validate' => 'color',
        ),
         'heading_color' => array(
			'id'    => 'heading_color',
			'type'  => 'color',
			'title' => esc_html__('Black Text', 'landshop'),
			'subtitle' => esc_html__('Controls the body black text color throughout the theme.', 'landshop'),
			'default'   => '#131313',			
        	'validate' => 'color',
		 ),
         'white_color' => array(
			'id'    => 'white_color',
			'type'  => 'color',
			'title' => esc_html__('White Color', 'landshop'),
			'subtitle' => esc_html__('Controls the body white color throughout the theme.', 'landshop'),
			'default'   => '#ffffff',			
        	'validate' => 'color',
		 ),
         'text_color' => array(
			'id'    => 'text_color',
			'type'  => 'color',
			'title' => esc_html__('Text Color', 'landshop'),
			'subtitle' => esc_html__('Controls the body light text color throughout the theme.', 'landshop'),
			'default'   => '#696969',			
        	'validate' => 'color',
		 ),
         'gray_color' => array(
			'id'    => 'gray_color',
			'type'  => 'color',
			'title' => esc_html__('Gray Background', 'landshop'),
			'subtitle' => esc_html__('Controls the all gray color border and line throughout the theme.', 'landshop'),
			'default'   => '#f7f7f7',			
        	'validate' => 'color',
		 ),
         'dark_color' => array(
			'id'    => 'dark_color',
			'type'  => 'color',
			'title' => esc_html__('Black Background', 'landshop'),
			'subtitle' => esc_html__('Controls the dark background color throughout the theme.', 'landshop'),
			'default'   => '#131313',			
        	'validate' => 'color',
		 ),
         'body_color' => array(
			'id'    => 'body_background',
			'type'  => 'color',
			'title' => esc_html__('Body Background', 'landshop'),
			'subtitle' => esc_html__('Controls the body background color throughout the theme.', 'landshop'),
			'default'   => '#ffffff',			
        	'validate' => 'color',
		 ),
	)
));

Redux::setSection($opt_name , array(
    'title'            => esc_html__( 'Navbar', 'landshop' ),
    'id'               => 'navbar_options',
    'customizer_width' => '400px',
    'icon'             => 'el el-lines',
    'fields'           => array(
		'navbar_width' => array(
			'title'		=> esc_html__( 'Wrapper width', 'landshop' ),
			'subtitle'	=> esc_html__( 'Controls the navbar container width.', 'landshop' ),
			'id'		=> 'navbar_width',
			'width' 	=> true,
			'height' 	=> false,
			'default'   => array('width' => '1710'),
            'type'      => 'dimensions',
            'units'     => array('em','px','%'),
            'output'    => '.nav_area .container-wide',
		),	
		'navbar_height' => array(
			'title'		=> esc_html__( 'Navbar Height', 'landshop' ),
			'subtitle'	=> esc_html__( 'Controls the navbar height.', 'landshop' ),
			'id'		=> 'navbar_height',
			'width' 	=> false,
			'height' 	=> true,
			'default'   => array('height' => '100'),
            'type'      => 'dimensions',
            'units'     => false,
		),
        'navbar_transparent' => array(
            'id'       => 'navbar_transparent',
            'type'     => 'select',
            'title'    => esc_html__( 'Navbar Style', 'landshop' ),
            'options'  => array(
                'off' => esc_html__( 'Static','landshop' ),
                'transparent_menu' => esc_html__( 'Dark Transparent','landshop' ),
                'transparent_menu light_menu' => esc_html__( 'Light Transparent','landshop' ),
            ),
            'default'  => 'off',             
        ),
        'navbar_sticky' => array(
            'id'        => 'navbar_sticky',
            'type'      => 'switch',
            'title'     => esc_html__( 'Sticky Navbar', 'landshop' ),
            'on'        => esc_html__('On', 'landshop'),
            'off'       => esc_html__('Off', 'landshop'),
            'default'   => true,
        ),
		'sticky_offset' => array(
			'title'		=> esc_html__( 'Sticky Offset', 'landshop' ),
			'subtitle'	=> esc_html__( 'Controls the navbar sticky offset.', 'landshop' ),
			'id'		=> 'sticky_offset',
			'width' 	=> false,
			'height' 	=> true,
			'default'   => array('height' => '100'),
            'type'      => 'dimensions',
            'units'     => false,
            'required'  => array('navbar_sticky', '=', '1'),			
		),
         array(
            'id'       => 'nav_area_background',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Background Color', 'landshop' ),
            'output'   => array( '.nav_area' ),
            'mode'     => 'background',
            'validate' => 'colorrgba'
        ),
         array(
            'id'       => 'nav_area_border',
            'type'     => 'border',
            'title'    => esc_html__( 'Border', 'landshop' ),
            'subtitle'  => esc_html__('Control the button border/line.', 'landshop'),
            'output'   => array( '.nav_area' ),
        ),
        array(
            'id'       => 'nav_sticky_background',
            'type'     => 'background',
            'output'   => array( '.sticky .nav_area' ),
            'title'    => esc_html__( 'Sticky Background', 'landshop' ),
            'subtitle' => esc_html__( 'Control the nav sticky background with image, color, etc.', 'landshop' ),
        ),
    )
));
Redux::setSection($opt_name , array(
    'title'            => esc_html__( 'Logo', 'landshop' ),
    'id'               => 'navbar_logo',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(		
        array(
            'title'     => esc_html__('Light Logo', 'landshop'),
            'subtitle'  => esc_html__( 'Upload here a image file for your logo', 'landshop' ),
            'id'        => 'main_logo',
            'type'      => 'media',
            'default'   => array(
                'url'   => get_theme_file_uri('/assets/images/logo-light.svg') 
            )
        ),
        array(
            'title'     => esc_html__('Dark Logo', 'landshop'),
            'id'        => 'sticky_logo',
            'type'      => 'media',
            'default'   => array(
                'url'   => get_theme_file_uri('/assets/images/logo-dark.svg') 
            )
        ),
        array(
            'title'     => esc_html__('Logo dimensions', 'landshop'),
            'subtitle'  => esc_html__( 'Set a custom height width for your upload logo.', 'landshop' ),
            'id'        => 'logo_dimensions',
            'type'      => 'dimensions',
            'units'     => array('em','px','%'),
            'output'    => '.nav_area .nav_logo'
        ),
        array(
            'title'     => esc_html__('Padding', 'landshop'),
            'subtitle'  => esc_html__('Padding around the logo. Input the padding as clockwise (Top Right Bottom Left)', 'landshop'),
            'id'        => 'logo_padding',
            'type'      => 'spacing',
            'output'    => array( '.nav_area .nav_logo' ),
            'mode'      => 'padding',
            'units'     => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',
        ),
    )
));

if( class_exists('woocommerce') ):
// Shop Toggle Button
Redux::setSection($opt_name , array(
    'title'            => esc_html__( 'Shop Toggle', 'landshop' ),
    'id'               => 'nav_shop_button',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'title'     => esc_html__('Button Visibility', 'landshop'),
            'id'        => 'nav_shop_display',
            'subtitle'  => esc_html__('Do you want to show the shop toggle button at header nav area? Please choose your option.', 'landshop'),
            'type'      => 'switch',
            'on'        => esc_html__('Yes', 'landshop'),
            'off'       => esc_html__('No', 'landshop'),
            'default'   => true
        ),      
        array(
            'title'     => esc_html__('Style', 'landshop'),
            'subtitle'  => esc_html__('You can change your button style from here.', 'landshop'),
            'id'        => 'nav_shop_style_start',
            'type'      => 'section',
            'indent'    => true,
            'required'  => array('nav_shop_display', '=', '1'),
        ),
        array(
            'title'     => esc_html__('Color', 'landshop'),
            'subtitle'  => esc_html__('Control the button text color.', 'landshop'),
            'id'        => 'nav_shop_color',
            'type'      => 'color',
            'output'    => array('.nav_area .cart_toggle'),
        ),
        array(
            'title'     => esc_html__('Hover Color', 'landshop'),
            'subtitle'  => esc_html__('Control the button hover text color.', 'landshop'),
            'id'        => 'nav_shop_hover_color',
            'type'      => 'color',
            'output'    => array('.nav_area .cart_toggle:hover'),
        ),
        array(
            'title'     => esc_html__('BG Color', 'landshop'),
            'subtitle'  => esc_html__('Control the button background color.', 'landshop'),
            'id'        => 'nav_shop_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.nav_area .cart_toggle'),
        ),
        array(
            'title'     => esc_html__('Hover BG Color', 'landshop'),
            'subtitle'  => esc_html__('Control the button hover background color.', 'landshop'),
            'id'        => 'nav_shop_hover_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.nav_area .cart_toggle:hover'),
        ),
         array(
            'id'       => 'nav_shop_border',
            'type'     => 'border',
            'title'    => esc_html__( 'Border', 'landshop' ),
            'subtitle'  => esc_html__('Control the button border/line.', 'landshop'),
            'output'   => array( '.nav_area .cart_toggle' ),
        ),
         array(
            'id'       => 'nav_shop_hover_border',
            'type'     => 'border',
            'title'    => esc_html__( 'Hover Border', 'landshop' ),
            'subtitle'  => esc_html__('Control the button hover border/line.', 'landshop'),
            'output'   => array( '.nav_area .cart_toggle:hover' ),
        ),
        array(
            'title'     => esc_html__('Padding', 'landshop'),
            'subtitle'  => esc_html__('Control the button inner padding/space.', 'landshop'),
            'id'        => 'nav_shop_padding',
            'type'      => 'spacing',
            'output'    => array( '.nav_area .cart_toggle' ),
            'mode'      => 'padding',
            'units'     => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',
        ),        
        array(
            'title'     => esc_html__('Button Radius', 'landshop'),
            'subtitle'  => esc_html__('Radius around the button. Input the radius as clockwise (Top Right Bottom Left)', 'landshop'),
            'id'        => 'nav_shop_radius',
            'type'      => 'spacing',
            'mode'      => 'border-radius',
            'units'     => array( 'em', 'px', '%' ),
            'units_extended' => 'true',
        ),
        array(
            'id'     => 'nav_shop_style_end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
));
endif;

// Search Menu Button
Redux::setSection($opt_name , array(
    'title'            => esc_html__( 'Search Toggle', 'landshop' ),
    'id'               => 'nav_search_button',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'title'     => esc_html__('Button Visibility', 'landshop'),
            'id'        => 'nav_search_display',
            'subtitle'  => esc_html__('Do you want to show the search button at header nav area? Please choose your option.', 'landshop'),
            'type'      => 'switch',
            'on'        => esc_html__('Yes', 'landshop'),
            'off'       => esc_html__('No', 'landshop'),
            'default'   => true
        ),      
        array(
            'title'     => esc_html__('Style', 'landshop'),
            'subtitle'  => esc_html__('You can change your button style from here.', 'landshop'),
            'id'        => 'nav_search_style_start',
            'type'      => 'section',
            'indent'    => true,
            'required'  => array('nav_search_display', '=', '1'),
        ),
        array(
            'title'     => esc_html__('Color', 'landshop'),
            'subtitle'  => esc_html__('Control the button text color.', 'landshop'),
            'id'        => 'nav_search_color',
            'type'      => 'color',
            'output'    => array('.nav_area .search_toggle'),
        ),
        array(
            'title'     => esc_html__('Hover Color', 'landshop'),
            'subtitle'  => esc_html__('Control the button hover text color.', 'landshop'),
            'id'        => 'nav_search_hover_color',
            'type'      => 'color',
            'output'    => array('.nav_area .search_toggle:hover'),
        ),
        array(
            'title'     => esc_html__('BG Color', 'landshop'),
            'subtitle'  => esc_html__('Control the button background color.', 'landshop'),
            'id'        => 'nav_search_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.nav_area .search_toggle'),
        ),
        array(
            'title'     => esc_html__('Hover BG Color', 'landshop'),
            'subtitle'  => esc_html__('Control the button hover background color.', 'landshop'),
            'id'        => 'nav_search_hover_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.nav_area .search_toggle:hover'),
        ),
         array(
            'id'       => 'nav_search_border',
            'type'     => 'border',
            'title'    => esc_html__( 'Border', 'landshop' ),
            'subtitle'  => esc_html__('Control the button border/line.', 'landshop'),
            'output'   => array( '.nav_area .search_toggle' ),
        ),
         array(
            'id'       => 'nav_search_hover_border',
            'type'     => 'border',
            'title'    => esc_html__( 'Hover Border', 'landshop' ),
            'subtitle'  => esc_html__('Control the button hover border/line.', 'landshop'),
            'output'   => array( '.nav_area .search_toggle:hover' ),
        ),
        array(
            'title'     => esc_html__('Padding', 'landshop'),
            'subtitle'  => esc_html__('Control the button inner padding/space.', 'landshop'),
            'id'        => 'nav_search_padding',
            'type'      => 'spacing',
            'output'    => array( '.nav_area .search_toggle' ),
            'mode'      => 'padding',
            'units'     => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',
        ),        
        array(
            'title'     => esc_html__('Button Radius', 'landshop'),
            'subtitle'  => esc_html__('Radius around the button. Input the radius as clockwise (Top Right Bottom Left)', 'landshop'),
            'id'        => 'nav_search_radius',
            'type'      => 'spacing',
            'mode'      => 'border-radius',
            'units'     => array( 'em', 'px', '%' ),
            'units_extended' => 'true',
        ),
        array(
            'id'     => 'nav_search_style_end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
));

// Toggle Menu Button
Redux::setSection($opt_name , array(
    'title'            => esc_html__( 'Mobile Toggle', 'landshop' ),
    'id'               => 'toggle_menu',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'title'     => esc_html__('Button Visibility', 'landshop'),
            'id'        => 'toggle_menu_display',
            'subtitle'  => esc_html__('Do you want to show the mobile toggle button at header nav area? Please choose your option.', 'landshop'),
            'type'      => 'switch',
            'on'        => esc_html__('Yes', 'landshop'),
            'off'       => esc_html__('No', 'landshop'),
            'default'   => true
        ),
        'mobile_menu_active' => array(
            'id'        => 'mobile_menu_active',
            'type'      => 'slider',
			'title'		=> esc_html__( 'Mobile Menu Active', 'landshop' ),
			'subtitle'	=> esc_html__( 'Controls the main menu active width.', 'landshop' ),
            "default"   => 1200,
            "min"       => 1,
            "step"      => 1,
            "max"       => 3000,
            'display_value' => 'text',
            'required'  => array('toggle_menu_display', '=', '1'),
        ),
        array(
            'title'     => esc_html__('Style', 'landshop'),
            'subtitle'  => esc_html__('You can change your button style from here.', 'landshop'),
            'id'        => 'toggle_menu_style_start',
            'type'      => 'section',
            'indent'    => true,
            'required'  => array('toggle_menu_display', '=', '1'),
        ),
        array(
            'title'     => esc_html__('Color', 'landshop'),
            'subtitle'  => esc_html__('Control the button text color.', 'landshop'),
            'id'        => 'toggle_menu_color',
            'type'      => 'color',
            'output'    => array('.nav_area .mobile_menu_toggle'),
        ),
        array(
            'title'     => esc_html__('Hover Color', 'landshop'),
            'subtitle'  => esc_html__('Control the button hover text color.', 'landshop'),
            'id'        => 'toggle_menu_hover_color',
            'type'      => 'color',
            'output'    => array('.nav_area .mobile_menu_toggle:hover'),
        ),
        array(
            'title'     => esc_html__('BG Color', 'landshop'),
            'subtitle'  => esc_html__('Control the button background color.', 'landshop'),
            'id'        => 'toggle_menu_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.nav_area .mobile_menu_toggle'),
        ),
        array(
            'title'     => esc_html__('Hover BG Color', 'landshop'),
            'subtitle'  => esc_html__('Control the button hover background color.', 'landshop'),
            'id'        => 'toggle_menu_hover_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.nav_area .mobile_menu_toggle:hover'),
        ),
         array(
            'id'       => 'toggle_menu_border',
            'type'     => 'border',
            'title'    => esc_html__( 'Border', 'landshop' ),
            'subtitle'  => esc_html__('Control the button border/line.', 'landshop'),
            'output'   => array( '.nav_area .mobile_menu_toggle' ),
        ),
         array(
            'id'       => 'toggle_menu_hover_border',
            'type'     => 'border',
            'title'    => esc_html__( 'Hover Border', 'landshop' ),
            'subtitle'  => esc_html__('Control the button hover border/line.', 'landshop'),
            'output'   => array( '.nav_area .mobile_menu_toggle:hover' ),
        ),
        array(
            'title'     => esc_html__('Padding', 'landshop'),
            'subtitle'  => esc_html__('Control the button inner padding/space.', 'landshop'),
            'id'        => 'toggle_menu_padding',
            'type'      => 'spacing',
            'output'    => array( '.nav_area .mobile_menu_toggle' ),
            'mode'      => 'padding',
            'units'     => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',
        ),        
        array(
            'title'     => esc_html__('Button Radius', 'landshop'),
            'subtitle'  => esc_html__('Radius around the button. Input the radius as clockwise (Top Right Bottom Left)', 'landshop'),
            'id'        => 'toggle_menu_radius',
            'type'      => 'spacing',
            'mode'      => 'border-radius',
            'units'     => array( 'em', 'px', '%' ),
            'units_extended' => 'true',
        ),
        array(
            'id'     => 'toggle_menu_style_end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
));

// Action button
Redux::setSection($opt_name , array(
    'title'            => esc_html__( 'Primary Button', 'landshop' ),
    'id'               => 'nav_primary_button',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'title'     => esc_html__('Button Visibility', 'landshop'),
            'id'        => 'nav_button_display',
            'subtitle'  => esc_html__('Do you want to show the action button at header nav area? Please choose your option.', 'landshop'),
            'type'      => 'switch',
            'on'        => esc_html__('Yes', 'landshop'),
            'off'       => esc_html__('No', 'landshop'),
            'default'   => false
        ),
        array(
            'title'     => esc_html__('Button Label', 'landshop'),
            'subtitle'  => esc_html__('Enter type your action button text/label.', 'landshop'),
            'id'        => 'nav_button_label',
            'type'      => 'text',
            'default'   => esc_html__('Get Started Now', 'landshop'),
            'required'  => array('nav_button_display', '=', '1')
        ),
        array(
            'title'     => esc_html__('Button URL', 'landshop'),
            'id'        => 'nav_button_url',
            'subtitle'  => esc_html__('Enter type your action button URL/Link.', 'landshop'),
            'type'      => 'text',
            'default'   => '#',
            'required'  => array('nav_button_display', '=', '1')
        ),  
         array(
            'id'       => 'nav_button_icon',
            'type'     => 'media', 
            'url'      => true,
            'title'    => esc_html__('Upload Icon', 'landshop'),
            'required'  => array('nav_button_display', '=', '1')
        ),
        array(
            'title'     => esc_html__('Color', 'landshop'),
            'subtitle'  => esc_html__('Control the button text color.', 'landshop'),
            'id'        => 'nav_button_color',
            'type'      => 'color',
            'output'    => array('.nav_area .primary_button'),
            'required'  => array('nav_button_display', '=', '1'),
        ),
        array(
            'title'     => esc_html__('Hover Color', 'landshop'),
            'subtitle'  => esc_html__('Control the button hover text color.', 'landshop'),
            'id'        => 'nav_button_hover_color',
            'type'      => 'color',
            'output'    => array('.nav_area .primary_button:hover'),
            'required'  => array('nav_button_display', '=', '1'),
        ),
        array(
            'title'     => esc_html__('BG Color', 'landshop'),
            'subtitle'  => esc_html__('Control the button background color.', 'landshop'),
            'id'        => 'nav_button_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'required'  => array('nav_button_display', '=', '1'),
            'output'    => array('.nav_area .primary_button'),
        ),
        array(
            'title'     => esc_html__('Hover BG Color', 'landshop'),
            'subtitle'  => esc_html__('Control the button hover background color.', 'landshop'),
            'id'        => 'nav_button_hover_bg_color',
            'type'      => 'color',
            'required'  => array('nav_button_display', '=', '1'),
            'mode'      => 'background',
            'output'    => array('.nav_area .primary_button:hover'),
        ),
         array(
            'id'       => 'nav_button_border',
            'type'     => 'border',
            'title'    => esc_html__( 'Border', 'landshop' ),
            'subtitle'  => esc_html__('Control the button border/line.', 'landshop'),
            'output'   => array( '.nav_area .primary_button' ),
            'required'  => array('nav_button_display', '=', '1'),
        ),
         array(
            'id'       => 'nav_button_hover_border',
            'type'     => 'border',
            'title'    => esc_html__( 'Hover Border', 'landshop' ),
            'subtitle'  => esc_html__('Control the button hover border/line.', 'landshop'),
            'required'  => array('nav_button_display', '=', '1'),
            'output'   => array( '.nav_area .primary_button:hover' ),
        ),
        array(
            'title'     => esc_html__('Padding', 'landshop'),
            'subtitle'  => esc_html__('Control the button inner padding/space.', 'landshop'),
            'id'        => 'nav_button_padding',
            'type'      => 'spacing',
            'output'    => array( '.nav_area .primary_button' ),
            'mode'      => 'padding',
            'required'  => array('nav_button_display', '=', '1'),
            'units'     => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',
        ),    
        array(
            'title'     => esc_html__('Margin', 'landshop'),
            'subtitle'  => esc_html__('Control the button inner margin/space.', 'landshop'),
            'id'        => 'nav_button_margin',
            'type'      => 'spacing',
            'output'    => array( '.nav_area .primary_button' ),
            'mode'      => 'margin',
            'required'  => array('nav_button_display', '=', '1'),
            'units'     => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',
        ),        
        array(
            'title'     => esc_html__('Button Radius', 'landshop'),
            'subtitle'  => esc_html__('Radius around the button. Input the radius as clockwise (Top Right Bottom Left)', 'landshop'),
            'id'        => 'nav_button_radius',
            'type'      => 'spacing',
            'mode'      => 'border-radius',
            'units'     => array( 'em', 'px', '%' ),
            'required'  => array('nav_button_display', '=', '1'),
            'units_extended' => 'true',
        ),
    )
));

// Action button
Redux::setSection($opt_name , array(
    'title'            => esc_html__( 'Phone Number', 'landshop' ),
    'id'               => 'nav_phone_number',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'title'     => esc_html__('Number Visibility', 'landshop'),
            'id'        => 'nav_number_display',
            'subtitle'  => esc_html__('Do you want to show the phone number at header nav area? Please choose your option.', 'landshop'),
            'type'      => 'switch',
            'on'        => esc_html__('Yes', 'landshop'),
            'off'       => esc_html__('No', 'landshop'),
            'default'   => false
        ),
        array(
            'title'     => esc_html__('Number', 'landshop'),
            'subtitle'  => esc_html__('Enter type your phone number.', 'landshop'),
            'id'        => 'nav_phone_number',
            'type'      => 'text',
            'default'   => esc_html__('+161 94 32 141', 'landshop'),
            'required'  => array('nav_number_display', '=', '1')
        ),
        array(
            'title'     => esc_html__('Link', 'landshop'),
            'id'        => 'nav_phone_url',
            'subtitle'  => esc_html__('Enter type your URL/Link.', 'landshop'),
            'type'      => 'text',
            'default'   => 'tel:+1619432141',
            'required'  => array('nav_number_display', '=', '1')
        ),
         array(
            'id'       => 'nav_phone_icon',
            'type'     => 'media', 
            'url'      => true,
            'title'    => esc_html__('Upload Icon', 'landshop'),
            'required'  => array('nav_number_display', '=', '1')
        ),
    )
));

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Site Header', 'landshop' ),
    'id'               => 'site_header',
    'desc'             => esc_html__( 'You can change global page header options and styles!', 'landshop' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-flag-alt',
) );

Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Page Header', 'landshop' ),
    'id'         => 'page_header_option',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'page_header_background',
            'type'     => 'background',
            'output'   => array( '.site-header' ),
            'title'    => esc_html__( 'Background', 'landshop' ),
            'subtitle' => esc_html__( 'Control the page header background with image, color, etc.', 'landshop' ),
            'default'  => array( 'url' => get_theme_file_uri( 'assets/images/header-bg.jpg' ) ),
        ),
         array(
            'id'       => 'page_header_overlay',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Background Overlay', 'landshop' ),
            'output'   => array( '.site-header:before' ),
            'mode'     => 'background',
            'validate' => 'colorrgba'
        ),
        array(
            'id'             => 'page_header_space',
            'type'           => 'spacing',
            'output'   => array( '.site-header' ),
            // An array of CSS selectors to apply this font style to
            'mode'           => 'padding',
            // absolute, padding, margin, defaults to padding
            'all'            => false,
            // Have one field that applies to all
            //'top'           => false,     // Disable the top
            'right'         => false,     // Disable the right
            //'bottom'        => false,     // Disable the bottom
            'left'          => false,     // Disable the left
            'units'          => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',    // Allow users to select any type of unit
            //'display_units' => 'false',   // Set to false to hide the units if the units are specified
            'title'          => esc_html__( 'Header Padding', 'landshop' ),
            'subtitle'       => esc_html__( 'Site Header Spacing Define', 'landshop' ),
            'desc'           => esc_html__( 'To define Top, Right, Bottom, Left padding', 'landshop' ),
        ),        
        array(
            'id'       => 'page_header_align',
            'type'     => 'button_set',
            'title'    => esc_html__('Alignment', 'landshop'),
            //Must provide key => value pairs for options
            'options' => array(
                'left' => esc_html__('Left', 'landshop'),
                'center' => esc_html__('Center', 'landshop'),
                'right' => esc_html__('Right', 'landshop')
            ),
            'default' => 'left'
        ),
    ),
) );
Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Page Title', 'landshop' ),
    'id'               => 'header_page_title',
    'subsection'       => true,
    'customizer_width' => '400px',
    'fields'           => array(
        array(
            'title'     => esc_html__('Title Visibility', 'landshop'),
            'id'        => 'page_title',
            'subtitle'  => esc_html__('Do you want to show the page title at header area? Please choose your option.', 'landshop'),
            'type'      => 'switch',
            'on'        => esc_html__('Yes', 'landshop'),
            'off'       => esc_html__('No', 'landshop'),
            'default'   => true
        ),
        array(
            'id'       => 'blog_page_title',
            'type'     => 'text',
            'title'    => esc_html__( 'Blog Page Title', 'landshop' ),
            'subtitle' => esc_html__( 'Control the post page title.', 'landshop' ),
            'desc'     => esc_html__( 'You can update your blog page title from here!.', 'landshop' ),
            'default'  => esc_html__('Blog & Article', 'landshop'),
        ),
        array(
            'id'       => 'search_page_title',
            'type'     => 'text',
            'title'    => esc_html__( 'Search Page Title', 'landshop' ),
            'subtitle' => esc_html__( 'Control the search page title.', 'landshop' ),
            'desc'     => esc_html__( 'You can update your search page title from here!.', 'landshop' ),
            'default'  => esc_html__('Search', 'landshop'),
        ),
        array(
            'id'          => 'page_title_typography',
            'type'        => 'typography',
            'title'       => esc_html__( 'Title Typography', 'landshop' ),
            'google'      => true,
            'font-backup' => false,
            'font-style'    => false,
            'subsets'       => false,
            'text-transform'    => true,
            'letter-spacing'=> true, 
            'all_styles'  => true,
            'output'      => array( '.site-header .page_title' ),
            'compiler'    => array( 'page_title-compiler' ),
            'units'       => 'px',
            'subtitle'    => esc_html__( 'Typography option with each property can be called individually.', 'landshop' ),
        ),
        array(
            'id'             => 'page_title_space',
            'type'           => 'spacing',
            'output'   => array( '.site-header .page_title' ),
            // An array of CSS selectors to apply this font style to
            'mode'           => 'margin',
            // absolute, padding, margin, defaults to padding
            'all'            => false,
            // Have one field that applies to all
            //'top'           => false,     // Disable the top
            'right'         => false,     // Disable the right
            //'bottom'        => false,     // Disable the bottom
            'left'          => false,     // Disable the left
            'units'          => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',    // Allow users to select any type of unit
            //'display_units' => 'false',   // Set to false to hide the units if the units are specified
            'title'          => esc_html__( 'Title Space', 'landshop' ),
            'subtitle'       => esc_html__( 'Page title spacing.', 'landshop' ),
            'desc'           => esc_html__( 'You can define spacing for page title at Top, Right, Bottom, Left, or Units.', 'landshop' ),
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Page Sub Title', 'landshop' ),
    'id'               => 'page_header_sub_title',
    'subsection'       => true,
    'customizer_width' => '400px',
    'fields'           => array(
        array(
            'id'       => 'sub_title_format',
            'type'     => 'radio',
            'title'    => esc_html__( 'Display Format', 'landshop' ),
            'subtitle' => esc_html__( 'Page header subtitle format.', 'landshop' ),
            'desc'     => esc_html__( 'Please select subtitle display format.', 'landshop' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => esc_html__( 'Site Description' , 'landshop' ),
                '2' => esc_html__( 'Breadcrumb' , 'landshop' ),
                '3' => esc_html__( 'Custom Subtitle' , 'landshop' ),
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'breadcrumb_home',
            'type'     => 'text',
            'title'    => esc_html__( 'Breadcrumb Home', 'landshop' ),
            'subtitle' => esc_html__( 'Breadcrumbs menu home name.', 'landshop' ),
            'desc'     => esc_html__( 'To set breadcrumb home text.', 'landshop' ),
            'default'  => esc_html__('Home','landshop'),
            'required' => array( 'sub_title_format','=','2')
        ),
        array(
            'id'       => 'breadcrumb_separator',
            'type'     => 'text',
            'title'    => esc_html__( 'Breadcrumb Separator', 'landshop' ),
            'subtitle' => esc_html__( 'Breadcrumbs menu item separator.', 'landshop' ),
            'desc'     => esc_html__( 'To set breadcrumb separator.', 'landshop' ),
            'default'  => '<big class="primary_text mx-3">&#8226;</big>',
            'required' => array( 'sub_title_format','=','2')
        ),        
        array(
            'id'       => 'custom_sub_title',
            'type'     => 'text',
            'title'    => esc_html__( 'Custom Sub Title', 'landshop' ),
            'subtitle' => esc_html__( 'To set custom page subtitle.', 'landshop' ),
            'desc'     => esc_html__( 'Enter your custom page subtitle.', 'landshop' ),
            'default'  => esc_html__('Welcome to our website.', 'landshop'),
            'required' => array( 'sub_title_format','=','3')
        ),
        array(
            'id'          => 'page_sub_title_typography',
            'type'        => 'typography',
            'title'       => esc_html__( 'Sub Title Typography', 'landshop' ),
            'google'      => true,
            'font-backup' => false,
            'font-style'    => false,
            'subsets'       => false,
            'text-transform'    => true,
            'letter-spacing'=> true,
            'all_styles'  => true,
            'output'      => array( '.site-header .sub_title, .site-header .sub_title a' ),
            'compiler'    => array( 'page-subtitle-compiler' ),
            'units'       => 'px',
            'subtitle'    => esc_html__( 'Typography option with each property can be called individually.', 'landshop' ),
        ),
        array(
            'id'             => 'page_subtitle_space',
            'type'           => 'spacing',
            'output'   => array( '.site-header .sub_title' ),
            'mode'           => 'margin',
            'all'            => false,
            'right'         => false,
            'left'          => false,
            'units'          => array( 'em', 'px', '%' ),
            'units_extended' => 'true',
            'title'          => esc_html__( 'Subtitle Space', 'landshop' ),
            'subtitle'       => esc_html__( 'Allow your users to choose the spacing or margin they want.', 'landshop' ),
            'desc'           => esc_html__( 'You can enable or disable any piece of this field. Top, Right, Bottom, Left, or Units.', 'landshop' ),
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Bottom Action', 'landshop' ),
    'id'               => 'page_header_bottom_action',
    'subsection'       => true,
    'customizer_width' => '400px',
    'fields'           => array(
        array(
            'id'       => 'header_actions',
            'type'     => 'radio',
            'title'    => esc_html__( 'Bottom Action', 'landshop' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '0' => esc_html__( 'None' , 'landshop' ),
                '1' => esc_html__( 'Breadcrumb' , 'landshop' ),
                '2' => esc_html__( 'Scroll Down' , 'landshop' ),
            ),
            'default'  => '0'
        ),
        array(
            'id'       => 'breadcrumb_home_2',
            'type'     => 'text',
            'title'    => esc_html__( 'Breadcrumb Home', 'landshop' ),
            'subtitle' => esc_html__( 'Breadcrumbs menu home name.', 'landshop' ),
            'desc'     => esc_html__( 'To set breadcrumb home text.', 'landshop' ),
            'default'  => esc_html__('Home','landshop'),
            'required' => array( 'header_actions','=','1')
        ),
        array(
            'id'       => 'breadcrumb_separator_2',
            'type'     => 'text',
            'title'    => esc_html__( 'Breadcrumb Separator', 'landshop' ),
            'subtitle' => esc_html__( 'Breadcrumbs menu item separator.', 'landshop' ),
            'desc'     => esc_html__( 'To set breadcrumb separator.', 'landshop' ),
            'default'  => '<big class="mx-3">&#8226;</big>',
            'required' => array( 'header_actions','=','1')
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Blog Settings', 'landshop' ),
    'id'               => 'blog_posts_option',
    'desc'             => esc_html__( 'Control the blog post all option from here!', 'landshop' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-text-width'
) );
Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Post Box', 'landshop' ),
    'id'         => 'post_box_section',
    'subsection' => true,
    'fields'     => array(
        array(
            'title'     => esc_html__('Box Style', 'landshop'),
            'id'        => 'post_box_style',
            'type'      => 'section',
            'indent'    => true,        
        ),
        array(
            'title'     => esc_html__('Margin', 'landshop'),
            'subtitle'  => esc_html__('Control the margin around the post box. Input the margin as clockwise (Top Right Bottom Left)', 'landshop'),
            'id'        => 'post_box_margin',
            'type'      => 'spacing',
            'output'    => array( '.post-box' ),
            'mode'      => 'margin',
            'units'     => array( 'em', 'px', '%' ),
            'units_extended' => 'true',
        ),
        array(
            'title'     => esc_html__('Padding', 'landshop'),
            'subtitle'  => esc_html__('Padding around the post box. Input the padding as clockwise (Top Right Bottom Left)', 'landshop'),
            'id'        => 'post_box_padding',
            'type'      => 'spacing',
            'output'    => array( '.post-box .content' ),
            'mode'      => 'padding',
            'units'     => array( 'em', 'px', '%' ),
            'units_extended' => 'true',
        ),
        array(
            'title'     => esc_html__('Background Color', 'landshop'),
            'id'        => 'post_box_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.post-box .content'),
        ),
         array(
            'id'       => 'post_box_border',
            'type'     => 'border',
            'title'    => esc_html__( 'Border', 'landshop' ),
            'output'   => array( '.post-box .content' ),
        ),
        array(
            'id'     => 'post_box_style_section_end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
) );


Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Thumbnail', 'landshop' ),
    'id'         => 'blog_post_image_section',
    'subsection' => true,
    'fields'     => array(
         array(
            'id'       => 'post_thumbnail',
            'type'     => 'switch',
            'title'    => esc_html__( 'Image Visibility', 'landshop' ),
            'on'        => esc_html__('Show', 'landshop'),
            'off'       => esc_html__('Hide', 'landshop'),
            'default'  => true,
        ),
        array(
            'id'       => 'post_thumb_size',
            'type'     => 'select',
            'title'    => esc_html__( 'Image Size', 'landshop' ),
            'options'  => array(
                'thumbnail' => esc_html__( 'Thumbnail','landshop' ),
                'medium' => esc_html__( 'Medium','landshop' ),
                'large' => esc_html__( 'Large','landshop' ),
                'large' => esc_html__( 'Large','landshop' ),
                'full' => esc_html__( 'Full','landshop' ),
                'landshop_770x450' => esc_html__( 'landshop_770x450','landshop' ),
            ),
            'default'  => 'landshop_770x450',             
            'required' => array( 'post_thumbnail', '=', true )
        ),
        array(
            'title'     => esc_html__('Update Style', 'landshop'),
            'id'        => 'post_image_style_section',
            'type'      => 'section',
            'indent'    => true,        
            'required' => array( 'post_thumbnail', '=', '1' )
        ),
        array(
            'title'     => esc_html__('Image Margin', 'landshop'),
            'subtitle'  => esc_html__('Margin around the post Image. Input the margin as clockwise (Top Right Bottom Left)', 'landshop'),
            'id'        => 'post_image_margin',
            'type'      => 'spacing',
            'output'    => array( '.post-box .post-media' ),
            'mode'      => 'margin',
            'units'     => array( 'em', 'px', '%' ),
            'units_extended' => 'true',
        ),
        array(
            'title'     => esc_html__('Image Padding', 'landshop'),
            'subtitle'  => esc_html__('Padding around the post Image. Input the padding as clockwise (Top Right Bottom Left)', 'landshop'),
            'id'        => 'post_image_padding',
            'type'      => 'spacing',
            'output'    => array( '.post-box .post-media' ),
            'mode'      => 'padding',
            'units'     => array( 'em', 'px', '%' ),
            'units_extended' => 'true',
        ),
         array(
            'id'       => 'post_image_border',
            'type'     => 'border',
            'title'    => esc_html__( 'Image Border', 'landshop' ),
            'output'   => array( '.post-box .post-media' ),
        ),
        array(
            'id'     => 'post_image_style_section_end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
) );
Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Post Title', 'landshop' ),
    'id'         => 'blog_post_title_section',
    'subsection' => true,
    'fields'     => array(
         array(
            'id'       => 'post_title',
            'type'     => 'switch',
            'title'    => esc_html__( 'Title Visibility', 'landshop' ),
            'on'        => esc_html__('Show', 'landshop'),
            'off'       => esc_html__('Hide', 'landshop'),
            'default'  => true,
        ),
        array(
            'id'      => 'title_length',
            'type'    => 'spinner',
            'title'   => esc_html__( 'Title Length', 'landshop' ),
            'desc'    => esc_html__( 'Min:1, max: 100, step: 1, default value: 15', 'landshop' ),
            'default' => '15',
            'min'     => '1',
            'step'    => '1',
            'max'     => '100',
            'required' => array( 'post_title', '=', true )
        ),
        array(
            'title'     => esc_html__('Title Style', 'landshop'),
            'id'        => 'post_title_style_section',
            'type'      => 'section',
            'indent'    => true,        
            'required' => array( 'post_title', '=', '1' )
        ),
        array(
            'id'          => 'post_title_typography',
            'type'        => 'typography',
            'title'       => esc_html__( 'Title Typography', 'landshop' ),
            'google'      => true,
            'font-backup' => false,
            'font-style'    => false,
            'subsets'       => false,
            'text-transform'    => true,
            'all_styles'  => true,
            'output'      => array( '.post-box .title' ),
            'compiler'    => array( 'post-title-compiler' ),
            'units'       => 'px'
        ),
        array(
            'title'     => esc_html__('Title Hover Color', 'landshop'),
            'subtitle'  => esc_html__('Post title color on hover.', 'landshop'),
            'id'        => 'post_title_hover_color',
            'type'      => 'color',
            'output'    => array('.post-box .title:hover a'),
        ),
        array(
            'title'     => esc_html__('Margin', 'landshop'),
            'subtitle'  => esc_html__('Margin around the post title. Input the margin as clockwise (Top Right Bottom Left)', 'landshop'),
            'id'        => 'post_title_margin',
            'type'      => 'spacing',
            'output'    => array( '.post-box .title' ),
            'mode'      => 'margin',
            'units'     => array( 'em', 'px', '%' ),
            'units_extended' => 'true',
        ),
        array(
            'id'     => 'post_title_style_section_end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
) );
Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Post Content', 'landshop' ),
    'id'         => 'blog_post_content_section',
    'subsection' => true,
    'fields'     => array(
         array(
            'id'       => 'post_desc_format',
            'type'     => 'select',
            'title'    => esc_html__( 'Description Format', 'landshop' ),
            'desc'     => esc_html__( 'Controls if the blog content displays an excerpt or full content or is completely disabled for the assigned blog page in "settings > reading" or blog archive pages.', 'landshop' ),
            //Must provide key => value pairs for select options
            'options'  => array(
                'full' => esc_html__( 'Full','landshop' ),
                'excerpt' => esc_html__( 'Excerpt','landshop' ),
                'custom' => esc_html__( 'Custom','landshop' ),
                'none' => esc_html__( 'None','landshop' ),
            ),
            'default'  => 'excerpt'
        ),
        array(
            'id'      => 'post_desc_lenth',
            'type'    => 'spinner',
            'title'   => esc_html__( 'Excerpt Length', 'landshop' ),
            'desc'    => esc_html__( 'Min:10, max: 150, step: 1, default value: 30', 'landshop' ),
            'default' => '30',
            'min'     => '10',
            'step'    => '1',
            'max'     => '150',
            'required' => array( 'post_desc_format', '=', 'custom' )
        ),
        array(
            'title'     => esc_html__('Content Style', 'landshop'),
            'id'        => 'post_content_style_section',
            'type'      => 'section',
            'indent'    => true,
            'required' => array( 'post_desc_format', '!=', 'none' ),
        ),
        array(
            'id'          => 'post_content_typography',
            'type'        => 'typography',
            'title'       => esc_html__( 'Typography', 'landshop' ),
            'google'      => true,
            'font-backup' => false,
            'font-style'    => false,
            'subsets'       => false,
            'text-transform'    => true,
            'all_styles'  => true,
            'output'      => array( '.post-box .desc' ),
            'compiler'    => array( 'content-compiler' ),
            'units'       => 'px'
        ),
        array(
            'title'     => esc_html__('Margin', 'landshop'),
            'subtitle'  => esc_html__('Margin around the post content. Input the margin as clockwise (Top Right Bottom Left)', 'landshop'),
            'id'        => 'post_content_margin',
            'type'      => 'spacing',
            'output'    => array( '.post-box .desc' ),
            'mode'      => 'margin',
            'units'     => array( 'em', 'px', '%' ),
            'units_extended' => 'true',
        ),
        array(
            'id'     => 'post_content_style_section_end',
            'type'   => 'section',
            'indent' => false,
        ),        	
         array(
            'id'       => 'post_read_more',
            'type'     => 'switch',
            'title'    => esc_html__( 'Read More', 'landshop' ),            
            'on'        => esc_html__('Show', 'landshop'),
            'off'       => esc_html__('Hide', 'landshop'),
            'default'  => true,
        ),
        array(
            'id'       => 'post_read_more_txt',
            'type'     => 'text',
            'title'    => esc_html__( 'Button Text', 'landshop' ),
            'subtitle' => esc_html__( 'This is a post button text.', 'landshop' ),
            'desc'     => esc_html__( 'Enter button text. HTML tag supported.', 'landshop' ),
            'default'  => esc_html__('Read More','landshop'),
            'required' => array( 'post_read_more', '=', true )
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Post Meta', 'landshop' ),
    'id'         => 'blog_meta_section',
    'subsection' => true,
    'fields'     => array(
		array(
            'id'       => 'post_meta',
            'type'     => 'switch',
            'title'    => esc_html__( 'Post Meta', 'landshop' ),
            'on'        => esc_html__('Show', 'landshop'),
            'off'       => esc_html__('Hide', 'landshop'),
            'default'  => true,
        ),
		array(
            'id'       => 'post_meta_author',
            'type'     => 'switch',
            'title'    => esc_html__( 'Author', 'landshop' ),
            'on'        => esc_html__('Show', 'landshop'),
            'off'       => esc_html__('Hide', 'landshop'),
            'default'  => true,
            'required' => array( 'post_meta', '=', '1' )
        ),
		array(
            'id'       => 'post_meta_date',
            'type'     => 'switch',
            'title'    => esc_html__( 'Date', 'landshop' ),
            'on'        => esc_html__('Show', 'landshop'),
            'off'       => esc_html__('Hide', 'landshop'),
            'default'  => true,
            'required' => array( 'post_meta', '=', '1' )
        ),
		array(
            'id'       => 'post_meta_comment',
            'type'     => 'switch',
            'title'    => esc_html__( 'Comments', 'landshop' ),
            'on'        => esc_html__('Show', 'landshop'),
            'off'       => esc_html__('Hide', 'landshop'),
            'default'  => true,
            'required' => array( 'post_meta', '=', '1' )
        ),
		array(
            'id'       => 'post_meta_tag',
            'type'     => 'switch',
            'title'    => esc_html__( 'Tags', 'landshop' ),
            'on'        => esc_html__('Show', 'landshop'),
            'off'       => esc_html__('Hide', 'landshop'),
            'default'  => true,
            'required' => array( 'post_meta', '=', '1' )
        ),
		array(
            'id'       => 'post_meta_cat',
            'type'     => 'switch',
            'title'    => esc_html__( 'Category', 'landshop' ),
            'on'        => esc_html__('Show', 'landshop'),
            'off'       => esc_html__('Hide', 'landshop'),
            'default'  => true,
            'required' => array( 'post_meta', '=', '1' )
        ),
		array(
            'id'       => 'post_meta_view',
            'type'     => 'switch',
            'title'    => esc_html__( 'View Count', 'landshop' ),
            'on'        => esc_html__('Show', 'landshop'),
            'off'       => esc_html__('Hide', 'landshop'),
            'default'  => true,
            'required' => array( 'post_meta', '=', '1' )
        ),
        array(
            'title'     => esc_html__('Meta Style', 'landshop'),
            'id'        => 'post_meta_style_section',
            'type'      => 'section',
            'indent'    => true,        
            'required' => array( 'post_meta', '=', '1' )
        ),
        array(
            'id'          => 'post_meta_typography',
            'type'        => 'typography',
            'title'       => esc_html__( 'Meta Typography', 'landshop' ),
            'google'      => true,
            'font-backup' => false,
            'font-style'    => false,
            'subsets'       => false,
            'text-transform'    => true,
            'all_styles'  => true,
            'output'      => array( '.post-box .meta_list','.post-box .meta_list a' ),
            'compiler'    => array( 'post-meta-compiler' ),
            'units'       => 'px'
        ),
        array(
            'title'     => esc_html__('Meta Icon Color', 'landshop'),
            'subtitle'  => esc_html__('Meta icon color.', 'landshop'),
            'id'        => 'post_meta_icon_color',
            'type'      => 'color',
            'output'    => array('.post-box .meta_list i'),
        ),
        array(
            'title'     => esc_html__('Meta Hover Color', 'landshop'),
            'subtitle'  => esc_html__('Meta color on hover.', 'landshop'),
            'id'        => 'post_meta_hover_color',
            'type'      => 'color',
            'output'    => array('.post-box .meta_list a:hover'),
        ),

        array(
            'title'     => esc_html__('Meta Spacing', 'landshop'),
            'subtitle'  => esc_html__('Margin around the post meta item. Input the margin as clockwise (Top Right Bottom Left)', 'landshop'),
            'id'        => 'post_meta_item_margin',
            'type'      => 'spacing',
            'output'    => array( '.post-box .meta_list' ),
            'mode'      => 'margin',
            'units'     => array( 'em', 'px', '%' ),
            'units_extended' => 'true',
        ),
        array(
            'id'     => 'post_meta_style_section_end',
            'type'   => 'section',
            'indent' => false,
        ),


    )
) );
Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Post Details', 'landshop' ),
    'id'         => 'single_blog',
    'subsection' => true,
    'fields'     => array(
         array(
            'id'       => 'single_releted_tag',
            'type'     => 'switch',
            'title'    => esc_html__( 'Releted Tags?', 'landshop' ),
            'default'  => true,
        ),
         array(
            'id'       => 'single_post_share',
            'type'     => 'switch',
            'title'    => esc_html__( 'Social Share?', 'landshop' ),
            'default'  => false,
        ),
         array(
            'id'       => 'single_post_nav',
            'type'     => 'switch',
            'title'    => esc_html__( 'Next Post Navigation?', 'landshop' ),
            'default'  => true,
        ),
         array(
            'id'       => 'single_author_info',
            'type'     => 'switch',
            'title'    => esc_html__( 'Author Info?', 'landshop' ),
            'default'  => true,
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Footer', 'landshop' ),
    'id'               => 'footer_options',
    'desc'             => esc_html__( 'You can edit all of footer option.', 'landshop' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-list-alt',
	'fields'     => array(           
        array(
            'title'     => esc_html__('Footer Template', 'landshop'),
            'subtitle'  => esc_html__( 'At first create a elementor template footer and select form here.', 'landshop' ),
            'id'        => 'footer_template',
            'type'      => 'select',
            'options'   => landshop_get_post_title('elementor_library'),
        ),
        array(
            'id'        => 'if_footer_template_selected',
            'type'      => 'info',
            'style'     => 'warning',
            'title'     => esc_html__( 'Warning', 'landshop' ),
            'desc'      => esc_html__( 'You have selected a Custom Footer template. Now, all the Footer Settings will not apply. Edit your Footer template with Footer Elementor.', 'landshop' ),
            'required'  => array( 'footer_template', '!=', '' ),
        ),
		array(
            'id'       => 'copyright_text',
            'type'     => 'editor',
            'title'    => esc_html__( 'Copyright Text', 'landshop' ),
            'subtitle' => esc_html__( 'Please type your copyright text. You can use all HTML tags.', 'landshop' ),
            'default'  => esc_html__( '&copy; 2022 Landshop - IT Solution Company . All Rights Reserved.','landshop' ),
            'required'  => array( 'footer_template', '=', '' ),
        ),
    ),
) );

Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Style', 'landshop' ),
    'id'         => 'footer_style',
	'required'  => array( 'footer_template', '!=', '' ),
    'subsection' => true,
    'fields'     => array(
        array(         
            'id'       => 'footer_bg',
            'type'     => 'background',
            'output'      => array( '.footer_area' ),
            'title'    => esc_html__( 'Background', 'landshop' ),
            'subtitle' => esc_html__( 'Footer background with image, color, etc.', 'landshop' )
        ),
         array(
			'id'    => 'footer_heading_color',
			'type'  => 'color',
			'default'  => '#ffffff',
			'title' => esc_html__('Title Color', 'landshop'),
			'subtitle' => esc_html__('Controls the footer heading text color throughout the theme.', 'landshop'),
        	'validate' => 'color',
		 ),
         array(
			'id'    => 'footer_text_color',
			'type'  => 'color',
			'default'  => '#9FA1A5',
			'title' => esc_html__('Text Color', 'landshop'),
			'subtitle' => esc_html__('Controls the footer text color throughout the theme.', 'landshop'),
        	'validate' => 'color',
		 ),
         array(
			'id'    => 'footer_gray_color',
			'type'  => 'color',
			'default'  => '#1E212C',
			'title' => esc_html__('Border Color', 'landshop'),
			'subtitle' => esc_html__('Controls the footer border color throughout the theme.', 'landshop'),		
        	'validate' => 'color',
		 ),
         array(
			'id'    => 'footer_white_color',
			'type'  => 'color',
			'default'  => '#ffffff',
			'title' => esc_html__('white Color', 'landshop'),
			'subtitle' => esc_html__('Controls the footer white color throughout the theme.', 'landshop'),		
        	'validate' => 'color',
		 ),
    )
) );
Redux::setSection( $opt_name, array(
    'title'            => esc_html__( '404 page', 'landshop' ),
    'id'               => 'error_page_option',
    'desc'             => esc_html__( 'You can edit error page option.', 'landshop' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-info-circle',
	'fields'     => array(
        array(
            'id'       => 'error_image',
            'type'     => 'media',
            'url'      => true,
            'title'    => esc_html__( 'Error image', 'landshop' ),
            'subtitle' => esc_html__( 'Error page side image.', 'landshop' ),
            'default'  => array( 'url' => get_theme_file_uri( 'assets/images/404.png' ) ),
        ),
        array(
            'id'       => 'error_title',
            'type'     => 'text',
            'title'    => esc_html__( 'Title', 'landshop' ),
            'default'  => esc_html__('404 Error','landshop'),
        ),
        array(
            'id'       => 'error_desc',
            'type'     => 'text',
            'title'    => esc_html__( 'Description', 'landshop' ),
            'default'  => esc_html__("The Page You're Looking for Cannot Be Found!",'landshop'),
        )
    )
) );
Redux::setSection( $opt_name , array(
    'title'            => esc_html__( 'Preloader', 'landshop' ),
    'id'               => 'preloader_opt',
    'icon'             => 'dashicons dashicons-controls-repeat',
    'fields'           => array(
        array(
            'id'      => 'is_preloader',
            'type'    => 'switch',
            'title'   => esc_html__( 'loader Switch', 'landshop' ),
            'on'      => esc_html__( 'Show', 'landshop' ),
            'off'     => esc_html__( 'Hide', 'landshop' ),
            'default' => true,
        ),
        array(
            'title'     => esc_html__('Loder Text', 'landshop'),
            'subtitle'  => esc_html__('Enter maximum of 7 letters.', 'landshop'),
            'id'        => 'loader_text',
            'type'      => 'text',
            'default'   => esc_html__('Loading', 'landshop'),
            'required'  => array('is_preloader', '=', '1'),
        ),
		'page_bg_color' => array(         
            'id'        => 'preloader_background',
			'type'     => 'background',
            'title'     => esc_html__( 'Background', 'landshop' ),
            'subtitle'  => esc_html__( 'Controls the preloader background.', 'landshop' ),
            'output'    => ['.preloader'],
            'required'  => array('is_preloader', '=', '1'),
		),
    )
));

Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'ScrollUp', 'landshop' ),
    'id'         => 'scrollUp_option',
    'icon'         => 'el el-chevron-up',
    'fields'     => array(
         array(
            'id'       => 'is_scroll_up',
            'type'     => 'switch',
            'title'    => esc_html__( 'Display Button', 'landshop' ),            
            'on'        => esc_html__('Show', 'landshop'),
            'off'       => esc_html__('Hide', 'landshop'),
            'default'  => true,
        ),        
        array(
            'title'     => esc_html__('Color', 'landshop'),
            'id'        => 'scr_btn_color',
            'type'      => 'color',
            'output'    => array('.progress-wrap svg.progress-circle path'),
            'required'  => array('is_scroll_up', '=', '1'),
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Custom CSS', 'landshop' ),
    'id'         => 'custom_css_options',
    'icon'         => 'el el-edit',
    'fields'     => array(
         array(
            'id'       => 'custom_css',
            'type'     => 'ace_editor',
            'title'    => esc_html__( 'Custom CSS Code', 'landshop' ),
            'subtitle' => esc_html__( 'Type your custom CSS code here.', 'landshop' ),
            'mode'     => 'css',
            'theme'    => 'monokai'
        ),
    )
) );