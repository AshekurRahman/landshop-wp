<?php

/**
 * Post Feature_Image widget class
 *
 * @package Codexse_Addons
 */

namespace Codexse_Addons\Elementor\Widget;

use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;

defined('ABSPATH') || die();

class Post_Featured_Image extends Base {

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __('Post Featured Image', 'codexse-elementor-addons');
	}

	public function get_custom_help_url() {
		return 'https://codexseaddons.com/docs/codexse-addons-for-elementor/widgets/post-title/';
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
		return 'hm hm-tb-featured-image';
	}

	public function get_keywords() {
		return ['post image', 'image'];
	}

	/**
	 * Register widget content controls
	 */
	protected function register_content_controls() {

		$this->start_controls_section(
			'_section_post_thumbnail',
			[
				'label' => __('Post Featured Image', 'codexse-elementor-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'post_feature_image',
				'default' => 'full',
				'separator' => 'none',
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __('Alignment', 'codexse-elementor-addons'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'codexse-elementor-addons'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __('Center', 'codexse-elementor-addons'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __('Right', 'codexse-elementor-addons'),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __('Justify', 'codexse-elementor-addons'),
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
			'image_caption',
			[
				'label' => __('Show Caption', 'codexse-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'codexse-elementor-addons'),
				'label_off' => __('no', 'codexse-elementor-addons'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register styles related controls
	 */
	protected function register_style_controls() {
		$this->__thumbnail_style_controls();
		$this->__caption_style_controls();
	}


	protected function __thumbnail_style_controls() {

		$this->start_controls_section(
			'_section_thumbnail_style',
			[
				'label' => __('Image Style', 'codexse-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'thumbnail_width',
			[
				'label' => esc_html__('Size', 'codexse-elementor-addons'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'vw'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'vw' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'thumbnail_margin',
			[
				'label' => __('Margin', 'codexse-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'thumbnail_padding',
			[
				'label' => __('Padding', 'codexse-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'thumbnail_border',
				'label' => __('Border', 'codexse-elementor-addons'),
				'selector' => '{{WRAPPER}} .wrapper',
			]
		);

		$this->add_control(
			'thumbnail_radius',
			[
				'label' => __('Border Radius', 'codexse-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .elementor-widget-container img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function __caption_style_controls() {

		$this->start_controls_section(
			'_section_caption_style',
			[
				'label' => __('Caption Style', 'codexse-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'image_caption' => 'yes'
				]
			]
		);

		$this->add_control(
			'caption_margin',
			[
				'label' => esc_html__('Spacing (px)', 'codexse-elementor-addons'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .cx-image-caption' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'caption_color',
			[
				'label' => esc_html__('Color', 'codexse-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-image-caption' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'caption_typography',
				'label' => __('Typography', 'codexse-elementor-addons'),
				'selector' => '{{WRAPPER}} .cx-image-caption',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
			]
		);

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		if (cx_elementor()->editor->is_edit_mode() || is_preview()) {
			echo '<img src="' . Utils::get_placeholder_image_src() . '" alt="place holder image">';
		} else {
			if (has_post_thumbnail()) {

				if ($settings['post_feature_image_size'] == 'custom') {
					the_post_thumbnail(array($settings['post_feature_image_custom_dimension']['width'], $settings['post_feature_image_custom_dimension']['height']));
				} else {
					the_post_thumbnail($settings['post_feature_image_size']);
				}

				if ('yes' == $settings['image_caption']) { ?>
					<figcaption class="cx-image-caption"><?php echo wp_kses_post(get_the_post_thumbnail_caption()); ?></figcaption>
<?php }
			}
		}
	}
}
