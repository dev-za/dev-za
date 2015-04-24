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

        $("#user_login").keyup(function(){

            var email = $("#user_login").val();

            if(email != 0)
            {
                if(isValidEmailAddress(email))
                {
                    $("#validEmail").addClass('validField');
                } else {
                    $("#validEmail").removeClass('validField');
                }
            } else {
                $("#user_login").css({
                    "background-image": "none"
                });
            }

        });

        function isValidEmailAddress(emailAddress) {
            var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            return pattern.test(emailAddress);
        }


        var formAction = '<?php echo site_url()?>/wp-login.php';
        $('input#user_login').on('input', userExists);
        $('input#user_login').on('blur', userExists);

        function userExists(){
            var email = $(this).val();

            $('#user_email').val(email);

            $.post('<?php bloginfo('template_directory'); ?>/ajax/checkout.php',
                { action: 'check_user_exists', email: email },
                function(response){
                    if(response.success){
                        if(response.user_exists) {
                            doUserExists();
                        } else {
                            doUserNotExists()
                        }
                    } else {
                        doUserExists();
                    }

                }
            );
        }

        function doUserNotExists(){
            $('input#user_login').parent().parent('form').attr('action', formAction + '?action=register');

            $('input#user_login').attr('name', 'user_login');

            $('input[name="pwd"]').parent().addClass('hide');

            $('input[type="submit"]').val('Register');
        }

        function doUserExists(){
            $('input#user_login').parent().parent('form').attr('action', formAction);

            $('input#user_login').attr('name', 'log');

            $('input[name="pwd"]').parent().removeClass('hide');

            $('input[type="submit"]').val('Login');
        }

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
                        <?php if(isset($_REQUEST['registered'])):?>
                            <p class="text-warning checkout-form-message text-left">You are successfully registered!</p>
                            <p class="text-warning checkout-form-message text-left">Please, check your e-mail for the password.</p>
                        <?php else:?>
                        <p class="text-muted text-left checkout-form-message">Please enter your email for existing account or new email if you don't have an account with as.</p>
                        <?php endif;?>
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
