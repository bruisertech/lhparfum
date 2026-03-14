<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.6.1
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>

    <ul class="woocommerce-mini-cart cart_list product_list_widget flex flex-col gap-6 w-full <?php echo esc_attr( $args['list_class'] ?? '' ); ?>">
        <?php
        do_action( 'woocommerce_before_mini_cart_contents' );

        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('woocommerce_thumbnail', array('class' => 'absolute inset-0 w-full h-full object-cover')), $cart_item, $cart_item_key );
                $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

                // Get Rareza to apply subtle background class if needed, or keep clean.
                $rareza_terms = get_the_terms( $product_id, 'lh_rareza' );
                $glow_class = '';
                if ( $rareza_terms && ! is_wp_error( $rareza_terms ) ) {
                    $slug = $rareza_terms[0]->slug;
                    if ( $slug === 'nicho' ) $glow_class = 'bg-amber-50 dark:bg-amber-900/10 border-amber-200 dark:border-amber-900/30';
                    elseif ( $slug === 'arabe' ) $glow_class = 'bg-purple-50 dark:bg-purple-900/10 border-purple-200 dark:border-purple-900/30';
                    elseif ( $slug === 'disenador' ) $glow_class = 'bg-blue-50 dark:bg-blue-900/10 border-blue-200 dark:border-blue-900/30';
                    elseif ( $slug === 'accesible' ) $glow_class = 'bg-emerald-50 dark:bg-emerald-900/10 border-emerald-200 dark:border-emerald-900/30';
                }

                // Default clean classes if no rareza specific bg needed
                $card_class = $glow_class ? $glow_class : 'bg-white dark:bg-gray-800 border-gray-100 dark:border-gray-700';
                ?>
                <li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?> flex gap-4 p-4 rounded border shadow-sm relative <?php echo esc_attr($card_class); ?>">

                    <!-- Remove Item -->
                    <div class="absolute -top-2 -right-2 z-10">
                        <?php
                        echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            'woocommerce_cart_item_remove_link',
                            sprintf(
                                '<a href="%s" class="remove remove_from_cart_button bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-500 hover:text-red-500 hover:border-red-500 dark:hover:text-red-400 dark:hover:border-red-400 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold transition-colors shadow-sm" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
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

                    <!-- Product Image Strict Aspect Ratio -->
                    <div class="w-20 shrink-0">
                        <div class="relative w-full aspect-[3/4] overflow-hidden mb-0 rounded shadow-sm">
                            <?php if ( empty( $product_permalink ) ) : ?>
                                <?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            <?php else : ?>
                                <a href="<?php echo esc_url( $product_permalink ); ?>" class="absolute inset-0">
                                    <?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="flex-grow flex flex-col justify-between py-1">
                        <div>
                            <h3 class="text-sm font-bold uppercase tracking-wider text-gray-900 dark:text-gray-100 leading-tight">
                                <?php if ( empty( $product_permalink ) ) : ?>
                                    <?php echo wp_kses_post( $product_name ); ?>
                                <?php else : ?>
                                    <a href="<?php echo esc_url( $product_permalink ); ?>" class="hover:underline">
                                        <?php echo wp_kses_post( $product_name ); ?>
                                    </a>
                                <?php endif; ?>
                            </h3>
                            <?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

                            <div class="text-sm text-gray-500 dark:text-gray-400 mt-1 font-medium">
                                <?php echo $product_price; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            </div>
                        </div>

                        <!-- Quantity and Subtotal -->
                        <div class="flex items-center justify-between mt-3">
                            <div class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-widest font-semibold">
                                Cnt: <span class="text-gray-900 dark:text-white font-bold text-sm ml-1"><?php echo esc_html( $cart_item['quantity'] ); ?></span>
                            </div>
                            <div class="font-bold text-gray-900 dark:text-white text-base">
                                <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            </div>
                        </div>
                    </div>
                </li>
                <?php
            }
        }

        do_action( 'woocommerce_mini_cart_contents' );
        ?>
    </ul>

    <div class="sticky bottom-0 bg-gray-50 dark:bg-gray-900/95 backdrop-blur pt-6 mt-6 border-t border-gray-200 dark:border-gray-800">
        <?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

        <div class="flex justify-between items-center mb-6">
            <span class="text-sm font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?>:</span>
            <span class="text-xl font-extrabold text-gray-900 dark:text-white"><?php echo WC()->cart->get_cart_subtotal(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
        </div>

        <div class="woocommerce-mini-cart__buttons buttons flex flex-col gap-3">
            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button wc-forward w-full text-center border border-gray-900 dark:border-white text-gray-900 dark:text-white bg-transparent py-4 font-bold uppercase tracking-widest text-xs hover:bg-gray-900 hover:text-white dark:hover:bg-white dark:hover:text-gray-900 transition-colors rounded-sm"><?php esc_html_e( 'Ver Bolsa', 'bruiser-tech-lhparfum' ); ?></a>
            <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button checkout wc-forward w-full text-center bg-black dark:bg-white text-white dark:text-black py-4 font-bold uppercase tracking-widest text-xs hover:bg-gray-800 dark:hover:bg-gray-200 transition-colors rounded-sm shadow-lg shadow-black/10 dark:shadow-white/10"><?php esc_html_e( 'Pasar por caja', 'bruiser-tech-lhparfum' ); ?></a>
        </div>

        <?php do_action( 'woocommerce_widget_shopping_cart_after_buttons' ); ?>
    </div>

<?php else : ?>

    <div class="flex flex-col items-center justify-center h-full text-center py-20">
        <svg class="w-16 h-16 text-gray-300 dark:text-gray-700 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
        <p class="text-gray-500 dark:text-gray-400 uppercase tracking-widest text-sm font-semibold mb-8">
            <?php esc_html_e( 'Tu bolsa está vacía.', 'bruiser-tech-lhparfum' ); ?>
        </p>
        <a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" class="button border border-gray-900 dark:border-white text-gray-900 dark:text-white bg-transparent py-3 px-8 font-bold uppercase tracking-widest text-xs hover:bg-gray-900 hover:text-white dark:hover:bg-white dark:hover:text-gray-900 transition-colors rounded-sm">
            <?php esc_html_e( 'Explorar Colección', 'bruiser-tech-lhparfum' ); ?>
        </a>
    </div>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
