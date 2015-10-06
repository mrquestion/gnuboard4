<?
preg_match("/m([0-9]{3})([0-9]{3})_[^\/]*.php$/", __FILE__, $m);
sub_menu2($m, "복구/최적화", "./repair.php");
?>