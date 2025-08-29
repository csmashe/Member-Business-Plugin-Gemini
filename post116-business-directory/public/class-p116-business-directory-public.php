<?php

class P116_Business_Directory_Public {

    private $plugin_name;
    private $version;

    public function __construct( $plugin_name, $version ) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    // Add your public-facing methods here

    public function enqueue_scripts() {
        wp_enqueue_style( $this->plugin_name, P116_BUSINESS_DIRECTORY_PLUGIN_URL . 'public/css/p116-business-directory-public.css', array(), $this->version, 'all' );
        wp_enqueue_script( $this->plugin_name, P116_BUSINESS_DIRECTORY_PLUGIN_URL . 'public/js/p116-business-directory-public.js', array( 'jquery', 'jquery-ui-autocomplete' ), $this->version, false );
        wp_localize_script( $this->plugin_name, 'p116_business_directory', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    }

    public function ajax_autocomplete() {
        $term = strtolower( $_REQUEST['term'] );

        $suggestions = array();

        $args = array(
            'post_type' => 'p116_business',
            'posts_per_page' => 5,
            's' => $term
        );

        $query = new WP_Query( $args );

        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                $suggestions[] = array(
                    'label' => get_the_title(),
                    'value' => get_the_title(),
                );
            }
        }
        wp_reset_postdata();

        echo json_encode( $suggestions );
        wp_die();
    }

    public function add_json_ld_schema() {
        if ( ! is_singular( 'p116_business' ) ) {
            return;
        }

        $post_id = get_the_ID();

        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => get_the_title( $post_id ),
            'url' => get_permalink( $post_id ),
        );

        if ( has_post_thumbnail( $post_id ) ) {
            $schema['image'] = get_the_post_thumbnail_url( $post_id );
        }

        $business_phone = get_post_meta( $post_id, '_business_phone', true );
        if ( ! empty( $business_phone ) ) {
            $schema['telephone'] = $business_phone;
        }

        $business_email = get_post_meta( $post_id, '_business_email', true );
        if ( ! empty( $business_email ) ) {
            $schema['email'] = $business_email;
        }

        $address = array();
        $address1 = get_post_meta( $post_id, '_address1', true );
        if ( ! empty( $address1 ) ) {
            $address['streetAddress'] = $address1;
        }
        $city = get_post_meta( $post_id, '_city', true );
        if ( ! empty( $city ) ) {
            $address['addressLocality'] = $city;
        }
        $state = get_post_meta( $post_id, '_state', true );
        if ( ! empty( $state ) ) {
            $address['addressRegion'] = $state;
        }
        $postal_code = get_post_meta( $post_id, '_postal_code', true );
        if ( ! empty( $postal_code ) ) {
            $address['postalCode'] = $postal_code;
        }

        if ( ! empty( $address ) ) {
            $schema['address'] = $address;
        }

        $website_url = get_post_meta( $post_id, '_website_url', true );
        if ( ! empty( $website_url ) ) {
            $schema['sameAs'] = $website_url;
        }

        echo '<script type="application/ld+json">' . json_encode( $schema, JSON_UNESCAPED_SLASHES ) . '</script>';
    }

}
