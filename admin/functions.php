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
            'spacer',
            'divider',
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

if( !function_exists( 'ept_admin_template_display' ) ){
    
    /**
     * Hanndle each Items using do_action( 'ept/admin/form/items/item', $item_name, $item, $input_name, $item_settings, $items, $itemKey, $colKey, $column, $columns, $data, $TABLE_ID, $post );
     */
    function ept_admin_template_display( $item_name, $item, $input_name, $item_settings, $items, $itemKey, $colKey, $column, $columns, $data, $TABLE_ID ){
                
        /**
         * Content of Items
         */
        $atts = false;
        $element_template_loc = apply_filters( 'ept_template_loc', EPT_TEMPLATE_DIR, $TABLE_ID, $columns, $data, $atts, $colKey  );
        $file_name = isset( $item['name'] ) && is_string( $item['name'] ) && !empty( $item['name'] ) ? $item['name'] : 'default';
                        //var_dump($file_name);
        $tag = isset( $item['tag'] ) && is_string( $item['tag'] ) && !empty( $item['tag'] ) ? $item['tag'] : 'div';
        $settings = $setting = isset( $item['settings'] ) && is_array( $item['settings'] ) ? $item['settings'] : false;
        $content = isset( $item['content'] ) ? $item['content'] : '';
        $style = isset( $item['style'] ) && is_array( $item['style'] ) ? $item['style'] : array();
        
        $file = $element_template_loc . $item_name . '.php';
        if( file_exists( $file ) ){
            echo '<div class="ept_each_item_display ept_each_item ept_item_name_' . esc_attr( $file_name ) . '">';
            include $file;
            echo '</div>';
        }
    }
}
add_action( 'ept/admin/form/items/template', 'ept_admin_template_display', 10, 11 );


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

if( !function_exists( 'ept_admin_button_handler' ) ){
    
    /**
     * Hanndle each Items using do_action( 'ept/admin/form/items/item', $item, $itemKey, $input_name, $items, $colKey, $column, $columns, $data, $TABLE_ID, $post );
     */
    function ept_admin_button_handler( $item, $input_name, $item_settings ){
        
        $text = isset( $item_settings['text'] ) ? $item_settings['text'] : '';
        $url = isset( $item_settings['url'] ) ? $item_settings['url'] : '';
        $new_tab = isset( $item_settings['new_tab'] ) ? 'checked' : '';
        ?>
        <div class="item-extra">
            <label>Button Text</label>
            <input type="text" name="<?php echo esc_attr( $input_name );?>[text]" class="ua_input" value="<?php echo esc_attr( $text ); ?>">
        </div>    
        <div class="item-extra">
            <label>URL</label>
            <input type="url" name="<?php echo esc_attr( $input_name );?>[url]" class="ua_input" value="<?php echo esc_attr( $url ); ?>">
        </div>    
        <div class="item-extra">
            <label>New Tab</label>
            <input type="checkbox" name="<?php echo esc_attr( $input_name );?>[new_tab]" <?php echo $new_tab;?>>
        </div>    

            
        <?php
    }
}
add_action( 'ept/admin/form/items/item/button', 'ept_admin_button_handler', 10, 3 );



if( !function_exists( 'ept_admin_add_new_element_button' ) ){
    
    /**
     * Adding new Add Element Button at the bottom of Each Column
     * 
     * @global type $ept_supported_items
     */
    function ept_admin_add_new_element_button( $items, $input_name_prefix ){
        global $ept_supported_items;
        //var_dump($input_name_prefix);
        ?>
            <div class="ultraaddons-button-wrapper">
                <?php
                if( is_array( $ept_supported_items ) ){
                    echo '<select class="ept_elements ua_select">';
                    echo '<option value="">' . esc_html( 'Please select an Element', 'easy_price_table' ) . '</option>';
                    foreach( $ept_supported_items as $itmKey=>$itm ){
                        echo '<option value="' . esc_attr( $itmKey ) . '">' . esc_html( $itm ) . '</option>';
                    }
                    echo '</select>';
                }
                ?>
                <a class="button button-primary ept-add-new-item-button" data-name_prefix="<?php echo esc_attr( $input_name_prefix ); ?>">Add Element</a>
            </div>
        <?php
    }
}
add_action( 'ept/admin/form/items/bottom', 'ept_admin_add_new_element_button', 10, 2 );




if( !function_exists( 'ept_admin_add_column_button' ) ){
    
    /**
     * Adding new Add Column Button at the bottom of Each Column
     * 
     * @global type $ept_supported_items
     */
    function ept_admin_add_column_button( $columns, $data, $TABLE_ID ){
        ?>
            <div class="ultraaddons-button-wrapper ept-add-column-button-wrapper">
                <a class="button button-primary ept-add-column-button" data-col_key="<?php echo esc_attr( 11 ); ?>">Add Column</a>
                <span><?php echo esc_html( 'You able to add new column, by using this button. Recommended: max column should be three.', 'easy_price_table' ); ?></span>
            </div>
                
        <?php
    }
}
add_action( 'ept/admin/form/top', 'ept_admin_add_column_button', 10, 3 );
add_action( 'ept/admin/form/bottom', 'ept_admin_add_column_button', 10, 3 );


