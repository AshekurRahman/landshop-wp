<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class landshop_Elementor_Widget_Tabs extends Widget_Base {

    public function get_name() {
        return 'landshop-tab-addons';
    }
    
    public function get_title() {
        return __( 'Tabs', 'landshopcore' );
    }

	public function get_icon() {
		return "landshop-icon eicon-tabs";
	}
    
	public function get_categories() {
		return [ 'landshopcore' ];
	} 
    
	public function get_keywords() {
		return [ 'tabs', 'accordion', 'toggle' ];
	}

    public function get_script_depends() {
        return [
            'bootstrap-js',
        ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'tab_content',
            [
                'label' => __( 'Tabs', 'landshopcore' ),
            ]
        );
            
            $this->add_control(
                'menu_position',
                [
                    'label'   => esc_html__( 'Menu Position', 'landshopcore' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'top',
                    'options' => [
                        'top'   => esc_html__( 'Top', 'landshopcore' ),
                        'left'  => esc_html__( 'Left', 'landshopcore' ),
                        'right' => esc_html__( 'Right', 'landshopcore' ),
                    ],
                ]
            );    
            
            $this->add_control(
                'menu_style',
                [
                    'label'   => esc_html__( 'Menu Style', 'landshopcore' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'style1',
                    'options' => [
                        'style1' => esc_html__( 'Style 1', 'landshopcore' ),
                        'style2' => esc_html__( 'Style 2', 'landshopcore' ),
                        'style3' => esc_html__( 'Normal', 'landshopcore' ),
                    ],
                ]
            );    
            $repeater = new Repeater();
            $repeater->start_controls_tabs('tab_content_item_area_tabs');

                $repeater->start_controls_tab(
                    'tab_content_item_area',
                    [
                        'label' => __( 'Content', 'landshopcore' ),
                    ]
                );
                    
                    $repeater->add_control(
                        'tab_title',
                        [
                            'label'   => esc_html__( 'Title', 'landshopcore' ),
                            'type'    => Controls_Manager::TEXT,
                            'default' => esc_html__( 'Tab #1', 'landshopcore' ),
                        ]
                    );

                    $repeater->add_control(
                        'icon_type',
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
                            ],
                            'default' => 'icon',
                        ]
                    );

                    $repeater->add_control(
                        'image',
                        [
                            'label' => __('Image','landshopcore'),
                            'type'=>Controls_Manager::MEDIA,
                            'default' => [
                                'url' => Utils::get_placeholder_image_src(),
                            ],
                            'condition' => [
                                'icon_type' => 'img',
                            ]
                        ]
                    );

                    $repeater->add_group_control(
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

                    $repeater->add_control(
                        'feature_icon',
                        [
                            'label'       => __( 'Icon', 'landshopcore-addons' ),
                            'type'        => Controls_Manager::ICONS,
                            'label_block' => true,
                            'condition' => [
                                'icon_type' => 'icon',
                            ]
                        ]
                    );

                    $repeater->add_control(
                        'content_source',
                        [
                            'label'   => esc_html__( 'Select Content Source', 'landshopcore' ),
                            'type'    => Controls_Manager::SELECT,
                            'default' => 'custom',
                            'options' => [
                                'custom'    => esc_html__( 'Content', 'landshopcore' ),
                                "elementor" => esc_html__( 'Template', 'landshopcore' ),
                            ],
                        ]
                    );

                     $repeater->add_control(
                        'template_id',
                        [
                            'label'       => __( 'Content', 'landshopcore' ),
                            'type'        => Controls_Manager::SELECT,
                            'default'     => '0',
                            'options'     => landshop_elementor_template(),
                            'condition'   => [
                                'content_source' => "elementor"
                            ],
                        ]
                    );

                     $repeater->add_control(
                        'custom_content',
                        [
                            'label' => __( 'Content', 'landshopcore' ),
                            'type' => Controls_Manager::WYSIWYG,
                            'title' => __( 'Content', 'landshopcore' ),
                            'show_label' => false,
                            'condition' => [
                                'content_source' =>'custom',
                            ],
                        ]
                    );

                $repeater->end_controls_tab();// Tab Content area end

                // Style area start
                $repeater->start_controls_tab(
                    'tab_item_style_area',
                    [
                        'label' => __( 'Style', 'landshopcore' ),
                    ]
                );
                    
                    $repeater->add_control(
                        'tab_title_color',
                        [
                            'label'     => esc_html__( 'Title Color', 'landshopcore' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .landshop-tab-nav a{{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    
                    $repeater->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'title_background',
                            'label' => __( 'Background', 'landshopcore' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .landshop-tab-nav a{{CURRENT_ITEM}}',
                        ]
                    );

                    $repeater->add_control(
                        'tab_title_active_color',
                        [
                            'label'     => esc_html__( 'Title Active Color', 'landshopcore' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .landshop-tab-nav li.active a{{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'title_active_background',
                            'label' => __( 'Background', 'landshopcore' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .landshop-tab-nav li.active a{{CURRENT_ITEM}}',
                        ]
                    );

                    $repeater->add_control(
                        'tab_icon_color',
                        [
                            'label'     => esc_html__( 'Icon Color', 'landshopcore' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .landshop-tab-nav a{{CURRENT_ITEM}} .icon' => 'color: {{VALUE}}',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $repeater->add_control(
                        'tab_icon_size',
                        [
                            'label' => __( 'Icon Size', 'landshopcore' ),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'size' => 14,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .landshop-tab-nav a{{CURRENT_ITEM}} .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $repeater->add_control(
                        'tab_icon_active_color',
                        [
                            'label'     => esc_html__( 'Active Icon Color', 'landshopcore' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .landshop-tab-nav li.active a{{CURRENT_ITEM}} .icon' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                $repeater->end_controls_tab(); // Style area end

            $repeater->end_controls_tabs();

            $this->add_control(
                'landshop_tabs_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => array_values( $repeater->get_controls() ),
                    'default' => [
                        [
                            'tab_title' => esc_html__( 'Title #1', 'landshopcore' ),
                            'custom_content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolo magna aliqua. Ut enim ad minim veniam, quis nostrud exerci ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in repre in voluptate.','landshopcore' ),
                        ],
                        [
                            'tab_title' => esc_html__( 'Title #2', 'landshopcore' ),
                            'custom_content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolo magna aliqua. Ut enim ad minim veniam, quis nostrud exerci ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in repre in voluptate.','landshopcore' ),
                        ],
                        [
                            'tab_title' => esc_html__( 'Title #3', 'landshopcore' ),
                            'custom_content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolo magna aliqua. Ut enim ad minim veniam, quis nostrud exerci ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in repre in voluptate.','landshopcore' ),
                        ],
                    ],
                    'title_field' => '{{{ tab_title }}}',
                ]
            );
        
        $this->end_controls_section();
        
        // Style tab area tab section
        $this->start_controls_section(
            'landshop_tab_style_area',
            [
                'label' => __( 'Tab Menu', 'landshopcore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'landshop_tab_section_margin',
                [
                    'label' => __( 'Margin', 'landshopcore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .landshop-tab-nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'landshop_tab_section-padding',
                [
                    'label' => __( 'Padding', 'landshopcore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .landshop-tab-nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );
        
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'landshop_tab_section_bg',
                    'label' => __( 'Background', 'landshopcore' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .landshop-tab-nav',
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'landshop_tab_section_border',
                    'label' => __( 'Border', 'landshopcore' ),
                    'selector' => '{{WRAPPER}} .landshop-tab-nav',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'landshop_tab_section_shadow',
                    'label' => __( 'Box Shadow', 'landshopcore' ),
                    'selector' => '{{WRAPPER}} .landshop-tab-nav',
                ]
            );
            $this->add_responsive_control(
                'landshop_tab_section_width',
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
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .landshop-tab-nav' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'landshop_tab_section_height',
                [
                    'label' => __( 'Height', 'landshopcore' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
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
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .landshop-tab-nav' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        
            $this->add_responsive_control(
                'landshop_tab_section_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'landshopcore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .landshop-tab-nav' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'menu_list_align',
                [
                    'label' => __( 'Alignment', 'landshopcore' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'landshopcore' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'landshopcore' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'landshopcore' ),
                            'icon' => 'fa fa-align-right',
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .landshop-tab-nav' => 'text-align: {{VALUE}};',
                    ],
                    'separator' =>'before',
                ]
            );
        $this->end_controls_section();
        
        
		$this->start_controls_section(
			'tab_button_style_section',
			[
				'label' => __( 'Tab Button', 'landshopcore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_responsive_control(
            'menu_text_align',
            [
                'label' => __( 'Alignment', 'landshopcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'landshopcore' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'landshopcore' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'landshopcore' ),
                        'icon' => 'fa fa-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .landshop-tab-nav .tab-button' => 'text-align: {{VALUE}};',
                ],
                'separator' =>'before',
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_button_typography',
				'selector' => '{{WRAPPER}} .landshop-tab-nav .tab-button',
			]
		);
		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'landshopcore' ),
			]
		);

		$this->add_control(
			'tab_button__color',
			[
				'label' => __( 'Color', 'landshopcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .landshop-tab-nav .tab-button' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_control(
            'landshop_tab_item_width',
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
                ],
                'selectors' => [
                    '{{WRAPPER}} .landshop-tab-nav li' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'tab_button_background_color',
				'label' => __( 'Background', 'landshopcore' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .landshop-tab-nav .tab-button',
			]
		);
        
        $this->add_responsive_control(
            'tab_button_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .landshop-tab-nav .tab-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'tab_button_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .landshop-tab-nav .tab-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );   
        
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tab_button_border',
				'selector' => '{{WRAPPER}} .landshop-tab-nav .tab-button',
			]
		);

        $this->add_control(
			'tab_button_radius',
			[
				'label' => __( 'Border Radius', 'landshopcore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],                
				'selectors' => [
					'{{WRAPPER}} .landshop-tab-nav .tab-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_button_box_shadow',
				'selector' => '{{WRAPPER}} .landshop-tab-nav .tab-button',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'landshopcore' ),
			]
		);

		$this->add_control(
			'tab_button_hover_color',
			[
				'label' => __( 'Color', 'landshopcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .landshop-tab-nav .tab-button:hover, {{WRAPPER}} .landshop-tab-nav li.active .tab-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tab_button_hover_background',
			[
				'label' => __( 'Background Color', 'landshopcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .landshop-tab-nav .tab-button:hover, {{WRAPPER}} .landshop-tab-nav li.active .tab-button' => 'background-color: {{VALUE}};',
				],
			]
		);
        
		$this->add_control(
			'tab_button_hover_border_color',
			[
				'label' => __( 'Border Color', 'landshopcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .landshop-tab-nav .tab-button:hover, {{WRAPPER}} .landshop-tab-nav li.active .tab-button' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .landshop-tab-nav .tab-button:hover, {{WRAPPER}} .landshop-tab-nav li.active .tab-button',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		
		$this->end_controls_section();
        
        $this->start_controls_section(
			'tab_button_icon_section',
			[
				'label' => __( 'Button Icon', 'landshopcore' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
        
        
            $this->add_responsive_control(
                'button_icon_floting',
                [
                    'label' => __( 'Float', 'landshopcore' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'landshopcore' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'none' => [
                            'title' => __( 'Center', 'landshopcore' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'landshopcore' ),
                            'icon' => 'fa fa-align-right',
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .landshop-tab-nav .tab-button .icon' => 'float: {{VALUE}};',
                    ],
                    'separator' =>'before',
                ]
            );
        

        $this->start_controls_tabs( 'tabs_button_icon_style' );

		$this->start_controls_tab(
			'tab_button_icon_normal',
			[
				'label' => __( 'Normal', 'landshopcore' ),
			]
		);
            $this->add_responsive_control(
                'button_icon_margin',
                [
                    'label' => __( 'Margin', 'landshopcore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .landshop-tab-nav .tab-button .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'button_icon_opacity',
                [
                    'label' => __( 'Opacity (%)', 'vcharitycore' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 1,
                    ],
                    'range' => [
                        'px' => [
                            'max' => 1,
                            'step' => 0.01,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .landshop-tab-nav .tab-button .icon' => 'opacity: {{SIZE}}',

                    ],
                ]
            );
        
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_icon_hover',
			[
				'label' => __( 'Hover', 'landshopcore' ),
			]
		);
            $this->add_responsive_control(
                'button_icon_margin_hover',
                [
                    'label' => __( 'Margin', 'landshopcore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .landshop-tab-nav .tab-button:hover .icon,{{WRAPPER}} .landshop-tab-nav .active .tab-button .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'button_icon_opacity_hover',
                [
                    'label' => __( 'Opacity (%)', 'vcharitycore' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 1,
                    ],
                    'range' => [
                        'px' => [
                            'max' => 1,
                            'step' => 0.01,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .landshop-tab-nav .tab-button:hover .icon,{{WRAPPER}} .landshop-tab-nav .active .tab-button .icon' => 'opacity: {{SIZE}}',

                    ],
                ]
            );        

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
        
        
        // Style tab section
        $this->start_controls_section(
            'tab_style_content_section',
            [
                'label' => __( 'Content', 'landshopcore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'tab_content_background',
                    'label' => __( 'Background', 'landshopcore' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .landshop-tab-content',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'tab_content_border',
                    'label' => __( 'Border', 'landshopcore' ),
                    'selector' => '{{WRAPPER}} .landshop-tab-content',
                ]
            );

            $this->add_responsive_control(
                'tab_content_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'landshopcore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .landshop-tab-content' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'tab_content_padding',
                [
                    'label' => __( 'Padding', 'landshopcore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .landshop-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'tab_content_margin',
                [
                    'label' => __( 'Margin', 'landshopcore' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .landshop-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();
        $this->add_render_attribute( 'landshop_tab_attr', 'class', ['landshop-tabs', 'row g-4' ,'menu-position-'.$settings['menu_position']] );
        $this->add_render_attribute( 'landshop_tab_menu_attr', 'class', ['landshop-tab-nav', esc_attr($settings['menu_style'])]);
        $this->add_render_attribute( 'landshop_tab_menu_attr', 'role', 'tablist');
        $id = $this->get_id();       
        ?>
    <div <?php echo $this->get_render_attribute_string( 'landshop_tab_attr' ); ?>>
        <div class="col-12 <?php echo ($settings['menu_position'] != 'top' ? 'col-md-4' : ''); ?>">
            <ul <?php echo $this->get_render_attribute_string( 'landshop_tab_menu_attr' ); ?>>
                <?php
                $i=0;
                foreach ( $settings['landshop_tabs_list'] as $item ) {
                    $i++;
                    $tabbuttontxt = '';
                    if( $i == 1 ){ $active_tab = 'active'; } else{ $active_tab = ''; }
                    if( $item['icon_type'] == 'img' and !empty(Group_Control_Image_Size::get_attachment_image_html( $item, 'imagesize', 'image' )) ){
                        $image = Group_Control_Image_Size::get_attachment_image_html( $item, 'imagesize', 'image' );  
                        $tabbuttontxt .= '<span class="icon">'.$image.'</span>';
                    }elseif( $item['icon_type'] == 'icon' && !empty($item['feature_icon']['value']) ){
                        $tabbuttontxt .= sprintf( '<span class="icon" >%1$s</span>', landshop_icon_manager::render_icon( $item['feature_icon'], [ 'aria-hidden' => 'true' ] ) );
                    }
                    $tabbuttontxt .= $item['tab_title'];
                    
                    echo sprintf( '<li class="%1$s" ><a class="tab-button %4$s" href="#landshoptab-%2$s" data-toggle="tab" role="tab">%3$s</a></li>',$active_tab, $id.$i, $tabbuttontxt, 'elementor-repeater-item-'.$item['_id']);
                }
                ?>
            </ul>
        </div>
        <div class="col-12 <?php echo ($settings['menu_position'] != 'top' ? 'col-md-8' : ''); ?>">
            <div class="landshop-tab-content tab-content">
                <?php
                    $i=0;
                    foreach ( $settings['landshop_tabs_list'] as $item ) {
                        $i++;
                        if( $i == 1 ){ $active_tab = 'active in'; } else{ $active_tab = ''; }

                        if ( $item['content_source'] == 'custom' && !empty( $item['custom_content'] ) ) {
                            $tab_content =  wp_kses_post( $item['custom_content'] );
                        } elseif ( $item['content_source'] == "elementor" && !empty( $item['template_id'] )) {
                            $tab_content =  Plugin::instance()->frontend->get_builder_content_for_display( $item['template_id'] );
                        }
                        echo sprintf('<div class="landshop-single-tab tab-pane fade %1$s %4$s" id="landshoptab-%2$s" role="tabpanel"><div class="landshop-tab-content">%3$s</div></div>', $active_tab, $id.$i, $tab_content,'elementor-repeater-item-'.$item['_id'] );
                    }
                ?>
            </div>
        </div>
    </div>
<?php
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new landshop_Elementor_Widget_Tabs );
