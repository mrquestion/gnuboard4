<?
/*


�亯�ÿ� ���� �߼��� �Ұ� ���� üũ�� �ϰ� üũ�� Ǯ�� ���� �߼��� ���� ����


����� �����ϴ� ��찡 ���� �� �ֱ� ������ 



*/


include_once("_common.php");
include_once("$g4[path]/lib/one.lib.php");

$filepath = "$g4[path]/data/one/$ob_table";

if ($on_afile_del) {
    $row = sql_fetch(" select on_afile from $g4[one_prefix]$ob_table where on_id = '$on_id' ");
    @unlink("$filepath/$row[on_afile]");
}

if ($_FILES[on_afile][name]) {
    // �����ϴ� ������ �ִٸ� �����մϴ�.
    $row = sql_fetch(" select on_afile from $g4[one_prefix]$ob_table where on_id = '$on_id' ");
    @unlink("$filepath/$row[on_afile]");
}

$source = $_FILES[on_afile][name];
$filename = upload_file($filepath, $_FILES[on_afile]);

$sql = " update $g4[one_prefix]$ob_table
            set on_answer = '$on_answer',
                on_adatetime = '$g4[time_ymdhis]' ";
if ($source || $on_afile_del) {
    $sql .= " ,on_afile = '$filename' 
              ,on_asource = '$source' ";
}
$sql .= " where on_id = '$on_id' ";
sql_query($sql);

$oneboard = sql_fetch(" select ob_use_email from $g4[oneboard_table] where ob_table = '$ob_table' ");

// ���� �߼� ����̶��
if ($oneboard[ob_use_email]) {
    include_once("$g4[path]/lib/mailer.lib.php");

    $one = sql_fetch(" select * from $g4[one_prefix]$ob_table where on_id = '$on_id' ");

    $subject = $one[on_subject];
    $re_subject = "�亯: $subject";
    $link_url = "$g4[url]/$g4[bbs]/one.php?ob_table=$ob_table&on_id=$on_id&$qstr";

    ob_start();
    include_once("oneanswermail.php");
    $content = ob_get_contents();
    ob_end_clean();

    $mb = sql_fetch(" select mb_name, mb_email from $g4[member_table] where mb_no = '$one[mb_no]' ");

    mailer($member[mb_name], $member[mb_email], $mb[mb_email], $re_subject, $content, 1);
}

goto_url("one.php?ob_table=$ob_table&on_id=$on_id");
?>