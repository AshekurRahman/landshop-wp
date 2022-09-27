<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class landshop_Experiences extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve counter widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'experiences-widget';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve counter widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Experiences', 'landshopcore' );
	}
    

	/**
	 * Get widget icon.
	 *
	 * Retrieve counter widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'landshop-icon eicon-hypster';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the button widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'landshopcore' ];
	}
    
	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'experience','qualification' ];
	}

	protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Experiences', 'landshopcore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control(
            'institute_name',
            [
                'label' => __( 'Institute Name', 'landshopcore' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your institute name.', 'landshopcore' ),
                'default' => __( 'Google Software Inc', 'landshopcore' ),
                'title' => __( 'Institute Name', 'landshopcore' ),
            ]
        );
        $repeater->add_control(
            'session_year',
            [
                'label' => __( 'Session year', 'landshopcore' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your session year.', 'landshopcore' ),
                'default' => __( 'Sep 2016 - Aug 2014', 'landshopcore' ),
                'title' => __( 'Session year', 'landshopcore' ),
            ]
        );
        $repeater->add_control(
            'experience_title',
            [
                'label' => __( 'Title', 'landshopcore' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter the Experiences title', 'landshopcore' ),
                'default' => __( 'Mid Level UI/UX Designer', 'landshopcore' ),
                'title' => __( 'Experiences title', 'landshopcore' ),
            ]
        );
        $repeater->add_control(
            'experience_content',
            [
                'label' => __( 'Description', 'landshopcore' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Enter your Experiences description.', 'landshopcore' ),
                'default' => __( 'Their creativity, innovation, technological expertise, and project completion steps were impressive. Project management was professional. We’re a full-service creative digital marketing agency, collaborating with brands.', 'landshopcore' ),
                'title' => __( 'Experiences Description', 'landshopcore' ),
            ]
        );
        $repeater->add_control(
            'cirlce_color',
            [
                'label' => __( 'Circle Color', 'landshopcore' ),
                'type' => Controls_Manager::COLOR,
				'default' => '#ffb525',
                'selectors' => [
                    '{{WRAPPER}} .experience-boxes {{CURRENT_ITEM}} .circle span' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'item_list',
            [
                'label' => __( 'Repeater List', 'landshopcore' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'institute_name' => __( 'Google Software Inc', 'landshopcore' ),
                        'session_year' => __( 'Sep 2016 - Aug 2014', 'landshopcore' ),
                        'experience_title' => __( 'Mid Level UI/UX Designer', 'landshopcore' ),
                        'experience_content' => __( 'Their creativity, innovation, technological expertise, and project completion steps were impressive. Project management was professional. We’re a full-service creative digital marketing agency, collaborating with brands.', 'landshopcore' ),
                    ],
                ],
                'title_field' => '{{{ experience_title }}}',
            ]
        );
        
        $this->end_controls_section();  
        
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
        $html = '';
        $this->add_render_attribute( 'landshop_experience_attr', 'class', 'experience-boxes' );        
		if ( $settings['item_list'] ) {
            $html .= '<div '.$this->get_render_attribute_string( "landshop_experience_attr" ).' >';
            foreach (  $settings['item_list'] as $item ) {
                $html .= '<div class="experience-box elementor-repeater-item-'.$item['_id'].'">';
                    $html .= '<div class="left-side">';
                        if( !empty($item['institute_name']) ){
                            $html .= '<h4 class="institute">'.esc_html($item['institute_name']).'</h4>';
                        }
                        if(!empty($item['session_year']) ){
                            $html .= '<div class="session" >'.esc_html($item['session_year']).'</div>';
                        }
                    $html .= '</div>';
                    $html .= '<div class="circle"><span></span></div>';
                    $html .= '<div class="right-side">';
                        if( !empty($item['experience_title']) ){
                            $html .= '<h4 class="title">'.esc_html($item['experience_title']).'</h4>';
                        }
                        if( !empty($item['experience_content']) ){
                            $html .= '<div class="desc">'.wp_kses_post($item['experience_content']).'</div>';
                        }
                    $html .= '</div>';
                $html .= '</div>';
            }
            $html .= '</div>';
        }
        echo $html;        
    }// End Rendar
    
}// End Class


Plugin::instance()->widgets_manager->register_widget_type( new landshop_Experiences );