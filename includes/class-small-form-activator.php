<?php
namespace Includes;
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Small_Form
 * @subpackage Small_Form/includes
 * @author     Mrinal Haque <mrinalhaque99@gmail.com>
 */
class Small_Form_Activator {

	public static function activate() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'small_form';
    	// Check to see if the table exists already, if not, then create it
		$table_exist = ( $wpdb->get_var( "show tables like '$table_name'" ) != $table_name ) ? true : false;
    	if( $table_exist ) {
			$sql = "CREATE TABLE `". $table_name . "` ( ";
			$sql .= "  `id`  int(11)  NOT NULL auto_increment, ";
			$sql .= "  `email`  VARCHAR(255)  NOT NULL, ";
			$sql .= "  `desc`  VARCHAR(1024), ";
			$sql .= " `time` datetime DEFAULT '0000-00-00 00:00:00' NOT NULL, ";
			$sql .= " `form` VARCHAR(55), ";
			$sql .= "  PRIMARY KEY (`id`) "; 
			$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; ";
			require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
			dbDelta($sql);
    	}
	}
	
}
