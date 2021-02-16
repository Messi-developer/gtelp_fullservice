<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2021-01-04
 * Time: 오후 4:34
 */

class scoreService{

    var $examSetData = null;
    var $exType = '';
    var $exDate = '';
    var $pageData = array(
        'page' => 1,
        'rowSize' => 30, // 한 페이지당 노출 개수
    );
    var $defaultTab = array(
        1 => 'alarm',
        2 => 'result',
        3 => 'board'
    );

    public function __construct($exType){
        $this->init($exType);
    }

    // 정답서비스
    public function init($exType){
        $examSettingData['gtelp'] = array(
            'section1' => array('section' => '문법','count' => '26', 'total_point' => 100),
            'section2' => array('section' => '청취','count' => '26', 'total_point' => 100),
            'section3' => array('section' => '독해 및 어휘','count' => '28', 'total_point' => 100)
        );
        $this->exType = $exType;
        $this->examSetData = $examSettingData[$exType];
    }

    public function getRemakePhoneNumber($phoneNumber,$splitStr ='') {
        $remakePhoneNumber = '';
        $TEL = preg_replace("/[^0-9]/", "", $phoneNumber);  // 숫자 이외 제거

        if(substr($TEL, 0, 2) == '02') {    // 지역번호 - 서울
            $remakePhoneNumber = preg_replace("/([0-9]{2})([0-9]{3,4})([0-9]{4})$/", "\\1-\\2-\\3", $TEL);
        } else if(strlen($TEL) == '8' && (substr($TEL, 0, 2) == '15' || substr($TEL, 0, 2) == '16' || substr($TEL, 0, 2) == '18')) {    // 지능망 번호
            $remakePhoneNumber = preg_replace("/([0-9]{4})([0-9]{4})$/", "\\1-\\2", $TEL);
        } else {
            $remakePhoneNumber = preg_replace("/([0-9]{3})([0-9]{3,4})([0-9]{4})$/", "\\1-\\2-\\3", $TEL);
        }
        $remakePhoneNumber = str_replace('-',$splitStr,$remakePhoneNumber);
        return $remakePhoneNumber;
    }

    public function joinMember($exType = '', $memberData = array()){
        global $table;
        $exType = !empty($exType) ? $exType : $this->exType;

        $memberData['ex_type'] = $exType;
        $memberData['phone'] = $this->getRemakePhoneNumber($memberData['phone'],'-');
        $insertData = change_query_string($memberData);

        return getDbInsert2($table['score_service_member'],$insertData);
    }

    // 정답서비스 회원 찾기
    public function getFindMember($exType = '', $searchData = array()){
        global $table;

        $exType = !empty($exType) ? $exType : $this->exType;

        $addQuery[] = " `ex_type` = '{$exType}'";
        if(!empty($searchData['nic'])){
            $addQuery[] = " `nic` = '{$searchData['nic']}'";
        }
        if(!empty($searchData['phone'])){
            $phone = $this->getRemakePhoneNumber($searchData['phone'],'-');
            $addQuery[] = " `phone` = '{$phone}'";
        }
        if(!empty($searchData['uid'])){
            $addQuery[] = " `uid` = '{$searchData['uid']}'";
        }
        $where = @join(' AND ', $addQuery);

        return getDbData2($table['score_service_member'],$where," uid, ex_type, nic, password, email, phone, wdate, ip");
    }

    // 정답서비스 로그인 (닉네임, 비밀번호 매칭)
    public function getLoginMember($exType = '', $searchData = array()){
        global $table;

        $exType = !empty($exType) ? $exType : $this->exType;

        $addQuery[] = " `ex_type` = '{$exType}'";
        if(!empty($searchData['nic'])){
            $addQuery[] = " `nic` = '{$searchData['nic']}'";
        }
        if(!empty($searchData['password'])){
            $addQuery[] = " `password` = '{$searchData['password']}'";
        }
        $where = @join(' AND ', $addQuery);

        return getDbData2($table['score_service_member'],$where," uid, ex_type, nic, password, email, phone, wdate, ip");
    }

    // 정답서비스 회원 리스트
    public function getMemberList($exType = '', $searchData = array(), $returnType = 'list', $p = 1, $recnum = 30) {
        global $table;

        $exType = !empty($exType) ? $exType : $this->exType;
        $addQuery[] = " a.`ex_type` = '{$exType}'";

        if(!empty($searchData['nic'])){
            $addQuery[] = " a.`nic` = '{$searchData['nic']}'";
        }
        if(!empty($searchData['phone'])){
            $searchData['phone'] = $this->getRemakePhoneNumber($searchData['phone'],'-');
            $addQuery[] = " a.`phone` = '{$searchData['phone']}'";
        }
        $where = @join(' AND ', $addQuery);
        $data = " uid, ex_type, nic, email, phone, wdate, ip, agree_state, evt_agree_state, private_agree_state, five_agree_state";

        if($returnType == 'count'){
            return getDbRows($table['score_service_member']." AS a",$where);
        }else if($returnType == 'memberCount'){
            $data = " a.uid, a.ex_type, a.nic, a.email, a.phone, a.wdate, a.ip, a.agree_state, a.evt_agree_state, a.private_agree_state, a.five_agree_state, COUNT(b.`member_uid`) AS answer_cnt";
            $_table = "{$table['score_service_member']} AS a 
                    LEFT JOIN {$table['score_service_member_answer']} AS b ON a.`ex_type` = b.`ex_type` AND  a.`uid` = b.`member_uid` ";
            $where .= "GROUP BY  a.`uid`";
            return getDbArrayRow2($_table,$where,$data,'uid','DESC',$recnum,$p);
        }else{
            return getDbArrayRow2($table['score_service_member']." AS a",$where,$data,'uid','DESC',$recnum,$p);
        }
    }

    // 정답 세팅 리스트
    public function setNewPassword($member_uid, $upsData = array()){
        global $table;

        $set_arr['`password`'] = $upsData['password'];

        getDbUpdate($table['score_service_member'],change_query_string($set_arr)," uid = {$member_uid} ");
        return true;
    }

    // 정답 세팅 리스트
    public function setAnswerAddData($exType = '', $insData = array()){
        global $table;

        $exType = $exType ? $exType : $this->exType;

        $insert_data_arr['ex_type'] = $exType;
        $insert_data_arr['ex_date'] = $insData['ex_date'];
        $insert_data_arr['member_uid'] = $insData['member_uid'];
        $insert_data_arr['adddata'] = $insData['adddata'];
        $insert_data_arr['wdate'] = date('Y-m-d H:i:s');
        $insert_data_arr['mdate'] = date('Y-m-d H:i:s');
        $insert_data_arr['ip'] = $_SERVER['REMOTE_ADDR'];
        $insert_data_arr['agent'] = $_SERVER['HTTP_USER_AGENT'];

        $update_data_arr['adddata'] = $insData['adddata'];

        $insert_set = change_query_string($insert_data_arr);
        $update_set = change_query_string($update_data_arr);
        return getDbDuplicate($table['score_service_member_answer'], $insert_set, $update_set);
    }

    // 정답 세팅 리스트
    public function getSetting($exType = '', $exDate = ''){
        global $table;

        $exType = $exType ? $exType : $this->exType;
        $exDate = $exDate ? $exDate : $this->exDate;
        $_where = " ex_type = '{$exType}' AND ex_date = '{$exDate}' ";
        $_data = " * ";
        return getDbData2($table['score_service_setting'], $_where,$_data);
    }

    // 정답 세팅 리스트
    public function getSettingList($exType = ''){
        global $table;

        $exType = $exType ? $exType : $this->exType;
        return getDbArrayRow2($table['score_service_setting']," ex_type = '{$exType}' "," * ","ex_date",'DESC','','');
    }

    // 정답 세팅 리스트
    public function getNowSetting($exType = '', $type = ''){
        global $table;

        $exType = $exType ? $exType : $this->exType;
        $nowDate = date('Y-m-d');
        switch($type){
            case 'answer_show' :
            case 'answer_register' :
                $_where = " ex_type = '{$exType}' AND NOW() BETWEEN {$type}_start_date AND {$type}_end_date ";
                break;

            case 'promo' :
                $_where = " ex_type = '{$exType}' AND ex_date >= '{$nowDate}' ORDER BY ex_date ASC LIMIT 1 ";
                break;

            default :
                $_where = " ex_type = '{$exType}' AND ex_date <= '{$nowDate}' ORDER BY ex_date DESC LIMIT 1 ";
        }
        $_data = " * ";
        return getDbData2($table['score_service_setting'], $_where,$_data);
    }

    // 관리자 세팅 주관식 데이터
    public function getDescriptiveAnswer($exType = '', $searchData = array()){
        global $table;

        $returnData = array();
        $exType = $exType ? $exType : $this->exType;
        $_where = " ex_type = '{$exType}' AND ex_date = '{$searchData['ex_date']}' ";
        $_data = " ex_type, ex_date, num, answer, descriptive_answer, member_descriptive_answer ";
        $rcd = getDbArray($table['score_service_descriptive_answer'],$_where, $_data,'NULL','','','');

        while($_r=db_fetch_assoc($rcd)){
            $tmp['answer'] = $_r['answer'];
            $tmp['descriptive_answer'] = json_decode($_r['descriptive_answer']);
            $tmp['member_descriptive_answer'] = json_decode($_r['member_descriptive_answer']);
            $returnData[$_r['num']] = $tmp;
        }

        return $returnData;
    }

    // 유저 정답 데이터 리스트
    public function getMemberAnswerList($exType = '', $searchData = array(), $returnType = 'list', $page = 1, $rowSize = 30) {
        global $table;

        $exType = !empty($exType) ? $exType : $this->exType;
        $addQuery[] = " a.`ex_type` = '{$exType}'";
        if(!empty($searchData['ex_date'])){
            $addQuery[] = " a.`ex_date` = '{$searchData['ex_date']}'";
        }
        if(!empty($searchData['sdate']) || !empty($searchData['edate'])){
            $searchData['sdate'] = !empty($searchData['sdate']) ? $searchData['sdate'] : date('Y-m-d H:i:s');
            $searchData['edate'] = !empty($searchData['edate']) ? $searchData['edate'] : date('Y-m-d H:i:s');

            $addQuery[] = "a.`wdate` BETWEEN '{$searchData['sdate']}' AND '{$searchData['edate']}'";
        }
        if(!empty($searchData['member_uid'])){
            $addQuery[] = " a.`member_uid` = '{$searchData['member_uid']}'";
        }
        if(!empty($searchData['nic'])){
            $addQuery[] = " b.`nic` = '{$searchData['nic']}'";
        }
        if(!empty($searchData['email'])){
            $addQuery[] = " b.`email` = '{$searchData['email']}'";
        }
        if(!empty($searchData['phone'])){
            $addQuery[] = " b.`phone` = '{$searchData['phone']}'";
        }
        if(!empty($searchData['ip'])){
            $addQuery[] = " b.`ip` = '{$searchData['ip']}'";
        }
        if(!empty($searchData['keywd'])){
            $addQuery[] = " b.`keywd` = '{$searchData['keywd']}'";
        }
        if(!empty($searchData['section'])){
            $addQuery[] = " a.`member_uid` IN (SELECT member_uid FROM hc_score_service_member_answer_result  WHERE `ex_type` = '{$exType}' AND  `ex_date` = '{$searchData['ex_date']}' AND `section` = '{$searchData['section']}'  AND  `use_flag` = '{$searchData['use_flag']}' ) ";
        }
        if(!empty($searchData['answer'])) {
            $addQuery[] = " a.`answer` IS NOT NULL AND a.`answer` != '' ";
        }

        $where = @join(' AND ', $addQuery);

        if($returnType == 'count'){
            $_table = "{$table['score_service_member_answer']} AS a INNER JOIN {$table['score_service_member']} AS b ON a.`member_uid` = b.`uid`";
            return getDbRows($_table,$where);
        }else{
            $where .= " GROUP BY a.ex_type, a.ex_date, a.`member_uid` ";
            $data = " a.`ex_type`, a.`ex_date`, a.`answer`, a.`descriptive_answer`, a.`right_answer_cnt`, a.`score`, a.`ip`, a.`wdate`, a.`adddata`, b.`uid`, b.`nic`, b.`email`, b.`phone`, b.`agree_state`, b.`evt_agree_state`, b.`private_agree_state`, b.`five_agree_state`, b.`keywd`, GROUP_CONCAT(c.`section`) AS `section`, GROUP_CONCAT(c.`point`) AS `point`, GROUP_CONCAT(c.`correct_cnt`) AS correct_cnt, GROUP_CONCAT(c.`use_flag`) AS use_flag ";
            $_table = "{$table['score_service_member_answer']} AS a
	                INNER JOIN {$table['score_service_member']} AS b ON a.`member_uid` = b.`uid`
	                LEFT JOIN `hc_score_service_member_answer_result` AS c ON a.`ex_type` = c.`ex_type` AND a.`ex_date` = c.`ex_date` AND a.`member_uid` = c.`member_uid` ";
            return getDbArrayRow2($_table,$where,$data,'a.`wdate` ','DESC',$rowSize,$page);
        }
    }

    // 유저 데이터 통계 (memcache 적용 : 300초)
    public function getExamStatistics($exType, $exDate){
        global $table, $memcache;

        $returnData = $stat = array();

        // memcache 적용 ID
        $cacheID = $exType.'_'.$exDate."_stat";

        if ($memcache->connect_state) $returnData = $memcache->getCache($cacheID);
        if(!chkRes($returnData)) {
            $addQuery[] = " a.`ex_type` = '{$exType}'";
            $addQuery[] = " a.`ex_date` = '{$exDate}'";
            $addQuery[] = " a.`answer` != '' ";
            $addQuery[] = " a.`answer` IS NOT NULL";
            $_where = @join(' AND ', $addQuery);
            $_where .= " GROUP BY a.`ex_type`, a.`ex_date`, a.`member_uid` ";

            $_data = " a.member_uid, a.answer , GROUP_CONCAT(c.`section`) AS `section`, GROUP_CONCAT(c.`point`) AS `point`, GROUP_CONCAT(c.`correct_cnt`) AS correct_cnt, GROUP_CONCAT(c.`use_flag`) as use_flag ";
            $_table = " {$table['score_service_member_answer']} AS a LEFT JOIN `{$table['score_service_member_answer_result']}` AS c ON a.`ex_type` = c.`ex_type` AND a.`ex_date` = c.`ex_date` AND a.`member_uid` = c.`member_uid`";

            $R = getDbArrayRow2($_table, $_where, $_data, 'NULL', '', '', '');
            $rowCount = count($R);
            $i = 0;
            $abcd = array('a' => 0, 'b' => 0, 'c' => 0, 'd' => 0);
            if (!empty($R)) {
                foreach ($R as $key => $value) {
                    $_section_key = 1;
                    $answer = json_decode($value['answer'], true);
                    $useFlag = explode(',', $value['use_flag']);
                    $point = explode(',', $value['point']);
                    $section = explode(',', $value['section']);
                    $correctCnt = explode(',', $value['correct_cnt']);
                    foreach ($answer as $k => $v) {
                        if ($i >= $this->examSetData['section' . $_section_key]['count']) {
                            $_section_key++;
                            $i = 0;
                        }
                        if (empty($returnData['question_num'][($k + 1)]['answer'])) $returnData['question_num'][($k + 1)]['answer'] = $abcd;
                        if ($useFlag[$_section_key - 1]) {
                            $returnData['question_num'][($k + 1)]['answer'][$v]++;
                            $returnData['question_num'][($k + 1)]['participants']++;
                        }
                    }

                    // 통계 (응시자 평균 데이터)
                    foreach($section as $key => $value){
                        if($useFlag[$key]){
                            $returnData['stat'][$value]['point'] += $point[$key];
                            $returnData['stat'][$value]['correct_cnt'] += $correctCnt[$key];
                            $returnData['stat'][$value]['participants'] ++;
                        }
                    }
                    if(!in_array(0,$useFlag) && !empty($point)){
                        $avg = (floor(array_sum($point) / count($point) / 10) * 10);
                        $returnData['avg_stat']['avg'][$avg] ++ ;
                        $returnData['avg_stat']['participants'] ++;
                    }
                }
            }
            $returnData['count'] = $rowCount;
            if ($memcache->connect_state) $memcache->setCache($cacheID, $returnData, 300);
        }
        return $returnData;
    }

    // 유저 데이터 통계 재적용
    public function reSubmitExamStatistics($exType, $exDate){
        global $table, $memcache;

        $returnData = $stat = array();

        // memcache 적용 ID
        $cacheID = $exType.'_'.$exDate."_stat";

        if ($memcache->connect_state) $returnData = $memcache->delCache($cacheID);

        return $returnData;
    }
}