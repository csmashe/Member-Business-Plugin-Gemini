<?php

class P116_Business_Directory_Admin {

    private $plugin_name;
    private $version;

    public function __construct( $plugin_name, $version ) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;

        require_once P116_BUSINESS_DIRECTORY_PLUGIN_DIR . 'includes/meta-boxes.php';
        require_once P116_BUSINESS_DIRECTORY_PLUGIN_DIR . 'includes/settings-page.php';
    }

    // Add your admin-specific methods here

    public function enqueue_scripts() {
        wp_enqueue_script( $this->plugin_name, P116_BUSINESS_DIRECTORY_PLUGIN_URL . 'admin/js/p116-business-directory-admin.js', array( 'jquery' ), $this->version, false );
    }

}
