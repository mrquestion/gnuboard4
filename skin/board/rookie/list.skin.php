<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;
if ($is_category) $colspan++;
if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;
?>

<table width="<?=$width?>" align=center border=0 cellspacing="0" cellpadding="0">
<tr height="25">
    <? if ($is_category) { ?><form name="fcategory" method="get"><td width="50%"><select name=sca onchange="location='<?=$category_location?>'+this.value;"><option value=''>전체</option><?=$category_option?></select></td></form><? } ?>
    <td align="right">
        게시물 <?=number_format($total_count)?>건&nbsp;  
        <? if ($rss_href) { ?><a href='<?=$rss_href?>'>RSS</a>&nbsp; <?}?>
        <? if ($admin_href) { ?><a href="<?=$admin_href?>">관리자</a>&nbsp; <?}?></td>
</tr>
</table>

<form name="fboardlist" method="post" style="margin:0px;">
<input type="hidden" name="bo_table" value="<?=$bo_table?>">
<input type="hidden" name="sfl"  value="<?=$sfl?>">
<input type="hidden" name="stx"  value="<?=$stx?>">
<input type="hidden" name="spt"  value="<?=$spt?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="sw"   value="">
<table width='<?=$width?>'align=center border=1 cellpadding=0 cellspacing=0 style="border-collapse:collapse;" bordercolor="#0176B4">
<tr height=30 align=center>
    <td width=50>번호</td>
    <? if ($is_category) { ?><td width=70>분류</td><?}?>
    <? if ($is_checkbox) { ?><td width=40><INPUT onclick="if (this.checked) all_checked(true); else all_checked(false);" type=checkbox></td><?}?>
    <td>제목</td>
    <td width=40><?=subject_sort_link('wr_hit', $qstr2, 1)?>조회</a></td>
    <td width=50><?=subject_sort_link('wr_datetime', $qstr2, 1)?>날짜</a></td>
    <? if ($is_good) { ?><td width=40><?=subject_sort_link('wr_good', $qstr2, 1)?>추천</a></td><?}?>
    <? if ($is_nogood) { ?><td width=40><?=subject_sort_link('wr_nogood', $qstr2, 1)?>비추천</a></td><?}?>
    <td width=110>글쓴이</td>
</tr>

<? for ($i=0; $i<count($list); $i++) { ?>
<tr height=28 align=center> 
    <td>
        <? 
        if ($list[$i][is_notice]) // 공지사항 
            echo "공지";
        else if ($wr_id == $list[$i][wr_id]) // 현재위치
            echo "<b>{$list[$i][num]}</b>";
        else
            echo $list[$i][num];
        ?></td>
    <? if ($is_category) { ?><td><a href="<?=$list[$i][ca_name_href]?>"><?=$list[$i][ca_name]?></a></td><? } ?>
    <? if ($is_checkbox) { ?><td><input type=checkbox name=chk_wr_id[] value="<?=$list[$i][wr_id]?>"></td><? } ?>
    <td align=left style='word-break:break-all;'>
        <? 
		// 제목 시작
        echo $nobr_begin;
		echo "&nbsp;";
        echo $list[$i][reply];
        echo $list[$i][icon_reply];
        echo "<a href='{$list[$i][href]}'>";
        if ($list[$i][is_notice])
            echo "<font color='#FF6600'><strong>{$list[$i][subject]}</strong></font>";
        else
        {
            $style1 = $style2 = "";
            if ($list[$i][icon_new]) // 최신글은 검정
                $style1 = "color:#112222;";
            if (!$list[$i][comment_cnt]) // 코멘트 없는것만 굵게
                $style2 = "font-weight:bold;";
            echo "<span style='$style1 $style2'>{$list[$i][subject]}</span>";
        }
        echo "</a>";

        if ($list[$i][comment_cnt]) 
            echo " <a href=\"{$list[$i][comment_href]}\"><span style='font-size:7pt;'>{$list[$i][comment_cnt]}</span></a>";

        if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
        if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

		/*
        echo " " . $list[$i][icon_new];
        echo " " . $list[$i][icon_file];
        echo " " . $list[$i][icon_link];
        echo " " . $list[$i][icon_hot];
        echo " " . $list[$i][icon_secret];
		*/
        echo $nobr_end;
		// 제목 끝
        ?></td>
    <td><?=$list[$i][wr_hit]?></td>
    <td><?=$list[$i][datetime2]?></td>
    <? if ($is_good) { ?><td align="center"><?=$list[$i][wr_good]?></td><? } ?>
    <? if ($is_nogood) { ?><td align="center"><?=$list[$i][wr_nogood]?></td><? } ?>
    <td><?=$list[$i][name]?></td>
</tr>
<?}?>

<? if (count($list) == 0) { echo "<tr><td colspan='$colspan' height=100 align=center>게시물이 없습니다.</td></tr>"; } ?>
</table>
</form>

<div align=center>
	<? if ($prev_part_href) { echo "<a href='$prev_part_href'>이전검색</a>"; } ?>
	<?=$write_pages?>
	<? if ($next_part_href) { echo "<a href='$next_part_href'>다음검색</a>"; } ?>
</div>

<form name=fsearch method=get style="margin:0px;">
<input type=hidden name=bo_table value="<?=$bo_table?>">
<input type=hidden name=sca      value="<?=$sca?>">
<table width="<?=$width?>" align=center border=0 cellspacing="0" cellpadding="0">
<tr> 
    <td width="50%" height="40">
        <? if ($list_href) { ?><a href="<?=$list_href?>">목록</a><? } ?>
        <? if ($write_href) { ?><a href="<?=$write_href?>">쓰기</a><? } ?>
        <? if ($is_checkbox) { ?>
            <a href="javascript:select_delete();">선택삭제</a>
            <a href="javascript:select_copy('copy');">선택복사</a>
            <a href="javascript:select_copy('move');">선택이동</a>
        <? } ?>
    </td>
    <td width="50%" align="right">
        <select name=sfl>
            <option value='wr_subject'>제목</option>
            <option value='wr_content'>내용</option>
            <option value='wr_subject||wr_content'>제목+내용</option>
            <option value='mb_id'>회원아이디</option>
            <option value='wr_name'>이름</option>
        </select><input name=stx maxlength=15 size=10 itemname="검색어" required value="<?=$stx?>"><select name=sop>
            <option value=and>and</option>
            <option value=or>or</option>
        </select>
        <input type=submit value="검색"></td>
</tr>
</table>
</form>

<script language="JavaScript">
if ("<?=$sca?>") document.fcategory.sca.value = "<?=$sca?>";
if ("<?=$stx?>") {
	document.fsearch.sfl.value = "<?=$sfl?>";
	document.fsearch.sop.value = "<?=$sop?>";
}
</script>

<? if ($is_checkbox) { ?>
<script language="JavaScript">
function all_checked(sw)
{
	var f = document.fboardlist;

	for (var i=0; i<f.length; i++) {
		if (f.elements[i].name == "chk_wr_id[]")
			f.elements[i].checked = sw;
	}
}

function check_confirm(str)
{
	var f = document.fboardlist;
	var chk_count = 0;

	for (var i=0; i<f.length; i++) {
		if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
			chk_count++;
	}

	if (!chk_count) {
		alert(str + "할 게시물을 하나 이상 선택하세요.");
		return false;
	}
	return true;
}

// 선택한 게시물 삭제
function select_delete()
{
	var f = document.fboardlist;

	str = "삭제";
	if (!check_confirm(str))
		return;

	if (!confirm("선택한 게시물을 정말 "+str+" 하시겠습니까?\n\n한번 "+str+"한 자료는 복구할 수 없습니다"))
		return;

	f.action = "./delete_all.php";
	f.submit();
}

// 선택한 게시물 복사 및 이동
function select_copy(sw)
{
	var f = document.fboardlist;

	if (sw == "copy")
		str = "복사";
	else
		str = "이동";
					   
	if (!check_confirm(str))
		return;

	var sub_win = window.open("", "move", "left=50, top=50, width=396, height=550, scrollbars=1");

	f.sw.value = sw;
	f.target = "move";
	f.action = "./move.php";
	f.submit();
}
</script>
<? } ?>
