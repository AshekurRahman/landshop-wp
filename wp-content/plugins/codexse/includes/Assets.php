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
            'codexse-post-gallery' => [
                'src' => CODEXSE_ASSETS . '/css/post-gallery.css',
                'version' => filemtime(  CODEXSE_PATH . '/assets/css/post-gallery.css')
            ],  
            'codexse-post-video' => [
                'src' => CODEXSE_ASSETS . '/css/post-video.css',
                'version' => filemtime(  CODEXSE_PATH . '/assets/css/post-video.css')
            ],            
            'PopulerPosts' => [
                'src' => CODEXSE_ASSETS . '/css/PopulerPosts.css',
                'version' => filemtime(  CODEXSE_PATH . '/assets/css/PopulerPosts.css')
            ],            
            'swiper-slider' => [
                'src' => CODEXSE_ASSETS . '/css/swiper-bundle-min.css',
                'version' => filemtime(  CODEXSE_PATH . '/assets/css/swiper-bundle-min.css')
            ],           
            'codexse-button' => [
                'src' => CODEXSE_ASSETS . '/css/addons/button.css',
                'version' => filemtime(  CODEXSE_PATH . '/assets/css/addons/button.css')
            ],         
            'codexse-carousel' => [
                'src' => CODEXSE_ASSETS . '/css/addons/carousel.css',
                'version' => filemtime(  CODEXSE_PATH . '/assets/css/addons/carousel.css')
            ],       
            'codexse-icon-box' => [
                'src' => CODEXSE_ASSETS . '/css/addons/Icon_Box.css',
                'version' => filemtime(  CODEXSE_PATH . '/assets/css/addons/Icon_Box.css')
            ],
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
            'codexse-post-gallery' => [
                'src' => CODEXSE_ASSETS . '/js/post-gallery.js',
                'deps' => ['jquery'],
                'ver' => filemtime(  CODEXSE_PATH . '/assets/js/post-gallery.js'),
                'footer' => true
            ],
            'codexse-post-video' => [
                'src' => CODEXSE_ASSETS . '/js/post-video.js',
                'deps' => ['jquery'],
                'ver' => filemtime(  CODEXSE_PATH . '/assets/js/post-video.js'),
                'footer' => true
            ],
            'swiper-slider' => [
                'src' => CODEXSE_ASSETS . '/js/swiper-bundle-min.js',
                'deps' => ['jquery'],
                'ver' => filemtime(  CODEXSE_PATH . '/assets/js/swiper-bundle-min.js'),
                'footer' => true
            ],
            'codexse-carousel' => [
                'src' => CODEXSE_ASSETS . '/js/addons/carousel.js',
                'deps' => ['jquery'],
                'ver' => filemtime(  CODEXSE_PATH . '/assets/js/addons/carousel.js'),
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
