/**
 * Created by Workstation on 2/14/2016.
 */

// Resize event to check browser viewport
var wrapper = $("#wrapper");

$(window).resize(function () {
    setLayout();
});

function setLayout(){
    if($(window).height() < 450){
        $(".login-footer").fadeOut(300);
    }
    else{
        $(".login-footer").fadeIn(300);
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