<?php
class Landshop_Customize {
   public static function register ( $wp_customize ) {
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
            'title'       => __( 'Typography Settings', 'landshop' ),
            'priority'    => 10,
            'capability'  => 'edit_theme_options',
            'panel'       => 'landshop_theme_options_panel',
         )
      );

      // Create setting for selected font
      $wp_customize->add_setting('selected_google_font', array(
         'default'           => 'Inter',
         'sanitize_callback' => 'sanitize_text_field',
      ));

      $wp_customize->add_control('selected_google_font', array(
         'label'    => __('Select Google Font', 'landshop'),
         'section'  => 'landshop_typography_settings',
         'type'     => 'select',
         'choices'  => landshop_get_google_fonts(),
      ));

     







      

      // Section for General Settings
      $wp_customize->add_section( 'landshop_color_settings',
         array(
            'title'       => __( 'Color Settings', 'landshop' ),
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












      
      
      $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
      $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
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
         
         <?php /* self::generate_custom_property('body', '--border-color', 'border_color'); */ ?>
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
