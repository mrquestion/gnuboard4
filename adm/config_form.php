<?
$sub_menu = "100100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

if ($is_admin != "super")
    alert("�ְ�����ڸ� ���� �����մϴ�.");

$g4[title] = "�⺻ȯ�漳��";
include_once ("./admin.head.php");
?>

<table width=100% cellpadding=0 cellspacing=0 border=0>
<form name=fconfigform method=post action='javascript:fconfigform_submit(document.fconfigform);'>
<colgroup width=20% class='col1 pad1 bold right'>
<colgroup width=30% class='col2 pad2'>
<colgroup width=20% class='col1 pad1 bold right'>
<colgroup width=30% class='col2 pad2'>
<tr class='ht'>
    <td colspan=4 class=title align=left><img src='<?=$g4[admin_path]?>/img/icon_title.gif'> �⺻���� �� ��뿩��</td>
</tr>
<tr><td colspan=4 class=line1></td></tr>
<tr class='ht'>
    <td>Ȩ������ ����</td>
    <td>
        <input type=text class=ed name='cf_title' size='30' required itemname='Ȩ������ ����' value='<?=$config[cf_title]?>'>
        <!-- <input type=button class='btn1' value='�׷����' onclick="location.href='boardgroup_form.php';"> -->
    </td>
    <td>�ְ������</td>
    <td><?=get_member_id_select("cf_admin", 10, $config[cf_admin], "required itemname='�ְ� ������'")?></td>
</tr>
<tr class='ht'>
    <td>����Ʈ ���</td>
    <td><input type='checkbox' name='cf_use_point' value='1' <?=$config[cf_use_point]?'checked':'';?>> ���</td>
    <td>�α��ν� ����Ʈ</td>
    <td><input type=text class=ed name='cf_login_point' size='5' required itemname='�α��ν� ����Ʈ' value='<?=$config[cf_login_point]?>'> �� (ȸ������ �Ϸ翡 �ѹ��� �ο�)</td>
</tr>
<tr class='ht'>
    <td>�̸�(����) ǥ��</td>
    <td><input type=text class=ed name='cf_cut_name' value='<?=$config[cf_cut_name]?>' size=2> �ڸ��� ǥ��<br>(������ 2���� = �ѱ� 1����)</td>
    <td>���� ����</td>
    <td>������ �� <input type=text class=ed name='cf_nick_modify' value='<?=$config[cf_nick_modify]?>' size=2> �� ���� �ٲ� �� ����</td>
</tr>
<tr class='ht'>
    <td>�ֱٰԽù� ����</td>
    <td><input type=text class=ed name='cf_new_del' value='<?=$config[cf_new_del]?>' size=5> ���� ���� �ֱٰԽù� �ڵ� ����</td>
    <td>�޸� ����</td>
    <td><input type=text class=ed name='cf_memo_del' value='<?=$config[cf_memo_del]?>' size=5> ���� ���� �޸� �ڵ� ����</td>
</tr>
<tr class='ht'>
    <td>�����ڷα� ����</td>
    <td><input type=text class=ed name='cf_visit_del' value='<?=$config[cf_visit_del]?>' size=5> ���� ���� ������ �α� �ڵ� ����</td>
    <td>�α�˻��� ����</td>
    <td><input type=text class=ed name='cf_popular_del' value='<?=$config[cf_popular_del]?>' size=5> ���� ���� �α�˻��� �ڵ� ����</td>
</tr>
<tr class='ht'>
    <td>���� ������</td>
    <td><input type=text class=ed name='cf_login_minutes' value='<?=$config[cf_login_minutes]?>' size=5> ��<br>������ �̳��� �����ڸ� ���� �����ڷ� ����</td>
    <td>���������� ���μ�</td>
    <td><input type=text class=ed name='cf_page_rows' value='<?=$config[cf_page_rows]?>' size=5> ���� (��� ���������� ���μ�)</td>
</tr>
<tr class='ht'>
    <td>�ֱٰԽù� ��Ų</td>
    <td><select id=cf_new_skin name=cf_new_skin required itemname="�ֱٰԽù� ��Ų">
        <?
        $arr = get_skin_dir("new");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
        ?></select>
        <script language="JavaScript"> document.getElementById('cf_new_skin').value="<?=$config[cf_new_skin]?>";</script>
    </td>
    <td>�ֱٰԽù� ���μ�</td>
    <td><input type=text class=ed name='cf_new_rows' value='<?=$config[cf_new_rows]?>' size=5> ���� (��� ���������� ���μ�)</td>
</tr>
<tr class='ht'>
    <td>�˻� ��Ų</td>
    <td colspan=3><select id=cf_search_skin name=cf_search_skin required itemname="�˻� ��Ų">
        <?
        $arr = get_skin_dir("search");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
        ?></select>
        <script language="JavaScript"> document.getElementById('cf_search_skin').value="<?=$config[cf_search_skin]?>";</script>
    </td>
</tr>
<tr class='ht'>
    <td>������ ��Ų</td>
    <td colspan=3><select id=cf_connect_skin name=cf_connect_skin required itemname="�ֱٰԽù� ��Ų">
        <?
        $arr = get_skin_dir("connect");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
        ?></select>
        <script language="JavaScript"> document.getElementById('cf_connect_skin').value="<?=$config[cf_connect_skin]?>";</script>
    </td>
</tr>
<tr class='ht'>
    <td>������ ��� ����</td>
    <td><input type='checkbox' name='cf_formmail_is_member' value='1' <?=$config[cf_formmail_is_member]?'checked':'';?>> ȸ���� ���<br>(üũ���� ������ ��ȸ���� ��밡��)</td>
    <td>�ڵ���Ϲ��� ���</td>
    <td><input type='checkbox' name='cf_use_norobot' value='1' <?=$config[cf_use_norobot]?'checked':'';?>> ���<br>(�ڵ� ȸ�����԰� �۾��⸦ ����)</td>
</tr>
<tr class='ht'>
    <td>����, �̵��� �α�</td>
    <td colspan=3><input type='checkbox' name='cf_use_copy_log' value='1' <?=$config[cf_use_copy_log]?'checked':'';?>> ����<br>�Խù� �Ʒ� ������ ���� ����, �̵��� ǥ��</td>
</tr>
<tr class='ht'>
    <td>���ٰ��� IP</td>
    <td valign=top><textarea class=ed name='cf_possible_ip' rows='5' style='width:99%;'><?=$config[cf_possible_ip]?></textarea><br>�Էµ� IP�� ��ǻ�͸� ������ �� ����.<br>123.123.* �� �Է� ����. (���ͷ� ����)</td>
    <td>�������� IP</td>
    <td valign=top><textarea class=ed name='cf_intercept_ip' rows='5' style='width:99%;'><?=$config[cf_intercept_ip]?></textarea><br>�Էµ� IP�� ��ǻ�ʹ� ������ �� ����.<br>123.123.* �� �Է� ����. (���ͷ� ����)</td>
</tr>
<tr><td colspan=4 class=line2></td></tr>
<tr><td colspan=4 class=ht></td></tr>


<tr>
    <td colspan=4 class=title align=left><img src='<?=$g4[admin_path]?>/img/icon_title.gif'> �Խ��� ����</td>
</tr>
<tr><td colspan=4 class=line1></td></tr>
<tr class='ht'>
    <td>���б� ����Ʈ</td>
    <td><input type=text class=ed name='cf_read_point' size='10' required itemname='���б� ����Ʈ' value='<?=$config[cf_read_point]?>'> ��</td>
    <td>�۾��� ����Ʈ</td>
    <td><input type=text class=ed name='cf_write_point' size='10' required itemname='�۾��� ����Ʈ' value='<?=$config[cf_write_point]?>'> ��</td>
</tr>
<tr class='ht'>
    <td>�ڸ�Ʈ���� ����Ʈ</td>
    <td><input type=text class=ed name='cf_comment_point' size='10' required itemname='�亯, �ڸ�Ʈ���� ����Ʈ' value='<?=$config[cf_comment_point]?>'> ��</td>
    <td>�ٿ�ε� ����Ʈ</td>
    <td><input type=text class=ed name='cf_download_point' size='10' required itemname='�ٿ�ε�ޱ� ����Ʈ' value='<?=$config[cf_download_point]?>'> ��</td>
</tr>
<tr class='ht'>
    <td>LINK TARGET</td>
    <td><input type=text class=ed name='cf_link_target' size='10' value='<?=$config[cf_link_target]?>'> ��ũ�� ������ TARGET ����</td>
    <td>�˻� ����</td>
    <td><input type=text class=ed name='cf_search_part' size='10' itemname='�˻� ����' value='<?=$config[cf_search_part]?>'> �� ������ �˻�</td>
</tr>
<tr class='ht'>
    <td>�˻� ��� ����</td>
    <td><input type=text class=ed name='cf_search_bgcolor' size='10' required itemname='�˻� ��� ����' value='<?=$config[cf_search_bgcolor]?>'></td>
    <td>�˻� ���� ����</td>
    <td><input type=text class=ed name='cf_search_color' size='10' required itemname='�˻� ���� ����' value='<?=$config[cf_search_color]?>'></td>
</tr>
<tr class='ht'>
    <td>���ο� �۾���</td>
    <td><input type=text class=ed name='cf_delay_sec' size='10' required itemname='���ο� �۾���' value='<?=$config[cf_delay_sec]?>'> �� ������ ����</td>
    <td>������ ǥ�� ��</td>
    <td><input type=text class=ed name='cf_write_pages' size='10' required itemname='������ ǥ�� ��' value='<?=$config[cf_write_pages]?>'> �������� ǥ��</td>
</tr>
<tr class='ht'>
    <td>�̹��� ���ε� Ȯ����</td>
    <td colspan=3><input type=text class=ed name='cf_image_extension' size='80' itemname='�̹��� ���ε� Ȯ����' value='<?=$config[cf_image_extension]?>'><br>�Խ��� ���ۼ��� �̹��� ���� ���ε� ���� Ȯ����. | �� ����</td>
</tr>
<tr class='ht'>
    <td>�÷��� ���ε� Ȯ����</td>
    <td colspan=3><input type=text class=ed name='cf_flash_extension' size='80' itemname='�÷��� ���ε� Ȯ����' value='<?=$config[cf_flash_extension]?>'><br>�Խ��� ���ۼ��� �÷��� ���� ���ε� ���� Ȯ����. | �� ����</td>
</tr>
<tr class='ht'>
    <td>������ ���ε� Ȯ����</td>
    <td colspan=3><input type=text class=ed name='cf_movie_extension' size='80' itemname='������ ���ε� Ȯ����' value='<?=$config[cf_movie_extension]?>'><br>�Խ��� ���ۼ��� ������ ���� ���ε� ���� Ȯ����. | �� ����</td>
</tr>
<tr class='ht'>
    <td>�ܾ� ���͸�</td>
    <td colspan=3><textarea class=ed name='cf_filter' rows='7' style='width:99%;'><?=$config[cf_filter]?></textarea>
    <br>�� �Էµ� �ܾ ���Ե� ������ �Խ��� �� ���� (,�� ����)</td>
</tr>
<tr><td colspan=4 class=line2></td></tr>
<tr><td colspan=4 class=ht></td></tr>


<tr class='ht'>
    <td colspan=4 class=title align=left><img src='<?=$g4[admin_path]?>/img/icon_title.gif'> ȸ������ ����</td>
</tr>
<tr><td colspan=4 class=line1></td></tr>
<tr class='ht'>
    <td>ȸ�� ��Ų</td>
    <td><select id=cf_member_skin name=cf_member_skin required itemname="ȸ������ ��Ų">
        <?
        $arr = get_skin_dir("member");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
        ?></select>
        <script language="JavaScript"> document.getElementById('cf_member_skin').value="<?=$config[cf_member_skin]?>";</script>
    </td>
    <td>E-mail ���� ���</td>
    <td><input type='checkbox' name='cf_use_email_certify' value='1' <?=$config[cf_use_email_certify]?'checked':'';?>> ���<br>���Ͽ� ��޵� �ּ� Ŭ���� ȸ������ ����</td>
</tr>
<tr class='ht'>
    <td>Ȩ������ �Է�</td>
    <td>
        <input type='checkbox' name='cf_use_homepage' value='1' <?=$config[cf_use_homepage]?'checked':'';?>> ���̱�
        <input type='checkbox' name='cf_req_homepage' value='1' <?=$config[cf_req_homepage]?'checked':'';?>> �ʼ��Է�
    </td>
    <td>�ּ� �Է�</td>
    <td>
        <input type='checkbox' name='cf_use_addr' value='1' <?=$config[cf_use_addr]?'checked':'';?>> ���̱�
        <input type='checkbox' name='cf_req_addr' value='1' <?=$config[cf_req_addr]?'checked':'';?>> �ʼ��Է�
    </td>
</tr>
<tr class='ht'>
    <td>��ȭ��ȣ �Է�</td>
    <td>
        <input type='checkbox' name='cf_use_tel' value='1' <?=$config[cf_use_tel]?'checked':'';?>> ���̱�
        <input type='checkbox' name='cf_req_tel' value='1' <?=$config[cf_req_tel]?'checked':'';?>> �ʼ��Է�
    </td>
    <td>�ڵ��� �Է�</td>
    <td>
        <input type='checkbox' name='cf_use_hp' value='1' <?=$config[cf_use_hp]?'checked':'';?>> ���̱�
        <input type='checkbox' name='cf_req_hp' value='1' <?=$config[cf_req_hp]?'checked':'';?>> �ʼ��Է�
    </td>
</tr>
<tr class='ht'>
    <td>���� �Է�</td>
    <td>
        <input type='checkbox' name='cf_use_signature' value='1' <?=$config[cf_use_signature]?'checked':'';?>> ���̱�
        <input type='checkbox' name='cf_req_signature' value='1' <?=$config[cf_req_signature]?'checked':'';?>> �ʼ��Է�
    </td>
    <td>�ڱ�Ұ� �Է�</td>
    <td>
        <input type='checkbox' name='cf_use_profile' value='1' <?=$config[cf_use_profile]?'checked':'';?>> ���̱�
        <input type='checkbox' name='cf_req_profile' value='1' <?=$config[cf_req_profile]?'checked':'';?>> �ʼ��Է�
    </td>
</tr>
<tr class='ht'>
    <td>ȸ�����Խ� ����</td>
    <td><? echo get_member_level_select('cf_register_level', 1, 9, $config[cf_register_level]) ?></td>
    <td>ȸ�����Խ� ����Ʈ</td>
    <td><input type=text class=ed name='cf_register_point' size='5' value='<?=$config[cf_register_point]?>'> ��</td>
</tr>
<tr class='ht'>
    <td>�ֹε�Ϲ�ȣ</td>
    <td><input type='checkbox' name='cf_use_jumin' value='1' <?=$config[cf_use_jumin]?'checked':'';?>> ���<br>(�ֹε�Ϲ�ȣ�� ��ȣȭ�Ͽ� ������)</td>
    <td>ȸ��Ż���� ������</td>
    <td><input type=text class=ed name='cf_leave_day' size='5' value='<?=$config[cf_leave_day]?>'> �� �� �ڵ� ����</td>
</tr>
<tr class='ht'>
    <td>ȸ�������� ���</td>
    <td>
        <select name='cf_use_member_icon'> 
        <option value='0'>�̻��
        <option value='1'>�����ܸ� ǥ��
        <option value='2'>������+�̸� ǥ��
        </select><br>(�Խù��� �̸� ��� ������ ���)
    </td>
    <script language='javascript'> document.fconfigform.cf_use_member_icon.value = '<?=$config[cf_use_member_icon]?>'; </script>
    <td>������ ���ε� ����</td>
    <td colspan=3><? echo get_member_level_select('cf_icon_level', 1, 9, $config[cf_icon_level]) ?> �̻�</td>
</tr>
<tr class='ht'>
    <td>ȸ�������� �뷮</td>
    <td><input type=text class=ed name='cf_member_icon_size' size='5' value='<?=$config[cf_member_icon_size]?>'> ����Ʈ ����</td>
    <td>ȸ�������� ������</td>
    <td>�� <input type=text class=ed name='cf_member_icon_width' size='5' value='<?=$config[cf_member_icon_width]?>'> �ȼ� , ���� <input type=text class=ed name='cf_member_icon_height' size='5' value='<?=$config[cf_member_icon_height]?>'> �ȼ� ����</td>
</tr>
<tr class='ht'>
    <td>��õ������ ���</td>
    <td><input type='checkbox' name='cf_use_recommend' value='1' <?=$config[cf_use_recommend]?'checked':'';?>> ���</td>
    <td>��õ�� ����Ʈ</td>
    <td><input type=text class=ed name='cf_recommend_point' size='5' value='<?=$config[cf_recommend_point]?>'> ��</td>
</tr>
<tr class='ht'>
    <td>���̵�,���� �����ܾ�</td>
    <td valign=top><textarea class=ed name='cf_prohibit_id' rows='5' style='width:99%;'><?=$config[cf_prohibit_id]?></textarea><br>�� �Էµ� �ܾ ���Ե� ������ ȸ�����̵�, �������� ����� �� ���� (,�� ����)</td>
    <td>�Է� ���� ����</td>
    <td valign=top><textarea class=ed name='cf_prohibit_email' rows='5' style='width:99%;'><?=$config[cf_prohibit_email]?></textarea><br>�� hanmail.net�� ���� ���� �ּҴ� �Է��� ����. ���ͷ� �����մϴ�.</td>
</tr>
<tr class='ht'>
    <td>ȸ�����Ծ��</td>
    <td valign=top colspan=3><textarea class=ed name='cf_stipulation' rows='10' style='width:99%;'><?=$config[cf_stipulation]?></textarea></td>
</tr>
<tr><td colspan=4 class=line2></td></tr>
<tr><td colspan=4 class=ht></td></tr>


<tr class='ht'>
    <td colspan=4 class=title align=left><img src='<?=$g4[admin_path]?>/img/icon_title.gif'> ���� ����</td>
</tr>
<tr><td colspan=4 class=line1></td></tr>
<tr class='ht'>
    <td>���Ϲ߼� ���</td>
    <td colspan=3><input type=checkbox name=cf_email_use value='1' <?=$config[cf_email_use]?'checked':'';?>> ��� (üũ���� ������ ���Ϲ߼��� �ƿ� ������� �ʽ��ϴ�. ���� �׽�Ʈ�� �Ұ��մϴ�.)</td>
</tr>
<tr class='ht'>
    <td><span class=title>�Խ��� �� �ۼ���</span></td>
</tr>
<tr class='ht'>
    <td>�ְ������ ���Ϲ߼�</td>
    <td colspan=3><input type=checkbox name=cf_email_wr_super_admin value='1' <?=$config[cf_email_wr_super_admin]?'checked':'';?>> ��� (�ְ�����ڿ��� ������ �߼��մϴ�.)</td>
</tr>
<tr class='ht'>
    <td>�׷������ ���Ϲ߼�</td>
    <td colspan=3><input type=checkbox name=cf_email_wr_group_admin value='1' <?=$config[cf_email_wr_group_admin]?'checked':'';?>> ��� (�׷�����ڿ��� ������ �߼��մϴ�.)</td>
</tr>
<tr class='ht'>
    <td>�Խ��ǰ����� ���Ϲ߼�</td>
    <td colspan=3><input type=checkbox name=cf_email_wr_board_admin value='1' <?=$config[cf_email_wr_board_admin]?'checked':'';?>> ��� (�Խ��ǰ����ڿ��� ������ �߼��մϴ�.)</td>
</tr>
<tr class='ht'>
    <td>���� ���Ϲ߼�</td>
    <td colspan=3><input type=checkbox name=cf_email_wr_write value='1' <?=$config[cf_email_wr_write]?'checked':'';?>> ��� (�Խ��ڴԲ� ������ �߼��մϴ�.)</td>
</tr>
<tr class='ht'>
    <td>�ڸ�Ʈ ���Ϲ߼�</td>
    <td colspan=3><input type=checkbox name=cf_email_wr_comment_all value='1' <?=$config[cf_email_wr_comment_all]?'checked':'';?>> ��� (���ۿ� �ڸ�Ʈ�� �ö���� ��� �ڸ�Ʈ �� ��� �е鲲 ������ �߼��մϴ�.)</td>
</tr>
<tr class='ht'>
    <td><span class=title>ȸ�� ���Խ�</title></td>
</tr>
<tr class='ht'>
    <td>�ְ������ ���Ϲ߼�</td>
    <td colspan=3><input type=checkbox name=cf_email_mb_super_admin value='1' <?=$config[cf_email_mb_super_admin]?'checked':'';?>> ��� (�ְ�����ڿ��� ������ �߼��մϴ�.)</td>
</tr>
<tr class='ht'>
    <td>ȸ���Բ� ���Ϲ߼�</td>
    <td colspan=3><input type=checkbox name=cf_email_mb_member value='1' <?=$config[cf_email_mb_member]?'checked':'';?>> ��� (ȸ�������� ȸ���Բ� ������ �߼��մϴ�.)</td>
</tr>
<tr class='ht'>
    <td><span class=title>��ǥ ��Ÿ�ǰ� �ۼ���</title></td>
</tr>
<tr class='ht'>
    <td>�ְ������ ���Ϲ߼�</td>
    <td colspan=3><input type=checkbox name=cf_email_po_super_admin value='1' <?=$config[cf_email_po_super_admin]?'checked':'';?>> ��� (�ְ�����ڿ��� ������ �߼��մϴ�.)</td>
</tr>
<tr><td colspan=4 class=line2></td></tr>
<tr><td colspan=4 class=ht></td></tr>


<tr class='ht'>
    <td colspan=4 class=title align=left><img src='<?=$g4[admin_path]?>/img/icon_title.gif'> ���� �ʵ�</td>
</tr>
<tr><td colspan=4 class=line1></td></tr>
<? for ($i=1; $i<=10; $i=$i+2) { $k=$i+1; ?>
<tr class='ht'>
    <td>���� �ʵ�<?=$i?></td>
    <td><input type='text' class=ed style='width:99%;' name=cf_<?=$i?> value='<?=$config["cf_$i"]?>'></td>
    <td>���� �ʵ�<?=$k?></td>
    <td><input type='text' class=ed style='width:99%;' name=cf_<?=$k?> value='<?=$config["cf_$k"]?>'></td>
</tr>
<? } ?>
<tr><td colspan=4 class=line2></td></tr>
</table>

<p align=center><input type=image src='<?=$g4[admin_path]?>/img/btn_confirm.gif' accesskey='s'>
</form>

<script language="javascript">
function fconfigform_submit(f)
{
    f.action = "./config_form_update.php";
    f.submit();
}
</script>

<?
include_once ("./admin.tail.php");
?>
