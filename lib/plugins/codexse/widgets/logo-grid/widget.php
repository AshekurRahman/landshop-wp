<?php
/**
 * Logo grid widget class
 *
 * @package Codexse_Addons
 */
namespace Codexse_Addons\Elementor\Widget;

use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Logo_Grid extends Base {

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Logo Grid', 'codexse-elementor-addons');
    }

	public function get_custom_help_url() {
		return 'https://codexseaddons.com/docs/codexse-addons-for-elementor/widgets/logo-grid/';
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
        return 'cx cx-logo-grid';
    }

    public function get_keywords() {
        return ['logo', 'grid', 'brand', 'client'];
    }

	/**
     * Register widget content controls
     */
    protected function register_content_controls() {
		$this->__logo_content_controls();
		$this->__settings_content_controls();
	}

    protected function __logo_content_controls() {

        $this->start_controls_section(
            '_section_logo',
            [
                'label' => __( 'Logo Grid', 'codexse-elementor-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => __( 'Logo', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => __( 'Website Url', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
				],
				'default' => [
					'url'         => '#',
					'is_external' => true,
					'nofollow'    => true,
				]
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label' => __( 'Brand Name', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Brand Name', 'codexse-elementor-addons' ),
            ]
        );

        $this->add_control(
            'logo_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
                'default' => [
                    [
						'image' => [
							'url' => Utils::get_placeholder_image_src()
						],
						'link' => [
							'url'         => '#',
							'is_external' => true,
							'nofollow'    => true,
						],
					],
                    [
						'image' => [
							'url' => Utils::get_placeholder_image_src()
						],
						'link' => [
							'url'         => '#',
							'is_external' => true,
							'nofollow'    => true,
						],
					],
					[
						'image' => [
							'url' => Utils::get_placeholder_image_src()
						],
						'link' => [
							'url'         => '#',
							'is_external' => true,
							'nofollow'    => true,
						],
					],
					[
						'image' => [
							'url' => Utils::get_placeholder_image_src()
						],
						'link' => [
							'url'         => '#',
							'is_external' => true,
							'nofollow'    => true,
						],
					],
					[
						'image' => [
							'url' => Utils::get_placeholder_image_src()
						],
						'link' => [
							'url'         => '#',
							'is_external' => true,
							'nofollow'    => true,
						],
					],
					[
						'image' => [
							'url' => Utils::get_placeholder_image_src()
						],
						'link' => [
							'url'         => '#',
							'is_external' => true,
							'nofollow'    => true,
						],
					],
					[
						'image' => [
							'url' => Utils::get_placeholder_image_src()
						],
						'link' => [
							'url'         => '#',
							'is_external' => true,
							'nofollow'    => true,
						],
					],
					[
						'image' => [
							'url' => Utils::get_placeholder_image_src()
						],
						'link' => [
							'url'         => '#',
							'is_external' => true,
							'nofollow'    => true,
						],
					],
                ]
            ]
        );

        $this->end_controls_section();
	}

    protected function __settings_content_controls() {

        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __( 'Settings', 'codexse-elementor-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => __( 'Grid Layout', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'box' => __( 'Box', 'codexse-elementor-addons' ),
                    'border' => __( 'Border', 'codexse-elementor-addons' ),
                    'tictactoe' => __( 'Tic Tac Toe', 'codexse-elementor-addons' ),
                ],
                'default' => 'box',
                'prefix_class' => 'cx-logo-grid--',
                'style_transfer' => true,
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label' => __( 'Columns', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    2 => __( '2 Columns', 'codexse-elementor-addons' ),
                    3 => __( '3 Columns', 'codexse-elementor-addons' ),
                    4 => __( '4 Columns', 'codexse-elementor-addons' ),
                    5 => __( '5 Columns', 'codexse-elementor-addons' ),
                    6 => __( '6 Columns', 'codexse-elementor-addons' ),
                ],
                'desktop_default' => 4,
                'tablet_default' => 2,
                'mobile_default' => 2,
                'prefix_class' => 'cx-logo-grid--col-%s',
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();
    }

	/**
     * Register widget style controls
     */
    protected function register_style_controls() {

        $this->start_controls_section(
            '_section_style_grid',
            [
                'label' => __( 'Grid', 'codexse-elementor-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => __( 'Padding', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .cx-logo-grid-figure' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label' => __( 'Height', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'max' => 500,
                        'min' => 100,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-logo-grid-item' => 'height: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
            'grid_border_type',
            [
                'label' => __( 'Border Type', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => __( 'None', 'codexse-elementor-addons' ),
                    'solid' => __( 'Solid', 'codexse-elementor-addons' ),
                    'double' => __( 'Double', 'codexse-elementor-addons' ),
                    'dotted' => __( 'Dotted', 'codexse-elementor-addons' ),
                    'dashed' => __( 'Dashed', 'codexse-elementor-addons' ),
                    'groove' => __( 'Groove', 'codexse-elementor-addons' ),
                ],
                'default' => 'solid',
                'selectors' => [
                    '{{WRAPPER}} .cx-logo-grid-item' => 'border-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'grid_border_width',
            [
                'label' => __( 'Border Width', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '(desktop+){{WRAPPER}}.cx-logo-grid--border .cx-logo-grid-item' => 'border-right-width: {{grid_border_width.SIZE}}{{UNIT}}; border-bottom-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--border .cx-logo-grid-item' => 'border-right-width: {{grid_border_width_tablet.SIZE}}{{UNIT}}; border-bottom-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--border .cx-logo-grid-item' => 'border-right-width: {{grid_border_width_mobile.SIZE}}{{UNIT}}; border-bottom-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',

                    '(desktop+){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col-2 .cx-logo-grid-item:nth-child(2n+1)' => 'border-left-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col-3 .cx-logo-grid-item:nth-child(3n+1)' => 'border-left-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col-4 .cx-logo-grid-item:nth-child(4n+1)' => 'border-left-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col-5 .cx-logo-grid-item:nth-child(5n+1)' => 'border-left-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col-6 .cx-logo-grid-item:nth-child(6n+1)' => 'border-left-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col-2 .cx-logo-grid-item:nth-child(-n+2)' => 'border-top-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col-3 .cx-logo-grid-item:nth-child(-n+3)' => 'border-top-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col-4 .cx-logo-grid-item:nth-child(-n+4)' => 'border-top-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col-5 .cx-logo-grid-item:nth-child(-n+5)' => 'border-top-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col-6 .cx-logo-grid-item:nth-child(-n+6)' => 'border-top-width: {{grid_border_width.SIZE}}{{UNIT}};',

                    '(tablet){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--tablet2 .cx-logo-grid-item:nth-child(2n+1)' => 'border-left-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--tablet3 .cx-logo-grid-item:nth-child(3n+1)' => 'border-left-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--tablet4 .cx-logo-grid-item:nth-child(4n+1)' => 'border-left-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--tablet5 .cx-logo-grid-item:nth-child(5n+1)' => 'border-left-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--tablet6 .cx-logo-grid-item:nth-child(6n+1)' => 'border-left-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--tablet2 .cx-logo-grid-item:nth-child(-n+2)' => 'border-top-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--tablet3 .cx-logo-grid-item:nth-child(-n+3)' => 'border-top-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--tablet4 .cx-logo-grid-item:nth-child(-n+4)' => 'border-top-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--tablet5 .cx-logo-grid-item:nth-child(-n+5)' => 'border-top-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--tablet6 .cx-logo-grid-item:nth-child(-n+6)' => 'border-top-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',

                    '(mobile){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--mobile2 .cx-logo-grid-item:nth-child(2n+1)' => 'border-left-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--mobile3 .cx-logo-grid-item:nth-child(3n+1)' => 'border-left-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--mobile4 .cx-logo-grid-item:nth-child(4n+1)' => 'border-left-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--mobile5 .cx-logo-grid-item:nth-child(5n+1)' => 'border-left-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--mobile6 .cx-logo-grid-item:nth-child(6n+1)' => 'border-left-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--mobile2 .cx-logo-grid-item:nth-child(-n+2)' => 'border-top-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--mobile3 .cx-logo-grid-item:nth-child(-n+3)' => 'border-top-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--mobile4 .cx-logo-grid-item:nth-child(-n+4)' => 'border-top-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--mobile5 .cx-logo-grid-item:nth-child(-n+5)' => 'border-top-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--mobile6 .cx-logo-grid-item:nth-child(-n+6)' => 'border-top-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',

                    '{{WRAPPER}}.cx-logo-grid--tictactoe .cx-logo-grid-item' => 'border-top-width: {{SIZE}}{{UNIT}}; border-right-width: {{SIZE}}{{UNIT}};',

                    '{{WRAPPER}}.cx-logo-grid--box .cx-logo-grid-item' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'grid_border_type!' => 'none',
                ]
            ]
        );

        $this->add_control(
            'grid_border_color',
            [
                'label' => __( 'Border Color', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cx-logo-grid-item' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'grid_border_type!' => 'none',
                ]
            ]
        );

        $this->add_control(
            'grid_bg_color',
            [
                'label' => __( 'Background Color', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cx-logo-grid-figure' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'grid_border_radius',
            [
                'label' => __( 'Border Radius', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}.cx-logo-grid--border .cx-logo-grid-wrapper, {{WRAPPER}}.cx-logo-grid--box .cx-logo-grid-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}}.cx-logo-grid--border .cx-logo-grid-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}};',
                    '{{WRAPPER}}.cx-logo-grid--border .cx-logo-grid-item:last-child' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}};',

                    '(desktop+){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col-2 .cx-logo-grid-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col-2 .cx-logo-grid-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col-3 .cx-logo-grid-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col-3 .cx-logo-grid-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col-4 .cx-logo-grid-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col-4 .cx-logo-grid-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col-5 .cx-logo-grid-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col-5 .cx-logo-grid-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col-6 .cx-logo-grid-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col-6 .cx-logo-grid-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',

                    '(tablet){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--tablet2 .cx-logo-grid-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--tablet2 .cx-logo-grid-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--tablet3 .cx-logo-grid-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--tablet3 .cx-logo-grid-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--tablet4 .cx-logo-grid-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--tablet4 .cx-logo-grid-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--tablet5 .cx-logo-grid-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--tablet5 .cx-logo-grid-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--tablet6 .cx-logo-grid-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--tablet6 .cx-logo-grid-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',

                    '(mobile){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--mobile2 .cx-logo-grid-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--mobile2 .cx-logo-grid-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--mobile3 .cx-logo-grid-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--mobile3 .cx-logo-grid-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--mobile4 .cx-logo-grid-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--mobile4 .cx-logo-grid-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--mobile5 .cx-logo-grid-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--mobile5 .cx-logo-grid-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--mobile6 .cx-logo-grid-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--border.cx-logo-grid--col--mobile6 .cx-logo-grid-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',

                    // Tictactoe
                    '{{WRAPPER}}.cx-logo-grid--tictactoe .cx-logo-grid-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}}.cx-logo-grid--tictactoe .cx-logo-grid-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}};',
                    '{{WRAPPER}}.cx-logo-grid--tictactoe .cx-logo-grid-item:last-child' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}};',

                    '(desktop+){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col-2 .cx-logo-grid-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col-2 .cx-logo-grid-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col-3 .cx-logo-grid-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col-3 .cx-logo-grid-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col-4 .cx-logo-grid-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col-4 .cx-logo-grid-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col-5 .cx-logo-grid-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col-5 .cx-logo-grid-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col-6 .cx-logo-grid-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col-6 .cx-logo-grid-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',

                    '(tablet){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col--tablet2 .cx-logo-grid-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col--tablet2 .cx-logo-grid-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col--tablet3 .cx-logo-grid-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col--tablet3 .cx-logo-grid-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col--tablet4 .cx-logo-grid-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col--tablet4 .cx-logo-grid-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col--tablet5 .cx-logo-grid-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col--tablet5 .cx-logo-grid-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col--tablet6 .cx-logo-grid-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col--tablet6 .cx-logo-grid-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',

                    '(mobile){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col--mobile2 .cx-logo-grid-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col--mobile2 .cx-logo-grid-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col--mobile3 .cx-logo-grid-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col--mobile3 .cx-logo-grid-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col--mobile4 .cx-logo-grid-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col--mobile4 .cx-logo-grid-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col--mobile5 .cx-logo-grid-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col--mobile5 .cx-logo-grid-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col--mobile6 .cx-logo-grid-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.cx-logo-grid--tictactoe.cx-logo-grid--col--mobile6 .cx-logo-grid-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'grid_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}}.cx-logo-grid--tictactoe .cx-logo-grid-wrapper, {{WRAPPER}}.cx-logo-grid--border .cx-logo-grid-wrapper, {{WRAPPER}}.cx-logo-grid--box .cx-logo-grid-item'
            ]
        );


        $this->start_controls_tabs(
            '_tabs_image_effects',
            [
                'separator' => 'before'
            ]
        );

        $this->start_controls_tab(
            '_tab_image_effects_normal',
            [
                'label' => __( 'Normal', 'codexse-elementor-addons' ),
            ]
        );

        $this->add_control(
            'image_opacity',
            [
                'label' => __( 'Opacity', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-logo-grid-figure img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'image_css_filters',
                'selector' => '{{WRAPPER}} .cx-logo-grid-figure img',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'hover',
            [
                'label' => __( 'Hover', 'codexse-elementor-addons' ),
            ]
        );

        $this->add_control(
            'image_opacity_hover',
            [
                'label' => __( 'Opacity', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-logo-grid-figure:hover img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'image_css_filters_hover',
                'selector' => '{{WRAPPER}} .cx-logo-grid-figure:hover img',
            ]
        );

        $this->add_control(
            'image_bg_hover_transition',
            [
                'label' => __( 'Transition Duration', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-logo-grid-figure:hover img' => 'transition-duration: {{SIZE}}s;',
                ],
            ]
        );

        $this->add_control(
            'hover_animation',
            [
                'label' => __( 'Hover Animation', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::HOVER_ANIMATION,
                'label_block' => true,
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( empty($settings['logo_list'] ) ) {
            return;
        }
        ?>

        <div class="cx-logo-grid-wrapper">
            <?php
            foreach ( $settings['logo_list'] as $index => $item ) :
                $image = $item['image'];
                $repeater_key = 'grid_item' . $index;
                $tag = 'div';
                $this->add_render_attribute( $repeater_key, 'class', 'cx-logo-grid-item' );

                if ( $item['link']['url'] ) {
                    $tag = 'a';
					$this->add_render_attribute( $repeater_key, 'class', 'cx-logo-grid-link' );
					$this->add_link_attributes( $repeater_key, $item['link'] );
                }
                ?>
                <<?php echo $tag; ?> <?php $this->print_render_attribute_string( $repeater_key ); ?>>
                    <figure class="cx-logo-grid-figure">
                    <?php if ( isset( $image['source'] ) && $image['id'] ) :
							echo wp_get_attachment_image(
								$image['id'],
								$settings['thumbnail_size'],
								false,
								[
									'class' => 'cx-logo-grid-img elementor-animation-' . esc_attr( $settings['hover_animation'] )
								]
							);
                        else :
							$url = $image['url'] ? $image['url'] : Utils::get_placeholder_image_src();
                            printf( '<img class="cx-logo-grid-img elementor-animation-%s" src="%s" alt="%s">',
                                esc_attr( $settings['hover_animation'] ),
                                esc_url( $url ),
                                esc_attr( $item['name'] )
                                );
                        endif; ?>
                    </figure>
                </<?php echo $tag; ?>>
            <?php endforeach; ?>
        </div>

        <?php
    }
}
