<?
include_once("./_common.php");

if ($is_admin != "super")
    alert("�ְ�����ڸ� ��ȯ �����մϴ�", "$g4[bbs_path]/login.php?url=".urlencode($_SERVER[PHP_SELF]));

$g4[title] = "�ڷ� ��ȯ";
include_once("$g4[path]/head.sub.php");
?>

<br>
<ol>�״�����3 ���� ��ȯ
    <li><a href="./g3_member.php">ȸ��, ����Ʈ</a>
    <li><a href="./g3_board.php">�Խ���</a>
    <li><a href="./g3_dabsagi.php">���� �Խ���</a>
    <li><a href="./g3_count.php">�湮�ڼ�</a>
    <li><a href="./g3_vote.php">��ǥ</a>
    <li><a href="./g3_board_multi.php">�Խ��� ��Ƽ</a>
</ol>

<?
include_once("$g4[path]/tail.sub.php");
?>