<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

$question = conv_content($one[on_question], $is_dhtml_editor);
$answer = conv_content($one[on_answer], $is_dhtml_editor);

if ($is_dhtml_editor) {
    include_once("$g4[path]/lib/cheditor.lib.php");
    echo "<script src='$g4[editor_path]/cheditor.js'></script>";
    echo cheditor1('on_answer', $one[on_answer]);
}
?>

<table width="<?=$width?>" align="center" cellpadding="0" cellspacing="0"><tr><td>

<table width=100% cellpadding=0 cellspacing=0>
<colgroup width=120 align=center>
<colgroup width=''>
<tr><td colspan='2' height='2' bgcolor='#B0ADF5'></td></tr>
<tr>
    <td height=30>������</td>
    <td>
        <?
        $sql = "select mb_id, mb_name, mb_nick, mb_email, mb_homepage from $g4[member_table] where mb_no = '$one[mb_no]' ";
        $mb = sql_fetch($sql);
        $tmp_name = get_text(cut_str($mb['mb_nick'], $config['cf_cut_name'])); // ������ �ڸ��� ��ŭ�� �̸� ���
        $name = get_sideview($mb['mb_id'], $tmp_name, $list['mb_email'], $list['mb_homepage']);
        echo $name." ($mb[mb_name])";
        ?>
    </td>
</tr>
<tr><td colspan='2' height='1' bgcolor='#CCCCCC'></td></tr>
<tr>
    <td height=30>����</td>
    <td><b><?=get_text($one[on_subject])?></b></td>
</tr>
<tr><td colspan='2' height='1' bgcolor='#CCCCCC'></td></tr>
<tr>
    <td height=100>����</td>
    <td style='padding:10px 0 10px 0;' class='lh'>
        <? 
        if ($one[on_qfile]) {
            echo "<b>÷������ : <a href='onedownload.php?ob_table=$ob_table&on_id=$on_id&flag=q'>$one[on_qsource]</a></b><br/><br/>";

            /*
            // �̹��� ������ �̸����� �ϴ� ��� �ּ��� �����ϼ���.
            if (preg_match("/\.(gif|jpg|png)$/i", $one[on_qfile])) {
                $imgfile = "$g4[path]/data/one/$ob_table/$one[on_qfile]";
                $size = getimagesize($imgfile);
                echo "<img src='$imgfile' name='target_resize_image[]' border='0' onclick='image_window(this)' tmp_width='$size[0]' tmp_height='$size[1]' style='cursor:pointer;'><p>";
            }
            */
        }
        ?>

        <?=$question?>
        <br/><br/><div align=right style='color:#999999'>�ۼ��Ͻ� : <?=$one[on_qdatetime]?></div>
    </td>
</tr>
<tr><td colspan='2' height='1' bgcolor='#B0ADF5'></td></tr>

<? if ($one[on_answer]) { ?>
<tr>
    <td height=100>�亯</td>
    <td style='padding:10px 0 10px 0;' class='lh'>
        <? 
        if ($one[on_afile]) {
            echo "<b>÷������ : <a href='onedownload.php?ob_table=$ob_table&on_id=$on_id&flag=a'>$one[on_asource]</a></b><br/><br/>";

            /*
            // �̹��� ������ �̸����� �ϴ� ��� �ּ��� �����ϼ���.
            if (preg_match("/\.(gif|jpg|png)$/i", $one[on_afile])) {
                $imgfile = "$g4[path]/data/one/$ob_table/$one[on_afile]";
                $size = getimagesize($imgfile);
                echo "<img src='$imgfile' name='target_resize_image[]' border='0' onclick='image_window(this)' tmp_width='$size[0]' tmp_height='$size[1]' style='cursor:pointer;'><p>";
            }
            */
        }
        ?>

        <?=$answer?>
        <br/><br/><div align=right style='color:#999999'>�ۼ��Ͻ� : <?=$one[on_adatetime]?></div>
    </td>
</tr>
<tr><td colspan='2' height='1' bgcolor='#B0ADF5'></td></tr>
<? } ?>

<? if ($is_admin) { ?>
<tr id='answer' style='display:none;'>
    <td>�亯</td>
    <td style='padding:3px;'>
        <form name='foneview' method='post' action='oneanswer.php' onsubmit='return foneview_check(this);' enctype='multipart/form-data' style='margin:0px;'>
        <input type=hidden name='on_id'>
        <input type=hidden name='ob_table'>

        <table width=100%>
        <tr>
            <td>
                <? if ($is_dhtml_editor) { ?>
                    <?=cheditor2('foneview', 'on_answer', '100%', '350');?>
                <? } else { ?>
                    <textarea name='on_answer' id='on_answer' rows=12 style='width:100%;' required itemname='�亯' class='lh'><?=$one[on_answer]?></textarea>
                <? } ?>
            </td>
        </tr>
        <tr>
            <td>
                ÷������ : <input type=file name='on_afile' size=40>
                <?
                if ($one[on_afile]) {
                    echo "<input type='checkbox' name='on_afile_del' id='on_afile_del' value='1'>";
                    echo "<label for='on_afile_del'>$one[on_asource] ����</label>";
                }
                ?>
            </td>
        </tr>

        <? if ($oneboard[ob_use_email]) { ?>
        <tr>
            <td>
                <input type='checkbox' name='chk_send_mail' value='1'> ���Ϻ�����
            </td>
        </tr>
        <? } ?>

        <tr>
            <td>
                <input type='submit' name='submit' value='�亯Ȯ��'>
            </td>
        </tr>
        </table>
        </form>

        <script>
        //document.getElementById('on_answer').focus();

        function foneview_check(f) {
            <?
            if ($is_dhtml_editor) {
                echo cheditor3('on_answer');
                echo "if (!document.getElementById('on_answer').value) { alert('�亯�� �Է��Ͻʽÿ�.'); return false; } ";
            }
            ?>

            f.on_id.value = '<?=$on_id?>';
            f.ob_table.value = '<?=$ob_table?>';

            f.submit.value = '������...';
            f.submit.disabled = true;

            return true;
        }
        </script>
    </td>
</tr>
<tr><td colspan='2' height='1' bgcolor='#B0ADF5'></td></tr>
<? } ?>

</table>

<table width="100%" cellspacing="0" cellpadding="0">
<tr height="25">
    <td align="left">
        <? 
        if ($one[mb_no] == $member[mb_no] && $member[mb_no]) {
            if (!$one[on_answer])
                echo "<a href='one.php?ob_table=$ob_table&on_id=$on_id&w=u'>�����ϱ�</a> &nbsp;";
        }

        if ($is_admin) {
            if ($one[on_answer])
                $str = "�亯�����ϱ�";
            else
                $str = "�亯�ϱ�";
            echo "<a href='javascript:;' onclick=\"document.getElementById('answer').style.display='';\">{$str}</a>";
        }
        ?>

    </td>
    <td align="right">
        <a href='one.php?ob_table=<?=$ob_table?>'>��Ϻ���</a>
    </td>
</tr>
<tr><td height=5></td></tr>
</table>

<script language="JavaScript" src="<?="$g4[path]/js/board.js"?>"></script>
<script language="JavaScript">
window.onload=function() {
    resizeBoardImage(<?=(int)$oneboard[ob_image_width]?>);
}
</script>

</td></tr></table>