<?
include_once("./_common.php");

define('_GNUADMIN_', 'super');

include_once("./admin.head.php");
?>

<table width=400 align=center><tr><td>

<table width=100% cellpadding=3 cellspacing=1 class=tablebg>
<form name=fgroupselect method=get action="board_form.php" onsubmit="return fgroupselect_check(this)">
<colgroup width='' align=center class=csstitle>
<tr><td class='subject subjectbg' height=30>게시판을 생성할 그룹을 선택하십시오.</td></tr>
<tr><td class='content contentbg'><br><select name=gr_id size=10>
        <?
        $sql = " select * from $g4[group_table] a ";
        if ($is_admin == 'group') {
            $sql .= "  left join $g4[member_table] b on (b.mb_id = a.gr_admin)
                      where a.gr_admin = '$member[mb_id]' ";
        }
        $sql .= " order by a.gr_id ";
        $result = sql_query($sql);
        while ($row=sql_fetch_array($result)) {
            echo "<option value='$row[gr_id]'>[$row[gr_id]] $row[gr_subject]</option>";
        }
        ?></select><p>
    </td></tr>
</table>

<p>
<div align=center><input type=image src='img/btn_confirm2.gif' border=0 width=76 height=19></div>
</form>

</td></tr></table>

<script language="JavaScript">
<!--
    function fgroupselect_check(f)
    {
        if (f.gr_id.value == "") {
            alert("그룹을 선택하여 주십시오.");
            return false;
        }

        return true;
    }
//-->
</script>

<?
include_once("./admin.tail.php");
?>
