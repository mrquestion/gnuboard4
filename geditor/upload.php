<?
include_once("./_common.php");

// --
// ÷�� �̹��� ���� ���丮 
// --

$path = "$g4[path]/data/$g4[geditor]";

// --

make_dir($path);

$obj   = $_POST[obj];
$token = $_POST[token];
$work  = $_POST[work];

if (!$token) exit;

if (!$obj) 
    alert_only('������Ʈ ������ �����ϴ�.');

if ($work == 'delete') {
    delete_image($token, $path.'/'.date('ym'));
    exit;
}

$file = $_FILES[image];
$size = getImageSize($file[tmp_name]);
$mime = array('image/png', 'image/jpeg', 'image/gif');

if (!is_uploaded_file($file[tmp_name]))
    alert_only("÷�������� ���ε���� �ʾҽ��ϴ�.\\n\\n$file[error]");

if (!preg_match("/\.(gif|png|jp[e]?g)$/i", $file[name]))
    alert_only("PNG, GIF, JPG ������ �̹��� ���ϸ� ���ε� �����մϴ�.");

if (!in_array($size['mime'], $mime))
    alert_only("PNG, GIF, JPG ������ �̹��� ���ϸ� ���ε� �����մϴ�..");

if (!is_dir($path))
    alert_only("$path ���丮�� �������� �ʽ��ϴ�.");

if (!is_writable($path))
    alert_only("$path ���丮�� �۹̼��� 707�� �������ּ���.");

add_index($path);

$path .= '/'.date('ym');
make_dir($path);

delete_image($token, $path);

$dest_file = $path.'/'.abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr(md5(uniqid($g4[server_time])),0,8).'_'.str_replace('%', '', urlencode($file[name]));
$count = 0;

while (file_exists($dest_file))
    $dest_file = $path.'/['.$count++.']'.$file[name];

move_uploaded_file($file[tmp_name], $dest_file);

chmod($dest_file, 0606);

$file = dirname($HTTP_SERVER_VARS["PHP_SELF"]).'/'.$dest_file;

setCookie('ge_token', $token);
setCookie('ge_file', $dest_file);

function add_index($path) {
    $indexfile = $path."/index.php";
    $f = @fopen($indexfile, "w");
    @fwrite($f, "");
    @fclose($f);
    @chmod($indexfile, 0606);
}

function delete_image($token, $path) {
    global $_COOKIE;
    if ($token==$_COOKIE[ge_token]) {
        if (substr($_COOKIE[ge_file], 0, strlen($path))==$path) {
            if (file_exists($_COOKIE[ge_file])) {
                @unlink($_COOKIE[ge_file]);
            }
        }
    }
}

function alert_only($msg='', $url='') {
    echo "<script language='javascript'>alert('$msg'); </script>";
    exit;
}

function make_dir($path)
{
    if (!is_dir($path)) 
    {
        @mkdir($path, 0707);
        @chmod($path, 0707);

        if (!is_dir($path))
            alert_only('���丮 ������ �����Ͽ����ϴ�.');

        add_index($path);
    }
}

?>
<script language="javascript">
parent.<?=$obj?>.insert_image_preview("<?=$file?>");
</script>