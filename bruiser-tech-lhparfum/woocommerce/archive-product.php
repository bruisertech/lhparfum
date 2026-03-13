<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.6.1
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

    <div class="flex flex-col md:flex-row gap-12">
        <!-- Sidebar Filters -->
        <aside class="w-full md:w-1/4 lg:w-1/5 shrink-0 hidden md:block border-r border-gray-200 dark:border-gray-800 pr-8">
            <div class="sticky top-24">
                <form method="GET" action="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="space-y-10">
                    <h2 class="text-sm font-bold uppercase tracking-widest text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-800 pb-3 mb-6">
                        Refinar Búsqueda
                    </h2>

                    <!-- Price Range Filter -->
                    <div>
                        <h3 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4">Rango de Precio</h3>
                        <div class="flex items-center space-x-2 mb-4">
                            <?php
                            $min_val = isset( $_GET['min_price'] ) ? esc_attr( $_GET['min_price'] ) : '';
                            $max_val = isset( $_GET['max_price'] ) ? esc_attr( $_GET['max_price'] ) : '';
                            ?>
                            <input type="number" name="min_price" value="<?php echo $min_val; ?>" placeholder="Min" class="w-full text-xs p-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-sm focus:ring-black dark:focus:ring-white">
                            <span class="text-gray-500">-</span>
                            <input type="number" name="max_price" value="<?php echo $max_val; ?>" placeholder="Max" class="w-full text-xs p-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-sm focus:ring-black dark:focus:ring-white">
                        </div>
                        <button type="submit" class="w-full bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white text-[10px] font-bold uppercase tracking-widest py-2 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                            Aplicar Precio
                        </button>
                    </div>

                    <!-- Genero Filter -->
                    <?php
                    $generos = get_terms( array( 'taxonomy' => 'lh_genero', 'hide_empty' => false ) );
                    if ( ! empty( $generos ) && ! is_wp_error( $generos ) ) :
                        $current_genero = isset( $_GET['filter_genero'] ) && is_array( $_GET['filter_genero'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_GET['filter_genero'] ) ) : array();
                    ?>
                        <div>
                            <h3 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4">Género</h3>
                            <ul class="space-y-3">
                                <?php foreach ( $generos as $term ) : ?>
                                    <li>
                                        <label class="flex items-center space-x-3 cursor-pointer group">
                                            <input type="checkbox" name="filter_genero[]" value="<?php echo esc_attr( $term->slug ); ?>" <?php checked( in_array( $term->slug, $current_genero ) ); ?> class="form-checkbox h-4 w-4 text-black dark:text-white bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 rounded-sm focus:ring-black dark:focus:ring-white transition duration-150 ease-in-out cursor-pointer" onchange="this.form.submit()">
                                            <span class="text-sm text-gray-700 dark:text-gray-300 group-hover:text-black dark:group-hover:text-white transition-colors">
                                                <?php echo esc_html( $term->name ); ?>
                                            </span>
                                        </label>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- Rareza Filter -->
                    <?php
                    $rarezas = get_terms( array( 'taxonomy' => 'lh_rareza', 'hide_empty' => false ) );
                    if ( ! empty( $rarezas ) && ! is_wp_error( $rarezas ) ) :
                        $current_rareza = isset( $_GET['filter_rareza'] ) && is_array( $_GET['filter_rareza'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_GET['filter_rareza'] ) ) : array();
                    ?>
                        <div>
                            <h3 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4">Rareza</h3>
                            <ul class="space-y-3">
                                <?php foreach ( $rarezas as $term ) : ?>
                                    <li>
                                        <label class="flex items-center space-x-3 cursor-pointer group">
                                            <input type="checkbox" name="filter_rareza[]" value="<?php echo esc_attr( $term->slug ); ?>" <?php checked( in_array( $term->slug, $current_rareza ) ); ?> class="form-checkbox h-4 w-4 text-black dark:text-white bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 rounded-sm focus:ring-black dark:focus:ring-white transition duration-150 ease-in-out cursor-pointer" onchange="this.form.submit()">
                                            <span class="text-sm text-gray-700 dark:text-gray-300 group-hover:text-black dark:group-hover:text-white transition-colors">
                                                <?php echo esc_html( $term->name ); ?>
                                            </span>
                                        </label>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- Aroma Filter -->
                    <?php
                    $aromas = get_terms( array( 'taxonomy' => 'lh_aroma', 'hide_empty' => false ) );
                    if ( ! empty( $aromas ) && ! is_wp_error( $aromas ) ) :
                        $current_aroma = isset( $_GET['filter_aroma'] ) && is_array( $_GET['filter_aroma'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_GET['filter_aroma'] ) ) : array();
                    ?>
                        <div>
                            <h3 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4">Familia Olfativa</h3>
                            <ul class="space-y-3 max-h-48 overflow-y-auto pr-2">
                                <?php foreach ( $aromas as $term ) : ?>
                                    <li>
                                        <label class="flex items-center space-x-3 cursor-pointer group">
                                            <input type="checkbox" name="filter_aroma[]" value="<?php echo esc_attr( $term->slug ); ?>" <?php checked( in_array( $term->slug, $current_aroma ) ); ?> class="form-checkbox h-4 w-4 text-black dark:text-white bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 rounded-sm focus:ring-black dark:focus:ring-white transition duration-150 ease-in-out cursor-pointer" onchange="this.form.submit()">
                                            <span class="text-sm text-gray-700 dark:text-gray-300 group-hover:text-black dark:group-hover:text-white transition-colors">
                                                <?php echo esc_html( $term->name ); ?>
                                            </span>
                                        </label>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <noscript>
                        <button type="submit" class="w-full bg-black dark:bg-white text-white dark:text-black px-4 py-2 text-xs font-bold uppercase tracking-widest mt-4">Aplicar Filtros</button>
                    </noscript>
                </form>
            </div>
        </aside>

        <!-- Product Grid -->
        <main class="w-full md:w-3/4 lg:w-4/5">
            <!-- Mobile Filter Toggle -->
            <div class="md:hidden mb-6 flex justify-between items-center border-b border-gray-200 dark:border-gray-800 pb-4">
                <span class="text-sm font-bold uppercase tracking-widest text-gray-900 dark:text-white">Filtros</span>
                <button type="button" class="text-gray-500 dark:text-gray-400 text-sm flex items-center" onclick="alert('Por favor, navega en escritorio para una experiencia completa de filtrado.')">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Mostrar
                </button>
            </div>

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

                echo '<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-12 gap-x-8">';

                if ( wc_get_loop_prop( 'total' ) ) {
                    while ( have_posts() ) {
                        the_post();
                        do_action( 'woocommerce_shop_loop' );

                        // Custom Product Card
                        global $product;
                        $link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );

                        // Get Rareza
                        $rareza_terms = get_the_terms( $product->get_id(), 'lh_rareza' );
                        $rareza_html = '';
                        if ( $rareza_terms && ! is_wp_error( $rareza_terms ) ) {
                            $term = $rareza_terms[0];
                            $slug = $term->slug;

                            $pill_classes = 'absolute top-4 right-4 text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full text-white z-10 transition-all duration-300';

                            if ( $slug === 'nicho' ) {
                                $pill_classes .= ' bg-yellow-500 animate-pulse-glow-gold';
                            } elseif ( $slug === 'arabe' ) {
                                $pill_classes .= ' bg-purple-600 animate-pulse-glow-purple';
                            } elseif ( $slug === 'disenador' ) {
                                $pill_classes .= ' bg-blue-500 animate-pulse-glow-blue';
                            } else {
                                $pill_classes .= ' bg-green-500 animate-pulse-glow-green';
                            }

                            $rareza_html = '<span class="' . esc_attr( $pill_classes ) . '">' . esc_html( $term->name ) . '</span>';
                        }
                        ?>
                        <div class="group relative flex flex-col items-center text-center transition duration-300 bg-white dark:bg-gray-900">
                            <a href="<?php echo esc_url( $link ); ?>" class="block w-full overflow-hidden bg-gray-50 dark:bg-gray-800 aspect-w-3 aspect-h-4 relative rounded-sm shadow-sm group-hover:shadow-lg transition-shadow duration-300">
                                <?php echo $rareza_html; ?>
                                <?php echo $product->get_image( 'woocommerce_thumbnail', array( 'class' => 'object-cover w-full h-full group-hover:scale-110 transition-transform duration-700 ease-in-out' ) ); ?>
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-opacity duration-300"></div>
                            </a>
                            <div class="mt-6 flex flex-col justify-between flex-grow w-full px-2 items-center text-center">
                                <?php
                                $genero_terms = get_the_terms( $product->get_id(), 'lh_genero' );
                                if ( $genero_terms && ! is_wp_error( $genero_terms ) ) {
                                    echo '<span class="text-[10px] font-semibold text-[#888888] dark:text-[#aaaaaa] uppercase tracking-[0.2em] mb-3 inline-block">' . esc_html( $genero_terms[0]->name ) . '</span>';
                                }
                                ?>
                                <h2 class="text-lg md:text-xl font-black text-black dark:text-white mb-2 tracking-tight leading-tight">
                                    <a href="<?php echo esc_url( $link ); ?>" class="hover:underline decoration-2 underline-offset-4">
                                        <?php echo get_the_title(); ?>
                                    </a>
                                </h2>
                                <div class="text-sm md:text-base text-[#666666] dark:text-[#bbbbbb] font-light mb-6">
                                    <?php echo $product->get_price_html(); ?>
                                </div>

                                <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="mt-auto w-full group relative overflow-hidden bg-black dark:bg-white text-white dark:text-black px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] transition-all duration-500 shadow-md hover:shadow-xl flex justify-center items-center rounded-sm">
                                    <div class="absolute inset-0 w-0 bg-white dark:bg-black opacity-10 transition-all duration-[600ms] ease-out group-hover:w-full"></div>
                                    <span class="relative z-10"><?php echo esc_html( $product->add_to_cart_text() ); ?></span>
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
