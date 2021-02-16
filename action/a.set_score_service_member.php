<?php
if(!defined('__KIMS__')) exit;

include_once $g['path_module'].'event/var/var.score_service.php';
include_once $g['path_module'].'event/lang.korean/core/scoreService.php';

$scoreService = new scoreService('gtelp');

$session_name = $ex_type.'_marking_member';
switch($mode){
    case 'join' :
        $email = ($join_domain == 'my') ? $join_email1.'@'.$join_email2 : $join_email1.'@'.$join_domain;

        if(empty($_POST['join_nic'])){
            getLink('','parent.','닉네임을 입력해주세요.','');
            exit;
        }
        if(empty($_POST['join_email1']) || empty($_POST['join_domain'])){
            getLink('','parent.','이메일을 입력해주세요.','');
            exit;
        }
        if(empty($_POST['join_password'])){
            getLink('','parent.','비밀번호를 입력해주세요.','');
            exit;
        }
        if(empty($_POST['join_phone'])){
            getLink('','parent.','핸드폰 번호를 입력해주세요.','');
            exit;
        }

        $searchData['phone'] = $_POST['join_phone'];
        $findMember = $scoreService->getFindMember($_POST['ex_type'], $searchData);
        if(!empty($findMember)){
            getLink('','parent.','이미 가입된 회원입니다.','');
            exit;
        }

        $memberData['nic'] = $_POST['join_nic'];
        $memberData['password'] = hash('sha256', $_POST['join_password']);
        $memberData['email'] = $_POST['join_email1'].'@'.$_POST['join_domain'];
        $memberData['phone'] = $_POST['join_phone'];
        $memberData['private_agree_state'] = $_POST['private_agree_state'];
        $memberData['five_agree_state'] = $_POST['five_agree_state'];
        $memberData['evt_agree_state'] = $_POST['evt_agree_state'];
        $memberData['wdate'] = date('Y-m-d H:i:s');
        $memberData['ip'] = $_SERVER['REMOTE_ADDR'];
        $memberData['agent'] = $_SERVER['HTTP_USER_AGENT'];
        $memberData['keywd'] = $_SESSION['keywd'];

        if($scoreService->joinMember($_POST['ex_type'], $memberData)){
            getLink('reload','parent.','정상적으로 가입 완료하였습니다.','');
        }else{
            getLink('','parent.','새로고침 후 다시 시도해주세요..','');
        }
        break;

    case 'login' :
        if(empty($_POST['nic'])){
            getLink('','parent.','닉네임을 입력해주세요.','');
            exit;
        }
        if(empty($_POST['password'])){
            getLink('','parent.','비밀번호를 입력해주세요.','');
            exit;
        }

        $searchData['nic'] = $_POST['nic'];
        $searchData['password'] = hash('sha256',$_POST['password']);
        $findMember = $scoreService->getLoginMember($_POST['ex_type'], $searchData);

        if(!empty($findMember)){
            $_SESSION[$session_name] = $findMember['nic']."|".$findMember['email']."|".$findMember['phone']."|".$findMember['uid'];
            getLink('reload','parent.',"로그인 되었습니다.",'');
        }else{
            getLink('','parent.',"로그인 정보가 올바르지 않습니다.\\n채점서비스 가입전이라면, 가입을 먼저 해주세요.\\n\\n※ 최초 회원가입 시 입력한 이름과 비밀번호가 기억이 나지 않을 경우\\n로그인창 하단의 \'이름/비밀번호 찾기\'를 이용해주세요.\\n\\n재가입 문의 : <engevent@hackers.com>",'');
        }
        break;

    case 'logout' :
        unset($_SESSION[$session_name]);
        getLink('/?c=s_gov/gtelp_contents/gtelp_marking','parent.','로그아웃 되었습니다.','');
        break;

    case 'find_name' :

        $returnData['code'] = '99';
        $returnData['msg'] = '새로고침 후 다시 시도해주세요.';

        if(empty($_POST['phone'])){
            $returnData['code'] = '91';
            $returnData['msg'] = '휴대폰 번호를 입력해주세요.';
            echo json_encode($returnData);
            exit;
        }

        $ex_type = $_POST['ex_type'];
        $searchData['phone'] = $_POST['phone'];
        $member = $scoreService->getFindMember($ex_type, $searchData);

        if(!empty($member)){
            $returnData['code'] = '00';
            $returnData['msg'] = 'success';
            $returnData['nic'] = $member['nic'];
        }else{
            $returnData['code'] = '92';
            $returnData['msg'] = '존재하는 이름이 없습니다.';
        }
        echo json_encode($returnData);
    break;
    case 'change_password' :
        if($_POST['new_pass'] != $_POST['new_pass_conf'] ){
            getLink('','parent.','비밀번호가 일치하지 않습니다.','');
            exit;
        }
        if(empty($_POST['find_phone']) ){
            getLink('','parent.','휴대폰 번호 인증이 필요합니다.','');
            exit;
        }

        $ex_type = $_POST['ex_type'];
        $searchData['phone'] = $_POST['find_phone'];
        $member = $scoreService->getFindMember($ex_type, $searchData);

        if(!empty($member)){
            $upsData['password'] = hash('sha256', $_POST['new_pass']);
            $result = $scoreService->setNewPassword($member['uid'], $upsData);
            if($result){
                getLink('reload','parent.','정상적으로 변경 되었습니다.','');
            }else{
                getLink('','parent.','새로고침 후 다시 시도해주세요. ','');
            }
        }else{
            getLink('','parent.','존재하는 닉네임이 없습니다.','');
        }
        exit;
    break;
}

exit;
?>
