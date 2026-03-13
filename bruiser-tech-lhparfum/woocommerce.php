<?php
/**
 * The template for displaying all WooCommerce pages
 *
 * This is the fallback template for WooCommerce if specific overrides don't exist.
 *
 * @package BRUISER_TECH_LHPARFUM
 */

get_header( 'shop' ); ?>

<main id="main-content" class="site-main max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16 transition-colors duration-300">
    <div class="woocommerce-container w-full bg-white dark:bg-gray-900 rounded-sm shadow-sm border border-gray-100 dark:border-gray-800 p-8 md:p-12">
        <?php
            // Core wrapper for standard Woo hooks
            do_action('woocommerce_before_main_content');
        ?>

        <?php woocommerce_content(); ?>

        <?php
            do_action('woocommerce_after_main_content');
        ?>
    </div>
</main>

<?php
get_footer( 'shop' );
