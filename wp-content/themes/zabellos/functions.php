<?php
//Add menu support
if (function_exists('add_theme_support')) {
    add_theme_support('menus');
}
//add class 'active' to the child element
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class($classes, $item){
    if( in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}

//Remove container from all menus
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );
function my_wp_nav_menu_args( $args = '' ){
    $args['container'] = false;
    return $args;
}