<?php
namespace Includes;

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Small_Form
 * @subpackage Small_Form/includes
 * @author     Mrinal Haque <mrinalhaque99@gmail.com>
 */
class Small_Form_i18n {

	public function load_plugin_textdomain() {
		load_plugin_textdomain(
			'small-form',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}

}
