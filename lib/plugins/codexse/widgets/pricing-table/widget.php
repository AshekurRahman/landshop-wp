<?php
/**
 * Pricing table widget class
 *
 * @package Codexse_Addons
 */
namespace Codexse_Addons\Elementor\Widget;

use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || die();

class Pricing_Table extends Base {

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Pricing Table', 'codexse-elementor-addons' );
	}

	public function get_custom_help_url() {
		return 'https://codexseaddons.com/docs/codexse-addons-for-elementor/widgets/pricing-table/';
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
		return 'cx cx-file-cabinet';
	}

	public function get_keywords() {
		return [ 'pricing', 'price', 'table', 'package', 'product', 'plan' ];
	}

	/**
	 * Register widget content controls
	 */
	protected function register_content_controls() {
		$this->__header_content_controls();
		$this->__price_content_controls();
		$this->__features_content_controls();
		$this->__footer_content_controls();
		$this->__badge_content_controls();
	}

	protected function __header_content_controls() {

		$this->start_controls_section(
			'_section_header',
			[
				'label' => __( 'Header', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => __( 'Title', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Basic', 'codexse-elementor-addons' ),
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => __( 'Title HTML Tag', 'codexse-elementor-addons' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'h1' => [
						'title' => __( 'H1', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-editor-h1',
					],
					'h2' => [
						'title' => __( 'H2', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-editor-h2',
					],
					'h3' => [
						'title' => __( 'H3', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-editor-h3',
					],
					'h4' => [
						'title' => __( 'H4', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-editor-h4',
					],
					'h5' => [
						'title' => __( 'H5', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-editor-h5',
					],
					'h6' => [
						'title' => __( 'H6', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-editor-h6',
					],
				],
				'default' => 'h2',
				'toggle'  => false,
			]
		);

		$this->end_controls_section();
	}

	protected function __price_content_controls() {

		$this->start_controls_section(
			'_section_pricing',
			[
				'label' => __( 'Pricing', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'currency',
			[
				'label'       => __( 'Currency', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => false,
				'options'     => [
					''             => __( 'None', 'codexse-elementor-addons' ),
					'baht'         => '&#3647; ' . _x( 'Baht', 'Currency Symbol', 'codexse-elementor-addons' ),
					'bdt'          => '&#2547; ' . _x( 'BD Taka', 'Currency Symbol', 'codexse-elementor-addons' ),
					'dollar'       => '&#36; ' . _x( 'Dollar', 'Currency Symbol', 'codexse-elementor-addons' ),
					'euro'         => '&#128; ' . _x( 'Euro', 'Currency Symbol', 'codexse-elementor-addons' ),
					'franc'        => '&#8355; ' . _x( 'Franc', 'Currency Symbol', 'codexse-elementor-addons' ),
					'guilder'      => '&fnof; ' . _x( 'Guilder', 'Currency Symbol', 'codexse-elementor-addons' ),
					'krona'        => 'kr ' . _x( 'Krona', 'Currency Symbol', 'codexse-elementor-addons' ),
					'lira'         => '&#8356; ' . _x( 'Lira', 'Currency Symbol', 'codexse-elementor-addons' ),
					'peseta'       => '&#8359 ' . _x( 'Peseta', 'Currency Symbol', 'codexse-elementor-addons' ),
					'peso'         => '&#8369; ' . _x( 'Peso', 'Currency Symbol', 'codexse-elementor-addons' ),
					'pound'        => '&#163; ' . _x( 'Pound Sterling', 'Currency Symbol', 'codexse-elementor-addons' ),
					'real'         => 'R$ ' . _x( 'Real', 'Currency Symbol', 'codexse-elementor-addons' ),
					'ruble'        => '&#8381; ' . _x( 'Ruble', 'Currency Symbol', 'codexse-elementor-addons' ),
					'rupee'        => '&#8360; ' . _x( 'Rupee', 'Currency Symbol', 'codexse-elementor-addons' ),
					'indian_rupee' => '&#8377; ' . _x( 'Rupee (Indian)', 'Currency Symbol', 'codexse-elementor-addons' ),
					'shekel'       => '&#8362; ' . _x( 'Shekel', 'Currency Symbol', 'codexse-elementor-addons' ),
					'won'          => '&#8361; ' . _x( 'Won', 'Currency Symbol', 'codexse-elementor-addons' ),
					'yen'          => '&#165; ' . _x( 'Yen/Yuan', 'Currency Symbol', 'codexse-elementor-addons' ),
					'custom'       => __( 'Custom', 'codexse-elementor-addons' ),
				],
				'default'     => 'dollar',
			]
		);

		$this->add_control(
			'currency_custom',
			[
				'label'     => __( 'Custom Symbol', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::TEXT,
				'condition' => [
					'currency' => 'custom',
				],
				'dynamic'   => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'price',
			[
				'label'   => __( 'Price', 'codexse-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '9.99',
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'period',
			[
				'label'   => __( 'Period', 'codexse-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Per Month', 'codexse-elementor-addons' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->end_controls_section();
	}

	protected function __features_content_controls() {

		$this->start_controls_section(
			'_section_features',
			[
				'label' => __( 'Features', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'features_title',
			[
				'label'       => __( 'Title', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Features', 'codexse-elementor-addons' ),
				'separator'   => 'after',
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'features_title_tag',
			[
				'label'   => __( 'Title HTML Tag', 'codexse-elementor-addons' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'h1' => [
						'title' => __( 'H1', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-editor-h1',
					],
					'h2' => [
						'title' => __( 'H2', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-editor-h2',
					],
					'h3' => [
						'title' => __( 'H3', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-editor-h3',
					],
					'h4' => [
						'title' => __( 'H4', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-editor-h4',
					],
					'h5' => [
						'title' => __( 'H5', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-editor-h5',
					],
					'h6' => [
						'title' => __( 'H6', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-editor-h6',
					],
				],
				'default' => 'h4',
				'toggle'  => false,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'text',
			[
				'label'   => __( 'Text', 'codexse-elementor-addons' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Exciting Feature', 'codexse-elementor-addons' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'selected_icon',
			[
				'label'            => __( 'Icon', 'codexse-elementor-addons' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'fas fa-check',
					'library' => 'fa-solid',
				],
				'recommended'      => [
					'fa-regular' => [
						'check-square',
						'window-close',
					],
					'fa-solid'   => [
						'check',
					],
				],
			]
		);

		$this->add_control(
			'features_list',
			[
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'show_label'  => false,
				'default'     => [
					[
						'text' => __( 'Standard Feature', 'codexse-elementor-addons' ),
						'icon' => 'fa fa-check',
					],
					[
						'text' => __( 'Another Great Feature', 'codexse-elementor-addons' ),
						'icon' => 'fa fa-check',
					],
					[
						'text' => __( 'Obsolete Feature', 'codexse-elementor-addons' ),
						'icon' => 'fa fa-close',
					],
					[
						'text' => __( 'Exciting Feature', 'codexse-elementor-addons' ),
						'icon' => 'fa fa-check',
					],
				],
				'title_field' => '<# print(haGetFeatureLabel(text)); #>',
			]
		);

		$this->end_controls_section();
	}

	protected function __footer_content_controls() {

		$this->start_controls_section(
			'_section_footer',
			[
				'label' => __( 'Footer', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'       => __( 'Button Text', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Subscribe', 'codexse-elementor-addons' ),
				'placeholder' => __( 'Type button text here', 'codexse-elementor-addons' ),
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'button_link',
			[
				'label'       => __( 'Link', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'placeholder' => 'https://example.com',
				'dynamic'     => [
					'active' => true,
				],
				'default'     => [
					'url' => '#',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function __badge_content_controls() {

		$this->start_controls_section(
			'_section_badge',
			[
				'label' => __( 'Badge', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'show_badge',
			[
				'label'          => __( 'Show', 'codexse-elementor-addons' ),
				'type'           => Controls_Manager::SWITCHER,
				'label_on'       => __( 'Show', 'codexse-elementor-addons' ),
				'label_off'      => __( 'Hide', 'codexse-elementor-addons' ),
				'return_value'   => 'yes',
				'default'        => 'yes',
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'badge_position',
			[
				'label'          => __( 'Position', 'codexse-elementor-addons' ),
				'type'           => Controls_Manager::CHOOSE,
				'label_block'    => false,
				'options'        => [
					'left'  => [
						'title' => __( 'Left', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'toggle'         => false,
				'default'        => 'left',
				'style_transfer' => true,
				'condition'      => [
					'show_badge' => 'yes',
				],
			]
		);

		$this->add_control(
			'badge_text',
			[
				'label'       => __( 'Badge Text', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Recommended', 'codexse-elementor-addons' ),
				'placeholder' => __( 'Type badge text', 'codexse-elementor-addons' ),
				'condition'   => [
					'show_badge' => 'yes',
				],
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register widget style controls
	 */
	protected function register_style_controls() {
		$this->__general_style_controls();
		$this->__header_style_controls();
		$this->__price_style_controls();
		$this->__feature_style_controls();
		$this->__footer_style_controls();
		$this->__badge_style_controls();
	}

	protected function __general_style_controls() {

		$this->start_controls_section(
			'_section_style_general',
			[
				'label' => __( 'General', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => __( 'Text Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-pricing-table-title,'
					. '{{WRAPPER}} .cx-pricing-table-currency,'
					. '{{WRAPPER}} .cx-pricing-table-period,'
					. '{{WRAPPER}} .cx-pricing-table-features-title,'
					. '{{WRAPPER}} .cx-pricing-table-features-list li,'
					. '{{WRAPPER}} .cx-pricing-table-price-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function __header_style_controls() {

		$this->start_controls_section(
			'_section_style_header',
			[
				'label' => __( 'Header', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label'      => __( 'Bottom Spacing', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .cx-pricing-table-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-pricing-table-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .cx-pricing-table-title',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .cx-pricing-table-title',
			]
		);

		$this->end_controls_section();
	}

	protected function __price_style_controls() {

		$this->start_controls_section(
			'_section_style_pricing',
			[
				'label' => __( 'Pricing', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'_heading_price',
			[
				'type'  => Controls_Manager::HEADING,
				'label' => __( 'Price', 'codexse-elementor-addons' ),
			]
		);

		$this->add_responsive_control(
			'price_spacing',
			[
				'label'      => __( 'Bottom Spacing', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .cx-pricing-table-price-tag' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'price_color',
			[
				'label'     => __( 'Text Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-pricing-table-price-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'price_typography',
				'selector' => '{{WRAPPER}} .cx-pricing-table-price-text',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_control(
			'_heading_currency',
			[
				'type'      => Controls_Manager::HEADING,
				'label'     => __( 'Currency', 'codexse-elementor-addons' ),
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'currency_spacing',
			[
				'label'      => __( 'Side Spacing', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .cx-pricing-table-currency' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'currency_color',
			[
				'label'     => __( 'Text Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-pricing-table-currency' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'currency_typography',
				'selector' => '{{WRAPPER}} .cx-pricing-table-currency',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_control(
			'_heading_period',
			[
				'type'      => Controls_Manager::HEADING,
				'label'     => __( 'Period', 'codexse-elementor-addons' ),
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'period_spacing',
			[
				'label'      => __( 'Bottom Spacing', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .cx-pricing-table-price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'period_color',
			[
				'label'     => __( 'Text Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-pricing-table-period' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'period_typography',
				'selector' => '{{WRAPPER}} .cx-pricing-table-period',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->end_controls_section();
	}

	protected function __feature_style_controls() {

		$this->start_controls_section(
			'_section_style_features',
			[
				'label' => __( 'Features', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'features_container_spacing',
			[
				'label'      => __( 'Container Bottom Spacing', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .cx-pricing-table-body' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'_heading_features_title',
			[
				'type'      => Controls_Manager::HEADING,
				'label'     => __( 'Title', 'codexse-elementor-addons' ),
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'features_title_spacing',
			[
				'label'      => __( 'Bottom Spacing', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .cx-pricing-table-features-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'features_title_color',
			[
				'label'     => __( 'Text Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-pricing-table-features-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'features_title_typography',
				'selector' => '{{WRAPPER}} .cx-pricing-table-features-title',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
			]
		);

		$this->add_control(
			'_heading_features_list',
			[
				'type'      => Controls_Manager::HEADING,
				'label'     => __( 'List', 'codexse-elementor-addons' ),
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'features_list_spacing',
			[
				'label'      => __( 'Spacing Between', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .cx-pricing-table-features-list > li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'features_list_color',
			[
				'label'     => __( 'Text Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-pricing-table-features-list > li' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'features_list_typography',
				'selector' => '{{WRAPPER}} .cx-pricing-table-features-list > li',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->end_controls_section();
	}

	protected function __footer_style_controls() {

		$this->start_controls_section(
			'_section_style_footer',
			[
				'label' => __( 'Footer', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'_heading_button',
			[
				'type'  => Controls_Manager::HEADING,
				'label' => __( 'Button', 'codexse-elementor-addons' ),
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => __( 'Padding', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cx-pricing-table-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'button_border',
				'selector' => '{{WRAPPER}} .cx-pricing-table-btn',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'      => __( 'Border Radius', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cx-pricing-table-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .cx-pricing-table-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .cx-pricing-table-btn',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
			]
		);

		$this->add_control(
			'hr',
			[
				'type'  => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->start_controls_tabs( '_tabs_button' );

		$this->start_controls_tab(
			'_tab_button_normal',
			[
				'label' => __( 'Normal', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'button_color',
			[
				'label'     => __( 'Text Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-pricing-table-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label'     => __( 'Background Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-pricing-table-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tab_button_hover',
			[
				'label' => __( 'Hover', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label'     => __( 'Text Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-pricing-table-btn:hover, {{WRAPPER}} .cx-pricing-table-btn:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_bg_color',
			[
				'label'     => __( 'Background Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-pricing-table-btn:hover, {{WRAPPER}} .cx-pricing-table-btn:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'     => __( 'Border Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'button_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .cx-pricing-table-btn:hover, {{WRAPPER}} .cx-pricing-table-btn:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function __badge_style_controls() {

		$this->start_controls_section(
			'_section_style_badge',
			[
				'label' => __( 'Badge', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'badge_padding',
			[
				'label'      => __( 'Padding', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cx-pricing-table-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'badge_color',
			[
				'label'     => __( 'Text Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-pricing-table-badge' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'badge_bg_color',
			[
				'label'     => __( 'Background Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-pricing-table-badge' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'badge_border',
				'selector' => '{{WRAPPER}} .cx-pricing-table-badge',
			]
		);

		$this->add_responsive_control(
			'badge_border_radius',
			[
				'label'      => __( 'Border Radius', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cx-pricing-table-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'badge_box_shadow',
				'selector' => '{{WRAPPER}} .cx-pricing-table-badge',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'badge_typography',
				'label'    => __( 'Typography', 'codexse-elementor-addons' ),
				'selector' => '{{WRAPPER}} .cx-pricing-table-badge',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->end_controls_section();
	}

	private static function get_currency_symbol( $symbol_name ) {
		$symbols = [
			'baht'         => '&#3647;',
			'bdt'          => '&#2547;',
			'dollar'       => '&#36;',
			'euro'         => '&#128;',
			'franc'        => '&#8355;',
			'guilder'      => '&fnof;',
			'indian_rupee' => '&#8377;',
			'pound'        => '&#163;',
			'peso'         => '&#8369;',
			'peseta'       => '&#8359',
			'lira'         => '&#8356;',
			'ruble'        => '&#8381;',
			'shekel'       => '&#8362;',
			'rupee'        => '&#8360;',
			'real'         => 'R$',
			'krona'        => 'kr',
			'won'          => '&#8361;',
			'yen'          => '&#165;',
		];

		return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ] : '';
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'badge_text', 'class',
			[
				'cx-pricing-table-badge',
				'cx-pricing-table-badge--' . $settings['badge_position'],
			]
		);

		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_render_attribute( 'title', 'class', 'cx-pricing-table-title' );

		$this->add_inline_editing_attributes( 'price', 'basic' );
		$this->add_render_attribute( 'price', 'class', 'cx-pricing-table-price-text' );

		$this->add_inline_editing_attributes( 'period', 'basic' );
		$this->add_render_attribute( 'period', 'class', 'cx-pricing-table-period' );

		$this->add_inline_editing_attributes( 'features_title', 'basic' );
		$this->add_render_attribute( 'features_title', 'class', 'cx-pricing-table-features-title' );

		$this->add_inline_editing_attributes( 'button_text', 'none' );
		$this->add_render_attribute( 'button_text', 'class', 'cx-pricing-table-btn' );

		$this->add_link_attributes( 'button_text', $settings['button_link'] );

		if ( $settings['currency'] === 'custom' ) {
			$currency = $settings['currency_custom'];
		} else {
			$currency = self::get_currency_symbol( $settings['currency'] );
		}
		?>

		<?php if ( $settings['show_badge'] ) : ?>
			<span <?php $this->print_render_attribute_string( 'badge_text' ); ?>><?php echo esc_html( $settings['badge_text'] ); ?></span>
		<?php endif; ?>

		<div class="cx-pricing-table-header">
			<?php if ( $settings['title'] ) : ?>
				<?php
					printf(
						'<%1$s %2$s>%3$s</%1$s>',
						cx_escape_tags( $settings['title_tag'] ),
						$this->get_render_attribute_string( 'title' ),
						cx_kses_basic( $settings['title'] )
					);
				?>
			<?php endif; ?>
		</div>
		<div class="cx-pricing-table-price">
			<div class="cx-pricing-table-price-tag"><span class="cx-pricing-table-currency"><?php echo esc_html( $currency ); ?></span> <span <?php $this->print_render_attribute_string( 'price' ); ?>><?php echo cx_kses_basic( $settings['price'] ); ?></span></div>
			<?php if ( $settings['period'] ) : ?>
				<div <?php $this->print_render_attribute_string( 'period' ); ?>><?php echo cx_kses_basic( $settings['period'] ); ?></div>
			<?php endif; ?>
		</div>
		<div class="cx-pricing-table-body">
			<?php if ( $settings['features_title'] ) : ?>
				<?php
					printf(
						'<%1$s %2$s>%3$s</%1$s>',
						cx_escape_tags( $settings['features_title_tag'] ),
						$this->get_render_attribute_string( 'features_title' ),
						cx_kses_basic( $settings['features_title'] )
					);
				?>
			<?php endif; ?>

			<?php if ( is_array( $settings['features_list'] ) ) : ?>
				<ul class="cx-pricing-table-features-list">
					<?php foreach ( $settings['features_list'] as $index => $feature ) :
						$name_key = $this->get_repeater_setting_key( 'text', 'features_list', $index );
						// $this->add_inline_editing_attributes( $name_key, 'intermediate' );
						$this->add_render_attribute( $name_key, 'class', 'cx-pricing-table-feature-text' );
						?>
						<li class="<?php echo esc_attr( 'elementor-repeater-item-' . $feature['_id'] ); ?>">
							<?php if ( ! empty( $feature['icon'] ) || ! empty( $feature['selected_icon']['value'] ) ) :
								cx_render_icon( $feature, 'icon', 'selected_icon' );
							endif; ?>
							<div <?php $this->print_render_attribute_string( $name_key ); ?>><?php echo cx_kses_intermediate( $feature['text'] ); ?></div>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>

		<?php if ( $settings['button_text'] ) : ?>
			<a <?php $this->print_render_attribute_string( 'button_text' ); ?>><?php echo esc_html( $settings['button_text'] ); ?></a>
		<?php endif; ?>

		<?php
	}
}
