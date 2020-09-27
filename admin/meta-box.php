<?php


if( !function_exists( 'ept_add_meta_boxes' ) ){
    function ept_add_meta_boxes(){
        add_meta_box( 'ept_metabox_table_content', 'Table Content', 'ept_metabox_render', 'easy_price_table', 'normal', 'high');
        add_meta_box( 'ept_metabox_temp_scode', 'Template and Shortcode', 'ept_template_shortcode_render', 'easy_price_table', 'side', 'low');
        add_meta_box( 'ept_metabox_preview_box', 'Preview of Price Table', 'ept_preview_box_render', 'easy_price_table', 'normal', 'low');
        //add_meta_box($id, $title, $callback, $screen, $context, $priority, $callback_args);
    }
}
add_action( 'add_meta_boxes', 'ept_add_meta_boxes' );
$ept_data = array(
    'columns' => array(
        array(
            'status' => 'on',
            'recommend' => 'off',
            'items' => array(
                array(
                    'name'      => 'name',
                    'content'   => 'Startup',
                    'style'     => array(
                        'color' => 'red',
                        'background'=> 'white',
                    ),
                ),
                
                array(
                    'name'      => 'content',
                    'content'   => 'This is a Condetnt of Content',
                    
                ),
                
                array(
                    'name'      => 'price',
                    'content'   => 'This is a Condetnt of Content',
                    
                ),
                
                array(
                    'name'      => 'footer',
                    'content'   => 'Footer Content of Cols',
                    
                ),
                
            ),
            'attr' => array(
                'something' => 'nothing',
                'nothing'   => 'something',
            ),
            'style' => array(
                'color'=>'black',
                'background'=> 'white',
            ),
        ),
        
        array(
            'status' => 'on',
            'recommend' => 'on',
            'items' => array(
                array(
                    'name'      => 'name',
                    'content'   => 'This is Hagle',
                    'style'     => array(
                        'color' => 'black',
                        'background'=> 'white',
                    ),
                ),
                
                array(
                    'name'      => 'content',
                    'content'   => 'This is a Condetnt of Content',
                    
                ),
                
                array(
                    'name'      => 'price',
                    'content'   => '120USD',
                    
                ),
                
                array(
                    'name'      => 'footer',
                    'content'   => 'Content of Cols',
                    
                ),
                
            ),
            'attr' => array(
                'something' => 'nothing',
            ),
            'style' => array(
                'color'=>'black',
                'background'=> 'white',
            ),
        ),
        
        array(
            'status' => 'off',
            'recommend' => 'off',
            'items' => array(
                array(
                    'name'      => 'name',
                    'content'   => 'This is Hagle',
                    'style'     => array(
                        'color' => 'black',
                        'background'=> 'white',
                    ),
                ),
                
                array(
                    'name'      => 'content',
                    'content'   => 'This is a Condetnt of Content',
                    
                ),
                
                array(
                    'name'      => 'price',
                    'content'   => '120USD',
                    
                ),
                
                array(
                    'name'      => 'footer',
                    'content'   => 'Content of Cols',
                    
                ),
                
            ),
            'attr' => array(
                'something' => 'nothing',
            ),
            'style' => array(
                'color'=>'black',
                'background'=> 'white',
            ),
        ),
        
    ),
);
//ept_metabox_render
if( !function_exists( 'ept_metabox_render' ) ){
    function ept_metabox_render(){
        global $ept_data;
        var_dump($ept_data);
        
        ?>
    <div class="easy-product-table-wrapper">
        <input type="hidden" name="ept_nonce_value" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>">
    <h2>Welcome</h2>
    </div>      
        <?php
    }
}

//ept_template_shortcode_render
if( !function_exists( 'ept_template_shortcode_render' ) ){
    /**
     * To display shortcode and to select template of Price Table
     */
    function ept_template_shortcode_render(){
        global $post;
        ?>
    <div class="easy-product-table-wrapper ept-temp-shortcode">
        <div class="shortcode_box">
            <label for="ept_shortcode_text">Shortcode</label><br>
            <input class="ua_input" id="ept_shortcode_text" type="text" value="<?php echo esc_attr( '['. EPT_SHORTCODE . ' id=\'' . $post->ID . '\']' ); ?>">
        </div>
    </div>      
        <?php
    }
}
//ept_metabox_render
if( !function_exists( 'ept_preview_box_render' ) ){
    function ept_preview_box_render(){
        global $post;
        $ept_data = get_post_meta( $post->ID, EPT_META_NAME, true );
        ?>
    <div class="easy-product-table-wrapper ept-preview">
    <h2>Preview Table</h2>
    <?php var_dump($ept_data); ?>
    </div>      
        <?php
    }
}



if( !function_exists( 'ept_metabox_data_save' ) ){
    function ept_metabox_data_save( $post_id, $post ){
        
        if ( ! isset( $_POST['ept_nonce_value'] ) ) { // Check if our nonce is set.
            return;
        }

        // verify this came from the our screen and with proper authorization,
        // because save_post can be triggered at other times
        if( !wp_verify_nonce( $_POST['ept_nonce_value'], plugin_basename(__FILE__) ) ) {
            return;
        }
        
        global $ept_data;
        update_post_meta( $post_id, EPT_META_NAME, $ept_data );
        
    }
}
add_action( 'save_post', 'ept_metabox_data_save', 10, 2 ); // 


