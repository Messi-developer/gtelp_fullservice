<?
if(!empty($_GET['uid'])){
    $addUid = '&uid='.$_GET['uid'];
}
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
                <li><a href="/?c=<?=$c?>&tab=alarm">정답 무료알림</a></li>
                <li><a href="#;" onclick="move_tab2();">정답확인 로그인/채점</a></li>
                <li class="on"><a href="/?c=<?=$c?>&tab=board">지텔프 자유게시판</a></li>
            </ul>
        </div>
    </div>

    <div class="board_cont">
        <div class="inner">
            <iframe src='/?c=s_gov/gtelp_board/gtelp&iframe=Y&familysite=Y&fullservice_tab=<?=$scoreService->defaultTab[$answerShowSetting['default_service']].$addUid?>' id="board_frame" onload="calcHeight();" frameborder="0" scrolling="no" style="overflow-x:hidden; overflow:auto; width:100%; min-height:500px;"></iframe>
        </div>
    </div>
</div>