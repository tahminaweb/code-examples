<?php

if ( !defined('ABSPATH') )
{
    echo __( 'Nice try!', 'video-text-domain');
}

// video Custom Post Type
function video_init() {
    // set up video labels
    $labels = array(
        'name' => __('Videos', 'video-text-domain'),
        'singular_name' => __('Video', 'video-text-domain') ,
        'add_new' =>  __('Add New Video', 'video-text-domain'),
        'add_new_item' => __('Add New Video', 'video-text-domain'),
        'edit_item' => __('Edit Video','video-text-domain'),
        'new_item' => __('New Video' ,'video-text-domain'),
        'all_items' => __('All Video','video-text-domain'),
        'view_item' => __('View Video', 'video-text-domain'),
        'search_items' => __('Search Video', 'video-text-domain'),
        'not_found' =>  __('No Videos Found', 'video-text-domain'),
        'not_found_in_trash' =>__( 'No Videos found in Trash', 'video-text-domain') ,
        'parent_item_colon' => '',
        'menu_name' => __( 'Videos', 'video-text-domain'),
    );

    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'video'),
        'query_var' => true,
        'menu_icon' => 'dashicons-randomize',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
        )
    );
    register_post_type( 'video', $args );

    // register taxonomy
    register_taxonomy('video_category', 'video', array('hierarchical' => true, 'label' => 'Category', 'query_var' => true, 'rewrite' => array( 'slug' => 'video-category' )));
}

add_action( 'init', 'video_init' );

