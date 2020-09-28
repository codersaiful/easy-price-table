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
                    'name'      => 'banner-image',
                    'content'   => '<img src="http://testing.cm/wp-content/uploads/2020/09/lungs.png" alt="" />',
                ),

                array(
                    'name'      => 'name',
                    'content'   => 'CARDIOLOGY',
                    'style'     => array(
                        'color' => 'red',
                        'background'=> 'white',
                    ),
                ),
                array(
                    'name'      => 'price',
                    'content'   => 
                    '<span class="currency">$</span>
                    <span class="amount">85.99</span>
                    <span class="billing-cycle">/mon</span>',
                    
                ),
                array(
                    'name'      => 'content',
                    'content'   => 
                    '<ul><li>Regular Health Check-Ups</li>
                    <li>Weekly Blood Test</li>
                    <li>200 Test & Treatment</li>
                    <li>Medical Consultation</li></ul>',
                    
                ),
                
                
                
                array(
                    'name'      => 'footer',
                    'content'   => '<a href="#" class="btn btn-primary">Get Started Now</a>',
                    
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
                    'name'      => 'banner-image',
                    'content'   => '<img src="http://testing.cm/wp-content/uploads/2020/09/microscope.png" alt="" />',
                ),

                array(
                    'name'      => 'name',
                    'content'   => 'BODY CHECKUP',
                    'style'     => array(
                        'color' => 'black',
                        'background'=> 'white',
                    ),
                ),
                
                array(
                    'name'      => 'price',
                    'content'   => 
                    '<span class="currency">$</span>
                    <span class="amount">65.99</span>
                    <span class="billing-cycle">/mon</span>',
                    
                ),

                array(
                    'name'      => 'content',
                    'content'   => 
                    '<ul><li>Regular Health Check-Ups</li>
                    <li>Weekly Blood Test</li>
                    <li>200 Test & Treatment</li>
                    <li>Medical Consultation</li>
                    <li>Medical Consultation</li>
                    <li>Medical Consultation</li>
                    <li>Medical Consultation</li>
                    <li>Medical Consultation</li>
                    <li>Medical Consultation</li>
                    <li>Labratory Service</li></ul>',
                    
                ),
                
                array(
                    'name'      => 'footer',
                    'content'   => '<a href="#" class="btn btn-primary">Get Started Now</a>',
                    
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
                    'name'      => 'banner-image',
                    'content'   => '<img src="http://testing.cm/wp-content/uploads/2020/09/test-tubes.png" alt="" />',
                ),
                array(
                    'name'      => 'name',
                    'content'   => 'BlOOD TEST',
                    'style'     => array(
                        'color' => 'black',
                        'background'=> 'white',
                    ),
                ),
                
                array(
                    'name'      => 'price',
                    'content'   => 
                    '<span class="currency">$</span>
                    <span class="amount">95.99</span>
                    <span class="billing-cycle">/mon</span>',
                    
                ),

                array(
                    'name'      => 'content',
                    'content'   => 
                    '<ul><li>Regular Health Check-Ups</li>
                    <li>Weekly Blood Test</li>
                    <li>200 Test & Treatment</li>
                    <li>Medical Consultation</li></ul>',
                    
                ),
                
                array(
                    'name'      => 'footer',
                    'content'   => '<a href="#" class="btn btn-primary">Get Started Now</a>',
                    
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
        global $post;
        $POST_ID = $TABLE_ID = $post->ID;
        global $ept_data;
        $data = get_post_meta( $POST_ID, EPT_META_NAME, true );
        //echo '<pre>';
        //print_r( $ept_data );
        //print_r( $data );
        //echo '</pre>';
        //var_dump($ept_data,get_post_meta( $POST_ID, EPT_META_NAME, true ));
        
        ?>
    <div class="easy-product-table-wrapper ept-main-form ultraaddons easy-product-table">
        <input type="hidden" name="ept_nonce_value" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>">
        <?php
        include __DIR__ . '/form/main.php'
        ?>
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
    <?php 
    //var_dump($ept_data); 
    ?>
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
        
        $data = isset( $_POST['data'] ) && is_array( $_POST['data'] ) ? $_POST['data'] : false;
        //var_dump($data);exit;
        
        if( $data ){
            update_post_meta( $post_id, EPT_META_NAME, $data );
        }
        
        
    }
}
add_action( 'save_post', 'ept_metabox_data_save', 10, 2 ); // 


