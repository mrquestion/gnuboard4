<?
$sub_menu = "300100";
include_once("./_common.php");

check_demo();

if ($is_admin != "super")
    alert("�Խ��� ������ �ְ�����ڸ� �����մϴ�.");

auth_check($auth[$sub_menu], "d");

// _BOARD_DELETE_ ����� �����ؾ� board_delete.inc.php �� ���� �۵���
define("_BOARD_DELETE_", TRUE);

// include ���� $bo_table ���� �ݵ�� �Ѱܾ� ��
$tmp_bo_table = $bo_table;
include_once ("./board_delete.inc.php");

goto_url("./board_list.php?$qstr&page=$page");
?>
