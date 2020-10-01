<?php
/**
 * FrontEnd Function
 */

if( !function_exists( 'ept_table_edit_link' ) ){
    
    /**
     * Adding Edit Table link at the bottom of Table
     * Using Action:
     * do_action( 'ept_table_footer', $data, $atts, $ID )
     * 
     * @param type $ID
     * @return void
     */
    function ept_table_edit_link( $data, $atts, $ID ) {
        if( !current_user_can( EPT_CAPABILITY ) ) return null;
        $ID = (int) $ID;
        ?>
        <div class="ept_edit_table">
            <?php echo esc_html( 'Edit Price Table', 'easy_price_table' ); ?> - <a href="<?php echo esc_attr( admin_url( 'post.php?post=' . $ID . '&action=edit&classic-editor' ) ); ?>" 
                            target="_blank"
                            title="<?php echo esc_attr( 'Edit your table. It will open on new tab.', 'easy_price_table' ); ?>"
                            >
            <?php echo esc_html( get_the_title( $ID ) ); ?>
            </a>   
        </div> 
        <?php
    }
}
add_action( 'ept_table_footer', 'ept_table_edit_link', 99, 3 );