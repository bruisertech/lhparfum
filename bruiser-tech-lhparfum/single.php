<?php
get_header(); ?>

<main id="main-content" class="site-main">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header>

            <?php if ( has_post_thumbnail() ) : ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail(); ?>
                </div>
            <?php endif; ?>

            <div class="entry-content">
                <?php
                the_content();
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bruiser-tech-lhparfum' ),
                    'after'  => '</div>',
                ) );
                ?>
            </div>
        </article>

        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

        the_post_navigation();
    endwhile; // End of the loop.
    ?>
</main>

<?php
get_sidebar();
get_footer();
