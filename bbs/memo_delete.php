<?
include_once("./_common.php");

if (!$member[mb_id]) 
    alert("ȸ���� �̿��Ͻ� �� �ֽ��ϴ�.");

$sql = " delete from $g4[memo_table]
          where me_id = '$me_id' 
            and (me_recv_mb_id = '$member[mb_id]' or me_send_mb_id = '$member[mb_id]') ";
sql_query($sql);

goto_url("./memo.php?kind=$kind");
?>
