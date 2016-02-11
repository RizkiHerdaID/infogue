$(function () {

    // Toggle script ------------------------------------------------------------------------
    $(".toggle-nav").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    // Resize event to check browser viewport ----------------------------------------------
    var wrapper = $("#wrapper");
    $(window).resize(function () {
        if($(window).height() < 450){
            $(".login-footer").hide();
        }

        if($(window).height() < 500){
            $(".copyright").css('position', 'relative');
        }

        if($(window).width() < 767){
            if(!wrapper.hasClass('toggled')){
                wrapper.addClass('toggled');
            }
        }
        else{
            if(wrapper.hasClass('toggled')){
                wrapper.removeClass('toggled');
            }
        }
    });

    $("html").niceScroll({
        cursorcolor: '#4dc4d2',
        cursorborder: 'none'
    });

    if($("#wrapper").height() < $(window).height()){
        $("#wrapper").css('position', 'absolute').css('height', '100%');
        $(".content").css('min-height', $(window).height() - $('header').height() - $('breadcrumb-wrapper').height() - 40 - 40);
    }

    $("#sidebar-wrapper").niceScroll({
        cursorcolor: '#4dc4d2',
        cursorborder: 'none'
    });

    $(".chart .fill").each(function(){
        $(this).height($(this).data('value'));
    });
});