<?php
/**
 * Image grid widget class
 *
 * @package Codexse_Addons
 */
namespace Codexse_Addons\Elementor\Widget;

use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

defined( 'ABSPATH' ) || die();

class Image_Grid extends Base {

	/**
	 * Default filter is the global filter
	 * and can be overriden from settings
	 *
	 * @var string
	 */
	protected $_default_filter = '*';

	public function get_title() {
		return __( 'Image Grid', 'codexse-elementor-addons' );
	}

	public function get_custom_help_url() {
		return 'https://codexseaddons.com/docs/codexse-addons-for-elementor/widgets/image-grid/';
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
		return 'cx cx-grid-even';
	}

	public function get_keywords() {
		return [ 'gallery', 'image', 'masonry', 'even', 'portfolio', 'filterable', 'grid' ];
	}

	/**
     * Register widget content controls
     */
	protected function register_content_controls() {
		$this->__gallery_content_controls();
		$this->__advance_content_controls();
	}

	protected function __gallery_content_controls() {

		$this->start_controls_section(
			'_section_gallery',
			[
				'label' => __( 'Gallery', 'codexse-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'filter',
			[
				'label' => __( 'Filter Name', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Type gallery filter name', 'codexse-elementor-addons' ),
				'description' => __( 'Filter name will be used in filter menu.', 'codexse-elementor-addons' ),
				'default' => __( 'Filter Name', 'codexse-elementor-addons' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$repeater->add_control(
			'is_default_filter',
			[
				'label' => __( 'Is Default Filter?', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'description' => __( 'Set this as default active filter. Make sure filter menu is active and visible. Last active will get priority.', 'codexse-elementor-addons' ),
				'style_transfer' => true,
			]
		);

		$repeater->add_control(
			'images',
			[
				'type' => Controls_Manager::GALLERY,
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'gallery',
			[
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'show_label' => false,
				/** translators: 1: Filter name */
				'title_field' => sprintf( __( 'Filter Group: %1$s', 'codexse-elementor-addons' ), '{{filter}}' ),
				'default' => [
					[
						'filter' => __( 'Codexse', 'codexse-elementor-addons' ),
					]
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'medium_large',
				'separator' => 'before',
				'exclude' => [
					'custom'
				]
			]
		);

		$this->end_controls_section();
	}

	protected function __advance_content_controls() {

		$this->start_controls_section(
			'_section_advance',
			[
				'label' => __( 'Advance', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_filter',
			[
				'label' => __( 'Show Filter Menu', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'description' => __( 'Enable to display filter menu.', 'codexse-elementor-addons' ),
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'show_all_filter',
			[
				'label' => __( 'Show "All" Filter', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
				'description' => __( 'Enable to display "All" filter in filter menu.', 'codexse-elementor-addons' ),
				'condition' => [
					'show_filter' => 'yes'
				],
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'all_filter_label',
			[
				'label' => __( 'Filter Label', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'All', 'codexse-elementor-addons' ),
				'placeholder' => __( 'Type filter label', 'codexse-elementor-addons' ),
				'description' => __( 'Type "All" filter label.', 'codexse-elementor-addons' ),
				'condition' => [
					'show_all_filter' => 'yes',
					'show_filter' => 'yes'
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label' => __( 'Columns', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					1 => __( '1 Column', 'codexse-elementor-addons' ),
					2 => __( '2 Columns', 'codexse-elementor-addons' ),
					3 => __( '3 Columns', 'codexse-elementor-addons' ),
					4 => __( '4 Columns', 'codexse-elementor-addons' ),
					5 => __( '5 Columns', 'codexse-elementor-addons' ),
					6 => __( '6 Columns', 'codexse-elementor-addons' ),
				],
				'separator' => 'before',
				'desktop_default' => 4,
				'tablet_default' => 3,
				'mobile_default' => 2,
				'selectors' => [
					'{{WRAPPER}} .cx-image-grid__item' => '--image-grid-column: {{VALUE}};',
				],
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'layout',
			[
				'label' => __( 'Layout', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'even' => __( 'Even', 'codexse-elementor-addons' ),
					'fitRows' => __( 'Fit Rows', 'codexse-elementor-addons' ),
					'masonry' => __( 'Masonry', 'codexse-elementor-addons' ),
				],
				'default' => 'masonry',
				'render' => 'none',
				'frontend_available' => true,
				'prefix_class' => 'cx-image-grid--',
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'enable_popup',
			[
				'label' => __( 'Enable Lightbox', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before',
				'return_value' => 'yes',
				'default' => 'yes',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'disable_lightbox_on_tablet',
			[
				'label' => __( 'Disable On Tablet', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'frontend_available' => true,
				'condition' => [
					'enable_popup' => 'yes',
				]
			]
		);

		$this->add_control(
			'disable_lightbox_on_mobile',
			[
				'label' => __( 'Disable On Mobile', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'frontend_available' => true,
				'condition' => [
					'enable_popup' => 'yes',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'popup_image',
				'default' => 'large',
				'exclude' => [
					'custom'
				],
				'condition' => [
					'enable_popup' => 'yes',
				]
			]
		);

		$this->end_controls_section();
	}

	/**
     * Register widget style controls
     */
	protected function register_style_controls() {
		$this->__image_style_controls();
		$this->__menu_style_controls();
	}

	protected function __image_style_controls() {

		$this->start_controls_section(
			'_section_style_image',
			[
				'label' => __( 'Image', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'image_height',
			[
				'label' => __( 'Height', 'codexse-elementor-addons' ),
				'description' => __( 'Image height is only applicable for Even layout', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000
					]
				],
				'selectors' => [
					'{{WRAPPER}} .cx-image-grid__item' => 'height: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'layout' => 'even',
				]
			]
		);

		// Had to change the margin to padding due to markup update
		// but kept the origin control key for backward compatibility
		$this->add_responsive_control(
			'image_margin',
			[
				'label' => __( 'Padding', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .cx-image-grid__item' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .cx-image-grid__wrap' => '--image-grid-right: {{RIGHT}}{{UNIT}}; --image-grid-left: {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cx-image-grid__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
					'{{WRAPPER}} .cx-image-grid__item img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'image_css_filters',
				'selector' => '{{WRAPPER}} .cx-image-grid__item img',
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
					'{{WRAPPER}} .cx-image-grid__item:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'image_css_filters_hover',
				'selector' => '{{WRAPPER}} .cx-image-grid__item:hover img',
			]
		);

		$this->add_control(
			'image_background_hover_transition',
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
					'{{WRAPPER}} .cx-image-grid__item img' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->add_control(
			'image_hover_animation',
			[
				'label' => __( 'Hover Animation', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
				'default' => 'grow',
				'label_block' => true,
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function __menu_style_controls() {

		$this->start_controls_section(
			'_section_style_menu',
			[
				'label' => __( 'Filter Menu', 'codexse-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'_heading_menu',
			[
				'label' => __( 'Menu', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'menu_margin',
			[
				'label' => __( 'Margin', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cx-filter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'_heading_buttons',
			[
				'label' => __( 'Filter Buttons', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __( 'Padding', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cx-filter__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_spacing',
			[
				'label' => __( 'Spacing', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .cx-filter__item:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .cx-filter__item'
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' => __( 'Border Radius', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cx-filter__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .cx-filter__item'
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .cx-filter__item',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_responsive_control(
			'button_align',
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
					],
				],
				'desktop_default' => 'left',
				'toggle' => false,
				'selectors' => [
					'{{WRAPPER}} .cx-filter' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->start_controls_tabs( '_tabs_style_button' );

		$this->start_controls_tab(
			'_tab_button_normal',
			[
				'label' => __( 'Normal', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => __( 'Text Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cx-filter__item' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label' => __( 'Background Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-filter__item' => 'background-color: {{VALUE}};',
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
				'label' => __( 'Text Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-filter__item:hover, {{WRAPPER}} .cx-filter__item:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_bg_color',
			[
				'label' => __( 'Background Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-filter__item:hover, {{WRAPPER}} .cx-filter__item:focus' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .cx-filter__item:hover, {{WRAPPER}} .cx-filter__item:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tab_button_active',
			[
				'label' => __( 'Active', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'button_active_color',
			[
				'label' => __( 'Text Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-filter__item:active, {{WRAPPER}} .cx-filter__item--active' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_active_bg_color',
			[
				'label' => __( 'Background Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cx-filter__item:active, {{WRAPPER}} .cx-filter__item--active' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_active_border_color',
			[
				'label' => __( 'Border Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'button_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .cx-filter__item:active, {{WRAPPER}} .cx-filter__item--active' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function get_gallery_data() {
		$gallery = $this->get_settings_for_display( 'gallery' );

		if ( ! is_array( $gallery ) || empty( $gallery ) ) {
			return [];
		}

		$menu = [];
		$items = [];

		foreach ( $gallery as $key => $item ) {
			if ( empty( $item['images'] ) ) {
				continue;
			}

			$images = $item['images'];
			$filter = '__fltr-' . ( $key + 1 );

			if ( ! empty( $item['is_default_filter'] ) ) {
				$this->_default_filter = '.' . $filter;
			}

			if ( $filter && ! isset( $data[ $filter ] ) ) {
				$menu[ $filter ] = $item['filter'];
			}

			foreach ( $images as $image ) {
				if ( ! isset( $items[ $image['id'] ] ) ) {
					$items[ $image['id'] ] = $filter;
				} else {
					$items[ $image['id'] ] .= ' ' . $filter;
				}
			}
		}

		return compact( 'menu', 'items' );
	}

	protected function image_missing_alert() {
		if( cx_elementor()->editor ){
			printf(
				'<div %s>%s</div>',
				'style="margin: 1rem;padding: 1rem 1.25rem;border-left: 5px solid #f5c848;color: #856404;background-color: #fff3cd;"',
				__( 'Please select an image first to render the grid properly', 'codexse-elementor-addons' )
			);
		}
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$gallery = $this->get_gallery_data();

		if ( empty( $gallery ) ) {
			return;
		}

		if ( count( $gallery['items'] ) <= 0 ) {
			$this->image_missing_alert();
			return;
		}

		$this->add_render_attribute( 'grid_wrap', 'class', 'cx-image-grid__wrap hajs-isotope' );

		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			$this->add_render_attribute( 'grid_wrap', 'class', 'hajs-isotope-' . $this->get_id() );
		}

		$has_popup = $settings['enable_popup'];
		$item_html_tag = 'figure';

		if ( $has_popup ) {
			$item_html_tag = 'a';
			$this->add_render_attribute( 'grid_wrap', 'class', 'cx-lightbox--has' );
		}

		if ( $settings['show_filter'] ) : ?>
			<div class="cx-filter hajs-filter" data-default-filter="<?php echo $this->_default_filter; ?>" role="navigation" aria-label="<?php echo esc_attr_x( 'Gallery filter', 'Gallery filter aria label', 'codexse-elementor-addons' ); ?>">
				<?php if ( $settings['show_all_filter'] ) : ?>
					<button class="cx-filter__item" type="button" data-filter="*"><?php echo esc_html( $settings['all_filter_label'] ); ?></button></li>
				<?php endif; ?>
				<?php foreach ( $gallery['menu'] as $key => $val ) : ?>
					<button class="cx-filter__item" type="button" data-filter=".<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $val ); ?></button></li>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div <?php $this->print_render_attribute_string( 'grid_wrap' ); ?>>
			<?php foreach ( $gallery['items'] as $id => $filter_str ) : ?>
				<?php $popup = $settings['enable_popup'] ? sprintf( 'href="#" data-mfp-src="%s"', esc_url( wp_get_attachment_image_url( $id, $settings['popup_image_size'] ) ) ) : ''; ?>

				<<?php echo $item_html_tag; ?> <?php echo $popup; ?> class="cx-image-grid__item cx-js-lightbox <?php echo esc_attr( $filter_str ); ?>">
					<?php echo wp_get_attachment_image( $id, $settings['thumbnail_size'], false, [ 'class' => 'elementor-animation-' . esc_attr( $settings['image_hover_animation'] ) ] ); ?>
				</<?php echo $item_html_tag; ?>>
			<?php endforeach; ?>
		</div>

		<?php
		/**
		 * Codexse isotope hack.
		 *
		 * This piece of code may seem unnecessary to you
		 * but it saved the world!
		 */
		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) :
			printf( '<script>jQuery(".hajs-isotope-%s").isotope();</script>', $this->get_id() );
		endif;
	}
}
