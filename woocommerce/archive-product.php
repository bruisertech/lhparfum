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
    <!-- Removed Title Header as requested -->
    <?php
    // We still call the description action in case categories have important SEO text
    do_action( 'woocommerce_archive_description' );
    ?>

    <div class="flex flex-col md:flex-row gap-12 mt-4">
        <!-- Sidebar Filters -->
        <aside class="w-full md:w-1/4 lg:w-1/5 shrink-0 hidden md:block border-r border-gray-200 dark:border-gray-800 pr-8">
            <div class="sticky top-24">
                <form method="GET" action="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="space-y-10">
                    <h2 class="text-sm font-bold uppercase tracking-widest text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-800 pb-3 mb-6">
                        Refinar Búsqueda
                    </h2>

                    <!-- Price Range Filter (Bubbles) -->
                    <div>
                        <h3 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4">Presupuesto Máximo</h3>
                        <div class="flex flex-wrap gap-2">
                            <?php
                            $max_val = isset( $_GET['max_price'] ) ? esc_attr( $_GET['max_price'] ) : '';
                            $price_points = array( 100000, 200000, 300000 );

                            foreach ( $price_points as $price ) {
                                $is_active = ( $max_val == $price );
                                $active_classes = $is_active
                                    ? 'bg-black text-white dark:bg-white dark:text-black border-black dark:border-white shadow-md'
                                    : 'bg-transparent text-gray-600 dark:text-gray-400 border-gray-300 dark:border-gray-700 hover:border-gray-500 dark:hover:border-gray-500';

                                echo '<label class="cursor-pointer inline-block">';
                                echo '<input type="radio" name="max_price" value="' . esc_attr( $price ) . '" class="sr-only" onchange="this.form.submit()" ' . checked( $is_active, true, false ) . '>';
                                echo '<span class="inline-block px-3 py-1.5 rounded-full text-[10px] font-bold tracking-widest transition-all duration-300 border ' . esc_attr( $active_classes ) . '">';
                                echo 'Max $' . number_format( $price, 0, ',', '.' );
                                echo '</span>';
                                echo '</label>';
                            }
                            ?>
                        </div>
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

                    <!-- Rareza Filter (Elegant Glowing Pills) -->
                    <?php
                    $rarezas = get_terms( array( 'taxonomy' => 'lh_rareza', 'hide_empty' => false ) );
                    if ( ! empty( $rarezas ) && ! is_wp_error( $rarezas ) ) :
                        $current_rareza = isset( $_GET['filter_rareza'] ) && is_array( $_GET['filter_rareza'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_GET['filter_rareza'] ) ) : array();
                    ?>
                        <div>
                            <h3 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-6">Rareza</h3>
                            <div class="flex flex-col space-y-4">
                                <?php foreach ( $rarezas as $term ) :
                                    $slug = $term->slug;
                                    $is_checked = in_array( $slug, $current_rareza );

                                    // Base classes
                                    $pill_classes = 'inline-flex items-center justify-center px-4 py-2.5 rounded-full text-[10px] md:text-[11px] font-bold uppercase tracking-[0.25em] transition-all duration-500 shadow-md relative overflow-hidden group/pill cursor-pointer hover:scale-105';

                                    // Glow and background overrides based on rareza (matching single-product.php)
                                    if ( $slug === 'nicho' ) {
                                        $pill_classes .= ' text-white bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 animate-pulse-glow-gold border border-transparent';
                                    } elseif ( $slug === 'arabe' ) {
                                        $pill_classes .= ' text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-800 animate-pulse-glow-purple border border-transparent';
                                    } elseif ( $slug === 'disenador' ) {
                                        $pill_classes .= ' text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-700 animate-pulse-glow-blue border border-transparent';
                                    } else {
                                        // Accesible
                                        $pill_classes .= ' text-white bg-gradient-to-r from-emerald-400 via-emerald-500 to-emerald-700 animate-pulse-glow-green border border-transparent';
                                    }

                                    // If not checked, we fade it out slightly to show it's inactive,
                                    // but keep the pill design elegant.
                                    if ( ! $is_checked ) {
                                        $pill_classes .= ' opacity-50 hover:opacity-100 grayscale hover:grayscale-0';
                                    }
                                ?>
                                    <label class="relative w-fit">
                                        <input type="checkbox" name="filter_rareza[]" value="<?php echo esc_attr( $slug ); ?>" <?php checked( $is_checked ); ?> class="sr-only" onchange="this.form.submit()">
                                        <div class="<?php echo esc_attr( $pill_classes ); ?>">
                                            <span class="relative z-10 w-full text-center"><?php echo esc_html( $term->name ); ?></span>
                                            <div class="absolute inset-0 bg-white opacity-20 mix-blend-overlay group-hover/pill:opacity-40 transition-opacity duration-300"></div>
                                        </div>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Marca Filter -->
                    <?php
                    $marcas = get_terms( array( 'taxonomy' => 'lh_marca', 'hide_empty' => false ) );
                    if ( ! empty( $marcas ) && ! is_wp_error( $marcas ) ) :
                        $current_marca = isset( $_GET['filter_marca'] ) && is_array( $_GET['filter_marca'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_GET['filter_marca'] ) ) : array();
                    ?>
                        <div>
                            <h3 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4">Marca</h3>
                            <ul class="space-y-3 max-h-48 overflow-y-auto pr-2">
                                <?php foreach ( $marcas as $term ) : ?>
                                    <li>
                                        <label class="flex items-center space-x-3 cursor-pointer group">
                                            <input type="checkbox" name="filter_marca[]" value="<?php echo esc_attr( $term->slug ); ?>" <?php checked( in_array( $term->slug, $current_marca ) ); ?> class="form-checkbox h-4 w-4 text-black dark:text-white bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 rounded-sm focus:ring-black dark:focus:ring-white transition duration-150 ease-in-out cursor-pointer" onchange="this.form.submit()">
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

                    <?php if ( isset( $_GET['min_price'] ) || isset( $_GET['max_price'] ) || isset( $_GET['filter_genero'] ) || isset( $_GET['filter_rareza'] ) || isset( $_GET['filter_aroma'] ) || isset( $_GET['filter_marca'] ) ) : ?>
                        <div class="pt-4 border-t border-gray-200 dark:border-gray-800">
                            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="block w-full text-center text-xs font-bold uppercase tracking-widest text-red-500 hover:text-red-700 transition-colors">
                                Limpiar Filtros
                            </a>
                        </div>
                    <?php endif; ?>
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

            <?php
            // Remove WooCommerce default count and ordering hooks before shop loop to avoid duplicates
            remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
            remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

            // Get total products count
            $total_products = wc_get_loop_prop( 'total' );
            $results_text = $total_products === 1 ? '1 Resultado' : $total_products . ' Resultados';
            ?>

            <div class="flex justify-between items-center mb-8 pb-4 border-b border-gray-100 dark:border-gray-800">
                <span class="text-sm text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wider"><?php echo esc_html( $results_text ); ?></span>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wider mr-2 hidden sm:inline">Ordenar por:</span>
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

                        // Harvest Taxonomies
                        $rareza_terms = get_the_terms( $product->get_id(), 'lh_rareza' );

                        $tax_string = array();
                        $m_marca = get_the_terms( $product->get_id(), 'lh_marca' );
                        if ( $m_marca && ! is_wp_error( $m_marca ) ) $tax_string[] = esc_html( $m_marca[0]->name );

                        $m_genero = get_the_terms( $product->get_id(), 'lh_genero' );
                        if ( $m_genero && ! is_wp_error( $m_genero ) ) $tax_string[] = esc_html( $m_genero[0]->name );

                        $m_aroma = get_the_terms( $product->get_id(), 'lh_aroma' );
                        if ( $m_aroma && ! is_wp_error( $m_aroma ) ) $tax_string[] = esc_html( $m_aroma[0]->name );

                        $formatted_taxonomies = implode(' &bull; ', $tax_string);

                        // Pill & Glow Logic
                        $rareza_html = '';
                        $glow_class = '';
                        $carousel_btn_bg = 'bg-black dark:bg-white text-white dark:text-black';

                        if ( $rareza_terms && ! is_wp_error( $rareza_terms ) ) {
                            $term = $rareza_terms[0];
                            $slug = $term->slug;

                            $pill_classes = 'absolute top-4 right-4 inline-flex items-center justify-center px-4 py-1.5 rounded-full text-[9px] font-bold uppercase tracking-[0.25em] transition-all duration-500 shadow-md overflow-hidden z-20 border border-transparent text-white group-hover:scale-105';

                            if ( $slug === 'nicho' ) {
                                $pill_classes .= ' bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 animate-pulse-glow-gold';
                                $glow_class = 'bg-yellow-400 opacity-30 dark:opacity-20 animate-pulse-glow-gold blur-[48px]';
                                $carousel_btn_bg = 'bg-gradient-to-r from-yellow-400 to-yellow-600 text-white shadow-md hover:shadow-lg hover:shadow-yellow-500/20';
                            } elseif ( $slug === 'arabe' ) {
                                $pill_classes .= ' bg-gradient-to-r from-purple-500 via-purple-600 to-purple-800 animate-pulse-glow-purple';
                                $glow_class = 'bg-purple-600 opacity-30 dark:opacity-20 animate-pulse-glow-purple blur-[48px]';
                                $carousel_btn_bg = 'bg-gradient-to-r from-purple-500 to-purple-800 text-white shadow-md hover:shadow-lg hover:shadow-purple-500/20';
                            } elseif ( $slug === 'disenador' ) {
                                $pill_classes .= ' bg-gradient-to-r from-blue-400 via-blue-500 to-blue-700 animate-pulse-glow-blue';
                                $glow_class = 'bg-blue-500 opacity-30 dark:opacity-20 animate-pulse-glow-blue blur-[48px]';
                                $carousel_btn_bg = 'bg-gradient-to-r from-blue-400 to-blue-700 text-white shadow-md hover:shadow-lg hover:shadow-blue-500/20';
                            } else {
                                $pill_classes .= ' bg-gradient-to-r from-emerald-400 via-emerald-500 to-emerald-700 animate-pulse-glow-green';
                                $glow_class = 'bg-green-500 opacity-30 dark:opacity-20 animate-pulse-glow-green blur-[48px]';
                                $carousel_btn_bg = 'bg-gradient-to-r from-emerald-400 to-emerald-700 text-white shadow-md hover:shadow-lg hover:shadow-emerald-500/20';
                            }

                            $rareza_html = '<div class="' . esc_attr( $pill_classes ) . '">';
                            $rareza_html .= '<span class="relative z-10">' . esc_html( $term->name ) . '</span>';
                            $rareza_html .= '<div class="absolute inset-0 bg-white opacity-20 mix-blend-overlay"></div>';
                            $rareza_html .= '</div>';
                        }
                        ?>
                        <div class="group relative flex flex-col items-center text-center transition duration-300 bg-transparent h-full">
                            <!-- LED Ambient Glow -->
                            <?php if ( $glow_class ) : ?>
                                <div class="absolute inset-0 <?php echo esc_attr( $glow_class ); ?> rounded-sm -z-10 group-hover:scale-110 transition-transform duration-700 pointer-events-none"></div>
                            <?php endif; ?>

                            <a href="<?php echo esc_url( $link ); ?>" class="block w-full overflow-hidden relative rounded-sm shadow-md group-hover:shadow-xl transition-shadow duration-300 z-10" style="aspect-ratio: 3/4; font-size: 0; line-height: 0;">
                                <?php echo $rareza_html; ?>
                                <?php echo $product->get_image( 'woocommerce_thumbnail', array( 'class' => 'absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-in-out block m-0 p-0' ) ); ?>
                            </a>
                            <div class="pt-3 flex flex-col justify-start flex-grow w-full px-2 items-center text-center z-10">

                                <!-- Elegant Taxonomies -->
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

                                <!-- Dynamic Add to Cart -->
                                <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="mt-auto inline-block px-5 py-2.5 w-full max-w-[85%] text-[8px] font-black uppercase tracking-[0.2em] rounded-sm transition-all duration-300 transform group-hover:scale-105 <?php echo esc_attr($carousel_btn_bg); ?>">
                                    Adquirir fragancia
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
