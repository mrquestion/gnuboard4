<?
if (!defined("_GNUBOARD_")) exit;

$begin_time = get_microtime();

$title = "Admin";
if ($g4[title]) 
    $g4[title] = $title . " > " . $g4[title];
else
    $g4[title] = $title;

$g4[body_script] = "background='$g4[admin_path]/img/bg_body.jpg' style='background-repeat:repeat-x'";
include_once("$g4[path]/head.sub.php");
?>

<table width=1004 align=center><tr><td align=center>

<table width=98% cellpadding=0 cellspacing=0>
<tr>
    <td><img src='<?=$g4[admin_path]?>/img/navi_icon.gif' width=11 height=11 align=absmiddle> <font color=#FFFFFF><?=$g4[title]?></font></td>
    <td align=right>
        <a href="<?=$g4[path]?>/"><img src='<?=$g4[admin_path]?>/img/home.gif' width=45 height=15 border=0></a> 
        <a href="<?=$g4[bbs_path]?>/logout.php"><img src='<?=$g4[admin_path]?>/img/logout.gif' width=56 height=15 border=0></a> 
        <a href="<?=$g4[admin_path]?>/"><img src='<?=$g4[admin_path]?>/img/admin.gif' width=47 height=15 border=0></a>&nbsp;&nbsp;</td>
</tr>
</table><br>

<table width=98% cellpadding=0 cellspacing=0 border=0>
<colgroup width=9>
<colgroup>
<colgroup width=9>
<tr><td><img src='<?=$g4[admin_path]?>/img/box_co01.gif' width=9 height=10></td><td bgcolor=#FFFFFF></td><td><img src='<?=$g4[admin_path]?>/img/box_co02.gif' width=9 height=10></td></tr>
<tr bgcolor=#FFFFFF>
    <td></td>
    <td background='<?=$g4[admin_path]?>/img/m_split.gif'>
        <table cellpadding=0 cellspacing=0>
        <tr>
            <?
            ob_start();
            @ksort($amenu); // 키 순서대로 정렬한다
            foreach ($amenu as $key=>$value) 
                include_once("$g4[admin_path]/menu/" . $value);

            foreach($tmenu as $key=>$value) 
            {
                if ($key == substr($sub_menu,0,3))
                    echo "<td><img src='$g4[admin_path]/img/m_on_co01.gif' width=7 height=27></td><td style='padding:7 10 0 10;' background='$g4[admin_path]/img/m_on_bg.gif' align=center>$tmenu[$key]</td><td><img src='$g4[admin_path]/img/m_on_co02.gif' width=7 height=27></td>";
                else
                    echo "<td><img src='$g4[admin_path]/img/m_off_co01.gif' width=7 height=27></td><td style='padding:7 10 0 10;' background='$g4[admin_path]/img/m_off_bg.gif' align=center>$tmenu[$key]</td><td><img src='$g4[admin_path]/img/m_off_co02.gif' width=7 height=27></td>";
            }

            $head_contents = ob_get_contents();
            ob_end_clean();
            echo $head_contents;

            $tmp_menu = substr($sub_menu,0,3);
            $css_color = $tcolor[$tmp_menu];
            ?>
        </tr>
        </table>
    </td>
    <td></td>
</tr>
<tr bgcolor=#FFFFFF>
    <td></td>
    <td>
        <table width=100% cellpadding=0 cellspacing=0 align=center>
        <tr><td bgcolor=#E1E1E1 style='padding-left:1px; padding-right:1px; padding-bottom:1px'>
            <table cellpadding=0 cellspacing=0 width=100% bgcolor=#FFFFFF>
            <tr><td style='padding:10 0 10 0; line-height:200%;'>&nbsp;&nbsp;
                <img src='<?=$g4[admin_path]?>/img/sub_icon.gif' width=4 height=5 align=absmiddle> 
                    <?
                    if (count($smenu[$menu])) 
                    {
                        $bar = "";
                        foreach($smenu[$menu] as $key=>$value) 
                        {
                            if ($is_admin != "super")
                                if (!strstr($auth[$menu.$key], "r")) continue;
                            echo $bar;
                            echo $smenu[$menu][$key];
                            $bar = " <font color=silver>|</font> ";
                        }
                    } 
                    else 
                    {
                        //echo disp_sub_menu2("매뉴얼", "http://sir.co.kr/manual/gnuboard4/", "_blank");
                        echo disp_sub_menu2("자주하시는 질문", "http://sir.co.kr/bbs/board.php?bo_table=g4_faq", "_blank");
                        echo " | ";
                        echo disp_sub_menu2("묻고답하기", "http://sir.co.kr/bbs/board.php?bo_table=g4_qa", "_blank");
                        echo " | ";
                        echo disp_sub_menu2("팁앤테크", "http://sir.co.kr/bbs/board.php?bo_table=g4_tiptech", "_blank");
                        echo " | ";
                        echo disp_sub_menu2("스킨", "http://sir.co.kr/bbs/board.php?bo_table=g4_skin", "_blank");
                    }
                    ?>
                </td></tr>
            <tr>
            <td>
                <table width=98% cellpadding=1 cellspacing=0 bgcolor="<?=$css_color?>" align=center>
                <tr><td>
                    <table width=100% cellpadding=8 bgcolor=#FFFFFF>
                    <tr><td>

<style>
a:link, a:visited, a:active { text-decoration:underline; color:#616161; }
a:hover { text-decoration:underline; color:<?=$css_color?>; }

.title { font-size:9pt; font-family:굴림; font-weight:bold; color:<?=$css_color?>; }

.btn1 { background-color:#FAFAFA; height:19px;  border: 1px solid <?=$css_color?>; color:#555555; } 

.col1 { color:#616161; }
.col2 { color:#868686; }

.pad1 { padding:5px 20px 5px 20px; }
.pad2 { padding:5px 0px 5px 0px; }

.bgcol1 { background-color:#FBF8EE; padding:5px; }
.bgcol2 { background-color:#F5F5F5; padding:5px; }

.line1 { background-color:<?=$css_color?>; height:2px; }
.line2 { background-color:#CCCCCC; height:1px; }

.list0 { background-color:#FFFFFF; }
.list1 { background-color:#F8F8F8; }

.bold { font-weight:bold; }
.center { text-align:center; }
.right { text-align:right; }

.w99 { width:99%; }
.ht { height:30px; }

#csshelp1 { border:0px; background:#FFFFFF; padding:6px; }
#csshelp2 { border:2px solid #BDBEC6; padding:0px; }
#csshelp3 { background:#F9F9F9; padding:6px; width:200px; color:#222222; line-height:120%; text-align:left; }
</style>

<script language="JavaScript">
if (!g4_is_ie) document.captureEvents(Event.MOUSEMOVE)
document.onmousemove = getMouseXY;
var tempX = 0;
var tempY = 0;
var prevdiv = null;
var timerID = null;

function getMouseXY(e) 
{
    if (g4_is_ie) { // grab the x-y pos.s if browser is IE
        tempX = event.clientX + document.body.scrollLeft;
        tempY = event.clientY + document.body.scrollTop;
    } else {  // grab the x-y pos.s if browser is NS
        tempX = e.pageX;
        tempY = e.pageY;
    }  

    if (tempX < 0) {tempX = 0;}
    if (tempY < 0) {tempY = 0;}  

    return true;
}

function help(id, left, top)
{
    menu(id);

    //submenu = eval(name+".style");
    submenu = document.getElementById(id).style;
    submenu.posLeft = tempX - 50 + left;
    submenu.posTop  = tempY + 15 + top;

    //selectBoxHidden(name);
}

// TEXTAREA 사이즈 변경
function textarea_size(fld, size)
{
	var rows = parseInt(fld.rows);

	rows += parseInt(size);
	if (rows > 0) {
		fld.rows = rows;
	}
}
</script>
