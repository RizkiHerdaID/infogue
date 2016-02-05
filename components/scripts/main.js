$(function () {

    // SMOOTH SCROLL
    $(function() {
        $('a[href*="#"]:not([href="#"])').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });

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

    // EQUALIZE SOMETHING
    $('.featured-list').equalize({equalize: 'height', children: '.featured-mini'});

    // INIT FEATURED
    setLargeFeatured();

    // FEATURED SLIDE SHOW
    var imagesFeatured = new Array();
    var position = 2;
    var tid;

    $('.featured-mini img').each(function () {
        //console.log($(this).data("echo"));
        imagesFeatured.push($(this).data("echo"));
    });

    if(imagesFeatured.length > 0){
        tid = setInterval(changeFeatured, 4000);
    }

    $(".slide").click(function(){
        position = $(".slide").index($(this)) + 1;
        console.log(position);
        setFeatured();
    });

    function setFeatured(){
        var imageSection = $(".featured-list div:nth-child("+position+")").find(".featured-mini");

        $(".featured-mini").removeClass("active");
        imageSection.addClass("active");

        var title = imageSection.find(".src-title").text();
        var category = imageSection.find(".src-category").text();
        var description = imageSection.find(".src-description").text();
        var image = imagesFeatured[position-1];

        //console.log("change "+position);
        //console.log("title "+imageSection.find(".src-title").text());
        //console.log("category "+imageSection.find(".src-category").text());
        //console.log("description "+imageSection.find(".src-description").text());

        $(".slide-title").text(title);
        $(".slide-category").text(category);
        $(".slide-description").text(description);
        $('.featured-large .featured-image').data("featured", image);

        setLargeFeatured();
    }

    function setLargeFeatured(){
        var largeFeature = $('.featured-large .featured-image').fadeIn();
        var image = largeFeature.data('featured');

        largeFeature.css('background', "url('" + image + "') center center");
        largeFeature.css('background-size', 'cover');
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

    // IMAGE LAZY LOADING
    echo.init({
        offset: 100,
        throttle: 250,
        unload: false,
        callback: function (element, op) {
            //console.log(element, 'has been', op + 'ed')
            setTimeout(function(){
                var imgClass = (element.width / element.height > 1) ? 'wide' : 'tall';
                //console.log(element.width+"  "+element.height +"  "+element.src+"  "+imgClass);
                $(element).addClass(imgClass);
            }, 50);
        }
    });

    // TO TOP
    $('footer').waypoint(function() {
        $('.to-top').toggleClass('visible');
    }, { offset: '140%' });

});
