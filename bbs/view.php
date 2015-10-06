<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

@include_once("$board_skin_path/view.head.skin.php");

$sql_search = "";
// 검색이면
if ($sca || $stx) {
    // where 문을 얻음
    $sql_search = get_sql_search($sca, $sfl, $stx, $sop);
    $search_href = "./board.php?bo_table=$bo_table&page=$page" . $qstr;
    $list_href = "./board.php?bo_table=$bo_table";
} else {
    $search_href = "";
    $list_href = "./board.php?bo_table=$bo_table&page=$page";
}

if (!$board[bo_use_list_view]) {
    if ($sql_search)
        $sql_search = " and " . $sql_search;

    // 윗글을 얻음
    $sql = " select wr_id, wr_subject from $write_table where wr_is_comment = 0 and wr_num = '$write[wr_num]' and wr_reply < '$write[wr_reply]' $sql_search order by wr_num desc, wr_reply desc limit 1 ";
    $prev = sql_fetch($sql);
    // 위의 쿼리문으로 값을 얻지 못했다면
    if (!$prev[wr_id])     {
        $sql = " select wr_id, wr_subject from $write_table where wr_is_comment = 0 and wr_num < '$write[wr_num]' $sql_search order by wr_num desc, wr_reply desc limit 1 ";
        $prev = sql_fetch($sql);
    }

    // 아래글을 얻음
    $sql = " select wr_id, wr_subject from $write_table where wr_is_comment = 0 and wr_num = '$write[wr_num]' and wr_reply > '$write[wr_reply]' $sql_search order by wr_num, wr_reply limit 1 ";
    $next = sql_fetch($sql);
    // 위의 쿼리문으로 값을 얻지 못했다면
    if (!$next[wr_id]) {
        $sql = " select wr_id, wr_subject from $write_table where wr_is_comment = 0 and wr_num > '$write[wr_num]' $sql_search order by wr_num, wr_reply limit 1 ";
        $next = sql_fetch($sql);
    }
}

// 이전글 링크
$prev_href = "";
if ($prev[wr_id]) {
    $prev_wr_subject = get_text(cut_str($prev[wr_subject], 255));
    $prev_href = "./board.php?bo_table=$bo_table&wr_id=$prev[wr_id]&page=$page" . $qstr;
}

// 다음글 링크
$next_href = "";
if ($next[wr_id]) {
    $next_wr_subject = get_text(cut_str($next[wr_subject], 255));
    $next_href = "./board.php?bo_table=$bo_table&wr_id=$next[wr_id]&page=$page" . $qstr;
}

// 쓰기 링크
$write_href = "";
if ($member[mb_level] >= $board[bo_write_level]) 
    $write_href = "./write.php?bo_table=$bo_table";

// 답변 링크
$reply_href = "";
if ($member[mb_level] >= $board[bo_reply_level]) 
    $reply_href = "./write.php?w=r&bo_table=$bo_table&wr_id=$wr_id" . $qstr;

// 수정, 삭제 링크
$update_href = $delete_href = "";
// 로그인중이고 자신의 글이라면 또는 관리자라면 패스워드를 묻지 않고 바로 수정, 삭제 가능
if (($member[mb_id] && ($member[mb_id] == $write[mb_id])) || $is_admin) {
    $update_href = "./write.php?w=u&bo_table=$bo_table&wr_id=$wr_id&page=$page" . $qstr;
    $delete_href = "javascript:del('./delete.php?bo_table=$bo_table&wr_id=$wr_id&page=$page".urldecode($qstr)."');";
} 
else if (!$write[mb_id]) { // 회원이 쓴 글이 아니라면
    $update_href = "./password.php?w=u&bo_table=$bo_table&wr_id=$wr_id&page=$page" . $qstr;
    $delete_href = "./password.php?w=d&bo_table=$bo_table&wr_id=$wr_id&page=$page" . $qstr;
}

// 최고, 그룹관리자라면 글 복사, 이동 가능
$copy_href = $move_href = "";
if ($write[wr_reply] == "" && ($is_admin == "super" || $is_admin == "group")) {
    $copy_href = "javascript:win_open('./move.php?sw=copy&bo_table=$bo_table&wr_id=$wr_id&page=$page".$qstr."', 'boardcopy', 'left=50, top=50, width=500, height=550, scrollbars=1');";
    $move_href = "javascript:win_open('./move.php?sw=move&bo_table=$bo_table&wr_id=$wr_id&page=$page".$qstr."', 'boardmove', 'left=50, top=50, width=500, height=550, scrollbars=1');";
}

$scrap_href = "";
$good_href = "";
$nogood_href = "";
if ($member[mb_id]) {
    // 스크랩 링크
    $scrap_href = "./scrap_popin.php?bo_table=$bo_table&wr_id=$wr_id";

    // 추천 링크
    if ($board[bo_use_good]) 
        $good_href = "./good.php?bo_table=$bo_table&wr_id=$wr_id&good=good";

    // 비추천 링크
    if ($board[bo_use_nogood]) 
        $nogood_href = "./good.php?bo_table=$bo_table&wr_id=$wr_id&good=nogood";
}

$view = get_view($write, $board, $board_skin_path, 255);

if (strstr($sfl, "subject"))
    $view[subject] = search_font($stx, $view[subject]);

$html = 0;
if (strstr($view[wr_option], "html1"))
    $html = 1;
else if (strstr($view[wr_option], "html2"))
    $html = 2;

$view[content] = conv_content($view[wr_content], $html);
if (strstr($sfl, "content"))
    $view[content] = search_font($stx, $view[content]);
$view[content] = preg_replace("/(\<img )([^\>]*)(\>)/i", "\\1 name='target_resize_image[]' onclick='image_window(this)' style='cursor:pointer;' \\2 \\3", $view[content]);

//$view[rich_content] = preg_replace("/{img\:([0-9]+)[:]?([^}]*)}/ie", "view_image(\$view, '\\1', '\\2')", $view[content]);
$view[rich_content] = preg_replace("/{이미지\:([0-9]+)[:]?([^}]*)}/ie", "view_image(\$view, '\\1', '\\2')", $view[content]);

// 트랙백
$trackback_url = "";
if ($member[mb_level] >= $board[bo_trackback_level]) {
    if (isset($g4['token_time']) == false)
        $g4['token_time'] = 3; 
    $trackback_url = "$g4[url]/$g4[bbs]/tb.php/$bo_table/$wr_id";
}

$is_signature = false;
$signature = "";
if ($board[bo_use_signature] && $view[mb_id])
{
    $is_signature = true;
    $mb = get_member($view[mb_id]);
    $signature = $mb[mb_signature];

    //$signature = bad_tag_convert($signature);
    // 081022 : CSRF 보안 결함으로 인한 코드 수정
    $signature = conv_content($signature, 1);
}

echo "<script type='text/javascript' src='{$g4['path']}/js/ajax.js'></script>";
include_once("$board_skin_path/view.skin.php");

@include_once("$board_skin_path/view.tail.skin.php");
?>
