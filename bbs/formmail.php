<?
include_once("./_common.php");

if (!$member[mb_id] && $config[cf_formmail_is_member])  
    alert_close("ȸ���� �̿��Ͻ� �� �ֽ��ϴ�.");

if (!$member[mb_open] && $is_admin != "super" && $member[mb_id] != $mb_id) 
    alert_close("�ڽ��� ������ �������� ������ �ٸ��п��� ������ ���� �� �����ϴ�.\\n\\n�������� ������ ȸ�������������� �Ͻ� �� �ֽ��ϴ�.");

if ($mb_id) {
    $mb = get_member($mb_id);
    if (!$mb[mb_id]) 
        alert_close("ȸ�������� �������� �ʽ��ϴ�.\\n\\nŻ���Ͽ��� �� �ֽ��ϴ�.");

    if (!$mb[mb_open] && $is_admin != "super")
        alert_close("���������� ���� �ʾҽ��ϴ�.");
}

$g4[title] = "���� ����";
include_once("$g4[path]/head.sub.php");

if (!isset($type)) 
    $type = 0;

$type_checked[0] = $type_checked[1] = $type_checked[2] = "";
$type_checked[$type] = "checked";

$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";
include_once("$member_skin_path/formmail.skin.php");

include_once("$g4[path]/tail.sub.php");
?>
