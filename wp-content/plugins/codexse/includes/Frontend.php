<?php

namespace Codexse;

class Frontend
{
    function __construct(){
        if( class_exists('WooCommerce') ){
            new Frontend\Wishlist\Wishlist();
        }

    }
}
