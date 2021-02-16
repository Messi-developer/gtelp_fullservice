<?php

//지텔프 정답서비스 소문내기 이벤트 액션 파일
include_once $g['path_module'].'event/lang.korean/core/scoreService.php';

$scoreService = new scoreService('gtelp');

if(empty($_POST['ex_date'])){
    $set = $scoreService->getNowSetting($_POST['ex_type'],'promo');
    $_POST['ex_date'] = $set['ex_date'];
}

$returnData = array(
    'code' => '99',
    'msg' => '새로고침 후 다시 시도해주세요.'
);

if($adddata != '' && $nic != ''){
    $searchData['nic'] = $_POST['nic'];
    $findMember = $scoreService->getFindMember($_POST['ex_type'], $searchData);

    if (empty($findMember)) {
        $returnData = array(
            'code' => '91',
            'msg' => "채점서비스에 가입 하셨나요? \n회원가입 후 참여해주세요."
        );
        echo json_encode($returnData);
        exit;
    }

    $ex_type = $_POST['ex_type'];
    $insData['ex_date'] = $_POST['ex_date'];
    $insData['member_uid'] = $findMember['uid'];
    $insData['adddata'] = $_POST['adddata'];
    if($scoreService->setAnswerAddData($ex_type, $insData)){
        $returnData = array(
            'code' => '00',
            'msg' => '참여 완료하였습니다.'
        );
    }
}
echo json_encode($returnData);
exit;
?>