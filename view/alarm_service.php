<?
// 사전예약 정보 조회
$promoSetting = $scoreService->getNowSetting('gtelp','promo');
//$promoSetting = $answerShowSetting;
?>
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
                <li class="on"><a href="#;">정답 무료알림</a></li>
                <li><a href="#;" onclick="move_tab2();">정답확인 로그인/채점</a></li>
                <li><a href="/?c=<?=$c?>&tab=board">지텔프 자유게시판</a></li>
            </ul>
        </div>
    </div>

    <form id="smsForm" name="smsForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" novalidate>
        <input type="hidden" name="r" value="<?php echo $r?>" />
        <input type="hidden" name="m" value="event"/>
        <input type="hidden" name="a" value="set_event_data"/>
        <input type="hidden" name="category" value="<?=$promoSetting['ex_date']?>" > <!-- 시험일자 -->
        <input type="hidden" name="event_uid" value="367" />
        <div class="alim_apply">
            <div class="inner">
                <div class="p_r">
                    <img src="<?=$img_url?>alim_banner.jpg" alt="" usemap="#alim_banner"/>
                    <map name="alim_banner">
                        <area shape="rect" coords="827,79,964,130" href="#;" onclick="alarm_submit(this);" title="1인 1닭 기회까지"/>
                    </map>
                    <input class="pn_num" type="text" name="sim_phone" placeholder="-없이 휴대폰 번호를 입력해주세요" maxlength="11" onkeyup="onlyNumber(this.value, this);">
                </div>
                <div class="agree_wrap">
                    <p>이벤트 상세설명
                        <span class="detail_btn2" onclick="toggle_btn('.detail_txt.v1')">자세히</span>
                    </p>
                    <p class="detail_txt v1">
                        1. 이벤트 명 : 지텔프 정답 실시간 확인 이벤트<br/>
                        2. 이벤트 참여 방법 : 지텔프 정답 실시간 확인 서비스 이용<br/>
                        3. 이벤트 혜택 : 치킨/바나나우유<br/>
                        4. 이벤트 당첨 조건 :<br/>
                        [치킨]<br/>
                        - 시험당일~익일 24시까지 지텔프 정답 실시간 확인 서비스에 정답 입력(80개 모두 정답 입력 시)<br/>
                        - 지텔프 정답 실시간확인 서비스 결과 총점, 평균점수와 실제 총 점수, 평균점수가 100% 일치한 경우<br/>
                        <span class="red_txt">(*추후 이메일로 성적표 제출 및 일치 인증 필요)</span><br/>
                        - 지텔프 정답 실시간확인 서비스 결과 총점,평균점수는 시험일 익일 24시 이후의 점수 기준<br/>
                        - 마케팅 활용 동의 :  지텔프 성적표 사본 및 지텔프 정답 실시간 확인 서비스 결과 점수, 이름 등<br/>
                        - 점수획득을 목적으로 응시한 것이 아니라고 판단되는 경우 당첨에서 제외됩니다.<br/>
                        - 성적 위조 등 부정한 방법으로 이벤트에 참여할 경우 당첨에서 제외되며 불이익이 주어질 수 있습니다.<br/><br/>

                        [바나나우유]<br/>
                        - 시험당일~익일 24시까지 지텔프 정답 실시간 확인 서비스를 이용한 선착순 10명<br/>
                        - 시험당일~익일 24시까지 토익정답 실시간 확인 서비스에 정답 입력(80개 모두 정답 입력 시)<br/>
                        - 점수획득을 목적으로 응시한 것이 아니라고 판단되는 경우 당첨에서 제외됩니다.<br/>
                        - 성적 위조 등 부정한 방법으로 이벤트에 참여할 경우 당첨에서 제외되며 불이익이 주어질 수 있습니다.
                    </p>
                    <p><input id="agree_all" class="agree_all" type="checkbox"> <label for="agree_all">모두 동의</label></p>
                    <p><input id="private_agree" name="private_agree" type="checkbox" value='Y'> <label for="private_agree">개인정보 수집/이용에 동의합니다(필수)</label><span class="detail_btn2" onclick="toggle_btn('.detail_txt.v2')">자세히</span></p>
                    <p class="detail_txt v2">
                        [개인정보 수집 및 이용 안내]<br/>
                        1. 개인정보 수집/이용 목적<br/>

                        가. 이벤트 참여, 서비스 제공 및 안내, 문의사항 응대, 경품 제공 및 안내<br/><br/>

                        나. 이벤트 상품의 발송과 해커스어학원을 비롯한 해커스 교육그룹의 새로운 서비스 신상품이나 이벤트, 최신정보 안내 등 회원님의 취향에 맞는 최적의 서비스를 제공하기 위함<br/>
                        (해커스 교육그룹 : 챔프스터디 / 해커스패스 / 해커스영어 / 해커스잡 / 해커스유학 / 해커스편입 / 위더스교육 / 위더스독학사 / 해커스중국어 / 해커스톡 등)<br/><br/>

                        2. 개인정보 수집 항목 : 휴대폰번호<br/><br/>

                        3. 개인정보의 보유/이용 기간 : 별도로 개인정보 유효기간을 지정하신 경우에는 수집 시로부터 지정하신 기간 동안 이용 하며, 내역 관리를 위해 추가 1년을 더 보관한 후 파기합니다.<br/>
                        별도로 개인정보 유효기간을 지정하지 않으신 경우에는 수집 시로부터 1년 간 이용하며, 내역 관리를 위해 추가 1년을 보관한 후 파기합니다.<br/>
                        보유 및 이용 기간 동안 개인정보 이용 동의에 철회하시는 경우 그 즉시 파기합니다.<br/><br/>

                        신청자는 개인정보 수집을 거부할 권리가 있습니다. 단, 거부하는 경우 이벤트 참여가 제한됩니다. 
                    </p>
                    <p><input id="five_agree" name="five_agree" type="checkbox" value='Y'> <label for="agree2">개인정보 유효기간을 5년으로 요청합니다. (선택)</label><br/>
                        <span>*참여자는 본 동의를 하지 않을 권한이 있으나, 동의하지 않을 시 더 이상 해커스영어의 이벤트 안내, 학습관련 정보 등을 받아보실 수 없습니다.<br/>
                            *개인정보 유효기간은 개인정보를 파기 또는 분리 저장•관리하여야 하는 서비스 미이용 기간을 의미합니다. 별도의 요청이 없는 경우 서비스 미이용 기간은 1년으로 합니다.</span></p>
                    <p><input id="evt_agree" name="evt_agree" type="checkbox" value='Y'> <label for="evt_agree">이벤트/할인(광고성) 정보 안내에 대한 동의합니다. (선택)</label></p>
                </div>
            </div>
        </div>
    </form>

    <div class="chk_answer">
        <div class="inner">
            <h2 class="tit_txt"><?=$show_date?> 지텔프 응시자들이 가장 많이 선택한 정답 확인 <span>*’예상정답’과 ‘내답 비율’은 실시간으로 바뀔 수 있습니다.</span></h2>
            <div class="chk_table">
                <?if(empty($_SESSION['gtelp_marking_member'])){?>
                    <div class="bg login_bf"></div>
                    <div class="table_block">
                        <p>로그인 후, 모든 정답 보실 수 있습니다. :)</p>
                    </div>
                <?}?>
                <table>
                    <?for($i=0;$i<8;$i++){?>
                        <tr class="t_head">
                            <th>문항</th>
                            <? for($x=0;$x<10;$x++){ ?>
                                <th><?=(10*$i)+$x+1?></th>
                            <? } ?>
                        </tr>
                        <tr>
                            <th>예상<br/>정답</th>
                            <? for($x=0;$x<10;$x++){
                                if($answerShowSetting['answer_show_start_date'] <= date('Y-m-d H:i:s') && date('Y-m-d H:i:s') <= $answerShowSetting['answer_show_end_date']){
                                    $_setAnswer = $setAnswer[($i * 10) + $x];
                                }else {
                                    $_setAnswer = '분석중';
                                }?>
                                <td class="red_txt"><?=$_setAnswer?></td>
                            <? } ?>
                        </tr>
                        <tr>
                            <th>내가<br/>쓴답</th>
                            <? for($x=0;$x<10;$x++){
                                $_memberAnswer = $memberAnswerArr[($i * 10) + $x];
                                ?>
                                <?if(!empty($_SESSION['gtelp_marking_member'])){?>
                                    <td><?=(!empty($_memberAnswer)) ? $_memberAnswer : '분석중'?></td>
                                <?}else{?>
                                    <td></td>
                                <?}?>
                            <? } ?>
                        </tr>
                    <? } ?>
                </table>
            </div>
            <div class="btn_area">
                <a class="blue_btn" href="#;" onclick="move_tab2();">실시간 채점하고 내점수 확인하기 〉</a>
                <a class="black_btn" href="#;" onclick="move_tab2();">성적표 확인하러 가기 〉</a>
            </div>
        </div>
    </div>

    <div class="chk_answer">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/contents/lang.korean/pages/gtelp_full_service/pc/ans_content.php';?>
    </div>

    <div class="share" id="share">
        <div class="inner">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/contents/lang.korean/pages/gtelp_full_service/share.php';?>
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

</div>


