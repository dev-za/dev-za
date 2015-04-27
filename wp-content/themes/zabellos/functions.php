<?php
include_once('acf-repeater/acf-repeater.php');

//Add menu support
if (function_exists('add_theme_support')) {
    add_theme_support('menus');
}
//Add WooCommers
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
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
    //AKA: нужно сделать проверку для post переменных
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



//logout redirect
function go_home(){
    wp_redirect( home_url() );
    exit();
}
add_action('wp_logout','go_home');


//login failed redirect
function my_front_end_login_fail( $username ) {
    //AKA: нужно добавить проверку реферер может не существовать
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


// localize wp-ajax, notice the path to our theme-ajax.js file
wp_enqueue_script( 'rsclean-request-script', get_stylesheet_directory_uri() . '/js/reset_password.js', array( 'jquery' ) );
wp_localize_script( 'rsclean-request-script', 'reset_password', array(
    'url'        	=> admin_url( 'admin-ajax.php' ),
    'site_url'     	=> get_bloginfo('url'),
    'theme_url' 	=> get_bloginfo('template_directory')
) );




add_action( 'wp_ajax_nopriv_lost_pass', 'lost_pass_callback' );
add_action( 'wp_ajax_lost_pass', 'lost_pass_callback' );
/*
*	@desc	Process lost password
*/
function lost_pass_callback() {


    global $wpdb, $wp_hasher;
//AKA: нужна проверка для всех пост переменных
    $nonce = $_POST['nonce'];

    if ( ! wp_verify_nonce( $nonce, 'rs_user_lost_password_action' ) )
        die ( 'Security checked!');

//We shall SQL escape all inputs to avoid sql injection.
    $user_login = $_POST['user_login'];

    $errors = new WP_Error();

    if ( empty( $user_login ) ) {
        $errors->add('empty_username', __('<strong>ERROR</strong>: Enter a username or e-mail address.'));
    } else if ( strpos( $user_login, '@' ) ) {
        $user_data = get_user_by( 'email', trim( $user_login ) );
        if ( empty( $user_data ) )
            $errors->add('invalid_email', __('<strong>ERROR</strong>: There is no user registered with that email address.'));
    } else {
        $login = trim( $user_login );
        $user_data = get_user_by('login', $login);
    }


    /**
     * Fires before errors are returned from a password reset request.
     *
     * @since 2.1.0
     */
    do_action( 'lostpassword_post' );

    if ( ! $user_data )
        $errors->add('invalidcombo', __('<strong>ERROR</strong>: Invalid username or e-mail.'));


// redefining user_login ensures we return the right case in the email
    $user_login = $user_data->user_login;
    $user_email = $user_data->user_email;

    /**
     * Filter whether to allow a password to be reset.
     *
     * @since 2.7.0
     *
     * @param bool true           Whether to allow the password to be reset. Default true.
     * @param int  $user_data->ID The ID of the user attempting to reset a password.
     */
    $allow = apply_filters( 'allow_password_reset', true, $user_data->ID );

    if ( ! $allow )
        $errors->add('no_password_reset', __('Password reset is not allowed for this user'));

// Generate something random for a password reset key.
    $key = wp_generate_password( 20, false );

    /**
     * Fires when a password reset key is generated.
     *
     * @since 2.5.0
     *
     * @param string $user_login The username for the user.
     * @param string $key        The generated password reset key.
     */
    do_action( 'retrieve_password_key', $user_login, $key );

// Now insert the key, hashed, into the DB.
    if ( empty( $wp_hasher ) ) {
        require_once ABSPATH . 'wp-includes/class-phpass.php';
        $wp_hasher = new PasswordHash( 8, true );
    }
    $hashed = $wp_hasher->HashPassword( $key );
    $wpdb->update( $wpdb->users, array( 'user_activation_key' => $hashed ), array( 'user_login' => $user_login ) );

    $message = __('Someone requested that the password be reset for the following account:') . "\r\n\r\n";
    $message .= network_home_url( '/' ) . "\r\n\r\n";
    $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
    $message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";
    $message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
//    $message .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . "\r\n";
    $message .= network_site_url("reset-password?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . "\r\n";

    if ( is_multisite() )
        $blogname = $GLOBALS['current_site']->site_name;
    else
// The blogname option is escaped with esc_html on the way into the database in sanitize_option
// we want to reverse this for the plain text arena of emails.
        $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

    $title = sprintf( __('[%s] Password Reset'), $blogname );

    /**
     * Filter the subject of the password reset email.
     *
     * @since 2.8.0
     *
     * @param string $title Default email title.
     */
    $title = apply_filters( 'retrieve_password_title', $title );
    /**
     * Filter the message body of the password reset mail.
     *
     * @since 2.8.0
     *
     * @param string $message Default mail message.
     * @param string $key     The activation key.
     */
    $message = apply_filters( 'retrieve_password_message', $message, $key );

//if ( $message && ! wp_mail( $user_email, wp_specialchars_decode( $title ), $message ) )
    $response_message = '';
    if ( wp_mail( $user_email, wp_specialchars_decode( $title ), $message ) )
        $response_message = 'Check your e-mail for the confirmation link.';
    else
        $errors->add('could_not_sent', __('The e-mail could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function.'), 'message');


    // display error message
    $response = new StdClass();
    if ( $errors->get_error_code() ){
        $response->success = false;
        $response->message = '<p class="text-danger">'. $errors->get_error_message( $errors->get_error_code() ) .'</p>';
    }

    else{
        $response->success = true;
        $response->message = '<p class="text-muted">' . $response_message . '</p>';
    }

    header('Content-Type: application/json');
    echo json_encode($response);

    die();
}

add_action( 'wp_ajax_nopriv_reset_pass', 'reset_pass_callback' );
add_action( 'wp_ajax_reset_pass', 'reset_pass_callback' );
/*
*	@desc	Process reset password
*/
function reset_pass_callback() {
    //AKA: проверка для всех пост переменных
    $errors = new WP_Error();
    $nonce = $_POST['nonce'];

    if ( ! wp_verify_nonce( $nonce, 'rs_user_reset_password_action' ) )
        die ( 'Security checked!');

    $pass1 	= $_POST['pass1'];
    $pass2 	= $_POST['pass2'];
    $key 	= $_POST['user_key'];
    $login 	= $_POST['user_login'];

    $user = check_password_reset_key( $key, $login );

    if ( is_wp_error( $user ) ) {
        if ( $user->get_error_code() === 'expired_key' )
            $errors->add( 'expiredkey', __( 'Sorry, that key has expired. Please try again.' ) );
        else
            $errors->add( 'invalidkey', __( 'Sorry, that key does not appear to be valid.' ) );
    }


// check to see if user added some string
    if( empty( $pass1 ) || empty( $pass2 ) )
        $errors->add( 'password_required', __( 'Password is required field' ) );

// is pass1 and pass2 match?
    if ( isset( $pass1 ) && $pass1 != $pass2 )
        $errors->add( 'password_reset_mismatch', __( 'The passwords do not match.' ) );

    /**
     * Fires before the password reset procedure is validated.
     *
     * @since 3.5.0
     *
     * @param object           $errors WP Error object.
     * @param WP_User|WP_Error $user   WP_User object if the login and reset key match. WP_Error object otherwise.
     */
    do_action( 'validate_password_reset', $errors, $user );

    $response_message = '';

    if ( ( ! $errors->get_error_code() ) && isset( $pass1 ) && !empty( $pass1 ) ) {
        reset_password($user, $pass1);

        $response_message = 'Your password has been reset.';
    }

    $response = new StdClass();
    // display error message
    if ( $errors->get_error_code() ){
        $response->success = false;
        $response->message = '<p class="text-danger">'. $errors->get_error_message( $errors->get_error_code() ) .'</p>';
    }
    else{
        $response->success = true;
        $response->message = '<p class="text-muted">'. $response_message .'</p>';
    }

    header('Content-Type: application/json');
    echo json_encode($response);

    // return proper result
    die();
}


//Woocommerce

/**
 * Set a custom add to cart URL to redirect to
 * @return string
 */
add_filter( 'woocommerce_add_to_cart_redirect', 'custom_add_to_cart_redirect' );

function custom_add_to_cart_redirect() {
    return site_url('/cart');
}


add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

function custom_override_checkout_fields( $fields ) {
    $fields['billing']['billing_shipping_boxes'] = array(
        'required'  => false,
        'class'     => array('hide'),
        'clear'     => true
    );

    return $fields;
}



