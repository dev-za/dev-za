$(function() {
    var slideWidth = 984;

    $('.slidewrapper').width($('.slidewrapper').children().size()*slideWidth);

    var shift = 0;
    var startPos = $('.home-slider-pagination').offset();

    $('.home-slider-pagination').draggable({
        axis: 'x',
        containment: '.slider-viewport',
        drag: function(event, ui){
            shift = ui.offset.left - startPos.left;
            $('li.slide:first-child').css('margin-left', shift);
        }
    });
});