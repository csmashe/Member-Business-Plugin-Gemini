<?php

class P116_Business_Directory_Deactivator {

    public static function deactivate() {
        // Remove capabilities from roles
        require_once P116_BUSINESS_DIRECTORY_PLUGIN_DIR . 'includes/roles.php';
        p116_business_directory_remove_caps();

        // Flush rewrite rules
        flush_rewrite_rules();
    }

}
