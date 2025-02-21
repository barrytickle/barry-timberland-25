<?php


function register_my_menu() {
    register_nav_menu('header-menu', __('Header Menu'));
}
add_action('init', 'register_my_menu');

function has_class_name($object, $class_name) {
        return in_array($class_name, $object);
}