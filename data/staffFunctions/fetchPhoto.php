<?php
include_once("../classes/class.proctorFunctions.php");
$post = file_get_contents("php://input");
$entryData = json_decode($post);
$obj = new proctor();
$photo = $obj->fetchPhoto($entryData);
echo json_encode($photo);

?>
