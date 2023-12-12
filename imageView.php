<?php
include('functions.php');
$functions=new functions();
$id=$_GET['id'];
$picture=$functions->getPictureByProdId($id);
header("Content-type: " . $picture[0]["type"]);
echo $picture[0]['data'];
?>