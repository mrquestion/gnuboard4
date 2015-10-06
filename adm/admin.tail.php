<?
if (!defined("_GNUBOARD_")) exit;
?>

</td></tr></table>

</td></tr></table>

<!-- <p>실행시간 : <?=get_microtime() - $begin_time;?> -->

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
    if (act == "update") // 선택수정
    { 
        f.action = list_update_php;
        str = "수정";
    } 
    else if (act == "delete") // 선택삭제
    { 
        f.action = list_delete_php;
        str = "삭제";
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
        alert(str + "할 자료를 하나 이상 선택하세요.");
        return;
    }

    if (act == "delete")
    {
        if (!confirm("선택한 자료를 정말 삭제 하시겠습니까?"))
            return;
    }

    f.submit();
}
</script>

<? 
include_once("$g4[path]/tail.sub.php");
?>