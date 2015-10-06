<?
preg_match("/m([0-9]{3})([0-9]{3})_.*.php$/", __FILE__, $m);
sub_menu($m, "포인트관리", "./point_list.php");
?>