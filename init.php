<?php

/**
 * Plugin Name: Easy Price Table
 * Plugin URI: https://wordpress.org/plugins/easy-price-table
 * Description: Easily show a Price table at Any where of your website, just using a shortcode. No need Programming knowledge. Available different template
 * Author: Saiful Islam
 * Author URI: https://profiles.wordpress.org/codersaiful/#content-plugins
 * 
 * Version: 1.0.0
 * Requires at least:    4.0.0
 * Tested up to:         5.5.2
 * WC requires at least: 3.7
 * WC tested up to:      4.5.2
 * Text Domain: easy_price_table
 * Domain Path: /languages/
 */


if ( !defined( 'ABSPATH' ) ) {
    die();
}

if ( !defined( 'EPT_VERSION' ) ) {
    define( 'EPT_VERSION', '1.0.0');
}
if( !defined( 'EPT_CAPABILITY' ) ){
    $ept_capability = apply_filters( 'ept_menu_capability', 'manage_easy_price_table' );
    define( 'EPT_CAPABILITY', $ept_capability );
}

if ( !defined( 'EPT_NAME' ) ) {
    define( 'EPT_NAME', 'Easy Price Table');
}

if ( !defined( 'EPT_BASE_NAME' ) ) {
    define( 'EPT_BASE_NAME', plugin_basename( __FILE__ ) );
}

if ( !defined( 'EPT_MENU_SLUG' ) ) {
    define( 'EPT_MENU_SLUG', 'easy_price_table' );
}
if ( !defined( 'EPT_META_NAME' ) ) {
    define( 'EPT_META_NAME', 'ept_data' );
}
if ( !defined( 'EPT_SHORTCODE' ) ) {
    $ept_shortcode = 'EASY_PRICE_TABLE';
    $ept_shortcode = apply_filters( 'ept_shortcode_text', $ept_shortcode );
    define( 'EPT_SHORTCODE', $ept_shortcode );
}

if( !defined( 'EPT_PLUGIN' ) ){
    define( 'EPT_PLUGIN', 'easy-price-table/init.php' );
}


if ( !defined( 'EPT_BASE_URL' ) ) {
    define( "EPT_BASE_URL", plugins_url() . '/'. plugin_basename( dirname( __FILE__ ) ) . '/' );
}

if ( !defined( 'EPT_BASE_DIR' ) ) {
    define( "EPT_BASE_DIR", str_replace( '\\', '/', dirname( __FILE__ ) ) );
}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

include_once EPT_BASE_DIR . '/admin/plugins_loaded.php';
if( is_admin() ){
    include_once EPT_BASE_DIR . '/admin/meta-box.php';
    include_once EPT_BASE_DIR . '/admin/functions.php';
}

//Including File
include_once EPT_BASE_DIR . '/includes/load-scripts.php';
include_once EPT_BASE_DIR . '/includes/action-hook.php';
include_once EPT_BASE_DIR . '/includes/functions.php';
include_once EPT_BASE_DIR . '/includes/shortcode.php';

register_activation_hook(__FILE__, function(){
    $role = get_role( 'administrator' );

    $role->add_cap( 'edit_easy_price_table' );
    $role->add_cap( 'edit_easy_price_tables' );
    $role->add_cap( 'edit_others_easy_price_tables' );
    $role->add_cap( 'publish_easy_price_tables' );
    $role->add_cap( 'read_easy_price_table' );
    $role->add_cap( 'read_private_easy_price_tables' );
    $role->add_cap( 'delete_easy_price_table' );
    $role->add_cap( 'manage_easy_price_table' );
} );
