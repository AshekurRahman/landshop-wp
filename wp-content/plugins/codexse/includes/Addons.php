<?php

namespace Codexse;

class Addons
{
    function __construct(){
        require_once CODEXSE_PATH . '/includes/Addons/IconManager.php';

        // Register custom category
        add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ], '0' );
        
        // Add Plugin actions
        // Init Widgets
        if ( codexse_is_elementor_version( '>=', '3.5.0' ) ) {
            add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );
        }else{
            add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
        }
        
    }  

    // Add custom category.
    public function add_category( $elements_manager ) {
        $elements_manager->add_category(
            'codexse-addons',
            [
                'title' => __( 'Codexse Addons', 'codexse' ),
                'icon' => 'fa fa-snowflake',
            ]
        );
    }

    
    public function init_widgets(){

        $widget_list = $this->get_widget_list();
        $widgets_manager = \Elementor\Plugin::instance()->widgets_manager;

        foreach($widget_list as $option_key => $option){

            if(strpos($option['title'], ' ') !== false){
                $widget_file_name = str_replace(' ', '_', $option['title']);
                $widget_class = "\Elementor\Codexse_Elementor_Widget_" . str_replace(' ', '_', $option['title']);
            }else{
                $widget_file_name = $option['title'];
                $widget_class = "\Elementor\Codexse_Elementor_Widget_" . $option['title'];
            }
            
            $widget_status = file_exists( CODEXSE_PATH .'/includes/Addons/Widgets/'.$widget_file_name.'.php' ) ? true : false ;           

            if ( $widget_status ){
                require_once CODEXSE_PATH . '/includes/Addons/Widgets/'.$widget_file_name.'.php';                
                if ( codexse_is_elementor_version( '>=', '3.5.0' ) ){
                    $widgets_manager->register( new $widget_class() );
                }else{
                    $widgets_manager->register_widget_type( new $widget_class() );
                }                
            }
        }        
    }

    private function get_widget_list(){
        $widget_list =[
            'button' =>[
                'title' => __('Button','codexse'),
            ],
            'carousel' =>[
                'title' => __('Carousel','codexse'),
            ],
            'Icon_Box' =>[
                'title' => __('Icon Box','codexse'),
            ],
        ];
        return apply_filters( 'codexse_widget_list', $widget_list );
    }


}
