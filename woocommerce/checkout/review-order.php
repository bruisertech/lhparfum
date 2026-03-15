<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.6.1
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="shop_table woocommerce-checkout-review-order-table w-full mb-8">
    <div class="flex flex-col gap-6 mb-8 border-b border-gray-200 dark:border-gray-800 pb-8">
        <?php
        do_action( 'woocommerce_review_order_before_cart_contents' );

        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                $product_id = $cart_item['product_id'];

                // Rarity Pill Logic
                $rareza_terms = get_the_terms( $product_id, 'lh_rareza' );
                $pill_html = '';
                $glow_class = '';

                if ( $rareza_terms && ! is_wp_error( $rareza_terms ) ) {
                    $term = $rareza_terms[0];
                    $slug = $term->slug;

                    $pill_classes = 'absolute -top-3 -left-3 inline-flex items-center justify-center px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-[0.25em] text-white shadow-md z-20';

                    if ( $slug === 'nicho' ) {
                        $pill_classes .= ' bg-gradient-to-r from-yellow-400 to-yellow-600 animate-pulse-glow-gold';
                        $glow_class = 'bg-yellow-400 opacity-20 blur-xl';
                    } elseif ( $slug === 'arabe' ) {
                        $pill_classes .= ' bg-gradient-to-r from-purple-500 to-purple-800 animate-pulse-glow-purple';
                        $glow_class = 'bg-purple-600 opacity-20 blur-xl';
                    } elseif ( $slug === 'disenador' ) {
                        $pill_classes .= ' bg-gradient-to-r from-blue-400 to-blue-700 animate-pulse-glow-blue';
                        $glow_class = 'bg-blue-500 opacity-20 blur-xl';
                    } else {
                        $pill_classes .= ' bg-gradient-to-r from-emerald-400 to-emerald-700 animate-pulse-glow-green';
                        $glow_class = 'bg-emerald-500 opacity-20 blur-xl';
                    }

                    $pill_html = '<div class="' . esc_attr( $pill_classes ) . '">';
                    $pill_html .= '<span class="relative z-10">' . esc_html( $term->name ) . '</span>';
                    $pill_html .= '<div class="absolute inset-0 bg-white opacity-20"></div>';
                    $pill_html .= '</div>';
                }
                ?>
                <div class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?> flex gap-5 p-4 rounded-3xl border border-gray-100 dark:border-gray-800 bg-white/50 dark:bg-[#181818]/50 shadow-sm relative group items-center transition-shadow duration-300 hover:shadow-md transform-gpu">

                    <!-- Thumbnail with Rarity Pill -->
                    <div class="w-20 md:w-24 shrink-0 relative z-10">
                        <?php if ( $glow_class ) : ?>
                            <div class="absolute inset-0 <?php echo esc_attr( $glow_class ); ?> rounded-2xl -z-10 group-hover:scale-110 transition-transform duration-700 pointer-events-none transform-gpu"></div>
                        <?php endif; ?>

                        <div class="relative w-full aspect-[3/4] overflow-hidden rounded-2xl shadow-sm border border-black/5 dark:border-white/5 bg-white dark:bg-gray-900">
                            <?php echo $pill_html; ?>
                            <?php if ( $product_permalink ) : ?>
                                <a href="<?php echo esc_url( $product_permalink ); ?>" class="absolute inset-0 z-10 w-full h-full"></a>
                            <?php endif; ?>
                            <?php
                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'woocommerce_thumbnail', array( 'class' => 'absolute inset-0 w-full h-full object-cover' ) ), $cart_item, $cart_item_key );
                            echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            ?>
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="flex flex-col justify-center flex-grow py-1 pr-2">
                        <!-- Brand -->
                        <?php
                        $marca_terms = get_the_terms( $product_id, 'lh_marca' );
                        if ( $marca_terms && ! is_wp_error( $marca_terms ) ) {
                            echo '<div class="text-[9px] font-black uppercase tracking-[0.3em] text-gray-400 dark:text-gray-500 mb-1">' . esc_html( $marca_terms[0]->name ) . '</div>';
                        }
                        ?>

                        <!-- Name -->
                        <h4 class="text-sm font-black tracking-wide text-gray-900 dark:text-white leading-tight mb-2">
                            <?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ) . '&nbsp;'; ?>
                        </h4>

                        <?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

                        <div class="flex items-center justify-between mt-auto pt-2 border-t border-gray-100 dark:border-gray-800">
                            <!-- Qty -->
                            <div class="text-xs text-gray-500 dark:text-gray-400 font-bold">
                                <?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <span class="product-quantity">' . sprintf( '&times;&nbsp;%s', $cart_item['quantity'] ) . '</span>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            </div>

                            <!-- Subtotal -->
                            <div class="text-sm font-black text-gray-900 dark:text-white">
                                <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }

        do_action( 'woocommerce_review_order_after_cart_contents' );
        ?>
    </div>

    <!-- Totals Area -->
    <div class="flex flex-col gap-4 text-sm font-bold text-gray-600 dark:text-gray-400 mb-8">

        <div class="flex justify-between items-center cart-subtotal border-b border-gray-100 dark:border-gray-800 pb-4">
            <span class="uppercase tracking-widest text-xs"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></span>
            <span class="text-gray-900 dark:text-white text-base"><?php wc_cart_totals_subtotal_html(); ?></span>
        </div>

        <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
            <div class="flex justify-between items-center cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?> border-b border-gray-100 dark:border-gray-800 pb-4">
                <span class="uppercase tracking-widest text-xs flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    <?php wc_cart_totals_coupon_label( $coupon ); ?>
                </span>
                <span class="text-emerald-500 font-black"><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
            </div>
        <?php endforeach; ?>

        <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
            <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>
            <?php wc_cart_totals_shipping_html(); ?>
            <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
        <?php endif; ?>

        <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
            <div class="flex justify-between items-center fee border-b border-gray-100 dark:border-gray-800 pb-4">
                <span class="uppercase tracking-widest text-xs"><?php echo esc_html( $fee->name ); ?></span>
                <span class="text-gray-900 dark:text-white"><?php wc_cart_totals_fee_html( $fee ); ?></span>
            </div>
        <?php endforeach; ?>

        <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
            <?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
                <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
                    <div class="flex justify-between items-center tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?> border-b border-gray-100 dark:border-gray-800 pb-4">
                        <span class="uppercase tracking-widest text-xs"><?php echo esc_html( $tax->label ); ?></span>
                        <span class="text-gray-900 dark:text-white"><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="flex justify-between items-center tax-total border-b border-gray-100 dark:border-gray-800 pb-4">
                    <span class="uppercase tracking-widest text-xs"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></span>
                    <span class="text-gray-900 dark:text-white"><?php wc_cart_totals_taxes_total_html(); ?></span>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

        <div class="flex justify-between items-end order-total pt-4 mt-2">
            <span class="uppercase tracking-[0.2em] font-black text-gray-500 dark:text-gray-400 text-sm"><?php esc_html_e( 'Total', 'woocommerce' ); ?></span>
            <span class="text-3xl font-black tracking-tight text-gray-900 dark:text-white leading-none"><?php wc_cart_totals_order_total_html(); ?></span>
        </div>

        <?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
    </div>
</div>
