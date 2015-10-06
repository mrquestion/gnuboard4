<?php

require_once("_config.php");
// ---------------------------------------------------------------------------

$delete = $_GET['img'];
$pos = strrpos($delete, '/');

$delete = substr($delete, $pos+1);
$filepath = sprintf("%s/%s", SAVE_DIR, $delete);

$r = unlink($filepath);

echo $r ? true : false;

?>
