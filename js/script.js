$(window).on('scroll', function() {
    scroll_top = $(this).scrollTop();
    neededScroll = 500;
    if (scroll_top >= neededScroll) {
        $(".navbar").addClass('nav-sticky')
    } else {
        $('.navbar').removeClass('nav-sticky')
    }
});