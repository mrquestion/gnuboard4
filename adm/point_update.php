<?
$sub_menu = "200200";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

$mb = get_member($mb_id);

if (!$mb[mb_id])
    alert("존재하는 회원아이디가 아닙니다."); 

if (($po_point < 0) && ($po_point * (-1) > $mb[mb_point]))
    alert("포인트를 깎는 경우 현재 포인트보다 작으면 안됩니다.");

insert_point($mb_id, $po_point, $po_content);

//sql_query(" OPTIMIZE TABLE `$g4[point_table]` ");

goto_url("./point_list.php?$qstr");
?>
