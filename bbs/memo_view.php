<?
include_once("./_common.php");

if (!$member[mb_id]) 
    alert("ȸ���� �̿��Ͻ� �� �ֽ��ϴ�.");

$g4[title] = "���� ����";
include_once("$g4[path]/head.sub.php");

if ($kind == "recv") {
    $unkind = "send";

    $sql = " update $g4[memo_table]
                set me_read_datetime = '$g4[time_ymdhis]' 
              where me_id = '$me_id' 
                and me_read_datetime = '0000-00-00 00:00:00' ";
    sql_query($sql);
} else if ($kind == "send") 
    $unkind = "recv";
else 
    alert("\$kind ���� �Ѱ��ּ���.");

$sql = " select * from $g4[memo_table]
          where me_id = '$me_id'
            and me_{$kind}_mb_id = '$member[mb_id]' ";
$memo = sql_fetch($sql);

$mb = get_member($memo["me_{$unkind}_mb_id"]);

$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";
include_once("$member_skin_path/memo_view.skin.php");

include_once("$g4[path]/tail.sub.php");
?>
