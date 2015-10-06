<?
$sub_menu = "300100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

if (!preg_match("/[A-Za-z0-9_]{1,20}/", $target_table)) 
{ 
    alert("�Խ��� TABLE���� ������� ������, ����, _ �� ��� �����մϴ�. (20�� �̳�)"); 
}

$row = sql_fetch(" select count(*) as cnt from $g4[board_table] where bo_table = '$target_table' ");
if ($row[cnt])
    alert("{$target_table}��(��) �̹� �����ϴ� �Խ��� TABLE �Դϴ�.\\n\\n������ TABLE�� ����� �� �����ϴ�.");

// �Խ��� ���̺� ����
$sql = get_table_define($g4[write_prefix] . $bo_table);
$sql = str_replace($g4[write_prefix] . $bo_table, $g4[write_prefix] . $target_table, $sql);
sql_query($sql);

$file_copy = array();

// �Խ��� ����
$sql = " insert into $g4[board_table]
            set bo_table            = '$target_table',
                gr_id               = '$board[gr_id]', 
                bo_subject          = '[���纻] $board[bo_subject]',
                bo_admin            = '$board[bo_admin]',
                bo_list_level       = '$board[bo_list_level]',
                bo_read_level       = '$board[bo_read_level]',
                bo_write_level      = '$board[bo_write_level]',
                bo_reply_level      = '$board[bo_reply_level]',
                bo_comment_level    = '$board[bo_comment_level]',
                bo_upload_level     = '$board[bo_upload_level]',
                bo_download_level   = '$board[bo_download_level]',
                bo_html_level       = '$board[bo_html_level]',
                bo_link_level       = '$board[bo_link_level]',
                bo_trackback_level  = '$board[bo_tackback_level]',
                bo_count_modify     = '$board[bo_count_modify]',
                bo_count_delete     = '$board[bo_count_delete]',
                bo_read_point       = '$board[bo_read_point]',
                bo_write_point      = '$board[bo_write_point]',
                bo_comment_point    = '$board[bo_comment_point]',
                bo_download_point   = '$board[bo_download_point]',
                bo_use_category     = '$board[bo_use_category]',
                bo_category_list    = '$board[bo_category_list]',
                bo_disable_tags     = '$board[disable_tags]',
                bo_use_secret       = '$board[bo_use_secret]',
                bo_use_sideview     = '$board[bo_use_sideview]',
                bo_use_comment      = '$board[bo_use_comment]',
                bo_use_good         = '$board[bo_use_good]',
                bo_use_nogood       = '$board[bo_use_nogood]',
                bo_use_signature    = '$board[bo_use_signature]',
                bo_use_ip_view      = '$board[bo_use_ip_view]',
                bo_use_trackback    = '$board[bo_use_trackback]',
                bo_use_list_view    = '$board[bo_use_list_view]',
                bo_use_list_content = '$board[bo_use_list_content]',
                bo_table_width      = '$board[bo_table_width]',
                bo_subject_len      = '$board[bo_subject_len]',
                bo_page_rows        = '$board[bo_page_rows]',
                bo_new              = '$board[bo_new]',
                bo_hot              = '$board[bo_hot]',
                bo_image_width      = '$board[bo_image_width]',
                bo_skin             = '$board[bo_skin]',
                bo_include_head     = '$board[bo_include_head]',
                bo_include_tail     = '$board[bo_include_tail]',
                bo_content_head     = '$board[bo_content_head]',
                bo_content_tail     = '$board[bo_content_tail]',
                bo_insert_content   = '$board[bo_insert_content]',
                bo_gallery_cols     = '$board[bo_gallery_cols]',
                bo_upload_size      = '$board[bo_upload_size]',
                bo_reply_order      = '$board[bo_reply_order]',
                bo_use_search       = '$board[bo_use_search]',
                bo_order_search     = '$board[bo_order_search]',
                bo_notice           = '$board[bo_notice]',
                bo_1                = '$board[bo_1]',
                bo_2                = '$board[bo_2]',
                bo_3                = '$board[bo_3]',
                bo_4                = '$board[bo_4]',
                bo_5                = '$board[bo_5]',
                bo_6                = '$board[bo_6]',
                bo_7                = '$board[bo_7]',
                bo_8                = '$board[bo_8]',
                bo_9                = '$board[bo_9]',
                bo_10               = '$board[bo_10]' ";
sql_query($sql);

// �Խ��� ���� ����
@mkdir("$g4[path]/data/file/$target_table", 0707);
@chmod("$g4[path]/data/file/$target_table", 0707);

$copy_file = 0;
if ($copy_case == "schema_data_both") 
{
    $d = dir("$g4[path]/data/file/$bo_table");
    while ($entry = $d->read()) 
    {
        if ($entry == "." || $entry == "..") continue;

        @copy("$g4[path]/data/file/$bo_table/$entry", "$g4[path]/data/file/$target_table/$entry");
        @chmod("$g4[path]/data/file/$target_table/$entry", 0707);

        $copy_file++;
    }
    $d->close();

    // �ۺ���
    $sql = " insert into $g4[write_prefix]$target_table select * from $g4[write_prefix]$bo_table ";
    sql_query($sql);

    // �Խñۼ� ����
    $sql = " select bo_count_write, bo_count_comment from $g4[board_table] where bo_table = '$bo_table' ";
    $row = sql_fetch($sql);
    $sql = " update $g4[board_table] set bo_count_write = '$row[bo_count_write]', bo_count_comment = '$row[bo_count_comment]' where bo_table = '$target_table' ";
    sql_query($sql);

    // 05.05.24
    // �������̺� ����
    //$sql = " insert into $g4[board_file_table] select '$target_table', wr_id, bf_no, bf_source, bf_file, bf_download, bf_content from $g4[board_file_table] where bo_table = '$bo_table' ";
    //sql_query($sql);

    // 4.00.01
    // ���� �ڵ�� ���� ���̺���� ����Ͽ��ٴ� ������ �߻���. (�����ϳ� �Ѥ�;)
    $sql = " select * from $g4[board_file_table] where bo_table = '$bo_table' ";
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) 
        $file_copy[$i] = $row;
}   

if (count($file_copy)) 
{
    for ($i=0; $i<count($file_copy); $i++)
    {
        $sql = " insert into $g4[board_file_table] 
                    set bo_table = '$target_table',
                        wr_id = '{$file_copy[$i][wr_id]}',
                        bf_no = '{$file_copy[$i][bf_no]}',
                        bf_source = '{$file_copy[$i][bf_source]}',
                        bf_file = '{$file_copy[$i][bf_file]}',
                        bf_download = '{$file_copy[$i][bf_download]}',
                        bf_content = '{$file_copy[$i][bf_content]}' ";
        sql_query($sql, FALSE);
    }
}

echo "<script language='javascript'>";
echo "alert('�Խ��� ���� : {$bo_table} -> {$target_table}";
if ($copy_file)
    echo "\\n\\n������ ���� : �� {$copy_file}��";
echo "');";
echo "opener.document.location.reload();";
echo "</script>";

goto_url("./board_copy.php?bo_table=$bo_table&$qstr");
?>
