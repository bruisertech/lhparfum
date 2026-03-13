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

<div class="max-w-[100rem] mx-auto px-4 sm:px-6 lg:px-12 py-12 transition-colors duration-500 bg-white dark:bg-[#0a0a0a]">

    <!-- Hero / Header Section -->
    <header class="woocommerce-products-header mb-16 text-center pt-8 pb-12 border-b border-[#eeeeee] dark:border-[#222222] relative">
        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
            <h1 class="woocommerce-products-header__title text-4xl md:text-5xl font-extrabold text-black dark:text-white tracking-tight uppercase mb-6">
                <?php woocommerce_page_title(); ?>
            </h1>
        <?php endif; ?>

        <?php do_action( 'woocommerce_archive_description' ); ?>

        <!-- Elegant Minimalist Search Bar -->
        <div class="max-w-xl mx-auto mt-8 relative group">
            <form role="search" method="get" class="woocommerce-product-search flex items-center border-b border-[#cccccc] dark:border-[#444444] transition-colors duration-300 focus-within:border-black dark:focus-within:border-white pb-2" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <svg class="w-5 h-5 text-[#999999] group-focus-within:text-black dark:group-focus-within:text-white transition-colors duration-300 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field bg-transparent border-none focus:ring-0 text-sm font-light text-black dark:text-white w-full placeholder-[#bbbbbb] dark:placeholder-[#666666] outline-none" placeholder="Buscar fragancia..." value="<?php echo get_search_query(); ?>" name="s" />
                <input type="hidden" name="post_type" value="product" />
                <!-- Button hidden, submitting on enter -->
                <button type="submit" class="hidden" value="<?php echo esc_attr_x( 'Search', 'submit button', 'woocommerce' ); ?>"></button>
            </form>
        </div>
    </header>

    <div class="flex flex-col lg:flex-row gap-12 lg:gap-16">

        <?php
        // Helper to fetch terms safely
        function lh_get_filter_terms($taxonomy) {
            $terms = get_terms( array( 'taxonomy' => $taxonomy, 'hide_empty' => false ) );
            return ( ! empty( $terms ) && ! is_wp_error( $terms ) ) ? $terms : array();
        }

        $taxonomies = array(
            'lh_genero' => 'Género',
            'lh_rareza' => 'Rareza',
            'lh_aroma'  => 'Familia Olfativa',
            'lh_marca'  => 'Marca'
        );
        ?>

        <!-- Mobile Filter Sticky Top Bar -->
        <div class="lg:hidden sticky top-0 z-40 bg-white/90 dark:bg-[#0a0a0a]/90 backdrop-blur-md border-b border-[#eeeeee] dark:border-[#222222] py-4 -mx-4 px-4 mb-8 flex space-x-3 overflow-x-auto scrollbar-hide snap-x">
            <?php foreach ( $taxonomies as $tax_slug => $tax_name ) : ?>
                <?php $terms = lh_get_filter_terms($tax_slug); if($terms): ?>
                    <div class="relative group/mobile-filter flex-shrink-0 snap-start">
                        <button class="flex items-center space-x-2 text-[10px] font-bold uppercase tracking-widest px-4 py-2 rounded-full border border-[#dddddd] dark:border-[#333333] text-black dark:text-white bg-transparent hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-colors whitespace-nowrap">
                            <span><?php echo esc_html($tax_name); ?></span>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <!-- Mobile Dropdown -->
                        <div class="absolute left-0 top-full mt-2 w-48 bg-white dark:bg-[#111111] border border-[#eeeeee] dark:border-[#222222] shadow-2xl opacity-0 invisible group-hover/mobile-filter:opacity-100 group-hover/mobile-filter:visible transition-all duration-300 z-50 py-2">
                            <form method="GET" action="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
                                <?php
                                // Safely preserve other GET parameters, handling nested arrays
                                function lh_render_hidden_inputs($array, $parent_key = '') {
                                    foreach($array as $key => $val) {
                                        $current_key = $parent_key ? $parent_key . '[' . esc_attr($key) . ']' : esc_attr($key);
                                        if (is_array($val)) {
                                            lh_render_hidden_inputs($val, $current_key);
                                        } else {
                                            echo '<input type="hidden" name="' . $current_key . '" value="' . esc_attr($val) . '">';
                                        }
                                    }
                                }

                                $other_params = $_GET;
                                if (isset($other_params['filter_'.$tax_slug])) {
                                    unset($other_params['filter_'.$tax_slug]);
                                }
                                lh_render_hidden_inputs($other_params);

                                $current_filter = isset( $_GET['filter_'.$tax_slug] ) && is_array( $_GET['filter_'.$tax_slug] ) ? array_map( 'sanitize_text_field', wp_unslash( $_GET['filter_'.$tax_slug] ) ) : array();
                                ?>
                                <ul class="max-h-60 overflow-y-auto">
                                    <?php foreach ( $terms as $term ) : ?>
                                        <li class="px-4 py-2 hover:bg-[#f5f5f5] dark:hover:bg-[#222222] transition-colors">
                                            <label class="flex items-center space-x-3 cursor-pointer">
                                                <input type="checkbox" name="filter_<?php echo esc_attr($tax_slug); ?>[]" value="<?php echo esc_attr( $term->slug ); ?>" <?php checked( in_array( $term->slug, $current_filter ) ); ?> class="form-checkbox h-3.5 w-3.5 text-black dark:text-white bg-transparent border-[#cccccc] dark:border-[#555555] rounded-sm focus:ring-0 transition duration-150 cursor-pointer" onchange="this.form.submit()">
                                                <span class="text-xs text-[#555555] dark:text-[#aaaaaa] uppercase tracking-[0.15em] font-medium"><?php echo esc_html( $term->name ); ?></span>
                                            </label>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Desktop Sidebar Filters -->
        <aside class="hidden lg:block w-1/4 xl:w-1/5 shrink-0 border-r border-[#eeeeee] dark:border-[#222222] pr-8 lg:pr-12">
            <div class="sticky top-12">
                <form id="lh-desktop-filters" method="GET" action="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="space-y-12">

                    <div class="flex items-center justify-between mb-8 pb-4 border-b border-black dark:border-white">
                        <h2 class="text-xs font-black uppercase tracking-[0.3em] text-black dark:text-white">Filtros</h2>
                        <?php if(!empty($_GET)): ?>
                            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="text-[9px] text-[#888888] hover:text-black dark:hover:text-white uppercase tracking-widest border-b border-transparent hover:border-black dark:hover:border-white transition-colors">Limpiar</a>
                        <?php endif; ?>
                    </div>

                    <?php foreach ( $taxonomies as $tax_slug => $tax_name ) : ?>
                        <?php
                        $terms = lh_get_filter_terms($tax_slug);
                        if ( $terms ) :
                            $current_filter = isset( $_GET['filter_'.$tax_slug] ) && is_array( $_GET['filter_'.$tax_slug] ) ? array_map( 'sanitize_text_field', wp_unslash( $_GET['filter_'.$tax_slug] ) ) : array();
                        ?>
                            <div class="filter-group">
                                <h3 class="text-[10px] font-bold text-[#888888] dark:text-[#777777] uppercase tracking-[0.25em] mb-4 flex items-center justify-between cursor-pointer group" onclick="this.nextElementSibling.classList.toggle('hidden'); this.querySelector('svg').classList.toggle('rotate-180')">
                                    <span><?php echo esc_html($tax_name); ?></span>
                                    <svg class="w-3 h-3 transition-transform duration-300 group-hover:text-black dark:group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </h3>
                                <ul class="space-y-3 pl-1 transition-all duration-300 overflow-hidden">
                                    <?php foreach ( $terms as $term ) : ?>
                                        <li>
                                            <label class="flex items-center space-x-3 cursor-pointer group">
                                                <!-- Custom styled checkboxes for luxury feel -->
                                                <div class="relative flex items-center justify-center w-3.5 h-3.5 border border-[#cccccc] dark:border-[#555555] rounded-sm bg-transparent group-hover:border-black dark:group-hover:border-white transition-colors">
                                                    <input type="checkbox" name="filter_<?php echo esc_attr($tax_slug); ?>[]" value="<?php echo esc_attr( $term->slug ); ?>" <?php checked( in_array( $term->slug, $current_filter ) ); ?> class="absolute opacity-0 w-full h-full cursor-pointer peer" onchange="document.getElementById('lh-desktop-filters').submit()">
                                                    <svg class="w-2.5 h-2.5 text-black dark:text-white opacity-0 peer-checked:opacity-100 transition-opacity pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                </div>
                                                <span class="text-xs text-[#555555] dark:text-[#aaaaaa] uppercase tracking-[0.15em] font-medium group-hover:text-black dark:group-hover:text-white transition-colors <?php if(in_array($term->slug, $current_filter)) echo 'text-black dark:text-white font-bold'; ?>">
                                                    <?php echo esc_html( $term->name ); ?>
                                                </span>
                                            </label>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </form>
            </div>
        </aside>

        <!-- Product Grid Main Area -->
        <main class="w-full lg:w-3/4 xl:w-4/5 relative">

            <div class="flex justify-between items-center mb-10 pb-4">
                <span class="text-[10px] md:text-xs text-[#888888] dark:text-[#777777] font-bold uppercase tracking-[0.2em]">
                    <?php
                    $total = wc_get_loop_prop( 'total' );
                    echo sprintf( _n( '%d fragancia', '%d fragancias', $total, 'woocommerce' ), $total );
                    ?>
                </span>
                <div class="flex items-center space-x-4">
                    <span class="text-[9px] text-[#999999] dark:text-[#666666] font-bold uppercase tracking-[0.3em] hidden sm:inline-block">Ordenar:</span>
                    <div class="relative custom-sort-wrapper">
                        <?php woocommerce_catalog_ordering(); ?>
                    </div>
                </div>
            </div>

            <?php
            if ( woocommerce_product_loop() ) {

                do_action( 'woocommerce_before_shop_loop' );

                // The container that will hold the appended products
                echo '<div id="lh-products-grid" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-y-16 gap-x-8 md:gap-x-12">';

                if ( wc_get_loop_prop( 'total' ) ) {
                    while ( have_posts() ) {
                        the_post();
                        do_action( 'woocommerce_shop_loop' );

                        global $product;
                        $link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );

                        // Harvest taxonomies for the unified string
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

                        // Exact same card structure as the new Swiper carousel
                        ?>
                        <div class="lh-product-card group relative flex flex-col items-center text-center transition duration-300 bg-transparent h-full">
                            <!-- Clean Image Link -->
                            <a href="<?php echo esc_url( $link ); ?>" class="block w-full overflow-hidden relative rounded-sm shadow-md group-hover:shadow-xl transition-shadow duration-300 mb-4" style="aspect-ratio: 3/4; font-size: 0; line-height: 0;">
                                <?php echo $product->get_image( 'woocommerce_thumbnail', array( 'class' => 'absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-in-out block m-0 p-0' ) ); ?>
                            </a>

                            <div class="flex flex-col justify-start w-full px-1 items-center text-center flex-grow">
                                <!-- Unified Taxonomies -->
                                <?php if ( ! empty( $formatted_taxonomies ) ) : ?>
                                    <span class="text-[8px] md:text-[9px] font-black uppercase tracking-[0.25em] text-[#999999] mb-2 leading-relaxed">
                                        <?php echo $formatted_taxonomies; ?>
                                    </span>
                                <?php endif; ?>

                                <!-- Title -->
                                <h2 class="text-base md:text-lg font-bold text-black dark:text-white mb-1 tracking-wide whitespace-normal leading-tight">
                                    <a href="<?php echo esc_url( $link ); ?>" class="hover:underline decoration-2 underline-offset-4">
                                        <?php echo get_the_title(); ?>
                                    </a>
                                </h2>

                                <!-- Price -->
                                <div class="text-xs md:text-sm text-[#666666] dark:text-[#bbbbbb] font-light mb-6">
                                    <?php echo $product->get_price_html(); ?>
                                </div>

                                <!-- Dynamic Button based on rarity -->
                                <?php
                                    $btn_bg = 'bg-gray-900 dark:bg-white text-white dark:text-black';
                                    if ( $c_slug === 'nicho' ) $btn_bg = 'bg-gradient-to-r from-yellow-400 to-yellow-600 text-white shadow-md hover:shadow-lg hover:shadow-yellow-500/20';
                                    elseif ( $c_slug === 'arabe' ) $btn_bg = 'bg-gradient-to-r from-purple-500 to-purple-800 text-white shadow-md hover:shadow-lg hover:shadow-purple-500/20';
                                    elseif ( $c_slug === 'disenador' ) $btn_bg = 'bg-gradient-to-r from-blue-400 to-blue-700 text-white shadow-md hover:shadow-lg hover:shadow-blue-500/20';
                                    elseif ( $c_slug === 'accesible' ) $btn_bg = 'bg-gradient-to-r from-emerald-400 to-emerald-700 text-white shadow-md hover:shadow-lg hover:shadow-emerald-500/20';
                                ?>
                                <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="mt-auto inline-block px-6 py-3 w-full max-w-[90%] text-[9px] md:text-[10px] font-black uppercase tracking-[0.2em] rounded-sm transition-all duration-300 transform group-hover:scale-105 <?php echo esc_attr($btn_bg); ?>">
                                    Adquirir fragancia
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                }

                echo '</div>'; // End custom grid

                // Infinite Scroll / Load More Logic
                // We hide the default pagination and add our custom button.
                $max_pages = $wp_query->max_num_pages;
                if ( $max_pages > 1 ) {
                    $next_page_url = next_posts($max_pages, false);
                    ?>
                    <div id="lh-load-more-container" class="mt-20 text-center relative w-full flex justify-center border-t border-[#eeeeee] dark:border-[#222222] pt-16">
                        <button id="lh-load-more-btn" data-url="<?php echo esc_url($next_page_url); ?>" data-page="1" data-max="<?php echo esc_attr($max_pages); ?>" class="relative inline-flex items-center justify-center px-10 py-4 bg-transparent border border-black dark:border-white text-black dark:text-white text-[10px] md:text-xs font-black uppercase tracking-[0.25em] hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-all duration-500 overflow-hidden group">
                            <span class="relative z-10 transition-transform duration-300 group-hover:-translate-y-1">Cargar más fragancias</span>

                            <!-- Elegant loading spinner (hidden by default) -->
                            <svg class="w-4 h-4 absolute opacity-0 scale-50 transition-all duration-300 group-[.loading]:opacity-100 group-[.loading]:scale-100 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const loadBtn = document.getElementById('lh-load-more-btn');
                            const grid = document.getElementById('lh-products-grid');

                            if(!loadBtn || !grid) return;

                            let isLoading = false;

                            loadBtn.addEventListener('click', function(e) {
                                e.preventDefault();
                                if(isLoading) return;

                                const url = this.getAttribute('data-url');
                                let currentPage = parseInt(this.getAttribute('data-page'));
                                const maxPages = parseInt(this.getAttribute('data-max'));

                                if (!url || currentPage >= maxPages) return;

                                isLoading = true;
                                loadBtn.classList.add('loading');
                                loadBtn.querySelector('span').style.opacity = '0'; // hide text

                                fetch(url)
                                    .then(response => response.text())
                                    .then(html => {
                                        const parser = new DOMParser();
                                        const doc = parser.parseFromString(html, 'text/html');
                                        const newProducts = doc.querySelectorAll('#lh-products-grid .lh-product-card');
                                        const newBtn = doc.querySelector('#lh-load-more-btn');

                                        if (newProducts.length > 0) {
                                            newProducts.forEach(product => {
                                                // Add a small fade-in animation
                                                product.style.opacity = '0';
                                                product.style.transform = 'translateY(20px)';
                                                grid.appendChild(product);

                                                // Trigger reflow to apply CSS transition
                                                void product.offsetWidth;

                                                product.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
                                                product.style.opacity = '1';
                                                product.style.transform = 'translateY(0)';
                                            });
                                        }

                                        // Update button data
                                        currentPage++;
                                        if (currentPage >= maxPages || !newBtn) {
                                            loadBtn.style.display = 'none'; // Reached end
                                        } else {
                                            loadBtn.setAttribute('data-url', newBtn.getAttribute('data-url'));
                                            loadBtn.setAttribute('data-page', currentPage);
                                        }

                                        isLoading = false;
                                        loadBtn.classList.remove('loading');
                                        loadBtn.querySelector('span').style.opacity = '1';
                                    })
                                    .catch(err => {
                                        console.error('Error loading products:', err);
                                        isLoading = false;
                                        loadBtn.classList.remove('loading');
                                        loadBtn.querySelector('span').style.opacity = '1';
                                    });
                            });
                        });
                    </script>
                    <?php
                }

                // We hide default pagination via CSS below or by not calling it.
                // do_action( 'woocommerce_after_shop_loop' );
            } else {
                do_action( 'woocommerce_no_products_found' );
            }
            ?>
        </main>
    </div>
</div>

<style>
    /* Global fixes for the shop page */
    .woocommerce-pagination { display: none !important; } /* Hide default WC pagination */

    /* Elegant dropdown styling for the WC catalog ordering select */
    .custom-sort-wrapper select {
        appearance: none;
        background-color: transparent;
        border: none;
        border-bottom: 1px solid #cccccc;
        color: inherit;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        font-weight: 700;
        padding: 4px 20px 4px 0;
        cursor: pointer;
        outline: none;
    }
    .dark .custom-sort-wrapper select {
        border-bottom-color: #555555;
    }
    .custom-sort-wrapper::after {
        content: '';
        position: absolute;
        right: 4px;
        top: 50%;
        transform: translateY(-50%);
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        border-top: 4px solid currentColor;
        pointer-events: none;
    }
</style>

<?php
get_footer( 'shop' );
