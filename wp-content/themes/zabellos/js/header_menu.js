//Add menu separator
$(document).reary(function(){
    $('nav.navbar .navbar-nav li').not(':last-child').each(function(){
        $(this).append('<span class="back-s"></span>');
    });
});
