;(function($){
    /**
     * Load media uploader on pages with our custom metabox
     */
    $(document).on('ready',function(){
	'use strict';
    
    var type_post = $( "body" ).hasClass( "post-type-post" );
    var type_page = $( "body" ).hasClass( "post-type-page" );


    
    if(type_post){
    
        $('#codexse-post-meta').hide();
        $('#codexse-post-meta .codexse_embed_video').hide();
        $('#codexse-post-meta .codexse_embed_audio').hide();
        $('#codexse-post-meta .codexse_embed_gallery').hide();
        var id = $('input[name="post_format"]:checked').attr('id');        

        if (id == 'post-format-video') {
            $('#codexse-post-meta').show();
            $('#codexse-post-meta .codexse_embed_video').show();
        } else {
            $('#codexse-post-meta .codexse_embed_video').hide();
        }    
        if (id == 'post-format-audio') {
            $('#codexse-post-meta').show();
            $('#codexse-post-meta .codexse_embed_audio').show();
        } else {
            $('#codexse-post-meta .codexse_embed_audio').hide();
        }
        if (id == 'post-format-gallery') {
            $('#codexse-post-meta').show();
            $('#codexse-post-meta .codexse_embed_gallery').show();
        } else {
            $('#codexse-post-meta .codexse_embed_gallery').hide();
        }
        $('#post-formats-select .post-format').on('change', function() {
            $('#codexse-post-meta').hide();
            $('#codexse-post-meta .codexse_embed_video').hide();
            $('#codexse-post-meta .codexse_embed_audio').hide();
            $('#codexse-post-meta .codexse_embed_gallery').hide();
            var id = $('input[name="post_format"]:checked').attr('id');
            if (id == 'post-format-video') {
                $('#codexse-post-meta').show();
                $('#codexse-post-meta .codexse_embed_video').show();
            } else {
                $('#codexse-post-meta .codexse_embed_video').hide();
            }
            if (id == 'post-format-audio') {
                $('#codexse-post-meta').show();
                $('#codexse-post-meta .codexse_embed_audio').show();
            } else {
                $('#codexse-post-meta .codexse_embed_audio').hide();
            }
            if (id == 'post-format-gallery') {
                $('#codexse-post-meta').show();
                $('#codexse-post-meta .codexse_embed_gallery').show();
            } else {
                $('#codexse-post-meta .codexse_embed_gallery').hide();
            }
        });        


        // Prepare the variable that holds our custom media manager.
        var media_frame,attachment, attachmentPreview, attachmentSource, index;

        // Bind to our click event in order to open up the new media experience.
        $( document ).on( 'click.codexsepAddMediaManager', '#codexse-post-meta a.gallery-add', function( e ) {

            // Prevent the default action from occuring.
            e.preventDefault();

            // If the frame already exists, close it.
            if ( media_frame ) {
                media_frame.close();
            }

            // Create custom media frame. Refer to the wp-includes/js/media-views.js file for more default options.
            media_frame = wp.media.frames.media_frame = wp.media( {

                // Custom class name for our media frame.
                className: 'media-frame codexse-add-media-frame',
                // Assign 'select' workflow since we only want to upload an image. Use the 'post' workflow for posts.
                frame: 'select',
                // Allow mutiple file uploads.
                multiple: true,
                // Set custom media workflow title using the localized script object 'image_gallery_metabox'.
                title: image_gallery_metabox.add_title,
                // Limit media library access to images and video only.
                library: {
                    type: [ 'image', 'video' ]
                },
                // Set custom button text using the localized script object 'image_gallery_metabox'.
                button: {
                    text: image_gallery_metabox.add_button
                }

            } );

            media_frame.on( 'select', function() {

                var listIndex = $( '#gallery-metabox-list li' ).index( $( '#gallery-metabox-list li:last' ) ),
                selection = media_frame.state().get( 'selection' );

                var attachmentPreview, attachmentSource, index;

                selection.map( function( attachment, i ) {
                attachment = attachment.toJSON(),
                index = listIndex + ( i + 1 );

                // Check if attachment is an image or video file.
                if ( attachment.mime.includes('image') ) {
                    // Check if thumbnail size exists, if not use full size.
                    if ( attachment.sizes.thumbnail ) {
                        attachmentSource = attachment.sizes.thumbnail.url;
                    } else {
                        attachmentSource = attachment.url;
                    }

                    attachmentPreview = '<img class="image-preview" src="' + attachmentSource + '">';
                } else {
                    attachmentSource = attachment.url;

                    attachmentPreview = '<div class="thumbnail"><div class="centered"><img src="' + image_gallery_metabox.site_url + '/wp-includes/images/media/video.png" class="icon" alt=""></div><div class="filename"><div>' + attachment.filename + '</div></div></div>';
                }

                $( '#gallery-metabox-list' ).append( '<li class="attachment"><input type="hidden" name="_codexse_image_gallery_id[' + index + ']" value="' + attachment.id + '">' + attachmentPreview + '<a class="edit-image" href="#" title="' + image_gallery_metabox.link_edit_title + '"></a><a class="remove-image" href="#" title="' + image_gallery_metabox.link_remove_title + '"></a></li>' );
                } );

            } );

            makeSortable();

            // Now that everything has been set, let's open up the frame.
            media_frame.open();

        } );

        // Bind to our click event in order to open up the media frame.
        $( document ).on( 'click.codexseEditMediaManager', '#codexse-post-meta a.edit-image', function( e ) {

            // Prevent the default action from occuring.
            e.preventDefault();

            var that = $( this );

            // If the frame already exists, close it.
            if ( media_frame ) {
                media_frame.close();
            }

            // Create custom media frame. Refer to the wp-includes/js/media-views.js file for more default options.
            media_frame = wp.media.frames.media_frame = wp.media( {

                // Custom class name for our media frame.
                className: 'media-frame codexse-edit-media-frame',
                // Assign 'select' workflow since we only want to upload an image. Use the 'post' workflow for posts.
                frame: 'select',
                // Allow mutiple file uploads.
                multiple: false,
                // Set custom media workflow title using the localized script object 'image_gallery_metabox'.
                title: image_gallery_metabox.edit_title,
                // Limit media library access to images and video only.
                library: {
                    type: [ 'image', 'video' ]
                },
                // Set custom button text using the localized script object 'image_gallery_metabox'.
                button: {
                    text: image_gallery_metabox.edit_button
                }

            } );

            // Pre-select current image when opening our media frame.
            media_frame.on( 'open', function() {

                var selection = media_frame.state().get( 'selection' );
                id = that.parent().find( 'input:hidden' ).val();

                attachment = wp.media.attachment( id );
                attachment.fetch();
                selection.add( attachment ? [ attachment ] : [] );

            } );

            media_frame.on( 'select', function() {

                attachment = media_frame.state().get( 'selection' ).first().toJSON();

                // Check if thumbnail size exists, if not use full size
                if ( attachment.sizes.thumbnail ) {
                    attachmentSource = attachment.sizes.thumbnail.url;
                } else {
                    attachmentSource = attachment.url;
                }

                that.parent().find( 'input:hidden' ).attr( 'value', attachment.id );
                that.parent().find( 'img.image-preview' ).attr( 'src', attachmentSource );

            } );

            // Now that everything has been set, let's open up the frame.
            media_frame.open();

        } );

        function resetIndex() {

            $( '#gallery-metabox-list li' ).each( function( i ) {
                $( this ).find( 'input:hidden' ).attr( 'name', '_codexse_image_gallery_id[' + i + ']' );
            } );

        }

        function makeSortable() {

            $( '#gallery-metabox-list' ).sortable( {
                opacity: 0.8,
                stop: function() {
                    resetIndex();
                }
            } );

        }

        // Bind to our click event in order to remove an image from the gallery.
        $( document ).on( 'click.codexseRemoveMedia', '#codexse-post-meta a.remove-image', function( e ) {

            // Prevent the default action from occuring.
            e.preventDefault();

            $( this ).parents( 'li' ).animate( { opacity: 0 }, 200, function() {
                $( this ).remove();
                resetIndex();
            } );

        } );

        $( document ).ready( function() {
            makeSortable();
        } );

    }

    if(type_page){
        $(document).on("click", ".codexse-image-opload", function (e) {
            e.preventDefault();
            var $button = $(this);
            // Create the media frame.
            var file_frame = wp.media.frames.file_frame = wp.media({
                title: 'Select or upload image',
                library: { // remove these to show all
                    type: 'image' // specific mime
                },
                button: {
                    text: 'Select'
                },
                multiple: false // Set to true to allow multiple files to be selected
            });
            // When an image is selected, run a callback.
            file_frame.on('select', function () {
                // We set multiple to false so only get one image from the uploader 
                var attachment = file_frame.state().get('selection').first().toJSON();
                $button.parent('.meta-image-upload').addClass('uploaded');
                $button.siblings('input').attr('value', attachment.url);
                $button.css("background-image", "url(" + attachment.url + ")");
            });
            // Finally, open the modal
            file_frame.open();
        });
        $(document).on("click", ".meta-image-upload .image-remove", function (e) {
            e.preventDefault();
            var $close = $(this);
            $close.siblings('input').attr('value', '');
            $close.parent('.meta-image-upload').removeClass('uploaded');
            $close.siblings('.codexse-image-opload').css('background-image', 'none');
            return false;
        });
    }
    });
})(jQuery);
