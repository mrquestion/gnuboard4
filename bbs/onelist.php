<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

$sql = " select count(*) as cnt from $g4[one_prefix]$ob_table ";
if (!$is_admin)
    $sql .= " where mb_no = '$member[mb_no]' ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$total_page  = ceil($total_count / $oneboard[ob_page_rows]);  // 전체 페이지 계산
if (!$page) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $oneboard[ob_page_rows]; // 시작 열을 구함

$sql = " select * from $g4[one_prefix]$ob_table ";
if (!$is_admin)
    $sql .= " where mb_no = '$member[mb_no]' ";
if ($sst=='' && $sod=='') {
    $sst = "on_id";
    $sod = "desc";
}
$sql .= " order by $sst $sod ";
$sql .= " limit $from_record, $oneboard[ob_page_rows] ";
$result = sql_query($sql);
$list = Array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;

    $list[$i]['num'] = $total_count - ($page - 1) * $oneboard[ob_page_rows] - $i;
    $list[$i]['subject'] = conv_subject($row[on_subject], $oneboard[ob_subject_len], "…");
    $list[$i]['icon_file'] = ($row[on_qfile] || $row[on_afile]) ? "<img src='$oneboard_skin_path/img/icon_file.gif' border='0' align='absmiddle'>" : "";
    $list[$i]['date'] = substr($row[on_qdatetime],0,10);
    $ox = "X";
    if ($row[on_answer])
        $ox = "O";
    $list[$i]['answer'] = $ox;
}

$write_pages = get_paging(10, $page, $total_page, "one.php?ob_table=$ob_table&".$qstr."&page=");

include_once("$oneboard_skin_path/onelist.skin.php");
?>