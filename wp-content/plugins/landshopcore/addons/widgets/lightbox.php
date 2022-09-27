<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor play box widget.
 *
 * Elementor widget that displays an escalating play box bar.
 *
 * @since 1.0.0
 */
class landshop_Play_Box_Widget extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve play box widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'landshop_lightbox_addons';
    }

    /**
     * Get widget title.
     *
     * Retrieve play box widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Play Button', 'landshopcore' );
    }

    
    public function get_categories() {
        return [ 'landshopcore' ];
    }
    
    /**
     * Get widget icon.
     *
     * Retrieve play box widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'landshop-icon eicon-youtube';
    }
    

    public function get_script_depends() {
        return [
            'lity',
        ];
    }
    
    
    public function get_style_depends() {
        return [
            'lity',
        ];
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
		return [ 'lightbox', 'play button', 'popup', 'play' ];
	}

    

    /**
     * Register play box widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_play_box',
            [
                'label' => __( 'Play Box', 'landshopcore' ),
            ]
        );
        
        
        $this->add_control(
            'icon_format',
            [
                'label' => __( 'Label Format', 'landshopcore' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon_f',
                'options' => [
                    'icon_f' => __( 'Icon Format', 'landshopcore' ),
                    'text_f' => __( 'Text Format', 'landshopcore' ),
                ],
            ]
        );
        
        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'landshopcore' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Play',
                'condition' => [
                    'icon_format' => 'text_f',
                ]
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
                'condition' => [
                    'icon_format' => 'icon_f'
                ]
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
            'box_icon',
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
            'button_link',
            [
                'label' => __( 'Button Link', 'landshopcore' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'landshopcore' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );
        
        $this->add_control(
            'button_desc',
            [
                'label' => __( 'Description', 'landshopcore' ),
                'type' => Controls_Manager::WYSIWYG,
            ]
        );
        
        $this->add_control(
            'enable_lightbox',
            [
                'label' => __( 'Enable Lightbox', 'landshopcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'landshopcore' ),
                'label_off' => __( 'Hide', 'landshopcore' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'enable_wave',
            [
                'label' => __( 'Enable Wave', 'landshopcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'landshopcore' ),
                'label_off' => __( 'Hide', 'landshopcore' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->end_controls_section();
        // Play Box Style tab section
        $this->start_controls_section(
            'landshop_play_box_style_section',
            [
                'label' => __( 'Box', 'landshopcore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );        
         $this->add_responsive_control(
            'sectopm_text_align',
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
                    '{{WRAPPER}} .landshop-play-button' => 'text-align: {{VALUE}};',
                ],
                'default' => 'left',
                'separator' =>'before',
            ]
        );   
        $this->add_responsive_control(
            'play_box_width',
            [
                'label' => __( 'Width', 'landshopcore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw', 'vh', 'em', 'rem' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1920,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .landshop-play-button,{{WRAPPER}}' => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );        
        
        $this->add_responsive_control(
            'play_box_height',
            [
                'label' => __( 'Height', 'landshopcore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw', 'vh', 'em', 'rem' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 3000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .landshop-play-button' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
                        
        $this->add_responsive_control(
            'play_box_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => true
                ],
                'size_units' => [ 'px', '%', 'vw', 'vh', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .landshop-play-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'play_box_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => true
                ],
                'size_units' => [ 'px', '%', 'vw', 'vh', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .landshop-play-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'play_box_background',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .landshop-play-button',
            ]
        );
        $this->add_responsive_control(
            'box_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'vw', 'vh', 'em', 'rem' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => true,
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
                    '{{WRAPPER}} .landshop-play-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );        
        $this->add_responsive_control(
            'play_box_transform',
            [
                'label' => __( 'Transform', 'landshopcore' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'translateY(0)',
                'selectors' => [
                    '{{WRAPPER}} .landshop-play-button' => 'transform: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
        
        
        $this->start_controls_section(
            'wave_style_section',
            [
                'label' => __( 'Wave', 'landshopcore' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_wave' => 'yes',
                ]
            ]
        );    
        $this->add_responsive_control(
            'wave_width',
            [
                'label' => __( 'Width', 'landshopcore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw', 'vh', 'em', 'rem' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1920,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .landshop-play-button .waves-block' => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );        
        
        $this->add_responsive_control(
            'wave_height',
            [
                'label' => __( 'Height', 'landshopcore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw', 'vh', 'em', 'rem' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 3000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .landshop-play-button .waves-block' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'wave_background',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .landshop-play-button .waves-block .waves',
            ]
        );
        $this->add_responsive_control(
            'wave_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'vw', 'vh', 'em', 'rem' ],
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
                    '{{WRAPPER}} .landshop-play-button .waves-block .waves' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wave_shadow',
                'label' => __( 'Box Shadow', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .landshop-play-button .waves-block .waves',
            ]
        );    
        $this->end_controls_section();
                
        // Play Box Style tab section
        $this->start_controls_section(
            'box_button_section',
            [
                'label' => __( 'Button', 'landshopcore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->start_controls_tabs('box_button_style_tab');
        
        $this->start_controls_tab( 'box_button_normal',
            [
                'label' => __( 'Normal', 'landshopcore' ),
            ]
        );        
        
        $this->add_responsive_control(
            'button_width',
            [
                'label' => __( 'Width', 'landshopcore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw', 'vh', 'em', 'rem' ],
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
                    '{{WRAPPER}} .play-button .xicon' => 'width: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}};display: inline-block;',
                ],
            ]
        );        
        
        $this->add_responsive_control(
            'button_height',
            [
                'label' => __( 'Height', 'landshopcore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw', 'vh', 'em', 'rem' ],
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
                    '{{WRAPPER}} .play-button .xicon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'button_line_height',
            [
                'label' => __( 'Line Height', 'landshopcore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw', 'vh', 'em', 'rem' ],
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
                    '{{WRAPPER}} .play-button .xicon' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'icon_format' => 'icon_f',
                ]
            ]
        );
        $this->add_responsive_control(
            'button_size',
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
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .play-button .xicon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'icon_format' => 'icon_f',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_text_typo',
                'selector' => '{{WRAPPER}} .play-button .xicon',
                'condition' => [
                    'icon_format' => 'text_f',
                ]
            ]
        );
        $this->add_control(
            'button_color',
            [
                'label' => __( 'Color', 'landshopcore' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#55C882',
                'selectors' => [
                    '{{WRAPPER}} .play-button .xicon' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_background',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .play-button .xicon',
            ]
        );
        
         $this->add_responsive_control(
            'button_text_align',
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
                    '{{WRAPPER}} .play-button .xicon' => 'text-align: {{VALUE}};',
                ],
                'default' => 'center',
                'separator' =>'before',
            ]
        );
                
        $this->add_responsive_control(
            'button_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => true
                ],
                'size_units' => [ 'px', '%', 'vw', 'vh', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .play-button .xicon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => true
                ],
                'size_units' => [ 'px', '%', 'vw', 'vh', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .play-button .xicon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => __( 'Border', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .play-button .xicon',
            ]
        );
        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '100',
                    'right' => '100',
                    'bottom' => '100',
                    'left' => '100',
                    'isLinked' => true,
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
                    '{{WRAPPER}} .play-button .xicon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_shadow',
                'label' => __( 'Box Shadow', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .play-button .xicon',
            ]
        );        
        $this->add_control(
            'box_button_transition',
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
                    '{{WRAPPER}} .play-button .xicon' => 'transition-duration: {{SIZE}}s',
                ],
            ]
        );            
        $this->end_controls_tab(); // Hover Style tab end
        
        
        $this->start_controls_tab( 'box_button_hover',
            [
                'label' => __( 'Hover', 'landshopcore' ),
            ]
        );        
        $this->add_control(
            'hover_button_color',
            [
                'label' => __( 'Hover Color', 'landshopcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .play-button .xicon:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'hover_button_background',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .play-button .xicon:hover',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'hover_button_border',
                'label' => __( 'Border', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .play-button .xicon:hover',
            ]
        );
        $this->add_responsive_control(
            'hover_button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '100',
                    'right' => '100',
                    'bottom' => '100',
                    'left' => '100',
                    'isLinked' => true,
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
                    '{{WRAPPER}} .play-button .xicon:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hover_button_shadow',
                'label' => __( 'Box Shadow', 'landshopcore' ),
                'selector' => '{{WRAPPER}} .play-button .xicon:hover',
            ]
        );        
        
        $this->end_controls_tab(); // Hover Style tab end
        
        
        $this->end_controls_tabs();// Box Style tabs end  
        $this->end_controls_section();
                
        // Feature Style tab section
        $this->start_controls_section(
            'box_content_section',
            [
                'label' => __( 'Description', 'landshopcore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .desc',
            ]
        );
        $this->add_control(
            'content_color',
            [
                'label' => __( 'Color', 'landshopcore' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#63688e',
                'selectors' => [
                    '{{WRAPPER}} .desc' => 'color: {{VALUE}};',
                ],
            ]
        );
                
        $this->add_responsive_control(
            'content_margin',
            [
                'label' => __( 'Margin', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => false
                ],
                'selectors' => [
                    '{{WRAPPER}} .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'content_padding',
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
                    '{{WRAPPER}} .desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
         $this->add_responsive_control(
            'desc_align',
            [
                'label' => __( 'Alignment', 'landshopcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'align-items: center; flex-direction: row-reverse;' => [
                        'title' => __( 'Left', 'landshopcore' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'align-items: center; flex-wrap: wrap; justify-content: center; flex-direction: column;' => [
                        'title' => __( 'Center', 'landshopcore' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'align-items: center;' => [
                        'title' => __( 'Right', 'landshopcore' ),
                        'icon' => 'fa fa-align-right',
                    ],
                    'align-items: center; flex-wrap: wrap; justify-content: center; flex-direction: column-reverse;' => [
                        'title' => __( 'Top', 'landshopcore' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .landshop-play-button' => 'display: flex; {{VALUE}}',
                ],
                'separator' =>'before',
            ]
        ); 
        $this->end_controls_section();                
        
    }

    /**
     * Render play box widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $html_output = '';
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'play_box_attr', 'class', 'landshop-play-button' );
   
        // Link Generate
        if ( !empty( $settings['button_link']['url'] ) ) {
            $this->add_render_attribute( 'play_button_attr', 'href', esc_url($settings['button_link']['url']) );
            if ( $settings['button_link']['is_external'] ) {
                $this->add_render_attribute( 'play_button_attr', 'target', '_blank' );
            }
            
            if ( !empty( $settings['button_link']['nofollow'] ) ) {
                $this->add_render_attribute( 'play_button_attr', 'rel', 'nofollow' );
            }
            
            $this->add_render_attribute( 'play_button_attr', 'class', 'play-button' );
            
            if( $settings['enable_lightbox'] == 'yes' ){
                $this->add_render_attribute( 'play_button_attr', 'data-lity', 'true' );
            }
        
        }
        
        $html_output .= '<div '.$this->get_render_attribute_string( 'play_box_attr' ).' >';
            $html_output .= '<a '.$this->get_render_attribute_string( 'play_button_attr' ).' >';
                if( $settings['enable_wave'] == 'yes' ){
                    $html_output .= '<div class="waves-block"><div class="waves wave-1"></div><div class="waves wave-2"></div><div class="waves wave-3"></div><div class="waves wave-4"></div></div>';
                }
                if( $settings['icon_format'] == 'icon_f' ){
                    if( $settings['icon_type'] == 'img' and !empty(Group_Control_Image_Size::get_attachment_image_html( $settings, 'imagesize', 'image' )) ){
                        $image = Group_Control_Image_Size::get_attachment_image_html( $settings, 'imagesize', 'image' );  
                        $html_output .= '<div class="xicon">'.$image.'</div>';
                    }elseif( $settings['icon_type'] == 'icon' && !empty($settings['box_icon']['value']) ){
                        $html_output .= sprintf( '<div class="xicon" >%1$s</div>', landshop_icon_manager::render_icon( $settings['box_icon'], [ 'aria-hidden' => 'true' ] ) );
                    }
                }else{
                    $html_output .= '<span class="text">'.esc_html($settings['button_text']).'</span>';
                }
            $html_output .= '</a>';
            if(!empty($settings['button_desc'])){
                $html_output .= '<div class="desc">'.wp_kses_post($settings['button_desc']).'</div>';
            }
        $html_output .= '</div>';
        
        echo $html_output;
        
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new landshop_Play_Box_Widget );