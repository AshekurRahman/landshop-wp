<?php
/**
 * Chart widget class
 *
 * @package Codexse_Addons
 */
namespace Codexse_Addons\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Codexse_Addons\Elementor\Widget\Bar_Chart\Data_Map;

defined( 'ABSPATH' ) || die();

class Bar_Chart extends Base {

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Bar Chart', 'codexse-elementor-addons' );
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
		return 'hm hm-graph-bar';
	}

	public function get_keywords() {
		return [ 'chart', 'bar', 'statistic', 'graph' ];
	}

	/**
     * Register widget content controls
     */
	protected function register_content_controls() {
		$this->__barchart_content_controls();
		$this->__barchart_settings_content_controls();
	}

	protected function __barchart_content_controls() {

		$this->start_controls_section(
			'_section_chart',
			[
				'label' => __( 'Bar Chart', 'codexse-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'chart_position',
			[
				'label'   => __( '', 'codexse-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bar',
				'options' => [
					'bar' => __( 'Vertical Bar', 'codexse-elementor-addons' ),
					'horizontalBar' => __( 'Horizontal Bar', 'codexse-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'labels',
			[
				'label'       => __( 'Labels', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'January, February, March', 'codexse-elementor-addons' ),
				'description' => __( 'Write multiple label with comma ( , ) separator. Example: January, February, March etc', 'codexse-elementor-addons' ),
			]
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'bar_tabs' );

		$repeater->start_controls_tab(
			'bar_tab_content',
			[
				'label' => __( 'Content', 'codexse-elementor-addons' ),
			]
		);

		$repeater->add_control(
			'label',
			[
				'label'   => __( 'Label', 'codexse-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'data',
			[
				'label'       => __( 'Data', 'codexse-elementor-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'description' => __( 'Write data values with comma ( , ) separator. Example: 4, 2, 6', 'codexse-elementor-addons' ),
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'bar_tab_style',
			[
				'label' => __( 'Style', 'codexse-elementor-addons' ),
			]
		);

		$repeater->add_control(
			'background_color',
			[
				'label' => __( 'Background Color', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
			]
		);

		$repeater->add_control(
			'background_hover_color',
			[
				'label' => __( 'Background Hover Color', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
			]
		);

		$repeater->add_control(
			'border_color',
			[
				'label' => __( 'Border Color', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
			]
		);

		$repeater->add_control(
			'border_hover_color',
			[
				'label' => __( 'Border Hover Color', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
			]
		);

		$repeater->end_controls_tab();

		$this->add_control(
			'chart_data',
			[
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ label }}}',
				'default'     => [
					[
						'label'              => __( 'Codexse', 'codexse-elementor-addons' ),
						'data'               => __( '2, 4, 5', 'codexse-elementor-addons' ),
						'background_color'       => 'rgba(86, 45, 212, 0.7)',
						'background_hover_color' => '#27b59e',
						'border_color'       => '#602edc',
						'border_hover_color' => '#602edc',
					],
					[
						'label'              => __( 'Codexse Pro', 'codexse-elementor-addons' ),
						'data'               => __( '1, 6, 8', 'codexse-elementor-addons' ),
						'background_color'       => 'rgba(226, 73, 138, 0.7)',
						'background_hover_color' => '#26b59e',
						'border_color'       => '#d23b7b',
						'border_hover_color' => '#d23b7b',
					]
				]
			]
		);

		$this->end_controls_section();
	}

	protected function __barchart_settings_content_controls() {

		$this->start_controls_section(
			'settings',
			[
				'label' => __( 'Settings', 'codexse-elementor-addons' ),
			]
		);

		$this->add_responsive_control(
			'chart_height',
			[
				'label'       => __( 'Chart Height', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min' => 50,
						'max' => 1500,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 500,
				],
				'selectors'   => [
					'{{WRAPPER}} .cx-bar-chart-container' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'xaxes_grid_display',
			[
				'label'        => __( 'X Axes Grid Lines', 'codexse-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'yaxes_grid_display',
			[
				'label'        => __( 'Y Axes Grid Lines', 'codexse-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'xaxes_labels_display',
			[
				'label'        => __( 'Show X Axes Labels', 'codexse-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'yaxes_labels_display',
			[
				'label'        => __( 'Show Y Axes Labels', 'codexse-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'tooltip_display',
			[
				'label'        => __( 'Show Tooltips', 'codexse-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'title_display',
			[
				'label'        => __( 'Show Title', 'codexse-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'chart_title',
			[
				'label'       => __( 'Title', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Codexse Rocks', 'codexse-elementor-addons' ),
				'condition' => [
					'title_display' => 'yes'
				]
			]
		);

		$this->add_control(
			'axis_range',
			[
				'label'       => __( 'Scale Axis Range', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 10,
				'description' => __( 'Maximum number for the scale.', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'step_size',
			[
				'label'       => __( 'Step Size', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 1,
				'step'        => 1,
				'description' => __( 'Step size for the scale.', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'legend_heading',
			[
				'label'     => __( 'Legend', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'legend_display',
			[
				'label'        => __( 'Show Legend', 'codexse-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'legend_position',
			[
				'label'     => __( 'Position', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'top',
				'options'   => [
					'top'    => __( 'Top', 'codexse-elementor-addons' ),
					'left'   => __( 'Left', 'codexse-elementor-addons' ),
					'bottom' => __( 'Bottom', 'codexse-elementor-addons' ),
					'right'  => __( 'Right', 'codexse-elementor-addons' ),
				],
				'condition' => [
					'legend_display' => 'yes',
				],
			]
		);

		$this->add_control(
			'legend_reverse',
			[
				'label'        => __( 'Reverse', 'codexse-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
				'condition'    => [
					'legend_display'  => 'yes',
				],
			]
		);

		$this->add_control(
			'animation_heading',
			[
				'label'     => __( 'Animation', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'chart_animation_duration',
			[
				'label' => __( 'Duration', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10000,
				'step' => 1,
				'default' => 1000,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'animation_options',
			[
				'label'     => __( 'Easing', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'linear',
				'options'   => [
					'linear'    => __( 'Linear', 'codexse-elementor-addons' ),
					'easeInCubic'   => __( 'Ease In Cubic', 'codexse-elementor-addons' ),
					'easeInCirc' => __( 'Ease In Circ', 'codexse-elementor-addons' ),
					'easeInBounce' => __( 'Ease In Bounce', 'codexse-elementor-addons' ),
				]
			]
		);

		$this->end_controls_section();
	}

	/**
     * Register widget style controls
     */
	protected function register_style_controls() {
		$this->__barchart_common_style_controls();
		$this->__barchart_legend_style_controls();
		$this->__barchart_label_style_controls();
		$this->__barchart_tooltip_style_controls();
	}

	protected function __barchart_common_style_controls() {

		$this->start_controls_section(
			'_section_style_common',
			[
				'label' => __( 'Common', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'layout_padding',
			[
				'label' => __( 'Padding', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
			]
		);

		$this->add_control(
			'bar_width',
			[
				'label' => __( 'Bar Width', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 99,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 80,
				],
			]
		);

		$this->add_control(
			'category_width',
			[
				'label' => __( 'Category Width', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 99,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 85,
				],
			]
		);

		$this->add_control(
			'bar_border_width',
			[
				'label' => __( 'Bar Border Width', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
			]
		);

		$this->add_control(
			'grid_color',
			[
				'label' => __( 'Grid Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'condition' => [
					'grid_display' => 'yes',
				]
			]
		);

		$this->add_control(
			'title_typography_toggle',
			[
				'label' => __( 'Title Typography', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'None', 'codexse-elementor-addons' ),
				'label_on' => __( 'Custom', 'codexse-elementor-addons' ),
				'return_value' => 'yes',
				'condition' => [
					'title_display' => 'yes'
				]
			]
		);

		$this->start_popover();

		$this->add_control(
			'title_font_size',
			[
				'label' => __( 'Font Size', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'condition' => [
					'title_display' => 'yes',
					'title_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'title_font_family',
			[
				'label' => __( 'Font Family', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::FONT,
				'default' => '',
				'condition' => [
					'title_display' => 'yes',
					'title_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'title_font_weight',
			[
				'label'   => esc_html__( 'Font Weight', 'codexse-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'codexse-elementor-addons' ),
					'normal' => __( 'Normal', 'codexse-elementor-addons' ),
					'bold'   => __( 'Bold', 'codexse-elementor-addons' ),
					'300'    => __( '300', 'codexse-elementor-addons' ),
					'400'    => __( '400', 'codexse-elementor-addons' ),
					'600'    => __( '600', 'codexse-elementor-addons' ),
					'700'    => __( '700', 'codexse-elementor-addons' )
				],
				'condition' => [
					'title_display' => 'yes',
					'title_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'title_font_style',
			[
				'label'   => esc_html__( 'Font Style', 'codexse-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''        => __( 'Default', 'codexse-elementor-addons' ),
					'normal'  => __( 'Normal', 'codexse-elementor-addons' ),
					'italic'  => __( 'Italic', 'codexse-elementor-addons' ),
					'oblique' => __( 'Oblique', 'codexse-elementor-addons' ),
				],
				'condition' => [
					'title_display' => 'yes',
					'title_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'title_font_color',
			[
				'label' => __( 'Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'title_display' => 'yes',
					'title_typography_toggle' => 'yes'
				]
			]
		);

		$this->end_popover();

		$this->end_controls_section();
	}

	protected function __barchart_legend_style_controls() {

		$this->start_controls_section(
			'_section_style_legend',
			[
				'label' => __( 'Legend', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'lagend_note',
			[
				'label' => false,
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __( 'Lagend is Switched off from Content > Settings.', 'codexse-elementor-addons' ),
				'condition' => [
					'legend_display!' => 'yes'
				]
			]
		);

		$this->add_control(
			'legend_box_width',
			[
				'label' => __( 'Box Width', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 70,
					],
				],
				'condition' => [
					'legend_display' => 'yes'
				]
			]
		);

		$this->add_control(
            'legend_typography_toggle',
            [
                'label' => __( 'Typography', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __( 'None', 'codexse-elementor-addons' ),
                'label_on' => __( 'Custom', 'codexse-elementor-addons' ),
				'return_value' => 'yes',
				'condition' => [
					'legend_display' => 'yes'
				]
            ]
		);

		$this->start_popover();

		$this->add_control(
			'legend_font_size',
			[
				'label' => __( 'Font Size', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'condition' => [
					'legend_display' => 'yes',
					'legend_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'legend_font_family',
			[
				'label' => __( 'Font Family', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::FONT,
				'default' => '',
				'condition' => [
					'legend_display' => 'yes',
					'legend_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'legend_font_weight',
			[
				'label'   => esc_html__( 'Font Weight', 'codexse-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'codexse-elementor-addons' ),
					'normal' => __( 'Normal', 'codexse-elementor-addons' ),
					'bold'   => __( 'Bold', 'codexse-elementor-addons' ),
					'300'    => __( '300', 'codexse-elementor-addons' ),
					'400'    => __( '400', 'codexse-elementor-addons' ),
					'600'    => __( '600', 'codexse-elementor-addons' ),
					'700'    => __( '700', 'codexse-elementor-addons' )
				],
				'condition' => [
					'legend_display' => 'yes',
					'legend_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'legend_font_style',
			array(
				'label'   => esc_html__( 'Font Style', 'codexse-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''        => __( 'Default', 'codexse-elementor-addons' ),
					'normal'  => __( 'Normal', 'codexse-elementor-addons' ),
					'italic'  => __( 'Italic', 'codexse-elementor-addons' ),
					'oblique' => __( 'Oblique', 'codexse-elementor-addons' ),
				),
				'condition' => [
					'legend_display' => 'yes',
					'legend_typography_toggle' => 'yes'
				]
			)
		);

		$this->add_control(
			'legend_font_color',
			[
				'label' => __( 'Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'legend_display' => 'yes',
					'legend_typography_toggle' => 'yes'
				]
			]
		);

		$this->end_popover();

		$this->end_controls_section();
	}

	protected function __barchart_label_style_controls() {

		$this->start_controls_section(
			'_section_style_label',
			[
				'label' => __( 'Labels', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'labels_padding',
			[
				'label'       => __( 'Padding', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::SLIDER,
			]
		);

		$this->add_control(
			'xaxes_label_note',
			[
				'label' => false,
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __( 'X Axes Label is Switched off from Content > Settings.', 'codexse-elementor-addons' ),
				'condition' => [
					'xaxes_labels_display!' => 'yes'
				]
			]
		);

		$this->add_control(
            'labels_xaxes_typography_toggle',
            [
                'label' => __( 'X Axes Typography', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __( 'None', 'codexse-elementor-addons' ),
                'label_on' => __( 'Custom', 'codexse-elementor-addons' ),
				'return_value' => 'yes',
				'condition' => [
					'xaxes_labels_display' => 'yes'
				]
            ]
		);

		$this->start_popover();

		$this->add_control(
			'labels_xaxes_font_size',
			[
				'label' => __( 'Font Size', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'condition' => [
					'xaxes_labels_display' => 'yes',
					'labels_xaxes_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'labels_xaxes_font_family',
			[
				'label' => __( 'Font Family', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::FONT,
				'default' => '',
				'condition' => [
					'xaxes_labels_display' => 'yes',
					'labels_xaxes_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'labels_xaxes_font_weight',
			[
				'label'   => esc_html__( 'Font Weight', 'codexse-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'codexse-elementor-addons' ),
					'normal' => __( 'Normal', 'codexse-elementor-addons' ),
					'bold'   => __( 'Bold', 'codexse-elementor-addons' ),
					'300'    => __( '300', 'codexse-elementor-addons' ),
					'400'    => __( '400', 'codexse-elementor-addons' ),
					'600'    => __( '600', 'codexse-elementor-addons' ),
					'700'    => __( '700', 'codexse-elementor-addons' )
				],
				'condition' => [
					'xaxes_labels_display' => 'yes',
					'labels_xaxes_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'labels_xaxes_font_style',
			array(
				'label'   => esc_html__( 'Font Style', 'codexse-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''        => __( 'Default', 'codexse-elementor-addons' ),
					'normal'  => __( 'Normal', 'codexse-elementor-addons' ),
					'italic'  => __( 'Italic', 'codexse-elementor-addons' ),
					'oblique' => __( 'Oblique', 'codexse-elementor-addons' ),
				),
				'condition' => [
					'xaxes_labels_display' => 'yes',
					'labels_xaxes_typography_toggle' => 'yes'
				]
			)
		);

		$this->add_control(
			'labels_xaxes_font_color',
			[
				'label' => __( 'Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'xaxes_labels_display' => 'yes',
					'labels_xaxes_typography_toggle' => 'yes'
				]
			]
		);

		$this->end_popover();

		$this->add_control(
			'yaxes_label_note',
			[
				'label' => false,
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __( 'Y Axes Label is Switched off from Content > Settings.', 'codexse-elementor-addons' ),
				'condition' => [
					'yaxes_labels_display!' => 'yes'
				]
			]
		);

		$this->add_control(
            'labels_yaxes_typography_toggle',
            [
                'label' => __( 'Y Axes Typography', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __( 'None', 'codexse-elementor-addons' ),
                'label_on' => __( 'Custom', 'codexse-elementor-addons' ),
				'return_value' => 'yes',
				'condition' => [
					'yaxes_labels_display' => 'yes'
				]
            ]
		);

		$this->start_popover();

		$this->add_control(
			'labels_yaxes_font_size',
			[
				'label' => __( 'Font Size', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'condition' => [
					'xaxes_labels_display' => 'yes',
					'labels_yaxes_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'labels_yaxes_font_family',
			[
				'label' => __( 'Font Family', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::FONT,
				'default' => '',
				'condition' => [
					'xaxes_labels_display' => 'yes',
					'labels_yaxes_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'labels_yaxes_font_weight',
			[
				'label'   => esc_html__( 'Font Weight', 'codexse-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'codexse-elementor-addons' ),
					'normal' => __( 'Normal', 'codexse-elementor-addons' ),
					'bold'   => __( 'Bold', 'codexse-elementor-addons' ),
					'300'    => __( '300', 'codexse-elementor-addons' ),
					'400'    => __( '400', 'codexse-elementor-addons' ),
					'600'    => __( '600', 'codexse-elementor-addons' ),
					'700'    => __( '700', 'codexse-elementor-addons' )
				],
				'condition' => [
					'xaxes_labels_display' => 'yes',
					'labels_yaxes_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'labels_yaxes_font_style',
			array(
				'label'   => esc_html__( 'Font Style', 'codexse-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''        => __( 'Default', 'codexse-elementor-addons' ),
					'normal'  => __( 'Normal', 'codexse-elementor-addons' ),
					'italic'  => __( 'Italic', 'codexse-elementor-addons' ),
					'oblique' => __( 'Oblique', 'codexse-elementor-addons' ),
				),
				'condition' => [
					'xaxes_labels_display' => 'yes',
					'labels_yaxes_typography_toggle' => 'yes'
				]
			)
		);

		$this->add_control(
			'labels_yaxes_font_color',
			[
				'label' => __( 'Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'xaxes_labels_display' => 'yes',
					'labels_yaxes_typography_toggle' => 'yes'
				]
			]
		);

		$this->end_popover();

		$this->end_controls_section();
	}

	protected function __barchart_tooltip_style_controls() {

		$this->start_controls_section(
			'_section_style_tooltip',
			[
				'label' => __( 'Tooltip', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'tooltip_padding',
			[
				'label' => __( 'Padding', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'condition' => [
					'tooltip_display' => 'yes',
				]
			]
		);

		$this->add_control(
			'tooltip_border_width',
			[
				'label' => __( 'Border Width', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'condition' => [
					'tooltip_display' => 'yes',
				]
			]
		);

		$this->add_control(
			'tooltip_border_radius',
			[
				'label' => __( 'Border Radius', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'condition' => [
					'tooltip_display' => 'yes',
				]
			]
		);

		$this->add_control(
			'tooltip_caret_size',
			[
				'label' => __( 'Caret Size', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'condition' => [
					'tooltip_display' => 'yes',
				]
			]
		);

		$this->add_control(
			'tooltip_mode',
			[
				'label'   => esc_html__( 'Mode', 'codexse-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Select Mode', 'codexse-elementor-addons' ),
					'nearest' => __( 'Nearest', 'codexse-elementor-addons' ),
					'index' => __( 'Index', 'codexse-elementor-addons' ),
					'x' => __( 'X', 'codexse-elementor-addons' ),
					'y' => __( 'Y', 'codexse-elementor-addons' ),
				],
				'default' => '',
				'condition' => [
					'tooltip_display' => 'yes',
				]
			]
		);

		$this->add_control(
			'tooltip_background_color',
			[
				'label' => esc_html__( 'Background Color', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
				'condition' => [
					'tooltip_display' => 'yes'
				]
			]
		);

		$this->add_control(
			'tooltip_border_color',
			[
				'label' => esc_html__( 'Border Color', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
				'condition' => [
					'tooltip_display' => 'yes'
				]
			]
		);

		$this->add_control(
			'tooltip_title_typography_toggle',
			[
				'label' => __( 'Title Typography', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'None', 'codexse-elementor-addons' ),
				'label_on' => __( 'Custom', 'codexse-elementor-addons' ),
				'return_value' => 'yes',
				'condition' => [
					'tooltip_display' => 'yes'
				]
			]
		);

		$this->start_popover();

		$this->add_control(
			'tooltip_title_font_size',
			[
				'label' => __( 'Font Size', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'condition' => [
					'tooltip_display' => 'yes',
					'tooltip_title_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'tooltip_title_font_family',
			[
				'label' => __( 'Font Family', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::FONT,
				'default' => '',
				'condition' => [
					'tooltip_display' => 'yes',
					'tooltip_title_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'tooltip_title_font_weight',
			[
				'label'   => esc_html__( 'Font Weight', 'codexse-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'codexse-elementor-addons' ),
					'normal' => __( 'Normal', 'codexse-elementor-addons' ),
					'bold'   => __( 'Bold', 'codexse-elementor-addons' ),
					'300'    => __( '300', 'codexse-elementor-addons' ),
					'400'    => __( '400', 'codexse-elementor-addons' ),
					'600'    => __( '600', 'codexse-elementor-addons' ),
					'700'    => __( '700', 'codexse-elementor-addons' )
				],
				'condition' => [
					'tooltip_display' => 'yes',
					'tooltip_title_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'tooltip_title_font_style',
			[
				'label'   => esc_html__( 'Font Style', 'codexse-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''        => __( 'Default', 'codexse-elementor-addons' ),
					'normal'  => __( 'Normal', 'codexse-elementor-addons' ),
					'italic'  => __( 'Italic', 'codexse-elementor-addons' ),
					'oblique' => __( 'Oblique', 'codexse-elementor-addons' ),
				],
				'condition' => [
					'tooltip_display' => 'yes',
					'tooltip_title_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'tooltip_title_font_color',
			[
				'label' => __( 'Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'tooltip_display' => 'yes',
					'tooltip_title_typography_toggle' => 'yes'
				]
			]
		);

		$this->end_popover();

		$this->add_control(
			'tooltip_body_typography_toggle',
			[
				'label' => __( 'Body Typography', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'None', 'codexse-elementor-addons' ),
				'label_on' => __( 'Custom', 'codexse-elementor-addons' ),
				'return_value' => 'yes',
				'condition' => [
					'tooltip_display' => 'yes'
				]
			]
		);

		$this->start_popover();

		$this->add_control(
			'tooltip_body_font_size',
			[
				'label' => __( 'Font Size', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'condition' => [
					'tooltip_display' => 'yes',
					'tooltip_body_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'tooltip_body_font_family',
			[
				'label' => __( 'Font Family', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::FONT,
				'default' => '',
				'condition' => [
					'tooltip_display' => 'yes',
					'tooltip_body_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'tooltip_body_font_weight',
			[
				'label'   => esc_html__( 'Font Weight', 'codexse-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'codexse-elementor-addons' ),
					'normal' => __( 'Normal', 'codexse-elementor-addons' ),
					'bold'   => __( 'Bold', 'codexse-elementor-addons' ),
					'300'    => __( '300', 'codexse-elementor-addons' ),
					'400'    => __( '400', 'codexse-elementor-addons' ),
					'600'    => __( '600', 'codexse-elementor-addons' ),
					'700'    => __( '700', 'codexse-elementor-addons' )
				],
				'condition' => [
					'tooltip_display' => 'yes',
					'tooltip_body_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'tooltip_body_font_style',
			[
				'label'   => esc_html__( 'Font Style', 'codexse-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''        => __( 'Default', 'codexse-elementor-addons' ),
					'normal'  => __( 'Normal', 'codexse-elementor-addons' ),
					'italic'  => __( 'Italic', 'codexse-elementor-addons' ),
					'oblique' => __( 'Oblique', 'codexse-elementor-addons' ),
				],
				'condition' => [
					'tooltip_display' => 'yes',
					'tooltip_body_typography_toggle' => 'yes'
				]
			]
		);

		$this->add_control(
			'tooltip_body_font_color',
			[
				'label' => __( 'Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'tooltip_display' => 'yes',
					'tooltip_body_typography_toggle' => 'yes'
				]
			]
		);

		$this->end_popover();

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();
		include_once CODEXSE_ADDONS_DIR_PATH . "widgets/bar-chart/classes/data-map.php";

		$this->add_render_attribute(
			'container',
			[
				'class'         => 'cx-bar-chart-container',
				'data-settings' => Data_Map::initial($settings)
			]
		);

		$this->add_render_attribute( 'canvas',
			[
				'id' => 'cx-bar-chart',
				'role'  => 'img',
			]
		);
		?>
		<div <?php echo $this->get_render_attribute_string( 'container' ); ?>>

			<canvas <?php echo $this->get_render_attribute_string( 'canvas' ); ?>></canvas>

		</div>

	<?php
	}

}
