<?
include_once("./_common.php");

//@include_once("$board_skin_path/download.head.skin.php");

if (!$is_member) { 
    alert("ȸ���� �ٿ�ε尡 �����մϴ�.");
}

// ���ǿ� ����� ID���� �Ѿ�� ID���� ���Ͽ� ���� ���� ��� ���� �߻�
// �ٸ������� ��ũ �Ŵ°��� �����ϱ� ���� �ڵ�
if (get_session("ss_one_{$ob_table}") && get_session("ss_one_{$ob_table}") != $on_id) 
    alert("�߸��� �����Դϴ�.");  

// $flag �� on_qfile �Ǵ� on_afile �߿� �ϳ�
// $flag == "q" : on_qfile
// $flag == "a" : on_afile
$row = sql_fetch(" select on_{$flag}file as file, on_{$flag}source as source from $g4[one_prefix]$ob_table where on_id = '$on_id' ");
$filename = $row['file'];
$source = $row['source'];
if (!$filename)
    alert("���� ������ �������� �ʽ��ϴ�.");

$filepath = "$g4[path]/data/one/$ob_table/$filename";
$filepath = addslashes($filepath);
if (preg_match("/^utf/i", strtolower($g4[charset])))
    $original = urlencode($source);
else
    $original = $source;

if (file_exists($filepath)) {
    if(eregi("msie", $_SERVER[HTTP_USER_AGENT]) && eregi("5\.5", $_SERVER[HTTP_USER_AGENT])) {
        header("content-type: doesn/matter");
        header("content-length: ".filesize("$filepath"));
        header("content-disposition: attachment; filename=\"$original\"");
        header("content-transfer-encoding: binary");
    } else {
        header("content-type: file/unknown");
        header("content-length: ".filesize("$filepath"));
        header("content-disposition: attachment; filename=\"$original\"");
        header("content-description: php generated data");
    }
    header("pragma: no-cache");
    header("expires: 0");
    flush();

    if (is_file("$filepath")) {
        $fp = fopen("$filepath", "rb");

        while(!feof($fp)) { 
            echo fread($fp, 100*1024); 
            flush(); 
        } 
        fclose ($fp); 
        flush();
    } else {
        alert("�ش� �����̳� ��ΰ� �������� �ʽ��ϴ�.");
    }

} else {
    alert("������ ã�� �� �����ϴ�.");
}
?>