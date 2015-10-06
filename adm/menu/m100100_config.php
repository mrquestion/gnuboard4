<?
preg_match("/m([0-9]{3})([0-9]{3})_.*.php$/", __FILE__, $m);
sub_menu($m, "기본환경설정", "./config_form.php");
?>