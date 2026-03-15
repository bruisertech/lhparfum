<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header( 'shop' );

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
    echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
    return;
}
?>

<div class="max-w-[100rem] mx-auto px-4 sm:px-6 lg:px-12 py-12 md:py-24 transition-colors duration-500 overflow-x-hidden w-full">

    <div class="text-center mb-16">
        <h1 class="text-3xl md:text-5xl font-black uppercase tracking-[0.25em] text-gray-900 dark:text-white">
            Finalizar Orden
        </h1>
        <p class="text-xs md:text-sm font-medium text-gray-500 dark:text-gray-400 mt-4 tracking-widest uppercase">Estás a un paso de tu nueva fragancia</p>
    </div>

    <form name="checkout" method="post" class="checkout woocommerce-checkout flex flex-col lg:flex-row gap-12 lg:gap-24" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

        <!-- LEFT COLUMN: Customer Details (Forms) -->
        <div class="w-full lg:w-3/5">
            <?php if ( $checkout->get_checkout_fields() ) : ?>
                <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                <div class="col2-set space-y-12" id="customer_details">
                    <div class="col-1">
                        <div class="bg-transparent">
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white mb-6 uppercase tracking-widest border-b border-gray-200 dark:border-gray-800 pb-4">
                                <?php esc_html_e( 'Detalles de Facturación', 'bruiser-tech-lhparfum' ); ?>
                            </h3>
                            <?php do_action( 'woocommerce_checkout_billing' ); ?>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="bg-transparent mt-12">
                            <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                        </div>
                    </div>
                </div>

                <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
            <?php endif; ?>
        </div>

        <!-- RIGHT COLUMN: Order Review & Payment (Sticky App-like Glassmorphism Card) -->
        <div class="w-full lg:w-2/5">
            <div class="sticky top-24 bg-white/60 dark:bg-black/40 backdrop-blur-2xl border border-white/20 dark:border-gray-800/50 shadow-[0_30px_60px_rgba(0,0,0,0.05)] dark:shadow-[0_30px_60px_rgba(0,0,0,0.5)] rounded-[2rem] p-6 md:p-10 transition-all duration-500">
                <h3 id="order_review_heading" class="text-base md:text-lg font-black text-gray-900 dark:text-white mb-8 uppercase tracking-[0.2em] text-center w-full block">
                    <?php esc_html_e( 'Tu Orden', 'bruiser-tech-lhparfum' ); ?>
                </h3>

                <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

                <div id="order_review" class="woocommerce-checkout-review-order">
                    <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                </div>

                <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
            </div>
        </div>

    </form>

    <!-- Cross-Sell / Last Minute Additions Carousel (Splide.js injected below forms) -->
    <?php
    $related_args = array(
        'post_type'      => 'product',
        'posts_per_page' => 8,
        'orderby'        => 'rand',
    );

    // If there are products in cart, exclude them from suggestions
    $cart_ids = array();
    foreach ( WC()->cart->get_cart() as $cart_item ) {
        $cart_ids[] = $cart_item['product_id'];
    }
    if ( ! empty( $cart_ids ) ) {
        $related_args['post__not_in'] = $cart_ids;
    }

    $related_products = new WP_Query( $related_args );

    if ( $related_products->have_posts() ) {
        echo '<div class="mt-32 pt-16 border-t border-gray-200 dark:border-gray-800 w-full relative">';

        echo '<div class="flex flex-col items-center mb-12">';
        echo '<h3 class="text-sm md:text-base font-black uppercase tracking-[0.3em] text-gray-900 dark:text-white mb-2 text-center">Completa tu colección</h3>';
        echo '<p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-widest text-center">Agrega una última fragancia antes de pagar</p>';
        echo '</div>';

        // Continuous Splide.js integration (with AutoScroll extension)
        echo '<style>
            .splide__pagination, .splide__arrows { display: none !important; }
            .splide__slide { height: auto !important; }
        </style>';

        echo '<div class="relative w-full overflow-hidden px-4 md:px-0">';
        echo '<div class="splide lh-checkout-splide w-full">';
        echo '<div class="splide__track py-8">';
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

            // Button and Glow logic based on rarity
            $carousel_btn_bg = 'bg-black dark:bg-white text-white dark:text-black';
            $glow_class = 'bg-gray-200 dark:bg-gray-800 blur-2xl opacity-50';
            $pill_classes = 'absolute -top-3 -left-3 inline-flex items-center justify-center px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-[0.25em] text-white shadow-lg z-20 transition-transform hover:scale-110 border border-white/20';

            if ( $c_slug === 'nicho' ) {
                $carousel_btn_bg = 'bg-gradient-to-r from-yellow-400 to-yellow-600 text-white shadow-md hover:shadow-lg hover:shadow-yellow-500/20';
                $glow_class = 'bg-yellow-400 opacity-20 dark:opacity-10 blur-[48px] animate-pulse-glow-gold';
                $pill_classes .= ' bg-gradient-to-r from-yellow-400 to-yellow-600';
            } elseif ( $c_slug === 'arabe' ) {
                $carousel_btn_bg = 'bg-gradient-to-r from-purple-500 to-purple-800 text-white shadow-md hover:shadow-lg hover:shadow-purple-500/20';
                $glow_class = 'bg-purple-600 opacity-20 dark:opacity-10 blur-[48px] animate-pulse-glow-purple';
                $pill_classes .= ' bg-gradient-to-r from-purple-500 to-purple-800';
            } elseif ( $c_slug === 'disenador' ) {
                $carousel_btn_bg = 'bg-gradient-to-r from-blue-400 to-blue-700 text-white shadow-md hover:shadow-lg hover:shadow-blue-500/20';
                $glow_class = 'bg-blue-500 opacity-20 dark:opacity-10 blur-[48px] animate-pulse-glow-blue';
                $pill_classes .= ' bg-gradient-to-r from-blue-400 to-blue-700';
            } elseif ( $c_slug === 'accesible' ) {
                $carousel_btn_bg = 'bg-gradient-to-r from-emerald-400 to-emerald-700 text-white shadow-md hover:shadow-lg hover:shadow-emerald-500/20';
                $glow_class = 'bg-emerald-500 opacity-20 dark:opacity-10 blur-[48px] animate-pulse-glow-green';
                $pill_classes .= ' bg-gradient-to-r from-emerald-400 to-emerald-700';
            }

            ?>
            <li class="splide__slide w-[220px] md:w-[260px] lg:w-[300px] px-4">
                <div class="group relative flex flex-col items-center text-center transition duration-500 bg-transparent h-full pt-4">

                    <!-- Rarity Glow Underneath -->
                    <div class="absolute inset-0 <?php echo esc_attr($glow_class); ?> rounded-3xl -z-10 group-hover:scale-110 transition-transform duration-700 pointer-events-none mt-10"></div>

                    <!-- Image Container (Rounded App Style) -->
                    <div class="relative w-full aspect-[3/4] overflow-visible rounded-3xl shadow-[0_20px_40px_rgba(0,0,0,0.08)] dark:shadow-none bg-white dark:bg-[#111] border border-gray-100 dark:border-gray-800 group-hover:shadow-[0_30px_60px_rgba(0,0,0,0.12)] transition-shadow duration-500 mb-6 z-10">
                        <a href="<?php echo esc_url( $link ); ?>" class="absolute inset-0 z-30" aria-label="<?php the_title_attribute(); ?>" target="_blank"></a>

                        <!-- Rarity Pill -->
                        <?php if ( $c_slug ) : ?>
                            <div class="<?php echo esc_attr( $pill_classes ); ?>">
                                <span class="relative z-10"><?php echo esc_html( $m_rareza[0]->name ); ?></span>
                            </div>
                        <?php endif; ?>

                        <!-- Image with forced tailwind aspect ratio classes -->
                        <div class="w-full h-full rounded-3xl overflow-hidden [&_img]:absolute [&_img]:inset-0 [&_img]:w-full [&_img]:h-full [&_img]:object-cover [&_img]:object-center transition-transform duration-[1500ms] group-hover:scale-105">
                            <?php echo $product->get_image( 'woocommerce_thumbnail' ); ?>
                        </div>
                    </div>

                    <div class="flex flex-col justify-start w-full px-2 items-center text-center z-10">
                        <!-- Elegant, unified taxonomy string -->
                        <?php if ( ! empty( $formatted_taxonomies ) ) : ?>
                            <span class="text-[8px] md:text-[9px] font-black uppercase tracking-[0.25em] text-gray-400 dark:text-gray-500 mb-2 leading-relaxed">
                                <?php echo $formatted_taxonomies; ?>
                            </span>
                        <?php endif; ?>

                        <!-- Title -->
                        <h2 class="text-sm md:text-base font-black text-gray-900 dark:text-white mb-1.5 tracking-wide whitespace-normal leading-tight line-clamp-2">
                            <a href="<?php echo esc_url( $link ); ?>" target="_blank" class="hover:underline decoration-2 underline-offset-4">
                                <?php echo get_the_title(); ?>
                            </a>
                        </h2>

                        <!-- Price -->
                        <div class="text-xs text-gray-500 dark:text-gray-400 font-bold tracking-widest mb-5">
                            <?php echo $product->get_price_html(); ?>
                        </div>

                        <!-- Dynamic Button (Pill shaped for App feel) -->
                        <!-- Note: Add to cart via AJAX from here is tricky during checkout processing, so we open in blank or let WooCommerce handle it. Best is let it standard redirect to cart/checkout -->
                        <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" data-quantity="1" class="inline-block px-6 py-3 w-full max-w-[90%] text-[9px] font-black uppercase tracking-[0.25em] rounded-full transition-all duration-300 transform group-hover:scale-105 group-hover:-translate-y-1 <?php echo esc_attr($carousel_btn_bg); ?> add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo esc_attr($product->get_id()); ?>" data-product_sku="<?php echo esc_attr($product->get_sku()); ?>">
                            Añadir a la orden
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
                    const splideElement = document.querySelector('.lh-checkout-splide');
                    if (!splideElement) return;

                    const NORMAL_SPEED = 0.8;
                    const SLOW_SPEED = 0.2;

                    const splide = new Splide( '.lh-checkout-splide', {
                        type   : 'loop',
                        drag   : 'free',
                        focus  : 'center',
                        perPage: 4,
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

                    splideElement.addEventListener('mouseenter', () => {
                        splide.options = { autoScroll: { speed: SLOW_SPEED } };
                    });

                    splideElement.addEventListener('mouseleave', () => {
                        splide.options = { autoScroll: { speed: NORMAL_SPEED } };
                    });
                }
            });
        </script>
        <?php
    }
    ?>

</div>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

<?php get_footer( 'shop' ); ?>
