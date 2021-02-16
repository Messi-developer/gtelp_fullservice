<?php
//a.set_marking_user_login 작업 복사

if(!defined('__KIMS__')) exit;

$ip = $_SERVER['REMOTE_ADDR'];
$agent = $_SERVER['HTTP_USER_AGENT'];

//예) 지텔프 세션 - gtelp_marking_member
$session_name = $ex_type.'_marking_member';

switch ($mode) {
    case 'login' :
        if($nic == '') {
            echo "<script>alert('이름을 입력해주세요.'); </script>";
            exit;
        }
        if($password == '') {
            echo "<script>alert('비밀번호를 입력해주세요.'); </script>";
            exit;
        }
        $check_sque =  "nic='".$nic."' AND password='".hash('sha256', $password)."'";
        $check_member = getDbData('hc_score_service_member', $check_sque, '*');

        if(empty($check_member)) {
            //echo "<script>alert('로그인 정보가 올바르지 않습니다.\\n채점서비스 가입전이라면, 가입을 먼저 해주세요.\\n\\n※ 최초 회원가입 시 다른 이름으로 등록했을 수 있으니,\\n기억이 나지 않을 경우 <engevent@hackers.com>으로\\n문의 해 주세요! '); </script>";
            echo "<script>alert('로그인 정보가 올바르지 않습니다.\\n채점서비스 가입전이라면, 가입을 먼저 해주세요.\\n\\n※ 최초 회원가입 시 입력한 이름과 비밀번호가 기억이 나지 않을 경우\\n로그인창 하단의 \'이름/비밀번호 찾기\'를 이용해주세요.\\n\\n재가입 문의 : <engevent@hackers.com>'); </script>";
            exit;
        } else {
            // if($ex_date == '') {
            // 	include_once $g['path_module'].'event/var/var.markingservice.php';
            // 	$ex_date = $d['markingservice']['ex_date'];
            // }
            $sque =  " phone='".$check_member['phone']."' AND ex_date='".$ex_date."' ";
            $user_answer = getDbData($table['exam_marking_user'], $sque, '*');

            echo "<script>alert('로그인 되었습니다.'); </script>";

            $_SESSION[$session_name] = $nic."|".$check_member['email']."|".$check_member['phone']."|".$check_member['uid'];
            // 해당 시험일에 등록된 데이터가 없을 경우
            if(empty($user_answer)){
                $data = array(
                    'nic'		=> $check_member['nic'],
                    'email'		=> $check_member['email'],
                    'phone'		=> $check_member['phone'],
                    'ex_date'	=> $ex_date,
                    'wdate'		=> date('Y-m-d H:i:s'),
                    'ip'		=> $ip,
                    'agent'		=> $agent,
                    'keywd'		=> ($_SESSION['keywd']) ? $_SESSION['keywd'] : '',
                    'agree_state'		=> $check_member['agree_state'],
                    'answer'	=> $answer ? $answer : '',
                    'adddata'	=> $adddata ? $adddata : ''
                );
                getDbInsert2($table['exam_marking_user'], change_query_string($data));

            }


            $sque_log =  "phone='".$check_member['phone']."' AND ex_date ='".$ex_date."' AND LEFT(wdate, 10) = '".date("Y-m-d")."'";
            $user_answer_log = getDbData($table['exam_marking_user_log'], $sque_log, "*");

            //if($check_member['phone'] == '010-5458-1795' || $check_member['phone'] == '010-6578-2678') {
            //채점 로그
            if (empty($user_answer_log)) {
                $data_log = array(
                    'nic' => $check_member['nic'],
                    'email' => $check_member['email'],
                    'phone' => $check_member['phone'],
                    'ex_date' => $ex_date,
                    'wdate' => date('Y-m-d H:i:s'),
                    'ip' => $ip,
                    'agent' => $agent,
                    'keywd' => ($_SESSION['keywd']) ? $_SESSION['keywd'] : '',
                    'agree_state' => $check_member['agree_state'],
                    'answer' => $answer ? $answer : '',
                    'adddata' => $adddata ? $adddata : ''
                );
                getDbInsert2($table['exam_marking_user_log'], change_query_string($data_log));
            } else {
                $data_log = array(
                    'wdate' => date('Y-m-d H:i:s'),
                    'ip' => $ip,
                    'agent' => $agent,
                    'keywd' => ($_SESSION['keywd']) ? $_SESSION['keywd'] : '',
                    'agree_state' => $check_member['agree_state'],
                );
                getDbUpdate($table['exam_marking_user_log'], change_query_string($data_log), " nic='" . $check_member['nic'] . "' AND phone='" . $check_member['phone'] . "' AND ex_date='" . $ex_date . "' AND LEFT(wdate, 10) = '" . date('Y-m-d') . "'");
            }
            //}
            //로그 끝

            echo '<script>parent.parent.location.href = "/?c=s_gov/gtelp_board/gtelp_full_service"; </script>';
            exit;
        }
        break;

    case "logout" :
        unset($_SESSION[$session_name]);
        setCookie('fullservice_autosave', '', -1);
        echo ($g['mobile'] ? '2' : '1');;
        exit;
        break;
}
?>