<?php
add_filter('get_search_form','landshop_search_form');
if( !function_exists('landshop_search_form') ){
    function landshop_search_form(){            
        $data = '<form role="search" method="get" class="search_form" action="'.esc_url(home_url("/")).'">';
        $data .= '<input type="search" name="s" class="form_control" placeholder="'.esc_attr__("Search Here...","landshop").'" value="'.esc_attr(get_search_query()).'">';
        $data .= '<button type="submit" class="search_submit">';
		$data .= '<svg class="svg-icon"><use xlink:href="'.get_theme_file_uri( 'assets/images/symble.svg' ).'#ic-search"></use></svg>';
        $data .= '</button>';         
        $data .= '</form>';
        return $data;
   }
}