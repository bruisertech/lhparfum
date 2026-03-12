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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <?php while ( have_posts() ) : ?>
            <?php the_post(); ?>
            <?php global $product; ?>

            <div class="flex flex-col md:flex-row gap-12">
                <!-- Product Image Gallery -->
                <div class="w-full md:w-1/2">
                    <div class="sticky top-20 bg-gray-50 p-4 rounded-lg">
                        <?php
                            // The standard Woo gallery can be used here, but for this demo, we'll output a simple featured image.
                            $image_id  = $product->get_image_id();
                            $image_url = wp_get_attachment_image_url( $image_id, 'full' );
                            if ( $image_url ) {
                                echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $product->get_name() ) . '" class="w-full h-auto object-cover rounded shadow-sm">';
                            } else {
                                echo wc_placeholder_img( 'woocommerce_single' );
                            }
                        ?>

                        <!-- Mini Thumbnails Placeholder -->
                        <div class="flex space-x-2 mt-4 overflow-x-auto">
                           <?php
                           $attachment_ids = $product->get_gallery_image_ids();
                           if ( $attachment_ids ) {
                               foreach ( $attachment_ids as $attachment_id ) {
                                   echo '<div class="w-16 h-16 bg-gray-200 border border-gray-300 rounded overflow-hidden flex-shrink-0 cursor-pointer hover:opacity-75">';
                                   echo wp_get_attachment_image( $attachment_id, 'thumbnail', false, array( 'class' => 'w-full h-full object-cover' ) );
                                   echo '</div>';
                               }
                           }
                           ?>
                        </div>
                    </div>
                </div>

                <!-- Product Info & Add to Cart -->
                <div class="w-full md:w-1/2 flex flex-col justify-start">
                    <!-- Badges -->
                    <div class="flex items-center space-x-2 mb-2 text-xs font-semibold uppercase tracking-wider text-gray-500">
                        <span>Lujo</span>
                        <span class="text-blue-600">Nuevo</span>
                    </div>

                    <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-2">
                        <?php the_title(); ?>
                    </h1>

                    <div class="text-2xl font-light text-gray-900 mb-6">
                        <?php echo $product->get_price_html(); ?>
                    </div>

                    <!-- Description -->
                    <div class="prose prose-sm text-gray-600 mb-8 leading-relaxed">
                        <?php the_content(); ?>
                    </div>

                    <!-- Add to Cart Form -->
                    <div class="mb-8 w-full max-w-sm">
                        <?php
                        if ( $product->is_type( 'variable' ) ) {
                            woocommerce_variable_add_to_cart();
                        } else {
                            // Simple add to cart button mimicking dossier
                            echo '<form action="' . esc_url( $product->add_to_cart_url() ) . '" class="w-full" method="post" enctype="multipart/form-data">';
                            echo '<button type="submit" name="add-to-cart" value="' . esc_attr( $product->get_id() ) . '" class="w-full bg-black text-white px-8 py-4 text-sm font-semibold uppercase tracking-widest hover:bg-gray-800 transition-colors shadow-md flex justify-center items-center space-x-2">';
                            echo '<span>Añadir a la bolsa</span> <span class="text-gray-400 font-normal border-l border-gray-600 pl-2 ml-2">' . wc_price( $product->get_price() ) . '</span>';
                            echo '</button>';
                            echo '</form>';
                        }
                        ?>
                    </div>

                    <!-- Perks List -->
                    <ul class="space-y-3 border-t border-gray-200 pt-6 text-sm text-gray-600 font-medium">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Vegano y libre de crueldad
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Ingredientes limpios
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
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
