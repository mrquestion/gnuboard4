<?
if (!defined('_GNUBOARD_')) exit;

/*************************************************************************
**
**  일반 함수 모음
**
*************************************************************************/

// 마이크로 타임을 얻어 계산 형식으로 만듦
function get_microtime()
{
    list($usec, $sec) = explode(" ",microtime());
    return ((float)$usec + (float)$sec);
}


// 현재페이지, 총페이지수, 한페이지에 보여줄 행, URL
function get_paging($write_pages, $cur_page, $total_page, $url)
{
    $str = "";
    if ($cur_page > 1) {
        $str .= "<a href='" . $url . "1'>처음</a>";
        //$str .= "[<a href='" . $url . ($cur_page-1) . "'>이전</a>]";
    }

    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;

    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1) $str .= " &nbsp;<a href='" . $url . ($start_page-1) . "'>이전</a>";

    if ($total_page > 1) {
        for ($k=$start_page;$k<=$end_page;$k++) {
            if ($cur_page != $k)
                $str .= " &nbsp;<a href='$url$k'><span>$k</span></a>";
            else
                $str .= " &nbsp;<b>$k</b> ";
        }
    }

    if ($total_page > $end_page) $str .= " &nbsp;<a href='" . $url . ($end_page+1) . "'>다음</a>";

    if ($cur_page < $total_page) {
        //$str .= "[<a href='$url" . ($cur_page+1) . "'>다음</a>]";
        $str .= " &nbsp;<a href='$url$total_page'>맨끝</a>";
    }
    $str .= "";

    return $str;
}


// 변수 또는 배열의 이름과 값을 얻어냄. print_r() 함수의 변형
function print_r2($var)
{
    ob_start();
    print_r($var);
    $str = ob_get_contents();
    ob_end_clean();
    $str = preg_replace("/ /", "&nbsp;", $str);
    echo nl2br("<span style='font-family:Tahoma, 굴림; font-size:9pt;'>$str</span>");
}


// 메타태그를 이용한 URL 이동
// header("location:URL") 을 대체
function goto_url($url)
{
    if (preg_match("/MSIE/", $_SERVER[HTTP_USER_AGENT]))
        echo "<meta http-equiv='Refresh' content='0;url=$url'>";
    else
        echo "<script language='JavaScript'> document.location.href = '$url'; </script>";
    //header("Location:$url");
    //flush();
    //if (!headers_sent())
    //    header("Location:$url");
    //else
    //echo "<script language='JavaScript'> document.location.href = '$url'; </script>";
    exit;
}


// 세션변수 생성
function set_session($session_name, $value)
{
    session_register($session_name);
    // PHP 버전별 차이를 없애기 위한 방법
    $$session_name = $_SESSION["$session_name"] = $value;
}


// 세션변수값 얻음
function get_session($session_name)
{
    return $_SESSION[$session_name];
}


// 쿠키변수 생성
function set_cookie($cookie_name, $value, $expire)
{
    global $g4;

    setcookie(md5($cookie_name), base64_encode($value), $g4[server_time] + $expire, '/', $g4[cookie_domain]);
}


// 쿠키변수값 얻음
function get_cookie($cookie_name)
{
    return base64_decode($_COOKIE[md5($cookie_name)]);
}


// 경고메세지를 경고창으로
function alert($msg, $url='')
{
    if (!$msg) $msg = '올바른 방법으로 이용해 주십시오.';

    echo "<script language='javascript'>alert('$msg');";
    if (!$url)
        echo "history.go(-1);";
    echo "</script>";
    if ($url)
        echo "<meta http-equiv='refresh' content='0;url=$url'>";
    exit;
}


// 경고메세지 출력후 창을 닫음
function alert_close($msg)
{
    echo "<script language='javascript'> alert('$msg'); window.close(); </script>";
    exit;
}


// way.co.kr 의 wayboard 참고
function url_auto_link($str)
{
    global $config;

    // 속도 향샹 031011
    $str = preg_replace("/&lt;/", "\t_lt_\t", $str);
    $str = preg_replace("/&gt;/", "\t_gt_\t", $str);
    $str = preg_replace("/&amp;/", "&", $str);
    $str = preg_replace("/&quot;/", "\"", $str);
    $str = preg_replace("/([^(http:\/\/)]|\(|^)(www\.[^[:space:]]+)/i", "\\1<A HREF=\"http://\\2\" TARGET='$config[cf_link_target]'>\\2</A>", $str);
    $str = preg_replace("/([^(HREF=\"?'?)|(SRC=\"?'?)]|\(|^)((http|https|ftp|telnet|news|mms):\/\/[a-zA-Z0-9\.-]+\.[\xA1-\xFEa-zA-Z0-9\.:&#=_\?\/~\+%@;\-\|\,]+)/i", "\\1<A HREF=\"\\2\" TARGET='$config[cf_link_target]'>\\2</A>", $str);
    $str = preg_replace("/(([a-z0-9_]|\-|\.)+@([^[:space:]]*)([[:alnum:]-]))/i", "<a href='mailto:\\1'>\\1</a>", $str);
    $str = preg_replace("/\t_lt_\t/", "&lt;", $str);
    $str = preg_replace("/\t_gt_\t/", "&gt;", $str);

    return $str;
}


// url에 http:// 를 붙인다
function set_http($url)
{
    if (!trim($url)) return;

    // 3.32
    //if (!eregi("^(http|https)://", $url))
    if (!eregi("^(http|https|ftp|telnet|news|mms)://", $url))
        $url = "http://" . $url;

    return $url;
}


// 파일의 용량을 구한다.
function get_filesize($file)
{
    $size = @filesize(addslashes($file));
    if ($size >= 1024768) {
        $size = number_format($size/1024768, 1) . "M";
    } else if ($size >= 1024) {
        $size = number_format($size/1024, 1) . "K";
    } else {
        $size = number_format($size, 0) . "byte";
    }
    return $size;
}


// 게시글에 첨부된 파일을 얻는다. (배열로 반환)
function get_file($bo_table, $wr_id)
{
    global $g4, $qstr;

    $file["count"] = 0;
    $sql = " select * from $g4[board_file_table] where bo_table = '$bo_table' and wr_id = '$wr_id' order by bf_no ";
    $result = sql_query($sql);
    while ($row = sql_fetch_array($result))
    {
        $no = $row[bf_no];
        $file[$no][href] = "./download.php?bo_table=$bo_table&wr_id=$wr_id&no=$no" . $qstr;
        $file[$no][download] = $row[bf_download];
        // 4.00.11 - 파일 path 추가
        $file[$no][path] = "$g4[path]/data/file/$bo_table";
        $file[$no][size] = get_filesize("{$file[$no][path]}/$row[bf_file]");
        $file[$no][datetime] = date("Y-m-d H:i:s", @filemtime("$g4[path]/data/file/$bo_table/$row[bf_file]"));
        $file[$no][source] = $row[bf_source];
        $file[$no][bf_content] = $row[bf_content];
        $file[$no][content] = get_text($row[bf_content]);
        $file[$no][view] = view_file_link($row[bf_file], $file[$no][content]);
        $file[$no][file] = $row[bf_file];
        // prosper 님 제안
        $file[$no][imgsize] = @getimagesize("{$file[$no][path]}/$row[bf_file]");
        $file["count"]++;
    }

    return $file;
}


// 폴더의 용량 ($dir는 / 없이 넘기세요)
function get_dirsize($dir)
{
    $size = 0;
    $d = dir($dir);
    while ($entry = $d->read()) {
        if ($entry != "." && $entry != "..") {
            $size += filesize("$dir/$entry");
        }
    }
    $d->close();
    return $size;
}


/*************************************************************************
**
**  그누보드 관련 함수 모음
**
*************************************************************************/


// 게시물 정보($write_row)를 출력하기 위하여 $list로 가공된 정보를 복사 및 가공
function get_list($write_row, $board, $skin_path, $subject_len=40)
{
    global $g4, $config;
    global $qstr, $page;

    //$t = get_microtime();

    // 배열전체를 복사
    $list = $write_row;
    unset($write_row);

    $list[is_notice] = preg_match("/[^0-9]{0,1}{$list[wr_id]}[\r]{0,1}/",$board[bo_notice]);

    //$list[num] = number_format($total_count - ($page - 1) * $board[bo_page_rows] - $i);

    if ($subject_len)
        $list[subject] = conv_subject($list[wr_subject], $subject_len, "…");
    else
        $list[subject] = conv_subject($list[wr_subject], $board[bo_subject_len], "…");

    // 목록에서 내용 미리보기 사용한 게시판만 내용을 변환함 (속도 향상) : kkal3(커피)님께서 알려주셨습니다.
    if ($board[bo_use_list_content])
        $list[content] = conv_content($list[wr_content], $list[wr_html]);

    $list[comment_cnt] = "";
    if ($list[wr_comment])
    {
        $list[comment_cnt] = "($list[wr_comment])";

        if ($list[wr_last_comment] >= date("Y-m-d H:i:s", $g4[server_time] - ($board[bo_new] * 3600)))
            $list[comment_cnt] = '<b>' . $list[comment_cnt] . '</b>';
    }

    $list[datetime] = substr($list[wr_datetime],0,10);

    // 당일인 경우 시간으로 표시함
    $list[datetime2] = $list[wr_datetime];
    if ($list[datetime] == $g4[time_ymd])
        $list[datetime2] = substr($list[datetime2],11,5);
    else
        $list[datetime2] = substr($list[datetime2],5,5);

    //$list[wr_email] = get_text($list[wr_email]);
    $list[wr_homepage] = get_text(addslashes($list[wr_homepage]));

    $tmp_name = get_text(cut_str($list[wr_name], $config[cf_cut_name])); // 설정된 자리수 만큼만 이름 출력
    if ($board[bo_use_sideview])
        $list[name] = get_sideview($list[mb_id], $tmp_name, $list[wr_email], $list[wr_homepage]);
    else
        $list[name] = "<span class='".($list[mb_id]?'member':'guest')."'>$tmp_name</span>";

    //$reply = substr($list[wr_id], 5, 10);
    $reply = $list[wr_reply];

    $list[reply] = "";
    if (strlen($reply) > 0) {
        for ($k=0; $k<strlen($reply); $k++)
            $list[reply] .= ' &nbsp;&nbsp; ';
    }

    $list[icon_reply] = "";
    if ($list[reply])
        $list[icon_reply] = "<img src='$skin_path/img/icon_reply.gif' align='absmiddle'>";

    $list[icon_link] = "";
    if ($list[wr_link1] || $list[wr_link2])
        $list[icon_link] = "<img src='$skin_path/img/icon_link.gif' align='absmiddle'>";

    // 분류명 링크
    $list[ca_name_href] = "$g4[bbs_path]/board.php?bo_table=$board[bo_table]&sca=".urlencode($list[ca_name]);

    $list[href] = "$g4[bbs_path]/board.php?bo_table=$board[bo_table]&wr_id=$list[wr_id]" . $qstr;
    if ($board[bo_use_comment])
        $list[comment_href] = "javascript:win_comment('$g4[bbs_path]/board.php?bo_table=$board[bo_table]&wr_id=$list[wr_id]&cwin=1');";
    else
        $list[comment_href] = $list[href];

    $list[icon_new] = "";
    if ($list[wr_datetime] >= date("Y-m-d H:i:s", $g4[server_time] - ($board[bo_new] * 3600)))
        $list[icon_new] = "<img src='$skin_path/img/icon_new.gif' align='absmiddle'>";

    $list[icon_hot] = "";
    if ($list[wr_hit] >= $board[bo_hot])
        $list[icon_hot] = "<img src='$skin_path/img/icon_hot.gif' align='absmiddle'>";

    $list[icon_secret] = "";
    if (strstr($list[wr_option], "secret"))
        $list[icon_secret] = "<img src='$skin_path/img/icon_secret.gif' align='absmiddle'>";

    // 링크
    for ($i=1; $i<=$g4[link_count]; $i++) {
        $list[link][$i] = set_http(get_text($list["wr_link{$i}"]));
        $list[link_href][$i] = "$g4[bbs_path]/link.php?bo_table=$board[bo_table]&wr_id=$list[wr_id]&no=$i" . $qstr;
        $list[link_hit][$i] = (int)$list["wr_link{$i}_hit"];
    }

    // 가변 파일
    $list[file] = get_file($board[bo_table], $list[wr_id]);

    if ($list[file][count])
        $list[icon_file] = "<img src='$skin_path/img/icon_file.gif' align='absmiddle'>";

    return $list;
}

// get_list 의 alias
function get_view($write_row, $board, $skin_path, $subject_len=125)
{
    return get_list($write_row, $board, $skin_path, $subject_len);
}


// set_search_font(), get_search_font() 함수를 search_font() 함수로 대체
function search_font($stx, $str)
{
    global $config;

    if (!trim($stx)) return $str;

    // 검색어 전체를 공란으로 나눈다
    $s = explode(" ", $stx);

    // "/(검색1|검색2)/i" 와 같은 패턴을 만듬
    $pattern = "";
    $bar = "";
    for ($m=0; $m<count($s); $m++) {
        // 태그는 포함하지 않아야 하는데 잘 안되는군. ㅡㅡa
        //$pattern .= $bar . '([^<])(' . quotemeta($s[$m]) . ')';
        //$pattern .= $bar . quotemeta($s[$m]);
        $pattern .= $bar . str_replace("/", "\/", quotemeta($s[$m]));
        $bar = "|";
    }

    // 지정된 검색 폰트의 색상, 배경색상으로 대체
    $replace = "<span style='background-color:$config[cf_search_bgcolor]; color:$config[cf_search_color];'>\\1</span>";

    return preg_replace("/($pattern)/i", $replace, $str);
}


// 제목을 변환
function conv_subject($subject, $len, $suffix="")
{
    return cut_str(get_text($subject), $len, $suffix);
}


// 내용을 변환
function conv_content($content, $html)
{
    global $config, $board;

    if ($html)
    {
        $source = array();
        $target = array();

        $source[] = "//";
        $target[] = "";

        if ($html == 2) { // 자동 줄바꿈
            $source[] = "/\n/";
            $target[] = "<br/>";
        }

        if ($board[bo_disable_tags])
        {
            $source[] = "/(\<)([\/]?)($board[bo_disable_tags])/";
            $target[] = "$1$2$3-x";
            //$source[] = "/^/";
            //$target[] = "<b>이 페이지는 사용금지 태그 사용으로 인하여 정상 출력되지 않을 수 있습니다.</b><p>";
        }

        // 테이블 태그의 갯수를 세어 테이블이 깨지지 않도록 한다.
        $table_begin_count = substr_count(strtolower($content), "<table");
        $table_end_count = substr_count(strtolower($content), "</table");
        for ($i=$table_end_count; $i<$table_begin_count; $i++)
        {
            $content .= "</table>";
        }

        $content = preg_replace($source, $target, $content);
    }
    else // text 이면
    {
        // & 처리 : &amp; &nbsp; 등의 코드를 정상 출력함
        $content = html_symbol($content);

        // 공백 처리
		//$content = preg_replace("/  /", "&nbsp; ", $content);
		$content = str_replace("  ", "&nbsp; ", $content);
		$content = str_replace("\n ", "\n&nbsp;", $content);

        $content = get_text($content, 1);

        $content = url_auto_link($content);
    }

    return $content;
}


// 검색 구문을 얻는다.
//function get_sql_search($search_ca_name, $search_field, $search_text, $search_operator=false)
function get_sql_search($search_ca_name, $search_field, $search_text, $search_operator='and')
{
    global $g4;

    $str = "";
    if ($search_ca_name)
        $str = " ca_name = '$search_ca_name' ";

    $search_text = trim($search_text);

    if (!$search_text)
        return $str;

    if ($str)
        $str .= " and ";

    // 쿼리의 속도를 높이기 위하여 ( ) 는 최소화 한다.
    $op1 = "";

    // 검색어를 구분자로 나눈다. 여기서는 공백
    $s = array();
    $s = explode(" ", trim($search_text));

    // 검색필드를 구분자로 나눈다. 여기서는 +
    $field = array();
    $field = explode("+", trim($search_field));

    $str .= " ( ";
    for ($i=0; $i<count($s); $i++) {
        // 검색어
        if (preg_match("/[a-zA-Z]/", $s[$i]))
            $search_str = strtolower($s[$i]);
        else
            $search_str = $s[$i];

        // 인기검색어
        $sql = " insert into $g4[popular_table]
                    set pp_word = '$search_str',
                        pp_date = '$g4[time_ymd]',
                        pp_ip = '$_SERVER[REMOTE_ADDR]' ";
        sql_query($sql, FALSE);

        $str .= " " . $op1 . " ";
        $str .= " ( ";

        $op2 = "";
        for ($k=0; $k<count($field); $k++) { // 필드의 수만큼 다중 필드 검색 가능 (필드1+필드2...)
            $str .= " $op2 ";
            switch ($field[$k]) {
                case "mb_id" :
                    $str .= " $field[$k] = '$s[$i]' ";
                    break;
                case "mb_name" :
                    $str .= " $field[$k] like '%$s[$i]' ";
                    break;
                case "wr_hit" :
                case "wr_good" :
                case "wr_nogood" :
                    $str .= " $field[$k] >= '$s[$i]' ";
                    break;
                // 번호는 해당 검색어에 -1 을 곱함
                case "wr_num" :
                    $str .= " $field[$k] = ".((-1)*$s[$i]);
                    break;
                // LIKE 보다 INSTR 속도가 빠름
                default :
                    if (preg_match("/[a-zA-Z]/", $search_str))
                        $str .= " INSTR(LOWER($field[$k]), '$search_str') > 0 ";
                    else
                        $str .= " INSTR($field[$k], '$search_str') > 0 ";
                    break;
            }
            $op2 = " or ";
        }
        $str .= " ) ";

        //$op1 = ($search_operator) ? ' and ' : ' or ';
        $op1 = $search_operator;
    }
    $str .= " ) ";

    return $str;
}


// 게시판 테이블에서 하나의 행을 읽음
function get_write($write_table, $wr_id)
{
    return sql_fetch(" select * from $write_table where wr_id = '$wr_id' ");
}


// 게시판의 다음글 번호를 얻는다.
function get_next_num($table)
{
    // 가장 작은 번호를 얻어
    $sql = " select min(wr_num) as min_wr_num from $table ";
    $row = sql_fetch($sql);
    // 가장 작은 번호에 1을 빼서 넘겨줌
    return (int)($row[min_wr_num] - 1);
}


// 그룹 설정 테이블에서 하나의 행을 읽음
function get_group($gr_id)
{
    global $g4;

    return sql_fetch(" select * from $g4[group_table] where gr_id = '$gr_id' ");
}


// 회원 정보를 얻는다.
function get_member($mb_id, $fields='*')
{
    global $g4;

    return sql_fetch(" select $fields from $g4[member_table] where mb_id = TRIM('$mb_id') ");
}


// 날짜, 조회수의 경우 높은 순서대로 보여져야 하므로 $flag 를 추가
// $flag : asc 낮은 순서 , desc 높은 순서
// 제목별로 컬럼 정렬하는 QUERY STRING
function subject_sort_link($col, $query_string='', $flag='asc')
{
    global $sst, $sod, $sfl, $stx, $page;

    $q1 = "sst=$col";
    if ($flag == 'asc')
    {
        $q2 = 'sod=asc';
        if ($sst == $col)
        {
            if ($sod == 'asc')
            {
                $q2 = 'sod=desc';
            }
        }
    }
    else
    {
        $q2 = 'sod=desc';
        if ($sst == $col)
        {
            if ($sod == 'desc')
            {
                $q2 = 'sod=asc';
            }
        }
    }

    return "<a href='$_SERVER[PHP_SELF]?$query_string&$q1&$q2&sfl=$sfl&stx=$stx&page=$page'>";
}


// 관리자 정보를 얻음
function get_admin($admin='super')
{
    global $config, $group, $board;
    global $g4;

    $is = false;
    if ($admin == 'board') {
        $mb = sql_fetch("select * from $g4[member_table] where mb_id in ('$board[bo_admin]') limit 1 ");
        $is = true;
    }

    if (($is && !$mb[mb_id]) || $admin == 'group') {
        $mb = sql_fetch("select * from $g4[member_table] where mb_id in ('$group[gr_admin]') limit 1 ");
        $is = true;
    }

    if (($is && !$mb[mb_id]) || $admin == 'super') {
        $mb = sql_fetch("select * from $g4[member_table] where mb_id in ('$config[cf_admin]') limit 1 ");
    }

    return $mb;
}


// 관리자인가?
function is_admin($mb_id)
{
    global $config, $group, $board;

    if (!$mb_id) return;

    if ($config[cf_admin] == $mb_id) return 'super';
    if ($group[gr_admin] == $mb_id) return 'group';
    if ($board[bo_admin] == $mb_id) return 'board';
    return '';
}


// 분류 옵션을 얻음
// 4.00 에서는 카테고리 테이블을 없애고 보드테이블에 있는 내용으로 대체
function get_category_option($bo_table)
{
    global $g4;

    $sql = " select bo_category_list from $g4[board_table] where bo_table = '$bo_table' ";
    $row = sql_fetch($sql);
    $arr = explode("|", $row[bo_category_list]); // 구분자가 , 로 되어 있음
    $str = "";
    for ($i=0; $i<count($arr); $i++)
        if (trim($arr[$i]))
            $str .= "<option value='$arr[$i]'>$arr[$i]</option>\n";

    return $str;
}


// 게시판 그룹을 SELECT 형식으로 얻음
function get_group_select($name, $selected='', $event='')
{
    global $is_admin;
    global $g4;

    $sql = " select gr_id, gr_subject from $g4[group_table] a ";
    if ($is_admin == 'group') {
        $sql .= " left join $g4[member_table] b on (b.mb_id = a.gr_admin)
                  where b.mb_id = '$member[mb_id]' ";
    }
    $sql .= " order by a.gr_id ";
    $result = sql_query($sql);
    $str = "<select name='$name' $event>";
    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
        $str .= "<option value='$row[gr_id]'";
        if ($row[gr_id] == $selected) $str .= " selected";
        $str .= ">$row[gr_subject]</option>";
    }
    $str .= "</select>";
    return $str;
}


// '예', '아니오'를 SELECT 형식으로 얻음
function get_yn_select($name, $selected='1', $event='')
{
    $str = "<select name='$name' $event>";
    if ($selected) {
        $str .= "<option value='1' selected>예</option>";
        $str .= "<option value='0'>아니오</option>";
    } else {
        $str .= "<option value='1'>예</option>";
        $str .= "<option value='0' selected>아니오</option>";
    }
    $str .= "</select>";
    return $str;
}


// 포인트 부여
function insert_point($mb_id, $point, $content='', $rel_table='', $rel_id='', $rel_action='')
{
    global $config;
    global $g4;
    global $is_admin;

    // 포인트 사용을 하지 않는다면 return
    if (!$config[cf_use_point]) { return 0; }

    // 포인트가 없다면 업데이트 할 필요 없음
    if ($point == 0) { return 0; }

    // 최고관리자는 포인트 추가 내역 남기지 않음
    //if ($is_admin == "super") { return; }

    // 회원아이디가 없다면 업데이트 할 필요 없음
    if ($mb_id == "") { return 0; }
    $mb = sql_fetch(" select mb_id from $g4[member_table] where mb_id = '$mb_id' ");
    if (!$mb[mb_id]) { return 0; }

    // 이미 등록된 내역이라면 건너뜀
    if ($rel_table || $rel_id || $rel_action)
    {
        $sql = " select count(*) as cnt from $g4[point_table]
                  where mb_id = '$mb_id'
                    and po_rel_table = '$rel_table'
                    and po_rel_id = '$rel_id'
                    and po_rel_action = '$rel_action' ";
        $row = sql_fetch($sql);
        if ($row[cnt])
            return -1;
    }

    // 포인트 건별 생성
    $sql = " insert into $g4[point_table]
                set mb_id = '$mb_id',
                    po_datetime = '$g4[time_ymdhis]',
                    po_content = '$content',
                    po_point = '$point',
                    po_rel_table = '$rel_table',
                    po_rel_id = '$rel_id',
                    po_rel_action = '$rel_action' ";
    sql_query($sql);

    // 포인트 내역의 합을 구하고
    $sql = " select sum(po_point) as sum_po_point from $g4[point_table] where mb_id = '$mb_id' ";
    $row = sql_fetch($sql);
    $sum_point = $row[sum_po_point];

    // 포인트 UPDATE
    $sql = " update $g4[member_table] set mb_point = '$sum_point' where mb_id = '$mb_id' ";
    sql_query($sql);

    return 1;
}

// 포인트 삭제
function delete_point($mb_id, $rel_table, $rel_id, $rel_action)
{
    global $g4;

    $result = false;
    if ($rel_table || $rel_id || $rel_action)
    {
        $result = sql_query(" delete from $g4[point_table]
                     where mb_id = '$mb_id'
                       and po_rel_table = '$rel_table'
                       and po_rel_id = '$rel_id'
                       and po_rel_action = '$rel_action' ", false);

        // 포인트 내역의 합을 구하고
        $sql = " select sum(po_point) as sum_po_point from $g4[point_table] where mb_id = '$mb_id' ";
        $row = sql_fetch($sql);
        $sum_point = $row[sum_po_point];

        // 포인트 UPDATE
        $sql = " update $g4[member_table] set mb_point = '$sum_point' where mb_id = '$mb_id' ";
        $result = sql_query($sql);
    }

    return $result;
}

// 회원 레이어
function get_sideview($mb_id, $name="", $email="", $homepage="")
{
    global $config;
    global $g4;

    $email = base64_encode($email);
    $homepage = set_http($homepage);

    $name = preg_replace("/\&#039;/", "", $name);
    $name = preg_replace("/\'/", "", $name);
    $name = preg_replace("/\"/", "&#034;", $name);
    $title_name = $name;

    if ($mb_id) {
        $tmp_name = "<span class='member'>$name</span>";

        if ($config[cf_use_member_icon]) {
            $mb_dir = substr($mb_id,0,2);
            $icon_file = "$g4[path]/data/member/$mb_dir/$mb_id.gif";

            //if (file_exists($icon_file) && is_file($icon_file)) {
            if (file_exists($icon_file)) {
                //$size = getimagesize($icon_file);
                //$width = $size[0];
                //$height = $size[1];
                $width = $config[cf_member_icon_width];
                $height = $config[cf_member_icon_height];
                $tmp_name = "<img src='$icon_file' width='$width' height='$height' align='absmiddle' border='0'>";

                if ($config[cf_use_member_icon] == 2) // 회원아이콘+이름
                    $tmp_name = $tmp_name . " <span class='member'>$name</span>";
            }
        }
        $title_mb_id = "[$mb_id]";
    } else {
        $tmp_name = "<span class='guest'>$name</span>";
        $title_mb_id = "[비회원]";
    }

    return "<a href=\"javascript:;\" onClick=\"showSideView(this, '$mb_id', '$name', '$email', '$homepage');\" title=\"{$title_mb_id}{$title_name}\">$tmp_name</a>";
}


// 파일을 보이게 하는 링크 (이미지, 플래쉬, 동영상)
function view_file_link($file, $content='')
{
    global $config, $board;
    global $g4;

    if (!$file) return;

    $size = @getimagesize("$g4[path]/data/file/$board[bo_table]/$file");

    $width  = $size[0] ? $size[0] : 640;
    $height = $size[1] ? $size[1] : 480;

    if (preg_match("/\.($config[cf_image_extension])$/i", $file))
        return "<img src='$g4[path]/data/file/$board[bo_table]/".urlencode($file)."' name='target_resize_image[]' onclick='image_window(this);' style='cursor:pointer;' title='$content'>";
    else if (preg_match("/\.($config[cf_flash_extension])$/i", $file))
        return "<embed src='$g4[path]/data/file/$board[bo_table]/$file' width='$width' height='$height'></embed>";
    else if (preg_match("/\.($config[cf_movie_extension])$/i", $file))
        return "<embed src='$g4[path]/data/file/$board[bo_table]/$file' width='$width' height='$height'></embed>";
}


// view_file_link() 함수에서 넘겨진 이미지를 보이게 합니다.
// {img:0} ... {img:n} 과 같은 형식
function view_image($view, $number, $attribute)
{
    if ($view['file'][$number]['view'])
        return preg_replace("/>$/", " $attribute>", $view['file'][$number]['view']);
    else
        //return "{".$number."번 이미지 없음}";
        return "";
}


/*
// {link:0} ... {link:n} 과 같은 형식
function view_link($view, $number, $attribute)
{
    global $config;

    if ($view[link][$number][link])
    {
        if (!preg_match("/target/i", $attribute))
            $attribute .= " target='$config[cf_link_target]'";
        return "<a href='{$view[link][$number][href]}' $attribute>{$view[link][$number][link]}</a>";
    }
    else
        return "{".$number."번 링크 없음}";
}
*/


// 한글 한글자(2byte)는 길이 2, 공란.영숫자.특수문자는 길이 1
function cut_str($str, $len, $suffix="…")
{
    $s = substr($str, 0, $len);
    $cnt = 0;
    for ($i=0; $i<strlen($s); $i++)
        if (ord($s[$i]) > 127)
            $cnt++;
    $s = substr($s, 0, $len - ($cnt % 2));
    if (strlen($s) >= strlen($str))
        $suffix = "";
    return $s . $suffix;
}


// TEXT 형식으로 변환
function get_text($str, $html=0)
{
    /* 3.22 막음 (HTML 체크 줄바꿈시 출력 오류때문)
    $source[] = "/  /";
    $target[] = " &nbsp;";
    */

    // 3.31
    // TEXT 출력일 경우 &amp; &nbsp; 등의 코드를 정상으로 출력해 주기 위함
    if ($html == 0) {
        $str = html_symbol($str);
    }

    $source[] = "/</";
    $target[] = "&lt;";
    $source[] = "/>/";
    $target[] = "&gt;";
    //$source[] = "/\"/";
    //$target[] = "&#034;";
    $source[] = "/\'/";
    $target[] = "&#039;";
    //$source[] = "/}/"; $target[] = "&#125;";
    if ($html) {
        $source[] = "/\n/";
        $target[] = "<br/>";
    }

    return preg_replace($source, $target, $str);
}


/*
// HTML 특수문자 변환 htmlspecialchars
function hsc($str)
{
    $trans = array("\"" => "&#034;", "'" => "&#039;", "<"=>"&#060;", ">"=>"&#062;");
    $str = strtr($str, $trans);
    return $str;
}
*/

// 3.31
// HTML SYMBOL 변환
// &nbsp; &amp; &middot; 등을 정상으로 출력
function html_symbol($str)
{
    return preg_replace("/\&([a-z0-9]{1,20}|\#[0-9]{0,3});/i", "&#038;\\1;", $str);
}


/*************************************************************************
**
**  SQL 관련 함수 모음
**
*************************************************************************/

// DB 연결
function sql_connect($host, $user, $pass)
{
    return @mysql_connect($host, $user, $pass);
}


// DB 선택
function sql_select_db($db, $connect)
{
    return @mysql_select_db($db, $connect);
}


// mysql_query 와 mysql_error 를 한꺼번에 처리
function sql_query($sql, $error=TRUE)
{
    if ($error)
        $result = @mysql_query($sql) or die("<p>$sql<p>" . mysql_errno() . " : " .  mysql_error() . "<p>error file : $_SERVER[PHP_SELF]");
    else
        $result = @mysql_query($sql);
    return $result;
}


// 쿼리를 실행한 후 결과값에서 한행을 얻는다.
function sql_fetch($sql, $error=TRUE)
{
    $result = sql_query($sql, $error);
    //$row = @sql_fetch_array($result) or die("<p>$sql<p>" . mysql_errno() . " : " .  mysql_error() . "<p>error file : $_SERVER[PHP_SELF]");
    $row = sql_fetch_array($result);
    return $row;
}


// 결과값에서 한행 연관배열(이름으로)로 얻는다.
function sql_fetch_array($result)
{
    $row = @mysql_fetch_assoc($result);
    return $row;
}


// $result에 대한 메모리(memory)에 있는 내용을 모두 제거한다.
// sql_free_result()는 결과로부터 얻은 질의 값이 커서 많은 메모리를 사용할 염려가 있을 때 사용된다.
// 단, 결과 값은 스크립트(script) 실행부가 종료되면서 메모리에서 자동적으로 지워진다.
function sql_free_result($result)
{
    return mysql_free_result($result);
}


function sql_password($value)
{
    // mysql 4.0x 이하 버전에서는 password() 함수의 결과가 16bytes
    // mysql 4.1x 이상 버전에서는 password() 함수의 결과가 41bytes
    $row = sql_fetch(" select password('$value') as pass ");
    return $row[pass];
}


// PHPMyAdmin 참고
function get_table_define($table, $crlf="\n")
{
    // For MySQL < 3.23.20
    $schema_create .= 'CREATE TABLE ' . $table . ' (' . $crlf;

    $sql = 'SHOW FIELDS FROM ' . $table;
    $result = sql_query($sql);
    while ($row = sql_fetch_array($result))
    {
        $schema_create .= '    ' . $row['Field'] . ' ' . $row['Type'];
        if (isset($row['Default']) && $row['Default'] != '')
        {
            $schema_create .= ' DEFAULT \'' . $row['Default'] . '\'';
        }
        if ($row['Null'] != 'YES')
        {
            $schema_create .= ' NOT NULL';
        }
        if ($row['Extra'] != '')
        {
            $schema_create .= ' ' . $row['Extra'];
        }
        $schema_create     .= ',' . $crlf;
    } // end while
    sql_free_result($result);

    $schema_create = ereg_replace(',' . $crlf . '$', '', $schema_create);

    $sql = 'SHOW KEYS FROM ' . $table;
    $result = sql_query($sql);
    while ($row = sql_fetch_array($result))
    {
        $kname    = $row['Key_name'];
        $comment  = (isset($row['Comment'])) ? $row['Comment'] : '';
        $sub_part = (isset($row['Sub_part'])) ? $row['Sub_part'] : '';

        if ($kname != 'PRIMARY' && $row['Non_unique'] == 0) {
            $kname = "UNIQUE|$kname";
        }
        if ($comment == 'FULLTEXT') {
            $kname = 'FULLTEXT|$kname';
        }
        if (!isset($index[$kname])) {
            $index[$kname] = array();
        }
        if ($sub_part > 1) {
            $index[$kname][] = $row['Column_name'] . '(' . $sub_part . ')';
        } else {
            $index[$kname][] = $row['Column_name'];
        }
    } // end while
    sql_free_result($result);

    while (list($x, $columns) = @each($index)) {
        $schema_create     .= ',' . $crlf;
        if ($x == 'PRIMARY') {
            $schema_create .= '    PRIMARY KEY (';
        } else if (substr($x, 0, 6) == 'UNIQUE') {
            $schema_create .= '    UNIQUE ' . substr($x, 7) . ' (';
        } else if (substr($x, 0, 8) == 'FULLTEXT') {
            $schema_create .= '    FULLTEXT ' . substr($x, 9) . ' (';
        } else {
            $schema_create .= '    KEY ' . $x . ' (';
        }
        $schema_create     .= implode($columns, ', ') . ')';
    } // end while

    $schema_create .= $crlf . ')';

    return $schema_create;
} // end of the 'PMA_getTableDef()' function


// 리퍼러 체크
function referer_check($url="")
{
    global $g4;

    if (!$url)
        $url = $g4[url];

    if (!preg_match("/^http[s]?:\/\/".$_SERVER[HTTP_HOST]."/", $_SERVER[HTTP_REFERER]))
        alert("제대로 된 접근이 아닌것 같습니다.", $url);
}


// 한글 요일
function get_yoil($date, $full=0) 
{
    $arr_yoil = array ("일", "월", "화", "수", "목", "금", "토");

    $yoil = date("w", strtotime($date));
    $str = $arr_yoil[$yoil];
    if ($full) {
        $str .= "요일";
    }
    return $str;
}


// 날짜를 select 박스 형식으로 얻는다
function date_select($date, $name="")
{
    global $g4;

    $s = "";
    if (substr($date, 0, 4) == "0000") {
        $date = $g4[time_ymdhis];
    }
    preg_match("/([0-9]{4})-([0-9]{2})-([0-9]{2})/", $date, $m);
    
    // 년
    $s .= "<select name='{$name}_y'>";
    for ($i=$m[0]-3; $i<=$m[0]+3; $i++) {
        $s .= "<option value='$i'";
        if ($i == $m[0]) {
            $s .= " selected";
        }
        $s .= ">$i";
    }
    $s .= "</select>년 \n";

    // 월
    $s .= "<select name='{$name}_m'>";
    for ($i=1; $i<=12; $i++) {
        $s .= "<option value='$i'";
        if ($i == $m[2]) {
            $s .= " selected";
        }
        $s .= ">$i";
    }
    $s .= "</select>월 \n";

    // 일
    $s .= "<select name='{$name}_d'>";
    for ($i=1; $i<=31; $i++) {
        $s .= "<option value='$i'";
        if ($i == $m[3]) {
            $s .= " selected";
        }
        $s .= ">$i";
    }
    $s .= "</select>일 \n";

    return $s;
}


// 시간을 select 박스 형식으로 얻는다
// 1.04.00
// 경매에 시간 설정이 가능하게 되면서 추가함
function time_select($time, $name="")
{
    preg_match("/([0-9]{2}):([0-9]{2}):([0-9]{2})/", $time, $m);
    
    // 시
    $s .= "<select name='{$name}_h'>";
    for ($i=0; $i<=23; $i++) {
        $s .= "<option value='$i'";
        if ($i == $m[0]) {
            $s .= " selected";
        }
        $s .= ">$i";
    }
    $s .= "</select>시 \n";

    // 분
    $s .= "<select name='{$name}_i'>";
    for ($i=0; $i<=59; $i++) {
        $s .= "<option value='$i'";
        if ($i == $m[2]) {
            $s .= " selected";
        }
        $s .= ">$i";
    }
    $s .= "</select>분 \n";

    // 초
    $s .= "<select name='{$name}_s'>";
    for ($i=0; $i<=59; $i++) {
        $s .= "<option value='$i'";
        if ($i == $m[3]) {
            $s .= " selected";
        }
        $s .= ">$i";
    }
    $s .= "</select>초 \n";

    return $s;
}


// DEMO 라는 파일이 있으면 데모 화면으로 인식함
function check_demo()
{
    global $g4;
    if (file_exists("$g4[path]/DEMO"))
        alert("데모 화면에서는 하실(보실) 수 없는 작업입니다.");
}


// 테이블에서 INDEX(키) 사용여부 검사
function explain($sql)
{
    if (preg_match("/^(select)/i", trim($sql))) {
        $q = "explain $sql";
        echo $q;
        $row = sql_fetch($q);
        if (!$row[key]) $row[key] = "NULL";
        echo " <font color=blue>(type=$row[type] , key=$row[key])</font>";
    }
}
?>