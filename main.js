$(document).ready(function(){
    // 퀵배너
    if($('#evt_quick_menu').length > 0){
        var qbanner_pos = $('#evt_quick_menu').offset().top;

        q_banner(qbanner_pos);

        $(window).scroll(function () {
            q_banner(qbanner_pos);
        });
    }
    // e:퀵배너

    // 체크박스
    $('.agree_wrap input[type="checkbox"]').change(function(){
        var wrap_cont = $(this).closest('.agree_wrap');
        var chk = true;

        if($(this).attr('id').indexOf('agree_all') != -1){
            if($(this).prop('checked')) {
                wrap_cont.find('input[type="checkbox"]').prop('checked',true);
            }else{
                wrap_cont.find('input[type="checkbox"]').prop('checked',false);
            }
        }

        wrap_cont.find('input[type="checkbox"]').not('.agree_all').each(function(){
            if(!$(this).prop('checked')){
                chk = false;
            }
        });

        if(chk) {
            wrap_cont.find('.agree_all').prop('checked',true);
        }else{
            wrap_cont.find('.agree_all').prop('checked',false);
        }
    });

    /*탭*/
    $(".tab_area .tab_button > li").click(function(){
        if($(this).closest('.tab_area').hasClass('login_bf')){
            layer_open('login_layer');
            return false;
        }

        var idx = $(this).index();

        $(this).addClass('on').siblings().removeClass('on');
        $(this).closest('.tab_area').find('> .tab_cont').eq(idx).addClass('on').siblings('.tab_cont').removeClass('on');
    });

    $("div.login_bf").click(function(){
        layer_open('login_layer');
    });

    /*모바일 그래프*/
    var bar_max_h = $('.analysis .graph').outerHeight() - $('.analysis h4').height() - ($('.analysis .graph_wrap').innerHeight() - $('.analysis .graph_wrap').height()); // 그래프 최대 높이 pc 기준
    var top_h = 0;

    $('.analysis .gp_bar li').each(function(){
        $(this).css('height',bar_max_h * ($(this).data('score')/100));

        var this_h = parseInt($(this).css('height').replace('px',''));

        if(top_h < this_h){
            top_h = this_h;
        }
    });
    $('.analysis .gp_bar').css('padding-top',top_h);

    /*nav 상단 고정*/
    if($('.fullservice_tab').length > 0){
        var nav_pos = $('.fullservice_tab').offset().top;
        var nav_h = $('.fullservice_tab').height();
        $(window).scroll(function(){
            var scroll = $(document).scrollTop();

            if(nav_pos < scroll){
                $('.fullservice_tab').css({'position':'fixed','top':0,'left':0,'z-index':'1000'});
                $('#contents').css('padding-top',nav_h);
            }else{
                $('.fullservice_tab').css('position','static');
                $('#contents').css('padding-top',0);
            }
        })
    }

});

function q_banner(quick_banner_pos){
    var scroll_pos = $(document).scrollTop();

    if((scroll_pos > quick_banner_pos - 30) && $('#evt_quick_menu').css('position') !== "fixed"){
        $('#evt_quick_menu').css({'position':'fixed','top':'30px'});
    }else if((scroll_pos <= quick_banner_pos - 30) && $('#evt_quick_menu').css('position') === "fixed"){
        $('#evt_quick_menu').css({'position':'absolute','top':'200px'});
    }
}

function toggle_btn(_this){
    $(_this).toggle();

    if(_this == 'share_info_detail'){
        $('.share_info_btn').text('소문내기 이벤트 유의사항 접기 ▲');
        $('.share_info_btn').text('소문내기 이벤트 유의사항 펼치기 ▼');
    }
}

function getEventAddr(){
    prompt('이 글의 주소입니다. Ctrl+C를 눌러 클립보드로 복사하세요','https://m.hackers.co.kr/?c=s_gov/gtelp_contents/gtelp_marking');
}

function kakao_btn_328() {

    $("#kakao_share").val("1");
    $("#url").val("카카오톡 공유완료!");

    var k_title = "[지텔프 게시글쓰기 이벤트]";
    var k_description = "해커스 지텔프 게시판에 글만 써도 스벅커피 100% 무료!";
    var k_img = "https://gscdn.hackers.co.kr/hackers/files/upload/hackers_event_img_328_201108.jpg";
    var k_url = "https://m.hackers.co.kr/?c=s_gov/gtelp_board/gtelp&uid=396&keywd=mheng_gtelpwritingevt_kakaoshare_201102&logger_kw=mheng_gtelpwritingevt_kakaoshare_201102";

    kakao_sns(k_title, k_description ,k_img, k_url);
}

//소문내기 이벤트 추가
function event_save() {

    var f = document.eventForm;
    var url = f.url.value;
    var nick = f.nick.value;
    var ex_type = f.ex_type.value;
    var ex_date = f.ex_date.value;
    //var kakao_share = $("#kakao_share").val();

    if( !validate(f) ) {
        return false;
    }

    /*if(kakao_share != '1') {

        if (regUrlType(url) == false) {
            alert("url 형식이 맞지 않습니다.");
            $('input[name=url]').focus();
            return;
        }
    }*/

    $.ajax({
        type: "POST",
        url: "/?m=contents&a=gtelp_full_service/url_event",
        data: {
            ex_type         : ex_type,
            ex_date         : ex_date,
            nic         : nick,
            adddata     : url
        },
        dataType : 'json',
        success: function(result) {
            alert(result.msg);
            if(result.code == '00'){
                location.reload();
            }
        }
    });

}

/*팝업 띄우기*/
function layer_open(el, func) {
    var temp = $('#' + el);

    var bg = temp.prev().hasClass('fullservice_layer_bg');	//dimmed 레이어를 감지하기 위한 boolean 변수
    var id = temp.attr("id");

    if(bg){
        $('.fullservice_layer').fadeOut();
        $("#"+id).parent().fadeIn();
        $("body").addClass("fullservice_body");
    }else{
        $('.fullservice_layer').fadeOut();
        temp.fadeIn();
        $("body").addClass("fullservice_body");
    }

    // 화면의 중앙에 레이어를 띄운다.
    if (temp.outerHeight() < $(document).height() ) temp.css('margin-top', '-'+temp.outerHeight()/2+'px');
    else temp.css('top', '0px');
    if (temp.outerWidth() < $(document).width() ) temp.css('margin-left', '-'+temp.outerWidth()/2+'px');
    else temp.css('left', '0px');

    temp.find('.close').click(function(e){
        if(bg){
            $('.fullservice_layer').fadeOut(); //'bg' 클래스가 존재하면 레이어를 사라지게 한다.
            $("body").removeClass("fullservice_body");
        }else{
            $("body").removeClass("fullservice_body");
        }
    });

    if(typeof func=='function'){
        func();
    }
}

function checkPhoneNumber(phoneNumber) {
    var pattern = /^(01[01346-9])-?([1-9]{1}[0-9]{2,3})-?([0-9]{4})$/;
    var ret = false;
    if (phoneNumber != '') {
        if (pattern.test(phoneNumber) ) {
            ret = true;
        }
    }
    return ret;
}

function serviceLogout(){
    $("form[name='logoutForm']").submit();
}


var saveCheck_join = function(f) {

    if( !validate(f) ) {
        return false;
    }

    if (!/^(?=.*[a-z])(?=.*[0-9]).{10,20}$/.test($('#join_password').val())){
        alert("비밀번호는 영문/숫자 포함 10자리로 입력해주세요.");
        return false;
    }

    if ($('#join_password').val() != $('#join_password_chk').val()){
        alert("비밀번호가 일치하지 않습니다.");
        return false;
    }
    var nic = $(f).find('input[name="join_nic"]').val();
    var phone = $(f).find('input[name="join_phone"]').val();
    var email1 = $(f).find('input[name="join_email1"]').val();
    var email2 = $(f).find('input[name="join_email2"]').val();
    var domain = $('#join_domain').val();
    var mobile = $(f).find('input[name="agent"]').val();
    var private_agree_state = $(f).find('input[name="private_agree_state"]').val();
    var evt_agree_state = $(f).find('input[name="evt_agree_state"]').val();
    var five_agree_state = $(f).find('input[name="five_agree_state"]').val();

    if(!email1){
        regExp = /[~!@\#$%^&*\()\=+_']/gi;
        if (nic.match(regExp)) {
            alert('특수문자는 입력하실 수 없습니다.');
            $('input[name=nic]').focus();
            return false;
        }

        regExp = /[~!@\#$%^&*\()\=+']/gi;
        if(email1.match(regExp)){
            alert('특수문자는 입력하실 수 없습니다.');
            return false;
        }
    }
    if (domain == 'my') {
        if(email2 == ''){
            alert("도메인을 입력하여 주십시오.");
            return false;
        }
        regExp = /[~!@\#$%^&*\()\=+']/gi;
        if (email2.match(regExp)) {
            alert('도메인에 특수문자는 입력하실 수 없습니다.');
            return false;
        }
    }

    if(!private_agree_state){
        alert('개인정보 수집/이용에 동의해주세요.');
        return false;
    }

    //$(".fullservice_layer").css("display","none");
}

function examSubmit(f){
    var flag = false;
    var abcd = /^(a|b|c|d|1|2|3|4)$/i;

    $(f).find("[name='answer[]']").each(function(i){
        if($(this).val()){
            flag = true;
        }

        if(!abcd.test($(this).val())){
            $(f).find("[name='descriptive_answer[]']").eq(i).val($(this).val());
            $(this).val('');
        }
    });

    if(!flag){
        alert('정답을 입력하세요.');
        return false;
    }
}


//이름찾기
var nameFind = function(f) {
    if( !validate(f) ) {
        return false;
    }
    var phone  = f.find("input[name='phone']").val();
    var ex_type  = f.find("input[name='ex_type']").val();

    $.ajax({
        type: "post",
        url: "/?m=contents&a=gtelp_full_service/set_score_service_member",
        data: {
            mode : 'find_name',
            ex_type : ex_type,
            phone: phone
        },
        dataType : 'json',
        success: function(result) {
            console.log(result);
            if(result.code == '00'){
                $(".name_val").html("<strong>등록된 이름은 <span>"+ result.nic+"</span>입니다</strong>");
            }else{
                $(".name_val").html("<strong>등록되지 않은 번호입니다. <br> 정답서비스 신청을 해주세요.</strong>");
            }
        }
    });
    return false;
}


var auth_code = "";
var user_cert = "";
var CheckSendCert = "";
function doSendCert(flag){
    if(flag=="join" || flag=="find"){

        var phone = $('#'+flag+'_phone').val();
        var phone = $('#'+flag+'_phone').val();

        if(phone == '') {
            alert('핸드폰 번호를 입력해주세요');
            return;
        }
        if(phone.length==10){
            var phone1 = phone.substring(0,3);
            var phone2 = phone.substring(3,6);
            var phone3 = phone.substring(6,10);
        }else{
            var phone1 = phone.substring(0,3);
            var phone2 = phone.substring(3,7);
            var phone3 = phone.substring(7,11);
        }

    }else{
        var phone1 = $('#'+flag+'_phone1').val();
        var phone2 = $('#'+flag+'_phone2').val();
        var phone3 = $('#'+flag+'_phone3').val();

        if(phone1 == '' || phone2 == '' || phone3 == '') {
            alert('핸드폰 번호를 입력해주세요');
            return;
        }

        if(isNaN(phone1) || isNaN(phone2) || isNaN(phone3)){
            alert('핸드폰 번호를 확인해주세요');
            return false;
        }
    }

    $.ajax({
        type: "post",
        url: "/?m=sitemanager&a=send_sms",
        data: {
            phone: phone1 +"-"+ phone2 +"-"+ phone3,
            wdate: new Date().format("yyyy-MM-dd HH:mm:ss"),
            sub_category: "authcode",
            callback: "0234530654",
            category: "",
            sub_category2: "event",
            familysite: "",
            subject: "",
            msg_str: "[해커스] 인증번호[******]를 입력해 주세요."
        },
        success: function(result) {
            rdata = JSON.parse(result);
            auth_code = rdata.autocode;
            CheckSendCert = '';
            alert('인증번호가 발송되었습니다.');
            return;
        }
    });
};
//비밀번호찾기
var saveCheckFind = function(f) {
    if( !validate(f) ) {
        return false;
    }
    console.log(CheckSendCert);
    if((CheckSendCert != "Y")){
        alert("인증번호 확인하기를 먼저 진행 해주시기 바랍니다.");
        return false;
    }

    if($('#find_cert_num').val() != auth_code){
        alert("인증번호를 확인하여 주시기 바랍니다.");
        return false;
    }
    $('#pass_phone').val($('#find_phone').val());
    layer_open('password_layer2');
};

//인증번호 확인
function doCheckSendCert(flag) {
    if(flag == 'join') {
        user_cert = $('#cert_num').val();
    } else if(flag == 'find') {
        user_cert = $('#find_cert_num').val();
    } else if(flag == 'nic') {
        $('#cert_num_check').val('1');
        user_cert = $('#nic_cert_num').val();
    }
    if((user_cert != auth_code) || (user_cert=='')) {
        alert('인증번호가 일치하지 않습니다.');
        //doSendCert(flag);
        return;
    } else {
        alert('인증이 완료되었습니다!');
        CheckSendCert = "Y";
        return;
    }
}

//비밀번호변경
var savePass = function(f) {
    if( !validate(f) ) {
        return false;
    }

    if($(f).find('input[name="new_pass"]').val() != $(f).find('input[name="new_pass_conf"]').val()){
        alert("비밀번호가 일치하지 않습니다.");
        return false;
    }
};

var showType = function(type){
    switch(type){
        case 'analysis' :
            $('.chk_answer').addClass('hide');
            $('.analysis').removeClass('hide');
            break;
        case 'chk_answer' :
            $('.chk_answer').removeClass('hide');
            $('.analysis').addClass('hide');
            break;
    }
};