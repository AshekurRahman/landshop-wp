<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="woocommerce">
    <table class="shop_table cart shop_table_responsive woocommerce-cart-form__contents" cellspacing="0">
        <thead>
            <tr>
                <th class="product-close"></th>
                <th class="product-thumbnail"><?php esc_html_e( 'Thumbnail', 'codexse' ); ?></th>
                <th class="product-name"><?php esc_html_e( 'Name', 'codexse' ); ?></th>
                <th class="product-price"><?php esc_html_e( 'Price', 'codexse' ); ?></th>
                <th class="product-subtotal"><?php esc_html_e( 'Add to cart', 'codexse' ); ?></th>
            </tr>
        </thead>
        <tbody>
        <?php
            $args = array(
                'post_type' => 'product',
                'post__in'=> $_POST['post_ids']
            );   
            $wpq = new WP_Query( $args );
            
            if( $wpq->have_posts()){
                while($wpq->have_posts()){
                    $wpq->the_post();
                    echo '<tr>';
                        echo '<td class="product-close" data-title="'.esc_html__( 'Remove','codexse' ).'">';
                            echo '<button class="wish-close-button close-item" data-id="'.get_the_ID().'" ><i class="fal fa-minus"></i></button>';
                        echo '</td>';
                        echo '<td class="product-thumb" data-title="'.esc_html__( 'Thumbnail','codexse' ).'">';
                            the_post_thumbnail();
                        echo '</td>';
                        echo '<td data-title="'.esc_html__( 'Title','codexse' ).'"><a href="'.get_the_permalink().'">'.get_the_title().'</a></td>';
                        echo '<td data-title="'.esc_html__( 'Price','codexse' ).'">';
                            woocommerce_template_loop_price();
                        echo '</td>';
                        echo '<td data-title="'.esc_html__( 'Add to cart','codexse' ).'">';
                            woocommerce_template_loop_add_to_cart();
                        echo '</td>';
                    echo '</tr>';
                }
            }
        ?>
        
        </tbody>
    </table>
</div>

<script>
    ;(function($){
        $('body').on('click', '.wish-close-button', function(){            
            let proID = $(this).data('id');
            let wishItems = JSON.parse(localStorage.getItem("wishIds")) || [];
        
            if(wishItems.indexOf(proID) !== -1){
                wishItems.splice(wishItems.indexOf(proID),1);
                localStorage.setItem( 'wishIds', JSON.stringify(wishItems));
                $(this).removeClass('added');
            } else{
                wishItems.push(proID);
                localStorage.setItem( 'wishIds', JSON.stringify(wishItems));
                $(this).addClass('added');            
            }
            
            location.reload();
        });
    })(jQuery);
</script>
