<?
$sub_menu = "100940";
include_once("./_common.php");

check_demo();

$html_title = "�����ȣ �缳ġ";
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
if (!confirm("�����ȣ �缳ġ�� ��� �۾��ð��� ������� �ɸ��� �ֽ��ϴ�.\n\n��� �����Ͻðڽ��ϱ�?"))
{
    location.href = "./m100_index.php";
}
//-->
</script>

<?
echo "<script>document.getElementById('content').innerHTML += '��ġ���Դϴ�.<br><br>��ġ�� ������ �ߴ����� ���ʽÿ�.<br><br>';</script>\n";
flush();

$zip_file = "./sql_zip.sql";
if (file_exists($zip_file)) 
{
    // �����ȣ ������ ����
    sql_query(" delete from $g4[zip_table] ");

    $i=0;
    $fp = fopen($zip_file, "r");
    while(!feof($fp)) 
    {
        $i++;
        if ($i%1000==0)
        {
            echo "<script>document.getElementById('content').innerHTML += '��';</script>\n";
            flush();
        }

        $s = fgets($fp, 4096);
        $s = preg_replace("/_TABLE_ZIP_/", $g4[zip_table], $s);
        $s = preg_replace("/;/", "", $s);
        sql_query($s);
    }
    $str = "<br><br>�� ".number_format($i)." ���� �����ȣ �ڷḦ �����Ͽ����ϴ�.";
} 
else 
{
    $str = "<br><br>�����ȣ �ڷ�($zip_file)�� �������� �ʽ��ϴ�.";
}
$str .= "<br><br>[��]";

echo "<script>document.getElementById('content').innerHTML += '$str';</script>";
flush();
?>