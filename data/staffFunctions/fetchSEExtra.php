<?php
include_once("../classes/class.calcData.php");
$post = file_get_contents("php://input");
$entryData = json_decode($post);
$obj = new calcData();
$class = $obj->fetchSEExtra($entryData);
echo json_encode($class);
?>
