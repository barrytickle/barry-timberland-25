<?php

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Site Settings',
        'menu_title'    => 'Site Settings',
        'menu_slug'     => 'site-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Footer Settings',
        'menu_title'    => 'Footer Settings',
        'parent_slug'   => 'site-settings',
    ));
}


function logo_split($logo){
    $logo = explode(' ', $logo);
    $logo = array_map('trim', $logo);
    return array('full' => $logo, 'initials' => array($logo[0][0], $logo[1][0]));
}


function create_case_studies_cpt() {
    $labels = array(
        'name' => _x('Case Studies', 'Post Type General Name'),
        'singular_name' => _x('Case Study', 'Post Type Singular Name'),
        'menu_name' => __('Case Studies'),
        'name_admin_bar' => __('Case Study'),
        'archives' => __('Case Study Archives'),
        'attributes' => __('Case Study Attributes'),
        'parent_item_colon' => __('Parent Case Study:'),
        'all_items' => __('All Case Studies'),
        'add_new_item' => __('Add New Case Study'),
        'add_new' => __('Add New'),
        'new_item' => __('New Case Study'),
        'edit_item' => __('Edit Case Study'),
        'update_item' => __('Update Case Study'),
        'view_item' => __('View Case Study'),
        'view_items' => __('View Case Studies'),
        'search_items' => __('Search Case Study'),
        'not_found' => __('Not found'),
        'not_found_in_trash' => __('Not found in Trash'),
        'featured_image' => __('Featured Image'),
        'set_featured_image' => __('Set featured image'),
        'remove_featured_image' => __('Remove featured image'),
        'use_featured_image' => __('Use as featured image'),
        'insert_into_item' => __('Insert into Case Study'),
        'uploaded_to_this_item' => __('Uploaded to this Case Study'),
        'items_list' => __('Case Studies list'),
        'items_list_navigation' => __('Case Studies list navigation'),
        'filter_items_list' => __('Filter Case Studies list'),
    );
    $args = array(
        'label' => __('Case Study'),
        'description' => __('Post Type Description'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions'),
        'taxonomies' => array('category', 'post_tag'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'case-studies'), // Custom slug
        'show_in_rest' => true, // Enable Gutenberg editor
    );
    register_post_type('case_study', $args);
}
add_action('init', 'create_case_studies_cpt');

