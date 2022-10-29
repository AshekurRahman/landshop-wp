<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Codexse_Elementor_Widget_Button extends Widget_Base {

    public function get_name() {
        return 'codexse-button-addons';
    }
    
    public function get_title() {
        return __( 'Button', 'codexse' );
    }

    public function get_icon() {
        return 'codexse-icon eicon-button';
    }

    public function get_categories() {
        return [ 'codexse-addons' ];
    }

    public function get_style_depends(){
        return [
            'codexse-button',
        ];
    }

    public function get_script_depends() {
        return ['counterup', 'codexse-admin'];
    }

    protected function register_controls() {
        
        $this->start_controls_section(
            'button_content',
            [
                'label' => __( 'Button', 'codexse' ),
            ]
        );

            $this->add_control(
                'button_style',
                [
                    'label'   => __( 'Button Style', 'codexse' ),
                    'type'    => 'select',
                    'default' => '1',
                    'options' => [
                        '1'   => __( 'Style One', 'codexse' ),
                        '2'   => __( 'Style Two', 'codexse' ),
                        '3'   => __( 'Style Three', 'codexse' ),
                        '4'   => __( 'Style Four', 'codexse' ),
                        '5'   => __( 'Style Five', 'codexse' ),
                        '6'   => __( 'Style Six', 'codexse' ),
                        '7'   => __( 'Style Seven', 'codexse' ),
                    ]
                ]
            );


            $this->add_control(
                'button_text',
                [
                    'label' => __( 'Text', 'codexse' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Enter your Text', 'codexse' ),
                    'default' => __( 'Click Me', 'codexse' ),
                    'title' => __( 'Enter your Text', 'codexse' ),
                ]
            );

            $this->add_control(
                'button_link',
                [
                    'label' => __( 'Link', 'codexse' ),
                    'type' => Controls_Manager::URL,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'placeholder' => __( 'https://your-link.com', 'codexse' ),
                    'default' => [
                        'url' => '#',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'button_size',
                [
                    'label'   => __( 'Button Size', 'codexse' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'md',
                    'options' => [
                        'sm' => __( 'Small', 'codexse' ),
                        'xs' => __( 'Extra Small', 'codexse' ),
                        'md' => __( 'Medium', 'codexse' ),
                        'lg' => __( 'Large', 'codexse' ),
                        'xl' => __( 'Extra Large', 'codexse' ),
                    ],
                ]
            );

            $this->add_control(
                'button_icon',
                [
                    'label'       => __( 'Icon', 'codexse' ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'button_icon_align',
                [
                    'label'   => __( 'Icon Position', 'codexse' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'right',
                    'options' => [
                        'left'   => __( 'Left', 'codexse' ),
                        'right'  => __( 'Right', 'codexse' ),
                        'top'    => __( 'Top', 'codexse' ),
                        'bottom' => __( 'Bottom', 'codexse' ),
                    ],
                    'condition' => [
                        'button_icon!' => '',
                    ],
                ]
            );

            $this->add_control(
                'icon_specing',
                [
                    'label' => __( 'Icon Spacing', 'codexse' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 150,
                        ],
                    ],
                    'default' => [
                        'size' => 8,
                    ],
                    'condition' => [
                        'button_icon!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .button-align-icon-right .codexse_button_icon'  => 'margin-left: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .button-align-icon-left .codexse_button_icon'   => 'margin-right: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .button-align-icon-top .codexse_button_icon'    => 'margin-bottom: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .button-align-icon-bottom .codexse_button_icon' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'buttonalign',
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
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'codexse_button_style_section',
            [
                'label' => __( 'Button Style', 'codexse' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->start_controls_tabs('button_style_tabs');

                // Button Normal tab Start
                $this->start_controls_tab(
                    'button_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'codexse' ),
                    ]
                );
                    $this->add_control(
                        'codexse_button_text_color',
                        [
                            'label'     => __( 'Text Color', 'codexse' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .codexse-button .cdx-btn' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'button_typography',
                            'label' => __( 'Typography', 'codexse' ),
                            'selector' => '{{WRAPPER}} .codexse-button .cdx-btn',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'label' => __( 'Border', 'codexse' ),
                            'selector' => '{{WRAPPER}} .codexse-button .cdx-btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_border_radius',
                        [
                            'label' => __( 'Border Radius', 'codexse' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .codexse-button .cdx-btn' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_background',
                            'label' => __( 'Background', 'codexse' ),
                            'types' => [ 'classic', 'gradient' ],
                            'fields_options'=>[
                                'background'=>[
                                    'default'=>'classic',
                                ],
                                'color'=>[
                                    'default'=>'#000000',
                                ],
                            ],
                            'selector' => '{{WRAPPER}} .codexse-button .cdx-btn',
                            'separator' => 'before',
                        ]
                    );
                    

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'box_shadow',
                            'label' => __( 'Box Shadow', 'codexse' ),
                            'selector' => '{{WRAPPER}} .codexse-button .cdx-btn',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_padding',
                        [
                            'label' => __( 'Padding', 'codexse' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .codexse-button .cdx-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_margin',
                        [
                            'label' => __( 'Margin', 'codexse' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .codexse-button .cdx-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab(); // Button Normal tab end

                // Button Hover tab start
                $this->start_controls_tab(
                    'button_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'codexse' ),
                    ]
                );

                    $this->add_control(
                        'codexse_buttonhover_text_color',
                        [
                            'label'     => __( 'Text Color', 'codexse' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .codexse-button .cdx-btn:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'buttonhover_border',
                            'label' => __( 'Border', 'codexse' ),
                            'selector' => '{{WRAPPER}} .codexse-button .cdx-btn:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'buttonhover_border_radius',
                        [
                            'label' => __( 'Border Radius', 'codexse' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .codexse-button .cdx-btn:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'buttonhover_background',
                            'label' => __( 'Background', 'codexse' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .codexse-button .cdx-btn:hover:before',
                            'separator' => 'before',
                        ]
                    );
                    
                    $this->add_control(
                        'button_hover_animation',
                        [
                            'label' => __( 'Hover Animation', 'codexse' ),
                            'type' => Controls_Manager::HOVER_ANIMATION,
                        ]
                    );

                $this->end_controls_tab(); // Button Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Button Icon style tab start
        $this->start_controls_section(
            'codexse_button_icon_style_section',
            [
                'label'     => __( 'Icon Style', 'codexse' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'button_icon!' => '',
                ],
            ]
        );

            // Button Icon style tabs start
            $this->start_controls_tabs( 'button_icon_style_tabs' );

                // Button Icon style normal tab start
                $this->start_controls_tab(
                    'buttonicon_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'codexse' ),
                    ]
                );

                    $this->add_control(
                        'codexse_button_icon_color',
                        [
                            'label'     => __( 'Text Color', 'codexse' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .codexse-button .cdx-btn .codexse_button_icon' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_icon_background',
                            'label' => __( 'Icon Background', 'codexse' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .codexse-button .cdx-btn .codexse_button_icon',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'buttonicon_border',
                            'label' => __( 'Border', 'codexse' ),
                            'selector' => '{{WRAPPER}} .codexse-button .cdx-btn .codexse_button_icon',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_bordericon_radius',
                        [
                            'label' => __( 'Border Radius', 'codexse' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .codexse-button .cdx-btn .codexse_button_icon' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_icon_padding',
                        [
                            'label' => __( 'Padding', 'codexse' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .codexse-button .cdx-btn .codexse_button_icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'button_icon_typography',
                            'label' => __( 'Typography', 'codexse' ),
                            'selector' => '{{WRAPPER}} .codexse-button .cdx-btn .codexse_button_icon',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'icon_box_shadow',
                            'label' => __( 'Box Shadow', 'codexse' ),
                            'selector' => '{{WRAPPER}} .codexse-button .cdx-btn .codexse_button_icon',
                        ]
                    );

                $this->end_controls_tab(); // Button Icon style normal tab end

                // Button Icon style Hover tab start
                $this->start_controls_tab(
                    'buttonicon_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'codexse' ),
                    ]
                );

                    $this->add_control(
                        'codexse_button_iconhover_color',
                        [
                            'label'     => __( 'Text Color', 'codexse' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .codexse-button .cdx-btn:hover .codexse_button_icon' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_iconhover_background',
                            'label' => __( 'Icon Background', 'codexse' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .codexse-button .cdx-btn:hover .codexse_button_icon',
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab(); // Button Icon style hover tab end

            $this->end_controls_tabs(); // Button Icon style tabs end

        $this->end_controls_section(); // Button Icon style tab end

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        $this->add_render_attribute( 'codexse_button', 'class', 'codexse-button' );
        $this->add_render_attribute( 'codexse_button', 'class', 'codexse-btn-style-'. $settings['button_style'] );
        
        if( !empty( $settings['button_icon']['value'] ) ){
            $this->add_render_attribute( 'codexse_button', 'class', 'button-align-icon-'. $settings['button_icon_align'] );
        }

        $button_text  = ! empty( $settings['button_text'] ) ? $settings['button_text'] : '';
        $button_icon  = ! empty( $settings['button_icon']['value'] ) ? Codexse_Icon_manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] ) : '';

        // URL Generate
        if ( ! empty( $settings['button_link']['url'] ) ) {
            
            $this->add_link_attributes( 'url', $settings['button_link'] );

            $this->add_render_attribute( 'url', 'class', 'cdx-btn' );
            $this->add_render_attribute( 'url', 'class', 'codexse-btn-size-'. $settings['button_size'] );

            if ( $settings['button_hover_animation'] ) {
                $this->add_render_attribute( 'url', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
            }

            $button_text = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $button_text );
        }

        if( !empty( $settings['button_icon']['value'] ) ){
            $button_text = sprintf( '<a %1$s><span class="codexse_button_txt">%2$s</span><span class="codexse_button_icon">%3$s</span></a>', $this->get_render_attribute_string( 'url' ), wp_kses_post( $settings['button_text'] ), $button_icon );
        }
        if( !empty( $button_text ) ){
            printf( '<div %1$s>%2$s</div>', $this->get_render_attribute_string( 'codexse_button' ), $button_text );
        }
    }
}
