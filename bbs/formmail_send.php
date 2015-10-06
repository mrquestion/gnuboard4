<?
include_once("./_common.php");
include_once("$g4[path]/lib/mailer.lib.php");

if (!$is_member && $config[cf_formmail_is_member])
    alert_close("회원만 이용하실 수 있습니다.");

if (!$is_admin)
{
    $sendmail_count = (int)get_session('ss_sendmail_count') + 1;
    if ($sendmail_count > 3)
        alert_close('한번 접속후 일정수의 메일만 발송할 수 있습니다.\n\n계속해서 메일을 보내시려면 다시 로그인 또는 접속하여 주십시오.');
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

// html 이면
if ($type) 
{
    $current_url = $g4[url];
    $mail_content = "<html><head><meta http-equiv='content-type' content='text/html; charset=$cfg[charset]'><title>메일보내기</title><link rel='stylesheet' href='$current_url/style.css' type='text/css'></head><body>$content</body></html>";
} 
else 
    $mail_content = $content;

$to = base64_decode($to);

mailer($fnick, $fmail, $to, $subject, $mail_content, $type, $file, $cfg[charset]);

//$html_title = $tmp_to . "님께 메일발송";
$html_title = "메일 발송중";
include_once("$g4[path]/head.sub.php");

alert_close("메일을 정상적으로 발송하였습니다.");

include_once("$g4[path]/tail.sub.php");
?>