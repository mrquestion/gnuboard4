<?
preg_match("/m([0-9]{3})([0-9]{3})_[^\/]*.php$/", __FILE__, $m);
sub_menu($m, "회원메일발송", "./mail_list.php");
?>