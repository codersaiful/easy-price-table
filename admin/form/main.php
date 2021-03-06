<?php

$columns = isset( $data['columns'] ) && is_array( $data['columns'] ) && count( $data['columns'] ) > 0 ? $data['columns'] : false;
$columns = apply_filters( 'ept/admin/columns', $columns, $data, $TABLE_ID, $post );

do_action( 'ept/admin/form/top', $columns, $data, $TABLE_ID, $post );
?>
<div class="ept-column-wrapper">
<?php  

if( $columns  ){
    $serial = $maxNumber = 1;
    foreach( $columns as $colKey => $column ){
        
        $column = apply_filters( 'ept/admin/columns/column', $column, $columns, $data, $TABLE_ID, $post );
        $head_label = '';
        $prefix = 'ept-content';
        $status = isset( $column['status'] ) ? $column['status'] : 'off';
        $checkbox           = $status == 'on' ? 'checked' : '';

        $recommend = isset( $column['recommend'] ) ? $column['recommend'] : 'off';
        $recommend_checkbox           = $recommend == 'on' ? 'checked' : '';
        $attr = isset( $column['attr'] ) && !empty( $column['attr'] ) && is_array( $column['attr'] ) ? $column['attr'] :  false;
        $style = isset( $column['style'] ) && !empty( $column['style'] ) && is_array( $column['style'] ) ? $column['style'] :  false;
        $items = isset( $column['items'] ) && !empty( $column['items'] ) && is_array( $column['items'] ) ? $column['items'] :  false;
        $items = apply_filters( 'ept/admin/columns/column/items', $items, $colKey, $column, $columns, $data, $TABLE_ID, $post );
        
        $input_name_prefix = "data[columns][{$colKey}]";
        $ept_datas = get_post_meta( $POST_ID, EPT_META_NAME, true );;

        if($colKey >= $maxNumber ){
            $maxNumber = $colKey;
        }
?>
    <div 
        class="ept-each-column ept-each-column-<?php echo esc_attr( $colKey ); ?> recommend_<?php echo esc_attr( $recommend ); ?> status_<?php echo esc_attr( $status ); ?>" 
        data-col_key="<?php echo esc_attr( $colKey ); ?>" 
        data-status="<?php echo esc_attr( $status ); ?>" 
        data-recommend="<?php echo esc_attr( $recommend ); ?>" 
        data-max_col_number="<?php echo esc_attr( $maxNumber ); ?>"
        >
        <div class="column-control-icons">
            <i class="ept-each-column-handle ept-handle control-icons">Move</i>
            <i title="<?php echo esc_html( 'Delete Column', 'easy_price_table' ); ?>" class="control-icons control-icons-delete">X</i>
        </div>
        
        <div class="column-head handle">
            <h3 class="this-col-head-number">

                <?php 
                echo wp_kses_post( $head_label );
                echo sprintf( esc_html( "%sColumn %s%s%s%s", 'easy_price_table' ), '<span>','<i class="col-number">',$serial,'</i>','<span>');
                //echo wp_kses_post( $head_label ); 
                ?>
            </h3> 
            
            <div class="ept-status-controller">
                
                <input 
                    type="hidden" 
                    name="<?php echo esc_attr( $input_name_prefix ); ?>[recommend]" 
                    value="<?php echo esc_attr( $recommend ); ?>" 
                    data-type="recommend" 
                    class="<?php echo esc_attr( $prefix . '-' . $colKey ); ?>-recommend ept-switch ept-recommend-switch"
                    >

                <label class="switch recommended-item">
                    <input class="ept-placeholder-onoff" data-target="<?php echo esc_attr( $prefix . '-' . $colKey ); ?>-recommend" type="checkbox" <?php echo esc_attr( $recommend_checkbox ); ?>>
                    <div class="slider round"><!--ADDED HTML -->
                        <span class="on"><?php echo esc_html( 'Recommended', 'easy_price_table' ); ?></span><span class="off"><?php echo esc_html( 'As usual', 'easy_price_table' ); ?></span><!--END-->
                    </div>
                </label>


                <input 
                    type="hidden" 
                    name="<?php echo esc_attr( $input_name_prefix ); ?>[status]" 
                    value="<?php echo esc_attr( $status ); ?>" 
                    data-type="status"
                    class="<?php echo esc_attr( $prefix . '-' . $colKey ); ?>-status ept-switch  ept-status-switch"
                    >

                <label class="switch">
                    <input class="ept-placeholder-onoff" data-target="<?php echo esc_attr( $prefix . '-' . $colKey ); ?>-status" type="checkbox" <?php echo esc_attr( $checkbox ); ?>>
                    <div class="slider round"><!--ADDED HTML -->
                        <span class="on"><?php echo esc_html( 'Enable', 'easy_price_table' ); ?></span><span class="off"><?php echo esc_html( 'Disable', 'easy_price_table' ); ?></span><!--END-->
                    </div>
                </label>
            </div>
        </div>
        
        
        <div class="ept-item-wrapper ultraaddons-panel ept-item-wrapper-<?php echo esc_attr( $colKey ); ?>" data-col_key="<?php echo esc_attr( $colKey ); ?>">
            <div class="ept-item-wrapper-head">
                <?php do_action( 'ept/admin/form/items/top', $items, $input_name_prefix, $colKey, $column, $columns, $data, $TABLE_ID ); ?>
            </div>
            <div class="ept-item-items">
                <?php
                if( $items ){

                    foreach( $items as $itemKey=>$item ){
                        
                        $item = apply_filters( 'ept/admin/columns/column/items', $item, $items, $colKey, $column, $columns, $data, $TABLE_ID, $post );
                        
                        
                        $name = isset( $item['name'] ) && !empty( $item['name'] ) ? $item['name'] : false;
                        $content = isset( $item['content'] ) && !empty( $item['content'] ) ? $item['content'] : false;
                        $item_settings = isset( $item['settings'] ) && !empty( $item['settings'] ) && is_array( $item['settings'] ) ? $item['settings'] : false;
                        $style = isset( $item['style'] ) && !empty( $item['style'] ) ? $item['style'] : false;
                        $input_name = $input_name_prefix . "[items][{$itemKey}]";

                        if( !$name ){
                            return;
                        }

                        ?>
                <div class="each-item-wr" data-item_key="<?php echo esc_attr( $itemKey ); ?>" data-item_name="<?php echo esc_attr( $name ); ?>"> 
                    <input type="hidden" name="<?php echo esc_attr( $input_name ); ?>[name]" value="<?php echo esc_attr( $name ); ?>">   

                    <div class="item-head handle">
                        <span class="item-head-name"><?php echo esc_html( $name ); ?></span>
                        <span class="item-controllers">
                            <i title="<?php echo esc_html( 'Delete Item/Element', 'easy_price_table' ); ?>" class="control-icons control-icons-delete">X</i>
                            <i  title="<?php echo esc_html( 'Edit Item/Element', 'easy_price_table' ); ?>" class="control-icons control-icons-edit">Edit</i>
                        </span>
                    </div>
                    <div class="item-content">
                            <?php
                            /*
                        if( $name == 'content' ){

                            $settings = array(
                                'textarea_name'     => $input_name . '[content]',
                                'textarea_rows'     => 3,
                                'teeny'             => true,
                                );
                            wp_editor(wp_kses_post( $content ), 'eps_' . $itemKey . '_' . $colKey, $settings );

                        }else{
                        ?>

                        <input type="text" 
                               name="<?php echo esc_attr( $input_name ); ?>[content]" 
                               value="<?php echo esc_attr( $content ); ?>"
                               class="ua_input"
                               >     
                        <?php    
                        }

                        */

                            $item_name = isset( $item['name'] ) && !empty( $item['name'] ) ? $item['name'] : 'no_name';
                            $input_name = $input_name . '[settings]';
                            
                            echo '<div class="item-content-main">';
                            do_action( 'ept/admin/form/items/item/' . $item_name, $item, $input_name, $item_settings, $items, $itemKey, $colKey, $column, $columns, $data, $TABLE_ID, $post );
                            do_action( 'ept/admin/form/items/item', $item_name, $item, $input_name, $item_settings, $items, $itemKey, $colKey, $column, $columns, $data, $TABLE_ID, $post );
                            echo '</div>';
                            
                            echo '<div class="item-template">';
                            do_action( 'ept/admin/form/items/template', $item_name, $item, $input_name, $item_settings, $items, $itemKey, $colKey, $column, $columns, $data, $TABLE_ID, $post );
                            echo '</div>';
                            

                            ?>
                    </div>

                </div> <!-- /.each-item-wr -->
                    <?php   
                        
                        
                    }
                }else{
                    echo '<p class="ept_no_item">' . esc_html( 'There is no Element to this Column' ) . '</p>';
                }
                
                ?>
            </div>
            <div class="ept-item-wrapper-footer">
                <?php do_action( 'ept/admin/form/items/bottom', $items, $input_name_prefix, $colKey, $column, $columns, $data, $TABLE_ID, $post ); ?>
            </div>
        </div>
    </div>
    
<?php        


    $serial++;
    }
}else{
    echo '<p>' . esc_html( 'There is no column added for your price table.' ) . '</p>';
}
?>
</div> <!-- /.ept-column-wrapper -->
<?php
do_action( 'ept/admin/form/bottom', $columns, $data, $TABLE_ID, $post );