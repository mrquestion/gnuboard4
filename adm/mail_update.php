<?
$sub_menu = "200500";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

check_demo();

if ($w == "") 
{
    $sql = " insert $g4[mail_table]
                set ma_id = '$ma_id',
                    ma_subject = '$ma_subject',
                    ma_content = '$ma_content',
                    ma_time = '$g4[time_ymdhis]',
                    ma_ip = '$REMOTE_ADDR' ";
    sql_query($sql);
} 
else if ($w == "u") 
{
    $sql = " update $g4[mail_table]
                set ma_subject = '$ma_subject',
                    ma_content = '$ma_content',
                    ma_time = '$g4[time_ymdhis]',
                    ma_ip = '$REMOTE_ADDR'
              where ma_id = '$ma_id' ";
    sql_query($sql);
} 
else if ($w == "d") 
{
	$sql = " delete from $g4[mail_table] where ma_id = '$ma_id' ";
    sql_query($sql);
}

//sql_query(" OPTIMIZE TABLE `$g4[mail_table]` ");

goto_url("./mail_list.php");
?>
