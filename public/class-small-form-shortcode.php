<?php
namespace SF_Public;

class Small_Form_Shortcode {
    public function __construct() {
        add_shortcode('small-form', array( $this, 'small_form_shortcode_function'));
    }

    public function small_form_shortcode_function( $atts = array() ) {
        extract(shortcode_atts(array(
            'id' => ''
           ), $atts));
        $value = json_encode( get_post_meta( $atts['id'], '_small_form_meta', true ) );
        return '<div data-smallformid="'. $atts['id'] .'">Loading small form...</div>';
    }
}