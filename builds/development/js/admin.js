$(function () {

    // Toggle script ------------------------------------------------------------------------
    $("#menu-toggle").click(function(e) {
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

    $("#sidebar-wrapper").niceScroll({
        cursorcolor: '#4dc4d2',
        cursorborder: 'none'
    });
});