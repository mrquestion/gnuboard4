<?
include_once("./_common.php");

include_once("$g4[path]/head.sub.php");

if (!$member[mb_id]) {
    $href = "./login.php?$qstr&url=".urlencode("./board.php?bo_table=$bo_table&wr_id=$wr_id");
    echo <<<HEREDOC
    <script language='JavaScript'>
        alert("ȸ���� �����մϴ�.");
        top.location.href = "$href";
    </script>
HEREDOC;
    exit;
}

$sql = " select count(*) as cnt from $g4[scrap_table]
          where mb_id = '$member[mb_id]'
            and bo_table = '$bo_table'
            and wr_id = '$wr_id' ";
$row = sql_fetch($sql);
if ($row[cnt]) {
    echo <<<HEREDOC
    <script language="JavaScript">
    //if (confirm('�̹� ��ũ���Ͻ� �Խù� �Դϴ�.\\n\\n���� ��ũ���� Ȯ���Ͻðڽ��ϱ�?')) { win_scrap(); }
    alert("�̹� ��ũ���Ͻ� �Խù� �Դϴ�.");
    </script>
HEREDOC;
    exit;
}

$tmp_row = sql_fetch(" select max(ms_id) as max_ms_id from $g4[scrap_table] ");
$ms_id = $tmp_row[max_ms_id] + 1;

$sql = " insert into $g4[scrap_table] 
                ( ms_id, mb_id, bo_table, wr_id, ms_datetime )
         values ( '$ms_id', '$member[mb_id]', '$bo_table', '$wr_id', '$g4[time_ymdhis]' ) ";
sql_query($sql);

echo <<<HEREDOC
<script language="JavaScript"> 
    //if (confirm("�� �Խù��� ��ũ�� �Ͽ����ϴ�.\n\n���� ��ũ���� Ȯ���Ͻðڽ��ϱ�?")) win_scrap();
    alert("�� �Խù��� ��ũ�� �Ͽ����ϴ�.");
</script>
HEREDOC;

include_once("$g4[path]/head.sub.php");
?>
