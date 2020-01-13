<?php
namespace Admin;

use Admin\Small_Form_Table;
/**
 * The entry page functionality of the plugin.
 *
 * @since       1.0.0
 * @package    Small_Form
 * @subpackage Small_Form/admin
 * @author     Mrinal Haque <mrinalhaque99@gmail.com>
 */
class Small_Form_Entry {
    public function __construct() {
        add_action( 'admin_menu', array(&$this, 'register_sub_menu') );
    }

    /**
     * Register submenu
     * @return void
     */
    public function register_sub_menu() {
        add_submenu_page( 
            'edit.php?post_type=small-form', 
            __('Entries', 'small-form'),
            __('Entries', 'small-form'),
            'manage_options',
            'small-form-entries-table',
            array(&$this, 'small_form_table_page')
        );
    }

    public function small_form_table_page() {
        echo '<h2>'.__('Small Form Entry', 'small-form').'</h2>';
        if( class_exists('WP_List_Table')) {
            new Small_Form_Table();
        }
    }
}