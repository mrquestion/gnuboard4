<?
include_once("./_common.php");

// ���۷� üũ
referer_check();

if (!($w == "" || $w == "u")) 
    alert("w ���� ����� �Ѿ���� �ʾҽ��ϴ�.");

if ($w == "u" && $is_admin == "super") {
    if (file_exists("$g4[path]/DEMO")) 
        alert("���� ȭ�鿡���� �Ͻ�(����) �� ���� �۾��Դϴ�.");
}

// �ڵ���Ϲ��� �˻�
include_once ("./norobot_check.inc.php");

$mb_id = trim(strip_tags($_POST[mb_id]));
$mb_password = trim($_POST[mb_password]);
$mb_name = trim(strip_tags($_POST[mb_name]));
$mb_nick = trim(strip_tags($_POST[mb_nick]));
$mb_email = trim(strip_tags($_POST[mb_email]));

if ($w == "" || $w == "u") {
    if (!$mb_id) alert("ȸ�����̵� �Ѿ���� �ʾҽ��ϴ�.");
    if ($w == "" && !$mb_password) alert("�н����尡 �Ѿ���� �ʾҽ��ϴ�.");
    if (!$mb_name) alert("�̸�(�Ǹ�)�� �Ѿ���� �ʾҽ��ϴ�.");
    if (!$mb_nick) alert("������ �Ѿ���� �ʾҽ��ϴ�.");
    if (!$mb_email) alert("E-mail �� �Ѿ���� �ʾҽ��ϴ�.");
}

if ($w=='')
    if ($mb_id == $mb_recommend) alert("������ ��õ�� �� �����ϴ�.");

$mb_dir = "$g4[path]/data/member/".substr($mb_id,0,2);

// ������ ����
if ($del_mb_icon)
    @unlink("$mb_dir/$mb_id.gif");

$msg = "";

// ������ ���ε�
$mb_icon = "";
if (is_uploaded_file($_FILES[mb_icon][tmp_name])) {
    if (preg_match("/(\.gif)$/i", $_FILES[mb_icon][name])) {
        // ������ �뷮�� ���������� ���ϸ� ���ε� ����
        if ($_FILES[mb_icon][size] <= $config[cf_member_icon_size]) {
            @mkdir($mb_dir, 0707);
            @chmod($mb_dir, 0707);
            $dest_path = "$mb_dir/$mb_id.gif";
            move_uploaded_file($_FILES[mb_icon][tmp_name], $dest_path);
            chmod($dest_path, 0606);
            if (file_exists($dest_path)) {
                $size = getimagesize($dest_path);
                // �������� �� �Ǵ� ���̰� ������ ���� ũ�ٸ� �̹� ���ε� �� ������ ����
                if ($size[0] > $config[cf_member_icon_width] || $size[1] > $config[cf_member_icon_height])
                    @unlink($dest_path);
            }
        }
    }
    else
        $msg .= $_FILES[mb_icon][name] . "��(��) gif ������ �ƴմϴ�.";
}

if ($w == "") {
    $mb = get_member($mb_id);
    if ($mb[mb_id]) 
        alert("�̹� ������ ���̵��Դϴ�.");

    $sql = " insert into $g4[member_table]
                set mb_id = '$mb_id',
                    mb_password = '".sql_password($mb_password)."',
                    mb_name = '$mb_name',
                    mb_jumin = '$mb_jumin',
                    mb_sex = '$mb_sex',
                    mb_birth = '$mb_birth',
                    mb_nick = '$mb_nick',
                    mb_nick_date = '$g4[time_ymd]',
                    mb_password_q = '$mb_password_q',
                    mb_password_a = '$mb_password_a',
                    mb_email = '$mb_email',
                    mb_homepage = '$mb_homepage',
                    mb_tel = '$mb_tel',
                    mb_hp = '$mb_hp',
                    mb_zip1 = '$mb_zip1',
                    mb_zip2 = '$mb_zip2',
                    mb_addr1 = '$mb_addr1',
                    mb_addr2 = '$mb_addr2',
                    mb_signature = '$mb_signature',
                    mb_profile = '$mb_profile',
                    mb_datetime = '$g4[time_ymdhis]',
                    mb_ip = '$_SERVER[REMOTE_ADDR]',
                    mb_level = '$config[cf_register_level]',
                    mb_recommend = '$mb_recommend',
                    mb_login_ip = '$_SERVER[REMOTE_ADDR]',
                    mb_mailling = '$mb_mailling',
                    mb_open = '$mb_open',
                    mb_1 = '$mb_1',
                    mb_2 = '$mb_2',
                    mb_3 = '$mb_3',
                    mb_4 = '$mb_4',
                    mb_5 = '$mb_5',
                    mb_6 = '$mb_6',
                    mb_7 = '$mb_7',
                    mb_8 = '$mb_8',
                    mb_9 = '$mb_9',
                    mb_10 = '$mb_10' ";
    sql_query($sql);

    // ȸ������ ����Ʈ �ο�
    insert_point($mb_id, $config[cf_register_point], "ȸ������ ����", '@member', $mb_id, 'ȸ������');

    // ��õ�ο��� ����Ʈ �ο�
    if ($config[cf_use_recommend] && $mb_recommend)
        insert_point($mb_recommend, $config[cf_recommend_point], "{$mb_id}�� ��õ��", '@member', $mb_recommend, "{$mb_id} ��õ");

    // ���� �߼�
    {
        include_once("$g4[path]/lib/mailer.lib.php");

        // ȸ���Բ� ���� �߼�
        $subject = "ȸ�������� ���ϵ帳�ϴ�.";
        
        ob_start();
        include_once ("./register_form_update_mail1.php");
        $content = ob_get_contents();
        ob_end_clean();
        
        mailer($admin[mb_nick], $admin[mb_email], $mb_email, $subject, $content, 1);

        // �����ڴԲ� ���� �߼�
        $admin = get_admin('super');

        $subject = $mb_nick . " �Բ��� ȸ������ �����ϼ̽��ϴ�.";
        
        ob_start();
        include_once ("./register_form_update_mail2.php");
        $content = ob_get_contents();
        ob_end_clean();

        mailer($mb_nick, $mb_email, $admin[mb_email], $subject, $content, 1);
    }
} else if ($w == "u") {
    if (!trim($_SESSION["ss_mb_id"]))
        alert("�α��� �Ǿ� ���� �ʽ��ϴ�.");

    if ($_SESSION["ss_mb_id"] != $_POST[mb_id])
        alert("�α��ε� ������ �����Ϸ��� ������ Ʋ���Ƿ� ������ �� �����ϴ�.\\n\\n���� �ùٸ��� ���� ����� ����ϽŴٸ� �ٷ� �����Ͽ� �ֽʽÿ�.");

    $sql_password = "";
    if ($mb_password)
        $sql_password = " , mb_password = '".sql_password($mb_password)."' ";

    $sql_icon = "";
    if ($mb_icon)
        $sql_icon = " , mb_icon = '$mb_icon' ";

    $sql_nick_date = "";
    if ($mb_nick_default != $mb_nick)
        $sql_nick_date =  " , mb_nick_date = '$g4[time_ymd]' ";


    $sql = " update $g4[member_table]
                set mb_name         = '$mb_name',
                    mb_nick         = '$mb_nick',
                    mb_password_q     = '$mb_password_q',
                    mb_password_a     = '$mb_password_a',
                    mb_open         = '$mb_open',
                    mb_mailling     = '$mb_mailling',
                    mb_email        = '$mb_email',
                    mb_homepage     = '$mb_homepage',
                    mb_tel          = '$mb_tel',
                    mb_hp           = '$mb_hp',
                    mb_zip1         = '$mb_zip1',
                    mb_zip2         = '$mb_zip2',
                    mb_addr1        = '$mb_addr1',
                    mb_addr2        = '$mb_addr2',
                    mb_signature    = '$mb_signature',
                    mb_profile      = '$mb_profile',
                    mb_1            = '$mb_1',
                    mb_2            = '$mb_2',
                    mb_3            = '$mb_3',
                    mb_4            = '$mb_4',
                    mb_5            = '$mb_5',
                    mb_6            = '$mb_6',
                    mb_7            = '$mb_7',
                    mb_8            = '$mb_8',
                    mb_9            = '$mb_9',
                    mb_10           = '$mb_10'
                    $sql_password 
                    $sql_icon 
                    $sql_nick_date
              where mb_id = '$_POST[mb_id]' ";
    sql_query($sql);
}

// ����� �ڵ� ����
@include_once ("$g4[path]/skin/member/$config[cf_member_skin]/register_update.skin.php");

if ($w == "") {
    set_session("ss_mb_id", $mb_id);
    set_session("ss_mb_reg", $mb_id);
}

if ($msg) {
    echo <<<HEREDOC
    <script language="JavaScript">
    alert("{$msg}");
    </script>
HEREDOC;
}


if ($w == "")
    goto_url("./register_result.php");
else if ($w == "u") {
    if ($mb_password)
        $tmp_password = $mb_password;
    else
        $tmp_password = get_session("ss_tmp_password");
    echo <<<HEREDOC
    <html><title></title></html><body>
    <form name="fregisterupdate" method="post" action="./register_form.php">
    <input type="hidden" name="w" value="u">
    <input type="hidden" name="mb_id" value="{$mb_id}">
    <input type="hidden" name="mb_password" value="{$tmp_password}">
    </form>
    <script language="JavaScript">
    alert("ȸ�� ������ ���� �Ǿ����ϴ�.");
    document.fregisterupdate.submit();
    </script>
    </body>
    </html>
HEREDOC;
}
?>
