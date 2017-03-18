<?php
include_once("../classes/class.proctorFunctions.php");
$post = file_get_contents("php://input");
$entryData = json_decode($post,true);
$obj = new proctor();
$obj->checkAcademicData();

?>
