<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Codexse_Elementor_Widget_Icon_Box extends Widget_Base{

	public function get_name(){
		return "codexse-icon-box";
	}    
    
	public function get_title(){
		return __( 'Icon Box','codexse' );
	}
    
	public function get_categories() {
		return [ 'codexse-addons' ];
	}
    
	public function get_icon() {
		return 'codexse-icon eicon-icon-box';
	}

    public function get_style_depends(){
        return [
            'codexse-icon-box',
        ];
    }

    protected function  register_controls(){
        $this->start_controls_section(
            'icon_box_section',
            [
                'label' => __( 'Icon Box', 'codexse' ),
            ]
        );                                                                                                                                                  
                                                                                                                                                                    
        $this->add_control(                                                                                                                                     
            'icon_box_style',                                                                                                                              
            [                                                                                                                                                   
                'label' => __( 'Style', 'codexse-addons' ),                                                                                                     
                'type' => 'select',                                                                                                                             
                'default' => '1',                                                                                                                               
                'options' => [                                                                                                                                  
                    '1'   => __( 'Style One', 'codexse-addons' ),                                                                                               
                    '2'   => __( 'Style Two', 'codexse-addons' ),                                                                                               
                    '3'   => __( 'Style Three', 'codexse-addons' ),                                                                                             
                    '4'   => __( 'Style Four', 'codexse-addons' ),                                                                                              
                    '5'   => __( 'Style Five', 'codexse-addons' ),                                                                                              
                    '6'   => __( 'Style Six', 'codexse-addons' ),                                                                                               
                    '7'   => __( 'Style Seven', 'codexse-addons' ),                                                                                             
                ],                                                                                                                                              
            ]                                                                                                                                                   
        );   
        
        $this->add_control(
            'icon_type',
            [
                'label' => __('Icon Type','codexse'),
                'type' =>Controls_Manager::CHOOSE,
                'options' =>[
                    'img' =>[
                        'title' =>__('Image','codexse'),
                        'icon' =>'eicon-image-bold',
                    ],
                    'icon' =>[
                        'title' =>__('Icon','codexse'),
                        'icon' =>'eicon-icon-box',
                    ],
                    'text' =>[
                        'title' =>__('Text','codexse'),
                        'icon' =>'eicon-animation-text',
                    ],
                ],
                'default' => 'icon',
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __('Image','codexse'),
                'type'=>Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'icon_type' => 'img',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'imagesize',
                'default' => 'large',
                'separator' => 'none',
                'condition' => [
                    'icon_type' => 'img',
                ]
            ]
        );

        $this->add_control(
            'icon_box_icon',
            [
                'label'       => __( 'Icon', 'codexse-addons' ),
                'type'        => Controls_Manager::ICONS,
                'label_block' => true,
                'condition' => [
                    'icon_type' => 'icon',
                ]
            ]
        );

        $this->add_control(
            'icon_text',
            [
                'label' => __( 'Text', 'codexse' ),
                'type'=>Controls_Manager::TEXT,
				'default' => __( '1','codexse' ),
				'condition' => [
					'icon_type' => 'text'
				]
            ]
        );
        $this->add_control(
            'icon_box_title',
            [
                'label' => __( 'Title', 'codexse' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Educations for Children','codexse' ),
                'placeholder' => __( 'Title', 'codexse' ),
            ]
        );        

        $this->add_control(
            'title_link',
            [
                'label' => __( 'Link', 'codexse' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'codexse' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ]
            ]
        ); 
        
        $this->add_control(
            'icon_box_content',
            [
                'label' => __( 'Description', 'codexse' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incidi.','codexse' ),
                'placeholder' => __( 'Enter type your description...', 'codexse' ),
            ]
        );
                
		$this->add_control(
			'read_switch',
			[
				'label' => __( 'Read More', 'codexse' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'codexse' ),
				'label_off' => __( 'Hide', 'codexse' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
        
                
        
        $this->add_control(
            'button_icon_type',
            [
                'label' => __('Button Icon Type','codexse'),
                'type' =>Controls_Manager::CHOOSE,
                'options' =>[
                    'img' =>[
                        'title' =>__('Image','codexse'),
                        'icon' =>'eicon-image-bold',
                    ],
                    'icon' =>[
                        'title' =>__('Icon','codexse'),
                        'icon' =>'eicon-icon-box',
                    ],
                    'text' =>[
                        'title' =>__('Text','codexse'),
                        'icon' =>'eicon-animation-text',
                    ],
                ],
                'default' => 'text',
                'condition' => [
					'read_switch' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'button_image',
            [
                'label' => __('Image','codexse'),
                'type'=>Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'button_icon_type' => 'img',
					'read_switch' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'button_imagesize',
                'default' => 'large',
                'separator' => 'none',
                'condition' => [
                    'button_icon_type' => 'img',
					'read_switch' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'button_icon',
            [
                'label'       => __( 'Icon', 'codexse-addons' ),
                'type'        => Controls_Manager::ICONS,
                'label_block' => true,
                'condition' => [
                    'button_icon_type' => 'icon',
					'read_switch' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'read_more_button_text',
            [
                'label' => __( 'Text', 'codexse' ),
                'type'=>Controls_Manager::TEXT,
				'default' => __( '1','codexse' ),
				'condition' => [
					'button_icon_type' => 'text',
					'read_switch' => 'yes'
				]
            ]
        );

        $this->add_control(
            'read_more_link',
            [
                'label' => __( 'Link', 'codexse' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'codexse' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
				'condition' => [
					'read_switch' => 'yes'
				]
            ]
        ); 
        

        $this->end_controls_section();
        
        // Icon Box Style tab section
        $this->start_controls_section(
            'codexse_icon_box_style_section',
            [
                'label' => __( 'Icon Box', 'codexse' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->start_controls_tabs('icon_box_style_tab');
        $this->start_controls_tab( 'icon_box_normal',
			[
				'label' => __( 'Normal', 'codexse' ),
			]
		);
        
        $this->add_responsive_control(
            'icon_box_margin',
            [
                'label' => __( 'Margin', 'codexse' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'icon_box_padding',
            [
                'label' => __( 'Padding', 'codexse' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_box_background',
                'label' => __( 'Background', 'codexse' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .codexse-icon-box',
            ]
        );

        $this->add_responsive_control(
            'icon_box_text_align',
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
                    'justify' => [
                        'title' => __( 'Justified', 'codexse' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box' => 'text-align: {{VALUE}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_box_border',
                'label' => __( 'Border', 'codexse' ),
                'selector' => '{{WRAPPER}} .codexse-icon-box',
            ]
        );
        $this->add_responsive_control(
            'icon_box_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'codexse' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_box_shadow',
                'label' => __( 'Box Shadow', 'codexse' ),
                'selector' => '{{WRAPPER}} .codexse-icon-box',
            ]
        );

        
        $this->add_control(
			'icon_box_transform',
			[
				'label' => __( 'Transform', 'codexse' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'translateY(0)',
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-box' => 'transform: {{VALUE}}',
				],
			]
		);
        
		$this->add_control(
			'icon_box_transition',
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
					'{{WRAPPER}} .codexse-icon-box' => 'transition-duration: {{SIZE}}s',
				],
			]
		);
		$this->end_controls_tab();

             
        // Hover Style tab Start
        $this->start_controls_tab(
            'icon_box_hover',
            [
                'label' => __( 'Hover', 'codexse' ),
            ]
        );
        
        
              
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_box_hover_background',
                'label' => __( 'Background', 'codexse' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .codexse-icon-box:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_box_border_hover',
                'label' => __( 'Border', 'codexse' ),
                'selector' => '{{WRAPPER}} .codexse-icon-box:hover',
            ]
        );
        $this->add_responsive_control(
            'icon_box_hover_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'codexse' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_box_hover_shadow',
                'label' => __( 'Box Shadow', 'codexse' ),
                'selector' => '{{WRAPPER}} .codexse-icon-box:hover',
            ]
        );
        $this->add_control(
			'icon_box_hover_transform',
			[
				'label' => __( 'Transform', 'codexse' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'translateY(0)',
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-box:hover' => 'transform: {{VALUE}}',
				],
			]
		);
        
        $this->end_controls_tab(); // Hover Style tab end        
        $this->end_controls_tabs();// Box Style tabs end  
        $this->end_controls_section(); // Icon Box section style end
        
        
        // Icon Style tab section
        $this->start_controls_section(
            'box_icon_section',
            [
                'label' => __( 'Icon', 'codexse' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->start_controls_tabs('box_icon_style_tab');
        
        $this->start_controls_tab( 'box_icon_normal',
			[
				'label' => __( 'Normal', 'codexse' ),
			]
		);        
        
		$this->add_responsive_control(
			'icon_width',
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
					'{{WRAPPER}} .codexse-icon-box .icon' => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);        
        
		$this->add_responsive_control(
			'icon_height',
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
					'{{WRAPPER}} .codexse-icon-box .icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_line_height',
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
					'{{WRAPPER}} .codexse-icon-box .icon' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __( 'Size', 'codexse' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],           
                'condition' => [
                    'icon_type!' => 'text',
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'icon_typography',
                'selector' => '{{WRAPPER}} .codexse-icon-box .icon',                
                'condition' => [
                    'icon_type' => 'text',
                ]
            ]
        );
        
        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Color', 'codexse' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box .icon' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_background',
                'label' => __( 'Background', 'codexse' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .codexse-icon-box .icon',
            ]
        );        
         $this->add_responsive_control(
            'icon_floting',
            [
                'label' => __( 'Float', 'codexse' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-direction: row;' => [
                        'title' => __( 'Left', 'codexse' ),
                        'icon' => 'eicon-arrow-left',
                    ],
                    'flex-direction: column;' => [
                        'title' => __( 'Top', 'codexse' ),
                        'icon' => 'eicon-arrow-up',
                    ],
                    'flex-direction: row-reverse;' => [
                        'title' => __( 'Right', 'codexse' ),
                        'icon' => 'eicon-arrow-right',
                    ],
                    'flex-direction: column-reverse;' => [
                        'title' => __( 'Bottom', 'codexse' ),
                        'icon' => 'eicon-arrow-down',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box' => 'display: flex; {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_alignment',
            [
                'label' => __( 'Alignment', 'codexse' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'justify-content: flex-start; align-items: flex-start;' => [
                        'title' => __( 'Start', 'codexse' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'justify-content: center; align-items: center;' => [
                        'title' => __( 'Center', 'codexse' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'justify-content: flex-end; align-items: flex-end;' => [
                        'title' => __( 'End', 'codexse' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box' => '{{VALUE}}',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_responsive_control(
            'icon_margin',
            [
                'label' => __( 'Margin', 'codexse' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'icon_padding',
            [
                'label' => __( 'Padding', 'codexse' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'label' => __( 'Border', 'codexse' ),
                'selector' => '{{WRAPPER}} .codexse-icon-box .icon',
            ]
        );
        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'codexse' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
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
                    '{{WRAPPER}} .codexse-icon-box .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_shadow',
                'label' => __( 'Box Shadow', 'codexse' ),
                'selector' => '{{WRAPPER}} .codexse-icon-box .icon',
            ]
        );        
        $this->add_control(
			'box_icon_transition',
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
					'{{WRAPPER}} .codexse-icon-box .icon' => 'transition-duration: {{SIZE}}s',
				],
			]
		);
        $this->end_controls_tab(); // Hover Style tab end
        $this->start_controls_tab( 'box_icon_hover',
			[
				'label' => __( 'Hover', 'codexse' ),
			]
		);        
        $this->add_control(
            'hover_icon_color',
            [
                'label' => __( 'Hover Color', 'codexse' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box:hover .icon' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'hover_icon_background',
                'label' => __( 'Background', 'codexse' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .codexse-icon-box:hover .icon',
            ]
        );               
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'hover_icon_border',
                'label' => __( 'Border', 'codexse' ),
                'selector' => '{{WRAPPER}} .codexse-icon-box:hover .icon',
            ]
        );
        $this->add_responsive_control(
            'hover_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'codexse' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
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
                    '{{WRAPPER}} .codexse-icon-box:hover .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hover_icon_shadow',
                'label' => __( 'Box Shadow', 'codexse' ),
                'selector' => '{{WRAPPER}} .codexse-icon-box:hover .icon',
            ]
        );        
        
        $this->end_controls_tab(); // Hover Style tab end
        $this->end_controls_tabs();// Box Style tabs end  
        $this->end_controls_section();
                
        // Icon Box Style tab section
        $this->start_controls_section(
            'box_title_section',
            [
                'label' => __( 'Title', 'codexse' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->start_controls_tabs('box_title_style_tab');
        
        $this->start_controls_tab( 'box_title_normal',
			[
				'label' => __( 'Normal', 'codexse' ),
			]
		);        
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'icon_box_title_typography',
                'selector' => '{{WRAPPER}} .codexse-icon-box .title',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'codexse' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box .title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => __( 'Margin', 'codexse' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => __( 'Padding', 'codexse' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
                
		$this->add_control(
			'icon_box_title_transition',
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
					'{{WRAPPER}} .codexse-icon-box .title' => 'transition-duration: {{SIZE}}s',
				],
			]
		);
        
        $this->end_controls_tab(); // Hover Style tab end
         
        $this->start_controls_tab( 'title_hover_tab',
			[
				'label' => __( 'Hover', 'codexse' ),
			]
		);        
        
        $this->add_control(
            'title_hover_color',
            [
                'label' => __( 'Color', 'codexse' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box .title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_tab(); // Hover Style tab end
        $this->start_controls_tab( 'box_title_hover_tab',
			[
				'label' => __( 'Box Hover', 'codexse' ),
			]
		);        
        
        $this->add_control(
            'box_hover_title_color',
            [
                'label' => __( 'Color', 'codexse' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box:hover .title' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_tab(); // Hover Style tab end
        $this->end_controls_tabs();// Box Style tabs end  
        $this->end_controls_section();
         
        
        // Icon Box Style tab section
        $this->start_controls_section(
            'box_content_section',
            [
                'label' => __( 'Content', 'codexse' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs('box_content_style_tab');
        
        $this->start_controls_tab( 'box_content_normal',
			[
				'label' => __( 'Normal', 'codexse' ),
			]
		);        
        
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'icon_box_content_typography',
                'selector' => '{{WRAPPER}} .codexse-icon-box .description',
            ]
        );
        $this->add_control(
            'content_color',
            [
                'label' => __( 'Color', 'codexse' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box .description' => 'color: {{VALUE}};',
                ],
            ]
        );
                
        $this->add_responsive_control(
            'content_margin',
            [
                'label' => __( 'Margin', 'codexse' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __( 'Padding', 'codexse' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
		$this->add_control(
			'icon_box_content_transition',
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
					'{{WRAPPER}} .codexse-icon-box .description' => 'transition-duration: {{SIZE}}s',
				],
			]
		);
        
        $this->end_controls_tab(); // Hover Style tab end
         
        $this->start_controls_tab( 'content_hover_tab',
			[
				'label' => __( 'Hover', 'codexse' ),
			]
		);        
        
        $this->add_control(
            'content_hover_color',
            [
                'label' => __( 'Color', 'codexse' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box .description:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_tab(); // Hover Style tab end
        $this->start_controls_tab( 'box_content_hover_tab',
			[
				'label' => __( 'Box Hover', 'codexse' ),
			]
		);        
        
        $this->add_control(
            'box_hover_content_color',
            [
                'label' => __( 'Color', 'codexse' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box:hover .description' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_tab(); // Hover Style tab end
        $this->end_controls_tabs();// Box Style tabs end 
        $this->end_controls_section();
        
        // Read-More Style tab section
        $this->start_controls_section(
            'read_more_style_section',
            [
                'label' => __( 'Read More', 'codexse' ),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'read_switch' => 'yes'
				]
            ]
        );
        
        $this->start_controls_tabs('read_more_style_tab');
        
        $this->start_controls_tab( 'read_more_normal',
			[
				'label' => __( 'Normal', 'codexse' ),
			]
		);        
        
        $this->add_control(
			'read_more_width',
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
					'{{WRAPPER}} .codexse-icon-box .read-more-link' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);        
        
		$this->add_control(
			'button_height',
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
					'{{WRAPPER}} .codexse-icon-box .read-more-link' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
		$this->add_control(
			'button_line_height',
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
					'{{WRAPPER}} .codexse-icon-box .read-more-link' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .codexse-icon-box .read-more-link',
            ]
        );
        $this->add_control(
            'button_color',
            [
                'label' => __( 'Color', 'codexse' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box .read-more-link' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_background',
            [
                'label' => __( 'Background Color', 'codexse' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box .read-more-link' => 'background-color: {{VALUE}};',
                ],
            ]
        );
         $this->add_responsive_control(
            'button_text_align',
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
                    'justify' => [
                        'title' => __( 'Justified', 'codexse' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box .read-more-link' => 'text-align: {{VALUE}};',
                ],
                'separator' =>'before',
            ]
        );
                
        $this->add_responsive_control(
            'button_margin',
            [
                'label' => __( 'Margin', 'codexse' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box .read-more-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'codexse' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box .read-more-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => __( 'Border', 'codexse' ),
                'selector' => '{{WRAPPER}} .codexse-icon-box .read-more-link',
            ]
        );
        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'codexse' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
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
                    '{{WRAPPER}} .codexse-icon-box .read-more-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_shadow',
                'label' => __( 'Box Shadow', 'codexse' ),
                'selector' => '{{WRAPPER}} .codexse-icon-box .read-more-link',
            ]
        );        
        $this->add_control(
			'box_button_transition',
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
					'{{WRAPPER}} .codexse-icon-box .read-more-link' => 'transition-duration: {{SIZE}}s',
				],
			]
		);    
        
            $this->add_responsive_control(
                'ex_icon_z_index',
                [
                    'label' => __( 'Z Index', 'maruncycore' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => -100,
                    'max' => 100,
                    'step' => 1,
                    'selectors' => [
                        '{{WRAPPER}} .codexse-icon-box .read-more-link' => 'z-index: {{SIZE}};',
                    ],
                ]
            );
        
            $this->add_control(
                '_tst_position',
                [
                    'label' => esc_html__( 'Position', 'elementor' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__( 'Default', 'elementor' ),
                        'absolute' => esc_html__( 'Absolute', 'elementor' ),
                        'fixed' => esc_html__( 'Fixed', 'elementor' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .codexse-icon-box .read-more-link' => 'position: {{VALUE}};',
                    ],
                ]
            );

            $start = is_rtl() ? esc_html__( 'Right', 'elementor' ) : esc_html__( 'Left', 'elementor' );
            $end = ! is_rtl() ? esc_html__( 'Right', 'elementor' ) : esc_html__( 'Left', 'elementor' );

            $this->add_control(
                '_tst_offset_orientation_h',
                [
                    'label' => esc_html__( 'Horizontal Orientation', 'elementor' ),
                    'type' => Controls_Manager::CHOOSE,
                    'toggle' => false,
                    'default' => 'start',
                    'options' => [
                        'start' => [
                            'title' => $start,
                            'icon' => 'eicon-h-align-left',
                        ],
                        'end' => [
                            'title' => $end,
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'classes' => 'elementor-control-start-end',
                    'render_type' => 'ui',
                    'condition' => [
                        '_tst_position!' => '',
                    ],
                ]
            );

            $this->add_responsive_control(
                '_tst_offset_x',
                [
                    'label' => esc_html__( 'Offset', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => -200,
                            'max' => 200,
                        ],
                        'vw' => [
                            'min' => -200,
                            'max' => 200,
                        ],
                        'vh' => [
                            'min' => -200,
                            'max' => 200,
                        ],
                    ],
                    'default' => [
                        'size' => '0',
                    ],
                    'size_units' => [ 'px', '%', 'vw', 'vh' ],
                    'selectors' => [
                        'body:not(.rtl) {{WRAPPER}} .codexse-icon-box .read-more-link' => 'left: {{SIZE}}{{UNIT}}',
                        'body.rtl {{WRAPPER}} .codexse-icon-box .read-more-link' => 'right: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        '_tst_offset_orientation_h!' => 'end',
                        '_tst_position!' => '',
                    ],
                ]
            );

            $this->add_responsive_control(
                '_tst_offset_x_end',
                [
                    'label' => esc_html__( 'Offset', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                            'step' => 0.1,
                        ],
                        '%' => [
                            'min' => -200,
                            'max' => 200,
                        ],
                        'vw' => [
                            'min' => -200,
                            'max' => 200,
                        ],
                        'vh' => [
                            'min' => -200,
                            'max' => 200,
                        ],
                    ],
                    'default' => [
                        'size' => '0',
                    ],
                    'size_units' => [ 'px', '%', 'vw', 'vh' ],
                    'selectors' => [
                        'body:not(.rtl) {{WRAPPER}} .codexse-icon-box .read-more-link' => 'right: {{SIZE}}{{UNIT}}',
                        'body.rtl {{WRAPPER}} .codexse-icon-box .read-more-link' => 'left: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        '_tst_offset_orientation_h' => 'end',
                        '_tst_position!' => '',
                    ],
                ]
            );

            $this->add_control(
                '_tst_offset_orientation_v',
                [
                    'label' => esc_html__( 'Vertical Orientation', 'elementor' ),
                    'type' => Controls_Manager::CHOOSE,
                    'toggle' => false,
                    'default' => 'start',
                    'options' => [
                        'start' => [
                            'title' => esc_html__( 'Top', 'elementor' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'end' => [
                            'title' => esc_html__( 'Bottom', 'elementor' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'render_type' => 'ui',
                    'condition' => [
                        '_tst_position!' => '',
                    ],
                ]
            );

            $this->add_responsive_control(
                '_tst_offset_y',
                [
                    'label' => esc_html__( 'Offset', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => -200,
                            'max' => 200,
                        ],
                        'vh' => [
                            'min' => -200,
                            'max' => 200,
                        ],
                        'vw' => [
                            'min' => -200,
                            'max' => 200,
                        ],
                    ],
                    'size_units' => [ 'px', '%', 'vh', 'vw' ],
                    'default' => [
                        'size' => '0',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .codexse-icon-box .read-more-link' => 'top: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        '_tst_offset_orientation_v!' => 'end',
                        '_tst_position!' => '',
                    ],
                ]
            );

            $this->add_responsive_control(
                '_tst_offset_y_end',
                [
                    'label' => esc_html__( 'Offset', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => -200,
                            'max' => 200,
                        ],
                        'vh' => [
                            'min' => -200,
                            'max' => 200,
                        ],
                        'vw' => [
                            'min' => -200,
                            'max' => 200,
                        ],
                    ],
                    'size_units' => [ 'px', '%', 'vh', 'vw' ],
                    'default' => [
                        'size' => '0',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .codexse-icon-box .read-more-link' => 'bottom: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        '_tst_offset_orientation_v' => 'end',
                        '_tst_position!' => '',
                    ],
                ]
            );
        $this->end_controls_tab(); // Hover Style tab end
        
        
        
        $this->start_controls_tab( 'box_hover_button_tab',
			[
				'label' => __( 'Box Hover', 'codexse' ),
			]
		);        
        $this->add_control(
            'box_hover_button_color',
            [
                'label' => __( 'Color', 'codexse' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box:hover .read-more-link' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'box_hover_button_background',
            [
                'label' => __( 'Background Color', 'codexse' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box:hover .read-more-link' => 'background-color: {{VALUE}};',
                ],
            ]
        );             
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_hover_button_border',
                'label' => __( 'Border', 'codexse' ),
                'selector' => '{{WRAPPER}} .codexse-icon-box:hover .read-more-link',
            ]
        );
        $this->add_responsive_control(
            'box_hover_button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'codexse' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
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
                    '{{WRAPPER}} .codexse-icon-box:hover .read-more-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_hover_button_shadow',
                'label' => __( 'Box Shadow', 'codexse' ),
                'selector' => '{{WRAPPER}} .codexse-icon-box:hover .read-more-link',
            ]
        );
        $this->end_controls_tab(); // Hover Style tab end
        
        $this->start_controls_tab( 'box_button_hover',
			[
				'label' => __( 'Hover', 'codexse' ),
			]
		);        
        $this->add_control(
            'hover_button_color',
            [
                'label' => __( 'Color', 'codexse' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box .read-more-link:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'hover_button_background',
            [
                'label' => __( 'Background Color', 'codexse' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-box .read-more-link:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );             
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'hover_button_border',
                'label' => __( 'Border', 'codexse' ),
                'selector' => '{{WRAPPER}} .codexse-icon-box .read-more-link:hover',
            ]
        );
        $this->add_responsive_control(
            'hover_button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'codexse' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
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
                    '{{WRAPPER}} .codexse-icon-box .read-more-link:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hover_button_shadow',
                'label' => __( 'Box Shadow', 'codexse' ),
                'selector' => '{{WRAPPER}} .codexse-icon-box .read-more-link:hover',
            ]
        );
        $this->end_controls_tab(); // Hover Style tab end
        $this->end_controls_tabs();// Box Style tabs end  
        $this->end_controls_section();
    }
    protected function render() {       
		$settings = $this->get_settings_for_display();        
        $this->add_render_attribute( 'codexse_icon_box_attr', 'class', ['codexse-icon-box', 'box-style-'.$settings['icon_box_style'] ] );            
        
        $html_output = '';
        $html_output .= '<div '.$this->get_render_attribute_string( 'codexse_icon_box_attr' ).' >';        
        if( $settings['icon_type'] == 'img' and !empty(Group_Control_Image_Size::get_attachment_image_html( $settings, 'imagesize', 'image' )) ){
            $image = Group_Control_Image_Size::get_attachment_image_html( $settings, 'imagesize', 'image' );  
            $html_output .= '<div class="icon">'.$image.'</div>';
        }elseif( $settings['icon_type'] == 'icon' && !empty($settings['icon_box_icon']['value']) ){
            $html_output .= sprintf( '<div class="icon" >%1$s</div>', Codexse_Icon_manager::render_icon( $settings['icon_box_icon'], [ 'aria-hidden' => 'true' ] ) );
        }elseif( $settings['icon_type'] == 'text' && !empty($settings['icon_text']) ){
            $html_output .= sprintf( '<div class="icon" >%1$s</div>', $settings['icon_text']);
        }
        $html_output .= '<div class="content">';
        if( !empty($settings['icon_box_title']) ){
            if(!empty($settings['title_link']['url'])){                
                $this->add_render_attribute( 'titlelink', 'href', esc_url($settings['title_link']['url']) );            
                if ( $settings['title_link']['is_external'] ) {
                    $this->add_render_attribute( 'titlelink', 'target', '_blank' );
                }
                if ( !empty( $settings['title_link']['nofollow'] ) ) {
                    $this->add_render_attribute( 'titlelink', 'rel', 'nofollow' );
                }
                $html_output .= '<a '.$this->get_render_attribute_string( 'titlelink' ).' ><h4 class="title">'.esc_html($settings['icon_box_title']).'</h4></a>';
            }else{
                $html_output .= '<h4 class="title">'.esc_html($settings['icon_box_title']).'</h4>';
            }
        }
        if( !empty($settings['icon_box_content']) ){
            $html_output .= '<div class="description">'.wpautop(esc_html($settings['icon_box_content'])).'</div>';
        }		
		// Link Generate
        if ( $settings['read_switch'] == 'yes' ) {            
            $this->add_render_attribute( 'url', 'href', esc_url($settings['read_more_link']['url']) );            
            if ( $settings['read_more_link']['is_external'] ) {
                $this->add_render_attribute( 'url', 'target', '_blank' );
            }
            if ( !empty( $settings['read_more_link']['nofollow'] ) ) {
                $this->add_render_attribute( 'url', 'rel', 'nofollow' );
            }
            $this->add_render_attribute( 'url', 'class', 'read-more-link');
            $html_output .= '<a '.$this->get_render_attribute_string( 'url' ).' >';
                if( $settings['button_icon_type'] == 'img' and !empty(Group_Control_Image_Size::get_attachment_image_html( $settings, 'button_imagesize', 'button_image' )) ){
                    $html_output .= '<span class="icon">'.Group_Control_Image_Size::get_attachment_image_html( $settings, 'button_imagesize', 'button_image' ).'</span>';
                }elseif( $settings['button_icon_type'] == 'icon' && !empty($settings['button_icon']['value']) ){
                    $html_output .= sprintf( '<span class="icon" >%1$s</span>', codexse_icon_manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] ) );
                }elseif( $settings['button_icon_type'] == 'text' && !empty($settings['read_more_button_text']) ){
                    $html_output .= sprintf( '<span class="icon" >%1$s</span>', $settings['read_more_button_text']);
                }
            $html_output .= '</a>';
        }
        $html_output .= '</div>';        
        $html_output .= '</div>';        
        echo $html_output;        
	}

}
Plugin::instance()->widgets_manager->register_widget_type( new Codexse_Elementor_Widget_Icon_Box );