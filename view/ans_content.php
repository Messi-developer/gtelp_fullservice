<div class="inner">
    <h2 class="tit_txt">지텔프 시험일 가장 hot한 게시글 <span>*실시간으로 업데이트 되는 지텔프시험 후기, 레벨2 달성팁을 확인해보세요.</span></h2>
    <div class="exam_hot_list">
        <div>
            <?php
            $RHCD = $bbsUidArr = array();
            if(!empty($eventBbsList['gtelp'][$answerShowSetting['ex_date']])){
                $k = 0;
                $bbsUidArr[$k++] = $eventBbsList['gtelp'][$answerShowSetting['ex_date']]['notice'][0];
                for($i=0;$i<3;$i++){
                    $bbsUidArr[$k++] = $eventBbsList['gtelp'][$answerShowSetting['ex_date']]['data'][$i];
                }
                $bbsUidArr[$k++] = $eventBbsList['gtelp'][$answerShowSetting['ex_date']]['flow'][0];

                $_table = "{$table['bbsdata']}_gtelp";
                $_where = " uid IN (".implode(',',$bbsUidArr).") AND hidden = 0 AND display = 1";
                $_data = " uid, subject, comment, name, hit ";
                $RHCD = getDbArrayRow2($_table ,$_where,$_data," FIELD(uid,".implode(',',$bbsUidArr).") "," ASC ",5,1);
            }else{
                $_table = "{$table['bbsdata']}_gtelp";
                $_where = " site=1 AND display IN (1,2) AND hidden = 0 AND display = 1 ";
                $_data = " uid, subject, comment, name, hit ";
                $RHCD = getDbArrayRow2($_table ,$_where,$_data," gid "," DESC ",5,1);
            }
            ?>

            <table summary="<?php echo $B['name']?$B['name']:'전체'?> 게시물리스트 입니다.">
                <caption><?php echo $B['name']?$B['name']:'전체게시물'?></caption>
                <colgroup>
                    <col width="50">
                    <col>
                    <col width="80">
                    <col width="70">
                </colgroup>
                <thead>
                <tr>
                    <th scope="col">번호</th>
                    <th scope="col">제목</th>
                    <th scope="col">글쓴이</th>
                    <th scope="col">조회수</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $num = 1;
                if(chkRes($RHCD)) foreach($RHCD as $R):
                    $R['subject'] = strip_tags($R['subject'],'<b><font><em><strong>');
                    ?>
                    <?php $R['mobile']=isMobileConnect($R['agent'])?>
                    <tr>
                        <td>
                            <?=$num++;?>
                        </td>
                        <td class="sbj">
                            <?php if($R['depth']):?><img src="<?php echo $g['img_core']?>/blank.gif" width="<?php echo ($R['depth']-1)*13?>" height="1"><img src="<?php echo $g['img_module_skin']?>/ico_re.gif" alt="답글" /><?php endif?>
                            <?php if($R['mobile'] && $my['admin']):?><img src="<?php echo $g['img_core']?>/_public/ico_mobile.gif" class="imgpos" alt="모바일" title="모바일(<?php echo $R['mobile']?>)로 등록된 글입니다" /><?php endif ?>
                            <?php if($R['category'] && $R['notice'] != 2 && $d['bbs']['list_category_view'] != 1):?><span class="cat">[<?php echo $R['category']?>]</span><?php endif?>
                            <a href="/?c=s_gov/gtelp_contents/gtelp_marking&tab=board&uid=<?=$R['uid']?>" target="_blank">
									<span class="<?php if($my['admin'] && $R['hidden'] == '1') { ?> muted <?php } else { ?>  <?php } ?>" >
										<?php echo (preg_match('/<b>|<strong>|<font/', strtolower($R['subject']))) ? $R['subject']."" : getStrCut($R['subject'],$d['bbs']['sbjcut'],'...');?>
									</span>
                            </a>

                            <?php $adddata = json_decode($R['adddata']); ?>
                            <?php if($adddata->upload->img || preg_match('/\.(jpg|gif|png)/i',$R['content'])):?><img src="<?php echo $g['img_core']?>/_public/ico_pic.gif" class="imgpos" alt="사진" title="사진" /><?php endif?>
                            <?php if($adddata->upload->file):?><img src="<?php echo $g['img_core']?>/_public/ico_file.gif" class="imgpos" alt="첨부파일" title="첨부파일" /><?php endif?>

                            <?php if($R['comment'] || $R['oneline']):?><span class="comment hand" onclick="iPopup('/?r=hackers&m=comment&skin=&hidepost=0&iframe=Y&cync=[bbs][<?php echo $R['uid']?>][uid,comment,oneline,d_comment][<?php echo $table['bbsdata']?>][0][m:bbs,bid:<?php echo $bid?>,uid:<?php echo $R['uid']?>', 'Y', 750, 460, 1, 0, 0);">[<?php echo $R['comment']+$R['oneline']?>]</span><?php endif?>
                            <?php if($R['trackback']):?><span class="trackback">[<?php echo $R['trackback']?>]</span><?php endif?>
                            <?php if($my['admin'] == 1 ) { ?>
                                <span style="font-weight: bold; font-size: 11px; color: #019E59;"><?php if($R['display'] == 1):?>PM<?php elseif($R['display'] == 2):?>P<?php elseif($R['display'] == 3):?>M<?php endif?></span>
                            <?php } ?>
                            <span class="new">
								<?php if( $R['hot'] && ( $R['notice'] == 1 || $R['notice'] == 2 || $R['point4'] == 2 ) ) { ?>
                                    hot
                                <?php } else {?>
                                    <?php if(getNew($R['d_regis'],24)):?>new<?php endif?>
                                <?php } ?>
								</span>
                        </td>
                        <td class="name"><span class="hand" onclick="getMemberLayer('<?php echo $R['mbruid']?>',event);"><?php echo $R['name']?></span></td>
                        <td class="hit b"><?php echo $R['hit']?><?php if ($my['admin']) : ?>/<?php if($R['d_view']==date('Y-m-d')){ echo $R['view']; }else{ echo "0"; } ?><?php endif; ?></td>
                    </tr>
                <?php endforeach?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="bbs-btn-area">
        <a href="/?c=s_gov/gtelp_contents/gtelp_marking&tab=board" target="_blank" class="bbs-btn btn-no-active">목록</a>
        <a href="/?c=s_gov/gtelp_board/gtelp&mod=write" target="_blank" class="bbs-btn btn-active">글쓰기</a>
    </div>
</div>