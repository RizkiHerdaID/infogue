$(function () {
    var Mustache = require('mustache');

    $.getJSON('js/data.json', function (data) {
        if ($('#articlestpl').length) {
            var template = $('#articlestpl').html();
            var html = Mustache.to_html(template, data);
            $('#articles').html(html);
        }
    }); // getJSON

}); // function