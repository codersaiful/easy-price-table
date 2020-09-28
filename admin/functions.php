<?php
/**
 * Admin Functions
 */

if( !function_exists( 'ept_admin_items_handler' ) ){
    
    /**
     * Hanndle each Items using do_action( 'ept/admin/form/items/item', $item, $itemKey, $input_name, $items, $colKey, $column, $columns, $data, $TABLE_ID, $post );
     */
    function ept_admin_items_handler( $item_name, $item, $input_name, $item_settings, $items ){
        $content = isset( $item['content'] ) && !empty( $item['content'] ) ? $item['content'] : false;
        $content_col_supported = array(
            'footer',
            'banner-image',
            'name'
        );
        $input_name = str_replace('[settings]', '', $input_name);
        if( in_array( $item_name, $content_col_supported ) ){
            ?>
                
            <input type="text" 
                               name="<?php echo esc_attr( $input_name ); ?>[content]" 
                               value="<?php echo esc_attr( $content ); ?>"
                               class="ua_input"
                               >      
            <?php
        }
             
    }
}
add_action( 'ept/admin/form/items/item', 'ept_admin_items_handler', 10, 5 );


if( !function_exists( 'ept_admin_content_handler' ) ){
    
    /**
     * Hanndle each Items using do_action( 'ept/admin/form/items/item', $item, $itemKey, $input_name, $items, $colKey, $column, $columns, $data, $TABLE_ID, $post );
     */
    function ept_admin_content_handler( $item, $input_name, $item_settings, $items, $itemKey, $colKey, $column ){
        
        $content = isset( $item['content'] ) && !empty( $item['content'] ) ? $item['content'] : false;
        $item_content = isset( $item_settings['content'] ) && !empty( $item_settings['content'] ) ? $item_settings['content'] : false;
        $settings = array(
            'textarea_name'     => $input_name . '[content]',
            'textarea_rows'     => 2,
            'teeny'             => true,
            );
        wp_editor(wp_kses_post( $item_content ), 'eps_' . $itemKey . '_' . $colKey, $settings );
    }
}
add_action( 'ept/admin/form/items/item/content', 'ept_admin_content_handler', 10, 7 );

if( !function_exists( 'ept_admin_price_handler' ) ){
    
    /**
     * Hanndle each Items using do_action( 'ept/admin/form/items/item', $item, $itemKey, $input_name, $items, $colKey, $column, $columns, $data, $TABLE_ID, $post );
     */
    function ept_admin_price_handler( $item, $input_name, $item_settings, $items, $itemKey, $colKey, $column ){
        
        $symbol = isset( $item_settings['symbol'] ) ? $item_settings['symbol'] : '';
        $amount = isset( $item_settings['amount'] ) ? $item_settings['amount'] : '';
        $billing_cycle = isset( $item_settings['billing-cycle'] ) ? $item_settings['billing-cycle'] : '';
        ?>
        <div class="item-extra">
            <label>Currencty Symbol</label>
            <input name="<?php echo esc_attr( $input_name );?>[symbol]" class="ua_input" value="<?php echo esc_attr( $symbol ); ?>">
        </div>    
        <div class="item-extra">
            <label>Amount</label>
            <input name="<?php echo esc_attr( $input_name );?>[amount]" class="ua_input" value="<?php echo esc_attr( $amount ); ?>">
        </div>    
        <div class="item-extra">
            <label>Billing Cycle</label>
            <input name="<?php echo esc_attr( $input_name );?>[billing-cycle]" class="ua_input" value="<?php echo esc_attr( $billing_cycle ); ?>">
        </div>    

            
        <?php
    }
}
add_action( 'ept/admin/form/items/item/price', 'ept_admin_price_handler', 10, 7 );


