<?
include_once("./_common.php");

if (!$member[mb_id]) {
    $href = "./login.php?$qstr&url=".urlencode("./board.php?bo_table=$bo_table&wr_id=$wr_id");
    <<<HEREDOC
    <script language="JavaScript">
        alert("ȸ���� �����մϴ�.");
        top.location.href = "$href";
    </script>
HEREDOC;
    exit;
}

if ($good == "good" || $good == "nogood") {
    $ss_name = "ss_good_{$bo_table}_{$wr_id}";

    if ($tmp_good = $_SESSION[$ss_name]) {
        if ($tmp_good == "good") 
            $tmp_status = "��õ(����)";
        else 
            $tmp_status = "����õ(�ݴ�)";

        echo <<<HEREDOC
        <script language="JavaScript">
            alert("�̹� '$tmp_status' �Ͻ� �� �Դϴ�.");
        </script>    
HEREDOC;
    } else {
        // ��õ(����), ����õ(�ݴ�) ī��Ʈ ����
        sql_query(" update $write_table set wr_{$good} = wr_{$good} + 1 where wr_id = '$wr_id' ");

        set_session($ss_name, $good);

        if ($good == "good") 
            $status = "��õ(����)";
        else 
            $status = "����õ(�ݴ�)";

        echo <<<HEREDOC
        <script language="JavaScript">
            alert("�� ���� '$status' �Ͽ����ϴ�.");
        </script>    
HEREDOC;
    }
}
?>
<script language="JavaScript"> window.close(); </script>