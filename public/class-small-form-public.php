<?php
/**
 * Here, namespace is SF_Public because, Public is reserverd word in PHP.
 * Reference: https://www.php.net/manual/en/reserved.keywords.php
 */
namespace SF_Public;

use SF_Public\Small_Form_Shortcode;

/**
 * The public-facing functionality of the plugin. 
 * For this task only shortcode class register here.
 *
 * @package    Small_Form
 * @subpackage Small_Form/public
 * @author     Mrinal Haque <mrinalhaque99@gmail.com>
 */
class Small_Form_Public {

	/**
	 * Initialize the class.
	 *
	 * @since    1.0.0
	 */
	public function __construct( ) {

		new Small_Form_Shortcode();

	}

	

}
