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

            <div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'flex flex-col-reverse lg:flex-row gap-16 lg:gap-24 items-center lg:items-stretch', $product ); ?>>

                <?php $rareza_terms = get_the_terms( $product->get_id(), 'lh_rareza' ); ?>

                <!-- Product Info & Add to Cart (Left Side Now, Right-Aligned on Desktop, Centered on Mobile) -->
                <div class="w-full lg:w-1/2 flex flex-col items-center text-center lg:items-end lg:text-right pt-8 lg:pt-32 max-w-xl lg:pl-12 mx-auto lg:mx-0">

                    <!-- Delicate Rarity Pill -->
                    <div class="mb-6 flex justify-center lg:justify-end w-full">
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

                    <!-- Marca -->
                    <?php
                        $marca_terms = get_the_terms( $product->get_id(), 'lh_marca' );
                        if ( $marca_terms && ! is_wp_error( $marca_terms ) ) {
                            $term = $marca_terms[0];
                            $term_link = get_term_link( $term );
                            echo '<a href="' . esc_url( $term_link ) . '" class="text-xs md:text-sm font-black uppercase tracking-[0.4em] text-[#999999] hover:text-black dark:hover:text-white transition-colors mb-2 w-full">';
                            echo esc_html( $term->name );
                            echo '</a>';
                        }
                    ?>

                    <!-- Title -->
                    <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white tracking-tight mb-4 leading-tight w-full">
                        <?php the_title(); ?>
                    </h1>

                    <!-- Aroma (Protagonismo Elegante) -->
                    <div class="mb-8 w-full flex justify-center lg:justify-end">
                        <?php
                            $aroma_terms = get_the_terms( $product->get_id(), 'lh_aroma' );
                            if ( $aroma_terms && ! is_wp_error( $aroma_terms ) ) {
                                $term = $aroma_terms[0];
                                $term_link = get_term_link( $term );
                                echo '<div class="text-lg md:text-xl font-light italic font-serif text-[#777777] dark:text-[#aaaaaa] tracking-wide inline-block border-b border-[#eeeeee] dark:border-[#222222] pb-4">';
                                echo 'Familia Olfativa: ';
                                echo '<a href="' . esc_url( $term_link ) . '" class="font-semibold text-gray-800 dark:text-gray-200 not-italic uppercase tracking-[0.15em] text-sm ml-2 hover:text-black dark:hover:text-white hover:underline transition-colors">';
                                echo esc_html( $term->name );
                                echo '</a>';
                                echo '</div>';
                            }
                        ?>
                    </div>

                    <!-- Price & Gender -->
                    <div class="text-2xl md:text-3xl font-light text-gray-900 dark:text-white mb-8 flex items-center justify-center lg:justify-end w-full">
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
                    <div class="text-base md:text-lg text-[#555555] dark:text-[#bbbbbb] mb-12 leading-relaxed font-normal w-full">
                        <?php the_content(); ?>
                    </div>

                    <!-- Add to Cart Form with Core WooCommerce Integration -->
                    <?php
                        $btn_glow_class = '';
                        $btn_color_override = '';
                        if ( $rareza_terms && ! is_wp_error( $rareza_terms ) ) {
                            $slug = $rareza_terms[0]->slug;
                            if ( $slug === 'nicho' ) {
                                $btn_glow_class = 'glow-nicho';
                                $btn_color_override = 'btn-bg-nicho';
                            } elseif ( $slug === 'arabe' ) {
                                $btn_glow_class = 'glow-arabe';
                                $btn_color_override = 'btn-bg-arabe';
                            } elseif ( $slug === 'disenador' ) {
                                $btn_glow_class = 'glow-disenador';
                                $btn_color_override = 'btn-bg-disenador';
                            } else {
                                $btn_glow_class = 'glow-accesible';
                                $btn_color_override = 'btn-bg-accesible';
                            }
                        }
                    ?>
                    <div class="mb-16 w-full flex justify-center lg:justify-end custom-add-to-cart-wrapper <?php echo esc_attr($btn_glow_class . ' ' . $btn_color_override); ?>">
                        <?php
                            // Force WooCommerce to output the standard add to cart logic (for variables, quantity, etc)
                            // But we will style it via CSS to match the LED aesthetic.
                            do_action( 'woocommerce_' . $product->get_type() . '_add_to_cart' );
                        ?>
                    </div>

                </div>

                <!-- Product Image Gallery (Right Side, Stretches to match text height perfectly) -->
                <div class="w-full lg:w-1/2 flex justify-center lg:justify-start h-auto">
                    <!-- Added pt-8 lg:pt-16 to align the top of the image perfectly with the top of the text block (the rarity pill) -->
                    <div class="group relative overflow-visible w-full max-w-md h-full flex flex-col pt-8 lg:pt-16">

                        <!-- Rarity LED Glow Behind the Image (Massive ambience effect) -->
                        <?php
                            $glow_class = 'bg-white dark:bg-black blur-3xl'; // Default soft
                            if ( $rareza_terms && ! is_wp_error( $rareza_terms ) ) {
                                $slug = $rareza_terms[0]->slug;
                                // Increased opacity and blur spread for a much stronger, ethereal LED glow requested by user
                                if ( $slug === 'nicho' ) $glow_class = 'bg-yellow-400 opacity-40 dark:opacity-30 animate-pulse-glow-gold blur-[64px]';
                                elseif ( $slug === 'arabe' ) $glow_class = 'bg-purple-600 opacity-40 dark:opacity-30 animate-pulse-glow-purple blur-[64px]';
                                elseif ( $slug === 'disenador' ) $glow_class = 'bg-blue-500 opacity-40 dark:opacity-30 animate-pulse-glow-blue blur-[64px]';
                                else $glow_class = 'bg-green-500 opacity-40 dark:opacity-30 animate-pulse-glow-green blur-[64px]';
                            }
                            echo '<div class="absolute -inset-20 z-0 rounded-full transition-all duration-[2000ms] ' . esc_attr($glow_class) . ' pointer-events-none mix-blend-screen"></div>';
                        ?>

                        <!-- Main Image (Enforced Max Height to prevent overwhelming the button) -->
                        <div class="relative z-10 bg-transparent p-0 transition-transform duration-[1500ms] ease-out group-hover:scale-[1.02] overflow-hidden rounded-sm flex-grow w-full h-full max-h-[600px] self-start lg:ml-auto">
                            <?php
                                $image_id  = $product->get_image_id();
                                $image_url = wp_get_attachment_image_url( $image_id, 'full' );
                                if ( $image_url ) {
                                    // Use object-contain or cover with a max-height to ensure the image does not bleed past the add-to-cart boundary
                                    echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $product->get_name() ) . '" class="absolute inset-0 w-full h-full object-cover lg:object-contain object-top shadow-none drop-shadow-2xl mix-blend-multiply dark:mix-blend-normal">';
                                } else {
                                    echo wc_placeholder_img( 'woocommerce_single' );
                                }
                            ?>
                        </div>

                        <!-- Mini Thumbnails (Minimalist dots or floating small squares) -->
                        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-4 opacity-0 group-hover:opacity-100 transition-opacity duration-700 z-20">
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

            </div>

            <!-- Clean Global Perks (3 Columns, Centered across entire page width) -->
            <div class="w-full mt-16 md:mt-24">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-12 max-w-4xl mx-auto justify-items-center">
                    <div class="text-[10px] md:text-xs text-[#888888] dark:text-[#777777] font-semibold tracking-widest uppercase flex flex-col items-center text-center space-y-4">
                        <span class="w-12 h-12 rounded-full border border-[#dddddd] dark:border-[#333333] flex items-center justify-center text-black dark:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                        </span>
                        <span>Fragancia verificada por LH originals<br><span class="text-[9px] md:text-[10px] text-[#aaaaaa] mt-1 block">Perfume genuino y original</span></span>
                    </div>
                    <div class="text-[10px] md:text-xs text-[#888888] dark:text-[#777777] font-semibold tracking-widest uppercase flex flex-col items-center text-center space-y-4">
                        <span class="w-12 h-12 rounded-full border border-[#dddddd] dark:border-[#333333] flex items-center justify-center text-black dark:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </span>
                        <span>Cruelty Free</span>
                    </div>
                    <div class="text-[10px] md:text-xs text-[#888888] dark:text-[#777777] font-semibold tracking-widest uppercase flex flex-col items-center text-center space-y-4">
                        <span class="w-12 h-12 rounded-full border border-[#dddddd] dark:border-[#333333] flex items-center justify-center text-black dark:text-white">
                            <!-- Temperature / Snowflake Icon for storage -->
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 2v20M17 5l-5 5-5-5m10 14l-5-5-5 5" opacity="0.3"></path></svg>
                        </span>
                        <span>Almacenado en ambiente adecuado<br><span class="text-[9px] md:text-[10px] text-[#aaaaaa] mt-1 block">LH Integrity</span></span>
                    </div>
                </div>
            </div>

            <!-- Related Products (Interactive JS Carousel with Arrows) -->
            <?php
            $related_args = array(
                'post_type'      => 'product',
                'posts_per_page' => 8,
                'post__not_in'   => array( $product->get_id() ),
                'orderby'        => 'rand',
            );

            $related_products = new WP_Query( $related_args );

            if ( $related_products->have_posts() ) {
                echo '<div class="mt-24 lg:mt-32 pt-16 border-t border-[#eeeeee] dark:border-[#222222] w-full relative">';

                echo '<div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-6">';
                echo '<h3 class="text-xs md:text-sm font-black uppercase tracking-[0.3em] text-[#999999]">Descubre Otras Fragancias</h3>';

                // Elegant Navigation Arrows
                echo '<div class="flex space-x-4">';
                echo '<button type="button" id="lh-carousel-prev" aria-label="Previous" class="w-10 h-10 rounded-full border border-[#dddddd] dark:border-[#333333] flex items-center justify-center text-black dark:text-white hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-colors focus:outline-none"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"></path></svg></button>';
                echo '<button type="button" id="lh-carousel-next" aria-label="Next" class="w-10 h-10 rounded-full border border-[#dddddd] dark:border-[#333333] flex items-center justify-center text-black dark:text-white hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-colors focus:outline-none"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"></path></svg></button>';
                echo '</div>';
                echo '</div>'; // End Header Flex

                // Continuous Splide.js integration (with AutoScroll extension)
                // Hiding pagination and native arrows since we handle them manually
                echo '<style>
                    .splide__pagination, .splide__arrows { display: none !important; }
                    .splide__slide { height: auto !important; }
                </style>';

                echo '<div class="relative w-full overflow-hidden">';
                echo '<div class="splide lh-related-splide w-full">';
                echo '<div class="splide__track">';
                echo '<ul class="splide__list">';

                while ( $related_products->have_posts() ) : $related_products->the_post();
                    global $product;
                    $link = get_the_permalink();

                    // Harvest taxonomies for the unified text string
                    $tax_string = array();

                    $m_marca = get_the_terms( $product->get_id(), 'lh_marca' );
                    if ( $m_marca && ! is_wp_error( $m_marca ) ) $tax_string[] = esc_html( $m_marca[0]->name );

                    $m_genero = get_the_terms( $product->get_id(), 'lh_genero' );
                    if ( $m_genero && ! is_wp_error( $m_genero ) ) $tax_string[] = esc_html( $m_genero[0]->name );

                    $m_rareza = get_the_terms( $product->get_id(), 'lh_rareza' );
                    if ( $m_rareza && ! is_wp_error( $m_rareza ) ) {
                        $tax_string[] = esc_html( $m_rareza[0]->name );
                        $c_slug = $m_rareza[0]->slug;
                    } else {
                        $c_slug = '';
                    }

                    $formatted_taxonomies = implode(' &bull; ', $tax_string);

                    $carousel_btn_bg = 'bg-gray-900 dark:bg-white text-white dark:text-black';
                    if ( $c_slug === 'nicho' ) $carousel_btn_bg = 'bg-gradient-to-r from-yellow-400 to-yellow-600 text-white shadow-md hover:shadow-lg hover:shadow-yellow-500/20';
                    elseif ( $c_slug === 'arabe' ) $carousel_btn_bg = 'bg-gradient-to-r from-purple-500 to-purple-800 text-white shadow-md hover:shadow-lg hover:shadow-purple-500/20';
                    elseif ( $c_slug === 'disenador' ) $carousel_btn_bg = 'bg-gradient-to-r from-blue-400 to-blue-700 text-white shadow-md hover:shadow-lg hover:shadow-blue-500/20';
                    elseif ( $c_slug === 'accesible' ) $carousel_btn_bg = 'bg-gradient-to-r from-emerald-400 to-emerald-700 text-white shadow-md hover:shadow-lg hover:shadow-emerald-500/20';

                    ?>
                    <li class="splide__slide w-[240px] md:w-[280px] lg:w-[320px] px-3">
                        <div class="group relative flex flex-col items-center text-center transition duration-300 bg-transparent h-full">
                            <!-- Image without pills, completely clean -->
                            <div class="relative w-full aspect-[3/4] overflow-hidden rounded-sm shadow-md group-hover:shadow-xl transition-shadow duration-300 mb-0">
                                <a href="<?php echo esc_url( $link ); ?>" class="absolute inset-0 z-20" aria-label="<?php the_title_attribute(); ?>"></a>
                                <?php echo $product->get_image( 'woocommerce_thumbnail', array( 'class' => 'absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 block m-0 p-0' ) ); ?>
                            </div>

                            <div class="flex flex-col justify-start w-full px-1 items-center text-center">
                                <!-- Elegant, unified taxonomy string -->
                                <?php if ( ! empty( $formatted_taxonomies ) ) : ?>
                                    <span class="text-[8px] md:text-[9px] font-black uppercase tracking-[0.25em] text-[#999999] mb-1.5 leading-relaxed">
                                        <?php echo $formatted_taxonomies; ?>
                                    </span>
                                <?php endif; ?>

                                <!-- Title -->
                                <h2 class="text-sm md:text-base font-bold text-black dark:text-white mb-1 tracking-wide whitespace-normal leading-tight line-clamp-1">
                                    <a href="<?php echo esc_url( $link ); ?>" class="hover:underline decoration-2 underline-offset-4">
                                        <?php echo get_the_title(); ?>
                                    </a>
                                </h2>

                                <!-- Price -->
                                <div class="text-xs text-[#666666] dark:text-[#bbbbbb] font-light mb-4">
                                    <?php echo $product->get_price_html(); ?>
                                </div>

                                <!-- Dynamic Button -->
                                <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="inline-block px-5 py-2.5 w-full max-w-[85%] text-[8px] font-black uppercase tracking-[0.2em] rounded-sm transition-all duration-300 transform group-hover:scale-105 <?php echo esc_attr($carousel_btn_bg); ?>">
                                    Adquirir fragancia
                                </a>
                            </div>
                        </div>
                    </li>
                    <?php
                endwhile;
                wp_reset_postdata();

                echo '</ul></div></div></div></div>'; // End wrappers

                // Splide.js Initialization Script
                ?>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        if (typeof Splide !== 'undefined') {
                            const splideElement = document.querySelector('.lh-related-splide');
                            if (!splideElement) return;

                            // Default positive speed for continuous scrolling
                            const NORMAL_SPEED = 1;
                            const SLOW_SPEED = 0.3; // Much slower on hover

                            const splide = new Splide( '.lh-related-splide', {
                                type   : 'loop',
                                drag   : 'free',
                                focus  : 'center',
                                perPage: 4, // Number of items visible at a time
                                gap    : 0,
                                autoWidth: true,
                                arrows : false,
                                pagination: false,
                                breakpoints: {
                                    1024: { perPage: 3 },
                                    768: { perPage: 2 },
                                    640: { perPage: 1 }
                                },
                                autoScroll: {
                                    speed: NORMAL_SPEED,
                                    pauseOnHover: false,
                                    pauseOnFocus: false,
                                },
                            } );

                            splide.mount( window.splide.Extensions );

                            // Direction control via Custom Arrows
                            const prevBtn = document.getElementById('lh-carousel-prev');
                            const nextBtn = document.getElementById('lh-carousel-next');

                            let currentDirectionMultiplier = 1; // 1 for normal (left), -1 for reverse (right)
                            let currentAbsoluteSpeed = NORMAL_SPEED; // Either NORMAL_SPEED or SLOW_SPEED

                            const updateSpeed = () => {
                                splide.Components.AutoScroll.play();
                                // By multiplying absolute speed with direction, we handle hover and direction uniformly
                                splide.options = {
                                    autoScroll: {
                                        speed: currentAbsoluteSpeed * currentDirectionMultiplier,
                                    }
                                };
                            };

                            if (prevBtn) {
                                prevBtn.addEventListener('click', (e) => {
                                    e.preventDefault();
                                    currentDirectionMultiplier = -1; // Scroll right
                                    updateSpeed();
                                });
                            }

                            if (nextBtn) {
                                nextBtn.addEventListener('click', (e) => {
                                    e.preventDefault();
                                    currentDirectionMultiplier = 1; // Scroll left
                                    updateSpeed();
                                });
                            }

                            // Smooth hover slowdown
                            splideElement.addEventListener('mouseenter', () => {
                                currentAbsoluteSpeed = SLOW_SPEED;
                                updateSpeed();
                            });

                            splideElement.addEventListener('mouseleave', () => {
                                currentAbsoluteSpeed = NORMAL_SPEED;
                                updateSpeed();
                            });
                        }
                    });
                </script>
                <?php
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
