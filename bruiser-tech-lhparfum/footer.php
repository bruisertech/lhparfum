    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="site-info">
            <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'bruiser-tech-lhparfum' ) ); ?>">
                <?php
                /* translators: %s: CMS name, i.e. WordPress. */
                printf( esc_html__( 'Proudly powered by %s', 'bruiser-tech-lhparfum' ), 'WordPress' );
                ?>
            </a>
            <span class="sep"> | </span>
            <?php
            /* translators: 1: Theme name, 2: Theme author. */
            printf( esc_html__( 'Theme: %1$s by %2$s.', 'bruiser-tech-lhparfum' ), 'BRUISER TECH LHPARFUM', '<a href="http://example.com">Bruiser Tech</a>' );
            ?>
        </div><!-- .site-info -->
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
