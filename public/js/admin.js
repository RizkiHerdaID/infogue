$(function () {
    var websiteUrl = $('meta[name="url"]').attr('content');
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
            $(this).closest("tbody").next(".sub-table").find(".css-checkbox").prop('checked', true);
            $(this).closest("tbody").next(".sub-table").find("tr").addClass('success');
        }
        else{
            $(this).closest("tr").removeClass('success');
            $(this).closest("tbody").next(".sub-table").find(".css-checkbox").prop('checked', false);
            $(this).closest("tbody").next(".sub-table").find("tr").removeClass('success');
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

    $('.filter .dropdown.data a').click(function(){
        var value = $(this).text().toLowerCase();
        if($(this).data('value') != null){
            var value = $(this).data('value');
        }
        filterData('data', (value == 'all data') ? 'all' : value);
    });

    $('.filter .dropdown.status a').click(function(){
        var value = $(this).text().toLowerCase();
        filterData('status', (value == 'all status') ? 'all' : value);
    });

    $('.filter .dropdown.by a').click(function(){
        var value = $(this).text().toLowerCase();
        filterData('by', value);
    });

    $('.filter .dropdown.method a').click(function(){
        var value = $(this).text().toLowerCase();
        filterData('sort', (value=='ascending') ? 'asc' : 'desc');
    });

    function filterData(key, value){
        var url = window.location.origin + window.location.pathname;
        var query = window.location.search.substring(1);
        var newQuery = '?';
        var vars = query.split("&").clean('');
        var isNewQuery = true;
        for (var i=0; i < vars.length; i++) {
            var pair = vars[i].split("=");
            if(pair[0] == key){
                vars[i] = key+"="+value;
                isNewQuery = false;
            }
            if(pair[0] == 'page'){
                vars.splice(i, 1);
            }
        }

        if(isNewQuery){
            vars.push(key+"="+value);
        }

        for (var i=0; i < vars.length; i++) {
            if(i > 0){ newQuery+='&'; }
            newQuery += vars[i];
        }

        window.location.replace(url+newQuery);
    }

    Array.prototype.clean = function(deleteValue) {
        for (var i = 0; i < this.length; i++) {
            if (this[i] == deleteValue) {
                this.splice(i, 1);
                i--;
            }
        }
        return this;
    };


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


    // FILE INPUT -------------------------------------------------------------------
    $('.file-input').change(function () {
        $(this).parent().find('.file-info').text($(this).val());
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

        setTimeout(function(){
            $(".note-btn.btn-fullscreen").tooltip('hide');
        }, 5000);
    }

    // SUB TABLE --------------------------------------------------------------------
    $(".table-multiple tbody:not(.sub-table) > tr > td").not(":last-child").click(function(){
        $(this).closest("tr").toggleClass("active");

        $(".table-multiple")
            .find($(this).closest("tr").data("target"))
            .toggleClass("open");
    });

    $("time.timeago").timeago();

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

        if($(this).hasClass("reset-article")){
            $("#title").val("");
            $("#slug").val("");
            $('#tags').tagsinput('removeAll');
            $('#category').val("");
            $('#subcategory').html("<option value=''>Select Subcategory</option>");
            $(".note-editable").text("");
            $("#excerpt").val("");
            $("#standard").prop("checked", true);
            $("#published").prop("checked", true);
            $("#slug").removeClass('changed');
        }

        if($(this).hasClass("reset-contributor")){
            $("#name").val("");
            $('#date').val("");
            $('#month').val("");
            $('#year').val("");
            $("#male").prop("checked", true);
            $("#location").val("");
            $("#contact").val("");
            $("#about").val("");
            $("#instagram").val("");
            $("#facebook").val("");
            $("#twitter").val("");
            $("#googleplus").val("");
            $("#subscribe").prop("checked", true);
            $("#message").prop("checked", true);
            $("#follow").prop("checked", true);
            $("#stream").prop("checked", true);
            $("#push-notification").prop("checked", true);
        }

        if($(this).hasClass("print")){
            printDiv("content");
        }
    });

    function createSlug(str) {
        var $slug;
        var trimmed = $.trim(str);
        $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
            replace(/-+/g, '-').
            replace(/^-|-$/g, '');
        return $slug.toLowerCase();
    }


    $("#title").keyup(function(){
        if(!$("#slug").hasClass('changed')){
            $("#slug").val(createSlug($(this).val()));
        }
    });


    $("#slug").keyup(function(){
        $(this).addClass('changed');
    });


    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
        location.reload();
    }

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

    $.validator.setDefaults({
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });

    $.validator.addMethod("checkTags", function (value) {
        return ($(".bootstrap-tagsinput").find(".tag").length > 0);
    });

    $("#form-setting").validate({
        rules: {
            "keywords-dummy": "checkTags",
            new_password: {
                minlength: 6,
                maxlength: 20
            },
            new_password_confirmation: {
                minlength: 6,
                maxlength: 20,
                equalTo: "#new_password"
            }
        },
        messages: {
            "keywords-dummy": "Keywords are required",
            password: "Password is required to save",
            contact: "Contact or Fax is required",
        }
    });

    $("#form-article").validate({
        errorPlacement: function(error, element) {
            $(".note-btn.btn-fullscreen").tooltip('hide');
            if (element.attr("id") == "featured" || element.attr("id") == "category" || element.attr("id") == "subcategory") {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        rules: {
            "tags-dummy": "checkTags"
        },
        messages: {
            "tags-dummy": "Tags are required",
            title: {
                required: "Title is required",
                maxlength: "Title max length is {0} characters"
            },
            slug: {
                required: "Slug is required",
                maxlength: "Slug max length is {0} characters"
            },
        }
    });

    $("#form-contributor").validate({
        groups: {
            birthday: "date month year"
        },
        errorPlacement: function(error, element) {
            if (element.attr("id") == "date" || element.attr("id") == "month" || element.attr("id") == "year") {
                element.closest('div').append(error);
            } else {
                error.insertAfter(element);
            }
        },
        rules: {
            "new_password": {
                minlength: 6,
                maxlength: 20
            },
            "new_password_confirmation": {
                minlength: 6,
                maxlength: 20,
                equalTo: "#new_password"
            }
        },
        messages: {
            name: "Name is required",
            contact: "Contact is required",
            about: "About is required",
            location: "Location is required",
            date: "Please complete the birthday",
            month: "Please complete the birthday",
            year: "Please complete the birthday",
            password: "Password is required to update"
        }
    });

    $('select[name="category"]').change(function(){
        loadingSelect($('select[name="subcategory"]'));
        $.getJSON(websiteUrl+"/admin/article/subcategory/"+$(this).val(), function (data) {
            var output = '<option value="">'+$('select[name="category"] option:selected').text()+' Subcategory</option>';
            var label = '';
            var isFirst = true;
            $.each(data, function(i,row){
                if(row.label != label){
                    if(!isFirst){
                        output += '</optgroup>';
                    }
                    isFirst = false;
                    label = row.label;
                    output += '<optgroup label="'+row.label+'">';
                }
                output += "<option value='"+row.id+"'>"+row.subcategory+"</option>";
                if(data == data.length - 1){
                    output += '</optgroup>';
                }
            });
            completeSelect($('select[name="subcategory"]'));
            $('select[name="subcategory"]').html(output);
        });
    });

    function loadingSelect($tag){
        $tag.attr('disabled', '');
        $tag.html('<option value="loading">Please Wait...</option>');
    }

    function completeSelect($tag){
        $tag.removeAttr('disabled');
        $tag.find('option[value="loading"]').remove();
    }

    $(document).on("click", ".btn-delete", function(){
        var selectedRows = new Array();
        $('input[name="selected"]').val('');
        if($(this).hasClass('all')){
            $('.checkbox-row').each(function(){
                if($(this).is(':checked')){
                    selectedRows.push($(this).val());
                }
            });
            $('input[name="selected"]').val(selectedRows);
        }
        var id = $(this).closest('*[data-id]').data('id');
        var title = $(this).hasClass('all') ? selectedRows.length+' selected data' : $(this).data('label');
        $('#modal-delete form').attr('action', $('#modal-delete form').data('url')+'/'+id);
        $('#modal-delete form .delete-title').text(title);
    });

    $('.btn-mark').click(function(){
        var id = $(this).closest('*[data-id]').data('id');
        var label = $(this).text().toString().toLowerCase();
        var type = '';

        var link = $('#form-mark').data('url')+'/'+label+'/'+id;

        if($(this).data('value') != null && $(this).data('type') != null){
            label = $(this).data('value');
            type = $(this).data('type');
            link = $('#form-mark').data('url')+'/'+type+'/'+label+'/'+id;
        }

        $('#form-mark').attr('action', link);
        $('#form-mark').submit();
    });

    $('.btn-feedback-detail').click(function(){
        var feedback = $(this).closest('*[data-id]');
        var id = feedback.data('id');
        var name = feedback.data('name');
        var email = feedback.data('email');
        var timestamp = feedback.data('timestamp');
        var message = feedback.data('message');

        $('#modal-detail .name').text(name);
        $('#modal-detail .email').text(email);
        $('#modal-detail .timestamp').text(timestamp);
        $('#modal-detail .message').html(message);
        $('#modal-detail .btn-mark').data('id', id);
        $('#modal-detail .btn-feedback-reply').data('id', id);
    });

    $('.btn-feedback-reply').click(function(){
        var feedback = $('tr[data-id="'+$(this).data('id')+'"]').closest('*[data-id]');
        var id = feedback.data('id');
        var name = feedback.data('name');
        var email = feedback.data('email');
        var message = feedback.data('message');

        $('#modal-reply .name').text(name);
        $('#modal-reply .email').text(email);
        $('#modal-reply .email-link').attr('href', 'mailto:'+email);

        $('#modal-reply input[name="id"]').val(id);
        $('#modal-reply input[name="name"]').val(name);
        $('#modal-reply input[name="email"]').val(email);
        $('#modal-reply input[name="message"]').val(message);
        $('#modal-reply textarea[name="reply"]').html('Hi '+name+',\n\r--reply here\n\rRegard,\nInfogue Support');
    });

    $('.btn-article-detail').click(function(){
        var article = $(this).closest('*[data-id]');
        $('#modal-detail .title').text(article.data('title')).attr('href', article.data('article-ref')).unbind('click');
        $('#modal-detail .timestamp').text(article.data('timestamp'));
        $('#modal-detail .category').text(article.data('category')).attr('href', article.data('category-ref')).unbind('click');
        $('#modal-detail .subcategory').text(article.data('subcategory')).attr('href', article.data('subcategory-ref')).unbind('click');
        $('#modal-detail .author').text(article.data('author')).attr('href', article.data('author-ref')).unbind('click');
        $('#modal-detail .author-avatar').attr('src', article.data('avatar'));
        $('#modal-detail .view').text(article.data('view')+' X');

        $('#modal-detail .rating-wrapper').data('rating', article.data('rating'));
        renderRate();

        var tags = article.data('tags').toString().split(',');
        $('#modal-detail .tags').html('');
        for(var i = 0; i < tags.length; i++){
            var slug = tags[i].toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');
            $('#modal-detail .tags').append('<li><a class="tag" href="'+websiteUrl+'/tag/'+slug+'" target="_blank">'+tags[i].toString().toUpperCase()+'</a></li>');
        }
    });

    if($('.bootstrap-tagsinput input').length){
        var tags = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: websiteUrl+'/admin/article/tags'
        });

        $('.bootstrap-tagsinput input').typeahead(null, {
            name: 'slug',
            source: tags
        });
    }
});