<?
include_once("_common.php");
include_once("$g4[path]/lib/one.lib.php");

if ($w=='u') {
    if ($on_qfile_del) {
        $row = sql_fetch(" select on_qfile from $g4[one_prefix]$ob_table where on_id = '$on_id' ");
        @unlink("$g4[path]/data/one/$ob_table/$row[on_qfile]");
    }

    if ($_FILES[on_qfile][name]) {
        // �����ϴ� ������ �ִٸ� �����մϴ�. (���������� �ش�)
        $row = sql_fetch(" select on_qfile from $g4[one_prefix]$ob_table where on_id = '$on_id' ");
        @unlink("$g4[path]/data/one/$ob_table/$row[on_qfile]");
    }
}

$source = $_FILES[on_qfile][name];
$filename = upload_file("$g4[path]/data/one/$ob_table", $_FILES[on_qfile]);

$sql_common = " on_subject = '$on_subject', 
                on_question = '$on_question',
                on_qdatetime = '$g4[time_ymdhis]',
                on_1 = '$on_1',
                on_2 = '$on_2',
                on_3 = '$on_3',
                on_4 = '$on_4',
                on_5 = '$on_5',
                on_6 = '$on_6',
                on_7 = '$on_7',
                on_8 = '$on_8',
                on_9 = '$on_9',
                on_10 = '$on_10' ";
if ($source || $on_qfile_del) {
    $sql_common .= ",on_qfile = '$filename'
                    ,on_qsource = '$source' ";
}

if ($w=='i') {
    
    $sql = " insert into $g4[one_prefix]$ob_table
                set mb_no = '$member[mb_no]',
                    $sql_common ";
    sql_query($sql);

    $on_id = @mysql_insert_id();

} else if ($w=='u') {

    $sql = " update $g4[one_prefix]$ob_table
                set $sql_common
              where on_id = '$on_id' ";
    sql_query($sql);
}

goto_url("one.php?ob_table=$ob_table&on_id=$on_id");
?>