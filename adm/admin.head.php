<?
if (!defined("_GNUBOARD_")) exit;

$begin_time = get_microtime();

$title = "�״����� ������ ������";
if ($g4[title]) 
    $g4[title] = $title . " > " . $g4[title];
else
    $g4[title] = $title;

include_once("$g4[path]/head.sub.php");
?>

<table width=1000 cellpadding=5 cellspacing=0><tr><td>

<table width=100% cellpadding=0 cellspacing=0 border=0><tr><td align=right>
<a href="<?=$g4[path]?>/">Home</a>&nbsp;
<a href="<?=$g4[bbs_path]?>/logout.php">Logout</a>&nbsp;
<a href="<?=$g4[admin_path]?>/">Admin</a>
</td></tr></table>

<table cellpadding=0 cellspacing=1 border=0>
<tr>
<?
ob_start();
@ksort($amenu); // Ű ������� �����Ѵ�
foreach ($amenu as $key=>$value) {
    include_once("$g4[admin_path]/menu/" . $value);
}

foreach($tmenu as $key=>$value) 
    echo "<td height=43 width=80 align=center>$tmenu[$key]</td>";
$head_contents = ob_get_contents();
ob_end_clean();
echo $head_contents;

$tmp_menu = substr($sub_menu,0,3);
$css_color = $tcolor[$tmp_menu];
?>
</tr>
</table><br>

<style>
a:link, a:visited, a:active { text-decoration:underline; color:#616161; }
a:hover { text-decoration:underline; color:<?=$css_color?>; }

.title { font-size:9pt; font-family:����; font-weight:bold; color:<?=$css_color?>; }

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

// TEXTAREA ������ ����
function textarea_size(fld, size)
{
	var rows = parseInt(fld.rows);

	rows += parseInt(size);
	if (rows > 0) {
		fld.rows = rows;
	}
}
</script>

<table width="100%" cellpadding=0 cellspacing=0 border=0>
<tr>
    <td width=130 valign=top>
        <?
        if (count($smenu[$menu])) {
            foreach($smenu[$menu] as $key=>$value) {
                if ($is_admin != "super")
                    if (!strstr($auth[$menu.$key], "r")) continue;
                echo $smenu[$menu][$key];
            }
        } else {
            echo disp_sub_menu("�״����� ������", "", "");
            //echo disp_sub_menu2("�Ŵ���", "http://sir.co.kr/manual/gnuboard4/", "_blank");
            echo disp_sub_menu2("�����Ͻô� ����", "http://sir.co.kr/bbs/board.php?bo_table=g4_faq", "_blank");
            echo disp_sub_menu2("������ϱ�", "http://sir.co.kr/bbs/board.php?bo_table=g4_qa", "_blank");
            echo disp_sub_menu2("������ũ", "http://sir.co.kr/bbs/board.php?bo_table=g4_tiptech", "_blank");
            echo disp_sub_menu2("��Ų", "http://sir.co.kr/bbs/board.php?bo_table=g4_skin", "_blank");
        }
        ?>
    </td>
    <td width="" valign=top>
        <table width=97% align=center><tr><td>