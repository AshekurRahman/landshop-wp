<?php

namespace Codexse;

class Metabox
{
    function __construct(){
        require_once ( CODEXSE_PATH . '/includes/Metabox/PageMeta.php' );
        require_once ( CODEXSE_PATH . '/includes/Metabox/PostMeta.php' );
        
        if ('page' == codexse_get_current_post_type()) {            
            new Metabox\Pagemeta();
        }
        if ('post' == codexse_get_current_post_type()) {            
            new Metabox\Postmeta();
        }
    }
}
