<?
$sub_menu = "300300";
include_once("./_common.php");

check_demo();

if ($is_admin != "super")
    alert("1:1 �Խ��� ������ �ְ�����ڸ� �����մϴ�.");

auth_check($auth[$sub_menu], "d");

// 1:1 �Խ��� ���̺� DROP
sql_query(" drop table $g4[one_prefix]$ob_table ", FALSE);

// 1:1 �Խ��� ���� ��ü ����
rm_rf("$g4[path]/data/one/$ob_table");

// 1:1 �Խ��� ���� ����
sql_query(" delete from $g4[oneboard_table] where ob_table = '$ob_table' ");

goto_url("oneboard_list.php?$qstr&page=$page");
?>
