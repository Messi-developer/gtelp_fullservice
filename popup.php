<!-- 로그인레이어 -->
<div class="fullservice_layer fullservice_util_layer">
    <div class="fullservice_layer_bg"></div>
    <div class="fullservice_layer_con evt_layer_box" id="login_layer" >
        <h2>정답 서비스 로그인</h2>
        <div class="evt_layer">
            <p>정답 서비스 로그인 후 채점 서비스 이용 가능합니다.</p>
            <div class="login_layer_area">
                <form id="loginForm" name="loginForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>">
                    <input type="hidden" name="r" value="<?php echo $r?>"/>
                    <input type="hidden" name="m" value="contents"/>
                    <input type="hidden" name="a" value="gtelp_full_service/set_score_service_member"/>
                    <input type="hidden" name="mode" value="login"/>
                    <input type="hidden" name="ex_type" value="gtelp">
                    <div class="login_inp">
                        <div class="login_input">
                            <input type="text" name="nic" hname="이름" placeholder="이름" required="" autofocus/>
                        </div>
                        <div class="password_input">
                            <input type="password" id="login_password" name="password" hname="비밀번호" placeholder="비밀번호" required=""/>
                        </div>
                    </div>
                    <a href="javascript:loginForm.submit();" class="btn_login">정답 서비스 로그인</a>
                </form>
            </div>
            <div class="btn_bottom">
                <a href="#;" onclick="layer_open('name_layer')">이름 찾기</a> <span>|</span>
                <a href="#;" onclick="layer_open('password_layer')">비밀번호 찾기</a> <span>|</span>
                <a href="#;" onclick="layer_open('pc_join_layer')">정답서비스 신청</a>
            </div>
            <div class="login_txt">
                정답서비스 신청시 정보를 정확히 입력해야 정답 알림 서비스를 받아보실 수 있습니다.
            </div>
        </div>
        <a href="#;" class="close"></a>
    </div>
</div>
<!-- // 로그인레이어 -->
<!-- 이름찾기레이어 -->
<div class="fullservice_layer fullservice_util_layer">
    <div class="fullservice_layer_bg"></div>
    <div class="fullservice_layer_con evt_layer_box" id="name_layer">
        <h2>점수 예측 서비스 이름 찾기</h2>
        <div class="evt_layer">
            <form id="certNameForm" name="certNameForm"  novalidate>
                <input type="hidden" name="ex_type" value="gtelp">
                <input type="text" id="login_phone" name="phone" hname="핸드폰번호" placeholder="번호만 입력해주세요 ex)01012345678" required=""/>
                <a href="#;" onclick="nameFind($('#certNameForm'));" class="btn_login">확인 완료</a>
            </form>
        </div>
        <div class="name_val"></div>
        <div class="btn_bottom">
            <a href="#;" onclick="layer_open('password_layer')">비밀번호 찾기</a>
            <span>|</span>
            <a href="#;" onclick="$('.fullservice_layer').fadeOut();$('body').removeClass('fullservice_body');">점수예측 풀서비스 로그인</a>
        </div>
        <a href="#;" class="close"></a>
    </div>
</div>
<!-- // 비밀번호찾기레이어 -->

<!-- 비밀번호찾기레이어 -->
<div class="fullservice_layer fullservice_util_layer">
    <div class="fullservice_layer_bg"></div>
    <div class="fullservice_layer_con evt_layer_box" id="password_layer">
        <h2>비밀번호 찾기/변경</h2>
        <div class="evt_layer">
            <form id="certForm" name="certForm"  onsubmit="saveCheckFind(this);return false;" novalidate>
                <div class="util_area">
                    <ul>
                        <li>
                            <div class="side_btn_input">
                                <input type="text" id="find_phone" name="find_phone" maxlength="11" hname="핸드폰번호" required="" onKeyUp="onlyNumber(this.value, this);" placeholder="번호만 입력 Ex) 01000000000"/>
                                <a href="#;" class="evt_layer_btn" onclick="doSendCert('find');">인증번호요청</a>
                            </div>
                        </li>
                        <li>
                            <div class="side_btn_input">
                                <input type="text" id="find_cert_num" name="cert_num" maxlength="10" hname="인증번호" required="" value="">
                                <a href="javascript:doCheckSendCert('find');" class="evt_layer_btn">확인하기</a>
                            </div>
                        </li>
                    </ul>
                    <p class="notice">※ 기존에 등록된 회원정보와 동일해야합니다.</p>
                </div>
                <a href="#;" onclick="saveCheckFind(document.certForm)" class="btn_login">확인</a>
            </form>
        </div>
        <a href="#;" class="close">
        </a>
    </div>
</div>
<!-- // 비밀번호찾기레이어 -->

<!-- 비밀번호변경레이어 -->
<div class="fullservice_layer fullservice_util_layer">
    <div class="fullservice_layer_bg"></div>
    <div class="fullservice_layer_con evt_layer_box" id="password_layer2">
        <h2>비밀번호 찾기/변경</h2>
        <div class="evt_layer">
            <form id="passForm" name="passForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="savePass(this);" novalidate>
                <input type="hidden" name="r" value="<?php echo $r?>"/>
                <input type="hidden" name="m" value="contents"/>
                <input type="hidden" name="a" value="gtelp_full_service/set_score_service_member"/>
                <input type="hidden" name="mode" value="change_password"/>
                <input type="hidden" name="ex_type" value="gtelp">
                <input type="hidden" name="find_phone" id="pass_phone" value=""/>
                <div class="util_area">
                    <ul>
                        <li>
                            <input type="password" name="new_pass" placeholder="새비밀번호" hname="새비밀번호" required=""/>
                        </li>
                        <li>
                            <input type="password" name="new_pass_conf" placeholder="새비밀번호 확인" hname="새비밀번호 확인" required=""/>
                        </li>
                    </ul>
                </div>
                <a href="#;" onclick="$('#passForm').submit();" class="btn_login">확인</a>
            </form>
        </div>
        <a href="#;" class="close">
        </a>
    </div>
</div>
<!-- // 비밀번호변경레이어 -->

<!-- 회원가입레이어 -->
<script language="javascript" src="/modules/event/_main.js"></script>
<script type="text/javascript">
    $(function(){
        $(".inputs").focus(function(){
            var offset = $('#focus_area').offset();
            $('.evt_layer').animate({scrollTop: offset.top}, 'slow');
        });

        /* 비밀번호 찾기 클릭 */
        $('.pw_search').click(function(){
            $(".fullservice_layer").fadeOut();
            layer_open('password_layer');
        });
    });
</script>

<form id="joinForm" name="joinForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return saveCheck_join(this);" novalidate>
    <input type="hidden" name="r" value="<?php echo $r?>"/>
    <input type="hidden" name="m" value="contents"/>
    <input type="hidden" name="a" value="gtelp_full_service/set_score_service_member"/>
    <input type="hidden" name="mode" value="join"/>
    <input type="hidden" name="ex_type" value="gtelp">
    <div class="fullservice_layer">
        <div class="fullservice_layer_bg"></div>
        <div class="fullservice_layer_con evt_layer_box" id="pc_join_layer">
            <a href="<?php if($toeic_qa):?>javascript:window.location='http://www.hackers.co.kr/?mod=fullservice_board';<?php else:?>#;<?php endif;?>" class="close">
                <img src="//gscdn.hackers.co.kr/hackers/images/popup/fullservice/btn_service_close.gif" alt="팝업닫기" />
            </a>
            <div class="evt_layer">
                <h2 class="service_tit">지텔프정답 실시간확인 서비스 신청창</h2>
                <ul>
                    <li>본 페이지에서 수집되는 정보는 이벤트 참여정보 확인 및 혜택발송을 위함입니다.</li>
                    <li>해커스영어 사이트는 비회원제이므로, 이벤트를 제외한 모든 활동은 로그인 없이 이용가능합니다.</li>
                    <li>혹시 해커스어학원, 해커스인강 로그인을 찾고있다면? 여기클릭 <a href="//www.hackers.ac/site/?st=login&amp;rtnUrl=L2luZGV4LnBocD8=&amp;keywd=hac_fullservice_login_190219&amp;logger_kw=hac_fullservice_login_190219" target="_blank"><strong class="color_blue">[어학원go]</strong></a> / <a href="//member.hackers.com/login?service_id=3090&amp;return_url=https%3A%2F%2Fchamp.hackers.com%2F&amp;keywd=hac_fullservice_login_190219&amp;logger_kw=hac_fullservice_login_190219" target="_blnak"><strong class="color_blue">[인강go]</strong></a></li>
                </ul>

                <table border="0" cellspacing="0" cellpadding="0" class="mt20 full-table" id="focus_area">
                    <colgroup>
                        <col style="35%" /><col style="*" />
                    </colgroup>
                    <tbody>
                    <tr>
                        <th scope="row">이름</th>
                        <td>
                            <input type="text" id="join_nic" name="join_nic" maxlength="10" class="inputs" hname="이름" required="" option="banNick">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">비밀번호</th>
                        <td>
                            <input type="password" id="join_password" name="join_password" hname="비밀번호" required="">
                            <span id="confirm_join_password" class="f_red"></span>
                            <p class="evt_layer_tip"> ※ 영문/숫자 포함 10자리 이상으로 입력 해 주세요!</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">비밀번호확인</th>
                        <td>
                            <input type="password" id="join_password_chk" name="join_password_chk" hname="비밀번호" required="">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">이메일</th>
                        <td>
                            <input type="text" id="join_email1" name="join_email1" class="s_width" hname="이메일" required="">
                            @
                            <select class="s_width" id="join_domain" name="join_domain">
                                <option value="naver.com">naver.com</option>
                                <option value="nate.com">nate.com</option>
                                <option value="cholian.net">cholian.net</option>
                                <option value="hotmail.com">hotmail.com</option>
                                <option value="korea.com">korea.com</option>
                                <option value="dreamwiz.com">dreamwiz.com</option>
                                <option value="empal.com">empal.com</option>
                                <option value="hanmail.net">hanmail.net</option>
                                <option value="daum.net">daum.net</option>
                                <option value="gmail.com">gmail.com</option>
                                <option value="my">직접입력</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">핸드폰 번호</th>
                        <td>
                            <input type="text" id="join_phone" name="join_phone" maxlength="11" hname="휴대폰번호" required="" placeholder="'-'표시 없이 휴대폰 번호 입력 " onkeyup="onlyNumber(this.value, this);"/></td>
                    </tr>
                    </tbody>
                </table>

                <div class="agree_wrap">
                    <div class="evt_detail">
                        <h3 class="clear">이벤트 상세설명<a href="#;" class="detail_btn">자세히</a></h3>
                        <p class="detail_txt">
                            1. 이벤트 명 : 토익스피킹 모의고사 문자알림<br/>
                            2. 이벤트 참여 방법 :  알림신청<br/>
                            3. 이벤트 혜택 : 토익스피킹 기출유형분석집(PDF)증정<br/>
                            4. 이벤트 당첨 조건 : 참여자 전원
                        </p>
                        <p><input type="checkbox" id="agree_all"><label for="agree_all">모두 동의합니다.</label></p>
                        <p class="clear"><input type="checkbox" id="private_agree_state" name="private_agree_state"><label for="private_agree_state">개인정보 수집/이용에 동의합니다(필수)</label><a href="#;" class="detail_btn">자세히</a></p>
                        <p class="detail_txt">
                            [개인정보 수집,이용 동의 문안]<br/><br/>

                            1. 개인정보 수집,이용 목적<br/>
                            1) 문자 알림 서비스 이벤트  신청에 따른 혜택 발송, 안내 및 관련 문의 사항 응대<br/>
                            2) 이벤트 참여 내역 관리를 통한 혜택 중복 수령 방지 등<br/>
                            <strong>3)  광고성 정보 수신에 별도 동의한 자에 한하여 해커스영어를 비롯한 해커스 교육그룹의 새로운 서비스 신상품이나 이벤트, 최신 정보 안내 등 신청자의 취향에 맞는 최적의 서비스를 제공하기 위함.</strong><br/>
                            (해커스교육그룹: 해커스인강, 해커스프랩, 해커스톡, 해커스중국어, 해커스일본어, 해커스잡, 해커스금융, 해커스임용, 해커스공무원, 해커스경찰, 해커스소방, 해커스공인중개사, 해커스주택관리사, 해커스원격평생교육원, 해커스독학사, 해커스편입 등)<br/><br/>

                            2. 개인정보 수집,이용 항목: 휴대폰번호<br/><br/>

                            <strong>3. 별도로 개인정보 유효기간을 지정하신 경우에는 수집 시로부터 지정하신 기간 동안 이용 하며, 내역 관리를 위해 추가 1년을 더 보관한 후 파기합니다. 별도로 개인정보 유효기간을 지정하지 않으신 경우에는 수집 시로부터 1년 간 이용하며, 내역 관리를 위해 추가 1년을 보관한 후 파기합니다. 보유 및 이용 기간 동안 개인정보 이용 동의에 철회하시는 경우 그 즉시 파기합니다.</strong><br/><br/>

                            4. 신청자는 개인정보 수집,이용을 거부할 수 있습니다. 단, 거부의 경우에는 본 이벤트 신청이 제한됩니다.
                        </p>
                        <p><input type="checkbox" id="five_agree_state" name="five_agree_state"><label for="five_agree_state">개인정보 유효기간을 5년으로 요청합니다. (선택)</label></p>
                        <p>*참여자는 본 동의를 하지 않을 권한이 있으나, 동의하지 않을 시 더 이상 해커스영어의 이벤트 안내, 학습관련 정보 등을 받아보실 수 없습니다.<br/>
                            *개인정보 유효기간은 개인정보를 파기 또는 분리 저장,관리하여야 하는 서비스 미이용 기간을 의미합니다.<br/>
                            별도의 요청이 없는 경우 서비스 미이용 기간은 1년으로 합니다.</p>
                        <p><input type="checkbox" id="evt_agree_state" name="evt_agree_state"><label for="evt_agree_state">이벤트/할인(광고성) 정보 안내에 대한 동의합니다. (선택)</label></p>
                    </div>
                    <div class="btn_area">
                        <a class="blue_btn" href="#;" onclick="$('form[name=joinForm]').submit()">
                            토익스피킹 모의고사 응시하러 go ▶
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- // 회원가입레이어 -->

<form id="logoutForm" name="logoutForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>">
    <input type="hidden" name="r" value="<?php echo $r?>"/>
    <input type="hidden" name="m" value="contents"/>
    <input type="hidden" name="a" value="gtelp_full_service/set_score_service_member"/>
    <input type="hidden" name="mode" value="logout"/>
    <input type="hidden" name="ex_type" value="gtelp">
</form>