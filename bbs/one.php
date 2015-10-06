<?
include_once("_common.php");

if (!$is_member)
    goto_url("login.php?url=".urlencode("one.php"));

$oneboard = sql_fetch(" select * from $g4[oneboard_table] where ob_table = '$ob_table' ");
if (!$oneboard[ob_table])
    alert("존재하는 1:1 게시판이 아닙니다.");

if ($member[mb_level] < $oneboard[ob_write_level])
    alert("회원 권한 {$oneboard[ob_write_level]} 이상 접근이 가능합니다.");

if ($oneboard[ob_admin] && $oneboard[ob_admin]==$member[mb_admin])
    $is_admin = true;

$g4[title] = $oneboard[ob_subject];

$width = $oneboard[ob_table_width];
if ($width <= 100) $width .= '%';

$is_dhtml_editor = $oneboard[ob_use_dhtml_editor];

$oneboard_skin_path = "$g4[path]/skin/oneboard/$oneboard[ob_skin]";

if (isset($w)) {
    if (!($w=='i' || $w=='u')) {
        alert('입력 또는 수정만 가능합니다.');
    }

    if ($w=='u') {
        $sql = " select * from $g4[one_prefix]$ob_table where on_id = '$on_id' ";
        $one = sql_fetch($sql);
        
        if (!$is_admin) {
            if ($one[mb_no] != $member[mb_no])
                alert("자신의 글만 수정이 가능합니다.");
        }
    }
} else if ($on_id) {
    set_session("ss_one_{$ob_table}", $on_id);

    $sql = " select * from $g4[one_prefix]$ob_table where on_id = '$on_id' ";
    $one = sql_fetch($sql);
    if (!$is_admin) {
        if ($one[mb_no] != $member[mb_no])
            alert("자신의 글만 확인이 가능합니다.");
    }
}

include_once("$g4[path]/head.sub.php");

// 게시판 관리의 상단 파일 경로
if ($oneboard[ob_include_head]) 
    @include ($oneboard[ob_include_head]); 

// 게시판 관리의 상단 이미지 경로
if ($oneboard[ob_image_head]) 
    echo "<img src='$g4[path]/data/one/$ob_table/$oneboard[ob_image_head]' border='0'>";

// 게시판 관리의 상단 내용
if ($oneboard[ob_content_head]) 
    echo stripslashes($oneboard[ob_content_head]); 



if (isset($w)) {
    if ($board[ob_write_level] > $member[mb_level]) 
        alert("회원 레벨 {$board[ob_write_level]} 이상 글쓰기가 가능합니다.");

    include_once("oneform.php");
} else if ($on_id) {
    include_once("oneview.php");
} else {
    include_once("onelist.php"); 
}



// 게시판 관리의 하단 내용
if ($oneboard[ob_content_tail]) 
    echo stripslashes($oneboard[ob_content_tail]); 

// 게시판 관리의 하단 이미지 경로
if ($oneboard[ob_image_tail]) 
    echo "<img src='$g4[path]/data/one/$ob_table/$oneboard[ob_image_tail]' border='0'>";

// 게시판 관리의 하단 파일 경로
if ($oneboard[ob_include_tail]) 
    @include ($oneboard[ob_include_tail]); 

include_once("$g4[path]/tail.sub.php");
?>