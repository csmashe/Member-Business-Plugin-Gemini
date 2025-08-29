<?php
/**
 * Plugin Name:       Post 116 Business Directory
 * Plugin URI:        https://alpost116nc.org/
 * Description:       A plugin to manage and display a directory of businesses owned by Legion family members.
 * Version:           1.0.0
 * Author:            Your Name
 * Author URI:        https://yourwebsite.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       p116-business-directory
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Define constants
 */
define( 'P116_BUSINESS_DIRECTORY_VERSION', '1.0.0' );
define( 'P116_BUSINESS_DIRECTORY_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'P116_BUSINESS_DIRECTORY_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 */
function activate_p116_business_directory() {
	require_once P116_BUSINESS_DIRECTORY_PLUGIN_DIR . 'includes/class-p116-business-directory-activator.php';
	P116_Business_Directory_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_p116_business_directory() {
	require_once P116_BUSINESS_DIRECTORY_PLUGIN_DIR . 'includes/class-p116-business-directory-deactivator.php';
	P116_Business_Directory_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_p116_business_directory' );
register_deactivation_hook( __FILE__, 'deactivate_p116_business_directory' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require P116_BUSINESS_DIRECTORY_PLUGIN_DIR . 'includes/class-p116-business-directory.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_p116_business_directory() {

	$plugin = new P116_Business_Directory();
	$plugin->run();

}
run_p116_business_directory();
