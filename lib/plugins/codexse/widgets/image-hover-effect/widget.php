<?php

/**
 * Image grid widget class
 *
 * @package Codexse_Addons
 */

namespace Codexse_Addons\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

defined('ABSPATH') || die();

class Image_Hover_Effect extends Base {

	/**
	 * Default filter is the global filter
	 * and can be overriden from settings
	 *
	 * @var string
	 */

	public function get_title() {
		return __('Image Hover Effect', 'codexse-elementor-addons');
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
		return 'cx cx-cursor-hover-click';
	}

	public function get_keywords() {
		return ['hover', 'image', 'effect'];
	}

	/**
     * Register widget content controls
     */
	protected function register_content_controls() {

		$this->start_controls_section(
			'_section_image_content',
			[
				'label' => __('Image Content', 'codexse-elementor-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'hover_image',
			[
				'label' => __('Image', 'codexse-elementor-addons'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [
					'active' => true
				],
			]
		);

		$this->add_control(
			'hover_image_alt_tag',
			[
				'label' => __('Image ALT Tag', 'codexse-elementor-addons'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Image hover effect image', 'codexse-elementor-addons'),
				'placeholder' => __('Type here image alt tag value', 'codexse-elementor-addons'),
				'dynamic' => ['active' => true,],
			]
		);

		$this->add_control(
			'hover_title',
			[
				'label' => __('Title', 'codexse-elementor-addons'),
				'type' => Controls_Manager::TEXTAREA,
				'description' => cx_get_allowed_html_desc( 'intermediate' ),
				'rows' => 3,
				'default' => __('Codexse <span>Addons</span>', 'codexse-elementor-addons'),
				'placeholder' => __('Type your title here', 'codexse-elementor-addons'),
				'dynamic' => ['active' => true],
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label' => __( 'Title HTML Tag', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				// 'separator' => 'before',
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
			'hover_description',
			[
				'label' => __('Description', 'codexse-elementor-addons'),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => __('Best Elementor Addons', 'codexse-elementor-addons'),
				'placeholder' => __('Type your description here', 'codexse-elementor-addons'),
				'condition' => [
					'hover_effect!' => 'cx-effect-honey',
				],
				'dynamic' => ['active' => true],
			]
		);

		$this->add_control(
			'hover_link',
			[
				'label' => __('Link URL', 'codexse-elementor-addons'),
				'type' => Controls_Manager::URL,
				'placeholder' => __('https://your-link.com', 'codexse-elementor-addons'),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
				'dynamic' => ['active' => true],
			]
		);

		$this->add_control(
			'hover_effect',
			[
				'label' => __('Hover Effect', 'codexse-elementor-addons'),
				'type' => Controls_Manager::SELECT2,
				'options' => [
					'cx-effect-apollo'  => __('Apollo', 'codexse-elementor-addons'),
					'cx-effect-bubba'  => __('Bubba', 'codexse-elementor-addons'),
					'cx-effect-chico'  => __('Chico', 'codexse-elementor-addons'),
					'cx-effect-dexter'  => __('Dexter', 'codexse-elementor-addons'),
					'cx-effect-duke'  => __('Duke', 'codexse-elementor-addons'),
					'cx-effect-goliath'  => __('Goliath', 'codexse-elementor-addons'),
					'cx-effect-honey'  => __('Honey', 'codexse-elementor-addons'),
					'cx-effect-jazz'  => __('Jazz', 'codexse-elementor-addons'),
					'cx-effect-layla'  => __('Layla', 'codexse-elementor-addons'),
					'cx-effect-lexi'  => __('Lexi', 'codexse-elementor-addons'),
					'cx-effect-lily'  => __('Lily', 'codexse-elementor-addons'),
					'cx-effect-marley'  => __('Marley', 'codexse-elementor-addons'),
					'cx-effect-milo'  => __('Milo', 'codexse-elementor-addons'),
					'cx-effect-ming'  => __('Ming', 'codexse-elementor-addons'),
					'cx-effect-moses'  => __('Moses', 'codexse-elementor-addons'),
					'cx-effect-oscar'  => __('Oscar', 'codexse-elementor-addons'),
					'cx-effect-romeo'  => __('Romeo', 'codexse-elementor-addons'),
					'cx-effect-roxy'  => __('Roxy', 'codexse-elementor-addons'),
					'cx-effect-ruby'  => __('Ruby', 'codexse-elementor-addons'),
					'cx-effect-sadie'  => __('Sadie', 'codexse-elementor-addons'),
					'cx-effect-sarah'  => __('Sarah', 'codexse-elementor-addons'),
				],
				'default' => 'cx-effect-apollo',
			]
		);

		$this->end_controls_section();
	}

	/**
     * Register widget style controls
     */
	protected function register_style_controls() {
		$this->__common_style_controls();
		$this->__overlay_style_controls();
	}

	protected function __common_style_controls() {

		$this->start_controls_section(
			'_section_common_style',
			[
				'label' => __('Common', 'codexse-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'hover_container_height_width_control',
			[
				'label' => __('Container Max Width?', 'codexse-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'codexse-elementor-addons'),
				'label_off' => __('No', 'codexse-elementor-addons'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_responsive_control(
			'hover_width',
			[
				'label' => __('Width', 'codexse-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1200,
						'step' => 5,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'desktop_default' => [
					'size' => 480,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 480,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 300,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .cx-ihe-wrapper' => 'width: {{SIZE}}{{UNIT}}; height: calc({{SIZE}}{{UNIT}}/1.34);',
				],
				'condition' => [
					'hover_container_height_width_control' => 'yes'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'hover_border',
				'label' => __('Border', 'codexse-elementor-addons'),
				'selector' => '{{WRAPPER}} .cx-ihe-wrapper .cx-ihe-fig',
			]
		);

		$this->add_control(
			'hover_border_radius',
			[
				'label' => __('Border Radius', 'codexse-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .cx-ihe-wrapper .cx-ihe-fig' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typo',
				'label' => __('Title Typography', 'codexse-elementor-addons'),
				'selector' => '{{WRAPPER}} .cx-ihe-wrapper .cx-ihe-fig .cx-ihe-title',
				'fields_options' => [
					'typography' => ['default' => 'yes'],
					'font_family' => [
						'default' => 'Roboto',
					],
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typo',
				'label' => __('Description Typography', 'codexse-elementor-addons'),
				'selector' => '{{WRAPPER}} .cx-ihe-wrapper .cx-ihe-fig .cx-ihe-desc',
				'fields_options' => [
					'typography' => ['default' => 'yes'],
					'font_family' => [
						'default' => 'Roboto',
					],
				],
			]
		);

		$this->start_controls_tabs('_tabs_style');

		$this->start_controls_tab(
			'_tab_normal',
			[
				'label' => __('Normal', 'codexse-elementor-addons'),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __('Title Color', 'codexse-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-ihe-wrapper .cx-ihe-fig .cx-ihe-title' => 'color: {{VALUE}}; border-color: {{VALUE}};',
					'{{WRAPPER}} .cx-ihe-wrapper .cx-ihe-fig .cx-ihe-title::before' => '--cx-ihe-title-before-color: {{VALUE}};',
					'{{WRAPPER}} .cx-ihe-wrapper .cx-ihe-fig .cx-ihe-title::after' => '--cx-ihe-title-after-color: {{VALUE}};',
					'{{WRAPPER}} .cx-ihe-wrapper .cx-ihe-fig .cx-ihe-caption::before' => '--cx-ihe-fig-before-color: {{VALUE}};',
					'{{WRAPPER}} .cx-ihe-wrapper .cx-ihe-fig .cx-ihe-caption::after' => '--cx-ihe-fig-after-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __('Description Color', 'codexse-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-ihe-wrapper .cx-ihe-fig .cx-ihe-desc' => 'color: {{VALUE}}; --cx-ihe-desc-border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tab_hover',
			[
				'label' => __('Hover', 'codexse-elementor-addons'),
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label' => __('Title Color', 'codexse-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-ihe-wrapper .cx-ihe-fig:hover .cx-ihe-title' => 'color: {{VALUE}}; border-color: {{VALUE}};',
					'{{WRAPPER}} .cx-ihe-wrapper .cx-ihe-fig:hover .cx-ihe-title::before' => '--cx-ihe-title-before-color: {{VALUE}};',
					'{{WRAPPER}} .cx-ihe-wrapper .cx-ihe-fig:hover .cx-ihe-title::after' => '-cx-ihe-title-after-color: {{VALUE}};',
					'{{WRAPPER}} .cx-ihe-wrapper .cx-ihe-fig:hover .cx-ihe-caption::before' => '--cx-ihe-fig-before-color: {{VALUE}};',
					'{{WRAPPER}} .cx-ihe-wrapper .cx-ihe-fig:hover .cx-ihe-caption::after' => '--cx-ihe-fig-after-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'description_hover_color',
			[
				'label' => __('Description Color', 'codexse-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-ihe-wrapper .cx-ihe-fig:hover .cx-ihe-desc' => 'color: {{VALUE}}; --cx-ihe-desc-border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function __overlay_style_controls() {

		$this->start_controls_section(
			'_section_overlay_style',
			[
				'label' => __('Background Overlay', 'codexse-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('_tabs_overlay_style');
		$this->start_controls_tab(
			'_tab_overlay_normal',
			[
				'label' => __('Normal', 'codexse-elementor-addons'),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'hover_overlay_normal',
				'label' => __('Background', 'codexse-elementor-addons'),
				'show_label' => true,
				'types' => ['classic', 'gradient'],
				'exclude' => [
					'classic' => 'image'
				],
				'selector' => '{{WRAPPER}} .cx-ihe-wrapper .cx-ihe-fig, {{WRAPPER}} .cx-ihe-wrapper .cx-ihe-fig.cx-effect-sadie .cx-ihe-caption::before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tab_overlay_hover',
			[
				'label' => __('Hover', 'codexse-elementor-addons'),
			]
		);


		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'hover_overlay_hover',
				'label' => __('Background', 'codexse-elementor-addons'),
				'show_label' => true,
				'types' => ['classic', 'gradient'],
				'exclude' => [
					'classic' => 'image'
				],
				'selector' => '{{WRAPPER}} .cx-ihe-wrapper .cx-ihe-fig:hover, {{WRAPPER}} .cx-ihe-wrapper .cx-ihe-fig.cx-effect-sadie:hover .cx-ihe-caption::before',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$url_target = $settings['hover_link']['is_external'] ? ' target="_blank"' : '';
		$url_nofollow = $settings['hover_link']['nofollow'] ? ' rel="nofollow"' : '';
?>
		<div class="cx-ihe-wrapper grid">
			<figure class="cx-ihe-fig <?php echo esc_attr($settings['hover_effect']); ?>">
				<img class="cx-ihe-img" src="<?php echo esc_url($settings['hover_image']['url']); ?>" alt="<?php echo esc_attr($settings['hover_image_alt_tag']); ?>" />
				<figcaption class="cx-ihe-caption">
					<?php if ($settings['hover_effect'] == 'cx-effect-lily') : ?>
						<div>
						<?php endif; ?>
						<?php
						printf( '<%1$s class="cx-ihe-title">%2$s</%1$s>',
							cx_escape_tags( $settings['title_tag'], 'h2' ),
							cx_kses_intermediate($settings['hover_title'])
						);
						?>
						<?php if ($settings['hover_effect'] != 'cx-effect-honey') : ?>
							<p class="cx-ihe-desc"><?php echo cx_kses_intermediate($settings['hover_description']); ?></p>
						<?php endif; ?>
						<?php if ($settings['hover_effect'] == 'cx-effect-lily') : ?>
						</div>
					<?php endif; ?>
					<?php if ($settings['hover_link']['url'] != '') : ?>
						<a href="<?php echo esc_url($settings['hover_link']['url']); ?>" <?php echo esc_attr($url_target . $url_nofollow); ?>></a>
					<?php endif; ?>
				</figcaption>
			</figure>
		</div>
<?php
	}
}
