<?
include_once("./_common.php");

if (!$member[mb_id])
    alert("ȸ���� �̿��Ͻ� �� �ֽ��ϴ�.");

$tmp_list = explode(",", $me_recv_mb_id);
$me_recv_mb_id_list = "";
$msg = "";
$comma1 = $comma2 = "";
$mb_list = array();
$mb_array = array();
for ($i=0; $i<count($tmp_list); $i++) {
    $row = get_member($tmp_list[$i]);
    if ((!$row[mb_id] || !$row[mb_open] || $row[mb_leave_date] || $row[mb_intercept_date]) && !$is_admin) {
        $msg .= "$comma1$tmp_list[$i]";
        $comma1 = ",";
    } else {
        $me_recv_mb_id_list .= "$comma2$row[mb_nick]";
        $mb_list[] = $tmp_list[$i];
        $mb_array[] = $row;
        $comma2 = ",";
    }
}

if ($msg && !$is_admin)
    alert("ȸ�����̵� \'".$msg."\' ��(��) ����(�Ǵ� ��������)���� �ʴ� ȸ�����̵� �̰ų� Ż��, �������ܵ� ȸ�����̵� �Դϴ�.\\n\\n������ �߼����� �ʾҽ��ϴ�.");

if (!$is_admin) {
    if (count($mb_list)) {
        $point = (int)$config[cf_memo_send_point] * count($mb_list);
        if ($point) {
            if ($member[mb_point] - $point < 0) {
                alert("�����Ͻ� ����Ʈ(".number_format($member[mb_point])."��)�� ���ڶ� ������ ���� �� �����ϴ�.");
            } 
        }
    }
}

for ($i=0; $i<count($mb_list); $i++) {
    if (trim($mb_list[$i])) {
        $tmp_row = sql_fetch(" select max(me_id) as max_me_id from $g4[memo_table] ");
        $me_id = $tmp_row[max_me_id] + 1;

        // ���� INSERT
        $sql = " insert into $g4[memo_table]
                        ( me_id, me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo )
                 values ( '$me_id', '$mb_list[$i]', '$member[mb_id]', '$g4[time_ymdhis]', '$me_memo' ) ";
        sql_query($sql);

        // �ǽð� ���� �˸� ���
        $sql = " update $g4[member_table]
                    set mb_memo_call = '$member[mb_id]'
                  where mb_id = '$mb_list[$i]' ";
        sql_query($sql);

        if (!$is_admin) {
            $recv_mb_nick = get_text($mb_array[$i][mb_nick]);
            $recv_mb_id = $mb_array[$i][mb_id];
            insert_point($member[mb_id], (int)$config[cf_memo_send_point] * (-1), "{$recv_mb_nick}({$recv_mb_id})�Բ� ���� �߼�", "@memo", $recv_mb_id, $me_id);
        }
    }
}

alert("\'$me_recv_mb_id_list\' �Բ� ������ �����Ͽ����ϴ�.", "./memo.php?kind=send");
?>
