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


//Email login
remove_filter('authenticate', 'wp_authenticate_username_password', 20);

add_filter('authenticate', function($user, $email, $password){

    //Check for empty fields
    if(empty($email) || empty ($password)){
        //create new error object and add errors to it.
        $error = new WP_Error();

        if(empty($email)){ //No email
            $error->add('empty_username', __('<strong>ERROR</strong>: Email field is empty.'));
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ //Invalid Email
            $error->add('invalid_username', __('<strong>ERROR</strong>: Email is invalid.'));
        }

        if(empty($password)){ //No password
            $error->add('empty_password', __('<strong>ERROR</strong>: Password field is empty.'));
        }

        return $error;
    }

    //Check if user exists in WordPress database
    $user = get_user_by('email', $email);

    //bad email
    if(!$user){
        $error = new WP_Error();
        $error->add('invalid', __('<strong>ERROR</strong>: Either the email or password you entered is invalid.'));
        return $error;
    }
    else{ //check password
        if(!wp_check_password($password, $user->user_pass, $user->ID)){ //bad password
            $error = new WP_Error();
            $error->add('invalid', __('<strong>ERROR</strong>: Either the email or password you entered is invalid.'));
            return $error;
        }else{
            return $user; //passed
        }
    }
}, 20, 3);

add_filter('gettext', function($text){
    if(in_array($GLOBALS['pagenow'], array('wp-login.php'))){
        if('Username' == $text){
            return 'Email';
        }
    }
    return $text;
}, 20);

//End email login


/**
 * Redirect user after successful login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 * @return string
 */
function my_login_redirect( $redirect_to, $request, $user ) {
    //is there a user to check?
    global $user;
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        //check for admins
        if ( in_array( 'administrator', $user->roles ) ) {
            // redirect them to the default place
            return $redirect_to;
        } else {
//            return home_url();
            return '/account';
        }
    } else {
        return $redirect_to;
    }
}
add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );


//logout redirect
function go_home(){
    wp_redirect( home_url() );
    exit();
}
add_action('wp_logout','go_home');

//login failed redirect
function my_front_end_login_fail( $username ) {

    $referrerUrl = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
    //trim GET parameters
    $arr = explode('/', $referrerUrl);
    array_pop($arr);
    $redirectUrl = implode('/', $arr);
    // if there's a valid referrer, and it's not the default log-in screen
    if ( !empty($redirectUrl) && !strstr($redirectUrl,'wp-login') && !strstr($redirectUrl,'wp-admin') ) {
        wp_redirect( $redirectUrl . '?login=failed' );  // let's append some information (login=failed) to the URL for the theme to use
        exit;
    }
}
add_action( 'wp_login_failed', 'my_front_end_login_fail' );  // hook failed login

//forgot password redirect
function wpse_lost_password_redirect() {

    // Check if have submitted
    $confirm = ( isset($_GET['checkemail'] ) ? $_GET['checkemail'] : '' );

    if( $confirm ) {
        wp_redirect( home_url() . '/login' . '?checkemail=confirm' );
        exit;
    }
}
add_action('login_headerurl', 'wpse_lost_password_redirect');


//Display username
function personal_message_when_logged_in() {

    if ( is_user_logged_in() ) :

        $current_user = wp_get_current_user();

        echo '' . $current_user->user_firstname ;

    else :
        echo '';

    endif;
}
add_action( 'loop_start', 'personal_message_when_logged_in' );