<?
include_once("./_common.php");

for($i=0;$i<10000;$i++) {
    $k = 1000000 - $i;
    $sql = " insert into g4_board_category
                set bo_table = 'basic',
                    ca_name = '$k �����ٶ󸶹ٻ������īŸ���� �����ٶ󸶹ٻ������īŸ���� �����ٶ󸶹ٻ������īŸ���� �����ٶ󸶹ٻ������īŸ���� �����ٶ󸶹ٻ������īŸ���� �����ٶ󸶹ٻ������īŸ���� ',
                    bc_cnt = '$i',
                    bc_comment_cnt = '$i$i' ";
    sql_query($sql);
}
?>