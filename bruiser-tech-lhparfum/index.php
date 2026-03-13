<?php
get_header(); ?>

<main id="main-content" class="site-main max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 transition-colors duration-300">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'group flex flex-col' ); ?>>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <a href="<?php echo esc_url( get_permalink() ); ?>" class="block w-full mb-6 overflow-hidden bg-gray-50 dark:bg-gray-800 aspect-w-16 aspect-h-9 relative rounded-sm">
                            <?php the_post_thumbnail( 'large', array( 'class' => 'object-cover w-full h-full group-hover:scale-105 transition-transform duration-500 ease-in-out' ) ); ?>
                        </a>
                    <?php endif; ?>

                    <header class="entry-header mb-4">
                        <?php the_title( '<h2 class="entry-title text-2xl font-bold text-gray-900 dark:text-white hover:underline uppercase tracking-tight"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
                    </header>

                    <div class="entry-content text-gray-600 dark:text-gray-400 flex-grow mb-6 line-clamp-3">
                        <?php the_excerpt(); ?>
                    </div>

                    <a href="<?php echo esc_url( get_permalink() ); ?>" class="mt-auto inline-block border-b-2 border-black dark:border-white text-black dark:text-white font-bold uppercase tracking-widest text-xs pb-1 hover:text-gray-500 dark:hover:text-gray-400 transition-colors w-max">
                        Leer más
                    </a>
                </article>
                <?php
            endwhile;
            ?>
    </div>
    <div class="mt-16 text-center text-gray-900 dark:text-white font-medium uppercase tracking-widest text-sm">
        <?php the_posts_navigation(); ?>
    </div>
    <?php
        else :
            echo '<p class="text-gray-500 dark:text-gray-400 text-center py-24 text-lg w-full col-span-full">No se encontraron artículos.</p>';
        endif;
        ?>
</main>

<?php
get_footer();
