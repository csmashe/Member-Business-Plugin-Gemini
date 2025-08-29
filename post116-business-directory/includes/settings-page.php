<?php

if ( ! defined( 'WPINC' ) ) {
    die;
}

class P116_Business_Directory_Settings {

    private $options;

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    public function add_plugin_page() {
        add_options_page(
            'P116 Business Directory Settings',
            'Business Directory',
            'manage_options',
            'p116-business-directory-settings',
            array( $this, 'create_admin_page' )
        );
    }

    public function create_admin_page() {
        $this->options = get_option( 'p116_business_directory_options' );
        ?>
        <div class="wrap">
            <h1>Business Directory Settings</h1>
            <form method="post" action="options.php">
                <?php
                    settings_fields( 'p116_business_directory_option_group' );
                    do_settings_sections( 'p116-business-directory-settings-admin' );
                    submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    public function page_init() {
        register_setting(
            'p116_business_directory_option_group',
            'p116_business_directory_options',
            array( $this, 'sanitize' )
        );

        add_settings_section(
            'setting_section_id',
            'Main Settings',
            array( $this, 'print_section_info' ),
            'p116-business-directory-settings-admin'
        );

        add_settings_field(
            'directory_page_id',
            'Directory Page',
            array( $this, 'directory_page_id_callback' ),
            'p116-business-directory-settings-admin',
            'setting_section_id'
        );

        add_settings_field(
            'show_map_view',
            'Show Map View',
            array( $this, 'show_map_view_callback' ),
            'p116-business-directory-settings-admin',
            'setting_section_id'
        );
    }

    public function sanitize( $input ) {
        $new_input = array();
        if ( isset( $input['directory_page_id'] ) ) {
            $new_input['directory_page_id'] = absint( $input['directory_page_id'] );
        }

        if ( isset( $input['show_map_view'] ) ) {
            $new_input['show_map_view'] = absint( $input['show_map_view'] );
        }

        return $new_input;
    }

    public function print_section_info() {
        print 'Enter your settings below:';
    }

    public function directory_page_id_callback() {
        wp_dropdown_pages(
            array(
                'name' => 'p116_business_directory_options[directory_page_id]',
                'selected' => isset( $this->options['directory_page_id'] ) ? $this->options['directory_page_id'] : '',
                'show_option_none' => 'Select a page'
            )
        );
    }

    public function show_map_view_callback() {
        printf(
            '<input type="checkbox" id="show_map_view" name="p116_business_directory_options[show_map_view]" value="1" %s />',
            isset( $this->options['show_map_view'] ) && $this->options['show_map_view'] === 1 ? 'checked' : ''
        );
    }
}

if ( is_admin() ) {
    $p116_business_directory_settings = new P116_Business_Directory_Settings();
}
