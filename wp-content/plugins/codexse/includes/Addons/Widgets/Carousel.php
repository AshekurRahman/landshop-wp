<?php                                                                                                                                                               
namespace Elementor;                                                                                                                                                
                                                                                                                                                                    
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly                                                                                                    
                                                                                                                                                                    
class Codexse_Elementor_Widget_Carousel extends Widget_Base {                                                                                                       
                                                                                                                                                                    
    public function get_name() {                                                                                                                                    
        return 'codexse-carousel-addons';                                                                                                                           
    }                                                                                                                                                               
                                                                                                                                                                    
    public function get_title() {                                                                                                                                   
        return __( 'Carousel', 'codexse-addons' );                                                                                                                  
    }                                                                                                                                                               
                                                                                                                                                                    
    public function get_icon() {                                                                                                                                    
        return 'codexse-icon eicon-slider-push';                                                                                                                    
    }                                                                                                                                                               
                                                                                                                                                                    
    public function get_categories() {                                                                                                                              
        return [ 'codexse-addons' ];                                                                                                                                
    }                                                                                                                                                               
                                                                                                                                                                    
    public function get_style_depends() {                                                                                                                           
        return [                                                                                                                                                    
            'swiper-slider',                                                                                                                                        
            'codexse-carousel'                                                                                                                                      
        ];                                                                                                                                                          
    }                                                                                                                                                               
                                                                                                                                                                    
    public function get_script_depends() {                                                                                                                          
        return [                                                                                                                                                    
            'swiper-slider',                                                                                                                                        
            'codexse-carousel',                                                                                                                                     
        ];                                                                                                                                                          
    }                                                                                                                                                               
                                                                                                                                                                    
    protected function register_controls() {                                                                                                                        
                                                                                                                                                                    
        $this->start_controls_section(                                                                                                                              
            'carosul_content',                                                                                                                                      
            [                                                                                                                                                       
                'label' => __( 'Carousel', 'codexse-addons' ),                                                                                                      
            ]                                                                                                                                                       
        );                                                                                                                                                           
                                                                                                                                                                    
            $repeater = new Repeater();           
            
            
            $repeater->start_controls_tabs('carousel_repeater_items');
            $repeater->start_controls_tab( 'carousel_repeater_item_content',
                [
                    'label' => __( 'Conent', 'codexse' ),
                ]
            );                                                                                                                      
            $repeater->add_control(                                                                                                                                 
                'carosul_image_title',                                                                                                                              
                [                                                                                                                                                   
                    'label'   => __( 'Title', 'codexse-addons' ),                                                                                                   
                    'type'    => Controls_Manager::TEXT,                                                                                                            
                    'placeholder' => __('Image Grid Title.','codexse-addons'),                                                                                      
                ]                                                                                                                                                   
            );                                                                                                                                                      
                                                                                                                                                                    
            $repeater->add_control(                                                                                                                                 
                'carosul_image',                                                                                                                                    
                [                                                                                                                                                   
                    'label' => __( 'Image', 'codexse-addons' ),                                                                                                     
                    'type' => Controls_Manager::MEDIA,                                                                                                              
                ]                                                                                                                                                   
            );                                                                                                                                                      
                                                                                                                                                                    
            $repeater->add_group_control(                                                                                                                           
                Group_Control_Image_Size::get_type(),                                                                                                               
                [                                                                                                                                                   
                    'name' => 'carosul_imagesize',                                                                                                                  
                    'default' => 'large',                                                                                                                           
                    'separator' => 'none',                                                                                                                          
                ]                                                                                                                                                   
            );
            $repeater->end_controls_tab();
            $repeater->start_controls_tab( 'carousel_repeater_item_style',
                [
                    'label' => __( 'Style', 'codexse' ),
                ]
            );        
            $repeater->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'repeater_items_backgground',
                    'label' => __( 'Background', 'codexse' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .slide-item',
                ]
            );
            $repeater->add_responsive_control(
                'repeater_items_padding',
                [
                    'label' => __( 'Padding', 'codexse' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .slide-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );
            $repeater->end_controls_tab();
            $repeater->end_controls_tabs();                                                                                                                                                                                        
                                                                                                                                                                    
            $this->add_control(                                                                                                                                     
                'carosul_image_list',                                                                                                                               
                [                                                                                                                                                   
                    'type'    => Controls_Manager::REPEATER,                                                                                                        
                    'fields'  => $repeater->get_controls(),                                                                                                         
                    'default' => [                                                                                                                                  
                                                                                                                                                                    
                        [                                                                                                                                           
                            'carosul_image_title'        => __('Image Grid Title','codexse-addons'),                                                                
                        ],                                                                                                                                          
                                                                                                                                                                    
                    ],                                                                                                                                              
                    'title_field' => '{{{ carosul_image_title }}}',                                                                                                 
                ]                                                                                                                                                   
            );                                                                                                                                                      
                                                                                                                                                                    
            $this->add_control(                                                                                                                                     
                'slider_on',                                                                                                                                        
                [                                                                                                                                                   
                    'label'         => __( 'Slider', 'codexse-addons' ),                                                                                            
                    'type'          => Controls_Manager::SWITCHER,                                                                                                  
                    'label_on'      => __( 'On', 'codexse-addons' ),                                                                                                
                    'label_off'     => __( 'Off', 'codexse-addons' ),                                                                                               
                    'return_value'  => 'yes',                                                                                                                       
                    'default'       => 'yes',                                                                                                                       
                ]                                                                                                                                                   
            );        
            
            
        
            $this->add_control(
                'item_column',
                [
                    'label' => __( 'Column', 'codexse' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        '1grid' => [
                            'title' => __( 'One Column', 'codexse' ),
                            'icon' => 'icon-grid-1',
                        ],
                        '2grid' => [
                            'title' => __( 'Two Columns', 'codexse' ),
                            'icon' => 'icon-grid-2',
                        ],
                        '3grid' => [
                            'title' => __( 'Three Columns', 'codexse' ),
                            'icon' => 'icon-grid-3',
                        ],
                        '4grid' => [
                            'title' => __( 'Four Columns', 'codexse' ),
                            'icon' => 'icon-grid-4',
                        ],
                    ],
                    'default' => '3grid',
                    'toggle' => true,
                    'condition' => [
                        'slider_on!' => 'yes',
                    ]
                ]
            );
        
            $this->add_control(
                'grid_space',
                [
                    'label' => esc_html__( 'Grid Space', 'codexse' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'g-4',
                    'options' => [
                        'g-1'  => __( 'One', 'codexse' ),
                        'g-2'  => __( 'Two', 'codexse' ),
                        'g-3'  => __( 'Three', 'codexse' ),
                        'g-4'  => __( 'Four', 'codexse' ),
                        'g-5'  => __( 'Five', 'codexse' ),
                    ],
                    'condition' => [
                        'slider_on!' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'masonry',
                [
                    'label'         => __( 'Masonry', 'codexse' ),
                    'type'          => Controls_Manager::SWITCHER,
                    'label_on'      => __( 'On', 'codexse' ),
                    'label_off'     => __( 'Off', 'codexse' ),
                    'return_value'  => 'yes',
                    'default'       => 'no',
                    'condition' => [
                        'slider_on!' => 'yes',
                    ]
                ]
            );

                                                                                                                                                                    
        $this->end_controls_section();                                                                                                                              
                                                                                                                                                                    
        $this->start_controls_section(                                                                                                                              
            'slider_option',                                                                                                                                        
            [                                                                                                                                                       
                'label' => esc_html__( 'Slider Option', 'codexse' ),                                                                                                
                'condition'=>[                                                                                                                                      
                    'slider_on'=>'yes',                                                                                                                             
                ]                                                                                                                                                   
            ]                                                                                                                                                       
        );                                                                                                                                                          
            $this->add_control(                                                                                                                                     
                'sl_navigation',                                                                                                                                    
                [                                                                                                                                                   
                    'label' => esc_html__( 'Arrow', 'codexse' ),                                                                                                    
                    'type' => Controls_Manager::SWITCHER,                                                                                                           
                    'return_value' => 'yes',                                                                                                                        
                    'default' => 'yes',                                                                                                                             
                ]                                                                                                                                                   
            );                                                                                                                                                      
                                                                                                                                                                    
            $this->add_control(                                                                                                                                     
                'slider_custom_arrow',                                                                                                                              
                [                                                                                                                                                   
                    'label' => esc_html__( 'Custom Arrow', 'codexse' ),                                                                                             
                    'type' => Controls_Manager::SWITCHER,                                                                                                           
                    'return_value' => 'yes',                                                                                                                        
                    'default' => 'yes',                                                                                                                             
                    'condition'=>[                                                                                                                                  
                        'sl_navigation'=>'yes',                                                                                                                     
                    ]                                                                                                                                               
                ]                                                                                                                                                   
            );                                                                                                                                                      
                                                                                                                                                                    
            $this->add_control(                                                                                                                                     
                 'slider_target_id',                                                                                                                                
                 [                                                                                                                                                  
                     'label'     => __( 'Arrows ID', 'codexse' ),                                                                                                   
                     'type'      => Controls_Manager::TEXT,                                                                                                         
                     'title' => __( 'Take arrow id from "Custom Navigation" addons and paste here!', 'codexse' ),                                                   
                     'condition' => [                                                                                                                               
                        'slider_custom_arrow' => 'yes',                                                                                                            
                        'sl_navigation'=>'yes',                                                                                                                     
                     ]                                                                                                                                              
                 ]                                                                                                                                                  
             );                                                                                                                                                     
                                                                                                                                                                    
            $this->add_control(                                                                                                                                     
                'sl_nav_prev_icon',                                                                                                                                 
                [                                                                                                                                                   
                    'label' => __( 'Previus Icon', 'codexse' ),                                                                                                     
                    'type' => Controls_Manager::ICON,                                                                                                               
                    'default' => 'fa fa-angle-left',                                                                                                                
                    'condition'=>[                                                                                                                                  
                        'sl_navigation'=>'yes',                                                                                                                     
                        'slider_custom_arrow!'=>'yes',                                                                                                              
                    ]                                                                                                                                               
                ]                                                                                                                                                   
            );                                                                                                                                                      
                                                                                                                                                                    
            $this->add_control(                                                                                                                                     
                'sl_nav_next_icon',                                                                                                                                 
                [                                                                                                                                                   
                    'label' => __( 'Next Arrow', 'codexse' ),                                                                                                       
                    'type' => Controls_Manager::ICON,                                                                                                               
                    'default' => 'fa fa-angle-right',                                                                                                               
                    'condition'=>[                                                                                                                                  
                        'sl_navigation'=>'yes',                                                                                                                     
                        'slider_custom_arrow!'=>'yes',                                                                                                              
                    ]                                                                                                                                               
                ]                                                                                                                                                   
            );                                                                                                                                                      
                                                                                                                                                                    
            $this->add_control(                                                                                                                                     
                'slpaginate',                                                                                                                                       
                [                                                                                                                                                   
                    'label' => esc_html__( 'Paginate', 'codexse' ),                                                                                                 
                    'type' => Controls_Manager::SWITCHER,                                                                                                           
                    'return_value' => 'yes',                                                                                                                        
                    'default' => 'no',                                                                                                                              
                ]                                                                                                                                                   
            );                                                                                                                                                      
                                                                                                                                                                    
            $this->add_control(                                                                                                                                     
                'sleffect',                                                                                                                                         
                [                                                                                                                                                   
                    'label' => esc_html__( 'Effect', 'codexse' ),                                                                                                   
                    'type' => Controls_Manager::SELECT,                                                                                                             
                    'default' => 'slide',                                                                                                                           
                    'options' => [                                                                                                                                  
                        'slide'  => __( 'Slide', 'codexse' ),                                                                                                       
                        'fade'  => __( 'Fade', 'codexse' ),                                                                                                         
                        'cube'  => __( 'Cube', 'codexse' ),                                                                                                         
                        'coverflow'  => __( 'Coverflow', 'codexse' ),                                                                                               
                        'flip'  => __( 'Flip', 'codexse' ),                                                                                                         
                    ],                                                                                                                                              
                ]                                                                                                                                                   
            );                                                                                                                                                      
                                                                                                                                                                    
            $this->add_control(                                                                                                                                     
                'slloop',                                                                                                                                           
                [                                                                                                                                                   
                    'label' => esc_html__( 'Loop', 'codexse' ),                                                                                                     
                    'type' => Controls_Manager::SWITCHER,                                                                                                           
                    'return_value' => 'yes',                                                                                                                        
                    'default' => 'yes',                                                                                                                             
                ]                                                                                                                                                   
            );                                                                                                                                                      
            $this->add_control(                                                                                                                                     
                'slautolay',                                                                                                                                        
                [                                                                                                                                                   
                    'label' => esc_html__( 'Autoplay', 'codexse' ),                                                                                                 
                    'type' => Controls_Manager::SWITCHER,                                                                                                           
                    'return_value' => 'yes',                                                                                                                        
                    'default' => 'yes',                                                                                                                             
                ]                                                                                                                                                   
            );                                                                                                                                                      
                                                                                                                                                                    
            $this->add_control(                                                                                                                                     
                'slautolaydelay',                                                                                                                                   
                [                                                                                                                                                   
                    'label' => __('Autoplay Delay', 'codexse'),                                                                                                     
                    'type' => Controls_Manager::NUMBER,                                                                                                             
                    'default' => 6500,                                                                                                                              
                ]                                                                                                                                                   
            );                                                                                                                                                      
                                                                                                                                                                    
                                                                                                                                                                    
            $this->add_control(                                                                                                                                     
                'slcenter',                                                                                                                                         
                [                                                                                                                                                   
                    'label' => esc_html__( 'Center', 'codexse' ),                                                                                                   
                    'type' => Controls_Manager::SWITCHER,                                                                                                           
                    'return_value' => 'yes',                                                                                                                        
                    'default' => 'no',                                                                                                                              
                ]                                                                                                                                                   
            );                                                                                                                                                      
                                                                                                                                                                    
                                                                                                                                                                    
            $this->add_control(                                                                                                                                     
                'sldisplay_columns',                                                                                                                                
                [                                                                                                                                                   
                    'label' => __('Slider Items', 'codexse'),                                                                                                       
                    'type' => Controls_Manager::NUMBER,                                                                                                             
                    'min' => 1,                                                                                                                                     
                    'max' => 8,                                                                                                                                     
                    'step' => 1,                                                                                                                                    
                    'default' => 3,                                                                                                                                 
                ]                                                                                                                                                   
            );                                                                                                                                                      
                                                                                                                                                                    
            $this->add_control(                                                                                                                                     
                'slcenter_padding',                                                                                                                                 
                [                                                                                                                                                   
                    'label' => __( 'Center padding', 'codexse' ),                                                                                                   
                    'type' => Controls_Manager::NUMBER,                                                                                                             
                    'min' => 0,                                                                                                                                     
                    'max' => 500,                                                                                                                                   
                    'step' => 1,                                                                                                                                    
                    'default' => 30,                                                                                                                                
                ]                                                                                                                                                   
            );                                                                                                                                                      
                                                                                                                                                                    
            $this->add_control(                                                                                                                                     
                'slanimation_speed',                                                                                                                                
                [                                                                                                                                                   
                    'label' => __('Slide Speed', 'codexse'),                                                                                                        
                    'type' => Controls_Manager::NUMBER,                                                                                                             
                    'default' => 1000,                                                                                                                              
                ]                                                                                                                                                   
            );                                                                                                                                                      
                                                                                                                                                                    
            $this->add_control(                                                                                                                                     
                'heading_laptop',                                                                                                                                   
                [                                                                                                                                                   
                    'label' => __( 'Laptop', 'codexse' ),                                                                                                           
                    'type' => Controls_Manager::HEADING,                                                                                                            
                    'separator' => 'after',                                                                                                                         
                ]                                                                                                                                                   
            );                                                                                                                                                      
                                                                                                                                                                    
            $this->add_control(                                                                                                                                     
                'sllaptop_width',                                                                                                                                   
                [                                                                                                                                                   
                    'label' => __('Laptop Resolution', 'codexse'),                                                                                                  
                    'description' => __('The resolution to laptop.', 'codexse'),                                                                                    
                    'type' => Controls_Manager::NUMBER,                                                                                                             
                    'default' => 1200,                                                                                                                              
                ]                                                                                                                                                   
            );                                                                                                                                                      
                                                                                                                                                                    
            $this->add_control(                                                                                                                                     
                'sllaptop_display_columns',                                                                                                                         
                [                                                                                                                                                   
                    'label' => __('Slider Items', 'codexse'),                                                                                                       
                    'type' => Controls_Manager::NUMBER,                                                                                                             
                    'min' => 1,                                                                                                                                     
                    'max' => 8,                                                                                                                                     
                    'step' => 1,                                                                                                                                    
                    'default' => 3,                                                                                                                                 
                ]                                                                                                                                                   
            );                                                                                                                                                      
                                                                                                                                                                    
            $this->add_control(                                                                                                                                     
                'sllaptop_padding',                                                                                                                                 
                [                                                                                                                                                   
                    'label' => __( 'Center padding', 'codexse' ),                                                                                                   
                    'type' => Controls_Manager::NUMBER,                                                                                                             
                    'min' => 0,                                                                                                                                     
                    'max' => 500,                                                                                                                                   
                    'step' => 1,                                                                                                                                    
                    'default' => 30,                                                                                                                                
                ]                                                                                                                                                   
            );                                                                                                                                                      
                                                                                                                                                                    
            $this->add_control(                                                                                                                                     
                'heading_tablet',                                                                                                                                   
                [                                                                                                                                                   
                    'label' => __( 'Tablet', 'codexse' ),                                                                                                           
                    'type' => Controls_Manager::HEADING,                                                                                                            
                    'separator' => 'after',                                                                                                                         
                ]                                                                                                                                                   
            );                                                                                                                                                      
                                                                                                                                                                    
            $this->add_control(                                                                                                                                     
                'sltablet_width',                                                                                                                                   
                [                                                                                                                                                   
                    'label' => __('Tablet Resolution', 'codexse'),                                                                                                  
                    'description' => __('The resolution to tablet.', 'codexse'),                                                                                    
                    'type' => Controls_Manager::NUMBER,                                                                                                             
                    'default' => 992,                                                                                                                               
                ]                                                                                                                                                   
            );                                                                                                                                                      
                                                                                                                                                                    
            $this->add_control(                                                                                                                                     
                'sltablet_display_columns',                                                                                                                         
                [                                                                                                                                                   
                    'label' => __('Slider Items', 'codexse'),                                                                                                       
                    'type' => Controls_Manager::NUMBER,                                                                                                             
                    'min' => 1,                                                                                                                                     
                    'max' => 8,                                                                                                                                     
                    'step' => 1,                                                                                                                                    
                    'default' => 2,                                                                                                                                 
                ]                                                                                                                                                   
            );                                                                                                                                                      
                                                                                                                                                                    
            $this->add_control(                                                                                                                                     
                'sltablet_padding',                                                                                                                                 
                [                                                                                                                                                   
                    'label' => __( 'Center padding', 'codexse' ),                                                                                                   
                    'type' => Controls_Manager::NUMBER,                                                                                                             
                    'min' => 0,                                                                                                                                     
                    'max' => 768,                                                                                                                                   
                    'step' => 1,                                                                                                                                    
                    'default' => 30,                                                                                                                                
                ]                                                                                                                                                   
            );                                                                                                                                                      
                                                                                                                                                                    
            $this->add_control(                                                                                                                                     
                'heading_mobile',                                                                                                                                   
                [                                                                                                                                                   
                    'label' => __( 'Mobile Phone', 'codexse' ),                                                                                                     
                    'type' => Controls_Manager::HEADING,                                                                                                            
                    'separator' => 'after',                                                                                                                         
                ]                                                                                                                                                   
            );                                                                                                                                                      
                                                                                                                                                                    
            $this->add_control(                                                                                                                                     
                'slmobile_width',                                                                                                                                   
                [                                                                                                                                                   
                    'label' => __('Mobile Resolution', 'codexse'),                                                                                                  
                    'description' => __('The resolution to mobile.', 'codexse'),                                                                                    
                    'type' => Controls_Manager::NUMBER,                                                                                                             
                    'default' => 768,                                                                                                                               
                ]                                                                                                                                                   
            );                                                                                                                                                      
                                                                                                                                                                    
            $this->add_control(                                                                                                                                     
                'slmobile_display_columns',                                                                                                                         
                [                                                                                                                                                   
                    'label' => __('Slider Items', 'codexse'),                                                                                                       
                    'type' => Controls_Manager::NUMBER,                                                                                                             
                    'min' => 1,                                                                                                                                     
                    'max' => 4,                                                                                                                                     
                    'step' => 1,                                                                                                                                    
                    'default' => 1,                                                                                                                                 
                ]                                                                                                                                                   
            );                                                                                                                                                      
                                                                                                                                                                    
            $this->add_control(                                                                                                                                     
                'slmobile_padding',                                                                                                                                 
                [                                                                                                                                                   
                    'label' => __( 'Center padding', 'codexse' ),                                                                                                   
                    'type' => Controls_Manager::NUMBER,                                                                                                             
                    'min' => 0,                                                                                                                                     
                    'max' => 500,                                                                                                                                   
                    'step' => 1,                                                                                                                                    
                    'default' => 30,                                                                                                                                
                ]                                                                                                                                                   
            );                                                                                                                                                      
        $this->end_controls_section();                                                                                                                              
                                                                                                                                                                    

        // Feature Style tab section
        $this->start_controls_section(
            'codexse_feature_style_section',
            [
                'label' => __( 'Single Item', 'codexse' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->start_controls_tabs('carousel_item_style_tab');
        $this->start_controls_tab( 'carousel_item_normal',
			[
				'label' => __( 'Normal', 'codexse' ),
			]
		);
        
        $this->add_responsive_control(
            'feature_margin',
            [
                'label' => __( 'Margin', 'codexse' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .slide-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'feature_padding',
            [
                'label' => __( 'Padding', 'codexse' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .slide-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'feature_background',
                'label' => __( 'Background', 'codexse' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .slide-item',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'feature_border',
                'label' => __( 'Border', 'codexse' ),
                'selector' => '{{WRAPPER}} .slide-item',
            ]
        );
        $this->add_responsive_control(
            'feature_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'codexse' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .slide-item' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'carousel_item_shadow',
                'label' => __( 'Box Shadow', 'codexse' ),
                'selector' => '{{WRAPPER}} .slide-item',
            ]
        );

        
        $this->add_control(
			'carousel_item_transform',
			[
				'label' => __( 'Transform', 'codexse' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'translateY(0)',
				'selectors' => [
					'{{WRAPPER}} .slide-item' => 'transform: {{VALUE}}',
				],
			]
		);
        
		$this->add_control(
			'carousel_item_transition',
			[
				'label' => __( 'Transition Duration', 'codexse' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.3,
				],
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slide-item' => 'transition-duration: {{SIZE}}s',
				],
			]
		);
		$this->end_controls_tab();

             
        // Hover Style tab Start
        $this->start_controls_tab(
            'carousel_item_hover',
            [
                'label' => __( 'Hover', 'codexse' ),
            ]
        );
        
        
              
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'feature_hover_background',
                'label' => __( 'Background', 'codexse' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .slide-item:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'feature_border_hover',
                'label' => __( 'Border', 'codexse' ),
                'selector' => '{{WRAPPER}} .slide-item:hover',
            ]
        );
        $this->add_responsive_control(
            'feature_hover_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'codexse' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .slide-item:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'carousel_item_hover_shadow',
                'label' => __( 'Box Shadow', 'codexse' ),
                'selector' => '{{WRAPPER}} .slide-item:hover',
            ]
        );
        $this->add_control(
			'carousel_item_hover_transform',
			[
				'label' => __( 'Transform', 'codexse' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'translateY(0)',
				'selectors' => [
					'{{WRAPPER}} .slide-item:hover' => 'transform: {{VALUE}}',
				],
			]
		);
        
        $this->end_controls_tab(); // Hover Style tab end        
        $this->end_controls_tabs();// Box Style tabs end  
        $this->end_controls_section(); // Feature Box section style end
                                                                                                                                      
                                                                                                                                                                    
        // Style Slider arrow style start                                                                                                                           
        $this->start_controls_section(                                                                                                                              
            'slider_arrow_style',                                                                                                                                   
            [                                                                                                                                                       
                'label'     => __( 'Arrow', 'codexse' ),                                                                                                            
                'tab'       => Controls_Manager::TAB_STYLE,                                                                                                         
                'condition' =>[                                                                                                                                     
                    'slider_on' => 'yes',                                                                                                                           
                    'sl_navigation'  => 'yes',                                                                                                                      
                ],                                                                                                                                                  
            ]                                                                                                                                                       
        );                                                                                                                                                          
                                                                                                                                                                    
            $this->start_controls_tabs( 'slider_arrow_style_tabs' );                                                                                                
                                                                                                                                                                    
                // Normal tab Start                                                                                                                                 
                $this->start_controls_tab(                                                                                                                          
                    'slider_arrow_style_normal_tab',                                                                                                                
                    [                                                                                                                                               
                        'label' => __( 'Normal', 'codexse' ),                                                                                                       
                    ]                                                                                                                                               
                );                                                                                                                                                  
                                                                                                                                                                    
                    $this->add_control(                                                                                                                             
                        'slider_arrow_color',                                                                                                                       
                        [                                                                                                                                           
                            'label' => __( 'Color', 'codexse' ),                                                                                                    
                            'type' => Controls_Manager::COLOR,                                                                                                      
                            'selectors' => [                                                                                                                        
                                '{{WRAPPER}} .swiper-navigation .swiper-arrow' => 'color: {{VALUE}};',                                                              
                            ],                                                                                                                                      
                        ]                                                                                                                                           
                    );                                                                                                                                              
                    $this->add_responsive_control(                                                                                                                  
                        'slider_arrow_gap',                                                                                                                         
                        [                                                                                                                                           
                            'label' => __( 'Arrow Gap', 'codexse' ),                                                                                                
                            'type' => Controls_Manager::SLIDER,                                                                                                     
                            'size_units' => [ 'px' ],                                                                                                               
                            'range' => [                                                                                                                            
                                'px' => [                                                                                                                           
                                    'min' => -100,                                                                                                                  
                                    'max' => 100,                                                                                                                   
                                    'step' => 1,                                                                                                                    
                                ]                                                                                                                                   
                            ],                                                                                                                                      
                            'selectors' => [                                                                                                                        
                                '{{WRAPPER}} .swiper-navigation .swiper-arrow.swiper-prev' => 'left: {{SIZE}}{{UNIT}};',                                            
                                '{{WRAPPER}} .swiper-navigation .swiper-arrow.swiper-next' => 'right: {{SIZE}}{{UNIT}};',                                           
                            ],                                                                                                                                      
                        ]                                                                                                                                           
                    );                                                                                                                                              
                                                                                                                                                                    
                    $this->add_responsive_control(                                                                                                                  
                        'slider_arrow_fontsize',                                                                                                                    
                        [                                                                                                                                           
                            'label' => __( 'Font Size', 'codexse' ),                                                                                                
                            'type' => Controls_Manager::SLIDER,                                                                                                     
                            'size_units' => [ 'px', '%' ],                                                                                                          
                            'range' => [                                                                                                                            
                                'px' => [                                                                                                                           
                                    'min' => 0,                                                                                                                     
                                    'max' => 100,                                                                                                                   
                                    'step' => 1,                                                                                                                    
                                ],                                                                                                                                  
                                '%' => [                                                                                                                            
                                    'min' => 0,                                                                                                                     
                                    'max' => 100,                                                                                                                   
                                ],                                                                                                                                  
                            ],                                                                                                                                      
                            'selectors' => [                                                                                                                        
                                '{{WRAPPER}} .swiper-navigation .swiper-arrow' => 'font-size: {{SIZE}}{{UNIT}};',                                                   
                            ],                                                                                                                                      
                        ]                                                                                                                                           
                    );                                                                                                                                              
                                                                                                                                                                    
                    $this->add_group_control(                                                                                                                       
                        Group_Control_Background::get_type(),                                                                                                       
                        [                                                                                                                                           
                            'name' => 'slider_arrow_background',                                                                                                    
                            'label' => __( 'Background', 'codexse' ),                                                                                               
                            'types' => [ 'classic', 'gradient' ],                                                                                                   
                            'selector' => '{{WRAPPER}} .swiper-navigation .swiper-arrow',                                                                           
                        ]                                                                                                                                           
                    );                                                                                                                                              
                                                                                                                                                                    
                    $this->add_group_control(                                                                                                                       
                        Group_Control_Border::get_type(),                                                                                                           
                        [                                                                                                                                           
                            'name' => 'slider_arrow_border',                                                                                                        
                            'label' => __( 'Border', 'codexse' ),                                                                                                   
                            'selector' => '{{WRAPPER}} .swiper-navigation .swiper-arrow',                                                                           
                        ]                                                                                                                                           
                    );                                                                                                                                              
                                                                                                                                                                    
                    $this->add_responsive_control(                                                                                                                  
                        'slider_border_radius',                                                                                                                     
                        [                                                                                                                                           
                            'label' => esc_html__( 'Border Radius', 'codexse' ),                                                                                    
                            'type' => Controls_Manager::DIMENSIONS,                                                                                                 
                            'selectors' => [                                                                                                                        
                                '{{WRAPPER}} .swiper-navigation .swiper-arrow' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',                  
                            ],                                                                                                                                      
                        ]                                                                                                                                           
                    );                                                                                                                                              
                                                                                                                                                                    
                    $this->add_responsive_control(                                                                                                                  
                        'slider_arrow_width',                                                                                                                       
                        [                                                                                                                                           
                            'label' => __( 'Width', 'codexse' ),                                                                                                    
                            'type' => Controls_Manager::SLIDER,                                                                                                     
                            'size_units' => [ 'px', '%' ],                                                                                                          
                            'range' => [                                                                                                                            
                                'px' => [                                                                                                                           
                                    'min' => 0,                                                                                                                     
                                    'max' => 1000,                                                                                                                  
                                    'step' => 1,                                                                                                                    
                                ],                                                                                                                                  
                                '%' => [                                                                                                                            
                                    'min' => 0,                                                                                                                     
                                    'max' => 100,                                                                                                                   
                                ],                                                                                                                                  
                            ],                                                                                                                                      
                            'selectors' => [                                                                                                                        
                                '{{WRAPPER}} .swiper-navigation .swiper-arrow' => 'width: {{SIZE}}{{UNIT}};',                                                       
                            ],                                                                                                                                      
                        ]                                                                                                                                           
                    );                                                                                                                                              
                                                                                                                                                                    
                    $this->add_responsive_control(                                                                                                                  
                        'slider_arrow_height',                                                                                                                      
                        [                                                                                                                                           
                            'label' => __( 'Height', 'codexse' ),                                                                                                   
                            'type' => Controls_Manager::SLIDER,                                                                                                     
                            'size_units' => [ 'px', '%' ],                                                                                                          
                            'range' => [                                                                                                                            
                                'px' => [                                                                                                                           
                                    'min' => 0,                                                                                                                     
                                    'max' => 1000,                                                                                                                  
                                    'step' => 1,                                                                                                                    
                                ],                                                                                                                                  
                                '%' => [                                                                                                                            
                                    'min' => 0,                                                                                                                     
                                    'max' => 100,                                                                                                                   
                                ],                                                                                                                                  
                            ],                                                                                                                                      
                            'selectors' => [                                                                                                                        
                                '{{WRAPPER}} .swiper-navigation .swiper-arrow' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',                       
                            ],                                                                                                                                      
                        ]                                                                                                                                           
                    );                                                                                                                                              
                                                                                                                                                                    
                    $this->add_responsive_control(                                                                                                                  
                        'slider_arrow_line_height',                                                                                                                 
                        [                                                                                                                                           
                            'label' => __( 'Line Height', 'codexse' ),                                                                                              
                            'type' => Controls_Manager::SLIDER,                                                                                                     
                            'size_units' => [ 'px', '%' ],                                                                                                          
                            'range' => [                                                                                                                            
                                'px' => [                                                                                                                           
                                    'min' => 0,                                                                                                                     
                                    'max' => 1000,                                                                                                                  
                                    'step' => 1,                                                                                                                    
                                ],                                                                                                                                  
                                '%' => [                                                                                                                            
                                    'min' => 0,                                                                                                                     
                                    'max' => 100,                                                                                                                   
                                ],                                                                                                                                  
                            ],                                                                                                                                      
                            'selectors' => [                                                                                                                        
                                '{{WRAPPER}} .swiper-navigation .swiper-arrow' => 'line-height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',                  
                            ],                                                                                                                                      
                        ]                                                                                                                                           
                    );                                                                                                                                              
                                                                                                                                                                    
                    $this->add_responsive_control(                                                                                                                  
                        'slider_arrow_padding',                                                                                                                     
                        [                                                                                                                                           
                            'label' => __( 'Padding', 'codexse' ),                                                                                                  
                            'type' => Controls_Manager::DIMENSIONS,                                                                                                 
                            'size_units' => [ 'px', '%', 'em' ],                                                                                                    
                            'selectors' => [                                                                                                                        
                                '{{WRAPPER}} .swiper-navigation .swiper-arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],                                                                                                                                      
                            'separator' =>'before',                                                                                                                 
                        ]                                                                                                                                           
                    );                                                                                                                                              
                                                                                                                                                                    
                $this->end_controls_tab(); // Normal tab end                                                                                                        
                                                                                                                                                                    
                // Hover tab Start                                                                                                                                  
                $this->start_controls_tab(                                                                                                                          
                    'slider_arrow_style_hover_tab',                                                                                                                 
                    [                                                                                                                                               
                        'label' => __( 'Hover', 'codexse' ),                                                                                                        
                    ]                                                                                                                                               
                );                                                                                                                                                  
                                                                                                                                                                    
                    $this->add_control(                                                                                                                             
                        'slider_arrow_hover_color',                                                                                                                 
                        [                                                                                                                                           
                            'label' => __( 'Color', 'codexse' ),                                                                                                    
                            'type' => Controls_Manager::COLOR,                                                                                                      
                            'selectors' => [                                                                                                                        
                                '{{WRAPPER}} .swiper-navigation .swiper-arrow:hover' => 'color: {{VALUE}};',                                                        
                            ],                                                                                                                                      
                        ]                                                                                                                                           
                    );                                                                                                                                              
                                                                                                                                                                    
                    $this->add_group_control(                                                                                                                       
                        Group_Control_Background::get_type(),                                                                                                       
                        [                                                                                                                                           
                            'name' => 'slider_arrow_hover_background',                                                                                              
                            'label' => __( 'Background', 'codexse' ),                                                                                               
                            'types' => [ 'classic', 'gradient' ],                                                                                                   
                            'selector' => '{{WRAPPER}} .swiper-navigation .swiper-arrow:hover',                                                                     
                        ]                                                                                                                                           
                    );                                                                                                                                              
                                                                                                                                                                    
                    $this->add_group_control(                                                                                                                       
                        Group_Control_Border::get_type(),                                                                                                           
                        [                                                                                                                                           
                            'name' => 'slider_arrow_hover_border',                                                                                                  
                            'label' => __( 'Border', 'codexse' ),                                                                                                   
                            'selector' => '{{WRAPPER}} .swiper-navigation .swiper-arrow:hover',                                                                     
                        ]                                                                                                                                           
                    );                                                                                                                                              
                                                                                                                                                                    
                    $this->add_responsive_control(                                                                                                                  
                        'slider_arrow_hover_border_radius',                                                                                                         
                        [                                                                                                                                           
                            'label' => esc_html__( 'Border Radius', 'codexse' ),                                                                                    
                            'type' => Controls_Manager::DIMENSIONS,                                                                                                 
                            'selectors' => [                                                                                                                        
                                '{{WRAPPER}} .swiper-navigation .swiper-arrow:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',            
                            ],                                                                                                                                      
                        ]                                                                                                                                           
                    );                                                                                                                                              
                                                                                                                                                                    
                $this->end_controls_tab(); // Hover tab end                                                                                                         
                                                                                                                                                                    
            $this->end_controls_tabs();                                                                                                                             
                                                                                                                                                                    
        $this->end_controls_section(); // Style Slider arrow style end                                                                                              
                                                                                                                                                                    
        // Style Pagination button tab section                                                                                                                      
        $this->start_controls_section(                                                                                                                              
            'post_slider_pagination_style_section',                                                                                                                 
            [                                                                                                                                                       
                'label' => __( 'Pagination', 'codexse' ),                                                                                                           
                'tab' => Controls_Manager::TAB_STYLE,                                                                                                               
                'condition'=>[                                                                                                                                      
                    'slider_on' => 'yes',                                                                                                                           
                    'slpaginate'=>'yes',                                                                                                                            
                ]                                                                                                                                                   
            ]                                                                                                                                                       
        );                                                                                                                                                          
                                                                                                                                                                    
            $this->start_controls_tabs('pagination_style_tabs');                                                                                                    
            $this->add_responsive_control(                                                                                                                          
                'pagination_alignment',                                                                                                                             
                [                                                                                                                                                   
                    'label' => __( 'Alignment', 'codexse' ),                                                                                                        
                    'type' => Controls_Manager::CHOOSE,                                                                                                             
                    'options' => [                                                                                                                                  
                        'left' => [                                                                                                                                 
                            'title' => __( 'Left', 'codexse' ),                                                                                                     
                            'icon' => 'eicon-text-align-left',                                                                                                      
                        ],                                                                                                                                          
                        'center' => [                                                                                                                               
                            'title' => __( 'Center', 'codexse' ),                                                                                                   
                            'icon' => 'eicon-text-align-center',                                                                                                    
                        ],                                                                                                                                          
                        'right' => [                                                                                                                                
                            'title' => __( 'Right', 'codexse' ),                                                                                                    
                            'icon' => 'eicon-text-align-right',                                                                                                     
                        ],                                                                                                                                          
                    ],                                                                                                                                              
                    'selectors' => [                                                                                                                                
                        '{{WRAPPER}} .swiper-pagination-bullet' => 'text-align: {{VALUE}};'                                                                         
                    ],                                                                                                                                              
                    'separator' =>'before',                                                                                                                         
                ]                                                                                                                                                   
            );                                                                                                                                                      
                $this->start_controls_tab(                                                                                                                          
                    'pagination_style_normal_tab',                                                                                                                  
                    [                                                                                                                                               
                        'label' => __( 'Normal', 'codexse' ),                                                                                                       
                    ]                                                                                                                                               
                );                                                                                                                                                  
                                                                                                                                                                    
                    $this->add_responsive_control(                                                                                                                  
                        'slider_pagination_height',                                                                                                                 
                        [                                                                                                                                           
                            'label' => __( 'Height', 'codexse' ),                                                                                                   
                            'type' => Controls_Manager::SLIDER,                                                                                                     
                            'size_units' => [ 'px', '%' ],                                                                                                          
                            'range' => [                                                                                                                            
                                'px' => [                                                                                                                           
                                    'min' => 0,                                                                                                                     
                                    'max' => 1000,                                                                                                                  
                                    'step' => 1,                                                                                                                    
                                ],                                                                                                                                  
                                '%' => [                                                                                                                            
                                    'min' => 0,                                                                                                                     
                                    'max' => 100,                                                                                                                   
                                ],                                                                                                                                  
                            ],                                                                                                                                      
                            'selectors' => [                                                                                                                        
                                '{{WRAPPER}} .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};',                                                             
                            ],                                                                                                                                      
                        ]                                                                                                                                           
                    );                                                                                                                                              
                                                                                                                                                                    
                    $this->add_responsive_control(                                                                                                                  
                        'slider_pagination_width',                                                                                                                  
                        [                                                                                                                                           
                            'label' => __( 'Width', 'codexse' ),                                                                                                    
                            'type' => Controls_Manager::SLIDER,                                                                                                     
                            'size_units' => [ 'px', '%' ],                                                                                                          
                            'range' => [                                                                                                                            
                                'px' => [                                                                                                                           
                                    'min' => 0,                                                                                                                     
                                    'max' => 1000,                                                                                                                  
                                    'step' => 1,                                                                                                                    
                                ],                                                                                                                                  
                                '%' => [                                                                                                                            
                                    'min' => 0,                                                                                                                     
                                    'max' => 100,                                                                                                                   
                                ],                                                                                                                                  
                            ],                                                                                                                                      
                            'selectors' => [                                                                                                                        
                                '{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}};',                                                              
                            ],                                                                                                                                      
                        ]                                                                                                                                           
                    );                                                                                                                                              
                                                                                                                                                                    
                    $this->add_group_control(                                                                                                                       
                        Group_Control_Background::get_type(),                                                                                                       
                        [                                                                                                                                           
                            'name' => 'pagination_background',                                                                                                      
                            'label' => __( 'Background', 'codexse' ),                                                                                               
                            'types' => [ 'classic', 'gradient' ],                                                                                                   
                            'selector' => '{{WRAPPER}} .swiper-pagination-bullet',                                                                                  
                        ]                                                                                                                                           
                    );                                                                                                                                              
                                                                                                                                                                    
                    $this->add_responsive_control(                                                                                                                  
                        'pagination_margin',                                                                                                                        
                        [                                                                                                                                           
                            'label' => __( 'Margin', 'codexse' ),                                                                                                   
                            'type' => Controls_Manager::DIMENSIONS,                                                                                                 
                            'size_units' => [ 'px', '%', 'em' ],                                                                                                    
                            'selectors' => [                                                                                                                        
                                '{{WRAPPER}} .swiper-pagination-bullet' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',        
                            ],                                                                                                                                      
                        ]                                                                                                                                           
                    );                                                                                                                                              
                                                                                                                                                                    
                    $this->add_group_control(                                                                                                                       
                        Group_Control_Border::get_type(),                                                                                                           
                        [                                                                                                                                           
                            'name' => 'pagination_border',                                                                                                          
                            'label' => __( 'Border', 'codexse' ),                                                                                                   
                            'selector' => '{{WRAPPER}} .swiper-pagination-bullet',                                                                                  
                        ]                                                                                                                                           
                    );                                                                                                                                              
                                                                                                                                                                    
                    $this->add_responsive_control(                                                                                                                  
                        'pagination_border_radius',                                                                                                                 
                        [                                                                                                                                           
                            'label' => esc_html__( 'Border Radius', 'codexse' ),                                                                                    
                            'type' => Controls_Manager::DIMENSIONS,                                                                                                 
                            'selectors' => [                                                                                                                        
                                '{{WRAPPER}} .swiper-pagination-bullet' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',                         
                            ],                                                                                                                                      
                        ]                                                                                                                                           
                    );                                                                                                                                              
                    $this->add_responsive_control(                                                                                                                  
                        'pagination_opacity',                                                                                                                       
                        [                                                                                                                                           
                            'label' => __( 'Opacity (%)', 'codexse' ),                                                                                              
                            'type' => Controls_Manager::SLIDER,                                                                                                     
                            'range' => [                                                                                                                            
                                'px' => [                                                                                                                           
                                    'max' => 1,                                                                                                                     
                                    'step' => 0.01,                                                                                                                 
                                ],                                                                                                                                  
                            ],                                                                                                                                      
                            'selectors' => [                                                                                                                        
                                '{{WRAPPER}} .swiper-pagination-bullet' => 'opacity: {{SIZE}}',                                                                     
                                                                                                                                                                    
                            ],                                                                                                                                      
                        ]                                                                                                                                           
                    );                                                                                                                                              
                $this->end_controls_tab(); // Normal Tab end                                                                                                        
                                                                                                                                                                    
                $this->start_controls_tab(                                                                                                                          
                    'pagination_style_active_tab',                                                                                                                  
                    [                                                                                                                                               
                        'label' => __( 'Active', 'codexse' ),                                                                                                       
                    ]                                                                                                                                               
                );                                                                                                                                                  
                                                                                                                                                                    
                    $this->add_group_control(                                                                                                                       
                        Group_Control_Background::get_type(),                                                                                                       
                        [                                                                                                                                           
                            'name' => 'pagination_hover_background',                                                                                                
                            'label' => __( 'Background', 'codexse' ),                                                                                               
                            'types' => [ 'classic', 'gradient' ],                                                                                                   
                            'selector' => '{{WRAPPER}} .swiper-pagination-bullet:hover, {{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active',     
                        ]                                                                                                                                           
                    );                                                                                                                                              
                    $this->add_responsive_control(                                                                                                                  
                        'slider_pagination_active_width',                                                                                                           
                        [                                                                                                                                           
                            'label' => __( 'Width', 'codexse' ),                                                                                                    
                            'type' => Controls_Manager::SLIDER,                                                                                                     
                            'size_units' => [ 'px', '%' ],                                                                                                          
                            'range' => [                                                                                                                            
                                'px' => [                                                                                                                           
                                    'min' => 0,                                                                                                                     
                                    'max' => 1000,                                                                                                                  
                                    'step' => 1,                                                                                                                    
                                ],                                                                                                                                  
                                '%' => [                                                                                                                            
                                    'min' => 0,                                                                                                                     
                                    'max' => 100,                                                                                                                   
                                ],                                                                                                                                  
                            ],                                                                                                                                      
                            'selectors' => [                                                                                                                        
                                '{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}};',                              
                            ],                                                                                                                                      
                        ]                                                                                                                                           
                    );                                                                                                                                              
                    $this->add_responsive_control(                                                                                                                  
                        'slider_pagination_active_height',                                                                                                          
                        [                                                                                                                                           
                            'label' => __( 'Height', 'codexse' ),                                                                                                   
                            'type' => Controls_Manager::SLIDER,                                                                                                     
                            'size_units' => [ 'px', '%' ],                                                                                                          
                            'range' => [                                                                                                                            
                                'px' => [                                                                                                                           
                                    'min' => 0,                                                                                                                     
                                    'max' => 1000,                                                                                                                  
                                    'step' => 1,                                                                                                                    
                                ],                                                                                                                                  
                                '%' => [                                                                                                                            
                                    'min' => 0,                                                                                                                     
                                    'max' => 100,                                                                                                                   
                                ],                                                                                                                                  
                            ],                                                                                                                                      
                            'selectors' => [                                                                                                                        
                                '{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'height: {{SIZE}}{{UNIT}};',                             
                            ],                                                                                                                                      
                        ]                                                                                                                                           
                    );                                                                                                                                              
                    $this->add_responsive_control(                                                                                                                  
                        'pagination_active_opacity',                                                                                                                
                        [                                                                                                                                           
                            'label' => __( 'Opacity (%)', 'codexse' ),                                                                                              
                            'type' => Controls_Manager::SLIDER,                                                                                                     
                            'range' => [                                                                                                                            
                                'px' => [                                                                                                                           
                                    'max' => 1,                                                                                                                     
                                    'step' => 0.01,                                                                                                                 
                                ],                                                                                                                                  
                            ],                                                                                                                                      
                            'selectors' => [                                                                                                                        
                                '{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'opacity: {{SIZE}}',                                     
                            ],                                                                                                                                      
                        ]                                                                                                                                           
                    );                                                                                                                                              
                $this->end_controls_tab(); // Hover Tab end                                                                                                         
            $this->end_controls_tabs();                                                                                                                             
        $this->end_controls_section();                                                                                                                              
                                                                                                                                                                    
    }                                                                                                                                                               
                                                                                                                                                                    
    protected function render( $instance = [] ) {      
        $column = "col-lg-4 col-md-6";                                                                                                   
        $settings   = $this->get_settings_for_display();                                                                                                            
        // Carousel Attribute                                                                                                                                       
        $this->add_render_attribute( 'wrapper_attributes', 'class', 'codexse-custom-carousel' );                                                                    
        if( $settings['slider_on'] == 'yes' ){                                                                                                                      
            $this->add_render_attribute( 'wrapper_attributes', 'class', 'swiper-container' );                                                                       
            $slider_settings = [                                                                                                                                    
                'sleffect' => $settings['sleffect'],                                                                                                                
                'slloop' => ('yes' === $settings['slloop']),                                                                                                        
                'slautolay' => ('yes' === $settings['slautolay']),                                                                                                  
                'slautolaydelay' => absint($settings['slautolaydelay']),                                                                                            
                'slanimation_speed' => absint($settings['slanimation_speed']),                                                                                      
                'slcustom_arrow' => ('yes' === $settings['slider_custom_arrow']),                                                                                   
                'sltarget_id' => $settings['slider_target_id'],                                                                                                     
                'sldisplay_columns' => $settings['sldisplay_columns'],                                                                                              
                'slcenter' => ('yes' === $settings['slcenter']),                                                                                                    
                'slcenter_padding' => $settings['slcenter_padding'],                                                                                                
            ];                                                                                                                                                      
            $slider_responsive_settings = [                                                                                                                         
                'laptop_width' => $settings['sllaptop_width'],                                                                                                      
                'laptop_padding' => $settings['sllaptop_padding'],                                                                                                  
                'laptop_display_columns' => $settings['sllaptop_display_columns'],                                                                                  
                'tablet_width' => $settings['sltablet_width'],                                                                                                      
                'tablet_padding' => $settings['sltablet_padding'],                                                                                                  
                'tablet_display_columns' => $settings['sltablet_display_columns'],                                                                                  
                'mobile_width' => $settings['slmobile_width'],                                                                                                      
                'mobile_padding' => $settings['slmobile_padding'],                                                                                                  
                'mobile_display_columns' => $settings['slmobile_display_columns'],                                                                                  
            ];                                                                                                                                                      
            $slider_settings = array_merge( $slider_settings, $slider_responsive_settings );                                                                        
            $this->add_render_attribute( 'wrapper_attributes', 'data-settings', wp_json_encode( $slider_settings ) );                                               
        }else {
            $this->add_render_attribute( 'wrapper_attributes', 'class', ['row', esc_attr($settings['grid_space'])] );
            if($settings['masonry'] == 'yes'){
                $this->add_render_attribute( 'wrapper_attributes', 'class', 'masonry_lists' );
            }
            switch ($settings['item_column']) {
                case "1grid":
                    $column = "col-lg-12";
                    break;
                case "2grid":
                    $column = "col-lg-6 col-md-12";
                    break;
                case "3grid":
                    $column = "col-lg-4 col-md-6";
                    break;
                default:
                    $column = "col-xl-3 col-lg-4 col-md-6";
            }
        }
        
        echo '<div '.$this->get_render_attribute_string( "wrapper_attributes" ).' >';                                                                               
            if($settings['slider_on'] == 'yes'){
                echo '<div class="swiper-wrapper">';                                                                                                                        
                    foreach ( $settings['carosul_image_list'] as $item ):
                        echo '<div class="swiper-slide elementor-repeater-item-'.$item['_id'].'">';                                                                                                                  
                            echo '<div class="slide-item" data-title="'. esc_attr( $item['carosul_image_title'] ) .'">';                                                               
                                echo Group_Control_Image_Size::get_attachment_image_html( $item, 'carosul_imagesize', 'carosul_image' );                            
                            echo '</div>';                                                                                                                                  
                        echo '</div>';                                                                                                                                      
                    endforeach;                                                                                                                                             
                echo '</div>';                                                                                                                                              
                if( $settings['sl_navigation'] == true && $settings['slider_custom_arrow'] != true ){                                                                       
                    echo '<div class="swiper-navigation" >';                                                                                                                
                        echo '<div class="swiper-arrow swiper-prev"><i class="'.esc_attr($settings['sl_nav_prev_icon']).'" ></i></div>';                                    
                        echo '<div class="swiper-arrow swiper-next"><i class="'.esc_attr($settings['sl_nav_next_icon']).'" ></i></div>';                                    
                    echo '</div>';                                                                                                                                          
                }                                                                                                                                                           
                if( $settings['slpaginate'] == true ){                                                                                                                      
                    echo '<div class="swiper-pagination"></div>';                                                                                                           
                }           
            }else {                                                                                        
                foreach ( $settings['carosul_image_list'] as $item ):   
                    echo '<div class="'.$column.' elementor-repeater-item-'.$item['_id'].'">';                                                                                                                 
                        echo '<div class="slide-item" data-title="'. esc_attr( $item['carosul_image_title'] ) .'">';                                                               
                            echo Group_Control_Image_Size::get_attachment_image_html( $item, 'carosul_imagesize', 'carosul_image' );                            
                        echo '</div>';   
                    echo '</div>';
                endforeach;
            }            
        echo '</div>';                                                                                                                                              
    }                                                                                                                                                               
                                                                                                                                                                    
}                                                                                                                                                                   
                                                                                                                                                                    
