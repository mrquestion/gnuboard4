<?
if (!defined("_GNUBOARD_")) exit;

$begin_time = get_microtime();

$title = "그누보드 포에버 관리자";
if ($g4[title]) 
    $g4[title] = $title . " > " . $g4[title];
else
    $g4[title] = $title;

function disp_top_menu($title, $link, $color, $target="_parent")
{
return <<<HEREDOC
<table width="100%" height="100%" cellpadding=0 cellspacing=0><tr><td align="center" background="./img/top_back.gif" bgcolor="$color"><a href="$link" target="$target" style="text-decoration:none;"><font style="color:white;"><b>$title</b></font></a></td></tr></table>
HEREDOC;
}

function disp_sub_menu($title, $link, $target="_parent")
{
    if ($link)
        $href = "<a href='$link' target='$target' style='text-decoration:none;'>";
    else
        $href = "";
return <<<HEREDOC
<table width="100%" cellpadding="0" cellspacing="0"><tr><td width="20" height="26" align="center" background="./img/menu_dot_bg.gif"><img src="./img/icon_1.gif" width="9" height="9"></td><td background="./img/menu_dot_bg.gif">$href<font style="font-size:9pt; color:#868686;">$title</font></a></td></tr></table>
HEREDOC;
}

function disp_sub_menu2($title, $link, $target="_parent")
{
return <<<HEREDOC
<table width="100%" cellpadding="0" cellspacing="0"><tr><td height="25" background="./img/s_menu_dot_bg.gif">&nbsp;&nbsp;&nbsp;<font style="font-family:굴림; font-size:9pt; color:#868686;">+</font>&nbsp;&nbsp;<a href="$link" target="$target" style="text-decoration:none;"><font style="font-family:굴림; font-size:9pt; color:#868686;">$title</font></td></tr></table>
HEREDOC;
}

include_once("$g4[path]/head.sub.php");
?>

<table width=1000 cellpadding=5 cellspacing=0><tr><td>

<table width=100% cellpadding=0 cellspacing=0 border=0><tr><td align=right>
<a href="<?=$g4[path]?>/">Home</a>&nbsp;
<a href="<?=$g4[bbs_path]?>/logout.php">Logout</a>&nbsp;
<a href="./">Admin</a>
</td></tr></table>

<table cellpadding=0 cellspacing=1 border=0>
<tr>
<?
@ksort($amenu); // 키 순서대로 정렬한다
foreach ($amenu as $key=>$value) {
    include_once ("./menu/" . $value);
}

foreach($tmenu as $key=>$value) 
    echo "<td height=43 width=80 align=center>$tmenu[$key]</td>";

$tmp_menu = substr($sub_menu,0,3);
$css_color = $tcolor[$tmp_menu];
?>
</tr>
</table><br>

<style>
a:link, a:visited, a:active { text-decoration:underline; color:#616161; }
a:hover { text-decoration:underline; color:<?=$css_color?>; }

.title { font-size:9pt; font-family:굴림; font-weight:bold; color:<?=$css_color?>; }

.btn1 { background-color:#FAFAFA; height:19px;  border: 1px solid <?=$css_color?>; color:#555555; } 

.col1 { color:#616161; }
.col2 { color:#868686; }

.pad1 { padding:5px 20px 5px 20px; }
.pad2 { padding:5px 0px 5px 0px; }

.edit { border: 1px solid #9E9E9E; } 

.bgcol1 { background-color:#FBF8EE; padding:5px; }
.bgcol2 { background-color:#F5F5F5; padding:5px; }

.line1 { background-color:<?=$css_color?>; height:2px; }
.line2 { background-color:#CCCCCC; height:1px; }

.list0 { background-color:#FFFFFF; }
.list1 { background-color:#F8F8F8; }

.bold { font-weight:bold; }
.left { text-align:left; }
.right { text-align:right; }
.center { text-align:center; }

.w99 { width:99%; }
.ht { height:30px; }
</style>

<script language="JavaScript">
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
            echo disp_sub_menu("그누보드 포에버", "", "");
            //echo disp_sub_menu2("매뉴얼", "http://sir.co.kr/manual/gnuboard4/", "_blank");
            echo disp_sub_menu2("자주하시는 질문", "http://sir.co.kr/bbs/board.php?bo_table=g4_faq", "_blank");
            echo disp_sub_menu2("묻고답하기", "http://sir.co.kr/bbs/board.php?bo_table=g4_qa", "_blank");
            echo disp_sub_menu2("팁앤테크", "http://sir.co.kr/bbs/board.php?bo_table=g4_tiptech", "_blank");
            echo disp_sub_menu2("스킨", "http://sir.co.kr/bbs/board.php?bo_table=g4_skin", "_blank");
        }
        ?>
    </td>
    <td width="" valign=top>
        <table width=97% align=center><tr><td>