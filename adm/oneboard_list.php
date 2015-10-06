<?
$sub_menu = "300300";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$sql_common = " from $g4[oneboard_table] a ";
$sql_search = " where (1) ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "ob_table" :
            $sql_search .= " ($sfl like '$stx%') ";
            break;
        case "a.gr_id" :
            $sql_search .= " ($sfl = '$stx') ";
            break;
        default : 
            $sql_search .= " ($sfl like '%$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst  = "a.ob_table";
    $sod = "asc";
}
$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = $config[cf_page_rows];
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���
if ($page == "") { $page = 1; } // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$sql = " select * 
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$listall = "<a href='$_SERVER[PHP_SELF]'>ó��</a>";

$g4[title] = "1:1 �Խ��ǰ���";
include_once("./admin.head.php");

$colspan = 13;
?>

<script language="JavaScript">
var list_update_php = 'oneboard_list_update.php';
var list_delete_php = 'oneboard_list_delete.php';
</script>

<table width=100% cellpadding=3 cellspacing=1>
<form name=fsearch method=get>
<tr>
    <td width=50% align=left><?=$listall?> (�Խ��Ǽ� : <?=number_format($total_count)?>��)</td>
    <td width=50% align=right>
        <select name=sfl>
            <option value='ob_table'>TABLE</option>
            <option value='ob_subject'>����</option>
        </select>
        <input type=text name=stx required itemname='�˻���' value='<?=$stx?>'>
        <input type=image src='<?=$g4[admin_path]?>/img/btn_search.gif' align=absmiddle></td>
</tr>
</form>
</table>

<table width=100% cellpadding=0 cellspacing=1>
<form name=foneboardlist method=post>
<input type=hidden name=sst   value="<?=$sst?>">
<input type=hidden name=sod  value="<?=$sod?>">
<input type=hidden name=sfl value="<?=$sfl?>">
<input type=hidden name=stx   value="<?=$stx?>">
<input type=hidden name=page    value="<?=$page?>">
<colgroup width=30>
<colgroup width=''>
<colgroup width=120>
<colgroup width=120>
<colgroup width=120>
<colgroup width=120>
<colgroup width=80>
<tr><td colspan='<?=$colspan?>' class='line1'></td></tr>
<tr class='bgcol1 bold col1 ht center'>
    <td><input type=checkbox name=chkall value="1" onclick="check_all(this.form)"></td>
    <td><?=subject_sort_link("ob_table")?>TABLE</a></td>
    <td><?=subject_sort_link("ob_subject")?>����</a></td>
    <td><?=subject_sort_link("ob_skin", "", "desc")?>��Ų</a></td>
    <td><?=subject_sort_link("ob_admin")?>������</a></td>
    <td><?=subject_sort_link("ob_write_level")?>�������</a></td>
	<td><a href="oneboard_form.php"><img src='<?=$g4[admin_path]?>/img/icon_insert.gif' border=0 title='����'></a></td>
</tr>
<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>
<?
// ��Ų���丮
$skin_options = "";
$arr = get_skin_dir("oneboard");
for ($k=0; $k<count($arr); $k++) {
    $option = $arr[$k];
    if (strlen($option) > 10)
        $option = substr($arr[$k], 0, 18) . "��";

    $skin_options .= "<option value='$arr[$k]'>$option</option>";
}

for ($i=0; $row=sql_fetch_array($result); $i++) {
    $s_upd = "<a href='oneboard_form.php?w=u&ob_table=$row[ob_table]&$qstr'><img src='img/icon_modify.gif' border=0 title='����'></a>";
    $s_del = "";
    if ($is_admin == "super") 
        $s_del = "<a href=\"javascript:del('oneboard_delete.php?ob_table=$row[ob_table]&$qstr');\"><img src='img/icon_delete.gif' border=0 title='����'></a>";

    $list = $i % 2;
    echo "<input type=hidden name='oneboard_table[$i]' value='$row[ob_table]'>";
    echo "<tr class='list$list col1 ht center'>";
    echo "<td height='25'><input type='checkbox' name='chk[]' value='$i'></td>";
    echo "<td><a href='$g4[bbs_path]/one.php?ob_table=$row[ob_table]'><b>$row[ob_table]</b></a></td>";
    echo "<td><input type=text class=ed name=ob_subject[$i] value='".get_text($row[ob_subject])."' style='width:99%'></td>";
    echo "<td><select id='ob_skin_$i' name='ob_skin[$i]'>$skin_options</select></td>";
    echo "<td><input type=text class=ed name='ob_admin[$i]' value='".get_text($row[ob_admin])."' style='width:99%'></td>";
    echo "<td>".get_member_level_select("ob_write_level[$i]", 2, 10, $row[ob_write_level])."</td>";
    echo "<td>$s_upd $s_del</td>";
    echo "</tr>";
    echo "<script language='JavaScript'>document.getElementById('ob_skin_$i').value='$row[ob_skin]';</script>";
} 

if ($i == 0)
    echo "<tr><td colspan='$colspan' align=center height=100 bgcolor=#ffffff>�ڷᰡ �����ϴ�.</td></tr>"; 

echo "<tr><td colspan='$colspan' class='line2'></td></tr>";
echo "</table>";

$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");
echo "<table width=100% cellpadding=3 cellspacing=1>";
echo "<tr><td width=70%>";
echo "<input type=button class='btn1' value='���ü���' onclick=\"btn_check(this.form, 'update')\"> ";
echo "</td>";
echo "<td width=30% align=right>$pagelist</td></tr></table>\n";

if ($stx)
    echo "<script>document.fsearch.sfl.value = '$sfl';</script>";
?>
</form>

<script language="JavaScript">
function board_copy(ob_table) {
    window.open("./board_copy.php?ob_table="+ob_table, "BoardCopy", "left=10,top=10,width=500,height=200");
}
</script>

<?
include_once("./admin.tail.php");
?>