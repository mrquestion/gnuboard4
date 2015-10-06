<?
$sub_menu = "300200";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

if (!ereg("^([A-Za-z0-9_]{1,10})$", $gr_id)) {
    alert("그룹 ID는 공백없이 영문자, 숫자, _ 만 사용 가능합니다. (10자 이내)");
}

if (!$gr_subject) alert("그룹 제목을 입력하세요.");

/*
if ($gr_admin) {
    $mb = get_member($gr_admin);
    if (!$mb[mb_id]) 
        alert("그룹 관리자 회원아이디가 존재하지 않습니다.");
}
*/

$sql_common = " gr_subject      = '$gr_subject',
                gr_admin        = '$gr_admin',  
                gr_use_access   = '$gr_use_access',
                gr_1            = '$gr_1',
                gr_2            = '$gr_2',
                gr_3            = '$gr_3',
                gr_4            = '$gr_4',
                gr_5            = '$gr_5',
                gr_6            = '$gr_6',
                gr_7            = '$gr_7',
                gr_8            = '$gr_8',
                gr_9            = '$gr_9',
                gr_10           = '$gr_10'
                ";

if ($w == "") {
    $sql = " select count(*) as cnt from $g4[group_table] where gr_id = '$gr_id' ";
    $row = sql_fetch($sql);
    if ($row[cnt]) 
        alert("이미 존재하는 그룹 ID 입니다.");

    $sql = " insert into $g4[group_table]
                set gr_id = '$gr_id',
                    $sql_common ";
    sql_query($sql);
} else if ($w == "u") {
    $sql = " update $g4[group_table]
                set $sql_common
              where gr_id = '$gr_id' ";
    sql_query($sql);
} else
    alert("제대로 된 값이 넘어오지 않았습니다.");

sql_query(" OPTIMIZE TABLE `$g4[group_table]` ");

goto_url("./boardgroup_form.php?w=u&gr_id=$gr_id&$qstr");
?>
