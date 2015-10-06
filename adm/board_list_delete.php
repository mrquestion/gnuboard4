<?
$sub_menu = "300100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "d");

// _BOARD_DELETE_ 상수를 선언해야 board_delete.inc.php 가 정상 작동함
define('_BOARD_DELETE_', TRUE);

for ($i=0; $i<count($chk); $i++) {
    // 실제 번호를 넘김
    $k = $chk[$i];

    // include 전에 $bo_table 값을 반드시 넘겨야 함
    $tmp_bo_table = $board_table[$k];
    include ("./board_delete.inc.php");
}

goto_url("./board_list.php?$qstr");
?>
