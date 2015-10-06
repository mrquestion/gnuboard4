<?
$sub_menu = "200100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

if ($w == "") 
{
    $required_mb_id = "required minlength=3 alphanumericunderline itemname='회원아이디'";
    $required_mb_password = "required itemname='패스워드'";

    $mb[mb_mailling] = 1;
    $mb[mb_open] = 1;
    $mb[mb_level] = $config[cf_register_level];
    $html_title = "등록";
}
else if ($w == "u") 
{
    $mb = get_member($mb_id);
    if (!$mb[mb_id])
        alert("존재하지 않는 회원자료입니다."); 

    if ($is_admin != "super" && $mb[mb_level] >= $member[mb_level])
        alert("자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.");

    $required_mb_id = "readonly style='background-color:#dddddd;'";
    $required_mb_password = "";
    $html_title = "수정";
} 
else 
    alert("제대로 된 값이 넘어오지 않았습니다.");

if ($mb[mb_mailling])   $mailling_checked = "checked";  // 메일링 서비스
if ($mb[mb_open])       $open_checked = "checked";      // 정보 공개

$g4[title] = "회원정보 " . $html_title;
include_once("./admin.head.php");
?>

<table width=100% align=center cellpadding=0 cellspacing=0>
<form name=fmember method=post action="javascript:fmember_submit(document.fmember);" enctype="multipart/form-data" autocomplete="off">
<input type=hidden name=w    value='<?=$w?>'>
<input type=hidden name=sfl  value='<?=$sfl?>'>
<input type=hidden name=stx  value='<?=$stx?>'>
<input type=hidden name=sst  value='<?=$sst?>'>
<input type=hidden name=sod  value='<?=$sod?>'>
<input type=hidden name=page value='<?=$page?>'>
<colgroup width=20% class='col1 pad1 bold right'>
<colgroup width=30% class='col2 pad2'>
<colgroup width=20% class='col1 pad1 bold right'>
<colgroup width=30% class='col2 pad2'>
<tr>
    <td colspan=4 class=title align=left><img src='./img/icon_title.gif'> <?=$g4[title]?></td>
</tr>
<tr><td colspan=4 class=line1></td></tr>
<tr class='ht'>
    <td>아이디</td>
    <td>
        <input type=text class='edit' name='mb_id' size=20 maxlength=20 minlength=2 <?=$required_mb_id?> itemname='아이디' value='<? echo $mb[mb_id] ?>'>
        <?if ($w=="u"){?><a href='./boardgroupmember_form.php?mb_id=<?=$mb[mb_id]?>'>접근가능그룹보기</a><?}?>
    </td>
    <td>패스워드</td>
    <td><input type=password class='edit' name='mb_password' size=20 maxlength=20 <?=$required_mb_password?> itemname='암호'></td>
</tr>
<tr class='ht'>
    <td>이름(실명)</td>
    <td><input type=text class='edit' name='mb_name' maxlength=20 minlength=2 required itemname='이름(실명)' value='<? echo $mb[mb_name] ?>'></td>
    <td>별명</td>
    <td><input type=text class='edit' name='mb_nick' maxlength=20 minlength=2 required itemname='별명' value='<? echo $mb[mb_nick] ?>'></td>
</tr>
<tr class='ht'>
    <td>회원 권한</td>
    <td><?=get_member_level_select("mb_level", 1, 10, $row[bo_list_level])?></td>
    <td>포인트</td>
    <td><a href='point_list.php?sfl=a.mb_id&stx=<?=$mb[mb_id]?>' class='bold'><?=number_format($mb[mb_point])?></a> 점</td>
</tr>
<tr class='ht'>
    <td>E-mail</td>
    <td><input type=text class='edit' name='mb_email' size=40 maxlength=100 required email itemname='e-mail' value='<? echo $mb[mb_email] ?>'></td>
    <td>홈페이지</td>
    <td><input type=text class='edit' name='mb_homepage' size=40 maxlength=255 itemname='홈페이지' value='<? echo $mb[mb_homepage] ?>'></td>
</tr>
<tr class='ht'>
    <td>전화번호</td>
    <td><input type=text class='edit' name='mb_tel' maxlength=20 itemname='전화번호' value='<? echo $mb[mb_tel] ?>'></td>
    <td>핸드폰번호</td>
    <td><input type=text class='edit' name='mb_hp' maxlength=20 itemname='핸드폰번호' value='<? echo $mb[mb_hp] ?>'></td>
</tr>
<tr class='ht'>
    <td>주소</td>
    <td>
        <input type=text class='edit' name='mb_zip1' size=4 maxlength=3 readonly itemname='우편번호 앞자리' value='<? echo $mb[mb_zip1] ?>'> -
        <input type=text class='edit' name='mb_zip2' size=4 maxlength=3 readonly itemname='우편번호 뒷자리' value='<? echo $mb[mb_zip2] ?>'>
        <a href="javascript:;" onclick="win_zip('fmember', 'mb_zip1', 'mb_zip2', 'mb_addr1', 'mb_addr2');"><img src='<?=$g4[bbs_img_path]?>/btn_zip.gif' align=absmiddle border=0></a>
        <br><input type=text class='edit' name='mb_addr1' size=40 readonly value='<? echo $mb[mb_addr1] ?>'>
        <br><input type=text class='edit' name='mb_addr2' size=25 itemname='상세주소' value='<? echo $mb[mb_addr2] ?>'> 상세주소 입력</td>
    <td>회원아이콘</td>
    <td colspan=3>
        <input type=file name='mb_icon' class='edit'><br>이미지 크기는 <?=$config[cf_member_icon_width]?>x<?=$config[cf_member_icon_height]?>으로 해주세요.
        <?
        $mb_dir = substr($mb[mb_id],0,2);
        $icon_file = "$g4[path]/data/member/$mb_dir/$mb[mb_id].gif";
        if (file_exists($icon_file)) {
            echo "<br><img src='$icon_file' align=absmiddle>";
            echo " <input type=checkbox name='del_mb_icon' value='1' class='csscheck'>삭제";
        }   
        ?>
    </td>
</tr>
<tr class='ht'>
    <td>생년월일</td>
    <td><input type=text class='edit' name=mb_birth size=9 maxlength=8 value='<? echo $mb[mb_birth] ?>'></td>
    <td>남녀</td>
    <td>
        <select name=mb_sex><option value=''>----<option value='F'>여자<option value='M'>남자</select>
        <script language="JavaScript"> document.fmember.mb_sex.value = "<?=$mb[mb_sex]?>"; </script></td>
</tr>
<tr class='ht'>
    <td>메일링 서비스</td>
    <td><input type=checkbox name=mb_mailling value='1' <?=$mailling_checked?>> 정보 메일을 받음</td>
    <td>정보 공개</td>
    <td><input type=checkbox name=mb_open value='1' <?=$open_checked?>> 타인에게 자신의 정보를 공개</td>
</tr>
<tr class='ht'>
    <td>서명</td>
    <td><textarea class='edit' name=mb_signature rows=5 style='width:99%;'><? echo $mb[mb_signature] ?></textarea></td>
    <td>자기 소개</td>
    <td><textarea class='edit' name=mb_profile rows=5 style='width:99%;'><? echo $mb[mb_profile] ?></textarea></td>
</tr>
<tr class='ht'>
    <td>메모</td>
    <td colspan=3><textarea class='edit' name=mb_memo rows=5 style='width:99%;'><? echo $mb[mb_memo] ?></textarea></td>
</tr>

<? if ($w == "u") { ?>
<tr class='ht'>
    <td>회원가입일</td>
    <td><?=$mb[mb_datetime]?></td>
    <td>최근접속일</td>
    <td><?=$mb[mb_today_login]?></td>
</tr>
<tr class='ht'>
    <td>IP</td>
    <td colspan=3><?=$mb[mb_ip]?></td>
</tr>
<? } ?>

<tr class='ht'>
    <td>탈퇴일자</td>
    <td><input type=text class='edit' name=mb_leave_date size=9 maxlength=8 value='<? echo $mb[mb_leave_date] ?>'></td>
    <td>접근차단일자</td>
    <td><input type=text class='edit' name=mb_intercept_date size=9 maxlength=8 value='<? echo $mb[mb_intercept_date] ?>'> <input type=checkbox value='<? echo date("Ymd"); ?>' onclick='if (this.form.mb_intercept_date.value==this.form.mb_intercept_date.defaultValue) { this.form.mb_intercept_date.value=this.value; } else { this.form.mb_intercept_date.value=this.form.mb_intercept_date.defaultValue; } '>오늘</td>
</tr>

<? for ($i=1; $i<=10; $i=$i+2) { $k=$i+1; ?>
<tr class='ht'>
    <td>여분 필드 <?=$i?></td>
    <td><input type=text class='edit' style='width:99%;' name='mb_<?=$i?>' maxlength=255 value='<?=$mb["mb_$i"]?>'></td>
    <td>여분 필드 <?=$k?></td>
    <td><input type=text class='edit' style='width:99%;' name='mb_<?=$k?>' maxlength=255 value='<?=$mb["mb_$k"]?>'></td>
</tr>
<? } ?>

<tr><td colspan=4 class=line2></td></tr>
</table>

<p align=center>
    <input type=image src='./img/btn_confirm.gif' accesskey='s'>&nbsp;
    <a href='./member_list.php?<?=$qstr?>'><img src='./img/btn_list.gif' border=0></a>
</form>

<script language='Javascript'>
    if (document.fmember.w.value == "")
        document.fmember.mb_id.focus();
    else if (document.fmember.w.value == "u")
        document.fmember.mb_password.focus();

    if (typeof(document.fmember.mb_level) != "undefined") 
        document.fmember.mb_level.value   = "<?=$mb[mb_level]?>"; 

    function fmember_submit(f)
    {
        if (!f.mb_icon.value.match(/\.(gif|jp[e]g|png)$/i) && f.mb_icon.value) {
            alert('아이콘이 이미지 파일이 아닙니다. (bmp 제외)');
            return;
        }

        f.action = './member_form_update.php';
        f.submit();
    }
</script>

<?
include_once("./admin.tail.php");
?>
