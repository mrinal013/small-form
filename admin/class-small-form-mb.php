<?php
namespace Admin;
/**
 * The small-form field metabox functionality of the plugin.
 *
 * @since       1.0.0
 * @package    Small_Form
 * @subpackage Small_Form/admin
 * @author     Mrinal Haque <mrinalhaque99@gmail.com>
 */
class Small_Form_MB {
    public function __construct() {
        add_action('add_meta_boxes', array($this, 'small_form_meta_boxes'));
        add_action('save_post_small-form', array($this, 'small_form_save_meta_box_data'));
        add_action('rest_api_init', array( $this, 'meta_in_rest') );   
    }

    public function meta_in_rest() {
        register_rest_field( 'small-form', '_small_form_meta', array(
            'get_callback' => function ( $object ) {
                //get the id of the post object array
                $post_id = $object['id'];
               
                //return the post meta
                return get_post_meta( $post_id, '_small_form_meta', true );
               },
            'schema' => null,
            )
        );
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

        // get form post metas
        $small_form_meta = get_post_meta($post->ID, '_small_form_meta', true);
        $email_label = isset( $small_form_meta['email_label'] ) ? $small_form_meta['email_label'] : '';
        $desc_label = isset( $small_form_meta['desc_label'] ) ? $small_form_meta['desc_label'] : '';
        $submit_text = isset( $small_form_meta['submit_text'] ) ? $small_form_meta['submit_text'] : '';
        ?>
        <!-- Display small form meta boxes -->
        <table class="form-table">
            <tr>
                <th>
                    <label for="email-label"><?php echo __('Email Input Label', 'small-form'); ?></label>
                </th>
                <td>
                    <input type="text" name="email-label" id="email-label" class="regular-text postbox" value="<?php echo $email_label; ?>">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="desc-label"><?php echo __('Description Textarea Label', 'small-form'); ?></label>
                </th>
                <td>
                    <input type="text" name="desc-label" id="desc-label" class="regular-text postbox" value="<?php echo $desc_label; ?>">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="submit-text"><?php echo __('Submit Button Text', 'small-form'); ?></label>
                </th>
                <td>
                    <input type="text" name="submit-text" id="submit-text" class="regular-text postbox" value="<?php echo $submit_text; ?>">
                </td>
            </tr>
        </table>
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
            'email_label' => '',
            'desc_label' => '',
            'submit_text' => '',
        );

        // set posted meta value in specific key
        if (isset($_POST['email-label'])) {
            $small_form_meta['email_label'] = esc_html($_POST['email-label']);
        }
        if (isset($_POST['desc-label'])) {
            $small_form_meta['desc_label'] = esc_html($_POST['desc-label']);
        }
        if (isset($_POST['submit-text'])) {
            $small_form_meta['submit_text'] = esc_html($_POST['submit-text']);
        }

        // update small form post metas in serialized 
        update_post_meta($post_id, '_small_form_meta', $small_form_meta);
    }
}