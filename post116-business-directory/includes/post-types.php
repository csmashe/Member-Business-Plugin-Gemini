<?php

if ( ! defined( 'WPINC' ) ) {
    die;
}

function p116_business_directory_register_post_type() {
    $labels = array(
        'name'                  => _x( 'Businesses', 'Post type general name', 'p116-business-directory' ),
        'singular_name'         => _x( 'Business', 'Post type singular name', 'p116-business-directory' ),
        'menu_name'             => _x( 'Businesses', 'Admin Menu text', 'p116-business-directory' ),
        'name_admin_bar'        => _x( 'Business', 'Add New on Toolbar', 'p116-business-directory' ),
        'add_new'               => __( 'Add New', 'p116-business-directory' ),
        'add_new_item'          => __( 'Add New Business', 'p116-business-directory' ),
        'new_item'              => __( 'New Business', 'p116-business-directory' ),
        'edit_item'             => __( 'Edit Business', 'p116-business-directory' ),
        'view_item'             => __( 'View Business', 'p116-business-directory' ),
        'all_items'             => __( 'All Businesses', 'p116-business-directory' ),
        'search_items'          => __( 'Search Businesses', 'p116-business-directory' ),
        'parent_item_colon'     => __( 'Parent Businesses:', 'p116-business-directory' ),
        'not_found'             => __( 'No businesses found.', 'p116-business-directory' ),
        'not_found_in_trash'    => __( 'No businesses found in Trash.', 'p116-business-directory' ),
        'featured_image'        => _x( 'Business Logo', 'Overrides the \'Featured Image\' phrase for this post type. Added in 4.3', 'p116-business-directory' ),
        'set_featured_image'    => _x( 'Set logo', 'Overrides the \'Set featured image\' phrase for this post type. Added in 4.3', 'p116-business-directory' ),
        'remove_featured_image' => _x( 'Remove logo', 'Overrides the \'Remove featured image\' phrase for this post type. Added in 4.3', 'p116-business-directory' ),
        'use_featured_image'    => _x( 'Use as logo', 'Overrides the \'Use as featured image\' phrase for this post type. Added in 4.3', 'p116-business-directory' ),
        'archives'              => _x( 'Business archives', 'The post type archive label used in nav menus. Default \'Post Archives\'. Added in 4.4', 'p116-business-directory' ),
        'insert_into_item'      => _x( 'Insert into business', 'Overrides the \'Insert into post\'/\'Insert into page\' phrase (used when inserting media into a post). Added in 4.4', 'p116-business-directory' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this business', 'Overrides the \'Uploaded to this post\'/\'Uploaded to this page\' phrase (used when viewing media attached to a post). Added in 4.4', 'p116-business-directory' ),
        'filter_items_list'     => _x( 'Filter businesses list', 'Screen reader text for the filter links heading on the post type listing screen. Default \'Filter posts list\'/\'Filter pages list\'. Added in 4.4', 'p116-business-directory' ),
        'items_list_navigation' => _x( 'Businesses list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default \'Posts list navigation\'/\'Pages list navigation\'. Added in 4.4', 'p116-business-directory' ),
        'items_list'            => _x( 'Businesses list', 'Screen reader text for the items list heading on the post type listing screen. Default \'Posts list\'/\'Pages list\'. Added in 4.4', 'p116-business-directory' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'directory' ),
        'capability_type'    => 'p116_business',
        'map_meta_cap'       => true,
        'has_archive'        => 'directory',
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'p116_business', $args );
}
add_action( 'init', 'p116_business_directory_register_post_type' );

function p116_business_directory_register_taxonomy() {
    $labels = array(
        'name'              => _x( 'Business Categories', 'taxonomy general name', 'p116-business-directory' ),
        'singular_name'     => _x( 'Business Category', 'taxonomy singular name', 'p116-business-directory' ),
        'search_items'      => __( 'Search Business Categories', 'p116-business-directory' ),
        'all_items'         => __( 'All Business Categories', 'p116-business-directory' ),
        'parent_item'       => __( 'Parent Business Category', 'p116-business-directory' ),
        'parent_item_colon' => __( 'Parent Business Category:', 'p116-business-directory' ),
        'edit_item'         => __( 'Edit Business Category', 'p116-business-directory' ),
        'update_item'       => __( 'Update Business Category', 'p116-business-directory' ),
        'add_new_item'      => __( 'Add New Business Category', 'p116-business-directory' ),
        'new_item_name'     => __( 'New Business Category Name', 'p116-business-directory' ),
        'menu_name'         => __( 'Business Categories', 'p116-business-directory' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'directory/category' ),
        'show_in_rest'      => true,
    );

    register_taxonomy( 'p116_business_category', array( 'p116_business' ), $args );
}
add_action( 'init', 'p116_business_directory_register_taxonomy' );
