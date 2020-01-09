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
            'id'    => 'ID',
            'user_login'     => 'User Name',
            'user_email'   => 'User Email'            
        );
        return $columns;
    }

    function column_default( $item, $column_name ) {
        switch( $column_name ) {
            case 'id':
            case 'user_login':
            case 'user_email':

                return $item[ $column_name ];
            default:
                return print_r( $item, true ) ;
        }
    }

    function prepare_items() {

        $example_data = array(
                // array(
                //         'id'        => 1,
                //         'user_login'     => 'vasim',
                //         'user_email'    => 'vasim@abc.com'                        
                // ),
                // array(
                //         'id'        => 2,
                //         'user_login'     => 'Asma',
                //         'user_email'    => 'Asma@abc.com'                        
                // ),
                // array(
                //         'id'        => 3,
                //         'user_login'     => 'Nehal',
                //         'user_email'    => 'nehal@abc.com'                        
                // ),
            );

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $example_data;
    }
    
}