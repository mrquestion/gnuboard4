<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>

<table width="<?=$width?>" align=center border=1 cellpadding=0 cellspacing=0 style="border-collapse:collapse;" bordercolor="#0176B4">
<tr><td height=30>&nbsp;&nbsp;<b><? if ($is_category) { echo ($category_name ? "[$view[ca_name]] " : ""); } ?><?=$view[subject]?></b></td></tr>
<tr><td height=30>&nbsp;&nbsp;�۾��� : <?=$view[name]?><? if ($is_ip_view) { echo "&nbsp;($ip)"; } ?>&nbsp;&nbsp;&nbsp;&nbsp;
    ��¥ : <?=$view[wr_datetime]?>&nbsp;&nbsp;&nbsp;&nbsp;
    ��ȸ : <?=$view[wr_hit]?>&nbsp;&nbsp;&nbsp;&nbsp;
   <? if ($is_good) { ?>��õ : <?=$view[wr_good]?>&nbsp;&nbsp;&nbsp;&nbsp;<?}?>
   <? if ($is_nogood) { ?>����õ : <?=$view[wr_nogood]?>&nbsp;&nbsp;&nbsp;&nbsp;<?}?></td></tr>

<? if ($trackback_url) { ?>
	<tr><td height=30>&nbsp;&nbsp;Ʈ���� �ּ� : <a href="javascript:clipboard_trackback('<?=$trackback_url?>');" style="letter-spacing:0;" title='�� ���� �Ұ��� ���� �� �ּҸ� ����ϼ���'><?=$trackback_url?></a>
	<script language="JavaScript">
	function clipboard_trackback(str) 
	{
		if (g4_is_gecko)
			prompt("�� ���� �����ּ��Դϴ�. Ctrl+C�� ���� �����ϼ���.", str);
		else if (g4_is_ie) {
			window.clipboardData.setData("Text", str);
			alert("Ʈ���� �ּҰ� ����Ǿ����ϴ�.\n\n<?=$trackback_url?>");
		}
	}
	</script></td></tr>
<?}?>

<?
// ���� ����
$cnt = 0;
for ($i=0; $i<count($view[file]); $i++) 
{
    if ($view[file][$i][source] && !$view[file][$i][view]) 
    {
        $cnt++;
        echo "<tr><td height=22>&nbsp;&nbsp;���� : <a href=\"javascript:file_download('{$view[file][$i][href]}', '{$view[file][$i][source]}');\" title='{$view[file][$i][content]}'><b>{$view[file][$i][source]}</b> ({$view[file][$i][size]}), Down : {$view[file][$i][download]}, {$view[file][$i][datetime]}</a></td></tr>";
    }
}

// ��ũ
$cnt = 0;
for ($i=1; $i<=$g4[link_count]; $i++) 
{
    if ($view[link][$i]) 
    {
        $cnt++;
        $link = cut_str($view[link][$i], 70);
        echo "<tr><td height=22>&nbsp;&nbsp;��ũ :  <a href='{$view[link_href][$i]}' target=_blank><b>{$link}</b> ({$view[link_hit][$i]})</a></td></tr>";
    }
}
?>

<tr> 
    <td style='line-height:150%; padding:7px; word-break:break-all;'>
        <? 
        // ���� ���
        for ($i=0; $i<=count($view[file]); $i++) 
		{
            if ($view[file][$i][view]) 
                echo $view[file][$i][view] . "<p>";
        }
        ?>

        <?=$view[content]; // ���� ���� ��� ?>
        
        <? if ($is_signature) { echo "<br>$signature<br><br>"; } // ���� ��� ?></td>
</tr>
</table><br>

<?
include_once("./view_comment.php");
?>

<table width='<?=$width?>' align=center cellpadding=0 cellspacing=0>
<tr height=35>
    <td width=75%>
        <? if ($search_href) { echo "<a href=\"$search_href\">�˻����</a>&nbsp; "; } ?>
        <? echo "<a href=\"$list_href\">���</a>&nbsp; "; ?>

        <? if ($write_href) { echo "<a href=\"$write_href\">����</a>&nbsp; "; } ?>
        <? if ($reply_href) { echo "<a href=\"$reply_href\">�亯</a>&nbsp; "; } ?>

        <? if ($update_href) { echo "<a href=\"$update_href\">����</a>&nbsp; "; } ?>
        <? if ($delete_href) { echo "<a href=\"$delete_href\">����</a>&nbsp; "; } ?>

        <? if ($good_href) { echo "<a href=\"$good_href\" target='hiddenframe'>��õ</a>&nbsp; "; } ?>
        <? if ($nogood_href) { echo "<a href=\"$nogood_href\" target='hiddenframe'>����õ</a>&nbsp; "; } ?>

        <? if ($scrap_href) { echo "<a href=\"javascript:;\" onclick=\"win_scrap('$scrap_href');\">��ũ��</a>&nbsp; "; } ?>

        <? if ($copy_href) { echo "<a href=\"$copy_href\">����</a> "; } ?>
        <? if ($move_href) { echo "<a href=\"$move_href\">�̵�</a> "; } ?>
    </td>
    <td width=25% align=right>
        <? if ($prev_href) { echo "<a href=\"$prev_href\" title=\"$prev_wr_subject\">������</a>&nbsp; "; } ?>
        <? if ($next_href) { echo "<a href=\"$next_href\" title=\"$next_wr_subject\">������</a>&nbsp; "; } ?>
    </td>
</tr>
</table><br>

<script language="JavaScript">
// HTML �� �Ѿ�� <img ... > �±��� ���� ���̺������� ũ�ٸ� ���̺����� �����Ѵ�.
function resize_image()
{
	var target = document.getElementsByName('target_resize_image[]');
	var image_width = parseInt('<?=$board[bo_image_width]?>');
	var image_height = 0;

	for(i=0; i<target.length; i++) 
	{ 
		// ���� ����� ������ ���´�
		target[i].tmp_width  = target[i].width;
		target[i].tmp_height = target[i].height;
		// �̹��� ���� ���̺� ������ ũ�ٸ� ���̺����� �����
		if(target[i].width > image_width) 
		{
			image_height = parseFloat(target[i].width / target[i].height)
			target[i].width = image_width;
			target[i].height = parseInt(image_width / image_height);
		}
	}
}

window.onload = resize_image;

function file_download(link, file)
{
<? if ($board[bo_download_point] < 0) { ?>if (confirm("'"+file+"' ������ �ٿ�ε� �Ͻø� ����Ʈ�� ����(<?=number_format($board[bo_download_point])?>��)�˴ϴ�.\n\n����Ʈ�� �Խù��� �ѹ��� �����Ǹ� ������ �ٽ� �ٿ�ε� �ϼŵ� �ߺ��Ͽ� �������� �ʽ��ϴ�.\n\n�׷��� �ٿ�ε� �Ͻðڽ��ϱ�?"))<?}?>
document.location.href = link;
}
</script>
