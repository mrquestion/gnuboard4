<?
if (!defined('_GNUBOARD_')) exit;

function cheditor1($id, $content)
{
    global $g4;

    return "<div id='ps_{$id}' style='display:none;'>{$content}</div>";
}

function cheditor2($form, $id, $width='100%', $height='250')
{
    global $g4;

    return "
    <input type='hidden' name='{$id}' id='{$id}'>
    <script>
    var ed_{$id} = new cheditor('ed_{$id}');
    ed_{$id}.editorPath = '{$g4[editor_path]}';
    ed_{$id}.width = '{$width}';
    ed_{$id}.height = '{$height}';
    ed_{$id}.pasteContent = true;
    ed_{$id}.pasteContentForm = 'ps_{$id}';
    ed_{$id}.formName = '{$form}';
    ed_{$id}.run();
    </script>";
}

function cheditor3($form, $id)
{
    global $g4;

    return "{$form}.{$id}.value = ed_{$id}.outputHTML();";
}
?>