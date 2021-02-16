<div id="contents">
    <div class="top_title">
        <div class="inner">
            <img src="<?=$img_url?>top_title.jpg" alt=""/>
            <span class="people_num"><?=number_format($BCNT)?></span>
        </div>
    </div>

    <div class="main">
        <div class="inner">
            <img src="<?=$img_url?>main.jpg" alt=""/>
        </div>
    </div>

    <div class="nav">
        <div class="inner">
            <ul class="clear">
                <li><a href="/?c=<?=$c?>&tab=alarm">정답 무료알림</a></li>
                <li class="on"><a href="#;">정답확인 로그인/채점</a></li>
                <li><a href="/?c=<?=$c?>&tab=board">지텔프 자유게시판</a></li>
            </ul>
        </div>
    </div>

    <div class="answer_check">
        <div class="inner">
            <div class="user_box clear">
                <div class="user_result">
                    <h2 class="tit_txt">해커스 빅데이터 실시간 분석결과</h2>
                    <div class="score_area clear">
                        <? if(empty($_SESSION['gtelp_marking_member'])){ ?>
                            <div class="block_score">
                                <p onclick="layer_open('login_layer');">* 정답서비스 로그인 후 확인 가능합니다.</p>
                            </div>
                        <? }else{ ?>
                            <?if(empty($memberAnswer)){?>
                                <div class="block_score">
                                    <p >* 정답 입력 후 확인 가능합니다.</p>
                                </div>
                            <?}?>
                        <? } ?>
                        <div class="avg">
                            <span><?=$myPointAvg?></span>
                            <p>나의 평균점수</p>
                        </div>
                        <div class="tot">
                            <span><?=$myPoint?></span>
                            <p>나의 총 점수</p>
                        </div>

                    </div>
                    <p class="red_txt">* 해커스 지텔프 빅데이터로 분석한 가장 가능성 높은 점수입니다</p>
                </div>
                <? if(!empty($_SESSION['gtelp_marking_member'])){ ?>
                    <div class="login_area after">
                        <h2 class="tit_txt"><?=$member['nic']?>님 해커스와 함께 단기 고득점을 완성하세요!</h2>
                        <div class="btn_area">
                            <a class="blue_btn" href="#;" onclick="showType('chk_answer');">정답 입력/수정하기 〉</a>
                            <?if(empty($memberAnswer)){?>
                                <a class="black_btn" href="#;" onclick="alert('정답을 입력하세요.')">성적표 확인하기 〉</a>
                            <?}else{?>
                                <a class="black_btn" href="#;" onclick="showType('analysis');">성적표 확인하기 〉</a>
                            <?}?>
                        </div>
                        <p><a href="#;" onclick="serviceLogout()">로그아웃</a></p>
                    </div>
                <? }else{ ?>
                    <div class="login_area">
                        <h2 class="tit_txt">로그인하고 지텔프 정답 확인하세요.</h2>
                        <div class="login_wrap">
                            <form id="loginForm1" name="loginForm1" action="/" method="post" target="_action_frame_home">
                                <div class="login_box">
                                    <input type="hidden" name="r" value="hackers">
                                    <input type="hidden" name="m" value="contents"/>
                                    <input type="hidden" name="a" value="gtelp_full_service/set_score_service_member"/>
                                    <input type="hidden" name="mode" value="login"/>
                                    <input type="hidden" name="ex_type" value="gtelp">
                                    <div class="input_group">
                                        <input type="text" name="nic" placeholder="이름" option="banNick">
                                        <input type="password" name="password" placeholder="비밀번호">
                                    </div>
                                    <a href="#;" onclick="loginForm1.submit();">정답서비스<br>로그인</a>
                                </div>
                            </form>
                            <ul class="btn_util">
                                <li><a href="#;" onclick="layer_open('name_layer')">이름 찾기</a></li>
                                <li><a href="#;" onclick="layer_open('password_layer')">비밀번호 찾기</a></li>
                                <li class="util_join"><a href="#;" onclick="layer_open('pc_join_layer')">정답서비스 신청하기</a></li>
                            </ul>
                        </div>
                    </div>
                <? } ?>
            </div>
        </div>
    </div>

    <? if(!empty($memberAnswer)){ ?>
        <div class="analysis <?=(empty($memberAnswer) ? 'hide' : '')?>">
            <div class="inner">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/contents/lang.korean/pages/gtelp_full_service/analysis.php';?>
            </div>
        </div>
    <? } ?>

    <div class="chk_answer <?=(!empty($memberAnswer) ? 'hide' : '')?>">
        <form id="examForm" name="examForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return examSubmit(this); ">
            <input type="hidden" name="r" value="<?php echo $r?>"/>
            <input type="hidden" name="m" value="event"/>
            <input type="hidden" name="a" value="score_service/answer"/>
            <input type="hidden" name="ex_type" value="gtelp">
            <input type="hidden" name="ex_date" value="<?=$answerShowSetting['ex_date']?>">
            <input type="hidden" name="member_uid" value="<?=$member['uid']?>">
            <input type="hidden" name="nic" value="<?=$member['nic']?>">
            <input type="hidden" name="keywd" value="<?=$_SESSION['keywd']?>">
            <div class="inner <?=(empty($_SESSION['gtelp_marking_member']))? 'login_bf' : ''?>">
                <h2 class="tit_txt"><?=$show_date?> 지텔프 응시자들이 가장 많이 선택한 정답 확인 <span>*’예상정답’과 ‘내답 비율’은 실시간으로 바뀔 수 있습니다.</span></h2>
                <div class="chk_table v2">
                <?
                $k = 0;
                foreach($examSetData as $section => $_data){
                    ?>
                    <h3><?=$_data['section']?></h3>
                    <table>
                        <?for($i=0;$i<ceil($_data['count'] / 10);$i++){?>
                            <tr class="t_head">
                                <th>문항</th>
                                <? for($j=1;$j<=10;$j++){
                                    $n = (($i*10) + $j);
                                    if($n > $_data['count']) $n = '';
                                    ?>
                                    <th><?=$n?></th>
                                <? } ?>
                            </tr>
                            <tr>
                                <th>예상<br>정답</th>
                                <? for($j=1;$j<=10;$j++){
                                    $n = (($i*10) + $j);
                                    if($answerShowSetting['answer_show_start_date'] <= date('Y-m-d H:i:s') && date('Y-m-d H:i:s') <= $answerShowSetting['answer_show_end_date']){
                                        $_setAnswer = $setAnswer[$n];
                                    }else {
                                        $_setAnswer = '분석중';
                                    }
                                    if($n > $_data['count']){
                                        $n = '';
                                        $_setAnswer = '';
                                    }

                                    ?>
                                    <td class="red_txt"><?=$_setAnswer?></td>
                                <? } ?>
                            </tr>
                            <tr>
                                <th>내가<br>쓴답</th>
                                <? for($j=1;$j<=10;$j++){
                                    $n = (($i*10) + $j);
                                    $_memberAnswer = $memberAnswerArr[$k];
                                    ?>
                                    <td>
                                        <?if($n <= $_data['count']){?>
                                            <input type="text" class="" name="answer[]" value="<?=$_memberAnswer?>">
                                            <input type="hidden" name="descriptive_answer[]" value="">
                                        <?
                                            $k++;
                                        }?>
                                    </td>
                                <? } ?>
                            </tr>
                        <?}?>
                    </table>
                    <br/>
                <?} ?>
                </div>
                <div class="btn_area">
                    <a class="blue_btn" href="#;" onclick="$('#examForm').submit();">실시간 채점하고 내점수 확인하기 〉</a>
                    <? if(empty($memberAnswer)){ ?>
                        <a class="black_btn" href="#;" onclick="alert('정답을 입력하세요.')">성적표 확인하기 〉</a>
                    <? }else{ ?>
                        <a class="black_btn" href="#;" onclick="showType('analysis');">성적표 확인하기 〉</a>
                    <? } ?>
                </div>
            </div>
        </form>
    </div>

    <div class="chk_answer">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/contents/lang.korean/pages/gtelp_full_service/pc/ans_content.php';?>
    </div>

    <div class="share" id="share">
        <div class="inner">
            <img style="margin-bottom: 10px;" src="//cdn.hackers.co.kr/images/fullservice/gtelp/quick_banner.png" alt="" usemap="#quick_banner"/>
            <map name="quick_banner">
                <area shape="rect" coords="0,0,134,96" href="/?c=s_gov/gtelp_contents/gtelp_marking&keywd=heng_gtelp_smsalarm_rightquick1_210120&logger_kw=heng_gtelp_smsalarm_rightquick1_210120" target="_blank" />
                <area shape="rect" coords="1,145,130,288" href="/?c=s_gov/gtelp_contents/gtelp_marking&keywd=heng_gtelp_sharescroll_rightquick4_210120&logger_kw=heng_gtelp_sharescroll_rightquick4_210120#share"/>
                <area shape="rect" coords="1,288,130,431" href="/?c=s_gov/gtelp_board/gtelp&uid=548&keywd=heng_gtelp_comevt_rightquick3_210120&logger_kw=heng_gtelp_comevt_rightquick3_210120" target="_blank"/>
                <area shape="rect" coords="1,431,131,585" href="/?c=s_gov/gtelp_contents/gtelp_free&keywd=heng_gtelp_freelec_rightquick4_210120&logger_kw=heng_gtelp_freelec_rightquick4_210120" target="_blank"/>
            </map>
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
        <?php getWidget('banner/default', ['category' => 'gtelp_service_pc_right_quick', 'select_type' => 'category', 'datatype' => 'reMain', 'random' => 0, 'all' => 1]); ?>
    </div>

    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/modules/contents/lang.korean/pages/gtelp_full_service/popup.php'; ?>
</div>
