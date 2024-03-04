<?php
/**
 * Review widget class
 *
 * @package Codexse_Addons
 */
namespace Codexse_Addons\Elementor\Widget;

use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || die();

class Review extends Base {

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Review', 'codexse-elementor-addons' );
	}

	public function get_custom_help_url() {
		return 'https://codexseaddons.com/docs/codexse-addons-for-elementor/widgets/review/';
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
		return 'hm hm-review';
	}

	public function get_keywords() {
		return [ 'review', 'comment', 'feedback', 'testimonial' ];
	}

	public function get_style_depends() {
		return [
			'elementor-icons-fa-solid',
			'elementor-icons-fa-regular',
		];
	}

	/**
     * Register widget content controls
     */
	protected function register_content_controls() {
		$this->__review_content_controls();
		$this->__reviewer_content_controls();
	}

	protected function __review_content_controls() {

		$this->start_controls_section(
			'_section_review',
			[
				'label' => __( 'Review', 'codexse-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'ratting',
			[
				'label' => __( 'Rating', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => 4.2,
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5,
						'step' => .5,
					],
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'ratting_style',
			[
				'label' => __( 'Rating Style', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'star' => __( 'Star', 'codexse-elementor-addons' ),
					'num' => __( 'Number', 'codexse-elementor-addons' ),
				],
				'default' => 'star',
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'review',
			[
				'label' => __( 'Review', 'codexse-elementor-addons' ),
				'description' => cx_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Codexse reviewer is super excited being part of codexse family', 'codexse-elementor-addons' ),
				'placeholder' => __( 'Type amazing review from codexse reviewer', 'codexse-elementor-addons' ),
				'separator' => 'before',
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'review_position',
			[
				'label' => __( 'Review Position', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'before' => __( 'Before Rating', 'codexse-elementor-addons' ),
					'after' => __( 'After Rating', 'codexse-elementor-addons' ),
				],
				'default' => 'before',
				'style_transfer' => true,
			]
		);

		$this->end_controls_section();
	}

	protected function __reviewer_content_controls() {

		$this->start_controls_section(
			'_section_reviewer',
			[
				'label' => __( 'Reviewer', 'codexse-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Photo', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
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
				'default' => 'large',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'image_position',
			[
				'label' => __( 'Image Position', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'codexse-elementor-addons' ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => __( 'Top', 'codexse-elementor-addons' ),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' => __( 'Right', 'codexse-elementor-addons' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'top',
				'toggle' => false,
				'prefix_class' => 'cx-review--',
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Name', 'codexse-elementor-addons' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => 'Codexse Reviewer',
				'placeholder' => __( 'Type Reviewer Name', 'codexse-elementor-addons' ),
				'separator' => 'before',
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'job_title',
			[
				'label' => __( 'Job Title', 'codexse-elementor-addons' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Codexse Officer', 'codexse-elementor-addons' ),
				'placeholder' => __( 'Type Reviewer Job Title', 'codexse-elementor-addons' ),
				'dynamic' => [
					'active' => true,
				]
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
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label' => __( 'Name HTML Tag', 'codexse-elementor-addons' ),
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

		$this->end_controls_section();
	}

	/**
     * Register widget style controls
     */
	protected function register_style_controls() {
		$this->__ratting_style_controls();
		$this->__review_reviewer_style_controls();
		$this->__photo_style_controls();
	}

	protected function __ratting_style_controls() {

		$this->start_controls_section(
			'_section_ratting_style',
			[
				'label' => __( 'Rating', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'ratting_size',
			[
				'label' => __( 'Size', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .cx-review-ratting' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ratting_spacing',
			[
				'label' => __( 'Bottom Spacing', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .cx-review-ratting' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ratting_padding',
			[
				'label' => __( 'Padding', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cx-review-ratting' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ratting_color',
			[
				'label' => __( 'Text Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-review-ratting' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ratting_bg_color',
			[
				'label' => __( 'Background Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-review-ratting' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ratting_border',
				'selector' => '{{WRAPPER}} .cx-review-ratting',
			]
		);

		$this->add_control(
			'ratting_border_radius',
			[
				'label' => __( 'Border Radius', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cx-review-ratting' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function __review_reviewer_style_controls() {

		$this->start_controls_section(
			'_section_review_style',
			[
				'label' => __( 'Review & Reviewer', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'body_padding',
			[
				'label' => __( 'Text Box Padding', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cx-review-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'_heading_name',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Name', 'codexse-elementor-addons' ),
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
					'{{WRAPPER}} .cx-review-reviewer' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' => __( 'Text Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-review-reviewer' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'selector' => '{{WRAPPER}} .cx-review-reviewer',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
			]
		);

		$this->add_control(
			'_heading_job_title',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Job Title', 'codexse-elementor-addons' ),
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'job_title_spacing',
			[
				'label' => __( 'Bottom Spacing', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .cx-review-position' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'job_title_color',
			[
				'label' => __( 'Text Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-review-position' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'job_title_typography',
				'selector' => '{{WRAPPER}} .cx-review-position',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_control(
			'_heading_review',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Review', 'codexse-elementor-addons' ),
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'review_spacing',
			[
				'label' => __( 'Bottom Spacing', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .cx-review-desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'review_color',
			[
				'label' => __( 'Text Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-review-desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'review_typography',
				'selector' => '{{WRAPPER}} .cx-review-desc',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->end_controls_section();
	}

	protected function __photo_style_controls() {

		$this->start_controls_section(
			'_section_photo_style',
			[
				'label' => __( 'Photo', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
						'min' => 70,
						'max' => 500,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--cx-review-media-width: {{SIZE}}{{UNIT}};',
				],
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
						'min' => 70,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cx-review-figure' => 'height: {{SIZE}}{{UNIT}};',
				],
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
			'image_offset_x',
			[
				'label' => __( 'Offset X', 'codexse-elementor-addons' ),
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
					'{{WRAPPER}}' => '--cx-review-media-offset-x: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'image_offset_y',
			[
				'label' => __( 'Offset Y', 'codexse-elementor-addons' ),
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
					'{{WRAPPER}}' => '--cx-review-media-offset-y: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->end_popover();

		$this->add_responsive_control(
			'image_padding',
			[
				'label' => __( 'Padding', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cx-review-figure img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .cx-review-figure img',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cx-review-figure img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .cx-review-figure img',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_render_attribute( 'title', 'class', 'cx-review-reviewer' );

		$this->add_inline_editing_attributes( 'job_title', 'basic' );
		$this->add_render_attribute( 'job_title', 'class', 'cx-review-position' );

		$this->add_inline_editing_attributes( 'review', 'intermediate' );
		$this->add_render_attribute( 'review', 'class', 'cx-review-desc' );

		$this->add_render_attribute( 'ratting', 'class', [
			'cx-review-ratting',
			'cx-review-ratting--' . $settings['ratting_style']
		] );

		$ratting = max( 0, $settings['ratting']['size'] );

		if ( $settings['image']['url'] || $settings['image']['id'] ) :
			$settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
			?>
			<figure class="cx-review-figure">
				<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
			</figure>
		<?php endif; ?>

		<div class="cx-review-body">
			<?php if ( $settings['review_position'] === 'before' && $settings['review'] ) : ?>
				<div <?php $this->print_render_attribute_string( 'review' ); ?>>
					<p><?php echo cx_kses_intermediate( $settings['review'] ); ?></p>
				</div>
			<?php endif; ?>

			<div class="cx-review-header">
				<?php if ( $settings['title' ] ) :
					printf( '<%1$s %2$s>%3$s</%1$s>',
						cx_escape_tags( $settings['title_tag'], 'h2' ),
						$this->get_render_attribute_string( 'title' ),
						cx_kses_basic( $settings['title' ] )
						);
				endif; ?>

				<?php if ( $settings['job_title' ] ) : ?>
					<div <?php $this->print_render_attribute_string( 'job_title' ); ?>><?php echo cx_kses_basic( $settings['job_title' ] ); ?></div>
				<?php endif; ?>

				<div <?php $this->print_render_attribute_string( 'ratting' ); ?>>
					<?php if ( $settings['ratting_style'] === 'num' ) : ?>
						<?php echo esc_html( $ratting ); ?> <i class="fas fa-star" aria-hidden="true"></i>
					<?php else :
						for ( $i = 1; $i <= 5; ++$i ) :
							if ( $i <= $ratting ) {
								echo '<i class="fas fa-star" aria-hidden="true"></i>';
							} else {
								echo '<i class="far fa-star" aria-hidden="true"></i>';
							}
						endfor;
					endif; ?>
				 </div>
			</div>

			<?php if ( $settings['review_position'] === 'after' && $settings['review'] ) : ?>
				<div <?php $this->print_render_attribute_string( 'review' ); ?>>
					<p><?php echo cx_kses_intermediate( $settings['review'] ); ?></p>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}

	public function content_template() {
		?>
		<#
		view.addInlineEditingAttributes( 'title', 'basic' );
		view.addRenderAttribute( 'title', 'class', 'cx-review-reviewer' );

		view.addInlineEditingAttributes( 'job_title', 'basic' );
		view.addRenderAttribute( 'job_title', 'class', 'cx-review-position' );

		view.addInlineEditingAttributes( 'review', 'intermediate' );
		view.addRenderAttribute( 'review', 'class', 'cx-review-desc' );

		var ratting = Math.max(0, settings.ratting.size);

		if (settings.image.url || settings.image.id) {
			var image = {
				id: settings.image.id,
				url: settings.image.url,
				size: settings.thumbnail_size,
				dimension: settings.thumbnail_custom_dimension,
				model: view.getEditModel()
			};

			var image_url = elementor.imagesManager.getImageUrl( image );
			#>
			<figure class="cx-review-figure">
				<img src="{{ image_url }}">
			</figure>
		<# } #>

		<div class="cx-review-body">
			<# if (settings.review_position === 'before' && settings.review) { #>
				<div {{{ view.getRenderAttributeString( 'review' ) }}}>
					<p>{{{ settings.review }}}</p>
				</div>
			<# } #>
			<div class="cx-review-header">
				<# if (settings.title) { #>
					<{{ settings.title_tag }} {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</{{ settings.title_tag }}>
				<# } #>
				<# if (settings.job_title) { #>
					<div {{{ view.getRenderAttributeString( 'job_title' ) }}}>{{{ settings.job_title }}}</div>
				<# } #>
				<# if ( settings.ratting_style === 'num' ) { #>
					<div class="cx-review-ratting cx-review-ratting--num">{{ ratting }} <i class="fa fa-star"></i></div>
				<# } else { #>
					<div class="cx-review-ratting cx-review-ratting--star">
						<# _.each(_.range(1, 6), function(i) {
							if (i <= ratting) {
								print('<i class="fas fa-star"></i>');
							} else {
								print('<i class="far fa-star"></i>');
							}
						}); #>
					</div>
				<# } #>
			</div>
			<# if ( settings.review_position === 'after' && settings.review) { #>
				<div {{{ view.getRenderAttributeString( 'review' ) }}}>
					<p>{{{ settings.review }}}</p>
				</div>
			<# } #>
		</div>
		<?php
	}

}
