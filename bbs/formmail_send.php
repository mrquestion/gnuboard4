<?
include_once("./_common.php");
include_once("$g4[path]/lib/mailer.lib.php");

if (!$is_member && $config[cf_formmail_is_member])
    alert_close("ȸ���� �̿��Ͻ� �� �ֽ��ϴ�.");

if (!$is_admin)
{
    $sendmail_count = (int)get_session('ss_sendmail_count') + 1;
    if ($sendmail_count > 3)
        alert_close('�ѹ� ������ �������� ���ϸ� �߼��� �� �ֽ��ϴ�.\n\n����ؼ� ������ �����÷��� �ٽ� �α��� �Ǵ� �����Ͽ� �ֽʽÿ�.');
    set_session('ss_sendmail_count', $sendmail_count);
}

for ($i=1; $i<=$attach; $i++) 
{
    if ($_FILES["file".$i][name])
        $file[] = attach_file($_FILES["file".$i][name], $_FILES["file".$i][tmp_name]);
}

$content = stripslashes($content);
if ($type == 2) 
{
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

mailer($fnick, $fmail, $to, $subject, $mail_content, $type, $file, $cfg[charset]);

//$html_title = $tmp_to . "�Բ� ���Ϲ߼�";
$html_title = "���� �߼���";
include_once("$g4[path]/head.sub.php");

alert_close("������ ���������� �߼��Ͽ����ϴ�.");

include_once("$g4[path]/tail.sub.php");
?>