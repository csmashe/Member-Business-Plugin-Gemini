<?php

$business_phone = get_post_meta( get_the_ID(), '_business_phone', true );
$city = get_post_meta( get_the_ID(), '_city', true );
$veteran_owned = get_post_meta( get_the_ID(), '_veteran_owned', true );
$sons_owned = get_post_meta( get_the_ID(), '_sons_owned', true );
$auxiliary_owned = get_post_meta( get_the_ID(), '_auxiliary_owned', true );
$services_offered = get_post_meta( get_the_ID(), '_services_offered', true );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'business-card' ); ?>>
    <div class="business-card-inner">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="business-card-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'thumbnail' ); ?>
                </a>
            </div>
        <?php endif; ?>
        <div class="business-card-content">
            <h3 class="business-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <div class="business-card-meta">
                <?php if ( ! empty( $city ) ) : ?>
                    <span class="business-card-city"><?php echo esc_html( $city ); ?></span>
                <?php endif; ?>
                <?php if ( ! empty( $business_phone ) ) : ?>
                    <span class="business-card-phone"><?php echo esc_html( $business_phone ); ?></span>
                <?php endif; ?>
            </div>
            <?php if ( ! empty( $services_offered ) ) : ?>
                <div class="business-card-services">
                    <?php echo esc_html( $services_offered ); ?>
                </div>
            <?php endif; ?>
            <div class="business-card-ownership">
                <?php if ( $veteran_owned ) : ?>
                    <span class="ownership-flag veteran-owned"><?php _e( 'Veteran Owned', 'p116-business-directory' ); ?></span>
                <?php endif; ?>
                <?php if ( $sons_owned ) : ?>
                    <span class="ownership-flag sons-owned"><?php _e( 'Sons Owned', 'p116-business-directory' ); ?></span>
                <?php endif; ?>
                <?php if ( $auxiliary_owned ) : ?>
                    <span class="ownership-flag auxiliary-owned"><?php _e( 'Auxiliary Owned', 'p116-business-directory' ); ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</article>
