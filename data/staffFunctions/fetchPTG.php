<?php
include_once("../classes/class.proctorFunctions.php");
$post = file_get_contents("php://input");
$entryData = json_decode($post);
$obj = new proctor();
$class = $obj->getID(2,$entryData);
$current_class_id = $obj->getCurrentClass($entryData->sr_no,$class[0]['prim_id']);
$data = $obj->fetchPTG($entryData,$current_class_id);
echo json_encode($data);
?>
