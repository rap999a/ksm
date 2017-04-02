<?php
include_once("../classes/class.proctorFunctions.php");
$post = file_get_contents("php://input");
$entryData = json_decode($post,true);
$studentData = $entryData[0];
$remarks = $entryData[1];
$studentData = explode("@",$studentData['sr_no']);
$studentID = $studentData[0];
$studentclass = $studentData[1];
$date = Date('d-m-Y');
$month = Date('m');
$obj = new proctor();
$data = $obj->saveMeetingData($remarks,$studentID,$studentclass,$date,$month);
?>
