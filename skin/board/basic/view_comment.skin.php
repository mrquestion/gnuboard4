<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�
?>

<script language="JavaScript">
// ���ڼ� ����
var char_min = parseInt(<?=$comment_min?>); // �ּ�
var char_max = parseInt(<?=$comment_max?>); // �ִ�
</script>

<!-- �ڸ�Ʈ ����Ʈ -->
<?
for ($i=0; $i<count($list); $i++) {
    $comment_id = $list[$i][wr_id];
?>
<a name="c_<?=$comment_id?>"></a>
<table width=100% cellpadding=0 cellspacing=0>
<tr>
    <td><? for ($k=0; $k<strlen($list[$i][wr_comment_reply]); $k++) echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; ?></td>
    <td width='100%'>
        <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td width="10" ><img src="<?=$board_skin_path?>/img/left_top.gif" width="10" height="10"></td>
            <td colspan="2" background="<?=$board_skin_path?>/img/width_bg_top.gif"></td>
            <td width="10" ><img src="<?=$board_skin_path?>/img/right_top.gif" width="10" height="10"></td>
        </tr>
        <tr height=30>
            <td rowspan="2" background="<?=$board_skin_path?>/img/left_bg.gif"></td>
            <td width="40%" align="left" bgcolor="#f7f7f7"><?=$list[$i][name]?><? if ($is_ip_view) { echo "&nbsp;({$list[$i][ip]})"; } ?></td>
            <td width="60%" align="right" bgcolor="#f7f7f7">
                <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="250" height=16 align=right>
                        <!-- <?=$list[$i][wr_comment_reply]?>&nbsp; -->
                        <? if ($list[$i][is_reply]) { echo "<a href=\"javascript:comment_box('{$comment_id}', 'c');\"><img src='$board_skin_path/img/btn_comment_reply.gif' border=0 align=absmiddle></a> "; } ?>
                        <? if ($list[$i][is_edit]) { echo "<a href=\"javascript:comment_box('{$comment_id}', 'cu');\"><img src='$board_skin_path/img/btn_comment_update.gif' border=0 align=absmiddle></a> "; } ?>
                        <? if ($list[$i][is_del])  { echo "<a href=\"javascript:comment_delete('{$list[$i][del_link]}');\"><img src='$board_skin_path/img/btn_comment_delete.gif' border=0 align=absmiddle></a> "; } ?>&nbsp;
                    <td width="" align="right"><?=$list[$i][datetime]?>&nbsp;</td>
                </tr>
                </table></td>
            <td rowspan="2" bordercolor="#CCCCCC" background="<?=$board_skin_path?>/img/right_bg.gif"></td>
        </tr>
        <tr>
            <td colspan="2" align="left" bgcolor="#FFFFFF" style='word-break:break-all; padding:5px;'>
                <!-- �ڸ�Ʈ ��� -->
                <span class="ct lh"><?=$list[$i][content]?></span>
                <? if ($list[$i][trackback]) { echo "<p>".$list[$i][trackback]."</p>"; } ?>

                <textarea id='save_comment_<?=$comment_id?>' style='display:none; width:100%'><?=get_text($list[$i][wr_content], 0)?></textarea>
                
                <span id='edit_<?=$comment_id?>' style='display:none;'></span><!-- ���� -->
                <span id='reply_<?=$comment_id?>' style='display:none;'></span><!-- �亯 -->
            </td>
        </tr>
        <tr>
            <td width="10"><img src="<?=$board_skin_path?>/img/left_down.gif" width="10" height="10"></td>
            <td colspan="2" background="<?=$board_skin_path?>/img/width_bg_down.gif"></td>
            <td width="10"><img src="<?=$board_skin_path?>/img/right_down.gif" width="10" height="10"></td>
        </tr>
        </table></td>
</tr>
</table>
<br>
<? } ?>
<!-- �ڸ�Ʈ ����Ʈ -->


<? if ($is_comment_write) { ?>
<!-- �ڸ�Ʈ �Է� -->
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
    <td height=30 align=right><a href="javascript:comment_box('', 'c');"><img src='<?=$board_skin_path?>/img/btn_comment_insert.gif' border=0 align=absmiddle></a></td>
</tr>
<tr>
    <td>
        <span id=comment_write style='display:none;'>
        <form name="fviewcomment" method="post" action="./write_comment_update.php" onsubmit="return fviewcomment_submit(this);" autocomplete="off">
        <input type=hidden name=null><!-- �������� ���ʽÿ�. -->
        <input type=hidden name=w           id=w value='c'>
        <input type=hidden name=bo_table    value='<?=$bo_table?>'>
        <input type=hidden name=wr_id       value='<?=$wr_id?>'>
        <input type=hidden name=comment_id  id='comment_id' value=''>
        <input type=hidden name=sfl         value='<?=$sfl?>' >
        <input type=hidden name=stx         value='<?=$stx?>'>
        <input type=hidden name=spt         value='<?=$spt?>'>
        <input type=hidden name=page        value='<?=$page?>'>
        <input type=hidden name=cwin        value='<?=$cwin?>'>
        <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td width="10" ><img src="<?=$board_skin_path?>/img/left_top.gif" width="10" height="10"></td>
            <td background="<?=$board_skin_path?>/img/width_bg_top.gif"></td>
            <td width="10" ><img src="<?=$board_skin_path?>/img/right_top.gif" width="10" height="10"></td>
        </tr>
        <tr height=30>
            <td width="10" background="<?=$board_skin_path?>/img/left_bg.gif" >&nbsp;</td>
            <td bgcolor="#f7f7f7">
                <table width=100% cellpadding=0 cellspacing=0>
                <tr>
                    <td width=50% valign=bottom>&nbsp;
                        <SPAN style="CURSOR: pointer;" onclick="textarea_decrease('wr_content', 10);"><img src="<?=$board_skin_path?>/img/up.gif" width="16" height="16"></SPAN>
                        <SPAN style="CURSOR: pointer;" onclick="textarea_original('wr_content', 10);"><img src="<?=$board_skin_path?>/img/start.gif" width="16" height="16"></SPAN>
                        <SPAN style="CURSOR: pointer;" onclick="textarea_increase('wr_content', 10);"><img src="<?=$board_skin_path?>/img/down.gif" width="16" height="16"></SPAN>
                    </td>
                    <td width=50% align=right><? if ($comment_min || $comment_max) { ?><span id=char_count></span>����<?}?></td>
                </tr>
                </table></td>
            <td width="10" background="<?=$board_skin_path?>/img/right_bg.gif" >&nbsp;</td>
        </tr>
        <tr>
            <td bordercolor="#CCCCCC" background="<?=$board_skin_path?>/img/left_bg.gif"></td>
            <td bgcolor="#f7f7f7">
                <TEXTAREA id='wr_content' name='wr_content' rows="5" itemname="����" required 
                <? if ($comment_min || $comment_max) { ?>ONKEYUP="check_byte('wr_content', 'char_count');"<?}?> style='width:100%; word-break:break-all;' class=tx></TEXTAREA>
                <? if ($comment_min || $comment_max) { ?><script language="JavaScript"> check_byte('wr_content', 'char_count'); </script><?}?>
            </td>
            <td bordercolor="#CCCCCC" background="<?=$board_skin_path?>/img/right_bg.gif"></td>
        </tr>
        <tr>
            <td bordercolor="#CCCCCC" background="<?=$board_skin_path?>/img/left_bg.gif"></td>
            <td bgcolor="#f7f7f7" height="40">
                <table cellpadding=0 cellspacing="0" align=center valign=bottom>
                <tr>
                    <? if ($is_guest) { ?>
                    <td style='padding-right:5px;'>�̸�</td>
                    <td style='padding-right:10px;'><INPUT type=text maxLength=20 size=15 name="wr_name" itemname="�̸�" required class=ed></td>
                    <td style='padding-right:5px;'>�н�����</td>
                    <td style='padding-right:10px;'><INPUT type=password maxLength=20 size=15 name="wr_password" itemname="�н�����" required class=ed></td>
                    <!-- <td>�̸���</td>
                    <td><INPUT type=text maxLength="100" name="wr_email" itemname="E-mail" email></td>
                    <td>Ȩ������</td>
                    <td><INPUT type=text maxLength="100" name="wr_homepage" itemname="Ȩ������"></td> -->
                        <? if ($is_norobot) { ?>
                        <td style='padding-right:5px;'><?=$norobot_str?></td>
                        <td style='padding-right:10px;'><INPUT title="������ ������ �������ڸ� ������� �Է��ϼ���." type="input" name="wr_key" itemname="�ڵ���Ϲ���" required class=ed></td>
                        <? } ?>
                    <? } ?>
                    <td><INPUT type="image" src="<?=$board_skin_path?>/img/ok_btn.gif" border=0 accesskey='s'></td>
                </tr>
                </table></td>
            <td bordercolor="#CCCCCC" background="<?=$board_skin_path?>/img/right_bg.gif"></td>
        </tr>
        <tr>
            <td width="10" ><img src="<?=$board_skin_path?>/img/left_down.gif" width="10" height="10"></td>
            <td background="<?=$board_skin_path?>/img/width_bg_down.gif"></td>
            <td width="10" ><img src="<?=$board_skin_path?>/img/right_down.gif" width="10" height="10"></td>
        </tr>
        </table>
        </form>
        </span>
    </td>
</tr>
</table>

<? if($cwin==1) { ?><p align=center><a href="javascript:window.close();"><img src="<?=$board_skin_path?>/img/btn_close.gif" border="0"></a><? } ?>

<script language='JavaScript'>
var save_before = '';
var save_html = document.getElementById('comment_write').innerHTML;
function fviewcomment_submit(f)
{
    var pattern = /(^\s*)|(\s*$)/g; // \s ���� ����

    var s;
    if (s = word_filter_check(document.getElementById('wr_content').value))
    {
        alert("���뿡 �����ܾ�('"+s+"')�� ���ԵǾ��ֽ��ϴ�");
        document.getElementById('wr_content').focus();
        return false;
    }

    // ���� ���� ���ֱ�
    var pattern = /(^\s*)|(\s*$)/g; // \s ���� ����
    document.getElementById('wr_content').value = document.getElementById('wr_content').value.replace(pattern, "");
    if (char_min > 0 || char_max > 0)
    {
        check_byte('wr_content', 'char_count');
        var cnt = parseInt(document.getElementById('char_count').innerHTML);
        if (char_min > 0 && char_min > cnt)
        {
            alert("�ڸ�Ʈ�� "+char_min+"���� �̻� ���ž� �մϴ�.");
            return false;
        } else if (char_max > 0 && char_max < cnt)
        {
            alert("�ڸ�Ʈ�� "+char_max+"���� ���Ϸ� ���ž� �մϴ�.");
            return false;
        }
    }
    else if (!document.getElementById('wr_content').value)
    {
        alert("�ڸ�Ʈ�� �Է��Ͽ� �ֽʽÿ�.");
        return false;
    }

    if (typeof(f.wr_name) != 'undefined')
    {
        f.wr_name.value = f.wr_name.value.replace(pattern, "");
        if (f.wr_name.value == '')
        {
            alert('�̸��� �Էµ��� �ʾҽ��ϴ�.');
            f.wr_name.focus();
            return false;
        }
    }

    if (typeof(f.wr_password) != 'undefined')
    {
        f.wr_password.value = f.wr_password.value.replace(pattern, "");
        if (f.wr_password.value == '')
        {
            alert('�н����尡 �Էµ��� �ʾҽ��ϴ�.');
            f.wr_password.focus();
            return false;
        }
    }

    if (typeof(f.wr_key) != 'undefined')
    {
        if (hex_md5(f.wr_key.value) != md5_norobot_key)
        {
            alert('�ڵ���Ϲ����� �������ڰ� ������� �Էµ��� �ʾҽ��ϴ�.');
            f.wr_key.focus();
            return false;
        }
    }

    return true;
}

function comment_box(comment_id, work)
{
    var el_id;
    // �ڸ�Ʈ ���̵� �Ѿ���� �亯, ����
    if (comment_id)
    {
        if (work == 'c')
            el_id = 'reply_' + comment_id;
        else
            el_id = 'edit_' + comment_id;
    }
    else
        el_id = 'comment_write';

    if (save_before != el_id)
    {
        if (save_before)
        {
            document.getElementById(save_before).style.display = 'none';
            document.getElementById(save_before).innerHTML = '';
        }

        document.getElementById(el_id).style.display = '';
        document.getElementById(el_id).innerHTML = save_html;
        // �ڸ�Ʈ ����
        if (work == 'cu')
        {
            document.getElementById('wr_content').value = document.getElementById('save_comment_' + comment_id).value;
            if (typeof char_count != 'undefined')
                check_byte('wr_content', 'char_count');
        }

        document.getElementById('comment_id').value = comment_id;
        document.getElementById('w').value = work;

        save_before = el_id;
    }
}

function comment_delete(url)
{
    if (confirm("�� �ڸ�Ʈ�� �����Ͻðڽ��ϱ�?")) location.href = url;
}

comment_box('', 'c'); // �ڸ�Ʈ �Է����� ���̵��� ó���ϱ����ؼ� �߰� (root��)
</script>
<? } ?>
