<?
include_once("./_common.php");

if ($w == "u")
    $action = "./write.php";
else if ($w == "d")
    $action = "./delete.php";
else if ($w == "x")
    $action = "./delete_comment.php";
else if ($w == "s")
    $action = "./password_check.php";
else
    alert("w 값이 제대로 넘어오지 않았습니다.");

$g4[title] = "패스워드 입력";
include_once("$g4[path]/head.sub.php");

if ($board[bo_include_head]) { @include ($board[bo_include_head]); }
if ($board[bo_content_head]) { echo stripslashes($board[bo_content_head]); } 

$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";

include_once("$member_skin_path/password.skin.php");

if ($board[bo_content_tail]) { echo stripslashes($board[bo_content_tail]); } 
if ($board[bo_include_tail]) { @include ($board[bo_include_tail]); }

include_once("$g4[path]/tail.sub.php");
?>
