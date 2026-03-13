<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * @package WooCommerce\Templates
 * @version 10.1.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 bg-white dark:bg-gray-900 transition-colors duration-300">
    <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-gray-100 mb-8 uppercase text-center"><?php esc_html_e('Tu Bolsa', 'bruiser-tech-lhparfum'); ?></h1>

    <div class="flex flex-col lg:flex-row gap-12">
        <div class="lg:w-2/3">
            <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
                <?php do_action( 'woocommerce_before_cart_table' ); ?>

                <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents w-full text-left border-collapse" cellspacing="0">
                    <thead class="border-b border-gray-200 dark:border-gray-700">
                        <tr>
                            <th class="product-remove pb-4">&nbsp;</th>
                            <th class="product-thumbnail pb-4">&nbsp;</th>
                            <th class="product-name pb-4 font-semibold text-gray-600 dark:text-gray-400 uppercase text-xs tracking-wider"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
                            <th class="product-price pb-4 font-semibold text-gray-600 dark:text-gray-400 uppercase text-xs tracking-wider"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
                            <th class="product-quantity pb-4 font-semibold text-gray-600 dark:text-gray-400 uppercase text-xs tracking-wider"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
                            <th class="product-subtotal pb-4 font-semibold text-gray-600 dark:text-gray-400 uppercase text-xs tracking-wider"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                        <?php
                        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                ?>
                                <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?> border-b border-gray-200 dark:border-gray-800">

                                    <td class="product-remove py-6">
                                        <?php
                                            echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                'woocommerce_cart_item_remove_link',
                                                sprintf(
                                                    '<a href="%s" class="remove text-gray-400 hover:text-red-500 text-xl font-bold" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                                    esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                    /* translators: %s is the product name */
                                                    esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $_product->get_name() ) ) ),
                                                    esc_attr( $product_id ),
                                                    esc_attr( $_product->get_sku() )
                                                ),
                                                $cart_item_key
                                            );
                                        ?>
                                    </td>

                                    <td class="product-thumbnail py-6 pr-4">
                                    <?php
                                    $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                                    if ( ! $product_permalink ) {
                                        echo $thumbnail; // PHPCS: XSS ok.
                                    } else {
                                        printf( '<a href="%s" class="block w-20 h-20 overflow-hidden">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                                    }
                                    ?>
                                    </td>

                                    <td class="product-name py-6 text-gray-900 dark:text-gray-100 font-medium" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                                    <?php
                                    if ( ! $product_permalink ) {
                                        echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                                    } else {
                                        echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s" class="hover:underline">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                    }

                                    do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                                    // Meta data.
                                    echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                                    // Backorder notification.
                                    if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                        echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                                    }
                                    ?>
                                    </td>

                                    <td class="product-price py-6 text-gray-500 dark:text-gray-400" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                                        <?php
                                            echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                        ?>
                                    </td>

                                    <td class="product-quantity py-6" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                                    <?php
                                    if ( $_product->is_sold_individually() ) {
                                        $min_quantity = 1;
                                        $max_quantity = 1;
                                    } else {
                                        $min_quantity = 0;
                                        $max_quantity = $_product->get_max_purchase_quantity();
                                    }

                                    $product_quantity = woocommerce_quantity_input(
                                        array(
                                            'input_name'   => "cart[{$cart_item_key}][qty]",
                                            'input_value'  => $cart_item['quantity'],
                                            'max_value'    => $max_quantity,
                                            'min_value'    => $min_quantity,
                                            'product_name' => $_product->get_name(),
                                            'classes'      => array( 'input-text', 'qty', 'text', 'border', 'border-gray-300', 'dark:border-gray-700', 'bg-transparent', 'text-center', 'w-16', 'py-1', 'dark:text-white' ),
                                        ),
                                        $_product,
                                        false
                                    );

                                    echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                                    ?>
                                    </td>

                                    <td class="product-subtotal py-6 font-medium text-gray-900 dark:text-gray-100" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                                        <?php
                                            echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>

                        <?php do_action( 'woocommerce_cart_contents' ); ?>

                        <tr>
                            <td colspan="6" class="actions py-6 text-right">

                                <?php if ( wc_coupons_enabled() ) { ?>
                                    <div class="coupon inline-flex flex-col sm:flex-row gap-2 float-left mb-4 sm:mb-0">
                                        <label for="coupon_code" class="sr-only"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text border border-gray-300 dark:border-gray-700 bg-transparent py-2 px-4 dark:text-white focus:outline-none focus:ring-1 focus:ring-black dark:focus:ring-white" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button px-6 py-2 bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-white font-semibold uppercase tracking-widest text-xs hover:bg-gray-300 dark:hover:bg-gray-700 transition-colors" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>
                                        <?php do_action( 'woocommerce_cart_coupon' ); ?>
                                    </div>
                                <?php } ?>

                                <button type="submit" class="button px-6 py-2 border border-gray-900 dark:border-white text-gray-900 dark:text-white font-semibold uppercase tracking-widest text-xs hover:bg-gray-900 hover:text-white dark:hover:bg-white dark:hover:text-gray-900 transition-colors" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

                                <?php do_action( 'woocommerce_cart_actions' ); ?>

                                <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                            </td>
                        </tr>

                        <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                    </tbody>
                </table>
                <?php do_action( 'woocommerce_after_cart_table' ); ?>
            </form>
        </div>

        <div class="lg:w-1/3">
            <div class="bg-gray-50 dark:bg-gray-800 p-8 border border-gray-200 dark:border-gray-700">
                <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

                <div class="cart-collaterals">
                    <?php
                        /**
                         * Cart collaterals hook.
                         *
                         * @hooked woocommerce_cross_sell_display
                         * @hooked woocommerce_cart_totals - 10
                         */
                        do_action( 'woocommerce_cart_collaterals' );
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
