<h2 class="tit_txt">해커스 빅데이터 실시간 분석결과</h2>
<div class="score clear">
    <h4 class="clear">
        <?if($device == 'pc'){?>
            <span class="blue_txt only_pc">나의 평균 점수 : <?=$myPointAvg?>점</span>
        <?}?>
        <span>총 점수 : <?=$myPoint?>점</span>
    </h4>
    <?if($device == 'pc'){?>
        <div class="only_pc">
            <ul>
                <?
                $_i = 0;
                foreach($examSetData as $section => $_data){?>
                    <li><?=$_data['section']?> : <span class="blue_txt"><?=(!empty($memberCorrectCntArr[$_i])) ? $memberCorrectCntArr[$_i] : 0?></span>점</li>
                <?
                $_i++;
                }?>
            </ul>
        </div>
    <?}else{?>
    <ul>
        <?
        $_i = 0;
        foreach($examSetData as $section => $_data){?>
            <li><?=$_data['section']?> 맞은개수 : <span class="blue_txt"><?=!empty($memberCorrectCntArr[$_i]) ? $memberCorrectCntArr[$_i] : 0?></span>개 / 26개</li>
        <?
        $_i++;
        }?>
    </ul>
    <?}?>
</div>
<div class="graph">
    <h4><?=date('m.d',strtotime($answerShowSetting['ex_date']))?> 지텔프 내 위치 확인</h4>
    <div class="graph_wrap">
        <ul class="gp_bar">
            <!--data-score은 퍼센트율-->
            <li <?if($myPointAvg < 60){?>class="on"<?}?> data-score="15"></li>
            <li <?if($myPointAvg >= 60 && $myPointAvg < 70){?>class="on"<?}?> data-score="35"></li>
            <li <?if($myPointAvg >= 70 && $myPointAvg < 80){?>class="on"<?}?> data-score="25"></li>
            <li <?if($myPointAvg >= 80 && $myPointAvg < 90){?>class="on"<?}?> data-score="20"></li>
            <li <?if($myPointAvg >= 90 && $myPointAvg <= 100){?>class="on"<?}?> data-score="5"></li>

        </ul>
        <ul class="gp_sec clear">
            <?for($i = 5; $i < 10; $i++){?>
                <li><span><?=$i?>0점 <?=$i == 5 ? '미만' : ''?></span></li>
            <?}?>
        </ul>
    </div>
</div>
<table class="avg_score">
    <tr>
        <th colspan="4">응시자 평균 점수</th>
    </tr>
    <tr>
        <?
        foreach($examSetData as $section => $_data){?>
            <td><?=$_data['section']?> 평균점수</td>
        <?
        }?>
        <td>총 평균점수</td>
    </tr>
    <tr>
        <?
        $_total = 0;
        foreach($examSetData as $section => $_data){
            $_stat = $memberExamStat['stat'][$section];
            $_avg = ($_stat['participants'] > 0) ? $_stat['point'] / $_stat['participants'] : 0;
            $_total += $_avg;
            ?>
            <td><?=round($_avg)?></td>
        <? }?>
        <td><?=round($_total)?></td>
    </tr>
</table>
<table class="avg_correct">
    <tr>
        <th colspan="3">응시자 평균 맞은 점수</th>
    </tr>
    <tr>
        <?
        foreach($examSetData as $section => $_data){?>
            <td><?=$_data['section']?> 맞은 개수</td>
            <?
        }?>
    </tr>
    <tr>
        <? foreach($examSetData as $section => $_data){
            $_stat = $memberExamStat['stat'][$section];
            $_avg = ($_stat['participants'] > 0) ? $_stat['correct_cnt'] / $_stat['participants'] : 0;
            ?>
            <td><?=round($_avg)?></td>
        <? }?>
    </tr>
</table>
<table class="avg_diffcult">
    <tr>
        <th colspan="3">섹션 별 난이도</th>
    </tr>
    <tr>
        <? foreach($examSetData as $section => $_data){ ?>
            <td><?=$_data['section']?></td>
        <? }?>
    </tr>
    <tr>
        <? foreach($examSetData as $section => $_data){
            $level = !empty($d['exam_level']['gtelp'][$answerShowSetting['ex_date']][$section]) ? $d['exam_level']['gtelp'][$answerShowSetting['ex_date']][$section] : 0;
            ?>
            <td><?=$level?></td>
        <? } ?>
    </tr>
</table>
<div class="btn_area v1 clear">
    <a href="https://www.hackers.co.kr/?m=bookmanager&quick=N&category=16" target="_blank"><span>지텔프 교재</span>보러 가기 〉</a>
    <a href="https://champ.hackers.com/?r=champstudy&c=lecture/lec_gtelp" target="_blank"><span>지텔프 인강</span>보러 가기 〉</a>
</div>
<div class="btn_area v2 clear">
    <a href="https://www.hackers.co.kr/?c=s_gov" target="_blank"><span>지텔프 무료자료</span>한 눈에 보기 〉</a>
    <a href="https://www.hackers.co.kr/?c=s_gov/gtelp_board/gtelp" target="_blank"><span>지텔프 자유게시판</span>에서 후기확인 〉</a>
</div>