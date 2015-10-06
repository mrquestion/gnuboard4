<?
// 코멘트 삭제
include_once("./_common.php");

$write = sql_fetch(" select * from $write_table where wr_id = '$comment_id' ");

if (!$write[wr_id] || $write[wr_comment] > -1)
    alert("등록된 코멘트가 없거나 코멘트 글이 아닙니다.");

if ($is_admin == "super") // 최고관리자 통과
    ;
else if ($is_admin == "group") { // 그룹관리자
    $mb = get_member($write[mb_id]);
    if ($member[mb_id] == $group[gr_admin]) { // 자신이 관리하는 그룹인가?
        if ($member[mb_level] >= $mb[mb_level]) // 자신의 레벨이 크거나 같다면 통과
            ;
        else
            alert("그룹관리자의 권한보다 높은 회원의 코멘트이므로 삭제할 수 없습니다.");
    } else
        alert("자신이 관리하는 그룹의 게시판이 아니므로 코멘트를 삭제할 수 없습니다.");
} else if ($is_admin == "board") { // 게시판관리자이면
    $mb = get_member($write[mb_id]);
    if ($member[mb_id] == $board[bo_admin]) { // 자신이 관리하는 게시판인가?
        if ($member[mb_level] >= $mb[mb_level]) // 자신의 레벨이 크거나 같다면 통과
            ;
        else
            alert("게시판관리자의 권한보다 높은 회원의 코멘트이므로 삭제할 수 없습니다.");
    } else
        alert("자신이 관리하는 게시판이 아니므로 코멘트를 삭제할 수 없습니다.");
} else if ($member[mb_id]) {
    if ($member[mb_id] != $write[mb_id])
        alert("자신의 글이 아니므로 삭제할 수 없습니다.");
} else {
    if (sql_password($wr_password) != $write[wr_password])
        alert("패스워드가 틀립니다.");
}

$len = strlen($write[wr_comment_reply]);
if ($len < 0) $len = 0; 
$comment_reply = substr($write[wr_comment_reply], 0, $len);

$sql = " select count(*) as cnt from $write_table
          where wr_comment_reply like '$comment_reply%'
            and wr_id <> '$comment_id'
            and wr_parent = '$write[wr_parent]'
            and wr_comment = '$write[wr_comment]' ";
$row = sql_fetch($sql);
if ($row[cnt] && !$is_admin)
    alert("이 코멘트와 관련된 답변코멘트가 존재하므로 삭제 할 수 없습니다.");

// 코멘트 삭제
if (!delete_point($write[mb_id], $bo_table, $comment_id, '코멘트'))
    insert_point($write[mb_id], $board[bo_comment_point] * (-1), "$board[bo_subject] {$write[wr_parent]}-{$comment_id} 코멘트삭제");

// 코멘트 삭제
sql_query(" delete from $write_table where wr_id = '$comment_id' ");
                                      
// 원글의 코멘트 숫자를 감소
sql_query(" update $write_table set wr_comment = wr_comment - 1 where wr_id = '$write[wr_parent]' ");

// 코멘트 숫자 감소
sql_query(" update $g4[board_table] set bo_count_comment = bo_count_comment - 1 where bo_table = '$bo_table' ");

// 새글 삭제
sql_query(" delete from $g4[board_new_table] where bo_table = '$bo_table' and wr_id = '$comment_id' ");

// 사용자 코드 실행
@include_once("$board_skin_path/delete_comment.skin.php");

goto_url("./board.php?bo_table=$bo_table&wr_id=$write[wr_parent]&page=$page" . $qstr);
?>
