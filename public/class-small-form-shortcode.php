<?php
/**
 * Here, namespace is SF_Public because, Public is reserverd word in PHP.
 * Reference: https://www.php.net/manual/en/reserved.keywords.php
 */
namespace SF_Public;

/**
 * The output of shortcode define in this class.
 *
 * @package    Small_Form
 * @subpackage Small_Form/public
 * @author     Mrinal Haque <mrinalhaque99@gmail.com>
 */
class Small_Form_Shortcode {

    /**
	 * Initialize the class.
	 *
	 * @since    1.0.0
	 */
    public function __construct() {
        add_shortcode( 'small-form', array( $this, 'small_form_shortcode_function' ) );
        add_action( 'wp_ajax_small_form_submit', array( $this, 'small_form_submit' ) );
        add_action( 'wp_ajax_nopriv_small_form_submit', array( $this, 'small_form_submit' ) );
    }

    public function small_form_shortcode_function( $atts = array() ) {
        extract(shortcode_atts(array(
            'id' => ''
           ), $atts));
        $this->small_form_enqueue_scripts();
        $form_name = get_the_title( $atts['id'] );
        return '<div data-smallformid="'. $atts['id'] .'">' . __('Loading ', 'small-form') . $form_name . '...</div>';
    }

    public function small_form_enqueue_scripts() {

        wp_enqueue_style( 'small-form', plugin_dir_url( __FILE__ ) . 'css/small-form-public.min.css', array(), '1.0.0', 'all' );
        wp_enqueue_style( 'libre-franklin', 'https://fonts.googleapis.com/css?family=Libre+Franklin&display=swap', array(), '1.0.0', 'all' );

        wp_enqueue_script( 'vue', 'https://cdn.jsdelivr.net/npm/vue@2.6.11', array(), '2.6.11', true );
        wp_enqueue_script( 'axios', 'https://unpkg.com/axios/dist/axios.min.js', array(), '2.6.11', true );
        wp_enqueue_script( 'small-form', plugin_dir_url( __FILE__ ) . 'js/small-form-public.js', array( 'vue', 'axios' ), '1.0.0', true );

		wp_localize_script( 'small-form', 'ajax_object',
            array( 
                'ajax_url'  => admin_url( 'admin-ajax.php' ),
                'nonce'     => wp_create_nonce( 'small_form_nonce' )
        ) );
    }

    public function small_form_submit() {

        $nonce = $_GET['nonce'];
        if ( ! wp_verify_nonce( $nonce, 'small_form_nonce' ) ) {
            wp_die('No hanki-panki');
        }

        global $wpdb;
        $small_form_table = $wpdb->prefix . 'small_form';
        $email = $_GET['email'];
        $desc = $_GET['desc'];        
        $date = date('Y-m-d H:i:s');
        $form_title = get_the_title( $_GET['formid'] );
        $wpdb->insert("wp_small_form", array(
            'email' => $email,
            'desc' => $desc,
            'time' => $date,
            'form' => $form_title,
        ));

        wp_die();
    }
}