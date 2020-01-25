<?php
namespace Admin;
/**
 * The small-form custom post type functionality of the plugin.
 *
 *
 * @package    Small_Form
 * @subpackage Small_Form/admin
 * @author     Mrinal Haque <mrinalhaque99@gmail.com>
 */
class Small_Form_CPT {
    public function __construct() {
		add_action( 'init', array( $this, 'small_form_cpt' ) );
		add_filter('post_updated_messages', array( $this, 'small_form_messages'));
		
		add_filter('post_row_actions', array( $this, 'remove_quick_edit' ) ,10,2);
		add_action('admin_head', array( $this, 'remove_date_drop'));
		add_filter( 'bulk_actions-edit-small-form', array( $this, 'register_small_form_bulk_actions' ) );
	}

	public function remove_quick_edit( $actions, $post ) {
		if ($post->post_type=='small-form') {
			$actions['entries'] = '<a href="#" title="" rel="permalink" class="entries">Entries</a>';
			$actions['deactivate'] = '<a href="#" title="" rel="permalink" class="deactivate">Deactivate</a>';
			$actions['duplicate'] = '<a href="#" title="" rel="permalink" class="duplicate">Duplicate</a>';
			$trash = $actions['trash'];
			unset($actions['inline hide-if-no-js']);
			unset($actions['trash']);
            $actions['trash']=$trash;
		}
		return $actions;
	}
	
    public function small_form_cpt() {
        $labels = array(
			'name'                  => _x( '', 'Post type general name', 'textdomain' ),
			'singular_name'         => _x( 'Small Form', 'Post type singular name', 'textdomain' ),
			'menu_name'             => _x( 'Small Forms', 'Admin Menu text', 'textdomain' ),
			'name_admin_bar'        => _x( 'Small Form', 'Add New on Toolbar', 'textdomain' ),
			'add_new'               => __( 'Add New', 'textdomain' ),
			'add_new_item'          => __( 'Add New Small Form', 'textdomain' ),
			'new_item'              => __( 'New Small Form', 'textdomain' ),
			'edit_item'             => __( '', 'textdomain' ),
			'view_item'             => __( 'View Small Form', 'textdomain' ),
			'all_items'             => __( 'All Small Forms', 'textdomain' ),
			'search_items'          => __( 'Search', 'textdomain' ),
			'parent_item_colon'     => __( 'Parent Small Forms:', 'textdomain' ),
			'not_found'             => __( 'No Small Forms found.', 'textdomain' ),
			'not_found_in_trash'    => __( 'No Small Forms found in Trash.', 'textdomain' ),
			'featured_image'        => _x( 'Book Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
			'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
			'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
			'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
			'archives'              => _x( 'Small Form archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
			'insert_into_item'      => _x( 'Insert into Small Form', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
			'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
			'filter_items_list'     => _x( 'Filter books list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
			'items_list_navigation' => _x( 'Small Forms list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
			'items_list'            => _x( 'Small Forms list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
		);
	 
		$args = array(
			'labels'            => $labels,
			'menu_icon' 		=> 'dashicons-groups',
			'public'            => false,
			'publicly_queryable'=> false,
			'show_ui'           => true,
			'show_in_menu'      => true,
			'show_in_rest' 		=> true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'small-form' ),
			'capability_type'   => 'post',
			'has_archive'       => true,
			'hierarchical'      => false,
			'menu_position'     => null,
			'supports'          => array( 'title' ),
			'capabilities' 		=> array(
				'create_posts' 	=> true
			),
			'map_meta_cap' 		=> true,
		);
	 
		register_post_type( 'small-form', $args );
	}
	
	public function small_form_messages( $messages ) {
		$messages['small-form'] = array(
			1 => __('Small Form Updated.', 'small-form'),
			6 => __('Small Form Published.', 'small-form'),
		);
		return $messages;
	}

	

	public function remove_date_drop() {
		global $pagenow;
		if (( $pagenow == 'edit.php' ) && ( !empty( $_GET['post_type'] )) && ($_GET['post_type'] == 'small-form')) {
			add_filter('months_dropdown_results', '__return_empty_array');
		}
	}

	public function register_small_form_bulk_actions($bulk_actions) {
		$trash = $bulk_actions['trash'];
		unset($bulk_actions['edit']);
		unset($bulk_actions['trash']);
		$bulk_actions['activate'] = __( 'Activate', 'small-form');
		$bulk_actions['deactivate'] = __( 'Deactivate', 'small-form');
		$bulk_actions['duplicate'] = __( 'Duplicate', 'small-form');
		$bulk_actions['trash'] = $trash;
		return $bulk_actions;
	}
}