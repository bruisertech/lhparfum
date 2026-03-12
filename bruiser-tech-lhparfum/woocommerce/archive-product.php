<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumbs & Header -->
    <header class="woocommerce-products-header mb-8 border-b border-gray-200 pb-6">
        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
            <h1 class="woocommerce-products-header__title page-title text-4xl font-light text-gray-900 tracking-tight text-center">
                <?php woocommerce_page_title(); ?>
            </h1>
        <?php endif; ?>

        <?php
        do_action( 'woocommerce_archive_description' );
        ?>
    </header>

    <div class="flex flex-col md:flex-row">
        <!-- Sidebar / Filters -->
        <aside class="w-full md:w-1/4 pr-8 mb-8 md:mb-0">
            <h3 class="text-lg font-semibold mb-4 text-gray-900">Sort & Filter</h3>
            <?php
            // We can output standard woo sidebar, or hardcode simple sort dropdown
            woocommerce_catalog_ordering();
            ?>
        </aside>

        <!-- Product Grid -->
        <main class="w-full md:w-3/4">
            <?php
            if ( woocommerce_product_loop() ) {

                do_action( 'woocommerce_before_shop_loop' );

                woocommerce_product_loop_start();

                if ( wc_get_loop_prop( 'total' ) ) {
                    while ( have_posts() ) {
                        the_post();

                        /**
                         * Hook: woocommerce_shop_loop.
                         */
                        do_action( 'woocommerce_shop_loop' );

                        // Custom Product Card
                        global $product;
                        $link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
                        ?>
                        <div class="group relative flex flex-col items-center text-center p-4 border border-transparent hover:border-gray-100 transition duration-300">
                            <a href="<?php echo esc_url( $link ); ?>" class="block w-full overflow-hidden bg-gray-100 mb-4 aspect-w-1 aspect-h-1">
                                <?php echo woocommerce_get_product_thumbnail( 'woocommerce_thumbnail', array( 'class' => 'object-cover w-full h-full group-hover:scale-105 transition duration-500' ) ); ?>
                            </a>
                            <div class="mt-4 flex flex-col justify-between flex-grow">
                                <h2 class="text-sm font-medium text-gray-900">
                                    <a href="<?php echo esc_url( $link ); ?>">
                                        <?php echo get_the_title(); ?>
                                    </a>
                                </h2>
                                <div class="mt-2 text-sm text-gray-500 font-medium">
                                    <?php echo $product->get_price_html(); ?>
                                </div>

                                <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="mt-4 px-6 py-2 border border-black text-black text-sm font-medium uppercase tracking-wider hover:bg-black hover:text-white transition-colors duration-300 w-full">
                                    <?php echo esc_html( $product->add_to_cart_text() ); ?>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                }

                woocommerce_product_loop_end();

                do_action( 'woocommerce_after_shop_loop' );
            } else {
                do_action( 'woocommerce_no_products_found' );
            }
            ?>
        </main>
    </div>
</div>

<?php
get_footer( 'shop' );
