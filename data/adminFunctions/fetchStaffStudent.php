<?php
include_once("../classes/class.proctorFunctions.php");
$post = file_get_contents("php://input");
$entryData = json_decode($post);
$obj = new proctor();
$class = $obj->getID(2,$entryData);
$branch = $entryData->branch;
$division = $entryData->div;
$staff = $obj->fetchStaff($branch);
$student = $obj->fetchStudent($class[0]['prim_id'],$branch,$division);

$returnData = array();

$returnData[0]=$staff;
$returnData[1]=$student;

echo json_encode($returnData);
?>
