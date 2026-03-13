<?php
/**
 * The template for displaying all single pages
 *
 * @package BRUISER_TECH_LHPARFUM
 */

get_header(); ?>

<main id="main-content" class="site-main max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 transition-colors duration-300">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'w-full' ); ?>>

            <?php if ( ! is_front_page() ) : ?>
                <header class="entry-header mb-12 text-center">
                    <?php the_title( '<h1 class="entry-title text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white tracking-tight uppercase">', '</h1>' ); ?>
                </header>
            <?php endif; ?>

            <div class="entry-content prose prose-lg md:prose-xl max-w-none text-gray-600 dark:text-gray-300 dark:prose-invert prose-headings:font-bold prose-a:text-black dark:prose-a:text-white prose-a:underline hover:prose-a:text-gray-600">
                <?php
                the_content();

                wp_link_pages( array(
                    'before' => '<div class="page-links mt-8">' . esc_html__( 'Pages:', 'bruiser-tech-lhparfum' ),
                    'after'  => '</div>',
                ) );
                ?>
            </div>
        </article>
        <?php
    endwhile; // End of the loop.
    ?>
</main>

<?php
get_footer();
