
$(document).ready(function () {

    var smh = $('.main').height();  //비주얼 이미지의 높이를 리턴한다   900px
    var on_off = false;  //false(안오버)  true(오버)
    $('#headerArea').mouseenter(function () {
        // var scroll = $(window).scrollTop();
        $(this).css('background', '#fff');
        $('.dropdownmenu li a').css('color', '#333');
        $('.headerInner .topMenu li a').css('color', '#333');
        $('<span></span>').appendTo('.topMenu').css({
            'position': 'absolute',
            'display': 'block',
            'width': '2px',
            'height': '13px',
            'background': '#333',
            'left': '93px',
            'top': '5px'
        });
        on_off = true;
    });

    $('#headerArea').mouseleave(function () {
        var scroll = $(window).scrollTop();  //스크롤의 거리

        if (scroll < smh - 230) {
            $(this).css('background', 'rgba(0,0,0,.3)');
            $('.dropdownmenu li a').css('color', '#fff');
            $('.headerInner .topMenu li a').css('color', '#fff');
            $('.headerInner .topMenu span').remove();
        } else {
            $(this).css('background', '#fff');
            $('.dropdownmenu li a').css('color', '#333');
            $('.headerInner .topMenu li a').css('color', '#333');
            $('<span></span>').appendTo('.topMenu').css({
                'position': 'absolute',
                'display': 'block',
                'width': '2px',
                'height': '13px',
                'background': '#333',
                'left': '93px',
                'top': '5px'
            });
        }
        on_off = false;
    });

    $(window).on('scroll', function () {//스크롤의 거리가 발생하면
        var scroll = $(window).scrollTop();  //스크롤의 거리를 리턴하는 함수
        //console.log(scroll);

        if (scroll > smh - 230) {//스크롤300까지 내리면
            $('#headerArea').css('background', '#fff').css('border-bottom', '1px solid #ccc');
            $('.dropdownmenu li a').css('color', '#333');
            $('.headerInner .topMenu li a').css('color', '#333');
            $('<span></span>').appendTo('.topMenu').css({
                'position': 'absolute',
                'display': 'block',
                'width': '2px',
                'height': '13px',
                'background': '#333',
                'left': '93px',
                'top': '5px'
            });

        } else {//스크롤 내리기 전 디폴트(마우스올리지않음)
            if (on_off == false) {
                $('#headerArea').css('background', 'rgba(0,0,0,.3)').css('border-bottom', 'none');;
                $('.dropdownmenu li a').css('color', '#fff');
                $('.headerInner .topMenu li a').css('color', '#fff');
                $('.headerInner .topMenu span').remove();
            }
        };

    });




    //2depth 열기/닫기
    $('ul.dropdownmenu').hover(
        function () {
            $('ul.dropdownmenu li.menu ul').fadeIn('normal', function () { $(this).stop(); }); //모든 서브를 다 열어라
            $('#headerArea').animate({ height: 450 }, 'fast').clearQueue();
        }, function () {
            $('ul.dropdownmenu li.menu ul').hide(); //모든 서브를 다 닫아라.
            $('#headerArea').animate({ height: 230 }, 'fast').clearQueue();
        });

    //1depth 효과 
    $('ul.dropdownmenu li.menu').hover(
        function () {
            $('.depth1', this).css('color', ' #003660')
            $(this).closest("li").find(".dot").animate({
                left: 40,
                top: 16,
                opacity: 1
            }, 100).clearQueue()
            $(this).closest("li:nth-of-type(3)").find(".dot").animate({
                left: 20,
                top: 16,
                opacity: 1
            }, 100).clearQueue()
            $('.dropdownmenu .menu ul li').css('color', '#fff')
        }, function () {
            $('.depth1', this).css('color', '#333');
            $(this).closest("li").find(".dot").animate({
                left: 90,
                top: 40,
                opacity: 0
            }).clearQueue()
        }, 100);


    //tab 처리
    $('ul.dropdownmenu li.menu .depth1').on('focus', function () {
        $('ul.dropdownmenu li.menu ul').slideDown('normal');
        $('#headerArea').animate({ height: 450 }, 'fast').clearQueue();
    });

    $('ul.dropdownmenu li.m6 li:last').find('a').on('blur', function () {
        $('ul.dropdownmenu li.menu ul').slideUp('fast');
        $('#headerArea').animate({ height: 230 }, 'normal').clearQueue();
    });

    $('#zoom').click(function () {
        $('.search').slideToggle();
    });
    $('.search i').click(function () {
        $('.search').slideToggle();
    });
    // let value = document.querySelector('#searchBar').value

    // function ad() {
    //     console.log(value)
    // }
    // addEventListener('click', ad)


    $('.inText a').click(function (event) {
        event.preventDefalut();
        var text1 = $(this).text();
        $('#searchBar').attr('value', text1);
    })
});
