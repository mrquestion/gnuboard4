<?
$sub_menu = "300200";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

if ($is_admin != "super" && $w == "") alert("�ְ�����ڸ� ���� �����մϴ�.");

if (!ereg("^([A-Za-z0-9_]{1,10})$", $gr_id))
    alert("�׷� ID�� ������� ������, ����, _ �� ��� �����մϴ�. (10�� �̳�)");

if (!$gr_subject) alert("�׷� ������ �Է��ϼ���.");

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

if ($w == "") 
{
    $sql = " select count(*) as cnt from $g4[group_table] where gr_id = '$gr_id' ";
    $row = sql_fetch($sql);
    if ($row[cnt]) 
        alert("�̹� �����ϴ� �׷� ID �Դϴ�.");

    $sql = " insert into $g4[group_table]
                set gr_id = '$gr_id',
                    $sql_common ";
    sql_query($sql);
} 
else if ($w == "u") 
{
    $sql = " update $g4[group_table]
                set $sql_common
              where gr_id = '$gr_id' ";
    sql_query($sql);
} 
else
    alert("����� �� ���� �Ѿ���� �ʾҽ��ϴ�.");

goto_url("./boardgroup_form.php?w=u&gr_id=$gr_id&$qstr");
?>
