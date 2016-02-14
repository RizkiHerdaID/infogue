/**
 * Created by Workstation on 2/14/2016.
 */
$(function () {
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

    $.validator.addMethod("checkKeywords", function (value) {
        return ($("#keywords").find(".tag").length > 0);
    });

    $.validator.addMethod("checkTags", function (value) {
        return ($("#tags").find(".tag").length > 0);
    });

    $("#form-setting").validate({
        rules: {
            "keywords-dummy": "checkKeywords",
            "new-password": {
                minlength: 8,
                maxlength: 20
            },
            "confirm-password": {
                minlength: 8,
                maxlength: 20,
                equalTo: "#new-password"
            }
        },
        messages: {
            "keywords-dummy": "Keywords are required",
            password: "Password is required for saving",
            address: "Address is required",
            email: "Email address is required",
            contact: "Contact or Fax is required",
            description: "Description is required",
            website: "Website name is required"
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
            category: "Category is required",
            subcategory: "Sub Category is required",
            featured: "Featured is required",
            content: "Post content name is required"
        }
    });
})