<?
$sub_menu = "300100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "d");

// _BOARD_DELETE_ 상수를 선언해야 board_delete.inc.php 가 정상 작동함
define("_BOARD_DELETE_", TRUE);

// include 전에 $bo_table 값을 반드시 넘겨야 함
$tmp_bo_table = $bo_table;
include_once ("./board_delete.inc.php");

goto_url("./board_list.php?$qstr&page=$page");
?>
