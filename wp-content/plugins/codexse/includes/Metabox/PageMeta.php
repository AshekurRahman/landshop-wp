<?php

namespace Codexse\Metabox;

class Pagemeta
{
    function __construct(){
        add_action('add_meta_boxes', array($this, 'codexse_add_page_meta'));
        add_action('save_post', array($this, 'save'));
    }
    /**
	 * Adds the meta box container.
	 */
	public function codexse_add_page_meta($post_type) {
		$post_types = array( 'page' );

		//limit meta box to certain post types
		if (in_array($post_type, $post_types)) {
			add_meta_box('codexse-page-meta',
			__( 'Page options', 'codexse' ),
			array($this, 'codexse_meta_box_function'),
			$post_type,
			'normal',
			'high');
		}
	}

    public function codexse_meta_box_function($post) {
        wp_enqueue_script( 'codexse-admin' );
        wp_enqueue_style( 'codexse-admin' );

		// Add an nonce field so we can check for it later.
		wp_nonce_field('codexse_nonce_check', 'codexse_nonce_check_value');

		// Use get_post_meta to retrieve an existing value from the database.
		$remove_page_header = get_post_meta($post -> ID, '_codexse_remove_page_header', true);
		$remove_page_footer = get_post_meta($post -> ID, '_codexse_remove_page_footer', true);
		$ready_for_elementor = get_post_meta($post -> ID, '_codexse_ready_for_elementor', true);
		$ready_for_elementor = get_post_meta($post -> ID, '_codexse_ready_for_elementor', true);
		$page_background = get_post_meta( $post->ID, '_codexse_page_background', true );
		$one_page_scrolling_effect = get_post_meta($post -> ID, '_codexse_one_page_scrolling_effect', true);

		// Display the form, using the current value.
        echo '<div class="codexse-meta-items" >';
            echo '<div class="codexse-meta-item" >';
                echo '<p class="post-attributes-label-wrapper">';
                    echo '<label class="post-attributes-label" for="codexse_remove_page_header">'.__( 'Do you want to hide the page header?','codexse' ).'</label>';
                echo '</p>';
                echo '<select class="form-control" name="codexse_remove_page_header" id="codexse_remove_page_header">';
                    echo '<option value="no" '.selected( $remove_page_header, 'no' ).' >'.__( 'No','codexse' ).'</option>';
                    echo '<option value="yes" '.selected( $remove_page_header, 'yes' ).' >'.__( 'Yes','codexse' ).'</option>';
                echo '</select>';
            echo '</div>'; 
            echo '<div class="codexse-meta-item" >';
                echo '<p class="post-attributes-label-wrapper">';
                    echo '<label class="post-attributes-label" for="codexse_ready_for_elementor">'.__( 'Do you want to ready this page for Elementor?','codexse' ).'</label>';
                echo '</p>';
                echo '<select class="form-control" name="codexse_ready_for_elementor" id="codexse_ready_for_elementor">';
                    echo '<option value="no" '.selected( $ready_for_elementor, 'no' ).' >'.__( 'No','codexse' ).'</option>';
                    echo '<option value="yes" '.selected( $ready_for_elementor, 'yes' ).' >'.__( 'Yes','codexse' ).'</option>';
                echo '</select>';
            echo '</div>'; 
            echo '<div class="codexse-meta-item" >';
                echo '<p class="post-attributes-label-wrapper">';
                    echo '<label class="post-attributes-label" for="codexse_one_page_scrolling_effect">'.__( 'Do you want to use onepage scrolling effect?','codexse' ).'</label>';
                echo '</p>';
                echo '<select class="form-control" name="codexse_one_page_scrolling_effect" id="codexse_one_page_scrolling_effect">';
                    echo '<option value="no" '.selected( $one_page_scrolling_effect, 'no' ).' >'.__( 'No','codexse' ).'</option>';
                    echo '<option value="yes" '.selected( $one_page_scrolling_effect, 'yes' ).' >'.__( 'Yes','codexse' ).'</option>';
                echo '</select>';
            echo '</div>'; 
            echo '<div class="codexse-meta-item" >';
                echo '<p class="post-attributes-label-wrapper">';
                    echo '<label class="post-attributes-label" for="codexse_remove_page_footer">'.__( 'Do you want to hide the page footer?','codexse' ).'</label>';
                echo '</p>';
                echo '<select class="form-control" name="codexse_remove_page_footer" id="codexse_remove_page_footer">';
                    echo '<option value="no" '.selected( $remove_page_footer, 'no' ).' >'.__( 'No','codexse' ).'</option>';
                    echo '<option value="yes" '.selected( $remove_page_footer, 'yes' ).' >'.__( 'Yes','codexse' ).'</option>';
                echo '</select>';
            echo '</div>'; 
            echo '<div class="codexse-meta-item meta-image-upload '.(!empty($page_background) ? 'uploaded' : '' ).'" >';
                echo '<p class="post-attributes-label-wrapper">';
                    echo '<label class="post-attributes-label" for="codexse_page_backgroup">'.__( 'Upload page background','codexse' ).'</label>';
                echo '</p>';
                echo '<button type="button" style="background-image: url('.(!empty($page_background) ? $page_background : '' ).');" class="codexse-image-opload" >'. __( 'Upload image', 'codexse' ) .'</button>';
                echo '<input type="hidden" name="codexse_page_background" value="'.(!empty($page_background) ? $page_background : '' ).'" />';
                echo '<button type="button" class="image-remove '.( !empty($page_background) ? 'show' : 'hide' ).'"><span class="dashicons-before dashicons-no-alt" ></span></button>';
            echo '</div>'; 
        echo '</div>';
	}

        
    public function save($post_id) {

        /*
        * We need to verify this came from the our screen and with 
        * proper authorization,
        * because save_post can be triggered at other times.
        */

        // Check if our nonce is set.
        if (!isset($_POST['codexse_nonce_check_value']))
            return $post_id;

        $nonce = $_POST['codexse_nonce_check_value'];

        // Verify that the nonce is valid.
        if (!wp_verify_nonce($nonce, 'codexse_nonce_check'))
            return $post_id;

        // If this is an autosave, our form has not been submitted,
        //     so we don't want to do anything.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post_id;

        // Check the user's permissions.
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id))
                return $post_id;
        } else {
            if (!current_user_can('edit_post', $post_id))
                return $post_id;
        }

        /* OK, its safe for us to save the data now. */

        // Sanitize the user input.
        $page_background = sanitize_text_field($_POST['codexse_page_background']);
        $remove_header = sanitize_text_field($_POST['codexse_remove_page_header']);
        $remove_footer = sanitize_text_field($_POST['codexse_remove_page_footer']);
        $onepage_scroll = sanitize_text_field($_POST['codexse_one_page_scrolling_effect']);
        $ready_for_elementor = sanitize_text_field($_POST['codexse_ready_for_elementor']);

        // Update the meta field.
        update_post_meta($post_id, '_codexse_page_background', $page_background);
        update_post_meta($post_id, '_codexse_remove_page_header', $remove_header);
        update_post_meta($post_id, '_codexse_remove_page_footer', $remove_footer);
        update_post_meta($post_id, '_codexse_one_page_scrolling_effect', $onepage_scroll);
        update_post_meta($post_id, '_codexse_ready_for_elementor', $ready_for_elementor);
    }


}