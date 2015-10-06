<?
$g4_path = "..";
include_once ("$g4_path/common.php");

// ��Ų��θ� ��´�
function get_skin_dir($skin, $len='')
{
    global $g4;

    $result_array = array();

    $dirname = "$g4[path]/skin/$skin/";
    $handle = opendir($dirname);
    while ($file = readdir($handle)) 
    {
        if($file == "."||$file == "..") continue;

        if (is_dir($dirname.$file)) $result_array[] = $file;
    }
    closedir($handle);
    sort($result_array);

    return $result_array;
}

// ȸ�� ����
function member_delete($mb_id)
{
    global $config;
    global $g4;

    $sql = " select mb_recommend from $g4[member_table] where mb_id= '$mb_id' ";
    $mb = sql_fetch($sql);
    if ($mb[mb_recommend]) {
        $row = sql_fetch(" select count(*) as cnt from $g4[member_table] where mb_id = '$mb[mb_recommend]' ");
        if ($row[cnt])
            insert_point($mb[mb_recommend], $config[cf_recommend_point] * (-1), "{$mb_id}���� ȸ���ڷ� ������ ���� ��õ�� ����Ʈ ��ȯ");
    }

    $mb = sql_fetch(" select mb_name, mb_ip from $g4[member_table] where mb_id = '$mb_id' ");
    
    // ȸ�� �ڷ� ����
    sql_query(" delete from $g4[member_table] where mb_id = '$mb_id' ");

    // �ٸ� ����� �� ȸ�����̵� ������� ���ϵ��� ���̵� ������ �����ϴ�.
    // �Խ��ǿ��� ȸ�����̵�� �������� �ʱ� �����Դϴ�.
    sql_query(" insert into $g4[member_table] set mb_id = '$mb_id', mb_name='$mb[mb_name]', mb_nick='[������]', mb_ip='$mb[mb_ip]', mb_datetime = '$g4[time_ymdhis]' ");
    
    // ����Ʈ ���̺��� ����
    sql_query(" delete from $g4[point_table] where mb_id = '$mb_id' ");
    
    // �׷����ٰ��� ����
    sql_query(" delete from $g4[group_member_table] where mb_id = '$mb_id' ");
    
    // ���� ����
    sql_query(" delete from $g4[memo_table] where me_recv_mb_id = '$mb_id' or me_send_mb_id = '$mb_id' ");
    
    // ��ũ�� ����
    sql_query(" delete from $g4[scrap_table] where mb_id = '$mb_id' ");
    
    // �������� ����
    sql_query(" delete from $g4[auth_table] where mb_id = '$mb_id' ");

    // �׷�������� ��� �׷�����ڸ� �������� 
    sql_query(" update $g4[group_table] set gr_admin = '' where gr_admin = '$mb_id' ");

    // �Խ��ǰ������� ��� �Խ��ǰ����ڸ� ��������
    sql_query(" update $g4[board_table] set bo_admin = '' where bo_admin = '$mb_id' ");

    // ������ ����
    @unlink("$g4[path]/data/member/".substr($mb_id,0,2)."/$mb_id.gif");
}


// ȸ�������� SELECT �������� ����
function get_member_level_select($name, $start_id=0, $end_id=10, $selected='', $event='')
{
    global $g4;

    $str = "<select name='$name' $event>";
    for ($i=$start_id; $i<=$end_id; $i++)
    {
        $str .= "<option value='$i'";
        if ($i == $selected) 
            $str .= " selected";
        $str .= ">$i</option>";
    }
    $str .= "</select>";
    return $str;
}


// ȸ�����̵��� SELECT �������� ����
function get_member_id_select($name, $level, $selected='', $event='')
{
    global $g4;

    $sql = " select mb_id from $g4[member_table] where mb_level >= '$level' ";
    $result = sql_query($sql);
    $str = "<select name='$name' $event><option value=''>���þ���";
    for ($i=0; $row=sql_fetch_array($result); $i++) 
    {
        $str .= "<option value='$row[mb_id]'";
        if ($row[mb_id] == $selected) $str .= " selected";
        $str .= ">$row[mb_id]</option>";
    }
    $str .= "</select>";
    return $str;
}

// ���� �˻�
function auth_check($auth, $attr)
{
    global $is_admin;

    if ($is_admin == "super") return;

    if (!trim($auth))
        alert("�� �޴����� ���� ������ �����ϴ�.\\n\\n���� ������ �ְ�����ڸ� �ο��� �� �ֽ��ϴ�.");

    $attr = strtolower($attr);

    if (!strstr($auth, $attr)) {
        if ($attr == "r")
            alert("���� ������ �����ϴ�.");
        else if ($attr == "w")
            alert("�Է�, �߰�, ����, ���� ������ �����ϴ�.");
        else if ($attr == "d")
            alert("���� ������ �����ϴ�.");
        else 
            alert("�Ӽ��� �߸� �Ǿ����ϴ�.");
    }
}


// �ؽ�Ʈ������ �ø���, ���̱�
function textarea_size($fld) 
{
    global $cfg, $admin_dir;

    $size = 10;
    $s  = "<table cellpadding=2 cellspacing=0 border=0 width=100%><tr><td align=right>";
    $s .= "<span onclick=\"javascript:textarea_size(document.getElementById('$fld'), {$size})\"><img src='./img/btn_up.gif' border=0 align=absmiddle></span> ";
    $s .= "<span onclick=\"javascript:textarea_size(document.getElementById('$fld'), ".$size*(-1).")\"><img src='./img/btn_down.gif' border=0 align=absmiddle></span>";
    $s .= "&nbsp;&nbsp;</td></tr></table>";
    return $s;
}


// �۾������� ���
function icon($act, $link="", $target="_parent")
{
    global $cfg;

    $img = array("�Է�"=>"insert", "�߰�"=>"insert", "����"=>"insert", "����"=>"modify", "����"=>"delete", "�̵�"=>"move", "�׷�"=>"move", "����"=>"view", "�̸�����"=>"view");
    $icon = "<img src='./img/icon_{$img[$act]}.gif' border=0 align=absmiddle title='$act' width=22 height=21>";
    if ($link)
        $s = "<a href=\"$link\" target=\"$target\">$icon</a>";
    else
        $s = $icon;
    return $s;
}


// rm -rf �ɼ� : exec(), system() �Լ��� ����� �� ���� ���� �Ǵ� win32�� ��ü
// www.php.net ���� : pal at degerstrom dot com
function rm_rf($file) 
{
    if (file_exists($file)) {
        @chmod($file,0777);
        if (is_dir($file)) {
            $handle = opendir($file); 
            while($filename = readdir($handle)) {
                if ($filename != "." && $filename != "..") 
                    rm_rf("$file/$filename");
            }
            closedir($handle);
            rmdir($file);
        } else 
            unlink($file);
    }
}

function top_menu($m, $title, $link, $color)
{
    global $ttitle, $tlink, $tcolor, $tmenu;

    $ttitle[$m[1]] = $title;
    $tlink[$m[1]]  = $link;
    $tcolor[$m[1]] = $color;
    $tmenu[$m[1]]  = disp_top_menu($title, $link, $color);
}

function sub_menu($m, $title, $link="", $target='_parent')
{
    global $stitle, $slink, $smenu, $auth_menu;

    $stitle[$m[1]][$m[2]] = $title;
    $slink[$m[1]][$m[2]]  = $link;
    $smenu[$m[1]][$m[2]]  = disp_sub_menu($title, $link, $target);
    $auth_menu[$m[1].$m[2]] = $title;
}

function sub_menu2($m, $title, $link="", $target='_parent')
{
    global $stitle, $slink, $smenu, $auth_menu, $smenu2;

    $stitle[$m[1]][$m[2]] = $title;
    $slink[$m[1]][$m[2]]  = $link;
    $smenu[$m[1]][$m[2]]  = disp_sub_menu2($title, $link, $target);
    $auth_menu[$m[1].$m[2]] = $title;
    $smenu2[$m[1]][$m[2]] = TRUE; // ����޴�
}

function help($help="", $left=0, $top=0)
{
    global $admin_dir;
    static $idx = 0;

    $idx++;

    $help = preg_replace("/\n/", "<br>", $help);
    
    $str  = "<img src='./img/icon_help.gif' border=0 width=15 height=15 align=absmiddle onclick=\"help('help$idx', $left, $top);\" style='cursor:hand;'>";
    //$str .= "<div id='help$idx' style='position:absolute; top:0px; left:0px; display:none;'>";
    $str .= "<div id='help$idx' style='position:absolute; display:none;'>";
    $str .= "<div id='csshelp1'><div id='csshelp2'><div id='csshelp3'>$help</div></div></div>";
    $str .= "</div>";

    return $str;
}

// ���� ���� �˻�
if (!$member[mb_id])
    alert("�α��� �Ͻʽÿ�.", "$g4[bbs_path]/login.php?url=" . urlencode("$_SERVER[PHP_SELF]?w=$w&mb_id=$mb_id"));
else if ($is_admin != "super") {
    $auth = array();
    $sql = " select au_menu, au_auth from $g4[auth_table] where mb_id = '$member[mb_id]' ";
    $result = sql_query($sql);
    for($i=0; $row=sql_fetch_array($result); $i++) {
        $auth[$row[au_menu]] = $row[au_auth];
    }

    if (!$i)
        alert("�ְ������ �Ǵ� ���������� �ִ� ȸ���� ���� �����մϴ�.", $g4[path]);
}

@ksort($auth);
$menu = substr($sub_menu, 0, 3);

// ���� �޴�
$amenu = array();
$tmp = dir("$g4[admin_path]/menu");
while ($entry = $tmp->read()) {
    if (!preg_match("/^m([0-9]{3,6})(.*).php/", $entry, $m)) 
        continue;  // ���ϸ��� m ���� �������� ������ �����Ѵ�. 

    $amenu[$m[1]] = $entry;
}

@ksort($auth_menu);

$qstr = "sst=$sst&sod=$sod&sfl=$sfl&stx=$stx&page=$page";
?>
