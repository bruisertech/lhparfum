<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <!-- Load Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>

    <?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-white text-gray-900 antialiased' ); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site flex flex-col min-h-screen">
    <a class="skip-link screen-reader-text sr-only" href="#main-content"><?php esc_html_e( 'Skip to content', 'bruiser-tech-lhparfum' ); ?></a>

    <!-- Top Banner (Optional, replicating Dossier's style) -->
    <div class="bg-gray-100 text-center py-2 text-xs font-medium tracking-wide">
        Up to 20% OFF + FREE shipping. <a href="#" class="underline">Shop now</a>
    </div>

    <!-- Main Navigation Header -->
    <header id="masthead" class="site-header border-b border-gray-200 sticky top-0 bg-white z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Mobile Menu Button -->
                <div class="flex items-center md:hidden">
                    <button type="button" class="text-gray-500 hover:text-gray-900 focus:outline-none" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center justify-center md:justify-start flex-1 md:flex-none">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="font-bold text-2xl tracking-widest uppercase block">
                        <?php
                        // If custom logo is set via customizer, use it. Otherwise default to user provided imgur logo
                        if ( has_custom_logo() ) {
                            the_custom_logo();
                        } else {
                            echo '<img src="https://i.imgur.com/H1CtN0c.jpeg" alt="LHPARFUM Logo" class="h-10 w-auto">';
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
                        'menu_class'     => 'flex space-x-8 text-sm font-medium uppercase tracking-wider text-gray-700',
                        'fallback_cb'    => false,
                    ) );
                    ?>
                    <!-- Fallback if menu not set -->
                    <?php if ( ! has_nav_menu( 'menu-1' ) ) : ?>
                        <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="text-sm font-medium uppercase tracking-wider text-gray-700 hover:text-black">Shop All</a>
                        <a href="#" class="text-sm font-medium uppercase tracking-wider text-gray-700 hover:text-black">Women</a>
                        <a href="#" class="text-sm font-medium uppercase tracking-wider text-gray-700 hover:text-black">Men</a>
                        <a href="#" class="text-sm font-medium uppercase tracking-wider text-gray-700 hover:text-black">Unisex</a>
                    <?php endif; ?>
                </nav>

                <!-- Icons (Search, Cart) -->
                <div class="flex items-center space-x-4">
                    <button class="text-gray-500 hover:text-gray-900">
                        <span class="sr-only">Search</span>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                    <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="text-gray-500 hover:text-gray-900 relative">
                            <span class="sr-only">Cart</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <span class="absolute -top-1 -right-2 bg-black text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">
                                <?php echo WC()->cart->get_cart_contents_count(); ?>
                            </span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header><!-- #masthead -->

    <div id="content" class="site-content flex-grow">
