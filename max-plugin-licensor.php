<?php

/**
 * The plugin bootstrap file
 *
 *
 *
 * Plugin Name:       Max Plugins Licensor
 * Plugin URI:        https://maxenius.com/
 * Description:       This is a Licensor plugin built by Maxenius Solutions.
 * Version:           1.0
 * Author:            Maxenius Solutions
 * Author URI:        https://maxenius.com/
 * License:           GPL-2.0
 * Text Domain:       location-geo
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 *plugin version.
 */
define( 'MAX_PLUGIN_LICENSOR_VERSION', '1.0' );
/**
 * Plugin activator function
 */
function activate_MAX_PLUGIN_LICENSOR() {
    
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-max-plugin-licensor-activator.php';
	MAX_PLUGIN_LICENSOR_Activator::activate();

}

/**
 *Plugin deactivator function
 */
function deactivate_MAX_PLUGIN_LICENSOR() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-max-plugin-licensor-deactivator.php';
//	MAX_PLUGIN_LICENSOR_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_MAX_PLUGIN_LICENSOR' );
register_deactivation_hook( __FILE__, 'deactivate_MAX_PLUGIN_LICENSOR' );

require plugin_dir_path( __FILE__ ) . 'includes/class-max-plugin-licensor.php';

/**
 * Start plugin's execution.
 *
 */
function run_MAX_PLUGIN_LICENSOR_max() {

    $main = new MAX_PLUGIN_LICENSOR();
    $main->max_run();
}
run_MAX_PLUGIN_LICENSOR_max();
