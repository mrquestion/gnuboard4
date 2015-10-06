<?
include_once("./_common.php");

if (!$member[mb_id]) 
    alert("회원만 이용하실 수 있습니다.");

$g4[title] = "쪽지 보기";
include_once("$g4[path]/head.sub.php");

if ($kind == "recv") {
    $unkind = "send";

    $sql = " update $g4[memo_table]
                set me_read_datetime = '$g4[time_ymdhis]' 
              where me_id = '$me_id' 
                and me_read_datetime = '0000-00-00 00:00:00' ";
    sql_query($sql);
} else if ($kind == "send") 
    $unkind = "recv";
else 
    alert("\$kind 값을 넘겨주세요.");

$sql = " select * from $g4[memo_table]
          where me_id = '$me_id'
            and me_{$kind}_mb_id = '$member[mb_id]' ";
$memo = sql_fetch($sql);

$mb = get_member($memo["me_{$unkind}_mb_id"]);
?>

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
    <td width="600" height="20" colspan="4"></td>
</tr>
<tr> 
    <td width="30" height="24"></td>
    <td width="530" align="right" bgcolor="#EFEFEF">
        <?
        $nick = cut_str($mb[mb_nick], $config[cf_cut_name]);
        if ($kind == "recv")
            echo "<b>$nick</b> 님께서 {$memo[me_send_datetime]}에 보내온 쪽지의 내용입니다.";

        if ($kind == "send") 
            echo "<b>$nick</b> 님께 {$memo[me_send_datetime]}에 보낸 쪽지의 내용입니다."; 
        ?>
    </td>
    <td width="10" align="center" valign="middle" bgcolor="#EFEFEF">&nbsp;</td>
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
            <td width="540" height="150" align="center" valign="middle" bgcolor="#F6F6F6"><table width="500" height="110" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td valign="top" style='padding-top:10px; padding-bottom:10px;'><?=conv_content($memo[me_memo], 0)?></td>
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
    <td height="40" align="center" valign="bottom">
        <? if ($kind == "recv") echo "<a href='./memo_form.php?me_recv_mb_id=$mb[mb_id]&me_id=$memo[me_id]'><img src='$g4[bbs_img_path]/btn_reply.gif' border='0'></a>&nbsp;&nbsp;"; ?>
        <a href="./memo.php?kind=<?=$kind?>"><img src="<?=$g4[bbs_img_path]?>/btn_list_view.gif" width="62" height="20" border="0"></a>&nbsp;&nbsp;
        <a href="javascript:window.close();"><img src="<?=$g4[bbs_img_path]?>/btn_close.gif" width="48" height="20" border="0"></a></td>
</tr>
</table>

<?
include_once("$g4[path]/tail.sub.php");
?>
