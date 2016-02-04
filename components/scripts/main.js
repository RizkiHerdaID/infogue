$(function () {
    // STICKY HEADER
    var closed = new Waypoint({
        element: $("header"),
        handler: function () {
            if ($(".header.closed").length) {
                $(".header").addClass("transition");
                //console.log("add transition when closed");
            }
            $(".header").toggleClass('closed');
            //console.log(this.element.class + ' closed triggers at ' + this.triggerPoint)

            if (!$(".header.closed").length) {
                setTimeout(removeTransition, 500);
            }
        },
        offset: -200
    })

    var sticky = new Waypoint({
        element: $("header"),
        handler: function () {
            if ($(".header.closed").length) {
                $(".header").addClass("transition");
                //console.log("add transition when stickied");
            }
            $(".header").toggleClass('sticky');
            //console.log(this.element.class + ' triggers at ' + this.triggerPoint)
        },
        offset: -300
    });

    function removeTransition() {
        $(".header").removeClass("transition");
        //console.log("remove transition when closed");
    }

    // NAVIGATION
    var navigation = $('#navigation').superfish({
        speed: 'fast',
        cssArrows: false,
        delay: 200
    });

    // FILL IMAGE
    $('.featured-image').find('img').each(function () {
        var imgClass = (this.width / this.height > 1) ? 'wide' : 'tall';
        $(this).addClass(imgClass);
    })

    $('.featured-wrapper .featured-image').each(function (i, counter) {
        var image = $(this).data('featured');
        $(this).css('background', "url('" + image + "') center center");
        $(this).css('background-size', 'cover');
    })

    // RATING
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

    // PARALLAX EFFECT
    $(window).stellar({responsive: false});

    // IMAGE LAZY LOADING
    echo.init({
        offset: 100,
        throttle: 250,
        unload: false,
        callback: function (element, op) {
            //console.log(element, 'has been', op + 'ed')
        }
    });

    // EQUALIZE SOMETHING
    $('.featured-list').equalize({equalize: 'height', children: '.featured-mini'});
});
