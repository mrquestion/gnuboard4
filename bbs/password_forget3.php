<?
include_once("./_common.php");

$sql = " select mb_id, mb_nick, mb_password_a, mb_email from $g4[member_table] where mb_id = '$_POST[pass_mb_id]' ";
$mb = sql_fetch($sql);
if (!$mb[mb_id]) 
    alert("�������� �ʴ� ȸ���Դϴ�.");
else if ($mb_password_a != $mb[mb_password_a]) 
    alert("�н����� �н� �� �亯�� Ʋ���ϴ�.");
else if (is_admin($mb[mb_id])) 
    alert("������ ���̵�� ���� �Ұ��մϴ�.");

$g4[title] = "�н����� ã�� 3�ܰ�";
include_once("$g4[path]/head.sub.php");

// ���� �߻�
list($usec, $sec) = explode(" ", microtime()); 
$seed =  (float)$sec + ((float)$usec * 100000); 
srand($seed);
$randval = rand(4, 6); 

$change_password = substr(md5(get_microtime()), 0, $randval);
$sql = " update $g4[member_table]
            set mb_password = '".sql_password($change_password)."'
          where mb_id = '$mb[mb_id]' ";
sql_query($sql);
?>

<table width="600" height="50" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td height="50" align="center" valign="middle" bgcolor="#EBEBEB"><table width="590" height="40" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                    <td width="25" align="center" bgcolor="#FFFFFF" ><img src="<?=$g4[bbs_img_path]?>/icon_01.gif" width="5" height="5"></td>
                    <td width="275" align="left" bgcolor="#FFFFFF" ><font color="#666666"><b>ȸ�����̵�/�н����� ã�� ���</b></font></td>
                    <td width="290" align="right" bgcolor="#FFFFFF" >&nbsp;</td>
                </tr>
            </table></td>
    </tr>
</table>

<table width="600" border="0" cellspacing="0" cellpadding="0">
    <tr> 
        <td width="600" height="200" align="center" valign="middle" background="<?=$g4[bbs_img_path]?>/dot_bg_img_02.gif"><table width="400" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                    <td width="5%" height="40" align="center"><img src="<?=$g4[bbs_img_path]?>/icon_02.gif" width="6" height="6"></td>
                    <td width="28%"><b>ȸ�����̵�</b></td>
                    <td width="67%"><b><?=$mb[mb_id]?></b></td>
                </tr>
                <tr> 
                    <td height="40" align="center"><img src="<?=$g4[bbs_img_path]?>/icon_02.gif" width="6" height="6"></td>
                    <td><b>�ο��� �н�����</b></td>
                    <td><b><?=$change_password?></b></td>
                </tr>
                <tr> 
                    <td height="40" align="center"></td>
                    <td colspan="2">���� �ο��� �н������ �α��� �� ������ �ֽʽÿ�.</td>
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

<?
include_once("$g4[path]/tail.sub.php");
?>