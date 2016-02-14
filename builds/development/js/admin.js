$(function () {
    $("html").niceScroll({
        cursorcolor: '#4dc4d2',
        cursorborder: 'none',
        horizrailenabled: false
    });

    $(".modal").niceScroll({
        cursorcolor: '#4dc4d2',
        cursorborder: 'none'
    });

    if($("#wrapper").height() < $(window).height()){
        $("#wrapper").css('position', 'absolute').css('height', '100%').css('width', '100%');
        $(".content").css('min-height', $(window).height() - $('header').height() - $('breadcrumb-wrapper').height() - 40 - 40);
    }

    $("#sidebar-wrapper").niceScroll({
        cursorcolor: '#4dc4d2',
        cursorborder: 'none'
    });

    $(".chart .fill").each(function(){
        $(this).height($(this).data('value'));
    });

    $("tbody .css-checkbox").change(function(){
        if($(this).is(':checked')){
            $(this).closest("tr").addClass('success');
        }
        else{
            $(this).closest("tr").removeClass('success');
        }
        checkboxs_check();
    });

    $('.group-control').hide();
    $("thead .css-checkbox").change(function(){
        if($(this).is(':checked')){
            $("tbody .css-checkbox").prop('checked', true);
            $("tbody").find("tr").addClass('success');
        }
        else{
            $("tbody .css-checkbox").prop('checked', false);
            $("tbody").find("tr").removeClass('success');
        }
        checkboxs_check();
    });

    function checkboxs_check(){
        var isChecked = false;
        $("tbody .css-checkbox").each(function(){
            if($(this).is(':checked')){
                isChecked = true;
            }
        });

        if(isChecked){
            $('.group-control').fadeIn(200);
        }
        else{
            $('.group-control').fadeOut(200);
        }
    }

    $(".dropdown.select a").click(function(e){
        e.preventDefault();
        var text = $(this).text().toUpperCase()+" <span class='caret'></span>";
        $(this).closest(".dropdown").find("button.dropdown-toggle").html(text);
    });

    // RATING ------------------------------------------------------------------------
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


    // APPROVE
    $(".approve").click(function(e){
        e.preventDefault();
        $(this).closest("tr").find(".label")
            .removeClass()
            .addClass("label")
            .addClass("label-success")
            .text("PUBLISHED");
    });
    $(".suspend").click(function(e){
        e.preventDefault();
        $(this).closest("tr").find(".label")
            .removeClass()
            .addClass("label")
            .addClass("label-danger")
            .text("SUSPEND");
    });

    // HEADLINE & TRENDING FUNCTIONALITY ---------------------------------
    $(".headline").click(function(e){
        e.preventDefault();
        var row = $(this).closest("tr");
        row.removeClass('warning');
        row.toggleClass('danger');
        if(row.hasClass('danger')){
            $(this).html("<i class='fa fa-star'></i> Remove Headline");
            $(this).closest("ul").find(".trending").html("<i class='fa fa-trophy'></i> Trending</a>");
        }
        else{
            $(this).html("<i class='fa fa-star'></i> Headline");
        }
    });

    $(".trending").click(function(e){
        e.preventDefault();
        var row = $(this).closest("tr");
        row.removeClass('danger');
        row.toggleClass('warning');
        if(row.hasClass('warning')){
            $(this).html("<i class='fa fa-trophy'></i> Remove Trending");
            $(this).closest("ul").find(".headline").html("<i class='fa fa-star'></i> Headline");
        }
        else{
            $(this).html("<i class='fa fa-trophy'></i> Trending</a>");
        }
    });


    // SUMMERNOTE -------------------------------------------------------------------
    if ($('.summernote').length) {
        $('.summernote').summernote({
            toolbar: [
                ['font', ['style']],
                ['style', ['bold', 'italic', 'underline']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['picture', 'video', 'link']],
                ['misc', ['fullscreen']]
            ],
            placeholder: 'write here...',
            height: 200
        });

        $(".note-group-select-from-files").find(".note-image-input").remove();
        var inputFile = "<div class='css-file'>" +
            "<span class='file-info'>No file selected</span>" +
            "<button class='btn btn-primary' type='button'>SELECT<span class='hidden-xs'> IMAGE</span></button>" +
            "<input type='file' class='file-input note-image-input form-control' name='files' accept='image/*' multiple='multiple'/>" +
            "</div>";
        $(".note-group-select-from-files").append(inputFile);

        $(".link-dialog .checkbox").remove();
        var inputCheckbox = "<div class='checkbox'>" +
            "<input type='checkbox' name='link' id='link' class='css-checkbox' checked>" +
            "<label for='link' class='css-label'>Open in new window</label>" +
            "</div>";
        $(".link-dialog .modal-body").append(inputCheckbox);

        setTimeout(function(){
            $(".note-btn.btn-fullscreen").tooltip('show');
        }, 1000);
    }
});
/**
 * Created by Workstation on 2/14/2016.
 */

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

    if(isSmall){
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

    if($(window).width() >= 992){
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
        var heading = $(".table th").map(function(){
            var text = $.trim($(this).text()).toUpperCase();
            if(text == ''){
                text = 'SELECT'
            }
            return text;
        }).get();

        $(".table tbody td").find(".label-title").remove();
        $(".table tbody tr").each(function(){
            for(var i = 0; i < heading.length; i++){
                $(this).children().eq(i).prepend("<span class='label-title'>"+heading[i]+"</span>");
            }
        });
    }
    else{
        $(".table tbody td").find(".label-title").remove();
    }

    if(isExtraSmall){
        $(".filter ul.dropdown-menu").removeClass("dropdown-menu-right").addClass("dropdown-menu-left");
    }
    else{
        $(".filter ul.dropdown-menu").removeClass("dropdown-menu-left").addClass("dropdown-menu-right");
    }

    //$("tr").find(".dropdown").removeClass("dropup");
    //$("tr:last-child").find(".dropdown").addClass("dropup");
}
