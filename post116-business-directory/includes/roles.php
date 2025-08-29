<?php

if ( ! defined( 'WPINC' ) ) {
    die;
}

function p116_business_directory_add_caps() {
    $roles = array( 'administrator', 'editor', 'author', 'contributor', 'subscriber' );

    foreach ( $roles as $role_name ) {
        $role = get_role( $role_name );
        if ( ! is_null( $role ) ) {
            $role->add_cap( 'read' );
            $role->add_cap( 'read_p116_business' );
            $role->add_cap( 'read_private_p116_businesses' );
            $role->add_cap( 'edit_p116_business' );
            $role->add_cap( 'edit_p116_businesses' );
            $role->add_cap( 'edit_others_p116_businesses' );
            $role->add_cap( 'edit_published_p116_businesses' );
            $role->add_cap( 'publish_p116_businesses' );
            $role->add_cap( 'delete_p116_business' );
            $role->add_cap( 'delete_others_p116_businesses' );
            $role->add_cap( 'delete_private_p116_businesses' );
            $role->add_cap( 'delete_published_p116_businesses' );
            $role->add_cap( 'manage_p116_business_categories' );
            $role->add_cap( 'edit_p116_business_categories' );
            $role->add_cap( 'delete_p116_business_categories' );
            $role->add_cap( 'assign_p116_business_categories' );
        }
    }
}

function p116_business_directory_remove_caps() {
    $roles = array( 'administrator', 'editor', 'author', 'contributor', 'subscriber' );

    foreach ( $roles as $role_name ) {
        $role = get_role( $role_name );
        if ( ! is_null( $role ) ) {
            $role->remove_cap( 'read' );
            $role->remove_cap( 'read_p116_business' );
            $role->remove_cap( 'read_private_p116_businesses' );
            $role->remove_cap( 'edit_p116_business' );
            $role->remove_cap( 'edit_p116_businesses' );
            $role->remove_cap( 'edit_others_p116_businesses' );
            $role->remove_cap( 'edit_published_p116_businesses' );
            $role->remove_cap( 'publish_p116_businesses' );
            $role->remove_cap( 'delete_p116_business' );
            $role->remove_cap( 'delete_others_p116_businesses' );
            $role->remove_cap( 'delete_private_p116_businesses' );
            $role->remove_cap( 'delete_published_p116_businesses' );
            $role->remove_cap( 'manage_p116_business_categories' );
            $role->remove_cap( 'edit_p116_business_categories' );
            $role->remove_cap( 'delete_p116_business_categories' );
            $role->remove_cap( 'assign_p116_business_categories' );
        }
    }
}
