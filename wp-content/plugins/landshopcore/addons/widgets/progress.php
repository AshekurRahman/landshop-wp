<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor progress widget.
 *
 * Elementor widget that displays an escalating progress bar.
 *
 * @since 1.0.0
 */
class landshop_Progress_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve progress widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'progress';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve progress widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Progress Bar', 'landshopcore' );
	}

    
	public function get_categories() {
		return [ 'landshopcore' ];
	}
    
	/**
	 * Get widget icon.
	 *
	 * Retrieve progress widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'landshop-icon eicon-skill-bar';
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'progress', 'bar', 'skill' ];
	}

	/**
	 * Retrieve the list of scripts the counter widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'jquery-numerator' ];
	}

	/**
	 * Register progress widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_progress',
			[
				'label' => __( 'Progress Bar', 'landshopcore' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'landshopcore' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your title', 'landshopcore' ),
				'default' => __( 'My Skill', 'landshopcore' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'progress_type',
			[
				'label' => __( 'Type', 'landshopcore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'Default', 'landshopcore' ),
					'info' => __( 'Info', 'landshopcore' ),
					'success' => __( 'Success', 'landshopcore' ),
					'warning' => __( 'Warning', 'landshopcore' ),
					'danger' => __( 'Danger', 'landshopcore' ),
				],
			]
		);

		$this->add_control(
			'percent',
			[
				'label' => __( 'Percentage', 'landshopcore' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 50,
					'unit' => '%',
				],
				'label_block' => true,
			]
		);

		$this->add_control( 'display_percentage', [
			'label' => __( 'Display Percentage', 'landshopcore' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'show',
			'options' => [
				'show' => __( 'Show', 'landshopcore' ),
				'hide' => __( 'Hide', 'landshopcore' ),
			],
		] );

		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'landshopcore' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_progress_style',
			[
				'label' => __( 'Progress Bar', 'landshopcore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'bar_color',
                'label' => __( 'Bar Color', 'landshopcore' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .landshop-progress-wrapper .elementor-progress-bar',
            ]
        );

		$this->add_control(
			'bar_bg_color',
			[
                'label' => __( 'Bar Background', 'landshopcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .landshop-progress-wrapper' => 'background-color: {{VALUE}};',
				]
			]
		);

          $this->add_responsive_control(
            'progress_bar_height',
            [
                'label' => __( 'Bar Height', 'landshopcore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 8,
                ],
                'selectors' => [
                    '{{WRAPPER}} .landshop-progress-wrapper,{{WRAPPER}} .elementor-progress-bar' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'progress_bar_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'landshopcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .landshop-progress-wrapper' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    '{{WRAPPER}} .landshop-progress-wrapper .elementor-progress-bar' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Title', 'landshopcore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'landshopcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .landshop-progress-title' => 'color: {{VALUE}};',
				],
                'default' => '#6E6E78'
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .landshop-progress-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_percentage',
			[
				'label' => __( 'Percentage', 'landshopcore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'percentage_color',
			[
				'label' => __( 'Color', 'landshopcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .landshop-progress-percentage' => 'color: {{VALUE}};',
				],
                'default' => '#6E6E78'
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'percentage_typography',
				'selector' => '{{WRAPPER}} .landshop-progress-percentage',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render progress widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', [
			'class' => 'landshop-progress-wrapper',
			'role' => 'progressbar',
			'aria-valuemin' => '0',
			'aria-valuemax' => '100',
			'aria-valuenow' => $settings['percent']['size']
		] );

		if ( ! empty( $settings['progress_type'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'progress-' . $settings['progress_type'] );
		}
		$this->add_render_attribute( 'progress-bar', [
			'class' => 'elementor-progress-bar',
			'data-max' => $settings['percent']['size'],
		] );
        echo '<div class="progress-header" >';        
            if ( ! empty( $settings['title'] ) ) {
                echo '<span class="landshop-progress-title">'.esc_html($settings['title']).'</span>';
            }
            if ( 'hide' !== $settings['display_percentage'] ) {
                echo '<span class="landshop-progress-percentage"><span class="elementor-counter-number" data-duration="2000" data-to-value="'.$settings['percent']['size'].'" >'.$settings['percent']['size'].'</span>%</span>';
            }
        echo '</div>';
        echo '<div '.$this->get_render_attribute_string( 'wrapper' ).'>';
            echo '<div '.$this->get_render_attribute_string( 'progress-bar' ).'>';
            echo '</div>';
        echo '</div>';
        
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new landshop_Progress_Widget );