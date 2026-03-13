<?php
get_header(); ?>

<main id="main-content" class="site-main">
    <?php if ( have_posts() ) : ?>
        <header class="page-header">
            <?php
            the_archive_title( '<h1 class="page-title">', '</h1>' );
            the_archive_description( '<div class="archive-description">', '</div>' );
            ?>
        </header>

        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
                </header>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail( 'thumbnail' ); ?>
                        </a>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php the_excerpt(); ?>
                </div>
            </article>
            <?php
        endwhile;

        the_posts_navigation();

    else :
        echo '<p>' . esc_html__( 'No posts found.', 'bruiser-tech-lhparfum' ) . '</p>';
    endif;
    ?>
</main>

<?php
get_sidebar();
get_footer();
