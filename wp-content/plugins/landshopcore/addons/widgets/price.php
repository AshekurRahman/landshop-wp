<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class landshop_Elementor_Widget_Pricing_Table extends Widget_Base {

    public function get_name() {
        return 'landshop-pricing-table-addons';
    }
    
    public function get_title() {
        return __( 'Price Table', 'landshopcore' );
    }

    public function get_icon() {
        return 'landshop-icon eicon-price-table';
    }
    
    public function get_categories() {
        return [ 'landshopcore' ];
    }
    
    protected function register_controls() {

    // Header Fields tab start
    $this->start_controls_section(
        'landshop_pricing_header',
        [
            'label' => __( 'Header', 'landshopcore' ),
        ]
    );
        
        $this->add_control(
            'enable_icon',
            [
                'label' => __( 'Enable Icon', 'landshopcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'landshopcore' ),
                'label_off' => __( 'No', 'landshopcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'none',
            ]
        );       
            
        $this->add_control(
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
                'condition' => [
                    'enable_icon' => 'yes',
                ]
            ]
        );
        
        $this->add_control(
            'icon_image',
            [
                'label' => __('Image','landshopcore'),
                'type'=>Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'icon_type' => 'img',
                    'enable_icon' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'icon_imagesize',
                'default' => 'large',
                'separator' => 'none',
                'condition' => [
                    'icon_type' => 'img',
                    'enable_icon' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'icon_font',
            [
                'label'       => __( 'Icon', 'landshopcore-addons' ),
                'type'        => Controls_Manager::ICONS,
                'label_block' => true,
                'condition' => [
                    'icon_type' => 'icon',
                    'enable_icon' => 'yes',
                ]
            ]
        );
        
        $this->add_control(
            'enable_title',
            [
                'label' => __( 'Enable Title', 'landshopcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'landshopcore' ),
                'label_off' => __( 'No', 'landshopcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'pricing_title',
            [
                'label' => __( 'Title', 'landshopcore' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Basic Plan', 'landshopcore' ),
                'default' => __( 'Basic Plan', 'landshopcore' ),
                'condition' => [
                    'enable_title' => 'yes',
                ]
            ]
        );
        
        $this->add_control(
            'enable_sub_title',
            [
                'label' => __( 'Enable Sub Title', 'landshopcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'landshopcore' ),
                'label_off' => __( 'No', 'landshopcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'pricing_sub_title',
            [
                'label' => __( 'Sub Title', 'landshopcore' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Enter your sub title', 'landshopcore' ),
                'condition' => [
                    'enable_sub_title' => 'yes',
                ]
            ]
        );
                
        
        $this->add_control(
            'enable_amount',
            [
                'label' => __( 'Enable Amount', 'landshopcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'landshopcore' ),
                'label_off' => __( 'No', 'landshopcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'landshop_currency_symbol',
            [
                'label'   => __( 'Currency Symbol', 'landshopcore' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    ''             => esc_html__( 'None', 'landshopcore' ),
                    'dollar'       => '&#36; ' . esc_html__( 'Dollar', 'landshopcore' ),
                    'euro'         => '&#128; ' . esc_html__( 'Euro', 'landshopcore' ),
                    'baht'         => '&#3647; ' . esc_html__( 'Baht', 'landshopcore' ),
                    'franc'        => '&#8355; ' . esc_html__( 'Franc', 'landshopcore' ),
                    'guilder'      => '&fnof; ' . esc_html__( 'Guilder', 'landshopcore' ),
                    'krona'        => 'kr ' . esc_html__( 'Krona', 'landshopcore' ),
                    'lira'         => '&#8356; ' . esc_html__( 'Lira', 'landshopcore' ),
                    'peseta'       => '&#8359 ' . esc_html__( 'Peseta', 'landshopcore' ),
                    'peso'         => '&#8369; ' . esc_html__( 'Peso', 'landshopcore' ),
                    'pound'        => '&#163; ' . esc_html__( 'Pound Sterling', 'landshopcore' ),
                    'real'         => 'R$ ' . esc_html__( 'Real', 'landshopcore' ),
                    'ruble'        => '&#8381; ' . esc_html__( 'Ruble', 'landshopcore' ),
                    'rupee'        => '&#8360; ' . esc_html__( 'Rupee', 'landshopcore' ),
                    'indian_rupee' => '&#8377; ' . esc_html__( 'Rupee (Indian)', 'landshopcore' ),
                    'shekel'       => '&#8362; ' . esc_html__( 'Shekel', 'landshopcore' ),
                    'yen'          => '&#165; ' . esc_html__( 'Yen/Yuan', 'landshopcore' ),
                    'won'          => '&#8361; ' . esc_html__( 'Won', 'landshopcore' ),
                    'custom'       => __( 'Custom', 'landshopcore' ),
                ],
                'default' => 'dollar',
                'condition' => [
                    'enable_amount' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'landshop_currency_symbol_custom',
            [
                'label'     => __( 'Custom Symbol', 'landshopcore' ),
                'type'      => Controls_Manager::TEXT,
                'condition' => [
                    'landshop_currency_symbol' => 'custom',
                    'enable_amount' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'landshop_price',
            [
                'label'   => esc_html__( 'Price', 'landshopcore' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '20',
                'condition' => [
                    'enable_amount' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'landshop_price_period',
            [
                'label'   => esc_html__( 'Period', 'landshopcore' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( 'Per month', 'landshopcore' ),
                'condition' => [
                    'enable_amount' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'landshop_price_label',
            [
                'label'   => esc_html__( 'Label', 'landshopcore' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( '10% off for yearly subscription', 'landshopcore' ),
                'condition' => [
                    'enable_amount' => 'yes',
                ]
            ]
        );
        
        
        $this->add_control(
            'enable_range_slider',
            [
                'label' => __( 'Enable Range Slider', 'landshopcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'landshopcore' ),
                'label_off' => __( 'No', 'landshopcore' ),
                'return_value' => 'yes',
                'default' => 'no',
                'separator' => 'before',
            ]
        );    
                
		$this->add_control(
			'divider_number',
			[
				'label' => __( 'Divider Number', 'landshopcore' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 500,
				'step' => 1,
                'condition' => [
                    'enable_range_slider' => 'yes',
                ]
			]
		);
        
        $this->add_control(
             'slider_target_id',
             [
                'label'     => __( 'Enter Range Slider ID', 'landshopcore' ),
                'type'      => Controls_Manager::TEXT,
                'title' => __( 'Paste your "Range Slider Connector ID"', 'landshopcore' ),
                'condition' => [
                    'enable_range_slider' => 'yes',
                ]
             ]
         );


    $this->end_controls_section(); // Header Fields tab end

    // Features tab start
    $this->start_controls_section(
        'landshop_pricing_features',
        [
            'label' => __( 'Features', 'landshopcore' ),
        ]
    );

		  $repeater = new Repeater();   
            $repeater->add_control(
                'feature_icon_type',
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
                'feature_icon_image',
                [
                    'label' => __('Image','landshopcore'),
                    'type'=>Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'feature_icon_type' => 'img',
                    ]
                ]
            );

            $repeater->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'feature_icon_imagesize',
                    'default' => 'large',
                    'separator' => 'none',
                    'condition' => [
                        'feature_icon_type' => 'img',
                    ]
                ]
            );

            $repeater->add_control(
                'feature_icon_font',
                [
                    'label'       => __( 'Icon', 'landshopcore-addons' ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                    'condition' => [
                        'feature_icon_type' => 'icon',
                    ]
                ]
            );
        
            $repeater->add_control(
                'feature_icon_color',
                [
                    'label'     => esc_html__( 'Icon Color', 'landshopcore' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .price-box {{CURRENT_ITEM}} .x-icon' => 'color: {{VALUE}}',
                    ],
                ]
            );
        
            $repeater->add_control(
                'feature_text',
                [
                    'label' => __( 'Text', 'landshopcore' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Price Title', 'landshopcore' ),
                    'dynamic' => [
                        'active' => true,
                    ],
                    'label_block' => true,
                ]
            );
        
            $repeater->add_control(
                'deactive_item',
                [
                    'label' => __( 'Deactive', 'landshopcore' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'landshopcore' ),
                    'label_off' => __( 'No', 'landshopcore' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );   
        
            $this->add_control(
                'feature_items',
                [
                    'label' => __( 'Features', 'landshopcore' ),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'title_field' => '{{{ feature_text }}}',
                ]
            );
    $this->end_controls_section(); // Features Fields tab end


    // Footer tab start
    $this->start_controls_section(
        'landshop_pricing_footer',
        [
            'label' => __( 'Button', 'landshopcore' ),
        ]
    );
        $this->add_control(
            'enable_button',
            [
                'label' => __( 'Enable Button', 'landshopcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'landshopcore' ),
                'label_off' => __( 'No', 'landshopcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'landshop_button_text',
            [
                'label'   => esc_html__( 'Button Text', 'landshopcore' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( 'Purchase Now', 'landshopcore' ),
                'condition' => [
                    'enable_button' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'landshop_button_link',
            [
                'label'       => __( 'Link', 'landshopcore' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => 'http://your-link.com',
                'default'     => [
                    'url' => '#',
                ],
                'condition' => [
                    'enable_button' => 'yes',
                ]
            ]
        );
        
        
        $this->add_control(
            'button_icon_type',
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
                    'none' =>[
                        'title' =>__('None','landshopcore'),
                        'icon' =>'eicon-warning',
                    ],
                ],
                'default' => 'none',
                'condition' => [
                    'enable_button' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'button_icon_img',
            [
                'label' => __('Image','landshopcore'),
                'type'=>Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'button_icon_type' => 'img',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'button_icon_img_size',
                'default' => 'large',
                'separator' => 'none',
                'condition' => [
                    'button_icon_type' => 'img',
                ]
            ]
        );

        $this->add_control(
            'button_font_icon',
            [
                'label'       => __( 'Icon', 'landshopcore-addons' ),
                'type'        => Controls_Manager::ICONS,
                'label_block' => true,
                'condition' => [
                    'button_icon_type' => 'icon',
                ]
            ]
        );
        $this->add_control(
            'pricing_footer_desc',
            [
                'label' => __( 'Description', 'landshopcore' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Enter your description', 'landshopcore' ),
            ]
        );        

    $this->end_controls_section(); // Footer Fields tab end

        // price Style tab section
        $this->start_controls_section(
            'landshop_price_style_section',
            [
                'label' => __( 'Single Card', 'landshopcore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->start_controls_tabs('price_box_style_tab');
        $this->start_controls_tab( 'price_box_normal',
            [
                'label' => __( 'Normal', 'landshopcore' ),
            ]
        );
        
        $this->add_responsive_control(
            'price_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'price_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
                
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'price_background',
                'label' => __( 'Background', 'landshopcore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .price-box',
            ]
        );

        $this->add_responsive_control(
            'price_text_align',
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
                    ],
                    'justify' => [
                        'title' => __( 'Justified', 'landshopcore' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .price-box' => 'text-align: {{VALUE}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'price_border',
                'label' => __( 'Border', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .price-box',
            ]
        );
        $this->add_responsive_control(
            'price_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .price-box' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'price_box_shadow',
                'label' => __( 'Box Shadow', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .price-box',
            ]
        );        
        $this->add_control(
            'price_box_transform',
            [
                'label' => __( 'Transform', 'landshopcore' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'translateY(0)',
                'selectors' => [
                    '{{WRAPPER}} .price-box' => 'transform: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'price_box_transition',
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
                    '{{WRAPPER}} .price-box' => 'transition-duration: {{SIZE}}s',
                ],
            ]
        );
        $this->end_controls_tab();             
        // Hover Style tab Start
        $this->start_controls_tab(
            'price_box_hover',
            [
                'label' => __( 'Hover', 'landshopcore' ),
            ]
        );
                
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'price_hover_background',
                'label' => __( 'Background', 'landshopcore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .price-box:hover',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'price_border_hover',
                'label' => __( 'Border', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .price-box:hover',
            ]
        );
        $this->add_responsive_control(
            'price_hover_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .price-box:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'price_box_hover_shadow',
                'label' => __( 'Box Shadow', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .price-box:hover',
            ]
        );
        $this->add_control(
            'price_box_hover_transform',
            [
                'label' => __( 'Transform', 'landshopcore' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'translateY(0)',
                'selectors' => [
                    '{{WRAPPER}} .price-box:hover' => 'transform: {{VALUE}}',
                ],
            ]
        );        
        $this->end_controls_tab(); // Hover Style tab end        
        $this->end_controls_tabs();// Box Style tabs end  
    $this->end_controls_section(); // price Box section style end
        
    
    // Style tab section start
    $this->start_controls_section(
        'landshop_price_icon_section',
        [
            'label' => __( 'Icon', 'landshopcore' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );
        $this->add_responsive_control(
			'price_icon_width',
			[
				'label' => __( 'Width', 'landshopcore' ),
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
					'{{WRAPPER}} .price-box .price-icon' => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);        
        
		$this->add_responsive_control(
			'price_icon_height',
			[
				'label' => __( 'Height', 'landshopcore' ),
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
					'{{WRAPPER}} .price-box .price-icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'price_icon_line_height',
			[
				'label' => __( 'Line Height', 'landshopcore' ),
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
					'{{WRAPPER}} .price-box .price-icon' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        $this->add_responsive_control(
            'price_icon_size',
            [
                'label' => __( 'Font Icon Size', 'landshopcore' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'price_icon_color',
            [
                'label' => __( 'Color', 'landshopcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-icon' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'price_icon_background',
                'label' => __( 'Background', 'landshopcore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .price-box .price-icon',
            ]
        );        
         $this->add_responsive_control(
            'price_icon_floting',
            [
                'label' => __( 'Float', 'landshopcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-direction: row; align-items: center !important;' => [
                        'title' => __( 'Left', 'landshopcore' ),
                        'icon' => 'eicon-arrow-left',
                    ],
                    'flex-direction: column;' => [
                        'title' => __( 'Top', 'landshopcore' ),
                        'icon' => 'eicon-arrow-up',
                    ],
                    'flex-direction: row-reverse; align-items: center !important;' => [
                        'title' => __( 'Right', 'landshopcore' ),
                        'icon' => 'eicon-arrow-right',
                    ],
                    'flex-direction: column-reverse;' => [
                        'title' => __( 'Bottom', 'landshopcore' ),
                        'icon' => 'eicon-arrow-down',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .feature-box' => 'display: flex; {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'price_icon_alignment',
            [
                'label' => __( 'Alignment', 'landshopcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'justify-content: flex-start; align-items: flex-start;' => [
                        'title' => __( 'Start', 'landshopcore' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'justify-content: center; align-items: center;' => [
                        'title' => __( 'Center', 'landshopcore' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'justify-content: flex-end; align-items: flex-end;' => [
                        'title' => __( 'End', 'landshopcore' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .feature-box' => '{{VALUE}}',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_responsive_control(
            'price_icon_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'price_icon_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'price_icon_border',
                'label' => __( 'Border', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .price-box .price-icon',
            ]
        );
        $this->add_responsive_control(
            'price_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'landshopcore' ),
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
                    '{{WRAPPER}} .price-box .price-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'price_icon_shadow',
                'label' => __( 'Box Shadow', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .price-box .price-icon',
            ]
        );
        
    $this->end_controls_section();
    
    $this->start_controls_section(
        'landshop_price_header_title',
        [
            'label' => __( 'Title', 'landshopcore' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );

        $this->add_control(
            'landshop_price_title_color',
            [
                'label'     => __( 'Color', 'landshopcore' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-title' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'landshop_price_title_typo',
                'selector' => '{{WRAPPER}} .price-box .price-title',
            ]
        );

        $this->add_responsive_control(
            'landshop_price_title_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'landshop_price_title_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

    $this->end_controls_section();



    $this->start_controls_section(
        'landshop_price_header_sub_title',
        [
            'label' => __( 'Sub Title', 'landshopcore' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );

        $this->add_control(
            'landshop_price_sub_title_color',
            [
                'label'     => __( 'Color', 'landshopcore' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-box .sub-title' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'landshop_price_sub_title_typo',
                'selector' => '{{WRAPPER}} .price-box .sub-title',
            ]
        );

        $this->add_responsive_control(
            'landshop_price_sub_title_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-box .sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'landshop_price_sub_title_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-box .sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

    $this->end_controls_section();

    // Style tab section start
    $this->start_controls_section(
        'price_symble_section',
        [
            'label' => __( 'Symble', 'landshopcore' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );

        $this->add_control(
            'price_symble_color',
            [
                'label'     => __( 'Color', 'landshopcore' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-rate .symble' => 'color: {{VALUE}}',
                ],
            ]
        );   
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'price_symble_typo',
                'selector' => '{{WRAPPER}} .price-box .price-rate .symble',
            ]
        );
        $this->add_responsive_control(
            'price_symble_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-rate .symble' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'price_symble_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-rate .symble' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
    $this->end_controls_section();
        

    // Style tab section start
    $this->start_controls_section(
        'landshop_price_amount_section',
        [
            'label' => __( 'Amount', 'landshopcore' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );  
        $this->add_responsive_control(
            'amount_alignment',
            [
                'label' => __( 'Alignment', 'landshopcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'justify-content: flex-start; align-items: flex-start;' => [
                        'title' => __( 'Start', 'landshopcore' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'justify-content: center; align-items: center;' => [
                        'title' => __( 'Center', 'landshopcore' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'justify-content: flex-end; align-items: flex-end;' => [
                        'title' => __( 'End', 'landshopcore' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-amount' => '{{VALUE}}',
                ],
                'separator' =>'before',
            ]
        );
       $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pricing_amount_area_background',
                'label' => __( 'Background', 'landshopcore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .price-box .price-amount',
            ]
        );

        $this->add_control(
            'landshop_price_amount_color',
            [
                'label'     => __( 'Color', 'landshopcore' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-rate' => 'color: {{VALUE}}',
                ],
            ]
        );   
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'landshop_price_amount_typo',
                'selector' => '{{WRAPPER}} .price-box .price-rate .amount',
            ]
        );
        $this->add_responsive_control(
            'landshop_price_amount_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-amount' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'landshop_price_amount_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-amount' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_amount_border',
                'label' => __( 'Border', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .price-box .price-amount',
            ]
        );

        $this->add_responsive_control(
            'button_amount_round',
            [
                'label' => esc_html__( 'Border Radius', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-amount' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        
    $this->end_controls_section();

    $this->start_controls_section(
        'landshop_price_header_preiod',
        [
            'label' => __( 'Preiod', 'landshopcore' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );
        $this->add_control(
            'landshop_price_preiod_color',
            [
                'label'     => __( 'Color', 'landshopcore' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-box .preiod' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'landshop_price_preiod_typo',
                'selector' => '{{WRAPPER}} .price-box .preiod',
            ]
        );

        $this->add_responsive_control(
            'landshop_price_preiod_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-box .preiod' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'landshop_price_preiod_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-box .preiod' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
    $this->end_controls_section();
        
    $this->start_controls_section(
        'landshop_price_header_label',
        [
            'label' => __( 'Label', 'landshopcore' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );
        $this->add_control(
            'landshop_price_label_color',
            [
                'label'     => __( 'Color', 'landshopcore' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-label' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'landshop_price_label_typo',
                'selector' => '{{WRAPPER}} .price-box .price-label',
            ]
        );

        $this->add_responsive_control(
            'landshop_price_label_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'landshop_price_label_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'price_label_border',
                'label' => __( 'Border', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .price-box .price-label',
            ]
        );
    $this->end_controls_section();
    
    // Features style tab start
    $this->start_controls_section(
        'landshopcore_features_style',
        [
            'label'     => __( 'Features', 'landshopcore' ),
            'tab'       => Controls_Manager::TAB_STYLE,
        ]
    );        
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_list_background',
                'label' => __( 'Background', 'landshopcore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .price-box .feature-list li',
            ]
        );

        $this->add_responsive_control(
            'icon_list_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-box .feature-list li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_list_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-box .feature-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_list_border',
                'label' => __( 'Border', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .price-box .feature-list li',
            ]
        );

        $this->add_responsive_control(
            'icon_list_round',
            [
                'label' => esc_html__( 'Border Radius', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .price-box .feature-list li' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

       $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_list_shadow',
                'label' => __( 'Box Shadow', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .price-box .feature-list li',
            ]
        );

        
        $this->start_controls_tabs( 'feature_list_tabs');
            // Pricing Normal tab start
            $this->start_controls_tab(
                'feature_list_icon_tab',
                [
                    'label' => __( 'Icon', 'landshopcore' ),
                ]
            );

                $this->add_responsive_control(
                    'price_list_icon_width',
                    [
                        'label' => __( 'Width', 'landshopcore' ),
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
                            '{{WRAPPER}} .price-box .feature-list .price-icon' => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );        

                $this->add_responsive_control(
                    'price_list_icon_height',
                    [
                        'label' => __( 'Height', 'landshopcore' ),
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
                            '{{WRAPPER}} .price-box .feature-list .price-icon' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'price_list_icon_line_height',
                    [
                        'label' => __( 'Line Height', 'landshopcore' ),
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
                            '{{WRAPPER}} .price-box .feature-list .price-icon' => 'line-height: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_responsive_control(
                    'price_list_icon_size',
                    [
                        'label' => __( 'Font Icon Size', 'landshopcore' ),
                        'type'  => Controls_Manager::SLIDER,
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .price-box .feature-list .price-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_control(
                    'price_list_icon_color',
                    [
                        'label' => __( 'Color', 'landshopcore' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .price-box .feature-list .price-icon' => 'color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'price_list_icon_background',
                        'label' => __( 'Background', 'landshopcore' ),
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .price-box .feature-list .price-icon',
                    ]
                );        
                 $this->add_responsive_control(
                    'price_list_icon_floting',
                    [
                        'label' => __( 'Float', 'landshopcore' ),
                        'type' => Controls_Manager::CHOOSE,
                        'options' => [
                            'flex-direction: row; align-items: center !important;' => [
                                'title' => __( 'Left', 'landshopcore' ),
                                'icon' => 'eicon-arrow-left',
                            ],
                            'flex-direction: column;' => [
                                'title' => __( 'Top', 'landshopcore' ),
                                'icon' => 'eicon-arrow-up',
                            ],
                            'flex-direction: row-reverse; align-items: center !important;' => [
                                'title' => __( 'Right', 'landshopcore' ),
                                'icon' => 'eicon-arrow-right',
                            ],
                            'flex-direction: column-reverse;' => [
                                'title' => __( 'Bottom', 'landshopcore' ),
                                'icon' => 'eicon-arrow-down',
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .price-box .feature-list li' => 'display: flex; {{VALUE}}',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'price_list_icon_alignment',
                    [
                        'label' => __( 'Alignment', 'landshopcore' ),
                        'type' => Controls_Manager::CHOOSE,
                        'options' => [
                            'justify-content: flex-start; align-items: flex-start;' => [
                                'title' => __( 'Start', 'landshopcore' ),
                                'icon' => 'fa fa-align-left',
                            ],
                            'justify-content: center; align-items: center;' => [
                                'title' => __( 'Center', 'landshopcore' ),
                                'icon' => 'fa fa-align-center',
                            ],
                            'justify-content: flex-end; align-items: flex-end;' => [
                                'title' => __( 'End', 'landshopcore' ),
                                'icon' => 'fa fa-align-right',
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .price-box .feature-list li' => '{{VALUE}}',
                        ],
                        'separator' =>'before',
                    ]
                );
                $this->add_responsive_control(
                    'price_list_icon_margin',
                    [
                        'label' => __( 'Margin', 'landshopcore' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} .price-box .feature-list .price-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'separator' =>'before',
                    ]
                );

                $this->add_responsive_control(
                    'price_list_icon_padding',
                    [
                        'label' => __( 'Padding', 'landshopcore' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} .price-box .feature-list .price-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'separator' =>'before',
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'price_list_icon_border',
                        'label' => __( 'Border', 'landshopcore' ),
                        'selector' => '{{WRAPPER}} .price-box .feature-list .price-icon',
                    ]
                );
                $this->add_responsive_control(
                    'price_list_icon_border_radius',
                    [
                        'label' => esc_html__( 'Border Radius', 'landshopcore' ),
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
                            '{{WRAPPER}} .price-box .feature-list .price-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ]
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'price_list_icon_shadow',
                        'label' => __( 'Box Shadow', 'landshopcore' ),
                        'selector' => '{{WRAPPER}} .price-box .feature-list .price-icon',
                    ]
                );

            $this->end_controls_tab(); // Pricing Normal tab end

            // Pricing Hover tab start
            $this->start_controls_tab(
                'feature_list_text_tab',
                [
                    'label' => __( 'Text', 'landshopcore' ),
                ]
            );
        

                $this->add_control(
                    'price_list_text_color',
                    [
                        'label'     => __( 'Color', 'landshopcore' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .price-box .feature-list .text' => 'color: {{VALUE}}',
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name'     => 'price_list_text_typo',
                        'selector' => '{{WRAPPER}} .price-box .feature-list .text',
                    ]
                );

                $this->add_responsive_control(
                    'price_list_text_padding',
                    [
                        'label' => __( 'Padding', 'landshopcore' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} .price-box .feature-list .text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ]
                    ]
                );
                $this->add_responsive_control(
                    'price_list_text_margin',
                    [
                        'label' => __( 'Margin', 'landshopcore' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} .price-box .feature-list .text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ]
                    ]
                );

            $this->end_controls_tab(); // Pricing Hover tab end

        $this->end_controls_tabs();
                
    $this->end_controls_section(); // Features style tab end
    
    
    
    // Footer style tab start
    $this->start_controls_section(
        'landshopcore_pricing_footer_style',
        [
            'label'     => __( 'Button', 'landshopcore' ),
            'tab'       => Controls_Manager::TAB_STYLE,
        ]
    );

        $this->add_responsive_control(
            'pricing_footer_area_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'pricing_footer_area_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-box .price-footer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
       $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'pricing_footer_area_background',
                'label' => __( 'Background', 'landshopcore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .price-box .price-footer',
            ]
        );
        
        $this->add_control(
            'pricing_footer_button_area',
            [
                'label'     => __( 'Button', 'landshopcore' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->start_controls_tabs( 'pricing_footer_style_tabs');

            // Pricing Normal tab start
            $this->start_controls_tab(
                'style_pricing_normal_tab',
                [
                    'label' => __( 'Normal', 'landshopcore' ),
                ]
            );

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'button_background',
                        'label' => __( 'Background', 'landshopcore' ),
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .price-box .primary_button',
                    ]
                );

                $this->add_control(
                    'button_color',
                    [
                        'label'     => __( 'Color', 'landshopcore' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .price-box .primary_button' => 'color: {{VALUE}}',
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name'     => 'button_typography',
                        'selector' => '{{WRAPPER}} .price-box .primary_button',
                    ]
                );

                $this->add_responsive_control(
                    'button_padding',
                    [
                        'label' => __( 'Padding', 'landshopcore' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} .price-box .primary_button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ]
                    ]
                );

                $this->add_responsive_control(
                    'button_margin',
                    [
                        'label' => __( 'Margin', 'landshopcore' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} .price-box .primary_button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'button_border',
                        'label' => __( 'Border', 'landshopcore' ),
                        'selector' => '{{WRAPPER}} .price-box .primary_button',
                    ]
                );

                $this->add_responsive_control(
                    'button_round',
                    [
                        'label' => esc_html__( 'Border Radius', 'landshopcore' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            '{{WRAPPER}} .price-box .primary_button' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        ],
                    ]
                );

               $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'button_shadow',
                        'label' => __( 'Box Shadow', 'landshopcore' ),
                        'selector' => '{{WRAPPER}} .price-box .primary_button',
                    ]
                );

                $this->add_responsive_control(
                    'button_width',
                    [
                        'label' => __( 'Width', 'landshopcore' ),
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
                            '{{WRAPPER}} .price-box .primary_button' => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );        

            $this->end_controls_tab(); // Pricing Normal tab end

            // Pricing Hover tab start
            $this->start_controls_tab(
                'style_pricing_hover_tab',
                [
                    'label' => __( 'Hover', 'landshopcore' ),
                ]
            );

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'pricing_footer_hover_background',
                        'label' => __( 'Background', 'landshopcore' ),
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .price-box .primary_button:hover',
                    ]
                );

                $this->add_control(
                    'pricing_footer_hover_color',
                    [
                        'label'     => __( 'Color', 'landshopcore' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .price-box .primary_button:hover' => 'color: {{VALUE}}',
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'pricing_footer_hover_border',
                        'label' => __( 'Border', 'landshopcore' ),
                        'selector' => '{{WRAPPER}} .price-box .primary_button:hover',
                    ]
                );

                $this->add_responsive_control(
                    'pricing_footer_hover_radius',
                    [
                        'label' => esc_html__( 'Border Radius', 'landshopcore' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            '{{WRAPPER}} .price-box .primary_button:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        ],
                    ]
                );

               $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'pricing_button_hover_shadow',
                        'label' => __( 'Box Shadow', 'landshopcore' ),
                        'selector' => '{{WRAPPER}} .price-box .primary_button:hover',
                    ]
                );
            $this->end_controls_tab(); // Pricing Hover tab end

        $this->end_controls_tabs();

    $this->end_controls_section(); // Footer style tab end


    $this->start_controls_section(
        'landshop_price_header_desc_title',
        [
            'label' => __( 'Description', 'landshopcore' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );

        $this->add_control(
            'landshop_price_desc_title_color',
            [
                'label'     => __( 'Color', 'landshopcore' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-box .footer-desc' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'landshop_price_desc_title_typo',
                'selector' => '{{WRAPPER}} .price-box .footer-desc',
            ]
        );

        $this->add_responsive_control(
            'landshop_price_desc_title_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-box .footer-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'landshop_price_desc_title_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-box .footer-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

    $this->end_controls_section();
}
private function get_currency_symbol( $symbol_name ) {
    $symbols = [
        'dollar'       => '&#36;',
        'baht'         => '&#3647;',
        'euro'         => '&#128;',
        'franc'        => '&#8355;',
        'guilder'      => '&fnof;',
        'indian_rupee' => '&#8377;',
        'krona'        => 'kr',
        'lira'         => '&#8356;',
        'peseta'       => '&#8359',
        'peso'         => '&#8369;',
        'pound'        => '&#163;',
        'real'         => 'R$',
        'ruble'        => '&#8381;',
        'rupee'        => '&#8360;',
        'shekel'       => '&#8362;',
        'won'          => '&#8361;',
        'yen'          => '&#165;',
    ];
    return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ] : '';
}

protected function render( $instance = [] ) {

    $settings   = $this->get_settings_for_display();
    $button_content = '';


    $this->add_render_attribute( 'pricing_area_attr', 'class', 'price-box' );
        
    if(!empty($settings['divider_number'])){
        $this->add_render_attribute( 'pricing_area_attr', 'data-devide', $settings['divider_number'] );
    }else{
        $this->add_render_attribute( 'pricing_area_attr', 'data-devide', '0' );        
    }
    
    if(!empty($settings['slider_target_id'])){
        $this->add_render_attribute( 'pricing_area_attr', 'data-id', $settings['slider_target_id'] );
    }

    if ( ! empty( $settings['landshop_button_link']['url'] ) ) {
        $this->add_render_attribute( 'url', 'class', 'primary_button' );
        $this->add_render_attribute( 'url', 'href', $settings['landshop_button_link']['url'] );
        if ( $settings['landshop_button_link']['is_external'] ) {
            $this->add_render_attribute( 'url', 'target', '_blank' );
        }
        if ( ! empty( $settings['landshop_button_link']['nofollow'] ) ) {
            $this->add_render_attribute( 'url', 'rel', 'nofollow' );
        }
    }
    $price_rate = '';        
    if ( ! empty( $settings['landshop_currency_symbol'] ) ) {
        if ( $settings['landshop_currency_symbol'] != 'custom' ) {
            $price_rate .= '<span class="symble" >'.$this->get_currency_symbol( $settings['landshop_currency_symbol'] ).'</span>';
        } else {
            $price_rate .= '<span class="symble" >'.$settings['landshop_currency_symbol_custom'].'</span>';
        }
    }
    if ( $settings['landshop_price'] != '' ) {
        $price_rate .= '<span class="amount">'.esc_html($settings['landshop_price']).'</span>';
    }
    
    
    echo '<div '.$this->get_render_attribute_string( 'pricing_area_attr' ).' >';
        echo '<div class="price-header">';
            if( $settings['enable_icon'] == 'yes' ){                
                if( $settings['icon_type'] == 'img' and !empty(Group_Control_Image_Size::get_attachment_image_html( $settings, 'icon_imagesize', 'icon_image' )) ){
                    $image = Group_Control_Image_Size::get_attachment_image_html( $settings, 'icon_imagesize', 'icon_image' );  
                    echo '<div class="price-icon">'.$image.'</div>';
                }elseif( $settings['icon_type'] == 'icon' && !empty($settings['icon_font']['value']) ){
                    echo sprintf( '<div class="price-icon" >%1$s</div>', landshop_icon_manager::render_icon( $settings['icon_font'], [ 'aria-hidden' => 'true' ] ) );
                }
            }
            if( $settings['enable_title'] == 'yes' ){   
                if( !empty($settings['pricing_title']) ){
                    echo '<h3 class="price-title">'.esc_html( $settings['pricing_title'] ).'</h3>';
                } 
            } 
            if($settings['enable_sub_title'] == 'yes'){
                if( !empty($settings['pricing_sub_title']) ){
                    echo '<div class="sub-title">'.esc_html( $settings['pricing_sub_title'] ).'</div>';
                } 
            } 
    
            if($settings['enable_amount'] == 'yes'){
                echo '<div class="price-amount">';
                    if( !empty($price_rate) ):
                        echo '<h3 class="price-rate">'.wp_kses_post($price_rate).'</h3>';
                    endif; 
                        if( !empty($settings['landshop_price_period']) ):
                            echo '<div class="preiod">'.esc_html($settings['landshop_price_period']).'</div>';
                        endif;
                echo '</div>';  
                if( !empty($settings['landshop_price_label']) ):
                    echo '<div class="price-label">'.esc_html($settings['landshop_price_label']).'</div>';
                endif; 
            }
        echo '</div>';    
        if( $settings['feature_items'] ):    
            echo '<ul class="feature-list">';
                foreach ( $settings['feature_items'] as $index => $item ) :
                    echo '<li class="'.($item['deactive_item'] == 'yes' ? 'off' : 'on').' elementor-repeater-item-'.$item['_id'].'" >';
                        if( $item['feature_icon_type'] == 'img' and !empty(Group_Control_Image_Size::get_attachment_image_html( $item, 'feature_icon_image', 'image' )) ){
                            $image.$index = Group_Control_Image_Size::get_attachment_image_html( $item, 'feature_icon_imagesize', 'image' );  
                            echo '<span class="price-icon">'.$image.$index.'</span>';
                        }elseif( $item['feature_icon_type'] == 'icon' && !empty($item['feature_icon_font']['value']) ){
                            echo sprintf( '<span class="price-icon" >%1$s</span>', landshop_icon_manager::render_icon( $item['feature_icon_font'], [ 'aria-hidden' => 'true' ] ) );
                        }
                        echo '<span class="text">'.wp_kses_post($this->parse_text_editor( $item['feature_text'])).'</span>';
                    echo '</li>';
                endforeach; 
            echo '</ul>';            
        endif;
        if($settings['enable_button'] == 'yes'){
            if( !empty($settings['landshop_button_text']) ){
                $button_content .= esc_html($settings['landshop_button_text']);
            }
            if( $settings['button_icon_type'] == 'img' and !empty(Group_Control_Image_Size::get_attachment_image_html( $settings, 'button_icon_img_size', 'button_icon_img' )) ){
                $button_content .= '<span class="x-icon">'.Group_Control_Image_Size::get_attachment_image_html( $settings, 'button_icon_img_size', 'button_icon_img' ).'</span>';
            }elseif( $settings['button_icon_type'] == 'icon' && !empty($settings['button_font_icon']['value']) ){
                $button_content .= sprintf( '<span class="x-icon" >%1$s</span>', landshop_icon_manager::render_icon( $settings['button_font_icon'], [ 'aria-hidden' => 'true' ] ) );
            }
            if( !empty($button_content) ){
                echo '<div class="price-footer">'.sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $button_content ).'</div>';
            }
        }
        if( !empty($settings['pricing_footer_desc']) ){
            echo '<div class="footer-desc">'.esc_html( $settings['pricing_footer_desc'] ).'</div>';
        } 
    echo '</div>';
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new landshop_Elementor_Widget_Pricing_Table );