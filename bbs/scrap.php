<?
include_once("./_common.php");

if (!$member[mb_id]) 
    alert_close("ȸ���� ��ȸ�Ͻ� �� �ֽ��ϴ�.");

$g4[title] = $member[mb_nick] . "���� ��ũ��";
include_once("$g4[path]/head.sub.php");

$list = array();

$sql_common = " from $g4[scrap_table] where mb_id = '$member[mb_id]' ";
$sql_order = " order by ms_id desc ";

$sql = " select count(*) as cnt $sql_common ";
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = $config[cf_page_rows];
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���
if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����
?>

<table width="600" height="50" border="0" cellpadding="0" cellspacing="0">
<tr>
    <td align="center" valign="middle" bgcolor="#EBEBEB">
        <table width="590" height="40" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td width="25" align="center" bgcolor="#FFFFFF" ><img src="<?=$g4[bbs_img_path]?>/icon_01.gif" width="5" height="5"></td>
            <td width="75" align="left" bgcolor="#FFFFFF" ><font color="#666666"><b>��ũ��</b></font></td>
            <td width="490" bgcolor="#FFFFFF" ></td>
        </tr>
        </table></td>
</tr>
</table>

<table width="600" border="0" cellspacing="0" cellpadding="0">
<tr> 
    <td height="200" align="center" valign="top">
        <table width="540" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td height="20"></td>
        </tr>
        <tr> 
            <td height="2" bgcolor="#808080"></td>
        </tr>
        <tr> 
            <td width="540" bgcolor="#FFFFFF">
                <table width=100% cellpadding=1 cellspacing=1 border=0>
                <tr bgcolor=#E1E1E1 align=center> 
                    <td width="10%" height="24"><b>��ȣ</b></td>
                    <td width="12%"><b>�Խ���</b></td>
                    <td width="38%"><b>����</b></td>
                    <td width="25%"><b>�����Ͻ�</b></td>
                    <td width="10%"><b>����</b></td>
                </tr>

                <?
                $sql = " select * 
                          $sql_common
                          $sql_order
                          limit $from_record, $rows ";
                $result = sql_query($sql);
                for ($i=0; $row=sql_fetch_array($result); $i++) {
                    // �������� ��ȣ (����)
                    $num = $total_count - ($page - 1) * $rows - $i;

                    // �Խ��� ����
                    $sql2 = " select bo_subject from $g4[board_table] where bo_table = '$row[bo_table]' ";
                    $row2 = sql_fetch($sql2);
                    if (!$row2[bo_subject]) $row2[bo_subject] = "[�Խ��� ����]";

                    // �Խù� ����
                    $tmp_write_table = $g4[write_prefix] . $row[bo_table];
                    $sql3 = " select wr_subject from $tmp_write_table where wr_id = '$row[wr_id]' ";
                    $row3 = sql_fetch($sql3);
                    $subject = get_text(cut_str($row3[wr_subject], 100));
                    if (!$row3[wr_subject]) 
                        $row3[wr_subject] = "[�� ����]";

                    echo <<<HEREDOC
                    <tr height=25 bgcolor="#F6F6F6" align="center"> 
                        <td height="24">{$num}</td>
                        <td><a href="javascript:;" onclick="opener.document.location.href='./board.php?bo_table=$row[bo_table]';">$row2[bo_subject]</a></td>
                        <td align="left" style='word-break:break-all;'>&nbsp;<a href="javascript:;" onclick="opener.document.location.href='./board.php?bo_table=$row[bo_table]&wr_id=$row[wr_id]';">$subject</a></td>
                        <td>$row[ms_datetime]</td>
                        <td><a href="javascript:del('./scrap_delete.php?ms_id=$row[ms_id]&page=$page');"><img src="$g4[bbs_img_path]/btn_comment_delete.gif" width="45" height="14" border="0"></a></td>
                    </tr>
HEREDOC;
                }

                if ($i == 0)
                    echo "<tr><td colspan=5 align=center height=100 class='content contentbg'>�ڷᰡ �����ϴ�.</td></tr>";
                ?>
                </table></td>
        </tr>
        </table></td>
</tr>
<tr> 
    <td height="30" align="center"><?=get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");?></td>
</tr>
<tr> 
    <td height="2" align="center" valign="top" bgcolor="#D5D5D5"></td>
</tr>
<tr>
    <td height="2" align="center" valign="top" bgcolor="#E6E6E6"></td>
</tr>
<tr>
    <td height="40" align="center" valign="bottom"><a href="javascript:window.close();"><img src="<?=$g4[bbs_img_path]?>/close.gif" width="66" height="20" border="0"></a></td>
</tr>
</table>
<br>

<script language="JavaScript">
//window.resizeTo(626, 700);
</script>

<?
include_once("$g4[path]/tail.sub.php");
?>
