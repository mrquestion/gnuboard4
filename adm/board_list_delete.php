<?
$sub_menu = "300100";
include_once("./_common.php");

check_demo();

if ($is_admin != "super")
    alert("�Խ��� ������ �ְ�����ڸ� �����մϴ�.");

auth_check($auth[$sub_menu], "d");

// _BOARD_DELETE_ ����� �����ؾ� board_delete.inc.php �� ���� �۵���
define("_BOARD_DELETE_", TRUE);

for ($i=0; $i<count($chk); $i++) 
{
    // ���� ��ȣ�� �ѱ�
    $k = $chk[$i];

    $sql = " select count(*) as cnt from $g4[board_table] a, $g4[group_table] b
              where a.gr_id = '$gr_id[$k]' 
                and a.gr_id = b.gr_id ";
    $row = sql_fetch($sql);

    // include ���� $bo_table ���� �ݵ�� �Ѱܾ� ��
    $tmp_bo_table = $board_table[$k];
    include ("./board_delete.inc.php");
}

goto_url("./board_list.php?$qstr");
?>
