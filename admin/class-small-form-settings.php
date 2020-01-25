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
class Small_Form_Settings {
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
            __('Settings', 'small-form'),
            __('Settings', 'small-form'),
            'manage_options',
            'small-form-settings',
            array(&$this, 'small_form_settings')
        );
    }

    public function small_form_settings() {
        ?>
        <h1>Settings page</h1>
        <?php
    }
}