<?php
/**
 * Featured lotteries Widget
 *
 * Gets and displays featured lotteries in an unordered list
 *
 * @category 	Widgets
 * @version 	1.0.0
 * @extends 	WP_Widget
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WC_Lottery_Widget_Featured_Lotteries extends WP_Widget {
    	
	var $woo_widget_cssclass;
	var $woo_widget_description;
	var $woo_widget_idbase;
	var $woo_widget_name;

	/**
	 * Constructor
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {

		/* Widget variable settings. */
		$this->woo_widget_cssclass = 'woocommerce widget_featured_lotteries';
		$this->woo_widget_description = __( 'Display a list of featured lotteries on your site.', 'wc_lottery' );
		$this->woo_widget_idbase = 'woocommerce_featured_lotteries';
		$this->woo_widget_name = __( 'WooCommerce Featured Lotteries', 'wc_lottery' );

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->woo_widget_cssclass, 'description' => $this->woo_widget_description );

		parent::__construct('featured-lotteries', $this->woo_widget_name, $widget_ops);	
		
		

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	/**
	 * Widget function
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
     * 
	 */
	function widget($args, $instance) {
		global $woocommerce;

		$cache = wp_cache_get('widget_featured_lotteries', 'widget');

		if ( !is_array($cache) ) $cache = array();

		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Featured lotteries', 'wc_lottery' ) : $instance['title'], $instance, $this->id_base);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
        
        $query_args = array('posts_per_page' => $number, 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product' );
		$query_args['tax_query'] = array(array('taxonomy' => 'product_type' , 'field' => 'slug', 'terms' => 'lottery')); 
		$query_args['meta_query'] = $woocommerce->query->get_meta_query();
		if ( version_compare( WC_VERSION, '2.7', '<' ) ) {
			$query_args['meta_query'][] = array(
				'key' => '_featured',
				'value' => 'yes'
			);
		} else {
			$query_args['tax_query'][] = array(
     				'taxonomy' => 'product_visibility',
    				'field'    => 'name',
    				'terms'    => 'featured',
    			);	
		}
		$query_args['is_lottery_archive'] = TRUE; 	
		$r = new WP_Query($query_args);

		if ($r->have_posts()) : 
		$hide_time = empty( $instance['hide_time'] ) ? 0 : 1;
		
		?>
		
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul class="product_list_widget">
		<?php while ($r->have_posts()) : $r->the_post(); global $product;
		$time = '';
		$timetext = __('Time left', 'wc_lottery');
		$datatime = $product->get_seconds_remaining();
		$product_id = $product->get_id();
		if(!$product->is_started()){
			$timetext = __('Starting in', 'wc_lottery');
			$datatime = $product->get_seconds_to_lottery();
		}
		if($hide_time != 1 && !$product->is_closed()){
			$futureclass = ( $product->is_closed() === FALSE ) && ($product->is_started() === FALSE ) ? 'future' : '';
			$time = '<span class="time-left">'.apply_filters('time_text',$timetext,$product_id).'</span>';
			$time .= wc_get_template_html( 'global/lottery-widget-countdown.php');
		}
		if($product->is_closed())
				$time = '<span class="has-finished">'.apply_filters('time_text',__('Lottery finished', 'wc_lottery'),$product_id).'</span>';	
		 ?>

		<li><a href="<?php echo esc_url( get_permalink( $r->post->ID ) ); ?>" title="<?php echo esc_attr($r->post->post_title ? $r->post->post_title : $r->post->ID); ?>">
			<?php echo $product->get_image(); ?>
			<?php if ( $r->post->post_title ) echo get_the_title( $r->post->ID ); else echo $r->post->ID; ?>
		</a> <?php echo $product->get_price_html(); ?>
		<?php echo $time ?>
		</li>

		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>

		<?php endif;

		$content = ob_get_clean();

		if ( isset( $args['widget_id'] ) ) $cache[$args['widget_id']] = $content;

		echo $content;

		wp_cache_set('widget_featured_lotteries', $cache, 'widget');
        wp_reset_postdata();
	}


	/**
	 * Update function
	 *
	 * @see WP_Widget->update
	 * @access public
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
     * 
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['hide_time'] = empty( $new_instance['hide_time'] ) ? 0 : 1;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_featured_lotteries']) ) delete_option('widget_featured_lotteries');

		return $instance;
	}


	/**
	 * Flush widget cache
	 *
	 * @access public
	 * @return void
     * 
	 */
	function flush_widget_cache() {
		wp_cache_delete('widget_featured_lotteries', 'widget');
	}


	/**
	 * Form function
	 *
	 * @see WP_Widget->form
	 * @access public
	 * @param array $instance
	 * @return void
     * 
	 */
	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$hide_time = empty( $instance['hide_time'] ) ? 0 : 1;
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 2;
        ?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'wc_lottery' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of lotteries to show:', 'wc_lottery' ); ?></label>
		<input id="<?php echo esc_attr( $this->get_field_id('number') ); ?>" name="<?php echo esc_attr( $this->get_field_name('number') ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>
		
		<p><input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('hide_time') ); ?>" name="<?php echo esc_attr( $this->get_field_name('hide_time') ); ?>"<?php checked( $hide_time ); ?> />
		<label for="<?php echo $this->get_field_id('hide_time'); ?>"><?php _e( 'Hide time left', 'wc_lottery' ); ?></label></p>
        <?php
	}
}