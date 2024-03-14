<?php
/**
 * Icon List widget class
 *
 * @package Codexse_Addons
 */
namespace Codexse_Addons\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Repeater;
use Elementor\Icons_Manager;

defined( 'ABSPATH' ) || die();

class Icon_List extends Base {

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Icon List', 'codexse-elementor-addons' );
	}

	public function get_custom_help_url() {
		return 'https://codexseaddons.com/docs/codexse-addons-for-elementor/widgets/icon-list/';
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
		return 'cx cx-list';
	}

	public function get_keywords() {
		return [ 'icon list', 'icon', 'list' ];
	}

	/**
     * Register widget content controls
     */
	protected function register_content_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Icon List', 'codexse-elementor-addons' ),
			]
		);

		$this->add_control(
			'list_layout',
			[
				'label' => esc_html__( 'Layout', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'row', // Set your default layout here
				'options' => [
					'column' => [
						'title' => esc_html__( 'Row', 'codexse-elementor-addons' ),
						'icon' => 'eicon-editor-list-ul',
					],
					'row' => [
						'title' => esc_html__( 'Column', 'codexse-elementor-addons' ),
						'icon' => 'eicon-ellipsis-h',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-items' => 'display: flex; flex-direction: {{VALUE}};',
				],
			]
		);		

		$repeater = new Repeater();

		$repeater->add_control(
			'text',
			[
				'label' => esc_html__( 'Text', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'List Item', 'codexse-elementor-addons' ),
				'default' => esc_html__( 'List Item', 'codexse-elementor-addons' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'selected_icon',
			[
				'label' => esc_html__( 'Icon', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-check',
					'library' => 'fa-solid',
				],
				'fa4compatibility' => 'icon',
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'icon_list',
			[
				'label' => esc_html__( 'Items', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'text' => esc_html__( 'List Item #1', 'codexse-elementor-addons' ),
						'selected_icon' => [
							'value' => 'fas fa-check',
							'library' => 'fa-solid',
						],
					],
					[
						'text' => esc_html__( 'List Item #2', 'codexse-elementor-addons' ),
						'selected_icon' => [
							'value' => 'fas fa-times',
							'library' => 'fa-solid',
						],
					],
					[
						'text' => esc_html__( 'List Item #3', 'codexse-elementor-addons' ),
						'selected_icon' => [
							'value' => 'fas fa-dot-circle',
							'library' => 'fa-solid',
						],
					],
				],
				'title_field' => '{{{ elementor.helpers.renderIcon( this, selected_icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}} {{{ text }}}',
			]
		);

		$this->add_control(
			'link_click',
			[
				'label' => esc_html__( 'Apply Link On', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'full_width' => esc_html__( 'Full Width', 'codexse-elementor-addons' ),
					'inline' => esc_html__( 'Inline', 'codexse-elementor-addons' ),
				],
				'default' => 'full_width',
				'separator' => 'before',
				'prefix_class' => 'codexse-list-item-link-',
			]
		);

		$this->end_controls_section();

	
    }


	/**
     * Register widget style controls
     */
	protected function register_style_controls() {
		
		$this->start_controls_section(
			'section_icon_list',
			[
				'label' => esc_html__( 'List', 'codexse-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'list_item_background',
				'label' => esc_html__( 'Background', 'codexse-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .codexse-icon-list-items  .codexse-icon-list-item',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'list_item_border',
				'label' => esc_html__( 'Border', 'codexse-elementor-addons' ),
				'selector' => '{{WRAPPER}} .codexse-icon-list-items  .codexse-icon-list-item',
			]
		);

		$this->add_control(
			'list_item_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-items  .codexse-icon-list-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'list_item_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'codexse-elementor-addons' ),
				'selector' => '{{WRAPPER}} .codexse-icon-list-items  .codexse-icon-list-item',
			]
		);

		$this->add_control(
			'list_item_margin',
			[
				'label' => esc_html__( 'Margin', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-items  .codexse-icon-list-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'list_item_padding',
			[
				'label' => esc_html__( 'Padding', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-items  .codexse-icon-list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'list_item_padding_justify_content',
            [
                'label' => esc_html__( 'Justify Content', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Start', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'End', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'space-between' => [
                        'title' => esc_html__( 'Space Between', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-justify-space-between-h',
                    ],
                    'space-around' => [
                        'title' => esc_html__( 'Space Around', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-justify-space-around-h',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-list-items' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'list_item_padding_align_items',
            [
                'label' => esc_html__( 'Align Items', 'codexse-elementor-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Start', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'End', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                    'stretch' => [
                        'title' => esc_html__( 'Stretch', 'codexse-elementor-addons' ),
                        'icon' => 'eicon-align-stretch-v',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .codexse-icon-list-items' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        
        

		$this->end_controls_section();
        

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__( 'Icon', 'codexse-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->start_controls_tabs( 'icon_style_tabs' );
		
		// Normal Tab
		$this->start_controls_tab(
			'icon_style_normal',
			[
				'label' => esc_html__( 'Normal', 'codexse-elementor-addons' ),
			]
		);
		
		$this->add_control(
			'normal_icon_color',
			[
				'label' => esc_html__( 'Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-items .codexse-icon-list-item .codexse-icon-list-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'normal_icon_size',
			[
				'label' => esc_html__( 'Size', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-items .codexse-icon-list-item .codexse-icon-list-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .codexse-icon-list-items .codexse-icon-list-item .codexse-icon-list-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'normal_icon_width',
			[
				'label' => esc_html__( 'Width', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-items .codexse-icon-list-item .codexse-icon-list-icon' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'normal_icon_height',
			[
				'label' => esc_html__( 'Height', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-items .codexse-icon-list-item .codexse-icon-list-icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'normal_icon_margin',
			[
				'label' => esc_html__( 'Margin', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-items  .codexse-icon-list-item .codexse-icon-list-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'normal_icon_padding',
			[
				'label' => esc_html__( 'Padding', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-items  .codexse-icon-list-item .codexse-icon-list-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'normal_icon_border',
				'label' => esc_html__( 'Border', 'codexse-elementor-addons' ),
				'selector' => '{{WRAPPER}} .codexse-icon-list-items .codexse-icon-list-item .codexse-icon-list-icon',
			]
		);

		$this->add_control(
			'normal_icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-items .codexse-icon-list-item .codexse-icon-list-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'normal_icon_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'codexse-elementor-addons' ),
				'selector' => '{{WRAPPER}} .codexse-icon-list-items .codexse-icon-list-item .codexse-icon-list-icon',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'normal_icon_background',
				'label' => esc_html__( 'Background', 'codexse-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .codexse-icon-list-items .codexse-icon-list-item .codexse-icon-list-icon',
			]
		);
		
		// Add more controls for normal state as needed
		
		$this->end_controls_tab();
		
		// Hover Tab
		$this->start_controls_tab(
			'icon_style_hover',
			[
				'label' => esc_html__( 'Hover', 'codexse-elementor-addons' ),
			]
		);
		
		$this->add_control(
			'hover_icon_color',
			[
				'label' => esc_html__( 'Hover Color', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-items .codexse-icon-list-item:hover .codexse-icon-list-icon' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'hover_icon_border',
				'label' => esc_html__( 'Border', 'codexse-elementor-addons' ),
				'selector' => '{{WRAPPER}} .codexse-icon-list-items .codexse-icon-list-item:hover .codexse-icon-list-icon',
			]
		);

		$this->add_control(
			'hover_icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-items .codexse-icon-list-item:hover .codexse-icon-list-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'hover_icon_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'codexse-elementor-addons' ),
				'selector' => '{{WRAPPER}} .codexse-icon-list-items .codexse-icon-list-item:hover .codexse-icon-list-icon',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'hover_icon_background',
				'label' => esc_html__( 'Background', 'codexse-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .codexse-icon-list-items .codexse-icon-list-item:hover .codexse-icon-list-icon',
			]
		);
		$this->add_control(
			'hover_icon_transition',
			[
				'label' => esc_html__( 'Transition Duration', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 's', 'ms', 'custom' ],
				'default' => [
					'unit' => 's',
					'size' => 0.3,
				],
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-icon' => 'transition: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
		$this->end_controls_section();
		





		$this->start_controls_section(
			'section_text_style',
			[
				'label' => esc_html__( 'Text', 'codexse-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		// Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'label'    => esc_html__( 'Typography', 'codexse-elementor-addons' ),
				'selector' => '{{WRAPPER}} .codexse-icon-list-items .codexse-icon-list-item .codexse-icon-list-text', // Replace with the actual selector
			]
		);

		// Text Shadow
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'text_text_shadow',
				'label'    => esc_html__( 'Text Shadow', 'codexse-elementor-addons' ),
				'selector' => '{{WRAPPER}} .codexse-icon-list-items .codexse-icon-list-item .codexse-icon-list-text', // Replace with the actual selector
			]
		);

		// Normal Text Color
		$this->add_control(
			'normal_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-items .codexse-icon-list-item .codexse-icon-list-text' => 'color: {{VALUE}};',
				],
			]
		);

		// Hover Text Color
		$this->add_control(
			'hover_text_color',
			[
				'label'     => esc_html__( 'Hover Text Color', 'codexse-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-items .codexse-icon-list-item:hover .codexse-icon-list-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_text_transition',
			[
				'label' => esc_html__( 'Transition Duration', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 's', 'ms', 'custom' ],
				'default' => [
					'unit' => 's',
					'size' => 0.3,
				],
				'selectors' => [
					'{{WRAPPER}} .codexse-icon-list-text' => 'transition: {{SIZE}}{{UNIT}}',
				],
			]
		);



		$this->end_controls_section();
	}


	
	/**
	 * Render icon list widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$fallback_defaults = [
			'fa fa-check',
			'fa fa-times',
			'fa fa-dot-circle-o',
		];

		$this->add_render_attribute( 'icon_list', 'class', 'codexse-icon-list-items' );
		$this->add_render_attribute( 'list_item', 'class', 'codexse-icon-list-item' );
		?>
		<ul <?php $this->print_render_attribute_string( 'icon_list' ); ?>>
			<?php
			foreach ( $settings['icon_list'] as $index => $item ) :
				$repeater_setting_key = $this->get_repeater_setting_key( 'text', 'icon_list', $index );

				$this->add_render_attribute( $repeater_setting_key, 'class', 'codexse-icon-list-text' );

				$this->add_inline_editing_attributes( $repeater_setting_key );
				$migration_allowed = Icons_Manager::is_migration_allowed();
				?>
				<li <?php $this->print_render_attribute_string( 'list_item' ); ?>>
					<?php
					if ( ! empty( $item['link']['url'] ) ) {
						$link_key = 'link_' . $index;

						$this->add_link_attributes( $link_key, $item['link'] );
						?>
						<a <?php $this->print_render_attribute_string( $link_key ); ?>>

						<?php
					}

					// add old default
					if ( ! isset( $item['icon'] ) && ! $migration_allowed ) {
						$item['icon'] = isset( $fallback_defaults[ $index ] ) ? $fallback_defaults[ $index ] : 'fa fa-check';
					}

					$migrated = isset( $item['__fa4_migrated']['selected_icon'] );
					$is_new = ! isset( $item['icon'] ) && $migration_allowed;
					if ( ! empty( $item['icon'] ) || ( ! empty( $item['selected_icon']['value'] ) && $is_new ) ) :
						?>
						<span class="codexse-icon-list-icon">
							<?php
							if ( $is_new || $migrated ) {
								Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] );
							} else { ?>
									<i class="<?php echo esc_attr( $item['icon'] ); ?>" aria-hidden="true"></i>
							<?php } ?>
						</span>
					<?php endif; ?>
					<span <?php $this->print_render_attribute_string( $repeater_setting_key ); ?>><?php $this->print_unescaped_setting( 'text', 'icon_list', $index ); ?></span>
					<?php if ( ! empty( $item['link']['url'] ) ) : ?>
						</a>
					<?php endif; ?>
				</li>
				<?php
			endforeach;
			?>
		</ul>
		<?php
	}

	/**
	 * Render icon list widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	protected function content_template() {
		?>
		<#
			view.addRenderAttribute( 'icon_list', 'class', 'codexse-icon-list-items' );
			view.addRenderAttribute( 'list_item', 'class', 'codexse-icon-list-item' );
			var iconsHTML = {},
				migrated = {};
		#>
		<# if ( settings.icon_list ) { #>
			<ul {{{ view.getRenderAttributeString( 'icon_list' ) }}}>
			<# _.each( settings.icon_list, function( item, index ) {

					var iconTextKey = view.getRepeaterSettingKey( 'text', 'icon_list', index );

					view.addRenderAttribute( iconTextKey, 'class', 'codexse-icon-list-text' );

					view.addInlineEditingAttributes( iconTextKey ); #>

					<li {{{ view.getRenderAttributeString( 'list_item' ) }}}>
						<# if ( item.link && item.link.url ) { #>
							<a href="{{ item.link.url }}">
						<# } #>
						<# if ( item.icon || item.selected_icon.value ) { #>
						<span class="codexse-icon-list-icon">
							<#
								iconsHTML[ index ] = elementor.helpers.renderIcon( view, item.selected_icon, { 'aria-hidden': true }, 'i', 'object' );
								migrated[ index ] = elementor.helpers.isIconMigrated( item, 'selected_icon' );
								if ( iconsHTML[ index ] && iconsHTML[ index ].rendered && ( ! item.icon || migrated[ index ] ) ) { #>
									{{{ iconsHTML[ index ].value }}}
								<# } else { #>
									<i class="{{ item.icon }}" aria-hidden="true"></i>
								<# }
							#>
						</span>
						<# } #>
						<span {{{ view.getRenderAttributeString( iconTextKey ) }}}>{{{ item.text }}}</span>
						<# if ( item.link && item.link.url ) { #>
							</a>
						<# } #>
					</li>
				<#
				} ); #>
			</ul>
		<#	} #>

		<?php
	}

	public function on_import( $element ) {
		return Icons_Manager::on_import_migration( $element, 'icon', 'selected_icon', true );
	}



}
