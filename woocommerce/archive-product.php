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
        <!-- Sidebar Filters (Desktop Dropdowns) -->
        <aside class="w-full md:w-1/4 lg:w-1/5 shrink-0 hidden md:block pr-8 border-r border-gray-200 dark:border-gray-800 relative z-30">
            <div class="sticky top-32">
                <form method="GET" action="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="flex flex-col gap-4" id="desktop-filter-form">
                    <h2 class="text-sm font-black uppercase tracking-widest text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-800 pb-3 mb-4">
                        Filtros
                    </h2>

                    <!-- Price Range Filter (Desktop Dropdown) -->
                    <div class="relative group/dropdown">
                        <button type="button" class="flex items-center justify-between w-full px-4 py-3 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-sm text-[10px] font-bold uppercase tracking-widest text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none transition-colors" onclick="toggleDropdown('desktop-dropdown-precio')">
                            Presupuesto
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div id="desktop-dropdown-precio" class="hidden absolute top-full left-0 mt-2 w-full min-w-[200px] bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-2xl rounded-sm py-4 px-4 z-40">
                            <div class="flex flex-col gap-3">
                            <?php
                            $max_val = isset( $_GET['filter_precio_max'] ) ? esc_attr( $_GET['filter_precio_max'] ) : '';
                            $price_points = array( 100000, 200000, 300000, 400000 );

                            // Empty/Reset Option
                            $is_empty_active = empty( $max_val );
                            $empty_active_classes = $is_empty_active
                                ? 'bg-black text-white dark:bg-white dark:text-black border-black dark:border-white shadow-md'
                                : 'bg-transparent text-gray-600 dark:text-gray-400 border-gray-300 dark:border-gray-700 hover:border-gray-500 dark:hover:border-gray-500';

                            // Empty/Reset Option
                            $is_empty_active = empty( $max_val );
                            $empty_active_classes = $is_empty_active ? 'font-black text-black dark:text-white underline' : 'text-gray-600 dark:text-gray-400';

                            echo '<label class="cursor-pointer text-[10px] font-bold uppercase tracking-widest hover:text-black dark:hover:text-white transition-colors block ' . esc_attr( $empty_active_classes ) . '">';
                            echo '<input type="radio" name="filter_precio_max" value="" class="sr-only" onchange="document.getElementById(\'desktop-filter-form\').submit()" ' . checked( $is_empty_active, true, false ) . '>';
                            echo 'Sin límite';
                            echo '</label>';

                            // Price points
                            foreach ( $price_points as $price ) {
                                $is_active = ( $max_val == $price );
                                $active_classes = $is_active ? 'font-black text-black dark:text-white underline' : 'text-gray-600 dark:text-gray-400';

                                echo '<label class="cursor-pointer text-[10px] font-bold uppercase tracking-widest hover:text-black dark:hover:text-white transition-colors block ' . esc_attr( $active_classes ) . '">';
                                echo '<input type="radio" name="filter_precio_max" value="' . esc_attr( $price ) . '" class="sr-only" onchange="document.getElementById(\'desktop-filter-form\').submit()" ' . checked( $is_active, true, false ) . '>';
                                echo 'Max $' . number_format( $price, 0, ',', '.' );
                                echo '</label>';
                            }
                            ?>
                            </div>
                        </div>
                    </div>

                    <!-- Genero Filter (Desktop Dropdown) -->
                    <?php
                    $generos = get_terms( array( 'taxonomy' => 'lh_genero', 'hide_empty' => true ) );
                    if ( ! empty( $generos ) && ! is_wp_error( $generos ) ) :
                        $current_genero = isset( $_GET['filter_genero'] ) && is_array( $_GET['filter_genero'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_GET['filter_genero'] ) ) : array();
                    ?>
                        <div class="relative group/dropdown">
                            <button type="button" class="flex items-center justify-between w-full px-4 py-3 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-sm text-[10px] font-bold uppercase tracking-widest text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none transition-colors" onclick="toggleDropdown('desktop-dropdown-genero')">
                                Género
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div id="desktop-dropdown-genero" class="hidden absolute top-full left-0 mt-2 w-full min-w-[200px] bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-2xl rounded-sm py-4 px-4 z-40">
                                <div class="flex flex-col gap-3">
                                    <?php foreach ( $generos as $term ) :
                                        $is_checked = in_array( $term->slug, $current_genero );
                                    ?>
                                        <label class="cursor-pointer text-[10px] font-bold uppercase tracking-widest flex items-center group transition-colors">
                                            <input type="checkbox" name="filter_genero[]" value="<?php echo esc_attr( $term->slug ); ?>" <?php checked( $is_checked ); ?> class="sr-only" onchange="document.getElementById('desktop-filter-form').submit()">
                                            <span class="w-3 h-3 rounded-full border border-black dark:border-white mr-2 flex items-center justify-center <?php echo $is_checked ? 'bg-black dark:bg-white' : ''; ?>"></span>
                                            <span class="<?php echo $is_checked ? 'text-black dark:text-white font-black' : 'text-gray-500 dark:text-gray-400 group-hover:text-black dark:group-hover:text-white'; ?>"><?php echo esc_html( $term->name ); ?></span>
                                        </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Rareza Filter (Desktop Dropdown) -->
                    <?php
                    $rarezas = get_terms( array( 'taxonomy' => 'lh_rareza', 'hide_empty' => true ) );
                    if ( ! empty( $rarezas ) && ! is_wp_error( $rarezas ) ) :
                        $current_rareza = isset( $_GET['filter_rareza'] ) && is_array( $_GET['filter_rareza'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_GET['filter_rareza'] ) ) : array();
                    ?>
                        <div class="relative group/dropdown">
                            <button type="button" class="flex items-center justify-between w-full px-4 py-3 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-sm text-[10px] font-bold uppercase tracking-widest text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none transition-colors" onclick="toggleDropdown('desktop-dropdown-rareza')">
                                Rareza
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div id="desktop-dropdown-rareza" class="hidden absolute top-full left-0 mt-2 w-full min-w-[200px] bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-2xl rounded-sm py-4 px-4 z-40">
                                <div class="flex flex-col gap-3">
                                    <?php foreach ( $rarezas as $term ) :
                                        $is_checked = in_array( $term->slug, $current_rareza );
                                    ?>
                                        <label class="cursor-pointer text-[10px] font-bold uppercase tracking-widest flex items-center group transition-colors">
                                            <input type="checkbox" name="filter_rareza[]" value="<?php echo esc_attr( $term->slug ); ?>" <?php checked( $is_checked ); ?> class="sr-only" onchange="document.getElementById('desktop-filter-form').submit()">
                                            <span class="w-3 h-3 rounded-full border border-black dark:border-white mr-2 flex items-center justify-center <?php echo $is_checked ? 'bg-black dark:bg-white' : ''; ?>"></span>
                                            <span class="<?php echo $is_checked ? 'text-black dark:text-white font-black' : 'text-gray-500 dark:text-gray-400 group-hover:text-black dark:group-hover:text-white'; ?>"><?php echo esc_html( $term->name ); ?></span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Marca Filter (Desktop Dropdown) -->
                    <?php
                    $marcas = get_terms( array( 'taxonomy' => 'lh_marca', 'hide_empty' => true ) );
                    if ( ! empty( $marcas ) && ! is_wp_error( $marcas ) ) :
                        $current_marca = isset( $_GET['filter_marca'] ) && is_array( $_GET['filter_marca'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_GET['filter_marca'] ) ) : array();
                    ?>
                        <div class="relative group/dropdown">
                            <button type="button" class="flex items-center justify-between w-full px-4 py-3 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-sm text-[10px] font-bold uppercase tracking-widest text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none transition-colors" onclick="toggleDropdown('desktop-dropdown-marca')">
                                Casa Perfumista
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div id="desktop-dropdown-marca" class="hidden absolute top-full left-0 mt-2 w-full min-w-[200px] bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-2xl rounded-sm py-4 px-4 z-40">
                                <div class="flex flex-col gap-3 max-h-64 overflow-y-auto pr-2 custom-scrollbar">
                                    <?php foreach ( $marcas as $term ) :
                                        $is_checked = in_array( $term->slug, $current_marca );
                                    ?>
                                        <label class="cursor-pointer text-[10px] font-bold uppercase tracking-widest flex items-center group transition-colors">
                                            <input type="checkbox" name="filter_marca[]" value="<?php echo esc_attr( $term->slug ); ?>" <?php checked( $is_checked ); ?> class="sr-only" onchange="document.getElementById('desktop-filter-form').submit()">
                                            <span class="w-3 h-3 rounded-full border border-black dark:border-white mr-2 flex items-center justify-center shrink-0 <?php echo $is_checked ? 'bg-black dark:bg-white' : ''; ?>"></span>
                                            <span class="<?php echo $is_checked ? 'text-black dark:text-white font-black' : 'text-gray-500 dark:text-gray-400 group-hover:text-black dark:group-hover:text-white'; ?>"><?php echo esc_html( $term->name ); ?></span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Aroma Filter (Desktop Dropdown) -->
                    <?php
                    $aromas = get_terms( array( 'taxonomy' => 'lh_aroma', 'hide_empty' => true ) );
                    if ( ! empty( $aromas ) && ! is_wp_error( $aromas ) ) :
                        $current_aroma = isset( $_GET['filter_aroma'] ) && is_array( $_GET['filter_aroma'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_GET['filter_aroma'] ) ) : array();
                    ?>
                        <div class="relative group/dropdown">
                            <button type="button" class="flex items-center justify-between w-full px-4 py-3 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-sm text-[10px] font-bold uppercase tracking-widest text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none transition-colors" onclick="toggleDropdown('desktop-dropdown-aroma')">
                                Familia Olfativa
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div id="desktop-dropdown-aroma" class="hidden absolute top-full left-0 mt-2 w-full min-w-[200px] bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-2xl rounded-sm py-4 px-4 z-40">
                                <div class="flex flex-col gap-3 max-h-64 overflow-y-auto pr-2 custom-scrollbar">
                                    <?php foreach ( $aromas as $term ) :
                                        $is_checked = in_array( $term->slug, $current_aroma );
                                    ?>
                                        <label class="cursor-pointer text-[10px] font-bold uppercase tracking-widest flex items-center group transition-colors">
                                            <input type="checkbox" name="filter_aroma[]" value="<?php echo esc_attr( $term->slug ); ?>" <?php checked( $is_checked ); ?> class="sr-only" onchange="document.getElementById('desktop-filter-form').submit()">
                                            <span class="w-3 h-3 rounded-full border border-black dark:border-white mr-2 flex items-center justify-center shrink-0 <?php echo $is_checked ? 'bg-black dark:bg-white' : ''; ?>"></span>
                                            <span class="<?php echo $is_checked ? 'text-black dark:text-white font-black' : 'text-gray-500 dark:text-gray-400 group-hover:text-black dark:group-hover:text-white'; ?>"><?php echo esc_html( $term->name ); ?></span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <noscript>
                        <button type="submit" class="w-full bg-black dark:bg-white text-white dark:text-black px-4 py-2 text-xs font-bold uppercase tracking-widest mt-4">Aplicar Filtros</button>
                    </noscript>

                    <?php if ( isset( $_GET['min_price'] ) || isset( $_GET['filter_precio_max'] ) || isset( $_GET['filter_genero'] ) || isset( $_GET['filter_rareza'] ) || isset( $_GET['filter_aroma'] ) || isset( $_GET['filter_marca'] ) ) : ?>
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
            <!-- Mobile Filters Bar (Dropdowns) -->
            <div class="md:hidden mb-8 relative z-30">
                <form method="GET" action="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" id="mobile-filter-form">
                    <div class="flex flex-wrap justify-center gap-2">

                        <!-- Precio Mobile Dropdown -->
                        <div class="relative group/dropdown">
                            <button type="button" class="flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-full text-[10px] font-bold uppercase tracking-widest text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none" onclick="toggleDropdown('dropdown-precio')">
                                Precio
                                <svg class="ml-1 w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div id="dropdown-precio" class="hidden absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-48 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-xl rounded-md py-4 px-4 z-40">
                                <div class="flex flex-col gap-3">
                                    <?php
                                    $max_val = isset( $_GET['filter_precio_max'] ) ? esc_attr( $_GET['filter_precio_max'] ) : '';
                                    $price_points = array( 100000, 200000, 300000, 400000 );

                                    // Empty option mobile
                                    $is_empty_active = empty( $max_val );
                                    $empty_active_classes = $is_empty_active ? 'font-black text-black dark:text-white underline' : 'text-gray-600 dark:text-gray-400';
                                    echo '<label class="cursor-pointer text-xs uppercase tracking-widest hover:text-black dark:hover:text-white ' . esc_attr( $empty_active_classes ) . '">';
                                    echo '<input type="radio" name="filter_precio_max" value="" class="sr-only" onchange="document.getElementById(\'mobile-filter-form\').submit()" ' . checked( $is_empty_active, true, false ) . '>';
                                    echo 'Sin límite';
                                    echo '</label>';

                                    foreach ( $price_points as $price ) {
                                        $is_active = ( $max_val == $price );
                                        $active_classes = $is_active ? 'font-black text-black dark:text-white underline' : 'text-gray-600 dark:text-gray-400';
                                        echo '<label class="cursor-pointer text-xs uppercase tracking-widest hover:text-black dark:hover:text-white ' . esc_attr( $active_classes ) . '">';
                                        echo '<input type="radio" name="filter_precio_max" value="' . esc_attr( $price ) . '" class="sr-only" onchange="document.getElementById(\'mobile-filter-form\').submit()" ' . checked( $is_active, true, false ) . '>';
                                        echo 'Max $' . number_format( $price, 0, ',', '.');
                                        echo '</label>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Genero Mobile Dropdown -->
                        <?php if ( ! empty( $generos ) && ! is_wp_error( $generos ) ) : ?>
                        <div class="relative group/dropdown">
                            <button type="button" class="flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-full text-[10px] font-bold uppercase tracking-widest text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none" onclick="toggleDropdown('dropdown-genero')">
                                Género
                                <svg class="ml-1 w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div id="dropdown-genero" class="hidden absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-48 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-xl rounded-md py-4 px-4 z-40">
                                <div class="flex flex-col gap-4">
                                    <?php foreach ( $generos as $term ) :
                                        $is_checked = in_array( $term->slug, $current_genero );
                                    ?>
                                        <label class="cursor-pointer text-xs font-bold uppercase tracking-widest flex items-center group">
                                            <input type="checkbox" name="filter_genero[]" value="<?php echo esc_attr( $term->slug ); ?>" <?php checked( $is_checked ); ?> class="sr-only" onchange="document.getElementById('mobile-filter-form').submit()">
                                            <span class="w-3 h-3 rounded-full border border-black dark:border-white mr-2 flex items-center justify-center <?php echo $is_checked ? 'bg-black dark:bg-white' : ''; ?>"></span>
                                            <span class="<?php echo $is_checked ? 'text-black dark:text-white' : 'text-gray-500 dark:text-gray-400'; ?>"><?php echo esc_html( $term->name ); ?></span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Rareza Mobile Dropdown -->
                        <?php if ( ! empty( $rarezas ) && ! is_wp_error( $rarezas ) ) : ?>
                        <div class="relative group/dropdown">
                            <button type="button" class="flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-full text-[10px] font-bold uppercase tracking-widest text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none" onclick="toggleDropdown('dropdown-rareza')">
                                Rareza
                                <svg class="ml-1 w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div id="dropdown-rareza" class="hidden absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-48 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-xl rounded-md py-4 px-4 z-40">
                                <div class="flex flex-col gap-4">
                                    <?php foreach ( $rarezas as $term ) :
                                        $is_checked = in_array( $term->slug, $current_rareza );
                                    ?>
                                        <label class="cursor-pointer text-xs font-bold uppercase tracking-[0.15em] flex items-center group">
                                            <input type="checkbox" name="filter_rareza[]" value="<?php echo esc_attr( $term->slug ); ?>" <?php checked( $is_checked ); ?> class="sr-only" onchange="document.getElementById('mobile-filter-form').submit()">
                                            <span class="w-3 h-3 rounded-full border border-black dark:border-white mr-2 flex items-center justify-center <?php echo $is_checked ? 'bg-black dark:bg-white' : ''; ?>"></span>
                                            <span class="<?php echo $is_checked ? 'text-black dark:text-white' : 'text-gray-500 dark:text-gray-400'; ?>"><?php echo esc_html( $term->name ); ?></span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Marca Mobile Dropdown -->
                        <?php if ( ! empty( $marcas ) && ! is_wp_error( $marcas ) ) : ?>
                        <div class="relative group/dropdown">
                            <button type="button" class="flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-full text-[10px] font-bold uppercase tracking-widest text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none" onclick="toggleDropdown('dropdown-marca')">
                                Marca
                                <svg class="ml-1 w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div id="dropdown-marca" class="hidden absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-56 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-xl rounded-md py-4 px-4 z-40">
                                <div class="flex flex-col gap-4 max-h-48 overflow-y-auto">
                                    <?php foreach ( $marcas as $term ) :
                                        $is_checked = in_array( $term->slug, $current_marca );
                                    ?>
                                        <label class="cursor-pointer block text-center">
                                            <input type="checkbox" name="filter_marca[]" value="<?php echo esc_attr( $term->slug ); ?>" <?php checked( $is_checked ); ?> class="sr-only" onchange="document.getElementById('mobile-filter-form').submit()">
                                            <span class="font-serif uppercase tracking-[0.2em] text-xs <?php echo $is_checked ? 'text-black dark:text-white font-black underline' : 'text-gray-500 dark:text-gray-400'; ?>"><?php echo esc_html( $term->name ); ?></span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Aroma Mobile Dropdown -->
                        <?php if ( ! empty( $aromas ) && ! is_wp_error( $aromas ) ) : ?>
                        <div class="relative group/dropdown">
                            <button type="button" class="flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-full text-[10px] font-bold uppercase tracking-widest text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none" onclick="toggleDropdown('dropdown-aroma')">
                                Aroma
                                <svg class="ml-1 w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div id="dropdown-aroma" class="hidden absolute top-full right-0 mt-2 w-56 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-xl rounded-md py-4 px-4 z-40">
                                <div class="flex flex-col gap-5 max-h-48 overflow-y-auto items-center">
                                    <?php foreach ( $aromas as $term ) :
                                        $is_checked = in_array( $term->slug, $current_aroma );
                                    ?>
                                        <label class="cursor-pointer flex items-center justify-center w-full">
                                            <input type="checkbox" name="filter_aroma[]" value="<?php echo esc_attr( $term->slug ); ?>" <?php checked( $is_checked ); ?> class="sr-only" onchange="document.getElementById('mobile-filter-form').submit()">
                                            <span class="font-['Caveat',_cursive] text-xl capitalize leading-none <?php echo $is_checked ? 'text-black dark:text-white font-bold scale-105' : 'text-gray-400 dark:text-gray-500'; ?>"><?php echo esc_html( $term->name ); ?></span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if ( isset( $_GET['min_price'] ) || isset( $_GET['filter_precio_max'] ) || isset( $_GET['filter_genero'] ) || isset( $_GET['filter_rareza'] ) || isset( $_GET['filter_aroma'] ) || isset( $_GET['filter_marca'] ) ) : ?>
                            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="flex items-center px-4 py-2 text-[10px] font-bold uppercase tracking-widest text-red-500 hover:text-red-700">
                                Limpiar
                            </a>
                        <?php endif; ?>

                    </div>
                </form>
            </div>

            <script>
            function toggleDropdown(id) {
                // Close all other dropdowns
                const dropdowns = [
                    'dropdown-precio', 'dropdown-genero', 'dropdown-rareza', 'dropdown-marca', 'dropdown-aroma',
                    'desktop-dropdown-precio', 'desktop-dropdown-genero', 'desktop-dropdown-rareza', 'desktop-dropdown-marca', 'desktop-dropdown-aroma'
                ];
                dropdowns.forEach(did => {
                    if (did !== id) {
                        const el = document.getElementById(did);
                        if(el) el.classList.add('hidden');
                    }
                });
                // Toggle clicked dropdown
                const el = document.getElementById(id);
                if (el) el.classList.toggle('hidden');
            }

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(event) {
                if (!event.target.closest('.group\\/dropdown')) {
                    const dropdowns = [
                        'dropdown-precio', 'dropdown-genero', 'dropdown-rareza', 'dropdown-marca', 'dropdown-aroma',
                        'desktop-dropdown-precio', 'desktop-dropdown-genero', 'desktop-dropdown-rareza', 'desktop-dropdown-marca', 'desktop-dropdown-aroma'
                    ];
                    dropdowns.forEach(id => {
                        const el = document.getElementById(id);
                        if(el) el.classList.add('hidden');
                    });
                }
            });
            </script>

            <?php
            // Remove WooCommerce default count and ordering hooks before shop loop to avoid duplicates
            // We are removing the ordering and count entirely for a cleaner luxury aesthetic
            remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
            remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

            if ( woocommerce_product_loop() ) {

                do_action( 'woocommerce_before_shop_loop' );

                echo '<div id="lhparfum-product-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-12 gap-x-8 pt-4">';

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
                        $carousel_btn_bg = 'bg-[#600470] text-white hover:bg-[#600470]/90 transition-colors shadow-md';

                        if ( $rareza_terms && ! is_wp_error( $rareza_terms ) ) {
                            $term = $rareza_terms[0];
                            $slug = $term->slug;

                            $pill_classes = 'absolute top-4 right-4 inline-flex items-center justify-center px-4 py-1.5 rounded-full text-[9px] font-bold uppercase tracking-[0.25em] transition-all duration-500 shadow-md overflow-hidden z-20 border border-transparent text-white group-hover:scale-105';

                            if ( $slug === 'nicho' ) {
                                $pill_classes .= ' bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 animate-pulse-glow-gold';
                                $glow_class = 'bg-yellow-400 opacity-30 dark:opacity-20 animate-pulse-glow-gold blur-[48px]';
                            } elseif ( $slug === 'arabe' ) {
                                $pill_classes .= ' bg-gradient-to-r from-purple-500 via-purple-600 to-purple-800 animate-pulse-glow-purple';
                                $glow_class = 'bg-purple-600 opacity-30 dark:opacity-20 animate-pulse-glow-purple blur-[48px]';
                            } elseif ( $slug === 'disenador' ) {
                                $pill_classes .= ' bg-gradient-to-r from-blue-400 via-blue-500 to-blue-700 animate-pulse-glow-blue';
                                $glow_class = 'bg-blue-500 opacity-30 dark:opacity-20 animate-pulse-glow-blue blur-[48px]';
                            } else {
                                $pill_classes .= ' bg-gradient-to-r from-emerald-400 via-emerald-500 to-emerald-700 animate-pulse-glow-green';
                                $glow_class = 'bg-green-500 opacity-30 dark:opacity-20 animate-pulse-glow-green blur-[48px]';
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

                            <div class="relative w-full aspect-[3/4] overflow-hidden rounded-sm shadow-md group-hover:shadow-xl transition-shadow duration-300 mb-0 z-10">
                                <a href="<?php echo esc_url( $link ); ?>" class="absolute inset-0 z-20" aria-label="<?php the_title_attribute(); ?>"></a>
                                <?php echo $rareza_html; ?>
                                <?php echo $product->get_image( 'woocommerce_thumbnail', array( 'class' => 'absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 block m-0 p-0' ) ); ?>
                            </div>
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

                // Elegant Loader for Infinite Scroll
                echo '<div id="lhparfum-infinite-loader" class="hidden flex justify-center items-center py-8 md:py-16 w-full">';
                echo '<div class="w-8 h-8 rounded-full border-2 border-t-black border-r-black border-b-gray-200 border-l-gray-200 dark:border-t-white dark:border-r-white dark:border-b-gray-800 dark:border-l-gray-800 animate-spin"></div>';
                echo '</div>';

                // Transparent, always-rendered trigger for the IntersectionObserver
                echo '<div id="lhparfum-scroll-trigger" class="w-full h-1 mt-4"></div>';

                // Hide native pagination but keep it in DOM so JS can read the Next Page URL
                echo '<div id="lhparfum-pagination" class="hidden">';
                do_action( 'woocommerce_after_shop_loop' );
                echo '</div>';
            } else {
                // Elegant Spanish empty state
                remove_action( 'woocommerce_no_products_found', 'wc_no_products_found', 10 );
                echo '<div class="text-center py-32 flex flex-col items-center justify-center">';
                echo '<svg class="w-16 h-16 text-gray-300 dark:text-gray-700 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>';
                echo '<p class="text-sm md:text-base font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400 max-w-md mx-auto leading-relaxed">No se encontraron fragancias con los criterios seleccionados.</p>';
                echo '<a href="' . esc_url( wc_get_page_permalink( 'shop' ) ) . '" class="mt-8 inline-block border-b-2 border-black dark:border-white pb-1 text-xs font-bold uppercase tracking-[0.2em] text-black dark:text-white hover:text-gray-500 dark:hover:text-gray-400 transition-colors">Explorar Colección</a>';
                echo '</div>';
            }
            ?>
        </main>
    </div>
</div>

<!-- Infinite Scroll Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    let isLoading = false;
    let nextUrl = getNextUrl();
    const grid = document.getElementById('lhparfum-product-grid');
    const loader = document.getElementById('lhparfum-infinite-loader');
    const trigger = document.getElementById('lhparfum-scroll-trigger');

    function getNextUrl() {
        const nextLink = document.querySelector('#lhparfum-pagination a.next');
        return nextLink ? nextLink.href : null;
    }

    function loadNextPage() {
        if (!nextUrl || isLoading) return;

        isLoading = true;
        if(loader) loader.classList.remove('hidden');

        fetch(nextUrl)
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newGrid = doc.getElementById('lhparfum-product-grid');
                const newPagination = doc.querySelector('#lhparfum-pagination');

                if (newGrid && grid) {
                    // Extract all child elements from the newly fetched grid and append them
                    const newProducts = Array.from(newGrid.children);
                    newProducts.forEach(product => {
                        grid.appendChild(product);
                    });
                }

                // Update pagination block so we can find the next 'Next' URL
                const oldPagination = document.getElementById('lhparfum-pagination');
                if (oldPagination && newPagination) {
                    oldPagination.innerHTML = newPagination.innerHTML;
                } else if (oldPagination) {
                    oldPagination.innerHTML = '';
                }

                nextUrl = getNextUrl();

                // Hide loader and reset flag
                if(loader) loader.classList.add('hidden');
                isLoading = false;

                // If there's no next URL, we stop observing
                if (!nextUrl && observer) {
                    observer.disconnect();
                }
            })
            .catch(error => {
                console.error('Error loading more products:', error);
                if(loader) loader.classList.add('hidden');
                isLoading = false;
            });
    }

    // Robust Window Scroll Listener as fallback to IntersectionObserver quirks
    if (grid && nextUrl) {
        window.addEventListener('scroll', function() {
            if (isLoading || !nextUrl) return;

            // Check if we are close to the bottom of the document (within 800px)
            const scrollPosition = window.innerHeight + window.scrollY;
            const bottomPosition = document.body.offsetHeight - 800;

            if (scrollPosition >= bottomPosition) {
                loadNextPage();
            }
        });
    }
});
</script>

<?php
get_footer( 'shop' );
