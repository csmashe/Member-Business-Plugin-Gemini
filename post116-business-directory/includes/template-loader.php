<?php

if ( ! defined( 'WPINC' ) ) {
    die;
}

function p116_business_directory_template_loader( $template ) {
    if ( is_singular( 'p116_business' ) ) {
        $new_template = P116_BUSINESS_DIRECTORY_PLUGIN_DIR . 'templates/single-p116_business.php';
        if ( '' != $new_template ) {
            return $new_template;
        }
    } elseif ( is_tax( 'p116_business_category' ) ) {
        $new_template = P116_BUSINESS_DIRECTORY_PLUGIN_DIR . 'templates/taxonomy-p116_business_category.php';
        if ( '' != $new_template ) {
            return $new_template;
        }
    }
    return $template;
}
add_filter( 'template_include', 'p116_business_directory_template_loader' );
