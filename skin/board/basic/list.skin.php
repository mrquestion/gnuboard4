<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 9;
if ($is_category) $colspan++;
if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// 제목이 두줄로 표시되는 경우 이 코드를 사용해 보세요.
// <nobr style='display:block; overflow:hidden; width:000px;'>제목</nobr>
?>

<style type="text/css">
<!--
.w_fixed { table-layout:fixed; }
.w_font  { font-family:돋움; font-size:9pt; color:#5E5E5E; }
.w_title { font-family:돋움; font-size:9pt; color:#5E5E5E; }
.w_num { font-family:돋움; font-size:9pt; color:#7BB2D6; }
.w_list { font-family:돋움; font-size:9pt; color:#6A6A6A; }
.w_notice { font-family:돋움; font-size:9pt; color:#2C88B9; }
.w_comment_cnt { font-family:돋움; font-size:8pt; color:#9A9A9A; }
.w_padding { PADDING-LEFT: 15px; PADDING-BOTTOM: 5px; PADDING-TOP: 5px; }
.w_padding2 { PADDING-LEFT: 15px; PADDING-TOP: 5px; }
.w_text  { BORDER: #D3D3D3 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: #ffffff; }
.w_textarea  { BORDER: #D3D3D3 1px solid; BACKGROUND-COLOR: #ffffff; WIDTH: 100%; WORD-BREAK: break-all; }
.w_message  { font-family:돋움; font-size:9pt; color:#4B4B4B; }
.w_norobot  { font-family:돋움; font-size:9pt; color:#BB4681; }
-->
</style>

<table width="<?=$width?>" align="center" cellpadding="0" cellspcing="0"><tr><td>

<!-- 분류 셀렉트 박스, 게시물 몇건, 관리자화면 링크 시작 -->
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
    <? if ($is_category) { ?><form name="fcategory" method="get">
    <td width="50%"><select name=sca onchange="location='<?=$category_location?>'+this.value;"><option value=''>전체</option><?=$category_option?></select></td>
    </form><? } ?>
    <td height=25 align="right"><font class=w_font>게시물 <?=number_format($total_count)?>건</font><? if ($admin_href) { ?><a href="<?=$admin_href?>"><img src="<?=$board_skin_path?>/img/admin_button.gif" title="관리자" width="63" height="22" border="0"></a><? } ?></td>
</tr>
</table>
<!-- 분류 셀렉트 박스, 게시물 몇건, 관리자화면 링크 끝 -->

<!-- 여백 --><table width="100%" cellspacing="0" cellpadding="0"><tr><td height="5"></td></tr></table>

<!-- 게시판 제목 시작 -->
<table width="100%" cellspacing="0" cellpadding="0">
<form name="fboardlist" method="post">
<input type="hidden" name="bo_table" value="<?=$bo_table?>">
<input type="hidden" name="sfl"  value="<?=$sfl?>">
<input type="hidden" name="stx"  value="<?=$stx?>">
<input type="hidden" name="spt"  value="<?=$spt?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="sw"   value="">
<tr> 
    <td width="4" height="33" bgcolor="#7BB2D6"><img src="<?=$board_skin_path?>/img/list_top_01.gif" width="4" height="33"></td>
    <td width="40" align="center" bgcolor="#7BB2D6"><font style="font-family:돋움; font-size:9pt; color:#FFFFFF"><strong>번호</strong></font></td>
    <td width="5" align="center" bgcolor="#7BB2D6"><img src="<?=$board_skin_path?>/img/list_top_02.gif" width="5" height="33"></td>
    <td width="5" align="center" bgcolor="#EEEEEE"><img src="<?=$board_skin_path?>/img/list_top_03.gif" width="5" height="33"></td>
    <? if ($is_category) { ?><td width="70" align="center" bgcolor="#EEEEEE"><font class=w_title><strong>분류</strong></font></td><? } ?>
    <? if ($is_checkbox) { ?><td width="40" align="center" bgcolor="#EEEEEE"><INPUT onclick="if (this.checked) all_checked(true); else all_checked(false);" type=checkbox></td><? } ?>
    <td align="center" bgcolor="#EEEEEE"><font class=w_title><strong>제목</strong></font></td>
    <td width="110" align="center" bgcolor="#EEEEEE"><font class=w_title><strong>글쓴이</strong></font></td>
    <td width="40" align="center" bgcolor="#EEEEEE"><?=subject_sort_link('wr_datetime', $qstr2, 1)?><font class=w_title><strong>날짜</strong></font></a></td>
    <td width="40" align="center" bgcolor="#EEEEEE"><?=subject_sort_link('wr_hit', $qstr2, 1)?><font class=w_title><strong>조회</strong></font></a></td>
    <? if ($is_good) { ?><td width="40" align="center" bgcolor="#EEEEEE"><?=subject_sort_link('wr_good', $qstr2, 1)?><font style="font-family:돋움; font-size:9pt; color:#7993AF"><strong>추천</strong></font></a></td><? } ?>
    <? if ($is_nogood) { ?><td width="40" align="center" bgcolor="#EEEEEE"><font style="font-family:돋움; font-size:9pt; color:#A07C7C"><strong>비추천</strong></font></td><? } ?>
    <td width="4" bgcolor="#EEEEEE"><img src="<?=$board_skin_path?>/img/list_top_04.gif" width="4" height="33"></td>
</tr>
</table>
<!-- 게시판 제목 끝 -->

<!-- 게시물 리스트 시작 -->
<table width="100%" cellspacing="0" cellpadding="0" class="w_fixed">
<? for ($i=0; $i<count($list); $i++) { ?>
<tr <? if ($list[$i][is_notice]) { echo "bgcolor='#F9FBFB'"; } else { echo " onmouseover=\"this.style.backgroundColor='#eeeeff';return true;\" onMouseOut=\"this.style.backgroundColor='';return true;\""; }?>> 
    <td width="4" height="33"><img src="<?=$board_skin_path?>/img/trans4.gif" width="4" height="33"></td>
    <td width="40" align="center">
        <? 
        if ($list[$i][is_notice]) // 공지사항 
            echo "<img src=\"$board_skin_path/img/notice_icon.gif\" width=30 height=16>";
        else if ($wr_id == $list[$i][wr_id]) // 현재위치
            echo "<font class=w_num><strong>{$list[$i][num]}</strong></font>";
        else
            echo "<font class=w_list>{$list[$i][num]}</font>";
        ?></td>
    <td width="5" align="center"><img src="<?=$board_skin_path?>/img/trans5.gif" width="5" height="33"></td>
    <td width="5" align="center"><img src="<?=$board_skin_path?>/img/trans5.gif" width="5" height="33"></td>
    <? if ($is_category) { ?><td width="70" align="center"><font class=w_font><strong><a href="<?=$list[$i][ca_name_href]?>"><?=$list[$i][ca_name]?></a></strong></font></td><? } ?>
    <? if ($is_checkbox) { ?><td width="40" align="center"><input type=checkbox name=chk_wr_id[] value="<?=$list[$i][wr_id]?>"></td><? } ?>
    <td align="left" style='word-break:break-all;'>
        <? 
        echo $nobr_begin;
        echo $list[$i][reply];
        echo $list[$i][icon_reply];
        echo "<a href='{$list[$i][href]}'>";
        if ($list[$i][is_notice])
            echo "<font class=w_notice><strong>{$list[$i][subject]}</strong></font>";
        else
            echo "<font class=w_list>{$list[$i][subject]}</font>";
        echo "</a>";

        if ($list[$i][comment_cnt]) 
            echo " <a href=\"{$list[$i][comment_href]}\"><span class=w_comment_cnt>{$list[$i][comment_cnt]}</span></a>";

        // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
        // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

        echo " " . $list[$i][icon_new];
        echo " " . $list[$i][icon_file];
        echo " " . $list[$i][icon_link];
        echo " " . $list[$i][icon_hot];
        echo " " . $list[$i][icon_secret];
        echo $nobr_end;
        ?></td>
    <td width="110" align="center"><font class=w_font><?=$list[$i][name]?></font></td>
    <td width="40" align="center"><font class=w_font><?=$list[$i][datetime2]?></font></td>
    <td width="40" align="center"><font class=w_font><?=$list[$i][wr_hit]?></font></td>
    <? if ($is_good) { ?><td width="40" align="center"><font class=w_font><?=$list[$i][wr_good]?></font></td><? } ?>
    <? if ($is_nogood) { ?><td width="40" align="center"><font class=w_font><?=$list[$i][wr_nogood]?></font></td><? } ?>
    <td width="4"><img src="<?=$board_skin_path?>/img/trans4.gif" width="4" height="33"></td>
</tr>
<tr>
    <td colspan="<?=$colspan?>" height="1" background="<?=$board_skin_path?>/img/dot_bg.gif"></td>
</tr>
<? } ?>
<? if (count($list) == 0) { echo "<tr><td height=100 align=center>게시물이 없습니다.</td></tr>"; } ?>
</form>
</table>
<!-- 게시물 리스트 끝 -->

<!-- 페이지 표시 시작 -->
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
    <td height="37" align="center" background="<?=$board_skin_path?>/img/number_line.gif">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td width="100%" align="center">
                <? if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$board_skin_path/img/btn_search_prev.gif' width=50 height=20 border=0 align=absmiddle title='이전검색'></a>"; } ?>
                <?
                // 기본으로 넘어오는 페이지를 아래와 같이 변환하여 이미지로도 출력할 수 있습니다.
                //echo $write_pages;
                $write_pages = str_replace("처음", "<img src='$board_skin_path/img/begin.gif' border='0' align='absmiddle' title='처음'>", $write_pages);
                $write_pages = str_replace("이전", "<img src='$board_skin_path/img/prev.gif' border='0' align='absmiddle' title='이전'>", $write_pages);
                $write_pages = str_replace("다음", "<img src='$board_skin_path/img/next.gif' border='0' align='absmiddle' title='다음'>", $write_pages);
                $write_pages = str_replace("맨끝", "<img src='$board_skin_path/img/end.gif' border='0' align='absmiddle' title='맨끝'>", $write_pages);
                $write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "<font style=\"font-family:돋움; font-size:9pt; color:#797979\">$1</font>", $write_pages);
                $write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<font style=\"font-family:돋움; font-size:9pt; color:orange;\">$1</font>", $write_pages);
                ?>
                <strong><?=$write_pages?></strong>
                <? if ($next_part_href) { echo "<a href='$next_part_href'><img src='$board_skin_path/img/btn_search_next.gif' width=50 height=20 border=0 align=absmiddle title='다음검색'></a>"; } ?>
            </td>
        </tr>
        </table></td>
</tr>
</table>
<!-- 페이지 표시 끝 -->

<table width="100%" cellspacing="0" cellpadding="0">
<tr align="left"> 
    <td width="50%" height="40">
        <? if ($list_href) { ?><a href="<?=$list_href?>"><img src="<?=$board_skin_path?>/img/btn_list.gif" border="0"></a><? } ?>
        <? if ($write_href) { ?><a href="<?=$write_href?>"><img src="<?=$board_skin_path?>/img/btn_write.gif" border="0"></a><? } ?>
        <? if ($is_checkbox) { ?>
            <a href="javascript:select_delete();"><img src="<?=$board_skin_path?>/img/btn_select_delete.gif" border="0"></a>
            <a href="javascript:select_copy('copy');"><img src="<?=$board_skin_path?>/img/btn_select_copy.gif" border="0"></a>
            <a href="javascript:select_copy('move');"><img src="<?=$board_skin_path?>/img/btn_select_move.gif" border="0"></a>
        <? } ?>
    </td>
    <form name=fsearch method=get>
    <input type=hidden name=bo_table value="<?=$bo_table?>">
    <input type=hidden name=sca      value="<?=$sca?>">
    <td width="50%" align="right">
        <select name=sfl>
            <option value='wr_subject'>제목</option>
            <option value='wr_content'>내용</option>
            <option value='mb_id'>회원아이디</option>
            <option value='wr_name'>이름</option>
        </select>
        <INPUT maxLength=15 size=10 name=stx itemname="검색어" required value="<?=$stx?>">
        <SELECT name=sop>
            <OPTION value=and>And</OPTION>
            <OPTION value=or>Or</OPTION>
        </SELECT>
    </td>
    <td width="10%" align="center"><INPUT type=image width="53" height="18" src="<?=$board_skin_path?>/img/search_btn.gif" border=0></td>
    </form>
</tr>
</table>

</td></tr></table>

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
