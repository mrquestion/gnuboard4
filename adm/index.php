<?
include_once("./_common.php");

// �������� ���� �����ڷα� ����
$tmp_before_date = date("Y-m-d", $g4[server_time] - ($config[cf_visit_del] * 86400));
$sql = " delete from $g4[visit_table] where vi_date < '$tmp_before_date' ";
sql_query($sql);
sql_query(" OPTIMIZE TABLE `$g4[visit_table]`, `$g4[visit_sum_table]` ");

// �������� ���� �α�˻��� ����
$tmp_before_date = date("Y-m-d", $g4[server_time] - ($config[cf_popular_del] * 86400));
$sql = " delete from $g4[popular_table] where pp_date < '$tmp_before_date' ";
sql_query($sql);
sql_query(" OPTIMIZE TABLE `$g4[popular_table]` ");

// �������� ���� �ֱٰԽù� ����
$sql = " delete from $g4[board_new_table] where (TO_DAYS('$g4[time_ymdhis]') - TO_DAYS(bn_datetime)) > '$config[cf_new_del]' ";
sql_query($sql);
sql_query(" OPTIMIZE TABLE `$g4[board_new_table]` ");

// �������� ���� ���� ����
$sql = " delete from $g4[memo_table] where (TO_DAYS('$g4[time_ymdhis]') - TO_DAYS(me_send_datetime)) > '$config[cf_memo_del]' ";
sql_query($sql);
sql_query(" OPTIMIZE TABLE `$g4[memo_table]` ");

// Ż��ȸ�� �ڵ� ����
$sql = " select mb_id from $g4[member_table] where (TO_DAYS('$g4[time_ymdhis]') - TO_DAYS(mb_leave_date)) > '$config[cf_leave_day]' ";
$result = sql_query($sql);
while ($row=sql_fetch_array($result)) 
{
    // ȸ���ڷ� ����
    member_delete($row[mb_id]);
}
sql_query(" OPTIMIZE TABLE `$g4[member_table]` ");


$g4[title] = "�⺻ȯ�漳��";
include_once ("./admin.head.php");

echo "<table width=100% border=0><tr>";
$i = 0;
$mod = 4;
$width = (int)(100 / $mod);
foreach($ttitle as $key=>$value) {
    if ($i%4==0 && $i)
        echo "</tr><tr>";

    echo "<td valign=top width='$width%' align=center>";
    echo "<table width=100% cellpadding=0 cellspacing=0>";
    echo "<tr>";
    echo "<td style='background-color:$tcolor[$key]' class='ht'>&nbsp;";
    if ($tlink[$key]) {
        echo "<a href='$tlink[$key]' style='text-decoration:none;'";
        if ($ttarget[$key])
            echo " target='$ttarget[$key]'";
        echo ">";
    }
    echo "<span style='color:white;'><strong>&middot; $ttitle[$key]</strong></span>";
    echo "</a>";
    echo "</td>";
    echo "</tr>";
    $k = 0;
    foreach($stitle[$key] as $k=>$v) {
        if (!strstr($auth[$key.$k], "r") && $is_admin != "super")
            continue;

        if ($smenu2[$key][$k]) continue;

        echo "<tr><td valign=top>";
        echo disp_sub_menu($stitle[$key][$k], $slink[$key][$k], $starget[$key][$k]);
        echo "</td></tr>";
    }
    echo "</table>";
    echo "</td>";
    $i++;
}
echo "</tr></table>";

include_once ("./admin.tail.php");
?>
