<?php
get_header();
?>
    <div class="container-profile ">
        <div class="container">
            <div class="row">
                <div class="my-profile back-fff col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                    <p class="font-20">My profile</p>
                    <?php get_template_part('login-form-messages')?>
                    <?php get_template_part('login-form')?>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();?>
