<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>

<form name="fregister" method="POST" action="javascript:fregister_submit(document.fregister);" autocomplete="off">
<table width=600 cellspacing=0 cellspacing=0 align=center><tr><td align=center>

    <table width="100%" cellspacing="0" cellpadding="0">
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
            <td bgcolor="#cccccc">
                <table cellspacing=1 cellpadding=0 width=100% border=0>
                <tr bgcolor="#ffffff"> 
                    <td width="140" height=30>&nbsp;&nbsp;&nbsp;<b>�̸�</b></td>
                    <td width="">&nbsp;&nbsp;&nbsp;<input name=mb_name itemname="�̸�" required minlength="2" nospace hangul class=ed></td>
                </tr>
                <tr bgcolor="#ffffff"> 
                    <td height=30>&nbsp;&nbsp;&nbsp;<b>�ֹε�Ϲ�ȣ</b></td>
                    <td>&nbsp;&nbsp;&nbsp;<input name=mb_jumin itemname="�ֹε�Ϲ�ȣ" required jumin minlength="13" maxlength=13 class=ed><font style="font-family:����; font-size:9pt; color:#66a2c8">&nbsp;&nbsp;�� ���� 13�ڸ� �߰��� - ���� �Է��ϼ���.</font></td>
                </tr>
                </table></td>
        </tr>
    </table>
    <? } ?>

    <br>
    <table width="100%" cellpadding="4" cellspacing="0" bgcolor=#EEEEEE>
        <tr> 
            <td height=40>&nbsp; <b>ȸ�����Ծ��</b></td>
        </tr>
        <tr> 
            <td align="center" valign="top"><textarea style="width: 98%" rows=5 readonly class=ed><?=get_text($config[cf_stipulation])?></textarea></td>
        </tr>
        <tr> 
            <td height=40>&nbsp; <input type=checkbox value=1 name=agree id=agree>&nbsp;<label for=agree>ȸ�����Ծ���� �о����� ���뿡 �����մϴ�.</label></td>
        </tr>
    </table>

    <br>
    <table width="100%" cellpadding="4" cellspacing="0" bgcolor=#EEEEEE>
        <tr> 
            <td height=40>&nbsp; <b>����������ȣ��å</b></td>
        </tr>
        <tr> 
            <td align="center" valign="top"><textarea style="width: 98%" rows=5 readonly class=ed><?=get_text($config[cf_privacy])?></textarea></td>
        </tr>
        <tr> 
            <td height=40>&nbsp; <input type=checkbox value=1 name=agree2 id=agree2>&nbsp;<label for=agree2>����������ȣ��å�� �о����� ���뿡 �����մϴ�.</label></td>
        </tr>
    </table>

</td></tr></table>

<br>
<div align=center>
<input type=image width="66" height="20" src="<?=$member_skin_path?>/img/join_ok_btn.gif" border=0>
</div>
</form>


<script language="javascript">
function fregister_submit(f) {
    if (!f.agree.checked) {
        alert("ȸ�����Ծ���� ���뿡 �����ؾ� ȸ������ �Ͻ� �� �ֽ��ϴ�.");
        f.agree.focus();
        return;
    }

    if (!f.agree2.checked) {
        alert("����������ȣ��å�� ���뿡 �����ؾ� ȸ������ �Ͻ� �� �ֽ��ϴ�.");
        f.agree2.focus();
        return;
    }

    f.action = "./register_form.php";
    f.submit();
}

if (typeof(document.fregister.mb_name) != "undefined")
    document.fregister.mb_name.focus();
</script>
