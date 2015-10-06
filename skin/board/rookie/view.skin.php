<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<table width="<?=$width?>" align=center border=1 cellpadding=0 cellspacing=0 style="border-collapse:collapse;" bordercolor="#0176B4">
<tr><td height=30>&nbsp;&nbsp;<b><? if ($is_category) { echo ($category_name ? "[$view[ca_name]] " : ""); } ?><?=$view[subject]?></b></td></tr>
<tr><td height=30>&nbsp;&nbsp;글쓴이 : <?=$view[name]?><? if ($is_ip_view) { echo "&nbsp;($ip)"; } ?>&nbsp;&nbsp;&nbsp;&nbsp;
    날짜 : <?=$view[wr_datetime]?>&nbsp;&nbsp;&nbsp;&nbsp;
    조회 : <?=$view[wr_hit]?>&nbsp;&nbsp;&nbsp;&nbsp;
   <? if ($is_good) { ?>추천 : <?=$view[wr_good]?>&nbsp;&nbsp;&nbsp;&nbsp;<?}?>
   <? if ($is_nogood) { ?>비추천 : <?=$view[wr_nogood]?>&nbsp;&nbsp;&nbsp;&nbsp;<?}?></td></tr>

<? if ($trackback_url) { ?>
	<tr><td height=30>&nbsp;&nbsp;트랙백 주소 : <a href="javascript:clipboard_trackback('<?=$trackback_url?>');" style="letter-spacing:0;" title='이 글을 소개할 때는 이 주소를 사용하세요'><?=$trackback_url?></a>
	<script language="JavaScript">
	function clipboard_trackback(str) 
	{
		if (g4_is_gecko)
			prompt("이 글의 고유주소입니다. Ctrl+C를 눌러 복사하세요.", str);
		else if (g4_is_ie) {
			window.clipboardData.setData("Text", str);
			alert("트랙백 주소가 복사되었습니다.\n\n<?=$trackback_url?>");
		}
	}
	</script></td></tr>
<?}?>

<?
// 가변 파일
$cnt = 0;
for ($i=0; $i<count($view[file]); $i++) 
{
    if ($view[file][$i][source] && !$view[file][$i][view]) 
    {
        $cnt++;
        echo "<tr><td height=22>&nbsp;&nbsp;파일 : <a href=\"javascript:file_download('{$view[file][$i][href]}', '{$view[file][$i][source]}');\" title='{$view[file][$i][content]}'><b>{$view[file][$i][source]}</b> ({$view[file][$i][size]}), Down : {$view[file][$i][download]}, {$view[file][$i][datetime]}</a></td></tr>";
    }
}

// 링크
$cnt = 0;
for ($i=1; $i<=$g4[link_count]; $i++) 
{
    if ($view[link][$i]) 
    {
        $cnt++;
        $link = cut_str($view[link][$i], 70);
        echo "<tr><td height=22>&nbsp;&nbsp;링크 :  <a href='{$view[link_href][$i]}' target=_blank><b>{$link}</b> ({$view[link_hit][$i]})</a></td></tr>";
    }
}
?>

<tr> 
    <td style='line-height:150%; padding:7px; word-break:break-all;'>
        <? 
        // 파일 출력
        for ($i=0; $i<=count($view[file]); $i++) 
		{
            if ($view[file][$i][view]) 
                echo $view[file][$i][view] . "<p>";
        }
        ?>

        <?=$view[content]; // 본문 내용 출력 ?>
        
        <? if ($is_signature) { echo "<br>$signature<br><br>"; } // 서명 출력 ?></td>
</tr>
</table><br>

<?
include_once("./view_comment.php");
?>

<table width='<?=$width?>' align=center cellpadding=0 cellspacing=0>
<tr height=35>
    <td width=75%>
        <? if ($search_href) { echo "<a href=\"$search_href\">검색목록</a>&nbsp; "; } ?>
        <? echo "<a href=\"$list_href\">목록</a>&nbsp; "; ?>

        <? if ($write_href) { echo "<a href=\"$write_href\">쓰기</a>&nbsp; "; } ?>
        <? if ($reply_href) { echo "<a href=\"$reply_href\">답변</a>&nbsp; "; } ?>

        <? if ($update_href) { echo "<a href=\"$update_href\">수정</a>&nbsp; "; } ?>
        <? if ($delete_href) { echo "<a href=\"$delete_href\">삭제</a>&nbsp; "; } ?>

        <? if ($good_href) { echo "<a href=\"$good_href\" target='hiddenframe'>추천</a>&nbsp; "; } ?>
        <? if ($nogood_href) { echo "<a href=\"$nogood_href\" target='hiddenframe'>비추천</a>&nbsp; "; } ?>

        <? if ($scrap_href) { echo "<a href=\"javascript:;\" onclick=\"win_scrap('$scrap_href');\">스크랩</a>&nbsp; "; } ?>

        <? if ($copy_href) { echo "<a href=\"$copy_href\">복사</a> "; } ?>
        <? if ($move_href) { echo "<a href=\"$move_href\">이동</a> "; } ?>
    </td>
    <td width=25% align=right>
        <? if ($prev_href) { echo "<a href=\"$prev_href\" title=\"$prev_wr_subject\">이전글</a>&nbsp; "; } ?>
        <? if ($next_href) { echo "<a href=\"$next_href\" title=\"$next_wr_subject\">다음글</a>&nbsp; "; } ?>
    </td>
</tr>
</table><br>

<script language="JavaScript">
// HTML 로 넘어온 <img ... > 태그의 폭이 테이블폭보다 크다면 테이블폭을 적용한다.
function resize_image()
{
	var target = document.getElementsByName('target_resize_image[]');
	var image_width = parseInt('<?=$board[bo_image_width]?>');
	var image_height = 0;

	for(i=0; i<target.length; i++) 
	{ 
		// 원래 사이즈를 저장해 놓는다
		target[i].tmp_width  = target[i].width;
		target[i].tmp_height = target[i].height;
		// 이미지 폭이 테이블 폭보다 크다면 테이블폭에 맞춘다
		if(target[i].width > image_width) 
		{
			image_height = parseFloat(target[i].width / target[i].height)
			target[i].width = image_width;
			target[i].height = parseInt(image_width / image_height);
		}
	}
}

window.onload = resize_image;

function file_download(link, file)
{
<? if ($board[bo_download_point] < 0) { ?>if (confirm("'"+file+"' 파일을 다운로드 하시면 포인트가 차감(<?=number_format($board[bo_download_point])?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?"))<?}?>
document.location.href = link;
}
</script>
