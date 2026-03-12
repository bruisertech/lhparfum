<?php
/**
 * The template for displaying the front page
 *
 * @package BRUISER_TECH_LHPARFUM
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- Hero Section -->
    <section class="relative bg-gray-900 text-white py-32 md:py-48 flex items-center justify-center overflow-hidden">
        <!-- Optional Background Image (Placeholder) -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1594035910387-fea47794261f?auto=format&fit=crop&q=80&w=2000" alt="Perfume Hero" class="w-full h-full object-cover opacity-40">
        </div>

        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-6">
                Descubre Tu Esencia
            </h1>
            <p class="text-lg md:text-2xl font-light mb-10 text-gray-200">
                Perfumería de lujo en Colombia. Fragancias exclusivas creadas para destacar tu personalidad única.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="<?php echo class_exists( 'WooCommerce' ) ? esc_url( wc_get_page_permalink( 'shop' ) ) : '#'; ?>" class="px-8 py-4 bg-white text-gray-900 font-semibold uppercase tracking-widest text-sm hover:bg-gray-100 transition-colors w-full sm:w-auto">
                    Comprar Ahora
                </a>
                <a href="#coleccion" class="px-8 py-4 border border-white text-white font-semibold uppercase tracking-widest text-sm hover:bg-white hover:text-gray-900 transition-colors w-full sm:w-auto">
                    Explorar Colección
                </a>
            </div>
        </div>
    </section>

    <!-- Best Sellers Section -->
    <section id="coleccion" class="py-24 bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-gray-100 sm:text-4xl">Más Vendidos</h2>
                <p class="mt-4 text-lg text-gray-500 dark:text-gray-400">Nuestras fragancias más populares, elegidas por nuestros clientes.</p>
            </div>

            <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                <div class="woocommerce">
                    <?php
                        $args = array(
                            'post_type'      => 'product',
                            'posts_per_page' => 4,
                            'meta_key'       => 'total_sales',
                            'orderby'        => 'meta_value_num',
                            'order'          => 'DESC'
                        );
                        $loop = new WP_Query( $args );

                        if ( $loop->have_posts() ) {
                            echo '<ul class="products columns-4">';
                            while ( $loop->have_posts() ) : $loop->the_post();
                                wc_get_template_part( 'content', 'product' );
                            endwhile;
                            echo '</ul>';
                        } else {
                            echo '<p class="text-center text-gray-500">Aún no hay productos.</p>';
                        }
                        wp_reset_postdata();
                    ?>
                </div>
            <?php else : ?>
                <p class="text-center text-gray-500">Por favor, instala y activa WooCommerce para ver los productos.</p>
            <?php endif; ?>

            <div class="text-center mt-12">
                 <a href="<?php echo class_exists( 'WooCommerce' ) ? esc_url( wc_get_page_permalink( 'shop' ) ) : '#'; ?>" class="inline-block px-8 py-4 border border-gray-900 dark:border-white text-gray-900 dark:text-white font-semibold uppercase tracking-widest text-sm hover:bg-gray-900 hover:text-white dark:hover:bg-white dark:hover:text-gray-900 transition-colors">
                    Ver Todos Los Perfumes
                </a>
            </div>
        </div>
    </section>

    <!-- Value Props Section -->
    <section class="py-24 bg-gray-50 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
                <div>
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-black dark:bg-white text-white dark:text-gray-900 mx-auto mb-6 transition-colors duration-300">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Ingredientes Premium</h3>
                    <p class="text-gray-500 dark:text-gray-400">Seleccionamos cuidadosamente cada esencia para garantizar una duración y aroma excepcionales.</p>
                </div>
                <div>
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-black dark:bg-white text-white dark:text-gray-900 mx-auto mb-6 transition-colors duration-300">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Libre de Crueldad</h3>
                    <p class="text-gray-500 dark:text-gray-400">Nuestros productos son 100% veganos y nunca han sido probados en animales.</p>
                </div>
                <div>
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-black dark:bg-white text-white dark:text-gray-900 mx-auto mb-6 transition-colors duration-300">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Envío a toda Colombia</h3>
                    <p class="text-gray-500 dark:text-gray-400">Llevamos tus fragancias favoritas hasta la puerta de tu casa en todo el territorio nacional.</p>
                </div>
            </div>
        </div>
    </section>

</main><!-- #main -->

<?php
get_footer();
