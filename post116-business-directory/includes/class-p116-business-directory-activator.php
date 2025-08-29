<?php

class P116_Business_Directory_Activator {

    public static function activate() {
        // Register CPT and Taxonomy
        require_once P116_BUSINESS_DIRECTORY_PLUGIN_DIR . 'includes/post-types.php';
        p116_business_directory_register_post_type();
        p116_business_directory_register_taxonomy();

        // Add capabilities to roles
        require_once P116_BUSINESS_DIRECTORY_PLUGIN_DIR . 'includes/roles.php';
        p116_business_directory_add_caps();

        // Flush rewrite rules
        flush_rewrite_rules();
    }

}
