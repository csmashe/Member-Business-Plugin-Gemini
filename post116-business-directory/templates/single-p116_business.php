<?php

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        while ( have_posts() ) : the_post();

            $owners = get_post_meta( get_the_ID(), '_owners', true );
            $business_phone = get_post_meta( get_the_ID(), '_business_phone', true );
            $business_email = get_post_meta( get_the_ID(), '_business_email', true );
            $website_url = get_post_meta( get_the_ID(), '_website_url', true );
            $address1 = get_post_meta( get_the_ID(), '_address1', true );
            $address2 = get_post_meta( get_the_ID(), '_address2', true );
            $city = get_post_meta( get_the_ID(), '_city', true );
            $state = get_post_meta( get_the_ID(), '_state', true );
            $postal_code = get_post_meta( get_the_ID(), '_postal_code', true );
            $veteran_owned = get_post_meta( get_the_ID(), '_veteran_owned', true );
            $sons_owned = get_post_meta( get_the_ID(), '_sons_owned', true );
            $auxiliary_owned = get_post_meta( get_the_ID(), '_auxiliary_owned', true );
            $links = get_post_meta( get_the_ID(), '_links', true );
            $services_offered = get_post_meta( get_the_ID(), '_services_offered', true );

            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">'', '</h1>' ); ?>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail(); ?>
                        </div>
                    <?php endif; ?>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    
                    <?php if ( ! empty( $owners ) ) : ?>
                        <h2><?php _e( 'Owners', 'p116-business-directory' ); ?></h2>
                        <ul>
                            <?php foreach ( $owners as $owner ) : ?>
                                <li>
                                    <strong><?php echo esc_html( $owner['owner_name'] ); ?></strong>
                                    <?php if ( ! empty( $owner['owner_role'] ) ) : ?>
                                        (<?php echo esc_html( $owner['owner_role'] ); ?>)
                                    <?php endif; ?>
                                    <br>
                                    <?php if ( ! empty( $owner['owner_email'] ) ) : ?>
                                        <a href="mailto:<?php echo esc_attr( $owner['owner_email'] ); ?>"><?php echo esc_html( $owner['owner_email'] ); ?></a><br>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $owner['owner_phone'] ) ) : ?>
                                        <?php echo esc_html( $owner['owner_phone'] ); ?><br>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $owner['owner_website'] ) ) : ?>
                                        <a href="<?php echo esc_url( $owner['owner_website'] ); ?>" target="_blank"><?php echo esc_html( $owner['owner_website'] ); ?></a><br>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <h2><?php _e( 'Contact Information', 'p116-business-directory' ); ?></h2>
                    <p>
                        <?php if ( ! empty( $business_phone ) ) : ?>
                            <strong><?php _e( 'Phone:', 'p116-business-directory' ); ?></strong> <?php echo esc_html( $business_phone ); ?><br>
                        <?php endif; ?>
                        <?php if ( ! empty( $business_email ) ) : ?>
                            <strong><?php _e( 'Email:', 'p116-business-directory' ); ?></strong> <a href="mailto:<?php echo esc_attr( $business_email ); ?>"><?php echo esc_html( $business_email ); ?></a><br>
                        <?php endif; ?>
                        <?php if ( ! empty( $website_url ) ) : ?>
                            <strong><?php _e( 'Website:', 'p116-business-directory' ); ?></strong> <a href="<?php echo esc_url( $website_url ); ?>" target="_blank"><?php echo esc_html( $website_url ); ?></a><br>
                        <?php endif; ?>
                    </p>

                    <h2><?php _e( 'Address', 'p116-business-directory' ); ?></h2>
                    <p>
                        <?php if ( ! empty( $address1 ) ) : ?>
                            <?php echo esc_html( $address1 ); ?><br>
                        <?php endif; ?>
                        <?php if ( ! empty( $address2 ) ) : ?>
                            <?php echo esc_html( $address2 ); ?><br>
                        <?php endif; ?>
                        <?php if ( ! empty( $city ) ) : ?>
                            <?php echo esc_html( $city ); ?>, 
                        <?php endif; ?>
                        <?php if ( ! empty( $state ) ) : ?>
                            <?php echo esc_html( $state ); ?> 
                        <?php endif; ?>
                        <?php if ( ! empty( $postal_code ) ) : ?>
                            <?php echo esc_html( $postal_code ); ?>
                        <?php endif; ?>
                    </p>

                    <h2><?php _e( 'Ownership', 'p116-business-directory' ); ?></h2>
                    <p>
                        <?php if ( $veteran_owned ) : ?>
                            <span class="ownership-flag veteran-owned"><?php _e( 'Veteran Owned', 'p116-business-directory' ); ?></span>
                        <?php endif; ?>
                        <?php if ( $sons_owned ) : ?>
                            <span class="ownership-flag sons-owned"><?php _e( 'Sons Owned', 'p116-business-directory' ); ?></span>
                        <?php endif; ?>
                        <?php if ( $auxiliary_owned ) : ?>
                            <span class="ownership-flag auxiliary-owned"><?php _e( 'Auxiliary Owned', 'p116-business-directory' ); ?></span>
                        <?php endif; ?>
                    </p>

                    <?php if ( ! empty( $links ) ) : ?>
                        <h2><?php _e( 'Links', 'p116-business-directory' ); ?></h2>
                        <ul>
                            <?php foreach ( $links as $link ) : ?>
                                <li><a href="<?php echo esc_url( $link['link_url'] ); ?>" target="_blank"><?php echo esc_html( $link['link_label'] ); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <?php if ( ! empty( $services_offered ) ) : ?>
                        <h2><?php _e( 'Services Offered', 'p116-business-directory' ); ?></h2>
                        <p><?php echo esc_html( $services_offered ); ?></p>
                    <?php endif; ?>

                    <?php the_content(); ?>

                </div><!-- .entry-content -->

                <footer class="entry-footer">
                    <?php edit_post_link( __( 'Edit', 'p116-business-directory' ), '<span class="edit-link">'', '</span>' ); ?>
                </footer><!-- .entry-footer -->
            </article><!-- #post-## -->
        <?php endwhile; // End of the loop. ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
