<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor counter widget.
 *
 * Elementor widget that displays stats and numbers in an escalating manner.
 *
 * @since 1.0.0
 */
class landshop_Counter_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve counter widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'counter';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve counter widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Counter', 'landshopcore' );
	}
    

	/**
	 * Get widget icon.
	 *
	 * Retrieve counter widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'landshop-icon eicon-counter';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the button widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'landshopcore' ];
	}
    
	/**
	 * Retrieve the list of scripts the counter widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'jquery-numerator' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'counter' ];
	}

	/**
	 * Register counter widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_counter',
			[
				'label' => __( 'Counter', 'landshopcore' ),
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
                        'icon' =>'fa fa-image',
                    ],
                    'icon' =>[
                        'title' =>__('Icon','landshopcore'),
                        'icon' =>'fa fa-icons',
                    ]
                ],
                'default' => 'icon',
            ]
        );

        $this->add_control(
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
            'counter_icon',
            [
                'label'       => __( 'Icon', 'landshopcore-addons' ),
                'type'        => Controls_Manager::ICONS,
                'label_block' => true,
                'condition' => [
                    'icon_type' => 'icon',
                ]
            ]
        );       
                
		$this->add_control(
			'starting_number',
			[
				'label' => __( 'Starting Number', 'landshopcore' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
			]
		);

		$this->add_control(
			'ending_number',
			[
				'label' => __( 'Ending Number', 'landshopcore' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 100,
			]
		);

		$this->add_control(
			'prefix',
			[
				'label' => __( 'Number Prefix', 'landshopcore' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => 1,
			]
		);

		$this->add_control(
			'suffix',
			[
				'label' => __( 'Number Suffix', 'landshopcore' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Plus', 'landshopcore' ),
			]
		);

		$this->add_control(
			'duration',
			[
				'label' => __( 'Animation Duration', 'landshopcore' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 2000,
				'min' => 100,
				'step' => 100,
			]
		);

		$this->add_control(
			'thousand_separator',
			[
				'label' => __( 'Thousand Separator', 'landshopcore' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Show', 'landshopcore' ),
				'label_off' => __( 'Hide', 'landshopcore' ),
			]
		);

		$this->add_control(
			'thousand_separator_char',
			[
				'label' => __( 'Separator', 'landshopcore' ),
				'type' => Controls_Manager::SELECT,
				'condition' => [
					'thousand_separator' => 'yes',
				],
				'options' => [
					'' => 'Default',
					',' => 'Comma',
					'.' => 'Dot',
					' ' => 'Space',
				],
				'default' => ',',
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'landshopcore' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( 'Cool Number', 'landshopcore' ),
				'placeholder' => __( 'Cool Number', 'landshopcore' ),
			]
		);

		
		$this->add_control(
			'rating_switch',
			[
				'label' => __( 'Rating Switch', 'landshopcore' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Show', 'landshopcore' ),
				'label_off' => __( 'Hide', 'landshopcore' ),
			]
		);

		
		$this->add_control(
			'feed_rating',
			[
				'label' => __( 'Rating', 'landshopcore' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 3,
				],
				'condition' => [
					'rating_switch' => 'yes',
				],
				'range' => [
					'px' => [
						'max' => 5,
						'step' => 0.1,
					],
				],
			]
		);
	

		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'landshopcore' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);
		

		$this->end_controls_section();

        // Counter Style tab section
        $this->start_controls_section(
            'counter_box_style_section',
            [
                'label' => __( 'Box Style', 'landshopcore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->start_controls_tabs('counter_box_style_tab');
        $this->start_controls_tab( 'counter_box_normal',
			[
				'label' => __( 'Normal', 'landshopcore' ),
			]
		);
        
        $this->add_responsive_control(
            'counter_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .landshop-counter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'counter_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => '30',
                    'right' => '30',
                    'bottom' => '30',
                    'left' => '30',
                    'isLinked' => false
                ],
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .landshop-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'counter_background',
                'label' => __( 'Background', 'landshopcore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .landshop-counter',
            ]
        );

		$this->add_responsive_control(
			'box_width',
			[
				'label' => __( 'Width', 'landshopcore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
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
					'{{WRAPPER}} .landshop-counter' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);  
		$this->add_responsive_control(
			'box_height',
			[
				'label' => __( 'Height', 'landshopcore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vh' ],
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
					'{{WRAPPER}} .landshop-counter' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);        
        
        $this->add_responsive_control(
            'counter_text_align',
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
                    '{{WRAPPER}} .landshop-counter' => 'text-align: {{VALUE}};',
                ],
                'default' => 'left',
                'separator' =>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'counter_border',
                'label' => __( 'Border', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .landshop-counter',
            ]
        );
        $this->add_responsive_control(
            'counter_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .landshop-counter' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
                'default' => [
                    'top' => '5',
                    'right' => '5',
                    'bottom' => '5',
                    'left' => '5',
                    'isLinked' => false
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'counter_box_shadow',
                'label' => __( 'Box Shadow', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .landshop-counter',
            ]
        );

        
        $this->add_control(
			'counter_box_transform',
			[
				'label' => __( 'Transform', 'landshopcore' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'translateY(0)',
				'selectors' => [
					'{{WRAPPER}} .landshop-counter' => 'transform: {{VALUE}}',
				],
			]
		);
        
		$this->add_control(
			'counter_box_transition',
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
					'{{WRAPPER}} .landshop-counter' => 'transition-duration: {{SIZE}}s',
				],
			]
		);
		$this->end_controls_tab();

             
        // Hover Style tab Start
        $this->start_controls_tab(
            'counter_box_hover',
            [
                'label' => __( 'Hover', 'landshopcore' ),
            ]
        );
                
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'counter_hover_background',
                'label' => __( 'Background', 'landshopcore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .landshop-counter:hover',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'counter_border_hover',
                'label' => __( 'Border', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .landshop-counter:hover',
            ]
        );
        $this->add_responsive_control(
            'counter_hover_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .landshop-counter:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
                'default' => [
                    'top' => '3',
                    'right' => '3',
                    'bottom' => '3',
                    'left' => '3',
                    'isLinked' => false
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'counter_box_hover_shadow',
                'label' => __( 'Box Shadow', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .landshop-counter:hover',
            ]
        );
        $this->add_control(
			'counter_box_hover_transform',
			[
				'label' => __( 'Transform', 'landshopcore' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'translateY(0)',
				'selectors' => [
					'{{WRAPPER}} .landshop-counter:hover' => 'transform: {{VALUE}}',
				],
			]
		);
        
        $this->end_controls_tab(); // Hover Style tab end        
        $this->end_controls_tabs();// Box Style tabs end  
        $this->end_controls_section(); // Counter Box section style end
        
        
        // Feature Style tab section
        $this->start_controls_section(
            'box_icon_section',
            [
                'label' => __( 'Icon', 'landshopcore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->start_controls_tabs('box_icon_style_tab');
        
        $this->start_controls_tab( 'box_icon_normal',
			[
				'label' => __( 'Normal', 'landshopcore' ),
			]
		);        
        
		$this->add_responsive_control(
			'icon_width',
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
				'default' => [
					'unit' => 'px',
					'size' => 80,
				],
				'selectors' => [
					'{{WRAPPER}} .counter-icon' => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'icon_height',
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
				'default' => [
					'unit' => 'px',
					'size' => 80,
				],
				'selectors' => [
					'{{WRAPPER}} .counter-icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_line_height',
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
				'default' => [
					'unit' => 'px',
					'size' => 80,
				],
				'selectors' => [
					'{{WRAPPER}} .counter-icon' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __( 'Font Icon Size', 'landshopcore' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 52,
                ],
                'selectors' => [
                    '{{WRAPPER}} .counter-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Color', 'landshopcore' ),
                'type' => Controls_Manager::COLOR,
				'default' => '#55C882',
                'selectors' => [
                    '{{WRAPPER}} .counter-icon' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_background',
                'label' => __( 'Background', 'landshopcore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .counter-icon',
            ]
        );        
         $this->add_responsive_control(
            'icon_floting',
            [
                'label' => __( 'Float', 'landshopcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-direction: row;' => [
                        'title' => __( 'Left', 'landshopcore' ),
                        'icon' => 'eicon-arrow-left',
                    ],
                    'flex-direction: column;' => [
                        'title' => __( 'Top', 'landshopcore' ),
                        'icon' => 'eicon-arrow-up',
                    ],
                    'flex-direction: row-reverse;' => [
                        'title' => __( 'Right', 'landshopcore' ),
                        'icon' => 'eicon-arrow-right',
                    ],
                    'flex-direction: column-reverse;' => [
                        'title' => __( 'Bottom', 'landshopcore' ),
                        'icon' => 'eicon-arrow-down',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .landshop-counter' => 'display: flex; {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_alignment',
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
                    '{{WRAPPER}} .landshop-counter' => '{{VALUE}}',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_responsive_control(
            'icon_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '15',
                    'left' => '0',
                    'isLinked' => false
                ],
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .counter-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'icon_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => false
                ],
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .counter-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'label' => __( 'Border', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .counter-icon',
            ]
        );
        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '100',
                    'right' => '100',
                    'bottom' => '100',
                    'left' => '100',
                    'isLinked' => false,
					'unit' => '%',
                ],
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
                    '{{WRAPPER}} .counter-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_shadow',
                'label' => __( 'Box Shadow', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .counter-icon',
            ]
        );        
        $this->add_control(
			'box_icon_transition',
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
					'{{WRAPPER}} .counter-icon' => 'transition-duration: {{SIZE}}s',
				],
			]
		);
        $this->end_controls_tab(); // Hover Style tab end
        $this->start_controls_tab( 'box_icon_hover',
			[
				'label' => __( 'Hover', 'landshopcore' ),
			]
		);        
        $this->add_control(
            'hover_icon_color',
            [
                'label' => __( 'Hover Color', 'landshopcore' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#55C882',
                'selectors' => [
                    '{{WRAPPER}}:hover .counter-icon' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'hover_icon_background',
                'label' => __( 'Background', 'landshopcore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}}:hover .counter-icon',
            ]
        );               
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'hover_icon_border',
                'label' => __( 'Border', 'landshopcore' ),
                'selector' => '{{WRAPPER}}:hover .counter-icon',
            ]
        );
        $this->add_responsive_control(
            'hover_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '100',
                    'right' => '100',
                    'bottom' => '100',
                    'left' => '100',
                    'isLinked' => false,
					'unit' => '%',
                ],
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
                    '{{WRAPPER}}:hover .counter-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hover_icon_shadow',
                'label' => __( 'Box Shadow', 'landshopcore' ),
                'selector' => '{{WRAPPER}}:hover .counter-icon',
            ]
        );        
        
        $this->end_controls_tab(); // Hover Style tab end
        $this->end_controls_tabs();// Box Style tabs end  
        $this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_number',
			[
				'label' => __( 'Number', 'landshopcore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->start_controls_tabs('counter_number_tabs');
        $this->start_controls_tab( 'counter_number_tab',
			[
				'label' => __( 'Normal', 'landshopcore' ),
			]
		);
		$this->add_control(
			'number_color',
			[
				'label' => __( 'Text Color', 'landshopcore' ),
				'type' => Controls_Manager::COLOR,
                'default' => '#10131F',
				'selectors' => [
					'{{WRAPPER}} .landshop-counter-number-wrapper' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_number',
				'selector' => '{{WRAPPER}} .landshop-counter-number-wrapper',
			]
		);
        $this->add_responsive_control(
            'counter_number_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .landshop-counter-number-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_responsive_control(
            'counter_number_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .landshop-counter-number-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );      
		$this->add_control(
			'counter_number_transition',
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
					'{{WRAPPER}} .landshop-counter-number-wrapper' => 'transition-duration: {{SIZE}}s',
				],
			]
		);
        $this->end_controls_tab();
        $this->start_controls_tab( 'counter_number_tab_hover',
			[
				'label' => __( 'Hover', 'landshopcore' ),
			]
		);
		$this->add_control(
			'number_color_hover',
			[
				'label' => __( 'Text Color', 'landshopcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .landshop-counter-number-wrapper' => 'color: {{VALUE}};',
				],
			]
		);
        $this->end_controls_tab();
        $this->end_controls_tabs();
		$this->end_controls_section();
				
		$this->start_controls_section(
			'section_star_rating',
			[
				'label' => __( 'Rating', 'landshopcore' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'rating_switch' => 'yes',
                ]
			]
		);
        $this->start_controls_tabs('star_rating_tabs');
        $this->start_controls_tab( 'star_rating_tab',
			[
				'label' => __( 'Normal', 'landshopcore' ),
			]
		);
		$this->add_control(
			'star_rating_color',
			[
				'label' => __( 'Text Color', 'landshopcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .feed-rating' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_responsive_control(
            'star_rating_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .feed-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'star_rating_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .feed-rating' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );      
		$this->add_control(
			'star_rating_transition',
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
					'{{WRAPPER}} .feed-rating' => 'transition-duration: {{SIZE}}s',
				],
			]
		);
        $this->end_controls_tab();
        $this->start_controls_tab( 'star_rating_tab_hover',
			[
				'label' => __( 'Hover', 'landshopcore' ),
			]
		);
		$this->add_control(
			'star_rating_color_hover',
			[
				'label' => __( 'Color', 'landshopcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .feed-rating' => 'color: {{VALUE}};',
				],
			]
		);
        $this->end_controls_tab();
        $this->end_controls_tabs();
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Title', 'landshopcore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->start_controls_tabs('counter_title_tabs');
        $this->start_controls_tab( 'counter_title_tab',
			[
				'label' => __( 'Normal', 'landshopcore' ),
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'landshopcore' ),
				'type' => Controls_Manager::COLOR,
                'default' => '#10131F',
				'selectors' => [
					'{{WRAPPER}} .landshop-counter-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typo',
				'selector' => '{{WRAPPER}} .landshop-counter-title',
			]
		);
        $this->add_responsive_control(
            'counter_title_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .landshop-counter-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_responsive_control(
            'counter_title_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .landshop-counter-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
              
		$this->add_control(
			'counter_title_transition',
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
					'{{WRAPPER}} .landshop-counter-title' => 'transition-duration: {{SIZE}}s',
				],
			]
		);
        $this->end_controls_tab();
        $this->start_controls_tab( 'counter_title_tab_hover',
			[
				'label' => __( 'Hover', 'landshopcore' ),
			]
		);
		$this->add_control(
			'title_color_hover',
			[
				'label' => __( 'Text Color', 'landshopcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .landshop-counter-title' => 'color: {{VALUE}};',
				],
			]
		);
        $this->end_controls_tab();
        $this->end_controls_tabs();
		$this->end_controls_section();
        
	}

	/**
	 * Render counter widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'counter', [
			'class' => 'elementor-counter-number',
			'data-duration' => $settings['duration'],
			'data-to-value' => $settings['ending_number'],
		] );        
		if ( ! empty( $settings['thousand_separator'] ) ) {
			$delimiter = empty( $settings['thousand_separator_char'] ) ? '' : $settings['thousand_separator_char'];
			$this->add_render_attribute( 'counter', 'data-delimiter', $delimiter );
		}
		?>
        <div class="landshop-counter">
            <?php
                if( $settings['icon_type'] == 'img' and !empty(Group_Control_Image_Size::get_attachment_image_html( $settings, 'imagesize', 'image' )) ){
                    $image = Group_Control_Image_Size::get_attachment_image_html( $settings, 'imagesize', 'image' );  
                    echo '<div class="counter-icon">'.$image.'</div>';
                }elseif( $settings['icon_type'] == 'icon' && !empty($settings['counter_icon']['value']) ){
                    echo sprintf( '<div class="counter-icon" >%1$s</div>', landshop_icon_manager::render_icon( $settings['counter_icon'], [ 'aria-hidden' => 'true' ] ) );
                }
            ?>
            <div>
                <h3 class="landshop-counter-number-wrapper">
                    <span class="landshop-counter-number-prefix"><?php echo $settings['prefix']; ?></span><span <?php echo $this->get_render_attribute_string( 'counter' ); ?>><?php echo $settings['starting_number']; ?></span><span class="landshop-counter-number-suffix"><?php echo $settings['suffix']; ?></span>
                </h3>
				<?php if($settings['rating_switch'] == 'yes'): ?>
					<div class="feed-rating">
						<span class="star front"></span>
						<span class="star back" style="width: <?php echo ($settings['feed_rating']['size']*20); ?>%"></span>
					</div>
				<?php endif; ?>
                <?php if ( $settings['title'] ) : ?>
                <div class="landshop-counter-title">
                    <?php echo $settings['title']; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
<?php } }
Plugin::instance()->widgets_manager->register_widget_type( new landshop_Counter_Widget );