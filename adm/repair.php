<?
$sub_menu = "100991";
include_once("./_common.php");

if ($is_admin != "super")
    alert("�ְ�����ڸ� ���� �����մϴ�.", $g4[path]);

$g4[title] = "���̺� ���� �� ����ȭ";
include_once("./admin.head.php");
echo "<span id='ct'></span>";
include_once("./admin.tail.php");
flush();

$sql = "SHOW TABLE STATUS FROM ".$mysql_db;
$result = sql_query($sql);
while($row = sql_fetch_array($result))
{
    $str = '';

    $tbl = $row['Name'];

    $sql1 = " SELECT COUNT(*) FROM `$tbl` ";
    $result1 = @mysql_query($sql1);
    if (!$result1)
    {
        // ���̺� ����
        $sql2 = " REPAIR TABLE `$tbl` ";
        sql_query($sql2);
        $str .= $sql2 . "<br/>";
    }

    if($row['Data_free'] == 0) continue;

    // ���̺� ����ȭ
    $sql3 = " OPTIMIZE TABLE `$tbl` ";
    sql_query($sql3);
    $str .= $sql3 . "<br/>";

    echo "<script>document.getElementById('ct').innerHTML += '$str';</script>\n";

    flush();
    /*
    for($i = 0; $i < 40 - strlen($tbl); $i ++) echo " ";
        echo "\t";
    for($i = 0; $i < 9 - strlen($row['Data_free']); $i ++) echo " ";
        echo $row['Data_free']." OPTIMIZED\n";
    */
}
echo "<script>document.getElementById('ct').innerHTML += '���̺� ���� �� ����ȭ �Ϸ�.';</script>\n";
?>