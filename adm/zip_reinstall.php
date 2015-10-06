<?
$sub_menu = "100940";
include_once("./_common.php");

check_demo();

$html_title = "우편번호 재설치";
$g4[title] = $html_title;
include_once("./admin.head.php");
?>

<p><img src='<?=$g4[admin_path]?>/img/icon_title.gif'> <span class=title><?=$html_title?></span>

<p><span id=content></span>

<?
include_once("./admin.tail.php");
?>

<script language="JavaScript">
<!--
if (!confirm("우편번호 재설치의 경우 작업시간이 몇분정도 걸릴수 있습니다.\n\n계속 진행하시겠습니까?"))
{
    location.href = "./m100_index.php";
}
//-->
</script>

<?
echo "<script>document.getElementById('content').innerHTML += '설치중입니다.<br><br>설치중 실행을 중단하지 마십시오.<br><br>';</script>\n";
flush();

$zip_file = "./sql_zip.sql";
if (file_exists($zip_file)) 
{
    // 우편번호 파일을 비운다
    sql_query(" delete from $g4[zip_table] ");

    $i=0;
    $fp = fopen($zip_file, "r");
    while(!feof($fp)) 
    {
        $i++;
        if ($i%1000==0)
        {
            echo "<script>document.getElementById('content').innerHTML += '■';</script>\n";
            flush();
        }

        $s = fgets($fp, 4096);
        $s = preg_replace("/_TABLE_ZIP_/", $g4[zip_table], $s);
        $s = preg_replace("/;/", "", $s);
        sql_query($s);
    }
    $str = "<br><br>총 ".number_format($i)." 건의 우편번호 자료를 생성하였습니다.";
} 
else 
{
    $str = "<br><br>우편번호 자료($zip_file)가 존재하지 않습니다.";
}
$str .= "<br><br>[끝]";

echo "<script>document.getElementById('content').innerHTML += '$str';</script>";
flush();
?>