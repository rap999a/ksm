<?php
include_once("../classes/class.proctorFunctions.php");
$obj = new proctor();
$returnData = $obj->fetchMyStudents();
echo json_encode($returnData);
?>
