<?php

namespace Codexse;

class Frontend
{
    function __construct(){
        require_once ( CODEXSE_PATH . '/includes/Frontend/Wishlist/Wishlist.php' );
        if( class_exists('WooCommerce') ){
            new Frontend\Wishlist\Wishlist();
        }

    }
}
