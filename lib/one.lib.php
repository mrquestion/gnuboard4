<?
if (!defined('_GNUBOARD_')) exit;

function upload_file2($path, $file) {
    global $g4;

    if (!$file[name]) return '';

    $tmp_file  = $file[tmp_name];
    $filename  = $file[name];
    $filesize  = $file[size];
    $error = $file[error];

    if ($error == 1) {
        alert("\'{$filename}\' ������ �뷮�� ������ ����($upload_max_filesize)�� ������ ũ�Ƿ� ���ε� �� �� �����ϴ�.\\n");
        exit;
    } else if ($error != 0) {
        alert("\'{$filename}\' ������ ���������� ���ε� ���� �ʾҽ��ϴ�.\\n");
        exit;
    }

    // �Ʒ��� ���ڿ��� �� ������ -x �� �ٿ��� ����θ� �˴��� ������ ���� ���ϵ��� ��
    $filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

    // �޺��µ��� ���� : �ѱ������� urlencode($filename) ó���� �Ұ�� '%'�� �ٿ��ְ� �Ǵµ� '%'ǥ�ô� �̵���÷��̾ �ν��� ���ϱ� ������ ����� �ȵ˴ϴ�. �׷��� ������ ���ϸ��� '%'�κ��� ���ָ� �ذ�˴ϴ�. 
    $filename = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr(md5(uniqid($g4[server_time])),0,8).'_'.str_replace('%', '', urlencode($filename)); 

    $dest_file = $path.'/'.$filename;

    // ���ε尡 �ȵȴٸ� �����޼��� ����ϰ� �׾�����ϴ�.
    $error_code = move_uploaded_file($tmp_file, $dest_file) or die($file[error]);

    // �ö� ������ �۹̼��� �����մϴ�.
    chmod($dest_file, 0606);

    return $filename;
}
?>