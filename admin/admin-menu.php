<?php

if( !function_exists( 'ept_plugin_actions' ) ){
    /**
     * For showing configure or add new link on plugin page
     * It was actually an individual file, now combine at 4.1.1
     * @param type $links
     * @return type
     */
    function ept_plugin_actions( $actions ) {
        $links[] = '<a href="' . admin_url( 'post-new.php?post_type=easy_price_table' ) . '" title="' . esc_attr__( 'Create New', 'easy_price_table' ) . '">' . esc_html__( 'Add New', 'easy_price_table' ).'</a>';
        $links[] = '<a href="' . admin_url( 'admin.php?page=ept-browse-plugin' ) . '" title="' . esc_attr__( 'Browse All Plugin', 'easy_price_table' ) . '">' . esc_html__( 'Browse Plugins', 'easy_price_table' ).'</a>';
        //$links[] = '<a href="' . admin_url( 'admin.php?page=ept-settings' ) . '" title="' . esc_attr__( 'Settings', 'easy_price_table' ) . '">' . esc_html__( 'Settings', 'easy_price_table' ).'</a>';
        $links[] = '<a href="https://codeastrology.com/support/" title="' . esc_attr__( 'Support', 'easy_price_table' ) . '" target="_blank">'.esc_html__( 'Support','easy_price_table' ).'</a>';
        return array_merge( $links, $actions );
    }
    add_filter('plugin_action_links_' . EPT_BASE_NAME, 'ept_plugin_actions' );
}

if( !function_exists( 'ept_plugin_meta' ) ){
    /**
     * For showing configure or add new link on plugin page
     * It was actually an individual file, now combine at 4.1.1
     * @param type $links
     * @return type
     */
    function ept_plugin_meta( $plugin_meta, $plugin_file ) {
        
        if( $plugin_file == EPT_BASE_NAME ){
            //$plugin_meta[] = '<a href="https://wcquantity.com/wc-quantity-plus-minus-button/" title="' . esc_attr__( 'Plugin Features', 'easy_price_table' ) . '">' . esc_html__( 'Features', 'easy_price_table' ) . '</a>';
            //$plugin_meta[] = '<a href="https://wcquantity.com/product/head-phone/" title="' . esc_attr__( 'Plugin Demo', 'easy_price_table' ) . '" target="_blank">'.esc_html__( 'Demo','easy_price_table' ).'</a>';
            $plugin_meta[] = '<a href="https://github.com/codersaiful/easy-price-table" title="' . esc_attr__( 'Github Repo', 'easy_price_table' ) . '" target="_blank">'.esc_html__( 'Github Repo','easy_price_table' ).'</a>';
            $plugin_meta[] = '<a href="mailto:codersaiful@gmail.com" title="' . esc_attr__( 'Mail to Developer', 'easy_price_table' ) . '" target="_blank">'.esc_html__( 'Contact to Developer','easy_price_table' ).'</a>';

        }
        return $plugin_meta;
    }
    add_filter('plugin_row_meta', 'ept_plugin_meta',10, 2 );
}

if( !function_exists( 'ept_admin_menu' ) ){
    /**
     * Set Menu for WPT
     * 
     * @since 1.0
     * 
     * @package UltraTables
     */
    function ept_admin_menu() {
        //add_submenu_page( 'edit.php?post_type=easy_price_table', esc_html__( 'Settings', 'easy_price_table' ),  esc_html__( 'Settings', 'easy_price_table' ), ULTRATABLE_CAPABILITY, 'ept-settings', 'ept_settings_page' );
        add_submenu_page( 'edit.php?post_type=easy_price_table', esc_html__( 'Browse', 'easy_price_table' ),  esc_html__( 'Browse', 'easy_price_table' ), EPT_CAPABILITY, 'ept-browse-plugin', 'ept_browse_page' );
    }
}
add_action( 'admin_menu', 'ept_admin_menu' );