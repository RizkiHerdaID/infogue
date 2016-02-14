/**
 * Created by Workstation on 2/14/2016.
 */

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
    return ($("#keywords").find(".tag").length > 0);
});

$(function () {
    $("#form-setting").validate({
        rules: {
            "keywords-dummy": "checkTags",
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
})