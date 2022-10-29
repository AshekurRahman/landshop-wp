<?php

namespace Codexse;

class Widgets
{
    function __construct(){
        require_once ( CODEXSE_PATH . '/includes/Widgets/PopulerPosts.php' );
        new Widgets\PopulerPosts();
    }
}
