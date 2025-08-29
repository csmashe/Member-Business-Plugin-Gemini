<?php

if ( ! defined( 'WPINC' ) ) {
    die;
}

function p116_business_directory_register_rest_routes() {
    register_rest_route( 'p116/v1', '/search', array(
        'methods' => 'GET',
        'callback' => 'p116_business_directory_rest_search_callback',
        'permission_callback' => '__return_true' // public endpoint
    ) );

    register_rest_route( 'p116/v1', '/autocomplete', array(
        'methods' => 'GET',
        'callback' => 'p116_business_directory_rest_autocomplete_callback',
        'permission_callback' => '__return_true' // public endpoint
    ) );
}
add_action( 'rest_api_init', 'p116_business_directory_register_rest_routes' );

function p116_business_directory_rest_search_callback( $request ) {
    $search_term = sanitize_text_field( $request->get_param( 'term' ) );

    $args = array(
        'post_type' => 'p116_business',
        'posts_per_page' => -1,
        's' => $search_term,
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => '_owners_search',
                'value' => $search_term,
                'compare' => 'LIKE'
            ),
            array(
                'key' => '_city_search',
                'value' => $search_term,
                'compare' => 'LIKE'
            )
        )
    );

    $query = new WP_Query( $args );

    $results = array();

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $results[] = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'thumbnail' => get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ),
            );
        }
    }

    wp_reset_postdata();

    return new WP_REST_Response( $results, 200 );
}

function p116_business_directory_rest_autocomplete_callback( $request ) {
    $search_term = sanitize_text_field( $request->get_param( 'term' ) );

    $results = array();

    // Search business titles
    $args = array(
        'post_type' => 'p116_business',
        'posts_per_page' => 5,
        's' => $search_term
    );
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $results[] = array(
                'label' => get_the_title(),
                'value' => get_the_title(),
                'type' => 'Business'
            );
        }
    }
    wp_reset_postdata();

    // Search owner names
    $args = array(
        'post_type' => 'p116_business',
        'posts_per_page' => 5,
        'meta_query' => array(
            array(
                'key' => '_owners_search',
                'value' => $search_term,
                'compare' => 'LIKE'
            )
        )
    );
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $owners = get_post_meta( get_the_ID(), '_owners', true );
            foreach ( $owners as $owner ) {
                if ( stripos( $owner['owner_name'], $search_term ) !== false ) {
                    $results[] = array(
                        'label' => $owner['owner_name'],
                        'value' => $owner['owner_name'],
                        'type' => 'Owner'
                    );
                }
            }
        }
    }
    wp_reset_postdata();

    // Search categories
    $terms = get_terms( array(
        'taxonomy' => 'p116_business_category',
        'name__like' => $search_term,
        'number' => 5
    ) );
    if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
        foreach ( $terms as $term ) {
            $results[] = array(
                'label' => $term->name,
                'value' => $term->name,
                'type' => 'Category'
            );
        }
    }

    return new WP_REST_Response( array_slice( array_unique( $results, SORT_REGULAR ), 0, 10 ), 200 );
}
