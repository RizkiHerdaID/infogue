/**
 * Created by Workstation on 2/14/2016.
 */
$(function(){
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
    function setDevice(){
        var viewportWidth = $(window).width();
        isLarge = (viewportWidth >= 1200);
        isMedium = (viewportWidth >= 993 && viewportWidth <= 1199);
        isSmall = (viewportWidth >= 768 && viewportWidth <= 992);
        isExtraSmall = (viewportWidth <= 767);
    }

    /**
     * Navigation & breadcrumb on desktop / medium / large device
     */
    function initMegaMenu(){
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
        if($("#navigation").hasClass("open")){
            $("#navigation").removeClass("open");
        }
    }

    function destroyMegaMenu(){
        $('#navigation').superfish('destroy');
    }


    /**
     * Navigation & breadcrumb on tablet / small device
     */
    function initSidebarMenu(){
        /**
         * slide effect when click on navigation toggle
         * animation duration 200ms and toggle class 'open' to set mark the navigation status
         */
        $(".navigation-toggle").click(function(){
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
        $('#navigation > li').hover(function(){
            var text = $(this).find("a").first().text();
            var wrapper = "<a href='#'>"+text+"</a>";
            $(".level-dummy").removeClass("blank");
            $(".level-dummy").html(wrapper);

            setTimeout(function(){
                $(".level-1").removeClass("blank");
                $(".level-1").html(wrapper);
                $(".level-1").css("width", $(".level-dummy").width());
            }, 0);
        }, function(){
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
        $('#navigation .sf-mega a').hover(function(){
            var wrapper = "<a href='#'>"+$(this).text()+"</a>";
            $(".level-dummy").removeClass("blank");
            $(".level-dummy").html(wrapper);

            setTimeout(function(){
                $(".level-2").removeClass("blank");
                $(".level-2").html(wrapper);
                $(".level-2").css("width", $(".level-dummy").width());
            }, 0);
        }, function(){
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
        $('html').click(function() {
            if(isSmall){
                $(".level-1").html("").addClass("blank").css("width", "40px");;
                $(".level-2").html("").addClass("blank").css("width", "40px");;
                $("#navigation").slideUp(200);
            }
        });

        /**
         * stop propagation on navigation wrapper
         * prevent event reach the root (html) as closed the navigation
         */
        $('.navigation').click(function(event){
            if(isSmall) {
                event.stopPropagation();
            }
        });
    }

    /**
     * Destroy navigation & breadcrumb on tablet / small device
     */
    function destroySidebarMenu(){
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
    function createRightArrow(){
        /**
         * make sure navigation is hidden, waiting for user click the navigation menu
         * by default it's hidden by css media query, but it's okay to recheck
         */
        $("#navigation").hide();

        /**
         * loop through navigation li
         * add icon arrow right on list which has sub menu
         */
        $("#navigation > li").each(function(){
            if($(this).find(".sf-mega").length){
                if(!$(this).find("a").first().find("i.fa-angle-right").length){
                    $(this).find("a").first().append("<i class='fa fa-angle-right'></i>");
                }
            }
        });
    }

    /**
     * remove right arrow on first level of navigation which has sub menu
     * make sure navigation is visible in case device turns into larger or smaller
     */
    function removeRightArrow(){
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
    function initSlideMenu(){
        /**
         * add toggle functionality to slide right (visible) and slide left (invisible)
         * change icon burger into arrow and reverse
         * put class status while navigation show up or hide
         */
        $(".toggle-nav").click(function(e) {
            e.preventDefault();
            $(".navigation").toggleClass("open");
            $(this).toggleClass("fa-arrow-left");
            $(this).toggleClass("fa-navicon");
        });

        /**
         * close slide navigation when user click overlay
         * reverse back navigation icon and adjust the status (remove 'open' class)
         */
        $("nav.navigation .overlay").click(function(){
            $(".toggle-nav").toggleClass("fa-arrow-left");
            $(".toggle-nav").toggleClass("fa-navicon");
            $(".navigation").removeClass("open");
        })

        /**
         * build a simple accordion to make nice slide effect on sub menu
         * check if one of li has open the close and open the another
         */
        $("#navigation > li > a").click(function(){
            if(isExtraSmall){
                if($(this).parent().hasClass('active')) {
                    $("#navigation > li").removeClass('active');
                    $("#navigation > li .sf-mega").stop(true).slideUp().removeClass("open");
                }
                else{
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
        $(".mobile-search").click(function(){
            $(this).toggleClass("active");
            $(".header-section > .search-wrapper").stop(true).fadeToggle(100);

            $(".user-dropdown").removeClass("active");
            $(".list-menu").stop(true).slideUp(100);

        });

        $(".user-dropdown").click(function(){
            $(this).toggleClass('active');
            $(this).next(".list-menu").stop(true).slideToggle(100);

            if(isExtraSmall){
                $(".mobile-search").removeClass("active");
                $(".header-section > .search-wrapper").stop(true).fadeOut(100);
            }
        });

        /**
         * close search box when click the outside of the search box itself
         * remove class open on button search toggle
         */
        $('html').click(function() {
            /**
             * hide search on mobile only, because on mobile search act like a drop down
             * remove active class too
             */
            if(isExtraSmall){
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
        $('.user-menu').click(function(event){
            event.stopPropagation();
        });
    }

    /**
     * destroy slide menu if necessary
     * unbind all events and remove arrow on first level menu which has sub menu
     */
    function destroySlideMenu(){
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
    function createDownArrow(){
        $(".mobile-search").removeClass("active");
        $(".header-section > .search-wrapper").hide();

        /**
         * loop through navigation li
         * add icon arrow down on list which has sub menu
         */
        $("#navigation > li").each(function(){
            if($(this).find(".sf-mega").length){
                if(!$(this).find("a").first().find("i.fa-angle-down").length){
                    $(this).find("a").first().append("<i class='fa fa-angle-down'></i>");
                }
            }
        });
    }

    /**
     * remove arrow on first level which has sub menu
     * this function called if device turns larger and make sure search wrapper is visible
     */
    function removeDownArrow(){
        $("#navigation > li > a").find("i.fa-angle-down").remove();
        $(".header-section > .search-wrapper").show();
    }


    /**
     * reposition and re-adjusting layout component like navigation based on device size
     * activate sticky header and reset navigation status
     */
    function setLayout(){
        // equalize the article preview height
        $('.articles, #articles').equalize({equalize: 'height', children: '.article-preview'});

        if(isLarge || isMedium || isSmall){
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
            if(closed == null){
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
            if(sticky == null){
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
        else{
            /**
             * disable closed navigation after scrolling on mobile
             * disable navigation sticky after scrolling because on mobile header will always be sticky
             */
            if(sticky !== undefined){
                sticky.destroy();
            }
            if(closed !== undefined){
                closed.destroy();
            }

            /**
             * disable parallax effect on mobile
             * reset background position
             */
            $(window).data('plugin_stellar').destroy();
            setTimeout(function(){
                $("div[data-stellar-background-ratio]").not(".reset").removeAttr("style");
            }, 50);
        }

        if(isLarge || isMedium){
            initMegaMenu();
            removeRightArrow();
            removeDownArrow();
        }
        else if(isSmall){
            destroyMegaMenu();
            createRightArrow();
            removeDownArrow();
        }
        else{
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
    setInterval(function(){
        if(isExtraSmall){
            if(counter++%2 == 0){
                $(".sidebar-profile .link-text").fadeOut(200);
                setTimeout(function(){
                    $(".sidebar-profile .btn").fadeIn(200);
                }, 500);
            }
            else{
                $(".sidebar-profile .btn").fadeOut(200);
                setTimeout(function(){
                    $(".sidebar-profile .link-text").fadeIn(200);
                }, 500);
            }
        }
    }, 4000);

});