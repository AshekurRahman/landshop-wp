<?php
/**
 * Step Flow widget class
 *
 * @package Codexse_Addons
 */
namespace Codexse_Addons\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

defined( 'ABSPATH' ) || die();

class Step_Flow extends Base {
	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Step Flow', 'codexse-elementor-addons' );
	}

	public function get_custom_help_url() {
		return 'https://codexseaddons.com/docs/codexse-addons-for-elementor/widgets/step-flow/';
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
		return 'cx cx-step-flow';
	}

	public function get_keywords() {
		return [ 'step', 'flow' ];
	}

	/**
     * Register widget content controls
     */
	protected function register_content_controls() {

		$this->start_controls_section(
			'_section_step',
			[
				'label' => __( 'Step Flow', 'codexse-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		if ( cx_is_elementor_version( '<', '2.6.0' ) ) {
			$this->add_control(
				'icon',
				[
					'label' => __( 'Icon', 'codexse-elementor-addons' ),
					'type' => Controls_Manager::ICON,
					'label_block' => true,
					'options' => cx_get_codexse_icons(),
					'default' => 'cx cx-finger-index',
				]
			);
		} else {
			$this->add_control(
				'selected_icon',
				[
					'label' => __( 'Icon', 'codexse-elementor-addons' ),
					'type' => Controls_Manager::ICONS,
					'fa4compatibility' => 'icon',
					'label_block' => true,
					'default' => [
						'value' => 'cx cx-finger-index',
						'library' => 'codexse-icons',
					]
				]
			);
		}

		$this->add_control(
			'badge',
			[
				'label' => __( 'Badge', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Badge', 'codexse-elementor-addons' ),
				'description' => __( 'Keep it blank, if you want to remove the Badge', 'codexse-elementor-addons' ),
				'default' => __( 'Step 1', 'codexse-elementor-addons' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( 'Title', 'codexse-elementor-addons' ),
				'default' => __( 'Start Marketing', 'codexse-elementor-addons' ),
				'separator' => 'before',
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'description',
			[
				'label' => __( 'Description', 'codexse-elementor-addons' ),
				'description' => cx_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Description', 'codexse-elementor-addons' ),
				'default' => 'consectetur adipiscing elit, sed do<br>eiusmod Lorem ipsum dolor sit amet,<br> consectetur.',
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://example.com',
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label' => __( 'Title HTML Tag', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'separator' => 'before',
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h2',
			]
		);

		$this->add_control(
			'content_alignment',
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
					'justify' => [
						'title' => __( 'Justify', 'codexse-elementor-addons' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'show_indicator',
			[
				'label' => __( 'Show Direction', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'codexse-elementor-addons' ),
				'label_off' => __( 'No', 'codexse-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'style_transfer' => true,
			]
		);

		$this->end_controls_section();
	}

	/**
     * Register widget style controls
     */
	protected function register_style_controls() {
		$this->__icon_style_controls();
		$this->__badge_style_controls();
		$this->__title_desc_style_controls();
		$this->__direction_style_controls();
	}

	protected function __icon_style_controls() {

		$this->start_controls_section(
			'_section_icon_style',
			[
				'label' => __( 'Icon', 'codexse-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
					'em' => [
						'min' => 6,
						'max' => 300,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .cx-steps-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}' => '--cx-stepflow-icon-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => __( 'Padding', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .cx-steps-icon' => 'padding: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}' => '--cx-stepflow-icon-padding: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => __( 'Bottom Spacing', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .cx-steps-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'label' => __( 'Border', 'codexse-elementor-addons' ),
				'selector' => '{{WRAPPER}} .cx-steps-icon',
			]
		);

		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => __( 'Border Radius', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cx-steps-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .cx-steps-icon',
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-steps-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_background_color',
			[
				'label' => __( 'Background Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-steps-icon' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function __badge_style_controls() {

		$this->start_controls_section(
			'_section_badge_style',
			[
				'label' => __('Badge', 'codexse-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'badge!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'badge_padding',
			[
				'label' => __( 'Padding', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'condition' => [
					'badge!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .cx-steps-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'badge_border',
				'label' => __( 'Border', 'codexse-elementor-addons' ),
				'selector' => '{{WRAPPER}} .cx-steps-label',
				'condition' => [
					'badge!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'badge_border_radius',
			[
				'label' => __( 'Border Radius', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'condition' => [
					'badge!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .cx-steps-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'badge_color',
			[
				'label' => __( 'Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'badge!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .cx-steps-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'badge_background_color',
			[
				'label' => __( 'Background Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'badge!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .cx-steps-label' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'badge_typography',
				'selector' => '{{WRAPPER}} .cx-steps-label',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'condition' => [
					'badge!' => '',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function __title_desc_style_controls() {

		$this->start_controls_section(
			'_section_title_style',
			[
				'label' => __( 'Title & Description', 'codexse-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'_heading_title',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Title', 'codexse-elementor-addons' ),
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => __( 'Bottom Spacing', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .cx-steps-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-steps-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_link_color',
			[
				'label' => __( 'Link Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'link[url]!' => ''
				],
				'selectors' => [
					'{{WRAPPER}} .cx-steps-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Hover Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'link[url]!' => ''
				],
				'selectors' => [
					'{{WRAPPER}} .cx-steps-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .cx-steps-title',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .cx-steps-title',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_control(
			'_heading_description',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Description', 'codexse-elementor-addons' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-step-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'description_shadow',
				'selector' => '{{WRAPPER}} .cx-step-description',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .cx-step-description',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
			]
		);

		$this->end_controls_section();
	}

	protected function __direction_style_controls() {

		$this->start_controls_section(
			'_section_direction_style',
			[
				'label' => __( 'Direction', 'codexse-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'direction_style',
			[
				'label' => __( 'Style', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'solid' => __( 'Solid', 'codexse-elementor-addons' ),
					'dotted' => __( 'Dotted', 'codexse-elementor-addons' ),
					'dashed' => __( 'Dashed', 'codexse-elementor-addons' ),
				],
				'default' => 'solid',
				'selectors' => [
					'{{WRAPPER}} .cx-step-arrow, {{WRAPPER}} .cx-step-arrow:after' => 'border-top-style: {{VALUE}};',
					'{{WRAPPER}} .cx-step-arrow:after' => 'border-right-style: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'direction_width',
			[
				'label' => __( 'Width', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cx-step-arrow' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'direction_angle',
			[
				'label' => __( 'Angle', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['deg'],
				'default' => [
					'unit' => 'deg',
				],
				'tablet_default' => [
					'unit' => 'deg',
				],
				'mobile_default' => [
					'unit' => 'deg',
				],
				'range' => [
					'deg' => [
						'min' => 0,
						'max' => 360,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--cx-stepflow-direction-angle: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'direction_offset_toggle',
			[
				'label' => __( 'Offset', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'None', 'codexse-elementor-addons' ),
				'label_on' => __( 'Custom', 'codexse-elementor-addons' ),
				'return_value' => 'yes',
			]
		);

		$this->start_popover();

		$this->add_responsive_control(
			'direction_offset_y',
			[
				'label' => __( 'Offset Top', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 500,
					]
				],
				'condition' => [
					'direction_offset_toggle' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .cx-step-arrow' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'direction_offset_x',
			[
				'label' => __( 'Offset Left', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 500,
					]
				],
				'condition' => [
					'direction_offset_toggle' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .cx-step-arrow' => 'left: calc( 100% + {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}}' => '--cx-stepflow-direction-offset-x: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_popover();

		$this->add_control(
			'direction_color',
			[
				'label' => __( 'Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-step-arrow' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .cx-step-arrow:after' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'title', 'class', 'cx-steps-title' );

		$this->add_inline_editing_attributes( 'description', 'intermediate' );
		$this->add_render_attribute( 'description', 'class', 'cx-step-description' );

		$this->add_render_attribute( 'badge', 'class', 'cx-steps-label' );
		$this->add_inline_editing_attributes( 'badge', 'none' );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'link', $settings['link'] );
			$this->add_inline_editing_attributes( 'link', 'basic', 'title' );

			$title = sprintf( '<a %s>%s</a>',
				$this->get_render_attribute_string( 'link' ),
				cx_kses_basic( $settings['title'] )
			);
		} else {
			$this->add_inline_editing_attributes( 'title', 'basic' );
			$title = cx_kses_basic( $settings['title'] );
		}
		?>

		<div class="cx-steps-icon">
			<?php if ( $settings['show_indicator'] === 'yes' ) : ?>
				<span class="cx-step-arrow"></span>
			<?php endif; ?>

			<?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon']['value'] ) ) :
				cx_render_icon( $settings, 'icon', 'selected_icon' );
			endif; ?>

			<?php if ( $settings['badge'] ) : ?>
				<span <?php $this->print_render_attribute_string( 'badge' ); ?>><?php echo esc_html( $settings['badge'] ); ?></span>
			<?php endif; ?>
		</div>

		<?php
		printf( '<%1$s %2$s>%3$s</%1$s>',
			cx_escape_tags( $settings['title_tag'], 'h2' ),
			$this->get_render_attribute_string( 'title' ),
			$title
		);
		?>

		<?php if ( $settings['description'] ) : ?>
			<p <?php $this->print_render_attribute_string( 'description' ); ?>><?php echo cx_kses_intermediate( $settings['description'] ); ?></p>
		<?php endif; ?>

		<?php
	}

}
