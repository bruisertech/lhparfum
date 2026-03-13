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

            <?php
                // WooCommerce Core Action: Important for notices and some plugin integrations
                do_action( 'woocommerce_before_single_product' );
                if ( post_password_required() ) {
                    echo get_the_password_form(); // WPCS: XSS ok.
                    return;
                }
            ?>

            <div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'flex flex-col lg:flex-row gap-16 lg:gap-32 items-center lg:items-start', $product ); ?>>

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

                        <!-- Main Image (Enforced Aspect Ratio) -->
                        <div class="relative z-10 bg-transparent p-0 transition-transform duration-[1500ms] ease-out group-hover:scale-105 overflow-hidden rounded-sm" style="aspect-ratio: 3/4;">
                            <?php
                                $image_id  = $product->get_image_id();
                                $image_url = wp_get_attachment_image_url( $image_id, 'full' );
                                if ( $image_url ) {
                                    echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $product->get_name() ) . '" class="absolute inset-0 w-full h-full object-cover shadow-none drop-shadow-2xl mix-blend-multiply dark:mix-blend-normal">';
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
                <div class="w-full lg:w-1/2 flex flex-col justify-start pt-8 lg:pt-16 max-w-xl">

                    <!-- Delicate Rarity Pill -->
                    <div class="mb-6">
                        <?php
                            if ( $rareza_terms && ! is_wp_error( $rareza_terms ) ) {
                                $term = $rareza_terms[0];
                                $slug = $term->slug;
                                $term_link = get_term_link( $term );

                                $pill_classes = 'inline-block px-5 py-2 rounded-full text-[10px] md:text-xs font-bold uppercase tracking-[0.25em] text-white transition-all duration-1000 shadow-md relative overflow-hidden group/pill hover:scale-105';

                                if ( $slug === 'nicho' ) {
                                    $pill_classes .= ' bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 animate-pulse-glow-gold';
                                } elseif ( $slug === 'arabe' ) {
                                    $pill_classes .= ' bg-gradient-to-r from-purple-500 via-purple-600 to-purple-800 animate-pulse-glow-purple';
                                } elseif ( $slug === 'disenador' ) {
                                    $pill_classes .= ' bg-gradient-to-r from-blue-400 via-blue-500 to-blue-700 animate-pulse-glow-blue';
                                } else {
                                    $pill_classes .= ' bg-gradient-to-r from-emerald-400 via-emerald-500 to-emerald-700 animate-pulse-glow-green';
                                }

                                echo '<a href="' . esc_url( $term_link ) . '" class="' . esc_attr( $pill_classes ) . '">';
                                echo '<span class="relative z-10">' . esc_html( $term->name ) . '</span>';
                                echo '<div class="absolute inset-0 bg-white opacity-20 mix-blend-overlay group-hover/pill:opacity-40 transition-opacity duration-300"></div>';
                                echo '</a>';
                            }
                        ?>
                    </div>

                    <!-- Title -->
                    <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white tracking-tight mb-2 leading-tight">
                        <?php the_title(); ?>
                    </h1>

                    <!-- Aroma (Protagonismo Elegante) -->
                    <div class="mb-8">
                        <?php
                            $aroma_terms = get_the_terms( $product->get_id(), 'lh_aroma' );
                            if ( $aroma_terms && ! is_wp_error( $aroma_terms ) ) {
                                $term = $aroma_terms[0];
                                $term_link = get_term_link( $term );
                                echo '<div class="text-lg md:text-xl font-light italic font-serif text-[#777777] dark:text-[#aaaaaa] tracking-wide block border-b border-[#eeeeee] dark:border-[#222222] pb-4">';
                                echo 'Familia Olfativa: ';
                                echo '<a href="' . esc_url( $term_link ) . '" class="font-semibold text-gray-800 dark:text-gray-200 not-italic uppercase tracking-[0.15em] text-sm ml-2 hover:text-black dark:hover:text-white hover:underline transition-colors">';
                                echo esc_html( $term->name );
                                echo '</a>';
                                echo '</div>';
                            }
                        ?>
                    </div>

                    <!-- Price & Gender -->
                    <div class="text-2xl md:text-3xl font-light text-gray-900 dark:text-white mb-8 flex items-center">
                        <?php echo $product->get_price_html(); ?>
                        <?php
                            $genero_terms = get_the_terms( $product->get_id(), 'lh_genero' );
                            if ( $genero_terms && ! is_wp_error( $genero_terms ) ) {
                                $term = $genero_terms[0];
                                $term_link = get_term_link( $term );
                                echo '<a href="' . esc_url( $term_link ) . '" class="ml-4 text-[10px] font-medium text-[#888888] tracking-[0.15em] uppercase border-l border-[#dddddd] dark:border-[#444444] pl-4 py-1 hover:text-black dark:hover:text-white transition-colors">';
                                echo 'Para ' . esc_html( $term->name );
                                echo '</a>';
                            }
                        ?>
                    </div>

                    <!-- Description (Clean & Minimal) -->
                    <div class="text-base md:text-lg text-[#555555] dark:text-[#bbbbbb] mb-12 leading-relaxed font-normal">
                        <?php the_content(); ?>
                    </div>

                    <!-- Add to Cart Form with Core WooCommerce Integration -->
                    <?php
                        $btn_glow_class = '';
                        if ( $rareza_terms && ! is_wp_error( $rareza_terms ) ) {
                            $slug = $rareza_terms[0]->slug;
                            if ( $slug === 'nicho' ) $btn_glow_class = 'glow-nicho';
                            elseif ( $slug === 'arabe' ) $btn_glow_class = 'glow-arabe';
                            elseif ( $slug === 'disenador' ) $btn_glow_class = 'glow-disenador';
                            else $btn_glow_class = 'glow-accesible';
                        }
                    ?>
                    <div class="mb-16 w-full custom-add-to-cart-wrapper <?php echo esc_attr($btn_glow_class); ?>">
                        <?php
                            // Force WooCommerce to output the standard add to cart logic (for variables, quantity, etc)
                            // But we will style it via CSS to match the LED aesthetic.
                            do_action( 'woocommerce_' . $product->get_type() . '_add_to_cart' );
                        ?>
                    </div>

                    <!-- Clean Perks -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 border-t border-[#eeeeee] dark:border-[#111111] pt-12">
                        <div class="text-[10px] md:text-xs text-[#888888] dark:text-[#777777] font-semibold tracking-widest uppercase flex flex-col space-y-3">
                            <span class="w-10 h-10 rounded-full border border-[#dddddd] dark:border-[#333333] flex items-center justify-center text-black dark:text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                            </span>
                            Fragancia verificada por LH originals<br><span class="text-[9px] text-[#aaaaaa] mt-1">Perfume genuino y original</span>
                        </div>
                        <div class="text-[10px] md:text-xs text-[#888888] dark:text-[#777777] font-semibold tracking-widest uppercase flex flex-col space-y-3">
                            <span class="w-10 h-10 rounded-full border border-[#dddddd] dark:border-[#333333] flex items-center justify-center text-black dark:text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </span>
                            Cruelty Free
                        </div>
                    </div>

                </div>
            </div>

            <!-- Related Products (Infinite Scroll Carousel) -->
            <?php
            $related_args = array(
                'post_type'      => 'product',
                'posts_per_page' => 8, // Get enough to fill the scroll
                'post__not_in'   => array( $product->get_id() ),
                'orderby'        => 'rand', // Show variety from the store
            );

            $related_products = new WP_Query( $related_args );

            if ( $related_products->have_posts() ) {
                echo '<div class="mt-24 lg:mt-32 pt-16 border-t border-[#eeeeee] dark:border-[#222222] w-full overflow-hidden">';
                echo '<h3 class="text-xs font-black uppercase tracking-[0.3em] text-[#999999] text-center mb-12">Descubre Otras Fragancias Excepcionales</h3>';

                // We use CSS animations for an elegant infinite scroll effect
                echo '<div class="relative w-full flex overflow-hidden group/slider">';

                // Inner track that moves
                echo '<div class="flex whitespace-nowrap animate-slide-left hover:[animation-play-state:paused]">';

                // We duplicate the loop twice to create the seamless infinite scroll illusion
                for ($i = 0; $i < 2; $i++) {
                    while ( $related_products->have_posts() ) : $related_products->the_post();
                        global $product;
                        $link = get_the_permalink();
                        ?>
                        <div class="inline-block w-64 md:w-80 px-4 transition-transform duration-500">
                            <div class="group relative flex flex-col items-center text-center transition duration-300 bg-transparent h-full">
                                <a href="<?php echo esc_url( $link ); ?>" class="block w-full overflow-hidden bg-[#f8f8f8] dark:bg-[#111111] relative rounded-sm shadow-sm group-hover:shadow-lg transition-shadow duration-300" style="aspect-ratio: 3/4;">
                                    <?php echo $product->get_image( 'woocommerce_thumbnail', array( 'class' => 'absolute inset-0 w-full h-full object-cover mix-blend-multiply dark:mix-blend-normal group-hover:scale-105 transition-transform duration-700 ease-in-out' ) ); ?>
                                </a>
                                <div class="mt-6 flex flex-col justify-between flex-grow w-full px-2 items-center text-center">
                                    <h2 class="text-sm md:text-base font-black text-black dark:text-white mb-2 tracking-tight whitespace-normal">
                                        <a href="<?php echo esc_url( $link ); ?>" class="hover:underline decoration-2 underline-offset-4">
                                            <?php echo get_the_title(); ?>
                                        </a>
                                    </h2>
                                    <div class="text-xs text-[#666666] dark:text-[#bbbbbb] font-light">
                                        <?php echo $product->get_price_html(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    // Reset post data to loop again for the second set
                    $related_products->rewind_posts();
                }

                echo '</div></div></div>';
                wp_reset_postdata();
            }
            ?>

            <?php
                // Remove default WooCommerce related products so we don't have duplicates
                remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
                do_action( 'woocommerce_after_single_product' );
            ?>

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
