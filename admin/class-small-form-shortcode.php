<?php
namespace Admin;

class Small_Form_Shortcode {
    public function __construct() {
        if( ! empty($_GET['post'] ) ) {
            add_action('add_meta_boxes', array($this, 'small_form_shortcode'));
        }
    }

    public function small_form_shortcode() {
        add_meta_box(
            'small_form_shortcode',
            __('Small Form Shortcode', 'small-form'),
            array($this, 'small_form_shortcode_html'),
            'small-form',
            'side',
            'default'
        );
    }

    public function small_form_shortcode_html() {
        echo '[small-form id="' . $_GET['post'] . '"]';
    }
}