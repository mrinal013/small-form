<?php
namespace SF_Public;

class Small_Form_Shortcode {
    public function __construct() {
        add_shortcode( 'small-form', array( $this, 'small_form_shortcode_function' ) );
        add_action( 'wp_ajax_small_form_submit', array( $this, 'small_form_submit' ) );
    }

    public function small_form_shortcode_function( $atts = array() ) {
        extract(shortcode_atts(array(
            'id' => ''
           ), $atts));
        $value = json_encode( get_post_meta( $atts['id'], '_small_form_meta', true ) );
        return '<div data-smallformid="'. $atts['id'] .'">Loading small form...</div>';
    }

    public function small_form_submit() {
        global $wpdb;
        $small_form_table = $wpdb->prefix . 'small_form';
        $date = date('Y-m-d H:i:s');
        $email = $_GET['email'];
        $desc = $_GET['desc'];        
        $wpdb->insert("wp_small_form", array(
            'email' => $email,
            'desc' => $desc,
            'time' => $date,
        ));

        wp_die();
    }
}