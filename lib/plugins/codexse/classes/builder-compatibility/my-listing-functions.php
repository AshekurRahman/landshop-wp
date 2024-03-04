<?php

if(!function_exists( 'hfe_render_header' )){
    function hfe_render_header(){
        global $cx__template_ids;
        if($cx__template_ids[0] == null){
            return;
        }

        do_action('codexseaddons/template/before_header');
        echo '<div class="ekit-template-content-markup ekit-template-content-header">';
            echo Theme_Builder::render_builder_data($cx__template_ids[0]);
        echo '</div>';
        do_action('codexseaddons/template/after_header');
    }
}

if(!function_exists( 'get_hfe_header_id' )){
    function get_hfe_header_id(){
        global $cx__template_ids;
        return $cx__template_ids[0];
    }
}

if(!function_exists( 'hfe_render_footer' )){
    function hfe_render_footer(){
        global $cx__template_ids;
        if($cx__template_ids[1] == null){
            return;
        }

        do_action('codexseaddons/template/before_header');
        echo '<div class="ekit-template-content-markup ekit-template-content-header">';
            echo Theme_Builder::render_builder_data($cx__template_ids[1]);
        echo '</div>';
        do_action('codexseaddons/template/after_header');
    }
}

if(!function_exists( 'get_hfe_footer_id' )){
    function get_hfe_footer_id(){
        global $cx__template_ids;
        return $cx__template_ids[1];
    }
}
