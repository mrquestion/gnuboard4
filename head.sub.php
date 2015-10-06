<?
// 이 파일은 새로운 파일 생성시 반드시 포함되어야 함
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

$begin_time = get_microtime();

if (!$g4[title])
    $g4[title] = $config[cf_title];

// 쪽지를 받았나?
if ($member[mb_memo_call]) {
    $mb = get_member($member[mb_memo_call], "mb_nick");
    sql_query(" update {$g4[member_table]} set mb_memo_call = '' where mb_id = '$member[mb_id]' ");

    alert($mb[mb_nick]."님으로부터 쪽지가 전달되었습니다.", $_SERVER[REQUEST_URI]);
}


// 현재 접속자
// 시간이 지난 접속은 삭제한다
sql_query(" delete from $g4[login_table] where lo_datetime < '".date("Y-m-d H:i:s", $g4[server_time] - (60 * $config[cf_login_minutes]))."' ");

//$lo_location = get_text($g4[title]);
$lo_location = $g4[title];
if (!$lo_location)
    $lo_location = $_SERVER[REQUEST_URI];
//$lo_url = $g4[url] . $_SERVER[REQUEST_URI];
$lo_url = $_SERVER[REQUEST_URI];
if (strstr($lo_url, "/$g4[admin]/") || $is_admin == "super") $lo_url = "";

$tmp_sql = " insert into $g4[login_table] ( lo_ip, mb_id, lo_datetime, lo_location, lo_url ) values ( '$_SERVER[REMOTE_ADDR]', '$member[mb_id]', '$g4[time_ymdhis]', '$lo_location',  '$lo_url' ) ";
$tmp_result = sql_query($tmp_sql, FALSE);
if (!$tmp_result) { 
    // 오류가 발생한다면 UPDATE 함
    $tmp_sql = " update $g4[login_table] set mb_id = '$member[mb_id]', lo_datetime = '$g4[time_ymdhis]', lo_location = '$lo_location', lo_url = '$lo_url' where lo_ip = '$_SERVER[REMOTE_ADDR]' ";
    sql_query($tmp_sql);
}


// 자바스크립트에서 go(-1) 함수를 쓰면 폼값이 사라질때 해당 폼의 상단에 사용하면
// 캐쉬의 내용을 가져옴. 완전한지는 검증되지 않음
header("Content-Type: text/html; charset=$g4[charset]");
$gmnow = gmdate("D, d M Y H:i:s") . " GMT";
header("Expires: 0"); // rfc2616 - Section 14.21
header("Last-Modified: " . $gmnow);
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: pre-check=0, post-check=0, max-age=0"); // HTTP/1.1
header("Pragma: no-cache"); // HTTP/1.0
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=<?=$g4[charset]?>">
<title><?=$g4[title]?></title>
<link rel="stylesheet" href="<?=$g4[path]?>/style.css" type="text/css">
</head>
<script language="javascript">
// 자바스크립트에서 사용하는 전역변수 선언
var g4_path      = "<?=$g4[path]?>";
var g4_bbs       = "<?=$g4[bbs]?>";
var g4_bbs_img   = "<?=$g4[bbs_img]?>";
var g4_url       = "<?=$g4[url]?>";
var g4_is_member = "<?=$is_member?>";
var g4_is_admin  = "<?=$is_admin?>";
var g4_bo_table  = "<?=$bo_table?>";
var g4_sca       = "<?=$sca?>";
var g4_charset   = "<?=$g4[charset]?>";
var g4_is_gecko  = navigator.userAgent.toLowerCase().indexOf("gecko") != -1;
var g4_is_ie     = navigator.userAgent.toLowerCase().indexOf("msie") != -1;
<? if ($is_admin) { echo "var g4_admin = '$g4[admin]';"; } ?>
</script>
<script language="javascript" src="<?=$g4[path]?>/js/common.js"></script>
<body topmargin="0" leftmargin="0" <?=$g4[body_script]?>>
<a name="g4_head"></a>
