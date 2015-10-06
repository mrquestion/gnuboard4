<?
preg_match("/m([0-9]{3})[^\/]*.php$/", __FILE__, $m);
top_menu($m, "회원관리", "{$g4[admin_path]}/m200_index.php", "#F1A683");
?>