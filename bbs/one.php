<?
include_once("_common.php");

if (!$is_member)
    goto_url("login.php?url=".urlencode("one.php"));

$oneboard = sql_fetch(" select * from $g4[oneboard_table] where ob_table = '$ob_table' ");
if (!$oneboard[ob_table])
    alert("�����ϴ� 1:1 �Խ����� �ƴմϴ�.");

if ($member[mb_level] < $oneboard[ob_write_level])
    alert("ȸ�� ���� {$oneboard[ob_write_level]} �̻� ������ �����մϴ�.");

if ($oneboard[ob_admin] && $oneboard[ob_admin]==$member[mb_admin])
    $is_admin = true;

$g4[title] = $oneboard[ob_subject];

$width = $oneboard[ob_table_width];
if ($width <= 100) $width .= '%';

$is_dhtml_editor = $oneboard[ob_use_dhtml_editor];

$oneboard_skin_path = "$g4[path]/skin/oneboard/$oneboard[ob_skin]";

if (isset($w)) {
    if (!($w=='i' || $w=='u')) {
        alert('�Է� �Ǵ� ������ �����մϴ�.');
    }

    if ($w=='u') {
        $sql = " select * from $g4[one_prefix]$ob_table where on_id = '$on_id' ";
        $one = sql_fetch($sql);
        
        if (!$is_admin) {
            if ($one[mb_no] != $member[mb_no])
                alert("�ڽ��� �۸� ������ �����մϴ�.");
        }
    }
} else if ($on_id) {
    set_session("ss_one_{$ob_table}", $on_id);

    $sql = " select * from $g4[one_prefix]$ob_table where on_id = '$on_id' ";
    $one = sql_fetch($sql);
    if (!$is_admin) {
        if ($one[mb_no] != $member[mb_no])
            alert("�ڽ��� �۸� Ȯ���� �����մϴ�.");
    }
}

include_once("$g4[path]/head.sub.php");

// �Խ��� ������ ��� ���� ���
if ($oneboard[ob_include_head]) 
    @include ($oneboard[ob_include_head]); 

// �Խ��� ������ ��� �̹��� ���
if ($oneboard[ob_image_head]) 
    echo "<img src='$g4[path]/data/one/$ob_table/$oneboard[ob_image_head]' border='0'>";

// �Խ��� ������ ��� ����
if ($oneboard[ob_content_head]) 
    echo stripslashes($oneboard[ob_content_head]); 



if (isset($w)) {
    if ($board[ob_write_level] > $member[mb_level]) 
        alert("ȸ�� ���� {$board[ob_write_level]} �̻� �۾��Ⱑ �����մϴ�.");

    include_once("oneform.php");
} else if ($on_id) {
    include_once("oneview.php");
} else {
    include_once("onelist.php"); 
}



// �Խ��� ������ �ϴ� ����
if ($oneboard[ob_content_tail]) 
    echo stripslashes($oneboard[ob_content_tail]); 

// �Խ��� ������ �ϴ� �̹��� ���
if ($oneboard[ob_image_tail]) 
    echo "<img src='$g4[path]/data/one/$ob_table/$oneboard[ob_image_tail]' border='0'>";

// �Խ��� ������ �ϴ� ���� ���
if ($oneboard[ob_include_tail]) 
    @include ($oneboard[ob_include_tail]); 

include_once("$g4[path]/tail.sub.php");
?>