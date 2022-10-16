<?php

namespace Codexse;

/*
*Assets Handelar Class
*/
class Assets {

    function __construct(){

        add_action('wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );
        add_action('admin_enqueue_scripts', [ $this, 'admin_assets' ] );

    }

    public function get_styles()
    {
        return [
            'codexse-main' => [
                'src' => CODEXSE_ASSETS . '/css/main.css',
                'version' => filemtime(  CODEXSE_PATH . '/assets/css/main.css')
            ], 
            'codexse-post' => [
                'src' => CODEXSE_ASSETS . '/css/post-style.css',
                'version' => filemtime(  CODEXSE_PATH . '/assets/css/post-style.css')
            ],            
            'PopulerPosts' => [
                'src' => CODEXSE_ASSETS . '/css/PopulerPosts.css',
                'version' => filemtime(  CODEXSE_PATH . '/assets/css/PopulerPosts.css')
            ]
        ];
    }

    public function get_scripts()
    {
        return [
            'codexse-main' => [
                'src' => CODEXSE_ASSETS . '/js/main.js',
                'deps' => ['jquery'],
                'ver' => filemtime(  CODEXSE_PATH . '/assets/js/main.js'),
                'footer' => true
            ],
            'codexse-wishlist' => [
                'src' => CODEXSE_ASSETS . '/js/wishlist.js',
                'deps' => ['jquery'],
                'ver' => filemtime(  CODEXSE_PATH . '/assets/js/wishlist.js'),
                'footer' => true
            ],
            'codexse-post' => [
                'src' => CODEXSE_ASSETS . '/js/post-script.js',
                'deps' => ['jquery'],
                'ver' => filemtime(  CODEXSE_PATH . '/assets/js/post-script.js'),
                'footer' => true
            ]
        ];
    }

    public function admin_styles()
    {
        return [
            'codexse-admin' => [
                'src' => CODEXSE_ASSETS . '/css/admin.css',
                'version' => filemtime(  CODEXSE_PATH . '/assets/css/admin.css')
            ]
        ];
    }

    
    public function admin_scripts()
    {
        return [
            'codexse-admin' => [
                'src' => CODEXSE_ASSETS . '/js/admin.js',
                'deps' => ['jquery'],
                'ver' => filemtime(  CODEXSE_PATH . '/assets/js/admin.js'),
                'footer' => true
            ]
        ];
    }

    public function enqueue_assets()
    {
        $wp_scripts = $this->get_scripts();
        $wp_styles = $this->get_styles();

        foreach( $wp_styles as $handel => $script ){
            wp_register_style( $handel, $script['src'], false, $script['version']);
        }
        foreach( $wp_scripts as $handel => $script ){
            $deps = isset($script['deps']) ? $script['deps'] : false;
            wp_register_script( $handel , $script['src'] , $deps, $script['ver'], $script['footer'] );
        }
    }
    public function admin_assets()
    {        
        $admin_scripts = $this->admin_scripts();
        $admin_styles = $this->admin_styles();
        foreach( $admin_styles as $handel => $script ){
            wp_register_style( $handel, $script['src'], false, $script['version']);
        }
        foreach( $admin_scripts as $handel => $script ){
            $deps = isset($script['deps']) ? $script['deps'] : false;
            wp_register_script( $handel , $script['src'] , $deps, $script['ver'], $script['footer'] );
        }
    }

}
