<?
include_once("./_common.php");
include_once("$g4[path]/lib/trackback.lib.php");

$g4[title] = $wr_subject . "코멘트입력";

$w = $_POST["w"];
$wr_name  = strip_tags($_POST["wr_name"]);
$wr_email = strip_tags($_POST["wr_email"]);

if ($w == "c" || $w == "cu") 
{
    if ($member[mb_level] < $board[bo_comment_level]) 
        alert("코멘트를 쓸 권한이 없습니다.");
} 
else
    alert("w 값이 제대로 넘어오지 않았습니다."); 

// 세션의 시간 검사
if ($_SESSION["ss_datetime"] >= ($g4[server_time] - $config[cf_delay_sec]) && !$is_admin) 
    alert("너무 빠른 시간내에 게시물을 연속해서 올릴 수 없습니다.");

set_session("ss_datetime", $g4[server_time]);

// 동일내용 연속 등록 불가
$row = sql_fetch(" select MD5(CONCAT(wr_ip, wr_subject, wr_content)) as prev_md5 from $write_table where wr_comment = -1 order by wr_id desc limit 1 ");
$curr_md5 = md5($_SERVER[REMOTE_ADDR].$wr_subject.$wr_content);
if ($row[prev_md5] == $curr_md5 && !$is_admin)
    alert("동일한 내용을 연속해서 등록할 수 없습니다.");

$wr = get_write($write_table, $wr_id);
if (!$wr[wr_id]) 
    alert("글이 존재하지 않습니다.\\n\\n글이 삭제되었거나 이동하였을 수 있습니다."); 

// 자동등록방지 검사
include_once ("./norobot_check.inc.php");

// "인터넷옵션 > 보안 > 사용자정의수준 > 스크립팅 > Action 스크립팅 > 사용 안 함" 일 경우의 오류 처리
// 이 옵션을 사용 안 함으로 설정할 경우 어떤 스크립트도 실행 되지 않습니다.
//if (!trim($_POST["wr_content"])) die ("내용을 입력하여 주십시오.");

if ($member[mb_id]) 
{
    $mb_id = $member[mb_id];
    $wr_name = $member[mb_nick];
    $wr_password = $member[mb_password];
    $wr_email = $member[mb_email];
    $wr_homepage = $member[mb_homepage];
} 
else 
{
    $mb_id = "";
    $wr_password = sql_password($wr_password);
}

if ($w == "c") // 코멘트 입력
{
    if ($member[mb_point] + $board[bo_comment_point] < 0 && !$is_admin)
        alert("보유하신 포인트(".number_format($member[mb_point]).")가 없거나 모자라서 코멘트쓰기(".number_format($board[bo_comment_point]).")가 불가합니다.\\n\\n포인트를 적립하신 후 다시 코멘트를 써 주십시오.");

    // 코멘트 답변
    if ($comment_id) 
    {
        $sql = " select wr_id, wr_comment, wr_comment_reply from $write_table 
                  where wr_id = '$comment_id' ";
        $reply_array = sql_fetch($sql);
        if (!$reply_array[wr_id])
            alert("답변할 코멘트가 없습니다.\\n\\n답변하는 동안 코멘트가 삭제되었을 수 있습니다.");

        $tmp_comment = $reply_array[wr_comment];

        if (strlen($reply_array[wr_comment_reply]) == 5)
            alert("더 이상 답변하실 수 없습니다.\\n\\n답변은 5단계 까지만 가능합니다.");

        $reply_len = strlen($reply_array[wr_comment_reply]) + 1;
        if ($board[bo_reply_order]) {
            $begin_reply_char = "A";
            $end_reply_char = "Z";
            $reply_number = +1;
            $sql = " select MAX(SUBSTRING(wr_comment_reply, $reply_len, 1)) as reply 
                       from $write_table 
                      where wr_parent = '$wr_id' 
                        and wr_comment = '$tmp_comment'
                        and SUBSTRING(wr_comment_reply, $reply_len, 1) <> '' ";
        } 
        else 
        {
            $begin_reply_char = "Z";
            $end_reply_char = "A";
            $reply_number = -1;
            $sql = " select MIN(SUBSTRING(wr_comment_reply, $reply_len, 1)) as reply 
                       from $write_table 
                      where wr_parent = '$wr_id' 
                        and wr_comment = '$tmp_comment'
                       and SUBSTRING(wr_comment_reply, $reply_len, 1) <> '' ";
        }
        if ($reply_array[wr_comment_reply]) 
            $sql .= " and wr_comment_reply like '$reply_array[wr_comment_reply]%' ";
        $row = sql_fetch($sql);

        if (!$row[reply])
            $reply_char = $begin_reply_char;
        else if ($row[reply] == $end_reply_char) // A~Z은 26 입니다.
            alert("더 이상 답변하실 수 없습니다.\\n\\n답변은 26개 까지만 가능합니다.");
        else
            $reply_char = chr(ord($row[reply]) + $reply_number);

        $tmp_comment_reply = $reply_array[wr_comment_reply] . $reply_char;
    }
    else 
    {
        $sql = " select min(wr_comment) as max_comment from $write_table 
                  where wr_parent = '$wr_id' and wr_comment < 0 ";
        $row = sql_fetch($sql);
        $row[max_comment] -= 1;
        $tmp_comment = $row[max_comment];
        $tmp_comment_reply = "";
    }

    $sql = " insert into $write_table
                set ca_name = '$wr[ca_name]',
                    wr_option = '',
                    wr_num = '$wr[wr_num]',
                    wr_reply = '',
                    wr_parent = '$wr_id',
                    wr_comment = '$tmp_comment',
                    wr_comment_reply = '$tmp_comment_reply',
                    wr_subject = '$wr_subject',
                    wr_content = '$wr_content',
                    mb_id = '$mb_id',
                    wr_password = '$wr_password',
                    wr_name = '$wr_name',
                    wr_email = '$wr_email',
                    wr_homepage = '$wr_homepage',
                    wr_datetime = '$g4[time_ymdhis]',
                    wr_ip = '$_SERVER[REMOTE_ADDR]',
                    wr_1 = '$wr_1',
                    wr_2 = '$wr_2',
                    wr_3 = '$wr_3',
                    wr_4 = '$wr_4',
                    wr_5 = '$wr_5',
                    wr_6 = '$wr_6',
                    wr_7 = '$wr_7',
                    wr_8 = '$wr_8',
                    wr_9 = '$wr_9',
                    wr_10 = '$wr_10' ";
    sql_query($sql);

    $comment_id = mysql_insert_id();

    // 원글에 코멘트수 증가
    sql_query(" update $write_table set wr_comment = wr_comment + 1 where wr_id = '$wr_id' ");

    // 새글 INSERT
    sql_query(" insert into $g4[board_new_table] ( bo_table, wr_id, wr_parent, bn_datetime ) values ( '$bo_table', '$comment_id', '$wr_id', '$g4[time_ymdhis]' ) ");

    // 코멘트 1 증가
    sql_query(" update $g4[board_table] set bo_count_comment = bo_count_comment + 1 where bo_table = '$bo_table' ");

    // 포인트 부여
    insert_point($member[mb_id], $board[bo_comment_point], "$board[bo_subject] {$wr_id}-{$comment_id} 코멘트쓰기");

    // 메일발송
    {
        // 게시판 관리자의 정보를 얻고
        $admin = get_admin("board");

        $wr_subject = get_text(stripslashes($wr[wr_subject]));
        $wr_content = nl2br(get_text(stripslashes("----- 원글 -----\n\n$wr[wr_subject]\n\n\n----- 코멘트 -----\n\n$wr_content")));

        $warr = array( ""=>"입력", "u"=>"수정", "r"=>"답변", "c"=>"코멘트", "cu"=>"코멘트 수정" );
        $str = $warr[$w];

        $subject = "'{$board[bo_subject]}' 게시판에 {$str}글이 올라왔습니다.";
        $link_url = "$g4[url]/$g4[bbs]/board.php?bo_table=$bo_table&wr_id=$wr_id&$qstr";

        include_once("$g4[path]/lib/mailer.lib.php");

        ob_start();
        include_once ("./write_update_mail.php");
        $content = ob_get_contents();
        ob_end_clean();

        // 관리자에게 보내는 메일
        if ($wr_email != $admin[mb_email])
            mailer($wr_name, $wr_email, $admin[mb_email], $subject, $content, 1);

        // 답변 메일받기 (원게시자에게 보내는 메일)
        if ($wr[wr_recv_email] && $wr[wr_email] && $wr[wr_email] != $admin[mb_email]) 
        {
            mailer($wr_name, $wr_email, $wr[wr_email], $subject, $content, 1);

            // 코멘트 쓴 모든이에게 메일 발송
            if ($config[cf_comment_all_email]) 
            {
                $sql = " select distinct wr_email from $write_table
                          where wr_email not in ( '$wr[wr_email]', '' )
                            and wr_parent = '$wr_id' ";
                $result = sql_query($sql);
                while ($row=sql_fetch_array($result))
                    mailer($wr_name, $wr_email, $row[wr_email], $subject, $content, 1);
            }
        }
    }
} 
else if ($w == "cu") // 코멘트 수정
{ 
    $sql = " select wr_comment, wr_comment_reply from $write_table 
              where wr_id = '$comment_id' ";
    $reply_array = sql_fetch($sql);
    $tmp_comment = $reply_array[wr_comment];

    $len = strlen($reply_array[wr_comment_reply]);
    if ($len < 0) $len = 0; 
    $comment_reply = substr($reply_array[wr_comment_reply], 0, $len);

    $sql = " select count(*) as cnt from $write_table
              where wr_comment_reply like '$comment_reply%'
                and wr_id <> '$comment_id'
                and wr_parent = '$wr_id'
                and wr_comment = '$tmp_comment' ";
    $row = sql_fetch($sql);
    if ($row[cnt] && !$is_admin)
        alert("이 코멘트와 관련된 답변코멘트가 존재하므로 수정 할 수 없습니다.");

    $sql = " update $write_table
                set wr_subject = '$wr_subject',
                    wr_content = '$wr_content',
                    wr_ip = '$_SERVER[REMOTE_ADDR]',
                    wr_1 = '$wr_1',
                    wr_2 = '$wr_2',
                    wr_3 = '$wr_3',
                    wr_4 = '$wr_4',
                    wr_5 = '$wr_5',
                    wr_6 = '$wr_6',
                    wr_7 = '$wr_7',
                    wr_8 = '$wr_8',
                    wr_9 = '$wr_9',
                    wr_10 = '$wr_10'
              where wr_id = '$comment_id' ";
    sql_query($sql);
}

// 사용자 코드 실행
@include_once("$board_skin_path/write_comment_update.skin.php");

goto_url("./board.php?bo_table=$bo_table&wr_id=$wr[wr_parent]&page=$page" . $qstr . "&cwin=$cwin");
?>
