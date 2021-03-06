/*
 Коды клавиш, которые вызывают прокрутку:
 33, // pageUp
 34, // pageDown
 35, // end
 36, // home
 37, // left
 38, // up
 39, // right
 40  // down
 */

/*
document.onmousewheel = document.onwheel = function() {
    return false;
};

document.addEventListener ("MozMousePixelScroll",
    function() { return false }, false);

document.onkeydown = function(e) {
    if (e.keyCode >= 33 && e.keyCode <= 40) return false;
}
*/


$(document).ready(function(){

	/*border by clicking*/
	$(".checkout-address .col-sm-6.address-left button.btn-primary").click(function() {
		
		$(".checkout-address .col-sm-6.address-left").toggleClass("border-address");
	
	});
	$(".checkout-address .col-sm-6.address-right button.btn-primary").click(function() {
		
		$(".checkout-address .col-sm-6.address-right").toggleClass("border-address");
	
	});
	
	
	/*menu*/
	$("button.navbar-toggle").click(function() {
		
		$("button.navbar-toggle").toggleClass("navbar-toggle-close");
	
	});
	
	/*gallery*/
	
	$(".hover-view").click(function() {
		
		$(".gallery-back").toggleClass("gallery-back-show");
	
	});
    if($('.help-form').length > 0){
        $(".help-form").validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email:true
                },
                num: {
                    required: true,
                    number:true

                },
                subject: {
                    required: true
                },
                message: {
                    required: true
                }
            }


        });
    }

    if($("#form-shipping").length > 0){
        $("#form-shipping").validate({
            rules: {
                checkoutaddressname: {
                    required: true,
                    minlength:6
                },
                checkoutaddresslastname: {
                    required: true,
                    minlength:6
                },
                checkoutaddressphone: {
                    required: true,
                    number:true
                },
                checkoutaddressaddress1: {
                    required: true
                },
                checkoutaddressaddress2: {
                    required: true
                },
                checkoutaddresscity: {
                    required: true
                },
                checkoutaddressstate: {
                    required: true
                },
                checkoutaddressaddress2: {
                    required: true
                },
                checkoutaddressstate: {
                    required: true
                },
                checkoutaddresszipcode: {
                    required: true
                }
            },
            messages: {
                checkoutaddressname: {
                    minlength: 'Must be at least 6 characters.'
                },
                checkoutaddresslastname: {
                    minlength: 'Must be at least 6 characters.'
                }
            }


        });
    }

	if($("#bill-form") > 0){
        $("#bill-form").validate({
            rules: {
                same: {
                    required: true
                },
                yes: {
                    required: true
                }
            },
            messages: {
                checkoutaddressname: {
                    minlength: 'Must be at least 6 characters.'
                },
                checkoutaddresslastname: {
                    minlength: 'Must be at least 6 characters.'
                }

            }


        });
    }


	if($("#profile-form") > 0){
        $("#profile-form").validate({
            rules: {
                myprofileemail: {
                    required: true,
                    email:true
                },
                myprofilepassword: {
                    required: true,
                    minlength:6
                }
            },
            messages: {
                myprofileemail: {
                    minlength: 'Must be at least 6 characters.'
                },
                myprofilepassword: {
                    minlength: 'Must be at least 6 characters.'
                }

            }


        });
    }



    //Add menu separator
    $('nav.navbar .navbar-nav   li').not(':last-child').each(function(){

        $(this).append('<span class="back-s"></span>');
    });

    //Highlight collapsible panel title
    $('.panel-title a').click(function(){$(this).toggleClass('title-highlighted')});

});