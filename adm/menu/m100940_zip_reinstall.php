<?
preg_match("/m([0-9]{3})([0-9]{3})_.*.php$/", __FILE__, $m);
sub_menu2($m, "우편번호 재설치", "./zip_reinstall.php");
?>