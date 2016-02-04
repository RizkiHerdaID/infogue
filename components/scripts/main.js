$(function () {
    var navigation = $('#navigation').superfish({
        speed: 'fast',
        cssArrows: false,
        delay: 200
    });

    $('.featured-image').find('img').each(function () {
        var imgClass = (this.width / this.height > 1) ? 'wide' : 'tall';
        $(this).addClass(imgClass);
    })

    $('.featured-wrapper .featured-image').each(function (i, counter) {
        var image = $(this).data('featured');
        $(this).css('background', "url('" + image + "') center center");
        $(this).css('background-size', 'cover');
    })

    $('.rating-wrapper').each(function (i, counter) {
        var rating = $(this).data('rating');

        $(this).html("");

        for (var index = 0; index < 5; index++) {
            if (index < rating) {
                $(this).append("<i class='fa fa-circle rated'></i>")
            }
            else {
                $(this).append("<i class='fa fa-circle'></i>")
            }
        }
    });

    $(window).stellar();
});
