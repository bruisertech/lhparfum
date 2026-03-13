<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <!-- Load Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script>
        // Tailwind config for dark mode
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .dark img.dark-mode-logo-invert { filter: invert(1) hue-rotate(180deg); }
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
        Hasta 20% de descuento + envío GRATIS. <a href="#" class="underline">Comprar ahora</a>
    </div>

    <!-- Main Navigation Header -->
    <header id="masthead" class="site-header border-b border-gray-200 dark:border-gray-800 sticky top-0 bg-white dark:bg-gray-900 z-50 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Mobile Menu Button -->
                <div class="flex items-center md:hidden">
                    <button type="button" class="text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white focus:outline-none" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Abrir menú principal</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center justify-center md:justify-start flex-1 md:flex-none">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="block">
                        <?php
                        if ( has_custom_logo() ) {
                            // Ensure the custom logo doesn't blow up the header
                            $custom_logo_id = get_theme_mod( 'custom_logo' );
                            $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                            if ( has_custom_logo() ) {
                                echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '" class="h-12 w-auto object-contain">';
                            }
                        } else {
                            // Default to the generated transparent logos
                            echo '<img src="' . esc_url( get_template_directory_uri() . '/logo-black.png' ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" class="h-12 w-auto object-contain block dark:hidden">';
                            echo '<img src="' . esc_url( get_template_directory_uri() . '/logo-white.png' ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" class="h-12 w-auto object-contain hidden dark:block">';
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

                <!-- Icons (Search, Cart, Dark Mode Toggle) -->
                <div class="flex items-center space-x-4">
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
                        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white relative">
                            <span class="sr-only">Carrito</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <span class="absolute -top-1 -right-2 bg-black text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">
                                <?php echo wp_kses_data( WC()->cart->get_cart_contents_count() ); ?>
                            </span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header><!-- #masthead -->

    <div id="content" class="site-content flex-grow">
