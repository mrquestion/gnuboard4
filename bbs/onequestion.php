<?
include_once("_common.php");
include_once("$g4[path]/lib/one.lib.php");

if ($w=='u') {
    if ($on_qfile_del) {
        $row = sql_fetch(" select on_qfile from $g4[one_prefix]$ob_table where on_id = '$on_id' ");
        @unlink("$g4[path]/data/one/zzz/$row[on_qfile]");
    }

    if ($_FILES[on_qfile][name]) {
        // 존재하는 파일이 있다면 삭제합니다. (수정에서만 해당)
        $row = sql_fetch(" select on_qfile from $g4[one_prefix]$ob_table where on_id = '$on_id' ");
        @unlink("$g4[path]/data/one/zzz/$row[on_qfile]");
    }
}

$source = $_FILES[on_qfile][name];
$filename = upload_file("$g4[path]/data/one/$ob_table", $_FILES[on_qfile]);

$sql_common = " on_subject = '$on_subject', 
                on_question = '$on_question',
                on_qdatetime = '$g4[time_ymdhis]' ";
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