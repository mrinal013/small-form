<?php

namespace Admin;

class Small_Form_MB {
    public function __construct() {
        add_action('add_meta_boxes', array( $this, 'small_form_meta_boxes' ));
    }

    public function small_form_meta_boxes() {
        add_meta_box(
            'small_form_meta_box',
            __('Small Form Fields', 'small-form'),
            array( $this, 'small_form_meta_box_html' ),
            'small-form',
            'normal',
            'high'
        );
    }

    public function small_form_meta_box_html($post) {
        $value = get_post_meta($post->ID, '_small_form_metas', true);
        echo '<h5>' . __('Email Field', 'small-form') . '</h5>';
        echo '<p>' . __('Label', 'small-form');
        ?>
        <input type="text" name="email-label" class="regular-text">
        </p>
        <?php
        echo '<p>' . __('Placeholder', 'small-form');
        ?>
        <input type="text" name="email-placeholder">
        </p>
        <?php
        echo '<h5>' . __('Description Field', 'small-form') . '</h5>';
        echo '<p>' . __('Label', 'small-form');
        ?>
        <input type="text" name="desc-label">
        </p>
        <?php
        echo '<p>' . __('Placeholder', 'small-form');
        ?>
        <input type="text" name="desc-placeholder">
        </p>
        <?php
    }
}