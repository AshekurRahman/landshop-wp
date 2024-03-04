<?php
/**
 * Number widget class
 *
 * @package Codexse_Addons
 */
namespace Codexse_Addons\Elementor\Widget;

use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;

defined( 'ABSPATH' ) || die();

class Number extends Base {

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Number', 'codexse-elementor-addons' );
	}

	public function get_custom_help_url() {
		return 'https://codexseaddons.com/docs/codexse-addons-for-elementor/widgets/number/';
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
		return 'hm hm-madel';
	}

	public function get_keywords() {
		return [ 'number', 'animate', 'text' ];
	}

	/**
     * Register widget content controls
     */
	protected function register_content_controls() {

		$this->start_controls_section(
			'_section_number',
			[
				'label' => __( 'Number', 'codexse-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'number_text',
			[
				'label' => __( 'Text', 'codexse-elementor-addons' ),
				'label_block' => false,
				'type' => Controls_Manager::TEXT,
				'default' => 7,
                'dynamic' => [
                    'active' => true,
                ]
			]
		);

        $this->add_control(
            'animate_number',
            [
                'label' => __( 'Animate', 'codexse-elementor-addons' ),
                'description' => __( 'Only number is animatable' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'codexse-elementor-addons' ),
                'label_off' => __( 'No', 'codexse-elementor-addons' ),
                'return_value' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'animate_duration',
            [
                'label' => __( 'Duration', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 100,
                'max' => 10000,
                'step' => 10,
                'default' => 500,
                'condition' => [
                    'animate_number!' => ''
                ],
            ]
        );

        $this->end_controls_section();
	}

	/**
	 * Register styles related controls
	 */
	protected function register_style_controls() {
		$this->__number_bg_style_controls();
		$this->__text_style_controls();
	}

	protected function __number_bg_style_controls() {

		$this->start_controls_section(
			'number_background_style',
			[
				'label' => __( 'General', 'codexse-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'number_width_height',
			[
				'label' => __( 'Size', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cx-number-body' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'number_padding',
            [
                'label' => __( 'Padding', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .cx-number-body ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'number_border',
                'label' => __( 'Border', 'codexse-elementor-addons' ),
                'selector' => '{{WRAPPER}} .cx-number-body',
            ]
        );

        $this->add_control(
            'number_border_radius',
            [
                'label' => __( 'Border Radius', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .cx-number-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'number_box_shadow',
				'label' => __( 'Box Shadow', 'codexse-elementor-addons' ),
				'selector' => '{{WRAPPER}} .cx-number-body',
			]
		);

		$this->add_responsive_control(
			'number_align',
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
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .cx-number-body'  => '{{VALUE}};'
				],
                'selectors_dictionary' => [
                    'left' => 'float: left',
                    'center' => 'margin: 0 auto',
                    'right' => 'float:right'
                ],
			]
		);

        $this->add_control(
            '_heading_bg',
            [
                'label' => __( 'Background', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'number_background_color',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .cx-number-body',
            ]
        );

        $this->add_control(
                '_heading_bg_overlay',
                [
                    'label' => __( 'Background Overaly', 'codexse-elementor-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'number_background_overlay_color',
                'label' => __( 'Background', 'codexse-elementor-addons' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .cx-number-overlay',
            ]
        );

        $this->add_control(
            'number_background_overlay_blend_mode',
            [
                'label' => __( 'Blend Mood', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => cx_get_css_blend_modes(),
                'selectors' => [
                    '{{WRAPPER}} .cx-number-overlay' => 'mix-blend-mode: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'number_background_overlay_blend_mode_opacity',
            [
                'label' => __( 'Opacity', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => .1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-number-overlay' => 'opacity: {{SIZE}};',
                ],
            ]
        );

		$this->end_controls_section();
	}

	protected function __text_style_controls() {

        $this->start_controls_section(
            '_section_style_text',
            [
                'label' => __( 'Text', 'codexse-elementor-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'number_text_color',
            [
                'label' => __( 'Text Color', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cx-number-body' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'number_text_typography',
                'label' => __( 'Typography', 'codexse-elementor-addons' ),
                'selector' => '{{WRAPPER}} .cx-number-text',
                'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'number_text_shadow',
                'label' => __( 'Text Shadow', 'codexse-elementor-addons' ),
                'selector' => '{{WRAPPER}} .cx-number-text',
            ]
        );

        $this->add_control(
            'number_text_rotate',
            [
                'label' => __( 'Text Rotate', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-number-text' => '-webkit-transform: rotate({{SIZE}}deg);-ms-transform: rotate({{SIZE}}deg);transform: rotate({{SIZE}}deg);'
                ],
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'number_text', 'class', 'cx-number-text' );
		$number = $settings['number_text'];

		if ( $settings['animate_number'] ) {
		    $data = [
		        'toValue' => intval( $settings['number_text'] ),
                'duration' => intval( $settings['animate_duration'] ),
            ];
		    $this->add_render_attribute( 'number_text', 'data-animation', wp_json_encode( $data ) );
            $number = 0;
        }
        ?>

		<div class="cx-number-body">
			<div class="cx-number-overlay"></div>
			<span <?php $this->print_render_attribute_string( 'number_text' ); ?>><?php echo esc_html( $number ); ?></span>
		</div>

		<?php
	}
}
