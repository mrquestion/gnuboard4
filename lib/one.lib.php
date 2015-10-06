<?
if (!defined('_GNUBOARD_')) exit;

function upload_file2($path, $file) {
    global $g4;

    if (!$file[name]) return '';

    $tmp_file  = $file[tmp_name];
    $filename  = $file[name];
    $filesize  = $file[size];
    $error = $file[error];

    if ($error == 1) {
        alert("\'{$filename}\' 파일의 용량이 서버에 설정($upload_max_filesize)된 값보다 크므로 업로드 할 수 없습니다.\\n");
        exit;
    } else if ($error != 0) {
        alert("\'{$filename}\' 파일이 정상적으로 업로드 되지 않았습니다.\\n");
        exit;
    }

    // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
    $filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

    // 달빛온도님 수정 : 한글파일은 urlencode($filename) 처리를 할경우 '%'를 붙여주게 되는데 '%'표시는 미디어플레이어가 인식을 못하기 때문에 재생이 안됩니다. 그래서 변경한 파일명에서 '%'부분을 빼주면 해결됩니다. 
    $filename = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr(md5(uniqid($g4[server_time])),0,8).'_'.str_replace('%', '', urlencode($filename)); 

    $dest_file = $path.'/'.$filename;

    // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
    $error_code = move_uploaded_file($tmp_file, $dest_file) or die($file[error]);

    // 올라간 파일의 퍼미션을 변경합니다.
    chmod($dest_file, 0606);

    return $filename;
}
?>