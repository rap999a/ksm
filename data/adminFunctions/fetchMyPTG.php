<?php
include_once("../classes/class.proctorFunctions.php");

$obj = new proctor();
$returnData = $obj->fetchMyPTG();
echo json_encode($returnData);
?>
