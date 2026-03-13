<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.1.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 transition-colors duration-300">
    <!-- Header -->
    <header class="woocommerce-products-header mb-12 border-b border-gray-200 dark:border-gray-800 pb-8 text-center">
        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
            <h1 class="woocommerce-products-header__title page-title text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                <?php woocommerce_page_title(); ?>
            </h1>
        <?php endif; ?>

        <?php
        do_action( 'woocommerce_archive_description' );
        ?>
    </header>

    <div class="flex flex-col md:flex-row gap-8">
        <!-- Product Grid -->
        <main class="w-full">
            <div class="flex justify-between items-center mb-8 pb-4 border-b border-gray-100 dark:border-gray-800">
                <span class="text-sm text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wider">Mostrando Resultados</span>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wider mr-2">Ordenar por:</span>
                    <?php woocommerce_catalog_ordering(); ?>
                </div>
            </div>

            <?php
            if ( woocommerce_product_loop() ) {

                do_action( 'woocommerce_before_shop_loop' );

                // We override the default ul output to use our elegant 3-column grid
                echo '<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-12 gap-x-8">';

                if ( wc_get_loop_prop( 'total' ) ) {
                    while ( have_posts() ) {
                        the_post();
                        do_action( 'woocommerce_shop_loop' );

                        // Custom Product Card
                        global $product;
                        $link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
                        ?>
                        <div class="group relative flex flex-col items-center text-center transition duration-300 bg-white dark:bg-gray-900">
                            <a href="<?php echo esc_url( $link ); ?>" class="block w-full overflow-hidden bg-gray-50 dark:bg-gray-800 aspect-w-3 aspect-h-4 relative rounded-sm shadow-sm group-hover:shadow-lg transition-shadow duration-300">
                                <?php echo $product->get_image( 'woocommerce_thumbnail', array( 'class' => 'object-cover w-full h-full group-hover:scale-110 transition-transform duration-700 ease-in-out' ) ); ?>
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-opacity duration-300"></div>
                            </a>
                            <div class="mt-6 flex flex-col justify-between flex-grow w-full px-2">
                                <h2 class="text-base md:text-lg font-bold text-gray-900 dark:text-white mb-1">
                                    <a href="<?php echo esc_url( $link ); ?>">
                                        <?php echo get_the_title(); ?>
                                    </a>
                                </h2>
                                <div class="text-sm md:text-base text-gray-600 dark:text-gray-400 font-medium mb-4">
                                    <?php echo $product->get_price_html(); ?>
                                </div>

                                <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="mt-auto px-6 py-3 border border-gray-900 dark:border-white text-gray-900 dark:text-white text-xs font-bold uppercase tracking-widest hover:bg-gray-900 hover:text-white dark:hover:bg-white dark:hover:text-gray-900 transition-colors duration-300 w-full rounded-none">
                                    <?php echo esc_html( $product->add_to_cart_text() ); ?>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                }

                echo '</div>'; // End custom grid

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
