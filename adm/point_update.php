<?
$sub_menu = "200200";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

$mb = get_member($mb_id);

if (!$mb[mb_id])
    alert("�����ϴ� ȸ�����̵� �ƴմϴ�."); 

if (($po_point < 0) && ($po_point * (-1) > $mb[mb_point]))
    alert("����Ʈ�� ��� ��� ���� ����Ʈ���� ������ �ȵ˴ϴ�.");

insert_point($mb_id, $po_point, $po_content, '@passive', $mb_id, $member[mb_id]."-".uniqid(""));

goto_url("./point_list.php?$qstr");
?>
