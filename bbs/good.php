<?
include_once("./_common.php");

if (!$member[mb_id]) {
    $href = "./login.php?$qstr&url=".urlencode("./board.php?bo_table=$bo_table&wr_id=$wr_id");
    <<<HEREDOC
    <script language="JavaScript">
        alert("회원만 가능합니다.");
        top.location.href = "$href";
    </script>
HEREDOC;
    exit;
}

if ($good == "good" || $good == "nogood") {
    $ss_name = "ss_good_{$bo_table}_{$wr_id}";

    if ($tmp_good = $_SESSION[$ss_name]) {
        if ($tmp_good == "good") 
            $tmp_status = "추천(찬성)";
        else 
            $tmp_status = "비추천(반대)";

        echo <<<HEREDOC
        <script language="JavaScript">
            alert("이미 '$tmp_status' 하신 글 입니다.");
        </script>    
HEREDOC;
    } else {
        // 추천(찬성), 비추천(반대) 카운트 증가
        sql_query(" update $write_table set wr_{$good} = wr_{$good} + 1 where wr_id = '$wr_id' ");

        set_session($ss_name, $good);

        if ($good == "good") 
            $status = "추천(찬성)";
        else 
            $status = "비추천(반대)";

        echo <<<HEREDOC
        <script language="JavaScript">
            alert("이 글을 '$status' 하였습니다.");
        </script>    
HEREDOC;
    }
}
?>
<script language="JavaScript"> window.close(); </script>