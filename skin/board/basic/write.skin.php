<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<script language="JavaScript">
// 글자수 제한
var char_min = parseInt(<?=$write_min?>); // 최소
var char_max = parseInt(<?=$write_max?>); // 최대
</script>

<!-- 김선용 2005.4 - FF(불여우) 에서는 innerHTML 사용시 폼이 <table> 아래에 있으면 인식하지 못합니다. -->
<form name="fwrite" method="post" action="javascript:fwrite_check(document.fwrite);" enctype="multipart/form-data" autocomplete="off">
<table width="<?=$width?>" align=center cellpadding=0 cellspacing=0><tr><td align=center>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="4" height="33" bgcolor="#7BB2D6"><img src="<?=$board_skin_path?>/img/top_01.gif" width="4" height="33"></td>
    <td width="14%" align="center" bgcolor="#7BB2D6">&nbsp;</td>
    <td width="5" align="center" bgcolor="#7BB2D6"><img src="<?=$board_skin_path?>/img/top_02.gif" width="5" height="33"></td>
    <td width="5" align="center" bgcolor="#EEEEEE"><img src="<?=$board_skin_path?>/img/top_03.gif" width="5" height="33"></td>
    <td width="86%" align="left" bgcolor="#EEEEEE"><font style="font-family:돋움; font-size:9pt; color:#7D7D7D"><strong>[ <?=$title_msg?> ]</strong></span></td>
    <td width="4" bgcolor="#EEEEEE"><img src="<?=$board_skin_path?>/img/top_04.gif" width="4" height="33"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<input type=hidden name=w        value="<?=$w?>">
<input type=hidden name=bo_table value="<?=$bo_table?>">
<input type=hidden name=wr_id    value="<?=$wr_id?>">
<input type=hidden name=sfl      value="<?=$sfl?>">
<input type=hidden name=stx      value="<?=$stx?>">
<input type=hidden name=spt      value="<?=$spt?>">
<input type=hidden name=sst      value="<?=$sst?>">
<input type=hidden name=sod      value="<?=$sod?>">
<input type=hidden name=page     value="<?=$page?>">

<? if ($is_name) { ?>
<tr height="30">
    <td width="15%" align="center">이름</td>
    <td width="1" valign="bottom"><img src="<?=$board_skin_path?>/img/gray_line.gif" width="1" height="10"></td>
    <td width="84%"><INPUT class=ed maxLength=20 size=15 name=wr_name itemname="이름" required value="<?=$name?>"></TD>
</tr>
<tr><td height="1" background="<?=$board_skin_path?>/img/dot_bg.gif" colSpan=10></td></tr>
<? } ?>


<? if ($is_password) { ?>
<tr height="30">
    <td align="center">패스워드</td>
    <td valign="bottom"><img src="<?=$board_skin_path?>/img/gray_line.gif" width="1" height="10"></td>
    <td><INPUT class=ed type=password maxLength=20 size=15 name=wr_password itemname="패스워드" <?=$password_required?>></TD>
</tr>
<tr><td height="1" background="<?=$board_skin_path?>/img/dot_bg.gif" colSpan=10></td></tr>
<? } ?>


<? if ($is_email) { ?>
<tr height="30">
    <td align="center">이메일</td>
    <td valign="bottom"><img src="<?=$board_skin_path?>/img/gray_line.gif" width="1" height="10"></td>
    <td><INPUT class=ed maxLength=100 size=50 name=wr_email email itemname="이메일" value="<?=$email?>"></TD>
</tr>
<tr><td height="1" background="<?=$board_skin_path?>/img/dot_bg.gif" colSpan=10></td></tr>
<? } ?>


<? if ($is_homepage) { ?>
<tr height="30">
    <td align="center">홈페이지</td>
    <td valign="bottom"><img src="<?=$board_skin_path?>/img/gray_line.gif" width="1" height="10"></td>
    <td><INPUT class=ed size=50 name=wr_homepage itemname="홈페이지" value="<?=$homepage?>"></TD>
</tr>
<tr><td height="1" background="<?=$board_skin_path?>/img/dot_bg.gif" colSpan=10></td></tr>
<? } ?>


<tr height="30">
    <td align="center">옵션</td>
    <td valign="bottom"><img src="<?=$board_skin_path?>/img/gray_line.gif" width="1" height="10"></td>
    <td>
        <? if ($is_notice) { ?><input type=checkbox name=notice value="1" <?=$notice_checked?>>공지&nbsp;<? } ?>
        <? if ($is_html) { ?><INPUT onclick="html_auto_br(this);" type=checkbox value="<?=$html_value?>" name="html" <?=$html_checked?>><span class=w_title>HTML</span>&nbsp;<? } ?>
        <? if ($is_secret) { ?><INPUT type=checkbox value="secret" name="secret" <?=$secret_checked?>><span class=w_title>비밀글</span>&nbsp;<? } ?>
        <INPUT type=checkbox value="mail" name="mail" <?=$recv_email_checked?>>답변메일받기&nbsp;</TD>
</tr>
<tr><td height="1" background="<?=$board_skin_path?>/img/dot_bg.gif" colSpan=10></td></tr>


<? if ($is_category) { ?>
<tr height="30">
    <td>분류</td>
    <td valign="bottom"><img src="<?=$board_skin_path?>/img/gray_line.gif" width="1" height="10"></td>
    <td>
        <select name=ca_name required itemname="분류"><option value="">선택하세요<?=$category_option?></select></TD>
</tr>
<tr><td height="1" background="<?=$board_skin_path?>/img/dot_bg.gif" colSpan=10></td></tr>
<? } ?>

<tr height="30">
    <td align="center">제목</td>
    <td valign="bottom"><img src="<?=$board_skin_path?>/img/gray_line.gif" width="1" height="10"></td>
    <td><INPUT class=ed style="width:100%;" name=wr_subject itemname="제목" required value="<?=$subject?>"></TD>
</tr>
<tr><td height="1" background="<?=$board_skin_path?>/img/dot_bg.gif" colSpan=10></td></tr>
<tr>
    <td align="center">내용</td>
    <td valign="bottom"><img src="<?=$board_skin_path?>/img/gray_line.gif" width="1" height="10"></td>
    <td>
        <table width=100% cellpadding=0 cellspacing=0>
        <tr>
            <td width=50% align=left valign=bottom>
                <SPAN style="CURSOR: pointer;" onclick="textarea_decrease('wr_content', 10);"><img src="<?=$board_skin_path?>/img/up.gif" width="16" height="16"></SPAN>
                <SPAN style="CURSOR: pointer;" onclick="textarea_original('wr_content', 10);"><img src="<?=$board_skin_path?>/img/start.gif" width="16" height="16"></SPAN>
                <SPAN style="CURSOR: pointer;" onclick="textarea_increase('wr_content', 10);"><img src="<?=$board_skin_path?>/img/down.gif" width="16" height="16"></SPAN></td>
            <td width=50% align=right><span id=char_count></span>글자</td>
        </tr>
        </table>
        <TEXTAREA id=wr_content name=wr_content class=tx style='width:100%;' rows=10 itemname="내용" required ONKEYUP="check_byte('wr_content', 'char_count');"><?=$content?></TEXTAREA>
        <script language="JavaScript"> check_byte('wr_content', 'char_count'); </script>
    </TD>
</tr>
<tr><td height="1" background="<?=$board_skin_path?>/img/dot_bg.gif" colSpan=10></td></tr>


<? if ($is_link) { ?>
<? for ($i=1; $i<=$g4[link_count]; $i++) { ?>
<tr height="30">
    <td align="center">링크 #<?=$i?></td>
    <td valign="bottom"><img src="<?=$board_skin_path?>/img/gray_line.gif" width="1" height="10"></td>
    <td><INPUT type='text' class=ed size=50 name='wr_link<?=$i?>' itemname='링크 #<?=$i?>' value='<?=$write["wr_link{$i}"]?>'></td>
</tr>
<tr><td height="1" background="<?=$board_skin_path?>/img/dot_bg.gif" colSpan=10></td></tr>
<? } ?>
<? } ?>


<? if ($is_file) { ?>
<tr height="30">
    <td align="center" valign="top"><table cellpadding=0 cellspacing=0><tr><td style=" PADDING-TOP: 10px;">파일 <span onclick="add_file();" style='cursor:pointer;'>+</span> <span onclick="del_file();" style='cursor:pointer;'>-</span></td></tr></table></td>
    <td valign="bottom"><img src="<?=$board_skin_path?>/img/gray_line.gif" width="1" height="10"></td>
    <td><table id="variableFiles" cellpadding=0 cellspacing=0></table><?// print_r2($file); ?>
        <script language="JavaScript">
        function add_file(delete_code)
        {
            var objTbl;
            var objRow;
            var objCell;
            if (document.getElementById)
                objTbl = document.getElementById("variableFiles");
            else
                objTbl = document.all["variableFiles"];

            objRow = objTbl.insertRow(objTbl.rows.length);
            objCell = objRow.insertCell(0);

            objCell.innerHTML = "<input type='file' class=ed size=32 name='bf_file[]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'>";
            if (delete_code)
                objCell.innerHTML += delete_code;
            else
            {
                <? if ($is_file_content) { ?>
                objCell.innerHTML += "<br><input type='text' class=ed size=50 name='bf_content[]' title='업로드 이미지 파일에 해당 되는 내용을 입력하세요.'>";
                <? } ?>
                ;
            }
        }

        <?=$file_script; //수정시에 필요한 스크립트?>

        function del_file()
        {
            // file_length 이하로는 필드가 삭제되지 않아야 합니다.
            var file_length = <?=(int)$file_length?>;
            var objTbl = document.getElementById("variableFiles");
            if (objTbl.rows.length - 1 > file_length)
                objTbl.deleteRow(objTbl.rows.length - 1);
        }
        </script>
    </td>
</tr>
<tr><td height="1" background="<?=$board_skin_path?>/img/dot_bg.gif" colSpan=10></td></tr>
<? } ?>


<? if ($is_trackback) { ?>
<tr height="30">
    <td align="center">트랙백주소</td>
    <td valign="bottom"><img src="<?=$board_skin_path?>/img/gray_line.gif" width="1" height="10"></td>
    <td><INPUT class=ed size=50 name=wr_trackback itemname="트랙백" value="<?=$trackback?>">
        <? if ($w=="u") { ?><input type=checkbox name="re_trackback" value="1">핑 보냄<? } ?></TD>
</tr>
<tr><td height="1" background="<?=$board_skin_path?>/img/dot_bg.gif" colSpan=10></td></tr>
<? } ?>


<? if ($is_norobot) { ?>
<tr height="30">
    <td align="center"><?=$norobot_str?></td>
    <td valign="bottom"><img src="<?=$board_skin_path?>/img/gray_line.gif" width="1" height="10"></td>
    <td><INPUT class=ed type=input size=10 name=wr_key itemname="자동등록방지" required>&nbsp;&nbsp;* 왼쪽의 글자중 <FONT COLOR="red">빨간글자만</FONT> 순서대로 입력하세요.</TD>
</tr>
<tr><td height="1" background="<?=$board_skin_path?>/img/dot_bg.gif" colSpan=10></td></tr>
<? } ?>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="100%" height="30" background="<?=$board_skin_path?>/img/write_down_bg.gif"></td>
</tr>
<tr>
    <td width="100%" align="center" valign="top">
        <INPUT type=image id="btn_submit" src="<?=$board_skin_path?>/img/ok_btn.gif" border=0 accesskey='s'>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="./board.php?bo_table=<?=$bo_table?>"><img id="btn_list" src="<?=$board_skin_path?>/img/list_btn.gif" border=0></a></td>
</tr>
</table>

</td></tr></table>
</form>


<script language="Javascript">
with (document.fwrite) {
    if (typeof(wr_name) != "undefined")
        wr_name.focus();
    else if (typeof(wr_subject) != "undefined")
        wr_subject.focus();
    else if (typeof(wr_content) != "undefined")
        wr_content.focus();

    if (typeof(ca_name) != "undefined")
        if (w.value == "u")
            ca_name.value = "<?=$write[ca_name]?>";
}

function html_auto_br(obj)
{
    if (obj.checked) {
        result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
        if (result)
            obj.value = "html2";
        else
            obj.value = "html1";
    }
    else
        obj.value = "";
}

function fwrite_check(f)
{
    var s = "";
    if (s = word_filter_check(f.wr_subject.value)) {
        alert("제목에 금지단어('"+s+"')가 포함되어있습니다");
        return;
    }

    if (s = word_filter_check(f.wr_content.value)) {
        alert("내용에 금지단어('"+s+"')가 포함되어있습니다");
        return;
    }

    if (char_min > 0 || char_max > 0)
    {
        var cnt = parseInt(document.getElementById('char_count').innerHTML);
        if (char_min > 0 && char_min > cnt)
        {
            alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
            return;
        } else if (char_max > 0 && char_max < cnt)
        {
            alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
            return;
        }
    }

    if (typeof(f.wr_key) != "undefined") {
        if (hex_md5(f.wr_key.value) != md5_norobot_key) {
            alert("자동등록방지용 빨간글자가 순서대로 입력되지 않았습니다.");
            f.wr_key.focus();
            return;
        }
    }

    f.action = "./write_update.php";
    f.submit();
}
</script>
