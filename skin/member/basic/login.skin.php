<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>

<table width="668" border="0" cellspacing="0" cellpadding="0">
<form name="flogin" method="post" action="javascript:flogin_submit(document.flogin);" autocomplete="off">
<input type="hidden" name="url" value='<?=$urlencode?>'>
<!-- <tr align="center"> 
    <td colspan="3"><img src="<?=$member_skin_path?>/img/login_title.gif" width="624" height="72"></td>
</tr> -->
<tr>
    <td height="26"></td>
    <td width="628"></td>
    <td width="20"></td>
</tr>
<tr>
    <td width="20" height="2"></td>
    <td width="628" bgcolor="#8F8F8F"></td>
    <td width="20"></td>
</tr>
<tr>
    <td width="20" height="48"></td>
    <td width="628" align="right" background="<?=$member_skin_path?>/img/login_table_bg_top.gif"><img src="<?=$member_skin_path?>/img/login_img.gif" width="344" height="48"></td>
    <td width="20"></td>
</tr>
<tr>
    <td width="20" height="223"></td>
    <td width="628" align="center" background="<?=$member_skin_path?>/img/login_table_bg.gif">
        <table width="460" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="460" height="223" align="center" bgcolor="#FFFFFF">
                <table width="350" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="250">
                        <table width="250" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="10"><img src="<?=$member_skin_path?>/img/icon.gif" width="3" height="3"></td>
                            <td width="90" height="26"><b>���̵�</b></td>
                            <td width="150"><INPUT class=box1 maxLength=20 size=15 name=mb_id itemname="���̵�" required minlength="2"></td>
                        </tr>
                        <tr>
                            <td><img src="<?=$member_skin_path?>/img/icon.gif" width="3" height="3"></td>
                            <td height="26"><b>�н�����</b></td>
                            <td><INPUT type=password class=box1 maxLength=20 size=15 name=mb_password itemname="�н�����" required></td>
                        </tr>
                        <tr>
                            <td><img src="<?=$member_skin_path?>/img/icon.gif" width="3" height="3"></td>
                            <td height="26"><b>�ڵ��α���</b></td>
                            <td><INPUT onclick="if (this.checked) { if (confirm('�ڵ��α����� ����Ͻø� �������� ȸ�����̵�� �н����带 �Է��Ͻ� �ʿ䰡 �����ϴ�.\n\n\������ҿ����� ���������� ����� �� ������ ����� �����Ͽ� �ֽʽÿ�.\n\n�ڵ��α����� ����Ͻðڽ��ϱ�?')) { this.checked = true; } else { this.checked = false;} }" type=checkbox name=auto_login>
                                <b>���</b></td>
                        </tr>
                        </table>
                    </td>
                    <td width="100" valign="top"><INPUT type=image width="65" height="52" src="<?=$member_skin_path?>/img/btn_login.gif" border=0></td>
                </tr>
                <tr>
                    <td height="5" colspan="2"></td>
                </tr>
                <tr>
                    <td height="1" background="<?=$member_skin_path?>/img/dot_line.gif" colspan="2"></td>
                </tr>
                <tr>
                    <td height="5" colspan="2"></td>
                </tr>
                <tr>
                    <td height="26" colspan="2"><img src="<?=$member_skin_path?>/img/icon.gif" width="3" height="3"> ���� ȸ���� �ƴϽʴϱ�?&nbsp;&nbsp;&nbsp;&nbsp;<a href="./register.php"><img width="72" height="20" src="<?=$member_skin_path?>/img/btn_register.gif" border=0 align="absmiddle"></a></td>
                </tr>
                <tr>
                    <td height="26" colspan="2"><img src="<?=$member_skin_path?>/img/icon.gif" width="3" height="3"> ���̵�/�н����带 �����̽��ϱ�?&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="win_password_forget('./password_forget.php');"><img src="<?=$member_skin_path?>/img/btn_password_forget.gif" width="108" height="20" border=0 align="absmiddle"></td>
                </tr>
                </table></td>
        </tr>
        </table></td>
    <td width="20"></td>
</tr>
<tr>
    <td width="20" height="1"></td>
    <td width="628" bgcolor="#F0F0F0"></td>
    <td width="20"></td>
</tr>
<tr>
    <td height="20" colspan="3"></td>
</tr>
</form>
</table>

<script language='Javascript'>
document.flogin.mb_id.focus();

function flogin_submit(f)
{
    f.action = "./login_check.php";
    f.submit();
}
</script>
