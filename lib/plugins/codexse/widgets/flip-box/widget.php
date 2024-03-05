<?php
/**
 * Flip Box widget class
 *
 * @package Codexse_Addons
 */
namespace Codexse_Addons\Elementor\Widget;

use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

defined( 'ABSPATH' ) || die();

class Flip_Box extends Base {
    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Flip Box', 'codexse-elementor-addons' );
    }

	public function get_custom_help_url() {
		return 'https://codexseaddons.com/docs/codexse-addons-for-elementor/widgets/flip-box/';
	}

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'cx cx-flip-card1';
    }

    public function get_keywords() {
        return [ 'flip', 'box', 'flip', 'info', 'content', 'animation' ];
    }

	/**
     * Register widget content controls
     */
    protected function register_content_controls() {
		$this->__front_side_content_controls();
		$this->__back_side_content_controls();
		$this->__settings_content_controls();
	}

    protected function __front_side_content_controls() {

        $this->start_controls_section(
            '_section_front',
            [
                'label' => __( 'Front Side', 'codexse-elementor-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'front_icon_type',
            [
                'label' => __( 'Media Type', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'icon',
                'options' => [
                    'none' => [
                        'title' => __( 'None', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-close',
                    ],
                    'icon' => [
                        'title' => __( 'Icon', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-star',
                    ],
                    'image' => [
                        'title' => __( 'Image', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-image',
                    ],
                ],
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        if ( cx_is_elementor_version( '<', '2.6.0' ) ) {
            $this->add_control(
                'front_icon',
                [
                    'label' => __( 'Icon', 'codexse-elementor-addons' ),
                    'type' => Controls_Manager::ICON,
                    'options' => cx_get_codexse_icons(),
                    'default' => 'fa fa-home',
                    'condition' => [
                        'front_icon_type' => 'icon'
                    ],
                ]
            );
        } else {
            $this->add_control(
                'front_selected_icon',
                [
                    'label' => __( 'Icon', 'codexse-elementor-addons' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'front_icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'cx cx-home',
                        'library' => 'codexse-icons',
                    ],
                    'condition' => [
                        'front_icon_type' => 'icon'
                    ],
                ]
            );
        }

        $this->add_control(
            'front_icon_image',
            [
                'label' => __( 'Image', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'front_icon_type' => 'image'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'front_icon_thumbnail',
                'default' => 'thumbnail',
                'exclude' => [
                    'full',
                    'shop_catalog',
                    'shop_single',
                ],
                'condition' => [
                    'front_icon_type' => 'image'
                ]
            ]
        );

        $this->add_control(
            'front_title',
            [
                'label' => __( 'Title', 'codexse-elementor-addons' ),
                'label_block' => true,
                'separator' => 'before',
                'type' => Controls_Manager::TEXT,
                'default' => 'Start Marketing',
                'placeholder' => __( 'Type Flip Box Title', 'codexse-elementor-addons' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'front_description',
            [
                'label' => __( 'Description', 'codexse-elementor-addons' ),
                'description' => cx_get_allowed_html_desc( 'basic' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'consectetur adipiscing elit, sed do<br>eiusmod Lorem ipsum dolor sit amet,<br> consectetur.',
                'placeholder' => __( 'Description', 'codexse-elementor-addons' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'front_text_align',
            [
                'label' => __( 'Alignment', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-front-inner .icon-wrap' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .cx-flip-box-front-inner .cx-text' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();
	}

    protected function __back_side_content_controls() {

        $this->start_controls_section(
            '_section_back',
            [
                'label' => __( 'Back Side', 'codexse-elementor-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'back_icon_type',
            [
                'label' => __( 'Media Type', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'none',
                'options' => [
                    'none' => [
                        'title' => __( 'None', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-close',
                    ],
                    'icon' => [
                        'title' => __( 'Icon', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-star',
                    ],
                    'image' => [
                        'title' => __( 'Image', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-image',
                    ],
                ],
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'back_icon_image',
            [
                'label' => __( 'Image', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'back_icon_type' => 'image'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'back_icon_thumbnail',
                'default' => 'thumbnail',
                'exclude' => [
                    'full',
                    'shop_catalog',
                    'shop_single',
                ],
                'condition' => [
                    'back_icon_type' => 'image'
                ]
            ]
        );

        if ( cx_is_elementor_version( '<', '2.6.0' ) ) {
            $this->add_control(
                'back_icon',
                [
                    'label' => __( 'Icon', 'codexse-elementor-addons' ),
                    'type' => Controls_Manager::ICON,
                    'options' => cx_get_codexse_icons(),
                    'default' => 'fa fa-home',
                    'condition' => [
                        'back_icon_type' => 'icon'
                    ],
                ]
            );
        } else {
            $this->add_control(
                'back_selected_icon',
                [
                    'label' => __( 'Icon', 'codexse-elementor-addons' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'back_icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-smile-wink',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'back_icon_type' => 'icon'
                    ],
                ]
            );
        }

        $this->add_control(
            'back_title',
            [
                'label' => __( 'Title', 'codexse-elementor-addons' ),
                'label_block' => true,
                'separator' => 'before',
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Start Marketing', 'codexse-elementor-addons' ),
                'placeholder' => __( 'Type Flip Box Title', 'codexse-elementor-addons' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'back_description',
            [
                'label' => __( 'Description', 'codexse-elementor-addons' ),
                'description' => cx_get_allowed_html_desc( 'intermediate' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'consectetur adipiscing elit, sed do<br>eiusmod Lorem ipsum dolor sit amet.',
                'placeholder' => __( 'Description', 'codexse-elementor-addons' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'back_text_align',
            [
                'label' => __( 'Alignment', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-back-inner .icon-wrap' => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .cx-flip-box-back-inner .cx-text' => 'text-align: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_section();
	}

    protected function __settings_content_controls() {

        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __( 'Settings', 'codexse-elementor-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'flip_position',
            [
                'label' => __( 'Flip Direction', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left-right',
                'label_block' => false,
                'options' => [
                    'bottom-top' => [
                        'title' => __( 'Bottom To Top', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'left-right' => [
                        'title' => __( 'Left To Right', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

    }

	/**
     * Register widget style controls
     */
    protected function register_style_controls() {
		$this->__common_style_controls();
		$this->__front_side_style_controls();
		$this->__back_side_style_controls();
	}

    protected function __common_style_controls() {

        $this->start_controls_section(
            '_section_common_style',
            [
                'label' => __( 'Common', 'codexse-elementor-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label' => __( 'Height', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-front' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .cx-flip-box-back' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'content_area_border_radius',
            [
                'label' => __( 'Border Radius', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'separator' => 'after',
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-front' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .cx-flip-box-front:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .cx-flip-box-back' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .cx-flip-box-back:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
	}

    protected function __front_side_style_controls() {

        // front side
        $this->start_controls_section(
            '_section_front_style',
            [
                'label' => __( 'Front Side', 'codexse-elementor-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'front_content_padding',
            [
                'label' => __( 'Padding', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-front' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'front_border',
                'selector' => '{{WRAPPER}} .cx-flip-box-front',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'front_box_shadow',
                'selector' => '{{WRAPPER}} .cx-flip-box-front',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'front_background_image',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .cx-flip-box-front',
            ]
        );

        $this->add_control(
            'front_background_overlay',
            [
                'label' => __( 'Background Overlay', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
					'front_background_image_background' => 'classic'
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-front:before' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'front_icon_heading',
            [
                'label' => __( 'Media Type - Icon', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'front_icon_type' => 'icon'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'front_icon_heading_image',
            [
                'label' => __( 'Media Type - Image', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'front_icon_type' => 'image'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'front_icon_spacing',
            [
                'label' => __( 'Bottom Spacing', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-front .cx-flip-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'front_icon_image_size',
            [
                'label' => __( 'Resize Image', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'front_icon_type' => 'image'
                ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 500,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-front-inner .icon-wrap .cx-flip-icon img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'front_icon_image_fit',
            [
                'label' => __( 'Image Fit', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'contain'  => __( 'Contain', 'codexse-elementor-addons' ),
                    'cover' => __( 'Cover', 'codexse-elementor-addons' ),
                ],
                'condition' => [
                    'front_icon_type' => 'image'
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-front-inner .icon-wrap .cx-flip-icon img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'front_icon_font_size',
            [
                'label' => __( 'Icon Size', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300
					],
					'em' => [
						'min' => 6,
						'max' => 300
					]
				],
                'condition' => [
                    'front_icon_type' => 'icon'
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-front-inner .cx-flip-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'front_icon_background_size',
            [
                'label' => __( 'Padding', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'front_icon_type' => [ 'icon', 'image' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-front-inner .icon-wrap .cx-flip-icon' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'front_icon_border',
                'condition' => [
                    'front_icon_type' => [ 'icon', 'image' ],
                ],
                'selector' => '{{WRAPPER}} .cx-flip-box-front-inner .icon-wrap .cx-flip-icon',
            ]
        );

        $this->add_control(
            'front_icon_border_radius',
            [
                'label' => __( 'Border Radius', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'condition' => [
                    'front_icon_type' => [ 'icon', 'image' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-front-inner .icon-wrap .cx-flip-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .cx-flip-box-front-inner .cx-flip-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'front_icon_box_shadow',
                'selector' => '{{WRAPPER}} .cx-flip-box-front-inner .cx-flip-icon',
                'condition' => [
                    'front_icon_type' => [ 'icon', 'image' ],
                ],
            ]
        );

        $this->add_control(
            'front_icon_color',
            [
                'label' => __( 'Color', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'front_icon_type' => 'icon'
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-front-inner .icon-wrap .cx-flip-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'front_icon_background_color',
            [
                'label' => __( 'Background Color', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'front_icon_type' => [ 'icon', 'image' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-front-inner .icon-wrap .cx-flip-icon' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'front_text',
            [
                'label' => __( 'Title & Description', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs( '_tabs_front_text' );
        $this->start_controls_tab(
            '_tab_front_title',
            [
                'label' => __( 'Title', 'codexse-elementor-addons' ),
            ]
        );

        $this->add_control(
            'front_title_color',
            [
                'label' => __( 'Color', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-front-inner .cx-flip-box-heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'front_title_typography',
                'label' => __( 'Typography', 'codexse-elementor-addons' ),
                'selector' => '{{WRAPPER}} .cx-flip-box-front-inner .cx-flip-box-heading',
                'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'front_title_text_shadow',
                'label' => __( 'Text Shadow', 'codexse-elementor-addons' ),
                'selector' => '{{WRAPPER}} .cx-flip-box-front-inner .cx-flip-box-heading',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_front_description',
            [
                'label' => __( 'Description', 'codexse-elementor-addons' ),
            ]
        );

        $this->add_responsive_control(
            'front_description_space',
            [
                'label' => __( 'Spacing', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-front-inner .cx-text p' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'front_description_color',
            [
                'label' => __( 'Color', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-front-inner .cx-text p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'front_description_typography',
                'label' => __( 'Typography', 'codexse-elementor-addons' ),
                'selector' => '{{WRAPPER}} .cx-flip-box-front-inner .cx-text p',
                'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'front_description_text_shadow',
                'label' => __( 'Text Shadow', 'codexse-elementor-addons' ),
                'selector' => '{{WRAPPER}} .cx-flip-box-front-inner .cx-text p',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
	}

    protected function __back_side_style_controls() {

        // back side
        $this->start_controls_section(
            '_section_back_text_style',
            [
                'label' => __( 'Back Side', 'codexse-elementor-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'back_content_padding',
            [
                'label' => __( 'Padding', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-back' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'back_border',
                'selector' => '{{WRAPPER}} .cx-flip-box-back',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'back_box_shadow',
                'selector' => '{{WRAPPER}} .cx-flip-box-back',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'back_background_image',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .cx-flip-box-back',
            ]
        );

        $this->add_control(
            'back_background_overlay',
            [
                'label' => __( 'Background Overlay', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0,0,0,0.27)',
                'condition' => [
                    'back_background_image_background' => 'classic'
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-back:before' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'back_background_color',
            [
                'label' => __( 'Color', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#27374c',
                'condition' => [
                    'back_background_type' => 'color'
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-back' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'back_icon_heading',
            [
                'label' => __( 'Media Type - Icon', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'back_icon_type' => 'icon'
                ],
            ]
        );

        $this->add_control(
            'back_icon_heading_image',
            [
                'label' => __( 'Media Type - Image', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'back_icon_type' => 'image'
                ],
            ]
        );

        $this->add_responsive_control(
            'back_icon_spacing',
            [
                'label' => __( 'Bottom Spacing', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%'],
                'condition' => [
                    'back_icon_type' => [ 'icon', 'image' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-back-inner .cx-flip-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'back_icon_image_size',
            [
                'label' => __( 'Resize Image', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'back_icon_type' => 'image'
                ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 500,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-back-inner .cx-flip-icon img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'back_icon_image_fit',
            [
                'label' => __( 'Image Fit', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'contain'  => __( 'Contain', 'codexse-elementor-addons' ),
                    'cover' => __( 'Cover', 'codexse-elementor-addons' ),
                ],
                'condition' => [
                    'back_icon_type' => 'image'
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-back-inner .icon-wrap .cx-flip-icon img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'back_icon_font_size',
            [
                'label' => __( 'Icon Size', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300
					],
					'em' => [
						'min' => 6,
						'max' => 300
					]
				],
                'condition' => [
                    'back_icon_type' => 'icon'
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-back-inner .cx-flip-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'back_icon_padding',
            [
                'label' => __( 'Padding', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'back_icon_type' => [ 'icon', 'image' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-back-inner .icon-wrap .cx-flip-icon' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'back_icon_border',
                'condition' => [
                    'back_icon_type' => [ 'icon', 'image' ],
                ],
                'selector' => '{{WRAPPER}} .cx-flip-box-back-inner .icon-wrap .cx-flip-icon',
            ]
        );

        $this->add_control(
            'back_icon_border_radius',
            [
                'label' => __( 'Border Radius', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'condition' => [
                    'back_icon_type' => [ 'icon', 'image']
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-back-inner .icon-wrap .cx-flip-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .cx-flip-box-back-inner .cx-flip-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'back_icon_box_shadow',
                'condition' => [
                    'back_icon_type' => [ 'icon', 'image']
                ],
                'selector' => '{{WRAPPER}} .cx-flip-box-back-inner .cx-flip-icon',
            ]
        );

        $this->add_control(
            'back_icon_color',
            [
                'label' => __( 'Color', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'back_icon_type' => 'icon'
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-back-inner .cx-flip-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'back_icon_background_color',
            [
                'label' => __( 'Background Color', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'back_icon_type' => [ 'icon', 'image' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-back-inner .icon-wrap .cx-flip-icon' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'back_text',
            [
                'label' => __( 'Title & Description', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs( '_tabs_back_text' );
        $this->start_controls_tab(
            '_tab_back_title',
            [
                'label' => __( 'Title', 'codexse-elementor-addons' ),
            ]
        );

		$this->add_responsive_control(
			'back_title_space',
			[
				'label' => __( 'Bottom Spacing', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .cx-flip-box-back-inner .cx-flip-box-heading-back' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'back_title_color',
            [
                'label' => __( 'Color', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-back-inner .cx-flip-box-heading-back' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'back_title_typography',
                'label' => __( 'Typography', 'codexse-elementor-addons' ),
                'selector' => '{{WRAPPER}} .cx-flip-box-back-inner .cx-flip-box-heading-back',
                'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'back_title_shadow',
                'label' => __( 'Text Shadow', 'codexse-elementor-addons' ),
                'selector' => '{{WRAPPER}} .cx-flip-box-back-inner .cx-flip-box-heading-back',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_back_description',
            [
                'label' => __( 'Description', 'codexse-elementor-addons' ),
            ]
        );

        $this->add_control(
            'back_description_color',
            [
                'label' => __( 'Color', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cx-flip-box-back-inner .cx-text p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'back_description_typography',
                'label' => __( 'Typography', 'codexse-elementor-addons' ),
                'selector' => '{{WRAPPER}} .cx-flip-box-back-inner .cx-text p',
                'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'back_description_text_shadow',
                'label' => __( 'Text Shadow', 'codexse-elementor-addons' ),
                'selector' => '{{WRAPPER}} .cx-flip-box-back-inner .cx-text p',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // icon/image
        if ( isset( $settings['front_icon_image']['id'] ) && isset( $settings['front_icon_image']['url'] ) ) {
            $this->add_render_attribute( 'front_icon_image', 'src', $settings['front_icon_image']['url'] );
            $this->add_render_attribute( 'front_icon_image', 'alt', Control_Media::get_image_alt( $settings['front_icon_image'] ) );
            $this->add_render_attribute( 'front_icon_image', 'title', Control_Media::get_image_title( $settings['front_icon_image'] ) );
        }

        // title & description
        $this->add_render_attribute( 'front_title', 'class', 'cx-flip-box-heading' );
        $this->add_render_attribute( 'back_title', 'class', 'cx-flip-box-heading-back' );
        $this->add_render_attribute( 'front_description', 'class', 'cx-desc' );
        $this->add_render_attribute( 'back_description', 'class', 'cx-desc' );
        $this->add_inline_editing_attributes( 'back_description', 'intermediate' );

        // display type
        $this->add_render_attribute( 'display', 'class', 'cx-flip-box-container cx-flip-effect-classic' );

        // flip position
        $this->add_render_attribute( 'flip-position', 'class', 'cx-flip-box-inner' );
        if ( $settings['flip_position'] === 'bottom-top' ) {
            $this->add_render_attribute( 'flip-position', 'class', 'cx-flip-up' );
        } elseif ( $settings['flip_position'] === 'left-right' ) {
            $this->add_render_attribute( 'flip-position', 'class', 'cx-flip-right' );
        }
        ?>

        <div <?php echo $this->get_render_attribute_string( 'display' ); ?>>

            <div <?php echo $this->get_render_attribute_string( 'flip-position' ); ?>>
                <div class="cx-flip-box-inner-wrapper">
                    <div class="cx-flip-box-front">
                        <div class="cx-flip-box-front-inner">
                            <div class="icon-wrap">
                                <?php if ( ! empty( $settings['front_icon'] ) || ! empty( $settings['front_selected_icon'] ) ) : ?>
                                    <span class="cx-flip-icon icon">
                                        <?php cx_render_icon( $settings, 'front_icon', 'front_selected_icon' ); ?>
                                    </span>
                                <?php endif; ?>
                                <?php if ( $settings['front_icon_image'] ) : ?>
                                    <div class="cx-flip-icon">
                                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'front_icon_thumbnail', 'front_icon_image' ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="cx-text">
                                <?php if ( $settings['front_title'] ) : ?>
                                    <h2 <?php echo $this->get_render_attribute_string( 'front_title' ); ?>><?php echo cx_kses_basic( $settings['front_title'] ); ?></h2>
                                <?php endif; ?>

                                <?php if ( $settings['front_description'] ) : ?>
                                    <p <?php echo $this->get_render_attribute_string( 'front_description' ); ?>><?php echo cx_kses_basic( $settings['front_description'] ); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="cx-flip-box-back">
                        <div class="cx-flip-box-back-inner">
                            <div class="icon-wrap">
                                <?php if ( ! empty( $settings['back_icon'] ) || ! empty( $settings['back_selected_icon'] ) ) : ?>
                                    <span class="cx-flip-icon icon">
                                        <?php cx_render_icon( $settings, 'back_icon', 'back_selected_icon' ); ?>
                                    </span>
                                <?php endif; ?>
                                <?php if ( $settings['back_icon_image'] ) : ?>
                                    <div class="cx-flip-icon">
                                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'back_icon_thumbnail', 'back_icon_image' ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="cx-text">
                                <?php if ( $settings['back_title'] ) : ?>
                                    <h2 <?php echo $this->get_render_attribute_string( 'back_title' ); ?>><?php echo cx_kses_basic( $settings['back_title'] ); ?></h2>
                                <?php endif; ?>

                                <?php if ( $settings['back_description'] ) : ?>
                                    <p <?php echo $this->get_render_attribute_string( 'back_description' ) ?>><?php echo cx_kses_intermediate( $settings['back_description'] ); ?></p>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
}
