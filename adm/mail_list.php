<?
$sub_menu = "200300";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$sql_common = " from $g4[mail_table] ";

// ���̺��� ��ü ���ڵ���� ����
$sql = " select COUNT(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$page = 1;

$sql = "select * $sql_common order by ma_id desc ";
$result = sql_query($sql);

$g4[title] = "ȸ�����Ϲ߼�";
include_once("./admin.head.php");

$colspan = 6;
?>

<table width=100%>
<tr>
    <td width=20%>&nbsp;</td>
    <td width=60% align=center>&nbsp;</td>
    <td width=20% align=right>�Ǽ� : <? echo $total_count ?>&nbsp;</td>
</tr>
</table>


<table cellpadding=0 cellspacing=0 width=100%>
<tr><td colspan='<?=$colspan?>' class='line1'></td></tr>
<tr class='bgcol1 bold col1 ht center'>
    <td width=40>ID</td>
    <td width=''>����</td>
    <td width=120>�ۼ��Ͻ�</td>
    <td width=50>�׽�Ʈ</td>
    <td width=50>������</td>
    <td width=80><a href='./mail_form.php'><img src='<?=$g4[admin_path]?>/img/icon_insert.gif' border=0></a></td>
</tr>
<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>

<?
for ($i=0; $row=mysql_fetch_array($result); $i++) {
    $s_mod = icon("����", "./mail_form.php?w=u&ma_id=$row[ma_id]");
    $s_del = icon("����", "javascript:del('./mail_update.php?w=d&ma_id=$row[ma_id]');");
    $s_vie = icon("����", "./mail_preview.php?ma_id=$row[ma_id]", "_blank");

    $num = number_format($total_count - ($page - 1) * $config[cf_page_rows] - $i);

    $list = $i%2;
    echo "
    <tr class='list$list col1 ht center'>
        <td>$num</td>
        <td align=left>$row[ma_subject]</td>
        <td>$row[ma_time]</td>
        <td><a href='./mail_test.php?ma_id=$row[ma_id]'>�׽�Ʈ</a></td>
        <td><a href='./mail_select_form.php?ma_id=$row[ma_id]'>������</a></td>
        <td>$s_mod $s_del $s_vie</td>
    </tr>";
}

if (!$i)
    echo "<tr><td colspan='$colspan' height=100 align=center bgcolor='#FFFFFF'>�ڷᰡ �����ϴ�.</td></tr>";
?>
<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>
</table>

<?
include_once ("./admin.tail.php");
?>