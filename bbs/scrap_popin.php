<?
include_once("./_common.php");

include_once("$g4[path]/head.sub.php");

if (!$member[mb_id]) {
    $href = "./login.php?$qstr&url=".urlencode("./board.php?bo_table=$bo_table&wr_id=$wr_id");
    echo <<<HEREDOC
    <script language="JavaScript">
        alert("회원만 접근 가능합니다.");
        opener.location.href = "$href";
        window.close();
    </script>
HEREDOC;
    exit;
}

echo <<<HEREDOC
<script language="JavaScript">
    if (window.name != "scrap") {
        alert("올바른 방법으로 사용해 주십시오.");
        window.close();
    }
</script>
HEREDOC;

if ($write[wr_comment] < 0)
    alert_close("코멘트는 스크랩 할 수 없습니다.");

$sql = " select count(*) as cnt from $g4[scrap_table]
          where mb_id = '$member[mb_id]'
            and bo_table = '$bo_table'
            and wr_id = '$wr_id' ";
$row = sql_fetch($sql);
if ($row[cnt]) {
    echo <<<HEREDOC
    <script language="JavaScript">
    if (confirm('이미 스크랩하신 글 입니다.\\n\\n지금 스크랩을 확인하시겠습니까?'))
        document.location.href = './scrap.php';
    else
        window.close();
    </script>
HEREDOC;
    exit;
}
?>

<table width="600" height="50" border="0" cellpadding="0" cellspacing="0">
<tr>
    <td align="center" valign="middle" bgcolor="#EBEBEB">
        <table width="590" height="40" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td width="25" align="center" bgcolor="#FFFFFF" ><img src="<?=$g4[bbs_img_path]?>/icon_01.gif" width="5" height="5"></td>
            <td width="75" align="left" bgcolor="#FFFFFF" ><font color="#666666"><b>스크랩하기</b></font></td>
            <td width="490" bgcolor="#FFFFFF" ></td>
        </tr>
        </table></td>
</tr>
</table>

<table width="600" border="0" cellspacing="0" cellpadding="0">
<form name=f_scrap_popin method=post action="./scrap_popin_update.php">
<input type="hidden" name="bo_table" value="<?=$bo_table?>">
<input type="hidden" name="wr_id"    value="<?=$wr_id?>">
<tr> 
    <td height="200" align="center" valign="top"><table width="540" border="0" cellspacing="0" cellpadding="0">
            <tr> 
                <td height="20"></td>
            </tr>
            <tr> 
                <td height="2" bgcolor="#808080"></td>
            </tr>
            <tr> 
                <td width="540" height="2" align="center" valign="top" bgcolor="#FFFFFF"><table width="540" border="0" cellspacing="0" cellpadding="0">
                        <tr> 
                            <td width="80" height="27" align="center"><b>제목</b></td>
                            <td width="10" valign="bottom"><img src="<?=$g4[bbs_img_path]?>/l.gif" width="1" height="8"></td>
                            <td width="450" style='word-break:break-all;'><?=get_text(cut_str($write[wr_subject], 255))?></td>
                        </tr>
                        <tr> 
                            <td height="1" colspan="3" bgcolor="#E9E9E9"></td>
                        </tr>
                        <tr> 
                            <td width="80" height="200" align="center"><b>코멘트</b></td>
                            <td width="10" valign="bottom"><img src="<?=$g4[bbs_img_path]?>/l.gif" width="1" height="8"></td>
                            <td width="450"><textarea name="wr_content" rows="10" style="width:90%;"></textarea></td>
                        </tr>
                        <tr> 
                            <td height="1" colspan="3" bgcolor="#E9E9E9"></td>
                        </tr>
                    </table></td>
            </tr>
        </table></td>
</tr>
<tr> 
    <td height="2" align="center" valign="top" bgcolor="#D5D5D5"></td>
</tr>
<tr>
    <td height="2" align="center" valign="top" bgcolor="#E6E6E6"></td>
</tr>
<tr>
    <td height="40" align="center" valign="bottom"><INPUT type=image width="40" height="20" src="<?=$g4[bbs_img_path]?>/ok_btn.gif" border=0></td>
</tr>
</form>
</table>

<?/*?>
<script language="JavaScript">
    self.resizeTo(300, 300);
    self.moveTo(20, 20);

    document.f_scrap_popin.wr_content.focus();
</script>
<?*/?>

<?
include_once("$g4[path]/tail.sub.php");
?>
