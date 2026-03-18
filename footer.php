    </div><!-- #content -->

    <!-- Main Footer Area -->
    <footer id="colophon" class="site-footer text-white border-t border-gray-800 pt-12 pb-24 md:pb-12 mt-auto flex flex-col items-center justify-center text-center z-40 relative" style="background: linear-gradient(to bottom, #39393a, #2c2b2c, #1d1d1d);">
        <div class="max-w-7xl mx-auto px-4 w-full">
            <div class="flex flex-col items-center justify-center space-y-8">

                <!-- 1. Mini Site Index (Top) -->
                <nav class="flex flex-wrap justify-center items-center text-xs sm:text-sm font-medium uppercase tracking-wide text-white w-full">

                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hidden md:inline hover:text-gray-300 transition-colors">Inicio</a>
                    <span class="mx-2 sm:mx-3 text-white hidden md:inline">|</span>

                    <a href="<?php echo class_exists( 'WooCommerce' ) ? esc_url( wc_get_page_permalink( 'shop' ) ) : esc_url( home_url( '/shop/' ) ); ?>" class="hidden md:inline hover:text-gray-300 transition-colors">Tienda</a>
                    <span class="mx-2 sm:mx-3 text-white hidden md:inline">|</span>

                    <a href="<?php echo esc_url( home_url( '/sobre-nosotros/' ) ); ?>" class="hover:text-gray-300 transition-colors">Sobre Nosotros</a>
                    <span class="mx-2 sm:mx-3 text-white">|</span>

                    <a href="<?php echo esc_url( home_url( '/lhoriginals/' ) ); ?>" class="hover:text-gray-300 transition-colors">LH Originals</a>
                    <span class="mx-2 sm:mx-3 text-white">|</span>

                    <a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>" class="hover:text-gray-300 transition-colors">Contacto</a>
                    <span class="mx-2 sm:mx-3 text-white hidden md:inline">|</span>

                    <a href="<?php echo esc_url( home_url( '/legal/' ) ); ?>" class="hover:text-gray-300 transition-colors">Legal</a>
                    <span class="mx-2 sm:mx-3 text-white">|</span>

                    <a href="<?php echo esc_url( home_url( '/politicasyprivacidad/' ) ); ?>" class="hover:text-gray-300 transition-colors">Políticas y Privacidad</a>
                </nav>

                <!-- 2. Social Icons (Middle) -->
                <div class="flex items-center justify-center space-x-6">
                    <!-- WhatsApp -->
                    <a href="https://api.whatsapp.com/send?phone=573176689404" target="_blank" rel="noopener noreferrer" class="text-white hover:text-gray-300 transition-colors" aria-label="WhatsApp">
                        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    </a>
                    <!-- TikTok -->
                    <a href="https://www.tiktok.com/@lhparfumofficial" target="_blank" rel="noopener noreferrer" class="text-white hover:text-gray-300 transition-colors" aria-label="TikTok">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 448 512" aria-hidden="true"><path d="M448 209.9a210.1 210.1 0 0 1 -122.8-39.3V349.4A162.6 162.6 0 1 1 185 188.3V278.2a74.6 74.6 0 1 0 52.2 71.2V0l88 0a121.2 121.2 0 0 0 1.9 22.2h0A122.2 122.2 0 0 0 381 102.4a121.4 121.4 0 0 0 67 20.1z"/></svg>
                    </a>
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/lhparfumofficial" target="_blank" rel="noopener noreferrer" class="text-white hover:text-gray-300 transition-colors" aria-label="Facebook">
                        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                    </a>
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/lhparfumofficial" target="_blank" rel="noopener noreferrer" class="text-white hover:text-gray-300 transition-colors" aria-label="Instagram">
                        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                    </a>
                    <!-- YouTube -->
                    <a href="https://www.youtube.com/@lhparfumofficial" target="_blank" rel="noopener noreferrer" class="text-white hover:text-gray-300 transition-colors" aria-label="YouTube">
                        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" clip-rule="evenodd" /></svg>
                    </a>
                    <!-- Threads -->
                    <a href="https://www.threads.net/@lhparfumofficial" target="_blank" rel="noopener noreferrer" class="text-white hover:text-gray-300 transition-colors" aria-label="Threads">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 448 512" aria-hidden="true"><path d="M331.5 235.7c2.2 .9 4.2 1.9 6.3 2.8c29.2 14.1 50.6 35.2 61.8 61.4c15.7 36.5 17.2 95.8-30.3 143.2c-36.2 36.2-80.3 52.5-142.6 53h-.3c-70.2-.5-124.1-24.1-160.4-70.2c-32.3-41-48.9-98.1-49.5-169.6V256v-.2C17 184.3 33.6 127.2 65.9 86.2C102.2 40.1 156.2 16.5 226.4 16h.3c70.3 .5 124.9 24 162.3 69.9c18.4 22.7 32 50 40.6 81.7l-40.4 10.8c-7.1-25.8-17.8-47.8-32.2-65.4c-29.2-35.8-73-54.2-130.5-54.6c-57 .5-100.1 18.8-128.2 54.4C72.1 146.1 58.5 194.3 58 256c.5 61.7 14.1 109.9 40.3 143.3c28 35.6 71.2 53.9 128.2 54.4c51.4-.4 85.4-12.6 113.7-40.9c32.3-32.2 31.7-71.8 21.4-95.9c-7.6-17.8-22.1-33.1-44.5-44l-5.6-2.7c-33.4-15.6-76.4-23.2-127.2-23.2h-22.3V207h22.3c35.6 0 69.9 5.8 101.5 17.1l.9 .3c10.3 3.5 19.8 7.5 28.5 11.9zm-29.1 77.4l-.8-.3c-1.3-.5-2.6-1-3.9-1.5c-48.5-18.4-118-20.9-158.4-12.7c-5.7 1.2-11.4 2.6-17.1 4.2c-8 2.3-15.6 5-22.8 8c-30.8 13.1-48.4 34.2-50.6 61.6c-1 12.5 1.7 25.1 8 36.4c14.2 25.4 46.5 35 83.2 35c42.8 0 76.5-12.2 97.4-35.2c16-17.6 22.5-39.7 18.8-63.4c-2.4-15.4-8-27.1-16.7-34.9c-8.5-7.7-20.7-12-35.5-13.6c-8.2-1-17.1-1.2-26.6-1.2c-15.4 0-30.1 .7-43.2 2.6c-3 10.6-4.5 21.5-4.4 32c-.1 12.5 1.7 25 5.5 36.9c7.9 23.4 25.4 36.9 50.8 38.6c20.4 1.3 40.5-4.1 57.3-15.5c22.1-15 32.8-37.3 30.6-63.5c-1-12.3-5-23-11.6-31.5c-8.4-10.7-21.7-17-38.3-18.3c-11.5-1-23.7-1.1-35.6-1.1c-14.7 0-28.7-.7-41.2-2.3c-14.6-1.8-27-5-36.2-9.4c-12.3-5.9-19-14-18.3-22.5c.7-8.4 8.7-15.5 23-20.5c16.5-5.8 38.3-8.8 62.9-8.8c42.2 0 74.3 6.6 92.5 19.1c11.3 7.8 17.6 17.4 18.3 27.8c.4 5.9-1 11.5-4 16.5v.1z"/></svg>
                    </a>
                </div>

                <!-- 3. Copyright (Bottom) -->
                <div class="flex flex-col items-center text-center text-[10px] md:text-xs text-white uppercase tracking-[0.2em] w-full pt-4">
                    <p>&copy; 2026 LH Parfum - Desarrollado por <a href="https://instagram.com/bruiser.tech" target="_blank" rel="noopener noreferrer" class="hover:text-gray-300 font-bold transition-colors">Bruiser Tech</a></p>
                </div>

            </div>
        </div>
    </footer><!-- #colophon -->
</div><!-- #page -->

<!-- Mobile Bottom Navigation Bar -->
<div class="fixed bottom-0 left-0 z-50 w-full h-16 bg-[#600470] dark:bg-gray-900 border-t border-[#600470]/20 dark:border-gray-800 md:hidden flex justify-around items-center px-4 shadow-lg transition-colors duration-300">
    <!-- Home -->
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex flex-col items-center justify-center w-full h-full text-white/70 dark:text-gray-400 hover:text-white dark:hover:text-white group">
        <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
        <span class="text-[10px] font-medium uppercase tracking-wider text-white">Inicio</span>
    </a>

    <!-- Shop -->
    <a href="<?php echo class_exists( 'WooCommerce' ) ? esc_url( wc_get_page_permalink( 'shop' ) ) : '#'; ?>" class="flex flex-col items-center justify-center w-full h-full text-white/70 dark:text-gray-400 hover:text-white dark:hover:text-white group">
        <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V10C19 8.89543 18.1046 8 17 8H15M19 21H5M19 21H21M5 21V10C5 8.89543 5.89543 8 7 8H9M5 21H3M9 8H15M9 8V5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V8M9 21H15M9 21V16C9 14.8954 9.89543 14 11 14H13C14.1046 14 15 14.8954 15 16V21"></path></svg>
        <span class="text-[10px] font-medium uppercase tracking-wider text-white">Tienda</span>
    </a>

    <!-- Cart -->
    <button type="button" class="lhparfum-side-cart-toggle flex flex-col items-center justify-center w-full h-full text-white/70 dark:text-gray-400 hover:text-white dark:hover:text-white group relative cursor-pointer">
        <div class="relative">
            <svg class="w-6 h-6 mb-1 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            <?php if ( class_exists( 'WooCommerce' ) && isset(WC()->cart) && WC()->cart ) : ?>
                <span class="lhparfum-cart-count absolute -top-1 -right-2 bg-white dark:bg-white text-[#600470] dark:text-black text-[10px] font-bold px-1.5 py-0.5 rounded-full leading-none">
                    <?php echo wp_kses_data( WC()->cart->get_cart_contents_count() ); ?>
                </span>
            <?php endif; ?>
        </div>
        <span class="text-[10px] font-medium uppercase tracking-wider mt-1 text-white">Bolsa</span>
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
