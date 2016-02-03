$(function(){
    var navigation = $('#navigation').superfish({
        speed: 'fast',
        cssArrows: false,
        delay: 200
    });

    $('.featured-image').find('img').each(function(){
        var imgClass = (this.width/this.height > 1) ? 'wide' : 'tall';
        $(this).addClass(imgClass);
    })

    //$('.featured-image').imagefill();

    $('.featured-image').each(function(i, counter){
        var image = $(this).data('featured');
        $(this).css('background', "url('"+image+"') center center");
        $(this).css('background-size', 'cover');
    })
});
