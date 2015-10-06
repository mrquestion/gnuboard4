<?
$sub_menu = "300100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

for ($i=0; $i<count($chk); $i++) {
    // 실제 번호를 넘김
    $k = $chk[$i];

    $sql = " update $g4[board_table]
                set gr_id               = '$gr_id[$k]',
                    bo_subject          = '$bo_subject[$k]',
                    bo_skin             = '$bo_skin[$k]',
                    bo_admin            = '$bo_admin[$k]',
                    bo_read_point       = '$bo_read_point[$k]',
                    bo_write_point      = '$bo_write_point[$k]',
                    bo_comment_point    = '$bo_comment_point[$k]',
                    bo_download_point   = '$bo_download_point[$k]',
                    bo_use_search       = '$bo_use_search[$k]',
                    bo_order_search     = '$bo_order_search[$k]'
              where bo_table = '$board_table[$k]' ";
    sql_query($sql);
}

goto_url("./board_list.php?$qstr");
?>
