<?
$sub_menu = "300200";
include_once("./_common.php");

if ($w == "") {
    auth_check($auth[$sub_menu], "w");

    $mb = get_member($mb_id);
    if (!$mb[mb_id]) { 
        alert("�������� �ʴ� ȸ���Դϴ�."); 
    }

    $gr = get_group($gr_id);
    if (!$gr[gr_id]) {
        alert("�������� �ʴ� �׷��Դϴ�."); 
    }

    $sql = " select count(*) as cnt 
               from $g4[group_member_table]
              where gr_id = '$gr_id'
                and mb_id = '$mb_id' ";
    $row = sql_fetch($sql);
    if ($row[cnt]) {
        alert("�̹� ��ϵǾ� �ִ� �ڷ��Դϴ�.");
        /*
        $sql = " update $g4[group_member_table]
                    set gm_datetime = '$g4[time_ymdhis]' 
                  where gr_id = '$gr_id'
                    and mb_id = '$mb_id' ";
        sql_query($sql);
        */
    } else {
        $tmp_row = sql_fetch(" select max(gm_id) as max_gm_id from $g4[group_member_table] ");
        $gm_id = $tmp_row[max_gm_id] + 1;

        $sql = " insert into $g4[group_member_table]
                        ( gm_id, gr_id, mb_id, gm_datetime )
                 values ( '$gm_id', '$gr_id', '$mb_id','$g4[time_ymdhis]' ) ";
        sql_query($sql);
    }
} else if ($w == 'd' || $w == 'listdelete') {
    auth_check($auth[$sub_menu], "d");
    $sql = " select * from $g4[group_member_table] where gm_id = '$gm_id' ";
    $gm = sql_fetch($sql);
    if (!$gm[gm_id]) {
        alert("�������� �ʴ� �ڷ��Դϴ�.");
    }

    $gr_id = $gm[gr_id];
    $mb_id = $gm[mb_id];

    $sql = " delete from $g4[group_member_table] where gm_id = '$gm_id' ";
    sql_query($sql);
}

sql_query(" OPTIMIZE TABLE `$g4[group_member_table]` ");

if ($w == 'listdelete')
    goto_url("./boardgroupmember_list.php?gr_id=$gr_id");
else
    goto_url("./boardgroupmember_form.php?mb_id=$mb_id");
?>
