<?
$sub_menu = "300100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

function b_draw($pos, $color='red')
{
    return "border-{$pos}-width:1px; border-{$pos}-color:{$color}; border-{$pos}-style:solid; ";
}

$sql = " select count(*) as cnt from $g4[group_table] ";
$row = sql_fetch($sql);
if (!$row[cnt])
    alert("�Խ��Ǳ׷��� �Ѱ� �̻� �����Ǿ�� �մϴ�.", "./boardgroup_form.php");

$html_title = "�Խ���";
if ($w == "") 
{
    $html_title .= " ����";

    $bo_table_attr = "required alphanumericunderline";

    $board[bo_count_delete] = '3';
    $board[bo_count_modify] = '3';
    $board[bo_read_point] = $config[cf_read_point];
    $board[bo_write_point] = $config[cf_write_point];
    $board[bo_comment_point] = $config[cf_comment_point];
    $board[bo_download_point] = $config[cf_download_point];

    $board[bo_gallery_cols] = '4';
    $board[bo_table_width] = '97';
    $board[bo_page_rows] = $config[cf_page_rows];
    $board[bo_subject_len] = '60';
    $board[bo_new] = '24';
    $board[bo_hot] = '100';
    $board[bo_image_width] = '600';
    $board[bo_upload_size] = '1024768';
    $board[bo_reply_order] = '1';
    $board[bo_use_search] = '1';
    $board[bo_skin] = 'basic';
    $board[gr_id] = $gr_id;
    $board[bo_disable_tags] = "script|iframe";
} 
else if ($w == "u") 
{
    $html_title .= " ����";

    if (!$board[bo_table])
        alert("�������� ���� �Խ��� �Դϴ�.");

    if ($is_admin == "group") {
        if ($member[mb_id] != $group[gr_admin]) 
            alert("�׷��� Ʋ���ϴ�.");
    }

    $bo_table_attr = "readonly style='background-color:#dddddd'";
}

$g4[title] = $html_title;
include_once ("./admin.head.php");
?>

<table width=100% cellpadding=0 cellspacing=0>
<form name=fboardform method=post action="javascript:fboardform_submit(document.fboardform)" enctype="multipart/form-data">
<input type=hidden name="w"    value="<?=$w?>">
<input type=hidden name="Sfl"  value="<?=$sfl?>">
<input type=hidden name="stx"  value="<?=$stx?>">
<input type=hidden name="sst"  value="<?=$sst?>">
<input type=hidden name="sod"  value="<?=$sod?>">
<input type=hidden name="page" value="<?=$page?>">
<colgroup width=20% class='col1 pad1 bold right'>
<colgroup width=30% class='col2 pad2'>
<colgroup width=20% class='col1 pad1 bold right'>
<colgroup width=30% class='col2 pad2'>
<tr>
    <td colspan=4 class=title align=left><img src='./img/icon_title.gif'> <?=$html_title?></td>
</tr>
<tr><td colspan=4 class='line1'></td></tr>
<tr class='ht'>
    <td>TABLE</td>
    <td colspan=3><input type=text class='edit' name=bo_table size=30 maxlength=20 <?=$bo_table_attr?> itemname='TABLE' value='<?=$board[bo_table] ?>'>
        <? 
        if ($w == "") 
            echo "������, ����, _ �� ���� (������� 20�� �̳�)";
        else 
            echo "<a href='$g4[bbs_path]/board.php?bo_table=$board[bo_table]'><img src='./img/icon_view.gif' border=0 align=absmiddle></a>";
        ?>
    </td>
</tr>
<tr class='ht'>
    <td>�׷�</td>
    <td colspan=3>
        <?=get_group_select('gr_id', $board[gr_id], "required itemname='�׷�'");?>
        <? if ($w=='u') { ?><a href="javascript:location.href='./board_list.php?sfl=gr_id&stx='+document.fboardform.gr_id.value;">���ϱ׷�Խ��Ǹ��</a><?}?></td>
</tr>
<tr class='ht'>
    <td>�Խ��� ����</td>
    <td colspan=3>
        <input type=text class='edit' name=bo_subject size=60 maxlength=120 required itemname='�Խ��� ����' value='<?=$board[bo_subject]?>'>
    </td>
</tr>
<tr class='ht'>
    <td>��� �̹���</td>
    <td>
        <input type=file name=bo_image_head class='edit'>
        <?
        if ($board[bo_image_head])
            echo "<br><a href='$g4[path]/data/file/$board[bo_image_head]' target='_blank'>$board[bo_image_head]</a> <input type=checkbox name='bo_image_head_del' value='$board[bo_image_head]'> ����";
        ?>
    </td>
    <td>�ϴ� �̹���</td>
    <td>
        <input type=file name=bo_image_tail class='edit'>
        <? 
        if ($board[bo_image_tail]) 
            echo "<br><a href='$g4[path]/data/file/$board[bo_image_tail]' target='_blank'>$board[bo_image_tail]</a> <input type=checkbox name='bo_image_tail_del' value='$board[bo_image_tail]'> ����";
        ?>
    </td>
</tr>

<? if ($w == "u") { ?>
<tr class='ht'>
    <td>ī��Ʈ ����</td>
    <td colspan=3>
        <input type=checkbox name=proc_count value=1> ī��Ʈ�� �����մϴ�. �۾��ð��� ��� �ɸ� �� �ֽ��ϴ�.
        (���� ���ۼ� : <?=number_format($board[bo_count_write])?> , ���� �ڸ�Ʈ�� : <?=number_format($board[bo_count_comment])?>)
    </td>
</tr>
<? } ?>

<tr class='ht'>
    <td style="<?=b_draw('top', '#00D952') ?><?=b_draw('left', '#00D952') ?> ">�׷� ���� ����</td>
    <td style="<?=b_draw('top', '#00D952') ?><?=b_draw('right', '#00D952') ?>" colspan=3><input type=checkbox name=group_same1 value='1'>���� �׷쿡 ���� �Խ����� �� �׵θ����� �ɼ����� �����ϰ� �����մϴ�.</td>
</tr>

<tr class='ht'>
    <td style="<?=b_draw('bottom', '#00D952') ?><?=b_draw('left', '#00D952') ?> ">�Խ��� ������</td>
    <td style="<?=b_draw('bottom', '#00D952') ?><?=b_draw('right', '#00D952') ?>" colspan=3><?=get_member_id_select("bo_admin", 9, $board[bo_admin])?></td>
</tr>
<tr><td colspan=4 class='ht'></td></tr>


<tr class='ht'>
    <td style="<?=b_draw('top') ?><?=b_draw('left') ?> ">�׷� ���� ����</td>
    <td style="<?=b_draw('top') ?><?=b_draw('right') ?>" colspan=3><input type=checkbox name=group_same2 value='1'>���� �׷쿡 ���� �Խ����� �� �׵θ����� �ɼ����� �����ϰ� �����մϴ�.</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?>">��Ϻ��� ����</td>
    <td><?=get_member_level_select('bo_list_level', 1, 10, $board[bo_list_level]) ?></td>
    <td>���б� ����</td>
    <td style="<?=b_draw('right') ?>"><?=get_member_level_select('bo_read_level', 1, 10, $board[bo_read_level]) ?></td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?>">�۾��� ����</td>
    <td><?=get_member_level_select('bo_write_level', 1, 10, $board[bo_write_level]) ?></td>
    <td>�۴亯 ����</td>
    <td style="<?=b_draw('right') ?>"><?=get_member_level_select('bo_reply_level', 1, 10, $board[bo_reply_level]) ?></td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?>">�ڸ�Ʈ���� ����</td>
    <td><?=get_member_level_select('bo_comment_level', 1, 10, $board[bo_comment_level]) ?></td>
    <td>��ũ ����</td>
    <td style="<?=b_draw('right') ?>"><?=get_member_level_select('bo_link_level', 1, 10, $board[bo_link_level]) ?></td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?>">���ε� ����</td>
    <td><?=get_member_level_select('bo_upload_level', 1, 10, $board[bo_upload_level]) ?></td>
    <td>�ٿ�ε� ����</td>
    <td style="<?=b_draw('right') ?>"><?=get_member_level_select('bo_download_level', 1, 10, $board[bo_download_level]) ?></td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?>">HTML ���� ����</td>
    <td><?=get_member_level_select('bo_html_level', 1, 10, $board[bo_html_level]) ?></td>
    <td>Ʈ���龲�� ����</td>
    <td style="<?=b_draw('right') ?>"><?=get_member_level_select('bo_trackback_level', 1, 10, $board[bo_trackback_level]) ?></td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?>">���� ���� �Ұ�</td>
    <td>�ڸ�Ʈ <input type=text class='edit' name=bo_count_modify size=3 required numeric itemname='���� ���� �Ұ� �ڸ�Ʈ��' value='<?=$board[bo_count_modify]?>'>�� �̻� �޸��� �����Ұ�</td>
    <td>���� ���� �Ұ�</td>
    <td style="<?=b_draw('right')?>">�ڸ�Ʈ <input type=text class='edit' name=bo_count_delete size=3 required numeric itemname='���� ���� �Ұ� �ڸ�Ʈ��' value='<?=$board[bo_count_delete]?>'>�� �̻� �޸��� �����Ұ�</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?>">����Ʈ ����</td>
    <td colspan=3 style="<?=b_draw('right') ?>"><input type=checkbox name="chk_point" onclick="set_point(this.form)"> ȯ�漳���� �Էµ� ����Ʈ�� ����</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?>">���б� ����Ʈ</td>
    <td><input type=text class='edit' name=bo_read_point size=10 required itemname='���б� ����Ʈ' value='<?=$board[bo_read_point]?>'></td>
    <td>�۾��� ����Ʈ</td>
    <td style="<?=b_draw('right')?>"><input type=text class='edit' name=bo_write_point size=10 required itemname='�۾��� ����Ʈ' value='<?=$board[bo_write_point]?>'></td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left')?><?=b_draw('bottom')?>">�ڸ�Ʈ���� ����Ʈ</td>
    <td style="<?=b_draw('bottom')?>"><input type=text class='edit' name=bo_comment_point size=10 required itemname='�亯, �ڸ�Ʈ���� ����Ʈ' value='<?=$board[bo_comment_point]?>'></td>
    <td style="<?=b_draw('bottom')?>">�ٿ�ε� ����Ʈ</td>
    <td style="<?=b_draw('right')?><?=b_draw('bottom')?>"><input type=text class='edit' name=bo_download_point size=10 required itemname='�ٿ�ε� ����Ʈ' value='<?=$board[bo_download_point]?>'></td>
</tr>
<tr><td colspan=4 class='ht'></td></tr>


<tr class='ht'>
    <td style="<?=b_draw('top', '#00D952') ?><?=b_draw('left', '#00D952') ?> ">�׷� ���� ����</td>
    <td style="<?=b_draw('top', '#00D952') ?><?=b_draw('right', '#00D952') ?>" colspan=3>
        <input type=checkbox name=group_same3_1 value='1'>���� �׷쿡 ���� �Խ����� �� �׵θ����� �ɼ����� �����ϰ� �����մϴ�.</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left', '#00D952')?>">�з� ���</td>
    <td colspan=3 style="<?=b_draw('right', '#00D952')?>">
        <input type=checkbox name=bo_use_category value='1' <?=$board[bo_use_category]?'checked':'';?>>���
    </td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left', '#00D952') ?> <?=b_draw('bottom', '#00D952')?>">�з�</td>
    <td colspan=3 style="<?=b_draw('right', '#00D952') ?> <?=b_draw('bottom', '#00D952')?>">
        <input type=text class='edit' name=bo_category_list style='width:99%;' value='<?=$board[bo_category_list]?>'>
        <br> �з��� �з� ���̴� | �� �����ϼ���. (��: ����|�亯)
    </td>
</tr>
<tr><td colspan=4 class='ht'></td></tr>

<tr class='ht'>
    <td style="<?=b_draw('top', '#74A3C8') ?><?=b_draw('left', '#74A3C8') ?> ">�׷� ���� ����</td>
    <td style="<?=b_draw('top', '#74A3C8') ?><?=b_draw('right', '#74A3C8') ?>" colspan=3>
        <input type=checkbox name=group_same3_1 value='1'>���� �׷쿡 ���� �Խ����� �� �׵θ����� �ɼ����� �����ϰ� �����մϴ�.</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left', '#74A3C8') ?>">������ �±�</td>
    <td colspan=3 style="<?=b_draw('right', '#74A3C8') ?>">
        <input type=text class='edit' name=bo_disable_tags style='width:99%;' value='<?=$board[bo_disable_tags]?>'>
        <br> �±׿� �±� ���̴� | �� �����ϼ���. (��: <b>script</b>|<b>iframe</b>) HTML ���� ������ �±׸� �Է��ϼ���.
    </td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left', '#74A3C8') ?>">�۾��� ���̵��</td>
    <td><input type=checkbox name=bo_use_sideview value='1' <?=$board[bo_use_sideview]?'checked':'';?>>��� (�۾��� Ŭ���� ������ ���̾� �޴�)</td>
    <td>���� ���� ���</td>
    <td style="<?=b_draw('right', '#74A3C8') ?>"><input type=checkbox name=bo_use_file_content value='1' <?=$board[bo_use_file_content]?'checked':'';?>>���</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left', '#74A3C8') ?>">�ڸ�Ʈ ��â ���</td>
    <td><input type=checkbox name=bo_use_comment value='1' <?=$board[bo_use_comment]?'checked':'';?>>��� (�ڸ�Ʈ�� Ŭ���� ��â���� ����)</td>
    <td>��б� ���</td>
    <td style="<?=b_draw('right', '#74A3C8') ?>"><input type=checkbox name=bo_use_secret value='1' <?=$board[bo_use_secret]?'checked':'';?>>���</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left', '#74A3C8') ?>">��õ ���</td>
    <td><input type=checkbox name=bo_use_good value='1' <?=$board[bo_use_good]?'checked':'';?>>���</td>
    <td>����õ ���</td>
    <td style="<?=b_draw('right', '#74A3C8') ?>"><input type=checkbox name=bo_use_nogood value='1' <?=$board[bo_use_nogood]?'checked':'';?>>���</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left', '#74A3C8') ?>">�̸�(�Ǹ�) ���</td>
    <td><input type=checkbox name=bo_use_name value='1' <?=$board[bo_use_name]?'checked':'';?>>���</td>
    <td>�����̱� ���</td>
    <td style="<?=b_draw('right', '#74A3C8') ?>"><input type=checkbox name=bo_use_signature value='1' <?=$board[bo_use_signature]?'checked':'';?>>���</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left', '#74A3C8') ?>">IP ���̱� ���</td>
    <td><input type=checkbox name=bo_use_ip_view value='1' <?=$board[bo_use_ip_view]?'checked':'';?>>���</td>
    <td>Ʈ���� ���</td>
    <td style="<?=b_draw('right', '#74A3C8') ?>"><input type=checkbox name=bo_use_trackback value='1' <?=$board[bo_use_trackback]?'checked':'';?>>��� (Ʈ���龲�� ���� ���� �켱��)</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left', '#74A3C8') ?><?=b_draw('bottom', '#74A3C8') ?>">��Ͽ��� ���� ���</td>
    <td style="<?=b_draw('bottom', '#74A3C8') ?>"><input type=checkbox name=bo_use_list_content value='1' <?=$board[bo_use_list_content]?'checked':'';?>>��� (���� �ӵ� ������)</td>
    <td style="<?=b_draw('bottom', '#74A3C8') ?>">��ü��Ϻ��̱� ���</td>
    <td style="<?=b_draw('right', '#74A3C8') ?><?=b_draw('bottom', '#74A3C8') ?>"><input type=checkbox name=bo_use_list_view value='1' <?=$board[bo_use_list_view]?'checked':'';?>>���</td>
</tr>
<tr><td colspan=4 class='ht'></td></tr>


<tr class='ht'>
    <td style="<?=b_draw('top') ?><?=b_draw('left') ?> ">�׷� ���� ����</td>
    <td style="<?=b_draw('top') ?><?=b_draw('right') ?>" colspan=3><input type=checkbox name=group_same4 value='1'>���� �׷쿡 ���� �Խ����� �� �׵θ����� �ɼ����� �����ϰ� �����մϴ�.</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?>">��Ų ���丮</td>
    <td><select name=bo_skin required itemname="��Ų ���丮">
        <?
        $arr = get_skin_dir("board");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
        ?></select>
        <script language="JavaScript">document.fboardform.bo_skin.value="<?=$board[bo_skin]?>";</script>
    </td>
    <td>���� �̹�����</td>
    <td style="<?=b_draw('right') ?>"><input type=text class='edit' name=bo_gallery_cols size=10 required itemname='���� �̹�����' value='<?=$board[bo_gallery_cols]?>'> �ַ��� ���Ŀ����� ���</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?>">�Խ��� ���̺� ��</td>
    <td><input type=text class='edit' name=bo_table_width size=10 required itemname='�Խ��� ���̺� ��' value='<?=$board[bo_table_width]?>'> 100 ���ϴ� %</td>
    <td>�������� ��� ��</td>
    <td style="<?=b_draw('right') ?>"><input type=text class='edit' name=bo_page_rows size=10 required itemname='�������� ��� ��' value='<?=$board[bo_page_rows]?>'></td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?> ">���� ����</td>
    <td><input type=text class='edit' name=bo_subject_len size=10 required itemname='���� ����' value='<?=$board[bo_subject_len]?>'><br>��Ͽ��� ���� ���ڼ�. �߸��� ���� �� �� ǥ��</td>
    <td>new �̹���</td>
    <td style="<?=b_draw('right') ?>"><input type=text class='edit' name=bo_new size=10 required itemname='new �̹���' value='<?=$board[bo_new]?>'><br>�� �Է��� new �̹����� ����ϴ� �ð�</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?> ">hot �̹���</td>
    <td><input type=text class='edit' name=bo_hot size=10 required itemname='hot �̹���' value='<?=$board[bo_hot]?>'><br>��ȸ���� ������ �̻��̸� hot �̹��� ���</td>
    <td>�̹��� �� ũ��</td>
    <td style="<?=b_draw('right') ?>"><input type=text class='edit' name=bo_image_width size=10 required itemname='�̹��� �� ũ��' value='<?=$board[bo_image_width]?>'> �ȼ�<br>(�Խ��ǿ��� ��µǴ� �̹����� �� ũ��)</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?> ">�ۼ� ����</td>
    <td colspan=3 style="<?=b_draw('right') ?>">
        �ּ� <input type=text class='edit' name=bo_write_min size=5 numeric value='<?=$board[bo_write_min]?>'>&nbsp;
        �ִ� <input type=text class='edit' name=bo_write_max size=5 numeric value='<?=$board[bo_write_max]?>'>
        (�� �Է½� �ּ� ���ڼ�, �ִ� ���ڼ��� ����. 0�� �Է��ϸ� �˻����� ����)
    </td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?> ">�ڸ�Ʈ�� ����</td>
    <td colspan=3 style="<?=b_draw('right') ?>">
        �ּ� <input type=text class='edit' name=bo_comment_min size=5 numeric value='<?=$board[bo_comment_min]?>'>&nbsp;
        �ִ� <input type=text class='edit' name=bo_comment_max size=5 numeric value='<?=$board[bo_comment_max]?>'>
        (�ڸ�Ʈ �Է½� �ּ� ���ڼ�, �ִ� ���ڼ��� ����. 0�� �Է��ϸ� �˻����� ����)
    </td>
</tr>
<?
$upload_max_filesize = ini_get("upload_max_filesize");
if (!preg_match("/([m|M])$/", $upload_max_filesize)) {
    $upload_max_filesize = (int)($upload_max_filesize / 1024768);
}
?>
<tr class='ht'>
    <td style="<?=b_draw('left') ?> <?=b_draw('bottom') ?>">���ε� �뷮</td>
    <td style="<?=b_draw('bottom') ?>"><input type=text class='edit' name=bo_upload_size size=10 required itemname='���ε� �뷮' value='<?=$board[bo_upload_size]?>'> bytes (�ִ� <?=ini_get("upload_max_filesize")?> ����)<br>1 MB = 1,024,768 bytes</td>
    <td style="<?=b_draw('bottom') ?>">�亯 �ޱ�</td>
    <td style="<?=b_draw('right') ?> <?=b_draw('bottom') ?>">
        <select name=bo_reply_order>
        <option value='1'>���߿� �� �亯 �Ʒ��� �ޱ� (�⺻)
        <option value='0'>���߿� �� �亯 ���� �ޱ�
        </select>
        <script language='javascript'> document.fboardform.bo_reply_order.value = '<?=$board[bo_reply_order]?>'; </script>
    </td>
</tr>
<tr><td colspan=4 class='ht'></td></tr>


<tr class='ht'>
    <td style="<?=b_draw('top', '#00D952') ?><?=b_draw('left', '#00D952') ?> ">�׷� ���� ����</td>
    <td style="<?=b_draw('top', '#00D952') ?><?=b_draw('right', '#00D952') ?>" colspan=3><input type=checkbox name=group_same5 value='1'>���� �׷쿡 ���� �Խ����� �� �׵θ����� �ɼ����� �����ϰ� �����մϴ�.</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left', '#00D952') ?> ">��� ���� ���</td>
    <td style="<?=b_draw('right', '#00D952') ?>" colspan=3><input type=text class='edit' name=bo_include_head style='width:99%;' value='<?=$board[bo_include_head]?>'></td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left', '#00D952') ?> <?=b_draw('bottom', '#00D952') ?>">�ϴ� ���� ���</td>
    <td style="<?=b_draw('right', '#00D952') ?><?=b_draw('bottom', '#00D952') ?>" colspan=3><input type=text class='edit' name=bo_include_tail style='width:99%;' value='<?=$board[bo_include_tail]?>'></td>
</tr>
<tr><td colspan=4 class='ht'></td></tr>


<tr class='ht'>
    <td style="<?=b_draw('top') ?><?=b_draw('left') ?> ">�׷� ���� ����</td>
    <td style="<?=b_draw('top') ?><?=b_draw('right') ?>" colspan=3><input type=checkbox name=group_same6 value='1'>���� �׷쿡 ���� �Խ����� �� �׵θ����� �ɼ����� �����ϰ� �����մϴ�.</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?> ">��� ����</td>
    <td style="<?=b_draw('right') ?>" colspan=3><textarea class='edit' name=bo_content_head rows=5 style='width:99%;'><?=$board[bo_content_head] ?></textarea></td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?> <?=b_draw('bottom') ?>">�ϴ� ����</td>
    <td style="<?=b_draw('right') ?><?=b_draw('bottom') ?>" colspan=3><textarea class='edit' name=bo_content_tail rows=5 style='width:99%;'><?=$board[bo_content_tail] ?></textarea></td></tr>
</tr>
<tr><td colspan=4 class='ht'></td></tr>


<tr class='ht'>
    <td style="<?=b_draw('top', '#00D952') ?><?=b_draw('left', '#00D952') ?> ">�׷� ���� ����</td>
    <td style="<?=b_draw('top', '#00D952') ?><?=b_draw('right', '#00D952') ?>" colspan=3><input type=checkbox name=group_same7 value='1'>���� �׷쿡 ���� �Խ����� �� �׵θ����� �ɼ����� �����ϰ� �����մϴ�.</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left', '#00D952') ?> <?=b_draw('bottom', '#00D952') ?>">�۾��� �⺻ ����</td>
    <td style="<?=b_draw('right', '#00D952') ?><?=b_draw('bottom', '#00D952') ?>" colspan=3><textarea class='edit' name=bo_insert_content rows=5 style='width:99%;'><?=$board[bo_insert_content] ?></textarea></td>
</tr>
<tr><td colspan=4 class='ht'></td></tr>


<tr class='ht'>
    <td style="<?=b_draw('top') ?><?=b_draw('left') ?> ">�׷� ���� ����</td>
    <td style="<?=b_draw('top') ?><?=b_draw('right') ?>" colspan=3><input type=checkbox name=group_same8 value='1'>���� �׷쿡 ���� �Խ����� �� �׵θ����� �ɼ����� �����ϰ� �����մϴ�.</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?> <?=b_draw('bottom') ?>">��ü �˻� ���</td>
    <td style="<?=b_draw('bottom') ?>"><input type=checkbox name=bo_use_search value='1' <?=$board[bo_use_search]?'checked':'';?>>���</td>
    <td style="<?=b_draw('bottom') ?>">��ü �˻� ����</td>
    <td style="<?=b_draw('right') ?><?=b_draw('bottom') ?>"><input type=text class='edit' name=bo_order_search size=5 value='<?=$board[bo_order_search]?>'> ���ڰ� ���� �Խ��� ���� �˻�</td>
</tr>
<tr><td colspan=4 class='ht'></td></tr>


<tr class='ht'>
    <td style="<?=b_draw('top', '#00D952') ?><?=b_draw('left', '#00D952') ?> ">�׷� ���� ����</td>
    <td style="<?=b_draw('top', '#00D952') ?><?=b_draw('right', '#00D952') ?>" colspan=3><input type=checkbox name=group_same9 value='1'>���� �׷쿡 ���� �Խ����� �� �׵θ����� �ɼ����� �����ϰ� �����մϴ�.</td>
</tr>

<? for ($i=1; $i<=10; $i=$i+2) { $k=$i+1; ?>
<tr class='ht'>
    <td style="<?=b_draw('left', '#00D952') ?> ">���� �ʵ� <?=$i?></td>
    <td><input type=text class='edit' style='width:99%;' name=bo_<?=$i?> value='<?=$board["bo_$i"]?>'></td>
    <td>���� �ʵ� <?=$k?></td>
    <td style="<?=b_draw('right', '#00D952') ?>"><input type=text class='edit' style='width:99%;' name=bo_<?=$k?> value='<?=$board["bo_{$k}"]?>'></td>
</tr>
<? if ($i == 9) echo "<tr><td colspan=4 height=1 bgcolor='#00D952'></td></tr>"; ?>
<? } ?>
</table>

<p align=center>
    <input type=image src='./img/btn_confirm.gif' accesskey='s'>&nbsp;
    <a href='./board_list.php?<?=$qstr?>'><img src='./img/btn_list.gif' border=0></a>
</form>

<script language="JavaScript">
function set_point(f)
{
    if (f.chk_point.checked) {
        f.bo_read_point.value     = "<?=$config[cf_read_point]?>";
        f.bo_write_point.value    = "<?=$config[cf_write_point]?>";
        f.bo_comment_point.value  = "<?=$config[cf_comment_point]?>";
        f.bo_download_point.value = "<?=$config[cf_download_point]?>";
    } else {
        f.bo_read_point.value     = f.bo_read_point.defaultValue;
        f.bo_write_point.value    = f.bo_write_point.defaultValue;
        f.bo_comment_point.value  = f.bo_comment_point.defaultValue;
        f.bo_download_point.value = f.bo_download_point.defaultValue;
    }
}

function fboardform_submit(f)
{
    var tmp_title;
    var tmp_image;

    tmp_title = "���";
    tmp_image = f.bo_image_head;
    if (tmp_image.value) {
        if (!tmp_image.value.toLowerCase().match(/.(gif|jpg|png)$/i)) {
            alert(tmp_title + "�̹����� gif, jpg, png ������ �ƴմϴ�.");
            return;
        }
    }

    tmp_title = "�ϴ�";
    tmp_image = f.bo_image_tail;
    if (tmp_image.value) {
        if (!tmp_image.value.toLowerCase().match(/.(gif|jpg|png)$/i)) {
            alert(tmp_title + "�̹����� gif, jpg, png ������ �ƴմϴ�.");
            return;
        }
    }

    if (parseInt(f.bo_count_modify.value) < 1) {
        alert("���� ���� �Ұ� �ڸ�Ʈ���� 1 �̻� �Է��ϼž� �մϴ�.");
        f.bo_count_modify.focus();
        return;
    }

    if (parseInt(f.bo_count_delete.value) < 1) {
        alert("���� ���� �Ұ� �ڸ�Ʈ���� 1 �̻� �Է��ϼž� �մϴ�.");
        f.bo_count_delete.focus();
        return;
    }

    f.action = "./board_form_update.php";
    f.submit();
}
</script>

<?
include_once ("./admin.tail.php");
?>
