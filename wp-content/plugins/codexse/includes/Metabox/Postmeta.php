<?php

namespace Codexse\Metabox;

class Postmeta
{
    function __construct(){
        add_action('add_meta_boxes', array($this, 'codexse_add_post_meta'));
        add_action('save_post', array($this, 'save'));
    }

    /**
	 * Adds the meta box container.
	 */
	public function codexse_add_post_meta($post_type) {
		$post_types = array( 'post' );

		//limit meta box to certain post types
		if (in_array($post_type, $post_types)) {
			add_meta_box('codexse-post-meta',
			__( 'Additional options', 'codexse' ),
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
		$embed_video = get_post_meta($post -> ID, '_codexse_embed_video', true);
		$embed_audio = get_post_meta($post -> ID, '_codexse_embed_audio', true);
		$embed_gallery = get_post_meta($post -> ID, '_codexse_embed_gallery', true);

		// Display the form, using the current value.
        echo '<div class="codexse-meta-items" >';
            echo '<div class="codexse-meta-item codexse_embed_video" >';
                echo '<p class="post-attributes-label-wrapper">';
                    echo '<label class="post-attributes-label" for="codexse_embed_video">'.__( 'Embed Video','codexse' ).'</label>';
                echo '</p>';
                echo '<input type="text" class="form-control" name="codexse_embed_video" id="codexse_embed_video" value="'.( !empty($embed_video) ? esc_url($embed_video) : '' ).'" />';
                echo '<div class="input-caption">'.esc_html__('Enter a youtube, twitter, or instagram URL. Supports services listed at ', 'codexse' ).'<a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a> '.esc_html__('This video show for select video format', 'codexse' ).'</div>';
                if( !empty($embed_video) ){
                    echo '<div class="embed-preview">';
                    echo wp_oembed_get( esc_url($embed_video) );
                    echo '</div>';
                }
            echo '</div>';
            echo '<div class="codexse-meta-item codexse_embed_audio" >';
                echo '<p class="post-attributes-label-wrapper">';
                    echo '<label class="post-attributes-label" for="codexse_embed_audio">'.__( 'Embed Audio','codexse' ).'</label>';
                echo '</p>';
                echo '<input type="text" class="form-control" name="codexse_embed_audio" id="codexse_embed_audio" value="'.( !empty($embed_audio) ? esc_url($embed_audio) : '' ).'" />';
                echo '<div class="input-caption">'.esc_html__('Enter a SoundCloud, Mixcloud, or ReverbNation etc URL. Supports services listed at ', 'landshopcore' ).'<a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a> '.esc_html__('This audio show for select audio format', 'codexse' ).'</div>';
                if( !empty($embed_audio) ){
                    echo '<div class="embed-preview">';
                    echo wp_oembed_get( esc_url($embed_audio) );
                    echo '</div>';
                }
            echo '</div>';           
            echo '<div class="codexse-meta-item meta-images-upload '.(!empty($embed_gallery) ? 'uploaded' : '' ).'" >';
                echo '<p class="post-attributes-label-wrapper remove-page-footer-label-wrapper">';
                    echo '<label class="post-attributes-label" for="codexse_page_backgroup">'.__( 'Gallery Images','codexse' ).'</label>';
                echo '</p>';
                echo '<button type="button" class="codexse-images-opload" >';                
                    if( !empty($embed_gallery) ){
                         $gallery = explode(',', $embed_gallery); 
                        foreach($gallery as $items ){
                            if(!empty($items)){
                                echo '<img src="'.esc_url($items).'" alt="" />';
                            }
                        }
                    }else {
                        esc_html_e( 'Select images', 'codexse' );
                    }
                echo '</button>';
                echo '<input type="hidden" name="codexse_embed_gallery" value="'.(!empty($embed_gallery) ? $embed_gallery : '' ).'" />';
                echo '<button type="button" class="image-remove"><span class="dashicons-before dashicons-no-alt" ></span></button>';
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
        $video = sanitize_text_field($_POST['codexse_embed_video']);
        $audio = sanitize_text_field($_POST['codexse_embed_audio']);
        $gallery = sanitize_text_field($_POST['codexse_embed_gallery']);

        // Update the meta field.
        update_post_meta($post_id, '_codexse_embed_video', $video);
        update_post_meta($post_id, '_codexse_embed_audio', $audio);
        update_post_meta($post_id, '_codexse_embed_gallery', $gallery);
    }
}