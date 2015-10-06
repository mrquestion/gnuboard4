<?
include_once("./_common.php");
    
if (!$member[mb_id]) 
    alert_close("회원만 이용하실 수 있습니다.");

$g4[title] = "내 쪽지함";
include_once("$g4[path]/head.sub.php");

// 설정일이 지난 메모 삭제
$sql = " delete from $g4[memo_table]
          where me_recv_mb_id = '$member[mb_id]'
            and me_send_datetime < '".date("Y-m-d H:i:s", $g4[server_time] - (86400 * $config[cf_memo_del]))."' ";
sql_query($sql);

if (!$kind) $kind = "recv";

if ($kind == "recv")
    $unkind = "send";
else if ($kind == "send")
    $unkind = "recv";
else
    alert("\$kind 값을 넘겨주세요.");

$sql = " select count(*) as cnt from $g4[memo_table] where me_{$kind}_mb_id = '$member[mb_id]' ";
$row = sql_fetch($sql);
$total_count = number_format($row[cnt]);

if ($kind == "recv") {
    $kind_title = "받은";
    $recv_img = "on";
    $send_img = "off";
} else {
    $kind_title = "보낸";
    $recv_img = "off";
    $send_img = "on";
}
?>

<script language="javascript" src="<?=$g4[path]?>/js/sideview.js"></script>

<table width="600" height="50" border="0" cellpadding="0" cellspacing="0">
<tr>
    <td align="center" valign="middle" bgcolor="#EBEBEB">
        <table width="590" height="40" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td width="25" align="center" bgcolor="#FFFFFF" ><img src="<?=$g4[bbs_img_path]?>/icon_01.gif" width="5" height="5"></td>
            <td width="65" align="left" bgcolor="#FFFFFF" ><font color="#666666"><b><?=$g4[title]?></b></font></td>
            <td width="500" bgcolor="#FFFFFF" ></td>
        </tr>
        </table></td>
</tr>
</table>

<table width="600" border="0" cellspacing="0" cellpadding="0">
<tr> 
    <td width="600" height="20" colspan="14"></td>
</tr>
<tr> 
    <td width="30" height="24"></td>
    <td width="99" align="center" valign="middle"><a href="./memo.php?kind=recv"><img src="<?=$g4[bbs_img_path]?>/btn_recv_paper_<?=$recv_img?>.gif" width="99" height="24" border="0"></a></td>
    <td width="2" align="center" valign="middle">&nbsp;</td>
    <td width="99" align="center" valign="middle"><a href="./memo.php?kind=send"><img src="<?=$g4[bbs_img_path]?>/btn_send_paper_<?=$send_img?>.gif" width="99" height="24" border="0"></a></td>
    <td width="2" align="center" valign="middle">&nbsp;</td>
    <td width="99" align="center" valign="middle"><a href="./memo_form.php"><img src="<?=$g4[bbs_img_path]?>/btn_write_paper_off.gif" width="99" height="24" border="0"></a></td>
    <td width="2" align="center" valign="middle">&nbsp;</td>
    <td width="60" valign="middle" bgcolor="#EFEFEF">&nbsp;</td>
    <td width="4" align="center" valign="middle"><img src="<?=$g4[bbs_img_path]?>/left_img.gif" width="4" height="24"></td>
    <td width="18" align="center" valign="middle" background="<?=$g4[bbs_img_path]?>/bar_bg_img.gif"><img src="<?=$g4[bbs_img_path]?>/arrow_01.gif" width="7" height="5"></td>
    <td width="148" align="left" valign="middle" background="<?=$g4[bbs_img_path]?>/bar_bg_img.gif">전체 <?=$kind_title?> 쪽지 [ <B><?=$total_count?></B> ]통</td>
    <td width="4"><img src="<?=$g4[bbs_img_path]?>/right_img.gif" width="4" height="24"></td>
    <td width="3" bgcolor="#EFEFEF"></td>
    <td width="30" height="24"></td>
</tr>
</table>

<table width="600" border="0" cellspacing="0" cellpadding="0">
<tr> 
    <td height="200" align="center" valign="top">
        <table width="540" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td height="20"></td>
        </tr>
        <tr> 
            <td height="2" bgcolor="#808080"></td>
        </tr>
        <tr> 
            <td width="540" bgcolor="#FFFFFF">
                <table width=100% cellpadding=1 cellspacing=1 border=0>
                <tr bgcolor=#E1E1E1 align=center> 
                    <td width="30%" height="24"><b><?= ($kind == "recv") ? "보낸사람" : "받는사람"; ?></b></td>
                    <td width=25%><b>보낸시간</b></td>
                    <td width=25%><b>읽은시간</b></td>
                    <td width=20%><b>쪽지삭제</b></td>
                </tr>

                <?
                $sql = " select a.*, b.mb_id, b.mb_nick, b.mb_email, b.mb_homepage 
                           from $g4[memo_table] a
                           left join $g4[member_table] b on (a.me_{$unkind}_mb_id = b.mb_id)
                          where a.me_{$kind}_mb_id = '$member[mb_id]' 
                          order by a.me_id desc ";
                $result = sql_query($sql);
                for ($i=0; $row=sql_fetch_array($result); $i++) { 
                    $mb_id = $row["me_{$unkind}_mb_id"];

                    if ($row[mb_nick])
                        $mb_nick = $row[mb_nick];
                    else
                        $mb_nick = "<font color=silver>정보없음</font>";

                    $name = get_sideview($row[mb_id], $row[mb_nick], $row[wr_email], $row[wr_homepage]);

                    if (substr($row[me_read_datetime],0,1) == '0')
                        $read_datetime = '아직 읽지 않음';
                    else
                        $read_datetime = substr($row[me_read_datetime],2,14);

                    $link = "./memo_view.php?me_id=$row[me_id]&kind=$kind";

                    $send_datetime = substr($row[me_send_datetime],2,14);

                    echo <<<HEREDOC
                        <tr height=25 bgcolor=#F6F6F6 align=center> 
                            <td width="30%">{$name}</td>
                            <td width="25%"><a href="$link">{$send_datetime}</font></td>
                            <td width="25%"><a href="$link">{$read_datetime}</font></td>
                            <td width="20%"><a href="javascript:del('./memo_delete.php?me_id=$row[me_id]&kind=$kind');"><img src="{$g4[bbs_img_path]}/btn_comment_delete.gif" width="45" height="14" border="0"></a></td>
                        </tr>
HEREDOC;
                }
                ?>
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
    <td height="40" align="center" valign="bottom"><a href="javascript:window.close();"><img src="<?=$g4[bbs_img_path]?>/btn_close.gif" width="48" height="20" border="0"></a><br><br></td>
</tr>
</table>

<?
include_once("$g4[path]/tail.sub.php");
?>
