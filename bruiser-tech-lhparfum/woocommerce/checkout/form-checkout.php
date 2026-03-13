<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
    echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
    return;
}
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 bg-white dark:bg-gray-900 transition-colors duration-300">
    <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-gray-100 mb-8 uppercase text-center"><?php esc_html_e('Finalizar Compra', 'bruiser-tech-lhparfum'); ?></h1>

    <form name="checkout" method="post" class="checkout woocommerce-checkout flex flex-col lg:flex-row gap-12" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

        <?php if ( $checkout->get_checkout_fields() ) : ?>

            <div class="lg:w-2/3" id="customer_details">
                <div class="space-y-12">
                    <?php do_action( 'woocommerce_checkout_billing' ); ?>
                    <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                </div>
            </div>

        <?php endif; ?>

        <div class="lg:w-1/3">
            <div class="bg-gray-50 dark:bg-gray-800 p-8 border border-gray-200 dark:border-gray-700 sticky top-24">
                <h3 id="order_review_heading" class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6 pb-4 border-b border-gray-200 dark:border-gray-700 uppercase tracking-wider"><?php esc_html_e( 'Tu Pedido', 'bruiser-tech-lhparfum' ); ?></h3>

                <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

                <div id="order_review" class="woocommerce-checkout-review-order">
                    <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                </div>

                <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
            </div>
        </div>
    </form>

    <?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
</div>
