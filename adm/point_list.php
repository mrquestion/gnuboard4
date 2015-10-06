<?
$sub_menu = "200200";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$sql_common = " from $g4[point_table] a left join $g4[member_table] b on (a.mb_id=b.mb_id) ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "a.mb_id" :
            $sql_search .= " ($sfl = '$stx') ";
            break;
        default : 
            $sql_search .= " ($sfl like '%$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst  = "po_id";
    $sod = "desc";
}
$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common 
         $sql_search 
         $sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = $config[cf_page_rows];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select *, b.mb_nick, b.mb_email, b.mb_homepage, b.mb_point
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$listall = "<a href='$_SERVER[PHP_SELF]'>처음</a>";

if ($sfl == "a.mb_id" && $stx)
    $mb = get_member($stx);

$g4[title] = "포인트관리";
include_once ("./admin.head.php");

$colspan = 7;
?>

<script language="javascript" src="<?=$g4[path]?>/js/sideview.js"></script>
<script language="JavaScript">
var list_update_php = "";
var list_delete_php = "point_list_delete.php";
</script>

<table width=100%>
<form name=fsearch method=get>
<tr>
    <td width=50% align=left>
        <?=$listall?> (건수 : <?=number_format($total_count)?>)
        <? 
        if ($mb[mb_id]) 
            echo "&nbsp;(" . $mb[mb_id] ." 님 포인트 합계 : " . number_format($mb[mb_point]) . "점)";
        else {
            $row2 = sql_fetch(" select sum(po_point) as sum_point from $g4[point_table] ");
            echo "&nbsp;(전체 포인트 합계 : " . number_format($row2[sum_point]) . "점)";
        }
        ?>
    </td>
    <td width=50% align=right>
        <select name=sfl class=cssfl>
            <option value='a.mb_id'>회원아이디</option>
            <option value='b.mb_nick'>별명</option>
            <option value='a.po_content'>내용</option>
        </select>
        <input type=text name=stx required itemname='검색어' value='<?=$stx?>'>
        <input type=image src='<?=$g4[admin_path]?>/img/btn_search.gif' align=absmiddle></td>
</tr>
</form>
</table>

<table width=100% cellpadding=0 cellspacing=1>
<form name=fpointlist method=post>
<input type=hidden name=sst  value='<?=$sst?>'>
<input type=hidden name=sod  value='<?=$sod?>'>
<input type=hidden name=sfl  value='<?=$sfl?>'>
<input type=hidden name=stx  value='<?=$stx?>'>
<input type=hidden name=page value='<?=$page?>'>
<colgroup width=30>
<colgroup width=100>
<colgroup width=100>
<colgroup width=140>
<colgroup width=''>
<colgroup width=80>
<colgroup width=80>
<tr><td colspan='<?=$colspan?>' class='line1'></td></tr>
<tr class='bgcol1 bold col1 ht center'>
    <td><input type=checkbox name=chkall value='1' onclick='check_all(this.form)'></td>
    <td><?=subject_sort_link('a.mb_id')?>회원아이디</a></td>
    <td><?=subject_sort_link('mb_nick')?>별명</a></td>
    <td><?=subject_sort_link('po_datetime')?>일시</a></td>
    <td><?=subject_sort_link('po_content')?>포인트 내용</a></td>
    <td><?=subject_sort_link('po_point')?>포인트</a></td>
    <td>포인트합</td>
</tr>
<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>
<?
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $mb_nick = get_sideview($row[mb_id], $row[mb_nick], $row[mb_email], $row[mb_homepage]);

    $list = $i%2;
    echo "
    <input type=hidden name=po_id[$i] value='$row[po_id]'>
    <input type=hidden name=mb_id[$i] value='$row[mb_id]'>
    <tr class='list$list col1 ht center'>
        <td><input type=checkbox name=chk[] value='$i'></td>
        <td><a href='?sfl=a.mb_id&stx=$row[mb_id]'>$row[mb_id]</a></td>
        <td>$mb_nick</td>
        <td>$row[po_datetime]</td>
        <td align=left>&nbsp;$row[po_content]</td>
        <td align=right>".number_format($row[po_point])."&nbsp;</td>
        <td align=right>".number_format($row[mb_point])."&nbsp;</td>
    </tr> ";
} 

if ($i == 0)
    echo "<tr><td colspan='$colspan' align=center height=100 bgcolor=#ffffff>자료가 없습니다.</td></tr>";

echo "<tr><td colspan='$colspan' class='line2'></td></tr>";
echo "</table>";

$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");
echo "<table width=100% cellpadding=3 cellspacing=1>";
echo "<tr><td width=50%>";
echo "<input type=button class='btn1' value='선택삭제' onclick=\"btn_check(this.form, 'delete')\">";
echo "<td>";
echo "<td width=50% align=right>$pagelist</td></tr></table>\n";

if ($stx)
    echo "<script language='javascript'>document.fsearch.sfl.value = '$sfl';</script>\n";

if (strstr($sfl, "mb_id"))
    $mb_id = $stx;
else
    $mb_id = "";
?>
</form>

<script language='javascript'> document.fsearch.stx.focus(); </script>

<?$colspan=4?>
<p>
<table width=100% cellpadding=0 cellspacing=1 class=tablebg>
<form name=fpointlist2 method=post action="javascript:fpointlist2_submit(document.fpointlist2);" autocomplete="off">
<input type=hidden name=sfl  value='<?=$sfl?>'>
<input type=hidden name=stx  value='<?=$stx?>'>
<input type=hidden name=sst  value='<?=$sst?>'>
<input type=hidden name=sod  value='<?=$sod?>'>
<input type=hidden name=page value='<?=$page?>'>
<colgroup width=150>
<colgroup width=''>
<colgroup width=100>
<colgroup width=100>
<tr><td colspan='<?=$colspan?>' class='line1'></td></tr>
<tr class='bgcol1 bold col1 ht center'>
    <td>회원아이디</span></td>
    <td>포인트 내용</span></td>
    <td>포인트</span></td>
    <td>입력</span></td>
</tr>
<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>
<tr class='ht center'>
    <td><input type=text class=ed name=mb_id required itemname='회원아이디' value='<?=$mb_id?>'></td>
    <td><input type=text class=ed name=po_content required itemname='내용' style='width:99%;'></td>
    <td><input type=text class=ed name=po_point required itemname='포인트' size=10 maxlength=6></td>
    <td><input type=image src='<?=$g4[admin_path]?>/img/btn_confirm.gif'></td>
</tr>
<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>
</form>
</table>

<script language="JavaScript">
function fpointlist2_submit(f)
{
    f.action = "./point_update.php";
    f.submit();
}
</script>

<?
include_once ("./admin.tail.php");
?>
