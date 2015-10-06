<?
$sub_menu = "300100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

if (!$_POST[gr_id]) { alert("그룹 ID는 반드시 선택하세요."); }
if (!$bo_table) { alert("게시판 TABLE명은 반드시 입력하세요."); }
if (!ereg("^([A-Za-z0-9_]{1,20})$", $bo_table)) { alert("게시판 TABLE명은 공백없이 영문자, 숫자, _ 만 사용 가능합니다. (20자 이내)"); }
if (!$_POST[bo_subject]) { alert("게시판 제목을 입력하세요."); }

$board_path = "$g4[path]/data/file/$bo_table";

// 게시판 디렉토리 생성
@mkdir($board_path, 0707);
@chmod($board_path, 0707);

// 디렉토리에 있는 파일의 목록을 보이지 않게 한다.
$file = $board_path . "/index.php";
$f = @fopen($file, "w");
@fwrite($f, "");
@fclose($f);
@chmod($file, 0606);

$sql_common = " gr_id               = '$_POST[gr_id]',
                bo_subject          = '$bo_subject',
                bo_admin            = '$bo_admin',
                bo_list_level       = '$bo_list_level',
                bo_read_level       = '$bo_read_level',
                bo_write_level      = '$bo_write_level',
                bo_reply_level      = '$bo_reply_level',
                bo_comment_level    = '$bo_comment_level',
                bo_html_level       = '$bo_html_level',
                bo_link_level       = '$bo_link_level',
                bo_trackback_level  = '$bo_trackback_level',
                bo_count_modify     = '$bo_count_modify',
                bo_count_delete     = '$bo_count_delete',
                bo_upload_level     = '$bo_upload_level',
                bo_download_level   = '$bo_download_level',
                bo_read_point       = '$bo_read_point',
                bo_write_point      = '$bo_write_point',
                bo_comment_point    = '$bo_comment_point',
                bo_download_point   = '$bo_download_point',
                bo_use_category     = '$bo_use_category',
                bo_category_list    = '$bo_category_list',
                bo_disable_tags     = '$bo_disable_tags',
                bo_use_sideview     = '$bo_use_sideview',
                bo_use_file_content = '$bo_use_file_content',
                bo_use_secret       = '$bo_use_secret',
                bo_use_comment      = '$bo_use_comment',
                bo_use_good         = '$bo_use_good',
                bo_use_nogood       = '$bo_use_nogood',
                bo_use_name         = '$bo_use_name',
                bo_use_signature    = '$bo_use_signature',
                bo_use_ip_view      = '$bo_use_ip_view',
                bo_use_trackback    = '$bo_use_trackback',
                bo_use_list_view    = '$bo_use_list_view',
                bo_use_list_content = '$bo_use_list_content',
                bo_table_width      = '$bo_table_width',
                bo_subject_len      = '$bo_subject_len',
                bo_page_rows        = '$bo_page_rows',
                bo_new              = '$bo_new',
                bo_hot              = '$bo_hot',
                bo_image_width      = '$bo_image_width',
                bo_skin             = '$bo_skin',
                bo_include_head     = '$bo_include_head',
                bo_include_tail     = '$bo_include_tail',
                bo_content_head     = '$bo_content_head',
                bo_content_tail     = '$bo_content_tail',
                bo_insert_content   = '$bo_insert_content',
                bo_gallery_cols     = '$bo_gallery_cols',
                bo_upload_size      = '$bo_upload_size',
                bo_reply_order      = '$bo_reply_order',
                bo_use_search       = '$bo_use_search',
                bo_order_search     = '$bo_order_search',
                bo_write_min        = '$bo_write_min',
                bo_write_max        = '$bo_write_max',
                bo_comment_min      = '$bo_comment_min',
                bo_comment_max      = '$bo_comment_max',
                bo_1                = '$bo_1',
                bo_2                = '$bo_2',
                bo_3                = '$bo_3',
                bo_4                = '$bo_4',
                bo_5                = '$bo_5',
                bo_6                = '$bo_6',
                bo_7                = '$bo_7',
                bo_8                = '$bo_8',
                bo_9                = '$bo_9',
                bo_10               = '$bo_10' ";

if ($bo_image_head_del) {
    @unlink("$board_path/$bo_image_head_del");
    $sql_common .= " , bo_image_head = '' ";
}

if ($bo_image_tail_del) {
    @unlink("$board_path/$bo_image_tail_del");
    $sql_common .= " , bo_image_tail = '' ";
}

if ($_FILES[bo_image_head][name]) {
    $bo_image_head_urlencode = urlencode($_FILES[bo_image_head][name]);
    $sql_common .= " , bo_image_head = '$bo_image_head_urlencode' ";
}

if ($_FILES[bo_image_tail][name]) {
    $bo_image_tail_urlencode = urlencode($_FILES[bo_image_tail][name]);
    $sql_common .= " , bo_image_tail = '$bo_image_tail_urlencode' ";
}

if ($w == "") {
    $row = sql_fetch(" select count(*) as cnt from $g4[board_table] where bo_table = '$bo_table' ");
    if ($row[cnt])
        alert("{$bo_table} 은(는) 이미 존재하는 TABLE 입니다.");

    $sql = " insert into $g4[board_table]
                set bo_table = '$bo_table',
                    bo_count_write = '0',
                    bo_count_comment = '0',
                    $sql_common ";
    sql_query($sql);

    // 게시판 테이블 생성
    $file = file("./sql_write.sql");
    $sql = implode($file, "\n");

    $create_table = $g4[write_prefix] . $bo_table;

    // sql_board.sql 파일의 테이블명을 변환
    $source = array("/__TABLE_NAME__/", "/;/");
    $target = array($create_table, "");
    $sql = preg_replace($source, $target, $sql);
    sql_query($sql, FALSE);
} 
else if ($w == "u") 
{
    // 게시판의 글 수
    $sql = " select count(*) as cnt from $g4[write_prefix]$bo_table where wr_comment > -1 ";
    $row = sql_fetch($sql);
    $bo_count_write = $row[cnt];

    // 게시판의 코멘트 수
    $sql = " select count(*) as cnt from $g4[write_prefix]$bo_table where wr_comment < 0 ";
    $row = sql_fetch($sql);
    $bo_count_comment = $row[cnt];

    // 글수 조정
    if ($proc_count) 
    {
        // 원글을 얻습니다.
        $sql = " select wr_id from $g4[write_prefix]$bo_table where wr_comment > -1 ";
        $result = sql_query($sql);
        for ($i=0; $row=sql_fetch_array($result); $i++) 
        {
            // 코멘트수를 얻습니다.
            $sql2 = " select count(*) as cnt from $g4[write_prefix]$bo_table where wr_parent = '$row[wr_id]' and wr_comment < 0 ";
            $row2 = sql_fetch($sql2);

            sql_query(" update $g4[write_prefix]$bo_table set wr_comment = '$row2[cnt]' where wr_id = '$row[wr_id]' ");
        }
    }

    // 공지사항에는 등록되어 있지만 실제 존재하지 않는 글 아이디는 삭제합니다.
    $bo_notice = "";
    $lf = "";
    if ($board[bo_notice]) 
    {
        $tmp_array = explode("\n", $board[bo_notice]);
        for ($i=0; $i<count($tmp_array); $i++) 
        {
            $tmp_wr_id = trim($tmp_array[$i]);
            $row = sql_fetch(" select count(*) as cnt from $g4[write_prefix]$bo_table where wr_id = '$tmp_wr_id' ");
            if ($row[cnt]) 
            {
                $bo_notice .= $lf . $tmp_wr_id;
                $lf = "\n";
            }
        }
    }

    $sql = " update $g4[board_table]
                set bo_notice = '$bo_notice',
                    bo_count_write = '$bo_count_write',
                    bo_count_comment = '$bo_count_comment',
                    $sql_common
              where bo_table = '$bo_table' ";
    sql_query($sql);
}

// 같은 그룹내 게시판 동일 옵션 적용
$sql = " select bo_table from $g4[board_table] where gr_id = '$gr_id' and bo_table <> '$bo_table' ";
$result = sql_query($sql);
while ($row = sql_fetch_array($result)) {
    if ($group_same1) {
        $sql = " update $g4[board_table]
                    set bo_admin = '$bo_admin'
                  where bo_table = '$row[bo_table]'";
        sql_query($sql);
    }

    if ($group_same2) {
        $sql = " update $g4[board_table]
                    set bo_list_level       = '$bo_list_level',
                        bo_read_level       = '$bo_read_level',
                        bo_write_level      = '$bo_write_level',
                        bo_reply_level      = '$bo_reply_level',
                        bo_comment_level    = '$bo_comment_level',
                        bo_html_level       = '$bo_html_level',
                        bo_link_level       = '$bo_link_level',
                        bo_trackback_level  = '$bo_trackback_level',
                        bo_upload_level     = '$bo_upload_level',
                        bo_download_level   = '$bo_download_level',
                        bo_read_point       = '$bo_read_point',
                        bo_write_point      = '$bo_write_point',
                        bo_comment_point    = '$bo_comment_point',
                        bo_download_point   = '$bo_download_point'
                  where bo_table = '$row[bo_table]'";
        sql_query($sql);
    }        

    if ($group_same3_1) {
        $sql = " update $g4[board_table]
                    set bo_use_category     = '$bo_use_category',
                        bo_category_list    = '$bo_category_list'
                  where bo_table = '$row[bo_table]'";
        sql_query($sql);
    }

    if ($group_same3_2) {
        $sql = " update $g4[board_table]
                    set bo_disable_tags     = '$bo_disable_tags',
                        bo_use_sideview     = '$bo_use_sideview',
                        bo_use_secret       = '$bo_use_secret',
                        bo_use_comment      = '$bo_use_comment',
                        bo_use_good         = '$bo_use_good',
                        bo_use_nogood          = '$bo_use_nogood',
                        bo_use_name         = '$bo_use_name',
                        bo_use_signature    = '$bo_use_signature',
                        bo_use_ip_view      = '$bo_use_ip_view',
                        bo_use_list_view    = '$bo_use_list_view',
                        bo_use_list_content = '$bo_use_list_content'
                  where bo_table = '$row[bo_table]'";
        sql_query($sql);
    }

    if ($group_same4) {
        $sql = " update $g4[board_table]
                    set bo_skin             = '$bo_skin',
                        bo_gallery_cols     = '$bo_gallery_cols',
                        bo_table_width      = '$bo_table_width',
                        bo_subject_len      = '$bo_subject_len',
                        bo_page_rows        = '$bo_page_rows',
                        bo_new              = '$bo_new',
                        bo_hot              = '$bo_hot',
                        bo_write_min        = '$bo_write_min',
                        bo_write_max        = '$bo_write_max',
                        bo_comment_min      = '$bo_comment_min',
                        bo_comment_max      = '$bo_comment_max',
                        bo_image_width      = '$bo_image_width',
                        bo_upload_size      = '$bo_upload_size',
                        bo_reply_order      = '$bo_reply_order'
                  where bo_table = '$row[bo_table]'";
        sql_query($sql);
    }

    if ($group_same5) {
        $sql = " update $g4[board_table]
                    set bo_include_head     = '$bo_include_head',
                        bo_include_tail     = '$bo_include_tail'
                  where bo_table = '$row[bo_table]'";
        sql_query($sql);
    }

    if ($group_same6) {
        $sql = " update $g4[board_table]
                    set bo_content_head     = '$bo_content_head',
                        bo_content_tail     = '$bo_content_tail'
                  where bo_table = '$row[bo_table]'";
        sql_query($sql);
    }

    if ($group_same7) {
        $sql = " update $g4[board_table]
                    set bo_insert_content   = '$bo_insert_content'
                  where bo_table = '$row[bo_table]'";
        sql_query($sql);
    }

    if ($group_same8) {
        $sql = " update $g4[board_table]
                    set bo_use_search   = '$bo_use_search',
                        bo_order_search = '$bo_order_search'
                  where bo_table = '$row[bo_table]'";
        sql_query($sql);
    }

    if ($group_same9) {
        $sql = " update $g4[board_table]
                    set bo_1  = '$bo_1',
                        bo_2  = '$bo_2',
                        bo_3  = '$bo_3',
                        bo_4  = '$bo_4',
                        bo_5  = '$bo_5',
                        bo_6  = '$bo_6',
                        bo_7  = '$bo_7',
                        bo_8  = '$bo_8',
                        bo_9  = '$bo_9',
                        bo_10 = '$bo_10'
                  where bo_table = '$row[bo_table]'";
        sql_query($sql);
    }
}

if ($_FILES[bo_image_head][name]) { 
    $bo_image_head_path = "$board_path/$bo_image_head_urlencode";
    move_uploaded_file($_FILES[bo_image_head][tmp_name], $bo_image_head_path);
    chmod($bo_image_head_path, 0606);
}

if ($_FILES[bo_image_tail][name]) { 
    $bo_image_tail_path = "$board_path/$bo_image_tail_urlencode";
    move_uploaded_file($_FILES[bo_image_tail][tmp_name], $bo_image_tail_path);
    chmod($bo_image_tail_path, 0606);
}

//sql_query(" OPTIMIZE TABLE `$g4[board_table]`, `$g4[board_file_table]`, `$g4[board_new_table]`, `$g4[write_prefix]$bo_table` ");

goto_url("./board_form.php?w=u&bo_table=$bo_table&$qstr");
?>
