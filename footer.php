    </div><!-- #content -->

    <!-- Main Footer Area -->
    <footer id="colophon" class="site-footer bg-gray-900 text-white pt-12 pb-24 md:pb-12 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8">

            <!-- Company Info / Emergency -->
            <div class="mb-8 md:mb-0">
                <h3 class="text-sm font-semibold tracking-wider uppercase text-gray-400 mb-4">LHPARFUM</h3>
                <p class="text-gray-300 text-sm mb-4">Perfumería de lujo en Colombia.</p>
                <div class="mt-4">
                    <p class="text-sm text-gray-400 font-semibold mb-1">Contacto de Emergencia</p>
                    <p class="text-gray-300 text-sm">Llámanos: <?php echo esc_html( get_theme_mod( 'lhparfum_footer_phone', '+57 300 123 4567' ) ); ?></p>
                </div>
            </div>

            <!-- Links -->
            <div>
                <h3 class="text-sm font-semibold tracking-wider uppercase text-gray-400 mb-4">Tienda</h3>
                <ul class="space-y-2 text-sm text-gray-300">
                    <li><a href="#" class="hover:text-white transition-colors">Todos los Perfumes</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Mujeres</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Hombres</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Unisex</a></li>
                </ul>
            </div>

            <!-- Help -->
            <div>
                <h3 class="text-sm font-semibold tracking-wider uppercase text-gray-400 mb-4">Ayuda</h3>
                <ul class="space-y-2 text-sm text-gray-300">
                    <li><a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>" class="hover:text-white transition-colors">Contáctanos</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">FAQ</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Rastrear Pedido</a></li>
                </ul>
            </div>

            <!-- Social / Dev Info -->
            <div>
                <h3 class="text-sm font-semibold tracking-wider uppercase text-gray-400 mb-4">Conectar</h3>
                <div class="flex space-x-4 mb-6">
                    <!-- Instagram Icon -->
                    <a href="https://instagram.com/bruiser.tech" target="_blank" class="text-gray-400 hover:text-white">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
                <div class="text-sm text-gray-400">
                    <p class="mb-2">&copy; <?php echo date('Y'); ?> <?php echo esc_html( get_theme_mod( 'lhparfum_footer_copyright', 'LHPARFUM. Todos los derechos reservados.' ) ); ?></p>
                    <p>
                        <?php
                        /* translators: %s: CMS name, i.e. WordPress. */
                        printf( esc_html__( 'Desarrollado por %s', 'bruiser-tech-lhparfum' ), '<a href="https://instagram.com/bruiser.tech" target="_blank" class="text-white hover:underline font-medium">Bruiser Tech</a>' );
                        ?>
                    </p>
                </div>
            </div>

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
<div id="lhparfum-side-cart-overlay" class="fixed inset-0 bg-black/50 z-[60] hidden transition-opacity duration-300 opacity-0 cursor-pointer backdrop-blur-sm"></div>
<div id="lhparfum-side-cart" class="fixed top-0 right-0 w-full md:w-[450px] h-full bg-white dark:bg-gray-900 z-[70] transform translate-x-full transition-transform duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] shadow-2xl flex flex-col">
    <!-- Header -->
    <div class="flex items-center justify-between px-6 py-5 border-b border-gray-200 dark:border-gray-800">
        <h2 class="text-lg font-bold uppercase tracking-widest text-gray-900 dark:text-white"><?php esc_html_e( 'Tu Bolsa', 'bruiser-tech-lhparfum' ); ?></h2>
        <button id="lhparfum-close-cart" type="button" class="text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors p-2">
            <span class="sr-only">Cerrar carrito</span>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <!-- Content (AJAX Fragments load here) -->
    <div class="flex-grow overflow-y-auto overflow-x-hidden p-6 scrollbar-hide bg-gray-50 dark:bg-gray-900/50">
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
        $cartContent.css('opacity', '0.5');

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
                    $cartContent.css('opacity', '1');
                }
            },
            error: function() {
                $cartContent.css('opacity', '1');
            }
        });
    });
});
</script>

<!-- Load Splide JS and AutoScroll Extension -->
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js"></script>

<?php wp_footer(); ?>

</body>
</html>
