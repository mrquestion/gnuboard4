<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

if ($w=='i' && $oneboard[ob_insert_content]) {
    $one[on_question] = conv_content($oneboard[ob_insert_content], $is_dhtml_editor);
}

@include_once("$oneboard_skin_path/oneform.skin.php");
?>