<?
$sub_menu = "200";
include_once("./_common.php");

$g4[title] = "ȸ������";
include_once ("./admin.head.php");

echo "<script language='javascript' src='$g4[path]/js/sideview.js'></script>";

// ȸ������
if ($is_admin == "super" || strstr($auth["2010"], "r")) {
    $count = 5;
    $colspan = 9;
    echo "
    <table width=100% cellpadding=0 cellspacing=0>
    <tr>
        <td colspan='".($colspan-2)."' class='ht title'><img src='./img/icon_title.gif'> �ֱٿ� ������ ȸ�� ���� {$count}��</td>
        <td colspan='".($colspan - ($colspan-2))."' class='right'><a href='./member_list.php'>more</a>&nbsp;</td>
    </td>
    <tr><td colspan='$colspan' class='line1'></td></tr>
    <tr class='bgcol1 bold col1 ht center'>
        <td width='100'>ȸ�����̵�</td>
        <td width='100'>�̸�</td>
        <td width=''>����</td>
        <td width='100'>�������</td>
        <td width='30'>����</td>
        <td width='30'>����</td>
        <td width='30'>����</td>
        <td width='110'>�����Ͻ�</td>
        <td width='110'>IP</td>
    </tr>
    <tr><td colspan='$colspan' class='line2'></td></tr>
    ";

    $sql = " select * from $g4[member_table] order by mb_datetime desc limit $count ";
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $mb_nick = get_sideview($row[mb_id], $row[mb_nick], $row[mb_email], $row[mb_homepage]);

        $list = $i%2;
        echo "
        <tr class='list$list col1 ht center'>
            <td>$row[mb_id]</td>
            <td>$row[mb_name]</td>
            <td>$mb_nick</td>
            <td>$row[mb_birth]</td>
            <td>$row[mb_sex]</td>
            <td>".($row[mb_mailling]?'&radic;':'&nbsp;')."</td>
            <td>".($row[mb_open]?'&radic;':'&nbsp;')."</td>
            <td>$row[mb_datetime]</td>
            <td>$row[mb_ip]</td>
        </tr>
        ";
    }

echo "
<tr><td colspan='$colspan' class='line2'></td></tr>
</table><br>
";
}


// ����Ʈ����
if ($is_admin == "super" || strstr($auth["2020"], "r")) {
    $count = 5;
    $colspan = 6;
    echo "
    <table width=100% cellpadding=0 cellspacing=0>
    <tr>
        <td colspan='".($colspan-2)."' class='ht title'><img src='./img/icon_title.gif'> �ֱٿ� �ο��� ����Ʈ ���� {$count}��</td>
        <td colspan='".($colspan - ($colspan-2))."' class='right'><a href='./point_list.php'>more</a>&nbsp;</td>
    </td>
    <tr><td colspan='$colspan' class='line1'></td></tr>
    <tr class='bgcol1 bold col1 ht center'>
        <td width='100'>ȸ�����̵�</td>
        <td width='100'>����</td>
        <td width='140'>�Ͻ�</td>
        <td width=''>����Ʈ ����</td>
        <td width='80'>����Ʈ</td>
        <td width='80'>����Ʈ��</td>
    </tr>
    <tr><td colspan='$colspan' class='line2'></td></tr>
    ";

    $sql = " select * from $g4[point_table] a left join $g4[member_table] b on (a.mb_id=b.mb_id) order by po_id desc limit $count ";
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $mb_nick = get_sideview($row[mb_id], $row[mb_nick], $row[mb_email], $row[mb_homepage]);

        $list = $i%2;
        echo "
        <tr class='list$list col1 ht center'>
            <td>$row[mb_id]</td>
            <td>$mb_nick</td>
            <td>$row[po_datetime]</td>
            <td align=left>&nbsp;$row[po_content]</td>
            <td align=right>".number_format($row[po_point])."&nbsp;</td>
            <td align=right>".number_format($row[mb_point])."&nbsp;</td>
        </tr>
        ";
    }

echo "
<tr><td colspan='$colspan' class='line2'></td></tr>
</table><br>
";
}


// ��������Ȳ
if ($is_admin == "super" || strstr($auth["2080"], "r")) {
    include_once("$g4[path]/lib/visit.lib.php");

    $count = 5;
    $colspan = 5;
    echo "
    <table width=100% cellpadding=0 cellspacing=0>
    <tr>
        <td colspan='".($colspan-2)."' class='ht title'><img src='./img/icon_title.gif'> �ֱ� ���� ���� {$count}��</td>
        <td colspan='".($colspan - ($colspan-2))."' class='right'><a href='./visit_list.php'>more</a>&nbsp;</td>
    </td>
    <tr><td colspan='$colspan' class='line1'></td></tr>
    <tr class='bgcol1 bold col1 ht center'>
        <td width=100>IP</td>
        <td width=350>���� ���</td>
        <td width=100>������</td>
        <td width=100>OS</td>
        <td width=''>�Ͻ�</td>
    </tr>
    <tr><td colspan='$colspan' class='line2'></td></tr>
    ";

    $sql = " select * from $g4[visit_table] order by vi_id desc limit $count ";
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $brow = get_brow($row[vi_agent]);
        $os   = get_os($row[vi_agent]);

        $link = "";
        $referer = "";
        $title = "";
        if ($row[vi_referer]) {
            $referer = get_text(cut_str($row[vi_referer], 255, ""));
            $title = urldecode($row[vi_referer]);
            $link = "<a href='$row[vi_referer]' target=_blank title='$title '>";
        }

        $list = $i%2;
        echo "
        <tr class='list$list col1 ht center'>
            <td>$row[vi_ip]</td>
            <td align=left><nobr style='display:block; overflow:hidden; width:350;'>$link$title</a></nobr></td>
            <td>$brow</td>
            <td>$os</td>
            <td>$row[vi_date] $row[vi_time]</td>
        </tr>
        ";
    }

echo "
<tr><td colspan='$colspan' class='line2'></td></tr>
</table><br>
";
}

include_once ("./admin.tail.php");
?>
