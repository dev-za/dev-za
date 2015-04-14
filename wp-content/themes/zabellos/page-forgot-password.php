<?php
get_header();
?>
    <div class="container-profile ">
        <div class="container">
            <div class="row">
                <div class="my-profile back-fff col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">

                    <div id="lostPassword">
                        <p class="font-20">Forgot password</p>

                        <div id="message">
                            <p class="text-muted">Please enter your username or email address.
                                You will receive a link to create a new password via email.</p>
                        </div>

                        <form id="lostPasswordForm" method="post"  role="form">
                            <?php
                            // this prevent automated script for unwanted spam
                            if ( function_exists( 'wp_nonce_field' ) )
                                wp_nonce_field( 'rs_user_lost_password_action', 'rs_user_lost_password_nonce' );
                            ?>

                            <div class="form-group col-xs-12 col-lg-12">
                                <label for="user_login" class="sr-only">Username or Email</label>
                                <input type="text" class="form-control" id="user_login" name="user_login" placeholder="Username or Email">
                            </div>
                            <?php
                            /**
                             * Fires inside the lostpassword <form> tags, before the hidden fields.
                             *
                             * @since 2.1.0
                             */
                            do_action( 'lostpassword_form' ); ?>

                            <div class="form-group clearfix col-lg-12">
                                <input id="submit" type="submit" class="btn btn-danger btn-lg" value="Get new password">
                                <img width="20" src="<?php echo get_stylesheet_directory_uri(); ?>/images/loading.gif" id="loading" alt="Preloader" style="visibility: hidden;" />
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();?>
