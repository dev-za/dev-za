<?php
get_header();
?>
    <div class="container-profile ">
        <div class="container">
            <div class="row">
                <div class="my-profile back-fff col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                    <p class="font-20">My profile</p>
                    <form role="form" id="profile-form" action="account.html">
                        <div class="form-group col-xs-12 col-lg-12">
                            <label for="Idmy-profile-email" class="sr-only">Email</label>
                            <input type="text" class="form-control" id="Idmy-profile-email" name="myprofileemail" placeholder="Email">
                        </div>
                        <div class="form-group col-xs-12 col-lg-12">
                            <label for="Idmy-profile-password" class="sr-only">Password</label>
                            <input type="password" class="form-control" id="Idmy-profile-password" name="myprofilepassword" placeholder="Password">
                        </div>
                        <div class="form-group clearfix col-lg-12">
                            <p class="form-control-static pull-left"><a href="#">Forgot your password?</a></p>
                            <input type="submit" class="btn btn-danger btn-lg" value="Login">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();?>