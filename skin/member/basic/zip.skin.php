<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>

<script type="text/javascript" src="<?=$g4[path];?>/js/zip.js"></script>

<style>
.pg_wrap {clear:both;margin:0 0 20px;padding:20px 0 0;text-align:center}
.pg {}
.pg_page, .pg_current {display:inline-block;padding:0 8px;height:25px;color:#000;letter-spacing:0;line-height:2.2em;vertical-align:middle}
.pg a:focus, .pg a:hover {text-decoration:none}
.pg_page {background:#e4eaec;text-decoration:none}
.pg_start, .pg_prev {/* ���� */}
.pg_end, .pg_next {/* ���� */}
.pg_current {display:inline-block;background:#333;color:#fff;font-weight:normal}
.sound_only {display:none}

#result {margin:0}
#result_b4 {display:block;padding:30px 0;text-align:center}
#result .result_msg {padding:15px 0}
#result .result_fail {border:1px solid #dde4e9;background:#f0f5fc;color:#ff3061;text-align:center}
#result ul {margin:0;padding:0;border-bottom:1px solid #dde4e9;background:#f0f5fc;list-style:none}
#result li {padding:10px;border:1px solid #dde4e9;border-bottom:0}
#result li div {margin:4px 0 0;color:#738D94}
#result li div:before {content:"�� "}
</style>

<table width="600" height="50" border="0" cellpadding="0" cellspacing="0">
<tr>
    <td align="center" valign="middle" bgcolor="#EBEBEB">
        <table width="590" height="40" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="25" align="center" bgcolor="#FFFFFF" ><img src="<?=$member_skin_path?>/img/icon_01.gif" width="5" height="5"></td>
            <td bgcolor="#FFFFFF" ><font color="#666666"><b><?=$g4[title]?></b></font></td>
        </tr>
        </table></td>
</tr>
</table>

<table>
<tr>
    <td></td>
</tr>
</table>

<p style="padding:0 20px">
    �õ� �� �ñ��� ���þ��� ���θ�, ��/��/��, �ǹ��� ������ �˻��Ͻ� �� �ֽ��ϴ�.<br>
    ���� �˻������ ã���ô� �ּҰ� ���� ���� �õ��� �ñ����� �����Ͻ� �� �ٽ� �˻��� �ֽʽÿ�.<br>
    (�˻������ �ִ� 1,000�Ǹ� ǥ�õ˴ϴ�.)
</p>

<form name="fzip" method="get" onsubmit="search_call(); return false;" autocomplete="off">
<!-- �˻��� �Է� ���� { -->
<table width="600" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td align="center">
        <table width="566" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td bgcolor="#CCCCCC">
                <table width="100%" cellspacing="1" cellpadding="5">
                <tr>
                    <td bgcolor="#F7F7F7"><label for="sido">�õ�����</label></td>
                    <td bgcolor="#FFFFFF">
                        <select name="sido" id="sido">
                            <option value="">- �õ� ���� -</option>
                        </select>
                    </td>
                    <td bgcolor="#F7F7F7"><label for="gugun">�ñ���</label></td>
                    <td bgcolor="#FFFFFF">
                        <select name="gugun" id="gugun">
                            <option value="">- �ñ��� ���� -</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#F7F7F7"><label for="q">�˻���</label></td>
                    <td colspan="3" bgcolor="#FFFFFF">
                        <input type="text" name="q" value="" id="q" required itemname="�˻���" class="ed" style="vertical-align:middle">
                        <input type="image" src="<?=$member_skin_path?>/img/btn_post_search.gif" alt="�˻�" border="0" align="absmiddle">
                    </td>
                </tr>
                </table>
            </td>
        </tr>
        </table>
    </td>
</tr>
</table>
<!-- } �˻��� �Է� �� -->
</form>

<div id="result" style="padding:0 20px"><span id="result_b4" style="display:block;padding:20px 0;text-align:center">�˻�� �Է����ּ���.</span></div>

<table width="600">
<tr>
    <td height="40" align="center" valign="bottom"><a href="javascript:window.close();"><img src="<?=$member_skin_path?>/img/btn_close.gif" width="48" height="20" border="0"></a><br><br></td>
</tr>
</table>

<script type="text/javascript">
function put_data(zip1, zip2, addr1, addr2, jibeon)
{
    var of = window.opener.document.<?php echo $frm_name; ?>;

    of.<?php echo $frm_zip1; ?>.value = zip1;
    of.<?php echo $frm_zip2; ?>.value = zip2;
    of.<?php echo $frm_addr1; ?>.value = addr1;
    of.<?php echo $frm_addr2; ?>.value = addr2;

    //jibeon = decodeURIComponent(jibeon);
    $('#<?php echo $frm_jibeon; ?>', opener.document).text("�����ּ� : "+jibeon);

    if(of.<?php echo $frm_jibeon; ?> !== undefined)
        of.<?php echo $frm_jibeon; ?>.value = jibeon;

    window.close();
}
</script>