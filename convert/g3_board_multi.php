<?
include_once("./_common.php");

if ($is_admin != "super")
    alert("�ְ�����ڸ� ��ȯ �����մϴ�", "$g4[bbs_path]/login.php?url=".urlencode($_SERVER[PHP_SELF]));

$g4[title] = "�Խ��� ��Ƽ ��ȯ : �״�����3 -> �״�����4";
include_once("$g4[path]/head.sub.php");
?>

<br>
<form name=fmulti method=post action='./g3_board_multi_update.php'>
<p align=center><input type=submit value='   ��   ȯ   '>
<br><br>
<table align=center cellpadding=5 cellspacing=0 bordercolordark=white border=1>
<tr align=center>
	<td><b>�״�����3</b></td>
	<td width=30 align=center rowspan=2>��</td>
	<td><b>�״�����4</b></td>
</tr>
<tr>
	<td valign=top style='line-height:200%;'>
        <?
        $sql = " select bo_table, bo_subject from gb_board order by bo_table ";
        $result = sql_query($sql);
        for ($i=0; $row=sql_fetch_array($result); $i++)
        {
            $count = 0;
            $sql2 = " select count(*) as cnt from gb_write_{$row[bo_table]} ";
            $result2 = @mysql_query($sql2);
            if ($result2)
            {
                $disabled = "";
                $row2 = sql_fetch_array($result2);
                $count = $row2[cnt];
            }
            else
                $disabled = " disabled ";
            echo "<input type=radio name=source value='$row[bo_table]' $disabled id='source$i'> <a href=\"javascript:;\" onclick=\"document.getElementById('source$i').checked=true;\">$row[bo_subject] ($row[bo_table] : $count)</a>";
            echo "<br>";
        }
        ?>
    </td>
	<td valign=top style='line-height:200%;'>
        <?
        $sql = " select bo_table, bo_subject from $g4[board_table] order by bo_table ";
        $result = sql_query($sql);
        for ($i=0; $row=sql_fetch_array($result); $i++)
        {
            $count = 0;
            $sql2 = " select count(*) as cnt from {$g4[write_prefix]}{$row[bo_table]} ";
            $result2 = @mysql_query($sql2);
            if ($result2)
            {
                $disabled = "";
                $row2 = sql_fetch_array($result2);
                $count = $row2[cnt];
            }
            else
                $disabled = " disabled ";
            echo "<input type=radio name=target value='$row[bo_table]' $disabled id='target$i'> <a href=\"javascript:;\" onclick=\"document.getElementById('target$i').checked=true;\">$row[bo_subject] ($row[bo_table] : $count)</a>";
            echo "<br>";
        }
        ?>
    </td>
</tr>
</table>

<p align=center><input type=submit value='   ��   ȯ   '>
</form>

<br>
<table align=center cellpadding=5 cellspacing=0>
<tr>
    <td>
        �� �������� ���ϴ� �Խ����� �������� �ʱ� �����Դϴ�.<br>
        �� data/file ���� �ڷ�� ���� ������ �ֽñ� �ٶ��ϴ�.
    </td>
</tr>
</table>
<br><br>


<?
include_once("$g4[path]/tail.sub.php");
?>