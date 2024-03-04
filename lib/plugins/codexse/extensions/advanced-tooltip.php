<?php

namespace Codexse_Addons\Elementor\Extension;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;

defined('ABSPATH') || die();

class Advanced_Tooltip {

    static $should_script_enqueue = false;

    public static function init() {
        add_action('elementor/element/common/_section_style/after_section_end', [__CLASS__, 'add_controls_section'], 1);

        add_action('elementor/frontend/widget/before_render', [__CLASS__, 'should_script_enqueue']);

        add_action('elementor/preview/enqueue_scripts', [__CLASS__, 'enqueue_scripts']);
    }

    public static function enqueue_scripts() {
        $suffix = cx_is_script_debug_enabled() ? '.' : '.min.';

        $extension_js = CODEXSE_ADDONS_DIR_PATH . 'assets/js/extension-advanced-tooltip' . $suffix . 'js';

        if (file_exists($extension_js)) {
            wp_add_inline_script(
                'elementor-frontend',
                file_get_contents($extension_js)
            );
        }
    }

    /**
     * Set should_script_enqueue based extension settings
     *
     * @param Element_Base $section
     * @return void
     */
    public static function should_script_enqueue($section) {
        if (self::$should_script_enqueue) {
            return;
        }

        if ('enable' == $section->get_settings_for_display('cx_advanced_tooltip_enable')) {
            self::$should_script_enqueue = true;

            self::enqueue_scripts();

            remove_action('elementor/frontend/section/before_render', [__CLASS__, 'should_script_enqueue']);
        }
    }

    public static function add_controls_section($element) {

        $element->start_controls_section(
            '_section_cx_advanced_tooltip',
            [
                'label' => __('Codexse Tooltip', 'codexse-elementor-addons') . cx_get_section_icon(),
                'tab'   => Controls_Manager::TAB_ADVANCED,
            ]
        );

        $element->add_control(
            'cx_advanced_tooltip_enable',
            [
                'label'       => __('Enable Codexse Tooltip?', 'codexse-elementor-addons'),
                'type'        => Controls_Manager::SWITCHER,
                'label_on' => __('On', 'codexse-elementor-addons'),
                'label_off' => __('Off', 'codexse-elementor-addons'),
                'return_value' => 'enable',
                'prefix_class' => 'cx-advanced-tooltip-',
                'default' => '',
                'frontend_available' => true,
            ]
        );

        $element->start_controls_tabs('cx_tooltip_tabs');

        $element->start_controls_tab('cx_tooltip_settings', [
            'label' => __('Settings', 'codexse-elementor-addons'),
            'condition' => [
                'cx_advanced_tooltip_enable!' => '',
            ],
        ]);

        $element->add_control(
            'cx_advanced_tooltip_content',
            [
                'label' => __('Content', 'codexse-elementor-addons'),
                'type'      => Controls_Manager::TEXTAREA,
                'description' => cx_get_allowed_html_desc('intermediate'),
                'rows' => 5,
                'default' => __('I am a tooltip', 'codexse-elementor-addons'),
                'dynamic' => ['active' => true],
                'frontend_available' => true,
                'condition' => [
                    'cx_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->add_responsive_control(
            'cx_advanced_tooltip_position',
            [
                'label' => __('Position', 'codexse-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'top',
                'options' => [
                    'top' => __('Top', 'codexse-elementor-addons'),
                    'bottom' => __('Bottom', 'codexse-elementor-addons'),
                    'left' => __('Left', 'codexse-elementor-addons'),
                    'right' => __('Right', 'codexse-elementor-addons'),
                ],
                'frontend_available' => true,
                'prefix_class' => 'cx-advanced-tooltip%s-',
                'condition' => [
                    'cx_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->add_control(
            'cx_advanced_tooltip_animation',
            [
                'label' => __('Animation', 'codexse-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __('None', 'codexse-elementor-addons'),
                    'cx_fadeIn' => __('fadeIn', 'codexse-elementor-addons'),
                    'cx_zoomIn' => __('zoomIn', 'codexse-elementor-addons'),
                    'cx_rollIn' => __('rollIn', 'codexse-elementor-addons'),
                    'cx_bounce' => __('bounce', 'codexse-elementor-addons'),
                    'cx_slideInDown' => __('slideInDown', 'codexse-elementor-addons'),
                    'cx_slideInLeft' => __('slideInLeft', 'codexse-elementor-addons'),
                    'cx_slideInRight' => __('slideInRight', 'codexse-elementor-addons'),
                    'cx_slideInUp' => __('slideInUp', 'codexse-elementor-addons'),
                ],
                'frontend_available' => true,
                'condition' => [
                    'cx_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->add_control(
            'cx_advanced_tooltip_duration',
            [
                'label' => __('Animation Duration (ms)', 'codexse-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => 100,
                'max' => 5000,
                'step' => 50,
                'default' => 1000,
                'frontend_available' => true,
                'condition' => [
                    'cx_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->add_control(
            'cx_advanced_tooltip_arrow',
            [
                'label' => __('Arrow', 'codexse-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'codexse-elementor-addons'),
                'label_off' => __('Hide', 'codexse-elementor-addons'),
                'return_value' => 'true',
                'default' => 'true',
                'frontend_available' => true,
                'condition' => [
                    'cx_advanced_tooltip_enable!' => '',
                ],
            ]
        );


        $element->add_control(
            'cx_advanced_tooltip_arrow_notice',
            [
                'raw' => '<strong>' . esc_html__('Please note!', 'codexse-elementor-addons') . '</strong> ' . esc_html__('By toggling Arrow to "HIDE" you get access to more background control.', 'codexse-elementor-addons'),
                'type' => Controls_Manager::RAW_HTML,
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                'render_type' => 'ui',
                'condition' => [
                    'cx_advanced_tooltip_enable!' => '',
                    'cx_advanced_tooltip_arrow' => 'true',
                ],
            ]
        );

        $element->add_control(
            'cx_advanced_tooltip_trigger',
            [
                'label' => __('Trigger', 'codexse-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'hover',
                'options' => [
                    'click' => __('Click', 'codexse-elementor-addons'),
                    'hover' => __('Hover', 'codexse-elementor-addons'),
                ],
                'frontend_available' => true,
                'condition' => [
                    'cx_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->add_responsive_control(
            'cx_advanced_tooltip_distance',
            [
                'label' => __('Distance', 'codexse-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '0',
                ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.cx-advanced-tooltip-enable .cx-advanced-tooltip-content' => '--cx-tooltip-arrow-distance: {{SIZE}}{{UNIT}};',
                    // '{{WRAPPER}}.cx-advanced-tooltip-enable .cx-advanced-tooltip-content' => '--cx-tooltip-arrow-distance: {{SIZE}}{{UNIT}};',
                    // '{{WRAPPER}}.cx-advanced-tooltip-enable .cx-advanced-tooltip-content' => '--cx-tooltip-arrow-distance: {{SIZE}}{{UNIT}};',
                    // '{{WRAPPER}}.cx-advanced-tooltip-enable .cx-advanced-tooltip-content' => '--cx-tooltip-arrow-distance: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'cx_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->add_responsive_control(
            'cx_advanced_tooltip_align',
            [
                'label' => __('Text Alignment', 'codexse-elementor-addons'),
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
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .cx-advanced-tooltip-content' => 'text-align: {{VALUE}};'
                ],
                'condition' => [
                    'cx_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->end_controls_tab();

        $element->start_controls_tab('cx_advanced_tooltip_styles', [
            'label' => __('Styles', 'codexse-elementor-addons'),
            'condition' => [
                'cx_advanced_tooltip_enable!' => '',
            ],
        ]);

        $element->add_responsive_control(
            'cx_advanced_tooltip_width',
            [
                'label' => __('Width', 'codexse-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '120',
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 800,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-advanced-tooltip-content' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'cx_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->add_responsive_control(
            'cx_advanced_tooltip_arrow_size',
            [
                'label' => __('Tooltip Arrow Size (px)', 'codexse-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '5',
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cx-advanced-tooltip-content::after' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'cx_advanced_tooltip_enable!' => '',
                    'cx_advanced_tooltip_arrow' => 'true',
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cx_advanced_tooltip_typography',
                'separator' => 'after',
                'fields_options' => [
                    'typography' => [
                        'default' => 'yes'
                    ],
                    'font_family' => [
                        'default' => 'Nunito',
                    ],
                    'font_weight' => [
                        'default' => '500', // 100, 200, 300, 400, 500, 600, 700, 800, 900, normal, bold
                    ],
                    'font_size' => [
                        'default' => [
                            'unit' => 'px', // px, em, rem, vh
                            'size' => '14', // any number
                        ],
                    ],
                ],
                'selector' => '{{WRAPPER}} .cx-advanced-tooltip-content',
                'condition' => [
                    'cx_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'cx_advanced_tooltip_title_section_bg_color',
                'label'    => __('Background', 'codexse-elementor-addons'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .cx-advanced-tooltip-content',
                'condition' => [
                    'cx_advanced_tooltip_enable!' => '',
                    'cx_advanced_tooltip_arrow!' => 'true',
                ],
            ]
        );

        $element->add_control(
            'cx_advanced_tooltip_background_color',
            [
                'label' => __('Background Color', 'codexse-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .cx-advanced-tooltip-content' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .cx-advanced-tooltip-content::after' => '--cx-tooltip-arrow-color: {{VALUE}}',
                ],
                'condition' => [
                    'cx_advanced_tooltip_enable!' => '',
                    'cx_advanced_tooltip_arrow' => 'true',
                ],
            ]
        );

        $element->add_control(
            'cx_advanced_tooltip_color',
            [
                'label' => __('Text Color', 'codexse-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .cx-advanced-tooltip-content' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'cx_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cx_advanced_tooltip_border',
                'label' => __('Border', 'codexse-elementor-addons'),
                'selector' => '{{WRAPPER}} .cx-advanced-tooltip-content',
                'condition' => [
                    'cx_advanced_tooltip_enable!' => '',
                    'cx_advanced_tooltip_arrow!' => 'true',
                ],
            ]
        );

        $element->add_responsive_control(
            'cx_advanced_tooltip_border_radius',
            [
                'label' => __('Border Radius', 'codexse-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .cx-advanced-tooltip-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'cx_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->add_responsive_control(
            'cx_advanced_tooltip_padding',
            [
                'label' => __('Padding', 'codexse-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .cx-advanced-tooltip-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'cx_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'cx_advanced_tooltip_box_shadow',
                'selector' => '{{WRAPPER}} .cx-advanced-tooltip-content',
                'separator' => '',
                'condition' => [
                    'cx_advanced_tooltip_enable!' => '',
                ],
            ]
        );

        $element->end_controls_tab();

        $element->end_controls_tabs();

        $element->end_controls_section();
    }
}

Advanced_Tooltip::init();
