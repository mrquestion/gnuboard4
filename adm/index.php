<?
include_once("./_common.php");

$g4[title] = "기본환경설정";
include_once ("./admin.head.php");

echo "<table width=100% border=0><tr>";
$i = 0;
$mod = 4;
$width = (int)(100 / $mod);
foreach($ttitle as $key=>$value) {
    if ($i%4==0 && $i)
        echo "</tr><tr>";

    echo "<td valign=top width='$width%' align=center>";
    echo "<table width=100% cellpadding=0 cellspacing=0>";
    echo "<tr>";
    echo "<td style='background-color:$tcolor[$key]' class='ht'>&nbsp;<span style='color:white;'><strong>&nbsp;&middot; </strong></span>";
    if ($tlink[$key]) {
        echo "<a href='$tlink[$key]' style='text-decoration:none;'";
        if ($ttarget[$key])
            echo " target='$ttarget[$key]'";
        echo ">";
    }
    echo "<span style='color:white;'><strong>$ttitle[$key]</strong></span>";
    echo "</a>";
    echo "</td>";
    echo "</tr>";
    $k = 0;
    foreach($stitle[$key] as $k=>$v) {
        if (!strstr($auth[$key.$k], "r") && $is_admin != "super")
            continue;

        if ($smenu2[$key][$k]) continue;

        echo "<tr><td height=20>&nbsp; &middot; ";
        echo disp_sub_menu($stitle[$key][$k], $slink[$key][$k], $starget[$key][$k]);
        echo "</td></tr>";
    }
    echo "</table>";
    echo "</td>";
    $i++;
}
echo "</tr></table>";

include_once ("./admin.tail.php");
?>
