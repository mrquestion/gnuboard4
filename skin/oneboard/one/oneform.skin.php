<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

if ($is_dhtml_editor) {
    include_once("$g4[path]/lib/cheditor.lib.php");
    echo "<script src='$g4[editor_path]/cheditor.js'></script>";
    echo cheditor1('on_question', $one[on_question]);
}
?>

<table width="<?=$width?>" align="center" cellpadding="0" cellspacing="0"><tr><td>

<form name='foneform' method='post' action='onequestion.php' onsubmit='return foneform_check(this);' enctype='multipart/form-data' style='margin:0px;'>
<input type='hidden' name='w'>
<input type='hidden' name='on_id'>
<input type='hidden' name='ob_table'>

<table width=100% cellpadding=0 cellspacing=0>
<colgroup width=120 align=center>
<colgroup width=''>
<tr><td colspan='2' height='2' bgcolor='#B0ADF5'></td></tr>
<tr>
    <td height=30>����</td>
    <td>
        <input type='text' name='on_subject' id='on_subject' style='width:100%;' required itemname='����' value='<?=get_text($one[on_subject])?>'>
    </td>
</tr>
<tr><td colspan='2' height='1' bgcolor='#B0ADF5'></td></tr>
<tr>
    <td>����</td>
    <td style='padding:10px 0 10px 0;'>
        <? if ($is_dhtml_editor) { ?>
            <?=cheditor2('foneform', 'on_question', '100%', '350');?>
        <? } else { ?>
            <textarea name='on_question' rows=12 style='width:100%;' required itemname='����' class='lh'><?=$one[on_question]?></textarea>
        <? } ?>
    </td>
</tr>
<tr><td colspan='2' height='1' bgcolor='#B0ADF5'></td></tr>

<? if ($member[mb_level] >= $oneboard[ob_upload_level]) { ?>
<tr>
    <td height=30>÷������</td>
    <td>
        <input type=file name='on_qfile' size=40>
        <?
        if ($one[on_qfile]) {
            echo "<br>";
            echo "<input type='checkbox' name='on_qfile_del' id='on_qfile_del' value='1'>";
            echo "<label for='on_qfile_del'>$one[on_qsource] ����</label>";
        }
        ?>
    </td>
</tr>
<tr><td colspan='2' height='1' bgcolor='#B0ADF5'></td></tr>
<? } ?>

</table>

<p align=center>
<input type='submit' name='submit' value='     Ȯ     ��     '>
&nbsp;<input type='button' value='��Ϻ���' onclick="location.href='one.php?ob_table=<?=$ob_table?>';">

</form>

<script>
document.getElementById('on_subject').focus();

function foneform_check(f) {
    <?
    if ($is_dhtml_editor) {
        echo cheditor3('on_question');
        echo "if (!document.getElementById('on_question').value) { alert('������ �Է��Ͻʽÿ�.'); return false; } ";
    }
    ?>

    // �ּ�â���� ���Ƿ� ���� �ٲٴ°��� ����
    f.w.value = "<?=$w?>";
    f.on_id.value = "<?=$on_id?>";
    f.ob_table.value = "<?=$ob_table?>";

    f.submit.value = '������...';
    f.submit.disabled = true;
    return true;
}
</script>

</td></tr></table>