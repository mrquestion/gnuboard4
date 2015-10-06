<?
preg_match("/m([0-9]{3})([0-9]{3})_[^\/]*.php$/", __FILE__, $m);
sub_menu($m, "접속자현황", "{$g4[admin_path]}/visit_list.php");
?>