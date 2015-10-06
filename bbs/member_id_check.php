<?
include_once("./_common.php");

$g4[title] = "회원아이디 중복확인";
include_once("$g4[path]/head.sub.php");

$mb = get_member($mb_id);
if ($mb[mb_id]) {
    echo <<<HEREDOC
    <script language="JavaScript"> 
        alert("'{$mb_id}'은(는) 이미 가입된 회원아이디 이므로 사용하실 수 없습니다."); 
        parent.document.getElementById("mb_id_enabled").value = -1;
        window.close();
    </script>
HEREDOC;
} else {
    echo <<<HEREDOC
    <script language="JavaScript"> 
        alert("'{$mb_id}'은(는) 중복된 회원아이디가 없습니다.\\n\\n사용하셔도 좋습니다."); 
        parent.document.getElementById("mb_id_enabled").value = 1;
        window.close();
    </script>
HEREDOC;
}

include_once("$g4[path]/tail.sub.php");
?>