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
        
        wp_localize_script(
			'codexse-admin',
			'image_gallery_metabox',
			array(
				'add_title'         => __( 'Add Images to Gallery', 'codexse' ),
				'add_button'        => __( 'Add to Gallery', 'codexse' ),
				'edit_title'        => __( 'Edit or Change Image', 'codexse' ),
				'edit_button'       => __( 'Update Image', 'codexse' ),
				'link_edit_title'   => __( 'Edit/Change Image', 'codexse' ),
				'link_remove_title' => __( 'Remove Image', 'codexse' ),
				'site_url'          => get_site_url(),
			)
		);



		// Add an nonce field so we can check for it later.
		wp_nonce_field('codexse_nonce_check', 'codexse_nonce_check_value');

		// Use get_post_meta to retrieve an existing value from the database.
		$embed_video = get_post_meta($post -> ID, '_codexse_embed_video', true);
		$embed_audio = get_post_meta($post -> ID, '_codexse_embed_audio', true);

        $gallery_stored_meta = get_post_meta( $post->ID, '_codexse_image_gallery_id', true );


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
            echo '<div class="codexse-meta-item codexse_embed_gallery" >';
                echo '<p class="post-attributes-label-wrapper remove-page-footer-label-wrapper">';
                    echo '<label class="post-attributes-label">'.__( 'Gallery Images','codexse' ).'</label>';
                echo '</p>';
                echo '<ul id="gallery-metabox-list">';
                if ( $gallery_stored_meta ) {
					foreach ( $gallery_stored_meta as $key => $value ) {
						$mime     = get_post_mime_type( $value );
						$filename = basename( get_attached_file( $value ) );

						// Check if attachment is an image or video file.
						if ( preg_match( '/\bimage\b/', $mime ) ) {
							$image = wp_get_attachment_image_src( $value );
							$thumb = '<img class="image-preview" src="' . esc_url( $image[0] ) . '">';
						} else {
							$thumb = '<div class="thumbnail"><div class="centered"><img src="' . esc_url( get_site_url() ) . '/wp-includes/images/media/video.png" class="icon" alt=""></div><div class="filename"><div>' . esc_html( $filename ) . '</div></div></div>';
						}
                        echo '<li class="attachment">';
                        echo '<input type="hidden" name="_codexse_image_gallery_id['.esc_attr( $key ).']" value="'.esc_attr( $value ).'">';
                        echo $thumb;
                        echo '<a class="edit-image" href="#" title="'.esc_html__( 'Edit/Change Image', 'codexse' ).'"></a>';
                        echo '<a class="remove-image" href="#" title="'.esc_html__( 'Remove Image', 'codexse' ).'"></a>';
                        echo '</li>';
					}
				}
                echo '</ul>';
                echo '<input type="hidden" name="igm_honeypot" value="true">';
                echo '<a class="gallery-add button button-primary" href="#">'.esc_html__( 'Add Images', 'codexse' ).'</a>';
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

        // Update the meta field.
        update_post_meta($post_id, '_codexse_embed_video', $video);
        update_post_meta($post_id, '_codexse_embed_audio', $audio);

        // Check for input and sanitize/save if needed.
		if ( isset( $_POST['_codexse_image_gallery_id'] ) ) {
			update_post_meta( $post_id, '_codexse_image_gallery_id', array_map( 'absint', $_POST['_codexse_image_gallery_id'] ) );
		} else {
			delete_post_meta( $post_id, '_codexse_image_gallery_id' );
		}




    }
}