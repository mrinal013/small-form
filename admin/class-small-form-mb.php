<?php

namespace Admin;

class Small_Form_MB
{
    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'small_form_meta_boxes'));
        add_action('save_post_small-form', array($this, 'small_form_save_meta_box_data'));
    }

    public function small_form_meta_boxes()
    {
        add_meta_box(
            'small_form_meta_box',
            __('Small Form Fields', 'small-form'),
            array($this, 'small_form_meta_box_html'),
            'small-form',
            'normal',
            'high'
        );
    }

    public function small_form_meta_box_html($post)
    {
        // make sure the form request comes from WordPress
        wp_nonce_field(basename(__FILE__), 'small_form_meta_box_nonce');

        $small_form_meta = get_post_meta($post->ID, '_small_form_meta', true);
        // var_dump($small_form_meta);
        $email_label = isset( $small_form_meta['email-label'] ) ? $small_form_meta['email-label'] : '';
        $email_placeholder = isset( $small_form_meta['email-placeholder'] ) ? $small_form_meta['email-placeholder'] : '';
        $desc_label = isset( $small_form_meta['desc-label'] ) ? $small_form_meta['desc-label'] : '';
        $desc_placeholder = isset( $small_form_meta['desc-placeholder'] ) ? $small_form_meta['desc-placeholder'] : '';
        $submit_text = isset( $small_form_meta['submit-text'] ) ? $small_form_meta['submit-text'] : '';

        echo '<h5>' . __('Email Field', 'small-form') . '</h5>';
        echo '<p>' . __('Label', 'small-form');
        ?>
        <input type="text" name="email-label" class="regular-text postbox" value="<?php echo $email_label; ?>">
        </p>
        <?php
echo '<p>' . __('Placeholder', 'small-form');
        ?>
        <input type="text" name="email-placeholder" value="<?php echo $email_placeholder; ?>">
        </p>
        <?php
echo '<h5>' . __('Description Field', 'small-form') . '</h5>';
        echo '<p>' . __('Label', 'small-form');
        ?>
        <input type="text" name="desc-label" value="<?php echo $desc_label; ?>">
        </p>
        <?php
echo '<p>' . __('Placeholder', 'small-form');
        ?>
        <input type="text" name="desc-placeholder" value="<?php echo $desc_placeholder; ?>">
        </p>
        <?php
        echo '<h5>' . __('Submit button', 'small-form') . '</h5>';
        echo '<p>' . __('Text', 'small-form');
        ?>
        <input type="text" name="submit-text" value="<?php echo $submit_text; ?>">
        <?php
}

    /**
     * Store custom field meta box data
     *
     * @param int $post_id The post ID.
     * @link https://codex.wordpress.org/Plugin_API/Action_Reference/save_post
     */
    public function small_form_save_meta_box_data($post_id)
    {
        // verify meta box nonce
        if (!isset($_POST['small_form_meta_box_nonce']) || !wp_verify_nonce($_POST['small_form_meta_box_nonce'], basename(__FILE__))) {
            return;
        }
        // return if autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        // Check the user's permissions.
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        // store custom fields values
        $small_form_meta = array(
            'email-label' => '',
            'email-placeholder' => '',
            'desc-label' => '',
            'desc-placeholder' => '',
            'submit-text' => '',
        );
        if (isset($_POST['email-label'])) {
            $small_form_meta['email-label'] = esc_html($_POST['email-label']);
        }
        if (isset($_POST['email-placeholder'])) {
            $small_form_meta['email-placeholder'] = esc_html($_POST['email-placeholder']);
        }
        if (isset($_POST['desc-label'])) {
            $small_form_meta['desc-label'] = esc_html($_POST['desc-label']);
        }
        if (isset($_POST['desc-placeholder'])) {
            $small_form_meta['desc-placeholder'] = esc_html($_POST['desc-placeholder']);
        }
        if (isset($_POST['submit-text'])) {
            $small_form_meta['submit-text'] = esc_html($_POST['submit-text']);
        }

        update_post_meta($post_id, '_small_form_meta', $small_form_meta);
    }
}