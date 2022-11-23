$(document).ready(function () {

    var yearBox = $('.intro').offset().top + $('.intro').height();
    var cnt = 0;
    $('.sub li:eq(0)').find('a').addClass('spy');
    //첫번째 서브메뉴 활성화

    $('.year h3:eq(0)').addClass('boxMove');
    //첫번째 내용글 애니메이션 처리
    var smh = $('.main').offset().top + 850;  //메인 비주얼의 높이
    var h1 = $('#y2000').offset().top - 600;
    var h2 = $('#y1994').offset().top - 600;

    //스크롤의 좌표가 변하면.. 스크롤 이벤트
    $(window).on('scroll', function () {
        var scroll = $(window).scrollTop();
        //스크롤top의 좌표를 담는다
        if (scroll > yearBox) {
            $('.yearBox').addClass('on');
            $('#headerArea').hide();
            $('.history_wrap').css('marginTop', 150); // 탭 높이만큼 마진
        } else {
            $('.yearBox').removeClass('on');
            $('#headerArea').fadeIn('fast');
            $('.history_wrap').css('marginTop', '');
        }
        //sticky menu 처리
        if (scroll > smh) {
            $('.yearBox').addClass('navOn');
            //스크롤의 거리가 350px 이상이면 서브메뉴 고정
            $('header').hide();
        } else {
            $('.yearBox').removeClass('navOn');
            //스크롤의 거리가 350px 보다 작으면 서브메뉴 원래 상태로
            $('header').show();
        }



        $('.sub li').find('a').removeClass('spy');
        //모든 서브메뉴 비활성화~ 불꺼!!!


        //스크롤의 거리의 범위를 처리
        if (scroll >= 0 && scroll < h1) {
            cnt = 0
        } else if (scroll >= h1 && scroll < h2) {
            cnt = 1
        } else {
            cnt = 2
        }
        $('.sub li:eq(' + cnt + ')').find('a').addClass('spy');
        //첫번째 서브메뉴 활성화

        $('.year h3:eq(' + cnt + ')').addClass('boxMove');
        //첫번째 내용 콘텐츠 애니메이션




        $('.yearBox a').click(function (e) {
            e.preventDefault(); //href="#" 속성을 막아주는..메소드

            var value = 0; //이동할 스크롤의 거리

            if ($(this).hasClass('link1')) {   //첫번째 메뉴를 클릭했냐?   if($(this).is('#link1')){
                value = $('#content #y2009').offset().top - 100;  // 해당 콘테츠의 상단의 거리~~
            } else if ($(this).hasClass('link2')) {
                value = $('#content #y2000').offset().top - 100;
            } else if ($(this).hasClass('link3')) {
                value = $('#content #y1994').offset().top - 100;
            }

            $("html,body").stop().animate({ "scrollTop": value }, 1000);
        });
    });
    // 연혁 붙이기
    $('.year h3').removeClass('current');
    if (scroll > yearBox + 184 && scroll < smh - 10) {
        $('.year h3:eq(0)').addClass('current');
    } else if (scroll >= smh - 10 && scroll < h1 - 10) {
        $('.year h3:eq(1)').addClass('current');
    }
    else if (scroll >= h1 - 10 && scroll < h2 - 10) {
        $('.year h3:eq(2)').addClass('current');
    }


});


