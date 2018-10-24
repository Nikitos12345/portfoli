var scroll = new SmoothScroll('a[href*="#"]', {
    ignore: '[data-scroll-ignore]',
    speed: 1000
});
$(window).scroll(function() {
    var the_top = jQuery(document).scrollTop();
    if (the_top > 50) {
        $('.scroll-bar').css('height','auto');
    }
    else {
        $('.scroll-bar').css('height','100px');
    }
});
$('.nav-item').click(function() {
    $(this).parent().find('.active').removeClass('active');
    $(this).addClass('active');
});