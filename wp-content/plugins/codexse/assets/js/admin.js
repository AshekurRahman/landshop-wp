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
        $(document).on("click", ".codexse-images-opload", function () {
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
                multiple: true // Set to true to allow multiple files to be selected
            });
            // When an image is selected, run a callback.
            file_frame.on('select', function () {
                // We set multiple to false so only get one image from the uploader 
                var attachment = file_frame.state().get('selection').toJSON();
                var urls = '';
                var images = '';
                
                if( attachment.length !== 0  ){
                     attachment.forEach(function(item){
                        if( item.url !== null ){
                            urls += item.url+',';
                            
                            images += '<img src="'+item.url+'" alt="" />';
                        }
                     });                     
                    $button.siblings('input').attr('value', urls);
                    
                    $button.html(images);
                    
                    $button.parent('.meta-images-upload').addClass('uploaded');
                }else {
                    $button.siblings('input').attr('value', '');
                }
                return;
            });
            // Finally, open the modal
            file_frame.open();
        });
        
        $(document).on("click", ".meta-images-upload .image-remove", function (e) {
            e.preventDefault();
            var $close = $(this);
            $close.siblings('input').attr('value', '');
            $close.parent('.meta-images-upload').removeClass('uploaded');
            $close.siblings('.codexse-images-opload').empty();
            return false;
        });

        
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