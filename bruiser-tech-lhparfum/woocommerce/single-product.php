<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     10.6.1
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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 transition-colors duration-500">
        <?php while ( have_posts() ) : ?>
            <?php the_post(); ?>
            <?php global $product; ?>

            <div class="flex flex-col lg:flex-row gap-16 xl:gap-24 items-start">
                <!-- Product Image Gallery -->
                <div class="w-full lg:w-1/2">
                    <div class="sticky top-28 group relative overflow-hidden bg-[#f8f8f8] dark:bg-[#111111] p-8 md:p-16 rounded-sm transition-all duration-500">
                        <?php
                            $image_id  = $product->get_image_id();
                            $image_url = wp_get_attachment_image_url( $image_id, 'full' );
                            if ( $image_url ) {
                                echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $product->get_name() ) . '" class="w-full h-auto object-cover rounded-sm shadow-2xl mix-blend-multiply dark:mix-blend-normal transition-transform duration-700 ease-in-out group-hover:scale-105">';
                            } else {
                                echo wc_placeholder_img( 'woocommerce_single' );
                            }
                        ?>

                        <!-- Glowing Ambience Background (Subtle radial gradient to enhance the "luxury" feel) -->
                        <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-transparent to-white/10 dark:to-white/5 pointer-events-none"></div>

                        <!-- Mini Thumbnails -->
                        <div class="flex space-x-6 mt-12 overflow-x-auto pb-4 scrollbar-hide opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                           <?php
                           $attachment_ids = $product->get_gallery_image_ids();
                           if ( $attachment_ids ) {
                               foreach ( $attachment_ids as $attachment_id ) {
                                   echo '<div class="w-24 h-24 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-sm overflow-hidden flex-shrink-0 cursor-pointer hover:border-black dark:hover:border-white transition-all duration-300 shadow-sm hover:shadow-md">';
                                   echo wp_get_attachment_image( $attachment_id, 'thumbnail', false, array( 'class' => 'w-full h-full object-cover mix-blend-multiply dark:mix-blend-normal' ) );
                                   echo '</div>';
                               }
                           }
                           ?>
                        </div>
                    </div>
                </div>

                <!-- Product Info & Add to Cart -->
                <div class="w-full lg:w-1/2 flex flex-col justify-start pt-8 lg:pt-12">

                    <!-- Enhanced Rarity & Category Pills -->
                    <div class="flex items-center flex-wrap gap-4 mb-8">
                        <?php
                            // Rareza Pill (The LED Star)
                            $rareza_terms = get_the_terms( $product->get_id(), 'lh_rareza' );
                            if ( $rareza_terms && ! is_wp_error( $rareza_terms ) ) {
                                $term = $rareza_terms[0];
                                $slug = $term->slug;

                                $pill_classes = 'px-6 py-2 rounded-full text-xs font-black uppercase tracking-[0.2em] text-white transition-all duration-500 shadow-lg relative overflow-hidden';

                                if ( $slug === 'nicho' ) {
                                    $pill_classes .= ' bg-gradient-to-r from-yellow-400 to-yellow-600 animate-pulse-glow-gold';
                                } elseif ( $slug === 'arabe' ) {
                                    $pill_classes .= ' bg-gradient-to-r from-purple-500 to-purple-800 animate-pulse-glow-purple';
                                } elseif ( $slug === 'disenador' ) {
                                    $pill_classes .= ' bg-gradient-to-r from-blue-400 to-blue-700 animate-pulse-glow-blue';
                                } else {
                                    $pill_classes .= ' bg-gradient-to-r from-emerald-400 to-emerald-700 animate-pulse-glow-green';
                                }

                                echo '<span class="' . esc_attr( $pill_classes ) . '">';
                                echo '<span class="relative z-10">' . esc_html( $term->name ) . '</span>';
                                // Inner glow effect for extreme luxury
                                echo '<div class="absolute inset-0 bg-white opacity-20 mix-blend-overlay"></div>';
                                echo '</span>';
                            }

                            // Genero
                            $genero_terms = get_the_terms( $product->get_id(), 'lh_genero' );
                            if ( $genero_terms && ! is_wp_error( $genero_terms ) ) {
                                echo '<span class="text-[#888888] dark:text-[#aaaaaa] border border-[#e0e0e0] dark:border-[#333333] px-4 py-2 rounded-full text-[10px] font-semibold uppercase tracking-widest hover:border-black dark:hover:border-white transition-colors cursor-default">' . esc_html( $genero_terms[0]->name ) . '</span>';
                            }

                            // Aroma
                            $aroma_terms = get_the_terms( $product->get_id(), 'lh_aroma' );
                            if ( $aroma_terms && ! is_wp_error( $aroma_terms ) ) {
                                echo '<span class="text-[#888888] dark:text-[#aaaaaa] border border-[#e0e0e0] dark:border-[#333333] px-4 py-2 rounded-full text-[10px] font-semibold uppercase tracking-widest hover:border-black dark:hover:border-white transition-colors cursor-default">' . esc_html( $aroma_terms[0]->name ) . '</span>';
                            }
                        ?>
                    </div>

                    <!-- Title -->
                    <h1 class="text-5xl md:text-7xl font-black text-black dark:text-white tracking-tighter mb-6 leading-none">
                        <?php the_title(); ?>
                    </h1>

                    <!-- Price -->
                    <div class="text-2xl md:text-3xl font-light text-[#555555] dark:text-[#cccccc] mb-12 flex items-center">
                        <?php echo $product->get_price_html(); ?>
                        <span class="ml-4 text-sm font-normal text-[#999999] tracking-widest uppercase border-l border-[#dddddd] dark:border-[#444444] pl-4">Impuestos Incluidos</span>
                    </div>

                    <!-- Description -->
                    <div class="prose prose-lg text-[#666666] dark:text-[#bbbbbb] mb-12 leading-loose font-medium max-w-none">
                        <?php the_content(); ?>
                    </div>

                    <!-- Add to Cart Form -->
                    <div class="mb-14 w-full">
                        <?php
                        if ( $product->is_type( 'variable' ) ) {
                            woocommerce_variable_add_to_cart();
                        } else {
                            // High-end Add to Cart Button
                            echo '<form action="' . esc_url( $product->add_to_cart_url() ) . '" class="w-full" method="post" enctype="multipart/form-data">';
                            echo '<button type="submit" name="add-to-cart" value="' . esc_attr( $product->get_id() ) . '" class="group w-full relative overflow-hidden bg-black dark:bg-white text-white dark:text-black px-10 py-6 text-sm font-black uppercase tracking-[0.25em] transition-all duration-500 shadow-xl hover:shadow-2xl flex justify-center items-center rounded-sm">';

                            // Hover sheen effect
                            echo '<div class="absolute inset-0 w-0 bg-white dark:bg-black opacity-10 transition-all duration-[800ms] ease-out group-hover:w-full"></div>';

                            echo '<span class="relative z-10 flex items-center space-x-6">';
                            echo '<span>Adquirir fragancia</span>';
                            echo '<span class="w-1 h-1 bg-white dark:bg-black rounded-full opacity-50"></span>';
                            echo '<span class="text-[#aaaaaa] dark:text-[#555555] font-semibold">' . wc_price( $product->get_price() ) . '</span>';
                            echo '</span>';

                            echo '</button>';
                            echo '</form>';
                        }
                        ?>
                    </div>

                    <!-- Luxury Perks List -->
                    <ul class="space-y-6 border-t border-[#eeeeee] dark:border-[#222222] pt-10 text-sm text-[#777777] dark:text-[#999999] font-semibold tracking-wide">
                        <li class="flex items-center group">
                            <span class="w-10 h-10 rounded-full border border-[#dddddd] dark:border-[#444444] flex items-center justify-center mr-6 group-hover:bg-black group-hover:text-white dark:group-hover:bg-white dark:group-hover:text-black transition-colors duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path></svg>
                            </span>
                            Extractos Premium Seleccionados
                        </li>
                        <li class="flex items-center group">
                            <span class="w-10 h-10 rounded-full border border-[#dddddd] dark:border-[#444444] flex items-center justify-center mr-6 group-hover:bg-black group-hover:text-white dark:group-hover:bg-white dark:group-hover:text-black transition-colors duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </span>
                            Libre de Crueldad Animal
                        </li>
                        <li class="flex items-center group">
                            <span class="w-10 h-10 rounded-full border border-[#dddddd] dark:border-[#444444] flex items-center justify-center mr-6 group-hover:bg-black group-hover:text-white dark:group-hover:bg-white dark:group-hover:text-black transition-colors duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            </span>
                            Envase Elegante y Sostenible
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
