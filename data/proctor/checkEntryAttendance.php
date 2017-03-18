<?php
include_once("../classes/class.proctorFunctions.php");
$post = file_get_contents("php://input");
$entryData = json_decode($post);
$obj = new proctor();
$classId = $obj->getID(2,$entryData);
$classId[0]['fortnight'] = $entryData->fortnight;
$obj->checkEntryAttendance('PM010007',$classId);
?>
