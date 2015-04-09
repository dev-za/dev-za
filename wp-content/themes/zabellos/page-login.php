<?php
get_header();
?>
    <div class="container-profile ">
        <div class="container">
            <div class="row">
                <div class="my-profile back-fff col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                    <p class="font-20">My profile</p>

                    <?php if(!empty($_REQUEST['login']) && $_REQUEST['login'] == 'failed'):?>
                        <p class="text-danger">Either the email or password you entered is invalid.</p>

                    <?php endif;?><?php if(!empty($_REQUEST['checkemail']) && $_REQUEST['checkemail'] == 'confirm'):?>
                        <p class="text-muted">Check your e-mail for the confirmation link.</p>
                    <?php endif;?>

                    <form role="form" method="post" id="profile-form" action="<? echo home_url();?>/wp-login.php">
                        <div class="form-group col-xs-12 col-lg-12">
                            <label for="user_login" class="sr-only">Email</label>
                            <input type="text" class="form-control" id="user_login" name="log" placeholder="Email">
                        </div>
                        <div class="form-group col-xs-12 col-lg-12">
                            <label for="user_pass" class="sr-only">Password</label>
                            <input type="password" class="form-control" name="pwd" id="user_pass" name="myprofilepassword" placeholder="Password">
                        </div>
                        <div class="form-group clearfix col-lg-12">
                            <p class="form-control-static pull-left">
                                <a href="<?php home_url()?>/forgot-password">Forgot your password?</a>
                            </p>
                            <input type="submit" class="btn btn-danger btn-lg" value="Login">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();?>
