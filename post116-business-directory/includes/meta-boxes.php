<?php

if ( ! defined( 'WPINC' ) ) {
    die;
}

function p116_business_directory_add_meta_boxes() {
    add_meta_box(
        'p116_business_details',
        __( 'Business Details', 'p116-business-directory' ),
        'p116_business_directory_render_meta_box',
        'p116_business',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'p116_business_directory_add_meta_boxes' );

function p116_business_directory_render_meta_box( $post ) {
    wp_nonce_field( 'p116_business_directory_save_meta_box_data', 'p116_business_directory_meta_box_nonce' );

    // Owners
    $owners = get_post_meta( $post->ID, '_owners', true );

    // Contact
    $business_phone = get_post_meta( $post->ID, '_business_phone', true );
    $business_email = get_post_meta( $post->ID, '_business_email', true );
    $website_url = get_post_meta( $post->ID, '_website_url', true );

    // Address
    $address1 = get_post_meta( $post->ID, '_address1', true );
    $address2 = get_post_meta( $post->ID, '_address2', true );
    $city = get_post_meta( $post->ID, '_city', true );
    $state = get_post_meta( $post->ID, '_state', true );
    $postal_code = get_post_meta( $post->ID, '_postal_code', true );

    // Ownership flags
    $veteran_owned = get_post_meta( $post->ID, '_veteran_owned', true );
    $sons_owned = get_post_meta( $post->ID, '_sons_owned', true );
    $auxiliary_owned = get_post_meta( $post->ID, '_auxiliary_owned', true );

    // Links
    $links = get_post_meta( $post->ID, '_links', true );

    // Services
    $services_offered = get_post_meta( $post->ID, '_services_offered', true );

    // Show in directory
    $show_in_directory = get_post_meta( $post->ID, '_show_in_directory', true );
    if ( '' === $show_in_directory ) {
        $show_in_directory = true;
    }

    ?>
    <div id="p116-business-metabox-wrapper">
        <h2><?php _e( 'Owners', 'p116-business-directory' ); ?></h2>
        <div id="owners-repeater">
            <div class="repeater-template">
                <div class="repeater-item">
                    <input type="text" name="owners[__i__][owner_name]" placeholder="<?php _e( 'Name', 'p116-business-directory' ); ?>">
                    <input type="text" name="owners[__i__][owner_role]" placeholder="<?php _e( 'Role', 'p116-business-directory' ); ?>">
                    <input type="email" name="owners[__i__][owner_email]" placeholder="<?php _e( 'Email', 'p116-business-directory' ); ?>">
                    <input type="tel" name="owners[__i__][owner_phone]" placeholder="<?php _e( 'Phone', 'p116-business-directory' ); ?>">
                    <input type="url" name="owners[__i__][owner_website]" placeholder="<?php _e( 'Website', 'p116-business-directory' ); ?>">
                    <button class="button remove-owner"><?php _e( 'Remove', 'p116-business-directory' ); ?></button>
                </div>
            </div>
            <?php if ( is_array( $owners ) ) : ?>
                <?php foreach ( $owners as $i => $owner ) : ?>
                    <div class="repeater-item">
                        <input type="text" name="owners[<?php echo $i; ?>][owner_name]" value="<?php echo esc_attr( $owner['owner_name'] ); ?>" placeholder="<?php _e( 'Name', 'p116-business-directory' ); ?>">
                        <input type="text" name="owners[<?php echo $i; ?>][owner_role]" value="<?php echo esc_attr( $owner['owner_role'] ); ?>" placeholder="<?php _e( 'Role', 'p116-business-directory' ); ?>">
                        <input type="email" name="owners[<?php echo $i; ?>][owner_email]" value="<?php echo esc_attr( $owner['owner_email'] ); ?>" placeholder="<?php _e( 'Email', 'p116-business-directory' ); ?>">
                        <input type="tel" name="owners[<?php echo $i; ?>][owner_phone]" value="<?php echo esc_attr( $owner['owner_phone'] ); ?>" placeholder="<?php _e( 'Phone', 'p116-business-directory' ); ?>">
                        <input type="url" name="owners[<?php echo $i; ?>][owner_website]" value="<?php echo esc_attr( $owner['owner_website'] ); ?>" placeholder="<?php _e( 'Website', 'p116-business-directory' ); ?>">
                        <button class="button remove-owner"><?php _e( 'Remove', 'p116-business-directory' ); ?></button>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <button class="button" id="add-owner"><?php _e( 'Add Owner', 'p116-business-directory' ); ?></button>

        <h2><?php _e( 'Contact Information', 'p116-business-directory' ); ?></h2>
        <table class="form-table">
            <tbody>
                <!-- Contact -->
                <tr>
                    <th><label for="business_phone"><?php _e( 'Business Phone', 'p116-business-directory' ); ?></label></th>
                    <td><input type="text" id="business_phone" name="business_phone" value="<?php echo esc_attr( $business_phone ); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="business_email"><?php _e( 'Business Email', 'p116-business-directory' ); ?></label></th>
                    <td><input type="email" id="business_email" name="business_email" value="<?php echo esc_attr( $business_email ); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="website_url"><?php _e( 'Website URL', 'p116-business-directory' ); ?></label></th>
                    <td><input type="url" id="website_url" name="website_url" value="<?php echo esc_attr( $website_url ); ?>" class="regular-text"></td>
                </tr>
            </tbody>
        </table>

        <h2><?php _e( 'Address', 'p116-business-directory' ); ?></h2>
        <table class="form-table">
            <tbody>
                <!-- Address -->
                <tr>
                    <th><label for="address1"><?php _e( 'Address 1', 'p116-business-directory' ); ?></label></th>
                    <td><input type="text" id="address1" name="address1" value="<?php echo esc_attr( $address1 ); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="address2"><?php _e( 'Address 2', 'p116-business-directory' ); ?></label></th>
                    <td><input type="text" id="address2" name="address2" value="<?php echo esc_attr( $address2 ); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="city"><?php _e( 'City', 'p116-business-directory' ); ?></label></th>
                    <td><input type="text" id="city" name="city" value="<?php echo esc_attr( $city ); ?>" class="regular-text" required></td>
                </tr>
                <tr>
                    <th><label for="state"><?php _e( 'State', 'p116-business-directory' ); ?></label></th>
                    <td><input type="text" id="state" name="state" value="<?php echo esc_attr( $state ); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="postal_code"><?php _e( 'Postal Code', 'p116-business-directory' ); ?></label></th>
                    <td><input type="text" id="postal_code" name="postal_code" value="<?php echo esc_attr( $postal_code ); ?>" class="regular-text"></td>
                </tr>
            </tbody>
        </table>

        <h2><?php _e( 'Ownership', 'p116-business-directory' ); ?></h2>
        <table class="form-table">
            <tbody>
                <!-- Ownership Flags -->
                <tr>
                    <th><?php _e( 'Ownership', 'p116-business-directory' ); ?></th>
                    <td>
                        <label><input type="checkbox" name="veteran_owned" value="1" <?php checked( $veteran_owned, 1 ); ?>> <?php _e( 'Veteran Owned', 'p116-business-directory' ); ?></label><br>
                        <label><input type="checkbox" name="sons_owned" value="1" <?php checked( $sons_owned, 1 ); ?>> <?php _e( 'Sons Owned', 'p116-business-directory' ); ?></label><br>
                        <label><input type="checkbox" name="auxiliary_owned" value="1" <?php checked( $auxiliary_owned, 1 ); ?>> <?php _e( 'Auxiliary Owned', 'p116-business-directory' ); ?></label>
                    </td>
                </tr>
            </tbody>
        </table>

        <h2><?php _e( 'Links', 'p116-business-directory' ); ?></h2>
        <div id="links-repeater">
            <div class="repeater-template">
                <div class="repeater-item">
                    <input type="text" name="links[__i__][link_label]" placeholder="<?php _e( 'Label', 'p116-business-directory' ); ?>">
                    <input type="url" name="links[__i__][link_url]" placeholder="<?php _e( 'URL', 'p116-business-directory' ); ?>">
                    <button class="button remove-link"><?php _e( 'Remove', 'p116-business-directory' ); ?></button>
                </div>
            </div>
            <?php if ( is_array( $links ) ) : ?>
                <?php foreach ( $links as $i => $link ) : ?>
                    <div class="repeater-item">
                        <input type="text" name="links[<?php echo $i; ?>][link_label]" value="<?php echo esc_attr( $link['link_label'] ); ?>" placeholder="<?php _e( 'Label', 'p116-business-directory' ); ?>">
                        <input type="url" name="links[<?php echo $i; ?>][link_url]" value="<?php echo esc_attr( $link['link_url'] ); ?>" placeholder="<?php _e( 'URL', 'p116-business-directory' ); ?>">
                        <button class="button remove-link"><?php _e( 'Remove', 'p116-business-directory' ); ?></button>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <button class="button" id="add-link"><?php _e( 'Add Link', 'p116-business-directory' ); ?></button>

        <h2><?php _e( 'Other Information', 'p116-business-directory' ); ?></h2>
        <table class="form-table">
            <tbody>
                <!-- Services Offered -->
                <tr>
                    <th><label for="services_offered"><?php _e( 'Services Offered', 'p116-business-directory' ); ?></label></th>
                    <td><textarea id="services_offered" name="services_offered" rows="4" class="large-text"><?php echo esc_textarea( $services_offered ); ?></textarea></td>
                </tr>

                <!-- Show in Directory -->
                <tr>
                    <th><?php _e( 'Show in Directory', 'p116-business-directory' ); ?></th>
                    <td><label><input type="checkbox" name="show_in_directory" value="1" <?php checked( $show_in_directory, 1 ); ?>> <?php _e( 'Show this business in the directory', 'p116-business-directory' ); ?></label></td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}

function p116_business_directory_save_meta_box_data( $post_id ) {
    if ( ! isset( $_POST['p116_business_directory_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['p116_business_directory_meta_box_nonce'], 'p116_business_directory_save_meta_box_data' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Save Owners
    $owners = array();
    if ( isset( $_POST['owners'] ) && is_array( $_POST['owners'] ) ) {
        foreach ( $_POST['owners'] as $owner ) {
            $owners[] = array(
                'owner_name'    => sanitize_text_field( $owner['owner_name'] ),
                'owner_role'    => sanitize_text_field( $owner['owner_role'] ),
                'owner_email'   => sanitize_email( $owner['owner_email'] ),
                'owner_phone'   => sanitize_text_field( $owner['owner_phone'] ),
                'owner_website' => esc_url_raw( $owner['owner_website'] ),
            );
        }
    }
    update_post_meta( $post_id, '_owners', $owners );

    // Save Contact Info
    update_post_meta( $post_id, '_business_phone', sanitize_text_field( $_POST['business_phone'] ?? '' ) );
    update_post_meta( $post_id, '_business_email', sanitize_email( $_POST['business_email'] ?? '' ) );
    update_post_meta( $post_id, '_website_url', esc_url_raw( $_POST['website_url'] ?? '' ) );

    // Save Address
    update_post_meta( $post_id, '_address1', sanitize_text_field( $_POST['address1'] ?? '' ) );
    update_post_meta( $post_id, '_address2', sanitize_text_field( $_POST['address2'] ?? '' ) );
    $city = sanitize_text_field( $_POST['city'] ?? '' );
    update_post_meta( $post_id, '_city', $city );
    update_post_meta( $post_id, '_city_search', strtolower( $city ) );
    update_post_meta( $post_id, '_state', sanitize_text_field( $_POST['state'] ?? '' ) );
    update_post_meta( $post_id, '_postal_code', sanitize_text_field( $_POST['postal_code'] ?? '' ) );

    // Save Ownership Flags
    update_post_meta( $post_id, '_veteran_owned', isset( $_POST['veteran_owned'] ) ? 1 : 0 );
    update_post_meta( $post_id, '_sons_owned', isset( $_POST['sons_owned'] ) ? 1 : 0 );
    update_post_meta( $post_id, '_auxiliary_owned', isset( $_POST['auxiliary_owned'] ) ? 1 : 0 );

    // Save Links
    $links = array();
    if ( isset( $_POST['links'] ) && is_array( $_POST['links'] ) ) {
        foreach ( $_POST['links'] as $link ) {
            $links[] = array(
                'link_label' => sanitize_text_field( $link['link_label'] ),
                'link_url'   => esc_url_raw( $link['link_url'] ),
            );
        }
    }
    update_post_meta( $post_id, '_links', $links );

    // Save Services Offered
    update_post_meta( $post_id, '_services_offered', sanitize_textarea_field( $_POST['services_offered'] ?? '' ) );

    // Save Show in Directory
    update_post_meta( $post_id, '_show_in_directory', isset( $_POST['show_in_directory'] ) ? 1 : 0 );

    // Save owners_search field
    $owner_names = array_map( function( $owner ) {
        return $owner['owner_name'];
    }, $owners );
    update_post_meta( $post_id, '_owners_search', strtolower( implode( ' ', $owner_names ) ) );
}
add_action( 'save_post_p116_business', 'p116_business_directory_save_meta_box_data' );
