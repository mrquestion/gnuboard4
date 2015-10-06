<?
include_once("./_common.php");

$g4[title] = "별명 중복확인";
include_once("$g4[path]/head.sub.php");

$mb = sql_fetch(" select mb_nick from $g4[member_table] where mb_nick = '$mb_nick' ");
if ($mb[mb_nick]) 
{
    echo "
    <script language='JavaScript'> 
        alert(\"'{$mb_nick}'은(는) 이미 다른분께서 사용하고 있는 별명이므로 사용하실 수 없습니다.\"); 
        parent.document.getElementById('mb_nick_enabled').value = -1;
        window.close();
    </script>";
} 
else 
{
    echo "
    <script language='JavaScript'> 
        alert(\"'{$mb_nick}'은(는) 별명으로 사용할 수 있습니다.\"); 
        parent.document.getElementById('mb_nick_enabled').value = 1;
        window.close();
    </script>";
}

include_once("$g4[path]/tail.sub.php");
?>