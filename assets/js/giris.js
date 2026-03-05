$(document).ready(function() {

    $('.login').keypress(function(e) {
        if (e.which == 13) {
            $(".login__submit").trigger("click");
            return false;
        }
    });

    var animating = false;

    function ripple(elem, e) {
        $(".ripple").remove();
        var elTop = elem.offset().top,
                elLeft = elem.offset().left,
                x = e.pageX - elLeft,
                y = e.pageY - elTop;
        var $ripple = $("<div class='ripple'></div>");
        $ripple.css({top: y, left: x});
        elem.append($ripple);
    }
    ;

    $(document).on("click", ".login__submit", function(e) {
        if (animating)
            return;
        animating = true;
        var that = this;
        ripple($(that), e);
        $(that).addClass("processing");
        
        document.activeElement.blur();
        
        setTimeout(function() {

            var yol = jsPath + 'giris/kontrol';
            var formdata = $("#formk").serialize();

            $.post(yol, formdata, function(data) {
                if (data == 1) {
                    setTimeout('window.location.href="' + jsPath + '"', 500);
                } else {

                    $( ".login").addClass("shake");

                    setTimeout(function(){
                        $( ".login").removeClass("shake");
                    },2000);

                    animating = false;
                    $(that).removeClass("success processing");

                    $("input[name=username]").val("");
                    $("input[name=password]").val("");
                }
            });

        }, 1100);

    });

});