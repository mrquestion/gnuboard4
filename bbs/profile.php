<?
include_once("./_common.php");

if (!$member[mb_id]) 
    alert_close("ȸ���� �̿��Ͻ� �� �ֽ��ϴ�.");

if (!$member[mb_open] && $is_admin != "super" && $member[mb_id] != $mb_id) 
    alert_close("�ڽ��� ������ �������� ������ �ٸ����� ������ ��ȸ�� �� �����ϴ�.\\n\\n�������� ������ ȸ�������������� �Ͻ� �� �ֽ��ϴ�.");

$mb = get_member($mb_id);
if (!$mb[mb_id])
    alert_close("ȸ�������� �������� �ʽ��ϴ�.\\n\\nŻ���Ͽ��� �� �ֽ��ϴ�.");

if (!$mb[mb_open] && $is_admin != "super" && $member[mb_id] != $mb_id)
    alert_close("���������� ���� �ʾҽ��ϴ�.");

$g4[title] = $mb[mb_nick] . "���� �ڱ�Ұ�";
include_once("$g4[path]/head.sub.php");

$mb_nick = get_sideview($mb[mb_id], $mb[mb_nick], $mb[mb_email], $mb[mb_homepage], $mb[mb_open]);

// ȸ�������� ����°����? + 1 �� ������ �����Ѵٴ� ��
$sql = " select (TO_DAYS('$g4[time_ymdhis]') - TO_DAYS('$mb[mb_datetime]') + 1) as days ";
$row = sql_fetch($sql);
$mb_reg_after = $row[days];

$mb_homepage = set_http($mb[mb_homepage]);
$mb_profile = $mb[mb_profile] ? conv_content($mb[mb_profile],0) : "�Ұ� ������ �����ϴ�.";
?>

<script language='javascript' src='<?=$g4[path]?>/js/sideview.js'></script>

<table width="600" height="50" border="0" cellpadding="0" cellspacing="0">
<tr>
    <td align="center" valign="middle" bgcolor="#EBEBEB">
        <table width="590" height="40" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td width="25" align="center" bgcolor="#FFFFFF" ><img src="<?=$g4[bbs_img_path]?>/icon_01.gif" width="5" height="5"></td>
            <td width="75" align="left" bgcolor="#FFFFFF" ><font color="#666666"><b>�ڱ�Ұ�</b></font></td>
            <td width="490" bgcolor="#FFFFFF" ></td>
        </tr>
        </table></td>
</tr>
</table>

<table width="600" border="0" cellspacing="0" cellpadding="0">
<tr> 
    <td align="center" valign="top">
        <table width="540" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td height="20" colspan="3"></td>
        </tr>
        <tr> 
            <td width="174" height="149" align="center" valign="middle" background="<?=$g4[bbs_img_path]?>/self_intro_bg.gif">
                <table width="170" height="130" border="0" cellpadding="0" cellspacing="0">
                <tr> 
                    <td align="center" valign="middle"><?=$mb_nick?></td>
                </tr>
                </table></td>
            <td width="15" height="149"></td>
            <td width="351" height="149" align="center" valign="middle" background="<?=$g4[bbs_img_path]?>/self_intro_bg_1.gif">
                <table width="300" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                    <td width="30" height="25" align="center"><img src="<?=$g4[bbs_img_path]?>/arrow_01.gif" width="7" height="5"></td>
                    <td width="270">ȸ������ : <?=$mb[mb_level]?></td>
                </tr>
                <tr> 
                    <td height="1" colspan="2" bgcolor="#FFFFFF"></td>
                </tr>
                <tr> 
                    <td width="30" height="25" align="center"><img src="<?=$g4[bbs_img_path]?>/arrow_01.gif" width="7" height="5"></td>
                    <td width="270">����Ʈ : <?=number_format($mb[mb_point])?> ��</td>
                </tr>
                <tr> 
                    <td height="1" colspan="2" bgcolor="#FFFFFF"></td>
                </tr>

                <? if ($mb_homepage) { ?>
                <tr> 
                    <td width="30" height="25" align="center"><img src="<?=$g4[bbs_img_path]?>/arrow_01.gif" width="7" height="5"></td>
                    <td width="270">Ȩ������ : <a href="<?=$mb_homepage?>" target="<?=$config[cf_link_target]?>"><?=$mb_homepage?></a></td>
                </tr>
                <tr> 
                    <td height="1" colspan="2" bgcolor="#FFFFFF"></td>
                </tr>
                <? } ?>

                <tr> 
                    <td width="30" height="25" align="center"><img src="<?=$g4[bbs_img_path]?>/arrow_01.gif" width="7" height="5"></td>
                    <td width="270">ȸ�������� : <?=($member[mb_level] >= $mb[mb_level]) ?  substr($mb[mb_datetime],0,10) ." (".$mb_reg_after." ��)" : "�� �� ����"; ?></td>
                </tr>
                <tr> 
                    <td height="1" colspan="2" bgcolor="#FFFFFF"></td>
                </tr>
                <tr> 
                    <td width="30" height="25" align="center"><img src="<?=$g4[bbs_img_path]?>/arrow_01.gif" width="7" height="5"></td>
                    <td width="270">���������� : <?=($member[mb_level] >= $mb[mb_level]) ? $mb[mb_today_login] : "�� �� ����";?></td>
                </tr>
                </table></td>
        </tr>
        <tr> 
            <td width="540" height="15" colspan="3" bgcolor="#FFFFFF"></td>
        </tr>
        <tr> 
            <td height="15" colspan="3" bgcolor="#FFFFFF"><img src="<?=$g4[bbs_img_path]?>/top_line.gif" width="540" height="15"></td>
        </tr>
        <tr align="center" valign="top"> 
            <td colspan="3" background="<?=$g4[bbs_img_path]?>/mid_line.gif" bgcolor="#FFFFFF"><table width="500" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td height="30" valign="top"><img src="<?=$g4[bbs_img_path]?>/self_intro_icon_01.gif" width="81" height="24"></td>
                    </tr>
                    <tr>
                        <td height="100" valign="top"><?=$mb_profile?></td>
                    </tr>
                </table></td>
        </tr>
        <tr> 
            <td height="15" colspan="3" bgcolor="#FFFFFF"><img src="<?=$g4[bbs_img_path]?>/down_line.gif" width="540" height="15"></td>
        </tr>
        <tr>
            <td height="50" colspan="3" bgcolor="#FFFFFF"></td>
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
    <td height="40" align="center" valign="bottom"><a href="javascript:window.close();"><img src="<?=$g4[bbs_img_path]?>/btn_close.gif" width="48" height="20" border="0"></a></td>
</tr>
</table>


<?/*?>


<img src='<?=$g4[bbs_img_path]?>/title_mbprofile.gif'><br><br>

<table width=99% align=center cellpadding=0 cellspacing=0><tr><td>

<table width=100% bgcolor=#CCCCCC cellpadding=1 cellspacing=0>
	<tr>
		<td>
			<table width=100% cellpadding=7 cellspacing=0 bgcolor=#F3F3F3>
				<tr>
					<td align=center>
						<table width=450 cellpadding=3 cellspacing=0 border=0>
							<tr>
								<td rowspan=4 valign=top><?=$mb_nick?>(<?=$mb_id?>)<br><br><br><br><br>
								</td>
								<td rowspan=4><img src='<?=$g4[bbs_img_path]?>/line_white.gif'></td>
								<td width=20 rowspan=4></td>
								<td>+ ȸ������ : <?=$mb_level?></td></tr>
							<tr><td>+ ����Ʈ : <?=$mb_point?> ��</td></tr>
							<tr><td>+ ȸ�������� : <?=$mb_reg_date?> (<?=number_format($mb_reg_after)?> ��)</td></tr>
							<tr><td>+ ���������� : <?=substr($mb_today_login,0,10)?></td></tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table><br>
<table width=100% cellpadding=0 cellspacing=0 border=0>
<? if ($mb_profile) { ?>
	<tr><td colspan=2>+ �ڱ� �Ұ�</td></tr>
	<tr><td width=10></td><td width=490><?=$mb_profile?><p></td></tr>
<? } ?>
	<tr><td colspan=2 align=center><a href="javascript:window.close();"><img src='<?=$g4[bbs_img_path]?>/btn_close.gif' border=0></a><p></td></tr>
</table>

</td></tr></table>

<?*/?>

<?
include_once("$g4[path]/tail.sub.php");
?>
