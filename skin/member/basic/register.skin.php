<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>

<table width=600 cellspacing=0 cellspacing=0 align=center><tr><td>

<table width="100%" cellspacing="0" cellpadding="0">
<form name="fregister" method="POST" action="javascript:fregister_submit(document.fregister);" autocomplete="off">
<tr> 
    <td align=center><img src="<?=$member_skin_path?>/img/join_title.gif" width="624" height="72"></td>
</tr>
</table>

<? if ($config[cf_use_jumin]) { // �ֹε�Ϲ�ȣ�� ����Ѵٸ� ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td height=25></td>
</tr>
<tr>
    <td bgcolor="#CCCCCC">
        <TABLE cellSpacing=1 cellPadding=0 width=100% border=0>
        <TR bgcolor="#FFFFFF"> 
            <TD width="140" height=30>&nbsp;&nbsp;&nbsp;<b>�̸�</b></TD>
            <TD width="">&nbsp;&nbsp;&nbsp;<INPUT name=mb_name itemname="�̸�" required minlength="2" nospace hangul></TD>
        </TR>
        <TR bgcolor="#FFFFFF"> 
            <TD height=30>&nbsp;&nbsp;&nbsp;<b>�ֹε�Ϲ�ȣ</b></TD>
            <TD>&nbsp;&nbsp;&nbsp;<INPUT name=mb_jumin itemname="�ֹε�Ϲ�ȣ" required jumin minlength="13" maxLength=13><font style="font-family:����; font-size:9pt; color:#66A2C8">&nbsp;&nbsp;�� ���� 13�ڸ� �߰��� - ���� �Է��ϼ���.</font></TD>
        </TR>
        </TABLE></td>
</tr>
</table>
<? } ?>

<table width="100%" cellspacing="0" cellpadding="0">
<tr>
    <td height="20"></td>
</tr>
<tr> 
    <td height="48" background="<?=$member_skin_path?>/img/login_table_bg_top.gif"><b>ȸ�����Ծ��</b></td>
</tr>
<tr> 
    <td height="223" align="center" valign="top" background="<?=$member_skin_path?>/img/login_table_bg.gif"><TEXTAREA style="WIDTH: 100%" rows=15 readOnly><?=get_text($config[cf_stipulation])?></TEXTAREA></td>
</tr>
<tr> 
    <td><INPUT type=checkbox value=1 name=agree>&nbsp;����� ���뿡 �����մϴ�.</td>
</tr>
<tr> 
    <td height="35" background="<?=$member_skin_path?>/img/line.gif"></td>
</tr>
<tr> 
    <td align="center"><INPUT type=image width="66" height="20" src="<?=$member_skin_path?>/img/join_ok_btn.gif" border=0></td>
</tr>
</form>
</table>

<script language="javascript">
function fregister_submit(f)
{
    if (!f.agree.checked) {
        alert("����� ���뿡 �����ؾ� ȸ������ �Ͻ� �� �ֽ��ϴ�.");
        f.agree.focus();
        return;
    }

    f.action = "./register_form.php";
    f.submit();
}

if (typeof(document.fregister.mb_name) != "undefined")
    document.fregister.mb_name.focus();
</script>

</td></tr></table>