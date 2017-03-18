<?php
include_once("../classes/class.proctorFunctions.php");
$post = file_get_contents("php://input");
$entryData = json_decode($post);
// $entryData = array('class'=>'1','sem'=>'1','ut'=>'1');
$_SESSION['approved'] = 0;
$obj = new proctor();
$classId = $obj->storeUTData($_SESSION['approved'],$entryData);
echo json_encode($obj->checkEntry('PM010005',$classId));
?>
