<?php

/**
 * Social Share widget class
 *
 * @package Codexse_Addons
 */

namespace Codexse_Addons\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Social_Share extends Base {

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_title () {
		return __( 'Social Share', 'codexse-elementor-addons' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_icon () {
		return 'cx cx-share';
	}

	public function get_keywords () {
		return [ 'social', 'share', 'facebook', 'twitter', 'instagram', 'linkedin' ];
	}

	/**
	 * Register widget content controls
	 */
	protected function register_content_controls () {

		$this->start_controls_section(
			'_section_content',
			[
				'label' => __( 'Buttons', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'share_network',
			[
				'label'   => __( 'Network', 'codexse-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'facebook'    => __( 'Facebook', 'codexse-elementor-addons' ),
					'twitter'     => __( 'Twitter', 'codexse-elementor-addons' ),
					'linkedin'    => __( 'Linkedin', 'codexse-elementor-addons' ),
					'email'       => __( 'Email', 'codexse-elementor-addons' ),
					'whatsapp'    => __( 'Whatsapp', 'codexse-elementor-addons' ),
					'telegram'    => __( 'Telegram', 'codexse-elementor-addons' ),
					'viber'       => __( 'Viber', 'codexse-elementor-addons' ),
					'pinterest'   => __( 'Pinterest', 'codexse-elementor-addons' ),
					'tumblr'      => __( 'Tumblr', 'codexse-elementor-addons' ),
					'reddit'      => __( 'Reddit', 'codexse-elementor-addons' ),
					'vk'          => __( 'VK', 'codexse-elementor-addons' ),
					'xing'        => __( 'Xing', 'codexse-elementor-addons' ),
					'get-pocket'  => __( 'Get Pocket', 'codexse-elementor-addons' ),
					'digg'        => __( 'Digg', 'codexse-elementor-addons' ),
					'stumbleupon' => __( 'StumbleUpon', 'codexse-elementor-addons' ),
					'weibo'       => __( 'Weibo', 'codexse-elementor-addons' ),
					'renren'      => __( 'Renren', 'codexse-elementor-addons' ),
					'skype'       => __( 'Skype', 'codexse-elementor-addons' ),
				],
				'default' => 'facebook',
			]
		);

		$repeater->add_control(
			'custom_link',
			[
				'label'       => __( 'Custom Link', 'codexse-elementor-addons' ),
				'placeholder' => __( 'https://your-share-link.com', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'hashtags',
			[
				'label'       => __( 'Hashtags', 'codexse-elementor-addons' ),
				'description' => __( 'Write hashtags without # sign and with comma separated value', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'      => 2,
				'dynamic'     => [
					'active' => true,
				],
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'share_network',
							'operator' => '!==',
							'value' => 'facebook',
						],
						[
							'name' => 'share_network',
							'operator' => '!==',
							'value' => 'linkedin',
						],
						[
							'name' => 'share_network',
							'operator' => '!==',
							'value' => 'whatsapp',
						],
						[
							'name' => 'share_network',
							'operator' => '!==',
							'value' => 'reddit',
						],
						[
							'name' => 'share_network',
							'operator' => '!==',
							'value' => 'skype',
						],
						[
							'name' => 'share_network',
							'operator' => '!==',
							'value' => 'pinterest',
						],
						[
							'name' => 'share_network',
							'operator' => '!==',
							'value' => 'email',
						],
					]
				]
			]
		);

		$repeater->add_control(
			'share_title',
			[
				'label'     => __( 'Custom Title', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::TEXTAREA,
				'rows'      => 2,
				'dynamic'   => [
					'active' => true,
				],
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'share_network',
							'operator' => '!==',
							'value' => 'facebook',
						],
						[
							'name' => 'share_network',
							'operator' => '!==',
							'value' => 'linkedin',
						],
						[
							'name' => 'share_network',
							'operator' => '!==',
							'value' => 'reddit',
						],
						[
							'name' => 'share_network',
							'operator' => '!==',
							'value' => 'skype',
						],
						[
							'name' => 'share_network',
							'operator' => '!==',
							'value' => 'pinterest',
						],
					]
				]
			]
		);

		$repeater->add_control(
			'email_to',
			[
				'label'     => __( 'To', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::TEXT,
				'label_block' => true,
				'condition' => [
					'share_network' => 'email',
				]
			]
		);

		$repeater->add_control(
			'email_subject',
			[
				'label'     => __( 'Subject', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::TEXT,
				'label_block' => true,
				'condition' => [
					'share_network' => 'email',
				]
			]
		);

		$repeater->add_control(
			'twitter_handle',
			[
				'label'     => __( 'Twitter Handle', 'codexse-elementor-addons' ),
				'description' => __( 'Write without @ sign.', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::TEXT,
				'condition' => [
					'share_network' => 'twitter',
				]
			]
		);

		$repeater->add_control(
			'image',
			[
				'type' => Controls_Manager::MEDIA,
				'label' => __( 'Custom Image', 'codexse-elementor-addons' ),
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'share_network' => 'pinterest'
				]
			]
		);

		$repeater->add_control(
			'share_text',
			[
				'label'       => __( 'Button Text', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Share on Facebook', 'codexse-elementor-addons' ),
				'dynamic'     => [
					'active' => true,
				]
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
				'separator'      => 'before'
			]
		);

		$repeater->start_controls_tabs(
			'_tab_share_colors',
			[
				'condition' => [ 'customize' => 'yes' ]
			]
		);

		$repeater->start_controls_tab(
			'_tab_normal',
			[
				'label' => __( 'Normal', 'codexse-elementor-addons' ),
			]
		);

		$repeater->add_control(
			'single_color',
			[
				'label' => __( 'Color', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
				'condition'      => [
					'customize' => 'yes'
				],
				'selectors'      => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .cx-share-network' => 'color: {{VALUE}};',
					'{{WRAPPER}} .cx-share-icon-and-text > {{CURRENT_ITEM}} .cx-share-label' => 'border-color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'single_bg_color',
			[
				'label' => __( 'Background Color', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
				'condition'      => [
					'customize' => 'yes'
				],
				'selectors'      => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .cx-share-network' => 'background-color: {{VALUE}};',
				]
			]
		);

		$repeater->add_control(
			'single_border_color',
			[
				'label'          => __( 'Border Color', 'codexse-elementor-addons' ),
				'type'           => Controls_Manager::COLOR,
				'condition'      => [
					'customize' => 'yes'
				],
				'selectors'      => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .cx-share-network' => 'border-color: {{VALUE}};',
				]
			]
		);

		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'_tab_hover',
			[
				'label' => __( 'Hover', 'codexse-elementor-addons' ),
			]
		);

		$repeater->add_control(
			'signle_hover_color',
			[
				'label'          => __( 'Color', 'codexse-elementor-addons' ),
				'type'           => Controls_Manager::COLOR,
				'condition'      => [
					'customize' => 'yes'
				],
				'selectors'      => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .cx-share-network:hover' => 'color: {{VALUE}};'
				]
			]
		);

		$repeater->add_control(
			'single_hover_bg_color',
			[
				'label'          => __( 'Background Color', 'codexse-elementor-addons' ),
				'type'           => Controls_Manager::COLOR,
				'condition'      => [
					'customize' => 'yes'
				],
				'selectors'      => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .cx-share-network:hover' => 'background-color: {{VALUE}};',
				]
			]
		);

		$repeater->add_control(
			'single_hover_border_color',
			[
				'label'          => __( 'Border Color', 'codexse-elementor-addons' ),
				'type'           => Controls_Manager::COLOR,
				'condition'      => [
					'customize' => 'yes'
				],
				'selectors'      => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .cx-share-network:hover' => 'border-color: {{VALUE}};',
				]
			]
		);

		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();

		$this->add_control(
			'icon_list',
			[
				'label'       => __( 'Share Icons', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{ share_network }}',
				'default'     => [
					[
						'share_icon'    => [
							'value'   => 'fab fa-facebook',
							'library' => 'fa-brands',
						],
						'share_network' => 'facebook',
					],
					[
						'share_icon'    => [
							'value'   => 'fab fa-twitter',
							'library' => 'fa-brands',
						],
						'share_network' => 'twitter',
					],
					[
						'share_icon'    => [
							'value'   => 'fab fa-linkedin',
							'library' => 'fa-brands',
						],
						'share_network' => 'linkedin',
					],
				]
			]
		);

		$this->add_control(
			'network_view',
			[
				'label'     => __( 'View', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'separator' => 'before',
				'default'   => 'icon_and_text',
				'options'   => [
					'icon_and_text' => __( 'Icon and Text', 'codexse-elementor-addons' ),
					'icon_only'     => __( 'Icon', 'codexse-elementor-addons' ),
					'text_only'     => __( 'Text', 'codexse-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'separator_show',
			[
				'label'          => __( 'Separator', 'codexse-elementor-addons' ),
				'type'           => Controls_Manager::SWITCHER,
				'label_on'       => __( 'Yes', 'codexse-elementor-addons' ),
				'label_off'      => __( 'No', 'codexse-elementor-addons' ),
				'return_value'   => 'yes',
				'default'      => 'yes',
				'prefix_class' => 'cx-separator-',
				'condition' => [
					'network_view' => 'icon_and_text'
				]
			]
		);

		$this->add_responsive_control(
			'display',
			[
				'label'       => __( 'Display', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => [
					'inline-block'   => [
						'title' => __( 'Inline', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-ellipsis-h',
					],
					'block' => [
						'title' => __( 'Block', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-ellipsis-v',
					]
				],
				'desktop_default' => 'inline-block',
				'tablet_default' => 'inline-block',
				'mobile_default' => 'block',
				'toggle' => false,
				// 'prefix_class' => 'cx-display-',
				'selectors'   => [
					'{{WRAPPER}} .cx-share-button' => 'display: {{VALUE}};'
				],
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label'       => __( 'Alignment', 'codexse-elementor-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => [
					'left'   => [
						'title' => __( 'Left', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'     => 'center',
				'selectors'   => [
					'{{WRAPPER}} .cx-share-buttons' => 'text-align: {{VALUE}};'
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register widget style controls
	 */
	protected function register_style_controls () {

		$this->start_controls_section(
			'_section_button_style',
			[
				'label' => __( 'Button', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'          => __( 'Padding', 'codexse-elementor-addons' ),
				'type'           => Controls_Manager::DIMENSIONS,
				'size_units'     => [ 'px', '%' ],
				'selectors'      => [
					'{{WRAPPER}} .cx-share-network' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'button_spacing',
			[
				'label'     => __( 'Spacing', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .cx-share-button:not(:last-child)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label'      => __( 'Border Radius', 'codexse-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cx-share-network' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'button_border',
				'selector'  => '{{WRAPPER}} .cx-share-network',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .cx-share-network',
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'     => __( 'Icon Size', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'separator' => 'before',
				'range'     => [
					'px' => [
						'min' => 5,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cx-share-network' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label'          => __( 'Icon Right Spacing', 'codexse-elementor-addons' ),
				'type'           => Controls_Manager::SLIDER,
				'selectors'      => [
					'{{WRAPPER}} .cx-share-network i' => 'margin-right: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'separator_spacing',
			[
				'label'          => __( 'Separator Right Spacing', 'codexse-elementor-addons' ),
				'type'           => Controls_Manager::SLIDER,
				'selectors'      => [
					'{{WRAPPER}} .cx-share-label' => 'padding-left: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'label'    => __( 'Typography', 'codexse-elementor-addons' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .cx-share-network .cx-share-label'
			]
		);

		$this->start_controls_tabs( '_tab_icons_colors' );

		$this->start_controls_tab(
			'_tab_normal_color',
			[
				'label' => __( 'Normal', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'color',
			[
				'label' => __( 'Color', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,

				'selectors'      => [
					'{{WRAPPER}} .cx-share-network ' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __( 'Background Color', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
				'selectors'      => [
					'{{WRAPPER}} .cx-share-network' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'separator_color',
			[
				'label' => __( 'Separator Color', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
				'selectors'      => [
					'{{WRAPPER}} .cx-share-label' => 'border-color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'_tab_common_hover',
			[
				'label' => __( 'Hover', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'common_hover_color',
			[
				'label'          => __( 'Color', 'codexse-elementor-addons' ),
				'type'           => Controls_Manager::COLOR,
				'selectors'      => [
					'{{WRAPPER}} .cx-share-network:hover' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'common_hover_bg_color',
			[
				'label'          => __( 'Background Color', 'codexse-elementor-addons' ),
				'type'           => Controls_Manager::COLOR,
				'selectors'      => [
					'{{WRAPPER}} .cx-share-network:hover' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'common_hover_border_color',
			[
				'label'     => __( 'Border Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-share-network:hover' => 'border-color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'separator_hover_color',
			[
				'label' => __( 'Separator Color', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
				'selectors'      => [
					'{{WRAPPER}} .cx-share-network:hover .cx-share-label' => 'border-color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render () {
		$settings = $this->get_settings_for_display();
		$social_icons = $settings['icon_list'];
		$network_view = $settings['network_view'];

		// print_r($settings);
		?>
		<ul class="cx-share-buttons">
			<?php
			foreach ( $social_icons as $icon ) :
				$social_media_name  = $icon['share_network'];
				$custom_share_title = esc_html( $icon['share_title'] );
				$share_text         = esc_html( $icon['share_text'] );
				$default_share_text = ucfirst( $social_media_name );
				$image = isset($icon['image']['url'])? $icon['image']['url']: '';
				$twitter_handle = $icon['twitter_handle'];
				$email_to = $icon['email_to'];
				$email_subject = $icon['email_subject'];

				$share_on_text = $share_text ? $share_text : $default_share_text;

				$hashtags = $icon['hashtags'];
				$url = get_the_permalink();

				$custom_share_url = $icon['custom_link']['url'];
				$share_url        = $custom_share_url ? $custom_share_url : $url;

				$this->set_render_attribute( 'list_classes', 'class', [
					'cx-share-button',
					'elementor-repeater-item-' . $icon['_id']
				] );

				$this->set_render_attribute( 'link_classes', 'class', [
					'sharer',
					'cx-share-network',
					'elementor-social-icon-' . esc_attr( $social_media_name ),
				] );

				$this->set_render_attribute( 'link_classes', 'data-sharer', esc_attr( $social_media_name ) );
				$this->set_render_attribute( 'link_classes', 'data-url', $share_url );
				$this->set_render_attribute( 'link_classes', 'data-hashtags', $hashtags ? esc_html( $hashtags ) : '' );
				$this->set_render_attribute( 'link_classes', 'data-title', $custom_share_title );
				$this->set_render_attribute( 'link_classes', 'data-image', esc_url( $image ) );
				$this->set_render_attribute( 'link_classes', 'data-to', esc_attr( $email_to ) );
				$this->set_render_attribute( 'link_classes', 'data-subject', esc_attr( $email_subject ) );
				?>
				<li <?php $this->print_render_attribute_string( 'list_classes' ); ?>>
					<a <?php $this->print_render_attribute_string( 'link_classes' ); ?>>
						<?php
						$social_media_name = $social_media_name == 'email' ? 'envelope' : $social_media_name;
						$ico_library = $social_media_name == 'envelope' ? 'fa' : 'fab';
						
						if ( 'icon_and_text' == $network_view ) {
							?>
							<i class="<?=$ico_library?> fa-<?php echo esc_attr( $social_media_name ); ?>" aria-hidden="true"></i>
							<?php
							if ( ! empty( $share_on_text ) && '' != $share_on_text ) {
								printf( "<span class='cx-share-label'>%s</span>", $share_on_text );
							}
						}
						if ( 'icon_only' == $network_view ) {
							?>
							<i class="<?=$ico_library?> fa-<?php echo esc_attr( $social_media_name ); ?>" aria-hidden="true"></i>
							<?php
						}
						if ( 'text_only' == $network_view ) {
							if ( ! empty( $share_on_text ) && '' != $share_on_text ) {
								printf( "<span class='cx-share-label'>%s</span>", $share_on_text );
							}
						}
						?>
					</a>
				</li>
				<?php
			endforeach;
			?>

		</ul>
		<?php

	}

	}
