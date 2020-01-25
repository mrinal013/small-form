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
class Small_Form_Dashboard {
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
            __('Dashboard', 'small-form'),
            __('Dashboard', 'small-form'),
            'manage_options',
            'small-form-dashboard',
            array(&$this, 'small_form_dashboard')
        );
    }

    public function small_form_dashboard() {
        ?>
        <h1>Dashboard page</h1>
        <div id="dash">
  <v-app id="inspire">
    <v-container class="grey lighten-5">
      <v-row no-gutters>
        <v-col
          v-for="n in 3"
          :key="n"
          cols="12"
          sm="4"
        >
        <div id="app">
  <v-app id="inspire">
    <v-card
      class="mx-auto"
      max-width="344"
      outlined
    >
      <v-list-item three-line>
        <v-list-item-content>
          <div class="overline mb-4">OVERLINE</div>
          <v-list-item-title class="headline mb-1">Headline 5</v-list-item-title>
          <v-list-item-subtitle>Greyhound divisely hello coldly fonwderfully</v-list-item-subtitle>
        </v-list-item-content>
  
        <v-list-item-avatar
          tile
          size="80"
          color="grey"
        ></v-list-item-avatar>
      </v-list-item>
  
      <v-card-actions>
        <v-btn text>Button</v-btn>
        <v-btn text>Button</v-btn>
      </v-card-actions>
    </v-card>
  </v-app>
</div>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</div>
        <?php
    }
}