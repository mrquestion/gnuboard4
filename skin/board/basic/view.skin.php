<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<style>
.v_padding1 { PADDING-LEFT: 5px; PADDING-BOTTOM: 5px; PADDING-TOP: 5px; }
.v_padding2 { PADDING-LEFT: 5px; PADDING-right: 0px; PADDING-BOTTOM: 5px; PADDING-TOP: 5px; }
.v_padding3 { PADDING-LEFT: 0px; PADDING-right: 0px; PADDING-BOTTOM: 7px; PADDING-TOP: 10px; }
.v_padding4 { PADDING-LEFT: 5px; PADDING-right: 0px; PADDING-BOTTOM: 5px; PADDING-TOP: 5px; }
.v_padding5 { PADDING-LEFT: 10px; PADDING-right: 20px; PADDING-BOTTOM: 7px; PADDING-TOP: 10px; }
.v_padding6 { PADDING-BOTTOM: 20px; PADDING-TOP: 20px; }
.v_text1 { BORDER-RIGHT: #D3D3D3 1px solid; BORDER-TOP: #D3D3D3 1px solid; BORDER-LEFT: #D3D3D3 1px solid; BORDER-BOTTOM: #D3D3D3 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: #ffffff; }
.v_text2 { }
.v_content { COLOR:#3E755D; }
</style>

<table width="<?=$width?>" align="center" cellpadding="0" cellspcing="0"><tr><td>

<!-- 링크 버튼 -->
<? 
ob_start(); 
?>
<table width='100%' cellpadding=0 cellspacing=0>
<tr>
    <td width=75% height=35>
        <? if ($search_href) { echo "<a href=\"$search_href\"><img src='$board_skin_path/img/btn_search_list.gif' border='0' align='absmiddle'></a> "; } ?>
        <? echo "<a href=\"$list_href\"><img src='$board_skin_path/img/btn_list.gif' border='0' align='absmiddle'></a> "; ?>

        <? if ($write_href) { echo "<a href=\"$write_href\"><img src='$board_skin_path/img/btn_write.gif' border='0' align='absmiddle'></a> "; } ?>
        <? if ($reply_href) { echo "<a href=\"$reply_href\"><img src='$board_skin_path/img/btn_reply.gif' border='0' align='absmiddle'></a> "; } ?>

        <? if ($update_href) { echo "<a href=\"$update_href\"><img src='$board_skin_path/img/btn_update.gif' border='0' align='absmiddle'></a> "; } ?>
        <? if ($delete_href) { echo "<a href=\"$delete_href\"><img src='$board_skin_path/img/btn_delete.gif' border='0' align='absmiddle'></a> "; } ?>

        <? if ($good_href) { echo "<a href=\"$good_href\" target='hiddenframe'><img src='$board_skin_path/img/btn_good.gif' border='0' align='absmiddle'></a> "; } ?>
        <? if ($nogood_href) { echo "<a href=\"$nogood_href\" target='hiddenframe'><img src='$board_skin_path/img/btn_nogood.gif' border='0' align='absmiddle'></a> "; } ?>

        <? if ($scrap_href) { echo "<a href=\"javascript:;\" onclick=\"win_scrap('./scrap_popin.php?bo_table=$bo_table&wr_id=$wr_id');\"><img src='$board_skin_path/img/btn_scrap.gif' border='0' align='absmiddle'></a> "; } ?>

        <? if ($copy_href) { echo "<a href=\"$copy_href\"><img src='$board_skin_path/img/btn_copy.gif' border='0' align='absmiddle'></a> "; } ?>
        <? if ($move_href) { echo "<a href=\"$move_href\"><img src='$board_skin_path/img/btn_move.gif' border='0' align='absmiddle'></a> "; } ?>
    </td>
    <td width=25% align=right>
        <? if ($prev_href) { echo "<a href=\"$prev_href\" title=\"$prev_wr_subject\"><img src='$board_skin_path/img/btn_prev.gif' border='0' align='absmiddle'></a>&nbsp;"; } ?>
        <? if ($next_href) { echo "<a href=\"$next_href\" title=\"$next_wr_subject\"><img src='$board_skin_path/img/btn_next.gif' border='0' align='absmiddle'></a>&nbsp;"; } ?>
    </td>
</tr>
</table>
<?
$link_buttons = ob_get_contents();
ob_end_flush();
?>

<table width="100%" cellspacing="0" cellpadding="0">
<tr> 
    <td width="4" height="33" bgcolor="#7BB2D6"><img src="<?=$board_skin_path?>/img/top_01.gif" width="4" height="33"></td>
    <td width="10%" align="center" bgcolor="#7BB2D6"><font style="font-family:돋움; font-size:9pt; color:#ffffff"><strong>제 목</strong></font></td>
    <td width="5" align="center" bgcolor="#7BB2D6"><img src="<?=$board_skin_path?>/img/top_02.gif" width="5" height="33"></td>
    <td width="5" align="center" bgcolor="#EEEEEE"><img src="<?=$board_skin_path?>/img/top_03.gif" width="5" height="33"></td>
    <td width="90%" align="left" bgcolor="#EEEEEE" class=v_padding1 style='word-break:break-all;'><font class="v_text2"><b><? if ($is_category) { echo ($category_name ? "[$view[ca_name]] " : ""); } ?><?=$view[subject]?></b></font></td>
    <td width="4" bgcolor="#EEEEEE"><img src="<?=$board_skin_path?>/img/top_04.gif" width="4" height="33"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="100%" height="2" bgcolor="#FFFFFF"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr> 
    <td width="4" height="33" bgcolor="#7BB2D6"><img src="<?=$board_skin_path?>/img/top_01.gif" width="4" height="33"></td>
    <td width="10%" align="center" bgcolor="#7BB2D6"><font style="font-family:돋움; font-size:9pt; color:#ffffff"><strong>글쓴이</strong></font></td>
    <td width="5" align="center" bgcolor="#7BB2D6"><img src="<?=$board_skin_path?>/img/top_02.gif" width="5" height="33"></td>
    <td width="5" align="center" bgcolor="#EEEEEE"><img src="<?=$board_skin_path?>/img/top_03.gif" width="5" height="33"></td>
    <td width="33%" align="left" bgcolor="#EEEEEE" class=v_padding1><font class="v_text2"><?=$view[name]?></font><? if ($is_ip_view) { echo "&nbsp;($ip)"; } ?></td>
    <td width="27%" align="left" bgcolor="#EEEEEE">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr> 
                <td><table width="70" border="0" cellspacing="0" cellpadding="0">
                        <tr> 
                            <td width="4" bgcolor="#7BB2D6"><img src="<?=$board_skin_path?>/img/top_01.gif" width="4" height="33"></td>
                            <td width="61" align="center" bgcolor="#7BB2D6"><font style="font-family:돋움; font-size:9pt; color:#ffffff"><strong>날 짜</strong></font></td>
                            <td width="5" bgcolor="#7BB2D6"><img src="<?=$board_skin_path?>/img/top_02.gif" width="5" height="33"></td>
                        </tr>
                    </table></td>
                <td width="140" class=v_padding2><font class="v_text2"><?=substr($view[wr_datetime],2,14)?></font></td>
            </tr>
        </table></td>
    <td width="30%" align="center" bgcolor="#E3E3E3" class=v_padding4>
        <font style="font-family:돋움; font-size:9pt; color:#727272"><b>조회</b>(<?=$view[wr_hit]?>) 
        <? if ($is_good) echo "<b>추천</b>($view[wr_good])";?> 
        <? if ($is_nogood) echo "<b>비추천</b>($view[wr_nogood])";?></font></td>
    <td width="4" bgcolor="#E3E3E3"><img src="<?=$board_skin_path?>/img/top_04.gif" width="4" height="33"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

<? if ($trackback_url) { ?>
<tr>
    <td colspan="3" align="right" class=v_padding3>
        트랙백 주소 : <a href="javascript:clipboard_trackback('<?=$trackback_url?>');" style="letter-spacing:0;" title='이 글을 소개할 때는 이 주소를 사용하세요'><?=$trackback_url?></a>&nbsp;
        <script language="JavaScript">
            function clipboard_trackback(str) {
                if (g4_is_gecko)
                    prompt("이 글의 고유주소입니다. Ctrl+C를 눌러 복사하세요.", str);
                else if (g4_is_ie) {
                    window.clipboardData.setData("Text", str);
                    alert("트랙백 주소가 복사되었습니다.\n\n<?=$trackback_url?>");
                }
            }
        </script>
    </td>
</tr>
<tr> 
    <td height="1" colspan="3" align="right" background="<?=$board_skin_path?>/img/dot_bg.gif"></td>
</tr>
<? } ?>

<?
// 가변 파일
$cnt = 0;
for ($i=0; $i<count($view[file]); $i++) {
    if ($view[file][$i][source] && !$view[file][$i][view]) {
        $cnt++;
        echo <<<HEREDOC
        <tr> 
            <td width="30" class=v_padding3><img src="{$board_skin_path}/img/file_icon.gif" width="13" height="13">&nbsp;</td>
            <td width="30" class=v_padding3><font class="v_text2">#{$cnt}</font></td>
            <td width="100%" class=v_padding5><a href='{$view[file][$i][href]}' title='{$view[file][$i][content]}'><font class="v_text2">{$view[file][$i][source]} ({$view[file][$i][size]}), Down:{$view[file][$i][download]}, {$view[file][$i][datetime]}</FONT></a></td>
        </tr>
        <tr> 
            <td height="1" colspan="3" align="right" background="{$board_skin_path}/img/dot_bg.gif"></td>
        </tr>
HEREDOC;
    }
}

// 링크
$cnt = 0;
for ($i=1; $i<=$g4[link_count]; $i++) {
    if ($view[link][$i]) {
        $cnt++;
        $link = cut_str($view[link][$i], 70);
        echo <<<HEREDOC
        <tr> 
            <td width="30" class=v_padding3><img src="{$board_skin_path}/img/link_icon.gif" width="13" height="13">&nbsp;</td>
            <td width="30" class=v_padding3><font class="v_text2">#{$cnt}</font></td>
            <td width="100%" class=v_padding5><a href="{$view[link_href][$i]}" target="_blank"><font class="v_text2">{$link} ({$view[link_hit][$i]})</FONT></a></td>
        </tr>
        <tr> 
            <td height="1" colspan="3" align="right" background="{$board_skin_path}/img/dot_bg.gif"></td>
        </tr>
HEREDOC;
    }
}
?>

<tr> 
    <td height="200" colspan="3" valign="top" class=v_padding6 style='word-break:break-all;'>
        <? 
        // 파일 출력
        for ($i=0; $i<=count($view[file]); $i++) {
            if ($view[file][$i][view]) 
                echo $view[file][$i][view] . "<p>";
        }
        ?>

        <span class="v_content lh"><?=$view[content];?></span>
        <?//echo $view[rich_content]; // {이미지:0} 과 같은 코드를 사용할 경우?>
        <!-- 테러 태그 방지용 --></xml></xmp><a href=""></a><a href=''></a></td>
</tr>
<? if ($is_signature) { echo "<tr><td>$signature<br><br></td></tr>"; } // 서명 출력 ?>
</table>

<?
include_once("./view_comment.php");
?>

<?=$link_buttons?>

</td></tr></table>

<script language="JavaScript">
// HTML 로 넘어온 <img ... > 태그의 폭이 테이블폭보다 크다면 테이블폭을 적용한다.
function resize_image()
{
    var target = document.getElementsByName('target_resize_image[]');
    var image_width = parseInt('<?=$board[bo_image_width]?>');
    var image_height = 0;

    for(i=0; i<target.length; i++) { 
        // 원래 사이즈를 저장해 놓는다
        target[i].tmp_width  = target[i].width;
        target[i].tmp_height = target[i].height;
        // 이미지 폭이 테이블 폭보다 크다면 테이블폭에 맞춘다
        if(target[i].width > image_width) {
            image_height = parseFloat(target[i].width / target[i].height)
            target[i].width = image_width;
            target[i].height = parseInt(image_width / image_height);
        }
    }
}

window.onload = resize_image;
</script>
