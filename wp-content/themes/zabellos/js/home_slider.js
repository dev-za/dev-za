$(function() {
    //var slideWidth = 984;
    var slideWidth = 938;

    //top slide
    $('li.slide:nth-child(2)').css('margin-top', -627);

    var shift = 0;
    var startPos = $('.home-slider-pagination').offset();

    $('.home-slider-pagination').draggable({
        axis: 'x',
        containment: '.slider-viewport',
        drag: function(event, ui){
            shift = ui.offset.left - startPos.left;

            //$('li.slide:nth-child(2)').css('margin-left', shift);
            console.log('shift', shift);
            var newWidth = slideWidth + shift;
            console.log('new width',  newWidth);
            $('li.slide:nth-child(2)').width(newWidth);
        }
    });
});