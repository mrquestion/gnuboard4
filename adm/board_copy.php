<?
$sub_menu = "300100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

$g4[title] = "게시판 복사";
include_once("$g4[path]/head.sub.php");
?>

<style>
a:link, a:visited, a:active { text-decoration:underline; color:#616161; }
a:hover { text-decoration:underline; color:#EBC95F; }

.title { font-size:9pt; font-family:굴림; font-weight:bold; color:#EBC95F; }

.btn1 { background-color:#FAFAFA; height:19px;  border: 1px solid #EBC95F; color:#555555; } 

.col1 { color:#616161; }
.col2 { color:#868686; }

.pad1 { padding:5px 20px 5px 20px; }
.pad2 { padding:5px 0px 5px 0px; }

.edit { border: 1px solid #9E9E9E; } 

.bgcol1 { background-color:#FBF8EE; padding:5px; }
.bgcol2 { background-color:#F5F5F5; padding:5px; }

.line1 { background-color:#EBC95F; height:2px; }
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

<table width=100% cellpadding=0 cellspacing=0>
<form name="fboardcopy" action="javascript:fboardcopy_check(document.fboardcopy);" autocomplete="off">
<input type="hidden" name="bo_table" value="<?=$bo_table?>">
<colgroup width=30% class='col1 pad1 bold right'>
<colgroup width=70% class='col2 pad2'>
<tr><td colspan=2 height=5></td></tr>
<tr>
    <td colspan=2 class=title align=left><img src='./img/icon_title.gif'> <?=$g4[title]?></td>
</tr>
<tr><td colspan=2 class='line1'></td></tr>
<tr class='ht'>
	<td>원본 테이블</td>
	<td><?=$bo_table?></td>
</tr>
<tr class='ht'>
	<td>복사할 TABLE</td>
	<td><input type=text class=edit name="target_table" size="20" maxlength="20" required alphanumericunderline itemname="TABLE"> 영문자, 숫자, _ 만 가능 (공백없이)</td>
</tr>
<tr class='ht'>
	<td>게시판 제목</td>
	<td><input type=text class='edit' name='target_subject' size=60 maxlength=120 required itemname='게시판 제목' value='[복사본] <?=$board[bo_subject]?>'></td>
</tr>
<tr class='ht'>
	<td>복사 유형</td>
	<td>
        <input type="radio" name="copy_case" value="schema_only" checked>구조만
        <input type="radio" name="copy_case" value="schema_data_both">구조와 데이터
    </td>
</tr>
<tr height=40>
    <td></td>
	<td>
        <input type="submit" value="   복   사   " class=btn1>&nbsp;
        <input type="button" value="창닫기" onclick="window.close();" class=btn1>
    </td>
</tr>
</form>
</table>

<script language='javascript'>
function fboardcopy_check(f)
{
    f.action = "./board_copy_update.php";
    f.submit();
}
</script>

<?
include_once("$g4[path]/tail.sub.php");
?>
