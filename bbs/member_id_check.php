<?
include_once("./_common.php");

$g4[title] = "ȸ�����̵� �ߺ�Ȯ��";
include_once("$g4[path]/head.sub.php");

$mb = get_member($mb_id);
if ($mb[mb_id]) {
    echo <<<HEREDOC
    <script language="JavaScript"> 
        alert("'{$mb_id}'��(��) �̹� ���Ե� ȸ�����̵� �̹Ƿ� ����Ͻ� �� �����ϴ�."); 
        parent.document.getElementById("mb_id_enabled").value = -1;
        window.close();
    </script>
HEREDOC;
} else {
    echo <<<HEREDOC
    <script language="JavaScript"> 
        alert("'{$mb_id}'��(��) �ߺ��� ȸ�����̵� �����ϴ�.\\n\\n����ϼŵ� �����ϴ�."); 
        parent.document.getElementById("mb_id_enabled").value = 1;
        window.close();
    </script>
HEREDOC;
}

include_once("$g4[path]/tail.sub.php");
?>