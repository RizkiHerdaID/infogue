/**
 * Created by Workstation on 2/14/2016.
 */
$(function(){
    var isLarge = false;
    var isMedium = false;
    var isSmall = false;
    var isExtraSmall = false;

    // NAVIGATION -------------------------------------------------------
    var navigation = $('#navigation').superfish({
        speed: 'fast',
        cssArrows: false,
        delay: 100
    });

    setDevice();
    setLayout();

    $(window).resize(function () {
        setDevice();
        setLayout();
    });

    function setDevice(){
        var viewportWidth = $(window).width();
        isLarge = (viewportWidth >= 1200);
        isMedium = (viewportWidth >= 993 && viewportWidth <= 1199);
        isSmall = (viewportWidth >= 768 && viewportWidth <= 992);
        isExtraSmall = (viewportWidth <= 767);
    }

    $('#navigation > li').hover(function(){
        var text = $(this).find("a").first().text();
        var wrapper = "<a href='#'>"+text+"</a>";
        $(".level-dummy").removeClass("blank");
        $(".level-dummy").html(wrapper);

        setTimeout(function(){
            $(".level-1").removeClass("blank");
            $(".level-1").html(wrapper);
            $(".level-1").css("width", $(".level-dummy").width());
        }, 0);
    }, function(){
        $(".level-dummy").addClass("blank");
        $(".level-dummy").html("");

        $(".level-1").addClass("blank");
        $(".level-1").html("");
        $(".level-1").css("width", "40px");
    });

    $('#navigation .sf-mega a').hover(function(){
        var wrapper = "<a href='#'>"+$(this).text()+"</a>";
        $(".level-dummy").removeClass("blank");
        $(".level-dummy").html(wrapper);

        setTimeout(function(){
            $(".level-2").removeClass("blank");
            $(".level-2").html(wrapper);
            $(".level-2").css("width", $(".level-dummy").width());
        }, 0);
    }, function(){
        $(".level-dummy").addClass("blank");
        $(".level-dummy").html("");

        $(".level-2").addClass("blank");
        $(".level-2").html("");
        $(".level-2").css("width", "40px");
    });

    $(".navigation-toggle").click(function(){
        $("#navigation").slideToggle(200);
        $("#navigation").toggleClass("open");
    });

    $('html').click(function() {
        $(".level-1").html("").addClass("blank").css("width", "40px");;
        $(".level-2").html("").addClass("blank").css("width", "40px");;
        $("#navigation").slideUp(200);
    });

    $('.navigation').click(function(event){
        event.stopPropagation();
    });

    function setLayout(){
        // NAVIGATION
        if(isSmall || isExtraSmall){
            console.log('destroy superfish');
            navigation.superfish('destroy');
            $("#navigation").hide();
        }
        else{
            console.log('init superfish');
            navigation.superfish({
                speed: 'fast',
                cssArrows: false,
                delay: 100
            });
            $("#navigation").removeClass("open").css("display", "block");
        }
    }
});