<? 
//
// 조병완(korone)님 , 남규아빠(eagletalon)님께서 만들어 주셨습니다.
//

$sub_menu = "100960"; 
include_once("./_common.php"); 
include_once("$g4[path]/lib/mailer.lib.php"); 

$g4[title] = "버전확인"; 

include_once("./admin.head.php"); 

echo "현재버전 : <b>";
$args = "head -1 ".$g4[path]."/HISTORY"; 
system($args); 
echo "</b>";
?> 

<table width=100% border="0" align="left" cellpadding="0" cellspacing="0"> 
<tr> 
    <td> 

<textarea name="textarea" style='width:100%; line-height:150%;' rows="25" class="box" readonly><?=implode("", file("$g4[path]/HISTORY"));?></textarea> 

    </td> 
</tr> 
</table> 

<? 
include_once("./admin.tail.php"); 
?> 
