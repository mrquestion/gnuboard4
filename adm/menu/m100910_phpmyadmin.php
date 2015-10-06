<?
preg_match("/m([0-9]{3})([0-9]{3})_[^\/]*.php$/", __FILE__, $m);
sub_menu2($m, "phpMyAdmin", "$g4[path]/$g4[phpmyadmin_dir]", "_blank");
?>