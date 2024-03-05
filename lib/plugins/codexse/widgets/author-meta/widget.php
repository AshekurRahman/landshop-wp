<?php
/**
 * Author Meta widget class
 *
 * @package Codexse_Addons
 */
namespace Codexse_Addons\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

defined( 'ABSPATH' ) || die();

class Author_Meta extends Base {

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Author Meta', 'codexse-elementor-addons' );
	}

	public function get_custom_help_url() {
		return 'https://codexseaddons.com/docs/codexse-addons-for-elementor/widgets/post-title/';
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
		return 'cx cx-tb-author-meta';
	}

	public function get_keywords() {
		return [ 'author', 'author_meta', 'author info' ];
	}

	/**
     * Register widget content controls
     */
	protected function register_content_controls() {
		$this->__author_content_controls();

	}

	protected function __author_content_controls() {
		$this->start_controls_section(
			'_section_author_meta',
			[
				'label' => __( 'Author Meta', 'codexse-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_author',
			[
				'label'        => __( 'Show Author Name', 'codexse-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			]
		);


		$this->add_control(
			'author_meta_tag',
			[
				'label' => __( 'Author Name Tag', 'codexse-elementor-addons' ),
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
				'default' => 'h4',
				'toggle' => false,
				'condition'=>[
					'show_author' => 'yes',
				]
			]
		);

		$this->add_control(
			'show_avatar',
			[
				'label'        => __( 'Show Avatar', 'codexse-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'show_bio',
			[
				'label'        => __( 'Show Short Bio', 'codexse-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'show_archive_btn',
			[
				'label'        => __( 'Show Archive Button', 'codexse-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'author_link_to',
			[
				'label' => __( 'Link', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::SELECT,
				'options' => [
					''              => __( 'None', 'codexse-elementor-addons' ),
					'website'       => __( 'Website', 'codexse-elementor-addons' ),
					'admin_archive' => __( 'Admin Posts', 'codexse-elementor-addons' ),
				],
				'description'       => __( 'Link for the Author Name and Image', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'avatar_size',
			[
				'label' => __( 'Avatar Size', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 500,
				'step' => 1,
				'default' => 96,
			]
		);

		$this->add_control(
			'avatar_image_position',
			[
				'label'   => __( 'Avatar Image Position', 'codexse-elementor-addons' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-h-align-right',
					],
					'top' => [
						'title' => __( 'Top', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'default'     => 'left',
			]
		);

        $this->end_controls_section();
	}

	/**
	 * Register styles related controls
	 */
	protected function register_style_controls() {
		$this->__author_style_controls();
		$this->__avatar_style_controls();
		$this->__author_short_bio_controls();
		$this->__author_button_style_controls();
	}


	protected function __author_style_controls() {

        $this->start_controls_section(
            '_section_style_text',
            [
                'label' => __( 'Author Name', 'codexse-elementor-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'author_color',
			[
				'label' => esc_html__( 'Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-author-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'author_typography',
				'label' => __( 'Typography', 'codexse-elementor-addons' ),
				'selector' => '{{WRAPPER}} .cx-author-title',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'author_text_shadow',
				'selector' => '{{WRAPPER}} .cx-author-title',
			]
		);


        $this->end_controls_section();
	}

	protected function __author_short_bio_controls() {

        $this->start_controls_section(
            '_section_style_short_bio',
            [
                'label' => __( 'Short Bio', 'codexse-elementor-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'bio_color',
			[
				'label' => esc_html__( 'Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-desc p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'bio_typography',
				'label' => __( 'Typography', 'codexse-elementor-addons' ),
				'selector' => '{{WRAPPER}} .cx-desc p',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
			]
		);


        $this->end_controls_section();
	}

	protected function __avatar_style_controls() {

        $this->start_controls_section(
            '_section_avatar_style',
            [
                'label' => __( 'Avatar', 'codexse-elementor-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'avatar_vertical_lign',
			[
				'label'   => __( 'Vertical Align', 'codexse-elementor-addons' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => __( 'Top', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-v-align-top',
					],
					'center' => [
						'title' => __( 'Middle', 'codexse-elementor-addons' ),
						'icon'  => 'eicon-v-align-middle',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cx-avatar' => 'align-self:{{UNIT}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'avatar_width',
			[
				'label' => __( 'Wdth', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 250,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 96,
				],
				'selectors' => [
					'{{WRAPPER}} .cx-avatar img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
		// $this->add_responsive_control(
		// 	'avatar_margin',
		// 	[
		// 		'label' => __( 'Avatar Margin', 'codexse-elementor-addons' ),
		// 		'type' => Controls_Manager::DIMENSIONS,
		// 		'size_units' => [ 'px', '%' ],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .cx-avatar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		// 		],
		// 	]
		// );

        $this->add_responsive_control(
			'avatar_padding',
			[
				'label' => __( 'Padding', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cx-avatar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'avatar_border',
				'label' => __( 'Border', 'codexse-elementor-addons' ),
				'selector' => '{{WRAPPER}} .cx-avatar img',
			]
		);

		$this->add_control(
			'avatar_radius',
			[
				'label' => __( 'Border Radius', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '50',
					'right' => '50',
					'bottom' => '50',
					'left' => '50',
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .cx-avatar img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
	}

	protected function __author_button_style_controls() {

        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => __( 'Button', 'codexse-elementor-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_responsive_control(
			'author_info_button_padding',
			[
				'label' => __( 'Padding', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'separator' => 'before',
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '7',
					'right' => '15',
					'bottom' => '7',
					'left' => '15',
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .cx-author-posts' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'author_info_button_hover_typography',
				'label' => __( 'Typography', 'codexse-elementor-addons' ),
				'selector' => '{{WRAPPER}} .cx-author-posts',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'author_info_button_border',
				'selector' => '{{WRAPPER}} .cx-desc .cx-author-posts',
			]
		);

		$this->add_control(
			'author_info_button_border_radius',
			[
				'label' => __('Border Radius', 'codexse-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .cx-desc .cx-author-posts' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
            'author_info_button_active_tabs'
        );

		$this->start_controls_tab(
            'author_info_button_normal_tab',
            [
                'label'    => __('Normal', 'codexse-elementor-addons')
            ]
        );

        $this->add_control(
			'author_info_button_text_color',
			[
				'label' => esc_html__( 'Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#555555',
				'selectors' => [
					'{{WRAPPER}} .cx-author-posts-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'author_info_button_background',
                'label' => __('Background', 'codexse-elementor-addons'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .cx-author-posts-btn',
            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab(
            'author_info_button_hover_tab',
            [
                'label'    => __('Hover', 'codexse-elementor-addons')
            ]
        );

		$this->add_control(
			'author_info_button_hover_text_color',
			[
				'label' => esc_html__( 'Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#555555',
				'selectors' => [
					'{{WRAPPER}} .cx-author-posts-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'author_info_button_hover_background',
                'label' => __('Background', 'codexse-elementor-addons'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .cx-author-posts-btn:hover',
            ]
        );

		$this->add_control(
			'author_info_button_border_color_hover',
			[
				'label' => esc_html__( 'Border Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#555555',
				'selectors' => [
					'{{WRAPPER}} .cx-author-posts-btn:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		// $user_id = get_the_author_meta( 'ID' );
		// $avatar = get_avatar($user_id, $settings['avatar_size']);
		// $display_name = get_the_author_meta( 'display_name' );
		// $bio = get_the_author_meta( 'description' );
		$user_id = get_post_field( 'post_author', get_the_ID() );
		$avatar = get_avatar($user_id, $settings['avatar_size']);
		$display_name = get_the_author_meta( 'display_name', $user_id );
		$bio = get_the_author_meta( 'description', $user_id );

		$post_url = get_author_posts_url( $user_id );
		$user_url =  get_the_author_meta( 'user_url', $user_id );

		$this->add_render_attribute('author', 'class', 'cx-author');
		$this->add_render_attribute('avatar', 'class', 'cx-avatar');
		if( $settings['avatar_image_position'] && 'yes' === $settings['show_avatar']){
			$this->add_render_attribute('author', 'class', 'avatar-position-' . $settings['avatar_image_position']);
		}

		if( $settings['show_author'] ){
			$this->add_render_attribute('author-title', 'class', 'cx-author-title');
		}

		?>

		<div <?php $this->print_render_attribute_string('author'); ?>>
			<?php if('yes' === $settings['show_avatar']) : ?>
				<div <?php $this->print_render_attribute_string('avatar'); ?>>
					<?php echo $avatar; ?>
				</div>
			<?php endif; ?>

			<div class="cx-desc">
				<?php
				if('yes' === $settings['show_author']){
					printf('<%1$s %2$s>%3$s</%1$s>', esc_attr($settings['author_meta_tag']), $this->get_render_attribute_string('author-title'), esc_html($display_name));
				}
				if('yes' === $settings['show_bio']){
					printf('<p>%1$s</p>', esc_html($bio));
				}

				if( 'yes' == $settings['show_archive_btn'] ) { ?>
					<a class="cx-author-posts cx-author-posts-btn" href="<?php echo esc_url( $post_url ); ?>">All Posts</a>
				<?php }
				?>
			</div>
		</div>


		<?php
	}
}
