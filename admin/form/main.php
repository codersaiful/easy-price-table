<div class="ept-column-wrapper">
<?php

$columns = isset( $data['columns'] ) && is_array( $data['columns'] ) && count( $data['columns'] ) > 0 ? $data['columns'] : false;
$columns = apply_filters( 'ept/admin/columns', $columns, $data, $TABLE_ID, $post );

if( $columns  ){
    $serial = $maxNumber = 1;
    foreach( $columns as $colKey => $column ){
        
        $column = apply_filters( 'ept/admin/columns/column', $column, $columns, $data, $TABLE_ID, $post );
        $head_label = '';
        $prefix = 'ept-content';
        $status = isset( $column['status'] ) ? 'on' : 'off';
        $checkbox           = $status == 'on' ? 'checked' : '';
        $recommend = isset( $column['recommend'] ) ? $column['recommend'] : 'off';
        $recommend_checkbox           = $recommend == 'on' ? 'checked' : '';
        $attr = isset( $column['attr'] ) && !empty( $column['attr'] ) && is_array( $column['attr'] ) ? $column['attr'] :  false;
        $style = isset( $column['style'] ) && !empty( $column['style'] ) && is_array( $column['style'] ) ? $column['style'] :  false;
        $items = isset( $column['items'] ) && !empty( $column['items'] ) && is_array( $column['items'] ) ? $column['items'] :  false;
        $items = apply_filters( 'ept/admin/columns/column/items', $items, $colKey, $column, $columns, $data, $TABLE_ID, $post );
        
        $input_name_prefix = "data[columns][{$colKey}]";
        $ept_datas = get_post_meta( $POST_ID, EPT_META_NAME, true );;
        //var_dump($ept_datas['columns'][$colKey]['items']);
        if($colKey >= $maxNumber ){
            $maxNumber = $colKey;
        }
?>
    <div class="ept-each-column ept-each-column-<?php echo esc_attr( $colKey ); ?> ">
        <div class="column-control-icons">
            <i class="ept-each-column-handle ept-handle control-icons">Move</i>
            <i class="control-icons control-icons-delete">X</i>
            <i class="control-icons control-icons-edit">Edit</i>
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
                
                <input type="hidden" name="<?php echo esc_attr( $input_name_prefix ); ?>[recommend]" value="<?php echo esc_attr( $recommend ); ?>" class="<?php echo esc_attr( $prefix . '-' . $colKey ); ?>-recommend">

                <label class="switch recommended-item">
                    <input class="ept-placeholder-onoff" data-target="<?php echo esc_attr( $prefix . '-' . $colKey ); ?>-recommend" type="checkbox" <?php echo esc_attr( $recommend_checkbox ); ?>>
                    <div class="slider round"><!--ADDED HTML -->
                        <span class="on"><?php echo esc_html( 'Recommended', 'easy_price_table' ); ?></span><span class="off"><?php echo esc_html( 'As usual', 'easy_price_table' ); ?></span><!--END-->
                    </div>
                </label>


                <input type="hidden" name="<?php echo esc_attr( $input_name_prefix ); ?>[status]" value="<?php echo esc_attr( $status ); ?>" class="<?php echo esc_attr( $prefix . '-' . $colKey ); ?>-status">

                <label class="switch">
                    <input class="ept-placeholder-onoff" data-target="<?php echo esc_attr( $prefix . '-' . $colKey ); ?>-status" type="checkbox" <?php echo esc_attr( $checkbox ); ?>>
                    <div class="slider round"><!--ADDED HTML -->
                        <span class="on"><?php echo esc_html( 'Enable', 'easy_price_table' ); ?></span><span class="off"><?php echo esc_html( 'Disable', 'easy_price_table' ); ?></span><!--END-->
                    </div>
                </label>
            </div>
        </div>
        
        
        <div class="ept-item-wrapper ultraaddons-panel">
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
                        $style = isset( $item['style'] ) && !empty( $item['style'] ) ? $item['style'] : false;
                        $input_name = $input_name_prefix . "[items][{$itemKey}]";

                        if( !$name ){
                            return;
                        }

                        ?>
                <div class="each-item-wr"> 
                    <input type="hidden" name="<?php echo esc_attr( $input_name ); ?>[name]" value="<?php echo esc_attr( $name ); ?>">   

                        <div class="item-head handle">
                            <?php echo esc_html( $name ); ?>
                            <div class="item-controllers">
                                <i class="control-icons control-icons-delete">X</i>
                            </div>
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
                                do_action( 'ept/admin/form/items/item/' . $item_name, $item, $itemKey, $input_name, $items, $colKey, $column, $columns, $data, $TABLE_ID, $post );
                                do_action( 'ept/admin/form/items/item', $item, $itemKey, $input_name, $items, $colKey, $column, $columns, $data, $TABLE_ID, $post );
                                
                                
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
            <div class="ept-item-wrapper-head">
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