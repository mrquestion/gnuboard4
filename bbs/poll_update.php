<?
include_once("./_common.php");

$po = sql_fetch(" select po_id, po_subject, po_point, po_ips from $g4[poll_table] where po_id = '$_POST[po_id]' ");
if (!$po[po_id]) 
    alert_close("po_id ���� ����� �Ѿ���� �ʾҽ��ϴ�.");

if ($member[mb_level] < $po[po_level]) 
    alert_close("���� $po[po_level] �̻� ȸ���� ��ǥ�� �����Ͻ� �� �ֽ��ϴ�.");

// ��Ű�� ����� ��ǥ��ȣ�� ���ٸ�
if (get_cookie("ck_po_id") != $po_id) 
{
    // ��ǥ�ߴ� ip�� �߿��� ã�ƺ���
    $search_ip = false;
    $ips = explode("\n", $po[po_ips]);
    for ($i=0; $i<count($ips); $i++) 
    {
        if ($_SERVER[REMOTE_ADDR] == trim($ips[$i])) 
            $search_ip = true;
    }
    
    // ���ٸ� ������ ��ǥ�׸��� 1���� ��Ű�� ip�� ����
    if (!$search_ip) 
    {
        $po_ips = $po[po_ips] . $_SERVER[REMOTE_ADDR] . "\n";
        sql_query(" update $g4[poll_table] set po_cnt{$gb_poll} = po_cnt{$gb_poll} + 1, po_ips = '$po_ips' where po_id = '$po_id' ");

        // ȸ���̶�� ����Ʈ �ο�
        if ($member[mb_id])
            insert_point($member[mb_id], $po[po_point], $po[po_id] . ". " . cut_str($po[po_subject],20) . " ��ǥ ���� ");
    }
}

set_cookie("ck_po_id", $po_id, 86400 * 15); // ��ǥ ��Ű ������ ����

goto_url("./poll_result.php?po_id=$po_id");
?>
