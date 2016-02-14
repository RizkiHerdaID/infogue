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

    $('.bootstrap-tagsinput').focusin(function() {
        $(this).addClass('focus');
    });
    $('.bootstrap-tagsinput').focusout(function() {
        $(this).removeClass('focus');
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

    $("a[href='#']").click(function(e){
        e.preventDefault();

        if($(this).hasClass("reset-setting")){
            $("#website").val("InfoGue.id");
            $('#keywords').tagsinput('add', 'news');
            $('#keywords').tagsinput('add', 'technology');
            $('#keywords').tagsinput('add', 'science');
            $('#keywords').tagsinput('add', 'sport');
            $('#keywords').tagsinput('add', 'life');
            $('#keywords').tagsinput('add', 'health');
            $('#keywords').tagsinput('add', 'lifestyle');
            $('#keywords').tagsinput('add', 'entertainment');
            $("#online").prop("checked", true);
            $("#address").val("Avenue Street 23 Jakarta, Indonesia");
            $("#contact").val("+6285655479868");
            $("#email").val("anggadarkprince@gmail.com");
            $("#description").val("Public social news feeder");
            $("#owner").val("Angga Ari Wijaya");
            $("#latitude").val("0.34574576574");
            $("#longitude").val("0.45734573457");
            $("#facebook").val("angga.ari");
            $("#twitter").val("@anggadarkprince");
            $("#google").val("+AnggaAriWijaya");
            $("#article").prop("checked", true);
            $("#feedback").prop("checked", true);
            $("#member").prop("checked", true);
            $("#yes").prop("checked", true);
            $("#name").val("Adminisrtator");
        }
    });
});