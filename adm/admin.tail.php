<?
if (!defined("_GNUBOARD_")) exit;
?>

</td></tr></table>

</td></tr></table>

<!-- <p>����ð� : <?=get_microtime() - $begin_time;?> -->

<p>
<div align=right><a href='#g4_head'><img src='img/btn_top.gif' border=0></a>&nbsp;</div>
<br>

</td></tr></table>

<script language='javascript'>
function check_all(f)
{
    var chk = document.getElementsByName("chk[]");

    for (i=0; i<chk.length; i++)
        chk[i].checked = f.chkall.checked;
}

function btn_check(f, act)
{
    if (act == "update") // ���ü���
    { 
        f.action = list_update_php;
        str = "����";
    } 
    else if (act == "delete") // ���û���
    { 
        f.action = list_delete_php;
        str = "����";
    } 
    else
        return;

    var chk = document.getElementsByName("chk[]");
    var bchk = false;

    for (i=0; i<chk.length; i++)
    {
        if (chk[i].checked)
            bchk = true;
    }

    if (!bchk) 
    {
        alert(str + "�� �ڷḦ �ϳ� �̻� �����ϼ���.");
        return;
    }

    if (act == "delete")
    {
        if (!confirm("������ �ڷḦ ���� ���� �Ͻðڽ��ϱ�?"))
            return;
    }

    f.submit();
}
</script>

<? 
include_once("$g4[path]/tail.sub.php");
?>