<?
include_once("./_common.php");

if (!$member[mb_id])
    alert("회원만 이용하실 수 있습니다.");

$tmp_list = explode(",", $me_recv_mb_id);
$msg = "";
$comma = "";
$mb_list = array();
for ($i=0; $i<count($tmp_list); $i++) {
    $row = get_member($tmp_list[$i]);
    if (!$row[mb_id] || $row[mb_leave_date] || $row[mb_intercept_date]) {
        $msg .= "$comma$tmp_list[$i]";
        $comma = ",";
    } else {
        $mb_list[] = $tmp_list[$i];
    }
}

if ($msg)
    alert($msg . " 은(는) 존재하지 않는 회원아이디 이거나 탈퇴, 접근차단된 회원아이디 입니다.\\n\\n쪽지를 발송하지 않았습니다.");

for ($i=0; $i<count($mb_list); $i++) {
    if (trim($mb_list[$i])) {
        $tmp_row = sql_fetch(" select max(me_id) as max_me_id from $g4[memo_table] ");
        $me_id = $tmp_row[max_me_id] + 1;

        // 쪽지 INSERT
        $sql = " insert into $g4[memo_table]
                        ( me_id, me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo )
                 values ( '$me_id', '$mb_list[$i]', '$member[mb_id]', '$g4[time_ymdhis]', '$me_memo' ) ";
        sql_query($sql);

        // 실시간 쪽지 알림 기능
        $sql = " update $g4[member_table]
                    set mb_memo_call = '$member[mb_id]'
                  where mb_id = '$mb_list[$i]' ";
        sql_query($sql);
    }
}

alert("$me_recv_mb_id 님께 쪽지를 전달하였습니다.", "./memo.php?kind=send");
?>
