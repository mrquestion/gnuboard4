<?
include_once("./_common.php");

if ($is_admin != "super")
    alert("�ְ�����ڸ� ��ȯ �����մϴ�", "$g4[bbs_path]/login.php?url=".urlencode($_SERVER[PHP_SELF]));

$g4[title] = "�Խ��� ��ȯ : �״�����3 -> �״�����4";
include_once("$g4[path]/head.sub.php");

$tmp_source = "gb_write_" . $source;
$tmp_target = $g4[write_prefix] . $target;

$notice = "";
$cr = "";
$comment = -1;

if ($_POST[proc]) {
    $category = array();
    $sql = " select ca_id, ca_name from {$tmp_source}_cat order by ca_id ";
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $category[$row[ca_id]] = $row[ca_name];
    }

    $sql = " select * from $tmp_source ";
    $result = sql_query($sql);
    // �ڷᰡ ���� ��쿡�� Ÿ�� ���̺� ���� ����
    if (mysql_num_rows($result))
    {
        sql_query(" delete from $tmp_target ");
        sql_query(" delete from $g4[board_file_table] where bo_table = '$target' ");
    }
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        /*
        if ($row[wr_notice]) {
            $notice .= "$cr$row[wr_id]";
            $cr = "\n";
        }
        */

        $html = "";
        if ($row[wr_html])
            $html = ",html{$row[wr_html]}";
        $secret = "";
        if ($row[wr_secret])
            $secret = ",secret";
        $recv_email = "";
        if ($row[wr_recv_email])
            $mail = ",mail";
        $sql2 = " insert into $tmp_target
                     set wr_id = '$row[wr_id]',
                         ca_name = '{$category[$row[ca_id]]}',
                         wr_option = '$html,$secret,$mail',
                         wr_num = '$row[wr_num]',
                         wr_reply = '$row[wr_reply]',
                         wr_parent = '$row[wr_parent_id]',
                         wr_subject = '".addslashes($row[wr_subject])."',
                         wr_content = '".addslashes($row[wr_content])."',
                         wr_link1 = '$row[wr_link1]',
                         wr_link2 = '$row[wr_link2]',
                         wr_link1_hit = '$row[wr_link1_hit]',
                         wr_link2_hit = '$row[wr_link2_hit]',
                         wr_hit = '$row[wr_hit]',
                         wr_good = '$row[wr_good]',
                         wr_nogood = '$row[wr_nogood]',
                         mb_id = '$row[mb_id]',
                         wr_password = '$row[wr_passwd]',
                         wr_name = '".addslashes($row[wr_name])."',
                         wr_email = '$row[wr_email]',
                         wr_homepage = '$row[wr_homepage]',
                         wr_datetime = '$row[wr_datetime]',
                         wr_ip = '$row[wr_ip]',
                         wr_1 = '$row[wr_1]',
                         wr_2 = '$row[wr_2]',
                         wr_3 = '$row[wr_3]',
                         wr_4 = '$row[wr_4]',
                         wr_5 = '$row[wr_5]',
                         wr_6 = '$row[wr_6]',
                         wr_7 = '$row[wr_7]',
                         wr_8 = '$row[wr_8]',
                         wr_9 = '$row[wr_9]',
                         wr_10 = '$row[wr_10]' ";
        if ($row[wr_comment] == 0)
        {
            $sql2 .= " , wr_comment = '$row[wr_commentcnt]' ";
            $sql2 .= " , wr_is_comment = '0' ";
        }
        else // �ڸ�Ʈ���
        {
            $sql2 .= " , wr_comment = '$comment' ";
            $sql2 .= " , wr_is_comment = '1' ";
            $comment--;
        }
        sql_query($sql2);

        $bf_no = 0;
        if ($row[wr_file1]) {
            @copy("$source_file/$source/$row[wr_file1]", "$g4[path]/data/file/$target/$row[wr_file1]");
            @chmod("$g4[path]/data/file/$target/$row[wr_file1]", 0606);

            $sql3 = " insert into $g4[board_file_table]
                         set bo_table = '$target',
                             wr_id = '$row[wr_id]',
                             bf_no = '$bf_no',
                             bf_source = '".addslashes($row[wr_file1_source])."',
                             bf_file = '".addslashes($row[wr_file1])."',
                             bf_download = '$row[wr_file1_download]' ";

            sql_query($sql3);

            $bf_no++;
        }

        if ($row[wr_file2]) {
            @copy("$source_file/$source/$row[wr_file2]", "$g4[path]/data/file/$target/$row[wr_file2]");
            @chmod("$g4[path]/data/file/$target/$row[wr_file2]", 0606);
        
            $sql3 = " insert into $g4[board_file_table]
                         set bo_table = '$target',
                             wr_id = '$row[wr_id]',
                             bf_no = '$bf_no',
                             bf_source = '".addslashes($row[wr_file2_source])."',
                             bf_file = '".addslashes($row[wr_file2])."',
                             bf_download = '$row[wr_file2_download]' ";

            sql_query($sql3);
        }
    }

    $category_list = $bar = "";
    for ($i=1; $i<=count($category); $i++) {
        $category_list .= $bar . $category[$i];
        $bar = "|";
    }

    //sql_query(" update $g4[board_table] set bo_notice = '$notice', bo_category_list = '$category_list' where bo_table = '$target' ");

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
<form name=f method=post action="javascript:f_submit(document.f);" autocomplete="off">
<input type=hidden name=proc value=1>
<tr>
	<td height=50 align=center><strong><?=$g4[title]?></strong></td>
</tr>
<tr>
	<td height=30>�״�����3 = ���� , �״�����4 = ���纻</td>
</tr>
<tr>
	<td height=30>�״�����3 �Խ��Ǹ� : <input type=text name=source value="<?=$source?>" required></td>
</tr>
<tr>
	<td height=30>��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��&nbsp; ���丮 : <input type=text name=source_file value="<?=$source_file?>" required> ������</td>
</tr>
<tr>
	<td height=10><hr></td>
</tr>
<tr>
	<td height=30>��&nbsp;&nbsp;��&nbsp;&nbsp;��&nbsp; �Խ��Ǹ� : <input type=text name=target value="<?=$target?>" required></td>
</tr>
<tr>
	<td height=30>������ ���纻�� ���� DB ���� �ִٰ� �����մϴ�.</td>
</tr>
<tr>
	<td align=center height=60><br><input name=trans type=submit value=" ��ȯ�ϱ� "> <input type=button value="�޴�" onclick="location.href='./';"></td>
</tr>
<tr>
	<td height=30><b>��ȯ�� <a href="<?=$g4[admin_path]?>/board_form.php?w=u&bo_table=<?=$target?>" target=_blank>������ȭ��</a>���� ī��Ʈ������ üũ�� �� Ȯ�� ��ư�� Ŭ���Ͻʽÿ�.</b></td>
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