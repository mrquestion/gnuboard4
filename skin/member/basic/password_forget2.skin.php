<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>

<table width="600" height="50" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td height="50" align="center" valign="middle" bgcolor="#EBEBEB"><table width="590" height="40" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                    <td width="25" align="center" bgcolor="#FFFFFF" ><img src="<?=$member_skin_path?>/img/icon_01.gif" width="5" height="5"></td>
                    <td width="175" align="left" bgcolor="#FFFFFF" ><font color="#666666"><b>ȸ�����̵�/�н����� ã��</b></font></td>
                    <td width="390" align="right" bgcolor="#FFFFFF" ><img src="<?=$member_skin_path?>/img/step_02.gif" width="110" height="16"></td>
                </tr>
            </table></td>
    </tr>
</table>

<table width="600" border="0" cellspacing="0" cellpadding="0">
<form name=fpasswordforget2 method=post action="javascript:fpasswordforget2_submit(document.fpasswordforget2);" autocomplete=off>
<input type=hidden name=bo_table   value='<?=$bo_table?>'>
<input type=hidden name=pass_mb_id value='<?=$mb[mb_id]?>'>
    <tr> 
        <td width="600" height="300" align="center" valign="middle" background="<?=$member_skin_path?>/img/dot_bg_img_01.gif">
            <table width="400" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                    <td width="5%" height="40" align="center"><img src="<?=$member_skin_path?>/img/icon_02.gif" width="6" height="6"></td>
                    <td width="20%"><b>ȸ�����̵�</b></td>
                    <td width="75%"><b><?=$mb[mb_id]?></b></td>
                </tr>
                <tr> 
                    <td height="40" align="center"><img src="<?=$member_skin_path?>/img/icon_02.gif" width="6" height="6"></td>
                    <td colspan="2"><b>�н����� �нǽ� ����</b></td>
                </tr>
                <tr> 
                    <td height="30" align="center"></td>
                    <td colspan="2" valign="top"><?=$mb[mb_password_q]?></td>
                </tr>
                <tr> 
                    <td height="40" align="center"><img src="<?=$member_skin_path?>/img/icon_02.gif" width="6" height="6"></td>
                    <td colspan="2"><b>�н����� �нǽ� �亯</b></td>
                </tr>
                <tr> 
                    <td height="30"></td>
                    <td colspan="2" valign="top">
                        <input type=text name='mb_password_a' size=55 required itemname='�н����� �нǽ� �亯' value=''>
                    </td>
                </tr>
                <tr> 
                    <td height="40" align="center"><img src="<?=$member_skin_path?>/img/icon_02.gif" width="6" height="6"></td>
                    <td colspan="2">
                        <?="<img src='$g4[bbs_path]/norobot_image.php?".time()."' border='0' align='absmiddle'>";?>
                        <input type=text name='wr_key' size=10 required itemname='�ڵ���Ϲ��� �ڵ�'> �ڵ���Ϲ��� �ڵ带 �Է��ϼ���.
                    </td>
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
        <td height="40" align="center" valign="bottom"><input type="image" src="<?=$member_skin_path?>/img/btn_next_01.gif">&nbsp;&nbsp;<a href="javascript:window.close();"><img src="<?=$member_skin_path?>/img/btn_close.gif" width="48" height="20" border="0"></a></td>
    </tr>
</form>
</table>

<script language="javascript" src="<?=$g4['path']?>/js/md5.js"></script>
<script language='javascript'> var md5_norobot_key = '<?=md5($norobot_key)?>'; </script>
<script language='JavaScript'>
function fpasswordforget2_submit(f)
{
    if (hex_md5(f.wr_key.value) != md5_norobot_key) {
        alert('�ڵ���Ϲ����� �ڵ尡 ������� �Էµ��� �ʾҽ��ϴ�.');
        f.wr_key.focus();
        return;
    }

    f.action = "./password_forget3.php";
    f.submit();
}

document.fpasswordforget2.mb_password_a.focus();
</script>
