<?php

class P116_Business_Directory {

    protected $loader;

    protected $plugin_name;

    protected $version;

    public function __construct() {
        if ( defined( 'P116_BUSINESS_DIRECTORY_VERSION' ) ) {
            $this->version = P116_BUSINESS_DIRECTORY_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'p116-business-directory';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
        $this->define_block_hooks();
    }

    private function load_dependencies() {
        require_once P116_BUSINESS_DIRECTORY_PLUGIN_DIR . 'includes/class-p116-business-directory-loader.php';
        require_once P116_BUSINESS_DIRECTORY_PLUGIN_DIR . 'admin/class-p116-business-directory-admin.php';
        require_once P116_BUSINESS_DIRECTORY_PLUGIN_DIR . 'public/class-p116-business-directory-public.php';
        require_once P116_BUSINESS_DIRECTORY_PLUGIN_DIR . 'includes/template-loader.php';
        require_once P116_BUSINESS_DIRECTORY_PLUGIN_DIR . 'includes/rest-api.php';

        $this->loader = new P116_Business_Directory_Loader();
    }

    private function set_locale() {
        // Later: add internationalization support
    }

    private function define_admin_hooks() {
        $plugin_admin = new P116_Business_Directory_Admin( $this->get_plugin_name(), $this->get_version() );

        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
    }

    private function define_public_hooks() {
        $plugin_public = new P116_Business_Directory_Public( $this->get_plugin_name(), $this->get_version() );

        $this->loader->add_action( 'wp_head', $plugin_public, 'add_json_ld_schema' );
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
        $this->loader->add_action( 'wp_ajax_p116_business_directory_autocomplete', $plugin_public, 'ajax_autocomplete' );
        $this->loader->add_action( 'wp_ajax_nopriv_p116_business_directory_autocomplete', $plugin_public, 'ajax_autocomplete' );
    }

    private function define_block_hooks() {
        add_action( 'init', array( $this, 'register_blocks' ) );
    }

    public function register_blocks() {
        register_block_type( P116_BUSINESS_DIRECTORY_PLUGIN_DIR . 'blocks/directory' );
    }

    public function run() {
        $this->loader->run();
    }

    public function get_plugin_name() {
        return $this->plugin_name;
    }

    public function get_loader() {
        return $this->loader;
    }

    public function get_version() {
        return $this->version;
    }
}
