<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<style>
.vc_pad1 { PADDING-LEFT: 5px; PADDING-top: 10px; PADDING-BOTTOM: 10px; } 
.vc_pad2 { PADDING-LEFT: 5px; PADDING-top: 0px; PADDING-BOTTOM: 0px; } 
.vc_text     { BORDER: #D3D3D3 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: #ffffff; }
.vc_textarea { BORDER: #D3D3D3 1px solid; BACKGROUND-COLOR: #ffffff; WIDTH: 100%; WORD-BREAK: break-all; }
.vc_content { COLOR:#3E755D; }
</style>

<script language="JavaScript">
// 글자수 제한
var char_min = parseInt(<?=$comment_min?>); // 최소
var char_max = parseInt(<?=$comment_max?>); // 최대
</script>

<!-- 코멘트 리스트 -->
<? 
for ($i=0; $i<count($list); $i++) { 
    $comment_id = $list[$i][wr_id];
?>
<a name="c_<?=$comment_id?>"></a>
<table width=100% cellpadding=0 cellspacing=0>
<tr>
    <td valign=top><? for ($k=0; $k<strlen($list[$i][wr_comment_reply]); $k++) echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; ?></td>
    <td width='100%'>
        <table width="100%" cellspacing="0" cellpadding="0">
        <tr> 
            <td width="10" ><img src="<?=$board_skin_path?>/img/left_top.gif" width="10" height="10"></td>
            <td colspan="2" background="<?=$board_skin_path?>/img/width_bg_top.gif"></td>
            <td width="10" ><img src="<?=$board_skin_path?>/img/right_top.gif" width="10" height="10"></td>
        </tr>
        <tr> 
            <td rowspan="2" bordercolor="#CCCCCC" background="<?=$board_skin_path?>/img/left_bg.gif"></td>
            <td width="40%" align="left" valign="top" bgcolor="#f7f7f7" class='vc_pad1'><?=$list[$i][name]?><? if ($is_ip_view) { echo "&nbsp;({$list[$i][ip]})"; } ?></td>
            <td width="60%" align="right" valign="top" bgcolor="#f7f7f7" class='vc_pad1'>
                <table width="100%" cellspacing="0" cellpadding="0">
                <tr> 
                    <td width="250" height=16 align=right>
                        <!-- <?=$list[$i][wr_comment_reply]?>&nbsp; -->
                        <? if ($list[$i][is_reply]) { echo "<a href=\"javascript:comment_box('{$comment_id}', 'c');\"><img src='$board_skin_path/img/btn_comment_reply.gif' border=0 align=absmiddle></a> "; } ?>
                        <? if ($list[$i][is_edit]) { echo "<a href=\"javascript:comment_box('{$comment_id}', 'cu');\"><img src='$board_skin_path/img/btn_comment_update.gif' border=0 align=absmiddle></a> "; } ?>
                        <? if ($list[$i][is_del])  { echo "<a href=\"javascript:comment_delete('{$list[$i][del_link]}');\"><img src='$board_skin_path/img/btn_comment_delete.gif' border=0 align=absmiddle></a> "; } ?>&nbsp;
                    <td width="" align="right" valign="bottom" style="PADDING-RIGHT: 5px"><?=$list[$i][datetime]?></td>
                </tr>
                </table></td>
            <td rowspan="2" bordercolor="#CCCCCC" background="<?=$board_skin_path?>/img/right_bg.gif"></td>
        </tr>
        <tr> 
            <td colspan="2" align="left" bgcolor="#FFFFFF" class='vc_pad1' height="50" style='word-break:break-all;'>
                <!-- 코멘트 출력 -->
                <span class="vc_content lh"><?=$list[$i][content]?></span>
                <? if ($list[$i][trackback]) { echo "<p>".$list[$i][trackback]."</p>"; } ?>
                
                <textarea id='save_comment_<?=$comment_id?>' style='display:none;'><?=get_text($list[$i][wr_content], 0)?></textarea>
                <span id='edit_<?=$comment_id?>' style='display:none;'></span><!-- 수정 -->
                <span id='reply_<?=$comment_id?>' style='display:none;'></span><!-- 답변 -->
            </td>
        </tr>
        <tr> 
            <td width="10"><img src="<?=$board_skin_path?>/img/left_down.gif" width="10" height="10"></td>
            <td colspan="2" background="<?=$board_skin_path?>/img/width_bg_down.gif"></td>
            <td width="10"><img src="<?=$board_skin_path?>/img/right_down.gif" width="10" height="10"></td>
        </tr>
        </table></td>
</tr>
</table>
<br>
<? } ?>
<!-- 코멘트 리스트 -->


<? if ($is_comment_write) { ?>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
    <td height=30 align=right><a href="javascript:comment_box('', 'c');"><img src='<?=$board_skin_path?>/img/btn_comment_insert.gif' border=0 align=absmiddle></a></td>
</tr>
<tr>
    <td>
        <!-- 코멘트 입력테이블시작 -->
        <span id=comment_write style='display:none;'>
        <form name="fviewcomment" method="post" action="./write_comment_update.php" onsubmit="return fviewcomment_submit(this);" autocomplete="off">
        <input type=hidden name=w           id=w value='c'>
        <input type=hidden name=bo_table    value='<?=$bo_table?>'>
        <input type=hidden name=wr_id       value='<?=$wr_id?>'>
        <input type=hidden name=comment_id  id='comment_id' value=''>
        <input type=hidden name=sfl         value='<?=$sfl?>' >
        <input type=hidden name=stx         value='<?=$stx?>'>
        <input type=hidden name=spt         value='<?=$spt?>'>
        <input type=hidden name=page        value='<?=$page?>'>
        <input type=hidden name=cwin        value='<?=$cwin?>'>
        <table width="100%" cellspacing="0" cellpadding="0">
        <tr> 
            <td width="10" ><img src="<?=$board_skin_path?>/img/left_top.gif" width="10" height="10"></td>
            <td colspan="3" background="<?=$board_skin_path?>/img/width_bg_top.gif"></td>
            <td width="10" ><img src="<?=$board_skin_path?>/img/right_top.gif" width="10" height="10"></td>
        </tr>
        <tr> 
            <td width="10" background="<?=$board_skin_path?>/img/left_bg.gif" >&nbsp;</td>
            <td colspan='2' width='60%' bgcolor="#f7f7f7">
                <table width=100% cellpadding=0 cellspacing=0>
                <tr>
                    <td width=50% valign=bottom>&nbsp;
                        <SPAN style="CURSOR: pointer;" onclick="textarea_decrease('wr_content', 10);"><img src="<?=$board_skin_path?>/img/up.gif" width="16" height="16"></SPAN>
                        <SPAN style="CURSOR: pointer;" onclick="textarea_original('wr_content', 10);"><img src="<?=$board_skin_path?>/img/start.gif" width="16" height="16"></SPAN>
                        <SPAN style="CURSOR: pointer;" onclick="textarea_increase('wr_content', 10);"><img src="<?=$board_skin_path?>/img/down.gif" width="16" height="16"></SPAN> 
                    </td>
                    <td width=50% align=right><span id=char_count></span>글자</td>
                </tr>
                </table></td>
            <td bgcolor="#f7f7f7"></td>
            <td width="10" background="<?=$board_skin_path?>/img/right_bg.gif" >&nbsp;</td>
        </tr>
        <tr> 
            <td bordercolor="#CCCCCC" background="<?=$board_skin_path?>/img/left_bg.gif"></td>
            <td colspan="2" align="left" valign="top" bgcolor="#f7f7f7" class='vc_pad1'>
                <TEXTAREA id='wr_content' name='wr_content' class='vc_textarea' rows="10" itemname="내용" required ONKEYUP="check_byte('wr_content', 'char_count');"></TEXTAREA>
                <script language="JavaScript"> check_byte('wr_content', 'char_count'); </script>
            </td>
            <td align="center" bgcolor="#f7f7f7">

                <? if ($is_guest) { ?>
                <table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tr> 
                        <td width="80" height="20" align="right">이름</td>
                        <td><INPUT type=text maxLength=20 size=15 name="wr_name" itemname="이름" required></td>
                    </tr>
                    <tr> 
                        <td width="80" height="20" align="right">패스워드</td>
                        <td><INPUT type=password maxLength=20 size=15 name="wr_password" itemname="패스워드" required></td>
                    </tr>
                    <tr> 
                        <td width="80" height="20" align="right">이메일</td>
                        <td><INPUT type=text maxLength="100" name="wr_email" itemname="E-mail" email></td>
                    </tr>
                    <tr> 
                        <td width="80" height="20" align="right">홈페이지</td>
                        <td><INPUT type=text maxLength="100" name="wr_homepage" itemname="홈페이지"></td>
                    </tr>

                    <? if ($is_norobot) { ?>
                    <tr> 
                        <td width="80" height="20" align="right"><?=$norobot_str?></td>
                        <td><INPUT title="왼쪽의 글자중 빨간글자만 순서대로 입력하세요." type="input" name="wr_key" itemname="자동등록방지" required></td>
                    </tr>
                    <? } ?>

                </table>
                <? } ?>

                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                    <td align="center"><INPUT type="image" width="65" height="52" src="<?=$board_skin_path?>/img/ok_button.gif" border=0 accesskey='s'></td>
                </tr>
                </table></td>
            <td bordercolor="#CCCCCC" background="<?=$board_skin_path?>/img/right_bg.gif"></td>
        </tr>
        <tr> 
            <td width="10" ><img src="<?=$board_skin_path?>/img/left_down.gif" width="10" height="10"></td>
            <td colspan="3" background="<?=$board_skin_path?>/img/width_bg_down.gif"></td>
            <td width="10" ><img src="<?=$board_skin_path?>/img/right_down.gif" width="10" height="10"></td>
        </tr>
        </table>
        </form>
        </span>
        <!-- 코멘트 입력 테이블 끝 -->
    </td>
</tr>
</table>

<? if($cwin==1) { ?><p align=center><a href="javascript:window.close();"><img src="<?=$board_skin_path?>/img/btn_close.gif" border="0"></a><? } ?>

<script language='JavaScript'>
var save_before = '';
var save_html = document.getElementById('comment_write').innerHTML;
function fviewcomment_submit(f)
{
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자

    var s;
    if (s = word_filter_check(document.getElementById('wr_content').value))
    {
        alert("내용에 금지단어('"+s+"')가 포함되어있습니다");
        document.getElementById('wr_content').focus();
        return false;
    }

    // 양쪽 공백 없애기
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자
    document.getElementById('wr_content').value = document.getElementById('wr_content').value.replace(pattern, "");
    check_byte('wr_content', 'char_count');
    if (char_min > 0 || char_max > 0)
    {
        var cnt = parseInt(document.getElementById('char_count').innerHTML);
        if (char_min > 0 && char_min > cnt)
        {
            alert("코멘트는 "+char_min+"글자 이상 쓰셔야 합니다.");
            return false;
        } else if (char_max > 0 && char_max < cnt)
        {
            alert("코멘트는 "+char_max+"글자 이하로 쓰셔야 합니다.");
            return false;
        }
    }
    else if (!document.getElementById('wr_content').value)
    {
        alert("코멘트를 입력하여 주십시오.");
        return false;
    }

    if (typeof(f.wr_name) != 'undefined')
    {
        f.wr_name.value = f.wr_name.value.replace(pattern, "");
        if (f.wr_name.value == '')
        {
            alert('이름이 입력되지 않았습니다.');
            f.wr_name.focus();
            return false;
        }
    }

    if (typeof(f.wr_password) != 'undefined')
    {
        f.wr_password.value = f.wr_password.value.replace(pattern, "");
        if (f.wr_password.value == '')
        {
            alert('패스워드가 입력되지 않았습니다.');
            f.wr_password.focus();
            return false;
        }
    }

    if (typeof(f.wr_key) != 'undefined') 
    {
        if (hex_md5(f.wr_key.value) != md5_norobot_key) 
        {
            alert('자동등록방지용 빨간글자가 순서대로 입력되지 않았습니다.');
            f.wr_key.focus();
            return false;
        }
    }

    return true;
}

function comment_box(comment_id, work)
{
    var el_id;
    // 코멘트 아이디가 넘어오면 답변, 수정
    if (comment_id)
    {
        if (work == 'c')
            el_id = 'reply_' + comment_id;
        else
            el_id = 'edit_' + comment_id;
    }
    else
        el_id = 'comment_write';

    if (save_before != el_id)
    {
        if (save_before)
        {
            document.getElementById(save_before).style.display = 'none';
            document.getElementById(save_before).innerHTML = '';
        }

        document.getElementById(el_id).style.display = '';
        document.getElementById(el_id).innerHTML = save_html;
        // 코멘트 수정
        if (work == 'cu')
        {
            document.getElementById('wr_content').value = document.getElementById('save_comment_' + comment_id).value;
            if (typeof char_count != 'undefined')
                check_byte('wr_content', 'char_count');
        }

        document.getElementById('comment_id').value = comment_id;
        document.getElementById('w').value = work;

        save_before = el_id;
    }
}

function comment_delete(url)
{
    if (confirm("이 코멘트를 삭제하시겠습니까?")) location.href = url;
}

comment_box('', 'c'); // 코멘트 입력폼이 보이도록 처리하기위해서 추가 (root님)
</script>
<? } ?>
