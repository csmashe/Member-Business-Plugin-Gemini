<?php

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array(
    'post_type' => 'p116_business',
    'posts_per_page' => $attributes['perPage'],
    'paged' => $paged,
    'meta_query' => array(
        array(
            'key' => '_show_in_directory',
            'value' => '1',
            'compare' => '='
        )
    )
);

$query = new WP_Query( $args );

?>
<div <?php echo get_block_wrapper_attributes(); ?>>
    <div class="p116-business-directory-search-form">
        <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <label>
                <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
                <input type="search" class="search-field" placeholder="<?php echo esc_attr( $attributes['placeholderText'] ); ?>" value="<?php echo get_search_query() ?>" name="s" />
            </label>
            <input type="hidden" name="post_type" value="p116_business" />
            <input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
        </form>
    </div>

    <?php if ( $query->have_posts() ) : ?>
        <div class="business-directory-archive">
            <?php
            while ( $query->have_posts() ) : $query->the_post();
                include( P116_BUSINESS_DIRECTORY_PLUGIN_DIR . 'templates/parts/card-business.php' );
            endwhile;
            ?>
        </div>
        <?php
        $big = 999999999; // need an unlikely integer
        echo paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $query->max_num_pages
        ) );
        ?>
    <?php else : ?>
        <p><?php _e( 'No businesses found.', 'p116-business-directory' ); ?></p>
    <?php endif; ?>

    <?php wp_reset_postdata(); ?>
</div>
