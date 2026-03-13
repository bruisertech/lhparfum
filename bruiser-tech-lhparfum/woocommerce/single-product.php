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

    <!-- Full-width minimalist container for absolute cleanliness -->
    <div class="max-w-[100rem] mx-auto px-4 sm:px-6 lg:px-12 py-16 md:py-24 transition-colors duration-500">
        <?php while ( have_posts() ) : ?>
            <?php the_post(); ?>
            <?php global $product; ?>

            <div class="flex flex-col lg:flex-row gap-16 lg:gap-32 items-center lg:items-start">

                <!-- Product Image Gallery (The Protagonist) -->
                <div class="w-full lg:w-1/2 flex justify-center lg:justify-end">
                    <div class="sticky top-32 group relative overflow-visible w-full max-w-2xl">

                        <!-- Rarity LED Glow Behind the Image (Massive ambience effect) -->
                        <?php
                            $rareza_terms = get_the_terms( $product->get_id(), 'lh_rareza' );
                            $glow_class = 'bg-white dark:bg-black'; // Default soft
                            if ( $rareza_terms && ! is_wp_error( $rareza_terms ) ) {
                                $slug = $rareza_terms[0]->slug;
                                if ( $slug === 'nicho' ) $glow_class = 'bg-yellow-400 opacity-20 dark:opacity-10 animate-pulse-glow-gold blur-3xl';
                                elseif ( $slug === 'arabe' ) $glow_class = 'bg-purple-600 opacity-20 dark:opacity-10 animate-pulse-glow-purple blur-3xl';
                                elseif ( $slug === 'disenador' ) $glow_class = 'bg-blue-500 opacity-20 dark:opacity-10 animate-pulse-glow-blue blur-3xl';
                                else $glow_class = 'bg-green-500 opacity-20 dark:opacity-10 animate-pulse-glow-green blur-3xl';
                            }
                            echo '<div class="absolute -inset-10 z-0 rounded-full transition-all duration-[2000ms] ' . esc_attr($glow_class) . ' pointer-events-none"></div>';
                        ?>

                        <!-- Main Image -->
                        <div class="relative z-10 bg-transparent p-4 md:p-8 transition-transform duration-[1500ms] ease-out group-hover:scale-105">
                            <?php
                                $image_id  = $product->get_image_id();
                                $image_url = wp_get_attachment_image_url( $image_id, 'full' );
                                if ( $image_url ) {
                                    echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $product->get_name() ) . '" class="w-full h-auto object-cover shadow-none drop-shadow-2xl mix-blend-multiply dark:mix-blend-normal">';
                                } else {
                                    echo wc_placeholder_img( 'woocommerce_single' );
                                }
                            ?>
                        </div>

                        <!-- Mini Thumbnails (Minimalist dots or floating small squares) -->
                        <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2 flex space-x-4 opacity-0 group-hover:opacity-100 transition-opacity duration-700 z-20">
                           <?php
                           $attachment_ids = $product->get_gallery_image_ids();
                           if ( $attachment_ids ) {
                               foreach ( $attachment_ids as $attachment_id ) {
                                   echo '<div class="w-16 h-16 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-sm overflow-hidden flex-shrink-0 cursor-pointer hover:border-black dark:hover:border-white transition-all duration-300 shadow-lg">';
                                   echo wp_get_attachment_image( $attachment_id, 'thumbnail', false, array( 'class' => 'w-full h-full object-cover mix-blend-multiply dark:mix-blend-normal' ) );
                                   echo '</div>';
                               }
                           }
                           ?>
                        </div>
                    </div>
                </div>

                <!-- Product Info & Add to Cart (Clean, Typography Focused) -->
                <div class="w-full lg:w-1/2 flex flex-col justify-start pt-12 lg:pt-24 max-w-xl">

                    <!-- Massive Rarity Pill -->
                    <div class="mb-10">
                        <?php
                            if ( $rareza_terms && ! is_wp_error( $rareza_terms ) ) {
                                $term = $rareza_terms[0];
                                $slug = $term->slug;

                                $pill_classes = 'inline-block px-8 py-3 rounded-full text-sm font-black uppercase tracking-[0.3em] text-white transition-all duration-1000 shadow-2xl relative overflow-hidden';

                                if ( $slug === 'nicho' ) {
                                    $pill_classes .= ' bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 animate-pulse-glow-gold';
                                } elseif ( $slug === 'arabe' ) {
                                    $pill_classes .= ' bg-gradient-to-r from-purple-500 via-purple-600 to-purple-800 animate-pulse-glow-purple';
                                } elseif ( $slug === 'disenador' ) {
                                    $pill_classes .= ' bg-gradient-to-r from-blue-400 via-blue-500 to-blue-700 animate-pulse-glow-blue';
                                } else {
                                    $pill_classes .= ' bg-gradient-to-r from-emerald-400 via-emerald-500 to-emerald-700 animate-pulse-glow-green';
                                }

                                echo '<span class="' . esc_attr( $pill_classes ) . '">';
                                echo '<span class="relative z-10 drop-shadow-md">' . esc_html( $term->name ) . '</span>';
                                echo '<div class="absolute inset-0 bg-white opacity-20 mix-blend-overlay"></div>';
                                echo '</span>';
                            }
                        ?>
                    </div>

                    <!-- Title -->
                    <h1 class="text-6xl md:text-8xl font-black text-black dark:text-white tracking-tighter mb-4 leading-[0.9]">
                        <?php the_title(); ?>
                    </h1>

                    <!-- Aroma (Protagonismo) -->
                    <div class="mb-12">
                        <?php
                            $aroma_terms = get_the_terms( $product->get_id(), 'lh_aroma' );
                            if ( $aroma_terms && ! is_wp_error( $aroma_terms ) ) {
                                echo '<span class="text-2xl md:text-3xl font-light italic font-serif text-[#888888] dark:text-[#aaaaaa] tracking-wide block border-b border-[#eeeeee] dark:border-[#222222] pb-6">';
                                echo 'Aroma: <span class="font-medium text-black dark:text-white not-italic uppercase tracking-[0.2em] text-lg ml-2">' . esc_html( $aroma_terms[0]->name ) . '</span>';
                                echo '</span>';
                            }
                        ?>
                    </div>

                    <!-- Price -->
                    <div class="text-3xl md:text-4xl font-light text-black dark:text-white mb-10 flex items-center">
                        <?php echo $product->get_price_html(); ?>
                        <?php
                            $genero_terms = get_the_terms( $product->get_id(), 'lh_genero' );
                            if ( $genero_terms && ! is_wp_error( $genero_terms ) ) {
                                echo '<span class="ml-6 text-xs font-semibold text-[#999999] tracking-[0.2em] uppercase border-l border-[#dddddd] dark:border-[#444444] pl-6 py-1">Para ' . esc_html( $genero_terms[0]->name ) . '</span>';
                            }
                        ?>
                    </div>

                    <!-- Description (Clean & Minimal) -->
                    <div class="text-lg text-[#666666] dark:text-[#999999] mb-16 leading-loose font-light">
                        <?php the_content(); ?>
                    </div>

                    <!-- Add to Cart Form with Glowing LED Button -->
                    <div class="mb-16 w-full">
                        <?php
                        if ( $product->is_type( 'variable' ) ) {
                            woocommerce_variable_add_to_cart();
                        } else {
                            // High-end Glowing LED Button
                            echo '<form action="' . esc_url( $product->add_to_cart_url() ) . '" class="w-full" method="post" enctype="multipart/form-data">';

                            // Determine button glow color based on rarity
                            $btn_glow_class = 'animate-pulse-glow-white dark:animate-pulse-glow-white hover:animate-none'; // Default
                            if ( $rareza_terms && ! is_wp_error( $rareza_terms ) ) {
                                $slug = $rareza_terms[0]->slug;
                                if ( $slug === 'nicho' ) $btn_glow_class = 'hover:animate-pulse-glow-gold';
                                elseif ( $slug === 'arabe' ) $btn_glow_class = 'hover:animate-pulse-glow-purple';
                                elseif ( $slug === 'disenador' ) $btn_glow_class = 'hover:animate-pulse-glow-blue';
                                else $btn_glow_class = 'hover:animate-pulse-glow-green';
                            }

                            echo '<button type="submit" name="add-to-cart" value="' . esc_attr( $product->get_id() ) . '" class="group w-full relative overflow-hidden bg-black dark:bg-white text-white dark:text-black px-12 py-8 text-sm font-black uppercase tracking-[0.3em] transition-all duration-700 flex justify-between items-center rounded-sm ' . esc_attr($btn_glow_class) . '">';

                            // Sliding sheen effect
                            echo '<div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white dark:via-black to-transparent opacity-20 transition-transform duration-[1500ms] ease-in-out group-hover:translate-x-full"></div>';

                            echo '<span class="relative z-10">Adquirir fragancia</span>';
                            echo '<span class="relative z-10 flex items-center space-x-4">';
                            echo '<span class="w-8 h-[1px] bg-[#555555] dark:bg-[#cccccc]"></span>';
                            echo '<span class="font-normal text-[#dddddd] dark:text-[#333333]">' . wc_price( $product->get_price() ) . '</span>';
                            echo '</span>';

                            echo '</button>';
                            echo '</form>';
                        }
                        ?>
                    </div>

                    <!-- Clean Perks -->
                    <div class="grid grid-cols-2 gap-8 border-t border-[#eeeeee] dark:border-[#111111] pt-12">
                        <div class="text-xs text-[#888888] dark:text-[#777777] font-semibold tracking-widest uppercase flex flex-col space-y-3">
                            <span class="w-8 h-8 rounded-full border border-[#dddddd] dark:border-[#333333] flex items-center justify-center text-black dark:text-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path></svg>
                            </span>
                            Extractos Premium
                        </div>
                        <div class="text-xs text-[#888888] dark:text-[#777777] font-semibold tracking-widest uppercase flex flex-col space-y-3">
                            <span class="w-8 h-8 rounded-full border border-[#dddddd] dark:border-[#333333] flex items-center justify-center text-black dark:text-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </span>
                            Cruelty Free
                        </div>
                    </div>

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
