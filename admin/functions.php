<?php
/**
 * Admin Functions
 */

if( !function_exists( 'ept_admin_items_handler' ) ){
    
    /**
     * Hanndle each Items using do_action( 'ept/admin/form/items/item', $item, $itemKey, $input_name, $items, $colKey, $column, $columns, $data, $TABLE_ID, $post );
     */
    function ept_admin_items_handler( $item, $itemKey, $input_name, $items, $colKey, $column ){
        
             
    }
}
add_action( 'ept/admin/form/items/item', 'ept_admin_items_handler', 10, 6 );


if( !function_exists( 'ept_admin_content_handler' ) ){
    
    /**
     * Hanndle each Items using do_action( 'ept/admin/form/items/item', $item, $itemKey, $input_name, $items, $colKey, $column, $columns, $data, $TABLE_ID, $post );
     */
    function ept_admin_content_handler( $item, $itemKey, $input_name, $items, $colKey, $column ){
        
        $content = isset( $item['content'] ) && !empty( $item['content'] ) ? $item['content'] : false;
        
        
        $settings = array(
            'textarea_name'     => $input_name . '[content]',
            'textarea_rows'     => 3,
            'teeny'             => true,
            );
        wp_editor(wp_kses_post( $content ), 'eps_' . $itemKey . '_' . $colKey, $settings );
    }
}
add_action( 'ept/admin/form/items/item/content', 'ept_admin_content_handler', 10, 6 );


