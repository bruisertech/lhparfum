    </div><!-- #content -->

    <!-- Main Footer Area -->
    <footer id="colophon" class="site-footer bg-white dark:bg-gray-900 text-gray-600 dark:text-white border-t border-gray-100 dark:border-gray-800 pt-8 pb-24 md:pb-8 mt-auto flex flex-col items-center justify-center text-center transition-colors duration-300">
        <div class="text-sm text-gray-500 dark:text-gray-400">
            <p class="mb-2">&copy; <?php echo date('Y'); ?> <?php echo esc_html( get_theme_mod( 'lhparfum_footer_copyright', 'LHPARFUM. Todos los derechos reservados.' ) ); ?></p>
            <p>
                <?php
                /* translators: %s: CMS name, i.e. WordPress. */
                printf( esc_html__( 'Desarrollado por %s', 'bruiser-tech-lhparfum' ), '<a href="https://instagram.com/bruiser.tech" target="_blank" class="text-gray-900 dark:text-white hover:underline font-medium tracking-wide transition-colors">Bruiser Tech</a>' );
                ?>
            </p>
        </div>
    </footer><!-- #colophon -->
</div><!-- #page -->

<!-- Mobile Bottom Navigation Bar -->
<div class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 md:hidden flex justify-around items-center px-4 shadow-lg transition-colors duration-300">
    <!-- Home -->
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex flex-col items-center justify-center w-full h-full text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white group">
        <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
        <span class="text-[10px] font-medium uppercase tracking-wider">Inicio</span>
    </a>

    <!-- Shop -->
    <a href="<?php echo class_exists( 'WooCommerce' ) ? esc_url( wc_get_page_permalink( 'shop' ) ) : '#'; ?>" class="flex flex-col items-center justify-center w-full h-full text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white group">
        <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        <span class="text-[10px] font-medium uppercase tracking-wider">Tienda</span>
    </a>

    <!-- Cart -->
    <button type="button" class="lhparfum-side-cart-toggle flex flex-col items-center justify-center w-full h-full text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white group relative cursor-pointer">
        <div class="relative">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            <?php if ( class_exists( 'WooCommerce' ) && isset(WC()->cart) && WC()->cart ) : ?>
                <span class="lhparfum-cart-count absolute -top-1 -right-2 bg-black dark:bg-white text-white dark:text-black text-[10px] font-bold px-1.5 py-0.5 rounded-full leading-none">
                    <?php echo wp_kses_data( WC()->cart->get_cart_contents_count() ); ?>
                </span>
            <?php endif; ?>
        </div>
        <span class="text-[10px] font-medium uppercase tracking-wider mt-1">Bolsa</span>
    </button>
</div>

<!-- Side Cart (Drawer) -->
<?php if ( class_exists( 'WooCommerce' ) ) : ?>
<div id="lhparfum-side-cart-overlay" class="fixed inset-0 bg-black/60 dark:bg-black/80 z-[60] hidden transition-opacity duration-500 opacity-0 cursor-pointer backdrop-blur-md"></div>

<!-- Safely contained drawer layout. Avoids mt-[], mr-[] math that breaks desktop browsers -->
<div id="lhparfum-side-cart" class="fixed top-0 right-0 bottom-0 w-full sm:w-[450px] h-full bg-white dark:bg-gray-900 z-[70] rounded-none sm:rounded-l-[2rem] transform translate-x-full transition-transform duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] shadow-[0_20px_50px_rgba(0,0,0,0.5)] flex flex-col border-l border-gray-100 dark:border-gray-800 transform-gpu will-change-transform">
    <!-- Header -->
    <div class="flex items-center justify-between px-8 py-6 border-b border-gray-100 dark:border-gray-800 bg-white/90 dark:bg-gray-900/90 backdrop-blur-xl z-20 shrink-0">
        <h2 class="text-lg md:text-xl font-black uppercase tracking-[0.25em] text-gray-900 dark:text-white"><?php esc_html_e( 'Tu Bolsa', 'bruiser-tech-lhparfum' ); ?></h2>
        <button id="lhparfum-close-cart" type="button" class="text-gray-400 hover:text-black dark:hover:text-white transition-colors p-2 bg-gray-100 dark:bg-gray-800 rounded-full hover:scale-105 active:scale-95">
            <span class="sr-only">Cerrar carrito</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <!-- Content (AJAX Fragments load here) -->
    <div class="flex-grow overflow-y-auto overflow-x-hidden px-6 sm:px-8 py-6 scrollbar-hide bg-[#fcfcfc] dark:bg-[#111111] relative z-10">
        <div class="widget_shopping_cart_content h-full">
            <?php woocommerce_mini_cart(); ?>
        </div>
    </div>
</div>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
    var themeToggleBtn = document.getElementById('theme-toggle');

    if (!themeToggleBtn || !themeToggleDarkIcon || !themeToggleLightIcon) return;

    // Change the icons inside the button based on previous settings
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        themeToggleLightIcon.classList.remove('hidden');
    } else {
        themeToggleDarkIcon.classList.remove('hidden');
    }

    themeToggleBtn.addEventListener('click', function() {
        // toggle icons inside button
        themeToggleDarkIcon.classList.toggle('hidden');
        themeToggleLightIcon.classList.toggle('hidden');

        // if set via local storage previously
        if (localStorage.getItem('color-theme')) {
            if (localStorage.getItem('color-theme') === 'light') {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            }

        // if NOT set via local storage previously
        } else {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        }

        // Ensure body transitions immediately to prevent visual tearing
        document.body.classList.add('transition-colors', 'duration-300');
    });

    // Side Cart UI Logic
    const cartToggles = document.querySelectorAll('.lhparfum-side-cart-toggle');
    const closeCartBtn = document.getElementById('lhparfum-close-cart');
    const cartOverlay = document.getElementById('lhparfum-side-cart-overlay');
    const sideCart = document.getElementById('lhparfum-side-cart');

    function openSideCart(e) {
        if(e) e.preventDefault();
        cartOverlay.classList.remove('hidden');
        // small timeout to allow display:block to apply before animating opacity
        setTimeout(() => {
            cartOverlay.classList.remove('opacity-0');
            sideCart.classList.remove('translate-x-full');
            document.body.classList.add('overflow-hidden'); // Prevent background scrolling
        }, 10);
    }

    function closeSideCart(e) {
        if(e) e.preventDefault();
        cartOverlay.classList.add('opacity-0');
        sideCart.classList.add('translate-x-full');
        document.body.classList.remove('overflow-hidden');
        setTimeout(() => {
            cartOverlay.classList.add('hidden');
        }, 300); // match transition duration
    }

    if (sideCart) {
        cartToggles.forEach(toggle => {
            toggle.addEventListener('click', openSideCart);
        });
        closeCartBtn.addEventListener('click', closeSideCart);
        cartOverlay.addEventListener('click', closeSideCart);
    }

    // Optional: Open side cart when item added via AJAX (WooCommerce triggers this event)
    jQuery(document.body).on('added_to_cart', function() {
        openSideCart();
    });

    // Handle AJAX Quantity Updates
    jQuery(document).on('click', '.lhparfum-qty-btn', function(e) {
        e.preventDefault();

        const $btn = jQuery(this);
        const action = $btn.data('action');
        const cartItemKey = $btn.data('cart_item_key');
        const $input = $btn.siblings('.lhparfum-qty-input');
        let currentVal = parseInt($input.val());
        const maxVal = $input.attr('max') ? parseInt($input.attr('max')) : null;

        if (action === 'plus') {
            if (maxVal && currentVal >= maxVal) return;
            currentVal++;
        } else if (action === 'minus') {
            if (currentVal <= 0) return;
            currentVal--;
        }

        $input.val(currentVal);

        const $cartContent = jQuery('.widget_shopping_cart_content');
        $cartContent.css({'opacity': '0.5', 'pointer-events': 'none'});

        jQuery.ajax({
            type: 'POST',
            url: lhparfum_ajax.ajax_url,
            data: {
                action: 'lhparfum_update_mini_cart',
                nonce: lhparfum_ajax.nonce,
                cart_item_key: cartItemKey,
                qty: currentVal
            },
            success: function(response) {
                if(response.success) {
                    // Trigger WooCommerce fragment refresh to redraw the cart UI
                    jQuery(document.body).trigger('wc_fragment_refresh');
                } else {
                    $cartContent.css({'opacity': '1', 'pointer-events': 'auto'});
                }
            },
            error: function() {
                $cartContent.css({'opacity': '1', 'pointer-events': 'auto'});
            }
        });
    });

    // Reset Sidecart opacity and interactions when WooCommerce finishes loading fragments
    jQuery(document.body).on('wc_fragments_refreshed wc_fragments_loaded', function() {
        const $cartContent = jQuery('.widget_shopping_cart_content');
        if ($cartContent.length) {
            $cartContent.css({'opacity': '1', 'pointer-events': 'auto'});
        }
    });

    // Failsafe: if AJAX hangs, unlock the cart after 4 seconds
    jQuery(document).ajaxComplete(function(event, xhr, settings) {
        if(settings.data && settings.data.includes('action=lhparfum_update_mini_cart')) {
            setTimeout(function() {
                jQuery('.widget_shopping_cart_content').css({'opacity': '1', 'pointer-events': 'auto'});
            }, 3000);
        }
    });
});
</script>

<!-- Load Splide JS and AutoScroll Extension -->
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js"></script>

<?php wp_footer(); ?>

</body>
</html>
