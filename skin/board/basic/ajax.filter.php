<?
include_once("./_common.php");

if (!function_exists('convert_charset')) {
    /*
    -----------------------------------------------------------
        Charset 을 변환하는 함수
    -----------------------------------------------------------
    iconv 함수가 있으면 iconv 로 변환하고
    없으면 mb_convert_encoding 함수를 사용한다.
    둘다 없으면 사용할 수 없다.
    */
    function convert_charset($from_charset, $to_charset, $str) {

        if( function_exists('iconv') )
            return iconv($from_charset, $to_charset, $str);
        elseif( function_exists('mb_convert_encoding') )
            return mb_convert_encoding($str, $to_charset, $from_charset);
        else
            die("Not found 'iconv' or 'mbstring' library in server.");
    }
}

header("Content-Type: text/html; charset=$g4[charset]");

$subject = strtolower($_POST['subject']);
$content = strtolower(strip_tags($_POST['content']));

if (strtolower($g4[charset]) == 'euc-kr') {
    $subject = convert_charset('UTF-8', 'CP949', $subject);
    $content = convert_charset('UTF-8', 'CP949', $content);
}

$filter = explode(",", strtolower(trim($config['cf_filter'])));
for ($i=0; $i<count($filter); $i++) {
    $str = $filter[$i];

    // 제목 필터링 (찾으면 중지)
    $subj = "";
    $pos = strpos($subject, $str);
    if ($pos !== false) {
        $subj = $str;
        break;
    }

    // 내용 필터링 (찾으면 중지)
    $cont = "";
    $pos = strpos($content, $str);
    if ($pos !== false) {
        $cont = $str;
        break;
    }
}
die("{\"subject\":\"$subj\",\"content\":\"$cont\"}");
?>