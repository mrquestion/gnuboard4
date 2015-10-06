<?
include_once("./_common.php");

$g4[title] = "도로명/지번 주소 검색";
include_once("$g4[path]/head.sub.php");

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') {   //https 통신
    $g4['daum_juso_js'] = "<script src=\"https://spi.maps.daum.net/imap/map_js_init/postcode.js\"></script>";
} else {  //http 통신 
    $g4['daum_juso_js'] = "<script src=\"http://dmaps.daum.net/map_js_init/postcode.js\"></script>";
}

$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";
include_once("$member_skin_path/zip.skin.php");

include_once("$g4[path]/tail.sub.php");
?>
