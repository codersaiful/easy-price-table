<?php

/**
 * Use shortcode [EASY_PRICE_TABLE]
 * To display PRICE TABLE OF EASY_PRICE_TABLE
 * 
 */

add_action( 'init', function(){
    add_shortcode( EPT_SHORTCODE, array( 'EASY_PRICE_TABLE_SHORTCODE', 'table' ) );
    //add_shortcode( 'EASY_PRICE_TABLE', array( 'EASY_PRICE_TABLE_SHORTCODE', 'table' ) );
} );

if( !class_exists( 'EASY_PRICE_TABLE_SHORTCODE' ) ){
    
    /**
     * Class to Maintenance Shortcode for EASY PRICE TABLE
     */
    class EASY_PRICE_TABLE_SHORTCODE{

        /**
        * Adding shortcode for price Table
        * 
        * @return String  Full Price Table based on ShortCode
        */
        public static function table( $atts = false ) {
            
            $pairs = array( 'exclude' => false );
            extract( shortcode_atts( $pairs, $atts ) );
            $data = false;
            if( isset( $atts['id'] ) && !empty( $atts['id'] ) && is_numeric( $atts['id'] ) && get_post_type( (int) $atts['id'] ) == 'easy_price_table' ){
                ob_start();
                $ID = $atts['id'] = (int) $atts['id'];
                $atts = apply_filters( 'ept_atts_arr', $atts, $ID );
                
                $transient = EPT_META_NAME . '_' . $ID;
                if( get_transient( $transient ) ){
                    $data = get_transient( $transient );
                }else{
                    $data = get_post_meta( $ID, EPT_META_NAME, true );
                    $data = wp_parse_args($atts, $data);
                    set_transient( $transient, $data, 12 ); //1 week in Second 604800
                }
                
                
                $data = apply_filters( 'ept_data_arr', $data, $ID, $atts );
                
                $tbl_class_arr = array(
                    'easy_price_table',
                    'easy_price_table-' . $ID,
                );
                $tbl_class_arr = apply_filters( 'epr_wrapper_class_arr', $tbl_class_arr, $data, $ID, $atts );
                $tbl_class = implode( ' ', $tbl_class_arr );
                ?>
                <div class="<?php echo esc_attr( $tbl_class ); ?>">
                    <div class="ept-fixer">
                        <div class="ept-header ept-container">
                            <?php do_action( 'ept_table_header', $data, $atts, $ID ); ?>
                        </div>
                        <div class="ept-content ept-container">
                            <div class="ept-content-fixer">
                                <?php include_once __DIR__ . '/col-manager.php'; ?>
                            </div>
                        </div>
                        <div class="ept-footer ept-container">
                            <?php do_action( 'ept_table_footer', $data, $atts, $ID ); ?>
                        </div>
                    </div>
                </div>    
                <?php

                
                
                return ob_get_clean();
            }else{
                
                return false;
            }
        }
    }
}
