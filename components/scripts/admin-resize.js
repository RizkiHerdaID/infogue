/**
 * Created by Workstation on 2/14/2016.
 */

// Resize event to check browser viewport
var wrapper = $("#wrapper");

setLayout(0);

$(window).resize(function () {
    setLayout(300);
});

function setLayout(duration){
    if($(window).height() < 450){
        $(".login-footer").fadeOut(duration);
    }
    else{
        $(".login-footer").fadeIn(duration);
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
}