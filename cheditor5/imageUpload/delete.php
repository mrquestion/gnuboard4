<?php
require_once("_config.php");
// ---------------------------------------------------------------------------

$filepath = $_POST["filepath"];
$r = false;

# md5(ip)_��¥�ú���_���ϸ�.Ȯ����
preg_match('#\/([0-9a-f]+)_([0-9]+)_([a-z]+)\.(gif|png|jpe?g)$#i', $filepath, $m);
$md5ip = $m[1];
// �ڽ��� ���ε� �� ���ϸ� ������ �����ϰ� ��
if ($md5ip == md5($_SERVER['REMOTE_ADDR'])) {
    if (file_exists($filepath)) {
        $r = unlink($filepath);
        if ($r) {
            $thumbPath = dirname($filepath) . DIRECTORY_SEPARATOR . "thumb_" . basename($filepath);
            if (file_exists($thumbPath)) {
                unlink($thumbPath);
            }
        }
    }
}

echo $r ? true : false;
?>