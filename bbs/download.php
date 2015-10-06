<?
include_once("./_common.php");

// 쿠키에 저장된 ID값과 넘어온 ID값을 비교하여 같지 않을 경우 오류 발생
// 다른곳에서 링크 거는것을 방지하기 위한 코드
if (!get_session("ss_view_{$bo_table}_{$wr_id}")) 
    alert("잘못된 접근입니다.");  

$sql = " select bf_source, bf_file from $g4[board_file_table]
          where bo_table = '$bo_table'
            and wr_id = '$wr_id'
            and bf_no = '$no' ";
$file = sql_fetch($sql);
if (!$file[bf_file])
    alert_close("파일 정보가 존재하지 않습니다.");

if ($member[mb_level] < $board[bo_download_level]) { 
    $alert_msg = "다운로드 권한이 없습니다.";
    if ($member[mb_id])
        alert($alert_msg);
    else
        alert($alert_msg . "\\n\\n회원이시라면 로그인 후 이용해 보십시오.", "./login.php?wr_id=$wr_id&$qstr&url=".urlencode("board.php?bo_table=$bo_table&wr_id=$wr_id"));
}

// 회원이상 다운로드가 가능하다면
if ($board[bo_download_level] >= 1) {
    // 이미 다운로드 받은 파일인지를 검사
    // d 는 download의 약자
    //if (!preg_match("/^(d," . $index . "," . $member[mb_id].")/m", $write[wr_history])) {
    $ss_name = "ss_down_{$bo_table}_{$wr_id}_{$no}";
    if (!get_session($ss_name)) 
    {
        // 자신의 글이거나 관리자라면 통과
        if (($write[mb_id] && $write[mb_id] == $member[mb_id]) || $is_admin)
            ;
        else if ($board[bo_download_level] > 1) // 회원이상 다운로드가 가능하다면
        {
            // 다운로드 포인트가 음수이고 회원의 포인트가 0 이거나 작다면
            //if ($board[bo_download_point] < 0 && $member[mb_point] <= 0)
            if ($member[mb_point] + $board[bo_download_point] < 0)
                alert("보유하신 포인트(".number_format($member[mb_point]).")가 없거나 모자라서 다운로드(".number_format($board[bo_download_point]).")가 불가합니다.\\n\\n포인트를 적립하신 후 다시 다운로드 해 주십시오.");

            insert_point($member[mb_id], $board[bo_download_point], "$board[bo_subject] $wr_id {$index}번 파일 다운로드");
        }

        /*
        $history = $write[wr_history] . "d," . $index . "," . $member[mb_id] . "\n";
        sql_query(" update $write_table set wr_history = '$history' where wr_id = '$wr_id' ");
        */

        // 다운로드 카운트 증가
        $sql = " update $g4[board_file_table] set bf_download = bf_download + 1 where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$no' ";
        sql_query($sql);

        set_session($ss_name, TRUE);
    }
}

$g4[title] = "$group[gr_subject] > $board[bo_subject] > " . conv_subject($write[wr_subject], 255) . " > 다운로드";

$filepath = "$g4[path]/data/file/$bo_table/$file[bf_file]";
$filepath = addslashes($filepath);
$original = $file[bf_source];

if (file_exists($filepath)) {
    if(eregi("msie", $_SERVER[HTTP_USER_AGENT]) && eregi("5\.5", $_SERVER[HTTP_USER_AGENT])) {
        header("content-type: doesn/matter");
        header("content-length: ".filesize("$filepath"));
        header("content-disposition: attachment; filename=$original");
        header("content-transfer-encoding: binary");
    } else {
        header("content-type: file/unknown");
        header("content-length: ".filesize("$filepath"));
        header("content-disposition: attachment; filename=$original");
        header("content-description: php generated data");
    }
    header("pragma: no-cache");
    header("expires: 0");
    flush();

    if (is_file("$filepath")) {
        $fp = fopen("$filepath", "rb");

        // 4.00 대체
        // 서버부하를 줄이려면 print 나 echo 또는 while 문을 이용한 방법보다는 이방법이...
        //if (!fpassthru($fp)) {
        //    fclose($fp);
        //}

        $fp = fopen($filepath, "rb"); 
        while(!feof($fp)) { 
            echo fread($fp, 100*1024); 
            flush(); 
        } 
        fclose ($fp); 
        flush();
    } else {
        alert("해당 파일이나 경로가 존재하지 않습니다.");
    }

} else {
    alert("파일을 찾을 수 없습니다.");
}
?>
