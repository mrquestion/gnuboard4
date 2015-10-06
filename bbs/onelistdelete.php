<?
include_once("_common.php");

if (!$is_admin)
    alert('관리자만 삭제 가능합니다.');

for($i=0;$i<count($_POST[chk_on_id]);$i++) {
    $on_id = $_POST[chk_on_id][$i];

    $row = sql_fetch(" select on_qfile, on_afile from $g4[one_prefix]$ob_table where on_id = '$on_id' ");
    if ($row[on_qfile]) @unlink("$g4[path]/data/one/$ob_table/$row[on_qfile]");
    if ($row[on_afile]) @unlink("$g4[path]/data/one/$ob_table/$row[on_afile]");

    sql_query(" delete from $g4[one_prefix]$ob_table where on_id = '$on_id' ");
}

goto_url("one.php?ob_table=$ob_table");
?>