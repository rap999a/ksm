<?php
include_once("../classes/class.proctorFunctions.php");
$post = file_get_contents("php://input");
$entryData = json_decode($post);
// echo json_encode(sizeof($entryData));
$obj = new proctor();
$classId = $obj->storeUnivData($entryData);

?>
