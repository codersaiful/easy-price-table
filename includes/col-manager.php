<?php

if( isset( $data['columns'] ) && is_array( $data['columns'] ) ){
    $columns = $data['columns'];
    $columns = apply_filters( 'ept_columns_' . $ID, $columns, $data, $atts );
    $columns = apply_filters( 'ept_columns', $columns, $data, $atts, $ID );
    $count = count( $columns );
    ?>
<div class="columns-wrapper column-wrapper-<?php echo esc_attr( $ID ); ?>">   
    <?php
    foreach( $columns as $col_key => $column ){
        $column = apply_filters( 'ept_each_column_arr', $column, $col_key, $columns, $data, $atts, $ID );
        $items = isset( $column['items'] ) && is_array( $column['items'] ) ? $column['items'] : array();
        $items_count = count( $items );
        $status = isset( $column['status'] ) ? $column['status'] : 'on';
        $recommend = isset( $column['recommend'] ) ? $column['recommend'] : 'off';
        $col_class_arr = array(
            'ept_each_column',
            'ept_each_column_items_ammount_' . $items_count,
            'ept_each_col_key_' . $col_key,
            'ept_each_col_status_' . $status,
            'ept_each_col_recommend_' . $recommend,
            isset( $column['class'] ) ? $column['class'] : 'no_custom_class',
        );
        $col_class_arr = apply_filters( 'ept_each_column_class_arr', $col_class_arr, $col_key, $ID, $columns, $data, $atts  );
        $col_class = implode( ' ', $col_class_arr );
        ?>
    <div class="<?php echo esc_attr( $col_class );?>">
        <div class="ept_each_column_fixer">
            <div class="ept_item_erapper">
                <?php do_action( 'ept_each_col_header', $col_key, $ID, $columns, $data, $atts  ); ?>
                
                <?php
                    $element_template_loc = apply_filters( 'ept_template_loc', EPT_TEMPLATE_DIR, $ID, $columns, $data, $atts, $col_key  );
                    foreach( $items as $item ){
                        
                        $file_name = isset( $item['name'] ) && is_string( $item['name'] ) && !empty( $item['name'] ) ? $item['name'] : 'default';
                        
                        $tag = isset( $item['tag'] ) && is_string( $item['tag'] ) && !empty( $item['tag'] ) ? $item['tag'] : 'div';
                        $settings = $setting = isset( $item['settings'] ) && is_array( $item['settings'] ) ? $item['settings'] : false;
                        $content = isset( $item['content'] ) ? $item['content'] : '';
                        $style = isset( $item['style'] ) && is_array( $item['style'] ) ? $item['style'] : array();
                        ?>
                <<?php echo $tag; ?> class="ept_each_item ept_item_name_<?php echo esc_attr( $file_name ); ?>">    
                        <?php
                        
                        
                        $file = $element_template_loc . $file_name . '.php';
                        if( file_exists( $file ) ){
                            include $file;
                        }else{
                            include $element_template_loc . 'default.php';
                        }
                        ?>
                </<?php echo $tag; ?>> <!-- /.ept_each_item -->      
                        <?php
                        
                    }
                ?>
                
                <?php do_action( 'ept_each_col_footer', $col_key, $ID, $columns, $data, $atts  ); ?>
            </div>
        </div>
    </div>    
        <?php
    }
    ?>
</div> <!-- ./columns-wrapper -->
    <?php
}else{
    echo "<p class='ept-column-not-found-error'>" . esc_html( 'Price table Column not founded.' ) . "</p>";
}