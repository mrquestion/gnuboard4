<?
$sub_menu = "100200";
include_once("./_common.php");

check_demo();

if ($is_admin != "super")
    alert("�ְ�����ڸ� ���� �����մϴ�.");

for ($i=0; $i<count($chk); $i++) 
{
    // ���� ��ȣ�� �ѱ�
    $k = $chk[$i];

    $sql = " delete from $g4[auth_table] where mb_id = '$mb_id[$k]' and au_menu = '$au_menu[$k]' ";
    sql_query($sql);
}

goto_url("./auth_list.php?$qstr");
?>
