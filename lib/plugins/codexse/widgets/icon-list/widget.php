<?php
/**
 * Icon List widget class
 *
 * @package Codexse_Addons
 */
namespace Codexse_Addons\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Repeater;
use Elementor\Icons_Manager;

defined( 'ABSPATH' ) || die();

class Icon_List extends Base {

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Icon List', 'codexse-elementor-addons' );
	}

	public function get_custom_help_url() {
		return 'https://codexseaddons.com/docs/codexse-addons-for-elementor/widgets/icon-list/';
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
		return 'cx cx-list';
	}

	public function get_keywords() {
		return [ 'icon list', 'icon', 'list' ];
	}

	/**
     * Register widget content controls
     */
	protected function register_content_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Icon List', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'view',
			[
				'label' => esc_html__( 'Layout', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'traditional',
				'options' => [
					'traditional' => [
						'title' => esc_html__( 'Default', 'codexse-elementor-addons' ),
						'icon' => 'eicon-editor-list-ul',
					],
					'inline' => [
						'title' => esc_html__( 'Inline', 'codexse-elementor-addons' ),
						'icon' => 'eicon-ellipsis-h',
					],
				],
				'render_type' => 'template',
				'classes' => 'codexse-control-start-end',
				'style_transfer' => true,
				'prefix_class' => 'codexse-icon-list--layout-',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'text',
			[
				'label' => esc_html__( 'Text', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'List Item', 'codexse-elementor-addons' ),
				'default' => esc_html__( 'List Item', 'codexse-elementor-addons' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'selected_icon',
			[
				'label' => esc_html__( 'Icon', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-check',
					'library' => 'fa-solid',
				],
				'fa4compatibility' => 'icon',
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'icon_list',
			[
				'label' => esc_html__( 'Items', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'text' => esc_html__( 'List Item #1', 'codexse-elementor-addons' ),
						'selected_icon' => [
							'value' => 'fas fa-check',
							'library' => 'fa-solid',
						],
					],
					[
						'text' => esc_html__( 'List Item #2', 'codexse-elementor-addons' ),
						'selected_icon' => [
							'value' => 'fas fa-times',
							'library' => 'fa-solid',
						],
					],
					[
						'text' => esc_html__( 'List Item #3', 'codexse-elementor-addons' ),
						'selected_icon' => [
							'value' => 'fas fa-dot-circle',
							'library' => 'fa-solid',
						],
					],
				],
				'title_field' => '{{{ elementor.helpers.renderIcon( this, selected_icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}} {{{ text }}}',
			]
		);

		$this->add_control(
			'link_click',
			[
				'label' => esc_html__( 'Apply Link On', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'full_width' => esc_html__( 'Full Width', 'codexse-elementor-addons' ),
					'inline' => esc_html__( 'Inline', 'codexse-elementor-addons' ),
				],
				'default' => 'full_width',
				'separator' => 'before',
				'prefix_class' => 'codexse-list-item-link-',
			]
		);

		$this->end_controls_section();

	
    }


	/**
     * Register widget style controls
     */
	protected function register_style_controls() {
		
		$this->start_controls_section(
			'section_icon_list',
			[
				'label' => esc_html__( 'List', 'codexse-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'space_between',
			[
				'label' => esc_html__( 'Space Between', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-items:not(.codexse-inline-items) .codexse-icon-list-item:not(:last-child)' => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .codexse-icon-list-items:not(.codexse-inline-items) .codexse-icon-list-item:not(:first-child)' => 'margin-top: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .codexse-icon-list-items.codexse-inline-items .codexse-icon-list-item' => 'margin-right: calc({{SIZE}}{{UNIT}}/2); margin-left: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .codexse-icon-list-items.codexse-inline-items' => 'margin-right: calc(-{{SIZE}}{{UNIT}}/2); margin-left: calc(-{{SIZE}}{{UNIT}}/2)',
					'body.rtl {{WRAPPER}} .codexse-icon-list-items.codexse-inline-items .codexse-icon-list-item:after' => 'left: calc(-{{SIZE}}{{UNIT}}/2)',
					'body:not(.rtl) {{WRAPPER}} .codexse-icon-list-items.codexse-inline-items .codexse-icon-list-item:after' => 'right: calc(-{{SIZE}}{{UNIT}}/2)',
				],
			]
		);

		$this->add_responsive_control(
			'icon_align',
			[
				'label' => esc_html__( 'Alignment', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'codexse-elementor-addons' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'codexse-elementor-addons' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'codexse-elementor-addons' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'codexse%s-align-',
			]
		);

		$this->add_control(
			'divider',
			[
				'label' => esc_html__( 'Divider', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'Off', 'codexse-elementor-addons' ),
				'label_on' => esc_html__( 'On', 'codexse-elementor-addons' ),
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-item:not(:last-child):after' => 'content: ""',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'divider_style',
			[
				'label' => esc_html__( 'Style', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'solid' => esc_html__( 'Solid', 'codexse-elementor-addons' ),
					'double' => esc_html__( 'Double', 'codexse-elementor-addons' ),
					'dotted' => esc_html__( 'Dotted', 'codexse-elementor-addons' ),
					'dashed' => esc_html__( 'Dashed', 'codexse-elementor-addons' ),
				],
				'default' => 'solid',
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-items:not(.codexse-inline-items) .codexse-icon-list-item:not(:last-child):after' => 'border-top-style: {{VALUE}}',
					'{{WRAPPER}} .codexse-icon-list-items.codexse-inline-items .codexse-icon-list-item:not(:last-child):after' => 'border-left-style: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'divider_weight',
			[
				'label' => esc_html__( 'Weight', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-items:not(.codexse-inline-items) .codexse-icon-list-item:not(:last-child):after' => 'border-top-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .codexse-inline-items .codexse-icon-list-item:not(:last-child):after' => 'border-left-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_width',
			[
				'label' => esc_html__( 'Width', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'default' => [
					'unit' => '%',
				],
				'condition' => [
					'divider' => 'yes',
					'view!' => 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-item:not(:last-child):after' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_height',
			[
				'label' => esc_html__( 'Height', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'custom' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'condition' => [
					'divider' => 'yes',
					'view' => 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-item:not(:last-child):after' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_color',
			[
				'label' => esc_html__( 'Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ddd',
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-item:not(:last-child):after' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__( 'Icon', 'codexse-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'icon_colors' );

		$this->start_controls_tab(
			'icon_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .codexse-icon-list-icon svg' => 'fill: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
			]
		);
		
		$this->add_control(
			'icon_background',
			[
				'label' => esc_html__( 'Background Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label' => esc_html__( 'Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-item:hover .codexse-icon-list-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .codexse-icon-list-item:hover .codexse-icon-list-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'icon_hover_background',
			[
				'label' => esc_html__( 'Hover Background Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-item:hover .codexse-icon-list-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_color_hover_transition',
			[
				'label' => esc_html__( 'Transition Duration', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 's', 'ms', 'custom' ],
				'default' => [
					'unit' => 's',
					'size' => 0.3,
				],
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-icon i' => 'transition: color {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .codexse-icon-list-icon svg' => 'transition: fill {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		// Add the new styling options
		$this->add_responsive_control(
			'icon_width',
			[
				'label' => esc_html__( 'Width', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'default' => [
					'size' => 24, // Default width value
				],
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-icon' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_height',
			[
				'label' => esc_html__( 'Height', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'default' => [
					'size' => 24, // Default height value
				],
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'default' => [
					'size' => 14,
				],
				'range' => [
					'px' => [
						'min' => 6,
					],
					'%' => [
						'min' => 6,
					],
					'vw' => [
						'min' => 6,
					],
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}}' => '--e-icon-list-icon-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'text_indent',
			[
				'label' => esc_html__( 'Gap', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-icon' => is_rtl() ? 'margin-left: {{SIZE}}{{UNIT}};' : 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$e_icon_list_icon_css_var = 'var(--e-icon-list-icon-size, 1em)';
		$e_icon_list_icon_align_left = sprintf( '0 calc(%s * 0.25) 0 0', $e_icon_list_icon_css_var );
		$e_icon_list_icon_align_center = sprintf( '0 calc(%s * 0.125)', $e_icon_list_icon_css_var );
		$e_icon_list_icon_align_right = sprintf( '0 0 0 calc(%s * 0.25)', $e_icon_list_icon_css_var );

		$this->add_responsive_control(
			'icon_self_align',
			[
				'label' => esc_html__( 'Horizontal Alignment', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'codexse-elementor-addons' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'codexse-elementor-addons' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'codexse-elementor-addons' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => '',
				'selectors_dictionary' => [
					'left' => sprintf( '--e-icon-list-icon-align: left; --e-icon-list-icon-margin: %s;', $e_icon_list_icon_align_left ),
					'center' => sprintf( '--e-icon-list-icon-align: center; --e-icon-list-icon-margin: %s;', $e_icon_list_icon_align_center ),
					'right' => sprintf( '--e-icon-list-icon-align: right; --e-icon-list-icon-margin: %s;', $e_icon_list_icon_align_right ),
				],
				'selectors' => [
					'{{WRAPPER}}' => '{{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'icon_self_vertical_align',
			[
				'label' => esc_html__( 'Vertical Alignment', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Start', 'codexse-elementor-addons' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'codexse-elementor-addons' ),
						'icon' => 'eicon-v-align-middle',
					],
					'flex-end' => [
						'title' => esc_html__( 'End', 'codexse-elementor-addons' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => '--icon-vertical-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_vertical_offset',
			[
				'label' => esc_html__( 'Adjust Vertical Position', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => -15,
						'max' => 15,
					],
					'em' => [
						'min' => -1,
						'max' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--icon-vertical-offset: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_text_style',
			[
				'label' => esc_html__( 'Text', 'codexse-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'selector' => '{{WRAPPER}} .codexse-icon-list-item > .codexse-icon-list-text, {{WRAPPER}} .codexse-icon-list-item > a',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .codexse-icon-list-text',
			]
		);

		$this->start_controls_tabs( 'text_colors' );

		$this->start_controls_tab(
			'text_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-text' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'text_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'text_color_hover',
			[
				'label' => esc_html__( 'Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-item:hover .codexse-icon-list-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_color_hover_transition',
			[
				'label' => esc_html__( 'Transition Duration', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 's', 'ms', 'custom' ],
				'default' => [
					'unit' => 's',
					'size' => 0.3,
				],
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-text' => 'transition: color {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}


	
	/**
	 * Render icon list widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$fallback_defaults = [
			'fa fa-check',
			'fa fa-times',
			'fa fa-dot-circle-o',
		];

		$this->add_render_attribute( 'icon_list', 'class', 'codexse-icon-list-items' );
		$this->add_render_attribute( 'list_item', 'class', 'codexse-icon-list-item' );

		if ( 'inline' === $settings['view'] ) {
			$this->add_render_attribute( 'icon_list', 'class', 'codexse-inline-items' );
			$this->add_render_attribute( 'list_item', 'class', 'codexse-inline-item' );
		}
		?>
		<ul <?php $this->print_render_attribute_string( 'icon_list' ); ?>>
			<?php
			foreach ( $settings['icon_list'] as $index => $item ) :
				$repeater_setting_key = $this->get_repeater_setting_key( 'text', 'icon_list', $index );

				$this->add_render_attribute( $repeater_setting_key, 'class', 'codexse-icon-list-text' );

				$this->add_inline_editing_attributes( $repeater_setting_key );
				$migration_allowed = Icons_Manager::is_migration_allowed();
				?>
				<li <?php $this->print_render_attribute_string( 'list_item' ); ?>>
					<?php
					if ( ! empty( $item['link']['url'] ) ) {
						$link_key = 'link_' . $index;

						$this->add_link_attributes( $link_key, $item['link'] );
						?>
						<a <?php $this->print_render_attribute_string( $link_key ); ?>>

						<?php
					}

					// add old default
					if ( ! isset( $item['icon'] ) && ! $migration_allowed ) {
						$item['icon'] = isset( $fallback_defaults[ $index ] ) ? $fallback_defaults[ $index ] : 'fa fa-check';
					}

					$migrated = isset( $item['__fa4_migrated']['selected_icon'] );
					$is_new = ! isset( $item['icon'] ) && $migration_allowed;
					if ( ! empty( $item['icon'] ) || ( ! empty( $item['selected_icon']['value'] ) && $is_new ) ) :
						?>
						<span class="codexse-icon-list-icon">
							<?php
							if ( $is_new || $migrated ) {
								Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] );
							} else { ?>
									<i class="<?php echo esc_attr( $item['icon'] ); ?>" aria-hidden="true"></i>
							<?php } ?>
						</span>
					<?php endif; ?>
					<span <?php $this->print_render_attribute_string( $repeater_setting_key ); ?>><?php $this->print_unescaped_setting( 'text', 'icon_list', $index ); ?></span>
					<?php if ( ! empty( $item['link']['url'] ) ) : ?>
						</a>
					<?php endif; ?>
				</li>
				<?php
			endforeach;
			?>
		</ul>
		<?php
	}

	/**
	 * Render icon list widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	protected function content_template() {
		?>
		<#
			view.addRenderAttribute( 'icon_list', 'class', 'codexse-icon-list-items' );
			view.addRenderAttribute( 'list_item', 'class', 'codexse-icon-list-item' );

			if ( 'inline' == settings.view ) {
				view.addRenderAttribute( 'icon_list', 'class', 'codexse-inline-items' );
				view.addRenderAttribute( 'list_item', 'class', 'codexse-inline-item' );
			}
			var iconsHTML = {},
				migrated = {};
		#>
		<# if ( settings.icon_list ) { #>
			<ul {{{ view.getRenderAttributeString( 'icon_list' ) }}}>
			<# _.each( settings.icon_list, function( item, index ) {

					var iconTextKey = view.getRepeaterSettingKey( 'text', 'icon_list', index );

					view.addRenderAttribute( iconTextKey, 'class', 'codexse-icon-list-text' );

					view.addInlineEditingAttributes( iconTextKey ); #>

					<li {{{ view.getRenderAttributeString( 'list_item' ) }}}>
						<# if ( item.link && item.link.url ) { #>
							<a href="{{ item.link.url }}">
						<# } #>
						<# if ( item.icon || item.selected_icon.value ) { #>
						<span class="codexse-icon-list-icon">
							<#
								iconsHTML[ index ] = elementor.helpers.renderIcon( view, item.selected_icon, { 'aria-hidden': true }, 'i', 'object' );
								migrated[ index ] = elementor.helpers.isIconMigrated( item, 'selected_icon' );
								if ( iconsHTML[ index ] && iconsHTML[ index ].rendered && ( ! item.icon || migrated[ index ] ) ) { #>
									{{{ iconsHTML[ index ].value }}}
								<# } else { #>
									<i class="{{ item.icon }}" aria-hidden="true"></i>
								<# }
							#>
						</span>
						<# } #>
						<span {{{ view.getRenderAttributeString( iconTextKey ) }}}>{{{ item.text }}}</span>
						<# if ( item.link && item.link.url ) { #>
							</a>
						<# } #>
					</li>
				<#
				} ); #>
			</ul>
		<#	} #>

		<?php
	}

	public function on_import( $element ) {
		return Icons_Manager::on_import_migration( $element, 'icon', 'selected_icon', true );
	}



}
