<?php
/**
 * Dual Button widget class
 *
 * @package Codexse_Addons
 */
namespace Codexse_Addons\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Codexse_Addons\Elementor\Traits\Creative_Button_Markup;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

defined( 'ABSPATH' ) || die();

class Creative_Button extends Base {
	use Creative_Button_Markup;
	/**
	 * Get widget title.
	 */
	public function get_title() {
		return __( 'Creative Button', 'codexse-elementor-addons' );
	}

	public function get_custom_help_url() {
		return 'https://codexseaddons.com/docs/codexse-addons-for-elementor/widgets/creative-button/';
	}

	/**
	 * Get widget icon.
	 */
	public function get_icon() {
		return 'hm hm-motion-button';
	}

	public function get_keywords() {
		return [ 'button', 'btn', 'advance', 'link', 'creative', 'creative-utton' ];
	}

	/**
	 * Register widget content controls
	 */
	protected function register_content_controls() {

		$this->start_controls_section(
			'_section_button',
			[
				'label' => __( 'Creative Button', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'btn_style',
			[
				'label'   => __( 'Style', 'codexse-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'hermosa',
				'options' => [
					'hermosa'  => __( 'Hermosa', 'codexse-elementor-addons' ),
					'montino'  => __( 'Montino', 'codexse-elementor-addons' ),
					'iconica'  => __( 'Iconica', 'codexse-elementor-addons' ),
					'symbolab' => __( 'Symbolab', 'codexse-elementor-addons' ),
					'estilo'   => __( 'Estilo', 'codexse-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'estilo_effect',
			[
				'label'     => __( 'Effects', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'dissolve',
				'options'   => [
					'dissolve'     => __( 'Dissolve', 'codexse-elementor-addons' ),
					'slide-down'   => __( 'Slide In Down', 'codexse-elementor-addons' ),
					'slide-right'  => __( 'Slide In Right', 'codexse-elementor-addons' ),
					'slide-x'      => __( 'Slide Out X', 'codexse-elementor-addons' ),
					'cross-slider' => __( 'Cross Slider', 'codexse-elementor-addons' ),
					'slide-y'      => __( 'Slide Out Y', 'codexse-elementor-addons' ),
				],
				'condition' => [
					'btn_style' => 'estilo',
				],
			]
		);

		$this->add_control(
			'symbolab_effect',
			[
				'label'     => __( 'Effects', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'back-in-right',
				'options'   => [
					'back-in-right'  => __( 'Back In Right', 'codexse-elementor-addons' ),
					'back-in-left'   => __( 'Back In Left', 'codexse-elementor-addons' ),
					'back-out-right' => __( 'Back Out Right', 'codexse-elementor-addons' ),
					'back-out-left'  => __( 'Back Out Left', 'codexse-elementor-addons' ),
				],
				'condition' => [
					'btn_style' => 'symbolab',
				],
			]
		);

		$this->add_control(
			'iconica_effect',
			[
				'label'     => __( 'Effects', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'slide-in-down',
				'options'   => [
					'slide-in-down'  => __( 'Slide In Down', 'codexse-elementor-addons' ),
					'slide-in-top'   => __( 'Slide In Top', 'codexse-elementor-addons' ),
					'slide-in-right' => __( 'Slide In Right', 'codexse-elementor-addons' ),
					'slide-in-left'  => __( 'Slide In Left', 'codexse-elementor-addons' ),
				],
				'condition' => [
					'btn_style' => 'iconica',
				],
			]
		);

		$this->add_control(
			'montino_effect',
			[
				'label'     => __( 'Effects', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'winona',
				'options'   => [
					'winona'  => __( 'Winona', 'codexse-elementor-addons' ),
					'rayen'   => __( 'Rayen', 'codexse-elementor-addons' ),
					'aylen'   => __( 'Aylen', 'codexse-elementor-addons' ),
					'wapasha' => __( 'Wapasha', 'codexse-elementor-addons' ),
					'nina'    => __( 'Nina', 'codexse-elementor-addons' ),
					'antiman' => __( 'Antiman', 'codexse-elementor-addons' ),
					'sacnite' => __( 'Sacnite', 'codexse-elementor-addons' ),
				],
				'condition' => [
					'btn_style' => 'montino',
				],
			]
		);

		$this->add_control(
			'hermosa_effect',
			[
				'label'     => __( 'Effects', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'exploit',
				'options'   => [
					'exploit'    => __( 'Exploit', 'codexse-elementor-addons' ),
					'upward'     => __( 'Upward', 'codexse-elementor-addons' ),
					'newbie'     => __( 'Newbie', 'codexse-elementor-addons' ),
					'render'     => __( 'Render', 'codexse-elementor-addons' ),
					'reshape'    => __( 'Reshape', 'codexse-elementor-addons' ),
					'expandable' => __( 'Expandable', 'codexse-elementor-addons' ),
					'downhill'   => __( 'Downhill', 'codexse-elementor-addons' ),
					'bloom'      => __( 'Bloom', 'codexse-elementor-addons' ),
					'roundup'    => __( 'Roundup', 'codexse-elementor-addons' ),
				],
				'condition' => [
					'btn_style' => 'hermosa',
				],
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'       => __( 'Text', 'codexse-elementor-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Button Text',
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'button_link',
			array(
				'label'         => __( 'Link', 'codexse-elementor-addons' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'codexse-elementor-addons' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => true,
				),
				'dynamic'       => [
					'active' => true,
				],
			)
		);

		$this->add_control(
			'icon',
			[
				'label'                  => __( 'Icon', 'codexse-elementor-addons' ),
				'description'            => __( 'Please set an icon for the button.', 'codexse-elementor-addons' ),
				'label_block'            => false,
				'type'                   => Controls_Manager::ICONS,
				'skin'                   => 'inline',
				'exclude_inline_options' => [ 'svg' ],
				'default'                => [
					'value'   => 'hm hm-codexseaddons',
					'library' => 'codexse-icon',
				],
				'conditions'             => [
					'relation' => 'or',
					'terms'    => [
						[
							'relation' => 'or',
							'terms'    => [
								[
									'name'     => 'btn_style',
									'operator' => '==',
									'value'    => 'symbolab',
								],
								[
									'name'     => 'btn_style',
									'operator' => '==',
									'value'    => 'iconica',
								],
							],
						],
						[
							'relation' => 'and',
							'terms'    => [
								[
									'name'     => 'btn_style',
									'operator' => '==',
									'value'    => 'hermosa',
								],
								[
									'name'     => 'hermosa_effect',
									'operator' => '==',
									'value'    => 'expandable',
								],
							],
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'align_x',
			[
				'label'       => __( 'Alignment', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'left'   => [
						'title' => __( 'Left', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'toggle'      => true,
				'selectors'   => [
					'{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}};',
					// '{{WRAPPER}} .cx-creative-btn-wrap' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'magnetic_enable',
			[
				'label'        => __( 'Magnetic Effect', 'codexse-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_block'  => false,
				'return_value' => 'yes',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'threshold',
			[
				'label'     => __( 'Threshold', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 100,
				'step'      => 1,
				'default'   => 30,
				'condition' => [
					'magnetic_enable' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .cx-creative-btn' => 'margin: {{VALUE}}px;',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register widget style controls
	 */
	protected function register_style_controls() {
		$this->__common_style_controls();
	}

	protected function _color_template() {

		$this->start_controls_section(
			'_button_style_color',
			[
				'label' => __( 'Color Tamplate', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'white_color',
			[
				'label'     => __( 'White', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .cx-creative-btn-wrap' => '--cx-ctv-btn-clr-white: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'offwhite_color',
			[
				'label'     => __( 'Off White', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f0f0f0',
				'selectors' => [
					'{{WRAPPER}} .cx-creative-btn-wrap' => '--cx-ctv-btn-clr-offwhite: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'black_color',
			[
				'label'     => __( 'Black', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => [
					'{{WRAPPER}} .cx-creative-btn-wrap' => '--cx-ctv-btn-clr-black: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'cranberry_color',
			[
				'label'     => __( 'Cranberry', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#26b59e',
				'selectors' => [
					'{{WRAPPER}} .cx-creative-btn-wrap' => '--cx-ctv-btn-clr-cranberry: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'purple_color',
			[
				'label'     => __( 'Purple', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#27b59e',
				'selectors' => [
					'{{WRAPPER}} .cx-creative-btn-wrap' => '--cx-ctv-btn-clr-purple: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Style section for Estilo, Symbolab, Iconica
	 *
	 * @return void
	 */
	protected function __common_style_controls() {

		$this->start_controls_section(
			'_estilo_symbolab_iconica_style_section',
			[
				'label' => __( 'Common', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'button_item_width',
			[
				'label'      => __( 'Size', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .cx-creative-btn.cx-eft--downhill' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cx-creative-btn.cx-eft--roundup' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cx-creative-btn.cx-eft--roundup .progress' => 'width: calc({{SIZE}}{{UNIT}} - (({{SIZE}}{{UNIT}} / 100) * 20) ); height:auto;',
				],
				'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms'    => [
								[
									'name'     => 'hermosa_effect',
									'operator' => '==',
									'value'    => 'roundup',
								],
								[
									'name'     => 'hermosa_effect',
									'operator' => '==',
									'value'    => 'downhill',
								],
							],
						],
						[
							'terms' => [
								[
									'name'     => 'btn_style',
									'operator' => '==',
									'value'    => 'hermosa',
								],
							],
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'button_icon_size',
			[
				'label'      => __( 'Icon Size', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors'  => [
					'{{WRAPPER}} .cx-creative-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms'    => [
						[
							'relation' => 'or',
							'terms'    => [
								[
									'name'     => 'btn_style',
									'operator' => '==',
									'value'    => 'symbolab',
								],
								[
									'name'     => 'btn_style',
									'operator' => '==',
									'value'    => 'iconica',
								],
							],
						],
						[
							'relation' => 'and',
							'terms'    => [
								[
									'name'     => 'btn_style',
									'operator' => '==',
									'value'    => 'hermosa',
								],
								[
									'name'     => 'hermosa_effect',
									'operator' => '==',
									'value'    => 'expandable',
								],
							],
						],
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'label'    => __( 'Typography', 'codexse-elementor-addons' ),
				'selector' => '{{WRAPPER}} .cx-creative-btn',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'       => 'button_border',
				'exclude'    => ['color'], //remove border color
				'selector'   => '{{WRAPPER}} .cx-creative-btn, {{WRAPPER}} .cx-creative-btn.cx-eft--bloom div',
				'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms'    => [
								[
									'name'     => 'hermosa_effect',
									'operator' => '!=',
									'value'    => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name'     => 'btn_style',
									'operator' => '!=',
									'value'    => '',
								],
							],
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label'      => __( 'Border Radius', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cx-creative-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .cx-creative-btn.cx-stl--hermosa.cx-eft--bloom div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_hermosa_roundup_stroke_width',
			[
				'label'      => __( 'Stroke Width', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .cx-creative-btn.cx-eft--roundup' => '--cx-ctv-btn-stroke-width: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms'    => [
								[
									'name'     => 'hermosa_effect',
									'operator' => '==',
									'value'    => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name'     => 'btn_style',
									'operator' => '==',
									'value'    => 'hermosa',
								],
							],
						],
					],
				],
			]
		);

		$this->__btn_tab_style_controls();

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => __( 'Padding', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .cx-creative-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

					'{{WRAPPER}} .cx-creative-btn.cx-stl--iconica > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

					'{{WRAPPER}} .cx-creative-btn.cx-stl--montino.cx-eft--winona > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .cx-creative-btn.cx-stl--montino.cx-eft--winona::after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

					'{{WRAPPER}} .cx-creative-btn.cx-stl--montino.cx-eft--rayen > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .cx-creative-btn.cx-stl--montino.cx-eft--rayen::before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

					'{{WRAPPER}} .cx-creative-btn.cx-stl--montino.cx-eft--nina' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .cx-creative-btn.cx-stl--montino.cx-eft--nina::before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

					'{{WRAPPER}} .cx-creative-btn.cx-stl--hermosa.cx-eft--bloom span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section();
	}

	protected function __btn_tab_style_controls() {

		$conditions = [
			'terms' => [
				[
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'hermosa_effect',
							'operator' => '!=',
							'value'    => 'roundup',
						],
						// [
						// 	'name' => 'hermosa_effect',
						// 	'operator' => '!=',
						// 	'value' => 'downhill',
						// ],
					],
				],
				[
					'terms' => [
						[
							'name'     => 'btn_style',
							'operator' => '!=',
							'value'    => '',
						],
					],
				],
			],
		];

		$this->start_controls_tabs( '_tabs_button' );
		$this->start_controls_tab(
			'_tab_button_normal',
			[
				'label' => __( 'Normal', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => __( 'Text Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-creative-btn-wrap .cx-creative-btn' => '--cx-ctv-btn-txt-clr: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label'      => __( 'Background Color', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} .cx-creative-btn-wrap .cx-creative-btn' => '--cx-ctv-btn-bg-clr: {{VALUE}}',
				],
				'conditions' => $conditions,
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label'      => __( 'Border Color', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} .cx-creative-btn-wrap .cx-creative-btn' => '--cx-ctv-btn-border-clr: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms'    => [
								[
									'name'     => 'hermosa_effect',
									'operator' => '!=',
									'value'    => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name'     => 'btn_style',
									'operator' => '!=',
									'value'    => '',
								],
								[
									'name'     => 'button_border_border',
									'operator' => '!=',
									'value'    => '',
								],
							],
						],
					],
				],
			]
		);

		$this->add_control(
			'button_roundup_circle_color',
			[
				'label'      => __( 'Circle Color', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} .cx-creative-btn-wrap .cx-creative-btn.cx-eft--roundup' => '--cx-ctv-btn-border-clr: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms'    => [
								[
									'name'     => 'hermosa_effect',
									'operator' => '==',
									'value'    => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name'     => 'btn_style',
									'operator' => '==',
									'value'    => 'hermosa',
								],
							],
						],
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .cx-creative-btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tabs_button_hover',
			[
				'label' => __( 'Hover', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'button_hover_text_color',
			[
				'label'     => __( 'Text Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-creative-btn-wrap .cx-creative-btn' => '--cx-ctv-btn-txt-hvr-clr: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_hover_bg_color',
			[
				'label'      => __( 'Background Color', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} .cx-creative-btn-wrap .cx-creative-btn' => '--cx-ctv-btn-bg-hvr-clr: {{VALUE}}',
				],
				'conditions' => $conditions,
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'      => __( 'Border Color', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} .cx-creative-btn-wrap .cx-creative-btn' => '--cx-ctv-btn-border-hvr-clr: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms'    => [
								[
									'name'     => 'hermosa_effect',
									'operator' => '!=',
									'value'    => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name'     => 'btn_style',
									'operator' => '!=',
									'value'    => '',
								],
								[
									'name'     => 'button_border_border',
									'operator' => '!=',
									'value'    => '',
								],
							],
						],
					],
				],
			]
		);

		$this->add_control(
			'button_hover_roundup_circle_color',
			[
				'label'      => __( 'Circle Color', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} .cx-creative-btn-wrap .cx-creative-btn.cx-eft--roundup' => '--cx-ctv-btn-border-hvr-clr: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms'    => [
								[
									'name'     => 'hermosa_effect',
									'operator' => '==',
									'value'    => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name'     => 'btn_style',
									'operator' => '==',
									'value'    => 'hermosa',
								],
							],
						],
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .cx-creative-btn:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute( 'wrap', 'data-magnetic', $settings['magnetic_enable'] ? $settings['magnetic_enable'] : 'no' );
		$this->{'render_' . $settings['btn_style'] . '_markup'}( $settings );

	}

}
