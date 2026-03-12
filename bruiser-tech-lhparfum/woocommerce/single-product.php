<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

    <?php
        /**
         * woocommerce_before_main_content hook.
         */
        do_action( 'woocommerce_before_main_content' );
    ?>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 transition-colors duration-300">
        <?php while ( have_posts() ) : ?>
            <?php the_post(); ?>
            <?php global $product; ?>

            <div class="flex flex-col md:flex-row gap-12 lg:gap-16">
                <!-- Product Image Gallery -->
                <div class="w-full md:w-1/2">
                    <div class="sticky top-24 bg-gray-50 dark:bg-gray-800 p-6 md:p-10 rounded-sm shadow-sm transition-colors duration-300">
                        <?php
                            $image_id  = $product->get_image_id();
                            $image_url = wp_get_attachment_image_url( $image_id, 'full' );
                            if ( $image_url ) {
                                echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $product->get_name() ) . '" class="w-full h-auto object-cover rounded-sm shadow-md">';
                            } else {
                                echo wc_placeholder_img( 'woocommerce_single' );
                            }
                        ?>

                        <!-- Mini Thumbnails Placeholder -->
                        <div class="flex space-x-4 mt-6 overflow-x-auto pb-2">
                           <?php
                           $attachment_ids = $product->get_gallery_image_ids();
                           if ( $attachment_ids ) {
                               foreach ( $attachment_ids as $attachment_id ) {
                                   echo '<div class="w-20 h-20 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-sm overflow-hidden flex-shrink-0 cursor-pointer hover:opacity-75 transition-opacity duration-300 shadow-sm">';
                                   echo wp_get_attachment_image( $attachment_id, 'thumbnail', false, array( 'class' => 'w-full h-full object-cover' ) );
                                   echo '</div>';
                               }
                           }
                           ?>
                        </div>
                    </div>
                </div>

                <!-- Product Info & Add to Cart -->
                <div class="w-full md:w-1/2 flex flex-col justify-start pt-4">
                    <!-- Badges -->
                    <div class="flex items-center space-x-3 mb-4 text-xs font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400">
                        <span class="border-b border-gray-900 dark:border-white text-gray-900 dark:text-white pb-1">Lujo</span>
                        <span class="text-blue-600 dark:text-blue-400">Nuevo</span>
                    </div>

                    <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white tracking-tight mb-4">
                        <?php the_title(); ?>
                    </h1>

                    <div class="text-3xl font-light text-gray-900 dark:text-gray-200 mb-8">
                        <?php echo $product->get_price_html(); ?>
                    </div>

                    <!-- Description -->
                    <div class="prose prose-sm md:prose-base text-gray-600 dark:text-gray-300 mb-10 leading-relaxed">
                        <?php the_content(); ?>
                    </div>

                    <!-- Add to Cart Form -->
                    <div class="mb-10 w-full max-w-md">
                        <?php
                        if ( $product->is_type( 'variable' ) ) {
                            woocommerce_variable_add_to_cart();
                        } else {
                            // Simple add to cart button mimicking luxury e-commerce
                            echo '<form action="' . esc_url( $product->add_to_cart_url() ) . '" class="w-full" method="post" enctype="multipart/form-data">';
                            echo '<button type="submit" name="add-to-cart" value="' . esc_attr( $product->get_id() ) . '" class="w-full bg-black dark:bg-white text-white dark:text-black px-8 py-5 text-sm font-bold uppercase tracking-widest hover:bg-gray-800 dark:hover:bg-gray-200 transition-colors shadow-lg flex justify-center items-center space-x-3 rounded-none">';
                            echo '<span>Añadir a la bolsa</span> <span class="text-gray-400 dark:text-gray-500 font-normal border-l border-gray-600 dark:border-gray-300 pl-3 ml-3">' . wc_price( $product->get_price() ) . '</span>';
                            echo '</button>';
                            echo '</form>';
                        }
                        ?>
                    </div>

                    <!-- Perks List -->
                    <ul class="space-y-4 border-t border-gray-200 dark:border-gray-800 pt-8 text-sm text-gray-600 dark:text-gray-300 font-medium">
                        <li class="flex items-center">
                            <svg class="w-6 h-6 mr-4 text-gray-900 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path></svg>
                            Vegano y libre de crueldad
                        </li>
                        <li class="flex items-center">
                            <svg class="w-6 h-6 mr-4 text-gray-900 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path></svg>
                            Ingredientes limpios y sostenibles
                        </li>
                        <li class="flex items-center">
                            <svg class="w-6 h-6 mr-4 text-gray-900 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            Devoluciones gratuitas en 30 días
                        </li>
                    </ul>
                </div>
            </div>

        <?php endwhile; // end of the loop. ?>
    </div>

    <?php
        /**
         * woocommerce_after_main_content hook.
         */
        do_action( 'woocommerce_after_main_content' );
    ?>

<?php
get_footer( 'shop' );
