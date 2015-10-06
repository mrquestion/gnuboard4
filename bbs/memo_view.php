<?
include_once("./_common.php");

if (!$member[mb_id]) 
    alert("회원만 이용하실 수 있습니다.");

$g4[title] = "쪽지 보기";
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
    alert("\$kind 값을 넘겨주세요.");

$sql = " select * from $g4[memo_table]
          where me_id = '$me_id'
            and me_{$kind}_mb_id = '$member[mb_id]' ";
$memo = sql_fetch($sql);

$mb = get_member($memo["me_{$unkind}_mb_id"]);

$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";
include_once("$member_skin_path/memo_view.skin.php");

include_once("$g4[path]/tail.sub.php");
?>
