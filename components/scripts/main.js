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

    // FEATURED SLIDE SHOW
    var tid = setInterval(changeFeatured, 2000);

    var imagesFeatured = new Array();
    var position = 1;

    $('.featured-mini .featured-image').each(function (i, counter) {
        imagesFeatured.push($(this).data("featured"));
    });

    $(".slide").click(function(){
        position = $(".slide").index($(this)) + 1;
        console.log(position);
        setFeatured();
    });

    function setFeatured(){
        $(".featured-mini").removeClass("active");
        var imageSection = $(".featured-list div:nth-child("+position+")").find(".featured-mini");
        imageSection.addClass("active");

        var title = imageSection.find(".src-title").text();
        var category = imageSection.find(".src-category").text();
        var description = imageSection.find(".src-description").text();

        //console.log("change "+position);
        //console.log("title "+imageSection.find(".src-title").text());
        //console.log("category "+imageSection.find(".src-category").text());
        //console.log("description "+imageSection.find(".src-description").text());

        $(".slide-title").text(title);
        $(".slide-category").text(category);
        $(".slide-description").text(description);
    }

    function changeFeatured() {
        if(imagesFeatured.length > 0){
            setFeatured();

            position++;
            if(position > imagesFeatured.length){
                position = 1;
            }
        }
    }

    function abortChangeFeatured() { // to be called when you want to stop the timer
        clearInterval(tid);
    }

});
