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
      )));

      // Add a new panel for theme options
      $wp_customize->add_panel( 'landshop_theme_options_panel',
         array(
            'title'       => __( 'Theme Options', 'landshop' ),
            'capability'  => 'edit_theme_options',
            'priority'    => 0,
         )
      );

      // Section for Typography Settings
      $wp_customize->add_section( 'landshop_typography_settings',
         array(
            'title'       => __( 'Typography', 'landshop' ),
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
            'default'           => '3.815em',
            'sanitize_callback' => 'sanitize_text_field',
         )
      );

      $wp_customize->add_control( 'h1_font_size_control',
         array(
            'label'       => __( 'H1 Font Size (em)', 'landshop' ),
            'section'     => 'landshop_typography_settings',
            'settings'    => 'h1_font_size_setting',
            'type'        => 'text',
            'description' => __( 'Enter a value in em units, e.g., 3.815em', 'landshop' ),
         )
      );

      // H2 Font Size Setting
      $wp_customize->add_setting( 'h2_font_size_setting',
         array(
            'default'           => '3.052em',
            'sanitize_callback' => 'sanitize_text_field',
         )
      );

      $wp_customize->add_control( 'h2_font_size_control',
         array(
            'label'       => __( 'H2 Font Size (em)', 'landshop' ),
            'section'     => 'landshop_typography_settings',
            'settings'    => 'h2_font_size_setting',
            'type'        => 'text',
            'description' => __( 'Enter a value in em units, e.g., 3.052em', 'landshop' ),
         )
      );

      // H3 Font Size Setting
      $wp_customize->add_setting( 'h3_font_size_setting',
         array(
            'default'           => '2.441em',
            'sanitize_callback' => 'sanitize_text_field',
         )
      );

      $wp_customize->add_control( 'h3_font_size_control',
         array(
            'label'       => __( 'H3 Font Size (em)', 'landshop' ),
            'section'     => 'landshop_typography_settings',
            'settings'    => 'h3_font_size_setting',
            'type'        => 'text',
            'description' => __( 'Enter a value in em units, e.g., 2.441em', 'landshop' ),
         )
      );

      // H4 Font Size Setting
      $wp_customize->add_setting( 'h4_font_size_setting',
         array(
            'default'           => '1.953em',
            'sanitize_callback' => 'sanitize_text_field',
         )
      );

      $wp_customize->add_control( 'h4_font_size_control',
         array(
            'label'       => __( 'H4 Font Size (em)', 'landshop' ),
            'section'     => 'landshop_typography_settings',
            'settings'    => 'h4_font_size_setting',
            'type'        => 'text',
            'description' => __( 'Enter a value in em units, e.g., 1.953em', 'landshop' ),
         )
      );

      // H5 Font Size Setting
      $wp_customize->add_setting( 'h5_font_size_setting',
         array(
            'default'           => '1.563em',
            'sanitize_callback' => 'sanitize_text_field',
         )
      );

      $wp_customize->add_control( 'h5_font_size_control',
         array(
            'label'       => __( 'H5 Font Size (em)', 'landshop' ),
            'section'     => 'landshop_typography_settings',
            'settings'    => 'h5_font_size_setting',
            'type'        => 'text',
            'description' => __( 'Enter a value in em units, e.g., 1.563em', 'landshop' ),
         )
      );

      // H6 Font Size Setting
      $wp_customize->add_setting( 'h6_font_size_setting',
         array(
            'default'           => '1.25em',
            'sanitize_callback' => 'sanitize_text_field',
         )
      );

      $wp_customize->add_control( 'h6_font_size_control',
         array(
            'label'       => __( 'H6 Font Size (em)', 'landshop' ),
            'section'     => 'landshop_typography_settings',
            'settings'    => 'h6_font_size_setting',
            'type'        => 'text',
            'description' => __( 'Enter a value in em units, e.g., 1.25em', 'landshop' ),
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
            'section'    => 'landshop_color_settings',
         ) 
      ) );
      $wp_customize->add_setting( 'secondary_color',
         array(
            'default'    => '#fff5f2',
            'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport'  => 'refresh',
         ) 
      );    
      $wp_customize->add_control( new WP_Customize_Color_Control(
         $wp_customize,
         'landshop_secondary_color',
         array(
            'label'      => __( 'Secondary Color', 'landshop' ),
            'settings'   => 'secondary_color',
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
            'section'    => 'landshop_color_settings',
         ) 
      ) );



      // Add a new section for Navbar Settings
      $wp_customize->add_section( 'landshop_navbar_settings',
         array(
            'title'       => __( 'Navbar', 'landshop' ),
            'capability'  => 'edit_theme_options',
            'panel'       => 'landshop_theme_options_panel',
         )
      );


      if ( is_plugin_active( 'elementor/elementor.php' ) ) {
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
               'section'    => 'landshop_navbar_settings',
               'type'       => 'select',
               'choices'    => landshop_get_post_title('elementor_library'), // Call this function to get Elementor library templates
               'description' => __( 'Select an Elementor template for your Navbar.', 'landshop' ),
            )
         );
      }

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
                'section'    => 'landshop_navbar_settings',
                'type'       => 'number',
                'input_type' => 'text', // Use 'text' to allow entering numeric values
                'description' => __( 'Enter the sticky offset in pixels.', 'landshop' ),
            )
        );

        // Navbar Height Setting
        $wp_customize->add_setting( 'navbar_height_setting',
            array(
                'default'           => 100, // Set default value as needed
                'sanitize_callback' => 'absint', // Use absint to ensure the value is a positive integer
            )
        );

        $wp_customize->add_control( 'navbar_height_control',
            array(
                'label'      => __( 'Navbar Height', 'landshop' ),
                'settings'   => 'navbar_height_setting',
                'section'    => 'landshop_navbar_settings',
                'type'       => 'number',
                'input_type' => 'text', // Use 'text' to allow entering numeric values
                'description' => __( 'Enter the navbar height in pixels.', 'landshop' ),
            )
        );

         // Navbar Background Color Setting
         $wp_customize->add_setting( 'navbar_bg_color_setting',
            array(
               'default'           => '#ffffff', // Set default value as needed
               'sanitize_callback' => 'sanitize_text_field',
            )
         );

         $wp_customize->add_control( 'navbar_background_color_control',
         array(
            'label'      => __( 'Navbar Background Color', 'landshop' ),
            'type'       => 'text',
            'settings'   => 'navbar_bg_color_setting',
            'section'    => 'landshop_navbar_settings',
            'description' => __( 'Enter a color code in HEX or RGB format.', 'landshop' ),
         )
         );

         // Sticky Background Color Setting
         $wp_customize->add_setting( 'sticky_bg_color_setting',
         array(
            'default'           => '#f8f8f8', // Set default value as needed
            'sanitize_callback' => 'sanitize_text_field',
         )
         );

         $wp_customize->add_control( 'sticky_background_color_control',
            array(
               'label'      => __( 'Sticky Background Color', 'landshop' ),
               'type'       => 'text',
               'settings'   => 'sticky_bg_color_setting',
               'section'    => 'landshop_navbar_settings',
               'description' => __( 'Enter a color code in HEX or RGB format.', 'landshop' ),
            )
         );

         // Add a new section for Navbar Settings
         $wp_customize->add_section( 'landshop_header_settings',
            array(
               'title'       => __( 'Header', 'landshop' ),
               'capability'  => 'edit_theme_options',
               'panel'       => 'landshop_theme_options_panel',
            )
         );

      if ( is_plugin_active( 'elementor/elementor.php' ) ) {
         // Add control for Elementor Template
         $wp_customize->add_setting( 'header_elementor_template_setting',
            array(
               'default'           => 'default',
               'sanitize_callback' => 'sanitize_text_field',
            )
         );

         $wp_customize->add_control( 'header_elementor_template_control',
            array(
               'label'      => __( 'Elementor Template for Header', 'landshop' ),
               'settings'   => 'header_elementor_template_setting',
               'section'    => 'landshop_header_settings',
               'type'       => 'select',
               'choices'    => landshop_get_post_title('elementor_library'), // Call this function to get Elementor library templates
               'description' => __( 'Select an Elementor template for your Header.', 'landshop' ),
            )
         );
      }
      
      // Add Background Image control
      $wp_customize->add_setting('header_bg_image', array(
         'default'           => '',
         'sanitize_callback' => 'esc_url_raw',
      ));

      $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'header_bg_image', array(
         'label'    => __('Header Background Image', 'landshop'),
         'section'  => 'landshop_header_settings',
         'settings' => 'header_bg_image',
      )));

      // Navbar Background Color Setting
      $wp_customize->add_setting('header_bg_color', array(
         'default'           => '#fff5f2', // Set default value as needed
         'sanitize_callback' => 'sanitize_hex_color',
      ));

      $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_bg_color_control', array(
         'label'      => __('Header Background Color', 'landshop'),
         'section'    => 'landshop_header_settings',
         'settings'   => 'header_bg_color',
         'description' => __('Choose a color for the header background.', 'landshop'),
      )));


      $wp_customize->add_section('landshop_footer_settings', array(
         'title'       => __('Footer', 'landshop'),
         'capability'  => 'edit_theme_options',
         'panel'       => 'landshop_theme_options_panel',
     ));    

      if (is_plugin_active('elementor/elementor.php')) {
         // Add control for Elementor Template
         $wp_customize->add_setting('footer_elementor_template_setting', array(
            'default'           => 'default',
            'sanitize_callback' => 'sanitize_text_field',
         ));
         $wp_customize->add_control('footer_elementor_template_control', array(
            'label'         => __('Elementor Template for Footer', 'landshop'),
            'settings'      => 'footer_elementor_template_setting',
            'section'       => 'landshop_footer_settings',
            'type'          => 'select',
            'choices'       => landshop_get_post_title('elementor_library'), // Ensure this function is defined to get Elementor library templates
            'description'   => __('Select an Elementor template for your footer.', 'landshop'),
         ));
      }
  
      // Add a text control for copyrights text in the Footer section
      $wp_customize->add_setting( 'landshop_copyrights_text',
         array(
            'default'           => __('&copy;2024 All rights reserved. Powered by <b>Themectg</b>','landshop'),
            'sanitize_callback' => 'sanitize_text_field',
         )
      );

      $wp_customize->add_control( 'landshop_copyrights_text',
         array(
            'label'    => __( 'Copyrights Text', 'landshop' ),
            'section'  => 'landshop_footer_settings',
            'type'     => 'textarea',
         )
      );

      // Add controls for 404 page settings
      $wp_customize->add_section('landshop_404_settings', array(
         'title'      => __('404 Page', 'landshop'),
         'capability' => 'edit_theme_options',
         'panel'      => 'landshop_theme_options_panel',
      ));

      if ( is_plugin_active( 'elementor/elementor.php' ) ) {
         // Add control for Elementor Template
         $wp_customize->add_setting( '404_elementor_template_setting',
            array(
               'default'           => 'default',
               'sanitize_callback' => 'sanitize_text_field',
            )
         );

         $wp_customize->add_control( '404_elementor_template_control',
            array(
               'label'      => __( 'Elementor Template for 404', 'landshop' ),
               'settings'   => '404_elementor_template_setting',
               'section'    => 'landshop_404_settings',
               'type'       => 'select',
               'choices'    => landshop_get_post_title('elementor_library'), // Call this function to get Elementor library templates
               'description' => __( 'Select an Elementor template for your 404 page.', 'landshop' ),
            )
         );
      }

      // Control for 404 Image
      $wp_customize->add_setting('landshop_404_image', array(
         'default'           => get_theme_file_uri('assets/images/404.png'),
         'sanitize_callback' => 'esc_url_raw',
      ));

      $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'landshop_404_image', array(
         'label'    => __('404 Image', 'landshop'),
         'section'  => 'landshop_404_settings',
         'settings' => 'landshop_404_image',
      )));

      // Control for Page Title
      $wp_customize->add_setting('landshop_404_title', array(
         'default'           => __('Oops... Page Not Found!', 'landshop'),
         'sanitize_callback' => 'sanitize_text_field',
      ));

      $wp_customize->add_control('landshop_404_title', array(
         'label'    => __('Page Title', 'landshop'),
         'section'  => 'landshop_404_settings',
         'type'     => 'text',
      ));

      // Control for Page Description
      $wp_customize->add_setting('landshop_404_description', array(
         'default'           => __('Please return to the site\'s homepage. It looks like nothing was found at this location. Get in touch to discuss your employee needs today. Please give us a call, drop us an email.', 'landshop'),
         'sanitize_callback' => 'sanitize_textarea_field',
      ));

      $wp_customize->add_control('landshop_404_description', array(
         'label'    => __('Page Description', 'landshop'),
         'section'  => 'landshop_404_settings',
         'type'     => 'textarea',
      ));

      // Control for Page Title
      $wp_customize->add_setting('landshop_404_button_text', array(
         'default'           => __('Back to Home', 'landshop'),
         'sanitize_callback' => 'sanitize_text_field',
      ));

      $wp_customize->add_control('landshop_404_button_text', array(
         'label'    => __('Button Text', 'landshop'),
         'section'  => 'landshop_404_settings',
         'type'     => 'text',
      ));

      // Add controls for preloader settings
      $wp_customize->add_section('landshop_preloader_settings', array(
         'title'      => __('Preloader', 'landshop'),
         'capability' => 'edit_theme_options',
         'panel'      => 'landshop_theme_options_panel',
      ));

      // Control for Preloader Status (Enable/Disable)
      $wp_customize->add_setting('landshop_preloader_status', array(
         'default'           => 'enable', // Set default to enable
         'sanitize_callback' => 'sanitize_key',
      ));

      $wp_customize->add_control('landshop_preloader_status', array(
         'label'    => __('Preloader Status', 'landshop'),
         'section'  => 'landshop_preloader_settings',
         'type'     => 'select',
         'choices'  => array(
            'enable'  => __('Enable', 'landshop'),
            'disable' => __('Disable', 'landshop'),
         ),
      ));

      // Control for Preloader Image
      $wp_customize->add_setting('landshop_preloader_image', array(
         'default'           => get_theme_file_uri('assets/images/preloader.gif'),
         'sanitize_callback' => 'esc_url_raw',
      ));

      $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'landshop_preloader_image', array(
         'label'    => __('Preloader Image', 'landshop'),
         'section'  => 'landshop_preloader_settings',
         'settings' => 'landshop_preloader_image',
      )));

      // Control for Preloader Width
      $wp_customize->add_setting('preloader_width', array(
         'default'           => 20, // Set default width in percentage
         'sanitize_callback' => 'sanitize_text_field',
      ));

      $wp_customize->add_control('preloader_width', array(
         'label'       => __('Preloader Width', 'landshop'),
         'description' => __('Set the width of the preloader in percentage.', 'landshop'),
         'section'     => 'landshop_preloader_settings',
         'type'        => 'range',
         'input_attrs' => array(
            'min'  => 1,
            'max'  => 100,
            'step' => 1,
         ),
      ));
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

   public static function generate_css( $selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true ) {
      $return = '';
      $mod = get_theme_mod( $mod_name );
      if ( isset( $mod ) && '' !== $mod ) {
          $return = sprintf( '%s { %s:%s; }',
              $selector,
              $style,
              $prefix . $mod . $postfix
          );
          if ( $echo ) {
              echo $return;
          }
      }
      return $return;
  } 
  
    public static function generate_custom_property($property, $mod_name, $postfix='', $echo=true) {
      $return = '';
      $mod    = get_theme_mod($mod_name);
      if (!empty($mod)) {
          $return = sprintf('%s:%s%s;',
              $property,
              $mod,
              $postfix
          );
          if ($echo) {
              echo $return;
          }
      }
      return $return;
  }

   public static function header_output() {
      ?>
      <!--Customizer CSS--> 
      <style type="text/css">
         :root {
            <?php self::generate_custom_property('--navbar-height', 'navbar_height_setting', 'px'); ?>
            <?php self::generate_custom_property('--primary-color', 'primary_color'); ?>
            <?php self::generate_custom_property('--secondary-color', 'secondary_color'); ?>
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
         <?php self::generate_css('small', 'font-size', 'small_font_size_setting'); ?>
         <?php self::generate_css('sup, sub', 'font-size', 'sup_sub_font_size_setting'); ?>
         <?php self::generate_css('body .navbar__area', 'background-color', 'navbar_bg_color_setting'); ?>
         <?php self::generate_css('body.sticky .navbar__area', 'background-color', 'sticky_bg_color_setting'); ?>
         <?php self::generate_css('.header__area', 'background-image', 'header_bg_image', 'url("', '")' ); ?>
         <?php self::generate_css('.header__area', 'background-color', 'header_bg_color' ); ?>
         <?php self::generate_css('.preloader .loader__image img', 'width', 'preloader_width', '', '%' ); ?>
      </style> 
      <!--/Customizer CSS-->
      <?php
   }

  
}

add_action( 'customize_register' , array( 'Landshop_Customize' , 'register' ) );
add_action( 'wp_head' , array( 'Landshop_Customize' , 'header_output' ) );
add_action( 'customize_preview_init' , array( 'Landshop_Customize' , 'live_preview' ) );
