/**
 * Created by Workstation on 2/14/2016.
 */
$(function(){
    var isLarge = false;
    var isMedium = false;
    var isSmall = false;
    var isExtraSmall = false;

    setDevice();
    setLayout();

    $(window).resize(function () {
        setDevice();
        setLayout();
    });

    function setDevice(){
        var viewportWidth = $(window).width();
        isLarge = (viewportWidth >= 1200);
        isMedium = (viewportWidth >= 993 && viewportWidth <= 1199);
        isSmall = (viewportWidth >= 768 && viewportWidth <= 992);
        isExtraSmall = (viewportWidth <= 767);
    }

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

    $(".navigation-toggle").click(function(){
        $("#navigation").slideToggle(200);
        $("#navigation").toggleClass("open");
    });

    var closed;
    var sticky;
    function setLayout(){
        console.log('set layout');

        if(isLarge || isMedium || isSmall){
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

            $("#navigation li .sf-mega").find("a").first().find("i").remove();
        }

        if(isExtraSmall){
            if(sticky != null){
                sticky.remove();
            }
            if(closed != null){
                closed.remove();
            }

            $('#navigation').superfish('destroy');

            $("#navigation li .sf-mega").find(".fa-angle-down").remove();
            $("#navigation li").each(function(){
                if($(this).find(".sf-mega").length){
                    if(!$(this).find("a").first().find(".fa-angle-down").length){
                        $(this).find("a").first().append("<i class='fa fa-angle-down'></i>");
                    }
                }
            });

            $(".toggle-nav").click(function(e) {
                e.preventDefault();
                $(".navigation").toggleClass("open");
                $(this).toggleClass("fa-arrow-left");
                $(this).toggleClass("fa-navicon");
            });

            $("nav.navigation .overlay").click(function(){
                console.log('aa');
                $(".toggle-nav").toggleClass("fa-arrow-left");
                $(".toggle-nav").toggleClass("fa-navicon");
                $(".navigation").removeClass("open");
            })

            $("#navigation > li > a").click(function(){
                if($(this).parent().hasClass('active')) {
                    $("#navigation > li").removeClass('active');
                    $("#navigation > li .sf-mega").slideUp().removeClass("open");
                }
                else{
                    $("#navigation > li").removeClass('active');
                    $("#navigation > li .sf-mega").slideUp().removeClass("open");

                    $(this).parent().addClass('active');
                    $(this).next('.sf-mega').slideDown().addClass("open");
                }
            });

            $(".mobile-search").click(function(){
                $(this).toggleClass("open");
                $(".search-wrapper").fadeToggle(150);
            });

            $('html').click(function() {
                $(".search-wrapper").fadeOut(150);
                $(".mobile-search").removeClass("open");
            });

            $('.header-section').click(function(event){
                event.stopPropagation();
            });
        }
        else if(isSmall){
            $('#navigation').superfish('destroy');
            $("#navigation").hide();

            $('html').click(function() {
                $(".level-1").html("").addClass("blank").css("width", "40px");;
                $(".level-2").html("").addClass("blank").css("width", "40px");;
                $("#navigation").slideUp(200);
                $(".search-wrapper").fadeOut(150);
            });

            $('.navigation').click(function(event){
                event.stopPropagation();
            });
        }
        else{
            $('#navigation').superfish({
                speed: 'fast',
                cssArrows: false,
                delay: 100
            });
            $("#navigation").removeClass("open").css("display", "block");
            $('html').unbind("click");
        }
    }


});