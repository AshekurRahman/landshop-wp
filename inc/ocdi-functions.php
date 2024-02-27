<?php

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
