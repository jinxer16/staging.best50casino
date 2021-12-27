<?php
/**
 * @link              https://geotargetingwp.com/
 * @since             1.0.1
 * @package           GeoTarget
 *
 * @wordpress-plugin
 * Plugin Name:       Geo Maxmind
 * Plugin URI:        https://geotargetingwp.com/geotargeting-pro
 * Description:       Download the Maxmind Database and update it every month. Built for GeotargetingWP plugins
 * Version:           1.0.1
 * Author:            Timersys
 * Author URI:        https://geotargetingwp.com/geotargeting-pro
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       geot
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'GEOT_MAXIND_PLUGIN_FILE', __FILE__ );
define( 'GEOT_MAXMIND_DIR', plugin_dir_path( __FILE__ ) );
define( 'GEOT_MAXMIND_URL', plugin_dir_url( __FILE__ ) );

/*
	Geotmaxmind Class
*/
require_once GEOT_MAXMIND_DIR . 'includes/class-geot-maxmind.php';
$geotmax = new GeotMaxmind();

/**
 * The code that runs during plugin activation.
 */
require_once GEOT_MAXMIND_DIR . 'includes/class-geot-maxmind-activator.php';

/**
 * The code that runs during plugin deactivation.
 */
require_once GEOT_MAXMIND_DIR . 'includes/class-geot-maxmind-deactivator.php';

/** This action is documented in includes/class-geotarget-activator.php */
register_activation_hook( __FILE__, array( 'GeotMaxmindActivator', 'activate' ) );

/** This action is documented in includes/class-geotarget-deactivator.php */
register_deactivation_hook( __FILE__, array( 'GeotMaxmindDeactivator', 'deactivate' ) );
