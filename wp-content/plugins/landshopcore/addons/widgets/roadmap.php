<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class landshop_road_map_widget extends Widget_Base{

	public function get_name(){
		return "road-map";
	}    
    
	public function get_title(){
		return __( 'Road map ','landshopcore' );
	}
    
	public function get_categories() {
		return [ 'landshopcore' ];
	}
    
	public function get_icon() {
		return 'landshop-icon eicon-sitemap';
	}

    protected function  register_controls(){
        $this->start_controls_section(
            'roadmap_content',
            [
                'label' => __( 'Road Map', 'landshopcore' ),
            ]
        );
        
            $repeater = new Repeater();
            $repeater->start_controls_tabs('roadmap_content_item_area_tabs');

                $repeater->start_controls_tab(
                    'roadmap_content_item_area',
                    [
                        'label' => __( 'Content', 'landshopcore' ),
                    ]
                );                   
                    
                    $repeater->add_control(
                        'roadmap_title',
                        [
                            'label'   => esc_html__( 'Title', 'landshopcore' ),
                            'type'    => Controls_Manager::TEXT,
                            'default' => esc_html__( 'Tab #1', 'landshopcore' ),
                        ]
                    );
                     $repeater->add_control(
                        'roadmap_content',
                        [
                            'label' => __( 'Description', 'landshopcore' ),
                            'type' => Controls_Manager::WYSIWYG,
                            'title' => __( 'Description', 'landshopcore' ),
                            'show_label' => false,
                            'default' => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking opposd.', 'landshopcore' ),
                        ]
                    );
                    
                    $repeater->add_control(
                        'roadmap_year',
                        [
                            'label'   => esc_html__( 'Year', 'landshopcore' ),
                            'type'    => Controls_Manager::TEXT,
                            'default' => esc_html__( '2010', 'landshopcore' ),
                        ]
                    );

                $repeater->end_controls_tab();// Tab Content area end

                // Style area start
                $repeater->start_controls_tab(
                    'roadmap_item_style_area',
                    [
                        'label' => __( 'Style', 'landshopcore' ),
                    ]
                );
        
                    $repeater->add_control(
                        'roadmap_title_color',
                        [
                            'label'     => esc_html__( 'Title Color', 'landshopcore' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .roadmap-list {{CURRENT_ITEM}} .maptitle' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    
                    $repeater->add_control(
                        'roadmap_content_color',
                        [
                            'label'     => esc_html__( 'Content Color', 'landshopcore' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .roadmap-list {{CURRENT_ITEM}} .mapcontent' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    
                    $repeater->add_control(
                        'roadmap_year_color',
                        [
                            'label'     => esc_html__( 'Year Color', 'landshopcore' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .roadmap-list {{CURRENT_ITEM}} .mapyear' => '-webkit-text-stroke-color: {{VALUE}}',
                            ],
                        ]
                    );
                    
                    $repeater->add_control(
                        'roadmap_box_color',
                        [
                            'label'     => esc_html__( 'Dot Color', 'landshopcore' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .roadmap-list {{CURRENT_ITEM}} .mapbox' => 'border-color: {{VALUE}}',
                                '{{WRAPPER}} .roadmap-list {{CURRENT_ITEM}}:after' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                $repeater->end_controls_tab(); // Style area end

            $repeater->end_controls_tabs();

            $this->add_control(
                'landshop_roadmap_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => array_values( $repeater->get_controls() ),
                    'default' => [
                        [
                            'roadmap_title' => esc_html__( 'Startup Agency', 'landshopcore' ),
                            'roadmap_content' => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking opposd.','landshopcore' ),
                            'roadmap_year' => esc_html__( '2018','landshopcore' ),
                        ],
                        [
                            'roadmap_title' => esc_html__( 'Startup Agency', 'landshopcore' ),
                            'roadmap_content' => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking opposd.','landshopcore' ),
                            'roadmap_year' => esc_html__( '2018','landshopcore' ),
                        ],
                        [
                            'roadmap_title' => esc_html__( 'Startup Agency', 'landshopcore' ),
                            'roadmap_content' => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking opposd.','landshopcore' ),
                            'roadmap_year' => esc_html__( '2018','landshopcore' ),
                        ],
                    ],
                    'title_field' => '{{{ roadmap_title }}}',
                ]
            );
            
        $this->end_controls_section();
        
        // Road map style tab section
        $this->start_controls_section(
            'landshop_readmap_style_section',
            [
                'label' => __( 'Card Box', 'landshopcore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->start_controls_tabs('readmap_box_style_tab');
        $this->start_controls_tab( 'readmap_box_normal',
			[
				'label' => __( 'Normal', 'landshopcore' ),
			]
		);
        
        $this->add_responsive_control(
            'readmap_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .roadmap-list .mapbox' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'readmap_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}}.roadmap-list .mapbox' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'readmap_background',
                'label' => __( 'Background', 'landshopcore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}}.roadmap-list .mapbox',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'readmap_overlay_background',
                'label' => __( 'Background', 'landshopcore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}}.roadmap-list .mapbox:before',
            ]
        );

        $this->add_responsive_control(
            'readmap_text_align',
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
                    '{{WRAPPER}}.roadmap-list .mapbox' => 'text-align: {{VALUE}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'readmap_border',
                'label' => __( 'Border', 'landshopcore' ),
                'selector' => '{{WRAPPER}}.roadmap-list .mapbox',
            ]
        );
        $this->add_responsive_control(
            'readmap_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}}.roadmap-list .mapbox' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'readmap_box_shadow',
                'label' => __( 'Box Shadow', 'landshopcore' ),
                'selector' => '{{WRAPPER}}.roadmap-list .mapbox',
            ]
        );

        
        $this->add_control(
			'readmap_box_transform',
			[
				'label' => __( 'Transform', 'landshopcore' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'translateY(0)',
				'selectors' => [
					'{{WRAPPER}}.roadmap-list .mapbox' => 'transform: {{VALUE}}',
				],
			]
		);
        
		$this->add_control(
			'readmap_box_transition',
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
					'{{WRAPPER}}.roadmap-list .mapbox' => 'transition-duration: {{SIZE}}s',
				],
			]
		);
		$this->end_controls_tab();

             
        // Hover style tab Start
        $this->start_controls_tab(
            'readmap_box_hover',
            [
                'label' => __( 'Hover', 'landshopcore' ),
            ]
        );
        
        
              
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'readmap_hover_background',
                'label' => __( 'Background', 'landshopcore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}}.roadmap-list .mapbox:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'readmap_hover_overlay_background',
                'label' => __( 'Overlay', 'landshopcore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}}.roadmap-list .mapbox:hover:before',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'readmap_border_hover',
                'label' => __( 'Border', 'landshopcore' ),
                'selector' => '{{WRAPPER}}.roadmap-list .mapbox:hover',
            ]
        );
        $this->add_responsive_control(
            'readmap_hover_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}}.roadmap-list .mapbox:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'readmap_box_hover_shadow',
                'label' => __( 'Box Shadow', 'landshopcore' ),
                'selector' => '{{WRAPPER}}.roadmap-list .mapbox:hover',
            ]
        );
        $this->add_control(
			'readmap_box_hover_transform',
			[
				'label' => __( 'Transform', 'landshopcore' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'translateY(0)',
				'selectors' => [
					'{{WRAPPER}}.roadmap-list .mapbox:hover' => 'transform: {{VALUE}}',
				],
			]
		);
        
        $this->end_controls_tab(); // Hover style tab end        
        $this->end_controls_tabs();// Box style tabs end  
        $this->end_controls_section(); // Road map Box section style end
        
        
        // Road map style tab section
        $this->start_controls_section(
            'box_title_section',
            [
                'label' => __( 'Title', 'landshopcore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->start_controls_tabs('box_title_style_tab');
        
        $this->start_controls_tab( 'box_title_normal',
			[
				'label' => __( 'Normal', 'landshopcore' ),
			]
		);        
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'readmap_title_typography',
                'selector' => '{{WRAPPER}}.roadmap-list .mapbox .maptitle',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'landshopcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.roadmap-list .mapbox .maptitle' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}}.roadmap-list .mapbox .maptitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}}.roadmap-list .mapbox .maptitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
                
		$this->add_control(
			'readmap_title_transition',
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
					'{{WRAPPER}}.roadmap-list .mapbox .maptitle' => 'transition-duration: {{SIZE}}s',
				],
			]
		);
        
        $this->end_controls_tab(); // Hover style tab end
         
        $this->start_controls_tab( 'box_title_hover',
			[
				'label' => __( 'Hover', 'landshopcore' ),
			]
		);        
        
        $this->add_control(
            'title_hover_color',
            [
                'label' => __( 'Color', 'landshopcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.roadmap-list .mapbox .maptitle:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_tab(); // Hover style tab end
        $this->end_controls_tabs();// Box style tabs end  
        $this->end_controls_section();
         
        
        // Road map style tab section
        $this->start_controls_section(
            'box_content_section',
            [
                'label' => __( 'Content', 'landshopcore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'readmap_content_typography',
                'selector' => '{{WRAPPER}}.roadmap-list .mapbox .mapcontent',
            ]
        );
        $this->add_control(
            'content_color',
            [
                'label' => __( 'Color', 'landshopcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.roadmap-list .mapbox .mapcontent' => 'color: {{VALUE}};',
                ],
            ]
        );
                
        $this->add_responsive_control(
            'content_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}}.roadmap-list .mapbox .mapcontent' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}}.roadmap-list .mapbox .mapcontent' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->end_controls_section();
        
        // Road map style tab section
        $this->start_controls_section(
            'box_year_section',
            [
                'label' => __( 'Year', 'landshopcore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'readmap_year_typography',
                'selector' => '{{WRAPPER}}.roadmap-list .mapyear',
            ]
        );
        $this->add_control(
            'year_color',
            [
                'label' => __( 'Color', 'landshopcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.roadmap-list .mapyear' => '-webkit-text-stroke-color: {{VALUE}};',
                ],
            ]
        );
                
        $this->add_responsive_control(
            'year_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}}.roadmap-list .mapyear' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'year_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}}.roadmap-list .mapyear' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->end_controls_section();
        
    }
    
    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();
        $this->add_render_attribute( 'roadmap_attr', 'class', 'roadmap-area' );
        $this->add_render_attribute( 'roadmap_menu_attr', 'class', 'roadmap-nav');
        $id = $this->get_id();
        
        echo '<div '.$this->get_render_attribute_string( 'roadmap_attr' ).' >';
            echo '<ul class="roadmap-list">';
                foreach ( $settings['landshop_roadmap_list'] as $item ) {                            
                    echo '<li class="roadmap-item elementor-repeater-item-'.$item['_id'].'" >';
                        echo '<div class="mapbox">';
                            if(!empty($item['roadmap_title'])){
                                echo '<h3 class="maptitle">'.esc_html($item['roadmap_title']).'</h3>';
                            } 
                            if(!empty($item['roadmap_content'])){
                                echo '<div class="mapcontent">'.wp_kses_post($item['roadmap_content']).'</div>';
                            }                        
                        echo '</div>';
                        if(!empty($item['roadmap_year'])){
                            echo '<h4 class="mapyear">'.esc_html($item['roadmap_year']).'</h4>';
                        } 
                    echo '</li>';
                }
            echo '</ul>';
        echo '</div>';
    }

}
Plugin::instance()->widgets_manager->register_widget_type( new landshop_road_map_widget );