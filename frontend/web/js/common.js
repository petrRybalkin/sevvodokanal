$(function() {
    $('a[href*="#"]:not([href="#"])').click(function() {
        if (
            location.pathname.replace(/^\//, "") ==
            this.pathname.replace(/^\//, "") &&
            location.hostname == this.hostname
        ) {
            var target = $(this.hash);
            target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
            if (target.length) {
                $("html, body").animate(
                    {
                        scrollTop: target.offset().top
                    },
                    1000
                );
                return false;
            }
        }
    });
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 200) {
            $("div.bigmenu").addClass("bg-teal");
        } else {
            $("div.bigmenu").removeClass("bg-teal");
        }
    });
    $('#burger').on('click', function(){
        if ($('#menu').hasClass('hidden')){
            $('div.bigmenu').removeClass('bg-transparent').addClass("bg-teal");
            $('#menu').removeClass('hidden');
        } else {
            $("div.bigmenu").removeClass("bg-teal").addClass('bg-transparent');
            $('#menu').addClass('hidden');
        }
    });
    $('#burger2').on('click', function(){
        if ($('#menu').hasClass('hidden')){
            $('div.bigmenu').removeClass('bg-transparent').addClass("bg-teal");
            $('#menu').removeClass('hidden');
        } else {
            $("div.bigmenu").removeClass("bg-teal").addClass('bg-transparent');
            $('#menu').addClass('hidden');
        }
    });
});