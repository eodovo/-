// 패밀리사이트
$(document).ready(function () {
    $('.family .arrow').toggle(function () {
        $('.family .aList').slideDown('fast');
        $('.family .arrow i').addClass('.fa-solid fa-angle-up')
    }, function () {
        $('.family .aList').slideUp('fast');
        $('.family .arrow i').removeClass('.fa-solid fa-angle-up')
    });

    //tab키 처리
    $('.family .arrow').on('focus', function () {
        $('.select .aList').slideUp();
    });
    $('.family .aList li:last a').on('blur', function () {
        $('.family .aList').slideDown();
    });
})