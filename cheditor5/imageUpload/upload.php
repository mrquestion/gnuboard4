<?php
// ---------------------------------------------------------------------------
//                              CHXImage
//
// �� �ڵ�� ���� ���ؼ� �����˴ϴ�.
// ȯ�濡 �°� ���� �Ǵ� �����Ͽ� ����� �ֽʽÿ�.
//
// ---------------------------------------------------------------------------

require_once("_config.php");

//----------------------------------------------------------------------------
//
//
$tempfile = $_FILES['file']['tmp_name'];
$filename = md5($_SERVER['REMOTE_ADDR']).'_'.$_FILES['file']['name'];

// ���� ���� �̸�
// md5(IP)_����Ͻú���_��������4��.Ȯ����
// 1234567890abcdef1234567890abcdef_20140327125959_abcd.jpg
$savefile = SAVE_DIR . '/' . $filename;

// �����PC�� ���� �̸�: $_POST["origName"]
// �����PC�� ���� ���: $_POST["filePath"]
// �����PC�� ���� ũ��: $_POST["filesize"]

// ������ Ȯ���ڰ� �̹����� �ƴ϶�� ����
if (!preg_match("/.(gif|jpe?g|png)$/i", $savefile))
    unlink($savefile);

move_uploaded_file($tempfile, $savefile);
$imgsize = getimagesize($savefile);
$filesize = filesize($savefile);

if (!$imgsize) {
	$filesize = 0;
	$random_name = '-ERR';
	unlink($savefile);
};

switch ($imgsize[2]) {
    case IMAGETYPE_GIF :    // 1
    case IMAGETYPE_JPEG :   // 2
    case IMAGETYPE_PNG :    // 3
        break;
    default :
        $filesize = 0;
        $random_name = '-ERR';
        unlink($savefile);
}

$rdata = sprintf('{"fileUrl": "%s/%s", "filePath": "%s", "fileName": "%s", "fileSize": "%d" }',
	SAVE_URL,
	$filename,
	$savefile,
	$filename,
	$filesize );

echo $rdata;
?>
