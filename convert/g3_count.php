<?
include_once("./_common.php");

if ($is_admin != "super")
    alert("�ְ�����ڸ� ��ȯ �����մϴ�", "$g4[bbs_path]/login.php?url=".urlencode($_SERVER[PHP_SELF]));

$g4[title] = "�湮�ڼ� ��ȯ : �״�����3 -> �״�����4";
include_once("$g4[path]/head.sub.php");

$source = "gb_count";
$source_sum = "gb_count_sum";

$target = $g4[visit_table];
$target_sum = $g4[visit_sum_table];

if ($_POST[proc]) {
    $sql = " select * from $source ";
    $result = sql_query($sql);
    // �ڷᰡ ���� ��쿡�� Ÿ�� ���̺� ���� ����
    if (mysql_num_rows($result))
    {
        sql_query(" delete from $target ");
        sql_query(" delete from $target_sum ");
    }

    sql_query(" insert into $target select * from $source ");
    sql_query(" insert into $target_sum select * from $source_sum ");

    echo <<<HEREDOC
    <script language="JavaScript">
        alert("��ȯ �Ͽ����ϴ�.");
    </script>
HEREDOC;
}
?>

<br>
<br>
<br>
<table align=center>
<form name=f method=post action="javascript:f_submit(document.f);">
<input type=hidden name=proc value=1>
<tr>
	<td height=50 align=center><strong><?=$g4[title]?></strong></td>
</tr>
<tr>
	<td height=30>�״�����3 = ���� , �״�����4 = ���纻</td>
</tr>
<tr>
	<td height=30>������ ���纻�� ���� DB ���� �ִٰ� �����մϴ�.</td>
</tr>
<tr>
	<td align=center><br><input name=trans type=submit value=" ��ȯ�ϱ� "> <input type=button value="�޴�" onclick="location.href='./';"></td>
</tr>
</form>
</table>

<script language="JavaScript">
function f_submit(f)
{
    f.trans.value = " ��ȯ��... ";
    f.trans.disabled = true;
    f.action = "";
    f.submit();
}
</script>

<?
include_once("$g4[path]/tail.sub.php");
?>