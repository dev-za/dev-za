<?php
include_once('acf-repeater/acf-repeater.php');

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

//Add thumbnails support
add_theme_support( 'post-thumbnails', array('post') );


//Tune up excerpt
function new_excerpt_more( $more ) {    return '...'; }
add_filter('excerpt_more', 'new_excerpt_more');

function custom_excerpt_length( $length ) { return 500; }
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


//Featured content

// Add support for featured content.
add_theme_support( 'featured-content', array(
    'featured_content_filter' => 'zabellos_get_featured_posts',
    'max_posts' => 6,
) );


/**
 * Getter function for Featured Content Plugin.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return array An array of WP_Post objects.
 */
function zabellos_get_featured_posts() {
    /**
     * Filter the featured posts to return in Twenty Fourteen.
     *
     * @since Twenty Fourteen 1.0
     *
     * @param array|bool $posts Array of featured posts, otherwise false.
     */
    return apply_filters( 'zabellos_get_featured_posts', array() );
}

/**
 * A helper conditional function that returns a boolean value.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return bool Whether there are featured posts.
 */
function zabellos_has_featured_posts() {
    return ! is_paged() && (bool) zabellos_get_featured_posts();
}

/*
 * Add Featured Content functionality.
 *
 * To overwrite in a plugin, define your own Featured_Content class on or
 * before the 'setup_theme' hook.
 */
if ( ! class_exists( 'Featured_Content' ) && 'plugins.php' !== $GLOBALS['pagenow'] ) {
    require get_template_directory() . '/inc/featured-content.php';
}

//End Featured content


function wp_infinitepaginate(){
    $loopFile        = $_POST['loop_file'];
    $paged           = $_POST['page_no'];
    $posts_per_page  = (isset($_POST['posts_per_page']) && intval($_POST['posts_per_page']))?intval($_POST['posts_per_page']):get_option('posts_per_page');
//    var_dump($posts_per_page);
    # Load the posts
    query_posts(array('paged' => $paged , 'posts_per_page' => $posts_per_page));
    get_template_part( $loopFile );

    exit;
}
add_action('wp_ajax_infinite_scroll', 'wp_infinitepaginate');           // for logged in user
add_action('wp_ajax_nopriv_infinite_scroll', 'wp_infinitepaginate');    // if user not logged in


remove_filter('the_content', 'wpautop');