<?php


if( !function_exists( 'ept_add_meta_boxes' ) ){
    function ept_add_meta_boxes(){
        add_meta_box( 'ept_metabox_table_content', 'Table Content', 'ept_metabox_render', 'easy_price_table', 'normal', 'high');
        add_meta_box( 'ept_metabox_temp_scode', 'Shortcode', 'ept_template_shortcode_render', 'easy_price_table', 'side', 'low');
        //add_meta_box( 'ept_metabox_preview_box', 'Preview of Price Table', 'ept_preview_box_render', 'easy_price_table', 'normal', 'low');

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
                    'content'   =>  EPT_BASE_URL . 'assets/images/img_1.png',
                ),

                array(
                    'name'      => 'name',
                    'content'   => 'Basic',
                ),

                array(
                    'name'      => 'price',
                    'content'   => '',
                    'settings'  => array(
                        'symbol' => '$',
                        'amount' => '100',
                        'billing-cycle' => ' USD/Month',
                    ),
                    
                ),
                array(
                    'name'      => 'divider',
                    'content'   => '_____________',
                ),
                array(
                    'name'      => 'content',
                    'settings' => array(
                        'content' => '<ul>
 	<li>24/7 Support</li>
 	<li>Customer Support</li>
 	<li>Unlimited Update</li>
 	<li>Basic Features</li>
 	<li>Upto 1 Year</li>
 	<li>Regular Update</li>
</ul>',
                    ),
                ),
                
                
                array(
                    'name'      => 'button',
                    'settings' => array(
                        'text' => 'Buy Now',
                        'url' => 'https://wordpress.org',
                        'new_tab' => 'on',
                    ),
                    
                ),
                
            ),
            'attr' => array(
                //'something' => 'nothing',
                //'nothing'   => 'something',
            ),
            'style' => array(
                //'color'=>'black',
                //'background'=> 'white',
            ),
        ),
        
        
        array(
            'status' => 'on',
            'recommend' => 'on',
            'items' => array(
                array(
                    'name'      => 'banner-image',
                    'content'   =>  EPT_BASE_URL . 'assets/images/img_2.png',
                ),

                array(
                    'name'      => 'name',
                    'content'   => 'Advance',
                ),

                array(
                    'name'      => 'price',
                    'content'   => '',
                    'settings'  => array(
                        'symbol' => '$',
                        'amount' => '250',
                        'billing-cycle' => ' USD/Month',
                    ),
                    
                ),
                array(
                    'name'      => 'divider',
                    'content'   => '_____________',
                ),
                array(
                    'name'      => 'content',
                    'settings' => array(
                        'content' => '<ul>
 	<li>24/7 Support</li>
 	<li>Quick Customer Support</li>
 	<li>Unlimited Update</li>
 	<li>Advance Features</li>
 	<li>Upto 5 Year</li>
 	<li>Instant Update</li>
</ul>',
                    ),
                ),
                
                
                array(
                    'name'      => 'button',
                    'settings' => array(
                        'text' => 'Buy Now',
                        'url' => 'https://wordpress.org',
                        'new_tab' => 'on',
                    ),
                    
                ),
                
            ),
            'attr' => array(
                //'something' => 'nothing',
                //'nothing'   => 'something',
            ),
            'style' => array(
                //'color'=>'black',
                //'background'=> 'white',
            ),
        ),
        
        
        array(
            'status' => 'on',
            'recommend' => 'off',
            'items' => array(
                array(
                    'name'      => 'banner-image',
                    'content'   =>  EPT_BASE_URL . 'assets/images/img_3.png',
                ),

                array(
                    'name'      => 'name',
                    'content'   => 'Enterprise',
                ),

                array(
                    'name'      => 'price',
                    'content'   => '',
                    'settings'  => array(
                        'symbol' => '$',
                        'amount' => '810',
                        'billing-cycle' => ' USD/Year',
                    ),
                    
                ),
                array(
                    'name'      => 'divider',
                    'content'   => '_____________',
                ),
                array(
                    'name'      => 'content',
                    'settings' => array(
                        'content' => '<ul>
 	<li>24/7 Support</li>
 	<li>Customer Support</li>
 	<li>Unlimited Update</li>
 	<li>Basic Features</li>
 	<li>Unlimite Time</li>
 	<li>Developer Version Provided</li>
</ul>',
                    ),
                ),
                
                
                array(
                    'name'      => 'button',
                    'settings' => array(
                        'text' => 'Buy Now',
                        'url' => 'https://wordpress.org',
                        'new_tab' => 'on',
                    ),
                    
                ),
                
            ),
            'attr' => array(
                //'something' => 'nothing',
                //'nothing'   => 'something',
            ),
            'style' => array(
                //'color'=>'black',
                //'background'=> 'white',
            ),
        ),
        
        
       
        
    ),
);
$ept_data = apply_filters( 'ept_global_data', $ept_data );
//ept_metabox_render
if( !function_exists( 'ept_metabox_render' ) ){
    
    /**
     * Main Metabox for Easy Price Table
     * Where user will able to Create/Custmize Table
     * 
     * @global type $post
     * @global type $ept_data
     */
    function ept_metabox_render(){
        global $post;
        $POST_ID = $TABLE_ID = $post->ID;
        global $ept_data;
        $ept_data = apply_filters( 'ept_default_data', $ept_data, $TABLE_ID, $post );
        $data = get_post_meta( $POST_ID, EPT_META_NAME, true );
        if( empty( $data ) ){
            $data = $ept_data;
        }
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
    <div class="easy-product-table-wrapper ept-temp-shortcode ultraaddons">
        <div class="shortcode_box">
            <label for="ept_shortcode_text"><?php echo esc_html( 'Shortcode', 'easy_price_table' ); ?></label><br>
            <input class="ua_input" id="ept_shortcode_text" type="text" value="<?php echo esc_attr( '['. EPT_SHORTCODE . ' id=\'' . $post->ID . '\']' ); ?>">
            <p><?php echo esc_html( 'Just copy your shortcode and Paste in to your page/post or any of your custom_post.', 'easy_price_table' ); ?></p>
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
    ?>
    </div>      
        <?php
    }
}



if( !function_exists( 'ept_metabox_data_save' ) ){
    
    /**
     * Save Metabox Data information using $_POST and update_post_meta() function
     * 
     * 
     * @param type $post_id
     * @param type $post
     * @return type void
     */
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
        
        
        do_action( 'ept_data_before_save', $data, $post_id );
        
        $data = apply_filters( 'ept_data_on_save', $data, $post_id );
        
        if( $data ){
            //Expiring Transient,when Data Saving Properly
            $transient = EPT_META_NAME . '_' . $post_id;
            set_transient( $transient, false, -1 );
            
            update_post_meta( $post_id, EPT_META_NAME, $data );
        }
        
        do_action( 'ept_data_after_save', $data, $post_id );
    }
}
add_action( 'save_post', 'ept_metabox_data_save', 10, 2 ); // 


