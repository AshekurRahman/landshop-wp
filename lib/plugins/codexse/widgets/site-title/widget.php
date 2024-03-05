<?php
/**
 * Site Title widget class
 *
 * @package Codexse_Addons
 */
namespace Codexse_Addons\Elementor\Widget;

use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;

defined( 'ABSPATH' ) || die();

class Site_Title extends Base {

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Site Title', 'codexse-elementor-addons' );
	}

	public function get_custom_help_url() {
		return 'https://codexseaddons.com/docs/codexse-addons-for-elementor/widgets/site-title/';
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
		return 'cx cx-tb-site-title';
	}

	public function get_keywords() {
		return [ 'site title', 'Title', 'text' ];
	}

	/**
     * Register widget content controls
     */
	protected function register_content_controls() {
		$this->__site_title_content_control();
	}

	protected function __site_title_content_control(){
		$this->start_controls_section(
			'_section_site_title',
			[
				'label' => __( 'Site Title', 'codexse-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'site_title_tag',
			[
				'label' => __( 'Title HTML Tag', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'h1'  => [
						'title' => __( 'H1', 'codexse-elementor-addons' ),
						'icon' => 'eicon-editor-h1'
					],
					'h2'  => [
						'title' => __( 'H2', 'codexse-elementor-addons' ),
						'icon' => 'eicon-editor-h2'
					],
					'h3'  => [
						'title' => __( 'H3', 'codexse-elementor-addons' ),
						'icon' => 'eicon-editor-h3'
					],
					'h4'  => [
						'title' => __( 'H4', 'codexse-elementor-addons' ),
						'icon' => 'eicon-editor-h4'
					],
					'h5'  => [
						'title' => __( 'H5', 'codexse-elementor-addons' ),
						'icon' => 'eicon-editor-h5'
					],
					'h6'  => [
						'title' => __( 'H6', 'codexse-elementor-addons' ),
						'icon' => 'eicon-editor-h6'
					]
				],
				'default' => 'h2',
				'toggle' => false,
			]
		);
        $this->add_control(
			'size',
			[
				'label' => esc_html__( 'Size', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'codexse-elementor-addons' ),
					'small' => esc_html__( 'Small', 'codexse-elementor-addons' ),
					'medium' => esc_html__( 'Medium', 'codexse-elementor-addons' ),
					'large' => esc_html__( 'Large', 'codexse-elementor-addons' ),
					'xl' => esc_html__( 'XL', 'codexse-elementor-addons' ),
					'xxl' => esc_html__( 'XXL', 'codexse-elementor-addons' ),
				],
				'default' => 'default',
			]
		);

        $this->add_responsive_control(
			'align',
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

        $this->end_controls_section();
	}

	/**
	 * Register styles related controls
	 */
	protected function register_style_controls() {
		$this->__page_title_style_controls();
	}


	protected function __page_title_style_controls() {

        $this->start_controls_section(
            '_section_style_site_title',
            [
                'label' => __( 'Site Title', 'codexse-elementor-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'st_color',
			[
				'label' => esc_html__( 'Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-site-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'site_title_typography',
				'label' => __( 'Typography', 'codexse-elementor-addons' ),
				'selector' => '{{WRAPPER}} .cx-site-title',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'site_text_shadow',
				'selector' => '{{WRAPPER}} .cx-site-title',
			]
		);


        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute('title', 'class', 'cx-site-title');

        if ( ! empty( $settings['size'] ) ) {
            $this->add_render_attribute('title', 'class', 'cx-site-title-' . $settings['size']);
        }

		echo '<a href="' . esc_url(home_url('/')) . '">';
        printf('<%1$s %2$s>%3$s</%1$s>', $settings['site_title_tag'], $this->get_render_attribute_string('title'), get_bloginfo('name') );
		echo '</a>';
	}
}
