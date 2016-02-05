$(function () {
    if($('.btn-load-more').length){
        var count = 2;
        var total = 10;
        var onloading = false;

        $(window).scroll(function () {
            if ($(window).scrollTop() > $(document).height() - $(window).height() - 500 && !onloading) {
                loadArticle(count);
            }
        });

        $('.btn-load-more').click(function (e) {
            e.preventDefault();
            loadArticle(count);
        });
    }

    function loadArticle(pageNumber) {
        if (count > total) {
            $('.btn-load-more').text("END OF PAGE").addClass('disabled');
            return false;
        } else {
            $('.loading').show();
            $('.btn-load-more').hide();
            onloading = true;

            console.log('load article ' + pageNumber);

            setTimeout(function(){
                count++;
                onloading = false;
                $('.loading').hide();
                $('.btn-load-more').show();
                generateDummy();

                if (count > total) {
                    $('.btn-load-more').text("END OF PAGE").addClass('disabled');
                    return false;
                }
            }, 500);
        }
    }

    function generateDummy(){
        for(var i = 0; i < 6; i++){
            var image = getRandomInt(1, 25);
            var template = '<div class="col-md-4">' +
                '<div class="article-preview portrait">' +
                '<div class="featured-image">' +
                '<img src="images/misc/preloader.gif" alt="Featured 25" data-echo="images/featured/image'+image+'.jpg"/>' +
                '</div>' +
                '<div class="title-wrapper">' +
                '<p class="category"><a href="category.html">Entertainment</a></p>' +
                '<h1 class="title">' +
                '<a href="article.html">Smile and happy make the world better</a>' +
                '</h1>' +
                '<ul class="timestamp">' +
                '<li>By <a href="profile.html">Wanda Kisaku</a></li>' +
                '<li>12 April 2016</li>' +
                '<li>27 Views</li>' +
                '</ul>' +
                '</div>' +
                '<article>' +
                'After success with single Don’t Let You Go, Reika the band from america starting create' +
                'ivideo clip. Black and white describe about the song that can make feels free...' +
                '</article>' +
                '<div class="rating-wrapper" data-rating="2"></div>' +
                '<ul class="social text-right">' +
                '<li><a href="http://www.facebook.com/infogue" class="facebook"><i class="fa fa-facebook"></i></a></li>' +
                '<li><a href="http://www.twitter.com/infogue" class="twitter"><i class="fa fa-twitter"></i></a></li>' +
                '<li><a href="http://plus.google.com/+infogue" class="googleplus"><i class="fa fa-google-plus"></i></a></li>' +
                '</ul>' +
                '</div>' +
                '</div>';

            $('#articles').append(template);
            $('.rating-wrapper').each(function () {
                var rating = $(this).data('rating');

                $(this).html("");

                for (var index = 0; index < 5; index++) {
                    if (index < rating) {
                        $(this).append("<i class='fa fa-circle rated'></i>")
                    }
                    else {
                        $(this).append("<i class='fa fa-circle'></i>")
                    }
                }
            });
        }
    }

    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

});