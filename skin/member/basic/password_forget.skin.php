<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>

<table width="600" height="50" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td height="50" align="center" valign="middle" bgcolor="#EBEBEB"><table width="590" height="40" border="0" cellspacing="0" cellpadding="0">
            <tr> 
                <td width="25" align="center" bgcolor="#FFFFFF" ><img src="<?=$member_skin_path?>/img/icon_01.gif" width="5" height="5"></td>
                <td width="175" align="left" bgcolor="#FFFFFF" ><font color="#666666"><b><?=$g4[title]?></b></font></td>
                <td width="390" align="right" bgcolor="#FFFFFF" ><img src="<?=$member_skin_path?>/img/step_01.gif" width="110" height="16"></td>
            </tr>
            </table></td>
    </tr>
</table>

<table width="600" border="0" cellspacing="0" cellpadding="0">
<form name=fpasswordforget method=post action="javascript:fpasswordforget_submit(document.fpasswordforget);" autocomplete=off>
    <tr> 
        <td height="370" align="center" valign="top"><table width="540" border="0" cellspacing="0" cellpadding="0">
            <tr> 
                <td height="30" colspan="2"></td>
            </tr>
            <tr> 
                <td width="540" height="115" align="center" valign="middle" background="<?=$member_skin_path?>/img/dot_bg_img.gif"><table width="315" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td width="15" height="40"><img src="<?=$member_skin_path?>/img/icon_02.gif" width="6" height="6"></td>
                        <td width="300" colspan="2"><img src="<?=$member_skin_path?>/img/text_title_01.gif" width="149" height="15"></td>
                    </tr>
                    <tr> 
                        <td width="15" height="28"></td>
                        <td width="100"><b>ȸ�����̵�</b></td>
                        <td width="200"><input type=text name='pass_mb_id' size=18 maxlength=20 itemname='ȸ�����̵�'></td>
                    </tr>
                    </table></td>
            </tr>
            <tr> 
                <td width="540" height="20" colspan="2" bgcolor="#FFFFFF"></td>
            </tr>
            <tr>
                <td height="170" colspan="2" align="center" valign="middle" background="<?=$member_skin_path?>/img/gray_bg_img.gif" bgcolor="#FFFFFF"><table width="315" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td width="15" height="40"><img src="<?=$member_skin_path?>/img/icon_02.gif" width="6" height="6"></td>
                        <td width="300" colspan="2"><img src="<?=$member_skin_path?>/img/text_title_02.gif" width="139" height="15"></td>
                    </tr>
                    <tr> 
                        <td width="15" height="28"></td>
                        <td width="100" height="14"><b>�̸�</b></td>
                        <td width="200" height="14"><INPUT name=mb_name itemname="�̸�" size=18></td>
                    </tr>

                    <? if ($config[cf_use_jumin]) { // �ֹε�Ϲ�ȣ�� ����Ѵٸ�(�Է� �޾Ҵٸ�) ?>
                    <tr> 
                        <td width="15" height="28"></td>
                        <td width="100" height="14"><b>�ֹε�Ϲ�ȣ</b></td>
                        <td width="200" height="14"><INPUT name=mb_jumin itemname="�ֹε�Ϲ�ȣ" jumin size=18 maxlength=13> - ���� �Է�</td>
                    </tr>
                    <? } else { ?>
                    <tr> 
                        <td width="15" height="28"></td>
                        <td width="100" height="14"><b>E-mail</b></td>
                        <td width="200" height="14"><INPUT name=mb_email itemname="E-mail" email size=30></td>
                    </tr>
                    <? } ?>
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
        <td height="40" align="center" valign="bottom"><input type="image" src="<?=$member_skin_path?>/img/btn_next_01.gif">&nbsp;&nbsp;<a href="javascript:window.close();"><img src="<?=$member_skin_path?>/img/btn_close.gif" width="48" height="20" border="0"></a></td>
    </tr>
</table>

<script language="JavaScript">
function fpasswordforget_submit(f)
{
    if (f.pass_mb_id.value == "") {
        if (typeof f.mb_jumin != "undefined") {
            if (f.mb_name.value == "" || f.mb_jumin.value == "") {
                alert("ȸ�����̵�\n\n�ƽ� ��쿡�� ȸ�����̵�\n\n�𸣽� ��쿡�� �̸��� �ֹε�Ϲ�ȣ��\n\n�Է��Ͽ� �ֽʽÿ�.");
                return;
            }
        } else if (typeof f.mb_email != "undefined") {
            if (f.mb_name.value == "" || f.mb_email.value == "") {
                alert("ȸ�����̵�\n\n�ƽ� ��쿡�� ȸ�����̵�\n\n�𸣽� ��쿡�� �̸��� E-mail ��\n\n�Է��Ͽ� �ֽʽÿ�.");
                return;
            }
        }
    }

    f.action = "./password_forget2.php";
    f.submit();
}

document.fpasswordforget.pass_mb_id.focus();
</script>
