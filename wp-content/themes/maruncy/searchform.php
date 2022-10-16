<?php
add_filter('get_search_form','maruncy_search_form');
if( !function_exists('maruncy_search_form') ){
    function maruncy_search_form(){            
        $data = '<form role="search" method="get" class="search_form" action="'.esc_url(home_url("/")).'">';
        $data .= '<input type="search" name="s" class="form_control" placeholder="'. __("Search here...","maruncy").'" value="'.esc_attr(get_search_query()).'">';
        $data .= '<button type="submit" class="search_submit"><i class="mr-search-icon"></i></button>';            
        $data .= '</form>';
        return $data;
   }
}