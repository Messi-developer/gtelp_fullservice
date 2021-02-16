<div class="share_top">
    <?if($device == 'pc'){?>
        <img src="<?=$img_url; ?>share.jpg" alt="" usemap="#share" />
        <map name="share">
            <area shape="rect" coords="195,715,435,748" href="/?r=hackers&m=event&a=download&_path=upload&_name=gtelp_share_event_2020.jpg&_rename=소문내기이벤트.jpg" target="_blank" alt="이미지 다운받기"  />
            <area shape="rect" coords="445,715,685,746" href="#" onclick="getEventAddr();" alt="이벤트 주소 복사" />
            <area shape="circle" coords="224,856,30" href="#;" onclick="kakao_btn_328();"  alt="카카오" />
            <area shape="circle" coords="310,856,30" href="https://twitter.com/?lang=ko" target="_blank" alt="트위터" />
            <area shape="circle" coords="397,854,30" href="https://www.facebook.com/" target="_blank" alt="페이스북" />
            <area shape="circle" coords="481,855,30" href="https://section.blog.naver.com/BlogHome.nhn?directoryNo=0&currentPage=1&groupId=0" target="_blank" alt="블로그"/>
            <area shape="circle" coords="569,854,30" href="#;" onclick="layerComPop('guide_pop'); autoMap.printMap();" alt="카페" />
            <area shape="circle" coords="654,855,30" href="https://www.instagram.com/" target="_blank" alt="인스타그램" />
            <area shape="rect" coords="772,1015,934,1059" href="#;" onclick="event_save()" alt="닉네임 자랑하고 토익기출트렌드 무료받기" />
        </map>
    <?}else{?>
        <img src="<?=$img_url; ?>share.jpg" alt="" usemap="#share" />
        <map name="share" map-autoresize map-size="750">
            <area shape="rect" coords="213,632,433,675" href="/?r=hackers&m=event&a=download&_path=upload&_name=gtelp_share_event_2020.jpg&_rename=소문내기이벤트.jpg" target="_blank" alt="이미지 다운받기"  />
            <area shape="rect" coords="443,631,663,677" href="#" onclick="getEventAddr();" alt="이벤트 주소 복사" />
            <area shape="circle" coords="243,786,31" href="#;" onclick="kakao_btn_328();"  alt="카카오" />
            <area shape="circle" coords="321,789,30" href="https://twitter.com/?lang=ko" target="_blank" alt="트위터" />
            <area shape="circle" coords="398,787,30" href="https://www.facebook.com/" target="_blank" alt="페이스북" />
            <area shape="circle" coords="477,788,31" href="https://section.blog.naver.com/BlogHome.nhn?directoryNo=0&currentPage=1&groupId=0" target="_blank" alt="블로그"/>
            <area shape="circle" coords="553,790,31" href="#;" onclick="layerComPop('guide_pop'); autoMap.printMap();" alt="카페" />
            <area shape="circle" coords="631,787,30" href="https://www.instagram.com/" target="_blank" alt="인스타그램" />
            <area shape="rect" coords="124,1033,626,1105" href="#;" onclick="event_save()" alt="닉네임 자랑하고 토익기출트렌드 무료받기" />
        </map>
    <?}?>

    <form name="eventForm" id="eventForm">
        <input name="ex_type" id="ex_type" type="hidden" value="gtelp" />
        <input name="ex_date" id="ex_date" type="hidden" value="<?=$promoSetting['ex_date']?>" />
        <input class="input-name" name="nick" id="nick" type="text" title="닉네임"  hname="발급받은 닉네임" required="" value="<?=$member['nic']?>" />
        <input class="input-url" name="url" id="url" type="text" title="url" hname="게시글 주소" required="" />
    </form>
</div>
<div class="share_bot">
    <div class="share_info">
        <p class="share_info_btn" onclick="toggle_btn('.share_info_detail')">소문내기 이벤트 유의사항 펼치기 ▼</p>
        <p class="share_info_detail">
            1) 해커스 지텔프 소문내기 이미지를 다운받아, 게시글 내에 첨부해주세요.<br/>
            2) 삭제된 글은 인정되지 않습니다.<br/>
            3) 이벤트 혜택 중복수령은 불가합니다. (하나의 휴대폰번호 당 하나의 쿠폰만 발송됩니다.)<br/>
            4) 여러 ID를 활용하여 부당하게 이벤트에 참여했다고 판단될 경우, 당첨이 취소될 수 있습니다.<br/>
            5) 글+이벤트페이지URL+이미지가 모두 포함되지 않은 게시글은 인정되지 않습니다.<br/>
            6) 비로그인 상태에서도 확인 가능한 게시글만 인정됩니다.<br/>
            7) 이벤트 참여자 공지 및 혜택 발송 안내는 이벤트 참여 시 입력하신 이메일로 일괄 발송됩니다.<br/>
            8) 정답서비스를 이용하지 않고, 소문내기 이벤트 참여 시, 인정되지 않습니다.
        </p>
        <p class="basis_txt">
            [지텔프 기출문제집] 교보문고 외국어 베스트셀러 G-TELP 분야 1위 (2019.11.21 온라인 주간 집계 기준)<br/>
            YES24 국어 외국어 사전 베스트셀러 OPIC/G-TELP/ESPT외 기타 영어어학시험 분야 (2019.11.21, YES24 월별 베스트 기준)<br/>
            알라딘 외국어 베스트셀러 G-TELP 분야 1위 (2019년 11월 3주, 주간베스트 기준) 인터파크도서 국어/외국어/사전 베스트셀러 G-TELP 분야 (2019.11.21, 판매량순 기준)<br/>
            [지텔프 문법/독해] 교보문고 외국어 베스트셀러 G-TELP 분야 (2020.02.07 온라인 주간집계 기준
        </p>
    </div>
</div>
<img src="<?=$img_url; ?>share_bot.jpg" alt=""/>


<style>
    .layer-wrap{display:none;position:fixed;_position:fixed;top:0;left:0;width:100%;height:100%;z-index:100002}
    .layer-wrap .bg{position:fixed;top:0;left:0;z-index:10;width:100%;height:100%;background:#000000;opacity:0.7;filter:alpha(opacity=70);-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=70)"}
    .layer-wrap .layer-inner{overflow:hidden;position:absolute;top:50%;left:50%;z-index:100;width:746px;height:auto;background:#fff;border:2px solid #000; margin-left:0;}
    .layer-wrap .layer-content{overflow:hidden;}
    .layer-wrap .js_pop_close{position:absolute;top:13px;right:13px;z-index:100;display:block;background:none;text-indent:-9999px;border:0;margin:0;padding:0}
    .layer-wrap .ly_top{height:45px;padding-left:15px;line-height:45px; border-bottom:1px solid #d8d7d7; background-color:#efefef; }
    .layer-wrap .ico_comm{background-image:url("//gscdn.hackers.co.kr/hackers/images/event/2018/0111/close_btn.png"); }
    .layer-wrap .js_pop_close a{display:block;width:20px;height:20px;}
    @media (max-width: 640px){
        .layer-wrap .layer-inner {left: 0;top: 5%;width: 100%;margin-left: 0;}
        .layer-wrap .ico_comm {background-size: inherit;}
    }
</style>

<div class="layer-wrap" style="display: none;">
    <div class="bg"></div>
    <div class="layer-inner type1" id="guide_pop">
        <div class="lypop_inner">
            <div class="ly_top">
                <strong>지정 커뮤니티 바로가기</strong>
            </div>
            <span class="js_pop_close"><a href="#;" class="ico_comm">닫기</a></span>
        </div>
        <div class="layer-content">
            <img src="https://gscdn.hackers.co.kr/hackers//images/s_book/allbooks/180206/community_pop.jpg" usemap="#com-map2">
            <map name="com-map2" id="com-map" map-autoresize map-size="768">
                <area shape="rect" coords="36,126,200,170" href="http://cafe.naver.com/cosmania" target="_blank" alt="파우더룸"/>
                <area shape="rect" coords="215,126,379,170" href="http://cafe.naver.com/sheiszzz" target="_blank" alt="전현차"/>
                <area shape="rect" coords="392,126,557,170" href="http://cafe.naver.com/feko" target="_blank" alt="여우야"/>
                <area shape="rect" coords="569,125,734,171" href="http://cafe.naver.com/dieselmania" target="_blank" alt="디젤매니아"/>
                <area shape="rect" coords="36,263,200,307" href="http://cafe.daum.net/ok1221" target="_blank" alt="쭉빵"/>
                <area shape="rect" coords="214,263,379,306" href="http://cafe.daum.net/ok211" target="_blank" alt="뉴빵"/>
                <area shape="rect" coords="392,262,558,307" href="http://cafe.daum.net/forpharm" target="_blank" alt="약대가자"/>
                <area shape="rect" coords="569,263,734,307" href="http://cafe.daum.net/humornara" target="_blank" alt="유머나라"/>
                <area shape="rect" coords="115,318,282,362" href="http://cafe.daum.net/truepicture" target="_blank" alt="엽기혹은진실"/>
                <area shape="rect" coords="293,317,459,363" href="http://cafe.daum.net/subdued20club" target="_blank" alt="여성시대"/>
                <area shape="rect" coords="472,318,636,363" href="http://cafe.daum.net/dotax" target="_blank" alt="도탁스"/>
                <area shape="rect" coords="30,450,195,494" href="http://www.ppomppu.co.kr" target="_blank" alt="뽐뿌"/>
                <area shape="rect" coords="214,450,380,493" href="http://www.ygosu.com" target="_blank" alt="와이고수"/>
                <area shape="rect" coords="392,448,558,493" href="https://www.clien.net/service" target="_blank" alt="클리앙"/>
                <area shape="rect" coords="569,449,734,493" href="http://mlbpark.donga.com/mp" target="_blank" alt="mlb파크"/>
                <area shape="rect" coords="30,506,195,549" href="http://soccerline.kr" target="_blank" alt="사커라인"/>
                <area shape="rect" coords="214,506,379,549" href="http://www.fmkorea.com" target="_blank" alt="Fm코리아"/>
                <area shape="rect" coords="393,505,557,549" href="http://www.dealbada.com/" target="_blank" alt="딜바다"/>
                <area shape="rect" coords="569,504,735,549" href="http://www.todayhumor.co.kr" target="_blank" alt="오늘의 유머"/>
            </map>
        </div>
    </div>
</div>