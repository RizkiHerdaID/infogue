$(function () {
    var websiteUrl = $('meta[name="url"]').attr('content');

    if ($('.newsletter').length) {
        setTimeout(function () {
            $('.newsletter').modal('show');
        }, 3000);
    }

    // SMOOTH SCROLL---------------------------------------------------------------
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




    // PARALLAX EFFECT ------------------------------------------------------------
    $(window).stellar({responsive: true, horizontalScrolling: false});


    // EQUALIZE SOMETHING ---------------------------------------------------------
    $('.featured-list').equalize({equalize: 'height', children: '.featured-mini'});


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
    function onElementHeightChange(elm, callback) {
        var lastHeight = elm.clientHeight, newHeight;
        (function run() {
            newHeight = elm.clientHeight;
            if (lastHeight != newHeight)
                callback();
            lastHeight = newHeight;

            if (elm.onElementHeightChangeTimer)
                clearTimeout(elm.onElementHeightChangeTimer);

            elm.onElementHeightChangeTimer = setTimeout(run, 200);
        })();
    }

    onElementHeightChange(document.body, function () {
        $('footer').waypoint(function () {
            if ($(document).height() > 2000) {
                $('.to-top').toggleClass('visible');
            }
        }, {offset: '140%'});
    });


    // BROWSER UPGRADE ------------------------------------------------------------
    $('.browserupgrade').waypoint(function () {
        $('.browserupgrade').toggleClass('bottom');
    }, {offset: "30"});


    // NICE SCROLL ----------------------------------------------------------------
    $("html").niceScroll({
        cursorcolor: '#4dc4d2',
        cursorborder: 'none'
    });

    /*
     $(".navigation").niceScroll({
     cursorcolor: '#6dd7e3',
     cursorborder: 'none',
     cursoropacitymax: 0,
     scrollspeed: 75,
     smoothscroll: false
     });


     $("#navigation").niceScroll({
     cursorcolor: '#6dd7e3',
     cursorborder: 'none',
     scrollspeed: 75,
     smoothscroll: false
     });
     */

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

    // CONVERSATION SCROLL ----------------------------------------------------------
    if ($(".message-box").length) {
        $(".message-box").scrollTop($(".message-box")[0].scrollHeight);
        $(".message-box").niceScroll({
            cursorcolor: '#4dc4d2',
            cursorborder: 'none'
        });
    }

    $("a[href='#']").click(function (e) {
        e.preventDefault();
    });

    // DROPDOWN
    $(".dropdown.select a").click(function () {
        var text = $(this).text() + " <span class='caret'></span>";
        $(this).closest(".dropdown").find("button.dropdown-toggle").html(text);
    });

    $(".dropdown.filter a").click(function () {
        var text = $(this).data('filter');
        $(".search-wrapper input[name='filter']").val(text);
    });

    // ARCHIVE FILTER
    var archive_base_url = $('section[data-href]').data('href');
    var archive_filter_url = "";

    var archive_filter = new Array();

    $('.data-filter .data .dropdown a').click(function () {
        var value = $(this).data('value');
        insert_query(new Array("data", value));
    });

    $(".data-filter .view .btn").click(function () {
        var value = $(this).find('input').val();
        insert_query(new Array("view", value));
    });

    $('.data-filter .sort .dropdown.by a').click(function () {
        var value = $(this).text().toLowerCase();
        insert_query(new Array("by", value));
    });

    $('.data-filter .sort .dropdown.method a').click(function () {
        var value = $(this).data('value');
        insert_query(new Array("sort", value));
    });

    function insert_query($query) {
        if (getQueryVariable('data')) {
            archive_filter.push(new Array('data', getQueryVariable('data')));
        }
        if (getQueryVariable('view')) {
            archive_filter.push(new Array('view', getQueryVariable('view')));
        }
        if (getQueryVariable('by')) {
            archive_filter.push(new Array('by', getQueryVariable('by')));
        }
        if (getQueryVariable('sort')) {
            archive_filter.push(new Array('sort', getQueryVariable('sort')));
        }

        for (var i = 0; i < archive_filter.length; i++) {
            if (archive_filter[i][0] == $query[0]) {
                archive_filter.splice(i, 1);
            }
        }
        archive_filter.push($query);

        filter_archive();
    }

    function getQueryVariable(variable) {
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++) {
            var pair = vars[i].split("=");
            if (pair[0] == variable) {
                return pair[1];
            }
        }
        return (false);
    }

    function filter_archive() {
        archive_filter_url = "?";
        for (var i = 0; i < archive_filter.length; i++) {
            if (i > 0) {
                archive_filter_url += '&';
            }
            archive_filter_url += (archive_filter[i][0] + "=" + archive_filter[i][1]);
        }

        window.location.replace(archive_base_url + archive_filter_url);
    }


    var isLarge = false;
    var isMedium = false;
    var isSmall = false;
    var isExtraSmall = false;

    var closed;
    var sticky;

    initSidebarMenu();
    initSlideMenu();

    setDevice();
    setLayout();

    $(window).resize(function () {
        setDevice();
        setLayout();
    });

    /**
     * recheck device width for update the variables
     */
    function setDevice() {
        var viewportWidth = $(window).width();
        isLarge = (viewportWidth >= 1200);
        isMedium = (viewportWidth >= 993 && viewportWidth <= 1199);
        isSmall = (viewportWidth >= 768 && viewportWidth <= 992);
        isExtraSmall = (viewportWidth <= 767);
    }

    /**
     * Navigation & breadcrumb on desktop / medium / large device
     */
    function initMegaMenu() {
        /**
         * init superfish plugin
         */
        $('#navigation').superfish({
            speed: 'fast',
            cssArrows: false,
            delay: 100
        });

        /**
         * make sure navigation is visible, in case it's invisible after table mode
         * if navigation is open on tablet mode then remove 'open' class
         */
        $("#navigation").show();
        if ($("#navigation").hasClass("open")) {
            $("#navigation").removeClass("open");
        }
    }

    function destroyMegaMenu() {
        $('#navigation').superfish('destroy');
    }


    /**
     * Navigation & breadcrumb on tablet / small device
     */
    function initSidebarMenu() {
        /**
         * slide effect when click on navigation toggle
         * animation duration 200ms and toggle class 'open' to set mark the navigation status
         */
        $(".navigation-toggle").click(function () {
            $("#navigation").stop(true).slideToggle(200);
            $("#navigation").toggleClass("open");
        });

        /**
         * Level 1 breadcrumb
         *
         * Mouse enter:
         * grab first level menu text and put it on breadcrumb dummy and remove 'blank' class
         * copy the same text on the fist level breadcrumb and set width based on dummy
         *
         * Mouse leave:
         * clear dummy content and set class with 'blank'
         * clear level 1 breadcrumb and set class with 'blank'
         */
        $('#navigation > li').hover(function () {
            var text = $(this).find("a").first().text();
            var wrapper = "<a href='#'>" + text + "</a>";
            $(".level-dummy").removeClass("blank");
            $(".level-dummy").html(wrapper);

            setTimeout(function () {
                $(".level-1").removeClass("blank");
                $(".level-1").html(wrapper);
                $(".level-1").css("width", $(".level-dummy").width());
            }, 0);
        }, function () {
            $(".level-dummy").addClass("blank");
            $(".level-dummy").html("");

            $(".level-1").addClass("blank");
            $(".level-1").html("");
            $(".level-1").css("width", "40px");
        });

        /**
         * Level 2 breadcrumb
         *
         * Mouse enter:
         * grab sub menu text after sidebar menu and put it on dummy breadcrumb stack
         * copy that into level 2 breadcrumb and set width based on dummy width
         *
         * Mouse leave:
         * clear dummy content and set 'blank' class
         * clear level-2 content and set 'blank' class
         */
        $('#navigation .sf-mega a').hover(function () {
            var wrapper = "<a href='#'>" + $(this).text() + "</a>";
            $(".level-dummy").removeClass("blank");
            $(".level-dummy").html(wrapper);

            setTimeout(function () {
                $(".level-2").removeClass("blank");
                $(".level-2").html(wrapper);
                $(".level-2").css("width", $(".level-dummy").width());
            }, 0);
        }, function () {
            $(".level-dummy").addClass("blank");
            $(".level-dummy").html("");

            $(".level-2").addClass("blank");
            $(".level-2").html("");
            $(".level-2").css("width", "40px");
        });

        /**
         * close navigation menu when user clicks outside the navigation itself
         * reset all navigation breadcrumb level
         */
        $('html').click(function () {
            if (isSmall) {
                $(".level-1").html("").addClass("blank").css("width", "40px");
                ;
                $(".level-2").html("").addClass("blank").css("width", "40px");
                ;
                $("#navigation").slideUp(200);
            }
        });

        /**
         * stop propagation on navigation wrapper
         * prevent event reach the root (html) as closed the navigation
         */
        $('.navigation').click(function (event) {
            if (isSmall) {
                event.stopPropagation();
            }
        });
    }

    /**
     * Destroy navigation & breadcrumb on tablet / small device
     */
    function destroySidebarMenu() {
        /**
         * remove all registered event for sidebar navigation
         */
        $(".navigation-toggle").unbind('click');
        $('#navigation > li').unbind('mouseenter mouseleave');
        $('#navigation .sf-mega a').unbind('mouseenter mouseleave');

        /**
         * remove right arrow after li
         */
        $("#navigation > li > a").find("i.fa-angle-right").remove();
        $("#navigation").show();
    }

    /**
     * add arrow on small device
     * make sure navigation is hidden
     */
    function createRightArrow() {
        /**
         * make sure navigation is hidden, waiting for user click the navigation menu
         * by default it's hidden by css media query, but it's okay to recheck
         */
        $("#navigation").hide();

        /**
         * loop through navigation li
         * add icon arrow right on list which has sub menu
         */
        $("#navigation > li").each(function () {
            if ($(this).find(".sf-mega").length) {
                if (!$(this).find("a").first().find("i.fa-angle-right").length) {
                    $(this).find("a").first().append("<i class='fa fa-angle-right'></i>");
                }
            }
        });
    }

    /**
     * remove right arrow on first level of navigation which has sub menu
     * make sure navigation is visible in case device turns into larger or smaller
     */
    function removeRightArrow() {
        /**
         * show first level menu
         * in case change size from small into medium / large (mega menu)
         */
        $("#navigation").show();

        /**
         * remove left arrow on sidebar menu
         * in case change size from small into extra small (slide menu) or medium / large (mega menu)
         */
        $("#navigation > li > a").find("i.fa-angle-right").remove();

    }

    /**
     * Slide navigation mobile / extra small device
     */
    function initSlideMenu() {
        /**
         * add toggle functionality to slide right (visible) and slide left (invisible)
         * change icon burger into arrow and reverse
         * put class status while navigation show up or hide
         */
        $(".toggle-nav").click(function (e) {
            e.preventDefault();
            $(".navigation").toggleClass("open");
            $(this).toggleClass("fa-arrow-left");
            $(this).toggleClass("fa-navicon");
        });

        /**
         * close slide navigation when user click overlay
         * reverse back navigation icon and adjust the status (remove 'open' class)
         */
        $("nav.navigation .overlay").click(function () {
            $(".toggle-nav").toggleClass("fa-arrow-left");
            $(".toggle-nav").toggleClass("fa-navicon");
            $(".navigation").removeClass("open");
        })

        /**
         * build a simple accordion to make nice slide effect on sub menu
         * check if one of li has open the close and open the another
         */
        $("#navigation > li > a").click(function () {
            if (isExtraSmall) {
                if ($(this).parent().hasClass('active')) {
                    $("#navigation > li").removeClass('active');
                    $("#navigation > li .sf-mega").stop(true).slideUp().removeClass("open");
                }
                else {
                    $("#navigation > li").removeClass('active');
                    $("#navigation > li .sf-mega").stop(true).slideUp().removeClass("open");

                    $(this).parent().addClass('active');
                    $(this).next('.sf-mega').stop(true).slideDown().addClass("open");
                }
            }
        });

        /**
         * make sure the navigation is visible
         * but still offset the browser viewport
         */
        $("#navigation").show();

        /**
         * some additional feature on mobile
         * add toggle search box
         */
        $(".mobile-search").click(function () {
            $(this).toggleClass("active");
            $(".header-section > .search-wrapper").stop(true).fadeToggle(100);

            $(".user-dropdown").removeClass("active");
            $(".list-menu").stop(true).slideUp(100);

        });

        $(".user-dropdown").click(function () {
            $(this).toggleClass('active');
            $(this).next(".list-menu").stop(true).slideToggle(100);

            if (isExtraSmall) {
                $(".mobile-search").removeClass("active");
                $(".header-section > .search-wrapper").stop(true).fadeOut(100);
            }
        });

        /**
         * close search box when click the outside of the search box itself
         * remove class open on button search toggle
         */
        $('html').click(function () {
            /**
             * hide search on mobile only, because on mobile search act like a drop down
             * remove active class too
             */
            if (isExtraSmall) {
                $(".mobile-search").removeClass("active");
                $(".header-section > .search-wrapper").stop(true).fadeOut(100);
            }

            $(".user-dropdown").removeClass("active");
            $(".list-menu").stop(true).slideUp(100);
        });

        /**
         * stop all events when click reach the header-section
         * it prevent to close the search box when user click the wrapper of search box
         * itself until click event reach the html tag and close it as function that we have defined before
         */
        $('.user-menu').click(function (event) {
            event.stopPropagation();
        });
    }

    /**
     * destroy slide menu if necessary
     * unbind all events and remove arrow on first level menu which has sub menu
     */
    function destroySlideMenu() {
        $("#navigation > li > a").find("i.fa-angle-down").remove();
        $("#navigation > li > a").unbind('click');
        $("nav.navigation .overlay").unbind('click');
        $(".toggle-nav").unbind('click');

        $(".mobile-search").unbind('click');
        $('.header-section').unbind('click');
        $("html").unbind('click');
    }

    /**
     * if device turns smaller add down arrow icon on first menu which has sub menu
     * reset search state of search on mobile
     */
    function createDownArrow() {
        $(".mobile-search").removeClass("active");
        $(".header-section > .search-wrapper").hide();

        /**
         * loop through navigation li
         * add icon arrow down on list which has sub menu
         */
        $("#navigation > li").each(function () {
            if ($(this).find(".sf-mega").length) {
                if (!$(this).find("a").first().find("i.fa-angle-down").length) {
                    $(this).find("a").first().append("<i class='fa fa-angle-down'></i>");
                }
            }
        });
    }

    /**
     * remove arrow on first level which has sub menu
     * this function called if device turns larger and make sure search wrapper is visible
     */
    function removeDownArrow() {
        $("#navigation > li > a").find("i.fa-angle-down").remove();
        $(".header-section > .search-wrapper").show();
    }


    /**
     * reposition and re-adjusting layout component like navigation based on device size
     * activate sticky header and reset navigation status
     */
    function setLayout() {
        // equalize the article preview height
        $('.articles, #articles').equalize({equalize: 'height', children: '.article-preview'});

        if (isLarge || isMedium || isSmall) {
            /**
             * create parallax effect on tablet and desktop mode
             * init stellar js
             */
            $(window).data('plugin_stellar').init();

            /**
             * init waypoint.js to check scroll offset at -200px
             * add class 'closed' to make header position fixed out of the screen by css
             * do not add transition first because css will make y-translation start from  top 0
             * add transition when it has 'closed' class after 500ms delay and header has moved out off the screen
             * then transition effect doesn't come up, just make header go away from the screen with fixed position
             */
            if (closed == null) {
                closed = new Waypoint({
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
            }

            /**
             * after -300px passing by from the top, add 'sticky' class to make header fixed at top 0
             * by 'transition' class so it will show up with nice y-translation effect
             * if it has 'closed' class make sure 'transition' keep stick with that
             * it's needed for make header go away with y-translation out of screen
             */
            if (sticky == null) {
                sticky = new Waypoint({
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
            }
        }
        else {
            /**
             * disable closed navigation after scrolling on mobile
             * disable navigation sticky after scrolling because on mobile header will always be sticky
             */
            if (sticky !== undefined) {
                sticky.destroy();
            }
            if (closed !== undefined) {
                closed.destroy();
            }

            /**
             * disable parallax effect on mobile
             * reset background position
             */
            $(window).data('plugin_stellar').destroy();
            setTimeout(function () {
                $("div[data-stellar-background-ratio]").not(".reset").removeAttr("style");
            }, 50);
        }

        if (isLarge || isMedium) {
            initMegaMenu();
            removeRightArrow();
            removeDownArrow();
        }
        else if (isSmall) {
            destroyMegaMenu();
            createRightArrow();
            removeDownArrow();
        }
        else {
            destroyMegaMenu();
            removeRightArrow();
            createDownArrow();
        }
    }

    /**
     * create fade away side by sde between text login and button create on mobile device
     * @type {number}
     */
    var counter = 0;
    setInterval(function () {
        if (isExtraSmall) {
            if (counter++ % 2 == 0) {
                $(".sidebar-profile .unauthorized:not(.logged-in) .link-text").fadeOut(200);
                setTimeout(function () {
                    $(".sidebar-profile .unauthorized:not(.logged-in) .btn").fadeIn(200);
                }, 500);
            }
            else {
                $(".sidebar-profile .unauthorized:not(.logged-in) .btn").fadeOut(200);
                setTimeout(function () {
                    $(".sidebar-profile .unauthorized:not(.logged-in) .link-text").fadeIn(200);
                }, 500);
            }
        }
    }, 4000);

    $("time.timeago").timeago();

    $('#search-contributor').equalize({equalize: 'height', children: '.contributor-profile'});

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var page = 1;
    var onLoading = false;
    var isEnded = false;
    var isFirst = true;

    if ($('.loading').length) {
        $('.loading').show();
        $('.btn-load-more').hide();

        if (isFirst) {
            loadContent();
        }

        $(window).scroll(function () {
            if ($(window).scrollTop() > $(document).height() - $(window).height() - 500 && !onLoading && !isEnded) {
                if (!$('#conversations').length) {
                    loadContent();
                }
            }
        });

        $('.btn-load-more').click(function (e) {
            e.preventDefault();
            loadContent();
        });
    }

    function loadContent() {
        onLoading = true;
        $('.loading').show();
        $('.btn-load-more').hide();
        generateContent()
    }

    function generateContent() {
        $.getJSON($("section[data-href]").data('href') + '?page=' + page, function (data) {
            onLoading = false;
            $('.loading').hide();
            $('.btn-load-more').show();

            if ($('#articles').length) {
                loadArticleCategory(data);
            }
            else if ($('#stream').length) {
                loadStream(data);
            }
            else if ($('#followers').length) {
                loadFollower(data);
            }
            else if ($('#messages').length) {
                loadMessage(data);
            }
            else if ($('#conversations').length) {
                loadConversation(data);
            }
        }).fail(function (jqxhr, textStatus, error) {
            if (jqxhr.status == 401) {
                showInfoUnauthorized(jqxhr.status);
            }
            else if (jqxhr.status == 401) {
                showInfoNotFound(jqxhr.status);
            }
        });
    }

    function loadArticleCategory(data) {
        if ($('#article-portrait-template').length && data.data.length > 0) {
            var template = $('#article-portrait-template').html();
            var html = Mustache.to_html(template, data);
            $('#articles').append(html);

            renderRate();

            echo.init();

            $('#articles').equalize({equalize: 'height', children: '.article-preview'});

            if (page == data.last_page) {
                $('.btn-load-more').text("END OF PAGE").addClass('disabled');
                isEnded = true;
            }
            else {
                page++;
            }
        }
        else {
            $('.btn-load-more').text("END OF PAGE").addClass('disabled');
            isEnded = true;
        }
    }

    function loadStream(data) {
        if ($('#article-landscape-template').length && data.data.length > 0) {
            var template = $('#article-landscape-template').html();
            var html = Mustache.to_html(template, data);
            $('#stream').append(html);

            renderRate();

            echo.init();

            if (page == data.last_page) {
                $('.btn-load-more').text("END OF STREAM").addClass('disabled');
                isEnded = true;
            }
            else {
                page++;
            }
        }
        else {
            if (data.total == 0) {
                $('#stream').html("<p class='text-center mtm'>It's lonely here, follow another Contributor to feed the stream</p>");
            }

            $('.btn-load-more').text("END OF STREAM").addClass('disabled');
            isEnded = true;
        }
    }

    function loadFollower(data) {
        if ($('#follower-row-template').length && data.data.length > 0) {
            var template = $('#follower-row-template').html();
            var html = Mustache.to_html(template, data);
            $('#followers').append(html);

            if ($('a[data-contributor-id]').length) {
                $('#followers').find('button[data-id="' + $('a[data-contributor-id]').data('contributor-id') + '"]').hide();
            }

            if (page == data.last_page) {
                $('.btn-load-more').text("END OF PAGE").addClass('disabled');
                isEnded = true;
            }
            else {
                page++;
            }
        }
        else {
            if (data.total == 0) {
                $('#followers').html("<p class='text-center mtm'>It's lonely here, follow another Contributor</p>");
            }

            $('.btn-load-more').text("END OF PAGE").addClass('disabled');
            isEnded = true;
        }
    }

    function loadMessage(data) {
        if ($('#message-row-template').length && data.data.length > 0) {
            var template = $('#message-row-template').html();
            var html = Mustache.to_html(template, data);
            $('#messages').append(html);
            $("time.timeago").timeago();

            if (page == data.last_page) {
                $('.btn-load-more').text("END OF MESSAGES").addClass('disabled');
                isEnded = true;
            }
            else {
                page++;
            }
        }
        else {
            if (data.total == 0) {
                $('#messages').html("<p class='text-center mtm'>It's lonely here, send message to another Contributor</p>");
            }

            $('.btn-load-more').text("END OF MESSAGES").addClass('disabled');
            isEnded = true;
        }
    }

    var firstScroll = true;
    var previousScrollHeightMinusTop = 0;
    var lastConversationId = '';
    var isCheckingNewConversation = false;

    function loadConversation(data) {
        if ($('#conversation-row-template').length && data.data.length > 0) {
            var template = $('#conversation-row-template').html();
            data.data.reverse();
            var html = Mustache.to_html(template, data);
            $('#conversations').prepend(html);
            $("time.timeago").timeago();
            lastConversationId = $('.conversation:last-child').data('id');

            if (firstScroll) {
                $(".message-box").scrollTop($(".message-box")[0].scrollHeight);
                firstScroll = false;
            }
            else {
                $(".message-box").scrollTop($(".message-box")[0].scrollHeight - previousScrollHeightMinusTop);
            }

            if (page == data.last_page) {
                $('.btn-load-more').text("END OF CONVERSATION").addClass('disabled');
                isEnded = true;
            }
            else {
                page++;
            }
        }
        else {
            if (data.total == 0) {
                $('#messages').html("<p class='text-center mtm'>It's lonely here, send message to another Contributor</p>");
            }

            $('.btn-load-more').text("END OF CONVERSATION").addClass('disabled');
            isEnded = true;
        }
    }

    if ($('#conversations').length) {
        if (isExtraSmall) {
            $('footer').hide();
        }
        $(".message-box").scroll(function () {
            previousScrollHeightMinusTop = $(".message-box")[0].scrollHeight - $(".message-box").scrollTop();

            if ($(".message-box").scrollTop() < 50 && !onLoading && !isEnded) {
                loadContent();
            }
        });

        setInterval(function () {
            if (!isCheckingNewConversation) {
                checkConversation();
            }
        }, 5000);
    }

    $('.btn-message').click(function () {
        var name = $(this).closest('.profile').find('h2.name').text();
        $('#send-message').find('.message-to').text(name);
    });

    // AJAX SEND MESSAGE
    $('#form-message').on('submit', (function (e) {
        e.preventDefault();
        var formData = new FormData(this);

        $("#message").attr('readonly', '');
        $("#attachment").attr('disabled', 'true');
        $(".btn-send").attr('disabled', 'true');

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function () {
                console.log("message sent");
                $("#message").removeAttr('readonly').val('');
                $("#attachment").removeAttr('disabled').val('');
                $(".btn-send").removeAttr('disabled');
                if (!isCheckingNewConversation) {
                    checkConversation();
                }
            },
            error: function () {
                $("#message").removeAttr('readonly').val('');
                $("#attachment").removeAttr('disabled').val('');
                $(".btn-send").removeAttr('disabled');
                console.log("send message is failed");
            }
        });
    }));

    function checkConversation() {
        isCheckingNewConversation = true;
        $.getJSON($("section[data-href]").data('href') + '?last=' + lastConversationId, function (data) {
            if ($('#conversation-row-template').length && data.data.length > 0) {
                var template = $('#conversation-row-template').html();
                data.data.reverse();
                var html = Mustache.to_html(template, data);
                $('#conversations').append(html);
                $("time.timeago").timeago();
                $(".message-box").scrollTop($(".message-box")[0].scrollHeight);
                lastConversationId = $('.conversation:last-child').data('id');
            }
            isCheckingNewConversation = false;
        });
    }

    /*
     * --------------------------------------------------------------------------
     * Following Action
     * --------------------------------------------------------------------------
     * Async following request passing follower and following id, change
     * the button state and proceed the response.
     */

    $(document).on("click", ".btn-follow", function (e) {
        e.preventDefault();

        var contributor_id = $(this).data("id");
        var button = $(this);

        unfollowState(button);

        $.ajax({
            type: "POST",
            url: websiteUrl + "/account/follow",
            data: {id: contributor_id},
            success: function (data) {
                if (data == "failed") {
                    followState(button);
                    showInfo('UNFOLLOW FAILED', 'We apologize, please try again', 'Maybe traffic on our serve or you lost the internet connection');
                }
                else if (data == "restrict") {
                    followState(button);
                    showInfoUnauthorized(xhr.status.status);
                }
            },
            error: function (e) {
                followState(button);
            },
            statusCode: {
                401: function (xhr) {
                    showInfoUnauthorized(xhr.status);
                },
                404: function (xhr) {
                    showInfoNotFound(xhr.status);
                },
            }
        });
    });

    $(document).on("click", ".btn-unfollow", function (e) {
        e.preventDefault();

        var contributor_id = $(this).data("id");
        var button = $(this);

        followState(button);

        $.ajax({
            type: "POST",
            url: websiteUrl + "/account/unfollow/" + contributor_id,
            data: {id: contributor_id, _method: "delete"},
            success: function (data) {
                if (data == "failed") {
                    unfollowState(button);
                    showInfo('UNFOLLOW FAILED', 'We apologize, please try again', 'Maybe traffic or connection of internet');
                }
                else if (data == "restrict") {
                    unfollowState(button);
                    showInfoUnauthorized(xhr.status.status);
                }
            },
            error: function (e) {
                unfollowState(button);
            },
            statusCode: {
                401: function (xhr) {
                    showInfoUnauthorized(xhr.status);
                },
                404: function (xhr) {
                    showInfoNotFound(xhr.status);
                },
            }
        });
    });

    function showInfoUnauthorized(code) {
        showInfo(code + ' UNAUTHORIZED', 'You don\'t have authorization to do this action', 'Please Login <a href="http://localhost:8000/auth/login">here</a> or <a href="http://localhost:8000/auth/register">register</a>');
    }

    function showInfoNotFound(code) {
        showInfo(code + ' PAGE NOT FOUND', 'Something is getting wrong', 'Please contact out administrator');
    }

    function unfollowState(button) {
        button.text('UNFOLLOW');
        button.removeClass('btn-follow').addClass('active');
        button.addClass('btn-unfollow');
    }

    function followState(button) {
        button.text('FOLLOW');
        button.removeClass('btn-unfollow').removeClass('active');
        button.addClass('btn-follow');
    }

    function showInfo(title, message, submessage) {
        $("#modal-info .modal-title").html(title);
        $("#modal-info .modal-message").html(message);
        $("#modal-info .modal-submessage").html(submessage);
        $("#modal-info").modal("show");
    }


    /*
     * --------------------------------------------------------------------------
     * Form Function
     * --------------------------------------------------------------------------
     * Form action function including delete, share the article, populate data
     * into update form wrapper, retrieve ajax select data, generate slug,
     * provide ahead data like tags.
     */

    $(document).on("click", ".btn-delete", function () {
        var modal = $('#modal-delete');
        var id = $(this).closest('*[data-id]').data('id');
        var title = $(this).data('label');
        var url = modal.find('form').data('url') + '/' + id;

        if ($(this).hasClass('delete-message')) {
            var sender = $(this).closest('*[data-id]').data('sender');
            modal.find('input[name="sender"]').val(sender);
            modal.find('input[name="contributor"]').val(title);
        }

        modal.find('form').attr('action', url);
        modal.find('form .delete-title').text(title);
    });

    $('.btn-share').click(function () {
        var modal = $('#modal-share');
        var url = $(this).closest('*[data-id]').data('url');

        modal.find('.copy-url').val(url);
        modal.find('.facebook').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + url);
        modal.find('.twitter').attr('href', 'https://www.twitter.com/home?status=' + url);
        modal.find('.googleplus').attr('href', 'https://plus.google.com/share?url=' + url);
    });

    $('.btn-draft').click(function () {
        var id = $(this).closest('*[data-id]').data('id');
        var url = $('#form-draft').data('url') + '/' + id;

        $('#form-draft').attr('action', url);
        $('#form-draft').submit();
    });

    $('select[name="category"]').change(function () {
        var url = websiteUrl + "/account/article/subcategory/" + $(this).val();
        var category = $('select[name="category"] option:selected').text();

        loadingSelect($('select[name="subcategory"]'));

        $.getJSON(url, function (data) {
            var output = '<option value="">' + category + ' Subcategory</option>';
            var label = '';
            var isFirst = true;
            $.each(data, function (i, row) {
                if (row.label != label) {
                    if (!isFirst) {
                        output += '</optgroup>';
                    }
                    isFirst = false;
                    label = row.label;
                    output += '<optgroup label="' + row.label + '">';
                }
                output += "<option value='" + row.id + "'>" + row.subcategory + "</option>";
                if (data == data.length - 1) {
                    output += '</optgroup>';
                }
            });
            completeSelect($('select[name="subcategory"]'));
            $('select[name="subcategory"]').html(output);
        });
    });

    function loadingSelect($tag) {
        $tag.attr('disabled', '');
        $tag.html('<option value="loading">Please Wait...</option>');
    }

    function completeSelect($tag) {
        $tag.removeAttr('disabled');
        $tag.find('option[value="loading"]').remove();
    }

    function createSlug(str) {
        var $slug;
        var trimmed = $.trim(str);
        $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
            replace(/-+/g, '-').
            replace(/^-|-$/g, '');
        return $slug.toLowerCase();
    }

    $("#title").keyup(function () {
        if (!$("#slug").hasClass('changed')) {
            $("#slug").val(createSlug($(this).val()));
        }
    });

    if ($("#slug").length) {
        $("#slug").keyup(function () {
            if ($("#title").val() != '') {
                $(this).addClass('changed');
            }
        });
    }

    if ($('.bootstrap-tagsinput input').length) {
        var tags = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: websiteUrl + '/account/article/tags'
        });

        $('.bootstrap-tagsinput input').typeahead(null, {
            name: 'slug',
            source: tags
        });
    }


    /*
     * --------------------------------------------------------------------------
     * Article Function
     * --------------------------------------------------------------------------
     * This function list including rating function like render data-rating into
     * visual icon, hover rating function, sending rating into server and
     * incrementing number of article view.
     */

    if ($('.single-view[data-id]').length) {
        var article_id = $('.single-view[data-id]').data('id');
        setTimeout(function () {
            $.ajax({
                type: "POST",
                url: websiteUrl + "/article/hit",
                data: {id: article_id},
                success: function (data) {
                    console.log('This article hit at ' + data);
                },
                error: function (e) {
                    console.log(e.toString());
                }
            });
        }, 15000);
    }

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
        });
    }

    $(".rating-wrapper.control i").click(function () {
        $(".rating-wrapper.control i")
            .removeClass('active')
            .removeClass('inactive');

        var rate = $(".rating-wrapper.control i").index($(this));
        $(".rating-wrapper.control i")
            .removeClass('rated')
            .removeClass('unrated');

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

        var article_id = $('.single-view[data-id]').data('id');

        sendRate(article_id, rate + 1);
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

    function sendRate(article_id, rate) {
        $.ajax({
            type: "POST",
            url: "http://localhost:8000/article/rate",
            data: {article_id: article_id, rate: rate},
            success: function (data) {
                console.log('Article rate avg is ' + data);
            },
            error: function (e) {
                console.log(e.toString());
            }
        });
    }

    /*
     * --------------------------------------------------------------------------
     * Form Validation
     * --------------------------------------------------------------------------
     * Set validation of basic form, including, register, login, reset, setting,
     * create/edit article and contact form. Set default configuration so it
     * will fits on bootstrap form semantic.
     */

    $.validator.setDefaults({
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });

    $.validator.addMethod("checkTags", function (value) {
        return ($(".bootstrap-tagsinput").find(".tag").length > 0);
    }, "Tags are required.");

    $.validator.addMethod("alphaDash", function (value, element) {
        return this.optional(element) || /^[a-z0-9\-_]+$/i.test(value);
    }, "This field must contain only letters, numbers, underscore or dashes.");

    $("#form-contact").validate({
        messages: {
            name: {
                required: "Name is required",
                maxlength: "Name max length is {0} characters",
            },
            email: {
                required: "Email is required",
                maxlength: "Email max length is {0} characters",
            },
            message: {
                required: "Message is required",
                maxlength: "Message max length is {0} characters",
            },
        }
    });

    $("#form-register").validate({
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
            $('#agree-error').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
            $('#agree-error').removeClass('has-error');
        },
        errorPlacement: function (error, element) {
            if (element.attr("id") == "agree") {
                $('#agree-error').html(error);
            } else {
                error.insertAfter(element);
            }
        },
        rules: {
            username: {
                alphaDash: true,
            },
            "password": {
                minlength: 6,
                maxlength: 20
            },
            "password_confirmation": {
                minlength: 6,
                maxlength: 20,
                equalTo: "#password"
            }
        },
        messages: {
            email: {
                required: "Email is required",
                maxlength: "Email max length is {0} characters.",
            },
            username: {
                required: "Username is required",
                maxlength: "Username max length is {0} characters.",
            },
            password: {
                required: "Password is required",
                maxlength: "Password max length is {0} characters.",
            },
            password_confirmation: {
                required: "Confirm password is required.",
                equalTo: "Type the same value as password."
            },
            agree: "You must agree with terms and condition.",
        }
    });

    $("#form-login").validate({
        messages: {
            username: {
                required: "Username is required.",
            },
            password: {
                required: "Password is required.",
            },
        }
    });

    $("#form-reset").validate({
        messages: {
            email: {
                required: "Email is required.",
            },
            password: {
                required: "Password is required.",
                maxlength: "Password max length is {0} characters.",
            },
            password_confirmation: {
                required: "Confirm password is required.",
                equalTo: "Type the same value as password."
            },
        }
    });

    $("#form-setting").validate({
        groups: {
            birthday: "date month year"
        },
        errorPlacement: function (error, element) {
            if (element.attr("id") == "date" || element.attr("id") == "month" || element.attr("id") == "year") {
                element.closest('div').append(error);
            } else {
                error.insertAfter(element);
            }
        },
        rules: {
            username: {
                alphaDash: true,
            },
            new_password: {
                minlength: 6,
                maxlength: 20
            },
            new_password_confirmation: {
                minlength: 6,
                maxlength: 20,
                equalTo: "#new_password"
            }
        },
        messages: {
            name: {
                required: "Name is required",
                maxlength: "Name max length is {0} characters.",
            },
            contact: {
                required: "Contact is required",
                maxlength: "Contact max length is {0} characters.",
            },
            about: {
                required: "About is required",
                maxlength: "About max length is {0} characters.",
            },
            username: {
                required: "Username is required",
                maxlength: "Username max length is {0} characters.",
            },
            email: {
                required: "Email is required",
                maxlength: "Email max length is {0} characters.",
            },
            location: {
                required: "Location is required",
                maxlength: "Location max length is {0} characters.",
            },
            date: "Please complete the birthday.",
            month: "Please complete the birthday.",
            year: "Please complete the birthday.",
            password: {
                required: "Password is required",
                maxlength: "Password max length is {0} characters.",
            },
        }
    });
});