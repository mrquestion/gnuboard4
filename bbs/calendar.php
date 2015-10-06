<?
include_once("./_common.php");

$g4[title] = "달력";
include_once("$g4[path]/head.sub.php");

// 오늘
$today = getdate($g4[server_time]);
$han_yoil = array ("일", "월", "화", "수", "목", "금", "토");

if (!$yyyy) $yyyy = $today[year];
if (!$mm) $mm = $today[mon];

// 해당월의 1일
$mktime = mktime(0,0,0,$mm,1,$yyyy);
$dt = getdate(strtotime(date("Y-m-1", $mktime)));

// 해당월의 마지막 날짜,
$last_day = date("t", $mktime);

$yyyy_before = $yyyy;
$mm_before = $mm - 1;
if ($mm_before < 1) {
    $yyyy_before--;
    $mm_before = 12;
}

$yyyy_after = $yyyy;
$mm_after = $mm + 1;
if ($mm_after > 12) {
    $yyyy_after++;
    $mm_after = 1;
}
?>
<table border=0 cellpadding=4>
<form name=fcalendar autocomplete=off>
<input type=hidden name=fld value='<?=$fld?>'>
<tr><td align=center>
<a href='?yyyy=<?=($yyyy-1)?>&mm=<?=$mm?>&fld=<?=$fld?>'><<</a>
&nbsp;<a href='?yyyy=<?=$yyyy_before?>&mm=<?=$mm_before?>&fld=<?=$fld?>'><</a>
&nbsp;<input type=text name=yyyy value='<?=$yyyy?>' size=3 maxlength=4 onkeydown="keydown(event)">년
<input type=text name=mm value='<?=$mm?>' size=1 maxlength=2 onkeydown="keydown(event)">월
&nbsp;<a href='?yyyy=<?=$yyyy_after?>&mm=<?=$mm_after?>&fld=<?=$fld?>'>></a>
&nbsp;<a href='?yyyy=<?=($yyyy+1)?>&mm=<?=$mm_after?>&fld=<?=$fld?>'>>></a>

<table border=1 cellpadding=4 cellspacing=0>
<colgroup width=40>
<colgroup width=40>
<colgroup width=40>
<colgroup width=40>
<colgroup width=40>
<colgroup width=40>
<colgroup width=40>
<tr>
    <td><font color=red>일</font></td>
    <td>월</td>
    <td>화</td>
    <td>수</td>
    <td>목</td>
    <td>금</td>
    <td><font color=blue>토</font></td>
</tr>
<?
$cnt = $day = 0;
for ($i=0; $i<6; $i++) {
    echo "<tr>";
    for ($k=0; $k<7; $k++) {
        $cnt++;

        echo "<td align=center>";

        if ($cnt > $dt[wday]) {
            $day++;
            if ($day <= $last_day) {
                $mm2 = substr("0".$mm,-2);
                $day2 =  substr("0".$day,-2);
                echo "<a href=\"javascript:date_send('$yyyy', '$mm2', '$day2', '$k', '$han_yoil[$k]');\">";

                if ($k==0) echo "<font color='red'>";
                else if ($k==6) echo "<font color='blue'>";
                else  echo "<font color='black'>";

                // 오늘이라면
                if ($today[year] == $yyyy && $today[mon] == $mm && $today[mday] == $day)
                    echo "<span style='background-color:yellow;'><b>$day</b></span>";
                else 
                    echo $day;

                echo "</font></a>";              
            } else
                echo "&nbsp;";
        } else
            echo "&nbsp;";
        echo "</td>";
    }
    echo "</tr>\n";
    if ($day >= $last_day)
        break;
}
?>
</table>

<?
//print_r2($today);
?>
<!-- <a href='?yyyy=<?=$today[year]?>&mm=<?=$today[mon]?>&fld=<?=$fld?>'>오늘 : <?="{$today[year]}년 {$today[mon]}월 {$today[mday]}일 ({$han_yoil[$today[wday]]})";?></a> -->
오늘 : <?="{$today[year]}년 {$today[mon]}월 {$today[mday]}일 ({$han_yoil[$today[wday]]})";?>

</td></tr>
</form>
</table>

<script language="JavaScript">
    function keydown(evt)
    {
        if (evt.keyCode == 13) // ENTER
            document.fcalendar.submit();
    }

    //
    // year : 4자리
    // month : 1~2자리
    // day : 1~2자리
    // wday : 요일 숫자 (0:일 ~ 6:토)
    // handay : 요일 한글
    //
    function date_send(year, month, day, wday, handay)
    {
        opener.document.getElementById('<?=$fld?>').value = year + month + day;
        window.close();
    }
</script>

<?
include_once("$g4[path]/tail.sub.php");
?>
