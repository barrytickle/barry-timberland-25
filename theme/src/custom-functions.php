<?php


function register_my_menu() {
    register_nav_menu('header-menu', __('Header Menu'));
}
add_action('init', 'register_my_menu');

function has_class_name($object, $class_name) {
    return in_array($class_name, $object);
}

function post_meta($post_id, $meta_key){
    return get_post_meta($post_id, $meta_key, true);
}

function list_acf_fields_by_post_id($post_id) {
    $post = get_post($post_id);
    if (!$post) {
        return false; // Post doesn't exist
    }

    $blocks = parse_blocks($post->post_content);
    $acf_fields = [];

    foreach ($blocks as $block) {
        if (isset($block['blockName']) && strpos($block['blockName'], 'acf/') === 0) {
            // Extract ACF block fields
            $acf_fields[$block['blockName']] = $block['attrs']['data'] ?? [];
        }
    }

    return $acf_fields;
}

function get_url_by_post_id($post_id) {
    $post = get_post($post_id);
    if (!$post) {
        return false; // Post doesn't exist
    }
    return get_permalink($post_id);
}

function get_acf_block_by_post_id($post_id, $block_name) {
    $post = get_post($post_id);
    if (!$post) {
        return false; // Post doesn't exist
    }

    $blocks = parse_blocks($post->post_content);

    foreach ($blocks as $block) {
        if (isset($block['blockName']) && $block['blockName'] === 'acf/' . $block_name) {
            // Retrieve stored ACF fields
            $acf_fields = $block['attrs']['data'] ?? [];

            // Manually resolve dynamic fields by rendering the block
            if (function_exists('render_block')) {
                $rendered_block = render_block($block); // Fully renders the block
                $acf_fields['rendered_content'] = $rendered_block;
            }

            return $acf_fields;
        }
    }

    return false; // Block not found
}

function get_featured_image_by_post_id($post_id) {
    $thumbnail_id = get_post_thumbnail_id($post_id);
    if (!$thumbnail_id) {
        return false; // No featured image
    }

    $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'full');
    return $thumbnail_url ? $thumbnail_url[0] : false;
}



function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function is_svg($url){
    $path = parse_url($url, PHP_URL_PATH);
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    if($ext !== 'svg') {
        return array (
            'is_svg' => false,
            'contents' => $url
        );
    }else{
        return array (
            'is_svg' => true,
            'contents' => file_get_contents($url)
        );
    }    
}

function add_class_to_svg($svg, $class){
    $svg = str_replace('<svg', '<svg class="'.$class.'"', $svg);
    return $svg;
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
