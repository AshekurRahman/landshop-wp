<?php

/**
 * Post Feature_Image widget class
 *
 * @package Codexse_Addons
 */

namespace Codexse_Addons\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;

defined('ABSPATH') || die();

class Site_Tagline extends Base {

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __('Site Tagline', 'codexse-elementor-addons');
	}

	public function get_custom_help_url() {
		return 'https://codexseaddons.com/docs/codexse-addons-for-elementor/widgets/site-tagline/';
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
		return 'cx cx-tag';
	}

	public function get_keywords() {
		return ['site', 'tagline'];
	}

	/**
	 * Register widget content controls
	 */
	protected function register_content_controls() {

		$this->start_controls_section(
			'_section_site_tagline',
			[
				'label' => __('Tagline', 'codexse-elementor-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'icon',
			[
				'label'       => __('Icon', 'codexse-elementor-addons'),
				'type'        => Controls_Manager::ICONS,
				'label_block' => 'true',
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label'     => __('Icon Spacing', 'codexse-elementor-addons'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'icon[value]!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .cx-st-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'heading_text_align',
			[
				'label'              => __('Alignment', 'codexse-elementor-addons'),
				'type'               => Controls_Manager::CHOOSE,
				'options'            => [
					'left'    => [
						'title' => __('Left', 'codexse-elementor-addons'),
						'icon'  => 'fa fa-align-left',
					],
					'center'  => [
						'title' => __('Center', 'codexse-elementor-addons'),
						'icon'  => 'fa fa-align-center',
					],
					'right'   => [
						'title' => __('Right', 'codexse-elementor-addons'),
						'icon'  => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __('Justify', 'codexse-elementor-addons'),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .cx-site-tagline' => 'text-align: {{VALUE}};',
				],
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register styles related controls
	 */
	protected function register_style_controls() {
		$this->__site_logo_style_controls();
	}


	protected function __site_logo_style_controls() {

		$this->start_controls_section(
			'_section_style_tagline',
			[
				'label' => __('Tagline', 'codexse-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'tagline_typography',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
				'selector' => '{{WRAPPER}} .cx-site-tagline, {{WRAPPER}} .cx-site-tagline .cx-st-icon',
			]
		);
		$this->add_control(
			'tagline_color',
			[
				'label'     => __('Color', 'codexse-elementor-addons'),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .cx-site-tagline' => 'color: {{VALUE}};',
					'{{WRAPPER}} .cx-st-icon i'       => 'color: {{VALUE}};',
					'{{WRAPPER}} .cx-st-icon svg'     => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => __('Icon Color', 'codexse-elementor-addons'),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'condition' => [
					'icon[value]!' => '',
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .cx-st-icon i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .cx-st-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
?>
		<div class="cx-site-tagline cx-site-tagline-wrapper">
			<?php if ('' !== $settings['icon']['value']) { ?>
				<span class="cx-st-icon">
					<?php Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
				</span>
			<?php } ?>
			<span>
				<?php echo wp_kses_post(get_bloginfo('description')); ?>
			</span>
		</div>
<?php
	}
}
