$(function () {

    // SMOOTH SCROLL---------------------------------------------------------------
    $(function () {
        $('a[href*="#"]:not([href="#"]):not([data-toggle="tab"]):not([data-toggle="collapse"])').click(function () {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });


    // STICKY HEADER---------------------------------------------------------------
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
                setTimeout(function () {
                    $(".header").removeClass("transition");
                    //console.log("remove transition when closed");
                }, 500);
            }
        },
        offset: -200
    });

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


    // NAVIGATION SUPERFISH -------------------------------------------------------
    var navigation = $('#navigation').superfish({
        speed: 'fast',
        cssArrows: false,
        delay: 100
    });


    // RATING ---------------------------------------------------------------------
    var rateMessage = ['WORST', 'BAD', 'GOOD', 'EXCELLENT', 'GREAT'];
    var lastMessage = $(".rating > .rate-message").text();

    renderRate();
    function renderRate() {
        $('.rating-wrapper').each(function () {
            var rating = $(this).data('rating');

            $(this).html("");

            for (var index = 0; index < 5; index++) {
                if (index < rating) {
                    $(this).append("<i class='fa fa-circle rated'></i>")
                }
                else {
                    $(this).append("<i class='fa fa-circle unrated'></i>")
                }
            }

            $(".rating > .rate-message").text(rateMessage[rating - 1]);
        });
    }

    $(".rating-wrapper.control i").click(function () {
        $(".rating-wrapper.control i")
            .removeClass('active')
            .removeClass('inactive');

        var rate = $(".rating-wrapper.control i").index($(this));
        $(".rating-wrapper.control i").removeClass('rated').removeClass('unrated');
        for (var i = 0; i < 5; i++) {
            if (i <= rate) {
                $(".rating-wrapper.control")
                    .children()
                    .eq(i)
                    .addClass('rated');
            }
            else {
                $(".rating-wrapper.control")
                    .children()
                    .eq(i)
                    .addClass('unrated');
            }
        }
        lastMessage = rateMessage[rate];
    });

    $(".rating-wrapper.control i").hover(function () {
        var rate = $(".rating-wrapper.control i").index($(this));
        for (var i = 0; i < 5; i++) {
            if (i <= rate) {
                $(".rating-wrapper.control")
                    .children()
                    .eq(i)
                    .addClass('active');
            }
            else {
                $(".rating-wrapper.control")
                    .children()
                    .eq(i)
                    .addClass('inactive');
            }
        }
        $(".rating > .rate-message").text(rateMessage[rate]);
    }, function () {
        $(".rating-wrapper.control i")
            .removeClass('active')
            .removeClass('inactive');
        $(".rating > .rate-message").text(lastMessage);
    });

    // PARALLAX EFFECT ------------------------------------------------------------
    $(window).stellar({responsive: false, horizontalScrolling: false});


    // EQUALIZE SOMETHING ---------------------------------------------------------
    $('.featured-list').equalize({equalize: 'height', children: '.featured-mini'});
    $('.articles').equalize({equalize: 'height', children: '.article-preview'});


    // FEATURED SLIDE SHOW --------------------------------------------------------
    var imagesFeatured = new Array();
    var position = 2;
    var tid;

    setLargeFeatured();

    $('.featured-mini img').each(function () {
        //console.log($(this).data("echo"));
        imagesFeatured.push($(this).data("echo"));
    });

    if (imagesFeatured.length > 0) {
        tid = setInterval(changeFeatured, 5000);
    }

    function changeFeatured() {
        if (imagesFeatured.length > 0) {
            setFeatured();

            position++;
            if (position > imagesFeatured.length) {
                position = 1;
            }
        }
    }

    function abortChangeFeatured() { // to be called when you want to stop the timer
        clearInterval(tid);
    }

    $(".slide").click(function () {
        position = $(".slide").index($(this)) + 1;
        changeFeatured();

        abortChangeFeatured();
        tid = setInterval(changeFeatured, 5000);
    });

    function setFeatured() {
        var imageSection = $(".featured-list div:nth-child(" + position + ")").find(".featured-mini");

        $(".featured-mini").removeClass("active");
        imageSection.addClass("active");

        var title = imageSection.find(".src-title").text();
        var category = imageSection.find(".src-category").text();
        var description = imageSection.find(".src-description").text();
        var image = imagesFeatured[position - 1];

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

    function setLargeFeatured() {
        var largeFeature = $('.featured-large .featured-image');
        var image = largeFeature.data('featured');

        largeFeature.css('opacity', 0);
        setTimeout(function () {
            largeFeature.css('opacity', 1);
        }, 300);

        largeFeature.css('content', ' ');
        largeFeature.css('background', "url('" + image + "') center center");
        largeFeature.css('background-size', 'cover');
    }


    // IMAGE LAZY LOADING ---------------------------------------------------------
    echo.init({
        offset: 50,
        throttle: 250,
        unload: false,
        callback: function (element, op) {
            //console.log(element, 'has been', op + 'ed')
            $(element).css('opacity', '0');

            setTimeout(function () {
                if (op === 'load') {
                    changeClass($(element));
                    $(element).addClass('transition');
                    $(element).css('opacity', '1');
                }
            }, 150);
        }
    });

    $(window).resize(function () {
        $(".featured-image").each(function () {
            changeClass($(this).find('img'));
        });
    });

    function changeClass(element) {
        var containerRatio = element.parent().width() / element.parent().height();
        var imageRatio = element.width() / element.height();

        var imgClass = (imageRatio > 1) ? 'wide' : 'tall';

        if (imgClass == 'wide') {
            if (containerRatio > imageRatio) {
                //console.log('change to tall');
                imgClass = 'tall';
            }
        }
        else {
            if (containerRatio < imageRatio) {
                //console.log('change to wide');
                imgClass = 'wide';
            }
        }

        element.removeClass('tall')
            .removeClass('wide')
            .addClass(imgClass);
    }


    // TO TOP ---------------------------------------------------------------------
    $('footer').waypoint(function () {
        if ($(document).height() > 1500) {
            $('.to-top').toggleClass('visible');
        }
    }, {offset: '140%'});


    // BROWSER UPGRADE ------------------------------------------------------------
    $('.browserupgrade').waypoint(function () {
        $('.browserupgrade').toggleClass('bottom');
    }, {offset: "30"});


    // NICE SCROLL ----------------------------------------------------------------
    $("html").niceScroll({
        cursorcolor: '#4dc4d2',
        cursorborder: 'none'
    });


    // STICKY STATIC NAV ----------------------------------------------------------
    if ($('.static-page').length) {
        var staticNav = new Waypoint({
            element: $('.static-nav'),
            handler: function () {
                $('.static-nav').toggleClass('sticky');
            },
            offset: 100
        });

        var topNavOffset = 0;

        var statisNavRelease = new Waypoint({
            element: $('.static-nav'),
            handler: function () {
                $('.static-nav').toggleClass('release');
                topNavOffset = $(window).scrollTop();
            },
            offset: -($('.static-page').height() - 500)
        })

        $(window).scroll(function () {
            if ($('.static-nav').hasClass('release')) {
                $('.static-nav').css('top', 40 - Math.abs(topNavOffset - $(window).scrollTop()));
            }
            else {
                topNavOffset = 0;
                $('.static-nav').removeAttr('style');
            }
        });
    }


    // ACCORDION ---------------------------------------------------------------------
    $("#accordion .panel-title a").click(function () {
        $("#accordion .panel-heading").removeClass('active');
        var heading = $(this).parent().parent();
        console.log(heading.attr('class'));
        if (heading.parent().find('.collapse.in').length) {
            heading.removeClass('active');
        }
        else {
            heading.addClass('active');
        }
    });

    // SUMMERNOTE -------------------------------------------------------------------
    if ($('.summernote').length) {
        $('.summernote').summernote({
            toolbar: [
                ['font', ['style']],
                ['style', ['bold', 'italic', 'underline']],
                ['para', ['ul', 'paragraph']],
                ['insert', ['picture', 'video', 'link']],
                ['misc', ['fullscreen']]
            ],
            placeholder: 'write here...',
            height: 200
        });
    }

    // FILE INPUT -------------------------------------------------------------------
    $('.file-input').change(function () {
        $(this).parent().find('.file-info').text($(this).val());
    });

});
