<?php 
$sub_menu = "200810";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$search_sort = $_GET['search_sort'];

$g4['title'] = "�����ڰ˻�";
include_once("./admin.head.php");

include_once("$g4[path]/lib/visit.lib.php");

$qstr = "search_word=$search_word&search_sort=$search_sort"; //����¡ ó������ ����

$colspan = 5;

$listall = "<a href='{$_SERVER['PHP_SELF']}' class=tt>ó��</a>"; //������ ó������ (�ʱ�ȭ�뵵)
?>

<!-- �޷� datepicker ���� -->
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/themes/base/jquery-ui.css" rel="stylesheet" />
<style>
.ui-datepicker { font:12px dotum }
.ui-datepicker select.ui-datepicker-month, 
.ui-datepicker select.ui-datepicker-year { width: 70px;}
.ui-datepicker-trigger { margin:0 0 -5px 2px }
.search_sort {width:100px;vertical-align:middle}
.ed {vertical-align:middle}
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/jquery-ui.min.js"></script>
<script type="text/javascript">
jQuery(function($){
    $.datepicker.regional["ko"] = { 
        closeText: "�ݱ�", 
        prevText: "������", 
        nextText: "������", 
        currentText: "����", 
        monthNames: ["1��(JAN)","2��(FEB)","3��(MAR)","4��(APR)","5��(MAY)","6��(JUN)", "7��(JUL)","8��(AUG)","9��(SEP)","10��(OCT)","11��(NOV)","12��(DEC)"], 
        monthNamesShort: ["1��","2��","3��","4��","5��","6��", "7��","8��","9��","10��","11��","12��"], 
        dayNames: ["��","��","ȭ","��","��","��","��"], 
        dayNamesShort: ["��","��","ȭ","��","��","��","��"], 
        dayNamesMin: ["��","��","ȭ","��","��","��","��"], 
        weekHeader: "Wk", 
        dateFormat: "yymmdd", 
        firstDay: 0, 
        isRTL: false, 
        showMonthAfterYear: true, 
        yearSuffix: ""
    };
    $.datepicker.setDefaults($.datepicker.regional["ko"]);
});
</script>
<!-- �޷� datepicker �� -->

<table width="100%" cellpadding="3" cellspacing="1">
<form name="fvisit" method="get">
<tr>
    <td class="sch_wrp">
        <?=$listall?>
        <label for="sch_sort">�˻��з�</label>
        <select name="search_sort" id="sch_sort" class="search_sort">
            <?php 
            //echo '<option value="vi_ip" '.($search_sort=='vi_ip'?'selected="selected"':'').'>IP</option>'; //selected �߰�
            if($search_sort=='vi_ip'){ //select ���� �ɼʰ��� vi_ip��
                echo '<option value="vi_ip" selected="selected">IP</option>'; //selected �߰�
            }else{
                echo '<option value="vi_ip">IP</option>';
            }
            if($search_sort=='vi_referer'){ //select ���� �ɼʰ��� vi_referer��
                echo '<option value="vi_referer" selected="selected">���Ӱ��</option>'; //selected �߰�
            }else{
                echo '<option value="vi_referer">���Ӱ��</option>';
            }
            if($search_sort=='vi_date'){ //select ���� �ɼʰ��� vi_date��
                echo '<option value="vi_date" selected="selected">��¥</option>'; //selected �߰�
            }else{
                echo '<option value="vi_date">��¥</option>';
            }
            ?>
        </select>
        <input type="text" name="search_word" size="20" value="<?=$search_word?>" id="sch_word" class="ed">
        <input type="image" src="<?=$g4['admin_path']?>/img/btn_search.gif" alt="�˻�" align="absmiddle" onclick="fvisit_submit('visit_search.php');">
    </td>
</tr>
</form>
</table>

<table width="100%" cellpadding="0" cellspacing="1" border="0">
<colgroup width="100">
<colgroup width="350">
<colgroup width="100">
<colgroup width="100">
<colgroup width="">
<tr><td colspan="<?=$colspan?>" class="line1"></td></tr>
<tr class="bgcol1 bold col1 ht center">
    <td>IP</td>
    <td>���� ���</td>
    <td>������</td>
    <td>OS</td>
    <td>�Ͻ�</td>
</tr>
<tr><td colspan="<?=$colspan?>" class="line2"></td></tr>
<?php 
$sql_common = " from {$g4['visit_table']} ";
if ($search_sort) {
    if($search_sort=='vi_ip' || $search_sort=='vi_date'){
        $sql_search = " where $search_sort like '$search_word%' ";
    }else{
        $sql_search = " where $search_sort like '%$search_word%' ";
    }
}
$sql = " select count(*) as cnt
         $sql_common 
         $sql_search ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���
if ($page == "") $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$sql = " select * 
          $sql_common
          $sql_search
          order by vi_id desc
          limit $from_record, $rows ";
$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result); $i++) {
    $brow = get_brow($row['vi_agent']);
    $os   = get_os($row['vi_agent']);

    $link = "";
    $referer = "";
    $title = "";
    if ($row['vi_referer']) {

        /*
        $referer = $row['vi_referer'];
        $referer = htmlspecialchars($referer);
        */
        $referer = get_text(cut_str($row[vi_referer], 255, ""));
        $referer = urldecode($referer);

        if (strtolower($g4['charset']) == 'utf-8') {
            if (!is_utf8($referer)) {
                $referer = iconv('euc-kr', 'utf-8', $referer);
            }
        }
        else {
            if (is_utf8($referer)) {
                $referer = iconv('utf-8', 'euc-kr', $referer);
            }
        }

        $title = str_replace(array("<", ">"), array("&lt;", "&gt;"), $referer);
        $link = "<a href='$row[vi_referer]' target=_blank title='$title '>";
    }

    if ($is_admin == 'super')
        $ip = $row['vi_ip'];
    else
        $ip = preg_replace("/([0-9]+).([0-9]+).([0-9]+).([0-9]+)/", "\\1.��.\\3.\\4", $row['vi_ip']);

    if ($brow == '��Ÿ') { $brow = "<span title='$row[vi_agent]'>$brow</span>"; }
    if ($os == '��Ÿ') { $os = "<span title='$row[vi_agent]'>$os</span>"; }

    $list = ($i%2);
    echo "
    <tr class='list$list col1 ht center'>
        <td align='left'>&nbsp;<a href='{$_SERVER['PHP_SELF']}?search_sort=vi_ip&amp;search_word=$ip'>$ip</a></td>
        <td align=left><nobr style='display:block; overflow:hidden; width:350;'>$link$title</a></nobr></td>
        <td>$brow</td>
        <td>$os</td>
        <td><a href='{$_SERVER['PHP_SELF']}?search_sort=vi_date&amp;search_word={$row['vi_date']}'>$row[vi_date]</a> $row[vi_time]</td>
    </tr>";
}

if ($i == 0)
    echo "<tr><td colspan='$colspan' height=100 align=center>�ڷᰡ �����ϴ�.</td></tr>"; 

echo "<tr><td colspan='$colspan' class='line2'></td></tr>";
echo "</table>";

$page = get_paging($config['cf_write_pages'], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&domain=$domain&page=");
if ($page) {
    echo "<table width=100% cellpadding=3 cellspacing=1><tr><td align=right>$page</td></tr></table>";
}
?>

<script type='text/javascript'>
$(function(){
    $("#sch_sort").change(function(){ // select #sch_sort�� �ɼ��� �ٲ�
        if($(this).val()=="vi_date"){ // �ش� value ���� vi_date�̸�
            $("#sch_word").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" }); // datepicker ����
        }else{ // �ƴ϶��
            $("#sch_word").datepicker("destroy"); // datepicker �̽���
        }
    });
    if($("#sch_sort option:selected").val()=="vi_date"){ // select #sch_sort �� �ɼ��� selected �Ȱ��� ���� vi_date���
        $("#sch_word").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" }); // datepicker ����
    }
});

function fvisit_submit(act) 
{
    var f = document.fvisit;
    f.action = act;
    f.submit();
}
</script>

<?php 
include_once("./admin.tail.php");
?>
