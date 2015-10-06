<?
preg_match("/m([0-9]{3})[^\/]*.php$/", __FILE__, $m);
top_menu($m, "환경설정", "./m100_index.php", "#E68484");
?>