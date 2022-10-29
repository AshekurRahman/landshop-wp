<?php

/*
* Plugin Name: Codexse
* Plugin URI : https: //www.codexse.com/
* Description: Creates an interfaces to manage store / business locations on your website. Useful for showing location based information quickly. Includes both a widget and shortcode for ease of use.
* version    : 0.1
* Author     : Ashekur Rahman
* Author URI : https: //www.codexse.com/
* License    : GPL2
* License URI: https: //www.gnu.org/licenses/gpl-2.0.html
*/

if( ! defined('ABSPATH') ){
    exit;
}

// Require Autoload
//require_once __DIR__ . '/vendor/autoload.php';


final class Codexse {

    // Plugin VERSION define
    const VERSION = '1.0';    
    const MINIMUM_ELEMENTOR_VERSION = '2.5.0';
    const MINIMUM_PHP_VERSION = '7.0';

    /**
     * [$_instance]
     * @var null
     */
    private static $_instance = null;

    /**
     * [instance] Initializes a singleton instance
     * @return [Codexse]
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * [__construct] Class construcotr
     */
    private function __construct(){
        if ( ! function_exists('is_plugin_active') ){ 
            include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
        }

        $this->DefineConstruct();
        $this->FileInclude();
        add_action( 'init', [ $this, 'i18n' ] );
        add_action( 'plugins_loaded', [ $this, 'InitPlugin' ], 15 );
        add_action('widgets_init', [ $this, 'widgets_init' ] );
    }

    public function DefineConstruct()
    {
        define('CODEXSE_VERSION', self::VERSION);
        define('CODEXSE_FILE', __FILE__);
        define('CODEXSE_PATH', __DIR__);
        define('CODEXSE_URL', plugins_url( '', CODEXSE_FILE ));
        define('CODEXSE_ASSETS', CODEXSE_URL . '/assets');
    }

    /**
     * [FileInclude] Required Necessary file
     * @return [void]
     */
    
     public function FileInclude()
     {
        require_once ( CODEXSE_PATH . '/includes/Functions.php' );
        require_once ( CODEXSE_PATH . '/includes/Addons.php' );
        require_once ( CODEXSE_PATH . '/includes/Assets.php' );
        require_once ( CODEXSE_PATH . '/includes/Frontend.php' );
        require_once ( CODEXSE_PATH . '/includes/Metabox.php' );
        require_once ( CODEXSE_PATH . '/includes/Widgets.php' );
    }

    /**
     * [i18n] Load Text Domain
     * @return [void]
     */
    public function i18n() {
        load_plugin_textdomain( 'codexse', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }

    /**
     * [InitPlugin] Plugins Loaded Init Hook
     * @return [void]
     */
    public function InitPlugin()
    {           
        // Check if Elementor installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
            return;
        }

        // Check for required Elementor VERSION
        if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_VERSION' ] );
            return;
        }

        // Check for required PHP version
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
            return;
        }

        new Codexse\Assets();
        new Codexse\Widgets();
        new Codexse\Frontend();
        new Codexse\Metabox();     
        if (is_plugin_active( 'elementor/elementor.php' )) {
            new Codexse\Addons();
        }        
    }


    public function widgets_init()
    {  
        register_widget( 'Codexse\Widgets\PopulerPosts' );      
    }
    
    /**
     * [is_plugins_active] Check Plugin installation status
     * @param  [string]  $pl_file_path plugin location
     * @return boolean  True | False
     */
    public function is_plugins_active( $pl_file_path = NULL ){
        $installed_plugins_list = get_plugins();
        return isset( $installed_plugins_list[$pl_file_path] );
    }
    
    /**
     * [admin_notice_missing_main_plugin] Admin Notice if elementor Deactive | Not Install
     * @return [void]
     */
    public function admin_notice_missing_main_plugin() {

        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $elementor = 'elementor/elementor.php';
        if( $this->is_plugins_active( $elementor ) ) {
            if( ! current_user_can( 'activate_plugins' ) ) { return; }

            $activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $elementor . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $elementor );

            $message = '<p>' . __( '<strong>Codexse for Elementor</strong> requires "<strong>Elementor</strong>" plugin to be active. Please activate Elementor to continue.', 'codexse' ) . '</p>';
            $message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Elementor Activate Now', 'codexse' ) ) . '</p>';
        } else {
            if ( ! current_user_can( 'install_plugins' ) ) { return; }

            $install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );

            $message = '<p>' . __( '<strong>Codexse for Elementor</strong> requires "<strong>Elementor</strong>" plugin to be active. Please install the Elementor plugin to continue.', 'codexse' ) . '</p>';

            $message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Elementor Install Now', 'codexse' ) ) . '</p>';
        }
        echo '<div class="error"><p>' . $message . '</p></div>';
    }


    
    /**
     * [admin_notice_minimum_elementor_VERSION]
     * @return [void] Elementor Required VERSION check with current VERSION
     */
    public function admin_notice_minimum_elementor_version() {
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
        $message = sprintf(
            __( '"%1$s" requires "%2$s" version %3$s or greater.', 'codexse' ),
            '<strong>' . __( 'Codexse', 'codexse' ) . '</strong>',
            '<strong>' . __( 'Elementor', 'codexse' ) . '</strong>',
             self::MINIMUM_ELEMENTOR_VERSION
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }


}

/**
 * Initializes the main plugin
 *
 * @return \Codexse
 */
function codexse() {
    return Codexse::instance();
}
// Kick-off the plugin
codexse();