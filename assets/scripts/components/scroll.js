import $ from "jquery";

$(function () {
    let $width = $(window).width() + 15;

    if ($width < 768) {
        $('#scroll-top').addClass('d-none').removeClass('d-md-block');
        $('#scroll-bottom').addClass('d-none').removeClass('d-md-block');
    } else {
        $(window).scroll(function () {
            let scrollTop = $(window).scrollTop();
            if (scrollTop > 50) {
                $('#scroll-bottom').addClass('d-none').removeClass('d-md-block');
                $('#scroll-top').addClass('d-md-block').removeClass('d-none');
            } else {
                $('#scroll-bottom').addClass('d-md-block').removeClass('d-none');
                $('#scroll-top').addClass('d-none').removeClass('d-md-block');
            }
        });
    }
})