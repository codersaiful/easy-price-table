<?php

/**
 * Use shortcode [EASY_PRICE_TABLE id='123']
 * To display PRICE TABLE OF EASY_PRICE_TABLE
 * Here: 123 is your Post ID of Easy Price Table
 * 
 */

add_action( 'init', function(){
    add_shortcode( EPT_SHORTCODE, array( 'EASY_PRICE_TABLE_SHORTCODE', 'table' ) );
    //add_shortcode( 'EASY_PRICE_TABLE', array( 'EASY_PRICE_TABLE_SHORTCODE', 'table' ) );
} );

if( !class_exists( 'EASY_PRICE_TABLE_SHORTCODE' ) ){
    
    /**
     * Class to Maintenance Shortcode for EASY PRICE TABLE
     * 
     * EASY_PRICE_TABLE_SHORTCODE::table() method has created to display table
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
                    set_transient( $transient, $data, 604800 ); //1 week in Second 604800
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
                                <?php include __DIR__ . '/col-manager.php'; ?>
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
                ob_start();
                $ID = isset( $atts['id'] ) && !empty( $atts['id'] ) ? $atts['id'] : esc_html( 'Table ID is not founded in Shortcode.', 'easy_price_table' );
                $not_found = '<p class="ept_error ept_table_not_founded">' . esc_html( 'Table not founded, based on POST ID(' . $ID . ').' ) . '</p>';
                ?>
                <div class="ept_table_not_found ept_error_wrapper">
                <?php 
                do_action( 'ept_table_not_found', $atts );
                echo apply_filters( 'ept_table_not_found_msg', wp_kses_post( $not_found ), $atts );
                ?>
                </div>
                <?php
                echo ob_get_clean();
            }
        }
    }
}
