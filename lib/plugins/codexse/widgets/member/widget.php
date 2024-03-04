<?php
/**
 * Member widget class
 *
 * @package Codexse_Addons
 */
namespace Codexse_Addons\Elementor\Widget;

use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;
use Codexse_Addons\Elementor\Traits\Button_Renderer;

defined( 'ABSPATH' ) || die();

class Member extends Base {

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
		return __( 'Team Member', 'codexse-elementor-addons' );
	}

	public function get_custom_help_url() {
		return 'https://codexseaddons.com/docs/codexse-addons-for-elementor/widgets/team-member/';
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
		return 'hm hm-team-member';
	}

	public function get_keywords() {
		return [ 'team', 'member', 'crew', 'staff', 'person' ];
	}

	public function get_style_depends() {
		return [
			'elementor-icons-fa-solid',
			'elementor-icons-fa-brands',
		];
	}

	protected static function get_profile_names() {
		return [
			'500px'          => __( '500px', 'codexse-elementor-addons' ),
			'apple'          => __( 'Apple', 'codexse-elementor-addons' ),
			'behance'        => __( 'Behance', 'codexse-elementor-addons' ),
			'bitbucket'      => __( 'BitBucket', 'codexse-elementor-addons' ),
			'codepen'        => __( 'CodePen', 'codexse-elementor-addons' ),
			'delicious'      => __( 'Delicious', 'codexse-elementor-addons' ),
			'deviantart'     => __( 'DeviantArt', 'codexse-elementor-addons' ),
			'digg'           => __( 'Digg', 'codexse-elementor-addons' ),
			'dribbble'       => __( 'Dribbble', 'codexse-elementor-addons' ),
			'email'          => __( 'Email', 'codexse-elementor-addons' ),
			'phone'          => __( 'Phone', 'codexse-elementor-addons' ),
			'facebook'       => __( 'Facebook', 'codexse-elementor-addons' ),
			'flickr'         => __( 'Flicker', 'codexse-elementor-addons' ),
			'foursquare'     => __( 'FourSquare', 'codexse-elementor-addons' ),
			'github'         => __( 'Github', 'codexse-elementor-addons' ),
			'houzz'          => __( 'Houzz', 'codexse-elementor-addons' ),
			'instagram'      => __( 'Instagram', 'codexse-elementor-addons' ),
			'jsfiddle'       => __( 'JS Fiddle', 'codexse-elementor-addons' ),
			'linkedin'       => __( 'LinkedIn', 'codexse-elementor-addons' ),
			'medium'         => __( 'Medium', 'codexse-elementor-addons' ),
			'pinterest'      => __( 'Pinterest', 'codexse-elementor-addons' ),
			'product-hunt'   => __( 'Product Hunt', 'codexse-elementor-addons' ),
			'reddit'         => __( 'Reddit', 'codexse-elementor-addons' ),
			'slideshare'     => __( 'Slide Share', 'codexse-elementor-addons' ),
			'snapchat'       => __( 'Snapchat', 'codexse-elementor-addons' ),
			'soundcloud'     => __( 'SoundCloud', 'codexse-elementor-addons' ),
			'spotify'        => __( 'Spotify', 'codexse-elementor-addons' ),
			'stack-overflow' => __( 'StackOverflow', 'codexse-elementor-addons' ),
			'tripadvisor'    => __( 'TripAdvisor', 'codexse-elementor-addons' ),
			'tumblr'         => __( 'Tumblr', 'codexse-elementor-addons' ),
			'twitch'         => __( 'Twitch', 'codexse-elementor-addons' ),
			'twitter'        => __( 'Twitter', 'codexse-elementor-addons' ),
			'vimeo'          => __( 'Vimeo', 'codexse-elementor-addons' ),
			'vk'             => __( 'VK', 'codexse-elementor-addons' ),
			'website'        => __( 'Website', 'codexse-elementor-addons' ),
			'whatsapp'       => __( 'WhatsApp', 'codexse-elementor-addons' ),
			'wordpress'      => __( 'WordPress', 'codexse-elementor-addons' ),
			'xing'           => __( 'Xing', 'codexse-elementor-addons' ),
			'yelp'           => __( 'Yelp', 'codexse-elementor-addons' ),
			'youtube'        => __( 'YouTube', 'codexse-elementor-addons' ),
		];
	}

	/**
	 * Register widget content controls
	 */
	protected function register_content_controls() {
		$this->__info_content_controls();
		$this->__social_content_controls();
		$this->__details_content_controls();
		$this->__lightbox_content_controls();
	}

	protected function __info_content_controls() {

		$this->start_controls_section(
			'_section_info',
			[
				'label' => __( 'Information', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->start_controls_tabs( '_tabs_photo' );

		$this->start_controls_tab(
			'_tab_photo_normal',
			[
				'label' => __( 'Normal', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label'      => __( 'Photo', 'codexse-elementor-addons' ),
				'show_label' => false,
				'type'       => Controls_Manager::MEDIA,
				'default'    => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic'    => [
					'active' => true,
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tab_photo_hover',
			[
				'label' => __( 'Hover', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'image2',
			[
				'label'      => __( 'Photo 2', 'codexse-elementor-addons' ),
				'show_label' => false,
				'type'       => Controls_Manager::MEDIA,
				'dynamic'    => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'extra_hover_cls',
			[
				'label'        => __( 'Extra class added', 'codexse-elementor-addons' ),
				'type'         => Controls_Manager::HIDDEN,
				'default'      => 'on',
				'prefix_class' => 'cx-member-hover-image-',
				'condition'    => [
					'image2[url]!' => '',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'large',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => __( 'Name', 'codexse-elementor-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Codexse Member Name',
				'placeholder' => __( 'Type Member Name', 'codexse-elementor-addons' ),
				'separator'   => 'before',
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'job_title',
			[
				'label'       => __( 'Job Title', 'codexse-elementor-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Codexse Officer', 'codexse-elementor-addons' ),
				'placeholder' => __( 'Type Member Job Title', 'codexse-elementor-addons' ),
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'bio',
			[
				'label'       => __( 'Short Bio', 'codexse-elementor-addons' ),
				'description' => cx_get_allowed_html_desc( 'intermediate' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Write something amazing about the codexse member', 'codexse-elementor-addons' ),
				'rows'        => 5,
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'     => __( 'Title HTML Tag', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
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
				'default'   => 'h2',
				'toggle'    => false,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'     => __( 'Alignment', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'    => [
						'title' => __( 'Left', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => __( 'Center', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => __( 'Right', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justify', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function __social_content_controls() {

		$this->start_controls_section(
			'_section_social',
			[
				'label' => __( 'Social Profiles', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'name',
			[
				'label'          => __( 'Profile Name', 'codexse-elementor-addons' ),
				'type'           => Controls_Manager::SELECT2,
				'label_block'    => true,
				'select2options' => [
					'allowClear' => false,
				],
				'options'        => self::get_profile_names(),
			]
		);

		$repeater->add_control(
			'link', [
				'label'         => __( 'Profile Link', 'codexse-elementor-addons' ),
				'placeholder'   => __( 'Add your profile link', 'codexse-elementor-addons' ),
				'type'          => Controls_Manager::URL,
				'label_block'   => true,
				'autocomplete'  => false,
				'show_external' => false,
				'condition'     => [
					'name!' => ['email','phone'],
				],
				'dynamic'       => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'email', [
				'label'       => __( 'Email Address', 'codexse-elementor-addons' ),
				'placeholder' => __( 'Add your email address', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'input_type'  => 'email',
				'condition'   => [
					'name' => 'email',
				],
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'phone', [
				'label'       => __( 'Phone Number', 'codexse-elementor-addons' ),
				'placeholder' => __( 'Add your phone number', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'input_type'  => 'text',
				'condition'   => [
					'name' => 'phone',
				],
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'customize',
			[
				'label'          => __( 'Want To Customize?', 'codexse-elementor-addons' ),
				'type'           => Controls_Manager::SWITCHER,
				'label_on'       => __( 'Yes', 'codexse-elementor-addons' ),
				'label_off'      => __( 'No', 'codexse-elementor-addons' ),
				'return_value'   => 'yes',
				'style_transfer' => true,
			]
		);

		$repeater->start_controls_tabs(
			'_tab_icon_colors',
			[
				'condition' => ['customize' => 'yes'],
			]
		);
		$repeater->start_controls_tab(
			'_tab_icon_normal',
			[
				'label' => __( 'Normal', 'codexse-elementor-addons' ),
			]
		);

		$repeater->add_control(
			'color',
			[
				'label'          => __( 'Text Color', 'codexse-elementor-addons' ),
				'type'           => Controls_Manager::COLOR,
				'selectors'      => [
					'{{WRAPPER}} .cx-member-links > {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
				],
				'condition'      => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);

		$repeater->add_control(
			'bg_color',
			[
				'label'          => __( 'Background Color', 'codexse-elementor-addons' ),
				'type'           => Controls_Manager::COLOR,
				'selectors'      => [
					'{{WRAPPER}} .cx-member-links > {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
				],
				'condition'      => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);

		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'_tab_icon_hover',
			[
				'label' => __( 'Hover', 'codexse-elementor-addons' ),
			]
		);

		$repeater->add_control(
			'hover_color',
			[
				'label'          => __( 'Text Color', 'codexse-elementor-addons' ),
				'type'           => Controls_Manager::COLOR,
				'selectors'      => [
					'{{WRAPPER}} .cx-member-links > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .cx-member-links > {{CURRENT_ITEM}}:focus' => 'color: {{VALUE}}',
				],
				'condition'      => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);

		$repeater->add_control(
			'hover_bg_color',
			[
				'label'          => __( 'Background Color', 'codexse-elementor-addons' ),
				'type'           => Controls_Manager::COLOR,
				'selectors'      => [
					'{{WRAPPER}} .cx-member-links > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .cx-member-links > {{CURRENT_ITEM}}:focus' => 'background-color: {{VALUE}}',
				],
				'condition'      => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);

		$repeater->add_control(
			'hover_border_color',
			[
				'label'          => __( 'Border Color', 'codexse-elementor-addons' ),
				'type'           => Controls_Manager::COLOR,
				'selectors'      => [
					'{{WRAPPER}} .cx-member-links > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .cx-member-links > {{CURRENT_ITEM}}:focus' => 'border-color: {{VALUE}}',
				],
				'condition'      => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);

		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();

		$this->add_control(
			'profiles',
			[
				'show_label'  => false,
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '<# print(name.slice(0,1).toUpperCase() + name.slice(1)) #>',
				'default'     => [
					[
						'link' => ['url' => 'https://facebook.com/'],
						'name' => 'facebook',
					],
					[
						'link' => ['url' => 'https://twitter.com/'],
						'name' => 'twitter',
					],
					[
						'link' => ['url' => 'https://linkedin.com/'],
						'name' => 'linkedin',
					],
				],
			]
		);

		$this->add_control(
			'show_profiles',
			[
				'label'          => __( 'Show Profiles', 'codexse-elementor-addons' ),
				'type'           => Controls_Manager::SWITCHER,
				'label_on'       => __( 'Show', 'codexse-elementor-addons' ),
				'label_off'      => __( 'Hide', 'codexse-elementor-addons' ),
				'return_value'   => 'yes',
				'default'        => 'yes',
				'separator'      => 'before',
				'style_transfer' => true,
			]
		);

		$this->end_controls_section();
	}

	protected function __details_content_controls() {

		$this->start_controls_section(
			'_section_button',
			[
				'label' => __( 'Details Button', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_details_button',
			[
				'label'          => __( 'Show Button', 'codexse-elementor-addons' ),
				'type'           => Controls_Manager::SWITCHER,
				'label_on'       => __( 'Show', 'codexse-elementor-addons' ),
				'label_off'      => __( 'Hide', 'codexse-elementor-addons' ),
				'return_value'   => 'yes',
				'default'        => '',
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'show_lightbox',
			[
				'label'          => __( 'Show Lightbox', 'codexse-elementor-addons' ),
				'type'           => Controls_Manager::SWITCHER,
				'label_on'       => __( 'Show', 'codexse-elementor-addons' ),
				'label_off'      => __( 'Hide', 'codexse-elementor-addons' ),
				'return_value'   => 'yes',
				'default'        => '',
				'style_transfer' => true,
				'condition'      => [
					'show_details_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'button_position',
			[
				'label'          => __( 'Position', 'codexse-elementor-addons' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => 'after',
				'style_transfer' => true,
				'options'        => [
					'before' => __( 'Before Social Icons', 'codexse-elementor-addons' ),
					'after'  => __( 'After Social Icons', 'codexse-elementor-addons' ),
				],
				'condition'      => [
					'show_details_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'       => __( 'Text', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Show Details', 'codexse-elementor-addons' ),
				'placeholder' => __( 'Type button text here', 'codexse-elementor-addons' ),
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
				'condition'   => [
					'show_details_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'button_link',
			[
				'label'       => __( 'Link', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://example.com',
				'dynamic'     => [
					'active' => true,
				],
				'default'     => [
					'url' => '#',
				],
				'condition'   => [
					'show_details_button' => 'yes',
					'show_lightbox!'      => 'yes',
				],
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label'       => __( 'Icon', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => false,
				'show_label'  => true,
				'skin'        => 'inline',
				'condition'   => [
					'show_details_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'button_icon_position',
			[
				'label'          => __( 'Icon Position', 'codexse-elementor-addons' ),
				'type'           => Controls_Manager::CHOOSE,
				'label_block'    => false,
				'options'        => [
					'before' => [
						'title' => __( 'Before', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-h-align-left',
					],
					'after'  => [
						'title' => __( 'After', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'        => 'after',
				'toggle'         => false,
				'style_transfer' => true,
				'condition'      => [
					'show_details_button' => 'yes',
					'button_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'button_icon_spacing',
			[
				'label'     => __( 'Icon Spacing', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 10,
				],
				'condition' => [
					'show_details_button' => 'yes',
					'button_icon[value]!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .cx-btn--icon-before .cx-btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cx-btn--icon-after .cx-btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function __lightbox_content_controls() {

		$this->start_controls_section(
			'_section_lightbox',
			[
				'label'     => __( 'Lightbox', 'codexse-elementor-addons' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'show_details_button' => 'yes',
					'show_lightbox'       => 'yes',
				],
			]
		);

		$this->add_control(
			'saved_template_list',
			[
				'label'       => __( 'Content Source', 'codexse-elementor-addons' ),
				'description' => __( 'Select a saveed section to show in popup window.', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => $this->get_saved_content( ['page', 'section'] ),
				'default'     => '0',
			]
		);

		$this->add_control(
			'show_lightbox_preview',
			[
				'label'        => __( 'Show Lightbox Preview', 'codexse-elementor-addons' ),
				'description'  => __( 'This option only works on edit mode.', 'codexse-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'codexse-elementor-addons' ),
				'label_off'    => __( 'Hide', 'codexse-elementor-addons' ),
				'return_value' => 'yes',
				// 'style_transfer' => true,
				'default'      => '',

			]
		);

		$this->add_control(
			'close_position',
			[
				'label'                => __( 'Close Icon Position', 'codexse-elementor-addons' ),
				'type'                 => Controls_Manager::SELECT,
				'options'              => [
					'top-left'  => __( 'Top Left', 'codexse-elementor-addons' ),
					'top-right' => __( 'Top Right', 'codexse-elementor-addons' ),
				],
				'default'              => 'top-right',
				'selectors_dictionary' => [
					'top-left'  => 'top:0; left:0;',
					'top-right' => 'top:0; right:0;',
				],
				'selectors'            => [
					'{{WRAPPER}} .cx-member-lightbox.cx-member-lightbox-show .cx-member-lightbox-close' => '{{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register widget style controls
	 */
	protected function register_style_controls() {
		$this->__photo_style_controls();
		$this->__body_content_style_controls();
		$this->__social_style_controls();
		$this->__details_style_controls();
		$this->__lightbox_style_controls();
	}

	protected function __photo_style_controls() {

		$this->start_controls_section(
			'_section_style_image',
			[
				'label' => __( 'Photo', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label'      => __( 'Width', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%'],
				'range'      => [
					'%'  => [
						'min' => 20,
						'max' => 100,
					],
					'px' => [
						'min' => 100,
						'max' => 700,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .cx-member-figure' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'label'      => __( 'Height', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 100,
						'max' => 700,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .cx-member-figure' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_spacing',
			[
				'label'      => __( 'Bottom Spacing', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .cx-member-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'image_padding',
			[
				'label'      => __( 'Padding', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cx-member-figure img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'image_border',
				'selector' => '{{WRAPPER}} .cx-member-figure img',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label'      => __( 'Border Radius', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cx-member-figure img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'image_box_shadow',
				'exclude'  => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .cx-member-figure img',
			]
		);

		$this->add_control(
			'image_bg_color',
			[
				'label'     => __( 'Background Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-member-figure img' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->start_controls_tabs(
			'_tabs_img_effects', [
				'condition' => [
					'image2[url]' => '',
				],
			]
		);

		$this->start_controls_tab(
			'_tab_img_effects_normal',
			[
				'label' => __( 'Normal', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'img_opacity',
			[
				'label'     => __( 'Opacity', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cx-member-figure img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'img_css_filters',
				'selector' => '{{WRAPPER}} .cx-member-figure img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tab_img_effects_hover',
			[
				'label' => __( 'Hover', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'img_hover_opacity',
			[
				'label'     => __( 'Opacity', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cx-member-figure:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'img_hover_css_filters',
				'selector' => '{{WRAPPER}} .cx-member-figure:hover img',
			]
		);

		$this->add_control(
			'img_hover_transition',
			[
				'label'     => __( 'Transition Duration', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max'  => 3,
						'step' => 0.1,
					],
				],
				'default'   => [
					'size' => .2,
				],
				'selectors' => [
					'{{WRAPPER}} .cx-member-figure img' => 'transition-duration: {{SIZE}}s;',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function __body_content_style_controls() {

		$this->start_controls_section(
			'_section_style_content',
			[
				'label' => __( 'Name, Job Title & Bio', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => __( 'Content Padding', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cx-member-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'_heading_title',
			[
				'type'      => Controls_Manager::HEADING,
				'label'     => __( 'Name', 'codexse-elementor-addons' ),
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label'      => __( 'Bottom Spacing', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .cx-member-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Text Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-member-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .cx-member-name',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .cx-member-name',
			]
		);

		$this->add_control(
			'_heading_job_title',
			[
				'type'      => Controls_Manager::HEADING,
				'label'     => __( 'Job Title', 'codexse-elementor-addons' ),
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'job_title_spacing',
			[
				'label'      => __( 'Bottom Spacing', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .cx-member-position' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'job_title_color',
			[
				'label'     => __( 'Text Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-member-position' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'job_title_typography',
				'selector' => '{{WRAPPER}} .cx-member-position',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'job_title_text_shadow',
				'selector' => '{{WRAPPER}} .cx-member-position',
			]
		);

		$this->add_control(
			'_heading_bio',
			[
				'type'      => Controls_Manager::HEADING,
				'label'     => __( 'Short Bio', 'codexse-elementor-addons' ),
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'bio_spacing',
			[
				'label'      => __( 'Bottom Spacing', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .cx-member-bio' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'bio_color',
			[
				'label'     => __( 'Text Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-member-bio' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'bio_typography',
				'selector' => '{{WRAPPER}} .cx-member-bio',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'bio_text_shadow',
				'selector' => '{{WRAPPER}} .cx-member-bio',
			]
		);

		$this->end_controls_section();
	}

	protected function __social_style_controls() {

		$this->start_controls_section(
			'_section_style_social',
			[
				'label' => __( 'Social Icons', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'links_spacing',
			[
				'label'      => __( 'Right Spacing', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .cx-member-links > a:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'links_padding',
			[
				'label'      => __( 'Padding', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .cx-member-links > a' => 'padding: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'links_icon_size',
			[
				'label'      => __( 'Icon Size', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .cx-member-links > a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'links_border',
				'selector' => '{{WRAPPER}} .cx-member-links > a',
			]
		);

		$this->add_responsive_control(
			'links_border_radius',
			[
				'label'      => __( 'Border Radius', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cx-member-links > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( '_tab_links_colors' );
		$this->start_controls_tab(
			'_tab_links_normal',
			[
				'label' => __( 'Normal', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'links_color',
			[
				'label'     => __( 'Text Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-member-links > a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'links_bg_color',
			[
				'label'     => __( 'Background Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-member-links > a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'_tab_links_hover',
			[
				'label' => __( 'Hover', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'links_hover_color',
			[
				'label'     => __( 'Text Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-member-links > a:hover, {{WRAPPER}} .cx-member-links > a:focus' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'links_hover_bg_color',
			[
				'label'     => __( 'Background Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-member-links > a:hover, {{WRAPPER}} .cx-member-links > a:focus' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'links_hover_border_color',
			[
				'label'     => __( 'Border Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-member-links > a:hover, {{WRAPPER}} .cx-member-links > a:focus' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'links_border_border!' => '',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function __details_style_controls() {

		$this->start_controls_section(
			'_section_style_button',
			[
				'label' => __( 'Details Button', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'button_margin',
			[
				'label'      => __( 'Margin', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cx-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => __( 'Padding', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cx-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .cx-btn',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'button_border',
				'selector' => '{{WRAPPER}} .cx-btn',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'      => __( 'Border Radius', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cx-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .cx-btn',
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
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .cx-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label'     => __( 'Background Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-btn' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .cx-btn:hover, {{WRAPPER}} .cx-btn:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_bg_color',
			[
				'label'     => __( 'Background Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-btn:hover, {{WRAPPER}} .cx-btn:focus' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .cx-btn:hover, {{WRAPPER}} .cx-btn:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function __lightbox_style_controls() {

		$this->start_controls_section(
			'_section_style_lightbox',
			[
				'label'     => __( 'LightBox', 'codexse-elementor-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_details_button' => 'yes',
					'show_lightbox'       => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'lightbox_padding',
			[
				'label'      => __( 'Padding', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cx-member-lightbox.cx-member-lightbox-show' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'lightbox_background',
				'selector' => '{{WRAPPER}} .cx-member-lightbox.cx-member-lightbox-show',
			]
		);

		$this->add_control(
			'close_button_heading',
			[
				'label'     => __( 'Close Button', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'close_button_border',
				'selector' => '{{WRAPPER}} .cx-member-lightbox-close',
			]
		);

		$this->add_control(
			'close_button_border_radius',
			[
				'label'      => __( 'Border Radius', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cx-member-lightbox-close' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'close_button_box_shadow',
				'selector' => '{{WRAPPER}} .cx-member-lightbox-close',
			]
		);

		$this->add_responsive_control(
			'close_icon_size',
			[
				'label'      => __( 'Size', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 2,
						'max' => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .cx-member-lightbox-close' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( '_tabs_close_button' );
		$this->start_controls_tab(
			'_tab_close_button_normal',
			[
				'label' => __( 'Normal', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'close_button_color',
			[
				'label'     => __( 'Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-member-lightbox-close' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'close_button_bg_color',
			[
				'label'     => __( 'Background Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-member-lightbox-close' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tab_close_button_hover',
			[
				'label' => __( 'Hover', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'close_button_hover_color',
			[
				'label'     => __( 'Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-member-lightbox-close:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'close_button_hover_bg_color',
			[
				'label'     => __( 'Background Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-member-lightbox-close:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'close_button_hover_border_color',
			[
				'label'     => __( 'Border Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'close_button_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} ..cx-member-lightbox-close:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function get_post_template( $term = 'page' ) {
		$posts = get_posts(
			[
				'post_type'      => 'elementor_library',
				'orderby'        => 'title',
				'order'          => 'ASC',
				'posts_per_page' => '-1',
				'tax_query'      => [
					[
						'taxonomy' => 'elementor_library_type',
						'field'    => 'slug',
						'terms'    => $term,
					],
				],
			]
		);

		$templates = [];
		foreach ( $posts as $post ) {
			$templates[] = [
				'id'   => $post->ID,
				'name' => $post->post_title,
			];
		}
		return $templates;
	}

	protected function get_saved_content( $term = 'section' ) {
		$saved_contents = $this->get_post_template( $term );

		if ( count( $saved_contents ) > 0 ) {
			$options['0'] = __( 'None', 'codexse-elementor-addons' );
			foreach ( $saved_contents as $saved_content ) {
				$content_id             = $saved_content['id'];
				$options[ $content_id ] = $saved_content['name'];
			}
		} else {
			$options['no_template'] = __( 'Nothing Found', 'codexse-elementor-addons' );
		}
		return $options;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$button_position = ! empty( $settings['button_position'] ) ? $settings['button_position'] : 'after';

		$show_button = false;
		if ( ! empty( $settings['show_details_button'] ) && $settings['show_details_button'] === 'yes' ) {
			$show_button = true;
		}

		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_render_attribute( 'title', 'class', 'cx-member-name' );

		$this->add_inline_editing_attributes( 'job_title', 'basic' );
		$this->add_render_attribute( 'job_title', 'class', 'cx-member-position' );

		$this->add_inline_editing_attributes( 'bio', 'intermediate' );
		$this->add_render_attribute( 'bio', 'class', 'cx-member-bio' );
		?>

		<?php if ( $settings['image']['url'] || $settings['image']['id'] ) :
			$settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
			?>
			<figure class="cx-member-figure">
				<?php
					echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );
				if ( $settings['image2']['url'] || $settings['image2']['id'] ) {
					echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image2' );
				}
				?>
			</figure>
		<?php endif; ?>

		<div class="cx-member-body">
			<?php if ( $settings['title'] ) :
				printf( '<%1$s %2$s>%3$s</%1$s>',
					cx_escape_tags( $settings['title_tag'], 'h2' ),
					$this->get_render_attribute_string( 'title' ),
					cx_kses_basic( $settings['title'] )
				);
			endif; ?>

			<?php if ( $settings['job_title'] ) : ?>
				<div <?php $this->print_render_attribute_string( 'job_title' ); ?>><?php echo cx_kses_basic( $settings['job_title'] ); ?></div>
			<?php endif; ?>

			<?php if ( $settings['bio'] ) : ?>
				<div <?php $this->print_render_attribute_string( 'bio' ); ?>>
					<p><?php echo cx_kses_intermediate( $settings['bio'] ); ?></p>
				</div>
			<?php endif; ?>

			<?php
			if ( $show_button && $button_position === 'before' ) {
				$this->render_icon_button( [ 'new_icon' => 'button_icon', 'old_icon' => '' ] );
			}
			?>

			<?php if ( $settings['show_profiles'] && is_array( $settings['profiles'] ) ) : ?>
				<div class="cx-member-links">
					<?php
					foreach ( $settings['profiles'] as $profile ) :
						$icon = $profile['name'];
						$url  = isset( $profile['link']['url'] ) ? $profile['link']['url'] : '';

						if ( 'website' === $profile['name'] ) {
							$icon = 'globe far';
						} elseif ( 'email' === $profile['name'] ) {
							$icon = 'envelope far';
							$url  = 'mailto:' . antispambot( $profile['email'] );
						} elseif ( 'phone' === $profile['name'] ) {
							$icon = 'phone-alt fas';
							$url  = 'tel:' . esc_html( $profile['phone'] );
						} else {
							$icon .= ' fab';
						}

						printf( '<a target="_blank" rel="noopener" href="%s" class="elementor-repeater-item-%s"><i class="fa fa-%s" aria-hidden="true"></i></a>',
							esc_url( $url ),
							esc_attr( $profile['_id'] ),
							esc_attr( $icon )
						);
					endforeach; ?>
				</div>
			<?php endif; ?>

			<?php
			if ( $show_button && $button_position === 'after' ) {
				$this->render_icon_button( [ 'new_icon' => 'button_icon', 'old_icon' => '' ] );
			}
			?>
		</div>
		<?php
		// render lightbox
		$this->render_lightbox();
	}

	protected function render_lightbox() {
		$settings = $this->get_settings_for_display();
		$template = false;
		if ( ! empty( $settings['saved_template_list'] ) && '0' != $settings['saved_template_list'] && 'no_template' != $settings['saved_template_list'] ) {
			$template = true;
		}
		if ( $settings['show_lightbox'] && 'yes' === $settings['show_lightbox'] && $template ) :
			$this->add_render_attribute( 'lightbox', 'class', 'cx-member-lightbox' );
			if ( $settings['show_lightbox_preview'] == 'yes' && cx_elementor()->editor->is_edit_mode() ) {
				$this->add_render_attribute( 'lightbox', 'class', 'cx-member-lightbox-show' );
			}
			?>
				<div <?php $this->print_render_attribute_string( 'lightbox' ); ?>>
					<div class="cx-member-lightbox-close"><i aria-hidden="true" class="eicon-editor-close"></i></div>
					<div class="cx-member-lightbox-inner">
						<?php echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $settings['saved_template_list'] ); ?>
					</div>
				</div>
			<?php
		endif;
	}
}
