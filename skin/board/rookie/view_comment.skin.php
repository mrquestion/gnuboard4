<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�
?>

<script language="JavaScript">
// ���ڼ� ����
var char_min = parseInt(<?=$comment_min?>); // �ּ�
var char_max = parseInt(<?=$comment_max?>); // �ִ�
</script>

<? if ($cwin==1) { // ��â���� ���� ��� ?><table width=100% cellpadding=10><tr><td><?}?>

<?
for ($i=0; $i<count($list); $i++) 
{
    $comment_id = $list[$i][wr_id];
?>
<a name="c_<?=$comment_id?>"></a>
<table width="<?=$width?>" align=center cellpadding=0 cellspacing=0>
<tr>
    <td><? for ($k=0; $k<strlen($list[$i][wr_comment_reply]); $k++) echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; ?></td>
    <td width="100%">
        <table width=100% cellpadding=0 cellspacing=0 style='padding-top:5px;'>
        <tr>
            <td><b><?=$list[$i][name]?><? if ($is_ip_view) { echo "&nbsp;({$list[$i][ip]})"; } ?></b></td>
            <td align=right>
                <? if ($list[$i][is_reply]) { echo "<a href=\"javascript:comment_box('{$comment_id}', 'c');\">�亯</a>&nbsp; "; } ?>
                <? if ($list[$i][is_edit]) { echo "<a href=\"javascript:comment_box('{$comment_id}', 'cu');\">����</a>&nbsp; "; } ?>
                <? if ($list[$i][is_del])  { echo "<a href=\"javascript:comment_delete('{$list[$i][del_link]}');\">����</a>&nbsp; "; } ?>
                &nbsp;&nbsp;<?=$list[$i][datetime]?></td>
        </tr>
        </table>

        <table width=100% border=1 cellpadding=0 cellspacing=0 style="border-collapse:collapse;" bordercolor="#0176B4">
        <tr>                            
            <td style='line-height:150%; padding:7px; word-break:break-all;'>
                <?=$list[$i][content]; // �ڸ�Ʈ ��� ?>
                <? if ($list[$i][trackback]) { echo "<p>".$list[$i][trackback]."</p>"; } ?>
                <span id='edit_<?=$comment_id?>' style='display:none;'></span><!-- ���� -->
                <span id='reply_<?=$comment_id?>' style='display:none;'></span><!-- �亯 -->
            </td>
        </tr>
        </table>

        <textarea id='save_comment_<?=$comment_id?>' style='display:none;'><?=get_text($list[$i][wr_content], 0); // �����ϱ� ���� �ڸ�Ʈ�� ���� ?></textarea></td>
</tr>
</table>
<? } ?>


<? if ($is_comment_write) { ?>
<!-- �ڸ�Ʈ �Է� -->
<div align=right style='width:<?=$width?>'><a href="javascript:comment_box('', 'c');">�ڸ�Ʈ �Է�</a></div>

<div id=comment_write style='display:none;'>
<form name="fviewcomment" method="post" action="./write_comment_update.php" onsubmit="return fviewcomment_submit(this);" autocomplete="off" style="margin:0px;">
<input type=hidden name=w           id=w value='c'>
<input type=hidden name=bo_table    value='<?=$bo_table?>'>
<input type=hidden name=wr_id       value='<?=$wr_id?>'>
<input type=hidden name=comment_id  id='comment_id' value=''>
<input type=hidden name=sca         value='<?=$sca?>' >
<input type=hidden name=sfl         value='<?=$sfl?>' >
<input type=hidden name=stx         value='<?=$stx?>'>
<input type=hidden name=spt         value='<?=$spt?>'>
<input type=hidden name=page        value='<?=$page?>'>
<input type=hidden name=cwin        value='<?=$cwin?>'>
<table width="<?=$width?>" align=center border=1 cellpadding=4 cellspacing=0 style="border-collapse:collapse;" bordercolor="#0176B4">
<tr><td>

    <span style="cursor: pointer;" onclick="textarea_decrease('wr_content', 5);">��</span>
    <span style="cursor: pointer;" onclick="textarea_original('wr_content', 5);">��</span>
    <span style="cursor: pointer;" onclick="textarea_increase('wr_content', 5);">��</span>
	&nbsp;

    <? if ($is_guest) { ?>
        �̸� <input type=text maxlength=20 size=15 name="wr_name" itemname="�̸�" required>
        �н����� <input type=password maxlength=20 size=15 name="wr_password" itemname="�н�����" required>
            <? if ($is_norobot) { ?>
                <?=$norobot_str?>
                <input title="������ ������ �������ڸ� ������� �Է��ϼ���." type="input" name="wr_key" itemname="�ڵ���Ϲ���" required size=7>
            <?}?>
    <?}?>

	<? if ($comment_min || $comment_max) { ?><span id=char_count></span>����<?}?></td></tr>
<tr>
    <td>
        <textarea id="wr_content" name="wr_content" rows="5" itemname="����" required 
            <? if ($comment_min || $comment_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?} // �ڸ�Ʈ �ּ�, �ִ� ������ �ִٸ�?> style='width:100%; word-break:break-all;'></textarea>
            <? if ($comment_min || $comment_max) { ?><script language="javascript"> check_byte('wr_content', 'char_count'); </script><?} // �ڸ�Ʈ �ּ�, �ִ� ������ �ִٸ� ?></td>
    <td width=70 align=center><input type="submit" value="Ȯ ��" border=0 accesskey='s'></td></tr>
</table>
</form>
</div>

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

<? if($cwin==1) { ?></td><tr></table><p align=center><a href="javascript:window.close();">â�ݱ�</a><br><br><?}?>
