<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>

<style>
.vc_pad1 { PADDING-LEFT: 5px; PADDING-top: 10px; PADDING-BOTTOM: 10px; } 
.vc_pad2 { PADDING-LEFT: 5px; PADDING-top: 0px; PADDING-BOTTOM: 0px; } 
.vc_text     { BORDER: #D3D3D3 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: #ffffff; }
.vc_textarea { BORDER: #D3D3D3 1px solid; BACKGROUND-COLOR: #ffffff; WIDTH: 100%; WORD-BREAK: break-all; }
.vc_content { COLOR:#3E755D; }
</style>

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
    <td valign=top><? for ($k=0; $k<strlen($list[$i][wr_comment_reply]); $k++) echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; ?></td>
    <td width='100%'>
        <table width="100%" cellspacing="0" cellpadding="0">
        <tr> 
            <td width="10" ><img src="<?=$board_skin_path?>/img/left_top.gif" width="10" height="10"></td>
            <td colspan="2" background="<?=$board_skin_path?>/img/width_bg_top.gif"></td>
            <td width="10" ><img src="<?=$board_skin_path?>/img/right_top.gif" width="10" height="10"></td>
        </tr>
        <tr> 
            <td rowspan="2" bordercolor="#CCCCCC" background="<?=$board_skin_path?>/img/left_bg.gif"></td>
            <td width="40%" align="left" valign="top" bgcolor="#f7f7f7" class='vc_pad1'><?=$list[$i][name]?><? if ($is_ip_view) { echo "&nbsp;({$list[$i][ip]})"; } ?></td>
            <td width="60%" align="right" valign="top" bgcolor="#f7f7f7" class='vc_pad1'>
                <table width="100%" cellspacing="0" cellpadding="0">
                <tr> 
                    <td width="250" height=16 align=right>
                        <!-- <?=$list[$i][wr_comment_reply]?>&nbsp; -->
                        <? if ($list[$i][is_reply]) { echo "<a href=\"javascript:comment_box('{$comment_id}', 'c');\"><img src='$board_skin_path/img/btn_comment_reply.gif' border=0 align=absmiddle></a> "; } ?>
                        <? if ($list[$i][is_edit]) { echo "<a href=\"javascript:comment_box('{$comment_id}', 'cu');\"><img src='$board_skin_path/img/btn_comment_update.gif' border=0 align=absmiddle></a> "; } ?>
                        <? if ($list[$i][is_del])  { echo "<a href=\"javascript:comment_delete('{$list[$i][del_link]}');\"><img src='$board_skin_path/img/btn_comment_delete.gif' border=0 align=absmiddle></a> "; } ?>&nbsp;
                    <td width="" align="right" valign="bottom" style="PADDING-RIGHT: 5px"><?=$list[$i][datetime]?></td>
                </tr>
                </table></td>
            <td rowspan="2" bordercolor="#CCCCCC" background="<?=$board_skin_path?>/img/right_bg.gif"></td>
        </tr>
        <tr> 
            <td colspan="2" align="left" bgcolor="#FFFFFF" class='vc_pad1' height="50" style='word-break:break-all;'>
                <!-- �ڸ�Ʈ ��� -->
                <span class="vc_content lh"><?=$list[$i][content]?></span>
                <? if ($list[$i][trackback]) { echo "<p>".$list[$i][trackback]."</p>"; } ?>
                
                <textarea id='save_comment_<?=$comment_id?>' style='display:none;'><?=get_text($list[$i][wr_content], 0)?></textarea>
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
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
    <td height=30 align=right><a href="javascript:comment_box('', 'c');"><img src='<?=$board_skin_path?>/img/btn_comment_insert.gif' border=0 align=absmiddle></a></td>
</tr>
<tr>
    <td>
        <!-- �ڸ�Ʈ �Է����̺���� -->
        <span id=comment_write style='display:none;'>
        <form name="fviewcomment" method="post" action="./write_comment_update.php" onsubmit="return fviewcomment_submit(this);" autocomplete="off">
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
            <td colspan="3" background="<?=$board_skin_path?>/img/width_bg_top.gif"></td>
            <td width="10" ><img src="<?=$board_skin_path?>/img/right_top.gif" width="10" height="10"></td>
        </tr>
        <tr> 
            <td width="10" background="<?=$board_skin_path?>/img/left_bg.gif" >&nbsp;</td>
            <td colspan='2' width='60%' bgcolor="#f7f7f7">
                <table width=100% cellpadding=0 cellspacing=0>
                <tr>
                    <td width=50% valign=bottom>&nbsp;
                        <SPAN style="CURSOR: pointer;" onclick="textarea_decrease('wr_content', 10);"><img src="<?=$board_skin_path?>/img/up.gif" width="16" height="16"></SPAN>
                        <SPAN style="CURSOR: pointer;" onclick="textarea_original('wr_content', 10);"><img src="<?=$board_skin_path?>/img/start.gif" width="16" height="16"></SPAN>
                        <SPAN style="CURSOR: pointer;" onclick="textarea_increase('wr_content', 10);"><img src="<?=$board_skin_path?>/img/down.gif" width="16" height="16"></SPAN> 
                    </td>
                    <td width=50% align=right><span id=char_count></span>����</td>
                </tr>
                </table></td>
            <td bgcolor="#f7f7f7"></td>
            <td width="10" background="<?=$board_skin_path?>/img/right_bg.gif" >&nbsp;</td>
        </tr>
        <tr> 
            <td bordercolor="#CCCCCC" background="<?=$board_skin_path?>/img/left_bg.gif"></td>
            <td colspan="2" align="left" valign="top" bgcolor="#f7f7f7" class='vc_pad1'>
                <TEXTAREA id='wr_content' name='wr_content' class='vc_textarea' rows="10" itemname="����" required ONKEYUP="check_byte('wr_content', 'char_count');"></TEXTAREA>
                <script language="JavaScript"> check_byte('wr_content', 'char_count'); </script>
            </td>
            <td align="center" bgcolor="#f7f7f7">

                <? if ($is_guest) { ?>
                <table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tr> 
                        <td width="80" height="20" align="right">�̸�</td>
                        <td><INPUT type=text maxLength=20 size=15 name="wr_name" itemname="�̸�" required></td>
                    </tr>
                    <tr> 
                        <td width="80" height="20" align="right">�н�����</td>
                        <td><INPUT type=password maxLength=20 size=15 name="wr_password" itemname="�н�����" required></td>
                    </tr>
                    <tr> 
                        <td width="80" height="20" align="right">�̸���</td>
                        <td><INPUT type=text maxLength="100" name="wr_email" itemname="E-mail" email></td>
                    </tr>
                    <tr> 
                        <td width="80" height="20" align="right">Ȩ������</td>
                        <td><INPUT type=text maxLength="100" name="wr_homepage" itemname="Ȩ������"></td>
                    </tr>

                    <? if ($is_norobot) { ?>
                    <tr> 
                        <td width="80" height="20" align="right"><?=$norobot_str?></td>
                        <td><INPUT title="������ ������ �������ڸ� ������� �Է��ϼ���." type="input" name="wr_key" itemname="�ڵ���Ϲ���" required></td>
                    </tr>
                    <? } ?>

                </table>
                <? } ?>

                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                    <td align="center"><INPUT type="image" width="65" height="52" src="<?=$board_skin_path?>/img/ok_button.gif" border=0 accesskey='s'></td>
                </tr>
                </table></td>
            <td bordercolor="#CCCCCC" background="<?=$board_skin_path?>/img/right_bg.gif"></td>
        </tr>
        <tr> 
            <td width="10" ><img src="<?=$board_skin_path?>/img/left_down.gif" width="10" height="10"></td>
            <td colspan="3" background="<?=$board_skin_path?>/img/width_bg_down.gif"></td>
            <td width="10" ><img src="<?=$board_skin_path?>/img/right_down.gif" width="10" height="10"></td>
        </tr>
        </table>
        </form>
        </span>
        <!-- �ڸ�Ʈ �Է� ���̺� �� -->
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
    check_byte('wr_content', 'char_count');
    if (char_min > 0 || char_max > 0)
    {
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
