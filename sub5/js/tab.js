// JavaScript Document

$(document).ready(function () {
    var cnt = 4;  //탭메뉴 개수 ***
    $('.contentArea .contlist:eq(0)').show(); // 첫번째 탭 내용만 열어라
    $('.contentArea .tab_menu li:eq(0)').css('border', '1px solid red')
    // $('.contentArea .contlist:eq(0)').siblings().hide('.contlist'); // 첫번째 탭 내용만 열어라
    $('.contentArea .tab1').css({
        background: '#fff',
        color: '#da291c'
    })
    // }'background', ).css('color', '##da291c'); //첫번째 탭메뉴 활성화
    //자바스크립트의 상대 경로의 기준은 => 스크립트 파일을 불러들인 html파일이 저장된 경로 기준***
    // const hov = document.querySelector('.tap')
    // function hover() {
    //     hov.setAttribute('style', 'color', '#fff')
    //     hov.setAttribute('style', 'background', '#da291c')
    // }
    // hov.addEventListener('mouseover', hover)


    $('.contentArea .tab').click(function (e) {
        e.preventDefault();   // <a> href="#" 값을 강제로 막는다  
        var ind = $(this).index('.contentArea .tab');  // 클릭시 해당 index를 뽑아준다
        //console.log(ind);
        // $(this).siblings().css('border', '1px solid #da291c')
        $(".contentArea .contlist").hide(); //모든 탭내용을 안보이게...
        $(".contentArea .contlist:eq(" + ind + ")").show(); //클릭한 해당 탭내용만 보여라
        $('.tab').css('background', '#fff').css('color', '#999'); //모든 탭메뉴를 비활성화
        $('.tab').parent('li').css('border', 'none'); //모든 탭메뉴를 비활성화
        $(this).css('background', '#fff').css('color', '#da291c'); // 클릭한 해당 탭메뉴만 활성화
        $(this).parent('li').css('border', '1px solid red')

    });

    var memo = [
        {
            name: '연구 부문',
            title: '화학',
            text: '전문 제제와 범용 제제를 개발하는 것은 물론 계속해서 새로운 용도를 고안합니다. 또한 기존 사업의 원가 절감 및 품질 차별화를 목표로 연구를 기획, 기술 인프라와 역량을 최대치로 활용하는 방향으로 생산 공정을 개선합니다.국내‧외 고객사를 방문하여 제품 규격을 추천‧조정하는 기술 지원 업무를 수행하고, 신규 고객사를 확보하는 한편 기술과 관련된 VOC(Voice of Customer, 고객 의견)를 연구 활동에 적극 수렴‧반영합니다.'
        },
        {
            name: '연구 부문',
            title: '의약',
            text: '약물 용해도 개선 등 지적 재산화와 기술 수익화 과제도 의약 연구에서 진행됩니다. 당사품이 적용된 완제 의약품 사례를 발굴하는 등 제품 활용을 제고하고, 개발 제제 기술과 관련한 글로벌 홍보를 수행합니다. 더불어 성분과 효과 및 복용 방식에 영향을 미치는 코팅‧장용‧건기식 등의 제제 개발과 함께 고객 기술 지원 업무를 담당합니다.'
        },
        {
            name: '연구 부문',
            title: '식품',
            text: '수요 업체와 유통 채널을 대상으로 제제 교육을 진행하며, 고객사 프로모션 업무를 담당합니다. 또한 그룹 내 연구‧개발 시너지 제고를 위한 다양한 네트워킹 활동을 수행합니다.'
        },
        {
            name: '생산관리 부문',
            title: 'AnyCoat 담당',
            text: '롯데정밀화학이 생산하는 제품의 특성을 명확히 파악하는 것을 기본으로 원료 수급 및 원가와 재고 관리 업무를 통해 전반적인 제품 생산‧운영 계획을 세웁니다. 그 계획에 따라 생산 현장, 영업 담당과 긴밀한 커뮤니케이션을 유지하여 품질 안정화를 실현합니다. 또한 지속적으로 설비 가동 현황과 기술 자료를 파악하여 공정 개선과 증설을 검토‧추진합니다.'
        },
        {
            name: '생산지원 부문',
            title: '기계',
            text: '각종 설비 투자와 보전, 설비 이력 관리, 장치 검사, 시설 관리 등의 업무를 계획하고 실행합니다. 더불어 국내‧외 설비 규격과 코드 등을 유지‧관리에 적용하여 설비 이상을 예방하고, 설비 여건을 개선합니다.'
        },
        {
            name: '생산지원 부문',
            title: '전기',
            text: '전력 계통의 설계‧운영‧기술 검토를 포함한 관리 업무 전반을 수행하여 장치 프로그램 문제 발생(Utility Trouble)에 따른 생산라인 손실을 예방하여 공장에 안정적인 전력을 공급합니다. 이와 함께 전기 및 계전과 관련한 설비 투자와 보전, 설비 이력 관리, 시설 관리 등의 업무를 계획하고 실행합니다. 또한 외부 감사 관련 업무와 함께 외주 보수 및 수리 작업을 관리합니다.'
        },
        {
            name: '생산지원 부문',
            title: '안전',
            text: '공장 내부의 사고 위험성을 찾고, 제어하여 안전한 환경을 유지합니다. 이를 위해 전사 안전방재 기획, 안전작업 표준 관리, 공정안전관리(PSM), 법정 안전교육 운영, 협력사 안전 관리 등의 업무를 수행합니다.'
        },
        {
            name: '생산지원 부문',
            title: '환경',
            text: '화관법 및 화평법에 따라 화학물질 취급을 위한 인허가, 법정검사 수검, 법정 보고, 법정 교육 등의 업무를 담당하며 물질 등록에 필수적인 유해성‧위해성 심사에 대응합니다. '
        },
        {
            name: '생산지원 부문',
            title: '토목',
            text: '정기 보수 계획과 보전 전략을 수립하고, 설비 보전 체계 및 설비 표준 사항을 정립합니다. 이와 함께 전반적인 건축 공사를 기획하고, 그에 따른 예산 검토 업무를 수행하며, 공사 현장 일정 및 품질‧안전 등 시공 현장 관리 업무를 수행합니다.'
        },
        {
            name: '경영지원 부문',
            title: '재무',
            text: '경영 상황과 목표에 따라 자금 계획을 세워 운용합니다. 회사의 자금 집행 상황과 실적을 분석하여 안정된 재무 상태를 유지‧관리합니다.'
        },
        {
            name: '경영지원 부문',
            title: '경영기획',
            text: '전사 경영 실적 추정 관리, 목표 대비 실적 추정 분석 및 대책 수립 업무를 기반으로 계획 관리, 목표 관리, 예산 관리, 조직 및 지표 관리 등의 업무를 포괄합니다.'
        },
        {
            name: '경영지원 부문',
            title: '인사',
            text: '채용, 교육, 인력 운용, 평가 및 보상 제도 운영, 노무 기획 및 전략 수립 등의 업무를 진행합니다.'
        }
    ]
    var inner = 0;
    var txt = '';
    function popchange() {
        txt = '';
        txt += '<p>' + memo[inner].name + '</p>'
        txt += '<dl>';
        txt += '<dt>' + memo[inner].title + '</dt>';
        txt += '<dd>' + memo[inner].text + '</dd>';
        txt += '</dl>';
        $('.section2 li .popup p').html(txt);
    }

    $('.section2 .contlist a').click(function (e) {
        e.preventDefault();
        inner = $(this).index('.section2 .contlist a')
        // var menu = $(this).index('.section2 .contlist a');  // 0 1 2 3
        $('.section2 .modal_box').fadeIn('fast');
        $('.section2 .popup').fadeIn('slow');
        popchange()

    });

    $('.close_btn,.section2 .modal_box').click(function (e) {
        e.preventDefault();
        $('.section2 .modal_box').hide();
        $('.section2 .popup').hide();
    });
});

