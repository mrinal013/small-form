<?php
namespace Admin;

use Admin\Small_Form_CPT;
use Admin\Small_Form_MB;
use Admin\Small_Form_Shortcode;
use Admin\Small_Form_Table;
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Small_Form
 * @subpackage Small_Form/admin
 * @author     Mrinal Haque <mrinalhaque99@gmail.com>
 */
class Small_Form_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;


		new Small_Form_CPT();
		new Small_Form_MB();
		new Small_Form_Shortcode();

		if( ! class_exists( 'WP_List_Table' ) ) {
            require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
        }
		new Small_Form_Entry();

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Small_Form_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Small_Form_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/small-form-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Small_Form_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Small_Form_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/small-form-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function small_form_cpt() {
		$labels = array(
			'name'                  => _x( 'Small Forms', 'Post type general name', 'small-form' ),
			'singular_name'         => _x( 'Small Form', 'Post type singular name', 'small-form' ),
			'menu_name'             => _x( 'Small Forms', 'Admin Menu text', 'small-form' ),
			'name_admin_bar'        => _x( 'Small Form', 'Add New on Toolbar', 'small-form' ),
			'add_new'               => __( 'Add New', 'small-form' ),
			'add_new_item'          => __( 'Add New Small Form', 'small-form' ),
			'new_item'              => __( 'New Small Form', 'small-form' ),
			'edit_item'             => __( 'Edit Small Form', 'small-form' ),
			'view_item'             => __( 'View Small Form', 'small-form' ),
			'all_items'             => __( 'All Small Forms', 'small-form' ),
			'search_items'          => __( 'Search Books', 'small-form' ),
			'parent_item_colon'     => __( 'Parent Books:', 'small-form' ),
			'not_found'             => __( 'No Small Forms found.', 'small-form' ),
			'not_found_in_trash'    => __( 'No Small Forms found in Trash.', 'small-form' ),
			'featured_image'        => _x( 'Book Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'small-form' ),
			'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'small-form' ),
			'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'small-form' ),
			'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'small-form' ),
			'archives'              => _x( 'Small Form archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'small-form' ),
			'insert_into_item'      => _x( 'Insert into Small Form', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'small-form' ),
			'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
			'filter_items_list'     => _x( 'Filter books list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'small-form' ),
			'items_list_navigation' => _x( 'Small Forms list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'small-form' ),
			'items_list'            => _x( 'Small Forms list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'small-form' ),
		);
	 
		$args = array(
			'labels'            => $labels,
			'menu_icon'			=> 'dashicons-groups',
			'public'            => true,
			'publicly_queryable'=> true,
			'show_ui'           => true,
			'show_in_menu'      => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'small-form' ),
			'capability_type'   => 'post',
			'has_archive'       => true,
			'hierarchical'      => true,
			'menu_position'     => null,
			'supports'          => array( 'title' ),
		);
	 
		register_post_type( 'small-form', $args );
	}

}
