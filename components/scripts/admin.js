$(function () {
    console.log($(window).height());
    if($(window).height() < 450){
        $(".login-footer").hide();
    }
});