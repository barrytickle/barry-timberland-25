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

