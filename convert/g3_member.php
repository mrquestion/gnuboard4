<?
include_once("./_common.php");

if ($is_admin != "super")
    alert("�ְ�����ڸ� ��ȯ �����մϴ�", "$g4[bbs_path]/login.php?url=".urlencode($_SERVER[PHP_SELF]));

$g4[title] = "ȸ�� ��ȯ : �״�����3 -> �״�����4";
include_once("$g4[path]/head.sub.php");

if (!$source) $source = "gb_member";
$target = $g4[member_table];
$target_point = $g4[point_table];

if ($_POST[proc]) {
    $sql = " select * from $source ";
    $result = sql_query($sql);
    // �ڷᰡ ���� ��쿡�� Ÿ�� ���̺� ���� ����
    if (mysql_num_rows($result))
    {
        sql_query(" delete from $target where mb_level < '10' ");
        sql_query(" delete from $target_point ");
    }
    for ($i=1; $row=sql_fetch_array($result); $i++) {
        $sql2 = " insert into $target
                     set mb_id = '$row[mb_id]',
                         mb_password = '$row[mb_passwd]',
                         mb_jumin = '$row[mb_jumin]',
                         mb_name = '$row[mb_name]',
                         mb_nick = '$row[mb_name]',
                         mb_nick_date = '',
                         mb_email = '$row[mb_email]',
                         mb_homepage = '$row[mb_homepage]',
                         mb_password_q = '$row[mb_passwd_q]',
                         mb_password_a = '$row[mb_passwd_a]',
                         mb_level = '$row[mb_level]',
                         mb_sex = '$row[mb_sex]',
                         mb_birth = '$row[mb_birth]',
                         mb_tel = '$row[mb_tel]',
                         mb_hp = '$row[mb_hp]',
                         mb_zip1 = '$row[mb_zip1]',
                         mb_zip2 = '$row[mb_zip2]',
                         mb_addr1 = '$row[mb_addr1]',
                         mb_addr2 = '$row[mb_addr2]',
                         mb_signature = '$row[mb_signature]',
                         mb_recommend = '$row[mb_recommend]',
                         mb_point = '$row[mb_point]',
                         mb_today_login = '$row[mb_today_login]',
                         mb_login_ip = '$row[mb_login_ip]',
                         mb_datetime = '$row[mb_datetime]',
                         mb_ip = '$row[mb_ip]',
                         mb_leave_date = '$row[mb_leave_date]',
                         mb_intercept_date = '$row[mb_intercept_date]',
                         mb_memo = '$row[mb_memo]',
                         mb_mailling = '$row[mb_mailling]',
                         mb_open = '$row[mb_open]',
                         mb_profile = '$row[mb_profile]',
                         mb_memo_call = '$row[mb_memo_call_mb_id]',
                         mb_1 = '$row[mb_1]',
                         mb_2 = '$row[mb_2]',
                         mb_3 = '$row[mb_3]',
                         mb_4 = '$row[mb_4]',
                         mb_5 = '$row[mb_5]',
                         mb_6 = '$row[mb_6]',
                         mb_7 = '$row[mb_7]',
                         mb_8 = '$row[mb_8]',
                         mb_9 = '$row[mb_9]',
                         mb_10 = '$row[mb_10]'
                         ";
        sql_query($sql2, false);
    }

    // ����Ʈ ����
    $result = sql_query(" select mb_id, mb_point from $target ");
    while ($row=sql_fetch_array($result)) {
        if ($row[mb_point] != 0) {
            sql_query(" insert into $target_point (mb_id, po_datetime, po_content, po_point) values ('$row[mb_id]', '$g4[time_ymdhis]', '�״�����3 ��ȯ', '$row[mb_point]') ");
        }

        $sub_dir = substr($row[mb_id], 0, 2);
        @mkdir("$g4[path]/data/member/$sub_dir", 0707);
        @chmod("$g4[path]/data/member/$sub_dir", 0707);
    }

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
	<td height=30>�״�����3 ���̺�� : <input type=text name=source value="<?=$source?>"></td>
</tr>
<tr>
	<td height=30>������ ���纻�� ���� DB ���� �ִٰ� �����մϴ�.</td>
</tr>
<tr>
	<td height=30>����) ���纻�� ���� 10 �̻� ȸ���� ����� ��� ������ ��ȯ�մϴ�.</td>
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