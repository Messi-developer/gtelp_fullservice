<?
    include_once $g['path_module'].'event/var/var.score_service.php';
    include_once $g['path_module'].'event/var/var.bbs_hit_sort.php';
    include_once $g['path_module'].'event/lang.korean/core/scoreService.php';

    // 키워드를 세션으로 지정
    if(empty($_SESSION['keywd'])){
        $_SESSION['keywd'] = !empty($_GET['keywd']) ? $_GET['keywd'] : '';
    }

    $scoreService = new scoreService('gtelp');
    $answerShowSetting = $scoreService->getNowSetting('gtelp');
    $memberExamStat = $scoreService->getExamStatistics($answerShowSetting['ex_type'], $answerShowSetting['ex_date']);

    if($scoreService->defaultTab[$answerShowSetting['default_service']] != $page_id && empty($_SESSION['score_service_default'])){
        $_SESSION['score_service_default'] = 1;
        getLink('/?c=s_gov/gtelp_contents/gtelp_marking&tab='.$scoreService->defaultTab[$answerShowSetting['default_service']],'parent.','','');
    }

    // 정답 노출 데이터
    $examSetData = $scoreService->examSetData;
    $setAnswer = json_decode($answerShowSetting['answer'],true);

    //참여자정보
    $memberAnswer = array();
    $myPoint = $myPointAvg = '000';
    if(!empty($_SESSION['gtelp_marking_member'])){
        $sessionArr = explode('|', $_SESSION['gtelp_marking_member']);
        $searchData['uid'] = $sessionArr[3];
        $member = $scoreService->getFindMember('gtelp', $searchData);

        $answerFindSearch['ex_date'] = $answerShowSetting['ex_date'];
        $answerFindSearch['member_uid'] = $member['uid'];
        $answerFindSearch['answer'] = true;
        $memberAnswer = $scoreService->getMemberAnswerList('gtelp',$answerFindSearch)[0];

        if(!empty($memberAnswer)){
            $memberAnswerArr = json_decode($memberAnswer['answer'],true);
            $memberDescriptiveAnswerArr = json_decode($memberAnswer['descriptive_answer'],true);
            $memberCorrectCntArr = explode(',',$memberAnswer['correct_cnt']);
            $myPointArr = explode(',',$memberAnswer['point']);
            $myPoint = sprintf('%03d',array_sum($myPointArr));
            $myPointAvg = count($myPointArr) > 0 ? array_sum($myPointArr) / count($myPointArr) : 0;
            $myPointAvg = sprintf('%03d',$myPointAvg);
        }
    }
$show_date = date('m월 d일',strtotime($answerShowSetting['ex_date']));
?>
<script src="/modules/contents/lang.korean/pages/gtelp_full_service/main.js"></script>
<link rel="stylesheet" href="/modules/contents/lang.korean/pages/gtelp_full_service/main.css"/>

<? if(defined('HACKERS_MOBILE')){
    $img_url = '//cdn.hackers.co.kr/images/fullservice/gtelp/m/';
    $device = 'm';?>
    <link rel="stylesheet" href="/modules/contents/lang.korean/pages/gtelp_full_service/m/m_main.css"/>
<?}else{
    $img_url = '//cdn.hackers.co.kr/images/fullservice/gtelp/';
    $device = 'pc';
}

$HitCacheID = 'bbs_gtelp_hit_count';
if ($memcache->connect_state) $BCNT = $memcache->getCache($HitCacheID);
if(!chkRes($BCNT)){
    $cnt = getDbData2($table['daily_access_stat'],"bbs_id = 230","SUM(view_cnt) AS cnt");
    $BCNT = $cnt['cnt'];
    if ($memcache->connect_state) $memcache->setCache($HitCacheID, $BCNT, 300);
}
?>
<script type="text/javascript">
    //<![CDATA[
    function calcHeight(){
        //find the height of the internal page

        var the_height= document.getElementById('board_frame').contentWindow.document.body.scrollHeight;

        //change the height of the iframe
        document.getElementById('board_frame').height=the_height;

        //document.getElementById('board_frame').scrolling = "no";
        document.getElementById('board_frame').style.overflow = "hidden";

        //document.getElementById('board_frame').scrolling = "no";
        document.getElementById('board_frame').style.overflow = "hidden";
		if($(window).width() >768) {
			window.scrollTo({top:500});
		}else{
			window.scrollTo({top:0});
		}
		
    }

    //정답확인/채점 탭 클릭 -> 로그인 여부 체크
    function move_tab2(){
        var session_chk = "<?=$_SESSION['gtelp_marking_member']?>";
        if(!session_chk){
            layer_open('login_layer');
        }else{
            location.href="/?c=<?=$c?>&tab=result";
        }
    }

    //알람서비스 신청 함수
    function alarm_submit(){
    	
        var phone = $('#smsForm input[name="sim_phone"]').val();

        if(!phone){
            alert("핸드폰 번호가 입력되지 않았습니다.");
            $('#smsForm input[name="sim_phone"]').focus();
            return false;
        }

        if (!checkPhoneNumber(phone)) {
            alert("핸드폰번호 형식이 올바르지 않습니다.");
            $('#smsForm input[name="sim_phone"]').focus();
            return;
        }

        var agree = $('#private_agree').is(':checked');
        if (agree == false) {
            alert('개인정보 수집 및 이용 동의 안내에 체크해주세요.');
            return;
        }

		// 이벤트/할인 (광고성) 정보 안내 동의
		var evtAgreeCheck = evtAgreeState($('#evt_agree').is(':checked'), 'event', 'gtelp_fullservice_marking');
		if (evtAgreeCheck) $("#smsForm").submit();
		
    }
</script>
<?
switch($page_id) {
    case 'result' :
        include_once $g['path_module'].'/contents/lang.korean/pages/gtelp_full_service/'.$device.'/full_service.php';
    break;
    case 'board' :
        include_once $g['path_module'].'/contents/lang.korean/pages/gtelp_full_service/'.$device.'/board.php';
    break;
    default :
        include_once $g['path_module'].'/contents/lang.korean/pages/gtelp_full_service/'.$device.'/alarm_service.php';
    break;
}
?>