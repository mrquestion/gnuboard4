<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

if ($w=='i' && $oneboard[ob_insert_content]) {
    $one[on_question] = conv_content($oneboard[ob_insert_content], $is_dhtml_editor);
}

@include_once("$oneboard_skin_path/oneform.skin.php");
?>