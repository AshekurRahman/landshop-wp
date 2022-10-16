;(function($){

    let wishItems = JSON.parse(localStorage.getItem("wishIds")) || [];

    
    $('.wish-add-button').on( 'click', function(){
        let proID = $(this).data('id');
        if(wishItems.indexOf(proID) !== -1){
            wishItems.splice(wishItems.indexOf(proID),1);
            localStorage.setItem( 'wishIds', JSON.stringify(wishItems));
            $(this).removeClass('added');
        } else{
            wishItems.push(proID);
            localStorage.setItem( 'wishIds', JSON.stringify(wishItems));
            $(this).addClass('added');            
        }
        return false;
    });


    if( wishItems.length !== 0 ){
        $('.wish-add-button').each(function(){
            let proID = $(this).data('id');            
            if(wishItems.indexOf(proID) !== -1){
                $(this).addClass('added');
            } else{
                $(this).removeClass('added');
            }    
        });        
        if( typeof wishitems !== 'undefined' ){            
            $.ajax({
                url: wishitems.ajaxurl,  /* Admin ajax url from localized script */
                type: 'POST',  /* Important */
                data: {
                    'action': 'wishitems',
                    'post_ids': wishItems
                },  /* Data object including 'action' and all post variables */
                beforeSend: function() {
                    $('.codexse-wishlist').empty();
                    $('.codexse-wishlist').append('<div class="d-flex justify-content-center"> <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status"> <span class="visually-hidden"></span> </div> </div>');
                },
                success : function(response) {                    
                    $('.codexse-wishlist').empty();
                    $('.codexse-wishlist').append(response);
                }
            });
        }
    }else {
        $('.codexse-wishlist').append('<p class="cart-empty woocommerce-info">'+wishitems.emptymessage+'</p>');        
    }

})(jQuery);