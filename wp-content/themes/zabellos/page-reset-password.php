<?php
get_header();
?>
<div class="container-profile ">
    <div class="container">
        <div class="row">
            <div class="my-profile back-fff col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <div id="resetPassword">
                    <p class="font-20">Reset password</p>
                    <div id="message">
                    <?php
                        $errors = new WP_Error();
                        $user = check_password_reset_key($_GET['key'], $_GET['login']);

                        if ( is_wp_error( $user ) ) {
                            if ( $user->get_error_code() === 'expired_key' )
                                $errors->add( 'expiredkey', __( 'Sorry, that key has expired. Please try again.' ) );
                            else
                                $errors->add( 'invalidkey', __( 'Sorry, that key does not appear to be valid.' ) );
                        }

                        // display error message
                        if ( $errors->get_error_code() ) {
                            ?>
                            <p class="text-danger"><?php echo $errors->get_error_message($errors->get_error_code());?></p>
                        <?php
                        }
                        else { ?>
                            <p class="text-muted">Enter your new password below.</p>
                        <?php
                        } ?>


                    </div>
                    <!--this check on the link key and user login/username-->


                    <form id="resetPasswordForm" method="post" autocomplete="off">
                        <?php
                        // this prevent automated script for unwanted spam
                        if ( function_exists( 'wp_nonce_field' ) )
                            wp_nonce_field( 'rs_user_reset_password_action', 'rs_user_reset_password_nonce' );
                        ?>

                        <input type="hidden" name="user_key" id="user_key" value="<?php echo esc_attr( $_GET['key'] ); ?>" autocomplete="off" />
                        <input type="hidden" name="user_login" id="user_login" value="<?php echo esc_attr( $_GET['login'] ); ?>" autocomplete="off" />


                        <div class="form-group col-xs-12 col-lg-12">
                            <label for="pass1" class="sr-only">New password</label>
                            <input type="password" class="form-control" name="pass1" id="pass1" autocomplete="off" value="" placeholder="New password">
                        </div>
                        <div class="form-group col-xs-12 col-lg-12">
                            <label for="pass2" class="sr-only">Confirm new password</label>
                            <input type="password" class="form-control" name="pass2" id="pass2" autocomplete="off" value="" placeholder="Confirm new password">
                        </div>



                        <?php
                        /**
                         * Fires following the 'Strength indicator' meter in the user password reset form.
                         *
                         * @since 3.9.0
                         *
                         * @param WP_User $user User object of the user whose password is being reset.
                         */
                        do_action( 'resetpass_form', $user );
                        ?>

                        <div class="form-group clearfix col-lg-12">
                            <input  type="submit" name="wp-submit" id="wp-submit" class="btn btn-danger btn-lg" value="<?php esc_attr_e('Reset Password'); ?>">
                            <img width="20" src="<?php echo get_stylesheet_directory_uri(); ?>/images/loading.gif" id="loading" alt="Preloader" style="visibility: hidden;" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
