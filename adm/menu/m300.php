<?
preg_match("/m([0-9]{3})[^\/]*.php$/", __FILE__, $m);
top_menu($m, "게시판관리", "{$g4[admin_path]}/m300_index.php", "#EBC95F");
?>