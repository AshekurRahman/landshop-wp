<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>
    <div class="cart_body">
        <h4 class="cart_title"><?php _e("Shopping cart","landshop"); ?></h4>
        <ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?>">
            <?php
            do_action( 'woocommerce_before_mini_cart_contents' );
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                    /**
                     * This filter is documented in woocommerce/templates/cart/cart.php.
                     *
                     * @since 2.1.0
                     */
                    $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                    $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                    $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                    ?>
                    <li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
                    <div class="cart__product">
                        <div class="product-remove">
                            <?php
                            echo apply_filters(
                                'woocommerce_cart_item_remove_link',
                                sprintf(
                                    '<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><i class="fa-regular fa-times"></i></a>',
                                    esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                    /* translators: %s is the product name */
                                    esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
                                    esc_attr( $product_id ),
                                    esc_attr( $cart_item_key ),
                                    esc_attr( $_product->get_sku() )
                                ),
                                $cart_item_key
                            );
                            ?>
                        </div>
                        <?php if(!empty($thumbnail)): ?>
                        <figure class="product__image">
                            <?php if ( empty( $product_permalink ) ) : ?>
                                <?php echo $thumbnail; ?>
                            <?php else : ?>
                                <a href="<?php echo esc_url( $product_permalink ); ?>">
                                    <?php echo $thumbnail; ?>
                                </a>
                            <?php endif; ?>
                        </figure>
                        <?php endif; ?>
                        <div class="product__details">
                            <?php if(!empty($product_name)): ?>
                            <h6 class="product__title mb-1">
                                <?php if ( empty( $product_permalink ) ) : ?>
                                    <?php echo wp_kses_post( $product_name ); ?>
                                <?php else : ?>
                                    <a href="<?php echo esc_url( $product_permalink ); ?>"><?php echo wp_kses_post( $product_name ); ?></a>
                                <?php endif; ?>
                            </h6>
                            <?php endif; ?>
                            <?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
                            <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="qunt">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
                        </div>
                    </div>
                    </li>
                    <?php
                }
            }

            do_action( 'woocommerce_mini_cart_contents' );
            ?>
        </ul>
    </div>
    <div class="cart_footer">
        <div class="row g-2 g-sm-4 align-items-center">
            <div class="col-sm-5">
                <h4 class="woocommerce-mini-cart__total total mb-0 text-center text-sm-start">
                    <?php
                    /**
                     * Hook: woocommerce_widget_shopping_cart_total.
                     *
                     * @hooked woocommerce_widget_shopping_cart_subtotal - 10
                     */
                    do_action( 'woocommerce_widget_shopping_cart_total' );
                    ?>
                </h4>
            </div>
            <div class="col-sm-7">
                <?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>
                <p class="woocommerce-mini-cart__buttons buttons text-center text-sm-end"><?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?></p>
                <?php do_action( 'woocommerce_widget_shopping_cart_after_buttons' ); ?>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="cart_body">
        <div class="woocommerce-message woocommerce-info woocommerce-mini-cart__empty-message my-5" role="alert">
            <?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?>
        </div>
    </div>
<?php endif; ?>
<?php do_action( 'woocommerce_after_mini_cart' ); ?>