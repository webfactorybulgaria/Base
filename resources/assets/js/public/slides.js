/* Slides */
var winW = window.innerWidth,
    windWResized = winW;

var mySwiper = new Swiper('.swiper-container', {
    loop: true,
    autoplay: 6000,
    effect: 'fade',
    // pagination: '.swiper-pagination',
    paginationClickable: true,
    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev'
});

$(function() {
    var swipweHeight = function() {
        swiperHeight = Math.round(window.innerHeight * 0.8); // 80% of winH
        $('.swiper-home .swiper-slide').height(swiperHeight);
    };
    swipweHeight();
});

$(window).on('resize', function() {
    winWResized = window.innerWidth;

    if(winW != winWResized) {
        swipweHeight();
    }
    winW = winWResized;
});

