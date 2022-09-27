<?php
namespace Elementor;

// Elementor Classes
use Elementor\Core\Schemes\Color as Scheme_Color;
use Elementor\Core\Schemes\Typography as Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class landshop_Audio_Player extends Widget_Base {

    public function get_name() {
        return "landshop_Audio_Player";
    }

    public function get_title() {
        return esc_html__( "Audio Player", 'landshopcore' );
    }

    public function get_icon() {
        return 'landshop-icon eicon-headphones';
    }

    public function get_categories() {
        return array( 'landshopcore' );
    }
    
    public function get_script_depends() {
        return [
            'plyr',
            'polyfilled',
            'addons-active',
        ];
    }

	public function get_keywords() {
		return [ 'audio', 'music', 'player' ];
	}

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'General Options', 'landshopcore' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'src_type',
            [
                'label' => esc_html__( 'Audio Source', 'landshopcore' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'upload',
                'options' => [
                    'upload' => esc_html__( 'Upload Audio', 'landshopcore' ),
                    'link' => esc_html__( 'Audio Link', 'landshopcore' ),
                ],
            ]
        );

        $this->add_control(
            'audio_upload',
            array(
                'label' => esc_html__( 'Upload Audio', 'landshopcore' ),
                'type'  => Controls_Manager::MEDIA,
                'media_type' => 'audio',
                'condition' => array(
                    'src_type' => 'upload',
                ),
            )
        );

        $this->add_control(
            'audio_link',
            [
                'label' => esc_html__( 'Audio Link', 'landshopcore' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://example.com/music-name.mp3', 'landshopcore' ),
                'show_external' => false,
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'src_type'    =>  'link',
                ]
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'landshopcore' ),
                'type' => Controls_Manager::SWITCHER,
                'description' => __('Note: Mobile browsers don’t allow autoplay for Audio. Some desktop or laptop browsers also automatically block videos from automatically playing or may automatically mute the audio.', 'landshopcore'),
                'label_on' => esc_html__( 'Yes', 'landshopcore' ),
                'label_off' => esc_html__( 'No', 'landshopcore' ),
                'return_value' => 'true',
                'default' => '',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'muted',
            [
                'label' => esc_html__( 'Muted', 'landshopcore' ),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('Enable this to start playback muted. This is also usefull if you experience autoplay is not working from your browser.', 'landshopcore'),
                'label_on' => esc_html__( 'Yes', 'landshopcore' ),
                'label_off' => esc_html__( 'No', 'landshopcore' ),
                'return_value' => 'true',
                'default' => '',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => esc_html__( 'Loop', 'landshopcore' ),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('Loop the current media. ', 'landshopcore'),
                'label_on' => esc_html__( 'Yes', 'landshopcore' ),
                'label_off' => esc_html__( 'No', 'landshopcore' ),
                'return_value' => 'true',
                'default' => '',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'invert_time',
            [
                'label' => esc_html__( 'Display Time As Countdown', 'landshopcore' ),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('Display the current time as a countdown rather than an incremental counter.', 'landshopcore'),
                'label_on' => esc_html__( 'Yes', 'landshopcore' ),
                'label_off' => esc_html__( 'No', 'landshopcore' ),
                'return_value' => 'true',
                'default' => 'true',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'seek_time',
            [
                'label' => esc_html__( 'Seek Time', 'landshopcore' ),
                'type' => Controls_Manager::NUMBER,
                'description' => esc_html__('The time, in seconds, to seek when a user hits fast forward or rewind.', 'landshopcore'),
                'min' => 5,
                'max' => 100,
                'step' => 1,
                'default' => 10,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tooltips_seek',
            [
                'label' => esc_html__( 'Display Seek Tooltip', 'landshopcore' ),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('Display a seek tooltip to indicate on click where the media would seek to.', 'landshopcore'),
                'label_on' => esc_html__( 'Yes', 'landshopcore' ),
                'label_off' => esc_html__( 'No', 'landshopcore' ),
                'return_value' => 'true',
                'default' => 'true',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'speed_selected',
            [
                'label' => esc_html__( 'Initial Speed', 'landshopcore' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'speed_1',
                'options' => [
                    'speed_.5'  => esc_html__( '0.5', 'landshopcore' ),
                    'speed_.75' => esc_html__( '0.75', 'landshopcore' ),
                    'speed_1' => esc_html__( '1', 'landshopcore' ),
                    'speed_1.25' => esc_html__( '1.25', 'landshopcore' ),
                    'speed_1.5' => esc_html__( '1.5', 'landshopcore' ),
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'preload',
            [
                'label' => esc_html__( 'Preload', 'landshopcore' ),
                'description' => __( 'Specifies how the the audio should be loaded when the page loads. <a target="_blank" href="https://www.w3schools.com/tags/att_audio_preload.asp">Learn More</a>', 'landshopcore' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'upload',
                'options' => [
                    'auto' => esc_html__( 'Auto', 'landshopcore' ),
                    'metadata' => esc_html__( 'Metadata', 'landshopcore' ),
                    'none' => esc_html__( 'None', 'landshopcore' ),
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'controls',
            [
                'label' => esc_html__( 'Control Options', 'landshopcore' ),
                'type' => Controls_Manager::SELECT2,
                'description'   =>  esc_html__('Add/Remove your prefered audio control options'),
                'multiple' => true,
                'options' => [
                    'play' => esc_html__( 'Play Icon', 'landshopcore' ),
                    'progress' => esc_html__( 'Progress Bar', 'landshopcore' ),
                    'mute' => esc_html__( 'Mute Icon', 'landshopcore' ),
                    'volume' => esc_html__( 'Volume Bar', 'landshopcore' ),
                    'settings' => esc_html__( 'Settings Icon', 'landshopcore' ),
                    'airplay' => esc_html__( 'Airplay Icon', 'landshopcore' ),
                    'download' => esc_html__( 'Download Button', 'landshopcore' ),
                ],
                'default' => [ 'play', 'progress', 'mute', 'volume', 'settings' ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'debug_section',
            [
                'label' => esc_html__( 'Debugging', 'landshopcore' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

            $this->add_control(
                'debug_mode',
                [
                    'label' => esc_html__( 'Debug Mode', 'landshopcore' ),
                    'type' => Controls_Manager::SWITCHER,
                    'description' => esc_html__('Enable it when the player does not work properly. When debug is enable, the browser will show the informations about this player in the browser console. This is helpful for developer.', 'landshopcore'),
                    'label_on' => esc_html__( 'Yes', 'landshopcore' ),
                    'label_off' => esc_html__( 'No', 'landshopcore' ),
                    'return_value' => 'true',
                    'default' => 'false',
                ]
            );

        $this->end_controls_section();

        // Feature Style tab section
        $this->start_controls_section(
            'box_icon_section',
            [
                'label' => __( 'Play Icon', 'landshopcore' ),
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
				'selectors' => [
					'{{WRAPPER}} .plyr__control[data-plyr="play"]' => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
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
				'selectors' => [
					'{{WRAPPER}} .plyr__control[data-plyr="play"]' => 'height: {{SIZE}}{{UNIT}};',
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
				'selectors' => [
					'{{WRAPPER}} .plyr__control[data-plyr="play"]' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __( 'Size', 'landshopcore' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .plyr__control[data-plyr="play"]' => 'font-size: {{SIZE}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .plyr__control[data-plyr="play"]',                
                'condition' => [
                    'icon_type' => 'text',
                ]
            ]
        );
        
        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Color', 'landshopcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .plyr__control[data-plyr="play"]' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_background',
                'label' => __( 'Background', 'landshopcore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .plyr__control[data-plyr="play"]',
            ]
        );
        $this->add_responsive_control(
            'icon_alignment',
            [
                'label' => __( 'Alignment', 'landshopcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'landshopcore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'landshopcore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'landshopcore' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .plyr__control[data-plyr="play"]' => 'text-align: {{VALUE}}',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_responsive_control(
            'icon_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .plyr__control[data-plyr="play"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'icon_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .plyr__control[data-plyr="play"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'label' => __( 'Border', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .plyr__control[data-plyr="play"]',
            ]
        );
        $this->add_responsive_control(
            'icon_border_radius',
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
                    '{{WRAPPER}} .plyr__control[data-plyr="play"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_shadow',
                'label' => __( 'Box Shadow', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .plyr__control[data-plyr="play"]',
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
					'{{WRAPPER}} .plyr__control[data-plyr="play"]' => 'transition-duration: {{SIZE}}s',
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
                'selectors' => [
                    '{{WRAPPER}} .plyr__control[data-plyr="play"]:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'hover_icon_background',
                'label' => __( 'Background', 'landshopcore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .plyr__control[data-plyr="play"]:hover',
            ]
        );               
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'hover_icon_border',
                'label' => __( 'Border', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .plyr__control[data-plyr="play"]:hover',
            ]
        );
        $this->add_responsive_control(
            'hover_icon_border_radius',
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
                    '{{WRAPPER}} .plyr__control[data-plyr="play"]:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hover_icon_shadow',
                'label' => __( 'Box Shadow', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .plyr__control[data-plyr="play"]:hover',
            ]
        );        
        
        $this->end_controls_tab(); // Hover Style tab end
        $this->end_controls_tabs();// Box Style tabs end  
        $this->end_controls_section();
                
        $this->start_controls_section(
            'styling_progress_bar_section',
            [
                'label'     => esc_html__( 'Seek Progress Bar', 'landshopcore' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            // pbar_pointer_color
            $this->add_control(
                'pbar_pointer_color',
                [
                    'label' => esc_html__( 'Bar Pointer Color', 'landshopcore' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .plyr__progress__container input[type=range]::-webkit-slider-thumb' => 'background:{{VALUE}}',
                        '{{WRAPPER}} .plyr__progress__container input[type=range]::-moz-range-thumb' => 'background:{{VALUE}}',
                        '{{WRAPPER}} .plyr__progress__container input[type=range]::-ms-thumb' => 'background:{{VALUE}}',
                    ],
                ]
            );

            // pbar_color
            $this->add_control(
                'pbar_color_1',
                [
                    'label' => esc_html__( 'Bar Color 1', 'landshopcore' ),
                    'desc'  => esc_html__( 'Use RGB color with some opacity. E.g: rgba(255,68,115,0.60). Otherwise buffer color will now show.', 'landshopcore' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .plyr__progress input[type=range]::-webkit-slider-runnable-track' => 'background-color:{{VALUE}}',
                        '{{WRAPPER}} .plyr__progress input[type=range]::-moz-range-track' => 'background-color:{{VALUE}}',
                        '{{WRAPPER}} .plyr__progress input[type=range]::-ms-track' => 'background-color:{{VALUE}}',
                    ],
                ]
            );

            // pbar_color_2
            $this->add_control(
                'pbar_color_2',
                [
                    'label' => esc_html__( 'Bar Color 2', 'landshopcore' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .plyr__progress__container input[type=range]' => 'color:{{VALUE}}',
                    ],
                ]
            );

            // pbar_buffer_color
            $this->add_control(
                'pbar_buffer_color',
                [
                    'label' => esc_html__( 'Buffered Bar Color', 'landshopcore' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .plyr--audio .plyr__progress__buffer' => 'color:{{VALUE}}',
                    ],
                ]
            );

        $this->end_controls_section(); // styling_progress_bar_section end

        $this->start_controls_section(
            'styling_volume_section',
            [
                'label'     => esc_html__( 'Volume Icon', 'landshopcore' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            // volume_icon_bg_color
            $this->add_control(
                'volume_icon_bg_color',
                [
                    'label' => esc_html__( 'BG Color', 'landshopcore' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .plyr__control[data-plyr="mute"]' => 'background-color:{{VALUE}}',
                    ],
                ]
            );

            // volume_icon_color
            $this->add_control(
                'volume_icon_color',
                [
                    'label' => esc_html__( 'Icon Color', 'landshopcore' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .plyr__control[data-plyr="mute"] svg' => 'color:{{VALUE}}',
                    ],
                ]
            );

            // volume_icon_hover_bg_color
            $this->add_control(
                'volume_icon_hover_bg_color',
                [
                    'label' => esc_html__( 'Hover BG Color', 'landshopcore' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .plyr__control[data-plyr="mute"]:hover' => 'background-color:{{VALUE}}',
                    ],
                ]
            );

            // volume_icon_hover_color
            $this->add_control(
                'volume_icon_hover_color',
                [
                    'label' => esc_html__( 'Hover Icon Color', 'landshopcore' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .plyr__control[data-plyr="mute"]:hover svg' => 'color:{{VALUE}}',
                    ],
                ]
            );

            // volume_icon_border
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'volume_icon_border',
                    'label' => esc_html__( 'Border', 'landshopcore' ),
                    'selector' => '{{WRAPPER}} .plyr__control[data-plyr="mute"]'
                ]
            );

            $this->end_controls_section(); // Styling- volume icon section end
            $this->start_controls_section(
                'styling_volume_bar_section',
                [
                    'label'     => esc_html__( 'Volume Bar', 'landshopcore' ),
                    'tab'       => Controls_Manager::TAB_STYLE,
                ]
            );
            // vbar_pointer_color
            $this->add_control(
                'vbar_pointer_color',
                [
                    'label' => esc_html__( 'Bar Pointer Color', 'landshopcore' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .plyr__volume input[type=range]::-webkit-slider-thumb' => 'background:{{VALUE}}',
                        '{{WRAPPER}} .plyr__volume input[type=range]::-moz-range-thumb' => 'background:{{VALUE}}',
                        '{{WRAPPER}} .plyr__volume input[type=range]::-ms-thumb' => 'background:{{VALUE}}',
                    ],
                ]

            );
            // vbar_color
            $this->add_control(
                'vbar_color',
                [
                    'label' => esc_html__( 'Bar Color', 'landshopcore' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .plyr__volume input[type=range]' => 'color:{{VALUE}}',
                    ],
                ]
            );

            // vbar_remaining_color
            $this->add_control(
                'vbar_remaining_color',
                [
                    'label' => esc_html__( 'Bar Empty Color', 'landshopcore' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .plyr__volume input[type=range]::-webkit-slider-runnable-track' => 'background-color:{{VALUE}}',
                        '{{WRAPPER}} .plyr__volume input[type=range]::-moz-range-track' => 'background-color:{{VALUE}}',
                        '{{WRAPPER}} .plyr__volume input[type=range]::-ms-track' => 'background-color:{{VALUE}}',
                    ],
                ]
            );

        $this->end_controls_section(); // style tab volume_section end

        $this->start_controls_section(
            'styling_setting_icon_section',
            [
                'label'     => esc_html__( 'Setting Icon', 'landshopcore' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

            // settings_icon_bg_color
            $this->add_control(
                'settings_icon_bg_color',
                [
                    'label' => esc_html__( 'BG Color', 'landshopcore' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .plyr__control[data-plyr="settings"]' => 'background-color:{{VALUE}}',
                    ],
                ]
            );

            // settings_icon_color
            $this->add_control(
                'settings_icon_color',
                [
                    'label' => esc_html__( 'Icon Color', 'landshopcore' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .plyr__control[data-plyr="settings"] svg' => 'color:{{VALUE}}',
                    ],
                ]
            );

            // settings_icon_hover_bg_color
            $this->add_control(
                'settings_icon_hover_bg_color',
                [
                    'label' => esc_html__( 'Hover BG Color', 'landshopcore' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .plyr__control[data-plyr="settings"]:hover' => 'background-color:{{VALUE}}',
                    ],
                ]
            );

            // settings_icon_hover_color
            $this->add_control(
                'settings_icon_hover_color',
                [
                    'label' => esc_html__( 'Hover Icon Color', 'landshopcore' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .plyr__control[data-plyr="settings"]:hover svg' => 'color:{{VALUE}}',
                    ],
                ]
            );

            // volume_icon_border
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'settings_icon_border',
                    'label' => esc_html__( 'Border', 'landshopcore' ),
                    'selector' => '{{WRAPPER}} .plyr__control[data-plyr="settings"]'
                ]
            );
        $this->end_controls_section(); // Style tab setting_icon_section end

        $this->start_controls_section(
            'styling_others_section',
            [
                'label'     => esc_html__( 'Others', 'landshopcore' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

            // timer_color
            $this->add_control(
                'timer_color',
                [
                    'label' => esc_html__( 'Timer Color', 'landshopcore' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .plyr__controls .plyr__time' => 'color:{{VALUE}}',
                    ],
                ]
            );

        $this->end_controls_section(); // Style tab others_section end

    }

    protected function render() {
        $settings    = $this->get_settings_for_display();

        // audio link
        if($settings['src_type'] == 'upload'){
            $audio_link = $settings['audio_upload']['url'];
        } else {
            $audio_link = $settings['audio_link']['url'];
        }

        $autoplay = $settings['autoplay'] == 'true' ? 'true' : 'false';
        $muted = $settings['muted'] == 'true' ? 'true' : 'false';
        $loop = $settings['loop'] == 'true' ? 'true' : 'false';
        $seek_time = $settings['seek_time'];
        $tooltips_seek = $settings['tooltips_seek'] == 'true' ? 'true' : 'false';
        $invert_time = $settings['invert_time'] == 'true' ? 'true' : 'false';
        $speed_selected = $settings['speed_selected'];
        $speed_selected = substr($speed_selected, 6 );
        $preload = $settings['preload'];
        $controls = $settings['controls'];
        $debug_mode = $settings['debug_mode'] == 'true' ? 'true' : 'false';

        // data settings
        $data_settings = array();
        $data_settings['muted'] = $muted;
        $data_settings['seek_time'] = $seek_time;
        $data_settings['tooltips_seek'] = $tooltips_seek;
        $data_settings['invertTime'] = $invert_time;
        $data_settings['speed_selected'] = $speed_selected;
        $data_settings['controls'] = $controls;
        $data_settings['debug_mode'] = $debug_mode;

        if($audio_link):
            $arr = explode('.', $audio_link);
            $file_ext = end($arr);
        ?>
        <audio
            class="landshopcore_player landshopcore_audio" 
            data-settings='<?php echo wp_json_encode($data_settings); ?>' 
            <?php echo esc_attr($autoplay == 'true' ? 'autoplay allow="autoplay"' : ''); ?>
            <?php echo esc_attr($loop == 'true' ? 'loop' : ''); ?> 
            preload="<?php echo esc_attr($preload); ?>"
        >
            <source
                src="<?php echo esc_url($audio_link); ?>"
                type="audio/<?php echo esc_attr($file_ext); ?>"
            />
        </audio>
        <?php
        else:
            echo '<div class="landshopcore_not_found">';
            echo "<span>". esc_html__('No Audio File Selected/Uploaded', 'landshopcore') ."</span>";
            echo '</div>';
        endif;
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new landshop_Audio_Player );