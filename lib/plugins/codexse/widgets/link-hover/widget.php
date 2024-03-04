<?php
/**
 * Link Hover widget class
 *
 * @package Codexse_Addons
 */

namespace Codexse_Addons\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Codexse_Addons\Elementor\Traits\Link_Hover_Markup;

class Link_Hover extends Base {
	use Link_Hover_Markup;

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Animated Link', 'codexse-elementor-addons' );
	}

	public function get_custom_help_url() {
		return 'https://codexseaddons.com/docs/codexse-addons-for-elementor/widgets/link-hover/';
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
		return 'hm hm-animated-link';
	}

	public function get_keywords() {
		return array('link', 'hover', 'animation');
	}

	/**
     * Register widget content controls
     */
	protected function register_content_controls() {

		$this->start_controls_section(
			'_section_title',
			array(
				'label' => __( 'Link Content', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'animation_style',
			array(
				'label'   => __( 'Animation Style', 'codexse-elementor-addons' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'carpo',
				'options' => array(
					'carpo'   => __( 'Carpo', 'codexse-elementor-addons' ),
					'carme'   => __( 'Carme', 'codexse-elementor-addons' ),
					'dia'     => __( 'Dia', 'codexse-elementor-addons' ),
					'eirene'  => __( 'Eirene', 'codexse-elementor-addons' ),
					'elara'   => __( 'Elara', 'codexse-elementor-addons' ),
					'ersa'    => __( 'Ersa', 'codexse-elementor-addons' ),
					'helike'  => __( 'Helike', 'codexse-elementor-addons' ),
					'herse'   => __( 'Herse', 'codexse-elementor-addons' ),
					'io'      => __( 'Io', 'codexse-elementor-addons' ),
					'iocaste' => __( 'Iocaste', 'codexse-elementor-addons' ),
					'kale'    => __( 'Kale', 'codexse-elementor-addons' ),
					'leda'    => __( 'Leda', 'codexse-elementor-addons' ),
					'metis'   => __( 'Metis', 'codexse-elementor-addons' ),
					'mneme'   => __( 'Mneme', 'codexse-elementor-addons' ),
					'thebe'   => __( 'Thebe', 'codexse-elementor-addons' ),
				),
			)
		);

		$this->add_control(
			'link_text',
			array(
				'label'       => __( 'Title', 'codexse-elementor-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Animated Link', 'codexse-elementor-addons' ),
				'placeholder' => __( 'Type Link Title', 'codexse-elementor-addons' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_responsive_control(
            'link_align',
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
                    ]
                ],
                'default' => 'left',
                'toggle' => true,
                // 'prefix_class' => 'cx-align-',
                'selectors_dictionary' => [
                    'left' => 'justify-content: flex-start',
                    'center' => 'justify-content: center',
                    'right' => 'justify-content: flex-end',
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx_content__item' => '{{VALUE}}'
                ]
            ]
        );

		$this->add_control(
			'link_url',
			array(
				'label'         => __( 'Link', 'codexse-elementor-addons' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'codexse-elementor-addons' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '',
					'is_external' => false,
					'nofollow'    => true,
				),
			)
		);

		$this->end_controls_section();
	}

	/**
     * Register widget style controls
     */
	protected function register_style_controls() {

		$this->start_controls_section(
			'_section_media_style',
			array(
				'label' => __( 'Link Content', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'content_padding',
			array(
				'label'      => __( 'Content Box Padding', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .cx_content__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Link Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cx-link' => 'color: {{VALUE}};',
				),
			)
		);

        $this->add_control(
			'title_hover_color',
			array(
				'label'     => __( 'Link Hover Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cx-link:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'codexse-elementor-addons' ),
				'selector' => '{{WRAPPER}} .cx-link',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		self::{'render_' . $settings['animation_style'] . '_markup'}( $settings );
	}
}
