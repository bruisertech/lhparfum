<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.6.1
 */

defined( 'ABSPATH' ) || exit;

if ( $max_value && $min_value === $max_value ) {
    ?>
    <div class="quantity hidden">
        <input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" />
    </div>
    <?php
} else {
    /* translators: %s: Quantity. */
    $label = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'woocommerce' ), wp_strip_all_tags( $args['product_name'] ) ) : esc_html__( 'Quantity', 'woocommerce' );
    ?>
    <div class="quantity flex items-center border border-gray-300 dark:border-gray-700 w-max rounded-sm overflow-hidden bg-white dark:bg-gray-800">
        <?php
        /**
         * Hook to output something before the quantity input field.
         *
         * @since 7.2.0
         */
        do_action( 'woocommerce_before_quantity_input_field' );
        ?>
        <label class="screen-reader-text sr-only" for="<?php echo esc_attr( $input_id ); ?>"><?php echo esc_attr( $label ); ?></label>

        <button type="button" class="minus flex items-center justify-center w-10 h-10 text-gray-500 hover:text-black dark:text-gray-400 dark:hover:text-white transition-colors focus:outline-none" onclick="var qty = this.parentNode.querySelector('input.qty'); var val = parseInt(qty.value); if(val > <?php echo esc_attr( $min_value ); ?>) { qty.value = val - 1; qty.dispatchEvent(new Event('change', { bubbles: true })); }">-</button>

        <input
            type="number"
            <?php echo $readonly ? 'readonly="readonly"' : ''; ?>
            id="<?php echo esc_attr( $input_id ); ?>"
            class="<?php echo esc_attr( join( ' ', (array) $classes ) ); ?> w-12 text-center text-sm font-semibold bg-transparent border-none focus:ring-0 appearance-none m-0 p-0 text-gray-900 dark:text-white"
            name="<?php echo esc_attr( $input_name ); ?>"
            value="<?php echo esc_attr( $input_value ); ?>"
            aria-label="<?php echo esc_attr_e( 'Product quantity', 'woocommerce' ); ?>"
            size="4"
            min="<?php echo esc_attr( $min_value ); ?>"
            max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
            <?php if ( ! $readonly ) : ?>
                step="<?php echo esc_attr( $step ); ?>"
                placeholder="<?php echo esc_attr( $placeholder ); ?>"
                inputmode="<?php echo esc_attr( $inputmode ); ?>"
                autocomplete="<?php echo esc_attr( isset( $autocomplete ) ? $autocomplete : 'on' ); ?>"
            <?php endif; ?>
        />

        <button type="button" class="plus flex items-center justify-center w-10 h-10 text-gray-500 hover:text-black dark:text-gray-400 dark:hover:text-white transition-colors focus:outline-none" onclick="var qty = this.parentNode.querySelector('input.qty'); var val = parseInt(qty.value); <?php if ( 0 < $max_value ) echo 'if(val < ' . esc_attr( $max_value ) . ')'; ?> { qty.value = val + 1; qty.dispatchEvent(new Event('change', { bubbles: true })); }">+</button>

        <?php
        /**
         * Hook to output something after the quantity input field
         *
         * @since 3.6.0
         */
        do_action( 'woocommerce_after_quantity_input_field' );
        ?>
    </div>
    <?php
}