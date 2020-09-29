<?php
//ept_browse_page

if( !function_exists( 'ept_browse_page' ) ){
    
    /**
     * Making Browse page of Plugin
     * 
     */
    function ept_browse_page() {
        wp_enqueue_script( 'plugin-install' );
			wp_enqueue_script( 'updates' );
			add_thickbox();
        echo '<h2>' . esc_html( 'Browse our Plugins' ) . '</h2>';
        
        $wp_list_table = _get_list_table( 'WP_Plugin_Install_List_Table' );
        $wp_list_table->prepare_items();

        echo '<form id="plugin-filter" method="post">';
        $wp_list_table->display();
        echo '</div>';
    }
}
add_filter( 'plugins_api_result', 'ept_browse_plugin_result', 1, 3 );
function ept_browse_plugin_result( $res, $action, $args ){
    
    if ( $action !== 'query_plugins' ) {
            return $res;
    }
    
    if( isset( $_GET['page'] ) && $_GET['page'] == 'ept-browse-plugin' ){
        //Will Continue
    }else{
        return $res;
    }
    $browse_plugins = get_transient( 'codersaiful_browse_plugins' );


    if( $browse_plugins ){
        return $browse_plugins;//As $res
    }
    
    
    
    $wp_version = get_bloginfo( 'version', 'display' );
    $action = 'query_plugins';
    $args = array(
        'page' => 1,
        'wp_version' => $wp_version
    );
    $args['author']          = 'codersaiful';
    $url = 'http://api.wordpress.org/plugins/info/1.2/';
    $url = add_query_arg(
            array(
                    'action'  => $action,
                    'request' => $args,
            ),
            $url
    );

    $http_url = $url;
    $ssl      = wp_http_supports( array( 'ssl' ) );
    if ( $ssl ) {
            $url = set_url_scheme( $url, 'https' );
    }

    $http_args = array(
            'timeout'    => 15,
            'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url( '/' ),
    );
    $request   = wp_remote_get( $url, $http_args );

    if ( $ssl && is_wp_error( $request ) ) {
            if ( ! wp_is_json_request() ) {
                    trigger_error(
                            sprintf(
                                    /* translators: %s: Support forums URL. */
                                    __( 'An unexpected error occurred. Something may be wrong with WordPress.org or this server&#8217;s configuration. If you continue to have problems, please try the <a href="%s">support forums</a>.' ),
                                    __( 'https://wordpress.org/support/forums/' )
                            ) . ' ' . __( '(WordPress could not establish a secure connection to WordPress.org. Please contact your server administrator.)' ),
                            headers_sent() || WP_DEBUG ? E_USER_WARNING : E_USER_NOTICE
                    );
            }

            $request = wp_remote_get( $http_url, $http_args );
    }


    $res = json_decode( wp_remote_retrieve_body( $request ), true );
    if ( is_array( $res ) ) {
            // Object casting is required in order to match the info/1.0 format.
            $res = (object) $res;
            set_transient( 'codersaiful_browse_plugins' , $res, 32000);
    }
    
    return $res;
}
//
//add_filter( 'plugins_api_args', function( $args, $action ){
//    //var_dump($args, $action);
//    //$args['author']          = 'XplodedThemes';
//    return $args;
//},100, 2 );
//
//
//add_filter('plugins_api',function($bool, $action, $args){
//    //var_dump($bool, $action, $args);
//    return $bool;
//},10,3);