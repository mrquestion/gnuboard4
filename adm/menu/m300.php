<?
preg_match("/m([0-9]{3}).*.php$/", __FILE__, $m);
top_menu($m, "게시판관리", "./m300_index.php", "#EBC95F");
?>