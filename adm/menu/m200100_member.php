<?
preg_match("/m([0-9]{3})([0-9]{3})_[^\/]*.php$/", __FILE__, $m);
sub_menu($m, "회원관리", "{$g4[admin_path]}/member_list.php");
?>