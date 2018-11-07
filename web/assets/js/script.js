function menuScroll() {
    $(window).scroll(function() {
        var the_top = $(document).scrollTop();
        if (the_top > 50) {
            $('.scroll-bar').css('height','auto');
        }
        else {
            $('.scroll-bar').css('height','100px');
        }
    });
}
function smooth() {
    var scroll = new SmoothScroll('a[href*="#"]', {
        ignore: '[data-scroll-ignore]',
        speed: 1000
    });
}
menuScroll();
smooth();

var menu_selector = "#topmenu";
function onScroll(){
    var scroll_top = $(document).scrollTop();
    $(menu_selector + " a").each(function(){
        var hash = $(this).attr("href");
        var target = $(hash);
        if (target.position().top <= scroll_top && target.position().top + target.outerHeight() > scroll_top) {
            $(menu_selector + " li.active a").parent().removeClass("active");
            $(this).parent().addClass("active");
        }
    });
}
$(document).ready(function () {
    $(document).on("scroll", onScroll);
    $("a[href*='#']").click(function(e){
        e.preventDefault();
        $(document).off("scroll");
        $(menu_selector + " li.active a").parent().removeClass("active");
        $(this).parent().addClass("active");
        var hash = $(this).attr("href");
        var target = $(hash);
        $("html, body").animate({
            scrollTop: target.offset().top
        }, 500, function(){
            window.location.hash = hash;
            $(document).on("scroll", onScroll);
        });
    });
});
