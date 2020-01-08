<?php
use Includes\Small_Form_Activator;
use Includes\Small_Form_Deactivator;
use Includes\Small_Form;
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              mrinalbd.com
 * @since             1.0.0
 * @package           Small_Form
 *
 * @wordpress-plugin
 * Plugin Name:       Small Form
 * Plugin URI:        https://github.com/mrinal013/small-form
 * Description:       This is a very small form plugin for developer test in gain solutions.
 * Version:           1.0.0
 * Author:            Mrinal Haque
 * Author URI:        mrinalbd.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       small-form
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SMALL_FORM_VERSION', '1.0.0' );

class Small_Form_Run {
	public function __construct() {
		spl_autoload_register(array($this, 'small_form_autoload'));

		$this->run_small_form();
	}

	/**
	 * Load necessary classes on demand.
	 */
	public function small_form_autoload($class) {
			$lowercase_class = strtolower($class);
			$folder_class_seperator = explode("\\", $lowercase_class);
			$folder_name = str_replace( 'sf_', '', $folder_class_seperator[0]);
			if( !empty($folder_class_seperator[1]) ) {
				$class_name = str_replace('_', '-', $folder_class_seperator[1]);
				$filename = WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'small-form' . DIRECTORY_SEPARATOR . $folder_name . DIRECTORY_SEPARATOR . 'class-' . $class_name . '.php';
				if( file_exists($filename)) {
					require_once($filename);
				}
			}
	}

	

	/**
	 * Begins execution of the plugin.
	 *
	 * Since everything within the plugin is registered via hooks,
	 * then kicking off the plugin from this point in the file does
	 * not affect the page life cycle.
	 *
	 * @since    1.0.0
	 */
	function run_small_form() {

		$plugin = new Small_Form();
		$plugin->run();
	
	}
}
register_activation_hook( __FILE__, 'activate_small_form' );
register_deactivation_hook( __FILE__, 'deactivate_small_form');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-small-form-activator.php
 */
function activate_small_form() {
	Small_Form_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-small-form-deactivator.php
 */
function deactivate_small_form() {
	Small_Form_Deactivator::deactivate();
}
/**
 * class Small_Form_Run instantiate outside for the sake of SOLID priciple.
 */
new Small_Form_Run();
