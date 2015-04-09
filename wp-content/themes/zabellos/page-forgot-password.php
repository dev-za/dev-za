<?php
get_header();
?>
    <div class="container-profile ">
        <div class="container">
            <div class="row">
                <div class="my-profile back-fff col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                    <p class="font-20">Forgot password</p>
                    <p class="text-muted">Please enter your username or email address. You will receive a link to create a new password via email.</p>
                    <form role="form" method="post" id="profile-form" method="post" action="<? echo home_url();?>/wp-login.php?action=lostpassword">
                        <div class="form-group col-xs-12 col-lg-12">
                            <label for="user_login" class="sr-only">Username or Email</label>
                            <input type="text" class="form-control" id="user_login" name="user_login" placeholder="Username or Email">
                        </div>
                        <div class="form-group clearfix col-lg-12">
                            <input type="submit" class="btn btn-danger btn-lg" value="Get new password">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();?>
