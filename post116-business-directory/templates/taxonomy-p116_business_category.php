<?php

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <header class="page-header">
            <?php
                the_archive_title( '<h1 class="page-title">'', '</h1>' );
                the_archive_description( '<div class="taxonomy-description">'', '</div>' );
            ?>
        </header><!-- .page-header -->

        <?php if ( have_posts() ) : ?>
            <div class="business-directory-archive">
                <?php
                while ( have_posts() ) : the_post();
                    // Include the business card part
                    include( P116_BUSINESS_DIRECTORY_PLUGIN_DIR . 'templates/parts/card-business.php' );
                endwhile;
                ?>
            </div>
            <?php
            the_posts_pagination( array(
                'prev_text' => __( 'Previous', 'p116-business-directory' ),
                'next_text' => __( 'Next', 'p116-business-directory' ),
            ) );
        else :
            get_template_part( 'template-parts/content', 'none' );
        endif; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
