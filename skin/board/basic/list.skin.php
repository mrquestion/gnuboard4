<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

// ���ÿɼ����� ���� ����ġ�Ⱑ ���������� ����
$colspan = 9;
if ($is_category) $colspan++;
if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// ������ ���ٷ� ǥ�õǴ� ��� �� �ڵ带 ����� ������.
// <nobr style='display:block; overflow:hidden; width:000px;'>����</nobr>
?>

<style type="text/css">
<!--
.w_fixed { table-layout:fixed; }
.w_font  { font-family:����; font-size:9pt; color:#5E5E5E; }
.w_title { font-family:����; font-size:9pt; color:#5E5E5E; }
.w_num { font-family:����; font-size:9pt; color:#7BB2D6; }
.w_list { font-family:����; font-size:9pt; color:#6A6A6A; }
.w_notice { font-family:����; font-size:9pt; color:#2C88B9; }
.w_comment_cnt { font-family:����; font-size:8pt; color:#9A9A9A; }
.w_padding { PADDING-LEFT: 15px; PADDING-BOTTOM: 5px; PADDING-TOP: 5px; }
.w_padding2 { PADDING-LEFT: 15px; PADDING-TOP: 5px; }
.w_text  { BORDER: #D3D3D3 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: #ffffff; }
.w_textarea  { BORDER: #D3D3D3 1px solid; BACKGROUND-COLOR: #ffffff; WIDTH: 100%; WORD-BREAK: break-all; }
.w_message  { font-family:����; font-size:9pt; color:#4B4B4B; }
.w_norobot  { font-family:����; font-size:9pt; color:#BB4681; }
-->
</style>

<table width="<?=$width?>" align="center" cellpadding="0" cellspcing="0"><tr><td>

<!-- �з� ����Ʈ �ڽ�, �Խù� ���, ������ȭ�� ��ũ ���� -->
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
    <? if ($is_category) { ?><form name="fcategory" method="get">
    <td width="50%"><select name=sca onchange="location='<?=$category_location?>'+this.value;"><option value=''>��ü</option><?=$category_option?></select></td>
    </form><? } ?>
    <td height=25 align="right"><font class=w_font>�Խù� <?=number_format($total_count)?>��</font><? if ($admin_href) { ?><a href="<?=$admin_href?>"><img src="<?=$board_skin_path?>/img/admin_button.gif" title="������" width="63" height="22" border="0"></a><? } ?></td>
</tr>
</table>
<!-- �з� ����Ʈ �ڽ�, �Խù� ���, ������ȭ�� ��ũ �� -->

<!-- ���� --><table width="100%" cellspacing="0" cellpadding="0"><tr><td height="5"></td></tr></table>

<!-- �Խ��� ���� ���� -->
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
    <td width="40" align="center" bgcolor="#7BB2D6"><font style="font-family:����; font-size:9pt; color:#FFFFFF"><strong>��ȣ</strong></font></td>
    <td width="5" align="center" bgcolor="#7BB2D6"><img src="<?=$board_skin_path?>/img/list_top_02.gif" width="5" height="33"></td>
    <td width="5" align="center" bgcolor="#EEEEEE"><img src="<?=$board_skin_path?>/img/list_top_03.gif" width="5" height="33"></td>
    <? if ($is_category) { ?><td width="70" align="center" bgcolor="#EEEEEE"><font class=w_title><strong>�з�</strong></font></td><? } ?>
    <? if ($is_checkbox) { ?><td width="40" align="center" bgcolor="#EEEEEE"><INPUT onclick="if (this.checked) all_checked(true); else all_checked(false);" type=checkbox></td><? } ?>
    <td align="center" bgcolor="#EEEEEE"><font class=w_title><strong>����</strong></font></td>
    <td width="110" align="center" bgcolor="#EEEEEE"><font class=w_title><strong>�۾���</strong></font></td>
    <td width="40" align="center" bgcolor="#EEEEEE"><?=subject_sort_link('wr_datetime', $qstr2, 1)?><font class=w_title><strong>��¥</strong></font></a></td>
    <td width="40" align="center" bgcolor="#EEEEEE"><?=subject_sort_link('wr_hit', $qstr2, 1)?><font class=w_title><strong>��ȸ</strong></font></a></td>
    <? if ($is_good) { ?><td width="40" align="center" bgcolor="#EEEEEE"><?=subject_sort_link('wr_good', $qstr2, 1)?><font style="font-family:����; font-size:9pt; color:#7993AF"><strong>��õ</strong></font></a></td><? } ?>
    <? if ($is_nogood) { ?><td width="40" align="center" bgcolor="#EEEEEE"><font style="font-family:����; font-size:9pt; color:#A07C7C"><strong>����õ</strong></font></td><? } ?>
    <td width="4" bgcolor="#EEEEEE"><img src="<?=$board_skin_path?>/img/list_top_04.gif" width="4" height="33"></td>
</tr>
</table>
<!-- �Խ��� ���� �� -->

<!-- �Խù� ����Ʈ ���� -->
<table width="100%" cellspacing="0" cellpadding="0" class="w_fixed">
<? for ($i=0; $i<count($list); $i++) { ?>
<tr <? if ($list[$i][is_notice]) { echo "bgcolor='#F9FBFB'"; } else { echo " onmouseover=\"this.style.backgroundColor='#eeeeff';return true;\" onMouseOut=\"this.style.backgroundColor='';return true;\""; }?>> 
    <td width="4" height="33"><img src="<?=$board_skin_path?>/img/trans4.gif" width="4" height="33"></td>
    <td width="40" align="center">
        <? 
        if ($list[$i][is_notice]) // �������� 
            echo "<img src=\"$board_skin_path/img/notice_icon.gif\" width=30 height=16>";
        else if ($wr_id == $list[$i][wr_id]) // ������ġ
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
<? if (count($list) == 0) { echo "<tr><td height=100 align=center>�Խù��� �����ϴ�.</td></tr>"; } ?>
</form>
</table>
<!-- �Խù� ����Ʈ �� -->

<!-- ������ ǥ�� ���� -->
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
    <td height="37" align="center" background="<?=$board_skin_path?>/img/number_line.gif">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td width="100%" align="center">
                <? if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$board_skin_path/img/btn_search_prev.gif' width=50 height=20 border=0 align=absmiddle title='�����˻�'></a>"; } ?>
                <?
                // �⺻���� �Ѿ���� �������� �Ʒ��� ���� ��ȯ�Ͽ� �̹����ε� ����� �� �ֽ��ϴ�.
                //echo $write_pages;
                $write_pages = str_replace("ó��", "<img src='$board_skin_path/img/begin.gif' border='0' align='absmiddle' title='ó��'>", $write_pages);
                $write_pages = str_replace("����", "<img src='$board_skin_path/img/prev.gif' border='0' align='absmiddle' title='����'>", $write_pages);
                $write_pages = str_replace("����", "<img src='$board_skin_path/img/next.gif' border='0' align='absmiddle' title='����'>", $write_pages);
                $write_pages = str_replace("�ǳ�", "<img src='$board_skin_path/img/end.gif' border='0' align='absmiddle' title='�ǳ�'>", $write_pages);
                $write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "<font style=\"font-family:����; font-size:9pt; color:#797979\">$1</font>", $write_pages);
                $write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<font style=\"font-family:����; font-size:9pt; color:orange;\">$1</font>", $write_pages);
                ?>
                <strong><?=$write_pages?></strong>
                <? if ($next_part_href) { echo "<a href='$next_part_href'><img src='$board_skin_path/img/btn_search_next.gif' width=50 height=20 border=0 align=absmiddle title='�����˻�'></a>"; } ?>
            </td>
        </tr>
        </table></td>
</tr>
</table>
<!-- ������ ǥ�� �� -->

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
            <option value='wr_subject'>����</option>
            <option value='wr_content'>����</option>
            <option value='mb_id'>ȸ�����̵�</option>
            <option value='wr_name'>�̸�</option>
        </select>
        <INPUT maxLength=15 size=10 name=stx itemname="�˻���" required value="<?=$stx?>">
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
        alert(str + "�� �Խù��� �ϳ� �̻� �����ϼ���.");
        return false;
    }
    return true;
}

// ������ �Խù� ����
function select_delete()
{
    var f = document.fboardlist;

    str = "����";
    if (!check_confirm(str))
        return;

    if (!confirm("������ �Խù��� ���� "+str+" �Ͻðڽ��ϱ�?\n\n�ѹ� "+str+"�� �ڷ�� ������ �� �����ϴ�"))
        return;

    f.action = "./delete_all.php";
    f.submit();
}

// ������ �Խù� ���� �� �̵�
function select_copy(sw)
{
    var f = document.fboardlist;

    if (sw == "copy")
        str = "����";
    else
        str = "�̵�";
                       
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
