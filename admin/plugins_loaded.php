<?php

add_action( 'plugins_loaded', function(){
    
} );


/**
 * Creating Post Type
 */
add_action( 'init', function(){
    $labels = array(
            'name'                  => _x( 'Easy Price Tables', 'Post Type General Name', 'easy_price_table' ),
            'singular_name'         => _x( 'Easy Price Table', 'Post Type Singular Name', 'easy_price_table' ),
            'menu_name'             => __( 'Easy Price Tables', 'easy_price_table' ),
            'name_admin_bar'        => __( 'Easy Price Table', 'easy_price_table' ),
            'archives'              => __( 'Price Table Archives', 'easy_price_table' ),
            'attributes'            => __( 'Item Attributes', 'easy_price_table' ),
            'parent_item_colon'     => __( 'Parent Item:', 'easy_price_table' ),
            'all_items'             => __( 'All Price Table', 'easy_price_table' ),
            'add_new_item'          => __( 'Add New Price Table', 'easy_price_table' ),
            'add_new'               => __( 'Add New', 'easy_price_table' ),
            'new_item'              => __( 'New Price Table', 'easy_price_table' ),
            'edit_item'             => __( 'Edit Price Table', 'easy_price_table' ),
            'update_item'           => __( 'Update Item', 'easy_price_table' ),
            'view_item'             => __( 'View Table', 'easy_price_table' ),
            'view_items'            => __( 'View Tables', 'easy_price_table' ),
            'search_items'          => __( 'Search Search Table', 'easy_price_table' ),
            'not_found'             => __( 'Not found', 'easy_price_table' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'easy_price_table' ),
            'featured_image'        => __( 'Featured Image', 'easy_price_table' ),
            'set_featured_image'    => __( 'Set featured image', 'easy_price_table' ),
            'remove_featured_image' => __( 'Remove featured image', 'easy_price_table' ),
            'use_featured_image'    => __( 'Use as featured image', 'easy_price_table' ),
            'insert_into_item'      => __( 'Insert into item', 'easy_price_table' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'easy_price_table' ),
            'items_list'            => __( 'Price Table list', 'easy_price_table' ),
            'items_list_navigation' => __( 'Items list navigation', 'easy_price_table' ),
            'filter_items_list'     => __( 'Filter items list', 'easy_price_table' ),
    );
    $args = array(
            'label'                 => __( 'Easy Price Table', 'easy_price_table' ),
            'description'           => __( 'Create your price table easily', 'easy_price_table' ),
            'labels'                => $labels,
            'supports'              => array( 'title' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 10,
            'menu_icon'             => 'dashicons-cart',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => false,
            'exclude_from_search'   => true,
            'publicly_queryable'    => true,
            'query_var'             => 'easy_price_table',
            'capability_type'       => 'post',
            'capabilities' => array(
                'edit_post' => 'edit_easy_price_table',
                'edit_posts' => 'edit_easy_price_tables',
                'edit_others_posts' => 'edit_others_easy_price_tables',
                'publish_posts' => 'publish_easy_price_tables',
                'read_post' => 'read_easy_price_table',
                'read_private_posts' => 'read_private_easy_price_tables',
                'delete_post' => 'delete_easy_price_table',
            ),
            'map_meta_cap' => true,
    );
    register_post_type( 'easy_price_table', $args );
} );

/**
* Plugin Activation Hook
*/

//register_deactivation_hook( __FILE__,  );