<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

// visit �迭������ 
// $visit[1] = ����
// $visit[2] = ����
// $visit[3] = �ִ�
// $visit[4] = ��ü
// ���ڰ� ��
preg_match("/����:(.*),����:(.*),�ִ�:(.*),��ü:(.*)/", $config[cf_visit], $visit);
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr> 
    <td colspan="3"><img src="<?=$g4[bbs_img]?>/visit_top.gif" width="220" height="11"></td>
</tr>
<tr> 
    <td width="15" height="88" rowspan="4" bgcolor="#F4F4F4"></td>
    <td width="73" height="22"><img src="<?=$g4[bbs_img]?>/visit_1.gif" width="73" height="22"></td>
    <td width="132" height="22" bgcolor="#F4F4F4"><font color="#4B4B4B"><?=number_format($visit[1])?></font></td>
</tr>
<tr> 
    <td width="73" height="22"><img src="<?=$g4[bbs_img]?>/visit_2.gif" width="73" height="22"></td>
    <td width="132" height="22" bgcolor="#F4F4F4"><font color="#4B4B4B"><?=number_format($visit[2])?></font></td>
</tr>
<tr> 
    <td width="73" height="22"><img src="<?=$g4[bbs_img]?>/visit_3.gif" width="73" height="22"></td>
    <td width="132" height="22" bgcolor="#F4F4F4"><font color="#4B4B4B"><?=number_format($visit[3])?></font></td>
</tr>
<tr> 
    <td width="73" height="22"><img src="<?=$g4[bbs_img]?>/visit_4.gif" width="73" height="22"></td>
    <td width="132" height="22" bgcolor="#F4F4F4"><font color="#4B4B4B"><?=number_format($visit[4])?></font></td>
</tr>
<tr> 
    <td colspan="3"><img src="<?=$g4[bbs_img]?>/visit_down.gif" width="220" height="11"></td>
</tr>
</table>