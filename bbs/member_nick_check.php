<?
include_once("./_common.php");

$g4[title] = "���� �ߺ�Ȯ��";
include_once("$g4[path]/head.sub.php");

$mb_nick = trim($mb_nick);

$mb = sql_fetch(" select mb_nick from $g4[member_table] where mb_nick = '$mb_nick' ");
if ($mb[mb_nick]) 
{
    echo "<script language='JavaScript'>";
    echo "alert(\"'{$mb_nick}'��(��) �̹� �ٸ��в��� ����ϰ� �ִ� �����̹Ƿ� ����Ͻ� �� �����ϴ�.\");";
    echo "parent.document.getElementById('mb_nick_enabled').value = -1;";
    echo "window.close();";
    echo "</script>";
} 
else 
{
    if (preg_match("/[\,]?{$mb_nick}/i", $config[cf_prohibit_id]))
    {
        echo "<script language='JavaScript'>";
        echo "alert(\"'{$mb_nick}'��(��) ������ ����Ͻ� �� ���� �����Դϴ�.\");";
        echo "parent.document.getElementById('mb_nick_enabled').value = -2;";
        echo "window.close();";
        echo "</script>";
    }
    else
    {
        echo "<script language='JavaScript'>";
        echo "alert(\"'{$mb_nick}'��(��) �������� ����� �� �ֽ��ϴ�.\");";
        echo "parent.document.getElementById('mb_nick_enabled').value = 1;";
        echo "window.close();";
        echo "</script>";
    }
}

include_once("$g4[path]/tail.sub.php");
?>