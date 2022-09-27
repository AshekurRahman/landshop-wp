<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class landshop_Elementor_Widget_Slider_Arrow extends Widget_Base {

    public function get_name() {
        return 'custom-slider-navigation';
    }
    
    public function get_title() {
        return __( 'Custom Navigation', 'landshopcore' );
    }

    public function get_icon() {
        return 'landshop-icon eicon-exchange';
    }

    public function get_categories() {
		return [ 'landshopcore' ];
    }

    public function get_script_depends() {
        return [
            'el-widget-active'
        ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'slider_navigation',
            [
                'label' => __( 'Slider Navigation', 'landshopcore' ),
            ]
        );
        
            $this->add_control(
                 'slider_target_id',
                 [
                     'label'     => __( 'Arrow ID', 'landshopcore' ),
                     'type'      => Controls_Manager::TEXT,
                     'title' => __( 'Copy this Id and paste at slider "Target ID" field.', 'landshopcore' ),
                     'default' => uniqid(),
                 ]
             );
            
            $this->start_controls_tabs('custom_navigation_tabs');
            
                $this->start_controls_tab( 'navigation_prev_tab',
                    [
                        'label' => __( 'Prev', 'landshopcore' ),
                    ]
                );

                    $this->add_control(
                        'prev_icon_type',
                        [
                            'label' => __('Icon Type','landshopcore'),
                            'type' =>Controls_Manager::CHOOSE,
                            'options' =>[
                                'img' =>[
                                    'title' =>__('Image','landshopcore'),
                                    'icon' =>'eicon-image-bold',
                                ],
                                'icon' =>[
                                    'title' =>__('Icon','landshopcore'),
                                    'icon' =>'eicon-icon-box',
                                ],
                                'text' =>[
                                    'title' =>__('Text','landshopcore'),
                                    'icon' =>'eicon-animation-text',
                                ]
                            ],
                            'default' => 'text',
                        ]
                    );

                    $this->add_control(
                        'prev_image_icon',
                        [
                            'label' => __('Image','landshopcore'),
                            'type'=>Controls_Manager::MEDIA,
                            'default' => [
                                'url' => Utils::get_placeholder_image_src(),
                            ],
                            'condition' => [
                                'prev_icon_type' => 'img',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Image_Size::get_type(),
                        [
                            'name' => 'prev_imagesize',
                            'default' => 'large',
                            'separator' => 'none',
                            'condition' => [
                                'prev_icon_type' => 'img',
                            ]
                        ]
                    );

                    $this->add_control(
                        'prev_font_icon',
                        [
                            'label'       => __( 'Icon', 'landshopcore-addons' ),
                            'type'        => Controls_Manager::ICONS,
                            'label_block' => true,
                            'condition' => [
                                'prev_icon_type' => 'icon',
                            ]
                        ]
                    );
                    $this->add_control(
                        'prev_arrow_text',
                        [
                            'label'     => __( 'Text', 'landshopcore' ),
                            'type'      => Controls_Manager::TEXT,
                            'title' => __( 'Text', 'landshopcore' ),
                            'default' => '<',
                            'condition' => [
                                'prev_icon_type' => 'text',
                            ]
                        ]
                    );

                $this->end_controls_tab();


                $this->start_controls_tab( 'nav_next_tab',
                    [
                        'label' => __( 'Next', 'landshopcore' ),
                    ]
                );

                    $this->add_control(
                        'next_icon_type',
                        [
                            'label' => __('Icon Type','landshopcore'),
                            'type' =>Controls_Manager::CHOOSE,
                            'options' =>[
                                'img' =>[
                                    'title' =>__('Image','landshopcore'),
                                    'icon' =>'eicon-image-bold',
                                ],
                                'icon' =>[
                                    'title' =>__('Icon','landshopcore'),
                                    'icon' =>'eicon-icon-box',
                                ],
                                'text' =>[
                                    'title' =>__('Text','landshopcore'),
                                    'icon' =>'eicon-animation-text',
                                ]
                            ],
                            'default' => 'text',
                        ]
                    );

                    $this->add_control(
                        'next_image_icon',
                        [
                            'label' => __('Image','landshopcore'),
                            'type'=>Controls_Manager::MEDIA,
                            'default' => [
                                'url' => Utils::get_placeholder_image_src(),
                            ],
                            'condition' => [
                                'next_icon_type' => 'img',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Image_Size::get_type(),
                        [
                            'name' => 'next_imagesize',
                            'default' => 'large',
                            'separator' => 'none',
                            'condition' => [
                                'next_icon_type' => 'img',
                            ]
                        ]
                    );

                    $this->add_control(
                        'next_font_icon',
                        [
                            'label'       => __( 'Icon', 'landshopcore-addons' ),
                            'type'        => Controls_Manager::ICONS,
                            'label_block' => true,
                            'condition' => [
                                'next_icon_type' => 'icon',
                            ]
                        ]
                    );
                    $this->add_control(
                        'next_arrow_text',
                        [
                            'label'     => __( 'Text', 'landshopcore' ),
                            'type'      => Controls_Manager::TEXT,
                            'title' => __( 'Text', 'landshopcore' ),
                            'default' => '>',
                            'condition' => [
                                'next_icon_type' => 'text',
                            ]
                        ]
                    );

                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        
        // post Style Tab section
        $this->start_controls_section(
            'tab_area_style_section',
            [
                'label' => __( 'Area Style', 'landshopcore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'tab_tab_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        ); 
        $this->add_responsive_control(
            'tab_tab_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        
        );  
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tab_tab_border',
                'label' => __( 'Border', 'core' ),
                'selector' => '{{WRAPPER}}',
                'separator' =>'before',
            ]
        );

        $this->add_responsive_control(
            'tab_tab_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}}' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tab_tab_shadow',
                'label' => __( 'Box Shadow', '' ),
                'selector' => '{{WRAPPER}}',
                'separator' =>'before',
            ]
        );
        
         $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tab_tab_background',
                'label' => __( 'Background', 'landshopcore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}}',
                'separator' =>'before',
            ]
        );
        $this->end_controls_section(); // post section style end                        
        // Tab Style Tab section
        $this->start_controls_section(
            'tab_tab_section',
            [
                'label' => __( 'Tab Menu', 'landshopcore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'tab_menu_align',
            [
                'label' => __( 'Alignment', 'landshopcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Left', 'landshopcore' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'landshopcore' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => __( 'Right', 'landshopcore' ),
                        'icon' => 'fa fa-align-right',
                    ],
                    'space-between' => [
                        'title' => __( 'Justified', 'landshopcore' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .landshopcore-arrow-nav' => 'display: flex; justify-content: {{VALUE}};',
                ],
                'default' => 'center'
            ]
        );
        $this->add_responsive_control(
            'tab_menu_width',
            [
                'label' => __( 'Width', 'landshopcore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 9999,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .landshopcore-arrow-nav' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'tab_menu_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .landshopcore-arrow-nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_responsive_control(
            'tab_menu_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .landshopcore-arrow-nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tab_menu_area_border',
                'label' => __( 'Border', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .landshopcore-arrow-nav',
            ]
        );
        $this->add_responsive_control(
            'tab_menu_area_radius',
            [
                'label' => esc_html__( 'Box Radius', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .landshopcore-arrow-nav' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tab_menu_area_shadow',
                'selector' => '{{WRAPPER}} .landshopcore-arrow-nav',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tab_menu_area_background',
                'label' => __( 'Background', 'landshopcore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .landshopcore-arrow-nav',
            ]
        );
        
        $this->add_control(
            'tab_menu_list_title_sc',
            [
                'label'     => __( 'Tab Menu Item Style', 'landshopcore' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->start_controls_tabs('box_tab_style_tab');
        
        $this->start_controls_tab( 'box_tab_normal',
            [
                'label' => __( 'Normal', 'landshopcore' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tab_tab_typography',
                'selector' => '{{WRAPPER}} .landshopcore-arrow-nav .nav-link',
            ]
        );
        $this->add_control(
            'tab_color',
            [
                'label' => __( 'Color', 'landshopcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .landshopcore-arrow-nav .nav-link' => 'color: {{VALUE}};'
                ],
            ]
        );
         $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tab_bg_color',
                'label' => __( 'Background', 'landshopcore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .landshopcore-arrow-nav .nav-link',
                'separator' =>'before',
            ]
        );
        $this->add_responsive_control(
            'tab_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .landshopcore-arrow-nav .nav-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'tab_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .landshopcore-arrow-nav .nav-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );  
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tab_menu_border',
                'label' => __( 'Border', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .landshopcore-arrow-nav .nav-link',
            ]
        );
        $this->add_responsive_control(
            'tab_menu_border_radius',
            [
                'label' => esc_html__( 'Box Radius', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .landshopcore-arrow-nav .nav-link' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $this->add_control(
            'tab_item_transition',
            [
                'label' => __( 'Transition Duration', 'landshopcore' ),
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
                    '{{WRAPPER}} .landshopcore-arrow-nav .nav-link' => 'transition-duration: {{SIZE}}s',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'tab_item_width',
            [
                'label' => __( 'Width', 'landshopcore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 9999,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .landshopcore-arrow-nav .nav-link' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'tab_item_height',
            [
                'label' => __( 'Height', 'landshopcore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 9999,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .landshopcore-arrow-nav .nav-link' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'tab_item_line_height',
            [
                'label' => __( 'Line Height', 'landshopcore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 9999,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .landshopcore-arrow-nav .nav-link' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tab_item_shadow',
                'label' => __( 'Box Shadow', '' ),
                'selector' => '{{WRAPPER}} .landshopcore-arrow-nav .nav-link',
                'separator' =>'before',
            ]
        );
        $this->end_controls_tab(); // Hover Style Tab end
        $this->start_controls_tab( 'tab_items_hover',
            [
                'label' => __( 'Hover', 'landshopcore' ),
            ]
        );    
        
        $this->add_control(
            'hover_tab_color',
            [
                'label' => __( 'Color', 'landshopcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .landshopcore-arrow-nav .nav-link:hover' => 'color: {{VALUE}};'
                ],
            ]
        );
        
         $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'hover_tab_bg_color',
                'label' => __( 'Background', 'landshopcore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .landshopcore-arrow-nav .nav-link:hover',
                'separator' =>'before',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tab_menu_active_border',
                'label' => __( 'Border', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .landshopcore-arrow-nav .nav-link:hover',
            ]
        );
        
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tab_item_active_shadow',
                'label' => __( 'Box Shadow', '' ),
                'selector' => '{{WRAPPER}} .landshopcore-arrow-nav .nav-link:hover',
                'separator' =>'before',
            ]
        );
        $this->end_controls_tab(); // Hover Style Tab end
      
        $this->start_controls_tab( 'tab_items_focus',
            [
                'label' => __( 'Focus', 'landshopcore' ),
            ]
        );    
        
        $this->add_control(
            'focus_tab_color',
            [
                'label' => __( 'Color', 'landshopcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .landshopcore-arrow-nav .nav-link:focus' => 'color: {{VALUE}};'
                ],
            ]
        );
        
         $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'focus_tab_bg_color',
                'label' => __( 'Background', 'landshopcore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .landshopcore-arrow-nav .nav-link:focus',
                'separator' =>'before',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tab_menu_focus_border',
                'label' => __( 'Border', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .landshopcore-arrow-nav .nav-link:focus',
            ]
        );
        
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tab_item_focus_shadow',
                'label' => __( 'Box Shadow', '' ),
                'selector' => '{{WRAPPER}} .landshopcore-arrow-nav .nav-link:focus',
                'separator' =>'before',
            ]
        );
        $this->end_controls_tab(); // Hover Style Tab end
        $this->end_controls_tabs();// Box Style tabs end
        $this->end_controls_section();
    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();
        $html_output = '';
        $this->add_render_attribute( 'landshop_arrow_attr', 'class', 'landshop-custom-arrow' );
        $this->add_render_attribute( 'landshop_arrow_attr', 'id', 'slider-arrow-'.$settings['slider_target_id'] );
        $html_output .= '<div '.$this->get_render_attribute_string( 'landshop_arrow_attr' ).'>';
            $html_output .= '<div class="landshopcore-arrow-nav">';
                $html_output .= '<button class="nav-link prev-action" type="button">';
                    if( $settings['prev_icon_type'] == 'img' and !empty(Group_Control_Image_Size::get_attachment_image_html( $settings, 'prev_imagesize', 'prev_image_icon' )) ){
                        $prev_image = Group_Control_Image_Size::get_attachment_image_html( $settings, 'prev_imagesize', 'prev_image_icon' );  
                        $html_output .= '<span class="x-icon">'.$prev_image.'</dspaniv>';
                    }elseif( $settings['prev_icon_type'] == 'icon' && !empty($settings['prev_font_icon']['value']) ){
                        $html_output .= sprintf( '<span class="x-icon" >%1$s</span>', landshop_icon_manager::render_icon( $settings['prev_font_icon'], [ 'aria-hidden' => 'true' ] ) );
                    }elseif( $settings['prev_icon_type'] == 'text' && !empty($settings['prev_arrow_text']) ){
                        $html_output .= '<span class="text" >'.esc_html($settings['prev_arrow_text']).'</span>';
                    }
                $html_output .= '</button>';
                $html_output .= '<button class="nav-link next-action" type="button" >';        
                    if( $settings['next_icon_type'] == 'img' and !empty(Group_Control_Image_Size::get_attachment_image_html( $settings, 'next_imagesize', 'next_image_icon' )) ){
                        $next_image = Group_Control_Image_Size::get_attachment_image_html( $settings, 'next_imagesize', 'next_image_icon' );  
                        $html_output .= '<span class="x-icon">'.$next_image.'</dspaniv>';
                    }elseif( $settings['next_icon_type'] == 'icon' && !empty($settings['next_font_icon']['value']) ){
                        $html_output .= sprintf( '<span class="x-icon" >%1$s</span>', landshop_icon_manager::render_icon( $settings['next_font_icon'], [ 'aria-hidden' => 'true' ] ) );
                    }elseif( $settings['next_icon_type'] == 'text' && !empty($settings['next_arrow_text']) ){
                        $html_output .= '<span class="text" >'.esc_html($settings['next_arrow_text']).'</span>';
                    }
                $html_output .= '</button>';
            $html_output .= '</div>';
        $html_output .= '</div>';
        echo $html_output;
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new landshop_Elementor_Widget_Slider_Arrow );