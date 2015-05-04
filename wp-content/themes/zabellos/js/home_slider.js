$(document).ready(function() {
    var defaultSlideWidth = 938;
    var defaultSlideWidth = 627;
    var slideWidth = $('.home-content > .container').width();
    var homePaginationWidth = $('.home-paginations-a').width();
    $('li.slide').width(slideWidth);
    
    //top slide
    //AKA: а разве нельзя сделать определение ширины на которую нужно сместиться?
    $('li.slide:nth-child(2)').css('margin-top', -627);

    var shift = 0;
    var startPos = $('.home-slider-pagination').offset();

    $('.home-slider-pagination').draggable({
        axis: 'x',
        containment: '.slider-viewport',
        drag: function(event, ui){
            shift = ui.offset.left - startPos.left;
            var newWidth = slideWidth + shift + homePaginationWidth/2;
            $('li.slide:nth-child(2)').width(newWidth);
        }
    });
});
