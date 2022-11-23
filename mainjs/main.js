// 사업영역

$(document).ready(function () {
  var imageCount = $(".businessItem li").size(); //이미지 개수 ***
  var cnt = 1; //이미지 순서 1 2 3 4 5 4 3 2 1 2 3 4 5 ...
  var direct = 1; //1씩 증가(+1)/감소(-1)
  var position = 0; //겔러리 무비의 left값 0 -1000 -2000 -3000 -4000

  $(".slide1").css("background", "#f00"); //첫번째 불켜
  $(".slide1").css("width", "30");
  $(".business_text li:eq(0)").fadeIn("slow"); //첫번째 텍스트만 보여라~~~
  $(".businessItem ul li:eq(0)").siblings().css("filter", "brightness(0.5) grayscale(1)");

  function moveg() {
    cnt += direct;
    position = -(cnt - 1) * 1200;
    $(".businessItem").animate({ left: position }, "slow"); //겔러리 무비의 left값을 움직여라~
    $(".business_text li").hide(); //모든 텍스트를 안보이게...
    $(".business_text li:eq(" + (cnt - 1) + ")").fadeIn("slow"); //해당 텍스트만 보여라
    for (var i = 1; i <= imageCount; i++) {
      $(".slide" + i).css("background", "#00f"); //버튼불다꺼!!
      $(".slide" + i).css("width", "16");
    }
    $(".slide" + cnt).css("background", "#f00"); //자신만 불켜
    $(".slide" + cnt).css("width", "30");
    if (cnt == imageCount) direct = -1;
    if (cnt == 1) direct = 1;
  }

  $(".mbutton").click(function (event) {
    //각각의 버튼을 클릭한다면...

    var $target = $(event.target); //$target == this =>실제 클릭한 버튼

    for (var i = 1; i <= imageCount; i++) {
      $(".slide" + i).css("background", "#00f"); //버튼 모두불꺼
      $(".slide" + i).css("width", "16");
    }
    if ($target.is(".slide1")) {
      //첫번째 버튼을 클릭했다면...
      $(".businessItem").animate({ left: 0 }, "slow");
      cnt = 1;
      direct = 1;
    } else if ($target.is(".slide2")) {
      //두번째 버튼을 클릭했다면...
      $(".businessItem").animate({ left: -1200 }, "slow");
      cnt = 2;
    } else if ($target.is(".slide3")) {
      //세번째 버튼을 클릭했다면...
      $(".businessItem").animate({ left: -2400 }, "slow");
      cnt = 3;
    } else if ($target.is(".slide4")) {
      //네번째 버튼을 클릭했다면...
      $(".businessItem").animate({ left: -3600 }, "slow");
      cnt = 4;
    }
    $(".business_text li").hide();
    $(".business_text li:eq(" + (cnt - 1) + ")").fadeIn("slow");
    $(".slide" + cnt).css("background", "#f00"); //자신 버튼만 불켜
    $(".slide" + cnt).css("width", "30");
  });
  $(".business .slide").click(function () {
    if ($(this).is(".right")) {
      if (cnt == imageCount) cnt = 0; //카운트가 마지막 번호(5)라면 초기화 0
      if (cnt == imageCount + 1) cnt = 1;
      cnt++; //카운트 1씩증가
    } else if ($(this).is(".left")) {
      if (cnt == 1) cnt = imageCount + 1;
      if (cnt == 0) cnt = imageCount;
      cnt--; //카운트 감소
    }
    $(".businessItem")
      .animate({ left: (cnt - 1) * -1200 }, "slow")
      .clearQueue(); // 1->0 2->-1000 3->-2000 4->-3000 5->-4000
    $(".business_text li").hide(); //모든 텍스트를 안보이게...
    $(".business_text li:eq(" + (cnt - 1) + ")").fadeIn("slow"); //해당
    $(".businessItem ul li").css("filter", "brightness(0.5) grayscale(1)");

    $(".businessItem ul li:eq(" + (cnt - 1) + ")").css("filter", "none");
    for (var i = 1; i <= imageCount; i++) {
      $(".slide" + i).css("background", "#00f"); //버튼 모두불꺼
      $(".slide" + i).css("width", "16");
    }
    $(".slide" + cnt).css("background", "#f00"); //자신 버튼만 불켜
    $(".slide" + cnt).css("width", "30");
  });

  // PR 자료실

  var position = 0; //최초위치
  var movesize = 395; //이미지 하나의 너비 이미지 width + margin
  // position 2340 = 410*6 (ul 안 li 개수)

  $(".slide_gallery ul").after($(".slide_gallery ul").clone());

  $(".switch").click(function (event) {
    event.preventDefault();
    //clearInterval(timeonoff);

    if ($(this).is(".c1")) {
      //이전버튼 클릭
      if (position == -2370) {
        $(".slide_gallery").css("left", -0);
        position = -0;
      }

      position -= movesize; // 150씩 감소
      $(".slide_gallery")
        .stop()
        .animate({ left: position }, "fast", function () {
          if (position == -2370) {
            $(".slide_gallery").css("left", 0);
            position = 0;
          }
        });
    } else if ($(this).is(".c2")) {
      //다음버튼 클릭
      if (position == 0) {
        $(".slide_gallery").css("left", -2370);
        position = -2370;
      }

      position += movesize; // 150씩 증가
      $(".slide_gallery")
        .stop()
        .animate({ left: position }, "fast", function () {
          if (position == 0) {
            $(".slide_gallery").css("left", -2370);
            position = -2370;
          }
        });
    }
  });

  // var memo = ['LFC Green materials Business Brand Film', '[유록스×박기량]', '[롯데그룹] 남성육아휴직', '롯데 글로벌 통합 캠페인', '롯데정밀화학 Corporate Film', 'LFC Ulsan Plant'];

  // $('.pr .prList a').click(function (e) {
  //   e.preventDefault();

  //   var ind = $(this).index('.pr .prList a');  // 0 1 2 3

  //   $('.pr .modal_box').fadeIn('fast');
  //   $('.pr .popup').fadeIn('slow');

  //   $('.pr .popup img').attr('src', './images/big' + (ind + 1) + '.jpg');
  //   $('.pr .popup p').text(memo[ind]).css({
  //     fontSize: '20px',
  //     textAlign: 'left',
  //     padding: "10px 0 0 30px",
  //     margin: "15px 0"
  //   });
  //   $('.pr .popup').css({
  //     borderTop: "10px solid red"
  //   })
  // });

  // $('.close_btn,.pr .modal_box').click(function (e) {
  //   e.preventDefault();
  //   $('.pr .modal_box').hide();
  //   $('.pr .popup').hide();
  // });

  // 인덱스 애니메이션

  $(window).on("scroll", function () {
    //스크롤 값의 변화가 생기면
    var mainScroll = $(window).scrollTop(); //스크롤의 거리
    // var mainScrollGap = $(window).height() / 2;
    var mainScrollGap = $(window).height() - 500;

    // BUSINESS
    var mainBusiness = $(".businessItem").offset().top - mainScrollGap;
    if (mainScroll > mainBusiness) {
      $(".businessItem").addClass("active");
    } else if (mainScroll < mainBusiness - 500) {
      $(".businessItem").removeClass("active");
    }

    // 소셜영역
    var social = $(".social").offset().top - mainScrollGap;
    if (mainScroll > social) {
      $(".social").addClass("active");
    } else if (mainScroll < social - 500) {
      $(".social").removeClass("active");
    }

    // pr자료실
    var pr = $(".slideGalleryBox").offset().top - mainScrollGap;
    if (mainScroll > pr) {
      $(".slideGalleryBox").addClass("active");
    } else if (mainScroll < pr - 500) {
      $(".slideGalleryBox").removeClass("active");
    }

    // 회사소식
    var news = $(".board").offset().top - mainScrollGap - 100;
    if (mainScroll > news) {
      $(".board").addClass("active");
    } else if (mainScroll < news - 500) {
      $(".board").removeClass("active");
    }

    // 사업장안내
    var world = $(".worldMap").offset().top - mainScrollGap - 200;
    if (mainScroll > world) {
      $(".worldMap").addClass("active");
    } else if (mainScroll < world - 500) {
      $(".worldMap").removeClass("active");
    }
  });
});
