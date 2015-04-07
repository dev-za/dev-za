$(function() {
    var slideWidth = 984;

    $('li.slide:nth-child(2)').css('margin-top', -658);
    var shift = 0;
    var startPos = $('.home-slider-pagination').offset();

    $('.home-slider-pagination').draggable({
        axis: 'x',
        containment: '.slider-viewport',
        drag: function(event, ui){
            shift = ui.offset.left - startPos.left;
            $('li.slide:nth-child(2)').css('margin-left', shift);
        }
    });
});