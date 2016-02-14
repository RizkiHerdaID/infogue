/**
 * Created by Workstation on 2/14/2016.
 */

// Resize event to check browser viewport
var wrapper = $("#wrapper");

setLayout(0);
resizeContentWrapper();

$(window).resize(function () {
    setLayout(300);
});

$(".toggle-nav").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");

    if($(window).width() >=992){
        if(wrapper.hasClass('toggled')){
            $(".md-screen").fadeIn(300).css('display', 'table-cell');
        }
        else{
            $(".bar.sm-screen").fadeOut(300);
        }
    }

    resizeContentWrapper();
});

function setLayout(duration){
    if($(window).height() < 450){
        $(".login-footer").fadeOut(duration);
    }
    else{
        $(".login-footer").fadeIn(duration);
    }

    if($(window).width() <= 767){
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

    if($(window).width() >=768 && $(window).width() <=992){
        $(".bar.sm-screen").css('display', 'table-cell');
    }
    else{
        $(".bar.sm-screen").css('display', 'none');
    }
}

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
