<div class="chk_answer">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/contents/lang.korean/pages/gtelp_full_service/pc/ans_content.php';?>
    </div>

    <div class="share" id="share">
        <div class="inner">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/contents/lang.korean/pages/gtelp_full_service/share.php';?>
        </div>
    </div>

    <!-- PC 팝업 커뮤니티 -->
    <div class="layer-wrap">
        <div class="bg"></div>
        <div class="layer-inner type1" id="guide_pop" style="width:100%; max-width:768px;">
            <div class="lypop_inner">
                <div class="ly_top">
                    <strong>지정 커뮤니티 바로가기</strong>
                </div>
                <span class="js_pop_close"><a href="#;" class="ico_comm">닫기</a></span>
            </div>
            <div class="layer-content">
                <img src="<?php echo $g['path_image'] ?>/images/s_book/allbooks/180206/community_pop.jpg" usemap="#com-map2"/>
                <map name="com-map2" id="com-map" map-autoresize2 map-size2="768">
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


    <div id="evt_quick_menu" class="quick_banlist">
        <img style="margin-bottom: 10px;" src="//cdn.hackers.co.kr/images/fullservice/gtelp/quick_banner.png" alt="" usemap="#quick_banner"/>
        <map name="quick_banner">
            <area shape="rect" coords="0,0,134,96" href="/?c=s_gov/gtelp_contents/gtelp_marking&keywd=heng_gtelp_smsalarm_rightquick1_210120&logger_kw=heng_gtelp_smsalarm_rightquick1_210120" target="_blank" />
            <area shape="rect" coords="1,145,130,288" href="/?c=s_gov/gtelp_contents/gtelp_marking&keywd=heng_gtelp_sharescroll_rightquick4_210120&logger_kw=heng_gtelp_sharescroll_rightquick4_210120#share"/>
            <area shape="rect" coords="1,288,130,431" href="/?c=s_gov/gtelp_board/gtelp&uid=548&keywd=heng_gtelp_comevt_rightquick3_210120&logger_kw=heng_gtelp_comevt_rightquick3_210120" target="_blank"/>
            <area shape="rect" coords="1,431,131,585" href="/?c=s_gov/gtelp_contents/gtelp_free&keywd=heng_gtelp_freelec_rightquick4_210120&logger_kw=heng_gtelp_freelec_rightquick4_210120" target="_blank"/>
        </map>
        <?php getWidget('banner/default', ['category' => 'gtelp_service_pc_right_quick', 'select_type' => 'category', 'datatype' => 'reMain', 'random' => 0, 'all' => 1]); ?>
    </div>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/modules/contents/lang.korean/pages/gtelp_full_service/popup.php'; ?>