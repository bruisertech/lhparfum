<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <!-- Load Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Load Alex Brush Font for Scent Families -->
    <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&display=swap" rel="stylesheet">

    <!-- Load Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Load Splide CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">

    <script>
        // Tailwind config for dark mode
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    animation: {
                        'pulse-glow-gold': 'pulseGlowGold 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'pulse-glow-purple': 'pulseGlowPurple 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'pulse-glow-blue': 'pulseGlowBlue 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'pulse-glow-green': 'pulseGlowGreen 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'pulse-glow-white': 'pulseGlowWhite 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        pulseGlowWhite: {
                            '0%, 100%': { boxShadow: '0 0 5px rgba(255,255,255,0.2)' },
                            '50%': { boxShadow: '0 0 20px rgba(255,255,255,0.6)' },
                        },
                        pulseGlowGold: {
                            '0%, 100%': { boxShadow: '0 0 5px #fbbf24, 0 0 10px #fbbf24' },
                            '50%': { boxShadow: '0 0 15px #f59e0b, 0 0 20px #f59e0b' },
                        },
                        pulseGlowPurple: {
                            '0%, 100%': { boxShadow: '0 0 5px #a855f7, 0 0 10px #a855f7' },
                            '50%': { boxShadow: '0 0 15px #9333ea, 0 0 20px #9333ea' },
                        },
                        pulseGlowBlue: {
                            '0%, 100%': { boxShadow: '0 0 5px #60a5fa, 0 0 10px #60a5fa' },
                            '50%': { boxShadow: '0 0 15px #3b82f6, 0 0 20px #3b82f6' },
                        },
                        pulseGlowGreen: {
                            '0%, 100%': { boxShadow: '0 0 5px #4ade80, 0 0 10px #4ade80' },
                            '50%': { boxShadow: '0 0 15px #22c55e, 0 0 20px #22c55e' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .dark img.dark-mode-logo-invert { filter: invert(1) hue-rotate(180deg); }

        /* Scrollbar styling for aesthetic */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        .dark ::-webkit-scrollbar-track { background: #1f2937; }
        ::-webkit-scrollbar-thumb { background: #888; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #555; }
        .dark ::-webkit-scrollbar-thumb { background: #4b5563; }
        .dark ::-webkit-scrollbar-thumb:hover { background: #6b7280; }

        /* Force restrict custom logo output from WP */
        .site-header img.custom-logo { max-height: 48px !important; width: auto !important; object-fit: contain; }

        /* Force WooCommerce Add to Cart to look like our Luxury Button */
        .custom-add-to-cart-wrapper form.cart { display: flex; flex-direction: column; gap: 1.5rem; width: 100%; max-width: 400px; align-items: center; }
        @media (min-width: 1024px) {
            .custom-add-to-cart-wrapper form.cart { align-items: flex-end; }
        }

        /* Hide default number spin buttons for elegant quantity input */
        .quantity input[type=number]::-webkit-inner-spin-button,
        .quantity input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
        .quantity input[type=number] { -moz-appearance: textfield; }

        .custom-add-to-cart-wrapper button.single_add_to_cart_button {
            width: 100%;
            background-color: #000;
            color: #fff;
            padding: 1.25rem 2rem;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.25em;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            position: relative;
            overflow: hidden;
            border-radius: 2px;
        }

        .dark .custom-add-to-cart-wrapper button.single_add_to_cart_button {
            background-color: #fff;
            color: #000;
        }

        /* Dynamic Background Color Overrides based on Rarity */
        .custom-add-to-cart-wrapper.btn-bg-nicho button.single_add_to_cart_button { background: linear-gradient(to right, #fbbf24, #d97706); color: white; }
        .custom-add-to-cart-wrapper.btn-bg-arabe button.single_add_to_cart_button { background: linear-gradient(to right, #a855f7, #7e22ce); color: white; }
        .custom-add-to-cart-wrapper.btn-bg-disenador button.single_add_to_cart_button { background: linear-gradient(to right, #60a5fa, #1d4ed8); color: white; }
        .custom-add-to-cart-wrapper.btn-bg-accesible button.single_add_to_cart_button { background: linear-gradient(to right, #34d399, #047857); color: white; }

        .custom-add-to-cart-wrapper button.single_add_to_cart_button:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transform: translateY(-2px);
        }

        /* The specific rarity glows */
        .custom-add-to-cart-wrapper.glow-nicho button.single_add_to_cart_button { animation: pulseGlowGold 3s infinite; }
        .custom-add-to-cart-wrapper.glow-arabe button.single_add_to_cart_button { animation: pulseGlowPurple 3s infinite; }
        .custom-add-to-cart-wrapper.glow-disenador button.single_add_to_cart_button { animation: pulseGlowBlue 3s infinite; }
        .custom-add-to-cart-wrapper.glow-accesible button.single_add_to_cart_button { animation: pulseGlowGreen 3s infinite; }
        .custom-add-to-cart-wrapper button.single_add_to_cart_button:hover { animation: none; }

        /* Variable products clean up */
        .custom-add-to-cart-wrapper table.variations { width: 100%; margin-bottom: 1.5rem; text-align: left; }
        .custom-add-to-cart-wrapper table.variations td.label { font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.1em; color: #888; padding-bottom: 0.5rem; }
        .custom-add-to-cart-wrapper table.variations select { width: 100%; padding: 0.75rem; background: transparent; border: 1px solid #ddd; outline: none; margin-bottom: 1rem; }
        .dark .custom-add-to-cart-wrapper table.variations select { border-color: #444; color: white; }
        .custom-add-to-cart-wrapper .woocommerce-variation-price { font-size: 1.5rem; font-weight: 300; margin-bottom: 1rem; }

        /* Utility to hide scrollbar but allow scrolling */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Infinite Scroll Animation for Related Products */
        @keyframes slideLeft {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .animate-slide-left {
            animation: slideLeft 20s linear infinite;
        }
        .animate-slide-left:hover {
            animation-play-state: paused;
        }
    </style>

    <!-- Dark Mode Init Script -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>

    <?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased transition-colors duration-300' ); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site flex flex-col min-h-screen">
    <a class="skip-link screen-reader-text sr-only" href="#main-content"><?php esc_html_e( 'Saltar al contenido', 'bruiser-tech-lhparfum' ); ?></a>

    <!-- Top Banner (Optional, replicating Dossier's style) -->
    <div class="bg-gray-100 dark:bg-gray-800 text-center py-2 text-xs font-medium tracking-wide text-gray-900 dark:text-gray-100">
        Hasta 20% de descuento + envío GRATIS. <a href="<?php echo class_exists( 'WooCommerce' ) ? esc_url( wc_get_page_permalink( 'shop' ) ) : esc_url( home_url( '/tienda/' ) ); ?>" class="underline">Comprar ahora</a>
    </div>

    <!-- Main Navigation Header -->
    <header id="masthead" class="site-header border-b border-gray-200 dark:border-gray-800 sticky top-0 bg-white dark:bg-gray-900 z-50 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Mobile Menu Button -->
                <div class="flex items-center md:hidden flex-1">
                    <button type="button" id="mobile-menu-toggle" class="text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white focus:outline-none" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Abrir menú principal</span>
                        <svg class="h-6 w-6 transition-transform duration-300" id="hamburger-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg class="h-6 w-6 hidden transition-transform duration-300" id="close-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center justify-center flex-1 md:flex-none">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="block h-12 flex items-center">
                        <?php
                        if ( has_custom_logo() ) {
                            // Ensure the custom logo doesn't blow up the header by forcing height limits
                            the_custom_logo();
                        } else {
                            // Default to the generated transparent logos
                            echo '<img src="' . esc_url( get_template_directory_uri() . '/logo-black.png' ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" class="h-12 max-h-12 w-auto object-contain block dark:hidden">';
                            echo '<img src="' . esc_url( get_template_directory_uri() . '/logo-white.png' ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" class="h-12 max-h-12 w-auto object-contain hidden dark:block">';
                        }
                        ?>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav id="site-navigation" class="hidden md:flex md:space-x-8 md:items-center main-navigation">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'menu-1',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'menu_class'     => 'flex space-x-8 text-sm font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300',
                        'fallback_cb'    => false,
                    ) );
                    ?>
                    <!-- Fallback if menu not set -->
                    <?php if ( ! has_nav_menu( 'menu-1' ) ) : ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-sm font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300 hover:text-black dark:hover:text-white transition-colors">Inicio</a>
                        <a href="<?php echo esc_url( home_url( '/colecciones/' ) ); ?>" class="text-sm font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300 hover:text-black dark:hover:text-white transition-colors">Colecciones</a>
                        <a href="<?php echo class_exists( 'WooCommerce' ) ? esc_url( wc_get_page_permalink( 'shop' ) ) : esc_url( home_url( '/tienda/' ) ); ?>" class="text-sm font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300 hover:text-black dark:hover:text-white transition-colors">Tienda</a>
                        <a href="<?php echo esc_url( home_url( '/sobre-nosotros/' ) ); ?>" class="text-sm font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300 hover:text-black dark:hover:text-white transition-colors">Sobre Nosotros</a>
                        <a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>" class="text-sm font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300 hover:text-black dark:hover:text-white transition-colors">Contacto</a>
                    <?php endif; ?>
                </nav>

                <!-- Icons (Search, Cart, Dark Mode Toggle) - Hidden on Mobile -->
                <div class="hidden md:flex items-center space-x-4 flex-1 justify-end">
                    <!-- Dark Mode Toggle -->
                    <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none rounded-lg text-sm p-2">
                        <span class="sr-only">Toggle dark mode</span>
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                    </button>

                    <button class="text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        <span class="sr-only">Buscar</span>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                    <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                        <button type="button" class="lhparfum-side-cart-toggle text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white relative cursor-pointer">
                            <span class="sr-only">Carrito</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <span class="lhparfum-cart-count absolute -top-1 -right-2 bg-black dark:bg-white text-white dark:text-black text-[10px] font-bold px-1.5 py-0.5 rounded-full leading-none">
                                <?php echo wp_kses_data( WC()->cart->get_cart_contents_count() ); ?>
                            </span>
                        </button>
                    <?php endif; ?>
                </div>

                <!-- Spacer for mobile to keep logo centered -->
                <div class="flex-1 md:hidden"></div>
            </div>
        </div>
    </header><!-- #masthead -->

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu" class="fixed inset-0 z-[45] bg-white dark:bg-gray-900 transform -translate-x-full transition-transform duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] pt-20 px-6 overflow-y-auto">
        <nav class="flex flex-col space-y-8 mt-8">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'menu-1',
                'container'      => false,
                'menu_class'     => 'flex flex-col space-y-6 text-xl font-bold uppercase tracking-widest text-gray-900 dark:text-gray-100',
                'fallback_cb'    => false,
                'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>'
            ) );
            ?>
            <!-- Fallback if menu not set -->
            <?php if ( ! has_nav_menu( 'menu-1' ) ) : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-xl font-bold uppercase tracking-widest text-gray-900 dark:text-gray-100 hover:text-gray-500 transition-colors">Inicio</a>
                <a href="<?php echo esc_url( home_url( '/colecciones/' ) ); ?>" class="text-xl font-bold uppercase tracking-widest text-gray-900 dark:text-gray-100 hover:text-gray-500 transition-colors">Colecciones</a>
                <a href="<?php echo class_exists( 'WooCommerce' ) ? esc_url( wc_get_page_permalink( 'shop' ) ) : esc_url( home_url( '/tienda/' ) ); ?>" class="text-xl font-bold uppercase tracking-widest text-gray-900 dark:text-gray-100 hover:text-gray-500 transition-colors">Tienda</a>
                <a href="<?php echo esc_url( home_url( '/sobre-nosotros/' ) ); ?>" class="text-xl font-bold uppercase tracking-widest text-gray-900 dark:text-gray-100 hover:text-gray-500 transition-colors">Sobre Nosotros</a>
                <a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>" class="text-xl font-bold uppercase tracking-widest text-gray-900 dark:text-gray-100 hover:text-gray-500 transition-colors">Contacto</a>
            <?php endif; ?>

            <div class="pt-8 border-t border-gray-200 dark:border-gray-800 flex items-center justify-between">
                <span class="text-sm font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400">Modo Oscuro</span>
                <button id="mobile-theme-toggle" type="button" class="w-12 h-6 rounded-full bg-gray-300 dark:bg-gray-600 relative transition-colors focus:outline-none">
                    <span class="sr-only">Toggle dark mode</span>
                    <span class="absolute left-1 top-1 w-4 h-4 rounded-full bg-white transition-transform transform dark:translate-x-6"></span>
                </button>
            </div>
        </nav>
    </div>

    <!-- Mobile Menu Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('mobile-menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            const hamburgerIcon = document.getElementById('hamburger-icon');
            const closeIcon = document.getElementById('close-icon');
            let isMenuOpen = false;

            if (toggleBtn && mobileMenu) {
                toggleBtn.addEventListener('click', function() {
                    isMenuOpen = !isMenuOpen;
                    if (isMenuOpen) {
                        mobileMenu.classList.remove('-translate-x-full');
                        hamburgerIcon.classList.add('hidden');
                        closeIcon.classList.remove('hidden');
                        document.body.classList.add('overflow-hidden');
                    } else {
                        mobileMenu.classList.add('-translate-x-full');
                        hamburgerIcon.classList.remove('hidden');
                        closeIcon.classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    }
                });
            }

            // Mobile theme toggle logic
            const mobileThemeToggle = document.getElementById('mobile-theme-toggle');
            if(mobileThemeToggle) {
                mobileThemeToggle.addEventListener('click', function() {
                    // Re-use desktop logic by triggering a click on it, or run logic directly
                    const desktopBtn = document.getElementById('theme-toggle');
                    if(desktopBtn) {
                        desktopBtn.click();
                    }
                });
            }
        });
    </script>

    <!-- Style inline list items created by wp_nav_menu -->
    <style>
        #mobile-menu ul li a {
            display: block;
            font-size: 1.25rem;
            line-height: 1.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: inherit;
            transition: color 0.3s;
        }
        #mobile-menu ul li a:hover {
            color: #888;
        }
    </style>

    <div id="content" class="site-content flex-grow">
