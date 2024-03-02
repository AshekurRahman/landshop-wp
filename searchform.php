<?php
add_filter('get_search_form','landshop_search_form');
if( !function_exists('landshop_search_form') ){
    function landshop_search_form(){            
        $data = '<form role="search" method="get" class="search__form" action="'.esc_url(home_url("/")).'">';
        $data .= '<input type="search" name="s" class="input__control" placeholder="'.esc_attr__("Search Here...","landshop").'" value="'.esc_attr(get_search_query()).'">';
        $data .= '<button type="submit" class="search_submit">';
		$data .= '<i class="fa-sharp fa-light fa-telescope icon"></i>';
        $data .= '</button>';         
        $data .= '</form>';
        return $data;
   }
}