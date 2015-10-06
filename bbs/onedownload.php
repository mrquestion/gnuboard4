<?
include_once("./_common.php");

//@include_once("$board_skin_path/download.head.skin.php");

if (!$is_member) { 
    alert("회원만 다운로드가 가능합니다.");
}

// 세션에 저장된 ID값과 넘어온 ID값을 비교하여 같지 않을 경우 오류 발생
// 다른곳에서 링크 거는것을 방지하기 위한 코드
if (get_session("ss_one_{$ob_table}") && get_session("ss_one_{$ob_table}") != $on_id) 
    alert("잘못된 접근입니다.");  

// $flag 는 on_qfile 또는 on_afile 중에 하나
// $flag == "q" : on_qfile
// $flag == "a" : on_afile
$row = sql_fetch(" select on_{$flag}file as file, on_{$flag}source as source from $g4[one_prefix]$ob_table where on_id = '$on_id' ");
$filename = $row['file'];
$source = $row['source'];
if (!$filename)
    alert("파일 정보가 존재하지 않습니다.");

$filepath = "$g4[path]/data/one/$ob_table/$filename";
$filepath = addslashes($filepath);
if (preg_match("/^utf/i", strtolower($g4[charset])))
    $original = urlencode($source);
else
    $original = $source;

if (file_exists($filepath)) {
    if(eregi("msie", $_SERVER[HTTP_USER_AGENT]) && eregi("5\.5", $_SERVER[HTTP_USER_AGENT])) {
        header("content-type: doesn/matter");
        header("content-length: ".filesize("$filepath"));
        header("content-disposition: attachment; filename=\"$original\"");
        header("content-transfer-encoding: binary");
    } else {
        header("content-type: file/unknown");
        header("content-length: ".filesize("$filepath"));
        header("content-disposition: attachment; filename=\"$original\"");
        header("content-description: php generated data");
    }
    header("pragma: no-cache");
    header("expires: 0");
    flush();

    if (is_file("$filepath")) {
        $fp = fopen("$filepath", "rb");

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