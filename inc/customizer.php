<?php
class Landshop_Customize {
   public static function register ( $wp_customize ) {
      $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
      $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

      // Add setting for the sticky logo
      $wp_customize->add_setting('landshop_sticky_logo', array(
         'default' => '', // Default value for the sticky logo
         'sanitize_callback' => 'esc_url_raw', // Sanitization callback for the URL
      ));
      // Add control for the sticky logo, using WP_Customize_Image_Control
      $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'landshop_sticky_logo', array(
         'label' => __('Sticky Logo', 'landshop'), // Label displayed in the Customizer
         'section' => 'title_tagline', // Section in which the control will be placed
         'settings' => 'landshop_sticky_logo', // Setting to which this control is linked
         'priority' => 8, // Priority/order in the section
      )));

      // Add a new panel for theme options
      $wp_customize->add_panel( 'landshop_theme_options_panel',
         array(
            'title'       => __( 'Theme Options', 'landshop' ),
            'priority'    => 0,
            'capability'  => 'edit_theme_options',
         )
      );

      // Section for Typography Settings
      $wp_customize->add_section( 'landshop_typography_settings',
         array(
            'title'       => __( 'Typography', 'landshop' ),
            'priority'    => 10,
            'capability'  => 'edit_theme_options',
            'panel'       => 'landshop_theme_options_panel',
         )
      );
      // Body Font Size Setting
      $wp_customize->add_setting( 'body_font_size_setting',
         array(
            'default'           => '16px',
            'sanitize_callback' => 'sanitize_text_field',
         )
      );

      $wp_customize->add_control( 'body_font_size_control',
         array(
            'label'       => __( 'Body Font Size (px)', 'landshop' ),
            'section'     => 'landshop_typography_settings',
            'settings'    => 'body_font_size_setting',
            'type'        => 'text',
            'description' => __( 'Enter a value in px units, e.g., 16px', 'landshop' ),
         )
      );
      // H1 Font Size Setting
      $wp_customize->add_setting( 'h1_font_size_setting',
         array(
            'default'           => '5.61em',
            'sanitize_callback' => 'sanitize_text_field',
         )
      );

      $wp_customize->add_control( 'h1_font_size_control',
         array(
            'label'       => __( 'H1 Font Size (em)', 'landshop' ),
            'section'     => 'landshop_typography_settings',
            'settings'    => 'h1_font_size_setting',
            'type'        => 'text',
            'description' => __( 'Enter a value in em units, e.g., 5.61em', 'landshop' ),
         )
      );

      // H2 Font Size Setting
      $wp_customize->add_setting( 'h2_font_size_setting',
         array(
            'default'           => '4.209em',
            'sanitize_callback' => 'sanitize_text_field',
         )
      );

      $wp_customize->add_control( 'h2_font_size_control',
         array(
            'label'       => __( 'H2 Font Size (em)', 'landshop' ),
            'section'     => 'landshop_typography_settings',
            'settings'    => 'h2_font_size_setting',
            'type'        => 'text',
            'description' => __( 'Enter a value in em units, e.g., 4.209em', 'landshop' ),
         )
      );

      // H3 Font Size Setting
      $wp_customize->add_setting( 'h3_font_size_setting',
         array(
            'default'           => '3.157em',
            'sanitize_callback' => 'sanitize_text_field',
         )
      );

      $wp_customize->add_control( 'h3_font_size_control',
         array(
            'label'       => __( 'H3 Font Size (em)', 'landshop' ),
            'section'     => 'landshop_typography_settings',
            'settings'    => 'h3_font_size_setting',
            'type'        => 'text',
            'description' => __( 'Enter a value in em units, e.g., 3.157em', 'landshop' ),
         )
      );

      // H4 Font Size Setting
      $wp_customize->add_setting( 'h4_font_size_setting',
         array(
            'default'           => '2.369em',
            'sanitize_callback' => 'sanitize_text_field',
         )
      );

      $wp_customize->add_control( 'h4_font_size_control',
         array(
            'label'       => __( 'H4 Font Size (em)', 'landshop' ),
            'section'     => 'landshop_typography_settings',
            'settings'    => 'h4_font_size_setting',
            'type'        => 'text',
            'description' => __( 'Enter a value in em units, e.g., 2.369em', 'landshop' ),
         )
      );

      // H5 Font Size Setting
      $wp_customize->add_setting( 'h5_font_size_setting',
         array(
            'default'           => '1.777em',
            'sanitize_callback' => 'sanitize_text_field',
         )
      );

      $wp_customize->add_control( 'h5_font_size_control',
         array(
            'label'       => __( 'H5 Font Size (em)', 'landshop' ),
            'section'     => 'landshop_typography_settings',
            'settings'    => 'h5_font_size_setting',
            'type'        => 'text',
            'description' => __( 'Enter a value in em units, e.g., 1.777em', 'landshop' ),
         )
      );

      // H6 Font Size Setting
      $wp_customize->add_setting( 'h6_font_size_setting',
         array(
            'default'           => '1.333em',
            'sanitize_callback' => 'sanitize_text_field',
         )
      );

      $wp_customize->add_control( 'h6_font_size_control',
         array(
            'label'       => __( 'H6 Font Size (em)', 'landshop' ),
            'section'     => 'landshop_typography_settings',
            'settings'    => 'h6_font_size_setting',
            'type'        => 'text',
            'description' => __( 'Enter a value in em units, e.g., 1.333em', 'landshop' ),
         )
      );

      // Additional Typography Settings
      $wp_customize->add_setting( 'paragraph_font_size_setting',
         array(
            'default'           => '1em',
            'sanitize_callback' => 'sanitize_text_field',
         )
      );

      $wp_customize->add_control( 'paragraph_font_size_control',
         array(
            'label'       => __( 'Paragraph Font Size (rem)', 'landshop' ),
            'section'     => 'landshop_typography_settings',
            'settings'    => 'paragraph_font_size_setting',
            'type'        => 'text',
            'description' => __( 'Enter a value in rem units, e.g., 1em', 'landshop' ),
         )
      );

      $wp_customize->add_setting( 'small_font_size_setting',
         array(
            'default'           => '0.75em',
            'sanitize_callback' => 'sanitize_text_field',
         )
      );

      $wp_customize->add_control( 'small_font_size_control',
         array(
            'label'       => __( 'Small Font Size (em)', 'landshop' ),
            'section'     => 'landshop_typography_settings',
            'settings'    => 'small_font_size_setting',
            'type'        => 'text',
            'description' => __( 'Enter a value in em units, e.g., 0.75em', 'landshop' ),
         )
      );

      $wp_customize->add_setting( 'sup_sub_font_size_setting',
         array(
            'default'           => '0.563em',
            'sanitize_callback' => 'sanitize_text_field',
         )
      );

      $wp_customize->add_control( 'sup_sub_font_size_control',
         array(
            'label'       => __( 'Superscript/Subscript Font Size (em)', 'landshop' ),
            'section'     => 'landshop_typography_settings',
            'settings'    => 'sup_sub_font_size_setting',
            'type'        => 'text',
            'description' => __( 'Enter a value in em units, e.g., 0.563em', 'landshop' ),
         )
      );


      

      // Section for General Settings
      $wp_customize->add_section( 'landshop_color_settings',
         array(
            'title'       => __( 'Color scheme', 'landshop' ),
            'priority'    => 10,
            'capability'  => 'edit_theme_options',
            'panel'       => 'landshop_theme_options_panel',
         )
      );
      $wp_customize->add_setting( 'accent_color',
         array(
            'default'    => '#FF6B31',
            'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport'  => 'refresh',
         ) 
      );      
      $wp_customize->add_control( new WP_Customize_Color_Control(
         $wp_customize,
         'landshop_accent_color',
         array(
            'label'      => __( 'Accent Color', 'landshop' ),
            'settings'   => 'accent_color',
            'priority'   => 0,
            'section'    => 'landshop_color_settings',
         ) 
      ) );
      $wp_customize->add_setting( 'primary_color',
         array(
            'default'    => '#131313',
            'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport'  => 'refresh',
         ) 
      );    
      $wp_customize->add_control( new WP_Customize_Color_Control(
         $wp_customize,
         'landshop_primary_color',
         array(
            'label'      => __( 'Primary Color', 'landshop' ),
            'settings'   => 'primary_color',
            'priority'   => 0,
            'section'    => 'landshop_color_settings',
         ) 
      ) );
      $wp_customize->add_setting( 'text_color',
         array(
            'default'    => '#505050',
            'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport'  => 'refresh',
         ) 
      );      
      $wp_customize->add_control( new WP_Customize_Color_Control(
         $wp_customize,
         'landshop_text_color',
         array(
            'label'      => __( 'Text Color', 'landshop' ),
            'settings'   => 'text_color',
            'priority'   => 0,
            'section'    => 'landshop_color_settings',
         ) 
      ) );
      
      $wp_customize->add_setting( 'border_color',
         array(
            'default'    => '#ededed',
            'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport'  => 'refresh',
         ) 
      );      
      $wp_customize->add_control( new WP_Customize_Color_Control(
         $wp_customize,
         'landshop_border_color',
         array(
            'label'      => __( 'Border Color', 'landshop' ),
            'settings'   => 'border_color',
            'priority'   => 0,
            'section'    => 'landshop_color_settings',
         ) 
      ) );



      // Add a new section for Navbar Settings
      $wp_customize->add_section( 'landshop_navbar_settings',
         array(
            'title'       => __( 'Navbar', 'landshop' ),
            'priority'    => 15,  // Adjust the priority as needed
            'capability'  => 'edit_theme_options',
            'panel'       => 'landshop_theme_options_panel',
         )
      );


      // Add control for Elementor Template
      $wp_customize->add_setting( 'navbar_elementor_template_setting',
         array(
            'default'           => 'default',
            'sanitize_callback' => 'sanitize_text_field',
         )
      );

      $wp_customize->add_control( 'navbar_elementor_template_control',
         array(
            'label'      => __( 'Elementor Template for Navbar', 'landshop' ),
            'settings'   => 'navbar_elementor_template_setting',
            'priority'   => 40,
            'section'    => 'landshop_navbar_settings',
            'type'       => 'select',
            'choices'    => landshop_get_post_title('elementor_library'), // Call your function to get Elementor library templates
            'description' => __( 'Select an Elementor template for your Navbar.', 'landshop' ),
         )
      );

        // Sticky Menu Setting
        $wp_customize->add_setting( 'sticky_menu_setting',
            array(
                'default'           => 'enable',
                'sanitize_callback' => 'sanitize_key', // Use sanitize_key for a select control
            )
        );

        $wp_customize->add_control( 'sticky_menu_control',
            array(
                'label'      => __( 'Sticky Menu', 'landshop' ),
                'settings'   => 'sticky_menu_setting',
                'priority'   => 50,
                'section'    => 'landshop_navbar_settings',
                'type'       => 'select',
                'choices'    => array(
                    'enable'  => __( 'Enable', 'landshop' ),
                    'disable' => __( 'Disable', 'landshop' ),
                ),
                'description' => __( 'Select to enable or disable the sticky menu.', 'landshop' ),
            )
        );

        // Sticky Offset Setting
        $wp_customize->add_setting( 'sticky_offset_setting',
            array(
                'default'           => 100, // Set default value as needed
                'sanitize_callback' => 'absint', // Use absint to ensure the value is a positive integer
            )
        );

        $wp_customize->add_control( 'sticky_offset_control',
            array(
                'label'      => __( 'Sticky Offset', 'landshop' ),
                'settings'   => 'sticky_offset_setting',
                'priority'   => 60,
                'section'    => 'landshop_navbar_settings',
                'type'       => 'number',
                'input_type' => 'text', // Use 'text' to allow entering numeric values
                'description' => __( 'Enter the sticky offset in pixels.', 'landshop' ),
            )
        );

   }


   public static function header_output() {
      ?>
      <!--Customizer CSS--> 
      <style type="text/css">
         :root {
            <?php self::generate_custom_property('--primary-color', 'primary_color'); ?>
            <?php self::generate_custom_property('--text-color', 'text_color'); ?>
            <?php self::generate_custom_property('--accent-color', 'accent_color'); ?>
            <?php self::generate_custom_property('--border-color', 'border_color'); ?>
         }
         
         <?php self::generate_css('body', 'font-size', 'body_font_size_setting'); ?>
        <?php self::generate_css('h1', 'font-size', 'h1_font_size_setting'); ?>
        <?php self::generate_css('h2', 'font-size', 'h2_font_size_setting'); ?>
        <?php self::generate_css('h3', 'font-size', 'h3_font_size_setting'); ?>
        <?php self::generate_css('h4', 'font-size', 'h4_font_size_setting'); ?>
        <?php self::generate_css('h5', 'font-size', 'h5_font_size_setting'); ?>
        <?php self::generate_css('h6', 'font-size', 'h6_font_size_setting'); ?>
        <?php self::generate_css('p', 'font-size', 'paragraph_font_size_setting'); ?>
        <?php self::generate_css('small', 'font-size', 'small_font_size_setting'); ?>
        <?php self::generate_css('sup, sub', 'font-size', 'sup_sub_font_size_setting'); ?>
      </style> 
      <!--/Customizer CSS-->
      <?php
   }
   
   public static function live_preview() {
      wp_enqueue_script( 
           'landshop-themecustomizer',
           get_template_directory_uri() . '/assets/js/customizer.js',
           array(  'jquery', 'customize-preview' ),
           '',
           true
      );
   }

    public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
      $return = '';
      $mod = get_theme_mod($mod_name);
      if ( ! empty( $mod ) ) {
         $return = sprintf('%s { %s:%s; }',
            $selector,
            $style,
            $prefix.$mod.$postfix
         );
         if ( $echo ) {
            echo $return;
         }
      }
      return $return;
    }

    public static function generate_custom_property($property, $mod_name, $prefix='', $postfix='', $echo=true) {
      $return = '';
      $mod    = get_theme_mod($mod_name);
      if (!empty($mod)) {
         $return = sprintf('%s:%s;',
            $property,
            $prefix.$mod.$postfix
         );
         if ($echo) {
            echo $return;
         }
      }
      return $return;
   }
}

add_action( 'customize_register' , array( 'Landshop_Customize' , 'register' ) );
add_action( 'wp_head' , array( 'Landshop_Customize' , 'header_output' ) );
add_action( 'customize_preview_init' , array( 'Landshop_Customize' , 'live_preview' ) );
