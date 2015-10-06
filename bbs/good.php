<?
include_once("./_common.php");

if (!$is_member) 
{
    $href = "./login.php?$qstr&url=".urlencode("./board.php?bo_table=$bo_table&wr_id=$wr_id");

    echo "<script language='JavaScript'>alert('회원만 가능합니다.'); top.location.href = '$href';</script>";
    exit;
}

if (!($bo_table && $wr_id)) 
    alert_close("값이 제대로 넘어오지 않았습니다.");

// SQL Injection 예방
$row = sql_fetch(" select count(*) as cnt from {$g4[write_prefix]}{$bo_table} ", FALSE);
if (!$row[cnt])
    alert_close("존재하는 게시판이 아닙니다.");

if ($good == "good" || $good == "nogood") 
{
    $ss_name = "ss_good_{$bo_table}_{$wr_id}";

    if ($tmp_good = $_SESSION[$ss_name]) 
    {
        if ($tmp_good == "good") 
            $tmp_status = "추천(찬성)";
        else 
            $tmp_status = "비추천(반대)";

        echo "<script language='JavaScript'>alert('이미 \'$tmp_status\' 하신 글 입니다.');</script>";
    } 
    else 
    {
        // 추천(찬성), 비추천(반대) 카운트 증가
        sql_query(" update {$g4[write_prefix]}{$bo_table} set wr_{$good} = wr_{$good} + 1 where wr_id = '$wr_id' ");

        set_session($ss_name, $good);

        if ($good == "good") 
            $status = "추천(찬성)";
        else 
            $status = "비추천(반대)";

        echo "<script language='JavaScript'> alert('이 글을 \'$status\' 하였습니다.');</script>";
    }
}
?>
<script language="JavaScript"> window.close(); </script>