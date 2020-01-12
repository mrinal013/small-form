<?php
namespace Admin;

class Small_Form_Table extends \WP_List_Table {
    public function __construct()
    {
             parent::__construct( array(
                  'singular'=> 'wp_list_text_link', //Singular label
                  'plural' => 'wp_list_test_links', //plural label, also this well be one of the table css class
                  'ajax'   => false //We won't support Ajax for this table
                  ) );      
            $this->prepare_items();
            $this->display();           

    }

    function get_columns() {
        $columns = array(
            'id'        => __( 'ID','small-form' ),
            'email'     => __( 'Email', 'small-form' ),
            'desc'      => __( 'Description', 'small-form' ),
            'time'      => __( 'Time', 'small-form'),
            'form'      => __( 'Form', 'small-form'),
        );
        return $columns;
    }

    function column_default( $item, $column_name ) {
        switch( $column_name ) {
            case 'id':
            case 'email':
            case 'desc':
            case 'time':
            case 'form':
                return $item[ $column_name ];
            default:
                return print_r( $item, true ) ;
        }
    }

    function prepare_items() {
        global $wpdb;
        $result = $wpdb->get_results ( "
            SELECT * 
            FROM  {$wpdb->prefix}small_form
        " );
        $json  = json_encode($result);
        $array = json_decode($json, true);

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $array;
    }
    
}