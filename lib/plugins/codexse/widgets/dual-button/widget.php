<?php
/**
 * Dual Button widget class
 *
 * @package Codexse_Addons
 */
namespace Codexse_Addons\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

defined( 'ABSPATH' ) || die();

class Dual_Button extends Base {

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Dual Button', 'codexse-elementor-addons' );
    }

	public function get_custom_help_url() {
		return 'https://codexseaddons.com/docs/codexse-addons-for-elementor/widgets/dual-button/';
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
        return 'cx cx-accordion-horizontal';
    }

    public function get_keywords() {
        return [ 'button', 'btn', 'dual', 'advance', 'link' ];
    }

	/**
     * Register widget content controls
     */
    protected function register_content_controls() {

        $this->start_controls_section(
            '_section_button',
            [
                'label' => __( 'Dual Buttons', 'codexse-elementor-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->start_controls_tabs( '_tabs_buttons' );

        $this->start_controls_tab(
            '_tab_button_primary',
            [
                'label' => __( 'Primary', 'codexse-elementor-addons' ),
            ]
        );

        $this->add_control(
            'left_button_text',
            [
                'label' => __( 'Text', 'codexse-elementor-addons' ),
                'label_block'=> true,
                'type' => Controls_Manager::TEXT,
                'default' => 'Button Text',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'left_button_link',
            [
                'label' => __( 'Link', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'https://example.com',
                'dynamic' => [
                    'active' => true,
				],
				'default' => [
					'url' => '#',
				],
            ]
        );

        if ( cx_is_elementor_version( '<', '2.6.0' ) ) {
            $this->add_control(
                'left_button_icon',
                [
                    'label' => __( 'Icon', 'codexse-elementor-addons' ),
                    'type' => Controls_Manager::ICON,
                    'options' => cx_get_codexse_icons(),
                ]
            );

            $condition = ['left_button_icon!' => ''];
        } else {
            $this->add_control(
                'left_button_selected_icon',
                [
                    'label' => __( 'Icon', 'codexse-elementor-addons' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'left_button_icon',
                ]
            );
            $condition = ['left_button_selected_icon[value]!' => ''];
        }

        $this->add_control(
            'left_button_icon_position',
            [
                'label' => __( 'Icon Position', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'before' => [
                        'title' => __( 'Before', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => __( 'After', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'toggle' => false,
                'default' => 'before',
                'condition' => $condition,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'left_button_icon_spacing',
            [
                'label' => __( 'Icon Spacing', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'condition' => $condition,
                'selectors' => [
                    '{{WRAPPER}} .cx-dual-btn--left .cx-dual-btn-icon--before' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .cx-dual-btn--left .cx-dual-btn-icon--after' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_connector',
            [
                'label' => __( 'Connector', 'codexse-elementor-addons' ),
            ]
        );

        $this->add_control(
            'button_connector_hide',
            [
                'label' => __( 'Hide Connector?', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Hide', 'codexse-elementor-addons' ),
                'label_off' => __( 'Show', 'codexse-elementor-addons' ),
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'button_connector_type',
            [
                'label' => __( 'Connector Type', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'text' => [
                        'title' => __( 'Text', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-t-letter-bold',
                    ],
                    'icon' => [
                        'title' => __( 'Icon', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-star',
                    ]
                ],
                'toggle' => false,
                'default' => 'text',
                'condition' => [
                    'button_connector_hide!' => 'yes',
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'button_connector_text',
            [
                'label' => __( 'Text', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Or', 'codexse-elementor-addons' ),
                'condition' => [
                    'button_connector_hide!' => 'yes',
                    'button_connector_type' => 'text',
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        if ( cx_is_elementor_version( '<', '2.6.0' ) ) {
            $this->add_control(
                'button_connector_icon',
                [
                    'label' => __( 'Icon', 'codexse-elementor-addons' ),
                    'type' => Controls_Manager::ICON,
                    'options' => cx_get_codexse_icons(),
                    'condition' => [
                        'button_connector_hide!' => 'yes',
                        'button_connector_type' => 'icon',
                    ]
                ]
            );
        } else {
            $this->add_control(
                'button_connector_selected_icon',
                [
                    'label' => __( 'Icon', 'codexse-elementor-addons' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'button_connector_icon',
                    'default' => [
                        'library' => 'codexse-icons',
                        'value' => 'cx cx-codexseaddons',
                    ],
                    'condition' => [
                        'button_connector_hide!' => 'yes',
                        'button_connector_type' => 'icon',
                    ]
                ]
            );
        }

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_secondary',
            [
                'label' => __( 'Secondary', 'codexse-elementor-addons' ),
            ]
        );

        $this->add_control(
            'right_button_text',
            [
                'label' => __( 'Text', 'codexse-elementor-addons' ),
                'label_block'=> true,
                'type' => Controls_Manager::TEXT,
                'default' => 'Button Text',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'right_button_link',
            [
                'label' => __( 'Link', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'https://example.com',
                'dynamic' => [
                    'active' => true,
				],
				'default' => [
					'url' => '#',
				],
            ]
        );

        if ( cx_is_elementor_version( '<', '2.6.0' ) ) {
            $this->add_control(
                'right_button_icon',
                [
                    'label' => __( 'Icon', 'codexse-elementor-addons' ),
                    'type' => Controls_Manager::ICON,
                    'options' => cx_get_codexse_icons(),
                ]
            );

            $condition = ['right_button_icon!' => ''];
        } else {
            $this->add_control(
                'right_button_selected_icon',
                [
                    'label' => __( 'Icon', 'codexse-elementor-addons' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'right_button_icon',
                ]
            );

            $condition = ['right_button_selected_icon[value]!' => ''];
        }

        $this->add_control(
            'right_button_icon_position',
            [
                'label' => __( 'Icon Position', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'before' => [
                        'title' => __( 'Before', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => __( 'After', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'toggle' => false,
                'default' => 'after',
                'condition' => $condition,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'right_button_icon_spacing',
            [
                'label' => __( 'Icon Spacing', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'condition' => $condition,
                'selectors' => [
                    '{{WRAPPER}} .cx-dual-btn--right .cx-dual-btn-icon--before' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .cx-dual-btn--right .cx-dual-btn-icon--after' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'buttons_layout',
            [
                'label' => __( 'Layout', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'queue' => [
                        'title' => __( 'Queue', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-navigation-horizontal',
                    ],
                    'stack' => [
                        'title' => __( 'Stack', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-navigation-vertical',
                    ]
                ],
                'toggle' => false,
                'desktop_default' => 'queue',
                'tablet_default' => 'queue',
                'mobile_default' => 'queue',
                'separator' => 'before',
                'prefix_class' => 'cx-dual-button-%s-layout-',
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();
    }

	/**
     * Register widget style controls
     */
    protected function register_style_controls() {
		$this->__common_style_controls();
		$this->__primary_btn_style_controls();
		$this->__connector_style_controls();
		$this->__secondary_btn_style_controls();
	}

    protected function __common_style_controls() {

        $this->start_controls_section(
            '_section_style_common',
            [
                'label' => __( 'Common', 'codexse-elementor-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
		);

		$this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .cx-dual-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);

		$this->add_responsive_control(
            'button_gap',
            [
                'label' => __( 'Space Between Buttons', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '(desktop+){{WRAPPER}}.cx-dual-button--layout-queue .cx-dual-btn--left' => 'margin-right: calc({{button_gap.SIZE}}{{UNIT}}/2);',
                    '(desktop+){{WRAPPER}}.cx-dual-button--layout-stack .cx-dual-btn--left' => 'margin-bottom: calc({{button_gap.SIZE}}{{UNIT}}/2);',
                    '(desktop+){{WRAPPER}}.cx-dual-button--layout-queue .cx-dual-btn--right' => 'margin-left: calc({{button_gap.SIZE}}{{UNIT}}/2);',
                    '(desktop+){{WRAPPER}}.cx-dual-button--layout-stack .cx-dual-btn--right' => 'margin-top: calc({{button_gap.SIZE}}{{UNIT}}/2);',

                    '(tablet){{WRAPPER}}.cx-dual-button--tablet-layout-queue .cx-dual-btn--left' => 'margin-right: calc({{button_gap_tablet.SIZE || button_gap.SIZE}}{{UNIT}}/2); margin-bottom: 0;',
                    '(tablet){{WRAPPER}}.cx-dual-button--tablet-layout-stack .cx-dual-btn--left' => 'margin-bottom: calc({{button_gap_tablet.SIZE || button_gap.SIZE}}{{UNIT}}/2); margin-right: 0;',
                    '(tablet){{WRAPPER}}.cx-dual-button--tablet-layout-queue .cx-dual-btn--right' => 'margin-left: calc({{button_gap_tablet.SIZE || button_gap.SIZE}}{{UNIT}}/2); margin-top: 0;',
                    '(tablet){{WRAPPER}}.cx-dual-button--tablet-layout-stack .cx-dual-btn--right' => 'margin-top: calc({{button_gap_tablet.SIZE || button_gap.SIZE}}{{UNIT}}/2); margin-left: 0;',

                    '(mobile){{WRAPPER}}.cx-dual-button--mobile-layout-queue .cx-dual-btn--left' => 'margin-right: calc({{button_gap_mobile.SIZE || button_gap_tablet.SIZE || button_gap.SIZE}}{{UNIT}}/2); margin-bottom: 0;',
                    '(mobile){{WRAPPER}}.cx-dual-button--mobile-layout-stack .cx-dual-btn--left' => 'margin-bottom: calc({{button_gap_mobile.SIZE || button_gap_tablet.SIZE || button_gap.SIZE}}{{UNIT}}/2); margin-right: 0;',
                    '(mobile){{WRAPPER}}.cx-dual-button--mobile-layout-queue .cx-dual-btn--right' => 'margin-left: calc({{button_gap_mobile.SIZE || button_gap_tablet.SIZE || button_gap.SIZE}}{{UNIT}}/2); margin-top: 0;',
                    '(mobile){{WRAPPER}}.cx-dual-button--mobile-layout-stack .cx-dual-btn--right' => 'margin-top: calc({{button_gap_mobile.SIZE || button_gap_tablet.SIZE || button_gap.SIZE}}{{UNIT}}/2); margin-left: 0;',
                ],
            ]
		);

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __( 'Typography', 'codexse-elementor-addons' ),
                'selector' => '{{WRAPPER}} .cx-dual-btn',
                'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
            ]
		);

		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .cx-dual-btn'
            ]
		);

        $this->add_responsive_control(
            'button_align_x',
            [
                'label' => __( 'Alignment', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'toggle' => true,
                'prefix_class' => 'cx-dual-button-%s-align-'
            ]
        );

		$this->end_controls_section();
	}

    protected function __primary_btn_style_controls() {

		$this->start_controls_section(
			'_section_style_left_button',
            [
                'label' => __( 'Primary Button', 'codexse-elementor-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
		);

        $this->add_responsive_control(
            'left_button_padding',
            [
                'label' => __( 'Padding', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .cx-dual-btn--left' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'left_button_border',
                'selector' => '{{WRAPPER}} .cx-dual-btn--left'
            ]
		);

        $this->add_responsive_control(
            'left_button_border_radius',
            [
                'label' => __( 'Border Radius', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .cx-dual-btn--left' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'left_button_typography',
                'label' => __( 'Typography', 'codexse-elementor-addons' ),
                'selector' => '{{WRAPPER}} .cx-dual-btn--left',
                'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'left_button_box_shadow',
                'selector' => '{{WRAPPER}} .cx-dual-btn--left'
            ]
        );

		$this->start_controls_tabs( '_tabs_left_button' );

        $this->start_controls_tab(
            '_tab_left_button_normal',
            [
                'label' => __( 'Normal', 'codexse-elementor-addons' ),
            ]
		);

        $this->add_control(
            'left_button_text_color',
            [
                'label' => __( 'Text Color', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cx-dual-btn--left' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
            'left_button_bg_color',
            [
                'label' => __( 'Background Color', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cx-dual-btn--left' => 'background-color: {{VALUE}}',
                ],
            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab(
            '_tabs_left_button_hover',
            [
                'label' => __( 'Hover', 'codexse-elementor-addons' ),
            ]
		);

		$this->add_control(
            'left_button_hover_text_color',
            [
                'label' => __( 'Text Color', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cx-dual-btn--left:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'left_button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cx-dual-btn--left:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'left_button_hover_border_color',
            [
                'label' => __( 'Border Color', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cx-dual-btn--left:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'left_button_border_border!' => ''
                ]
            ]
        );

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

    protected function __connector_style_controls() {

		$this->start_controls_section(
			'_section_style_connector',
            [
                'label' => __( 'Connector', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
            ]
		);

        $this->add_control(
            'connector_notice',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __( 'Connector is hidden now, please enable connector from Content > Connector tab.', 'codexse-elementor-addons' ),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                'condition' => [
                    'button_connector_hide' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'connector_text_color',
            [
                'label' => __( 'Text Color', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cx-dual-btn-connector' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
            'connector_bg_color',
            [
                'label' => __( 'Background Color', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cx-dual-btn-connector' => 'background-color: {{VALUE}}',
                ],
            ]
        );

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'connector_typography',
                'label' => __( 'Typography', 'codexse-elementor-addons' ),
                'selector' => '{{WRAPPER}} .cx-dual-btn-connector',
                'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
            ]
		);

		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'connector_box_shadow',
                'selector' => '{{WRAPPER}} .cx-dual-btn-connector'
            ]
		);

		$this->end_controls_section();
	}

    protected function __secondary_btn_style_controls() {

        $this->start_controls_section(
            '_section_style_right_button',
            [
                'label' => __( 'Secondary Button', 'codexse-elementor-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'right_button_padding',
            [
                'label' => __( 'Padding', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .cx-dual-btn--right' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'right_button_border',
                'selector' => '{{WRAPPER}} .cx-dual-btn--right'
            ]
        );

        $this->add_responsive_control(
            'right_button_border_radius',
            [
                'label' => __( 'Border Radius', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .cx-dual-btn--right' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'right_button_typography',
                'label' => __( 'Typography', 'codexse-elementor-addons' ),
                'selector' => '{{WRAPPER}} .cx-dual-btn--right',
                'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'right_button_box_shadow',
                'selector' => '{{WRAPPER}} .cx-dual-btn--right'
            ]
        );

        $this->start_controls_tabs( '_tabs_right_button' );

        $this->start_controls_tab(
            '_tab_right_button_normal',
            [
                'label' => __( 'Normal', 'codexse-elementor-addons' ),
            ]
        );

        $this->add_control(
            'right_button_text_color',
            [
                'label' => __( 'Text Color', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cx-dual-btn--right' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'right_button_bg_color',
            [
                'label' => __( 'Background Color', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cx-dual-btn--right' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tabs_right_button_hover',
            [
                'label' => __( 'Hover', 'codexse-elementor-addons' ),
            ]
        );

        $this->add_control(
            'right_button_hover_text_color',
            [
                'label' => __( 'Text Color', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cx-dual-btn--right:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'right_button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cx-dual-btn--right:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'right_button_hover_border_color',
            [
                'label' => __( 'Border Color', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cx-dual-btn--right:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'right_button_border_border!' => ''
                ]
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Left button
        $this->add_render_attribute( 'left_button', 'class', 'cx-dual-btn cx-dual-btn--left' );
        $this->add_link_attributes( 'left_button', $settings['left_button_link'] );
        $this->add_inline_editing_attributes( 'left_button_text', 'none' );

        if ( ! empty( $settings['left_button_icon'] ) || ! empty( $settings['left_button_selected_icon'] ) ) {
            $this->add_render_attribute( 'left_button_icon', 'class', [
                'cx-dual-btn-icon',
                'cx-dual-btn-icon--' . esc_attr( $settings['left_button_icon_position'] )
            ] );
        }

        // Button connector
        $this->add_render_attribute( 'button_connector_text', 'class', 'cx-dual-btn-connector' );
        if ( $settings['button_connector_type'] === 'icon' && ( ! empty( $settings['button_connector_icon'] ) || ! empty( $settings['button_connector_selected_icon'] ) ) ) {
            $this->add_render_attribute( 'button_connector_text', 'class', 'cx-dual-btn-connector--icon' );
        } else {
            $this->add_render_attribute( 'button_connector_text', 'class', 'cx-dual-btn-connector--text' );
            $this->add_inline_editing_attributes( 'button_connector_text', 'none' );
        }

        // Right button
        $this->add_render_attribute( 'right_button', 'class', 'cx-dual-btn cx-dual-btn--right' );
        $this->add_link_attributes( 'right_button', $settings['right_button_link'] );
        $this->add_inline_editing_attributes( 'right_button_text', 'none' );

        if ( ! empty( $settings['right_button_icon'] ) || ! empty( $settings['right_button_selected_icon'] ) ) {
            $this->add_render_attribute( 'right_button_icon', 'class', [
                'cx-dual-btn-icon',
                'cx-dual-btn-icon--' . esc_attr( $settings['right_button_icon_position'] )
            ] );
        }
        ?>
        <div class="cx-dual-btn-wrapper">
            <a <?php $this->print_render_attribute_string( 'left_button' ); ?>>
                <?php if ( $settings['left_button_icon_position'] === 'before' && ( ! empty( $settings['left_button_icon'] ) || ! empty( $settings['left_button_selected_icon'] ) ) ) : ?>
                    <span <?php $this->print_render_attribute_string( 'left_button_icon' ); ?>>
                        <?php cx_render_icon( $settings, 'left_button_icon', 'left_button_selected_icon' ); ?>
                    </span>
                <?php endif; ?>
                <?php if ( $settings['left_button_text'] ) : ?>
                    <span <?php $this->print_render_attribute_string( 'left_button_text' ); ?>><?php echo esc_html( $settings['left_button_text'] ); ?></span>
                <?php endif; ?>
                <?php if ( $settings['left_button_icon_position'] === 'after' && ( ! empty( $settings['left_button_icon'] ) || ! empty( $settings['left_button_selected_icon'] ) ) ) : ?>
                    <span <?php $this->print_render_attribute_string( 'left_button_icon' ); ?>>
                        <?php cx_render_icon( $settings, 'left_button_icon', 'left_button_selected_icon' ); ?>
                    </span>
                <?php endif; ?>
            </a>
            <?php if ( $settings['button_connector_hide'] !== 'yes' ) : ?>
                <span <?php $this->print_render_attribute_string( 'button_connector_text' ); ?>>
                    <?php if ( $settings['button_connector_type'] === 'icon' && ( ! empty( $settings['button_connector_icon'] ) || ! empty( $settings['button_connector_selected_icon'] ) ) ) : ?>
                        <?php cx_render_icon( $settings, 'button_connector_icon', 'button_connector_selected_icon' ); ?>
                    <?php else :
                        echo esc_html( $settings['button_connector_text'] );
                    endif; ?>
                </span>
            <?php endif; ?>
        </div>
        <div class="cx-dual-btn-wrapper">
            <a <?php $this->print_render_attribute_string( 'right_button' ); ?>>
                <?php if ( $settings['right_button_icon_position'] === 'before' && ( ! empty( $settings['right_button_icon'] ) || ! empty( $settings['right_button_selected_icon'] ) ) ) : ?>
                    <span <?php $this->print_render_attribute_string( 'right_button_icon' ); ?>>
                        <?php cx_render_icon( $settings, 'right_button_icon', 'right_button_selected_icon' ); ?>
                    </span>
                <?php endif; ?>
                <?php if ( $settings['right_button_text'] ) : ?>
                    <span <?php $this->print_render_attribute_string( 'right_button_text' ); ?>><?php echo esc_html( $settings['right_button_text'] ); ?></span>
                <?php endif; ?>
                <?php if ( $settings['right_button_icon_position'] === 'after' && ( ! empty( $settings['right_button_icon'] ) || ! empty( $settings['right_button_selected_icon'] ) ) ) : ?>
                    <span <?php $this->print_render_attribute_string( 'right_button_icon' ); ?>>
                        <?php cx_render_icon( $settings, 'right_button_icon', 'right_button_selected_icon' ); ?>
                    </span>
                <?php endif; ?>
            </a>
        </div>
        <?php
    }
}
