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
    alert("게시판그룹이 한개 이상 생성되어야 합니다.", "./boardgroup_form.php");

$html_title = "게시판";
if ($w == "") 
{
    $html_title .= " 생성";

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
    $html_title .= " 수정";

    if (!$board[bo_table])
        alert("존재하지 않은 게시판 입니다.");

    if ($is_admin == "group") {
        if ($member[mb_id] != $group[gr_admin]) 
            alert("그룹이 틀립니다.");
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
            echo "영문자, 숫자, _ 만 가능 (공백없이 20자 이내)";
        else 
            echo "<a href='$g4[bbs_path]/board.php?bo_table=$board[bo_table]'><img src='./img/icon_view.gif' border=0 align=absmiddle></a>";
        ?>
    </td>
</tr>
<tr class='ht'>
    <td>그룹</td>
    <td colspan=3>
        <?=get_group_select('gr_id', $board[gr_id], "required itemname='그룹'");?>
        <? if ($w=='u') { ?><a href="javascript:location.href='./board_list.php?sfl=gr_id&stx='+document.fboardform.gr_id.value;">동일그룹게시판목록</a><?}?></td>
</tr>
<tr class='ht'>
    <td>게시판 제목</td>
    <td colspan=3>
        <input type=text class='edit' name=bo_subject size=60 maxlength=120 required itemname='게시판 제목' value='<?=$board[bo_subject]?>'>
    </td>
</tr>
<tr class='ht'>
    <td>상단 이미지</td>
    <td>
        <input type=file name=bo_image_head class='edit'>
        <?
        if ($board[bo_image_head])
            echo "<br><a href='$g4[path]/data/file/$board[bo_image_head]' target='_blank'>$board[bo_image_head]</a> <input type=checkbox name='bo_image_head_del' value='$board[bo_image_head]'> 삭제";
        ?>
    </td>
    <td>하단 이미지</td>
    <td>
        <input type=file name=bo_image_tail class='edit'>
        <? 
        if ($board[bo_image_tail]) 
            echo "<br><a href='$g4[path]/data/file/$board[bo_image_tail]' target='_blank'>$board[bo_image_tail]</a> <input type=checkbox name='bo_image_tail_del' value='$board[bo_image_tail]'> 삭제";
        ?>
    </td>
</tr>

<? if ($w == "u") { ?>
<tr class='ht'>
    <td>카운트 조정</td>
    <td colspan=3>
        <input type=checkbox name=proc_count value=1> 카운트를 조정합니다. 작업시간이 몇분 걸릴 수 있습니다.
        (현재 원글수 : <?=number_format($board[bo_count_write])?> , 현재 코멘트수 : <?=number_format($board[bo_count_comment])?>)
    </td>
</tr>
<? } ?>

<tr class='ht'>
    <td style="<?=b_draw('top', '#00D952') ?><?=b_draw('left', '#00D952') ?> ">그룹 동일 적용</td>
    <td style="<?=b_draw('top', '#00D952') ?><?=b_draw('right', '#00D952') ?>" colspan=3><input type=checkbox name=group_same1 value='1'>같은 그룹에 속한 게시판을 이 테두리안의 옵션으로 동일하게 적용합니다.</td>
</tr>

<tr class='ht'>
    <td style="<?=b_draw('bottom', '#00D952') ?><?=b_draw('left', '#00D952') ?> ">게시판 관리자</td>
    <td style="<?=b_draw('bottom', '#00D952') ?><?=b_draw('right', '#00D952') ?>" colspan=3><?=get_member_id_select("bo_admin", 9, $board[bo_admin])?></td>
</tr>
<tr><td colspan=4 class='ht'></td></tr>


<tr class='ht'>
    <td style="<?=b_draw('top') ?><?=b_draw('left') ?> ">그룹 동일 적용</td>
    <td style="<?=b_draw('top') ?><?=b_draw('right') ?>" colspan=3><input type=checkbox name=group_same2 value='1'>같은 그룹에 속한 게시판을 이 테두리안의 옵션으로 동일하게 적용합니다.</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?>">목록보기 권한</td>
    <td><?=get_member_level_select('bo_list_level', 1, 10, $board[bo_list_level]) ?></td>
    <td>글읽기 권한</td>
    <td style="<?=b_draw('right') ?>"><?=get_member_level_select('bo_read_level', 1, 10, $board[bo_read_level]) ?></td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?>">글쓰기 권한</td>
    <td><?=get_member_level_select('bo_write_level', 1, 10, $board[bo_write_level]) ?></td>
    <td>글답변 권한</td>
    <td style="<?=b_draw('right') ?>"><?=get_member_level_select('bo_reply_level', 1, 10, $board[bo_reply_level]) ?></td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?>">코멘트쓰기 권한</td>
    <td><?=get_member_level_select('bo_comment_level', 1, 10, $board[bo_comment_level]) ?></td>
    <td>링크 권한</td>
    <td style="<?=b_draw('right') ?>"><?=get_member_level_select('bo_link_level', 1, 10, $board[bo_link_level]) ?></td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?>">업로드 권한</td>
    <td><?=get_member_level_select('bo_upload_level', 1, 10, $board[bo_upload_level]) ?></td>
    <td>다운로드 권한</td>
    <td style="<?=b_draw('right') ?>"><?=get_member_level_select('bo_download_level', 1, 10, $board[bo_download_level]) ?></td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?>">HTML 쓰기 권한</td>
    <td><?=get_member_level_select('bo_html_level', 1, 10, $board[bo_html_level]) ?></td>
    <td>트랙백쓰기 권한</td>
    <td style="<?=b_draw('right') ?>"><?=get_member_level_select('bo_trackback_level', 1, 10, $board[bo_trackback_level]) ?></td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?>">원글 수정 불가</td>
    <td>코멘트 <input type=text class='edit' name=bo_count_modify size=3 required numeric itemname='원글 수정 불가 코멘트수' value='<?=$board[bo_count_modify]?>'>개 이상 달리면 수정불가</td>
    <td>원글 삭제 불가</td>
    <td style="<?=b_draw('right')?>">코멘트 <input type=text class='edit' name=bo_count_delete size=3 required numeric itemname='원글 삭제 불가 코멘트수' value='<?=$board[bo_count_delete]?>'>개 이상 달리면 삭제불가</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?>">포인트 설정</td>
    <td colspan=3 style="<?=b_draw('right') ?>"><input type=checkbox name="chk_point" onclick="set_point(this.form)"> 환경설정에 입력된 포인트로 설정</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?>">글읽기 포인트</td>
    <td><input type=text class='edit' name=bo_read_point size=10 required itemname='글읽기 포인트' value='<?=$board[bo_read_point]?>'></td>
    <td>글쓰기 포인트</td>
    <td style="<?=b_draw('right')?>"><input type=text class='edit' name=bo_write_point size=10 required itemname='글쓰기 포인트' value='<?=$board[bo_write_point]?>'></td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left')?><?=b_draw('bottom')?>">코멘트쓰기 포인트</td>
    <td style="<?=b_draw('bottom')?>"><input type=text class='edit' name=bo_comment_point size=10 required itemname='답변, 코멘트쓰기 포인트' value='<?=$board[bo_comment_point]?>'></td>
    <td style="<?=b_draw('bottom')?>">다운로드 포인트</td>
    <td style="<?=b_draw('right')?><?=b_draw('bottom')?>"><input type=text class='edit' name=bo_download_point size=10 required itemname='다운로드 포인트' value='<?=$board[bo_download_point]?>'></td>
</tr>
<tr><td colspan=4 class='ht'></td></tr>


<tr class='ht'>
    <td style="<?=b_draw('top', '#00D952') ?><?=b_draw('left', '#00D952') ?> ">그룹 동일 적용</td>
    <td style="<?=b_draw('top', '#00D952') ?><?=b_draw('right', '#00D952') ?>" colspan=3>
        <input type=checkbox name=group_same3_1 value='1'>같은 그룹에 속한 게시판을 이 테두리안의 옵션으로 동일하게 적용합니다.</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left', '#00D952')?>">분류 사용</td>
    <td colspan=3 style="<?=b_draw('right', '#00D952')?>">
        <input type=checkbox name=bo_use_category value='1' <?=$board[bo_use_category]?'checked':'';?>>사용
    </td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left', '#00D952') ?> <?=b_draw('bottom', '#00D952')?>">분류</td>
    <td colspan=3 style="<?=b_draw('right', '#00D952') ?> <?=b_draw('bottom', '#00D952')?>">
        <input type=text class='edit' name=bo_category_list style='width:99%;' value='<?=$board[bo_category_list]?>'>
        <br> 분류와 분류 사이는 | 로 구분하세요. (예: 질문|답변)
    </td>
</tr>
<tr><td colspan=4 class='ht'></td></tr>

<tr class='ht'>
    <td style="<?=b_draw('top', '#74A3C8') ?><?=b_draw('left', '#74A3C8') ?> ">그룹 동일 적용</td>
    <td style="<?=b_draw('top', '#74A3C8') ?><?=b_draw('right', '#74A3C8') ?>" colspan=3>
        <input type=checkbox name=group_same3_1 value='1'>같은 그룹에 속한 게시판을 이 테두리안의 옵션으로 동일하게 적용합니다.</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left', '#74A3C8') ?>">사용금지 태그</td>
    <td colspan=3 style="<?=b_draw('right', '#74A3C8') ?>">
        <input type=text class='edit' name=bo_disable_tags style='width:99%;' value='<?=$board[bo_disable_tags]?>'>
        <br> 태그와 태그 사이는 | 로 구분하세요. (예: <b>script</b>|<b>iframe</b>) HTML 사용시 금지할 태그를 입력하세요.
    </td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left', '#74A3C8') ?>">글쓴이 사이드뷰</td>
    <td><input type=checkbox name=bo_use_sideview value='1' <?=$board[bo_use_sideview]?'checked':'';?>>사용 (글쓴이 클릭시 나오는 레이어 메뉴)</td>
    <td>파일 설명 사용</td>
    <td style="<?=b_draw('right', '#74A3C8') ?>"><input type=checkbox name=bo_use_file_content value='1' <?=$board[bo_use_file_content]?'checked':'';?>>사용</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left', '#74A3C8') ?>">코멘트 새창 사용</td>
    <td><input type=checkbox name=bo_use_comment value='1' <?=$board[bo_use_comment]?'checked':'';?>>사용 (코멘트수 클릭시 새창으로 보임)</td>
    <td>비밀글 사용</td>
    <td style="<?=b_draw('right', '#74A3C8') ?>"><input type=checkbox name=bo_use_secret value='1' <?=$board[bo_use_secret]?'checked':'';?>>사용</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left', '#74A3C8') ?>">추천 사용</td>
    <td><input type=checkbox name=bo_use_good value='1' <?=$board[bo_use_good]?'checked':'';?>>사용</td>
    <td>비추천 사용</td>
    <td style="<?=b_draw('right', '#74A3C8') ?>"><input type=checkbox name=bo_use_nogood value='1' <?=$board[bo_use_nogood]?'checked':'';?>>사용</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left', '#74A3C8') ?>">이름(실명) 사용</td>
    <td><input type=checkbox name=bo_use_name value='1' <?=$board[bo_use_name]?'checked':'';?>>사용</td>
    <td>서명보이기 사용</td>
    <td style="<?=b_draw('right', '#74A3C8') ?>"><input type=checkbox name=bo_use_signature value='1' <?=$board[bo_use_signature]?'checked':'';?>>사용</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left', '#74A3C8') ?>">IP 보이기 사용</td>
    <td><input type=checkbox name=bo_use_ip_view value='1' <?=$board[bo_use_ip_view]?'checked':'';?>>사용</td>
    <td>트랙백 사용</td>
    <td style="<?=b_draw('right', '#74A3C8') ?>"><input type=checkbox name=bo_use_trackback value='1' <?=$board[bo_use_trackback]?'checked':'';?>>사용 (트랙백쓰기 권한 보다 우선함)</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left', '#74A3C8') ?><?=b_draw('bottom', '#74A3C8') ?>">목록에서 내용 사용</td>
    <td style="<?=b_draw('bottom', '#74A3C8') ?>"><input type=checkbox name=bo_use_list_content value='1' <?=$board[bo_use_list_content]?'checked':'';?>>사용 (사용시 속도 느려짐)</td>
    <td style="<?=b_draw('bottom', '#74A3C8') ?>">전체목록보이기 사용</td>
    <td style="<?=b_draw('right', '#74A3C8') ?><?=b_draw('bottom', '#74A3C8') ?>"><input type=checkbox name=bo_use_list_view value='1' <?=$board[bo_use_list_view]?'checked':'';?>>사용</td>
</tr>
<tr><td colspan=4 class='ht'></td></tr>


<tr class='ht'>
    <td style="<?=b_draw('top') ?><?=b_draw('left') ?> ">그룹 동일 적용</td>
    <td style="<?=b_draw('top') ?><?=b_draw('right') ?>" colspan=3><input type=checkbox name=group_same4 value='1'>같은 그룹에 속한 게시판을 이 테두리안의 옵션으로 동일하게 적용합니다.</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?>">스킨 디렉토리</td>
    <td><select name=bo_skin required itemname="스킨 디렉토리">
        <?
        $arr = get_skin_dir("board");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
        ?></select>
        <script language="JavaScript">document.fboardform.bo_skin.value="<?=$board[bo_skin]?>";</script>
    </td>
    <td>가로 이미지수</td>
    <td style="<?=b_draw('right') ?>"><input type=text class='edit' name=bo_gallery_cols size=10 required itemname='가로 이미지수' value='<?=$board[bo_gallery_cols]?>'> 겔러리 형식에서만 사용</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?>">게시판 테이블 폭</td>
    <td><input type=text class='edit' name=bo_table_width size=10 required itemname='게시판 테이블 폭' value='<?=$board[bo_table_width]?>'> 100 이하는 %</td>
    <td>페이지당 목록 수</td>
    <td style="<?=b_draw('right') ?>"><input type=text class='edit' name=bo_page_rows size=10 required itemname='페이지당 목록 수' value='<?=$board[bo_page_rows]?>'></td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?> ">제목 길이</td>
    <td><input type=text class='edit' name=bo_subject_len size=10 required itemname='제목 길이' value='<?=$board[bo_subject_len]?>'><br>목록에서 제목 글자수. 잘리는 글은 … 로 표시</td>
    <td>new 이미지</td>
    <td style="<?=b_draw('right') ?>"><input type=text class='edit' name=bo_new size=10 required itemname='new 이미지' value='<?=$board[bo_new]?>'><br>글 입력후 new 이미지를 출력하는 시간</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?> ">hot 이미지</td>
    <td><input type=text class='edit' name=bo_hot size=10 required itemname='hot 이미지' value='<?=$board[bo_hot]?>'><br>조회수가 설정값 이상이면 hot 이미지 출력</td>
    <td>이미지 폭 크기</td>
    <td style="<?=b_draw('right') ?>"><input type=text class='edit' name=bo_image_width size=10 required itemname='이미지 폭 크기' value='<?=$board[bo_image_width]?>'> 픽셀<br>(게시판에서 출력되는 이미지의 폭 크기)</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?> ">글수 제한</td>
    <td colspan=3 style="<?=b_draw('right') ?>">
        최소 <input type=text class='edit' name=bo_write_min size=5 numeric value='<?=$board[bo_write_min]?>'>&nbsp;
        최대 <input type=text class='edit' name=bo_write_max size=5 numeric value='<?=$board[bo_write_max]?>'>
        (글 입력시 최소 글자수, 최대 글자수를 설정. 0을 입력하면 검사하지 않음)
    </td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?> ">코멘트수 제한</td>
    <td colspan=3 style="<?=b_draw('right') ?>">
        최소 <input type=text class='edit' name=bo_comment_min size=5 numeric value='<?=$board[bo_comment_min]?>'>&nbsp;
        최대 <input type=text class='edit' name=bo_comment_max size=5 numeric value='<?=$board[bo_comment_max]?>'>
        (코멘트 입력시 최소 글자수, 최대 글자수를 설정. 0을 입력하면 검사하지 않음)
    </td>
</tr>
<?
$upload_max_filesize = ini_get("upload_max_filesize");
if (!preg_match("/([m|M])$/", $upload_max_filesize)) {
    $upload_max_filesize = (int)($upload_max_filesize / 1024768);
}
?>
<tr class='ht'>
    <td style="<?=b_draw('left') ?> <?=b_draw('bottom') ?>">업로드 용량</td>
    <td style="<?=b_draw('bottom') ?>"><input type=text class='edit' name=bo_upload_size size=10 required itemname='업로드 용량' value='<?=$board[bo_upload_size]?>'> bytes (최대 <?=ini_get("upload_max_filesize")?> 이하)<br>1 MB = 1,024,768 bytes</td>
    <td style="<?=b_draw('bottom') ?>">답변 달기</td>
    <td style="<?=b_draw('right') ?> <?=b_draw('bottom') ?>">
        <select name=bo_reply_order>
        <option value='1'>나중에 쓴 답변 아래로 달기 (기본)
        <option value='0'>나중에 쓴 답변 위로 달기
        </select>
        <script language='javascript'> document.fboardform.bo_reply_order.value = '<?=$board[bo_reply_order]?>'; </script>
    </td>
</tr>
<tr><td colspan=4 class='ht'></td></tr>


<tr class='ht'>
    <td style="<?=b_draw('top', '#00D952') ?><?=b_draw('left', '#00D952') ?> ">그룹 동일 적용</td>
    <td style="<?=b_draw('top', '#00D952') ?><?=b_draw('right', '#00D952') ?>" colspan=3><input type=checkbox name=group_same5 value='1'>같은 그룹에 속한 게시판을 이 테두리안의 옵션으로 동일하게 적용합니다.</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left', '#00D952') ?> ">상단 파일 경로</td>
    <td style="<?=b_draw('right', '#00D952') ?>" colspan=3><input type=text class='edit' name=bo_include_head style='width:99%;' value='<?=$board[bo_include_head]?>'></td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left', '#00D952') ?> <?=b_draw('bottom', '#00D952') ?>">하단 파일 경로</td>
    <td style="<?=b_draw('right', '#00D952') ?><?=b_draw('bottom', '#00D952') ?>" colspan=3><input type=text class='edit' name=bo_include_tail style='width:99%;' value='<?=$board[bo_include_tail]?>'></td>
</tr>
<tr><td colspan=4 class='ht'></td></tr>


<tr class='ht'>
    <td style="<?=b_draw('top') ?><?=b_draw('left') ?> ">그룹 동일 적용</td>
    <td style="<?=b_draw('top') ?><?=b_draw('right') ?>" colspan=3><input type=checkbox name=group_same6 value='1'>같은 그룹에 속한 게시판을 이 테두리안의 옵션으로 동일하게 적용합니다.</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?> ">상단 내용</td>
    <td style="<?=b_draw('right') ?>" colspan=3><textarea class='edit' name=bo_content_head rows=5 style='width:99%;'><?=$board[bo_content_head] ?></textarea></td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?> <?=b_draw('bottom') ?>">하단 내용</td>
    <td style="<?=b_draw('right') ?><?=b_draw('bottom') ?>" colspan=3><textarea class='edit' name=bo_content_tail rows=5 style='width:99%;'><?=$board[bo_content_tail] ?></textarea></td></tr>
</tr>
<tr><td colspan=4 class='ht'></td></tr>


<tr class='ht'>
    <td style="<?=b_draw('top', '#00D952') ?><?=b_draw('left', '#00D952') ?> ">그룹 동일 적용</td>
    <td style="<?=b_draw('top', '#00D952') ?><?=b_draw('right', '#00D952') ?>" colspan=3><input type=checkbox name=group_same7 value='1'>같은 그룹에 속한 게시판을 이 테두리안의 옵션으로 동일하게 적용합니다.</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left', '#00D952') ?> <?=b_draw('bottom', '#00D952') ?>">글쓰기 기본 내용</td>
    <td style="<?=b_draw('right', '#00D952') ?><?=b_draw('bottom', '#00D952') ?>" colspan=3><textarea class='edit' name=bo_insert_content rows=5 style='width:99%;'><?=$board[bo_insert_content] ?></textarea></td>
</tr>
<tr><td colspan=4 class='ht'></td></tr>


<tr class='ht'>
    <td style="<?=b_draw('top') ?><?=b_draw('left') ?> ">그룹 동일 적용</td>
    <td style="<?=b_draw('top') ?><?=b_draw('right') ?>" colspan=3><input type=checkbox name=group_same8 value='1'>같은 그룹에 속한 게시판을 이 테두리안의 옵션으로 동일하게 적용합니다.</td>
</tr>
<tr class='ht'>
    <td style="<?=b_draw('left') ?> <?=b_draw('bottom') ?>">전체 검색 사용</td>
    <td style="<?=b_draw('bottom') ?>"><input type=checkbox name=bo_use_search value='1' <?=$board[bo_use_search]?'checked':'';?>>사용</td>
    <td style="<?=b_draw('bottom') ?>">전체 검색 순서</td>
    <td style="<?=b_draw('right') ?><?=b_draw('bottom') ?>"><input type=text class='edit' name=bo_order_search size=5 value='<?=$board[bo_order_search]?>'> 숫자가 낮은 게시판 부터 검색</td>
</tr>
<tr><td colspan=4 class='ht'></td></tr>


<tr class='ht'>
    <td style="<?=b_draw('top', '#00D952') ?><?=b_draw('left', '#00D952') ?> ">그룹 동일 적용</td>
    <td style="<?=b_draw('top', '#00D952') ?><?=b_draw('right', '#00D952') ?>" colspan=3><input type=checkbox name=group_same9 value='1'>같은 그룹에 속한 게시판을 이 테두리안의 옵션으로 동일하게 적용합니다.</td>
</tr>

<? for ($i=1; $i<=10; $i=$i+2) { $k=$i+1; ?>
<tr class='ht'>
    <td style="<?=b_draw('left', '#00D952') ?> ">여분 필드 <?=$i?></td>
    <td><input type=text class='edit' style='width:99%;' name=bo_<?=$i?> value='<?=$board["bo_$i"]?>'></td>
    <td>여분 필드 <?=$k?></td>
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

    tmp_title = "상단";
    tmp_image = f.bo_image_head;
    if (tmp_image.value) {
        if (!tmp_image.value.toLowerCase().match(/.(gif|jpg|png)$/i)) {
            alert(tmp_title + "이미지가 gif, jpg, png 파일이 아닙니다.");
            return;
        }
    }

    tmp_title = "하단";
    tmp_image = f.bo_image_tail;
    if (tmp_image.value) {
        if (!tmp_image.value.toLowerCase().match(/.(gif|jpg|png)$/i)) {
            alert(tmp_title + "이미지가 gif, jpg, png 파일이 아닙니다.");
            return;
        }
    }

    if (parseInt(f.bo_count_modify.value) < 1) {
        alert("원글 수정 불가 코멘트수는 1 이상 입력하셔야 합니다.");
        f.bo_count_modify.focus();
        return;
    }

    if (parseInt(f.bo_count_delete.value) < 1) {
        alert("원글 삭제 불가 코멘트수는 1 이상 입력하셔야 합니다.");
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
