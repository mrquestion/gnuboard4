<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

$colspan = 4;
if ($is_admin) $colspan = 5;
?>

<table width="<?=$width?>" align="center" cellpadding="0" cellspacing="0"><tr><td>

<table width="100%" cellspacing="0" cellpadding="0">
<tr height="25">
    <td align="left">
        �� <?=$total_count?>��
        <? 
        if ($is_admin) { 
            echo " &nbsp; <b>�����ڷ� �α��� �ϼ̽��ϴ�.</b>"; 
            echo " &nbsp; <a href='$g4[admin_path]/oneboard_form.php?ob_table=$ob_table&w=u'>������</b>"; 
        } 
        ?>
    </td>
    <td align="right"><a href='one.php?ob_table=<?=$ob_table?>&w=i'>�����ϱ�</a></td>
</tr>
<tr><td height=5></td></tr>
</table>

<form name='fonelist' method='post' action='onelistdelete.php' style='margin:0px;'>
<input type='hidden' name='ob_table' value='<?=$ob_table?>'>

<table width=100% cellpadding=0 cellspacing=0>
<? if ($is_admin) echo "<colgroup width='30'>"; ?>
<colgroup width='50'>
<colgroup width=''>
<colgroup width='50'>
<colgroup width='100'>
<tr><td colspan='<?=$colspan?>' height='2' bgcolor='#B0ADF5'></td></tr>
<tr align='center' bgcolor='#F8F8F9' height='30'>
    <? if ($is_admin) echo "<td><input onclick='if (this.checked) all_checked(true); else all_checked(false);' type=checkbox></td>"; ?>
    <td>��ȣ</td>
    <td><?=subject_sort_link('on_subject', "ob_table=$ob_table", 1)?>����</a></td>
    <td><?=subject_sort_link('on_adatetime', "ob_table=$ob_table", 0)?>�亯</a></td>
    <td><?=subject_sort_link('on_qdatetime', "ob_table=$ob_table", 1)?>��¥</a></td>
</tr>
<tr><td colspan='<?=$colspan?>' height='1' bgcolor='#B0ADF5'></td></tr>

<?
for ($i=0; $i<count($list); $i++) {
    echo "<tr height=28 align=center>";
    if ($is_admin) echo "<td><input type='checkbox' name='chk_on_id[]' value='{$list[$i][on_id]}'></td>";
    echo "
        <td>{$list[$i][num]}</td>
        <td align=left><a href='one.php?ob_table=$ob_table&on_id={$list[$i][on_id]}'>{$list[$i][subject]}</a> {$list[$i][icon_file]}</td>
        <td>{$list[$i][answer]}</td>
        <td>{$list[$i][date]}</td>
    </tr>
    <tr>
        <td colspan='$colspan' height='1' bgcolor='#E7E7E7'></td>
    </tr>";
}

if ($i==0) {
    echo "<td colspan='$colspan' height=100 align=center>�����Ͻ� ������ �����ϴ�.</td>";
}
?>
<tr><td colspan='<?=$colspan?>' height='1' bgcolor='#5C86AD'></td></tr>
</table>

<table width="100%" cellspacing="0" cellpadding="0">
<tr><td height=5></td></tr>
<tr height="25">
    <td align="left"><?=$write_pages?></td>
    <td align="right">
        <? if ($is_admin) { echo "<a href='javascript:del_checked();'>���û���</a> &nbsp;"; } ?>
        <a href='one.php?ob_table=<?=$ob_table?>&w=i'>�����ϱ�</a>
    </td>
</tr>
</table>

</form>

<script>
function all_checked(sw) {
    var f = document.fonelist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_on_id[]")
            f.elements[i].checked = sw;
    }
}

function del_checked() {
    var f = document.fonelist;
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_on_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert("������ �Խù��� �ϳ� �̻� �����ϼ���.");
        return;
    }

    document.fonelist.submit();
}
</script>

</td></tr></table>