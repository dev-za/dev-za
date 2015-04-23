<?php
/**
 * Checkout login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}

//$info_message  = apply_filters( 'woocommerce_checkout_login_message', __( 'Returning customer?', 'woocommerce' ) );
//$info_message .= ' <a href="#" class="showlogin">' . __( 'Click here to login', 'woocommerce' ) . '</a>';
//wc_print_notice( $info_message, 'notice' );
?>
<script type="text/javascript">
    $(document).ready(function(){
        var formAction = '<?php echo site_url()?>/wp-login.php';
       $('input#user_login').on('input', function(){

           var email = $(this).val();

           $('#user_email').val(email);

           $.post('<?php bloginfo('template_directory'); ?>/ajax/checkout.php',
               { action: 'check_user_exists', email: email },
               function(response){
                   if(response.success){
                       if(!response.user_exists){
                           $('input#user_login').parent().parent('form').attr('action', formAction + '?action=register');

                           $('input#user_login').attr('name', 'user_login');

                           $('input[name="pwd"]').parent().addClass('hide');

                           $('input[type="submit"]').val('Register');
                       }
                       else{
                           $('input#user_login').parent().parent('form').attr('action', formAction);

                           $('input#user_login').attr('name', 'log');

                           $('input[name="pwd"]').parent().removeClass('hide');

                           $('input[type="submit"]').val('Login');

                       }
                   }

               }
           );
       });
    });
</script>
<div class="container">
    <div class="row">
        <div class="my-profile back-fff col-xs-12 col-sm-12 col-md-12">
            <div class="container">
                <div class="row">
                    <div col-xs-12 col-sm-12 col-md-12>
                        <?php get_template_part('login-form-messages')?>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <?php get_template_part('login-form-checkout')?>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted text-left checkout-form-message font-13">Please enter your email for existing account or new email if you don't have an account with as.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
	/*woocommerce_login_form(
		array(
			'message'  => __( 'If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; Shipping section.', 'woocommerce' ),
			'redirect' => wc_get_page_permalink( 'checkout' ),
			'hidden'   => true
		)
	);*/
?>
