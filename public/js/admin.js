$(function () {
    var websiteUrl = $('meta[name="url"]').attr('content');

    /*
     * --------------------------------------------------------------------------
     * Javascript Libraries
     * --------------------------------------------------------------------------
     * Setup all libraries including nicescroll, summernote wysiwyg, timeago,
     * input tags, validation and typeahead.
     */

    var page = 1;
    var onLoading = false;
    var isEnded = false;
    var isFirst = true;

    if ($('.loading').length) {
        $('.loading').show();
        $('.btn-load-more').hide();

        if (isFirst) {
            loadContent();
        }

        $(window).scroll(function () {
            if ($(window).scrollTop() > $(document).height() - $(window).height() - 500 && !onLoading && !isEnded) {
                if (!$('#conversations').length) {
                    loadContent();
                }
            }
        });

        $('.btn-load-more').click(function (e) {
            e.preventDefault();
            loadContent();
        });
    }

    function loadContent() {
        onLoading = true;
        $('.loading').show();
        $('.btn-load-more').hide();
        generateContent()
    }

    function generateContent() {
        $.getJSON($("section[data-href]").data('href') + '?page=' + page, function (data) {
            onLoading = false;
            $('.loading').hide();
            $('.btn-load-more').show();

            if ($('#messages').length) {
                loadMessage(data);
            }
            else if ($('#conversations').length) {
                loadConversation(data);
            }
        }).fail(function (jqxhr, textStatus, error) {
            if (jqxhr.status == 401) {
                showInfoUnauthorized(jqxhr.status);
            }
            else if (jqxhr.status == 404) {
                showInfoNotFound(jqxhr.status);
            }
        });
    }

    // AJAX INFO
    function showInfoUnauthorized(code) {
        showInfo(code + ' UNAUTHORIZED', 'You don\'t have authorization to do this action', 'Please Login <a href="http://localhost:8000/auth/login">here</a> or <a href="http://localhost:8000/auth/register">register</a>');
    }

    function showInfoNotFound(code) {
        showInfo(code + ' PAGE NOT FOUND', 'Something is getting wrong', 'Please contact out administrator');
    }

    function showInfo(title, message, submessage) {
        $("#modal-info .modal-title").html(title);
        $("#modal-info .modal-message").html(message);
        $("#modal-info .modal-submessage").html(submessage);
        $("#modal-info").modal("show");
    }

    // MESSAGES
    $('.btn-message').click(function () {
        var name = $(this).closest('tr').data('author');
        var id = $(this).closest('tr').data('author-id');
        $('#send-message').find('.message-to').text(name);
        $('#send-message').find('#contributor_id').val(id);
    });

    function loadMessage(data) {
        if ($('#message-row-template').length && data.data.length > 0) {
            var template = $('#message-row-template').html();
            var html = Mustache.to_html(template, data);
            $('#messages').append(html);
            $("time.timeago").timeago();

            if (page == data.last_page) {
                $('.btn-load-more').text("END OF MESSAGES").addClass('disabled');
                isEnded = true;
            }
            else {
                page++;
            }
        }
        else {
            if (data.total == 0) {
                $('#messages').html("<p class='text-center mtm'>It's lonely here, send message to another Contributor</p>");
            }

            $('.btn-load-more').text("END OF MESSAGES").addClass('disabled');
            isEnded = true;
        }
    }

    /*
     * --------------------------------------------------------------------------
     * Conversation Function
     * --------------------------------------------------------------------------
     * Setup initial form, button state, check if message box is not empty,
     * then send message via ajax. Checking the new message from another user
     * each 5 seconds.
     */

    var firstScroll = true;
    var previousScrollHeightMinusTop = 0;
    var lastConversationId = '';
    var isCheckingNewConversation = false;

    function loadConversation(data) {
        if ($('#conversation-row-template').length && data.data.length > 0) {
            var template = $('#conversation-row-template').html();
            data.data.reverse();
            var html = Mustache.to_html(template, data);
            $('#conversations').prepend(html);
            $("time.timeago").timeago();
            lastConversationId = $('.conversation:last-child').data('id');

            if (firstScroll) {
                $(".message-box").scrollTop($(".message-box")[0].scrollHeight);
                firstScroll = false;
            }
            else {
                $(".message-box").scrollTop($(".message-box")[0].scrollHeight - previousScrollHeightMinusTop);
            }

            if (page == data.last_page) {
                $('.btn-load-more').text("END OF CONVERSATION").addClass('disabled');
                isEnded = true;
            }
            else {
                page++;
            }
        }
        else {
            if (data.total == 0) {
                $('#messages').html("<p class='text-center mtm'>It's lonely here, send message to another Contributor</p>");
            }

            $('.btn-load-more').text("END OF CONVERSATION").addClass('disabled');
            isEnded = true;
        }
    }

    if ($('#conversations').length) {
        if (isExtraSmall) {
            $('footer').hide();
        }
        $(".message-box").scroll(function () {
            previousScrollHeightMinusTop = $(".message-box")[0].scrollHeight - $(".message-box").scrollTop();

            if ($(".message-box").scrollTop() < 50 && !onLoading && !isEnded) {
                loadContent();
            }
        });

        setInterval(function () {
            if (!isCheckingNewConversation) {
                checkConversation();
            }
        }, 5000);

        var buttonSendMessage = $(".btn-send");
        buttonSendMessage.attr('disabled', 'true');

        $('#form-message').on('submit', (function (e) {
            e.preventDefault();
            sendMessage();
        }));

        $("#form-message #message").keyup(function () {
            if ($(this).val() == '') {
                buttonSendMessage.attr('disabled', 'true');
            }
            else {
                buttonSendMessage.removeAttr('disabled');
            }
        });

        function sendMessage() {
            var form = $('#form-message').get(0);
            var formData = new FormData(form);

            $("#message").attr('readonly', '');
            $("#attachment").attr('disabled', 'true');
            $(".btn-send").attr('disabled', 'true');

            $.ajax({
                type: 'POST',
                url: $(form).attr('action'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log("message sent");
                    $("#message").removeAttr('readonly').val('');
                    $("#attachment").removeAttr('disabled').val('');
                    $(".btn-send").attr('disabled', 'true');
                    $(".file-info").text('');
                    if (!isCheckingNewConversation) {
                        checkConversation();
                    }
                },
                error: function (e) {
                    $("#message").removeAttr('readonly').val('');
                    $("#attachment").removeAttr('disabled').val('');
                    $(".btn-send").removeAttr('disabled');
                    console.log("send message is failed "+e.responseText);
                }
            });
        }

        function checkConversation() {
            isCheckingNewConversation = true;
            $.getJSON($("section[data-href]").data('href') + '?last=' + lastConversationId, function (data) {
                if ($('#conversation-row-template').length && data.data.length > 0) {
                    var template = $('#conversation-row-template').html();
                    data.data.reverse();
                    var html = Mustache.to_html(template, data);
                    $('#conversations').append(html);
                    $("time.timeago").timeago();
                    $(".message-box").scrollTop($(".message-box")[0].scrollHeight);
                    lastConversationId = $('.conversation:last-child').data('id');
                }
                isCheckingNewConversation = false;
            });
        }
    }
    

    // ADD NICE SCROLL EXCEPT IE:EDGE
    if (!/Edge/.test(navigator.userAgent)) {
        $("html").niceScroll({
            cursorcolor: '#4dc4d2',
            cursorborder: 'none',
            horizrailenabled: false
        });

        $(".modal").niceScroll({
            cursorcolor: '#4dc4d2',
            cursorborder: 'none'
        });

        $("#sidebar-wrapper").niceScroll({
            cursorcolor: '#4dc4d2',
            cursorborder: 'none'
        });
    }

    // SUMMERNOTE
    if ($('.summernote').length) {
        $('.summernote').summernote({
            toolbar: [
                ['font', ['style']],
                ['style', ['bold', 'italic', 'underline']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['picture', 'video', 'link']],
                ['misc', ['codeview', 'fullscreen']]
            ],
            placeholder: 'Write here...',
            height: 200,
            onImageUpload: function (files, editor, welEditable) {
                console.log(files[0]+'  '+editor+'  '+welEditable);
            }
        });

        // CHANGE DEFAULT UPLOAD IMAGE INPUT
        $(".note-group-select-from-files").find(".note-image-input").remove();
        var inputFile = "<div class='css-file'>" +
            "<span class='file-info'>No file selected</span>" +
            "<button class='btn btn-primary' type='button'>SELECT<span class='hidden-xs'> IMAGE</span></button>" +
            "<input type='file' class='file-input note-image-input form-control' name='files' accept='image/*' multiple='multiple'/>" +
            "</div>";
        $(".note-group-select-from-files").append(inputFile);

        // CHANGE DEFAULT CHECKBOX
        $(".link-dialog .checkbox").remove();
        var inputCheckbox = "<div class='checkbox'>" +
            "<input type='checkbox' name='link' id='link' class='css-checkbox' checked>" +
            "<label for='link' class='css-label'>Open in new window</label>" +
            "</div>";
        $(".link-dialog .modal-body").append(inputCheckbox);

        // ADD LITTLE NOTIFICATION ON FULLSCREEN BUTTON
        setTimeout(function () {
            $(".note-btn.btn-fullscreen").tooltip('show');
        }, 1000);

        setTimeout(function () {
            $(".note-btn.btn-fullscreen").tooltip('hide');
        }, 5000);
    }

    // TIME AGO
    $("time.timeago").timeago();


    /*
     * --------------------------------------------------------------------------
     * Application Function
     * --------------------------------------------------------------------------
     * Snippet script necessary to build this application.
     */

    // SIMPLE CHART HEIGHT
    $(".chart .fill").each(function () {
        $(this).height($(this).data('value'));
    });

    // RENDER RATING NUMBER INTO VISUAL
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


    /*
     * --------------------------------------------------------------------------
     * Checkbox & Select Rows
     * --------------------------------------------------------------------------
     * Checkbox table to select rows, this functions checking if multiple
     * control button is needed or not, select all by single click and change
     * selected row color by adding bootstrap class.
     */

    // HIDE MULTIPLE ROW CONTROL
    $('.group-control').hide();

    // SELECT ROW WITH CHECKBOX
    $("tbody .css-checkbox").change(function () {
        var subtable = $(this).closest("tbody").next(".sub-table");
        if ($(this).is(':checked')) {
            $(this).closest("tr").addClass('success');
            subtable.find(".css-checkbox").prop('checked', true);
            subtable.find("tr").addClass('success');
        }
        else {
            $(this).closest("tr").removeClass('success');
            subtable.find(".css-checkbox").prop('checked', false);
            subtable.find("tr").removeClass('success');
        }
        selectedCheckboxCheck();
    });

    // SELECT ALL ROWS
    $("thead .css-checkbox").change(function () {
        if ($(this).is(':checked')) {
            $("tbody .css-checkbox").prop('checked', true);
            $("tbody").find("tr").addClass('success');
        }
        else {
            $("tbody .css-checkbox").prop('checked', false);
            $("tbody").find("tr").removeClass('success');
        }
        selectedCheckboxCheck();
    });

    // CHECK IF THERE IS ROW SELECTED
    function selectedCheckboxCheck() {
        var isChecked = false;
        $("tbody .css-checkbox").each(function () {
            if ($(this).is(':checked')) {
                isChecked = true;
            }
        });

        if (isChecked) {
            $('.group-control').fadeIn(200);
        }
        else {
            $('.group-control').fadeOut(200);
        }
    }


    /*
     * --------------------------------------------------------------------------
     * Filter Data
     * --------------------------------------------------------------------------
     * Filtering data by dropdown option, the filters including data, status,
     * sorting, and sorting method, change dropdown like select and build
     * query string.
     */

    // DROPDOWN AS SELECT
    $(".dropdown.select a").click(function (e) {
        e.preventDefault();
        var text = $(this).text().toUpperCase() + " <span class='caret'></span>";
        $(this).closest(".dropdown").find("button.dropdown-toggle").html(text);
    });

    // FILTER DATA
    $('.filter .dropdown.data a').click(function () {
        var value = $(this).text().toLowerCase();
        if ($(this).data('value') != null) {
            var value = $(this).data('value');
        }
        filterData('data', (value == 'all data') ? 'all' : value);
    });

    // FILTER STATUS
    $('.filter .dropdown.status a').click(function () {
        var value = $(this).text().toLowerCase();
        filterData('status', (value == 'all status') ? 'all' : value);
    });

    // FILTER SORT ATTRIBUTE
    $('.filter .dropdown.by a').click(function () {
        var value = $(this).text().toLowerCase();
        filterData('by', value);
    });

    // FILTER SORT METHOD
    $('.filter .dropdown.method a').click(function () {
        var value = $(this).text().toLowerCase();
        filterData('sort', (value == 'ascending') ? 'asc' : 'desc');
    });

    // BUILD QUERY FILTER
    function filterData(key, value) {
        var url = window.location.origin + window.location.pathname;
        var query = window.location.search.substring(1);
        var newQuery = '?';
        var vars = query.split("&").clean('');
        var isNewQuery = true;

        for (var i = 0; i < vars.length; i++) {
            var pair = vars[i].split("=");
            if (pair[0] == key) {
                vars[i] = key + "=" + value;
                isNewQuery = false;
            }
            if (pair[0] == 'page') {
                vars.splice(i, 1);
            }
        }

        if (isNewQuery) {
            vars.push(key + "=" + value);
        }

        for (var i = 0; i < vars.length; i++) {
            if (i > 0) {
                newQuery += '&';
            }
            newQuery += vars[i];
        }

        window.location.replace(url + newQuery);
    }

    // CREATE FUNCTION ON ARRAY
    Array.prototype.clean = function (deleteValue) {
        for (var i = 0; i < this.length; i++) {
            if (this[i] == deleteValue) {
                this.splice(i, 1);
                i--;
            }
        }
        return this;
    };


    /*
     * --------------------------------------------------------------------------
     * Quick Action
     * --------------------------------------------------------------------------
     * Asynchronous method gives immediately respond of button.
     */

    // APPROVE
    $(".approve").click(function (e) {
        e.preventDefault();
        $(this).closest("tr").find(".label")
            .removeClass()
            .addClass("label")
            .addClass("label-success")
            .text("PUBLISHED");
    });
    $(".suspend").click(function (e) {
        e.preventDefault();
        $(this).closest("tr").find(".label")
            .removeClass()
            .addClass("label")
            .addClass("label-danger")
            .text("SUSPEND");
    });

    // HEADLINE FUNCTIONALITY
    $(".headline").click(function (e) {
        e.preventDefault();
        var row = $(this).closest("tr");
        row.removeClass('warning');
        row.toggleClass('danger');
        if (row.hasClass('danger')) {
            $(this).html("<i class='fa fa-star'></i> Remove Headline");
            $(this).closest("ul").find(".trending").html("<i class='fa fa-trophy'></i> Trending</a>");
        }
        else {
            $(this).html("<i class='fa fa-star'></i> Headline");
        }
    });

    // TRENDING FUNCTIONALITY
    $(".trending").click(function (e) {
        e.preventDefault();
        var row = $(this).closest("tr");
        row.removeClass('danger');
        row.toggleClass('warning');
        if (row.hasClass('warning')) {
            $(this).html("<i class='fa fa-trophy'></i> Remove Trending");
            $(this).closest("ul").find(".headline").html("<i class='fa fa-star'></i> Headline");
        }
        else {
            $(this).html("<i class='fa fa-trophy'></i> Trending</a>");
        }
    });

    // ADD FAKE FOCUS ON TAGS DIV
    $('.bootstrap-tagsinput').focusin(function () {
        $(this).addClass('focus');
    });
    $('.bootstrap-tagsinput').focusout(function () {
        $(this).removeClass('focus');
    });

    // FILE INPUT VALUE
    $('.file-input').change(function () {
        $(this).parent().find('.file-info').text($(this).val());
    });


    /*
     * --------------------------------------------------------------------------
     * Reset Form
     * --------------------------------------------------------------------------
     * Set default value or empty the form. Add prevent # link to trigger
     * redirection.
     */

    $("a[href='#']").click(function (e) {
        e.preventDefault();

        // SETTING FORM
        if ($(this).hasClass("reset-setting")) {
            $("#website").val("InfoGue.id");
            $('#keywords').tagsinput('removeAll');
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
            $("#email").val("support@infogue.id");
            $("#description").val("The most update web portal news. We always provide latest article and information with high integrity and truth. Knowledge is beyond among us to share with you.");
            $("#owner").val("Angga Ari Wijaya");
            $("#latitude").val("6.1745");
            $("#longitude").val("106.8227");
            $("#facebook").val("https://www.facebook.com/infogue");
            $("#twitter").val("https://www.twitter.com/infogue");
            $("#googleplus").val("https://plus.google.com/+InfoGue");
            $("#article").prop("checked", true);
            $("#feedback").prop("checked", true);
            $("#member").prop("checked", true);
            $("#yes").prop("checked", true);
            $("#name").val("Administrator");
            $("#email_admin").val("admin@infogue.id");
        }

        // ARTICLE FORM
        if ($(this).hasClass("reset-article")) {
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

        // CONTRIBUTOR
        if ($(this).hasClass("reset-contributor")) {
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
            $("#email_subscription").prop("checked", true);
            $("#email_message").prop("checked", true);
            $("#email_follow").prop("checked", true);
            $("#email_feed").prop("checked", true);
            $("#mobile_notification").prop("checked", true);
        }

        // SIMPLE PRINT DIV
        if ($(this).hasClass("print")) {
            printDiv("content");
        }
    });

    // PRINTER
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }


    /*
     * --------------------------------------------------------------------------
     * Article & Slug
     * --------------------------------------------------------------------------
     * Building method to create slug by passing plain text, check if the slug
     * input text has been edited then stop to guess slug.
     */

    // STRING TO SLUG
    function createSlug(str) {
        var $slug;
        var trimmed = $.trim(str);
        $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
            replace(/-+/g, '-').
            replace(/^-|-$/g, '');
        return $slug.toLowerCase();
    }

    // CREATE SLUG WHEN TITLE IS TYPED
    $("#title").keyup(function () {
        if (!$("#slug").hasClass('changed')) {
            $("#slug").val(createSlug($(this).val()));
        }
    });

    // ADD MARK WHEN SLUG IS CHANGING
    $("#slug").keyup(function () {
        $(this).addClass('changed');
    });


    /*
     * --------------------------------------------------------------------------
     * Layout Resizer
     * --------------------------------------------------------------------------
     * Check device dimension, is it small, medium or large then try to fits
     * the layout according dimension, this function including change sidebar
     * to sliding off-canvas navigation and chart resizing.
     */

    var wrapper = $("#wrapper");

    // SET FULL HEIGHT IF CONTENT TOO SHORT
    if (wrapper.height() < $(window).height()) {
        wrapper.css('position', 'absolute').css('height', '100%').css('width', '100%');
        wrapper.css('min-height', $(window).height() - $('header').height() - $('breadcrumb-wrapper').height() - 40 - 40);
    }

    var isLarge = false;
    var isMedium = false;
    var isSmall = false;
    var isExtraSmall = false;

    setDevice();
    setLayout();
    resizeContentWrapper();
    resizeTable();

    $(window).resize(function () {
        setDevice();
        setLayout();
    });

    // FIND OUT DEVICE DIMENSION ON RESIZE
    function setDevice() {
        var viewportWidth = $(window).width();
        isLarge = (viewportWidth >= 1200);
        isMedium = (viewportWidth >= 993 && viewportWidth <= 1199);
        isSmall = (viewportWidth >= 768 && viewportWidth <= 992);
        isExtraSmall = (viewportWidth <= 767);
    }

    // CHANGE THE LAYOUT ON RESIZE
    function setLayout() {
        // Responsive table
        resizeTable();

        // Hide login footer
        if ($(window).height() < 450) {
            $(".login-footer").fadeOut(300);
        }
        else {
            $(".login-footer").fadeIn(300);
        }

        // Toggle some part of chart on dashboard
        if (isSmall || isLarge) {
            $(".bar.sm-screen").css('display', 'table-cell');
        }
        else {
            $(".bar.sm-screen").css('display', 'none');
        }
    }


    /*
     * --------------------------------------------------------------------------
     * Off-Canvas
     * --------------------------------------------------------------------------
     * Sliding push off-canvas function, check device dimension and set class
     * and position of wrapper, add toggle function on navigation button toggle
     * finally prevent event triggered on navigation container itself.
     */


    // SET SIDE BAR MUST BE OPENED OR CLOSED
    if (isExtraSmall) {
        if (!wrapper.hasClass('toggled')) {
            wrapper.addClass('toggled');
            wrapper.find("#content-wrapper").removeAttr('style');
        }
    }
    else {
        if (wrapper.hasClass('toggled')) {
            wrapper.removeClass('toggled');
        }
    }

    // NAVIGATION TOGGLE
    $(".toggle-nav").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");

        if (isMedium) {
            if (wrapper.hasClass('toggled')) {
                $(".md-screen").fadeIn(300).css('display', 'table-cell');
            }
            else {
                $(".bar.sm-screen").fadeOut(300);
            }
        }

        resizeContentWrapper();
    });

    // CLOSE NAVIGATION WHEN CLICK OUTSIDE
    $(".content").click(function () {
        if ($(window).width() <= 767) {
            if (!wrapper.hasClass('toggled')) {
                wrapper.addClass('toggled');
                resizeContentWrapper();
            }
        }
    });

    // PUSH AND MAINTAIN SIZE OF CONTENT
    function resizeContentWrapper() {
        if ($(window).width() <= 767) {
            if (!wrapper.hasClass('toggled')) {
                wrapper.find("#content-wrapper").width($("#content-wrapper").width() + $("#sidebar-wrapper").width());
            }
            else {
                wrapper.find("#content-wrapper").removeAttr('style');
            }
        }
    }

    /*
     * --------------------------------------------------------------------------
     * Responsive Table & Subtable
     * --------------------------------------------------------------------------
     * Check dimension of device and decide class and position of table rows,
     * add label if necessary, check empty row and replace with label title, and
     * add subtable toggle open.
     */

    // TABLE
    function resizeTable() {
        if (isSmall || isExtraSmall) {
            // RETRIEVE HEADING TEXT AND PUT IN ARRAY
            var heading = $(".table > thead th").map(function () {
                var text = $.trim($(this).text()).toUpperCase();
                // REPLACE EMPTY HEADING
                if (text == '') {
                    text = 'SELECT'
                }
                return text;
            }).get();

            // ADD LABEL HEADING BEFORE DATA IN EACH ROW
            $(".table tbody:not(.sub-table) td").find(".label-title").remove();
            $(".table tbody:not(.sub-table) tr").each(function () {
                for (var i = 0; i < heading.length; i++) {
                    $(this).children().eq(i).prepend("<span class='label-title'>" + heading[i] + "</span>");
                }
            });

            // SUB TABLE HEADING
            var headingSub = $(".table > tbody.sub-table .sub-head th").map(function () {
                var text = $.trim($(this).text()).toUpperCase();
                if (text == '') {
                    text = 'ACTION'
                }
                return text;
            }).get();
            headingSub[0] = ''; // KEEP THE FIRST EMPTY ON TITLE

            // ADD LABEL HEADING BEFORE SUB DATA IN EACH ROW
            $(".table tbody.sub-table td").find(".label-title").remove();
            $(".table tbody.sub-table tr:not(.sub-head)").each(function () {
                for (var i = 0; i < heading.length; i++) {
                    $(this).children().eq(i).prepend("<span class='label-title'>" + headingSub[i] + "</span>");
                }
            });
        }
        else {
            // RESTORE TABLE AND REMOVE LABELS TITLE
            $(".table tbody:not(.sub-table) td").find(".label-title").remove();
            $(".table tbody.sub-table td").find(".label-title").remove();
        }

        // CHANGE FILTER DROPDOWN POSITION OM MOBILE
        if (isExtraSmall) {
            $(".filter ul.dropdown-menu").removeClass("dropdown-menu-right").addClass("dropdown-menu-left");
        }
        else {
            $(".filter ul.dropdown-menu").removeClass("dropdown-menu-left").addClass("dropdown-menu-right");
        }
    }

    // SUB TABLE TOGGLE OPEN
    $(".table-multiple tbody:not(.sub-table) > tr > td").not(":last-child").click(function () {
        $(this).closest("tr").toggleClass("active");

        $(".table-multiple")
            .find($(this).closest("tr").data("target"))
            .toggleClass("open");
    });


    /*
     * --------------------------------------------------------------------------
     * Form Validation
     * --------------------------------------------------------------------------
     * Set validation of basic form, including, login, email, reset, setting,
     * and article management. Set default configuration so it will fits on
     * bootstrap error form semantic.
     */

    // OVERRIDE DEFAULT SETTING
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

    // CUSTOM VALIDATION RULE
    $.validator.addMethod("checkTags", function (value) {
        return ($(".bootstrap-tagsinput").find(".tag").length > 0);
    });

    // VALIDATE LOGIN FORM
    $("#form-login").validate({
        errorClass: 'help-block text-left',
        messages: {
            email: {
                required: 'Email is required'
            },
            password: {
                required: 'Password is required'
            },
        }
    });

    // VALIDATE EMAIL FORM
    $("#form-email").validate({
        errorClass: 'help-block text-left',
        messages: {
            email: {
                required: 'Registered email is required'
            },
        }
    });

    // VALIDATE RESET FORM
    $("#form-reset").validate({
        errorClass: 'help-block text-left',
        rules: {
            password: {
                minlength: 6,
                maxlength: 20
            },
            password_confirmation: {
                minlength: 6,
                maxlength: 20,
                equalTo: "#password"
            }
        },
        messages: {
            email: {
                required: 'Registered email is required'
            },
            password: {
                required: 'New password email is required'
            },
            password_confirmation: {
                required: 'Password confirmation is required'
            },
        }
    });

    // VALIDATE SETTING FORM
    $("#form-setting").validate({
        rules: {
            keywords_dummy: "checkTags",
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
            website: {
                required: "Website name is required",
                maxlength: "Website name max length is {0} characters"
            },
            keywords_dummy: "Keywords are required",
            contact: {
                required: "Contact or Fax is required",
                maxlength: "Contact max length is {0} characters"
            },
            address: {
                required: "Address is required",
                maxlength: "Address max length is {0} characters"
            },
            email: {
                required: "Email is required",
                maxlength: "Email max length is {0} characters"
            },
            description: {
                required: "Description is required",
                maxlength: "Description max length is {0} characters"
            },
            latitude: {
                required: "Latitude is required",
            },
            longitude: {
                required: "Longitude is required",
            },
            email_admin: {
                required: "Email is required",
                maxlength: "Email max length is {0} characters"
            },
            name: {
                required: "Name is required",
                maxlength: "Name max length is {0} characters"
            },
            password: "Password is required to save",
        }
    });

    // VALIDATE ARTICLE FORM
    $("#form-article").validate({
        errorPlacement: function (error, element) {
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

    // VALIDATE CONTRIBUTOR FORM
    $("#form-contributor").validate({
        groups: {
            birthday: "date month year"
        },
        errorPlacement: function (error, element) {
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
            name: {
                required: "Name is required",
                maxlength: "Name max length is {0} characters"
            },
            contact: {
                required: "Contact is required",
                maxlength: "Contact max length is {0} characters"
            },
            about: {
                required: "About is required",
                maxlength: "About max length is {0} characters"
            },
            location: {
                required: "Location is required",
                maxlength: "Location max length is {0} characters"
            },
            username: {
                required: "Username is required",
                maxlength: "Location max length is {0} characters"
            },
            email: {
                required: "Email is required",
                maxlength: "Email max length is {0} characters"
            },
            date: "Please complete the birthday",
            month: "Please complete the birthday",
            year: "Please complete the birthday",
        }
    });

    $("#form-category").validate({
        messages: {
            category: {
                required: "Category name is required",
                maxlength: "Category max length is {0} characters"
            },
            description: {
                required: "Description is required",
                maxlength: "Description max length is {0} characters"
            },
        }
    });

    $("#form-subcategory").validate({
        errorPlacement: function (error, element) {
            if (element.attr("id") == "category_id") {
                error.insertAfter(element.closest('label'));
            } else {
                error.insertAfter(element);
            }
        },
        messages: {
            category: {
                required: "Category is required",
            },
            subcategory: {
                required: "Subcategory name is required",
                maxlength: "Subcategory max length is {0} characters"
            },
            label: {
                required: "Label is required",
                maxlength: "Label max length is {0} characters"
            },
            description: {
                required: "Description is required",
                maxlength: "Description max length is {0} characters"
            },
        }
    });


    /*
     * --------------------------------------------------------------------------
     * Form Functions
     * --------------------------------------------------------------------------
     * List of function which used to creating and manipulating data, including
     * retrieve subcategory, deleting, showing detail, populating data-* into
     * form and etc.
     */

    // RETRIEVE SUBCATEGORY VIA AJAX
    $('select[name="category"]').change(function () {
        loadingSelect($('select[name="subcategory"]'));
        $.getJSON(websiteUrl + "/admin/article/subcategory/" + $(this).val(), function (data) {
            var output = '<option value="">' + $('select[name="category"] option:selected').text() + ' Subcategory</option>';
            var label = '';
            var isFirst = true;
            $.each(data, function (i, row) {
                if (row.label != label) {
                    if (!isFirst) {
                        output += '</optgroup>';
                    }
                    isFirst = false;
                    label = row.label;
                    output += '<optgroup label="' + row.label + '">';
                }
                output += "<option value='" + row.id + "'>" + row.subcategory + "</option>";
                if (data == data.length - 1) {
                    output += '</optgroup>';
                }
            });
            completeSelect($('select[name="subcategory"]'));
            $('select[name="subcategory"]').html(output);
        });
    });

    // SET SELECT LOADING
    function loadingSelect($tag) {
        $tag.attr('disabled', '');
        $tag.html('<option value="loading">Please Wait...</option>');
    }

    // REMOVE SELECT LOADING STATUS
    function completeSelect($tag) {
        $tag.removeAttr('disabled');
        $tag.find('option[value="loading"]').remove();
    }

    // DELETE BUTTON
    $(document).on("click", ".btn-delete", function () {
        var modal = $('#modal-delete');
        var selectedRows = new Array();
        var selectedRowSubs = new Array();
        $('input[name="selected"]').val('');
        $('input[name="selected_sub"]').val('');

        if ($(this).hasClass('all')) {
            $('button[type="submit"]').text('DELETE');
            $('.checkbox-row').each(function () {
                if ($(this).is(':checked')) {
                    selectedRows.push($(this).val());
                }
            });
            $('input[name="selected"]').val(selectedRows);

            if ($('.checkbox-row-sub').length > 0) {
                $('.checkbox-row-sub').each(function () {
                    if ($(this).is(':checked')) {
                        selectedRowSubs.push($(this).val());
                    }
                });
                $('input[name="selected_sub"]').val(selectedRowSubs);
            }
        }
        var totalData = selectedRows.length + selectedRowSubs.length;
        var id = $(this).closest('*[data-id]').data('id');
        if (id == undefined) {
            id = 0;
        }
        var title = $(this).hasClass('all') ? totalData + ' selected data' : $(this).data('label');

        if ($(this).hasClass('btn-delete-category') || (selectedRows.length > 0 && $('.btn-delete-category').length > 0)) {
            $('#modal-delete form').attr('action', $('#modal-delete form').data('url') + '/category/' + id);
            console.log('category ' + $('#modal-delete form').attr('action'));
        }
        else if ($(this).hasClass('btn-delete-subcategory') || (selectedRowSubs.length > 0 && $('.btn-delete-subcategory').length > 0)) {
            $('#modal-delete form').attr('action', $('#modal-delete form').data('url') + '/subcategory/' + id);
            console.log('subcategory ' + $('#modal-delete form').attr('action'));
        }
        else {
            $('#modal-delete form').attr('action', $('#modal-delete form').data('url') + '/' + id);
            console.log('general ' + $('#modal-delete form').attr('action'));
        }

        if ($(this).hasClass('delete-message')) {
            var sender = $(this).closest('*[data-id]').data('sender');
            modal.find('input[name="sender"]').val(sender);
            modal.find('input[name="contributor"]').val(title);
        }

        $('#modal-delete form .delete-title').text(title);
    });

    // MARKING DATA
    $('.btn-mark').click(function () {
        var id = $(this).closest('*[data-id]').data('id');
        var label = $(this).text().toString().toLowerCase();
        var type = '';

        var link = $('#form-mark').data('url') + '/' + label + '/' + id;

        if ($(this).data('value') != null && $(this).data('type') != null) {
            label = $(this).data('value');
            type = $(this).data('type');
            link = $('#form-mark').data('url') + '/' + type + '/' + label + '/' + id;
        }

        $('#form-mark').attr('action', link);
        $('#form-mark').submit();
    });

    // SHOW FEEDBACK DETAIL
    $('.btn-feedback-detail').click(function () {
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

    // REPLY FEEDBACK
    $('.btn-feedback-reply').click(function () {
        var feedback = $('tr[data-id="' + $(this).data('id') + '"]').closest('*[data-id]');
        var id = feedback.data('id');
        var name = feedback.data('name');
        var email = feedback.data('email');
        var message = feedback.data('message');

        $('#modal-reply .name').text(name);
        $('#modal-reply .email').text(email);
        $('#modal-reply .email-link').attr('href', 'mailto:' + email);

        $('#modal-reply input[name="id"]').val(id);
        $('#modal-reply input[name="name"]').val(name);
        $('#modal-reply input[name="email"]').val(email);
        $('#modal-reply input[name="message"]').val(message);
        $('#modal-reply textarea[name="reply"]').html('Hi ' + name + ',\n\r--reply here\n\rRegard,\nInfogue Support');
    });

    // SHOW ARTICLE DETAIL
    $('.btn-article-detail').click(function () {
        var article = $(this).closest('*[data-id]');
        $('#modal-detail .title').text(article.data('title')).attr('href', article.data('article-ref')).unbind('click');
        $('#modal-detail .timestamp').text(article.data('timestamp'));
        $('#modal-detail .category').text(article.data('category')).attr('href', article.data('category-ref')).unbind('click');
        $('#modal-detail .subcategory').text(article.data('subcategory')).attr('href', article.data('subcategory-ref')).unbind('click');
        $('#modal-detail .author').text(article.data('author')).attr('href', article.data('author-ref')).unbind('click');
        $('#modal-detail .author-avatar').attr('src', article.data('avatar'));
        $('#modal-detail .view').text(article.data('view') + ' X');

        $('#modal-detail .rating-wrapper').data('rating', article.data('rating'));
        renderRate();

        var tags = article.data('tags').toString().split(',');
        $('#modal-detail .tags').html('');
        for (var i = 0; i < tags.length; i++) {
            var slug = tags[i].toLowerCase().replace(/[^\w ]+/g, '').replace(/ +/g, '-');
            $('#modal-detail .tags').append('<li><a class="tag" href="' + websiteUrl + '/tag/' + slug + '" target="_blank">' + tags[i].toString().toUpperCase() + '</a></li>');
        }
    });

    // TYPEAHEAD RETRIEVE ALL TAGS
    if ($('.bootstrap-tagsinput input').length) {
        var tags = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: websiteUrl + '/admin/article/tags'
        });

        $('.bootstrap-tagsinput input').typeahead(null, {
            name: 'slug',
            source: tags
        });
    }

    var firstCategoryRequest = true;

    // ADD CATEGORY
    $('.btn-category-create').click(function () {
        var categoryModal = $('#modal-category');

        categoryModal.find('form').attr('action', $('#modal-category form').data('url'));
        categoryModal.find('form input[name="_method"]').val('post');

        categoryModal.find('.title').text('CREATE');
        categoryModal.find('.title-button').text('CREATE');

        if (firstCategoryRequest && (categoryModal.find('input[name="category"]').val() != '' || categoryModal.find('textarea[name="description"]').val() != '')) {
            firstCategoryRequest = false;
            return;
        }
        firstCategoryRequest = false;

        categoryModal.find('input[name="category"]').val('');
        categoryModal.find('textarea[name="description"]').val('');
    });

    // EDIT CATEGORY
    $('.btn-category-edit').click(function () {
        var categoryModal = $('#modal-category');
        var categoryData = $(this).closest('*[data-id]');

        var id = categoryData.data('id');
        var category = categoryData.data('category');
        var description = categoryData.data('description');

        categoryModal.find('form').attr('action', $('#modal-category form').data('url') + '/' + id);
        categoryModal.find('form input[name="_method"]').val('put');

        categoryModal.find('.title').text('EDIT');
        categoryModal.find('.title-button').text('UPDATE');

        if (firstCategoryRequest && (categoryModal.find('input[name="category"]').val() != '' || categoryModal.find('textarea[name="description"]').val() != '')) {
            firstCategoryRequest = false;
            return;
        }
        firstCategoryRequest = false;

        categoryModal.find('input[name="category"]').val(category);
        categoryModal.find('textarea[name="description"]').val(description);
    });

    // ADDITIONAL DELETE INFO
    $('.btn-delete-category').click(function () {
        $('#modal-delete form .title').text(' CATEGORY');
    });

    // ADD SUBCATEGORY
    $('.btn-subcategory-create').click(function () {
        var subcategoryModal = $('#modal-subcategory');

        subcategoryModal.find('form').attr('action', $('#modal-subcategory form').data('url'));
        subcategoryModal.find('form input[name="_method"]').val('post');

        subcategoryModal.find('.title').text('CREATE');
        subcategoryModal.find('.title-button').text('CREATE');

        if (firstCategoryRequest && (subcategoryModal.find('input[name="subcategory"]').val() != '' || subcategoryModal.find('input[name="label"]').val() != '' || subcategoryModal.find('textarea[name="description"]').val() != '')) {
            firstCategoryRequest = false;
            return;
        }
        firstCategoryRequest = false;

        subcategoryModal.find('select[name="category_id"]').val('');
        subcategoryModal.find('input[name="subcategory"]').val('');
        subcategoryModal.find('input[name="label"]').val('');
        subcategoryModal.find('textarea[name="description"]').val('');
    });

    // EDIT SUBCATEGORY
    $('.btn-subcategory-edit').click(function () {
        var subcategoryModal = $('#modal-subcategory');
        var subcategoryData = $(this).closest('*[data-id]');

        var id = subcategoryData.data('id');
        var category = subcategoryData.data('category');
        var subcategory = subcategoryData.data('subcategory');
        var label = subcategoryData.data('label');
        var description = subcategoryData.data('description');

        subcategoryModal.find('form').attr('action', $('#modal-subcategory form').data('url') + '/' + id);
        subcategoryModal.find('form input[name="_method"]').val('put');

        subcategoryModal.find('.title').text('EDIT');
        subcategoryModal.find('.title-button').text('UPDATE');

        if (firstCategoryRequest && (subcategoryModal.find('input[name="subcategory"]').val() != '' || subcategoryModal.find('input[name="label"]').val() != '' || subcategoryModal.find('textarea[name="description"]').val() != '')) {
            firstCategoryRequest = false;
            return;
        }
        firstCategoryRequest = false;

        subcategoryModal.find('select[name="category_id"]').val(category);
        subcategoryModal.find('input[name="subcategory"]').val(subcategory);
        subcategoryModal.find('input[name="label"]').val(label);
        subcategoryModal.find('textarea[name="description"]').val(description);
    });

    // ADDITIONAL DELETE INFO
    $('.btn-delete-subcategory').click(function () {
        $('#modal-delete form .title').text(' SUBCATEGORY');
    });
});