<?
include_once("./_common.php");

if (!$member[mb_id] && $config[cf_formmail_is_member])  
    alert_close("ȸ���� �̿��Ͻ� �� �ֽ��ϴ�.");

if (!$member[mb_open] && $is_admin != "super" && $member[mb_id] != $mb_id) 
    alert_close("�ڽ��� ������ �������� ������ �ٸ��п��� ������ ���� �� �����ϴ�.\\n\\n�������� ������ ȸ�������������� �Ͻ� �� �ֽ��ϴ�.");

if ($mb_id) {
    $mb = get_member($mb_id);
    if (!$mb[mb_id]) 
        alert_close("ȸ�������� �������� �ʽ��ϴ�.\\n\\nŻ���Ͽ��� �� �ֽ��ϴ�.");

    if (!$mb[mb_open] && $is_admin != "super")
        alert_close("���������� ���� �ʾҽ��ϴ�.");
}

$g4[title] = "���� ����";
include_once("$g4[path]/head.sub.php");

if (!isset($type)) 
    $type = 0;

$type_checked[0] = $type_checked[1] = $type_checked[2] = "";
$type_checked[$type] = "checked";
?>

<table width="600" height="50" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center" valign="middle" bgcolor="#EBEBEB"><table width="590" height="40" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                    <td width="25" align="center" bgcolor="#FFFFFF" ><img src="<?=$g4[bbs_img_path]?>/icon_01.gif" width="5" height="5"></td>
                    <td width="75" align="left" bgcolor="#FFFFFF" ><font color="#666666"><b><?=$g4[title]?></b></font></td>
                    <td width="490" bgcolor="#FFFFFF" ></td>
                </tr>
            </table></td>
    </tr>
</table>

<table width="600" border="0" cellspacing="0" cellpadding="0">
    <tr> 
        <td width="600" height="20" colspan="4"></td>
    </tr>
    <tr> 
        <td width="30" height="24"></td>
        <td width="20" align="center" valign="middle" bgcolor="#EFEFEF"><img src="<?=$g4[bbs_img_path]?>/arrow_01.gif" width="7" height="5"></td>
        <td width="520" align="left" valign="middle" bgcolor="#EFEFEF"><b><?=$name?></b>�Բ� ���Ϻ�����</td>
        <td width="30" height="24"></td>
    </tr>
</table>

<table width="600" border="0" cellspacing="0" cellpadding="0">
<form name="fformmail" method="post" action="javascript:fformmail_submit(document.fformmail);" enctype="multipart/form-data">
<input type="hidden" name="to"     value="<?=$email?>">
<input type="hidden" name="attach" value="2">
<tr> 
    <td height="330" align="center" valign="top"><table width="540" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td height="20"></td>
        </tr>
        <tr> 
            <td height="2" bgcolor="#808080"></td>
        </tr>
        <tr> 
            <td width="540" height="2" align="center" valign="top" bgcolor="#FFFFFF">
                <table width="540" border="0" cellspacing="0" cellpadding="0">
                
                <? if ($member[mb_id]) { // ȸ���̸� ?>
                <input type='hidden' name='fnick'  value='<?=$member[mb_nick]?>'>
                <input type='hidden' name='fmail'  value='<?=$member[mb_email]?>'>
                <? } else { ?>
                <tr> 
                    <td width="80" height="27" align="center"><b>�̸�</b></td>
                    <td width="10" valign="bottom"><img src="<?=$g4[bbs_img_path]?>/l.gif" width="1" height="8"></td>
                    <td width="450"><input type=text style='width:90%;' name='fname' required minlength=2 itemname='�̸�'></td>
                </tr>
                <tr> 
                    <td width="80" height="27" align="center"><b>E-mail</b></td>
                    <td width="10" valign="bottom"><img src="<?=$g4[bbs_img_path]?>/l.gif" width="1" height="8"></td>
                    <td width="450"><input type=text style='width:90%;' name='femail' required email itemname='E-mail'></td>
                </tr>
                <? } ?>

                <tr> 
                    <td width="80" height="27" align="center"><b>����</b></td>
                    <td width="10" valign="bottom"><img src="<?=$g4[bbs_img_path]?>/l.gif" width="1" height="8"></td>
                    <td width="450"><input type=text style='width:90%;' name='subject' required itemname='����'></td>
                </tr>
                <tr> 
                    <td height="1" colspan="3" bgcolor="#E9E9E9"></td>
                </tr>
                <tr> 
                    <td width="80" height="28" align="center"><b>����</b></td>
                    <td width="10" valign="bottom"><img src="<?=$g4[bbs_img_path]?>/l.gif" width="1" height="8"></td>
                    <td width="450"><input type='radio' name='type' value='0' checked> TEXT <input type='radio' name='type' value='1' > HTML <input type='radio' name='type' value='2' > TEXT+HTML</td>
                </tr>
                <tr> 
                    <td height="1" colspan="3" bgcolor="#E9E9E9"></td>
                </tr>
                <tr> 
                    <td width="80" height="150" align="center"><b>����</b></td>
                    <td width="10" valign="bottom"><img src="<?=$g4[bbs_img_path]?>/l.gif" width="1" height="8"></td>
                    <td width="450"><textarea name="content" style='width:90%;' rows='9' required itemname='����'></textarea></td>
                </tr>
                <tr> 
                    <td height="1" colspan="3" bgcolor="#E9E9E9"></td>
                </tr>
                <tr> 
                    <td width="80" height="27" align="center">÷������ #1</td>
                    <td width="10" valign="bottom"><img src="<?=$g4[bbs_img_path]?>/l.gif" width="1" height="8"></td>
                    <td width="450"><input type=file style='width:90%;' name='file1'></td>
                </tr>
                <tr> 
                    <td height="1" colspan="3" bgcolor="#E9E9E9"></td>
                </tr>
                <tr> 
                    <td width="80" height="27" align="center">÷������ #2</td>
                    <td width="10" valign="bottom"><img src="<?=$g4[bbs_img_path]?>/l.gif" width="1" height="8"></td>
                    <td width="450"><input type=file style='width:90%;' name='file2'></td>
                </tr>
                <tr> 
                    <td height="1" colspan="3" bgcolor="#E9E9E9"></td>
                </tr>
                </table></td>
        </tr>
        </table></td>
</tr>
<tr> 
    <td height="2" align="center" valign="top" bgcolor="#D5D5D5"></td>
</tr>
<tr>
    <td height="2" align="center" valign="top" bgcolor="#E6E6E6"></td>
</tr>
<tr>
    <td height="40" align="center" valign="bottom"><input id=btn_submit type=image src="<?=$g4[bbs_img_path]?>/btn_mail_send.gif" border=0>&nbsp;&nbsp;<a href="javascript:window.close();"><img src="<?=$g4[bbs_img_path]?>/btn_close.gif" width="48" height="20" border="0"></a></td>
</tr>
</form>
</table>

<script language="JavaScript">
with (document.fformmail) {
    if (typeof fname != "undefined")
        fname.focus();
    else if (typeof subject != "undefined")
        subject.focus();
}

function fformmail_submit(f)
{
    if (f.file1.value || f.file2.value) {
        if (confirm("÷�������� �뷮�� ū��� ���۽ð��� ���� �ɸ��ϴ�.\n\n���Ϻ����Ⱑ �Ϸ�Ǳ� ���� â�� �ݰų� ���ΰ�ħ ���� ���ʽÿ�."))
            return;
    }

    document.getElementById('btn_submit').disabled = true;

    f.action = "./formmail_send.php";
    f.submit();
}
</script>

<?
include_once("$g4[path]/tail.sub.php");
?>
