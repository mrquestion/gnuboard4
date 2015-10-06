<?
include_once("./_common.php");

if (!$member[mb_id] && $config[cf_formmail_is_member])  
    alert_close("회원만 이용하실 수 있습니다.");

if (!$member[mb_open] && $is_admin != "super" && $member[mb_id] != $mb_id) 
    alert_close("자신의 정보를 공개하지 않으면 다른분에게 메일을 보낼 수 없습니다.\\n\\n정보공개 설정은 회원정보수정에서 하실 수 있습니다.");

if ($mb_id) {
    $mb = get_member($mb_id);
    if (!$mb[mb_id]) 
        alert_close("회원정보가 존재하지 않습니다.\\n\\n탈퇴하였을 수 있습니다.");

    if (!$mb[mb_open] && $is_admin != "super")
        alert_close("정보공개를 하지 않았습니다.");
}

$g4[title] = "메일 쓰기";
include_once("$g4[path]/head.sub.php");

if (!isset($type)) 
    $type = 0;

$type_checked[0] = $type_checked[1] = $type_checked[2] = "";
$type_checked[$type] = "checked";

$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";
include_once("$member_skin_path/formmail.skin.php");

include_once("$g4[path]/tail.sub.php");
?>
