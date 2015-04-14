//    var reset_password = {url: 'http://zabellos.local/wp-content/themes/zabellos/ajax/reset_password.php'};

jQuery(document).ready(function($) {
    //save .wrapper block height
    window.wrapperHeight = $('.wrapper').height();
    // for lost password
    $("form#lostPasswordForm").submit(function(){

        var submit = $("div#lostPassword #submit");
        var preloader = $("div#lostPassword #loading");
        var message    = $("div#lostPassword #message");
        var submitForm = $("#lostPasswordForm");
        var contents = {
            action:     'lost_pass',
            nonce:         this.rs_user_lost_password_nonce.value,
            user_login:    this.user_login.value
        };
        preloader.css({'visibility':'visible'});
        // disable button onsubmit to avoid double submision
        submit.attr("disabled", "disabled").addClass('disabled');

        // Display our pre-loading
        preloader.css({'visibility':'visible'});

        $.post( reset_password.url, contents, function( data ){

            submit.removeAttr("disabled").removeClass('disabled');

            // hide pre-loader
            preloader.css({'visibility':'hidden'});

            if(data.success === true){
                submitForm.hide();
                //apply saved height
                $('.wrapper').height(window.wrapperHeight);
            }
            // display return data
            message.html( data.message );
        });

        return false;
    });


    // for reset password
    $("form#resetPasswordForm").submit(function(){
        var submit = $("div#resetPassword #submit");
        var preloader = $("div#resetPassword #preloader");
        var message    = $("div#resetPassword #message");
        var submitForm = $("#resetPasswordForm");
        var contents = {
                action:     'reset_pass',
                nonce:         this.rs_user_reset_password_nonce.value,
                pass1:        this.pass1.value,
                pass2:        this.pass2.value,
                user_key:    this.user_key.value,
                user_login:    this.user_login.value
            };

        // disable button onsubmit to avoid double submision
        submit.attr("disabled", "disabled").addClass('disabled');

        // Display our pre-loading
        preloader.css({'visibility':'visible'});

        $.post( reset_password.url, contents, function( data ){
            submit.removeAttr("disabled").removeClass('disabled');

            // hide pre-loader
            preloader.css({'visibility':'hidden'});

            // display return data
            message.html( data.message );

            if(data.success === true){
                submitForm.hide();
                //apply saved height
                $('.wrapper').height(window.wrapperHeight);

                message.append('<p class="text-muted">Redirecting to login page...</p>');
                setTimeout(function(){
                    window.location = document.location.protocol + '//' + document.location.host + '/login';
                }, 3000);
            }

        });

        return false;
    });

});
