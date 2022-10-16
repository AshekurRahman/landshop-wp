<?php

namespace Codexse;

class Metabox
{
    function __construct(){
        if ('page' == codexse_get_current_post_type()) {            
            new Metabox\Pagemeta();
        }
        if ('post' == codexse_get_current_post_type()) {            
            new Metabox\Postmeta();
        }
    }
}
