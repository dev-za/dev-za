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
        <input type="submit" class="btn btn-danger btn-lg pull-left" value="Login">
    </div>

    <input type="hidden" name="user_email" id="user_email" class="input" value="" size="25">
    <input type="hidden" id="_wpnonce" name="_wpnonce" value="c26fcb96e8">
    <input type="hidden" name="_wp_http_referer" value="/checkout/">
    <input type="hidden" name="redirect" value="<?php echo site_url()?>/checkout/">
</form>