<?
include_once("./_common.php");

if ($_POST[pass_mb_id])
    $sql = " select mb_id, mb_password_q from $g4[member_table] where mb_id = '$_POST[pass_mb_id]' ";
else if ($_POST[mb_name] && $_POST[mb_jumin])
    $sql = " select mb_id, mb_password_q from $g4[member_table] where mb_name = '$_POST[mb_name]' and mb_jumin = '".sql_password($_POST[mb_jumin])."' ";
else if ($_POST[mb_name] && $_POST[mb_email])
    $sql = " select mb_id, mb_password_q from $g4[member_table] where mb_name = '$_POST[mb_name]' and mb_email = '$_POST[mb_email]' ";
else 
    alert("�ùٸ� ������� �����Ͽ� �ֽʽÿ�.");

$mb = sql_fetch($sql);
if (!$mb[mb_id]) 
    alert("�Է��Ͻ� �������δ� ȸ�������� �������� �ʽ��ϴ�.");
else if (is_admin($mb[mb_id])) 
    alert("������ ���̵�� ���� �Ұ��մϴ�.");

$g4[title] = "�н����� ã�� 2�ܰ�";
include_once("$g4[path]/head.sub.php");

$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";
include_once("$member_skin_path/password_forget2.skin.php");

include_once("$g4[path]/tail.sub.php");
?>