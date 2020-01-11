<?php
namespace Includes;
/**
 * Fired during plugin activation
 *
 * @link       mrinalbd.com
 * @since      1.0.0
 *
 * @package    Small_Form
 * @subpackage Small_Form/includes
 */

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

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'small_form';
		// $sql = $wpdb->query( $wpdb->prepare( 
		// 	"
		// 		CREATE TABLE %s (
		// 			id int(11) NOT NULL auto_increment,
		// 			email VARCHAR(50) NOT NULL,
		// 			desc VARCHAR(500),
		// 			time datetime default CURRENT_TIMESTAMP
		// 			PRIMARY KEY (`id`)
		// 		)
		// 	",
		// 	$table_name
		// 	) );

    #Check to see if the table exists already, if not, then create it

    if($wpdb->get_var( "show tables like '$table_name'" ) != $table_name) 
    {

        $sql = "CREATE TABLE `". $table_name . "` ( ";
        $sql .= "  `id`  int(11)  NOT NULL auto_increment, ";
		$sql .= "  `email`  VARCHAR(255)  NOT NULL, ";
		$sql .= "  `desc`  VARCHAR(1024), ";
		$sql .= " `time` datetime DEFAULT '0000-00-00 00:00:00' NOT NULL, ";
        $sql .= "  PRIMARY KEY (`id`) "; 
        $sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; ";
        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
        dbDelta($sql);
    }

	}

}
