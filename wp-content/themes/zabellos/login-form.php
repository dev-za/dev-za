<form role="form" method="post" id="profile-form" action="<? echo home_url();?>/wp-login.php">
    <div class="form-group col-xs-12 col-lg-12">
        <label for="user_login" class="sr-only">Email</label>
        <input type="text" class="form-control" id="user_login" name="log" placeholder="Email">
    </div>
    <div class="form-group col-xs-12 col-lg-12">
        <label for="user_pass" class="sr-only">Password</label>
        <input type="password" class="form-control" name="pwd" id="user_pass" placeholder="Password">
    </div>
    <div class="form-group clearfix col-lg-12">
        <p class="form-control-static pull-left">
            <a href="<?php home_url()?>/forgot-password">Forgot your password?</a>
        </p>
        <input type="submit" class="btn btn-danger btn-lg" value="Login">
        <input type="hidden" name="redirect_to" value="<?php echo site_url()?>/account/">
    </div>
</form>