<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */
if ( ! class_exists( 'Redux' ) ) {
    return;
}

// This is your option name where all the Redux data is stored.
$opt_name = "maruncy_opt";

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
    'menu_title'           => __( 'Theme Options', 'maruncy' ),
    'page_title'           => __( 'Theme Options', 'maruncy' ),
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
    'page_slug'            => 'maruncy_opt',
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
    'title'            => __( 'Layout', 'maruncy' ),
    'id'               => 'layout',
    'customizer_width' => '400px',
    'icon'             => 'el el-website',
    'fields'           => array(
		'layout' => array(
            'id'        => 'page_layout',
			'type'     	=> 'radio',
            'title'     => __( 'Layout', 'maruncy' ),
            'subtitle'     => __( 'Controls the site layout.', 'maruncy' ),
			//Must provide key => value pairs for radio options
			'options'  	=> array(
				'1' => __('Boxed Wrapper','maruncy'), 
				'2' => __('Wide Wrapper','maruncy'),
			),
			'default' 	=> '2'
		),
		'site_width' => array(
			'title'		=> __( 'Site Width', 'maruncy' ),
			'subtitle'	=> __( 'Controls the overall site width.', 'maruncy' ),
			'id'		=> 'site_width',
			'width' 	=> true,
			'height' 	=> false,
			'default'   => array('width' => '1170'),
            'type'      => 'dimensions',
            'units'     => array('em','px','%'),
			'desc'      => esc_attr__( 'The value was changed in Maruncy to include both the site-width & side-header width, ex: calc(90% + 300px). Leave this as is, or update it with a single percentage, ex: 95%', 'maruncy' ),
            'output'    => '.page_wrapper',
            'required'  => array('page_layout', '=', '1'),
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
            'title'          => __( 'Boxed Mode Offset Top & Bottom', 'maruncy' ),
            'subtitle'       => __( 'Controls the top/bottom offset of the page background.', 'maruncy' ),
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
            'title'          => __( 'Boxed Mode Inner Padding Left & Right', 'maruncy' ),
            'subtitle'       => __( 'Controls the left and right padding of the boxed background.', 'maruncy' ),
            'required'  => array('page_layout', '=', '1'),
        ),
		'page_bg_color' => array(         
            'id'        => 'page_bg_color',
			'type'     => 'background',
            'title'     => __( 'Page Background', 'maruncy' ),
            'subtitle'  => __( 'Controls the background and opacity for the page.', 'maruncy' ),
            'output'    => ['.main_wrapper'],
            'required'  => array('page_layout', '=', '1'),
		),
    )
));



// Global Color Layout
Redux::setSection($opt_name , array(
    'title'            => __( 'Global Color', 'maruncy' ),
    'id'               => 'gloabl_color',
    'customizer_width' => '400px',
    'icon'             => 'el el-brush',
    'fields'           => array(
         'color_info' => array(
			'id'    => 'color_info',
			'type'  => 'info',
			'title' => __('IMPORTANT NOTE:', 'maruncy'),
			'style' => 'info',
			'desc'  => __('This tab contains general color options. Additional color options for specific areas, can be found within other tabs. Example: For menu color options go to the menu tab.', 'maruncy')
		),
        'primary_color' => array(
           'id'    => 'primary_color',
           'type'  => 'color',
           'title' => __('Primary Color', 'maruncy'),
           'subtitle' => __('Controls the main highlight color throughout the theme.', 'maruncy'),
           'default'   => '#FF6854',
           'validate' => 'color',
        ),
         'heading_color' => array(
			'id'    => 'heading_color',
			'type'  => 'color',
			'title' => __('Black Text', 'maruncy'),
			'subtitle' => __('Controls the body black text color throughout the theme.', 'maruncy'),
			'default'   => '#010212',			
        	'validate' => 'color',
		 ),
         'text_color' => array(
			'id'    => 'text_color',
			'type'  => 'color',
			'title' => __('Light Color', 'maruncy'),
			'subtitle' => __('Controls the body light text color throughout the theme.', 'maruncy'),
			'default'   => '#0C0D24',			
        	'validate' => 'color',
		 ),
         'black_bg' => array(
			'id'    => 'black_bg',
			'type'  => 'color',
			'title' => __('Black Background', 'maruncy'),
			'subtitle' => __('Controls the body background color throughout the theme.', 'maruncy'),
			'default'   => '#252220',			
        	'validate' => 'color',
		 ),
         'body_bg' => array(
			'id'    => 'body_bg',
			'type'  => 'color',
			'title' => __('Body Background', 'maruncy'),
			'subtitle' => __('Controls the body background color throughout the theme.', 'maruncy'),
			'default'   => '#ffffff',			
        	'validate' => 'color',
		 ),
         'gray_bg' => array(
			'id'    => 'gray_bg',
			'type'  => 'color',
			'title' => __('Gray Background', 'maruncy'),
			'subtitle' => __('Controls the all gray color border and line throughout the theme.', 'maruncy'),
			'default'   => '#E5E4E4',			
        	'validate' => 'color',
		 ),
	)
));

Redux::setSection($opt_name , array(
    'title'            => __( 'Navbar', 'maruncy' ),
    'id'               => 'navbar_options',
    'customizer_width' => '400px',
    'icon'             => 'el el-lines',
    'fields'           => array(
        'navbar_style' => array(
            'id'       => 'navbar_style',
            'type'     => 'image_select',
            'title'    => __( 'Navbar Style', 'maruncy' ),
            'subtitle' => esc_html__('A preview of the selected image will appear underneath the select box.', 'maruncy'),
            'desc'     => esc_html__('You can change the menu layout from here.', 'maruncy'),
            'options'  => array(
                '1' => array (
                     'alt'  => __('Navbar One','maruncy'),
                     'img'  => get_theme_file_uri('/assets/images/menu_1.jpg'),
                ),
                '2' => array (
                     'alt'  => __('Navbar Two','maruncy'),
                     'img'  => get_theme_file_uri('/assets/images/menu_2.jpg'),
                ),
                '3' => array (
                     'alt'  => __('Navbar Three','maruncy'),
                     'img'  => get_theme_file_uri('/assets/images/menu_3.jpg'),
                )
            ),
            'default'  => '1',
        ),      
        'navbar_transparent' => array(
            'id'       => 'navbar_transparent',
            'type'     => 'select',
            'title'    => __( 'Transparent Menu', 'maruncy' ),
            'options'  => array(
                'off' => __( 'Off','maruncy' ),
                'transparent_menu' => __( 'Dark Menu Text','maruncy' ),
                'transparent_menu light_menu' => __( 'Light Menu Text','maruncy' )
            ),
            'default'  => 'off',             
        ),
        'navbar_sticky' => array(
            'id'        => 'navbar_sticky',
            'type'      => 'switch',
            'title'     => __( 'Sticky Navbar', 'maruncy' ),
            'on'        => __('On', 'maruncy'),
            'off'       => __('Off', 'maruncy'),
            'default'   => true,
        ),
		'sticky_offset' => array(
			'title'		=> __( 'Sticky Offset', 'maruncy' ),
			'subtitle'	=> __( 'Controls the navbar sticky offset.', 'maruncy' ),
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
            'type'     => 'background',
            'output'   => array( '.nav_area' ),
            'title'    => __( 'Background', 'maruncy' ),
            'subtitle' => __( 'Control the nav area background with image, color, etc.', 'maruncy' ),
        ),
        array(
            'id'       => 'nav_sticky_background',
            'type'     => 'background',
            'output'   => array( '.sticky .nav_area' ),
            'title'    => __( 'Sticky Background', 'maruncy' ),
            'subtitle' => __( 'Control the nav sticky background with image, color, etc.', 'maruncy' ),
        ),
    )
));
Redux::setSection($opt_name , array(
    'title'            => __( 'Logo', 'maruncy' ),
    'id'               => 'navbar_logo',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(		
        array(
            'title'     => __('Logo light', 'maruncy'),
            'subtitle'  => __( 'Upload here a image file for your logo', 'maruncy' ),
            'id'        => 'main_logo',
            'type'      => 'media',
            'default'   => array(
                'url'   => get_theme_file_uri('/assets/images/logo-light.svg') 
            )
        ),
        array(
            'title'     => __('Logo dark', 'maruncy'),
            'id'        => 'sticky_logo',
            'type'      => 'media',
            'default'   => array(
                'url'   => get_theme_file_uri('/assets/images/logo-dark.svg') 
            )
        ),
        array(
            'title'     => __('Logo dimensions', 'maruncy'),
            'subtitle'  => __( 'Set a custom height width for your upload logo.', 'maruncy' ),
            'id'        => 'logo_dimensions',
            'type'      => 'dimensions',
            'units'     => array('em','px','%'),
            'output'    => '.nav_area .nav_logo'
        ),
        array(
            'title'     => __('Padding', 'maruncy'),
            'subtitle'  => __('Padding around the logo. Input the padding as clockwise (Top Right Bottom Left)', 'maruncy'),
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
    'title'            => __( 'Shop Toggle', 'maruncy' ),
    'id'               => 'nav_shop_button',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'title'     => __('Button Visibility', 'maruncy'),
            'id'        => 'nav_shop_display',
            'subtitle'  => __('Do you want to show the shop toggle button at header nav area? Please choose your option.', 'maruncy'),
            'type'      => 'switch',
            'on'        => __('Yes', 'maruncy'),
            'off'       => __('No', 'maruncy'),
            'default'   => false
        ),      
        array(
            'title'     => __('Style', 'maruncy'),
            'subtitle'  => __('You can change your button style from here.', 'maruncy'),
            'id'        => 'nav_shop_style_start',
            'type'      => 'section',
            'indent'    => true,
            'required'  => array('nav_shop_display', '=', '1'),
        ),
        array(
            'title'     => __('Color', 'maruncy'),
            'subtitle'  => __('Control the button text color.', 'maruncy'),
            'id'        => 'nav_shop_color',
            'type'      => 'color',
            'output'    => array('.nav_area .cart_toggle'),
        ),
        array(
            'title'     => __('Hover Color', 'maruncy'),
            'subtitle'  => __('Control the button hover text color.', 'maruncy'),
            'id'        => 'nav_shop_hover_color',
            'type'      => 'color',
            'output'    => array('.nav_area .cart_toggle:hover'),
        ),
        array(
            'title'     => __('BG Color', 'maruncy'),
            'subtitle'  => __('Control the button background color.', 'maruncy'),
            'id'        => 'nav_shop_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.nav_area .cart_toggle'),
        ),
        array(
            'title'     => __('Hover BG Color', 'maruncy'),
            'subtitle'  => __('Control the button hover background color.', 'maruncy'),
            'id'        => 'nav_shop_hover_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.nav_area .cart_toggle:hover'),
        ),
         array(
            'id'       => 'nav_shop_border',
            'type'     => 'border',
            'title'    => __( 'Border', 'maruncy' ),
            'subtitle'  => __('Control the button border/line.', 'maruncy'),
            'output'   => array( '.nav_area .cart_toggle' ),
        ),
         array(
            'id'       => 'nav_shop_hover_border',
            'type'     => 'border',
            'title'    => __( 'Hover Border', 'maruncy' ),
            'subtitle'  => __('Control the button hover border/line.', 'maruncy'),
            'output'   => array( '.nav_area .cart_toggle:hover' ),
        ),
        array(
            'title'     => __('Padding', 'maruncy'),
            'subtitle'  => __('Control the button inner padding/space.', 'maruncy'),
            'id'        => 'nav_shop_padding',
            'type'      => 'spacing',
            'output'    => array( '.nav_area .cart_toggle' ),
            'mode'      => 'padding',
            'units'     => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',
        ),        
        array(
            'title'     => __('Button Radius', 'maruncy'),
            'subtitle'  => __('Radius around the button. Input the radius as clockwise (Top Right Bottom Left)', 'maruncy'),
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
    'title'            => __( 'Search Toggle', 'maruncy' ),
    'id'               => 'nav_search_button',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'title'     => __('Button Visibility', 'maruncy'),
            'id'        => 'nav_search_display',
            'subtitle'  => __('Do you want to show the search button at header nav area? Please choose your option.', 'maruncy'),
            'type'      => 'switch',
            'on'        => __('Yes', 'maruncy'),
            'off'       => __('No', 'maruncy'),
            'default'   => true
        ),      
        array(
            'title'     => __('Style', 'maruncy'),
            'subtitle'  => __('You can change your button style from here.', 'maruncy'),
            'id'        => 'nav_search_style_start',
            'type'      => 'section',
            'indent'    => true,
            'required'  => array('nav_search_display', '=', '1'),
        ),
        array(
            'title'     => __('Color', 'maruncy'),
            'subtitle'  => __('Control the button text color.', 'maruncy'),
            'id'        => 'nav_search_color',
            'type'      => 'color',
            'output'    => array('.nav_area .search_toggle'),
        ),
        array(
            'title'     => __('Hover Color', 'maruncy'),
            'subtitle'  => __('Control the button hover text color.', 'maruncy'),
            'id'        => 'nav_search_hover_color',
            'type'      => 'color',
            'output'    => array('.nav_area .search_toggle:hover'),
        ),
        array(
            'title'     => __('BG Color', 'maruncy'),
            'subtitle'  => __('Control the button background color.', 'maruncy'),
            'id'        => 'nav_search_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.nav_area .search_toggle'),
        ),
        array(
            'title'     => __('Hover BG Color', 'maruncy'),
            'subtitle'  => __('Control the button hover background color.', 'maruncy'),
            'id'        => 'nav_search_hover_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.nav_area .search_toggle:hover'),
        ),
         array(
            'id'       => 'nav_search_border',
            'type'     => 'border',
            'title'    => __( 'Border', 'maruncy' ),
            'subtitle'  => __('Control the button border/line.', 'maruncy'),
            'output'   => array( '.nav_area .search_toggle' ),
        ),
         array(
            'id'       => 'nav_search_hover_border',
            'type'     => 'border',
            'title'    => __( 'Hover Border', 'maruncy' ),
            'subtitle'  => __('Control the button hover border/line.', 'maruncy'),
            'output'   => array( '.nav_area .search_toggle:hover' ),
        ),
        array(
            'title'     => __('Padding', 'maruncy'),
            'subtitle'  => __('Control the button inner padding/space.', 'maruncy'),
            'id'        => 'nav_search_padding',
            'type'      => 'spacing',
            'output'    => array( '.nav_area .search_toggle' ),
            'mode'      => 'padding',
            'units'     => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',
        ),        
        array(
            'title'     => __('Button Radius', 'maruncy'),
            'subtitle'  => __('Radius around the button. Input the radius as clockwise (Top Right Bottom Left)', 'maruncy'),
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
    'title'            => __( 'Mobile Toggle', 'maruncy' ),
    'id'               => 'toggle_menu',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'title'     => __('Button Visibility', 'maruncy'),
            'id'        => 'toggle_menu_display',
            'subtitle'  => __('Do you want to show the mobile toggle button at header nav area? Please choose your option.', 'maruncy'),
            'type'      => 'switch',
            'on'        => __('Yes', 'maruncy'),
            'off'       => __('No', 'maruncy'),
            'default'   => true
        ),
        'mobile_menu_active' => array(
            'id'        => 'mobile_menu_active',
            'type'      => 'slider',
			'title'		=> __( 'Mobile Menu Active', 'maruncy' ),
			'subtitle'	=> __( 'Controls the main menu active width.', 'maruncy' ),
            "default"   => 1200,
            "min"       => 1,
            "step"      => 1,
            "max"       => 3000,
            'display_value' => 'text',
            'required'  => array('toggle_menu_display', '=', '1'),
        ),
        array(
            'title'     => __('Style', 'maruncy'),
            'subtitle'  => __('You can change your button style from here.', 'maruncy'),
            'id'        => 'toggle_menu_style_start',
            'type'      => 'section',
            'indent'    => true,
            'required'  => array('toggle_menu_display', '=', '1'),
        ),
        array(
            'title'     => __('Color', 'maruncy'),
            'subtitle'  => __('Control the button text color.', 'maruncy'),
            'id'        => 'toggle_menu_color',
            'type'      => 'color',
            'output'    => array('.nav_area .mobile_menu_toggle'),
        ),
        array(
            'title'     => __('Hover Color', 'maruncy'),
            'subtitle'  => __('Control the button hover text color.', 'maruncy'),
            'id'        => 'toggle_menu_hover_color',
            'type'      => 'color',
            'output'    => array('.nav_area .mobile_menu_toggle:hover'),
        ),
        array(
            'title'     => __('BG Color', 'maruncy'),
            'subtitle'  => __('Control the button background color.', 'maruncy'),
            'id'        => 'toggle_menu_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.nav_area .mobile_menu_toggle'),
        ),
        array(
            'title'     => __('Hover BG Color', 'maruncy'),
            'subtitle'  => __('Control the button hover background color.', 'maruncy'),
            'id'        => 'toggle_menu_hover_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.nav_area .mobile_menu_toggle:hover'),
        ),
         array(
            'id'       => 'toggle_menu_border',
            'type'     => 'border',
            'title'    => __( 'Border', 'maruncy' ),
            'subtitle'  => __('Control the button border/line.', 'maruncy'),
            'output'   => array( '.nav_area .mobile_menu_toggle' ),
        ),
         array(
            'id'       => 'toggle_menu_hover_border',
            'type'     => 'border',
            'title'    => __( 'Hover Border', 'maruncy' ),
            'subtitle'  => __('Control the button hover border/line.', 'maruncy'),
            'output'   => array( '.nav_area .mobile_menu_toggle:hover' ),
        ),
        array(
            'title'     => __('Padding', 'maruncy'),
            'subtitle'  => __('Control the button inner padding/space.', 'maruncy'),
            'id'        => 'toggle_menu_padding',
            'type'      => 'spacing',
            'output'    => array( '.nav_area .mobile_menu_toggle' ),
            'mode'      => 'padding',
            'units'     => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',
        ),        
        array(
            'title'     => __('Button Radius', 'maruncy'),
            'subtitle'  => __('Radius around the button. Input the radius as clockwise (Top Right Bottom Left)', 'maruncy'),
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
    'title'            => __( 'Primary Button', 'maruncy' ),
    'id'               => 'nav_primary_button',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'title'     => __('Button Visibility', 'maruncy'),
            'id'        => 'nav_button_display',
            'subtitle'  => __('Do you want to show the action button at header nav area? Please choose your option.', 'maruncy'),
            'type'      => 'switch',
            'on'        => __('Yes', 'maruncy'),
            'off'       => __('No', 'maruncy'),
            'default'   => false
        ),
        array(
            'title'     => __('Button Label', 'maruncy'),
            'subtitle'  => __('Enter type your action button text/label.', 'maruncy'),
            'id'        => 'nav_button_label',
            'type'      => 'text',
            'default'   => __('Donate Now', 'maruncy'),
            'required'  => array('nav_button_display', '=', '1')
        ),
        array(
            'title'     => __('Button URL', 'maruncy'),
            'id'        => 'nav_button_url',
            'subtitle'  => __('Enter type your action button URL/Link.', 'maruncy'),
            'type'      => 'text',
            'default'   => '#',
            'required'  => array('nav_button_display', '=', '1')
        ),  
         array(
            'id'       => 'nav_button_icon',
            'type'     => 'media', 
            'url'      => true,
            'title'    => __('Upload Icon', 'maruncy'),
            'required'  => array('nav_button_display', '=', '1')
        ),
        array(
            'title'     => __('Color', 'maruncy'),
            'subtitle'  => __('Control the button text color.', 'maruncy'),
            'id'        => 'nav_button_color',
            'type'      => 'color',
            'output'    => array('.nav_area .button'),
            'required'  => array('nav_button_display', '=', '1'),
        ),
        array(
            'title'     => __('Hover Color', 'maruncy'),
            'subtitle'  => __('Control the button hover text color.', 'maruncy'),
            'id'        => 'nav_button_hover_color',
            'type'      => 'color',
            'output'    => array('.nav_area .button:hover'),
            'required'  => array('nav_button_display', '=', '1'),
        ),
        array(
            'title'     => __('BG Color', 'maruncy'),
            'subtitle'  => __('Control the button background color.', 'maruncy'),
            'id'        => 'nav_button_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'required'  => array('nav_button_display', '=', '1'),
            'output'    => array('.nav_area .button'),
        ),
        array(
            'title'     => __('Hover BG Color', 'maruncy'),
            'subtitle'  => __('Control the button hover background color.', 'maruncy'),
            'id'        => 'nav_button_hover_bg_color',
            'type'      => 'color',
            'required'  => array('nav_button_display', '=', '1'),
            'mode'      => 'background',
            'output'    => array('.nav_area .button:hover'),
        ),
         array(
            'id'       => 'nav_button_border',
            'type'     => 'border',
            'title'    => __( 'Border', 'maruncy' ),
            'subtitle'  => __('Control the button border/line.', 'maruncy'),
            'output'   => array( '.nav_area .button' ),
            'required'  => array('nav_button_display', '=', '1'),
        ),
         array(
            'id'       => 'nav_button_hover_border',
            'type'     => 'border',
            'title'    => __( 'Hover Border', 'maruncy' ),
            'subtitle'  => __('Control the button hover border/line.', 'maruncy'),
            'required'  => array('nav_button_display', '=', '1'),
            'output'   => array( '.nav_area .button:hover' ),
        ),
        array(
            'title'     => __('Padding', 'maruncy'),
            'subtitle'  => __('Control the button inner padding/space.', 'maruncy'),
            'id'        => 'nav_button_padding',
            'type'      => 'spacing',
            'output'    => array( '.nav_area .primary_button' ),
            'mode'      => 'padding',
            'required'  => array('nav_button_display', '=', '1'),
            'units'     => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',
        ),    
        array(
            'title'     => __('Margin', 'maruncy'),
            'subtitle'  => __('Control the button inner margin/space.', 'maruncy'),
            'id'        => 'nav_button_margin',
            'type'      => 'spacing',
            'output'    => array( '.nav_area .primary_button' ),
            'mode'      => 'margin',
            'required'  => array('nav_button_display', '=', '1'),
            'units'     => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',
        ),        
        array(
            'title'     => __('Button Radius', 'maruncy'),
            'subtitle'  => __('Radius around the button. Input the radius as clockwise (Top Right Bottom Left)', 'maruncy'),
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
    'title'            => __( 'Phone Number', 'maruncy' ),
    'id'               => 'nav_phone_number',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'title'     => __('Number Visibility', 'maruncy'),
            'id'        => 'nav_number_display',
            'subtitle'  => __('Do you want to show the phone number at header nav area? Please choose your option.', 'maruncy'),
            'type'      => 'switch',
            'on'        => __('Yes', 'maruncy'),
            'off'       => __('No', 'maruncy'),
            'default'   => false
        ),
        array(
            'title'     => __('Number', 'maruncy'),
            'subtitle'  => __('Enter type your phone number.', 'maruncy'),
            'id'        => 'nav_phone_number',
            'type'      => 'text',
            'default'   => __('+161 94 32 141', 'maruncy'),
            'required'  => array('nav_number_display', '=', '1')
        ),
        array(
            'title'     => __('Link', 'maruncy'),
            'id'        => 'nav_phone_url',
            'subtitle'  => __('Enter type your URL/Link.', 'maruncy'),
            'type'      => 'text',
            'default'   => 'tel:+1619432141',
            'required'  => array('nav_number_display', '=', '1')
        ),
         array(
            'id'       => 'nav_phone_icon',
            'type'     => 'media', 
            'url'      => true,
            'title'    => __('Upload Icon', 'maruncy'),
            'required'  => array('nav_number_display', '=', '1')
        ),
    )
));

Redux::setSection( $opt_name, array(
    'title'            => __( 'Site Header', 'maruncy' ),
    'id'               => 'site_header',
    'desc'             => __( 'You can change global page header options and styles!', 'maruncy' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-flag-alt',
) );

Redux::setSection( $opt_name, array(
    'title'      => __( 'Page Header', 'maruncy' ),
    'id'         => 'page_header_option',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'page_header_background',
            'type'     => 'background',
            'output'   => array( '.site-header' ),
            'title'    => __( 'Background', 'maruncy' ),
            'subtitle' => __( 'Control the page header background with image, color, etc.', 'maruncy' ),
            'default'  => array( 'url' => get_theme_file_uri( 'assets/images/header-bg.jpg' ) ),
        ),
         array(
            'id'       => 'page_header_overlay',
            'type'     => 'color_rgba',
            'title'    => __( 'Background Overlay', 'maruncy' ),
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
            'title'          => __( 'Header Padding', 'maruncy' ),
            'subtitle'       => __( 'Site Header Spacing Define', 'maruncy' ),
            'desc'           => __( 'To define Top, Right, Bottom, Left padding', 'maruncy' ),
        ),        
        array(
            'id'       => 'page_header_align',
            'type'     => 'button_set',
            'title'    => __('Alignment', 'maruncy'),
            //Must provide key => value pairs for options
            'options' => array(
                'left' => __('Left', 'maruncy'),
                'center' => __('Center', 'maruncy'),
                'right' => __('Right', 'maruncy')
            ),
            'default' => 'left'
        ),
        array(
            'title'     => __('Element One', 'maruncy'),
            'id'        => 'header_element_one',
            'type'      => 'media',
            'default'   => array(
                'url'   => get_theme_file_uri('/assets/images/element-1.svg') 
            )
        ),
        array(
            'title'     => __('Element Two', 'maruncy'),
            'id'        => 'header_element_two',
            'type'      => 'media',
            'default'   => array(
                'url'   => get_theme_file_uri('/assets/images/element-2.svg') 
            )
        ),
        array(
            'title'     => __('Element Three', 'maruncy'),
            'id'        => 'header_element_three',
            'type'      => 'media',
            'default'   => array(
                'url'   => get_theme_file_uri('/assets/images/element-3.svg') 
            )
        ),
    ),
) );
Redux::setSection( $opt_name, array(
    'title'            => __( 'Page Title', 'maruncy' ),
    'id'               => 'header_page_title',
    'subsection'       => true,
    'customizer_width' => '400px',
    'fields'           => array(
        array(
            'title'     => __('Title Visibility', 'maruncy'),
            'id'        => 'page_title',
            'subtitle'  => __('Do you want to show the page title at header area? Please choose your option.', 'maruncy'),
            'type'      => 'switch',
            'on'        => __('Yes', 'maruncy'),
            'off'       => __('No', 'maruncy'),
            'default'   => true
        ),
        array(
            'id'       => 'blog_page_title',
            'type'     => 'text',
            'title'    => __( 'Blog Page Title', 'maruncy' ),
            'subtitle' => __( 'Control the post page title.', 'maruncy' ),
            'desc'     => __( 'You can update your blog page title from here!.', 'maruncy' ),
            'default'  => __('Blog List', 'maruncy'),
        ),
        array(
            'id'       => 'search_page_title',
            'type'     => 'text',
            'title'    => __( 'Search Page Title', 'maruncy' ),
            'subtitle' => __( 'Control the search page title.', 'maruncy' ),
            'desc'     => __( 'You can update your search page title from here!.', 'maruncy' ),
            'default'  => __('Search', 'maruncy'),
        ),
        array(
            'id'          => 'page_title_typography',
            'type'        => 'typography',
            'title'       => __( 'Title Typography', 'maruncy' ),
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
            'subtitle'    => __( 'Typography option with each property can be called individually.', 'maruncy' ),
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
            'title'          => __( 'Title Space', 'maruncy' ),
            'subtitle'       => __( 'Page title spacing.', 'maruncy' ),
            'desc'           => __( 'You can define spacing for page title at Top, Right, Bottom, Left, or Units.', 'maruncy' ),
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'            => __( 'Page Sub Title', 'maruncy' ),
    'id'               => 'page_header_sub_title',
    'subsection'       => true,
    'customizer_width' => '400px',
    'fields'           => array(
        array(
            'id'       => 'sub_title_format',
            'type'     => 'radio',
            'title'    => __( 'Display Format', 'maruncy' ),
            'subtitle' => __( 'Page header subtitle format.', 'maruncy' ),
            'desc'     => __( 'Please select subtitle display format.', 'maruncy' ),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => __( 'Site Description' , 'maruncy' ),
                '2' => __( 'Breadcrumb' , 'maruncy' ),
                '3' => __( 'Custom Subtitle' , 'maruncy' ),
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'breadcrumb_home',
            'type'     => 'text',
            'title'    => __( 'Breadcrumb Home', 'maruncy' ),
            'subtitle' => __( 'Breadcrumbs menu home name.', 'maruncy' ),
            'desc'     => __( 'To set breadcrumb home text.', 'maruncy' ),
            'default'  => __('Home','maruncy'),
            'required' => array( 'sub_title_format','=','2')
        ),
        array(
            'id'       => 'breadcrumb_separator',
            'type'     => 'text',
            'title'    => __( 'Breadcrumb Separator', 'maruncy' ),
            'subtitle' => __( 'Breadcrumbs menu item separator.', 'maruncy' ),
            'desc'     => __( 'To set breadcrumb separator.', 'maruncy' ),
            'default'  => '|',
            'required' => array( 'sub_title_format','=','2')
        ),        
        array(
            'id'       => 'custom_sub_title',
            'type'     => 'text',
            'title'    => __( 'Custom Sub Title', 'maruncy' ),
            'subtitle' => __( 'To set custom page subtitle.', 'maruncy' ),
            'desc'     => __( 'Enter your custom page subtitle.', 'maruncy' ),
            'default'  => __('Welcome to our website.', 'maruncy'),
            'required' => array( 'sub_title_format','=','3')
        ),
        array(
            'id'          => 'page_sub_title_typography',
            'type'        => 'typography',
            'title'       => __( 'Sub Title Typography', 'maruncy' ),
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
            'subtitle'    => __( 'Typography option with each property can be called individually.', 'maruncy' ),
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
            'title'          => __( 'Subtitle Space', 'maruncy' ),
            'subtitle'       => __( 'Allow your users to choose the spacing or margin they want.', 'maruncy' ),
            'desc'           => __( 'You can enable or disable any piece of this field. Top, Right, Bottom, Left, or Units.', 'maruncy' ),
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'            => __( 'Blog Settings', 'maruncy' ),
    'id'               => 'blog_posts_option',
    'desc'             => __( 'Control the blog post all option from here!', 'maruncy' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-text-width'
) );
Redux::setSection( $opt_name, array(
    'title'      => __( 'Post Box', 'maruncy' ),
    'id'         => 'post_box_section',
    'subsection' => true,
    'fields'     => array(
        array(
            'title'     => esc_html__('Box Style', 'maruncy'),
            'id'        => 'post_box_style',
            'type'      => 'section',
            'indent'    => true,        
        ),
        array(
            'title'     => esc_html__('Margin', 'maruncy'),
            'subtitle'  => esc_html__('Control the margin around the post box. Input the margin as clockwise (Top Right Bottom Left)', 'maruncy'),
            'id'        => 'post_box_margin',
            'type'      => 'spacing',
            'output'    => array( '.post-box' ),
            'mode'      => 'margin',
            'units'     => array( 'em', 'px', '%' ),
            'units_extended' => 'true',
        ),
        array(
            'title'     => esc_html__('Padding', 'maruncy'),
            'subtitle'  => esc_html__('Padding around the post box. Input the padding as clockwise (Top Right Bottom Left)', 'maruncy'),
            'id'        => 'post_box_padding',
            'type'      => 'spacing',
            'output'    => array( '.post-box .content' ),
            'mode'      => 'padding',
            'units'     => array( 'em', 'px', '%' ),
            'units_extended' => 'true',
        ),
        array(
            'title'     => esc_html__('Background Color', 'maruncy'),
            'id'        => 'post_box_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array('.post-box .content'),
        ),
         array(
            'id'       => 'post_box_border',
            'type'     => 'border',
            'title'    => __( 'Border', 'maruncy' ),
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
    'title'      => __( 'Thumbnail', 'maruncy' ),
    'id'         => 'blog_post_image_section',
    'subsection' => true,
    'fields'     => array(
         array(
            'id'       => 'post_thumbnail',
            'type'     => 'switch',
            'title'    => __( 'Image Visibility', 'maruncy' ),
            'on'        => esc_html__('Show', 'maruncy'),
            'off'       => esc_html__('Hide', 'maruncy'),
            'default'  => true,
        ),
        array(
            'id'       => 'post_thumb_size',
            'type'     => 'select',
            'title'    => __( 'Image Size', 'maruncy' ),
            'options'  => array(
                'thumbnail' => __( 'Thumbnail','maruncy' ),
                'medium' => __( 'Medium','maruncy' ),
                'large' => __( 'Large','maruncy' ),
                'full' => __( 'Full','maruncy' ),
            ),
            'default'  => 'full',             
            'required' => array( 'post_thumbnail', '=', true )
        ),
        array(
            'title'     => esc_html__('Update Style', 'maruncy'),
            'id'        => 'post_image_style_section',
            'type'      => 'section',
            'indent'    => true,        
            'required' => array( 'post_thumbnail', '=', '1' )
        ),
        array(
            'title'     => esc_html__('Image Margin', 'maruncy'),
            'subtitle'  => esc_html__('Margin around the post Image. Input the margin as clockwise (Top Right Bottom Left)', 'maruncy'),
            'id'        => 'post_image_margin',
            'type'      => 'spacing',
            'output'    => array( '.post-box .post_media' ),
            'mode'      => 'margin',
            'units'     => array( 'em', 'px', '%' ),
            'units_extended' => 'true',
        ),
        array(
            'title'     => esc_html__('Image Padding', 'maruncy'),
            'subtitle'  => esc_html__('Padding around the post Image. Input the padding as clockwise (Top Right Bottom Left)', 'maruncy'),
            'id'        => 'post_image_padding',
            'type'      => 'spacing',
            'output'    => array( '.post-box .post_media' ),
            'mode'      => 'padding',
            'units'     => array( 'em', 'px', '%' ),
            'units_extended' => 'true',
        ),
         array(
            'id'       => 'post_image_border',
            'type'     => 'border',
            'title'    => __( 'Image Border', 'maruncy' ),
            'output'   => array( '.post-box .post_media' ),
        ),
        array(
            'id'     => 'post_image_style_section_end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
) );
Redux::setSection( $opt_name, array(
    'title'      => __( 'Post Title', 'maruncy' ),
    'id'         => 'blog_post_title_section',
    'subsection' => true,
    'fields'     => array(
         array(
            'id'       => 'post_title',
            'type'     => 'switch',
            'title'    => __( 'Title Visibility', 'maruncy' ),
            'on'        => esc_html__('Show', 'maruncy'),
            'off'       => esc_html__('Hide', 'maruncy'),
            'default'  => true,
        ),
        array(
            'id'      => 'title_length',
            'type'    => 'spinner',
            'title'   => __( 'Title Length', 'maruncy' ),
            'desc'    => __( 'Min:1, max: 100, step: 1, default value: 15', 'maruncy' ),
            'default' => '15',
            'min'     => '1',
            'step'    => '1',
            'max'     => '100',
            'required' => array( 'post_title', '=', true )
        ),
        array(
            'title'     => esc_html__('Title Style', 'maruncy'),
            'id'        => 'post_title_style_section',
            'type'      => 'section',
            'indent'    => true,        
            'required' => array( 'post_title', '=', '1' )
        ),
        array(
            'id'          => 'post_title_typography',
            'type'        => 'typography',
            'title'       => __( 'Title Typography', 'maruncy' ),
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
            'title'     => esc_html__('Title Hover Color', 'maruncy'),
            'subtitle'  => esc_html__('Post title color on hover.', 'maruncy'),
            'id'        => 'post_title_hover_color',
            'type'      => 'color',
            'output'    => array('.post-box .title:hover a'),
        ),
        array(
            'title'     => esc_html__('Margin', 'maruncy'),
            'subtitle'  => esc_html__('Margin around the post title. Input the margin as clockwise (Top Right Bottom Left)', 'maruncy'),
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
    'title'      => __( 'Post Content', 'maruncy' ),
    'id'         => 'blog_post_content_section',
    'subsection' => true,
    'fields'     => array(
         array(
            'id'       => 'post_desc_format',
            'type'     => 'select',
            'title'    => __( 'Description Format', 'maruncy' ),
            'desc'     => __( 'Controls if the blog content displays an excerpt or full content or is completely disabled for the assigned blog page in "settings > reading" or blog archive pages.', 'maruncy' ),
            //Must provide key => value pairs for select options
            'options'  => array(
                'full' => __( 'Full','maruncy' ),
                'excerpt' => __( 'Excerpt','maruncy' ),
                'custom' => __( 'Custom','maruncy' ),
                'none' => __( 'None','maruncy' ),
            ),
            'default'  => 'excerpt'
        ),
        array(
            'id'      => 'post_desc_lenth',
            'type'    => 'spinner',
            'title'   => __( 'Excerpt Length', 'maruncy' ),
            'desc'    => __( 'Min:10, max: 150, step: 1, default value: 30', 'maruncy' ),
            'default' => '30',
            'min'     => '10',
            'step'    => '1',
            'max'     => '150',
            'required' => array( 'post_desc_format', '=', 'custom' )
        ),
        array(
            'title'     => esc_html__('Content Style', 'maruncy'),
            'id'        => 'post_content_style_section',
            'type'      => 'section',
            'indent'    => true,
            'required' => array( 'post_desc_format', '!=', 'none' ),
        ),
        array(
            'id'          => 'post_content_typography',
            'type'        => 'typography',
            'title'       => __( 'Typography', 'maruncy' ),
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
            'title'     => esc_html__('Margin', 'maruncy'),
            'subtitle'  => esc_html__('Margin around the post content. Input the margin as clockwise (Top Right Bottom Left)', 'maruncy'),
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
            'title'    => __( 'Read More', 'maruncy' ),            
            'on'        => __('Show', 'maruncy'),
            'off'       => __('Hide', 'maruncy'),
            'default'  => false,
        ),
        array(
            'id'       => 'post_read_more_txt',
            'type'     => 'text',
            'title'    => __( 'Button Text', 'maruncy' ),
            'subtitle' => __( 'This is a post button text.', 'maruncy' ),
            'desc'     => __( 'Enter button text. HTML tag supported.', 'maruncy' ),
            'default'  => __('Read More','maruncy'),
            'required' => array( 'post_read_more', '=', true )
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'      => __( 'Post Meta', 'maruncy' ),
    'id'         => 'blog_meta_section',
    'subsection' => true,
    'fields'     => array(
		array(
            'id'       => 'post_meta',
            'type'     => 'switch',
            'title'    => __( 'Post Meta', 'maruncy' ),
            'on'        => __('Show', 'maruncy'),
            'off'       => __('Hide', 'maruncy'),
            'default'  => true,
        ),
        array(
            'title'     => esc_html__('Meta Style', 'maruncy'),
            'id'        => 'post_meta_style_section',
            'type'      => 'section',
            'indent'    => true,        
            'required' => array( 'post_meta', '=', '1' )
        ),
        array(
            'id'          => 'post_meta_typography',
            'type'        => 'typography',
            'title'       => __( 'Meta Typography', 'maruncy' ),
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
            'title'     => esc_html__('Meta Icon Color', 'maruncy'),
            'subtitle'  => esc_html__('Meta icon color.', 'maruncy'),
            'id'        => 'post_meta_icon_color',
            'type'      => 'color',
            'output'    => array('.post-box .meta_list i'),
        ),
        array(
            'title'     => esc_html__('Meta Hover Color', 'maruncy'),
            'subtitle'  => esc_html__('Meta color on hover.', 'maruncy'),
            'id'        => 'post_meta_hover_color',
            'type'      => 'color',
            'output'    => array('.post-box .meta_list a:hover'),
        ),

        array(
            'title'     => esc_html__('Meta Spacing', 'maruncy'),
            'subtitle'  => esc_html__('Margin around the post meta item. Input the margin as clockwise (Top Right Bottom Left)', 'maruncy'),
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
    'title'      => __( 'Post Details', 'maruncy' ),
    'id'         => 'single_blog',
    'subsection' => true,
    'fields'     => array(
         array(
            'id'       => 'single_releted_tag',
            'type'     => 'switch',
            'title'    => __( 'Releted Tags?', 'maruncy' ),
            'default'  => true,
        ),
         array(
            'id'       => 'single_post_share',
            'type'     => 'switch',
            'title'    => __( 'Social Share Menu?', 'maruncy' ),
            'default'  => false,
        ),
         array(
            'id'       => 'single_post_nav',
            'type'     => 'switch',
            'title'    => __( 'Next Post Navigation?', 'maruncy' ),
            'default'  => true,
        ),
         array(
            'id'       => 'single_author_info',
            'type'     => 'switch',
            'title'    => __( 'Author Info?', 'maruncy' ),
            'default'  => true,
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'            => __( 'Footer', 'maruncy' ),
    'id'               => 'footer_options',
    'desc'             => __( 'You can edit all of footer option.', 'maruncy' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-list-alt',
	'fields'     => array(           
        array(
            'title'     => __('Footer Template', 'maruncy'),
            'subtitle'  => __( 'At first create a elementor template footer and select form here.', 'maruncy' ),
            'id'        => 'footer_template',
            'type'      => 'select',
            'options'   => maruncy_get_post_title('elementor_library'),
        ),
        array(
            'id'        => 'if_footer_template_selected',
            'type'      => 'info',
            'style'     => 'warning',
            'title'     => __( 'Warning', 'maruncy' ),
            'desc'      => __( 'You have selected a Custom Footer template. Now, all the Footer Settings will not apply. Edit your Footer template with Footer Elementor.', 'maruncy' ),
            'required'  => array( 'footer_template', '!=', '' ),
        ),
		array(
            'id'       => 'copyright_text',
            'type'     => 'editor',
            'title'    => __( 'Copyright Text', 'maruncy' ),
            'subtitle' => __( 'Please type your copyright text. You can use all HTML tags.', 'maruncy' ),
            'default'  => __( 'Copyright &copy; 2022  by name. All Rights Reserved.','maruncy' ),
            'required'  => array( 'footer_template', '=', '' ),
        ),
    ),
) );

Redux::setSection( $opt_name, array(
    'title'      => __( 'Style', 'maruncy' ),
    'id'         => 'footer_style',
	'required'  => array( 'footer_template', '!=', '' ),
    'subsection' => true,
    'fields'     => array(
        array(         
            'id'       => 'footer_bg',
            'type'     => 'background',
            'output'      => array( '.footer_area' ),
            'title'    => __( 'Background', 'maruncy' ),
            'subtitle' => __( 'Footer background with image, color, etc.', 'maruncy' )
        ),
         array(
			'id'    => 'footer_heading_color',
			'type'  => 'color',
			'default'  => '#ffffff',
			'title' => __('Title Color', 'maruncy'),
			'subtitle' => __('Controls the footer heading text color throughout the theme.', 'maruncy'),
        	'validate' => 'color',
		 ),
         array(
			'id'    => 'footer_text_color',
			'type'  => 'color',
			'default'  => '#ffffff',
			'title' => __('Content Color', 'maruncy'),
			'subtitle' => __('Controls the footer text color throughout the theme.', 'maruncy'),
        	'validate' => 'color',
		 ),
         array(
			'id'    => 'footer_gray_color',
			'type'  => 'color',
			'default'  => '#2B2A3A',
			'title' => __('Border Color', 'maruncy'),
			'subtitle' => __('Controls the footer border color throughout the theme.', 'maruncy'),		
        	'validate' => 'color',
		 ),
    )
) );
Redux::setSection( $opt_name, array(
    'title'            => __( '404 page', 'maruncy' ),
    'id'               => 'error_page_option',
    'desc'             => __( 'You can edit error page option.', 'maruncy' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-info-circle',
	'fields'     => array(
        array(
            'id'       => 'error_image',
            'type'     => 'media',
            'url'      => true,
            'title'    => __( 'Error image', 'maruncy' ),
            'subtitle' => __( 'Error page side image.', 'maruncy' ),
            'default'  => array( 'url' => get_theme_file_uri( 'assets/images/404.png' ) ),
        ),
        array(
            'id'       => 'error_title',
            'type'     => 'text',
            'title'    => __( 'Title', 'maruncy' ),
            'default'  => __('Opps! Page not found','maruncy'),
        ),
        array(
            'id'       => 'error_desc',
            'type'     => 'text',
            'title'    => __( 'Description', 'maruncy' ),
            'default'  => __("Page doesn't exist or some other error occurred. Go to our home page or go back to the previous page.",'maruncy'),
        )
    )
) );
Redux::setSection( $opt_name , array(
    'title'            => esc_html__( 'Preloader', 'maruncy' ),
    'id'               => 'preloader_opt',
    'icon'             => 'dashicons dashicons-controls-repeat',
    'fields'           => array(
        array(
            'id'      => 'is_preloader',
            'type'    => 'switch',
            'title'   => esc_html__( 'loader Switch', 'maruncy' ),
            'on'      => esc_html__( 'Show', 'maruncy' ),
            'off'     => esc_html__( 'Hide', 'maruncy' ),
            'default' => true,
        ),
		'page_bg_color' => array(         
            'id'        => 'preloader_background',
			'type'     => 'background',
            'title'     => __( 'Background', 'maruncy' ),
            'subtitle'  => __( 'Controls the preloader background.', 'maruncy' ),
            'output'    => ['.preloader'],
            'required'  => array('is_preloader', '=', '1'),
		),
    )
));

Redux::setSection( $opt_name, array(
    'title'      => __( 'ScrollUp', 'maruncy' ),
    'id'         => 'scrollUp_option',
    'icon'         => 'el el-chevron-up',
    'fields'     => array(
         array(
            'id'       => 'is_scroll_up',
            'type'     => 'switch',
            'title'    => __( 'Display Button', 'maruncy' ),            
            'on'        => esc_html__('Show', 'maruncy'),
            'off'       => esc_html__('Hide', 'maruncy'),
            'default'  => true,
        ),        
        array(
            'title'     => esc_html__('Color', 'maruncy'),
            'id'        => 'scr_btn_color',
            'type'      => 'color',
            'output'    => array('.progress-wrap svg.progress-circle path'),
            'required'  => array('is_scroll_up', '=', '1'),
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'      => __( 'Custom CSS', 'maruncy' ),
    'id'         => 'custom_css_options',
    'icon'         => 'el el-edit',
    'fields'     => array(
         array(
            'id'       => 'custom_css',
            'type'     => 'ace_editor',
            'title'    => __( 'Custom CSS Code', 'maruncy' ),
            'subtitle' => __( 'Type your custom CSS code here.', 'maruncy' ),
            'mode'     => 'css',
            'theme'    => 'monokai'
        ),
    )
) );