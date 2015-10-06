<?
preg_match("/m([0-9]{3})([0-9]{3})_[^\/]*.php$/", __FILE__, $m);
sub_menu2($m, "포인트정리", "{$g4[admin_path]}/point_clear.php");
?>