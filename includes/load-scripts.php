<?php

if( !function_exists( 'ept_enqueue_scripts' ) ){
    
    /**
     * Style and Script file loading for Front-sie
     * manage enqueue for front-side
     */
    function ept_enqueue_scripts(){
        global $ept_google_fonts;
        if( is_array( $ept_google_fonts ) && count( $ept_google_fonts ) > 0 ){
            
            foreach( $ept_google_fonts as $fonts ){
                $id = isset( $fonts['id'] ) ? $fonts['id'] : '';
                $url = isset( $fonts['url'] ) ? $fonts['url'] : '';
                $version = isset( $fonts['version'] ) ? $fonts['version'] : '1.0.0';
                $media = isset( $fonts['media'] ) ? $fonts['media'] : 'all';
                wp_enqueue_style( $id, $url, array(), $version, $media );
            }
        }
        
        wp_enqueue_style( 'ept-style', EPT_BASE_URL . 'assets/css/style.css', array(), '1.0.0', 'all' );
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'ept-script', EPT_BASE_URL . 'assets/js/scripts.js', array( 'jquery' ), '1.0.0', true );

        $ajax_url = admin_url( 'admin-ajax.php' );
        $EPT_DATA = array( 
            'ajaxurl'   => $ajax_url,
            'ajax_url'  => $ajax_url,
            'site_url'  => site_url(),
            'checkout_url' => wc_get_checkout_url(),
            'cart_url' => wc_get_cart_url(),
            );
        $EPT_DATA = apply_filters( 'ept_localize_data', $EPT_DATA );
        wp_localize_script( 'ept-script', 'EPT_DATA', $EPT_DATA );
    }
}
add_action( 'wp_enqueue_scripts', 'ept_enqueue_scripts' );

if( !function_exists( 'ept_admin_enqueue_scripts' ) ){
    
    /**
     * Manage Style And JS Script File for Admin Panel.
     */
    function ept_admin_enqueue_scripts( ) {
        wp_enqueue_style( 'ept-css', EPT_BASE_URL . 'assets/css/admin-common.css', array(), '1.0.0', 'all' );
        wp_enqueue_style('ept-css');

        wp_enqueue_style( 'ept-admin', EPT_BASE_URL . 'assets/css/admin-style.css', array(), '1.0.0', 'all' );
        wp_enqueue_script( 'ept-admin', EPT_BASE_URL . 'assets/js/admin-script.js', array( 'jquery' ), '1.0.0', true );
    }
}
add_action( 'admin_enqueue_scripts', 'ept_admin_enqueue_scripts' );