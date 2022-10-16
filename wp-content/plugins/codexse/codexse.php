<?php

/*
* Plugin Name: Codexse
* Plugin URI : https: //www.codexse.com/
* Description: Creates an interfaces to manage store / business locations on your website. Useful for showing location based information quickly. Includes both a widget and shortcode for ease of use.
* Version    : 0.1
* Author     : Ashekur Rahman
* Author URI : https: //www.codexse.com/
* License    : GPL2
* License URI: https: //www.gnu.org/licenses/gpl-2.0.html
*/

if( ! defined('ABSPATH') ){
    exit;
}

// Require Autoload
require_once __DIR__ . '/vendor/autoload.php';


final class Codexse {

    // Plugin version define
    const version = '1.0';

    // Class constructor
    private function __construct(){
        $this->define_construct();


        add_action('plugins_loaded', [$this, 'init_plugin'] );
        add_action('widgets_init', [ $this, 'widgets_init' ] );
    }

    // Class Initialize
    static public function init()
    {
       static $instanse = false;       
       if( ! $instanse ){
        $instanse = new self();
       }
       return $instanse;
    }

    public function define_construct()
    {
        define('CODEXSE_VERSION', self::version);
        define('CODEXSE_FILE', __FILE__);
        define('CODEXSE_PATH', __DIR__);
        define('CODEXSE_URL', plugins_url( '', CODEXSE_FILE ));
        define('CODEXSE_ASSETS', CODEXSE_URL . '/assets');
    }

    public function init_plugin()
    {   
        load_plugin_textdomain( 'codexse', false , CODEXSE_PATH . '/languages/' );

        new Codexse\Assets();
        new Codexse\Widgets();
        new Codexse\Frontend();
        new Codexse\Metabox();
    }


    public function widgets_init()
    {  
        register_widget( 'Codexse\Widgets\PopulerPosts' );      
    }


}

// Initialize the main plugin
function codexse(){
    return Codexse::init();
}

// Kick-off the plugin
codexse();