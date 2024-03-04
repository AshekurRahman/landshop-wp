<?php
/**
 * Info box widget class
 *
 * @package Codexse_Addons
 */
namespace Codexse_Addons\Elementor\Widget;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Codexse_Addons\Elementor\Traits\Button_Renderer;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

defined( 'ABSPATH' ) || die();

class InfoBox extends Base {

	use Button_Renderer;

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Info Box', 'codexse-elementor-addons' );
	}

	public function get_custom_help_url() {
		return 'https://codexseaddons.com/docs/codexse-addons-for-elementor/widgets/info-box/';
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
		return 'hm hm-info';
	}

	public function get_keywords() {
		return [ 'info', 'blurb', 'box', 'text', 'content' ];
	}

	/**
     * Register widget content controls
     */
	protected function register_content_controls() {
		$this->__media_content_controls();
		$this->lordicon_settings();
		$this->__title_desc_content_controls();
		$this->__button_content_controls();
	}

	protected function __media_content_controls() {

		$this->start_controls_section(
			'_section_media',
			[
				'label' => __( 'Icon / Image', 'codexse-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'type',
			[
				'label' => __( 'Media Type', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'icon' => [
						'title' => __( 'Icon', 'codexse-elementor-addons' ),
						'icon' => 'eicon-star',
					],
					'image' => [
						'title' => __( 'Image', 'codexse-elementor-addons' ),
						'icon' => 'eicon-image',
					],
					'lordicon' => [
						'title' => __( 'LordIcon', 'codexse-elementor-addons' ),
						'icon' => 'eicon-lottie',
					],
				],
				'default' => 'icon',
				'toggle' => false,
				'style_transfer' => true,
			]
		);

		$this->add_control(
            'icon_method',
            [
                'type'        => Controls_Manager::SELECT,
                'label'       => __('Icon Method', 'codexse-elementor-addons'),
                'description' => sprintf('<a target="_blank" href="%1$s">Learn how to use the Lordicon widget</a>', esc_url('https://codexseaddons.com/docs/codexse-addons-for-elementor/widgets/lord-icon')),
                'options'     => [
                    'cdn'  => esc_html__('Paste LordIcon URL', 'codexse-elementor-addons'),
                    'file' => esc_html__('Upload LordIcon file', 'codexse-elementor-addons'),
                ],
                'default'     => 'cdn',
                'label_block' => true,
				'condition' => [
					'type' => 'lordicon'
				],
            ]
        );
        $this->add_control(
            'icon_cdn',
            [
                'type'        => Controls_Manager::TEXT,
                'label'       => __('Paste CDN', 'codexse-elementor-addons'),
                'label_block' => true,
                'description' => sprintf(
                    'Paste icon code from <a target="_blank" href="%1$s">lordicon.com</a> <br /><br /> <a target="_blank" href="%2$s">Learn how to get Lordicon CDN</a><br><br>
                Example: https://cdn.lordicon.com/lupuorrc.json', esc_url('https://lordicon.com/'), esc_url('https://codexseaddons.com/docs/codexse-addons-for-elementor/widgets/lord-icon')
                ),
                'default'     => 'https://cdn.lordicon.com/lupuorrc.json',
                'condition'   => [
					'icon_method' => 'cdn',
					'type' => 'lordicon',
                ],
            ]
        );
        $this->add_control(
            'icon_json',
            [
                'type'        => Controls_Manager::MEDIA,
                'label'       => __('JSON File', 'codexse-elementor-addons'),
                'media_type'  => 'application/json',
                'description' => sprintf('Download Json file from <a href="%1$s" target="_blank">lordicon.com</a>', esc_url('https://lordicon.com/')),
                'default'     => [
                    'url' => CODEXSE_ADDONS_ASSETS . 'vendor/lord-icon/placeholder.json',
                ],
                'condition'   => [
                    'icon_method' => 'file',
					'type' => 'lordicon',
                ],
            ]
        );

		$this->add_control(
			'image',
			[
				'label' => __( 'Image', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'type' => 'image'
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'medium_large',
				'separator' => 'none',
				'exclude' => [
					'full',
					'custom',
					'large',
					'shop_catalog',
					'shop_single',
					'shop_thumbnail'
				],
				'condition' => [
					'type' => 'image'
				]
			]
		);

		if ( cx_is_elementor_version( '<', '2.6.0' ) ) {
			$this->add_control(
				'icon',
				[
					'label' => __( 'Icon', 'codexse-elementor-addons' ),
					'label_block' => true,
					'type' => Controls_Manager::ICON,
					'options' => cx_get_codexse_icons(),
					'default' => 'fa fa-smile-o',
					'condition' => [
						'type' => 'icon'
					]
				]
			);
		} else {
			$this->add_control(
				'selected_icon',
				[
					'type' => Controls_Manager::ICONS,
					'fa4compatibility' => 'icon',
					'label_block' => true,
					'default' => [
						'value' => 'fas fa-smile-wink',
						'library' => 'fa-solid',
					],
					'condition' => [
						'type' => 'icon'
					]
				]
			);
		}

		$this->add_responsive_control(
			'media_direction',
			[
				'label' => __('Media direction', 'codexse-elementor-addons'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'codexse-elementor-addons'),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => __('Top', 'codexse-elementor-addons'),
						'icon' => 'eicon-v-align-top',
					],
				],
				'default' => 'top',
				'toggle' => false,
                'style_transfer' => true,
				'prefix_class' => 'cx-infobox-media-dir%s-',
			]
		);

		$this->add_responsive_control(
			'media_v_align',
			[
				'label' => __('Vertical Alignment', 'codexse-elementor-addons'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __('Top', 'codexse-elementor-addons'),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => __('Center', 'codexse-elementor-addons'),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __('Bottom', 'codexse-elementor-addons'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'top',
				'toggle' => false,
				'condition' => [
					'media_direction' => 'left',
				],
                'style_transfer' => true,
				'selectors_dictionary' => [
                    'top' => ' -webkit-align-self: flex-start; -ms-flex-item-align: flex-start; align-self: flex-start;',
                    'center' => ' -webkit-align-self: center; -ms-flex-item-align: center; align-self: center;',
                    'bottom' => ' -webkit-align-self: flex-end; -ms-flex-item-align: end; align-self: flex-end;',
                ],
				'selectors' => [
					'body[data-elementor-device-mode="widescreen"] {{WRAPPER}}.cx-infobox-media-dir-widescreen-left .cx-infobox-figure' => '{{VALUE}};',
					'body[data-elementor-device-mode="desktop"] {{WRAPPER}}.cx-infobox-media-dir-left .cx-infobox-figure' => '{{VALUE}};',
					'body[data-elementor-device-mode="laptop"] {{WRAPPER}}.cx-infobox-media-dir-laptop-left .cx-infobox-figure' => '{{VALUE}};',
					'body[data-elementor-device-mode="tablet_extra"] {{WRAPPER}}.cx-infobox-media-dir-tablet_extra-left .cx-infobox-figure' => '{{VALUE}};',
					'body[data-elementor-device-mode="tablet"] {{WRAPPER}}.cx-infobox-media-dir-tablet-left .cx-infobox-figure' => '{{VALUE}};',
					'body[data-elementor-device-mode="mobile_extra"] {{WRAPPER}}.cx-infobox-media-dir-mobile_extra-left .cx-infobox-figure' => '{{VALUE}};',
					'body[data-elementor-device-mode="mobile"] {{WRAPPER}}.cx-infobox-media-dir-mobile-left .cx-infobox-figure' => '{{VALUE}};',

					'body[data-elementor-device-mode="widescreen"] {{WRAPPER}}.cx-infobox-media-dir-left .cx-info-box-icon' => '{{VALUE}};',
					'body[data-elementor-device-mode="desktop"] {{WRAPPER}}.cx-infobox-media-dir-left .cx-info-box-icon' => '{{VALUE}};',
					'body[data-elementor-device-mode="laptop"] {{WRAPPER}}.cx-infobox-media-dir-laptop-left .cx-info-box-icon' => '{{VALUE}};',
					'body[data-elementor-device-mode="tablet_extra"] {{WRAPPER}}.cx-infobox-media-dir-tablet_extra-left .cx-info-box-icon' => '{{VALUE}};',
					'body[data-elementor-device-mode="tablet"] {{WRAPPER}}.cx-infobox-media-dir-tablet-left .cx-info-box-icon' => '{{VALUE}};',
					'body[data-elementor-device-mode="mobile_extra"] {{WRAPPER}}.cx-infobox-media-dir-mobile_extra-left .cx-info-box-icon' => '{{VALUE}};',
					'body[data-elementor-device-mode="mobile"] {{WRAPPER}}.cx-infobox-media-dir-mobile-left .cx-info-box-icon' => '{{VALUE}};',
				]
			]
		);

		$this->end_controls_section();
	}

	protected function lordicon_settings(){
		$this->start_controls_section(
			'_section_lordicon_settings',
			[
				'label' => __( 'Lord Icon Settings', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
				'condition' =>[
					'type' => 'lordicon'
				]
			]
		);

		$this->add_control(
            'animation_trigger',
            [
                'type'    => Controls_Manager::SELECT,
                'label'   => __('Animation Trigger', 'codexse-elementor-addons'),
                'options' => [
                    'loop'          => esc_html__('Loop (infinite)', 'codexse-elementor-addons'),
                    'click'         => esc_html__('Click', 'codexse-elementor-addons'),
                    'hover'         => esc_html__('Hover', 'codexse-elementor-addons'),
                    'loop-on-hover' => esc_html__('Loop on Hover', 'codexse-elementor-addons'),
                    'morph'         => esc_html__('Morph', 'codexse-elementor-addons'),
                    'morph-two-way' => esc_html__('Morph two way', 'codexse-elementor-addons'),
                ],
                'default' => 'loop',
            ]
        );

        $this->add_control(
            'target',
            [
                'type'    => Controls_Manager::SELECT,
                'label'   => __('Target', 'codexse-elementor-addons'),
                'options' => [
                    'widget'  => __('On Widget', 'codexse-elementor-addons'),
                    // 'icon' => __('On Icon', 'codexse-elementor-addons' ),
                    'column'  => __('On Column', 'codexse-elementor-addons'),
                    'section' => __('On Section', 'codexse-elementor-addons'),
                    'custom'  => __('Custom', 'codexse-elementor-addons'),
                ],
                'default' => 'widget',
            ]
        );

        $this->add_control(
            'custom_target',
            [
                'type'        => Controls_Manager::TEXT,
                'label'       => __('Custom Target', 'codexse-elementor-addons'),
                'placeholder' => __('.example', 'codexse-elementor-addons'),
                'default'     => __('.example', 'codexse-elementor-addons'),
                'condition'   => [
                    'target' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'pulse_effect',
            [
                'label'        => esc_html__('Pulse Effect', 'codexse-elementor-addons'),
                'type'         => Controls_Manager::SWITCHER,
                'description'  => __('This will override your box shadow', 'codexse-elementor-addons'),
                'return_value' => 'yes',
                'default'      => '',
            ]
        );

        $this->add_control(
            'pulse_color',
            [
                'label'     => __('Pulse Color', 'codexse-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#B6B6B6',
                'condition' => [
                    'pulse_effect' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .pulse_effect' => '--icon-pulse-color:{{VALUE}}',
                ],
            ]
        );

		$this->end_controls_section();
	}

	protected function __title_desc_content_controls() {

		$this->start_controls_section(
			'_section_title',
			[
				'label' => __( 'Title & Description', 'codexse-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'codexse-elementor-addons' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Codexse Info Box Title', 'codexse-elementor-addons' ),
				'placeholder' => __( 'Type Info Box Title', 'codexse-elementor-addons' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'description',
			[
				'label' => __( 'Description', 'codexse-elementor-addons' ),
				'description' => cx_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Codexse info box description goes here', 'codexse-elementor-addons' ),
				'placeholder' => __( 'Type info box description', 'codexse-elementor-addons' ),
				'rows' => 5,
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'title_tag',
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
				'condition' => [
					'media_direction' => 'top',
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->end_controls_section();
	}

	protected function __button_content_controls() {

		$this->start_controls_section(
			'_section_button',
			[
				'label' => __( 'Button', 'codexse-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __( 'Text', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Button Text', 'codexse-elementor-addons' ),
				'placeholder' => __( 'Type button text here', 'codexse-elementor-addons' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'button_link',
			[
				'label' => __( 'Link', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://example.com',
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => '#',
				]
			]
		);

		if ( cx_is_elementor_version( '<', '2.6.0' ) ) {
			$this->add_control(
				'button_icon',
				[
					'label' => __( 'Icon', 'codexse-elementor-addons' ),
					'label_block' => true,
					'type' => Controls_Manager::ICON,
					'options' => cx_get_codexse_icons(),
					'default' => 'fa fa-angle-right',
				]
			);

			$condition = ['button_icon!' => ''];
		} else {
			$this->add_control(
				'button_selected_icon',
				[
					'type' => Controls_Manager::ICONS,
					'fa4compatibility' => 'button_icon',
					'label_block' => true,
				]
			);
			$condition = ['button_selected_icon[value]!' => ''];
		}

		$this->add_control(
			'button_icon_position',
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
					],
				],
				'default' => 'after',
				'toggle' => false,
				'condition' => $condition,
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'button_icon_spacing',
			[
				'label' => __( 'Icon Spacing', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10
				],
				'condition' => $condition,
				'selectors' => [
					'{{WRAPPER}} .cx-btn--icon-before .cx-btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cx-btn--icon-after .cx-btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
     * Register widget style controls
     */
	protected function register_style_controls() {
		$this->__media_style_controls();
		$this->lord_icon_style_controls();
		$this->__title_style_controls();
		$this->__button_style_controls();
	}

	protected function __media_style_controls() {

		$this->start_controls_section(
			'_section_media_style',
			[
				'label' => __( 'Icon / Image', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cx-infobox-figure--icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					 'type' => 'icon'
				]
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label' => __( 'Width', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 400,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cx-infobox-figure--image' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'type' => 'image'
				]
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'label' => __( 'Height', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 400,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cx-infobox-figure--image' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'type' => 'image'
				]
			]
		);

		$this->add_control(
			'offset_toggle',
			[
				'label' => __( 'Offset', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'None', 'codexse-elementor-addons' ),
				'label_on' => __( 'Custom', 'codexse-elementor-addons' ),
				'return_value' => 'yes',
			]
		);

		$this->start_popover();

		$this->add_responsive_control(
			'media_offset_x',
			[
				'label' => __( 'Offset Left', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'condition' => [
					'offset_toggle' => 'yes'
				],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--cx-infobox-media-offset-x: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'media_offset_y',
			[
				'label' => __( 'Offset Top', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'condition' => [
					'offset_toggle' => 'yes'
				],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--cx-infobox-media-offset-y: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_popover();

		$this->add_responsive_control(
			'media_spacing',
			[
				'label' => __( 'Spacing', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'body[data-elementor-device-mode="widescreen"] {{WRAPPER}}.cx-infobox-media-dir-widescreen-top .cx-infobox-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="desktop"] {{WRAPPER}}.cx-infobox-media-dir-top .cx-infobox-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="laptop"] {{WRAPPER}}.cx-infobox-media-dir-laptop-top .cx-infobox-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="tablet_extra"] {{WRAPPER}}.cx-infobox-media-dir-tablet_extra-top .cx-infobox-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="tablet"] {{WRAPPER}}.cx-infobox-media-dir-tablet-top .cx-infobox-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="mobile_extra"] {{WRAPPER}}.cx-infobox-media-dir-mobile_extra-top .cx-infobox-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="mobile"] {{WRAPPER}}.cx-infobox-media-dir-mobile-top .cx-infobox-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
					
					'body[data-elementor-device-mode="widescreen"] {{WRAPPER}}.cx-infobox-media-dir-widescreen-left .cx-infobox-figure' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="desktop"] {{WRAPPER}}.cx-infobox-media-dir-left .cx-infobox-figure' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="laptop"] {{WRAPPER}}.cx-infobox-media-dir-laptop-left .cx-infobox-figure' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="tablet_extra"] {{WRAPPER}}.cx-infobox-media-dir-tablet_extra-left .cx-infobox-figure' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="tablet"] {{WRAPPER}}.cx-infobox-media-dir-tablet-left .cx-infobox-figure' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="mobile_extra"] {{WRAPPER}}.cx-infobox-media-dir-mobile_extra-left .cx-infobox-figure' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="mobile"] {{WRAPPER}}.cx-infobox-media-dir-mobile-left .cx-infobox-figure' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'media_padding',
			[
				'label' => __( 'Padding', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .cx-infobox-figure--image img, {{WRAPPER}} .cx-infobox-figure--icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_margin',
			[
				'label' => __( 'Margin', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cx-infobox-figure' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'media_border',
				'selector' => '{{WRAPPER}} .cx-infobox-figure--image img, {{WRAPPER}} .cx-infobox-figure--icon',
			]
		);

		$this->add_responsive_control(
			'media_border_radius',
			[
				'label' => __( 'Border Radius', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cx-infobox-figure--image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .cx-infobox-figure--icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'media_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .cx-infobox-figure--image img, {{WRAPPER}} .cx-infobox-figure--icon'
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-infobox-figure--icon' => 'color: {{VALUE}}',
				],
				'condition' => [
					'type' => 'icon'
				]
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label' => __( 'Background Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-infobox-figure--icon' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'type' => 'icon'
				]
			]
		);

		$this->add_control(
			'icon_bg_rotate',
			[
				'label' => __( 'Background Rotate', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'default' => [
					'unit' => 'deg',
				],
				'range' => [
					'deg' => [
						'min' => 0,
						'max' => 360,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--cx-infobox-media-rotate: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'type' => 'icon'
				]
			]
		);

		$this->end_controls_section();
	}
	protected function lord_icon_style_controls(){
        $this->start_controls_section(
            '_section_style_lord_icon',
            [
                'label' => __('Lord Icon', 'codexse-elementor-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
				'condition' =>[
					'type' => 'lordicon'
				]
            ]
        );

        $this->add_responsive_control(
            'lord_icon_size',
            [
                'label'   => __('Size', 'codexse-elementor-addons'),
                'type'    => Controls_Manager::SLIDER,
                // 'size_units' => [ 'px' ],
                'range'   => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'size' => 150,
                ],
            ]
        );

        $this->add_control(
            'primary_color',
            [
                'label'   => __('Primary Color', 'codexse-elementor-addons'),
                'type'    => Controls_Manager::COLOR,
                'default' => '#121331',
				'render_type' => 'template',
				'frontend_available' => true,
            ]
        );

        $this->add_control(
            'secondary_color',
            [
                'label'   => __('Secondary Color', 'codexse-elementor-addons'),
                'type'    => Controls_Manager::COLOR,
                'default' => '#08a88a',
            ]
        );

		$this->add_control(
            'tertiary_color',
            [
                'label'   => __('Tertiary Color', 'codexse-elementor-addons'),
                'type'    => Controls_Manager::COLOR,
                'default' => '#0816A8',
            ]
        );

        $this->add_control(
            'quaternary_color',
            [
                'label'   => __('Quaternary Color', 'codexse-elementor-addons'),
                'type'    => Controls_Manager::COLOR,
                'default' => '#2CA808',
            ]
        );

        $this->add_control(
            'lord_icon_stroke',
            [
                'label'   => __('Stroke', 'codexse-elementor-addons'),
                'type'    => Controls_Manager::SLIDER,
                'range'   => [
                    'min' => 1,
                    'max' => 500,
                ],
                'default' => [
                    'size' => '20',
                ],
            ]
        );

        // $this->add_control(
        //     'lord_icon_bg_color',
        //     [
        //         'label'     => __('Background Color', 'codexse-elementor-addons'),
        //         'type'      => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .cx-icon-box-icon lord-icon' => 'background: {{VALUE}};',
        //         ],
        //     ]
        // );

        // $this->add_group_control(
        //     Group_Control_Border::get_type(),
        //     [
        //         'name'     => 'lord_icon_border',
        //         'selector' => '{{WRAPPER}} .cx-icon-box-icon lord-icon',
        //     ]
        // );

        // $this->add_responsive_control(
        //     'lord_icon_border_radius',
        //     [
        //         'label'      => __('Border Radius', 'codexse-elementor-addons'),
        //         'type'       => Controls_Manager::DIMENSIONS,
        //         'size_units' => ['px', '%'],
        //         'selectors'  => [
        //             '{{WRAPPER}} .cx-icon-box-icon lord-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        //         ],
        //     ]
        // );

        // $this->add_group_control(
        //     Group_Control_Box_Shadow::get_type(),
        //     [
        //         'name'     => 'lord_icon_shadow',
        //         'exclude'  => [
        //             'box_shadow_position',
        //         ],
        //         'selector' => '{{WRAPPER}} .cx-icon-box-icon lord-icon',
        //     ]
        // );

        $this->end_controls_section();
    }

	protected function __title_style_controls() {

		$this->start_controls_section(
			'_section_title_style',
			[
				'label' => __( 'Title & Description', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Content Box Padding', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cx-infobox-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Title', 'codexse-elementor-addons' ),
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => __( 'Bottom Spacing', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .cx-infobox-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-infobox-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'codexse-elementor-addons' ),
				'selector' => '{{WRAPPER}} .cx-infobox-title',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
			]
		);

		$this->add_control(
			'description_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Description', 'codexse-elementor-addons' ),
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'description_spacing',
			[
				'label' => __( 'Bottom Spacing', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .cx-infobox-text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Text Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-infobox-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => __( 'Typography', 'codexse-elementor-addons' ),
				'selector' => '{{WRAPPER}} .cx-infobox-text',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->end_controls_section();
	}

	protected function __button_style_controls() {

		$this->start_controls_section(
			'_section_style_button',
			[
				'label' => __( 'Button', 'codexse-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'link_padding',
			[
				'label' => __( 'Padding', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cx-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'selector' => '{{WRAPPER}} .cx-btn',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .cx-btn',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => __( 'Border Radius', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cx-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .cx-btn',
			]
		);

		$this->add_control(
			'hr',
			[
				'type' => Controls_Manager::DIVIDER,
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
			'link_color',
			[
				'label' => __( 'Text Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cx-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label' => __( 'Background Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_icon_translate',
			[
				'label' => __( 'Icon Translate X', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cx-btn .cx-btn-icon' => '--infobox-btn-icon-translate-x: {{SIZE}}{{UNIT}};',
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
			'link_hover_color',
			[
				'label' => __( 'Text Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-btn:hover, {{WRAPPER}} .cx-btn:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_bg_color',
			[
				'label' => __( 'Background Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-btn:hover, {{WRAPPER}} .cx-btn:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Border Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'button_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .cx-btn:hover, {{WRAPPER}} .cx-btn:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_icon_translate',
			[
				'label' => __( 'Icon Translate X', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10
				],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cx-btn .cx-btn-icon' => '--infobox-btn-icon-translate-x-hover: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		//for manage loard icon global colors only
		$primary_color = $settings['primary_color'];
		if( isset($settings['__globals__']) && !empty($settings['__globals__']['primary_color']) ) { 
			$color_id = explode('=', $settings['__globals__']['primary_color']);
			$get_id = end($color_id);
			$primary_color = $this->get_golobal_color($get_id);
		} 
		
		$secondary_color = $settings['secondary_color'];
		if( isset($settings['__globals__']) && !empty($settings['__globals__']['secondary_color']) ) { 
			$color_id = explode('=', $settings['__globals__']['secondary_color']);
			$get_id = end($color_id);
			$secondary_color = $this->get_golobal_color($get_id);
		} 
		
		$tertiary_color = $settings['tertiary_color'];
		if( isset($settings['__globals__']) && !empty($settings['__globals__']['tertiary_color']) ) { 
			$color_id = explode('=', $settings['__globals__']['tertiary_color']);
			$get_id = end($color_id);
			$tertiary_color = $this->get_golobal_color($get_id);
		} 
		
		$quaternary_color = $settings['quaternary_color'];
		if( isset($settings['__globals__']) && !empty($settings['__globals__']['quaternary_color']) ) { 
			$color_id = explode('=', $settings['__globals__']['quaternary_color']);
			$get_id = end($color_id);
			$quaternary_color = $this->get_golobal_color($get_id);
		} 
				

		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_render_attribute( 'title', 'class', 'cx-infobox-title' );

		$this->add_inline_editing_attributes( 'description', 'intermediate' );
		$this->add_render_attribute( 'description', 'class', 'cx-infobox-text' );

		if( 'lordicon' == $settings[ 'type' ] ){
			if ( 'file' == $settings['icon_method'] ) {
				$json_url = $settings['icon_json']['url'];
			} else {
				$json_url = $settings['icon_cdn'];
			}
		}
		$pulse_effect = ( 'yes' == $settings['pulse_effect'] ) ? ' pulse_effect' : '';
		?>

		<?php if ( $settings['type'] === 'image' && ( $settings['image']['url'] || $settings['image']['id'] ) ) :
			$settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
			?>
			<figure class="cx-infobox-figure cx-infobox-figure--image">
				<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
			</figure>
		<?php elseif( isset( $settings['type'] ) && 'lordicon' === $settings['type'] ) : ?>
		<span class="cx-info-box-icon<?php echo esc_attr( $pulse_effect ); ?>">
			<lord-icon
				src="<?php echo esc_url( $json_url ); ?>"
				trigger="<?php echo esc_attr($settings['animation_trigger'] ); ?>"
				stroke="<?php echo esc_attr( $settings['lord_icon_stroke']['size']); ?>"
				target="<?php echo esc_attr( $settings['target'] ); ?>"
				colors="primary:<?php echo esc_attr($primary_color); ?>,secondary:<?php echo esc_attr($secondary_color); ?>,tertiary:<?php echo esc_attr($tertiary_color); ?>,quaternary:<?php echo esc_attr($quaternary_color); ?>"
				style="width:<?php echo esc_attr($settings['lord_icon_size']['size']); ?>px;height:<?php echo esc_attr($settings['lord_icon_size']['size']); ?>px">
			</lord-icon>
		</span>
		<?php elseif ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon']['value'] ) ) : ?>
			<figure class="cx-infobox-figure cx-infobox-figure--icon">
				<?php cx_render_icon( $settings, 'icon', 'selected_icon' ); ?>
			</figure>
		<?php endif; ?>

		<div class="cx-infobox-body">
			<?php
			if ( $settings['title' ] ) :
				printf( '<%1$s %2$s>%3$s</%1$s>',
					cx_escape_tags( $settings['title_tag'], 'h2' ),
					$this->get_render_attribute_string( 'title' ),
					cx_kses_basic( $settings['title' ] )
				);
			endif;
			?>

			<?php if ( $settings['description'] ) : ?>
				<div <?php $this->print_render_attribute_string( 'description' ); ?>>
					<p><?php echo cx_kses_intermediate( $settings['description'] ); ?></p>
				</div>
			<?php endif; ?>

			<?php $this->render_icon_button(); ?>
		</div>
		<?php
	}

	private function get_golobal_color($id) {
		$global_color = '';

		if( ! $id ) {
			return $global_color;
		}
		
		$el_page_settings 	= [];

		$ekit_id = get_option('elementor_active_kit', true);

		if ( $ekit_id ) {
			$el_page_settings = get_post_meta($ekit_id, '_elementor_page_settings', true);

			if( !empty( $el_page_settings ) && isset($el_page_settings['system_colors']) ) {
				foreach( $el_page_settings['system_colors'] as $key => $val ) {
					if( $val['_id'] == $id ) {
						$global_color = $val['color'];
					}
				}
			}

		}

		return $global_color;
	}


}