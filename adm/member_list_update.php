<?
$sub_menu = "200100";
include_once("./_common.php");

check_demo();

auth_check($auth[$sub_menu], "w");

for ($i=0; $i<count($chk); $i++) 
{
    // ���� ��ȣ�� �ѱ�
    $k = $chk[$i];

    $mb = get_member($mb_id[$k]);

    if (!$mb[mb_id]) {
        $msg .= "$mb[mb_id] : ȸ���ڷᰡ �������� �ʽ��ϴ�.\\n";
    } else if ($is_admin != "super" && $mb[mb_level] >= $member[mb_level]) {
        $msg .= "$mb[mb_id] : �ڽź��� ������ ���ų� ���� ȸ���� ������ �� �����ϴ�.\\n";
    } else {
        $sql = " update $g4[member_table]
                    set mb_level = '$mb_level[$k]',
                        mb_intercept_date = '$mb_intercept_date[$k]'
                  where mb_id = '$mb_id[$k]' ";
        sql_query($sql);
    }
}

if ($msg)
    echo "<script language='JavaScript'> alert('$msg'); </script>";

goto_url("./member_list.php?$qstr");
?>
