<?
preg_match("/m([0-9]{3})([0-9]{3})_[^\/]*.php$/", __FILE__, $m);
sub_menu($m, "게시판그룹관리", "{$g4[admin_path]}/boardgroup_list.php");
?>