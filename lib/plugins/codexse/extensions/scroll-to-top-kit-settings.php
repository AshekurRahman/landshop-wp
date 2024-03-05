<?php
namespace Codexse_Addons\Elementor\Extension;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Tab_Base;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Scroll_To_Top_Kit_Setings extends Tab_Base {

	public function get_id() {
		return 'cx-scroll-to-top-kit-settings';
	}

	public function get_title() {
		return __( 'Scroll to Top', 'codexse-elementor-addons' ) . '<span style="margin: 0 15px 0 0;display: inline-block;float: right;">' . cx_get_section_icon() . '</spna>';
	}

	public function get_icon() {
		return 'cx cx-scroll-top';
	}

	public function get_help_url() {
		return '';
	}

	public function get_group() {
		return 'settings';
	}

	protected function register_tab_controls() {
		$this->start_controls_section(
			'cx_scroll_to_top_kit_section',
			[
				'tab'   => 'cx-scroll-to-top-kit-settings',
				'label' => __( 'Scroll to Top', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'cx_scroll_to_top_global',
			[
				'type'      => Controls_Manager::SWITCHER,
				'label'     => __( 'Enable Scroll To Top', 'codexse-elementor-addons' ),
				'default'   => '',
				'label_on'  => __( 'Show', 'codexse-elementor-addons' ),
				'label_off' => __( 'Hide', 'codexse-elementor-addons' ),
			]
		);

		// TODO: For Pro 3.6.0, convert this to the breakpoints utility method introduced in core 3.5.0.
		$breakpoints    = cx_elementor()->breakpoints->get_active_breakpoints();
		$device_default = [];
		foreach ( $breakpoints as $breakpoint_key => $breakpoint ) {
			$device_default[ $breakpoint_key . '_default' ] = 'yes';
		}
		$device_default['desktop_default'] = 'yes';
		$this->add_responsive_control(
			'cx_scroll_to_top_responsive_visibility',
			array_merge(
				[
					'type'                 => Controls_Manager::SWITCHER,
					'label'                => __( 'Responsive Visibility', 'codexse-elementor-addons' ),
					'default'              => 'yes',
					'return_value'         => 'yes',
					'label_on'             => __( 'Show', 'codexse-elementor-addons' ),
					'label_off'            => __( 'Hide', 'codexse-elementor-addons' ),
					'selectors_dictionary' => [
						''    => 'visibility: hidden; opacity: 0;',
						'yes' => 'visibility: visible; opacity: 1;',
					],
					'selectors'            => [
						'body[data-elementor-device-mode="widescreen"] .cx-scroll-to-top-wrap,
						body[data-elementor-device-mode="widescreen"] .cx-scroll-to-top-wrap.edit-mode,
						body[data-elementor-device-mode="widescreen"] .cx-scroll-to-top-wrap.single-page-off' => '{{VALUE}}',

						'body[data-elementor-device-mode="desktop"] .cx-scroll-to-top-wrap,
						body[data-elementor-device-mode="desktop"] .cx-scroll-to-top-wrap.edit-mode,
						body[data-elementor-device-mode="desktop"] .cx-scroll-to-top-wrap.single-page-off' => '{{VALUE}}',

						'body[data-elementor-device-mode="laptop"] .cx-scroll-to-top-wrap,
						body[data-elementor-device-mode="laptop"] .cx-scroll-to-top-wrap.edit-mode,
						body[data-elementor-device-mode="laptop"] .cx-scroll-to-top-wrap.single-page-off' => '{{VALUE}}',

						'body[data-elementor-device-mode="tablet_extra"] .cx-scroll-to-top-wrap,
						body[data-elementor-device-mode="tablet_extra"] .cx-scroll-to-top-wrap.edit-mode,
						body[data-elementor-device-mode="tablet_extra"] .cx-scroll-to-top-wrap.single-page-off' => '{{VALUE}}',

						'body[data-elementor-device-mode="tablet"] .cx-scroll-to-top-wrap,
						body[data-elementor-device-mode="tablet"] .cx-scroll-to-top-wrap.edit-mode,
						body[data-elementor-device-mode="tablet"] .cx-scroll-to-top-wrap.single-page-off' => '{{VALUE}}',

						'body[data-elementor-device-mode="mobile_extra"] .cx-scroll-to-top-wrap,
						body[data-elementor-device-mode="mobile_extra"] .cx-scroll-to-top-wrap.edit-mode,
						body[data-elementor-device-mode="mobile_extra"] .cx-scroll-to-top-wrap.single-page-off' => '{{VALUE}}',

						'body[data-elementor-device-mode="mobile"] .cx-scroll-to-top-wrap,
						body[data-elementor-device-mode="mobile"] .cx-scroll-to-top-wrap.edit-mode,
						body[data-elementor-device-mode="mobile"] .cx-scroll-to-top-wrap.single-page-off' => '{{VALUE}}',
					],
					'condition'            => [
						'cx_scroll_to_top_global' => 'yes',
					],
				],
				$device_default
			)
		);

		$this->add_control(
			'cx_scroll_to_top_position_text',
			[
				'label'       => esc_html__( 'Position', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'bottom-right',
				'label_block' => false,
				'options'     => [
					'bottom-left'  => esc_html__( 'Bottom Left', 'codexse-elementor-addons' ),
					'bottom-right' => esc_html__( 'Bottom Right', 'codexse-elementor-addons' ),
				],
				'separator'   => 'before',
				'condition'   => [
					'cx_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->add_control(
			'cx_scroll_to_top_position_bottom',
			[
				'label'      => __( 'Bottom', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'em' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
					'%'  => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'.cx-scroll-to-top-wrap .cx-scroll-to-top-button' => 'bottom: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'cx_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->add_control(
			'cx_scroll_to_top_position_left',
			[
				'label'      => __( 'Left', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'em' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
					'%'  => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'.cx-scroll-to-top-button' => 'left: 15px',
					'.cx-scroll-to-top-wrap .cx-scroll-to-top-button' => 'left: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'cx_scroll_to_top_global'        => 'yes',
					'cx_scroll_to_top_position_text' => 'bottom-left',
				],
			]
		);

		$this->add_control(
			'cx_scroll_to_top_position_right',
			[
				'label'      => __( 'Right', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'em' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
					'%'  => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'.cx-scroll-to-top-wrap .cx-scroll-to-top-button' => 'right: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'cx_scroll_to_top_global'        => 'yes',
					'cx_scroll_to_top_position_text' => 'bottom-right',
				],
			]
		);

		$this->add_control(
			'cx_scroll_to_top_button_width',
			[
				'label'      => __( 'Width', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'.cx-scroll-to-top-wrap .cx-scroll-to-top-button' => 'width: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'before',
				'condition'  => [
					'cx_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->add_control(
			'cx_scroll_to_top_button_height',
			[
				'label'      => __( 'Height', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'.cx-scroll-to-top-wrap .cx-scroll-to-top-button' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'cx_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->add_control(
			'cx_scroll_to_top_z_index',
			[
				'label'      => __( 'Z Index', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 9999,
						'step' => 10,
					],
				],
				'selectors'  => [
					'.cx-scroll-to-top-wrap .cx-scroll-to-top-button' => 'z-index: {{SIZE}}',
				],
				'condition'  => [
					'cx_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->add_control(
			'cx_scroll_to_top_button_opacity',
			[
				'label'     => __( 'Opacity', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min'  => 0,
						'max'  => 1,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'.cx-scroll-to-top-wrap .cx-scroll-to-top-button' => 'opacity: {{SIZE}};',
				],
				'condition' => [
					'cx_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->add_control(
			'cx_scroll_to_top_media_type',
			[
				'label'          => __( 'Media Type', 'codexse-elementor-addons' ),
				'type'           => Controls_Manager::CHOOSE,
				'label_block'    => false,
				'options'        => [
					'icon'  => [
						'title' => __( 'Icon', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-star',
					],
					'image' => [
						'title' => __( 'Image', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-image',
					],
					'text'  => [
						'title' => __( 'Text', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-animation-text',
					],
				],
				'default'        => 'icon',
				'separator'      => 'before',
				'toggle'         => false,
				'style_transfer' => true,
				'condition'      => [
					'cx_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->add_control(
			'cx_scroll_to_top_button_icon',
			[
				'label'      => esc_html__( 'Icon', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::ICONS,
				'show_label' => false,
				'default'    => [
					'value'   => 'fas fa-chevron-up',
					'library' => 'fa-solid',
				],
				'condition'  => [
					'cx_scroll_to_top_global'     => 'yes',
					'cx_scroll_to_top_media_type' => 'icon',
				],
			]
		);

		$this->add_control(
			'cx_scroll_to_top_button_image',
			[
				'label'      => __( 'Image', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::MEDIA,
				'show_label' => false,
				'dynamic'    => [
					'active' => true,
				],
				'condition'  => [
					'cx_scroll_to_top_global'     => 'yes',
					'cx_scroll_to_top_media_type' => 'image',
				],
			]
		);

		$this->add_control(
			'cx_scroll_to_top_button_text',
			[
				'label'       => __( 'Text', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'show_label'  => false,
				'label_block' => true,
				'default'     => 'Top',
				'condition'   => [
					'cx_scroll_to_top_global'     => 'yes',
					'cx_scroll_to_top_media_type' => 'text',
				],
			]
		);

		$this->add_control(
			'cx_scroll_to_top_button_icon_size',
			[
				'label'      => __( 'Size', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'.cx-scroll-to-top-wrap .cx-scroll-to-top-button i' => 'font-size: {{SIZE}}{{UNIT}};',
					'.cx-scroll-to-top-wrap .cx-scroll-to-top-button img' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'cx_scroll_to_top_global'      => 'yes',
					'cx_scroll_to_top_media_type!' => 'text',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'cx_scroll_to_top_button_text_typo',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector'  => '.cx-scroll-to-top-wrap .cx-scroll-to-top-button span',
				'condition' => [
					'cx_scroll_to_top_global'     => 'yes',
					'cx_scroll_to_top_media_type' => 'text',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'cx_scroll_to_top_button_border',
				'exclude'   => ['color'], //remove border color
				'selector'  => '{{WRAPPER}} .cx-scroll-to-top-wrap .cx-scroll-to-top-button',
				'condition' => [
					'cx_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->start_controls_tabs(
			'cx_scroll_to_top_tabs',
			[
				'separator' => 'before',
				'condition' => [
					'cx_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->start_controls_tab(
			'cx_scroll_to_top_tab_normal',
			[
				'label'     => __( 'Normal', 'codexse-elementor-addons' ),
				'condition' => [
					'cx_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->add_control(
			'cx_scroll_to_top_button_icon_color',
			[
				'label'     => __( 'Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'.cx-scroll-to-top-wrap .cx-scroll-to-top-button i' => 'color: {{VALUE}}',
					'.cx-scroll-to-top-wrap .cx-scroll-to-top-button span' => 'color: {{VALUE}}',
				],
				'condition' => [
					'cx_scroll_to_top_global'      => 'yes',
					'cx_scroll_to_top_media_type!' => 'image',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'cx_scroll_to_top_button_bg_color',
				'types'     => [ 'classic', 'gradient' ],
				'exclude'   => [ 'image' ],
				'selector'  => '.cx-scroll-to-top-wrap .cx-scroll-to-top-button',
				'condition' => [
					'cx_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->add_control(
			'cx_scroll_to_top_button_border_color',
			[
				'label'     => __( 'Border Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.cx-scroll-to-top-wrap .cx-scroll-to-top-button' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'cx_scroll_to_top_global' => 'yes',
					'cx_scroll_to_top_button_border_border!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'cx_scroll_to_top_tab_hover',
			[
				'label'     => __( 'Hover', 'codexse-elementor-addons' ),
				'condition' => [
					'cx_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->add_control(
			'cx_scroll_to_top_button_icon_hvr_color',
			[
				'label'     => __( 'Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'.cx-scroll-to-top-wrap .cx-scroll-to-top-button:hover i' => 'color: {{VALUE}}',
					'.cx-scroll-to-top-wrap .cx-scroll-to-top-button:hover span' => 'color: {{VALUE}}',
				],
				'condition' => [
					'cx_scroll_to_top_global'      => 'yes',
					'cx_scroll_to_top_media_type!' => 'image',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'cx_scroll_to_top_button_bg_hvr_color',
				'types'     => [ 'classic', 'gradient' ],
				'exclude'   => [ 'image' ],
				'selector'  => '.cx-scroll-to-top-wrap .cx-scroll-to-top-button:hover',
				'condition' => [
					'cx_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->add_control(
			'cx_scroll_to_top_button_hvr_border_color',
			[
				'label'     => __( 'Border Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.cx-scroll-to-top-wrap .cx-scroll-to-top-button:hover' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'cx_scroll_to_top_global' => 'yes',
					'cx_scroll_to_top_button_border_border!' => '',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'cx_scroll_to_top_button_border_radius',
			[
				'label'      => __( 'Border Radius', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'.cx-scroll-to-top-wrap .cx-scroll-to-top-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
				'condition'  => [
					'cx_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'cx_scroll_to_top_button_box_shadow',
				'exclude'   => [
					'box_shadow_position',
				],
				'selector'  => '.cx-scroll-to-top-wrap .cx-scroll-to-top-button',
				'condition' => [
					'cx_scroll_to_top_global' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}
}
