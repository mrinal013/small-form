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
class Small_Form_Help {
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
            __('Help', 'small-form'),
            __('Help', 'small-form'),
            'manage_options',
            'small-form-help',
            array(&$this, 'small_form_help')
        );
    }

    public function small_form_help() {
        ?>
        <h1>Help page</h1>
        <?php
    }
}