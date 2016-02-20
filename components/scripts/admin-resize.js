/**
 * Created by Workstation on 2/14/2016.
 */

$(function () {
    var isLarge = false;
    var isMedium = false;
    var isSmall = false;
    var isExtraSmall = false;

    var wrapper = $("#wrapper");

    setDevice();
    setLayout();
    resizeContentWrapper();
    resizeTable();

    $(window).resize(function () {
        setDevice();
        setLayout();
    });

    // GLOBAL LAYOUT --------------------------------------------------------------
    function setDevice(){
        var viewportWidth = $(window).width();
        isLarge = (viewportWidth >= 1200);
        isMedium = (viewportWidth >= 993 && viewportWidth <= 1199);
        isSmall = (viewportWidth >= 768 && viewportWidth <= 992);
        isExtraSmall = (viewportWidth <= 767);
    }

    function setLayout(){
        resizeTable();

        if($(window).height() < 450){
            $(".login-footer").fadeOut(300);
        }
        else{
            $(".login-footer").fadeIn(300);
        }

        if(isExtraSmall){
            if(!wrapper.hasClass('toggled')){
                wrapper.addClass('toggled');
                wrapper.find("#content-wrapper").removeAttr('style');
            }
        }
        else{
            if(wrapper.hasClass('toggled')){
                wrapper.removeClass('toggled');
            }
        }

        if(isSmall || isLarge){
            $(".bar.sm-screen").css('display', 'table-cell');
        }
        else{
            $(".bar.sm-screen").css('display', 'none');
        }
    }



    // NAVIGATION -----------------------------------------------------------------
    $(".toggle-nav").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");

        if(isMedium){
            if(wrapper.hasClass('toggled')){
                $(".md-screen").fadeIn(300).css('display', 'table-cell');
            }
            else{
                $(".bar.sm-screen").fadeOut(300);
            }
        }

        resizeContentWrapper();
    });

    $(".content").click(function(){
        if($(window).width() <= 767){
            if(!wrapper.hasClass('toggled')){
                wrapper.addClass('toggled');
                resizeContentWrapper();
            }
        }
    });


    function resizeContentWrapper(){
        if($(window).width() <= 767){
            if(!wrapper.hasClass('toggled')){
                wrapper.find("#content-wrapper").width($("#content-wrapper").width() + $("#sidebar-wrapper").width());
            }
            else{
                wrapper.find("#content-wrapper").removeAttr('style');
            }
        }
    }



    // TABLE ---------------------------------------------------------------------
    function resizeTable(){
        if(isSmall || isExtraSmall){
            var heading = $(".table > thead th").map(function(){
                var text = $.trim($(this).text()).toUpperCase();
                if(text == ''){
                    text = 'SELECT'
                }
                return text;
            }).get();

            $(".table tbody:not(.sub-table) td").find(".label-title").remove();
            $(".table tbody:not(.sub-table) tr").each(function(){
                for(var i = 0; i < heading.length; i++){
                    $(this).children().eq(i).prepend("<span class='label-title'>"+heading[i]+"</span>");
                }
            });

            // SUB TABLE
            var headingSub = $(".table > tbody.sub-table .sub-head th").map(function(){
                var text = $.trim($(this).text()).toUpperCase();
                if(text == ''){
                    text = 'ACTION'
                }
                return text;
            }).get();
            headingSub[0] = '';

            $(".table tbody.sub-table td").find(".label-title").remove();
            $(".table tbody.sub-table tr:not(.sub-head)").each(function(){
                for(var i = 0; i < heading.length; i++){
                    $(this).children().eq(i).prepend("<span class='label-title'>"+headingSub[i]+"</span>");
                }
            });
        }
        else{
            $(".table tbody:not(.sub-table) td").find(".label-title").remove();
            $(".table tbody.sub-table td").find(".label-title").remove();
        }

        if(isExtraSmall){
            $(".filter ul.dropdown-menu").removeClass("dropdown-menu-right").addClass("dropdown-menu-left");
        }
        else{
            $(".filter ul.dropdown-menu").removeClass("dropdown-menu-left").addClass("dropdown-menu-right");
        }
    }
});

