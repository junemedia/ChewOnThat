<?php
$preview = $_REQUEST['preview'];
if ($preview == "") {
$preview = "false";
}
?>
var preview = <?php echo $preview; ?>;
if (preview != true && self != top)
{
top.location.href = document.location.href;
}