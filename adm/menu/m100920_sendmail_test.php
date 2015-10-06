<?
preg_match("/m([0-9]{3})([0-9]{3})_[^\/]*.php$/", __FILE__, $m);
sub_menu2($m, "메일 테스트", "{$g4[admin_path]}/sendmail_test.php");
?>