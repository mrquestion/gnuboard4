<?
include_once("./_common.php");
include_once("$g4[path]/lib/mailer.lib.php");

if (!$member[mb_id] && $config[cf_formmail_is_member])
    alert_close("ȸ���� �̿��Ͻ� �� �ֽ��ϴ�.");

for ($i=1; $i<=$attach; $i++) {
    if ($_FILES["file".$i][name]) {
        $file[] = attach_file($_FILES["file".$i][name], $_FILES["file".$i][tmp_name]);
    }
}

$content = stripslashes($content);
if ($type == 2) {
    $type = 1;
    $content = preg_replace("/\n/", "<br>", $content);
} 

// html �̸�
if ($type) 
{
    $current_url = $g4[url];
    $mail_content = "<html><head><meta http-equiv='content-type' content='text/html; charset=$cfg[charset]'><title>���Ϻ�����</title><link rel='stylesheet' href='$current_url/style.css' type='text/css'></head><body>$content</body></html>";
} 
else 
    $mail_content = $content;

$to = base64_decode($to);
//$tmp_to = "***" . substr($to, 3, strlen($to)-3);

mailer($fnick, $fmail, $to, $subject, $mail_content, $type, $file, $cfg[charset]);

//$html_title = $tmp_to . "�Բ� ���Ϲ߼�";
$html_title = "���� �߼���";
include_once("$g4[path]/head.sub.php");

alert_close("������ ���������� �߼��Ͽ����ϴ�.");

include_once("$g4[path]/tail.sub.php");
?>