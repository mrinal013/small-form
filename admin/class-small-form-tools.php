<?php
namespace Admin;

/**
 * The settings page functionality of the plugin.
 *
 * @since       1.0.0
 * @package    Small_Form
 * @subpackage Small_Form/admin
 * @author     Mrinal Haque <mrinalhaque99@gmail.com>
 */
class Small_Form_Tools {
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
            __('Tools', 'small-form'),
            __('Tools', 'small-form'),
            'manage_options',
            'small-form-tools',
            array(&$this, 'small_form_tools')
        );
    }

    public function small_form_tools() {
        ?>
        <h1>Tools page</h1>
        <?php
    }
}