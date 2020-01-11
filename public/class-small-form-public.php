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
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Small_Form
 * @subpackage Small_Form/public
 * @author     Mrinal Haque <mrinalhaque99@gmail.com>
 */
class Small_Form_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		new Small_Form_Shortcode();

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Small_Form_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Small_Form_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/small-form-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Small_Form_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Small_Form_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( 'vue', 'https://cdn.jsdelivr.net/npm/vue@2.6.11', array(), '2.6.11', true );
		wp_enqueue_script( 'axios', 'https://unpkg.com/axios/dist/axios.min.js', array(), '2.6.11', true );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/small-form-public.js', array( 'vue', 'axios' ), $this->version, true );

		wp_localize_script( $this->plugin_name, 'ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

	}

}
