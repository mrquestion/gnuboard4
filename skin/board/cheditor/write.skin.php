<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�

include_once("$g4[path]/lib/cheditor.lib.php");

if ($w == 'r') $content = '';
?>

<script src="<?=$g4[editor_path]?>/cheditor.js"></script>
<?=cheditor1('wr_content', $write[wr_content]);?>

<script language="javascript">
// ���ڼ� ����
var char_min = parseInt(<?=$write_min?>); // �ּ�
var char_max = parseInt(<?=$write_max?>); // �ִ�
</script>

<!-- �輱�� 2005.4 - ff(�ҿ���) ������ innerhtml ���� ���� <table> �Ʒ��� ������ �ν����� ���մϴ�. -->
<form name="fwrite" method="post" action="javascript:fwrite_check(document.fwrite);" enctype="multipart/form-data" style="margin:0px;">
<input type=hidden name=w        value="<?=$w?>">
<input type=hidden name=bo_table value="<?=$bo_table?>">
<input type=hidden name=wr_id    value="<?=$wr_id?>">
<input type=hidden name=sfl      value="<?=$sfl?>">
<input type=hidden name=stx      value="<?=$stx?>">
<input type=hidden name=spt      value="<?=$spt?>">
<input type=hidden name=sst      value="<?=$sst?>">
<input type=hidden name=sod      value="<?=$sod?>">
<input type=hidden name=page     value="<?=$page?>">

<table width="<?=$width?>" align=center cellpadding=0 cellspacing=0><tr><td>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan=2 height=2 bgcolor=#b0adf5></td></tr>
<tr><td style='padding-left:20px' colspan=2 height=38 bgcolor=#f8f8f9><strong><?=$title_msg?></strong></td></tr>

<? if ($is_name) { ?>
<tr>
    <td style='padding-left:20px; height:30px;'>�� �̸�</td>
    <td><input class=ed maxlength=20 size=15 name=wr_name itemname="�̸�" required value="<?=$name?>"></td></tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

<? if ($is_password) { ?>
<tr>
    <td style='padding-left:20px; height:30px;'>�� �н�����</td>
    <td><input class=ed type=password maxlength=20 size=15 name=wr_password itemname="�н�����" <?=$password_required?>></td></tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

<? if ($is_email) { ?>
<tr>
    <td style='padding-left:20px; height:30px;'>�� �̸���</td>
    <td><input class=ed maxlength=100 size=50 name=wr_email email itemname="�̸���" value="<?=$email?>"></td></tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

<? if ($is_homepage) { ?>
<tr>
    <td style='padding-left:20px; height:30px;'>�� Ȩ������</td>
    <td><input class=ed size=50 name=wr_homepage itemname="Ȩ������" value="<?=$homepage?>"></td></tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

<tr>
    <td width=120 style='padding-left:20px; height:30px;'>�� �ɼ�</td>
    <td><? if ($is_notice) { ?><input type=checkbox name=notice value="1" <?=$notice_checked?>>����&nbsp;<? } ?>
        <?/* if ($is_html) { ?><INPUT onclick="html_auto_br(this);" type=checkbox value="<?=$html_value?>" name="html" <?=$html_checked?>><span class=w_title>HTML</span>&nbsp;<? } */?>
        <input type='hidden' name='html' value='html1'>
        <? if ($is_secret) { ?><input type=checkbox value="secret" name="secret" <?=$secret_checked?>><span class=w_title>��б�</span>&nbsp;<? } ?>
        <input type=checkbox value="mail" name="mail" <?=$recv_email_checked?>>�亯���Ϲޱ�&nbsp;</td></tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>

<? if ($is_category) { ?>
<tr>
    <td style='padding-left:20px; height:30px;'>�� �з�</td>
    <td><select name=ca_name required itemname="�з�"><option value="">�����ϼ���<?=$category_option?></select></td></tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

<tr>
    <td style='padding-left:20px; height:30px;'>�� ����</td>
    <td><input class=ed style="width:100%;" name=wr_subject itemname="����" required value="<?=$subject?>"></td></tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<tr>
    <td style='padding-left:20px;'>�� ����</td>
    <td style='padding:5 0 5 0;'><?=cheditor2('fwrite', 'wr_content', '100%', '350');?></td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>

<? if ($is_link) { ?>
<? for ($i=1; $i<=$g4[link_count]; $i++) { ?>
<tr>
    <td style='padding-left:20px; height:30px;'>�� ��ũ #<?=$i?></td>
    <td><input type='text' class=ed size=50 name='wr_link<?=$i?>' itemname='��ũ #<?=$i?>' value='<?=$write["wr_link{$i}"]?>'></td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>
<? } ?>

<? if ($is_file) { ?>
<tr>
    <td style='padding-left:20px; height:30px;'><table cellpadding=0 cellspacing=0><tr><td style=" padding-top: 10px;">�� ���� <span onclick="add_file();" style='cursor:pointer; font-family:����; font-size:10pt;'>+</span> <span onclick="del_file();" style='cursor:pointer; font-family:����; font-size:10pt;'>-</span></td></tr></table></td>
    <td style='padding:5 0 5 0;'><table id="variableFiles" cellpadding=0 cellspacing=0></table><?// print_r2($file); ?>
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
        </script></td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

<? if ($is_trackback) { ?>
<tr>
    <td style='padding-left:20px; height:30px;'>�� Ʈ�����ּ�</td>
    <td><input class=ed size=50 name=wr_trackback itemname="Ʈ����" value="<?=$trackback?>">
        <? if ($w=="u") { ?><input type=checkbox name="re_trackback" value="1">�� ����<? } ?></td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

<? if ($is_norobot) { ?>
<tr>
    <td style='padding-left:20px; height:30px;'>�� <?=$norobot_str?></td>
    <td><input class=ed type=input size=10 name=wr_key itemname="�ڵ���Ϲ���" required>&nbsp;&nbsp;* ������ ������ <font color="red">�������ڸ�</font> ������� �Է��ϼ���.</td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

<tr><td colspan=2 height=1 bgcolor=#000000></td></tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="100%" height="30" background="<?=$board_skin_path?>/img/write_down_bg.gif"></td>
</tr>
<tr>
    <td width="100%" align="center" valign="top">
        <input type=image id="btn_submit" src="<?=$board_skin_path?>/img/btn_write.gif" border=0 accesskey='s'>&nbsp;
        <a href="./board.php?bo_table=<?=$bo_table?>"><img id="btn_list" src="<?=$board_skin_path?>/img/btn_list.gif" border=0></a></td>
</tr>
</table>

</td></tr></table>
</form>


<script language="javascript">
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
        var cnt = parseInt(document.getElementById('char_count').innerhtml);
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

    <?=cheditor3('wr_content');?>

    f.action = "./write_update.php";
    f.submit();
}

<?
// �����ڶ�� �з� ���ÿ� '����' �ɼ��� �߰���
if ($is_admin) 
{
    echo "
    if (typeof(document.fwrite.ca_name) != 'undefined')
    {
        document.fwrite.ca_name.options.length += 1;
        document.fwrite.ca_name.options[document.fwrite.ca_name.options.length-1].value = '����';
        document.fwrite.ca_name.options[document.fwrite.ca_name.options.length-1].text = '����';
    }";
} 
?>
</script>
