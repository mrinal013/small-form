<?php
/**
 * Here, namespace is SF_Public because, Public is reserverd word in PHP.
 * Reference: https://www.php.net/manual/en/reserved.keywords.php
 */
namespace SF_Public;

use SF_Public\Small_Form_Shortcode;

/**
 * The public-facing functionality of the plugin.
 *
 * @link       mrinalbd.com
 * @since      1.0.0
 *
 * @package    Small_Form
 * @subpackage Small_Form/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Small_Form
 * @subpackage Small_Form/public
 * @author     Mrinal Haque <mrinalhaque99@gmail.com>
 */
class Small_Form_Public {

	/**
	 * Initialize the class and set its properties.
	 * For now small-form has only one class instant.
	 *
	 * @since    1.0.0
	 */
	public function __construct( ) {

		new Small_Form_Shortcode();

	}

	

}
