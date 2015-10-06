<?
include_once("./_common.php");

$g4[title] = "기본환경설정";
include_once ("./admin.head.php");

echo "<table width=100% border=0><tr>";
$i = 0;
$mod = 4;
$width = (int)(100 / $mod);
foreach($ttitle as $key=>$value) 
{
    if ($i%4==0 && $i)
        echo "</tr><tr>";

    echo "<td valign=top width='$width%' align=center>";
    echo "<table width=100% cellpadding=0 cellspacing=0>";
    echo "<tr>";
    echo "<td style='background-color:$tcolor[$key]' height=30 width=10><img src='./img/bg_left.gif' border=0 width=10 height=30></td>";
    echo "<td style='background-color:$tcolor[$key]' width='100%'><span style='color:white;'><strong>&middot; </strong></span>";
    if ($tlink[$key]) {
        echo "<a href='$tlink[$key]' style='text-decoration:none;'";
        if ($ttarget[$key])
            echo " target='$ttarget[$key]'";
        echo ">";
    }
    echo "<span style='color:white;'><strong>$ttitle[$key]</strong></span>";
    echo "</a></td>";
    echo "<td style='background-color:$tcolor[$key]' width=10><img src='./img/bg_right.gif' border=0 align=absmiddle width=10 height=30></td>";
    echo "</tr>";
    $k = 0;
    foreach($stitle[$key] as $k=>$v) {
        if (!strstr($auth[$key.$k], "r") && $is_admin != "super")
            continue;

        if ($smenu2[$key][$k]) continue;

        echo "<tr><td height=20 colspan=3>&nbsp; &middot; ";
        echo disp_sub_menu($stitle[$key][$k], $slink[$key][$k], $starget[$key][$k]);
        echo "</td></tr>";
    }
    echo "</table>";
    echo "</td>\n";
    $i++;
}

$cnt = $i % $mod;
if ($cnt)
    for ($k=$cnt; $k<$mod; $k++)
        echo "<td width='$width%'>&nbsp;</td>";

echo "</tr></table>";

include_once ("./admin.tail.php");
?>
