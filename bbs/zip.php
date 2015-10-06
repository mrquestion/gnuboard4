<?
include_once("./_common.php");

if ($addr1) 
{
    //$sql = " select * from $g4[zip_table] where zp_dong like '%$addr1%' order by zp_id ";
    $sql = " select * from $g4[zip_table] where zp_dong like '%$addr1%' order by zp_sido, zp_gugun, zp_dong ";
    $result = sql_query($sql);
    $search_count = 0;
    for ($i=0; $row=sql_fetch_array($result); $i++) 
    {
        $list[$i][zip1] = substr($row[zp_code], 0, 3);
        $list[$i][zip2] = substr($row[zp_code], 3, 3);
        $list[$i][addr] = "$row[zp_sido] $row[zp_gugun] $row[zp_dong]";
        $list[$i][bunji] = $row[zp_bunji];
        $list[$i][encode_addr] = urlencode($list[$i][addr]);
        $search_count++;
    }

    if (!$search_count) 
        alert("찾으시는 주소가 없습니다.");
}

$g4[title] = "우편번호 검색";
include_once("$g4[path]/head.sub.php");

$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";
include_once("$member_skin_path/zip.skin.php");

include_once("$g4[path]/tail.sub.php");
?>
