<?
include_once("./_common.php");

$g4[title] = "���� �ߺ�Ȯ��";
include_once("$g4[path]/head.sub.php");

$mb = sql_fetch(" select mb_nick from $g4[member_table] where mb_nick = '$mb_nick' ");
if ($mb[mb_nick]) 
{
    echo "
    <script language='JavaScript'> 
        alert(\"'{$mb_nick}'��(��) �̹� �ٸ��в��� ����ϰ� �ִ� �����̹Ƿ� ����Ͻ� �� �����ϴ�.\"); 
        parent.document.getElementById('mb_nick_enabled').value = -1;
        window.close();
    </script>";
} 
else 
{
    echo "
    <script language='JavaScript'> 
        alert(\"'{$mb_nick}'��(��) �������� ����� �� �ֽ��ϴ�.\"); 
        parent.document.getElementById('mb_nick_enabled').value = 1;
        window.close();
    </script>";
}

include_once("$g4[path]/tail.sub.php");
?>