<?
preg_match("/m([0-9]{3})([0-9]{3})_[^\/]*.php$/", __FILE__, $m);
sub_menu($m, "기본환경설정", "{$g4[admin_path]}/config_form.php");
?>