<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�
?>

<script language="JavaScript">
// ���ڼ� ����
var char_min = parseInt(<?=$write_min?>); // �ּ�
var char_max = parseInt(<?=$write_max?>); // �ִ�
</script>

<!-- �輱�� 2005.4 - FF(�ҿ���) ������ innerHTML ���� ���� <table> �Ʒ��� ������ �ν����� ���մϴ�. -->
<form name="fwrite" method="post" action="javascript:fwrite_check(document.fwrite);" enctype="multipart/form-data" autocomplete="off">
<table width="<?=$width?>" align=center cellpadding=0 cellspacing=0><tr><td align=center>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="4" height="33" bgcolor="#7BB2D6"><img src="<?=$board_skin_path?>/img/top_01.gif" width="4" height="33"></td>
    <td width="14%" align="center" bgcolor="#7BB2D6">&nbsp;</td>
    <td width="5" align="center" bgcolor="#7BB2D6"><img src="<?=$board_skin_path?>/img/top_02.gif" width="5" height="33"></td>
    <td width="5" align="center" bgcolor="#EEEEEE"><img src="<?=$board_skin_path?>/img/top_03.gif" width="5" height="33"></td>
    <td width="86%" align="left" bgcolor="#EEEEEE"><font style="font-family:����; font-size:9pt; color:#7D7D7D"><strong>[ <?=$title_msg?> ]</strong></span></td>
    <td width="4" bgcolor="#EEEEEE"><img src="<?=$board_skin_path?>/img/top_04.gif" width="4" height="33"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<input type=hidden name=w        value="<?=$w?>">
<input type=hidden name=bo_table value="<?=$bo_table?>">
<input type=hidden name=wr_id    value="<?=$wr_id?>">
<input type=hidden name=sfl      value="<?=$sfl?>">
<input type=hidden name=stx      value="<?=$stx?>">
<input type=hidden name=spt      value="<?=$spt?>">
<input type=hidden name=sst      value="<?=$sst?>">
<input type=hidden name=sod      value="<?=$sod?>">
<input type=hidden name=page     value="<?=$page?>">

<? if ($is_name) { ?>
<tr height="30">
    <td width="15%" align="center">�̸�</td>
    <td width="1" valign="bottom"><img src="<?=$board_skin_path?>/img/gray_line.gif" width="1" height="10"></td>
    <td width="84%"><INPUT class=ed maxLength=20 size=15 name=wr_name itemname="�̸�" required value="<?=$name?>"></TD>
</tr>
<tr><td height="1" background="<?=$board_skin_path?>/img/dot_bg.gif" colSpan=10></td></tr>
<? } ?>


<? if ($is_password) { ?>
<tr height="30">
    <td align="center">�н�����</td>
    <td valign="bottom"><img src="<?=$board_skin_path?>/img/gray_line.gif" width="1" height="10"></td>
    <td><INPUT class=ed type=password maxLength=20 size=15 name=wr_password itemname="�н�����" <?=$password_required?>></TD>
</tr>
<tr><td height="1" background="<?=$board_skin_path?>/img/dot_bg.gif" colSpan=10></td></tr>
<? } ?>


<? if ($is_email) { ?>
<tr height="30">
    <td align="center">�̸���</td>
    <td valign="bottom"><img src="<?=$board_skin_path?>/img/gray_line.gif" width="1" height="10"></td>
    <td><INPUT class=ed maxLength=100 size=50 name=wr_email email itemname="�̸���" value="<?=$email?>"></TD>
</tr>
<tr><td height="1" background="<?=$board_skin_path?>/img/dot_bg.gif" colSpan=10></td></tr>
<? } ?>


<? if ($is_homepage) { ?>
<tr height="30">
    <td align="center">Ȩ������</td>
    <td valign="bottom"><img src="<?=$board_skin_path?>/img/gray_line.gif" width="1" height="10"></td>
    <td><INPUT class=ed size=50 name=wr_homepage itemname="Ȩ������" value="<?=$homepage?>"></TD>
</tr>
<tr><td height="1" background="<?=$board_skin_path?>/img/dot_bg.gif" colSpan=10></td></tr>
<? } ?>


<tr height="30">
    <td align="center">�ɼ�</td>
    <td valign="bottom"><img src="<?=$board_skin_path?>/img/gray_line.gif" width="1" height="10"></td>
    <td>
        <? if ($is_notice) { ?><input type=checkbox name=notice value="1" <?=$notice_checked?>>����&nbsp;<? } ?>
        <? if ($is_html) { ?><INPUT onclick="html_auto_br(this);" type=checkbox value="<?=$html_value?>" name="html" <?=$html_checked?>><span class=w_title>HTML</span>&nbsp;<? } ?>
        <? if ($is_secret) { ?><INPUT type=checkbox value="secret" name="secret" <?=$secret_checked?>><span class=w_title>��б�</span>&nbsp;<? } ?>
        <INPUT type=checkbox value="mail" name="mail" <?=$recv_email_checked?>>�亯���Ϲޱ�&nbsp;</TD>
</tr>
<tr><td height="1" background="<?=$board_skin_path?>/img/dot_bg.gif" colSpan=10></td></tr>


<? if ($is_category) { ?>
<tr height="30">
    <td>�з�</td>
    <td valign="bottom"><img src="<?=$board_skin_path?>/img/gray_line.gif" width="1" height="10"></td>
    <td>
        <select name=ca_name required itemname="�з�"><option value="">�����ϼ���<?=$category_option?></select></TD>
</tr>
<tr><td height="1" background="<?=$board_skin_path?>/img/dot_bg.gif" colSpan=10></td></tr>
<? } ?>

<tr height="30">
    <td align="center">����</td>
    <td valign="bottom"><img src="<?=$board_skin_path?>/img/gray_line.gif" width="1" height="10"></td>
    <td><INPUT class=ed style="width:100%;" name=wr_subject itemname="����" required value="<?=$subject?>"></TD>
</tr>
<tr><td height="1" background="<?=$board_skin_path?>/img/dot_bg.gif" colSpan=10></td></tr>
<tr>
    <td align="center">����</td>
    <td valign="bottom"><img src="<?=$board_skin_path?>/img/gray_line.gif" width="1" height="10"></td>
    <td>
        <table width=100% cellpadding=0 cellspacing=0>
        <tr>
            <td width=50% align=left valign=bottom>
                <SPAN style="CURSOR: pointer;" onclick="textarea_decrease('wr_content', 10);"><img src="<?=$board_skin_path?>/img/up.gif" width="16" height="16"></SPAN>
                <SPAN style="CURSOR: pointer;" onclick="textarea_original('wr_content', 10);"><img src="<?=$board_skin_path?>/img/start.gif" width="16" height="16"></SPAN>
                <SPAN style="CURSOR: pointer;" onclick="textarea_increase('wr_content', 10);"><img src="<?=$board_skin_path?>/img/down.gif" width="16" height="16"></SPAN></td>
            <td width=50% align=right><span id=char_count></span>����</td>
        </tr>
        </table>
        <TEXTAREA id=wr_content name=wr_content class=tx style='width:100%;' rows=10 itemname="����" required ONKEYUP="check_byte('wr_content', 'char_count');"><?=$content?></TEXTAREA>
        <script language="JavaScript"> check_byte('wr_content', 'char_count'); </script>
    </TD>
</tr>
<tr><td height="1" background="<?=$board_skin_path?>/img/dot_bg.gif" colSpan=10></td></tr>


<? if ($is_link) { ?>
<? for ($i=1; $i<=$g4[link_count]; $i++) { ?>
<tr height="30">
    <td align="center">��ũ #<?=$i?></td>
    <td valign="bottom"><img src="<?=$board_skin_path?>/img/gray_line.gif" width="1" height="10"></td>
    <td><INPUT type='text' class=ed size=50 name='wr_link<?=$i?>' itemname='��ũ #<?=$i?>' value='<?=$write["wr_link{$i}"]?>'></td>
</tr>
<tr><td height="1" background="<?=$board_skin_path?>/img/dot_bg.gif" colSpan=10></td></tr>
<? } ?>
<? } ?>


<? if ($is_file) { ?>
<tr height="30">
    <td align="center" valign="top"><table cellpadding=0 cellspacing=0><tr><td style=" PADDING-TOP: 10px;">���� <span onclick="add_file();" style='cursor:pointer;'>+</span> <span onclick="del_file();" style='cursor:pointer;'>-</span></td></tr></table></td>
    <td valign="bottom"><img src="<?=$board_skin_path?>/img/gray_line.gif" width="1" height="10"></td>
    <td><table id="variableFiles" cellpadding=0 cellspacing=0></table><?// print_r2($file); ?>
        <script language="JavaScript">
        function add_file(delete_code)
        {
            var objTbl;
            var objRow;
            var objCell;
            if (document.getElementById)
                objTbl = document.getElementById("variableFiles");
            else
                objTbl = document.all["variableFiles"];

            objRow = objTbl.insertRow(objTbl.rows.length);
            objCell = objRow.insertCell(0);

            objCell.innerHTML = "<input type='file' class=ed size=32 name='bf_file[]' title='���� �뷮 <?=$upload_max_filesize?> ���ϸ� ���ε� ����'>";
            if (delete_code)
                objCell.innerHTML += delete_code;
            else
            {
                <? if ($is_file_content) { ?>
                objCell.innerHTML += "<br><input type='text' class=ed size=50 name='bf_content[]' title='���ε� �̹��� ���Ͽ� �ش� �Ǵ� ������ �Է��ϼ���.'>";
                <? } ?>
                ;
            }
        }

        <?=$file_script; //�����ÿ� �ʿ��� ��ũ��Ʈ?>

        function del_file()
        {
            // file_length ���Ϸδ� �ʵ尡 �������� �ʾƾ� �մϴ�.
            var file_length = <?=(int)$file_length?>;
            var objTbl = document.getElementById("variableFiles");
            if (objTbl.rows.length - 1 > file_length)
                objTbl.deleteRow(objTbl.rows.length - 1);
        }
        </script>
    </td>
</tr>
<tr><td height="1" background="<?=$board_skin_path?>/img/dot_bg.gif" colSpan=10></td></tr>
<? } ?>


<? if ($is_trackback) { ?>
<tr height="30">
    <td align="center">Ʈ�����ּ�</td>
    <td valign="bottom"><img src="<?=$board_skin_path?>/img/gray_line.gif" width="1" height="10"></td>
    <td><INPUT class=ed size=50 name=wr_trackback itemname="Ʈ����" value="<?=$trackback?>">
        <? if ($w=="u") { ?><input type=checkbox name="re_trackback" value="1">�� ����<? } ?></TD>
</tr>
<tr><td height="1" background="<?=$board_skin_path?>/img/dot_bg.gif" colSpan=10></td></tr>
<? } ?>


<? if ($is_norobot) { ?>
<tr height="30">
    <td align="center"><?=$norobot_str?></td>
    <td valign="bottom"><img src="<?=$board_skin_path?>/img/gray_line.gif" width="1" height="10"></td>
    <td><INPUT class=ed type=input size=10 name=wr_key itemname="�ڵ���Ϲ���" required>&nbsp;&nbsp;* ������ ������ <FONT COLOR="red">�������ڸ�</FONT> ������� �Է��ϼ���.</TD>
</tr>
<tr><td height="1" background="<?=$board_skin_path?>/img/dot_bg.gif" colSpan=10></td></tr>
<? } ?>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="100%" height="30" background="<?=$board_skin_path?>/img/write_down_bg.gif"></td>
</tr>
<tr>
    <td width="100%" align="center" valign="top">
        <INPUT type=image id="btn_submit" src="<?=$board_skin_path?>/img/ok_btn.gif" border=0 accesskey='s'>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="./board.php?bo_table=<?=$bo_table?>"><img id="btn_list" src="<?=$board_skin_path?>/img/list_btn.gif" border=0></a></td>
</tr>
</table>

</td></tr></table>
</form>


<script language="Javascript">
with (document.fwrite) {
    if (typeof(wr_name) != "undefined")
        wr_name.focus();
    else if (typeof(wr_subject) != "undefined")
        wr_subject.focus();
    else if (typeof(wr_content) != "undefined")
        wr_content.focus();

    if (typeof(ca_name) != "undefined")
        if (w.value == "u")
            ca_name.value = "<?=$write[ca_name]?>";
}

function html_auto_br(obj)
{
    if (obj.checked) {
        result = confirm("�ڵ� �ٹٲ��� �Ͻðڽ��ϱ�?\n\n�ڵ� �ٹٲ��� �Խù� ������ �ٹٲ� ����<br>�±׷� ��ȯ�ϴ� ����Դϴ�.");
        if (result)
            obj.value = "html2";
        else
            obj.value = "html1";
    }
    else
        obj.value = "";
}

function fwrite_check(f)
{
    var s = "";
    if (s = word_filter_check(f.wr_subject.value)) {
        alert("���� �����ܾ�('"+s+"')�� ���ԵǾ��ֽ��ϴ�");
        return;
    }

    if (s = word_filter_check(f.wr_content.value)) {
        alert("���뿡 �����ܾ�('"+s+"')�� ���ԵǾ��ֽ��ϴ�");
        return;
    }

    if (char_min > 0 || char_max > 0)
    {
        var cnt = parseInt(document.getElementById('char_count').innerHTML);
        if (char_min > 0 && char_min > cnt)
        {
            alert("������ "+char_min+"���� �̻� ���ž� �մϴ�.");
            return;
        } else if (char_max > 0 && char_max < cnt)
        {
            alert("������ "+char_max+"���� ���Ϸ� ���ž� �մϴ�.");
            return;
        }
    }

    if (typeof(f.wr_key) != "undefined") {
        if (hex_md5(f.wr_key.value) != md5_norobot_key) {
            alert("�ڵ���Ϲ����� �������ڰ� ������� �Էµ��� �ʾҽ��ϴ�.");
            f.wr_key.focus();
            return;
        }
    }

    f.action = "./write_update.php";
    f.submit();
}
</script>
