<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>

<!-- �Խñ� ���� ���� -->
<table width="<?=$width?>" align="center" cellpadding="0" cellspcing="0"><tr><td>

<!-- ��ũ ��ư -->
<? 
ob_start(); 
?>
<table width='100%' cellpadding=0 cellspacing=0>
<tr height=35>
    <td width=75%>
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
    <td width="10%" align="center" bgcolor="#7BB2D6"><font color='#ffffff'><strong>�� ��</strong></font></td>
    <td width="5" align="center" bgcolor="#7BB2D6"><img src="<?=$board_skin_path?>/img/top_02.gif" width="5" height="33"></td>
    <td width="5" align="center" bgcolor="#EEEEEE"><img src="<?=$board_skin_path?>/img/top_03.gif" width="5" height="33"></td>
    <td width="90%" align="left" bgcolor="#EEEEEE" style='word-break:break-all;'>&nbsp;<b><? if ($is_category) { echo ($category_name ? "[$view[ca_name]] " : ""); } ?><?=$view[subject]?></b></td>
    <td width="4" bgcolor="#EEEEEE"><img src="<?=$board_skin_path?>/img/top_04.gif" width="4" height="33"></td>
</tr>
<tr><td colspan=6 height="2"></td></tr>
</table>

<table width="100%" cellspacing="0" cellpadding="0">
<tr height="33"> 
    <td width="4" bgcolor="#7BB2D6"><img src="<?=$board_skin_path?>/img/top_01.gif" width="4" height="33"></td>
    <td width="10%" align="center" bgcolor="#7BB2D6"><font color='#ffffff'><strong>�۾���</strong></font></td>
    <td width="5" align="center" bgcolor="#7BB2D6"><img src="<?=$board_skin_path?>/img/top_02.gif" width="5" height="33"></td>
    <td width="5" align="center" bgcolor="#EEEEEE"><img src="<?=$board_skin_path?>/img/top_03.gif" width="5" height="33"></td>
    <td width="33%" align="left" bgcolor="#EEEEEE">&nbsp;<?=$view[name]?><? if ($is_ip_view) { echo "&nbsp;($ip)"; } ?></td>
    <td width="27%" align="left" bgcolor="#EEEEEE">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr> 
                <td><table width="70" border="0" cellspacing="0" cellpadding="0">
                        <tr> 
                            <td width="4" bgcolor="#7BB2D6"><img src="<?=$board_skin_path?>/img/top_01.gif" width="4" height="33"></td>
                            <td width="61" align="center" bgcolor="#7BB2D6"><font color='#ffffff'><strong>�� ¥</strong></font></td>
                            <td width="5" bgcolor="#7BB2D6"><img src="<?=$board_skin_path?>/img/top_02.gif" width="5" height="33"></td>
                        </tr>
                    </table></td>
                <td width="140" align=center><?=substr($view[wr_datetime],2,14)?></td>
            </tr>
        </table></td>
    <td width="30%" align="center" bgcolor="#E3E3E3">
        <font color="#727272"><b>��ȸ</b>(<?=$view[wr_hit]?>) 
        <? if ($is_good) echo "<b>��õ</b>($view[wr_good])";?> 
        <? if ($is_nogood) echo "<b>����õ</b>($view[wr_nogood])";?></font></td>
    <td width="4" bgcolor="#E3E3E3"><img src="<?=$board_skin_path?>/img/top_04.gif" width="4" height="33"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

<? if ($trackback_url) { ?>
<tr height=30>
    <td align="right">
        Ʈ���� �ּ� : <a href="javascript:clipboard_trackback('<?=$trackback_url?>');" style="letter-spacing:0;" title='�� ���� �Ұ��� ���� �� �ּҸ� ����ϼ���'><?=$trackback_url?></a>&nbsp;
        <script language="JavaScript">
            function clipboard_trackback(str) {
                if (g4_is_gecko)
                    prompt("�� ���� �����ּ��Դϴ�. Ctrl+C�� ���� �����ϼ���.", str);
                else if (g4_is_ie) {
                    window.clipboardData.setData("Text", str);
                    alert("Ʈ���� �ּҰ� ����Ǿ����ϴ�.\n\n<?=$trackback_url?>");
                }
            }
        </script>
    </td>
</tr>
<tr><td height="1" background="<?=$board_skin_path?>/img/dot_bg.gif"></td></tr>
<? } ?>

<?
// ���� ����
$cnt = 0;
for ($i=0; $i<count($view[file]); $i++) {
    if ($view[file][$i][source] && !$view[file][$i][view]) {
        $cnt++;
        echo <<<HEREDOC
        <tr height=30><td>FILE #{$cnt} : <a href='{$view[file][$i][href]}' title='{$view[file][$i][content]}'><b>{$view[file][$i][source]}</b> ({$view[file][$i][size]}), Down:{$view[file][$i][download]}, {$view[file][$i][datetime]}</a></td></tr>
        <tr><td height="1" background="{$board_skin_path}/img/dot_bg.gif"></td></tr>
HEREDOC;
    }
}

// ��ũ
$cnt = 0;
for ($i=1; $i<=$g4[link_count]; $i++) {
    if ($view[link][$i]) {
        $cnt++;
        $link = cut_str($view[link][$i], 70);
        echo <<<HEREDOC
        <tr height=30><td>LINK #{$cnt} : <a href="{$view[link_href][$i]}" target="_blank"><b>{$link}</b></a> ({$view[link_hit][$i]})</td></tr>
        <tr><td height="1" background="{$board_skin_path}/img/dot_bg.gif"></td></tr>
HEREDOC;
    }
}
?>

<tr> 
    <td height="150" valign="top" style='word-break:break-all; padding:10px;'>
        <? 
        // ���� ���
        for ($i=0; $i<=count($view[file]); $i++) {
            if ($view[file][$i][view]) 
                echo $view[file][$i][view] . "<p>";
        }
        ?>

        <span class="ct lh"><?=$view[content];?></span>

<!-- �� �� �ڵ�� �����ϼŵ� �����ϴ�. -->
<br><br><br>
<script type="text/javascript"><!--
google_ad_client = "pub-2822305545668489";
google_ad_width = 234;
google_ad_height = 60;
google_ad_format = "234x60_as";
google_ad_type = "text";
google_ad_channel ="";
google_color_border = "CCCCCC";
google_color_bg = "FFFFFF";
google_color_link = "000000";
google_color_url = "666666";
google_color_text = "333333";
//--></script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script><br><br><span style='font-size:8pt; font-family:����; color:silver;'>���� ������ �״������� ȣ���� ������� ����մϴ�. (��â : Shift + ��ũ Ŭ��)</span><br>
<!-- �� �� �ڵ�� �����ϼŵ� �����ϴ�. -->

        <?//echo $view[rich_content]; // {�̹���:0} �� ���� �ڵ带 ����� ���?>
        <!-- �׷� �±� ������ --></xml></xmp><a href=""></a><a href=''></a></td>
</tr>
<? if ($is_signature) { echo "<tr><td>$signature<br><br></td></tr>"; } // ���� ��� ?>
</table>

<?
include_once("./view_comment.php");
?>

<?=$link_buttons?>

</td></tr></table>

<script language="JavaScript">
// HTML �� �Ѿ�� <img ... > �±��� ���� ���̺������� ũ�ٸ� ���̺����� �����Ѵ�.
function resize_image()
{
    var target = document.getElementsByName('target_resize_image[]');
    var image_width = parseInt('<?=$board[bo_image_width]?>');
    var image_height = 0;

    for(i=0; i<target.length; i++) { 
        // ���� ����� ������ ���´�
        target[i].tmp_width  = target[i].width;
        target[i].tmp_height = target[i].height;
        // �̹��� ���� ���̺� ������ ũ�ٸ� ���̺����� �����
        if(target[i].width > image_width) {
            image_height = parseFloat(target[i].width / target[i].height)
            target[i].width = image_width;
            target[i].height = parseInt(image_width / image_height);
        }
    }
}

window.onload = resize_image;
</script>
<!-- �Խñ� ���� �� -->
